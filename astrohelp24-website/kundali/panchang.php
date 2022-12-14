<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>

<?php


require_once 'src/VedicRishiClient.php';

$userId = "617029";
$apiKey = "0b2a8bfa1592144fe548e3b2317f896e";


// make some dummy data in order to call vedic rishi panchang api function
$time =explode(":",$_POST['time']);
$data = array(
'date' => (int)date("d",strtotime($_POST['date'])),
'month' => (int)date("m",strtotime($_POST['date'])),
'year' => (int)date("Y",strtotime($_POST['date'])),
'hour' => $time[0],
'minute' => $time[1],
'latitude' => $_POST['latitude'],
'longitude' => $_POST['latitude'],
'timezone' => 5.5,
);


// instantiate VedicRishiClient class
$vedicRishi = new VedicRishiClient($userId, $apiKey);

//Get Basic Panchang
$responseData = $vedicRishi->getBasicPanchang($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

//Get Basic Panchang at the time of sunrise
$responseData1 = $vedicRishi->getBasicPanchangSunrise($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

//Get Advance Panchang
$responseData2 = $vedicRishi->getAdvancedPanchang($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

//Get Advance Panchang at the time of sunrise
$responseData3 = $vedicRishi->getAdvancedPanchangSunrise($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

//Get Planet Panchang
$responseData4 = $vedicRishi->getPlanetPanchang($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

//Get Planet Panchang at the time of sunrise
$responseData5 = $vedicRishi->getPlanetPanchangSunrise($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

//Get Chaughadiya Muhurta
$responseData6 = $vedicRishi->getChaughadiyaMuhurta($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

//Get Hora Muhurta
$responseData7 = $vedicRishi->getHoraMuhurta($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);



// print response data. Change the name of variable to get the respective panchang response data
// $responseData;
$data = json_decode($responseData);

//echo "<pre>"; // ......
//print_r($data);// ......

?>



<div class="container marb-75 paddtop50">
	<h2 class="head-h2">Panchang</h2>
<div class="mr-34"></div>


<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="box-shade">
		
<p class="astro-p"><b class="astro-b">
Day&nbsp;:&nbsp; </b>	<?php echo $data->day;?>
</p>

<p class="astro-p"><b class="astro-b">
Tithi&nbsp;:&nbsp; </b>	<?php echo $data->tithi;?>
</p>

<p class="astro-p"><b class="astro-b">
Nakshatra&nbsp;:&nbsp; </b>	<?php echo $data->nakshatra;?>
</p>

<p class="astro-p"><b class="astro-b">
Yog&nbsp;:&nbsp; </b>	<?php echo $data->yog;?>
</p>

<p class="astro-p"><b class="astro-b">
Karan&nbsp;:&nbsp; </b>	<?php echo $data->karan;?>
</p>

<p class="astro-p"><b class="astro-b">
Sunrise&nbsp;:&nbsp; </b>	<?php echo $data->sunrise;?>
</p>

<p class="astro-p"><b class="astro-b">
Sunset&nbsp;:&nbsp; </b>	<?php echo $data->sunset;?>
</p>
</div>
	</div>

	<div class="col-md-4"></div>
</div>

</div>
<br>
<br>
<br>
<br>

<?php include 'footer.php';?>