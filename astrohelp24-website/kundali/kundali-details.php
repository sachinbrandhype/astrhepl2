<?php
// $data = array(
 //	'date' => 25,
 //	'month' => 12,
 //	'year' => 1988,
 //	'hour' => 4,
//	'minute' => 0,
 //	'latitude' => 25.123,
 //	'longitude' => 82.34,
 //	'timezone' => 5.5
 //);

if (isset($_POST['chartid'])) {
	echo (json_encode(getData('horo_chart_image/'.$_POST['chartid'],$_POST['data'])));
	exit();
}?>
<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<?php
$name = $_POST['fullname'];
$time =explode(":",$_POST['time']);
$data = array(
'date' => (int)date("d",strtotime($_POST['date'])),
'month' => (int)date("m",strtotime($_POST['date'])),
'year' => (int)date("Y",strtotime($_POST['date'])),
'hour' => $time[0],
'minute' => $time[1],
	'latitude' => 25.123,
	'longitude' => 82.34,
'timezone' => 5.5,
);


$basicDetails = getData("birth_details",$data);
$panchangDetails = getData("advanced_panchang",$data);
$astroDetails = getData("astro_details",$data);
$planetDetails = getData("planets",$data);
$bhavMadhayaDetails = getData("bhav_madhya",$data);
$kalsarpaDetails = getData("kalsarpa_details",$data);
$mangaldosaDetails = getData("manglik",$data);
$pitraDoshaDetails = getData("pitra_dosha_report",$data);
//Basic Ashtakvarga/sarvashtak
$ashtakvargaDetails = getData("sarvashtak",$data);
//yogini
$majorYoginiDashaDetails = getData("major_yogini_dasha",$data);
$currentYoginiDashaDetails = getData("current_yogini_dasha",$data);
//char dasha
$majorCharDashaDetails = getData("major_chardasha",$data);
$currentCharDashaDetails = getData("current_chardasha",$data);
//Vimshottari
$majorVdashaDetails = getData("major_vdasha",$data);
$currentVdashaDetails = getData("current_vdasha",$data);


function getData($resourceName,$data){
	require_once 'src/VedicRishiClient.php';
$userId = "617029";
$apiKey = "0b2a8bfa1592144fe548e3b2317f896e";
	$vedicRishi = new VedicRishiClient($userId, $apiKey);
	$responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
	///echo $responseData;
	return json_decode($responseData);
	
}

?>

<div class="container marb-75 paddtop50">
    <h2 class="head-h2">Kundali</h2>
  <div class="mr-34"></div>
 

		<div class="col-lg-12">
			
			<div class="accordion" id="accordionExample">
				<div class="card">
					<div class="card-header" id="headingOne">
						<h2 class="clearfix mb-0">
			<a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Charts<i class="material-icons">add</i></a>									
						</h2>
					</div>
					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						<div class="card-body">

                            <table class="table table-striped table-responsive">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>Birth Chart</th>
        <th>chart</th>
       
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>	<form action="#">
							 <div class="form-group">
      <label for="sel1"><b>Birth Chart</b></label>
      <select class="form-control" id="chart">
        <option value="D1" selected="">D1 : For Brith Chart</option>
        <option value="chalit">chalit : For Chalit Chart</option>
        <option value="MOON">MOON : For Moon Chart</option>
        <option value="SUN">SUN : For Sun Chart</option>
         <option value="D2">D2 : For Hora Chart</option>
         <option value="D3">D3 : For Dreshkan Chart</option>
         <option value="D4">D4 : For Chathurthamasha Chart</option>
		<option value="D5">D5 : For Panchmansha Chart</option>
		<option value="D7">D7 : For Saptamansha Chart</option>
		<option value="D8">D8 : For Ashtamansha Chart</option>
		<option value="D9">D9 : For Navamansha Chart</option>
		<option value="D10">D10 : For Dashamansha Chart</option>
		<option value="D12">D12 : For Dwadashamsha chart</option>
		<option value="D16">D16 : For Shodashamsha Chart</option>
		<option value="D20">D20 : For Vishamansha Chart</option>
		<option value="D24">D24 : For Chaturvimshamsha Chart</option>
		<option value="D27">D27 : For Bhamsha Chart</option>
		<option value="D30">D30 : For Trishamansha Chart</option>
		<option value="D40">D40 : For Khavedamsha Chart</option>
		<option value="D45">D45 : For Akshvedansha Chart</option>
		<option value="D60">D60 : For Shashtymsha Chart</option>
      </select>
  </div>
						</form>	</td>

<td>
	<div class="chartcontent">
					</div>
</td>

    </tr>
</tbody>
</table>
</div>				
					</div>
				</div>


				<div class="card">
					<div class="card-header" id="headingTwo">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Basic details <i class="material-icons">add</i></a>
						</h2>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						<div class="card-body">

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="box-shade">
		
<p class="astro-p"><b class="astro-b">
Name&nbsp;:&nbsp; </b>	<?php echo $name; ?></p>

<p class="astro-p"><b class="astro-b">
Date of Brith&nbsp;:&nbsp; </b>	<?php echo $basicDetails->day;?>-<?php echo $basicDetails->month;?>-<?php echo $basicDetails->year;?></p>

<p class="astro-p"><b class="astro-b">
Time of Brith&nbsp;:&nbsp; </b>	<?php echo $basicDetails->hour;?>:<?php echo $basicDetails->minute;?></p>

<p class="astro-p"><b class="astro-b">
Latitude&nbsp;:&nbsp; </b>	<?php echo $basicDetails->latitude;?></p>

<p class="astro-p"><b class="astro-b">
Longitude&nbsp;:&nbsp; </b>	<?php echo $basicDetails->longitude;?></p>

<p class="astro-p"><b class="astro-b">
Timezone&nbsp;:&nbsp; </b>	<?php echo $basicDetails->timezone;?></p>

<p class="astro-p"><b class="astro-b">
Ayanamsha&nbsp;:&nbsp; </b>	<?php echo $basicDetails->ayanamsha;?></p>
</div>
	</div>
	<div class="col-md-4"></div>
</div>

</div>
				</div>
			
</div>

				<div class="card">
					<div class="card-header" id="headingThree">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Panchang Details<i class="material-icons">add</i></a>                     
						</h2>
					</div>
					<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
						
						<div class="card-body">
	<div class="row">
	<div class="col-md-4">
		
<p class="astro-p"><b class="astro-b">
Day&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->day;?></p>

<p class="astro-p"><b class="astro-b">
Sunrise&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->sunrise;?></p>

<p class="astro-p"><b class="astro-b">
Sunset&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->sunset;?></p>
</div>

<div class="col-md-4">
<p class="astro-p"><b class="astro-b">
Moonrise&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->moonrise;?></p>

<p class="astro-p"><b class="astro-b">
Moonset&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->moonset;?></p>

</div>

<div class="col-md-4">
<p class="astro-p"><b class="astro-b">
Vedic Sunset&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->vedic_sunset;?></p>

<p class="astro-p"><b class="astro-b">
Vedic Sunrise&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->vedic_sunrise;?></p>
</div>
	</div>

<br>

<div class="row">
<div class="col-md-4">
	<div class="box-shade">	
		<h2 class="head-red">Tithi</h2>
<p class="astro-p"><b class="astro-b">
Tithi Number&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->tithi->details->tithi_number;?></p>

<p class="astro-p"><b class="astro-b">
Tithi Name&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->tithi->details->tithi_name;?></p>

<p class="astro-p"><b class="astro-b">
Special&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->tithi->details->special;?></p>

<p class="astro-p"><b class="astro-b">
Summary&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->tithi->details->summary;?></p>

<p class="astro-p"><b class="astro-b">
Deity&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->tithi->details->deity;?></p>

<p class="astro-p"><b class="astro-b">
Yog End Time&nbsp;:&nbsp; </b>  <?php echo $panchangDetails->tithi->end_time->hour;?>:<?php echo $panchangDetails->tithi->end_time->minute;?>:<?php echo $panchangDetails->tithi->end_time->second;?></p>

	</div>
</div>
	
<div class="col-md-4">
	<div class="box-shade">	
		<h2 class="head-red">Nakshatra</h2>
<p class="astro-p"><b class="astro-b">
Nakshtra Number&nbsp;:&nbsp; </b><?php echo $panchangDetails->nakshatra->details->nak_number;?></p>

<p class="astro-p"><b class="astro-b">
Nakshatra Name&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->nakshatra->details->nak_name;?></p>

<p class="astro-p"><b class="astro-b">
Special&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->nakshatra->details->special;?></p>

<p class="astro-p"><b class="astro-b">
Summary&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->nakshatra->details->summary;?></p>

<p class="astro-p"><b class="astro-b">
Deity&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->nakshatra->details->deity;?></p>

<p class="astro-p"><b class="astro-b">
Yog End Time&nbsp;:&nbsp; </b>  <?php echo $panchangDetails->nakshatra->end_time->hour;?>:<?php echo $panchangDetails->nakshatra->end_time->minute;?>:<?php echo $panchangDetails->nakshatra->end_time->second;?></p>

	</div>
</div>

<div class="col-md-4">
	<div class="box-shade">	
		<h2 class="head-red">Yog</h2>
<p class="astro-p"><b class="astro-b">
Yog Number&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->yog->details->yog_number;?></p>

<p class="astro-p"><b class="astro-b">
Yog Name&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->yog->details->yog_name;?></p>

<p class="astro-p"><b class="astro-b">
Special&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->yog->details->special;?></p>

<p class="astro-p"><b class="astro-b">
Meaning&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->yog->details->meaning;?></p>


<p class="astro-p"><b class="astro-b">
Yog End Time&nbsp;:&nbsp; </b>	<?php echo $panchangDetails->yog->end_time->hour;?>:<?php echo $panchangDetails->yog->end_time->minute;?>:<?php echo $panchangDetails->yog->end_time->second;?></p>

	</div>
</div>
</div>





<div class="row mt-10">
<div class="col-md-4">
    <div class="box-shade"> 
        <h2 class="head-red">Karan</h2>
<p class="astro-p"><b class="astro-b">
Karan Number&nbsp;:&nbsp; </b>  <?php echo $panchangDetails->karan->details->karan_number;?></p>

<p class="astro-p"><b class="astro-b">
Karan Name&nbsp;:&nbsp; </b>    <?php echo $panchangDetails->karan->details->karan_name;?></p>

<p class="astro-p"><b class="astro-b">
Special&nbsp;:&nbsp; </b>   <?php echo $panchangDetails->karan->details->special;?></p>


<p class="astro-p"><b class="astro-b">
Deity&nbsp;:&nbsp; </b> <?php echo $panchangDetails->karan->details->deity;?></p>

<p class="astro-p"><b class="astro-b">
Karan End Time&nbsp;:&nbsp; </b>  <?php echo $panchangDetails->karan->end_time->hour;?>:<?php echo $panchangDetails->karan->end_time->minute;?>:<?php echo $panchangDetails->karan->end_time->second;?></p>

    </div>
</div>
    
<div class="col-md-4">
    <div class="box-shade"> 
        <h2 class="head-red">Hindu Maah</h2>
<p class="astro-p"><b class="astro-b">
Adhik Status&nbsp;:&nbsp; </b><?php echo $panchangDetails->hindu_maah->adhik_status;?></p>

<p class="astro-p"><b class="astro-b">
Purnimanta&nbsp;:&nbsp; </b><?php echo $panchangDetails->hindu_maah->purnimanta;?></p>

<p class="astro-p"><b class="astro-b">
Amanta&nbsp;:&nbsp; </b><?php echo $panchangDetails->hindu_maah->amanta;?></p>


    </div>
</div>


</div>




<div class="row mt-10">
<div class="col-md-4">
        
<p class="astro-p"><b class="astro-b">
Paksha&nbsp;:&nbsp; </b>   <?php echo $panchangDetails->paksha;?></p>

<p class="astro-p"><b class="astro-b">
Ritu&nbsp;:&nbsp; </b>   <?php echo $panchangDetails->ritu;?></p>

<p class="astro-p"><b class="astro-b">
Sun Sign&nbsp;:&nbsp; </b>    <?php echo $panchangDetails->sun_sign;?></p>

<p class="astro-p"><b class="astro-b">
Moon Sign&nbsp;:&nbsp; </b>    <?php echo $panchangDetails->moon_sign;?></p>

<p class="astro-p"><b class="astro-b">
Ayana&nbsp;:&nbsp; </b>  <?php echo $panchangDetails->ayana;?></p>

</div>

<div class="col-md-4">
<p class="astro-p"><b class="astro-b">
Panchang Yog&nbsp;:&nbsp; </b>   <?php echo $panchangDetails->panchang_yog;?></p>

<p class="astro-p"><b class="astro-b">
Vikram Samvat&nbsp;:&nbsp; </b>  <?php echo $panchangDetails->vikram_samvat;?></p>

<p class="astro-p"><b class="astro-b">
Shaka Samvat&nbsp;:&nbsp; </b>  <?php echo $panchangDetails->shaka_samvat;?></p>

<p class="astro-p"><b class="astro-b">
Shaka Samvat Name&nbsp;:&nbsp; </b> <?php echo $panchangDetails->shaka_samvat_name;?></p>
</div>

<div class="col-md-4">
<p class="astro-p"><b class="astro-b">
Vkram Samvat Name&nbsp;:&nbsp; </b> <?php echo $panchangDetails->vkram_samvat_name;?></p>

<p class="astro-p"><b class="astro-b">
Disha Shool&nbsp;:&nbsp; </b> <?php echo $panchangDetails->disha_shool;?></p>

<p class="astro-p"><b class="astro-b">
Disha Shool Remedies&nbsp;:&nbsp; </b> <?php echo $panchangDetails->disha_shool_remedies;?></p>

<p class="astro-p"><b class="astro-b">
Moon Nivas&nbsp;:&nbsp; </b><?php echo $panchangDetails->hindu_maah->moon_nivas;?></p>
    </div>
</div>




<div class="row mt-10">


    <!-----
<div class="col-md-4">
    <div class="box-shade"> 
        <h2 class="head-red">Nakshatra Shool</h2>
<p class="astro-p"><b class="astro-b">
Directions&nbsp;:&nbsp; </b><?php //echo $panchangDetails->nak_shool;?></p>



    </div>
</div>--->


<div class="col-md-4">
    <div class="box-shade"> 
        <h2 class="head-red">Abhijit Muhurta</h2>
<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $panchangDetails->abhijit_muhurta->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $panchangDetails->abhijit_muhurta->end;?></p>


    </div>
</div>


<div class="col-md-4">
    <div class="box-shade"> 
        <h2 class="head-red">Rahukaal</h2>
<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $panchangDetails->rahukaal->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $panchangDetails->rahukaal->end;?></p>


    </div>
</div>
</div>


<div class="row mt-10">
<div class="col-md-4">
    <div class="box-shade"> 
        <h2 class="head-red">Gulikaal</h2>
<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $panchangDetails->guliKaal->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $panchangDetails->guliKaal->end;?></p>


    </div>
</div>


<div class="col-md-4">
    <div class="box-shade"> 
        <h2 class="head-red">Yamghant kaal</h2>
<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $panchangDetails->yamghant_kaal->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $panchangDetails->yamghant_kaal->end;?></p>

    </div>
</div>
</div>


					</div>
				</div>
</div>


				<div class="card">
					<div class="card-header" id="headingFour">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Astro Details<i class="material-icons">add</i></a>                               
						</h2>
					</div>
					<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
						<div class="card-body">
						
<div class="row mt-10">
<div class="col-md-4">
        
<p class="astro-p"><b class="astro-b">
Varna&nbsp;:&nbsp; </b>   <?php echo $astroDetails->Varna;?></p>

<p class="astro-p"><b class="astro-b">
Vashya&nbsp;:&nbsp; </b>  <?php echo $astroDetails->Vashya;?></p>

<p class="astro-p"><b class="astro-b">
Yoni&nbsp;:&nbsp; </b>    <?php echo $astroDetails->Yoni;?></p>

<p class="astro-p"><b class="astro-b">
Gan&nbsp;:&nbsp; </b>  <?php echo $astroDetails->Gan;?></p>

<p class="astro-p"><b class="astro-b">
Nadi&nbsp;:&nbsp; </b> <?php echo $astroDetails->Nadi;?></p>

<p class="astro-p"><b class="astro-b">
Sign&nbsp;:&nbsp; </b>  <?php echo $astroDetails->sign;?></p>

</div>

<div class="col-md-4">

<p class="astro-p"><b class="astro-b">
Sign Lord&nbsp;:&nbsp; </b> <?php echo $astroDetails->SignLord;?></p>

<p class="astro-p"><b class="astro-b">
Naksahtra&nbsp;:&nbsp; </b> <?php echo $astroDetails->Naksahtra;?></p>

<p class="astro-p"><b class="astro-b">
Naksahtra Lord&nbsp;:&nbsp; </b><?php echo $astroDetails->NaksahtraLord;?></p>

<p class="astro-p"><b class="astro-b">
Charan&nbsp;:&nbsp; </b> <?php echo $astroDetails->Charan;?></p>


<p class="astro-p"><b class="astro-b">
Yunja&nbsp;:&nbsp; </b> <?php echo $astroDetails->yunja;?></p>
</div>

<div class="col-md-4">


<p class="astro-p"><b class="astro-b">
Tatva&nbsp;:&nbsp; </b> <?php echo $astroDetails->tatva;?></p>

<p class="astro-p"><b class="astro-b">
Name Alphabet&nbsp;:&nbsp; </b><?php echo $astroDetails->name_alphabet;?></p>

<p class="astro-p"><b class="astro-b">
Paya&nbsp;:&nbsp; </b><?php echo $astroDetails->paya;?></p>

<p class="astro-p"><b class="astro-b">
Ascendant&nbsp;:&nbsp; </b><?php echo $astroDetails->ascendant;?></p>

<p class="astro-p"><b class="astro-b">
Ascendant Lord&nbsp;:&nbsp; </b><?php echo $astroDetails->ascendant_lord;?></p>


    </div>
</div>


					</div>
				</div>
            </div>


				<div class="card">
					<div class="card-header" id="headingFive">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Planetary Positions<i class="material-icons">add</i></a>                               
						</h2>
					</div>
					<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
						<div class="card-body">


                            <table class="table table-striped table-responsive">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>Planet</th>
        <th>Sign/Degree</th>
        <th>Nakshatra</th>
        <th>Rel</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $planetDetails[0]->name;?></td>
        <td><?php echo $planetDetails[0]->sign;?>&nbsp;<?php echo $planetDetails[0]->fullDegree;?></td>
        <td><?php echo $planetDetails[0]->nakshatra;?></td>
         <td><?php echo $planetDetails[0]->house;?></td>
      </tr>      
      <tr>
        <td><?php echo $planetDetails[1]->name;?></td>
        <td><?php echo $planetDetails[1]->sign;?>&nbsp;<?php echo $planetDetails[1]->fullDegree;?></td>
        <td><?php echo $planetDetails[1]->nakshatra;?></td>
         <td><?php echo $planetDetails[1]->house;?></td>
      </tr> 
     <tr>
        <td><?php echo $planetDetails[2]->name;?></td>
        <td><?php echo $planetDetails[2]->sign;?>&nbsp;<?php echo $planetDetails[2]->fullDegree;?></td>
        <td><?php echo $planetDetails[2]->nakshatra;?></td>
         <td><?php echo $planetDetails[2]->house;?></td>
      </tr> 
     <tr>
        <td><?php echo $planetDetails[3]->name;?></td>
        <td><?php echo $planetDetails[3]->sign;?>&nbsp;<?php echo $planetDetails[3]->fullDegree;?></td>
        <td><?php echo $planetDetails[3]->nakshatra;?></td>
         <td><?php echo $planetDetails[3]->house;?></td>
      </tr> 
      <tr>
        <td><?php echo $planetDetails[4]->name;?></td>
        <td><?php echo $planetDetails[4]->sign;?>&nbsp;<?php echo $planetDetails[4]->fullDegree;?></td>
        <td><?php echo $planetDetails[4]->nakshatra;?></td>
         <td><?php echo $planetDetails[4]->house;?></td>
      </tr> 
     <tr>
        <td><?php echo $planetDetails[5]->name;?></td>
        <td><?php echo $planetDetails[5]->sign;?>&nbsp;<?php echo $planetDetails[5]->fullDegree;?></td>
        <td><?php echo $planetDetails[5]->nakshatra;?></td>
         <td><?php echo $planetDetails[5]->house;?></td>
      </tr> 

       <tr>
        <td><?php echo $planetDetails[6]->name;?></td>
        <td><?php echo $planetDetails[6]->sign;?>&nbsp;<?php echo $planetDetails[6]->fullDegree;?></td>
        <td><?php echo $planetDetails[6]->nakshatra;?></td>
         <td><?php echo $planetDetails[6]->house;?></td>
      </tr> 

       <tr>
        <td><?php echo $planetDetails[7]->name;?></td>
        <td><?php echo $planetDetails[7]->sign;?>&nbsp;<?php echo $planetDetails[7]->fullDegree;?></td>
        <td><?php echo $planetDetails[7]->nakshatra;?></td>
         <td><?php echo $planetDetails[7]->house;?></td>
      </tr> 

       <tr>
        <td><?php echo $planetDetails[8]->name;?></td>
        <td><?php echo $planetDetails[8]->sign;?>&nbsp;<?php echo $planetDetails[8]->fullDegree;?></td>
        <td><?php echo $planetDetails[8]->nakshatra;?></td>
         <td><?php echo $planetDetails[8]->house;?></td>
      </tr> 

       <tr>
        <td><?php echo $planetDetails[9]->name;?></td>
        <td><?php echo $planetDetails[9]->sign;?>&nbsp;<?php echo $planetDetails[9]->fullDegree;?></td>
        <td><?php echo $planetDetails[9]->nakshatra;?></td>
         <td><?php echo $planetDetails[9]->house;?></td>
      </tr> 



   
    </tbody>
  </table>


					</div>
				</div></div>


				<div class="card">
					<div class="card-header" id="headingsix">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Bhav Madhaya<i class="material-icons">add</i></a>                               
						</h2>
					</div>
					<div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
						<div class="card-body">


   <table class="table table-striped table-responsive">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>House</th>
        <th>Bhav Madhya</th>
        <th>Bhav Sandhi</th>
      
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td><?php echo $bhavMadhayaDetails->bhav_madhya[0]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_madhya[0]->norm_degree;?></td>
        <td><?php echo $bhavMadhayaDetails->bhav_sandhi[0]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_sandhi[0]->norm_degree;?></td>
        
      </tr>      
       <tr>
        <td>2</td>
        <td><?php echo $bhavMadhayaDetails->bhav_madhya[1]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_madhya[1]->norm_degree;?></td>
        <td><?php echo $bhavMadhayaDetails->bhav_sandhi[1]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_sandhi[1]->norm_degree;?></td>
        
      </tr> 
      <tr>
        <td>3</td>
        <td><?php echo $bhavMadhayaDetails->bhav_madhya[2]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_madhya[2]->norm_degree;?></td>
        <td><?php echo $bhavMadhayaDetails->bhav_sandhi[2]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_sandhi[2]->norm_degree;?></td>
        
      </tr> 
     <tr>
        <td>4</td>
        <td><?php echo $bhavMadhayaDetails->bhav_madhya[3]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_madhya[3]->norm_degree;?></td>
        <td><?php echo $bhavMadhayaDetails->bhav_sandhi[3]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_sandhi[3]->norm_degree;?></td>
        
      </tr> 
       <tr>
        <td>5</td>
        <td><?php echo $bhavMadhayaDetails->bhav_madhya[4]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_madhya[4]->norm_degree;?></td>
        <td><?php echo $bhavMadhayaDetails->bhav_sandhi[4]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_sandhi[4]->norm_degree;?></td>
        
      </tr> 
      <tr>
        <td>6</td>
        <td><?php echo $bhavMadhayaDetails->bhav_madhya[5]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_madhya[5]->norm_degree;?></td>
        <td><?php echo $bhavMadhayaDetails->bhav_sandhi[5]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_sandhi[5]->norm_degree;?></td>
        
      </tr> 

   <tr>
        <td>7</td>
        <td><?php echo $bhavMadhayaDetails->bhav_madhya[6]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_madhya[6]->norm_degree;?></td>
        <td><?php echo $bhavMadhayaDetails->bhav_sandhi[6]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_sandhi[6]->norm_degree;?></td>
        
      </tr> 

   <tr>
        <td>8</td>
        <td><?php echo $bhavMadhayaDetails->bhav_madhya[7]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_madhya[7]->norm_degree;?></td>
        <td><?php echo $bhavMadhayaDetails->bhav_sandhi[7]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_sandhi[7]->norm_degree;?></td>
        
      </tr> 

      <tr>
        <td>9</td>
        <td><?php echo $bhavMadhayaDetails->bhav_madhya[8]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_madhya[8]->norm_degree;?></td>
        <td><?php echo $bhavMadhayaDetails->bhav_sandhi[8]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_sandhi[8]->norm_degree;?></td>
        
      </tr> 
 <tr>
        <td>10</td>
        <td><?php echo $bhavMadhayaDetails->bhav_madhya[9]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_madhya[9]->norm_degree;?></td>
        <td><?php echo $bhavMadhayaDetails->bhav_sandhi[9]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_sandhi[9]->norm_degree;?></td>
        
      </tr> 
       <tr>
        <td>11</td>
        <td><?php echo $bhavMadhayaDetails->bhav_madhya[10]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_madhya[10]->norm_degree;?></td>
        <td><?php echo $bhavMadhayaDetails->bhav_sandhi[10]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_sandhi[10]->norm_degree;?></td>
        
      </tr> 

       <tr>
        <td>12</td>
        <td><?php echo $bhavMadhayaDetails->bhav_madhya[11]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_madhya[11]->norm_degree;?></td>
        <td><?php echo $bhavMadhayaDetails->bhav_sandhi[11]->sign;?> &nbsp; <?php echo $bhavMadhayaDetails->bhav_sandhi[11]->norm_degree;?></td>
        
      </tr> 

     </tbody>
  </table>
</div>
				</div>
            </div>


				<div class="card">
					<div class="card-header" id="headingseven">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Ashtakvarga<i class="material-icons">add</i></a>                               
						</h2>
					</div>
					<div id="collapseseven" class="collapse" aria-labelledby="headingseven" data-parent="#accordionExample">
						<div class="card-body">
						
						<div>ashtak_varga</div>
						<div>type:        		  <?php echo $ashtakvargaDetails->ashtak_varga->type;?></div>
						<div>sign       <?php echo $ashtakvargaDetails->ashtak_varga->sign;?></div>
						<br>ashtak points
						<div>Aries</div>
						<div>sun:        		  <?php echo $ashtakvargaDetails->ashtak_points->aries->sun;?></div>
						<div>moon       <?php echo $ashtakvargaDetails->ashtak_points->aries->moon;?></div>
						<div>mars:        		  <?php echo $ashtakvargaDetails->ashtak_points->aries->sun;?></div>
						<div>mercury       <?php echo $ashtakvargaDetails->ashtak_points->aries->mercury;?></div>
					</div>
				</div>
</div>

				<div class="card">
					<div class="card-header" id="headingeight">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseeight" aria-expanded="false" aria-controls="collapseeight"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Vimshottari<i class="material-icons">add</i></a>                               
						</h2>
					</div>
<div id="collapseeight" class="collapse" aria-labelledby="headingeight" data-parent="#accordionExample">
						<div class="card-body">

<div class="row">
<div class="col-md-6">
     <table class="table table-striped">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>Major</th>
        
      </tr>
    </thead>
</table>

      <table class="table table-striped">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      
    </thead>
    <tbody>
      <tr>
        <td><?php echo $majorVdashaDetails[0]->planet;?></td>

        <td><?php echo $majorVdashaDetails[0]->start;?></td>
        <td><?php echo $majorVdashaDetails[0]->end;?></td>
       
      </tr>   

      <tr>
        <td><?php echo $majorVdashaDetails[1]->planet;?></td>

        <td><?php echo $majorVdashaDetails[1]->start;?></td>
        <td><?php echo $majorVdashaDetails[1]->end;?></td>
       
      </tr>   

       <tr>
        <td><?php echo $majorVdashaDetails[2]->planet;?></td>

        <td><?php echo $majorVdashaDetails[2]->start;?></td>
        <td><?php echo $majorVdashaDetails[2]->end;?></td>
       
      </tr>   

         <tr>
        <td><?php echo $majorVdashaDetails[3]->planet;?></td>

        <td><?php echo $majorVdashaDetails[3]->start;?></td>
        <td><?php echo $majorVdashaDetails[3]->end;?></td>
       
      </tr>  


             <tr>
        <td><?php echo $majorVdashaDetails[4]->planet;?></td>

        <td><?php echo $majorVdashaDetails[4]->start;?></td>
        <td><?php echo $majorVdashaDetails[4]->end;?></td>
       
      </tr> 


    <tr>
        <td><?php echo $majorVdashaDetails[5]->planet;?></td>

        <td><?php echo $majorVdashaDetails[5]->start;?></td>
        <td><?php echo $majorVdashaDetails[5]->end;?></td>
       
      </tr> 


    <tr>
        <td><?php echo $majorVdashaDetails[6]->planet;?></td>

        <td><?php echo $majorVdashaDetails[6]->start;?></td>
        <td><?php echo $majorVdashaDetails[6]->end;?></td>
       
      </tr> 

         <tr>
        <td><?php echo $majorVdashaDetails[7]->planet;?></td>

        <td><?php echo $majorVdashaDetails[7]->start;?></td>
        <td><?php echo $majorVdashaDetails[7]->end;?></td>
       
      </tr> 

            <tr>
        <td><?php echo $majorVdashaDetails[8]->planet;?></td>

        <td><?php echo $majorVdashaDetails[8]->start;?></td>
        <td><?php echo $majorVdashaDetails[8]->end;?></td>
       
      </tr> 
     
    </tbody>
  </table>    
</div>

<div class="col-md-6">
 <table class="table table-striped">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>Current</th>
        
      </tr>
    </thead>
</table>
    <div class="row">
        <div class="col-md-6">
            <div class="box-shade">
                <h2 class="head-red1">Major Vimshottari Dasha</h2>
    <p class="astro-p"><b class="astro-b">
Planet&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->major->planet;?></p>

<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->major->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->major->end;?></p>

            </div>

        </div>

         <div class="col-md-6">
            <div class="box-shade">
                 <h2 class="head-red1">Antardasha</h2>
    <p class="astro-p"><b class="astro-b">
Planet&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->minor->planet;?></p>

<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->minor->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->minor->end;?></p>

            </div>

        </div>
    </div>
 <div class="row mt-10">
        <div class="col-md-6">
            <div class="box-shade">
                 <h2 class="head-red1">Pratyantardasha</h2>
    <p class="astro-p"><b class="astro-b">
Planet&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_minor->planet;?></p>

<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_minor->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_minor->end;?></p>

            </div>

        </div>

        <div class="col-md-6">
            <div class="box-shade">
                 <h2 class="head-red1">Sookshmadasha</h2>
    <p class="astro-p"><b class="astro-b">
Planet&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_sub_minor->planet;?></p>

<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_sub_minor->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_sub_minor->end;?></p>

            </div>

        </div>
         <div class="col-md-6 mt-10">
            <div class="box-shade">
                 <h2 class="head-red1">Pranadasha</h2>
    <p class="astro-p"><b class="astro-b">
Planet&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_sub_sub_minor->planet;?></p>

<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_sub_sub_minor->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_sub_sub_minor->end;?></p>

            </div>

        </div>
    </div>

   
     
</div>
                           
						
					</div>
				</div>
                 </div>
            </div>

				<div class="card">
					<div class="card-header" id="headingnine">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsenine" aria-expanded="false" aria-controls="collapsenine"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Char Dasha<i class="material-icons">add</i></a>                               
						</h2>
					</div>
					<div id="collapsenine" class="collapse" aria-labelledby="headingnine" data-parent="#accordionExample">
                        <div class="card-body">

<div class="row">
<div class="col-md-6">
     <table class="table table-striped table-responsive">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>Major Dasha</th>
        
      </tr>
    </thead>
</table>

      <table class="table table-striped">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      
    </thead>
    <tbody>
      <tr>
        <td><?php echo $majorCharDashaDetails[0]->sign_name;?></td>
        <td><?php echo $majorCharDashaDetails[0]->start_date;?></td>
        <td><?php echo $majorCharDashaDetails[0]->end_date;?></td>
        <td><?php echo $majorCharDashaDetails[0]->duration;?></td>
       
      </tr>   

   <tr>
        <td><?php echo $majorCharDashaDetails[1]->sign_name;?></td>
        <td><?php echo $majorCharDashaDetails[1]->start_date;?></td>
        <td><?php echo $majorCharDashaDetails[1]->end_date;?></td>
        <td><?php echo $majorCharDashaDetails[1]->duration;?></td>
       
      </tr>   

   <tr>
        <td><?php echo $majorCharDashaDetails[2]->sign_name;?></td>
        <td><?php echo $majorCharDashaDetails[2]->start_date;?></td>
        <td><?php echo $majorCharDashaDetails[2]->end_date;?></td>
        <td><?php echo $majorCharDashaDetails[2]->duration;?></td>
       
      </tr>   

<tr>
        <td><?php echo $majorCharDashaDetails[3]->sign_name;?></td>
        <td><?php echo $majorCharDashaDetails[3]->start_date;?></td>
        <td><?php echo $majorCharDashaDetails[3]->end_date;?></td>
        <td><?php echo $majorCharDashaDetails[3]->duration;?></td>
       
      </tr>  


<tr>
        <td><?php echo $majorCharDashaDetails[4]->sign_name;?></td>
        <td><?php echo $majorCharDashaDetails[4]->start_date;?></td>
        <td><?php echo $majorCharDashaDetails[4]->end_date;?></td>
        <td><?php echo $majorCharDashaDetails[4]->duration;?></td>
       
      </tr> 

<tr>
        <td><?php echo $majorCharDashaDetails[5]->sign_name;?></td>
        <td><?php echo $majorCharDashaDetails[5]->start_date;?></td>
        <td><?php echo $majorCharDashaDetails[5]->end_date;?></td>
        <td><?php echo $majorCharDashaDetails[5]->duration;?></td>
       
      </tr> 


<tr>
        <td><?php echo $majorCharDashaDetails[6]->sign_name;?></td>
        <td><?php echo $majorCharDashaDetails[6]->start_date;?></td>
        <td><?php echo $majorCharDashaDetails[6]->end_date;?></td>
        <td><?php echo $majorCharDashaDetails[6]->duration;?></td>
       
      </tr> 

<tr>
        <td><?php echo $majorCharDashaDetails[7]->sign_name;?></td>
        <td><?php echo $majorCharDashaDetails[7]->start_date;?></td>
        <td><?php echo $majorCharDashaDetails[7]->end_date;?></td>
        <td><?php echo $majorCharDashaDetails[7]->duration;?></td>
       
      </tr> 

<tr>
        <td><?php echo $majorCharDashaDetails[8]->sign_name;?></td>
        <td><?php echo $majorCharDashaDetails[8]->start_date;?></td>
        <td><?php echo $majorCharDashaDetails[8]->end_date;?></td>
        <td><?php echo $majorCharDashaDetails[8]->duration;?></td>
       
      </tr> 

      <tr>
        <td><?php echo $majorCharDashaDetails[9]->sign_name;?></td>
        <td><?php echo $majorCharDashaDetails[9]->start_date;?></td>
        <td><?php echo $majorCharDashaDetails[9]->end_date;?></td>
        <td><?php echo $majorCharDashaDetails[9]->duration;?></td>
       
      </tr> 

      <tr>
        <td><?php echo $majorCharDashaDetails[10]->sign_name;?></td>
        <td><?php echo $majorCharDashaDetails[10]->start_date;?></td>
        <td><?php echo $majorCharDashaDetails[10]->end_date;?></td>
        <td><?php echo $majorCharDashaDetails[10]->duration;?></td>
       
      </tr> 

      <tr>
        <td><?php echo $majorCharDashaDetails[11]->sign_name;?></td>
        <td><?php echo $majorCharDashaDetails[11]->start_date;?></td>
        <td><?php echo $majorCharDashaDetails[11]->end_date;?></td>
        <td><?php echo $majorCharDashaDetails[11]->duration;?></td>
       
      </tr> 
     
    </tbody>
  </table>    
</div>

<div class="col-md-6">
 <table class="table table-striped">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>Current Dasha</th>
        
      </tr>
    </thead>
</table>
    <div class="row">
        <div class="col-md-6">
            <div class="box-shade">
                <h2 class="head-red1">Major Charshottari Dasha</h2>
    <p class="astro-p"><b class="astro-b">
Sign&nbsp;:&nbsp; </b><?php echo $currentCharDashaDetails->major_dasha->sign_name;?></p>

<p class="astro-p"><b class="astro-b">
Start Date&nbsp;:&nbsp; </b><?php echo $currentCharDashaDetails->major_dasha->start_date;?></p>

<p class="astro-p"><b class="astro-b">
End Date&nbsp;:&nbsp; </b><?php echo $currentCharDashaDetails->major_dasha->end_date;?></p>

<p class="astro-p"><b class="astro-b">
Duration&nbsp;:&nbsp; </b><?php echo $currentCharDashaDetails->major_dasha->duration;?></p>

            </div>

        </div>

         <div class="col-md-6">
            <div class="box-shade">
                 <h2 class="head-red1">Antardasha</h2>
    <p class="astro-p"><b class="astro-b">
Planet&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->minor->planet;?></p>

<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->minor->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->minor->end;?></p>

            </div>

        </div>
    </div>
 <div class="row mt-10">
        <div class="col-md-6">
            <div class="box-shade">
                 <h2 class="head-red1">Pratyantardasha</h2>
    <p class="astro-p"><b class="astro-b">
Planet&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_minor->planet;?></p>

<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_minor->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_minor->end;?></p>

            </div>

        </div>

        <div class="col-md-6">
            <div class="box-shade">
                 <h2 class="head-red1">Sookshmadasha</h2>
    <p class="astro-p"><b class="astro-b">
Planet&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_sub_minor->planet;?></p>

<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_sub_minor->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_sub_minor->end;?></p>

            </div>

        </div>
         <div class="col-md-6 mt-10">
            <div class="box-shade">
                 <h2 class="head-red1">Pranadasha</h2>
    <p class="astro-p"><b class="astro-b">
Planet&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_sub_sub_minor->planet;?></p>

<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_sub_sub_minor->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $currentVdashaDetails->sub_sub_sub_minor->end;?></p>

            </div>

        </div>
    </div>

   
     
</div>
                           
                        
                    </div>
                </div>

				</div>
            </div>


<div class="card">
					<div class="card-header" id="headinten">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseten" aria-expanded="false" aria-controls="collapseten"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Yogini dasha<i class="material-icons">add</i></a>                               
						</h2>
					</div>
					<div id="collapseten" class="collapse" aria-labelledby="headingten" data-parent="#accordionExample">


  <div class="card-body">

<div class="row">
<div class="col-md-6">
     <table class="table table-striped table-responsive">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>Major Yogini Dasha</th>
        
      </tr>
    </thead>
</table>

      <table class="table table-striped">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      
    </thead>
    <tbody>
      <tr>
        <td><?php echo $majorYoginiDashaDetails[0]->dasha_name;?></td>
        <td><?php echo $majorYoginiDashaDetails[0]->start_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[0]->end_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[0]->duration;?></td>
       
      </tr>   

   <tr>
        <td><?php echo $majorYoginiDashaDetails[1]->dasha_name;?></td>
        <td><?php echo $majorYoginiDashaDetails[1]->start_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[1]->end_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[1]->duration;?></td>
       
      </tr>   

   <tr>
        <td><?php echo $majorYoginiDashaDetails[2]->dasha_name;?></td>
        <td><?php echo $majorYoginiDashaDetails[2]->start_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[2]->end_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[2]->duration;?></td>
       
      </tr>   

<tr>
        <td><?php echo $majorYoginiDashaDetails[3]->dasha_name;?></td>
        <td><?php echo $majorYoginiDashaDetails[3]->start_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[3]->end_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[3]->duration;?></td>
       
      </tr>  


<tr>
        <td><?php echo $majorYoginiDashaDetails[4]->dasha_name;?></td>
        <td><?php echo $majorYoginiDashaDetails[4]->start_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[4]->end_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[4]->duration;?></td>
       
      </tr> 

<tr>
        <td><?php echo $majorYoginiDashaDetails[5]->dasha_name;?></td>
        <td><?php echo $majorYoginiDashaDetails[5]->start_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[5]->end_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[5]->duration;?></td>
       
      </tr> 


<tr>
        <td><?php echo $majorYoginiDashaDetails[6]->dasha_name;?></td>
        <td><?php echo $majorYoginiDashaDetails[6]->start_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[6]->end_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[6]->duration;?></td>
       
      </tr> 

<tr>
        <td><?php echo $majorYoginiDashaDetails[7]->dasha_name;?></td>
        <td><?php echo $majorYoginiDashaDetails[7]->start_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[7]->end_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[7]->duration;?></td>
       
      </tr> 

<tr>
        <td><?php echo $majorYoginiDashaDetails[8]->dasha_name;?></td>
        <td><?php echo $majorYoginiDashaDetails[8]->start_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[8]->end_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[8]->duration;?></td>
       
      </tr> 

      <tr>
        <td><?php echo $majorYoginiDashaDetails[9]->dasha_name;?></td>
        <td><?php echo $majorYoginiDashaDetails[9]->start_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[9]->end_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[9]->duration;?></td>
       
      </tr> 

      <tr>
        <td><?php echo $majorYoginiDashaDetails[10]->dasha_name;?></td>
        <td><?php echo $majorYoginiDashaDetails[10]->start_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[10]->end_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[10]->duration;?></td>
       
      </tr> 

      <tr>
        <td><?php echo $majorYoginiDashaDetails[11]->dasha_name;?></td>
        <td><?php echo $majorYoginiDashaDetails[11]->start_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[11]->end_date;?></td>
        <td><?php echo $majorYoginiDashaDetails[11]->duration;?></td>
       
      </tr> 
     
    </tbody>
  </table>    
</div>

<div class="col-md-6">
 <table class="table table-striped">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>Current Dasha</th>
        
      </tr>
    </thead>
</table>
    <div class="row">
        <div class="col-md-6">
            <div class="box-shade">
                <h2 class="head-red1">Major Charshottari Dasha</h2>
    <p class="astro-p"><b class="astro-b">
Sign&nbsp;:&nbsp; </b><?php echo $currentYoginiDashaDetails->major_dasha->dasha_name;?></p>

<p class="astro-p"><b class="astro-b">
Start Date&nbsp;:&nbsp; </b><?php echo $currentYoginiDashaDetails->major_dasha->start_date;?></p>

<p class="astro-p"><b class="astro-b">
End Date&nbsp;:&nbsp; </b><?php echo $currentYoginiDashaDetails->major_dasha->end_date;?></p>

<p class="astro-p"><b class="astro-b">
Duration&nbsp;:&nbsp; </b><?php echo $currentYoginiDashaDetails->major_dasha->duration;?></p>

            </div>

        </div>

         <div class="col-md-6">
            <div class="box-shade">
                 <h2 class="head-red1">Antardasha</h2>
    <p class="astro-p"><b class="astro-b">
Planet&nbsp;:&nbsp; </b><?php echo $currentYoginiDashaDetails->sub_dasha->planet;?></p>

<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $currentYoginiDashaDetails->sub_dasha->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $currentYoginiDashaDetails->sub_dasha->end;?></p>

            </div>

        </div>
    </div>
 <div class="row mt-10">
        <div class="col-md-6">
            <div class="box-shade">
                 <h2 class="head-red1">Pratyantardasha</h2>
    <p class="astro-p"><b class="astro-b">
Planet&nbsp;:&nbsp; </b><?php echo $currentYoginiDashaDetails->sub_sub_dasha->planet;?></p>

<p class="astro-p"><b class="astro-b">
Start&nbsp;:&nbsp; </b><?php echo $currentYoginiDashaDetails->sub_sub_dasha->start;?></p>

<p class="astro-p"><b class="astro-b">
End&nbsp;:&nbsp; </b><?php echo $currentYoginiDashaDetails->sub_sub_dasha->end;?></p>

            </div>

        </div>

    
         
    </div>

   
     
</div>
                           
                        
                    </div>
                </div>


					</div>
				</div>


				<div class="card">
					<div class="card-header" id="heading11">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Kal sarp dosha<i class="material-icons">add</i></a>                               
						</h2>
					</div>
					<div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#accordionExample">
						<div class="card-body">
<p class="astro-p"><b class="astro-b">
Analysis&nbsp;:&nbsp; </b><?php echo $kalsarpaDetails->one_line;?></p>

<p class="astro-p"><b class="astro-b">
Effect&nbsp;:&nbsp; </b><?php echo $kalsarpaDetails->type;?></p>

<p class="astro-p"><b class="astro-b">
Report&nbsp;:&nbsp; </b><?php echo $kalsarpaDetails->report->report;?></p>


				</div>
			</div>
        </div>



				<div class="card">
					<div class="card-header" id="heading12">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse12" aria-expanded="false" aria-controls="collapse12"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Mangal Dosha<i class="material-icons">add</i></a>                               
						</h2>
					</div>
					<div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#accordionExample">
						<div class="card-body">
                            <p class="astro-p"><b class="astro-b">
Analysis&nbsp;:&nbsp; </b><?php echo $mangaldosaDetails->manglik_report;?></p>

 <p class="astro-p"><b class="astro-b">
Status&nbsp;:&nbsp; </b><?php echo $mangaldosaDetails->manglik_status;?></p>


 <p class="astro-p"><b class="astro-b">
Percentage&nbsp;:&nbsp; </b><?php echo $mangaldosaDetails->percentage_manglik_present;?></p>

<b class="astro-b" style="color: #000;">
Mangalik Present Rule</b>

<b class="astro-b" style="color: #000; font-size: font-size:17px;">
Based on Aspect :</b>
<br>
 <p class="astro-p"><?php echo $mangaldosaDetails->manglik_present_rule->based_on_aspect[0];?></p>
 <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_aspect[1]?></p>
  <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_aspect[2]?></p>
   <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_aspect[3]?></p>
    <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_aspect[4]?></p>
     <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_aspect[5]?></p>
      <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_aspect[6]?></p>
       <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_aspect[7]?></p>
     <br>


<b class="astro-b" style="color: #000; font-size: font-size:17px;">
Based on House :</b>
<br>
 <p class="astro-p"><?php echo $mangaldosaDetails->manglik_present_rule->based_on_house[0];?></p>
 <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_house[1]?></p>
  <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_house[2]?></p>
   <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_house[3]?></p>
    <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_house[4]?></p>
     <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_house[5]?></p>
      <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_house[6]?></p>
       <p class="astro-p"> <?php echo $mangaldosaDetails->manglik_present_rule->based_on_house[7]?></p>


					</div>
				</div>
            </div>


					<div class="card">
					<div class="card-header" id="heading13">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse13" aria-expanded="false" aria-controls="collapse13"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Pitra Dosha<i class="material-icons">add</i></a>                               
						</h2>
					</div>
					<div id="collapse13" class="collapse" aria-labelledby="heading13" data-parent="#accordionExample">
						<div class="card-body">
<b class="astro-b">
What is Pitri Dosha</b>
<p class="astro-p"><?php echo $pitraDoshaDetails->what_is_pitri_dosha;?></p>

<b class="astro-b">
Conclusion</b>
<p class="astro-p"><?php echo $pitraDoshaDetails->conclusion;?></p>

<b class="astro-b">
Remedies</b>
<p class="astro-p"><?php echo $pitraDoshaDetails->remedies;?></p>

<b class="astro-b">
Effects</b>
<p class="astro-p"><?php echo $pitraDoshaDetails->effects;?></p>


					</div>
					
				</div>
            </div>


			</div>
		</div>


</div>


<script>
$(document).ready(function(){
	// Add minus icon for collapse element which is open by default
	$(".collapse.show").each(function(){
		$(this).siblings(".card-header").find(".btn i").html("remove");
		$(this).prev(".card-header").addClass("highlight");
	});
	
	// Toggle plus minus icon on show hide of collapse element
	$(".collapse").on('show.bs.collapse', function(){
		$(this).parent().find(".card-header .btn i").html("remove");
	}).on('hide.bs.collapse', function(){
		$(this).parent().find(".card-header .btn i").html("add");
	});
});

</script>
<?php include 'footer.php';?>
<script>
$(document).ready(function(){
	$.ajax({
        url: '#',
        type: 'post',
        data: { "chartid": 'D1',"data":<?php echo json_encode($data);?>},
        success: function(response) {
			console.log(response);
			var svg = jQuery.parseJSON(response)
			$('.chartcontent').html(svg['svg']); }
    });
$('#chart').on('change', function() {
  var value = $(this).val();
  console.log(value);
  $.ajax({
        url: '#',
        type: 'post',
        data: { "chartid": value,"data":<?php echo json_encode($data);?>},
        success: function(response) {
			console.log(response);
			var svg = jQuery.parseJSON(response)
			$('.chartcontent').html(svg['svg']); }
    });
});
});
</script>

