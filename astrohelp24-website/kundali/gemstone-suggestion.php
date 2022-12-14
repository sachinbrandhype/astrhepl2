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

$resourceName = "basic_gem_suggestion";
$vedicRishi = new VedicRishiClient($userId, $apiKey);
$responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
// echo $responseData;
$data = json_decode($responseData);
//echo "<pre>";

//print_r($data);

?>

<div class="container marb-75 paddtop50">
	<h2 class="head-h2">Gemstone Suggestion</h2>
<div class="mr-34"></div>

<div class="row mt-20">
	<div class="col-md-4">
		<div class="box-shade">
		<h3>LIFE</h3>
<p class="gem-p"><b class="astro-b">Name&nbsp;: &nbsp;</b> <?php echo $data->LIFE->name;?>
</p>
<p class="gem-p"><b class="astro-b">Semi Gem&nbsp;: &nbsp;</b> <?php echo $data->LIFE->semi_gem;?>
</p>
<p class="gem-p"><b class="astro-b">Wear Finger&nbsp;: &nbsp;</b> <?php echo $data->LIFE->wear_finger;?>
</p>
<p class="gem-p"><b class="astro-b">Weight Caret&nbsp;: &nbsp;</b> <?php echo $data->LIFE->weight_caret;?>
</p>
<p class="gem-p"><b class="astro-b">Wear Metal&nbsp;: &nbsp;</b> <?php echo $data->LIFE->wear_metal;?>
</p>
<p class="gem-p"><b class="astro-b">Wear Day&nbsp;: &nbsp;</b> <?php echo $data->LIFE->wear_day;?>
</p>
<p class="gem-p"><b class="astro-b">Gem Deity&nbsp;: &nbsp;</b> <?php echo $data->LIFE->gem_deity;?>
</p>
</div>
	</div>

	<div class="col-md-4">
			<div class="box-shade">
		<h3>BENEFIC</h3>
<p class="gem-p"><b class="astro-b">Name&nbsp;: &nbsp;</b> <?php echo $data->BENEFIC->name;?>
</p>
<p class="gem-p"><b class="astro-b">Semi Gem&nbsp;: &nbsp;</b> <?php echo $data->BENEFIC->semi_gem;?>
</p>
<p class="gem-p"><b class="astro-b">Wear Finger&nbsp;: &nbsp;</b> <?php echo $data->BENEFIC->wear_finger;?>
</p>
<p class="gem-p"><b class="astro-b">Weight Caret&nbsp;: &nbsp;</b> <?php echo $data->BENEFIC->weight_caret;?>
</p>
<p class="gem-p"><b class="astro-b">Wear Metal&nbsp;: &nbsp;</b> <?php echo $data->BENEFIC->wear_metal;?>
</p>
<p class="gem-p"><b class="astro-b">Wear Day&nbsp;: &nbsp;</b> <?php echo $data->BENEFIC->wear_day;?>
</p>
<p class="gem-p"><b class="astro-b">Gem Deity&nbsp;: &nbsp;</b> <?php echo $data->BENEFIC->gem_deity;?>
</p>
</div>
	</div>


	<div class="col-md-4">
			<div class="box-shade">
		<h3>LUCKY</h3>
<p class="gem-p"><b class="astro-b">Name&nbsp;: &nbsp;</b> <?php echo $data->LUCKY->name;?>
</p>
<p class="gem-p"><b class="astro-b">Semi Gem&nbsp;: &nbsp;</b> <?php echo $data->LUCKY->semi_gem;?>
</p>
<p class="gem-p"><b class="astro-b">Wear Finger&nbsp;: &nbsp;</b> <?php echo $data->LUCKY->wear_finger;?>
</p>
<p class="gem-p"><b class="astro-b">Weight Caret&nbsp;: &nbsp;</b> <?php echo $data->LUCKY->weight_caret;?>
</p>
<p class="gem-p"><b class="astro-b">Wear Metal&nbsp;: &nbsp;</b> <?php echo $data->LUCKY->wear_metal;?>
</p>
<p class="gem-p"><b class="astro-b">Wear Day&nbsp;: &nbsp;</b> <?php echo $data->LUCKY->wear_day;?>
</p>
<p class="gem-p"><b class="astro-b">Gem Deity&nbsp;: &nbsp;</b> <?php echo $data->LUCKY->gem_deity;?>
</p>
</div>
	</div>
</div>
	</div>


<?php include 'footer.php';?>