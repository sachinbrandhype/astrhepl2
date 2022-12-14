<?php
// $data = array(
//   'date' => 25,
//   'month' => 12,
//   'year' => 1988,
//   'hour' => 4,
//  'minute' => 0,
//   'latitude' => 25.123,
//   'longitude' => 82.34,
//   'timezone' => 5.5
//  );

if (isset($_POST['chartid'])) {
    echo (json_encode(getData('horo_chart_image/'.$_POST['chartid'],$_POST['data'])));
    exit();
}?>
<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<?php
// echo "<pre>";
// print_r($_POST); die;
$name = $_POST['fullname'];
$time =explode(":",$_POST['m-time']);
$ftime =explode(":",$_POST['f-time']);
if ($_POST['web']) {
    $data = array(
        'date' => $_POST['m-date'],
        'month' => $_POST['m-month'],
        'year' => $_POST['m-year'],
        'hour' => $_POST['m-hour'],
        'minute' => $_POST['m-minute'],
        'latitude' =>$_POST['m-latitude'],
        'longitude' => $_POST['m-longitude'],
        'timezone' => 5.5
        );


        $femaledata = array(
        'date' => $_POST['f-date'],
        'month' => $_POST['f-month'],
        'year' => $_POST['f-year'],
        'hour' => $_POST['f-hours'],
        'minute' => $_POST['f-minute'],
        'latitude' =>$_POST['f-latitude'],
         'longitude' => $_POST['f-longitude'],
        'timezone' => 5.5,
        );

}
else{
    $data = array(
    'date' => (int)date("d",strtotime($_POST['m-date'])),
    'month' => (int)date("m",strtotime($_POST['m-date'])),
    'year' => (int)date("Y",strtotime($_POST['m-date'])),
    'hour' => $time[0],
    'minute' => $time[1],
    'latitude' =>$_POST['m-latitude'],
    'longitude' => $_POST['m-longitude'],
    'timezone' => 5.5
    );


    $femaledata = array(
    'date' => (int)date("d",strtotime($_POST['f-date'])),
    'month' => (int)date("m",strtotime($_POST['f-date'])),
    'year' => (int)date("Y",strtotime($_POST['f-date'])),
    'hour' => $ftime[0],
    'minute' => $ftime[1],
    'latitude' => $_POST['f-latitude'],
    'longitude' => $_POST['f-longitude'],
    'timezone' => 5.5,
);

}
// echo "<pre>";
// print_r($data); 
// echo "<pre>";
// print_r($femaledata); die;

$match_birth_details = getData("matchBirthDetails",$data,$femaledata);

 $match_astro_details = getData("matchAstroDetails",$data,$femaledata);

 $match_ashtakoot_points = getData("matchAshtakootPoints",$data,$femaledata);

 $match_obstructions = getData("matchObstructions",$data,$femaledata);


 $match_planet_details = getData("matchPlanetDetails",$data,$femaledata);

 $match_manglik_report = getData("getMatchManglikReport",$data,$femaledata);

//     echo "<pre>";
// print_r($match_manglik_report); die;

 $match_making_report = getData("getMatchMakingReport",$data,$femaledata);
 $match_simple_report = getData("getMatchSimpleReport",$data,$femaledata);
//   $match_making_detailed_report = getData("getmatchMakingDetailedReport",$data,$femaledata);
//  $match_dashakoot_points = getData("match_dashakoot_points",$data,$femaledata);
// $match_percentage = getData("match_percentage",$data);
// $custom_match_profiles = getData("custom_match_profiles",$data);
// $papasamyam_details = getData("papasamyam_details",$data);
// $custom_match_profiles_xml = getData("custom_match_profiles_xml",$data);


function getData($resourceName, $data, $femaleData){
    require_once 'src/VedicRishiClient.php';
$userId = "617029";
$apiKey = "0b2a8bfa1592144fe548e3b2317f896e";
    $vedicRishi = new VedicRishiClient($userId, $apiKey);
    $responseData  = $vedicRishi->$resourceName($data, $femaleData);
    // $responseData = $vedicRishi->call($resourceName,
    // $data['m-day'], 
    // $data['m-month'],
    // $data['m-year'],
    // $data['m-hour'],
    // $data['m-min'],
    // $data['m-lat'], 
    // $data['m-lon'],
    // $data['m-tzone'],
    //   $data['f-day'], 
    // $data['f-month'],
    // $data['f-year'],
    // $data['f-hour'],
    // $data['f-min'],
    // $data['f-lat'], 
    // $data['f-lon'],
    // $data['f-tzone']
    // );
    ///echo $responseData;
    return json_decode($responseData);
    
}

?>

<div class="container marb-75 paddtop50">
    <h2 class="head-h2">Match Making</h2>
    <br><br>
 

        <div class="col-lg-12">
            
            <div class="accordion" id="accordionExample">
            


                <div class="card" style="display: none;">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Match Birth Details<i class="material-icons">add</i></a>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
<br>
<p class="text-center"><?php
echo "male ---> ";
 echo '<br>year        '.$match_birth_details->male_astro_details->year;
    echo '<br>gender        '.$match_birth_details->male_astro_details->gender;
    echo "female ---> ";
 echo '<br>year        '.$match_birth_details->female_astro_details->month;
    echo '<br>gender        '.$match_birth_details->demale_astro_details->ayanamsha;
?></p>

</div>
                </div>
            
</div>

                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Match Ashtakoot Points<i class="material-icons">add</i></a>                     
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        
                        <div class="card-body">


                          <div class="row">
 
  <div class="col-md-6">
    <div class="box-shade">
    <center>Varna</center>
<p class="astro-p"><b class="astro-b">
Description&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->varna->description; ?></p>


<p class="astro-p"><b class="astro-b">
Male Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->varna->male_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Female Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->varna->female_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Total Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->varna->total_points; ?></p>


<p class="astro-p"><b class="astro-b">
Received Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->varna->received_points; ?></p>



</div>
  </div>



  <div class="col-md-6">
    <div class="box-shade">
    <center>Vashya</center>
<p class="astro-p"><b class="astro-b">
Description&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->vashya->description; ?></p>


<p class="astro-p"><b class="astro-b">
Male Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->vashya->male_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Female Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->vashya->female_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Total Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->vashya->total_points; ?></p>


<p class="astro-p"><b class="astro-b">
Received Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->vashya->received_points; ?></p>



</div>
  </div>


  <div class="col-md-6">
    <div class="box-shade">
    <center>Tara</center>
<p class="astro-p"><b class="astro-b">
Description&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->tara->description; ?></p>


<p class="astro-p"><b class="astro-b">
Male Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->tara->male_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Female Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->tara->female_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Total Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->tara->total_points; ?></p>


<p class="astro-p"><b class="astro-b">
Received Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->tara->received_points; ?></p>



</div>
  </div>

  <div class="col-md-6">
    <div class="box-shade">
    <center>Yoni</center>
<p class="astro-p"><b class="astro-b">
Description&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->yoni->description; ?></p>


<p class="astro-p"><b class="astro-b">
Male Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->yoni->male_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Female Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->yoni->female_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Total Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->yoni->total_points; ?></p>


<p class="astro-p"><b class="astro-b">
Received Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->yoni->received_points; ?></p>



</div>
  </div>
  <div class="col-md-6">
    <div class="box-shade">
    <center>Maitri</center>
<p class="astro-p"><b class="astro-b">
Description&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->maitri->description; ?></p>


<p class="astro-p"><b class="astro-b">
Male Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->maitri->male_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Female Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->maitri->female_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Total Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->maitri->total_points; ?></p>


<p class="astro-p"><b class="astro-b">
Received Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->maitri->received_points; ?></p>



</div>
  </div>

  <div class="col-md-6">
    <div class="box-shade">
    <center>Gan</center>
<p class="astro-p"><b class="astro-b">
Description&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->gan->description; ?></p>


<p class="astro-p"><b class="astro-b">
Male Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->gan->male_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Female Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->gan->female_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Total Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->gan->total_points; ?></p>


<p class="astro-p"><b class="astro-b">
Received Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->gan->received_points; ?></p>



</div>
  </div>



  
  <div class="col-md-6">
    <div class="box-shade">
    <center>Bhakut</center>
<p class="astro-p"><b class="astro-b">
Description&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->bhakut->description; ?></p>


<p class="astro-p"><b class="astro-b">
Male Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->bhakut->male_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Female Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->bhakut->female_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Total Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->bhakut->total_points; ?></p>


<p class="astro-p"><b class="astro-b">
Received Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->bhakut->received_points; ?></p>



</div>
  </div>

  
  <div class="col-md-6">
    <div class="box-shade">
    <center>Nadi</center>
<p class="astro-p"><b class="astro-b">
Description&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->nadi->description; ?></p>


<p class="astro-p"><b class="astro-b">
Male Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->nadi->male_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Female Koot Attribute&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->nadi->female_koot_attribute; ?></p>


<p class="astro-p"><b class="astro-b">
Total Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->nadi->total_points; ?></p>


<p class="astro-p"><b class="astro-b">
Received Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->nadi->received_points; ?></p>



</div>
  </div>


  <div class="col-md-6">
    <div class="box-shade">
    <center>Total</center>
<p class="astro-p"><b class="astro-b">
Total Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->total->total_points; ?></p>


<p class="astro-p"><b class="astro-b">
Received Points&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->total->received_points; ?></p>


<p class="astro-p"><b class="astro-b">
Minimum Required&nbsp;:&nbsp; </b>  <?php echo $match_ashtakoot_points->total->minimum_required; ?></p>




</div>
  </div>

  <div class="col-md-12">
    <div class="box-shade">
    <center>Conclusion</center>
<p class="astro-p"><b class="astro-b">
Report&nbsp;:&nbsp; </b>  <?php echo  $match_ashtakoot_points->conclusion->report; ?></p>





</div>
  </div>


  
</div>



                    </div>
                </div>
</div>


                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Match Obstructions<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">

                           <div class="col-md-12">
    <div class="box-shade">
    <center>Match Obstructions</center>

    <p class="astro-p"><b class="astro-b">
Vedha Report&nbsp;:&nbsp; </b>  <?php echo  $match_obstructions->vedha_report; ?></p>



<p class="astro-p"><b class="astro-b">
Is Present&nbsp;:&nbsp; </b>  <?php echo  $match_obstructions->is_present; ?></p>






</div>
  </div>



            

                    </div>
                </div>
            </div>


                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Match Astro Details<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">


<div class="row">
  <div class="col-md-6">
    
     <div class="box-shade">
      <center>Male Data</center>
    
<p class="astro-p"><b class="astro-b">
Ascendant&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->ascendant; ?></p>

    
<p class="astro-p"><b class="astro-b">
Varna&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->Varna; ?></p>

    
<p class="astro-p"><b class="astro-b">
Vashya&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->Vashya; ?></p>

    
<p class="astro-p"><b class="astro-b">
Yoni&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->Yoni; ?></p>

    
<p class="astro-p"><b class="astro-b">
Gan&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->Gan; ?></p>

    
<p class="astro-p"><b class="astro-b">
Nadi&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->Nadi; ?></p>

    
<p class="astro-p"><b class="astro-b">
SignLord&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->SignLord; ?></p>

    
<p class="astro-p"><b class="astro-b">
Sign&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->sign; ?></p>

    
<p class="astro-p"><b class="astro-b">
Naksahtra&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->Naksahtra; ?></p>

    
<p class="astro-p"><b class="astro-b">
NaksahtraLord&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->NaksahtraLord; ?></p>

    
<p class="astro-p"><b class="astro-b">
Charan&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->Charan; ?></p>

    
<p class="astro-p"><b class="astro-b">
Yog&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->Yog; ?></p>

    
<p class="astro-p"><b class="astro-b">
Karan&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->Karan; ?></p>

    
<p class="astro-p"><b class="astro-b">
Tithi&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->Tithi; ?></p>

    
<p class="astro-p"><b class="astro-b">
Yunja&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->yunja; ?></p>

    
<p class="astro-p"><b class="astro-b">
Tatva&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->tatva; ?></p>
  
<p class="astro-p"><b class="astro-b">
Name Alphabet&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->name_alphabet; ?></p>
  
<p class="astro-p"><b class="astro-b">
Paya&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->male_astro_details->paya; ?></p>


</div>

  </div>
  <div class="col-md-6">
    <div class="box-shade">
       <center>Female Data</center>
<p class="astro-p"><b class="astro-b">
Ascendant&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->ascendant; ?></p>

    
<p class="astro-p"><b class="astro-b">
Varna&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->Varna; ?></p>

    
<p class="astro-p"><b class="astro-b">
Vashya&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->Vashya; ?></p>

    
<p class="astro-p"><b class="astro-b">
Yoni&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->Yoni; ?></p>

    
<p class="astro-p"><b class="astro-b">
Gan&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->Gan; ?></p>

    
<p class="astro-p"><b class="astro-b">
Nadi&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->Nadi; ?></p>

    
<p class="astro-p"><b class="astro-b">
SignLord&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->SignLord; ?></p>

    
<p class="astro-p"><b class="astro-b">
Sign&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->sign; ?></p>

    
<p class="astro-p"><b class="astro-b">
Naksahtra&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->Naksahtra; ?></p>

    
<p class="astro-p"><b class="astro-b">
NaksahtraLord&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->NaksahtraLord; ?></p>

    
<p class="astro-p"><b class="astro-b">
Charan&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->Charan; ?></p>

    
<p class="astro-p"><b class="astro-b">
Yog&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->Yog; ?></p>

    
<p class="astro-p"><b class="astro-b">
Karan&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->Karan; ?></p>

    
<p class="astro-p"><b class="astro-b">
Tithi&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->Tithi; ?></p>

    
<p class="astro-p"><b class="astro-b">
Yunja&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->yunja; ?></p>

    
<p class="astro-p"><b class="astro-b">
Tatva&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->tatva; ?></p>
  
<p class="astro-p"><b class="astro-b">
Name Alphabet&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->name_alphabet; ?></p>
  
<p class="astro-p"><b class="astro-b">
Paya&nbsp;:&nbsp; </b>  <?php echo $match_astro_details->female_astro_details->paya; ?></p>


</div>
  </div>
  <div class="col-md-4"></div>
</div>

                    </div>
                </div></div>


                <div class="card">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Match Planet Details<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="card-body">


                          <div class="row">

                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male planet 1</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[0]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[0]->sign;?></p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female planet 1</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[0]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[0]->sign;?></p>
                              </div>
                            </div>

                              
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male planet 2</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[1]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[1]->sign;?></p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female planet 2</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[1]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[1]->sign;?></p>
                              </div>
                            </div>

                              
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male planet 3</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[2]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[2]->sign;?></p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female planet 3</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[2]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[2]->sign;?></p>
                              </div>
                            </div>

                              
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male planet 4</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[3]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[3]->sign;?></p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female planet 4</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[3]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[3]->sign;?></p>
                              </div>
                            </div>

                              
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male planet 5</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[4]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[4]->sign;?></p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female planet 5</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[4]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[4]->sign;?></p>
                              </div>
                            </div>

                              
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male planet 6</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[5]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[5]->sign;?></p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female planet 6</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[5]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[5]->sign;?></p>
                              </div>
                            </div>

                              
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male planet 7</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[6]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[6]->sign;?></p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female planet 7</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[6]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[6]->sign;?></p>
                              </div>
                            </div>

                              
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male planet 8</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[7]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[7]->sign;?></p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female planet 8</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[7]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[7]->sign;?></p>
                              </div>
                            </div>
  
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male planet 9</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[8]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[8]->sign;?></p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female planet 9</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[8]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[8]->sign;?></p>
                              </div>
                            </div>
  
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male planet 10</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[9]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->male_planet_details[9]->sign;?></p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female planet 10</center>
                                    <p class="astro-p"><b class="astro-b">
                                    Name&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[9]->name;?></p>
                                  <p class="astro-p"><b class="astro-b">
                                    Sign&nbsp;:&nbsp; </b>  <?php echo $match_planet_details->female_planet_details[9]->sign;?></p>
                              </div>
                            </div>
  
                         

                              


</div>
                          
                    </div>
                </div>
            </div>



  <div class="card">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix11" aria-expanded="false" aria-controls="collapsesix11"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Match Manglik Report<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapsesix11" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="card-body">

                          <div class="row">
                             <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male Based On Aspect</center>
                                <p class="astro-p">  <?php echo $match_manglik_report->male->manglik_present_rule->based_on_aspect[0];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->male->manglik_present_rule->based_on_aspect[1];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->male->manglik_present_rule->based_on_aspect[2];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->male->manglik_present_rule->based_on_aspect[3];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->male->manglik_present_rule->based_on_aspect[4];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->male->manglik_present_rule->based_on_aspect[5];?></p>
                                  
                              </div>
                            </div>
                             <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female Based On Aspect</center>
                                <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_present_rule->based_on_aspect[0];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_present_rule->based_on_aspect[1];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_present_rule->based_on_aspect[2];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_present_rule->based_on_aspect[3];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_present_rule->based_on_aspect[4];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_present_rule->based_on_aspect[5];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_present_rule->based_on_aspect[6];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_present_rule->based_on_aspect[7];?></p>
                                <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_present_rule->based_on_aspect[8];?></p>
                                  
                              </div>
                            </div>


                             <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male Based On House</center>
                                   
                                  <p class="astro-p">  <?php echo $match_manglik_report->male->manglik_present_rule->based_on_house[0];?></p>
                                  <p class="astro-p">  <?php echo $match_manglik_report->male->manglik_present_rule->based_on_house[1];?></p>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female Based On House</center>
                                   
                                  <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_present_rule->based_on_house[0];?></p>
                                  <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_present_rule->based_on_house[1];?></p>
                              </div>
                            </div>



                             <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male Manglik cancel Rule</center>
                                   
                                  <p class="astro-p">  <?php echo $match_manglik_report->male->manglik_cancel_rule[0];?></p>
                                  
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female Manglik cancel Rule</center>
                                   
                                  <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_cancel_rule[0];?></p>
                                  
                              </div>
                            </div>


                             <div class="col-md-6">
                              <div class="box-shade">
                                <center>Male Manglik Report</center>
                                   
                                  <p class="astro-p">  <?php echo $match_manglik_report->male->manglik_report;?></p>
                                  
                              </div>
                            </div>
  
                            <div class="col-md-6">
                              <div class="box-shade">
                                <center>Female Manglik Report</center>
                                   
                                  <p class="astro-p">  <?php echo $match_manglik_report->female->manglik_report;?></p>
                                  
                              </div>
                            </div>


                              <div class="col-md-12">
                              <div class="box-shade">
                                <center>Conclusion</center>
                                   
                                  <p class="astro-p">  <?php echo $match_manglik_report->conclusion->report;?></p>
                                  
                              </div>
                            </div>
                          

                            
                            </div>
                    
</div>
                </div>
            </div>


              <div class="card" style="display: none;">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Match Making Report<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="card-body">
                            <br>
<p class="text-center">match_making_report
    <?php 
    echo "match_making_report<pre> ";
    print_r($match_making_report);
    
    ?>
</p>
</div>
                </div>
            </div>

              <div class="card" style="display: none;">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Match Simple Report<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="card-body">
                            <br>
<p class="text-center">
    <?php echo "match_making_report<pre> ";
    print_r($match_simple_report);
    ?></p>
</div>
                </div>
            </div>

              <div class="card" style="display: none;">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Match Making Detailed Report<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="card-body">
                            <br>
<p class="text-center">Result Text</p>
</div>
                </div>
            </div>

              <div class="card" style="display: none;">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Match Dashakoot Points<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="card-body">
                            <br>
<p class="text-center">Result Text</p>
</div>
                </div>
            </div>

              <div class="card" style="display: none;">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Match Percentage<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="card-body">
                            <br>
<p class="text-center">Result Text</p>
</div>
                </div>
            </div>
              <div class="card" style="display: none;">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Partner Report<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="card-body">
                            <br>
<p class="text-center">Result Text</p>
</div>
                </div>
            </div>  <div class="card" style="display: none;">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Custom Match Profiles<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="card-body">
                            <br>
<p class="text-center">Result Text</p>
</div>
                </div>
            </div>
              <div class="card" style="display: none;">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Custom Match Profiles xml<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="card-body">
                            <br>
<p class="text-center">Result Text</p>
</div>
                </div>
            </div>
              <div class="card" style="display: none;">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Papasamyam Details<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="card-body">
                            <br>
<p class="text-center">Result Text</p>
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


