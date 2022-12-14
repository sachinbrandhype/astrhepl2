const axios = require("axios").default;
const { User, Astrologer, Booking, Bookingrequest, sequelize, Transaction } = require('../models')
const { isPhoneExists, fetchUserByPhone, fetchUserByID, currentTimeStamp, getUserIpAddress } = require("../helpers/user.helper");
const { successRes, failedRes } = require("../helpers/response.helper");
const { send_booking_complete_notification, accept_reject_book_notification } = require("../helpers/notification.helper");
const { set_astrologer_comission_to_order, for_audio_call, booking_status_function } = require('./home.controller')
const { Op } = require('sequelize')
const moment = require('moment')

const get_tatatele_token = async (req, res) => {
  const options = {
    method: 'POST',
    url: 'https://api-smartflo.tatateleservices.com/v1/auth/login',
    headers: { Accept: 'application/json', 'Content-Type': 'application/json' },
    // data: { email: 'astrohelptwentyfour@gmail.com', password: 'Astrohelp@tatatele1' }
    data: { email: 'astro.help', password: 'Suneet!@456' }
  };

  const data = await axios.request(options).then(function (response) {
    console.log(response.data);
    return response.data.success ? response.data.access_token : false

  }).catch(function (error) {
    console.error(error);
    return false
  });
  return data;
}



const make_audio_call_astrologer_function = async (us_id, ast_id, price_mint) => {
  // var { user_id, astrologer_id, price_per_mint } = req.body
  // user_id = 3;
  // astrologer_id = 1;
  // price_per_mint = 10;
  var user_id = us_id;
  var astrologer_id = ast_id;
  var price_per_mint = parseFloat(price_mint);

  const check1 = await Bookingrequest.findOne({
    where: {
      status: {
        [Op.in]: [0],
      },
      user_id: user_id,
    },
    order: [["id", "desc"]],
  });
  const check2 = await Booking.findOne({
    where: {
      user_id: user_id,
      status: {
        [Op.in]: [0, 1, 6]
      },
      type: {
        [Op.in]: [1, 2, 3]
      }
    }

  })
  if (check1 || check2) {
    return (failedRes('You have already ongoing booking!Please try after some time'))

  } else {
    const token = await get_tatatele_token();
    if (token) {
      const userdata = await User.findOne({
        where: {
          id: user_id
        }
      })

      const astrologerdata = await Astrologer.findOne({
        where: {
          id: astrologer_id
        }
      });
      var wallet = parseFloat(userdata.wallet);
      // price_per_mint = parseFloat(astrologerdata.price_per_mint_audio);
      var total_minutes = Math.floor(wallet / price_per_mint);
      var total_seconds = total_minutes * 60;
      if (parseFloat(userdata.wallet) < price_per_mint) {
        return (failedRes('Please recharge your wallet to proceed'))
      }



      const options = {
        method: 'POST',
        url: 'https://api-smartflo.tatateleservices.com/v1/click_to_call',
        headers: { Accept: 'application/json', 'Content-Type': 'application/json', Authorization: token },
        data: {
          agent_number: astrologerdata.phone,
          destination_number: userdata.phone,
          //   caller_id: 'string',
          async: 0,
          call_timeout: total_seconds,
          //   custom_identifier: 'string',
          get_call_id: 1
        }
      };

      const data = await axios.request(options).then(async (response) => {
        // console.log(response.data);
        const calldata = response.data;
        if (("success" in calldata) && calldata.success) {

          const dateTime = currentTimeStamp();
          var payable_amount = parseFloat(total_minutes) * parseFloat(price_per_mint);
          const storedata = {
            user_id,
            assign_id: astrologer_id,
            subtotal: price_per_mint,
            price_per_mint,
            payable_amount: payable_amount,
            type: 2,
            booking_type: 2,
            user_name: userdata.name,
            user_gender: userdata.gender,
            user_dob: userdata.dob,
            user_phone: userdata.phone,
            user_tob: userdata.birth_time,
            user_pob: userdata.place_of_birth,
            member_id: 0,
            schedule_date: dateTime,
            schedule_time: currentTimeStamp('HH:mm:ss'),
            schedule_date_time: dateTime,
            start_time: dateTime,
            total_minutes: total_minutes,
            time_minutes: total_minutes,
            total_seconds: total_seconds,
            status: 1,
            is_confirmed: 1,
            astrologer_comission_perct: astrologerdata.share_percentage,

            created_at: dateTime,
            updated_at: dateTime,
            bridge_id: calldata.call_id
          }

          return await Booking.create(storedata)
            .then(rs => (successRes('call orignated successfully', rs)))
            .catch(err => (failedRes('call failed to originate, please try after some time', err)))


          // Boolean


        } else {
          return (failedRes('call failed to originate, please try after some time'))
        }

      }).catch(function (error) {
        return (failedRes('call failed to originate, please try after some time', error))

      });
    } else {
      return (failedRes('something went wrong!'))
    }
  }
}


const make_audio_call_astrologer = async (req, res) => {
  var { user_id, astrologer_id, price_per_mint } = req.body
  const data = await make_audio_call_astrologer_function(user_id, astrologer_id, price_per_mint);
  res.json(data);


}

const delay = ms => new Promise(resolve => setTimeout(resolve, ms))

const answer_by_agent = async (req, res) => {
  console.log('*********************************answer_by_agent********************************************************************',req.body);
  const { uuid, call_to_number, answer_agent_number, start_stamp, caller_id_number, call_timeout, call_id } = req.body;
  await delay(200);
  try {

    const astrologer_number = answer_agent_number.substring(answer_agent_number.length - 10);

    const astrologerd = await Astrologer.scope(['active']).findOne({
      where: {
        phone: astrologer_number
      }
    })

    const user_number = call_to_number.substring(call_to_number.length - 10);
    const checkbooking = await Booking.findOne({
      where: {
        // user_phone: user_number,
        // assign_id: astrologerd.id,
        bridge_id:call_id,
        status: {
          [Op.in]: [0, 1, 6]
        },
        type: {
          [Op.in]: [2]
        }
      }
    })
    if (checkbooking) {
      Booking.update({
        ivr_unique_id: uuid,
      },{
        where:{
          id:checkbooking.id
        }
      })
      const dataaa_ans = await for_audio_call(checkbooking.user_id);
      res.io.sockets.in(checkbooking.user_id).emit("audio_booking_request", dataaa_ans);
      accept_reject_book_notification(checkbooking.type, checkbooking.user_id, checkbooking.assign_id, checkbooking.id)

      return res.json(successRes(''))
    } else {
      // return failedRes('failed')
      const userdata = await User.findOne({
        where: {
          phone: user_number
        }
      })

      const astrologerdata = astrologerd;
      const astrologer_id = astrologerdata.id
      const price_per_mint = parseFloat(astrologerdata.price_per_mint_audio)
      var wallet = parseFloat(userdata.wallet);
      var total_minutes = Math.floor(wallet / price_per_mint);
      var total_seconds = total_minutes * 60;
      if (parseFloat(userdata.wallet) < price_per_mint) {
        return (failedRes('Please recharge your wallet to proceed'))
      }

      const dateTime = currentTimeStamp();
      var payable_amount = parseFloat(total_minutes) * parseFloat(price_per_mint);
      const storedata = {
        user_id:userdata.id,
        assign_id: astrologer_id,
        subtotal: price_per_mint,
        price_per_mint,
        payable_amount: payable_amount,
        type: 2,
        booking_type: 2,
        user_name: userdata.name,
        user_gender: userdata.gender,
        user_dob: userdata.dob,
        user_phone: userdata.phone,
        user_tob: userdata.birth_time,
        user_pob: userdata.place_of_birth,
        member_id: 0,
        schedule_date: dateTime,
        schedule_time: currentTimeStamp('HH:mm:ss'),
        schedule_date_time: dateTime,
        start_time: dateTime,
        total_minutes: total_minutes,
        time_minutes: total_minutes,
        total_seconds: total_seconds,
        status: 1,
        is_confirmed: 1,
        astrologer_comission_perct: astrologerdata.share_percentage,
        ivr_unique_id: uuid,
        created_at: dateTime,
        updated_at: dateTime,
        bridge_id: call_id
      }
      const rsss = await Booking.create(storedata)
        .then(async rs => {
          const dataaa_ans = await for_audio_call(userdata.id);
          res.io.sockets.in(userdata.id).emit("audio_booking_request", dataaa_ans);
          accept_reject_book_notification(rs.type, userdata.id, rs.assign_id, rs.id)

          return (successRes('call orignated successfully', rs))
        })
        .catch(err => (failedRes('call failed to originate, please try after some time', err)))


      return res.json(rsss)




    }
  } catch (error) {
    res.json(failedRes('failed to updated'))

  }


}
const call_pickup_customer = async (req, res) => {
  console.log('*********************************call_pickup_customer********************************************************************',req.body);

  await delay(200);

  const { uuid, call_to_number, answered_agent_number, start_stamp, caller_id_number, call_timeout } = req.body;
  try {

    const astrologer_number = answered_agent_number.substring(answered_agent_number.length - 10);

    const astrologerd = await Astrologer.scope(['active']).findOne({
      where: {
        phone: astrologer_number
      }
    })

    const user_number = call_to_number.substring(call_to_number.length - 10);
    const checkbooking = await Booking.findOne({
      where: {
        user_phone: user_number,
        assign_id: astrologerd.id,
        status: {
          [Op.in]: [0, 1, 6]
        },
        type: {
          [Op.in]: [2]
        }
      }
    })
    if (checkbooking) {
      await Booking.update({
        status: 6,
        start_time: start_stamp,
        schedule_date_time: start_stamp,
        ivr_unique_id: uuid
      }, {
        where: {
          id: checkbooking.id
        }
      })
        .then(async rs => {


          return res.json(successRes('updated'))
        })
        .catch(err => res.json(failedRes('faild to update')))

    }
    return;

  } catch (error) {
    res.json(failedRes('failed to updated'))

  }
}


const call_missed = async (req, res) => {

  const { uuid, call_to_number, caller_id_number, start_stamp, answer_stamp, end_stamp, hangup_cause, billsec, duration, answered_agent, missed_agent,
    recording_url, call_id, outbound_sec, agent_ring_time
  } = req.body;
  await delay(1000);

  const checkbooking = await Booking.findOne({
    where: {
      status: {
        [Op.in]: [0, 1, 6]
      },
      type: 2,
      bridge_id: call_id,
    }
  })

  if (checkbooking) {
    await Booking.update({
      schedule_date_time: start_stamp,
      start_time: start_stamp,
      end_time: end_stamp,
      ended_by: 'astrologer',
      status: 3,
      // total_minutes:0,
      // total_seconds:0,
      hangup_cause,
      ivr_unique_id: uuid
    }, {
      where: {
        id: checkbooking.id
      }
    })
      .then(async rs => {
        const dataaa = await for_audio_call(checkbooking.user_id);
        res.io.sockets.in(checkbooking.user_id).emit("audio_booking_request", dataaa);


        return res.json(successRes('success'))
      })
      .catch(err => res.json(failedRes('error', err)))
  } else {
    res.json(failedRes('error'))
  }
}


const call_hangup = async (req, res) => {
  console.log('*********************************call_hangup********************************************************************',req.body);

  const { uuid, call_to_number, caller_id_number, start_stamp, answer_stamp, end_stamp, hangup_cause, billsec, digits_dialed, duration,
    recording_url, call_status, call_id, outbound_sec, agent_ring_time, call_timeout, get_call_id
  } = req.body;
  await delay(200);


  const checkbooking = await Booking.findOne({
    where: {
      status: {
        [Op.in]: [0, 1, 6]
      },
      type: 2,
      bridge_id: call_id,
    }
  })
  const booking = checkbooking
  const dateTime = currentTimeStamp();
  var total_minutes = 0;
  var total_seconds = 0;

  if (checkbooking) {
    const user_id = checkbooking.user_id
    const booking_id = checkbooking.id;
    if (call_status == 'answered') {
      total_seconds = outbound_sec;
      total_minutes = Math.ceil(parseFloat(outbound_sec) / 60);
      const userdata = await User.findOne({
        where: {
          id: checkbooking.user_id
        }
      })

      var wallet = parseFloat(userdata.wallet);
      var payable_amount = parseFloat(total_minutes) * parseFloat(checkbooking.price_per_mint);



      const b_type = checkbooking.type;
      var booking_type = "";
      if (b_type == 1) {
        booking_type = 'Video Call Booking';
      } else if (b_type == 2) {
        booking_type = 'Audio Call Booking'
      } else if (b_type == 3) {
        booking_type = 'Chat Booking'
      } else if (b_type == 4) {
        booking_type = 'Report Booking'
      } else if (b_type == 5) {
        booking_type = 'Broadcast Booking'
      }

      var old_wallet = parseFloat(wallet);
      var txn_amount = parseFloat(payable_amount);
      var new_wallet = old_wallet - txn_amount;
      if (new_wallet < 0) {
        txn_amount = old_wallet
        new_wallet = 0;
      }
      var txn_type = 'debit';
      const txn_id = moment().utc() + user_id + booking.id;

      var transactiondata = {
        user_id: user_id,
        payment_mode: 'wallet',
        txn_name: 'Astrologer ' + booking_type,
        booking_id: booking.id,
        booking_txn_id: txn_id,
        txn_for: 'booking',
        type: txn_type,
        old_wallet: old_wallet,
        txn_amount: txn_amount,
        update_wallet: new_wallet,
        status: 1,
        created_at: dateTime,
        updated_at: dateTime,

      };
      var commision = 0;
      const gst_perct = 3.26;
      const tds_perct = 10;
      var total_astro_comission = 0;
      var tds_amount = 0;
      var gst_amount = 0;

      const share_percentage = parseFloat(booking.astrologer_comission_perct);
      if (share_percentage) {
        commision = ((parseFloat(payable_amount)) * (share_percentage / 100));
        total_astro_comission = commision;
        tds_amount = total_astro_comission * (tds_perct / 100);
        gst_amount = total_astro_comission * (gst_perct / 100);
        //commision -= tds_amount;
        commision -= gst_amount;
        if (commision < 0) {
          commision = 0
        }
      }


      const t = await sequelize.transaction();
      try {


        await Booking.update({
          schedule_date_time: start_stamp,
          start_time: answer_stamp,
          payable_amount,
          end_time: end_stamp,
          ended_by: 'customer',
          txn_id,
          status: 2,
          is_paid: 1,
          ivr_recording: recording_url,
          total_minutes,
          time_minutes: total_minutes,
          total_seconds,
          hangup_cause,
          ivr_unique_id: uuid,

          gst_astro: gst_amount,
          tds_astro: tds_amount,
          total_astro_comission: total_astro_comission,
          astrologer_comission_amount: commision
        }, {
          where: {
            id: checkbooking.id
          }
        }, { transaction: t })

        await User.update({
          wallet: new_wallet
        }, {
          where: {
            id: checkbooking.user_id
          }
        }, { transaction: t })
        const dt = await Transaction.create(transactiondata
          , { transaction: t });
        await t.commit();
        res.io.sockets.in(checkbooking.user_id).emit("audio_booking_request", {
          status: false,
          message: 'failed'
        })

        send_booking_complete_notification(b_type, user_id, booking.assign_id, booking.id, txn_amount);
        // await set_astrologer_comission_to_order(booking.id)

        // const dataaa_ans = await for_audio_call(checkbooking.user_id);
        //   res.io.sockets.in(checkbooking.user_id).emit("audio_booking_request", dataaa_ans);

        return res.json(successRes('done!!', booking))

      } catch (error) {
        // If the execution reaches this line, an error was thrown.
        // We rollback the transaction.
        await t.rollback();
        return res.json(failedRes('failed!!'));
      }
      //  set_astrologer_comission_to_order(booking.id)


    } else {

      await Booking.update({
        schedule_date_time: start_stamp,
        start_time: answer_stamp,
        end_time: end_stamp,
        ended_by: 'customer',
        status: 3,
        // total_minutes:0,
        // total_seconds:0,
        hangup_cause,
        ivr_unique_id: uuid
      }, {
        where: {
          id: checkbooking.id
        }
      })
        .then(async rs => {

          const dataaa_hg = await for_audio_call(checkbooking.user_id);
          res.io.sockets.in(checkbooking.user_id).emit("audio_booking_request", dataaa_hg);

          const bkgdata = await booking_status_function(checkbooking.user_id);
          res.io.sockets.in(checkbooking.user_id).emit("get_booking_status", bkgdata);

          res.io.sockets
          .in(checkbooking.user_id)
          .emit("give_review", { status: true, user_id: checkbooking.user_id });
  

          return res.json(successRes('success'))

        })
        .catch(err => res.json(failedRes('error', err)))
      return
    }


  }
}

const cancel_call_audio = async (booking_id) => {

  const bookingdata = await Booking.findOne({
    where: {
      id: booking_id
    }
  })
  if (bookingdata) {
    const token = await get_tatatele_token();


    const options = {
      method: 'POST',
      url: 'https://api-smartflo.tatateleservices.com/v1/call/hangup',
      headers: { Accept: 'application/json', 'Content-Type': 'application/json', Authorization: token },
      data: {
        call_id: bookingdata.bridge_id
      }
    };

    const data = await axios.request(options).then(function (response) {
      const calldata = response.data;
      if (("success" in calldata) && calldata.success) {
        return successRes('success')
      } else {
        return failedRes('failed')
      }
    })
      .catch(err => failedRes('failed'))

    return data;

  } else {
    return failedRes('failed')
  }

}
module.exports = {
  get_tatatele_token,
  make_audio_call_astrologer,
  call_pickup_customer,
  call_missed,
  call_hangup,
  make_audio_call_astrologer_function,
  cancel_call_audio,
  answer_by_agent
}

// var time = moment('09:34:00',format),
//   beforeTime = moment('08:34:00', format),
//   afterTime = moment('10:34:00', format);

// if (time.isBetween(beforeTime, afterTime)) {
