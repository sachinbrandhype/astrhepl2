<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>

<?php


require_once 'src/VedicRishiClient.php';
$userId = "617029";
$apiKey = "0b2a8bfa1592144fe548e3b2317f896e";

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

$resourceName = "numero_prediction/daily";
$vedicRishi = new VedicRishiClient($userId, $apiKey);
$responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
// echo $responseData;
$data = json_decode($responseData);
// echo "<pre>";

// print_r($data);

?>

<div class="container marb-75 paddtop50">
	<h2 class="head-h2">Daily Prediction</h2>
	<div class="mr-34"></div>

<h1 class="details-con"><?php echo $data->prediction;?></h1>
<br>
<p class="gem-p"><b class="astro-b">Lucky Color&nbsp;: &nbsp;</b> <?php echo $data->lucky_color;?>
</p>

<p class="gem-p"><b class="astro-b">Lucky Number&nbsp;: &nbsp;</b> <?php echo $data->lucky_number;?>
</p>

<p class="gem-p"><b class="astro-b">Prediction Date&nbsp;: &nbsp;</b> <?php echo $data->prediction_date;?>
</p>
	</div>


<?php include 'footer.php';?>