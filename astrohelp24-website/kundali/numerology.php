<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>

<?php
/**
 * A PHP File to test Numerology APIs from Vedic Rishi Astro
 * User: chandan
 * Date: 14/05/15
 * Time: 5:38 PM
 */


require_once 'src/VedicRishiClient.php';

$userId = "617029";
$apiKey = "0b2a8bfa1592144fe548e3b2317f896e";



//TODO:  Make numerology request data. This needs to come from form in production
//$dateOfBirth = 25;
//$monthOfBirth = 12;
//$yearOfBirth = 1988;
//$name = 'Chandan';


$dateOfBirth = (int)date("d",strtotime($_POST['date']));
$monthOfBirth = (int)date("m",strtotime($_POST['date']));
$yearOfBirth = (int)date("Y",strtotime($_POST['date']));
$name = $_POST['fullname'];



// instantiate VedicRishiClient class
$vedicRishi = new VedicRishiClient($userId, $apiKey);

// call numerology method of the VedicRishiClient call .. provides JSON response
$numeroJSONData1 = $vedicRishi->getNumeroReport($dateOfBirth, $monthOfBirth, $yearOfBirth, $name);
$numeroJSONData2 = $vedicRishi->getNumeroTable($dateOfBirth, $monthOfBirth, $yearOfBirth, $name);
$numeroJSONData3 = $vedicRishi->getNumeroPlaceVastu($dateOfBirth, $monthOfBirth, $yearOfBirth, $name);
$numeroJSONData4 = $vedicRishi->getNumeroFavLord($dateOfBirth, $monthOfBirth, $yearOfBirth, $name);
$numeroJSONData5 = $vedicRishi->getNumeroFavMantra($dateOfBirth, $monthOfBirth, $yearOfBirth, $name);
$numeroJSONData6 = $vedicRishi->getNumeroFastsReport($dateOfBirth, $monthOfBirth, $yearOfBirth, $name);
$numeroJSONData7 = $vedicRishi->getNumeroFavTime($dateOfBirth, $monthOfBirth, $yearOfBirth, $name);


// printing the JSON data on the screen/browser

/*Show the array in proper manner*/
// echo "<pre>";

/*Show json response form api*/
// echo $numeroJSONData7;


/*Convert array to json*/
$data = json_decode($numeroJSONData7);

/*show the array object data */
// print_r($data);
?>

<div class="container marb-75 paddtop50">
	<h2 class="head-h2">Numerology</h2>
<br>

<h1 class="details-con">Dear <b><?php echo $name; ?></b></h1> 
<br>
<h1 class="head"><?php echo $data->title; ?></h1>
<h1 class="details-con"><?php echo $data->description;?></h1>
</div>

<?php include 'footer.php';?>