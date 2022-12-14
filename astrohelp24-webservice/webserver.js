/**import packages */
process.env.TZ = 'Asia/Calcutta'
const express=require('express');
var redis = require('socket.io-redis');
const bodyParser=require('body-parser');
const {  ValidationError  } = require('express-validation')
const http = require('https')
const fs = require('fs')
const winston = require("winston"),
expressWinston = require("express-winston");
console.log("Server Started")
// var multer = require('multer');
// var upload = multer();


const moment = require('moment');


const cors=require('cors');

/**intialize express server app */
const app=express();

// var server = http.createServer(app);

const httpsServer = http.createServer({
    // /etc/apache2/ssl/astrohelp24.key
    key: fs.readFileSync('/etc/letsencrypt/live/astrohelp24.com/privkey.pem'),
    cert: fs.readFileSync('/etc/letsencrypt/live/astrohelp24.com/cert.pem'),
    ca: fs.readFileSync('/etc/letsencrypt/live/astrohelp24.com/chain.pem')
    //ca: [
      //  fs.readFileSync('/etc/apache2/ssl/addtrustexternalcaroddot.cer'),
        //fs.readFileSync('/etc/apache2/ssl/SectigoRSADomainValidationSecureServerCA.crt'),
        //fs.readFileSync('/etc/apache2/ssl/astrohelp24bundle.crt')
    //]
}, app);

// SSLCertificateKeyFile /etc/apache2/ssl/astrohelp24.key
// SSLCertificateFile /etc/apache2/ssl/astrohelp24.crt
// SSLCertificateChainFile /etc/apache2/ssl/SectigoRSADomainValidationSecureServerCA.crt


var io = require('socket.io')(httpsServer);
io.adapter(redis({ host: 'localhost', port: 6379 }));
//console.log('CURRENT',moment().format('YYYY-MM-DD HH:mm:ss'));

app.use(cors());

/**create again table */
//db.sequelize.sync();
// db.sequelize.sync({ force: true }).then(() => {
//     //console.log("Drop and re-sync db.");
// });

/**parse requests as application/json */
app.use(express.json());

// parse requests of content-type - application/x-www-form-urlencoded
app.use(express.urlencoded({extended:false}));


/**validation error */
app.use(function(err, req, res, next) {

    if (err instanceof ValidationError) {
    return res.status(err.statusCode).json(err)
    // return res.json({status:false,message:err.message})

    }

    return res.status(500).json(err)
})


// process.on('unhandledRejection', function(e) {
//    //console.log(e);
//    process. exit();
// });


function postTrimmer(req, res, next) {
    if (req.method === 'POST') {
        for (const [key, value] of Object.entries(req.body)) {
            req.body[key] = Number.isNaN() ? value.trim() : value;
        }
    }
    next();
}

app.use(postTrimmer);

app.use(
  expressWinston.logger({
    transports: [new winston.transports.Console()],
    format: winston.format.combine(
      winston.format.colorize(),
      winston.format.json()
    ),
    meta: true, // optional: control whether you want to log the meta data about the request (default to true)
    msg: "HTTP {{req.method}} {{req.url}}", // optional: customize the default logging message. E.g. "{{res.statusCode}} {{req.method}} {{res.responseTime}}ms {{req.url}}"
    expressFormat: true, // Use the default Express/morgan request formatting. Enabling this will override any msg if true. Will only output colors with colorize set to true
    colorize: false, // Color the text and status code, using the Express/morgan color palette (text: gray, status: default green, 3XX cyan, 4XX yellow, 5XX red).
    ignoreRoute: function (req, res) {
      return false;
    }, // optional: allows to skip some log messages based on request and/or response
  })
);
  expressWinston.requestWhitelist.push('body');

// simple route
app.get("/", (req, res) => {
    res.json({ 'headers' : req.headers,message: "Welcome to Astrohelp24 application new." });
});


app.use(function(req, res, next){
    res.io = io;
    // //console.log('io',io);
    next();
});

require("./app/socket/socket")(io);


require("./app/routes/main.routes")(app,io);



/**set port, listen requests */
const PORT=5030;
httpsServer.listen(PORT,()=>{
    console.log(`Server is running on port ${PORT}.`);
})
