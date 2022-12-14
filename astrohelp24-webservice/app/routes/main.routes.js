const validation = require('../middleware/validation.middleware');
const userController = require('../controllers/user.controller');
const homeController = require('../controllers/home.controller');
const memberController = require('../controllers/member.controller')
const horoscopeController = require('../controllers/horoscope.controller');
const bookingController = require('../controllers/booking.controller');
const transactionController = require('../controllers/transaction.controller');
const ropewayController = require('../controllers/ropeway.controller');
const favouriteController = require('../controllers/favourite.controller');
const giftController = require('../controllers/gift.controller');
const rechargePlanController = require('../controllers/rechargesplan.controller');

const tatatelecontroller = require('../controllers/tatatele.controller');


const multer = require("multer");
var upload = multer();


// var storage = multer.diskStorage({
//     destination: (req, file, cb) => {
//       cb(null, './public/images');
//     },
//     filename: (req, file, cb) => {
//       console.log(file);
//       var filetype = '';
//       if(file.mimetype === 'image/gif') {
//         filetype = 'gif';
//       }
//       if(file.mimetype === 'image/png') {
//         filetype = 'png';
//       }
//       if(file.mimetype === 'image/jpeg') {
//         filetype = 'jpg';
//       }
//       cb(null, 'image-' + Date.now() + '.' + filetype);
//     }
// });
// var upload2 = multer({storage: storage});
// const upload = multer({dest:'uploads/'}).single("demo_image");


const cartController = require('../controllers/cart.controller');
const jwt = require('jsonwebtoken');
const { jwtsecret } = require('../config/app.config');
const { failedRes } = require('../helpers/response.helper');


const verify = (token, secret) => {

    return new Promise(function (resolve, reject) {
        jwt.verify(token, secret, function (err, decode) {
            if (err) {
                reject(err)
                return
            }

            resolve(decode)
        })
    })
}

var authenticateUser = async (req, res, next) => {
    const authorization = req.headers.authorization;

    // console.log('language',req.headers);

    if (authorization == undefined) {
        res.json({
            'status': false,
            'message': 'Unauthorized'
        })
        return;
    }
    try {
        let decoded = await verify(authorization, jwtsecret)
        req.userId = decoded.id;
        req.user_id = decoded.id;
        req.body.userId = decoded.id;
        req.body.user_id = decoded.id;

        next();
    } catch (e) {
        return res.status(401).json(failedRes('Failed to authenticate token.', null));
    }
    // next()
}


module.exports = (app, io) => {
    var router = require("express").Router();

    router.post('/fetch_blogs', homeController.fetch_blogs);

    /**user auth */
    router.post("/register_login_otp", validation.register_login_otp_valid, userController.register_login_otp);
    router.post("/verify_register_login", userController.verify_register_login);
    router.post("/login_with_password", userController.login_with_password);
    router.post("/edit_password", authenticateUser, userController.edit_password);
    router.post("/get_userdata_by_token", authenticateUser, userController.get_userdata_by_token);
    router.post("/get_userdetails", authenticateUser, userController.get_userdetails);
    router.post("/edit_profile_details", authenticateUser, userController.edit_profile_details);
    router.post("/edit_profile_details_web", authenticateUser, userController.edit_profile_details_web);
    router.post("/change_password", authenticateUser, userController.change_password);
    router.post("/login_otp", userController.login_otp);
    router.post("/verify_login", userController.verify_login);
    router.post("/update_email", authenticateUser, userController.update_email);

    router.post("/register_user_otp", userController.register_user_otp);
    router.post("/verify_register_user", userController.verify_register_user);
    router.post("/resend_otp_register", userController.resend_otp_register);
    router.post("/fetch_faqs", homeController.fetch_faqs);
    router.all("/fetch_astrohelp24_home", homeController.fetch_astrohelp24_home);
    router.all("/test_ivr", homeController.test_ivr);



    router.post("/add_support", authenticateUser, homeController.add_support);
    router.post("/check_if_user_add_password", authenticateUser, userController.check_if_user_add_password);
    router.post("/check_if_user_add_additional_details", authenticateUser, userController.check_if_user_add_additional_details);
    router.post("/register_otp", validation.register_login_otp_valid, userController.register_otp);
    router.post("/verify_register", userController.verify_register);
    router.post("/make_register_with_token", userController.make_register_with_token);
    router.post("/edit_profile", authenticateUser, userController.edit_profile);
    router.post("/referral_code_history", authenticateUser, userController.referral_code_history);
    router.post("/send_otp_phone", authenticateUser, userController.send_otp_phone);
    router.post("/social_login", userController.social_login);
    router.all("/send_test_notification", userController.send_test_notification);



    router.post("/forgot_otp", userController.forgot_otp);
    router.post("/forgot_change_password", userController.forgot_change_password);

    router.post("/get_booking_status", authenticateUser, homeController.get_booking_status);

    // fetch_ropeways
    router.post("/fetch_ropeways", authenticateUser, ropewayController.fetch_ropeways);
    router.post("/add_ropeway_enquiry", authenticateUser, ropewayController.add_ropeway_enquiry);
    router.post("/fetch_ropeway_details", authenticateUser, ropewayController.fetch_ropeway_details);


    // router.post("/edit_profile_image",multer({dest:'uploads/'}).single('file'),userController.edit_profile_image);

    /**explore home */
    router.post("/fetch_explore_for_web", homeController.fetch_explore_for_web)
    router.post("/fetch_explore", homeController.fetch_explore)
    router.post("/astrokul_home", homeController.astrokul_home)
    router.post("/fetch_astrologer_by_speciality_services", authenticateUser, homeController.fetch_astrologer_by_speciality_services)
    router.post("/fetch_astrologer_speciality_horoscope", homeController.fetch_astrologer_speciality_horoscope)



    router.post("/fetch_explore_banner_puja", homeController.fetch_explore_banner_puja);
    router.post("/fetch_explore_yoga_posts", homeController.fetch_explore_yoga_posts);

    /**puja filters */
    router.post("/fetch_puja_filters", authenticateUser, homeController.fetch_puja_filters);
    router.post("/search_puja_by_filters", authenticateUser, homeController.search_puja_by_filters);

    router.post("/check_astrologer_booking_status", authenticateUser, homeController.check_astrologer_booking_status);
    router.post("/initiate_astrologer_booking", authenticateUser, homeController.initiate_astrologer_booking);



    router.post("/fetch_wallet_and_notification_count", authenticateUser, homeController.fetch_wallet_and_notification_count);
    router.post("/fetch_notifications", authenticateUser, homeController.fetch_notifications);
    router.post("/end_live_session", authenticateUser, homeController.end_live_session);
    router.post("/add_review", authenticateUser, homeController.add_review);
    router.all("/update_reviews_astro", homeController.update_reviews_astro);


    /**astrologer home */
    router.post("/fetch_astrologer_home", homeController.fetch_astrologer_home);
    router.post("/fetch_astrologer_filters", homeController.fetch_astrologer_filters);
    router.post("/search_astrologer_by_filters", authenticateUser, homeController.search_astrologer_by_filters);
    router.post("/sortDataAstro", authenticateUser, homeController.sortDataAstro);
    router.post("/get_puja_booking_status", authenticateUser, homeController.get_puja_booking_status);
    router.post("/end_puja", authenticateUser, homeController.end_puja);



    /**pujas */
    router.post("/fetch_pujas", authenticateUser, homeController.fetch_pujas);
    router.post("/fetch_puja_details", authenticateUser, homeController.fetch_puja_details);
    router.post("/fetch_puja_review_locations_details", authenticateUser, homeController.fetch_puja_review_locations_details);
    router.post("/fetch_puja_venues", authenticateUser, homeController.fetch_puja_venues);
    router.post("/fetch_puja_time_slots", homeController.fetch_puja_time_slots);

    router.post("/fetch_payable_amount_puja", authenticateUser, bookingController.fetch_payable_amount_puja);

    router.post("/booking_puja", authenticateUser, bookingController.booking_puja);
    router.post("/realtime_bookinghistory", authenticateUser, bookingController.realtime_bookinghistory);


    /***coupons */
    router.post("/fetch_puja_coupons", authenticateUser, bookingController.fetch_puja_coupons);
    router.post("/apply_coupon", authenticateUser, bookingController.apply_coupon);
    router.post("/puja_booking_history", authenticateUser, bookingController.puja_booking_history);
    router.post("/remove_coupon", authenticateUser, bookingController.remove_coupon);

    router.post("/fetch_horoscope_coupons", authenticateUser, bookingController.fetch_horoscope_coupons);
    router.post("/fetch_astrologer_coupons", authenticateUser, bookingController.fetch_astrologer_coupons);
    router.post("/astrologer_book", authenticateUser, bookingController.astrologer_book);
    router.post("/astrologer_book_new", authenticateUser, bookingController.astrologer_book_new);


    router.all("/get_astrologer_prices", bookingController.get_astrologer_prices);
    router.post("/set_astrologer_discount", bookingController.set_astrologer_discount);


    router.all("/get_cancellation_reasons", bookingController.get_cancellation_reasons);
    router.post("/booking_history", authenticateUser, bookingController.booking_history);
    router.post("/refund_request_raise", authenticateUser, bookingController.refund_request_raise);

    /**horoscopes */
    router.post("/fetch_horoscopes", horoscopeController.fetch_horoscopes);
    router.post("/daily_sun_sign_prediction", authenticateUser, horoscopeController.daily_sun_sign_prediction);
    router.post("/match_making_details", authenticateUser, horoscopeController.match_making_details);
    router.post("/fetch_payable_amount_horoscope", authenticateUser, bookingController.fetch_payable_amount_horoscope);
    router.post("/horoscope_book", authenticateUser, bookingController.horoscope_book);
    router.post("/fetch_payable_amount_astrologer", authenticateUser, bookingController.fetch_payable_amount_astrologer);
    router.post("/booking_details", authenticateUser, bookingController.booking_details);

    router.post("/fetch_payable_amount_horoscope_new", authenticateUser, bookingController.fetch_payable_amount_horoscope_new);
    router.post("/horoscope_book_new", authenticateUser, bookingController.horoscope_book_new);

    router.post("/reschedule_puja_booking", authenticateUser, bookingController.reschedule_puja_booking);
    router.post("/reschedule_astrologer_booking", authenticateUser, bookingController.reschedule_astrologer_booking);
    router.post("/cancel_astrologer_booking", authenticateUser, bookingController.cancel_astrologer_booking);
    router.post("/cancel_puja_booking", authenticateUser, bookingController.cancel_puja_booking);


    router.post("/join_puja", authenticateUser, homeController.join_puja);
    router.all("/send_test_notification_astro", homeController.send_test_notification_astro);


    /**cities and venues */
    router.post('/fetch_cities', homeController.fetch_cities)


    /**members */
    router.post('/add_member', authenticateUser, memberController.add_member)
    router.post('/delete_member', authenticateUser, memberController.delete_member)
    router.post('/fetch_members', authenticateUser, memberController.fetch_members)
    router.post('/add_kundalimember', authenticateUser, memberController.add_kundalimember)
    router.post('/delete_kundalimember', authenticateUser, memberController.delete_kundalimember)
    router.post('/fetch_kundalimembers', authenticateUser, memberController.fetch_kundalimembers)
    router.post('/set_default_kundali_member', authenticateUser, memberController.set_default_kundali_member)

    router.post('/get_recently_added_member', authenticateUser, memberController.get_recently_added_member)




    /**time slots */
    router.post('/time_slots', authenticateUser, homeController.time_slots)

    router.post('/fetch_tv_posts', authenticateUser, homeController.fetch_tv_posts)



    /**cart */
    router.post('/add_to_cart', authenticateUser, cartController.add_to_cart)
    router.post('/add_puja_to_cart', authenticateUser, cartController.add_puja_to_cart)
    router.post('/delete_puja_cart', authenticateUser, cartController.delete_puja_cart)
    router.post('/get_puja_cart', authenticateUser, cartController.get_puja_cart)
    router.post('/bookpuja_of_cart', authenticateUser, cartController.bookpuja_of_cart)



    /**add guest */
    router.post('/add_guests', authenticateUser, homeController.add_guests)



    /**enquiry */
    router.post("/add_enquiry", authenticateUser, homeController.add_enquiry);


    /**astrologers */
    router.post('/fetch_astrologers_on_home', homeController.fetch_astrologers_on_home)
    router.all('/fetch_astrologers', homeController.fetch_astrologers)
    router.post('/fetch_astrologer_new', homeController.fetch_astrologer_new)
    router.post('/fetch_astrologer_details', homeController.fetch_astrologer_details)
    router.post('/fetch_astrologer_time_slots', authenticateUser, homeController.fetch_astrologer_time_slots)
    router.post('/search_astrologers', homeController.search_astrologers)

    router.post('/search_pujas', authenticateUser, homeController.search_pujas)
    router.post('/fetch_astro_services', authenticateUser, homeController.fetch_astro_services)



    /**wallet recharge */
    router.post("/recharge_user_wallet", authenticateUser, transactionController.recharge_user_wallet);
    router.post("/recharge_user_wallet_new", authenticateUser, transactionController.recharge_user_wallet_new);
    router.post("/recharge_user_wallet_v2", authenticateUser, transactionController.recharge_user_wallet_v2);
    router.post("/recharge_user_wallet_v3", authenticateUser, transactionController.recharge_user_wallet_v3);

    router.post("/wallet_history", authenticateUser, transactionController.wallet_history);
    router.post("/user_wallet_balance", authenticateUser, transactionController.user_wallet_balance);
    // router.post("/check_wallet_coupon", authenticateUser, transactionController.check_wallet_coupon);
    router.post("/fetch_payable_amount_wallet", authenticateUser, transactionController.fetch_payable_amount_wallet);
    router.post("/check_if_first_recharge", authenticateUser, transactionController.check_if_first_recharge);


    router.post("/toggle_favourite", authenticateUser, favouriteController.toggle_favourite);
    router.post("/fetch_favourite_astrologers", authenticateUser, favouriteController.fetch_favourite_astrologers);

    router.post('/search_astro_by_filter', homeController.search_astro_by_filter)
    router.all('/broadcast_home', homeController.broadcast_home)


    router.all('/create_broadcast', homeController.create_broadcast)
    router.all('/end_broadcast', homeController.end_broadcast)


    router.all("/get_broadcast_joined_users", bookingController.get_broadcast_joined_users);
    router.all("/toggle_follow_astrologer", authenticateUser, homeController.toggle_follow_astrologer);
    router.all("/checkIfastrologerfollowed", authenticateUser, homeController.checkIfastrologerfollowed);

    router.all("/astrologer_dynamic", homeController.astrologer_dynamic);
    router.all("/fetch_queue_users", homeController.fetch_queue_users);
    router.all("/fetch_settings", homeController.fetch_settings);

    router.all("/remove_queue", authenticateUser, homeController.remove_queue);
    router.all("/set_astrologer_comission", homeController.set_astrologer_comission);


    router.all("/fetch_gifts", giftController.fetch_gifts);
    router.all("/fetch_languages", giftController.fetch_languages);
    router.post("/fetch_astrologer_broadcasts", giftController.fetch_astrologer_broadcasts);
    router.post("/update_broadcast_gifts", giftController.update_broadcast_gifts);
    router.post("/delete_broadcast", giftController.delete_broadcast);
    router.post("/start_broadcast_astro", giftController.start_broadcast_astro);
    router.post("/fetch_gift_bag", giftController.fetch_gift_bag);


    /**broadcasts customer side */
    router.post("/fetch_broadcast_customer", authenticateUser, giftController.fetch_broadcast_customer);
    router.post("/book_broadcast", authenticateUser, giftController.book_broadcast);
    router.post("/fetch_broadcast_gifts", authenticateUser, giftController.fetch_broadcast_gifts);
    router.all("/schedule_event", giftController.schedule_event);
    router.post("/send_gifts", authenticateUser, giftController.send_gifts);


    router.all("/get_recharge_plans", rechargePlanController.get_recharge_plans);

    router.all("/wallet_recharge_webhook_razorpay", transactionController.wallet_recharge_webhook_razorpay);
    router.all("/notifyurl_cashfree", transactionController.notifyurl_cashfree);
    router.all("/recharge_by_juspay_webhook", transactionController.recharge_by_juspay_webhook);

    router.all("/get_cashfree_orderid", authenticateUser, transactionController.get_cashfree_orderid);
    router.all("/recharge_by_juspay", authenticateUser, transactionController.recharge_by_juspay);


    // for parsing multipart/form-data


    router.post('/reply_on_review', homeController.reply_on_review)
    router.post('/get_astrologer_review', homeController.get_astrologer_review)

    router.all('/make_audio_call_astrologer', tatatelecontroller.make_audio_call_astrologer)
    router.all('/call_pickup_customer', tatatelecontroller.call_pickup_customer)
    router.all('/call_missed', tatatelecontroller.call_missed)
    router.all('/call_hangup', tatatelecontroller.call_hangup)
    router.all('/answer_by_agent', tatatelecontroller.answer_by_agent)

    router.post('/apply_wallet_coupon', authenticateUser,userController.apply_wallet_coupon)

    app.use(upload.array());

    app.use("/api", router);
};
