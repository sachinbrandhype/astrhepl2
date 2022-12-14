<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>

<?php


require_once 'src/VedicRishiClient.php';
$userId = "617029";
$apiKey = "0b2a8bfa1592144fe548e3b2317f896e";

//$data = array(
//'date' => 25,
//'month' => 12,
//'year' => 1988,
//'hour' => 4,
//'minute' => 0,
//'latitude' => 25.123,
//'longitude' => 82.34,
//'timezone' => 5.5
//);

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

$resourceName = "rudraksha_suggestion";
$vedicRishi = new VedicRishiClient($userId, $apiKey);
$responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
// echo $responseData;
$data = json_decode($responseData);
//echo "<pre>";

//print_r($data);

?>

<div class="container marb-75 paddtop50">
<h2 class="head-h2">Rudraksha Suggestion</h2>
<br>

<p class="astro-p"><?php echo "<img src='{$img->img_url}'>";?></p>

<p class="astro-p"><b class="astro-b">Name&nbsp;: &nbsp;</b> <?php echo $data->name;?></p>

<p class="astro-p"><b class="astro-b">Recommend&nbsp;: &nbsp;</b> <?php echo $data->recommend;?></p>

<p class="astro-p"><b class="astro-b">Details&nbsp;: &nbsp;</b> <?php echo $data->detail;?></p>

</div>

<?php include 'footer.php';?>