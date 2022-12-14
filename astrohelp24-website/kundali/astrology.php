<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>

<?php
/**
 * A php file to test the Vedic Rishi Client class
 * Author: Chandan Tiwari
 * Date: 06/12/14
 * Time: 5:42 PM
 */
// error_reporting(E_ALL); 
// ini_set('display_errors', TRUE); 
// ini_set('display_startup_errors', TRUE);
require_once 'src/VedicRishiClient.php';


$userId = "609418";
$apiKey = "3f44385e5c9a4a5febc2e9ea7872bacf";




$data = array(

    'date' => 07,
    'month' => 03,
    'year' => 1987,
    'hour' => 12,
    'minute' => 30,
    'latitude' => 28.63576,
    'longitude' => 77.22445,
    'timezone' => 'Asia/Kolkata',
    // 'prediction_time  zone' => 5.5 // Optional. Only For Transit Prediction API
);



// echo "<pre>";
// echo "<h1>asdhaksjhdkjahskdhkjas</h1>";
// var_dump($data);
// exit;
/*
$dateOfBirth = $_POST['date'];
$monthOfBirth = $_POST['month'];;
$yearOfBirth = $_POST['year'];;
$hour = $_POST['hour'];;
$minute = $_POST['minute'];;
$latitude = $_POST['latitude'];;
$longitude = $_POST['longitude'];;
$timezone = $_POST['timezone'];;
$prediction_timezone = $_POST['prediction_timezone'];;

*/



//planet name will be used for the planet ashtakvarga
$planetName = ["sun", "moon", "mars", "mercury", "jupiter", "venus", "saturn" , "ascendant"];

//sign name
$signName = ['aries', 'taurus', 'gemini', 'cancer', 'leo', 'virgo', 'libra', 'scorpio', 'sagittarius', 'capricorn', 'aquarius', 'pisces'];


//chart Id to calculate horoscope chart
$chartId = ['chalit','SUN','MOON','D1','D2','D3','D4','D5','D7','D8','D9','D10','D12','D16','D20','D24','D27','D30','D40','D45','D60'];


// instantiate VedicRishiClient class
$vedicRishi = new VedicRishiClient($userId, $apiKey);
$vedicRishi->setLanguage('hi');

// call horoscope functions of Vedic Rishi Client

//*****************Basic Astro****************//
$responseData = $vedicRishi->getBirthDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData1 = $vedicRishi->getAstroDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData2 = $vedicRishi->getPlanetsDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData3 = $vedicRishi->getPlanetsExtendedDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData4 = $vedicRishi->getPlanetsTropicalDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData5 = $vedicRishi->getGeoDetails('pune', 5);

$responseData6 = $vedicRishi->getTimezone('Asia/Kolkata', 'false');


//*****************Ashtakvarga****************//
$responseData7 = $vedicRishi->getAshtakvargaDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $planetName[3]);

$responseData8 = $vedicRishi->getSarvashtakDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Vimshottari Dasha****************//
$responseData9 = $vedicRishi->getCurrentVimDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData10 = $vedicRishi->getCurrentVimDashaAll($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData11 = $vedicRishi->getMajorVimDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Yogini Dasha****************//
$responseData12 = $vedicRishi->getCurrentYoginiDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData13 = $vedicRishi->getMajorYoginiDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData14 = $vedicRishi->getSubYoginiDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Char Dasha****************//
$responseData15 = $vedicRishi->getCurrentCharDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData16 = $vedicRishi->getMajorCharDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData17 = $vedicRishi->getSubCharDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $signName[3]);

$responseData18 = $vedicRishi->getSubSubCharDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $signName[4], $signName[2]);


//*****************Kalsarpa Dasha****************//
$responseData19 = $vedicRishi->getKalsarpaDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Pitri Dasha****************//
$responseData20 = $vedicRishi->getPitriDoshaReport($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Sadhesati Dosha****************//
$responseData201 = $vedicRishi->getSadhesatiLifeDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData202 = $vedicRishi->getSadhesatiCurrentStatus($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData203 = $vedicRishi->getSadhesatiRemedies($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Manglik Dosha****************//
$responseData21 = $vedicRishi->getManglikDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Horoscope Charts****************//
$responseData22 = $vedicRishi->getHoroChartById($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $chartId[4]);

$responseData23 = $vedicRishi->getExtendedHoroChartById($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $chartId[5]);


//*****************Suggestions and Remedies****************//
$responseData24 = $vedicRishi->getBasicGemSuggestion($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData25 = $vedicRishi->getRudrakshaSuggestion($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData26 = $vedicRishi->getPujaSuggestion($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

//***************************************** GENERAL REPORTS FUNCTIONS ****************************************************
$responseData27 = $vedicRishi->getGeneralHouseReport($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $planetName[6]);

$responseData28 = $vedicRishi->getGeneralRashiReport($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $planetName[1]);

$responseData29 = $vedicRishi->getAscendantReport($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

$responseData30 = $vedicRishi->getNakshatraReport($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

//****************************Nakshatra Prediction**********************//
$responseData31 = $vedicRishi->getDailyNakshatraPrediction($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//****************************Timezone Wth DST**********************//
//date formate -> mm-dd-yyyy
$date = $data['month'].'-'.$data['date'].'-'.$data['year'];
$timezoneData = $vedicRishi->timezoneWithDst($date, $data['latitude'], $data['longitude']);


/*Convert array to json*/
$data = json_decode($timezoneData);
// echo "<pre>";
print_r($data);

?>


<div class="container marb-75 paddtop50">

<h1 class="head"><?php  ?></h1>
<h1 class="details-con"><?php ?></h1>
</div>


<?php include 'footer.php';?>