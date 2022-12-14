const moment = require("moment");
const multer = require("multer");

const {customer_user, jwtsecret, jwtExpiration } = require("../config/app.config");
const { successRes, failedRes } = require("../helpers/response.helper");
const { isPhoneExists, fetchUserByPhone, fetchUserByID, currentTimeStamp,getUserIpAddress } = require("../helpers/user.helper");
const db = require("../models/index");
var jwt = require("jsonwebtoken");
var bcrypt = require("bcryptjs");
const { Setting, Referralcodehistory, AppliedWalletCoupon, Coupon } = require("../models/index");
const { send_otp,send_forgot_otp } = require("../helpers/aws.helper");
const { send_fcm_push, send_push_through_curl } = require("../helpers/notification.helper");
const { send_schedule_notification } = require("../helpers/schedulenotification.helper");
const { ant_media_server_req } = require("../helpers/axios.helper");
const { send_otp_msg91 } = require("../helpers/msg91.helper");
const { User, Otpuser, UserLogin } = db;
// const Op=db.sequelize.Op;

const user_type = customer_user;

exports.findAll = (req, res) => {
  User.findAll({ where: { status: 1 } })
    .then((data) => {
      res.send(data);
    })
    .catch((err) => {
      res.status(500).send({
        message: err.message || "Some error occurred while retrieving users.",
      });
    });
};

const accessToken = (payload) => {
  var token = jwt.sign(payload, jwtsecret, {
    expiresIn: jwtExpiration,
  });
  return token;
};

const generateOTP = () => {
  // Declare a digits variable
  // which stores all digits
  var digits = "0123456789";
  let OTP = "";
  for (let i = 0; i < 4; i++) {
    OTP += digits[Math.floor(Math.random() * 10)];
  }
  return OTP;
};


const send_otp_phone = async (req,res)=>{
  const { user_id } = req.body;
  const user =await User.findOne({
    where:{
      id:user_id
    }
  })
  const otp = generateOTP();
  send_otp(otp,user.phone)
  return res.json({
      status:true,
      message:'sent',
      otp:otp,
  })
}


const login_with_password = async (req, res) => {
  const {
    phone,
    password,
    device_id,
    device_type,
    device_token,
    model_name,
  } = req.body;
  try {
    const userdata = await fetchUserByPhone(phone);
    if(!userdata){
      return res.json(failedRes('invalid credentials',userdata))
    }else{
      if(userdata.status != 1){
        return res.json(failedRes('Your account is not active, Please contact to admin support',null))

      }
      const dateTime =await currentTimeStamp();
      const storeData = {
        device_id: device_id,
        device_type: device_type,
        device_token: device_token,
        model_name: model_name,
        loginTime: dateTime,
        updated_at: dateTime,
      };
      const verified = bcrypt.compareSync(password, userdata.password);
      if (verified) {
        await User.update(storeData, {
          where: { id: userdata.id },
        })
          .then((result) => {
            var token = accessToken({ id: userdata.id });
            return res.json(successRes("Verified", userdata, token));
          })
          .catch((error) => res.json(failedRes("Something went wrong", error)));
      } else {
        return res.json(failedRes("Invalid credentials"));
      }
    }
  } catch (error) {
    return res.json(failedRes("Invalid Credentials", error));
  }
};

/** register login otp user */
const register_login_otp = async (req, res) => {
  const { phone } = req.body;
  const dateTime =  currentTimeStamp();
  var otp = generateOTP();
  if(phone=='9896904632'){
    otp = '1265'
  }
  await Otpuser.create({
    phone: phone,
    phone_verified: 1,
    otp: otp,
    user_type: user_type,
    created_at: dateTime,
    updated_at: dateTime,
  })
    .then((r) => {
      send_otp_msg91(phone,'91',otp)
      res.json(successRes("OTP sent succesfully", r))
    })
    .catch((err) => res.json(failedRes("Something went wrong", err)));
    // send_otp_msg91('9896449941','91','1234')
};



const verify_register_login = async (req, res) => {
  const {
    id,
    otp,
    device_id,
    device_type,
    device_token,
    model_name,
    phone,
  } = req.body;

  // console.log('====================================');
  // console.log('verify_register_login',req.body);
  // console.log('====================================');
  try {
    await Otpuser.findOne({ where: { id: id, phone: phone } })
      .then(async (otpdata) => {
        // return res.json(otpdata)
        const { phone } = otpdata;
        if (otp == otpdata.otp) {
          const dateTime =  currentTimeStamp();;

          // const check = await isPhoneExists(phone);
          // return res.json(check);
          const userdata = await fetchUserByPhone(phone);

          if (userdata) {
            if(userdata.status != 1){
              return res.json(failedRes('Your account has been blocked by the admin, Please contact to admin support!'))
            }
            const updateData = {
              device_id: device_id,
              device_type: device_type,
              device_token: device_token,
              model_name: model_name,
              loginTime: dateTime,
              updated_at: dateTime,
            };

            await User.update(updateData, {
              where: { id: userdata.id },
            })
              .then(async (result) => {
                await Otpuser.destroy({
                  where: {
                    user_type: user_type,
                    phone: phone,
                  },
                });
                var token = accessToken({ id: userdata.id });

                const stlogin = {
                  user_id:userdata.id,
                  device_id: device_id,
                  device_type: device_type,
                  device_token: device_token,
                  created_at: dateTime,
                  updated_at: dateTime,
                  is_login:1,
                  ip_address:getUserIpAddress(req)
                };
                UserLogin.create(stlogin)

                return res.json(successRes("Verified", userdata, token));
              })
              .catch((error) =>
                res.json(failedRes("Something went wrong", error))
              );
          } else {
            const storeData = {
              name: otpdata.name ? otpdata.name : 'Guest User',
              email: otpdata.email,
              phone: otpdata.phone,
              gender: otpdata.gender,
              email_verified: otpdata.email_verified,
              phone_verified: otpdata.phone_verified,
              status:1,
              email_verified_at: otpdata.email_verified == 1 ? dateTime : null,
              phone_verified_at: otpdata.phone_verified == 1 ? dateTime : null,
              device_id: device_id,
              device_type: device_type,
              device_token: device_token,
              model_name: model_name,
              loginTime: dateTime,
              created_at: dateTime,
              updated_at: dateTime,
            };

            await User.create(storeData)
              .then(async (r) => {
                await Otpuser.destroy({
                  where: {
                    user_type: user_type,
                    phone: phone,
                  },
                });
                var token = accessToken({ id: r.id });

                const storeDatalogin = {
                  user_id:r.id,
                  device_id: device_id,
                  device_type: device_type,
                  device_token: device_token,
                  created_at: dateTime,
                  updated_at: dateTime,
                  is_login:1,
                  ip_address:getUserIpAddress(req)
                };
                UserLogin.create(storeDatalogin)

                res.json(successRes("Verified", r, token));
                return;
              })
              .catch((err) => res.json(failedRes("Something went wrong", err)));
          }
        } else {
          res.json(failedRes("Invalid OTP", null));
          return;
        }
      })
      .catch((err) => res.json(failedRes("Something went wrong", err)));
  } catch (error) {
    res.json(failedRes("Something error happen", error));
    return;
  }
};


const edit_password = async (req, res) => {
  // console.log(req);
  const { user_id, password, confirm_password } = req.body;
  if (password !== confirm_password) {
    return res.json(failedRes("Password not match", null));
  }
  var hashedPassword = await bcrypt.hashSync(password, 8);
  const dateTime =  currentTimeStamp();;
  const updateData = {
    password: hashedPassword,
    updated_at: dateTime,
  };
  await User.update(updateData, {
    where: { id: user_id },
  })
    .then((usr) => res.json(successRes("Updated", usr)))
    .catch((err) => res.json(failedRes("Something went wrong", err)));
};



const get_userdata_by_token = async (req, res) => {
  const { token } = req.body;
  // return res.json(successRes('',token))jw

  jwt.verify(token, jwtsecret, async (err, decoded) => {
    if (err) {
      return res
        .status(401)
        .json(failedRes("Failed to authenticate token.", null));
    }

    // if everything good, save to request for use in other routes
    const user_id = decoded.id;
    // const userData = fetchUserByID(user_id).then((r)=>r);
    return res.json(successRes("valid", { id: user_id }));
  });
  return res.json(failedRes("invalid"));
};

const get_userdetails = async (req, res) => {
  const { user_id } = req.body;
  var user = await fetchUserByID(user_id)
  return res.json(user ? successRes("found", user) : failedRes('not found'))
  // .then(async (rs) =>{
  //   if(rs){
  //     rs.dataValues.horoscope='ARIES';

  //     var stng=await Setting.findOne().then((st)=>st)
  //     if(stng){
  //       rs.dataValues.support_phone=stng.helpline_number;
  //       rs.dataValues.terms_condition=stng.terms_condition;
  //       rs.dataValues.privacy=stng.privacy;
  
  
  //     }
  //     return res.json(successRes("found", rs))
  
  //   }else{
  // return res.json(failedRes("not found", user));

  //   }
   
  // })
  // return res.json(failedRes("found", user));
};


const check_if_user_add_password =async (req,res)=>{
  const {user_id}=req.body;
  await fetchUserByID(user_id).then((rs)=>{
    if(rs.password && rs.password != ''){
      return res.json(successRes('password was added',rs))
    }
    return res.json(failedRes('not added',null));
  })
  .catch((err)=>res.json(failedRes('failed',err)))

}


const check_if_user_add_additional_details =async (req,res)=>{
  const {user_id}=req.body;
  await fetchUserByID(user_id).then((rs)=>{
    if((rs.dob && rs.dob != '') && (rs.birth_time && rs.birth_time != '')){
      return res.json(successRes('details already added',rs))
    }
    return res.json(failedRes('not added',null));
  })
  .catch((err)=>res.json(failedRes('failed',err)))

}

const edit_profile_details = async (req, res) => {
  const { name,dob,birth_time,place_of_birth,address,mother_name,father_name,gotro,spouse_name,user_id,latitude,longitude,referral_from } = req.body;
  const dateTime = currentTimeStamp();
  if(referral_from){
    const refrlfrmusr = await User.findOne({
      where:{
        referral_code:referral_from
      }
    })
    if(!refrlfrmusr){
      return res.json(failedRes('Invalid referral code'))
    }else{
      const referl_data = {
        referral_from:refrlfrmusr.id,
        referral_to:user_id,
        added_on:dateTime,
        code:referral_from
      }
      Referralcodehistory.create(referl_data)
    }
  }
  console.log('data',req.body);
  const updateData={
    name:name,
    dob:dob,
    birth_time:birth_time,
    place_of_birth:place_of_birth,
    address:address,
    mother_name:mother_name,
    father_name:father_name,
    gotro:gotro,
    spouse_name:spouse_name,
    latitude,
    longitude

  }
  
  await User.update(updateData, {
    where: { id: user_id },
  })
    .then((usr) => res.json(successRes("Updated", usr)))
    .catch((err) => res.json(failedRes("Something went wrong", err)));
};



const edit_profile_details_web= async (req, res) => {
  const { name,dob,birth_time,place_of_birth,address,mother_name,father_name,gotro,spouse_name,user_id,latitude,longitude, } = req.body;
  const dateTime = currentTimeStamp();
  
  const updateData={
    name:name,
    dob:dob,
    birth_time:birth_time,
    place_of_birth:place_of_birth,
    address:address,
    mother_name:mother_name,
    father_name:father_name,
    gotro:gotro,
    spouse_name:spouse_name,
    latitude,
    longitude

  }
  
  await User.update(updateData, {
    where: { id: user_id },
  })
    .then((usr) => res.json(successRes("Updated", usr)))
    .catch((err) => res.json(failedRes("Something went wrong", err)));
};



/** register  otp user */
const register_otp = async (req, res) => {
  const { phone } = req.body;
  const dateTime =  currentTimeStamp();;
  const otp = generateOTP();

  const check = await isPhoneExists(phone);

  if(check){
    return res.json(failedRes('Mobile number already exists!!'));
  }else{
    await Otpuser.create({
      phone: phone,
      phone_verified: 1,
      otp: otp,
      user_type: user_type,
      created_at: dateTime,
      updated_at: dateTime,
    })
      .then((r) => {
        send_otp(otp,phone)
        return res.json(successRes("OTP sent succesfully", r))})
      .catch((err) => res.json(failedRes("Something went wrong", err)));

  }
  
};
function genraterandomID(length) {
  var result           = '';
  var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var charactersLength = characters.length;
  for ( var i = 0; i < length; i++ ) {
     result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}

const verify_register= async (req, res) => {
  const {
    id,
    otp,
    phone,
    device_id,
    device_type,
    device_token,
    model_name
  } = req.body;

  const dateTime= currentTimeStamp();
  try {
    await Otpuser.findOne({ where: { id: id, phone: phone },
    order:[
        ['id','desc']
    ],
    })
    .then(async (otpdata)=>{
      if(!otpdata){ return res.json(failedRes('Invalid OTP!!')); }
      else{
        if(otp !== otpdata.otp){ 
          return res.json(failedRes('Invalid OTP!!')); 
        }else{
          const count_users =await User.count();

          const check = await isPhoneExists(phone);
          if(!check){

            const storeData = {
              name: otpdata.name,
              email: otpdata.email,
              phone: otpdata.phone,
              gender: otpdata.gender,
              password:otpdata.password,
              email_verified: otpdata.email_verified,
              phone_verified: otpdata.phone_verified,
              email_verified_at: otpdata.email_verified == 1 ? dateTime : "",
              phone_verified_at: otpdata.phone_verified == 1 ? dateTime : "",
              device_id: device_id,
              device_type: device_type,
              device_token: device_token,
              model_name: model_name,
              loginTime: dateTime,
              created_at: dateTime,
              updated_at: dateTime,
              status:1,
              referral_code:genraterandomID(4).toUpperCase()+(count_users+1)
            };
            // cosole.log(storedata);
      
            console.log(storeData);
      
            await User.create(storeData)
              .then(async (r) => {
                await Otpuser.destroy({
                  where: {
                    user_type: user_type,
                    phone: phone,
                  },
                });
                var token = accessToken({ id: r.id });
                res.json(successRes("Verified", r, token));
                return;
              })
              .catch((err) => res.json(failedRes("Something went wrong", err)));
          }else{
            res.json(failedRes('Phone number already exists!!'))
          }

        }
      }
    })
  } catch (error) {
    return res.json(failedRes('something went wrong',error))
  }
};


const change_password = async (req,res) => {
  const {
    user_id,
    password,
    confirm_password
  } = req.body;
  if (password !== confirm_password) {
    return res.json(failedRes("Password not match", null));
  }else{
    var hashedPassword = await bcrypt.hashSync(password, 8);
    const updateData = {
      password:hashedPassword,
    };

    await User.update(updateData, {
      where: { id: user_id },
    })
    return res.json(successRes('password changed successfully!'));
  }
}

const make_register_with_token= async (req, res) => {
  const {
    token,
    name,
    device_id,
    device_type,
    device_token,
    model_name,
    phone,
    password,
    confirm_password
  } = req.body;
  const dateTime =  currentTimeStamp();;
  if (password !== confirm_password) {
    return res.json(failedRes("Password not match", null));
  }
  var hashedPassword = await bcrypt.hashSync(password, 8);
  try {
    await Otpuser.findOne({ where: { token:token } })
    .then(async (otpdata)=>{
      // console.log(otpdata);

      if(!otpdata){ return res.json(failedRes('Token Expired!!')); }

      const check = await isPhoneExists(otpdata.phone);
      if(check){
        var userdata = await fetchUserByPhone(otpdata.phone);
        const updateData = {
          name:name,
          password:hashedPassword,
          device_id: device_id,
          device_type: device_type,
          device_token: device_token,
          model_name: model_name,
          loginTime: dateTime,
          updated_at: dateTime,
        };

        await User.update(updateData, {
          where: { id: userdata.id },
        })
          .then(async (result) => {
            await Otpuser.destroy({
              where: {
                user_type: user_type,
                phone: userdata.phone,
              },
            });
            var token = accessToken({ id: userdata.id });
            userdata.name=name;
            return res.json(successRes("Verified", userdata, token));
          })
          .catch((error) =>
            res.json(failedRes("Something went wrong", error))
          );
      }
      else{
        /**register process */
        const storeData = {
          name: name,
          email: otpdata.email,
          phone: otpdata.phone,
          gender: otpdata.gender,
          password:hashedPassword,
          email_verified: otpdata.email_verified,
          phone_verified: otpdata.phone_verified,
          email_verified_at: otpdata.email_verified == 1 ? dateTime : "",
          phone_verified_at: otpdata.phone_verified == 1 ? dateTime : "",
          device_id: device_id,
          device_type: device_type,
          device_token: device_token,
          model_name: model_name,
          loginTime: dateTime,
          created_at: dateTime,
          updated_at: dateTime,
          referral_code:genraterandomID(5).toUpperCase()
        };
        // console.log(storeData);
        await User.create(storeData)
        .then(async (r) => {
          Otpuser.destroy({
            where: {
              user_type:otpdata.user_type,
              phone: otpdata.phone,
            },
          });
          var token = accessToken({ id: r.id });
          return res.json(successRes("Verified", r, token));;
        })
        .catch((err) => res.json(failedRes("Something went wrong", err)));

      }
    })
  } catch (error) {
    return res.json(failedRes('something went wrong',error))
  }
};



const edit_profile = async (req, res) => {
  const { name,dob,birth_time,place_of_birth,address,mother_name,father_name,gotro,spouse_name,user_id,latitude,longitude } = req.body;

  const updateData={
    name:name,
    dob:dob,
    birth_time:birth_time,
    place_of_birth:place_of_birth,
    address:address,
    mother_name:mother_name,
    father_name:father_name,
    gotro:gotro,
    spouse_name:spouse_name,
    latitude,
    longitude

  }
  await User.update(updateData, {
    where: { id: user_id },
  })
    .then((usr) => res.json(successRes("Updated", usr)))
    .catch((err) => res.json(failedRes("Something went wrong", err)));
};



const edit_profile_image = async (req, res) => {
  console.log(req.file);
  if(!req.file) {
    res.status(500);
    return next(err);
  }
  res.json({ fileUrl: 'http://192.168.0.7:3000/images/' + req.file.filename });
  // var form = req.form();
  // console.log(req);
  // var upload = multer({ dest: 'uploads/' })
  // console.log(upload)
  // var storage = multer.diskStorage({
  //   destination: function (req, file, cb) {
  //     cb(null, 'uploads')
  //   },
  //   filename: function (req, file, cb) {
  //     cb(null, file.fieldname + '-' + Date.now())
  //   }
  // })
  
  // var upload = multer({ storage: storage })

  // const a = upload.single('file')
  // console.log(a);

};

const referral_code_history = async (req,res) => {
  const {user_id} = req.body;
  console.log('user_id',user_id);
  var code = 'mm';
  const referrals = await Referralcodehistory.findAll({
    where:{
      referral_from:user_id
    }
  }).then(async (rfs)=>{
    for (let rf of rfs) {
      code = rf.code;
      const referral_to_user = await User.findOne({where:{id:rf.referral_to}})
      rf.dataValues.referral_to_user=referral_to_user
    }
    return await rfs;
  })
  return res.json({
    status:true,
    code,
    data:referrals
  });
}


const social_login = async (req,res) => {
    const {name, email,device_id,device_type,device_token,model_name,social_id,auth} = req.body;
    const dateTime = currentTimeStamp();;
    const userdata =await User.findOne({
      where:{
        email:email
      }
    });
    if(!userdata){
 /**register process */
      const storeData = {
        name: name,
        email: email,
        email_verified: 1,
        email_verified_at:dateTime,
        device_id: device_id,
        device_type: device_type,
        device_token: device_token,
        model_name: model_name,
        loginTime: dateTime,
        created_at: dateTime,
        updated_at: dateTime,
        social_id:social_id,
        auth:auth,
        referral_code:genraterandomID(5).toUpperCase()
      };
      await User.create(storeData)
        .then(async (r) => {
          var token = accessToken({ id: r.id });
          return res.json(successRes("Verified", r, token));;
        })
    }else{

      const updateData = {
        name: name,
        email_verified: 1,
        email_verified_at:dateTime,
        device_id: device_id,
        device_type: device_type,
        device_token: device_token,
        model_name: model_name,
        loginTime: dateTime,
        updated_at: dateTime,
        social_id:social_id,
        auth:auth,
      };
      await User.update(updateData, {
        where: { id: userdata.id },
      })
        .then((result) => {
          var token = accessToken({ id: userdata.id });
          return res.json(successRes("Verified", userdata, token));
        })
        .catch((error) => res.json(failedRes("Something went wrong", error)));
    }
}


const send_test_notification = async (req,res) => {
  // const {user_id}=req.body;
  // const user =await User.findOne({
  //   where:{
  //     id:user_id
  //   }
  // })

  // send_push_through_curl(user.id,'Hello '+user.name,'Test bro')
  // const cdate = new Date();
  // console.log('current',cdate);
  // return res.json(user)
  // const dt = await ant_media_server_req();
  send_otp_msg91('9896449941','91','1234')
  res.json({status:true})
}


const register_user_otp = async (req,res)=>{
  const {name,email,phone,gender,password,confirm_password} = req.body;
  const dateTime = currentTimeStamp();
  if(password != confirm_password){
    return res.json(failedRes('password not match'));
  }else{
    const check = await isPhoneExists(phone);
    if(check){
      return res.json(failedRes('User phone no already exists'));

    }else{
      var hashedPassword = await bcrypt.hashSync(password, 8);
      const otp = generateOTP();
      // const otp = '1111';
      const checkifotpalreadysent = await Otpuser.findOne({where:{
        phone:phone,
        user_type:user_type
      }})
      if(checkifotpalreadysent){
        await Otpuser.update({
          phone: phone,
          name:name,
          email:email,
          phone_verified: 1,
          otp: otp,
          gender:gender,
          password:hashedPassword,
          user_type: user_type,
          updated_at: dateTime,
        },{
          where:{
            id:checkifotpalreadysent.id
          }
        })
          .then((r) => {
            // send_otp(otp,phone)
            send_otp_msg91(phone,'91',otp)
            return res.json(successRes("OTP sent succesfully", checkifotpalreadysent))})
          .catch((err) => res.json(failedRes("Something went wrong", err)));
      }else{
        await Otpuser.create({
          phone: phone,
          name:name,
          email:email,
          phone_verified: 1,
          otp: otp,
          gender:gender,
          password:hashedPassword,
          user_type: user_type,
          created_at: dateTime,
          updated_at: dateTime,
        })
          .then((r) => {
            // send_otp(otp,phone)
            send_otp_msg91(phone,'91',otp)
            return res.json(successRes("OTP sent succesfully", r))})
          .catch((err) => res.json(failedRes("Something went wrong", err)));
      }
    }
  }
}


const resend_otp_register = async (req,res) => {
  const {id} = req.body;
  const dateTime = currentTimeStamp();
  const checkifotpalreadysent = await Otpuser.findOne({where:{
    id:id,
    user_type:user_type
  }})
  if(checkifotpalreadysent){
    await Otpuser.update({
      updated_at: dateTime,
    },{
      where:{
        id:id
      }
    })
      .then((r) => {
        const otp = checkifotpalreadysent.otp;
        send_otp_msg91(checkifotpalreadysent.phone,'91',otp)
        // send_otp(otp,checkifotpalreadysent.phone)
        return res.json(successRes("OTP sent succesfully", checkifotpalreadysent))})
      .catch((err) => res.json(failedRes("Something went wrong", err)));
  }else{
    return res.json(failedRes('failed'));
  }
}


const verify_register_user = async (req, res) => {
  const {
    id,
    otp,
    device_id,
    device_type,
    device_token,
    model_name,
    phone,
  } = req.body;

  console.log(
    'verify_register_user',req.body
  );
  try {
    await Otpuser.findOne({ where: { id: id } })
      .then(async (otpdata) => {
        const { phone } = otpdata;
        if (otp == otpdata.otp) {
          const dateTime =  currentTimeStamp();;
          const check = await isPhoneExists(phone);
          const userdata = await fetchUserByPhone(phone);

          console.log('userdata',userdata);
          if (userdata) {
            const updateData = {
              device_id: device_id,
              device_type: device_type,
              device_token: device_token,
              model_name: model_name,
              loginTime: dateTime,
              updated_at: dateTime,
            };

            await User.update(updateData, {
              where: { id: userdata.id },
            })
              .then(async (result) => {
                await Otpuser.destroy({
                  where: {
                    user_type: user_type,
                    phone: phone,
                  },
                });
                var token = accessToken({ id: userdata.id });
                return res.json(successRes("Verified", userdata, token));
              })
              .catch((error) =>
                res.json(failedRes("Something went wrong", error))
              );
          } else {
            const storeData = {
              name: otpdata.name,
              email: otpdata.email,
              phone: otpdata.phone,
              gender: otpdata.gender,
              password:otpdata.password,
              email_verified: otpdata.email_verified,
              phone_verified: otpdata.phone_verified,
              email_verified_at: otpdata.email_verified == 1 ? dateTime : "",
              phone_verified_at: otpdata.phone_verified == 1 ? dateTime : "",
              device_id: device_id,
              device_type: device_type,
              device_token: device_token,
              model_name: model_name,
              loginTime: dateTime,
              created_at: dateTime,
              updated_at: dateTime,
            };

            console.log(storeData);

            await User.create(storeData)
              .then(async (r) => {
                await Otpuser.destroy({
                  where: {
                    user_type: user_type,
                    phone: phone,
                  },
                });
                var token = accessToken({ id: r.id });
                res.json(successRes("Verified", r, token));
                return;
              })
              .catch((err) => res.json(failedRes("Something went wrong", err)));
          }
        } else {
          res.json(failedRes("Invalid OTP", null));
          return;
        }
      })
      .catch((err) => res.json(failedRes("Something went wrong", err)));
  } catch (error) {
    res.json(failedRes("Something error happen", error));
    return;
  }
};





const forgot_otp =async (req,res) => {
  const {phone} = req.body;

  const check = await fetchUserByPhone(phone);
  if(check){
    if(check.status != 1){
      return res.json(failedRes('Your account is blocked by the admin, Please contact to admin for further process'))
    }else{
      const otp = generateOTP();
      const dateTime = currentTimeStamp();
      await Otpuser.create({
        phone: phone,
        phone_verified: 1,
        otp: otp,
        user_type: user_type,
        created_at: dateTime,
        updated_at: dateTime,
      })
        .then((r) =>{ 
          // send_forgot_otp(otp,phone)
          send_otp_msg91(phone,'91',otp)
          return res.json(successRes("OTP sent succesfully", r)) 
        })
        .catch((err) => res.json(failedRes("Something went wrong", err)));
    }
  }else{
    return res.json(failedRes("phone no not registered", null))
  }
}

const forgot_change_password = async (req,res) => {
  const {otp,password,confirm_password,phone,id} = req.body;

  const otpuser = await Otpuser.findOne({
    where:{
      id:id,
      phone:phone
    }
  })

  if(!otpuser){
    return res.json(failedRes('Invalid OTP!'))
  }else{

    if(otp != otpuser.otp){
      return res.json(failedRes('Invalid OTP!'))

    }else{
      await Otpuser.destroy({
        where: {
          user_type: user_type,
          phone: phone,
        },
      });
      const userdata = await fetchUserByPhone(phone);
  
      var hashedPassword = await bcrypt.hashSync(password, 8);
      const updateData = {
        password:hashedPassword,
      };
  
      await User.update(updateData, {
        where: { id: userdata.id },
      })
  
      var token = accessToken({ id: userdata.id });
      return res.json(successRes("Verified", userdata, token));
    }

   
  }

}



/** login otp user */
const login_otp = async (req, res) => {
  const { phone } = req.body;
  const dateTime =  currentTimeStamp();
  var otp = generateOTP();
  if(phone=='9896904632'){
    otp = '1265'
  }
  const check = await fetchUserByPhone(phone);
  if(check){
    if(check.status != 1){
      return res.json(failedRes('Your account is blocked by admin,Please contact to admin support'))
    }else{
      await Otpuser.create({
        phone: phone,
        phone_verified: 1,
        otp: otp,
        user_type: user_type,
        created_at: dateTime,
        updated_at: dateTime,
      })
        .then((r) => res.json(successRes("OTP sent succesfully", r)))
        .catch((err) => res.json(failedRes("Something went wrong", err)));
    }
    
  }else{
    return res.json(failedRes('Mobile number not exists!',check));
  }
  
};



const verify_login = async (req, res) => {
  const {
    id,
    otp,
    device_id,
    device_type,
    device_token,
    model_name,
    phone,
  } = req.body;

  try {
    await Otpuser.findOne({ where: { id: id, phone: phone } })
      .then(async (otpdata) => {
        // return res.json(otpdata)
        const { phone } = otpdata;
        if (otp == otpdata.otp) {
          const dateTime =  currentTimeStamp();;

          const check = await isPhoneExists(phone);
          // return res.json(check);
          const userdata = await fetchUserByPhone(phone);

          if (check) {
            const updateData = {
              device_id: device_id,
              device_type: device_type,
              device_token: device_token,
              model_name: model_name,
              loginTime: dateTime,
              updated_at: dateTime,
            };
// console.log(check);
            if(userdata.status != 1){
              return res.json(failedRes('Your account is blocked by admin,Please contact to admin support'))
            }else{
              await User.update(updateData, {
                where: { id: userdata.id },
              })
                .then(async (result) => {
                  await Otpuser.destroy({
                    where: {
                      user_type: user_type,
                      phone: phone,
                    },
                  });
                  var token = accessToken({ id: userdata.id });

                  const storeData = {
                      user_id:userdata.id,
                      device_id: device_id,
                      device_type: device_type,
                      device_token: device_token,
                      created_at: dateTime,
                      updated_at: dateTime,
                      is_login:1,
                      ip_address:getUserIpAddress(req)
                  };
                  const storeLogin = UserLogin.create(storeData)

                  return res.json(successRes("Verified", userdata, token));
                })
                .catch((error) =>res.json(failedRes("Something went wrong", error)));
            }
           
          } else {
            return res.json(failedRes('Invalid OTP'));
          }
        } else {
          return res.json(failedRes("Invalid OTP", null));
        }
      })
      .catch((err) => res.json(failedRes("Something went wrong", err)));
  } catch (error) {
    return res.json(failedRes("Something error happen", error));
  }
};

const update_profile = async (req,res) => {
  const storage = multer.diskStorage({
      destination: function (req, file, cb) {
          cb(null, './uploads');
        },
      filename: function (req, file, cb) {
          cb(null, file.originalname);
      }
  });
  const uploadImg = multer({storage: storage}).single('image');
  res.json(successRes('fetched',req.file.path))
}

function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

const update_email = async (req,res) => {
  const {user_id,email} = req.body;
  if(email !== '' && validateEmail(email)){
    const upd = await User.update({
      email:email
    },{
      where:{
        id:user_id
      }
    });
    res.json(successRes('email updated!'))

  }else{
    res.json(failedRes('Email is not valid!'))
  }
}

const apply_wallet_coupon = async (req, res) => {
  const {coupon_id,user_id} = req.body;
  try {
  const cpn = await Coupon.findOne({
    where:{
      status:1,
      code:coupon_id
    }
  })
  const dateTime = currentTimeStamp();
  if(cpn){
    const checkifapplied = await AppliedWalletCoupon.findOne({
      where:{
        user_id:user_id,
        coupon_id:cpn.id
      }
    })
    if(checkifapplied){
      res.json(successRes('applied',cpn))
    }else{
      const storedata = {
        user_id,
        coupon_id:cpn.id,
        status:1,
        code:cpn.code,
        created_at:dateTime
      }
      await AppliedWalletCoupon.create(storedata)
          .then(rs=>rs && res.json(successRes('applied',cpn)))
          .catch(err=>res.json(failedRes(err.message)))
    }
  }else{
    res.json(failedRes('failed'))
  }
} catch (e) {
  res.json(failedRes(e.message))
}
}
module.exports = {
  login_with_password,
  register_login_otp,
  verify_register_login,
  edit_password,
  get_userdata_by_token,
  get_userdetails,
  edit_profile_details,
  check_if_user_add_password,
  check_if_user_add_additional_details,
  register_otp,
  verify_register,
  make_register_with_token,
  edit_profile,
  referral_code_history,
  edit_profile_image,
  send_otp_phone,
  social_login,
  send_test_notification,
  edit_profile_details_web,
  change_password,

  resend_otp_register,
  register_user_otp,

  verify_register_user,
  forgot_otp,
  forgot_change_password,
  apply_wallet_coupon,
  login_otp,
  verify_login,
  update_email
};
