<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>

<?php

require_once 'src/VedicRishiClient.php';


$userId = "617029";
$apiKey = "0b2a8bfa1592144fe548e3b2317f896e";

$data = array(
    'timezone' => '5.5'
);



// instantiate VedicRishiClient class
$vedicRishi = new VedicRishiClient($userId, $apiKey);


// call prediction method of the VedicRishiClient call .. provides JSON response

$todaysPrediction = $vedicRishi->getTodaysPrediction($_POST['rashi_name'], $data['timezone']);
$tomorrowsPrediction = $vedicRishi->getTomorrowsPrediction($_POST['rashi_name'], $data['timezone']);
$yesterdaysPrediction = $vedicRishi->getYesterdaysPrediction($_POST['rashi_name'], $data['timezone']);

// print_r($_POST['timezone']); die;

// printing the JSON data on the screen/browser
// echo $todaysPrediction;
// echo "\n";
// echo $tomorrowsPrediction;
// echo "\n";
// echo $yesterdaysPrediction;
// echo "\n";

//echo "<pre>";


$data1 = json_decode($todaysPrediction);

//$data2 = json_decode($tomorrowsPrediction);

//$data3 = json_decode($yesterdaysPrediction);

// print_r($data1);
//print_r($data1);
//print_r($data2);


?>




<div class="container marb-75 paddtop50">
<h2 class="head-h2">Daily Horoscope</h2>
<br>
<p class="astro-p"><b class="astro-b">
Sun Shine&nbsp;: </b>	<?php echo $data1->sun_sign;?>

</p>

<p class="astro-p"><b class="astro-b">Drediction Date&nbsp;:</b>	<?php echo $data1->prediction_date;?>
</p>


<p class="astro-p"><b class="astro-b">Health&nbsp;: </b><?php echo $data1->prediction->health;?>
</p>

<p class="astro-p"><b class="astro-b">
Personal Life&nbsp;:</b>	<?php echo $data1->prediction->personal_life;?>
</p>


<p class="astro-p"><b class="astro-b">
Profession&nbsp;:	</b><?php echo $data1->prediction->profession;?>
</p>

<p class="astro-p"><b class="astro-b">
Emotions&nbsp;:</b>	<?php echo $data1->prediction->emotions;?>
</p>



<p class="astro-p"><b class="astro-b">
Travel&nbsp;: </b>	<?php echo $data1->prediction->travel;?>
</p>

<p class="astro-p"><b class="astro-b">
Luck&nbsp;:	</b><?php echo $data1->prediction->luck;?>
</p>

</div>

<?php include 'footer.php';?>