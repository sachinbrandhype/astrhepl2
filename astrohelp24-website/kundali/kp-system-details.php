<?php
// $data = array(
 // 'date' => 25,
 // 'month' => 12,
 // 'year' => 1988,
 // 'hour' => 4,
//  'minute' => 0,
 // 'latitude' => 25.123,
 // 'longitude' => 82.34,
 // 'timezone' => 5.5
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
'latitude' => $_POST['latitude'],
'longitude' => $_POST['latitude'],
'timezone' => 5.5,
);


$kp_planets = getData("kp_planets",$data);
$kp_house_cusps = getData("kp_house_cusps",$data);
$kp_birth_chart = getData("kp_birth_chart",$data);
$kp_house_significator = getData("kp_house_significator",$data);
$kp_planet_significator = getData("kp_planet_significator",$data);


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
    <h2 class="head-h2">KP System</h2>
   <div class="mr-34"></div>
 

        <div class="col-lg-12">
            
            <div class="accordion" id="accordionExample">
            


                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>KP Planet Details<i class="material-icons">add</i></a>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">

    <table class="table table-striped table-responsive">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>Planet</th>
        <th>Degree</th>
        <th>SL</th>
        <th>NL</th>
        <th>SB</th>
        <th>SS</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $kp_planets[0]->planet_name;?></td>
        <td><?php echo $kp_planets[0]->degree;?></td>
        <td><?php echo $kp_planets[0]->sign_lord;?></td>
        <td><?php echo $kp_planets[0]->nakshatra_lord;?></td>
        <td><?php echo $kp_planets[0]->sub_lord;?></td>
        <td><?php echo $kp_planets[0]->sub_sub_lord;?></td>
      </tr>  

      <tr>
        <td><?php echo $kp_planets[1]->planet_name;?></td>
        <td><?php echo $kp_planets[1]->degree;?></td>
        <td><?php echo $kp_planets[1]->sign_lord;?></td>
        <td><?php echo $kp_planets[1]->nakshatra_lord;?></td>
        <td><?php echo $kp_planets[1]->sub_lord;?></td>
        <td><?php echo $kp_planets[1]->sub_sub_lord;?></td>
      </tr>   

       <tr>
        <td><?php echo $kp_planets[2]->planet_name;?></td>
        <td><?php echo $kp_planets[2]->degree;?></td>
        <td><?php echo $kp_planets[2]->sign_lord;?></td>
        <td><?php echo $kp_planets[2]->nakshatra_lord;?></td>
        <td><?php echo $kp_planets[2]->sub_lord;?></td>
        <td><?php echo $kp_planets[2]->sub_sub_lord;?></td>
      </tr>   

      <tr>
        <td><?php echo $kp_planets[3]->planet_name;?></td>
        <td><?php echo $kp_planets[3]->degree;?></td>
        <td><?php echo $kp_planets[3]->sign_lord;?></td>
        <td><?php echo $kp_planets[3]->nakshatra_lord;?></td>
        <td><?php echo $kp_planets[3]->sub_lord;?></td>
        <td><?php echo $kp_planets[3]->sub_sub_lord;?></td>
      </tr> 


       <tr>
        <td><?php echo $kp_planets[4]->planet_name;?></td>
        <td><?php echo $kp_planets[4]->degree;?></td>
        <td><?php echo $kp_planets[4]->sign_lord;?></td>
        <td><?php echo $kp_planets[4]->nakshatra_lord;?></td>
        <td><?php echo $kp_planets[4]->sub_lord;?></td>
        <td><?php echo $kp_planets[4]->sub_sub_lord;?></td>
      </tr> 
      
       <tr>
        <td><?php echo $kp_planets[5]->planet_name;?></td>
        <td><?php echo $kp_planets[5]->degree;?></td>
        <td><?php echo $kp_planets[5]->sign_lord;?></td>
        <td><?php echo $kp_planets[5]->nakshatra_lord;?></td>
        <td><?php echo $kp_planets[5]->sub_lord;?></td>
        <td><?php echo $kp_planets[5]->sub_sub_lord;?></td>
      </tr> 


        <tr>
        <td><?php echo $kp_planets[6]->planet_name;?></td>
        <td><?php echo $kp_planets[6]->degree;?></td>
        <td><?php echo $kp_planets[6]->sign_lord;?></td>
        <td><?php echo $kp_planets[6]->nakshatra_lord;?></td>
        <td><?php echo $kp_planets[6]->sub_lord;?></td>
        <td><?php echo $kp_planets[6]->sub_sub_lord;?></td>
      </tr> 

        <tr>
        <td><?php echo $kp_planets[7]->planet_name;?></td>
        <td><?php echo $kp_planets[7]->degree;?></td>
        <td><?php echo $kp_planets[7]->sign_lord;?></td>
        <td><?php echo $kp_planets[7]->nakshatra_lord;?></td>
        <td><?php echo $kp_planets[7]->sub_lord;?></td>
        <td><?php echo $kp_planets[7]->sub_sub_lord;?></td>
      </tr> 

        <tr>
        <td><?php echo $kp_planets[8]->planet_name;?></td>
        <td><?php echo $kp_planets[8]->degree;?></td>
        <td><?php echo $kp_planets[8]->sign_lord;?></td>
        <td><?php echo $kp_planets[8]->nakshatra_lord;?></td>
        <td><?php echo $kp_planets[8]->sub_lord;?></td>
        <td><?php echo $kp_planets[8]->sub_sub_lord;?></td>
      </tr>

       <tr>
        <td><?php echo $kp_planets[9]->planet_name;?></td>
        <td><?php echo $kp_planets[9]->degree;?></td>
        <td><?php echo $kp_planets[9]->sign_lord;?></td>
        <td><?php echo $kp_planets[9]->nakshatra_lord;?></td>
        <td><?php echo $kp_planets[9]->sub_lord;?></td>
        <td><?php echo $kp_planets[9]->sub_sub_lord;?></td>
      </tr>

    </tbody>
  </table>


</div>
                </div>
            
</div>

                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>KP House Cusps Details<i class="material-icons">add</i></a>                     
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        
                        <div class="card-body">

  <table class="table table-striped table-responsive">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>Planet</th>
        <th>Degree</th>
        <th>SL</th>
        <th>NL</th>
        <th>SB</th>
        <th>SS</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $kp_house_cusps[0]->sign;?></td>
        <td><?php echo $kp_house_cusps[0]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[0]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[0]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[0]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[0]->sub_sub_lord;?></td>
      </tr>      
      
      <tr>
        <td><?php echo $kp_house_cusps[1]->sign;?></td>
        <td><?php echo $kp_house_cusps[1]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[1]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[1]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[1]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[1]->sub_sub_lord;?></td>
      </tr>


      <tr>
        <td><?php echo $kp_house_cusps[2]->sign;?></td>
        <td><?php echo $kp_house_cusps[2]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[2]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[2]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[2]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[2]->sub_sub_lord;?></td>
      </tr>

      <tr>
        <td><?php echo $kp_house_cusps[3]->sign;?></td>
        <td><?php echo $kp_house_cusps[3]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[3]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[3]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[3]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[3]->sub_sub_lord;?></td>
      </tr>

      <tr>
        <td><?php echo $kp_house_cusps[4]->sign;?></td>
        <td><?php echo $kp_house_cusps[4]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[4]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[4]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[4]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[4]->sub_sub_lord;?></td>
      </tr>

      <tr>
        <td><?php echo $kp_house_cusps[5]->sign;?></td>
        <td><?php echo $kp_house_cusps[5]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[5]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[5]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[5]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[5]->sub_sub_lord;?></td>
      </tr>

        <tr>
        <td><?php echo $kp_house_cusps[6]->sign;?></td>
        <td><?php echo $kp_house_cusps[6]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[6]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[6]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[6]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[6]->sub_sub_lord;?></td>
      </tr>

     <tr>
        <td><?php echo $kp_house_cusps[7]->sign;?></td>
        <td><?php echo $kp_house_cusps[7]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[7]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[7]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[7]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[7]->sub_sub_lord;?></td>
      </tr>

       <tr>
        <td><?php echo $kp_house_cusps[8]->sign;?></td>
        <td><?php echo $kp_house_cusps[8]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[8]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[8]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[8]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[8]->sub_sub_lord;?></td>
      </tr>


      <tr>
        <td><?php echo $kp_house_cusps[9]->sign;?></td>
        <td><?php echo $kp_house_cusps[9]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[9]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[9]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[9]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[9]->sub_sub_lord;?></td>
      </tr>

         <tr>
        <td><?php echo $kp_house_cusps[10]->sign;?></td>
        <td><?php echo $kp_house_cusps[10]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[10]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[10]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[10]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[10]->sub_sub_lord;?></td>
      </tr>


       <tr>
        <td><?php echo $kp_house_cusps[11]->sign;?></td>
        <td><?php echo $kp_house_cusps[11]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[11]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[11]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[11]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[11]->sub_sub_lord;?></td>
      </tr>


        <tr>
        <td><?php echo $kp_house_cusps[12]->sign;?></td>
        <td><?php echo $kp_house_cusps[12]->cusp_full_degree;?></td>
        <td><?php echo $kp_house_cusps[12]->sign_lord;?></td>
        <td><?php echo $kp_house_cusps[12]->nakshatra_lord;?></td>
        <td><?php echo $kp_house_cusps[12]->sub_lord;?></td>
        <td><?php echo $kp_house_cusps[12]->sub_sub_lord;?></td>
      </tr>
    </tbody>
  </table>

                    </div>
                </div>


                <div id="collapsethree" class="collapse" aria-labelledby="headingthree" data-parent="#accordionExample">
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
                </div>


</div>


           <!----     <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>KP cusps chart<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                    <br>
<p class="text-center"><?php 
                          echo '<br>signs '.$kp_birth_chart[0]->signs[0];   
                          echo '<br>signs '.$kp_birth_chart[0]->signs[1];
                          echo '<br>planets '.$kp_birth_chart[0]->planets[0];
                           echo '<br>planets_small '.$kp_birth_chart[0]->planets_small[0];
                            echo '<br>planet_signs '.$kp_birth_chart[0]->planet_signs[0];
                            
                            echo '<br>signs '.$kp_birth_chart[1]->signs[0];   
                          echo '<br>signs '.$kp_birth_chart[1]->signs[1];
                          echo '<br>planets '.$kp_birth_chart[1]->planets[0];
                           echo '<br>planets_small '.$kp_birth_chart[1]->planets_small[0];
                            echo '<br>planet_signs '.$kp_birth_chart[1]->planet_signs[0];
                            
                            echo '<br>signs '.$kp_birth_chart[2]->signs[0];   
                          echo '<br>signs '.$kp_birth_chart[2]->signs[1];
                          echo '<br>planets '.$kp_birth_chart[2]->planets[0];
                          
                            
                            echo '<br>signs '.$kp_birth_chart[3]->signs[0];   
                          echo '<br>signs '.$kp_birth_chart[3]->signs[1];
                          echo '<br>planets '.$kp_birth_chart[3]->planets[0];
                           echo '<br>planets_small '.$kp_birth_chart[3]->planets_small[0];
                            echo '<br>planet_signs '.$kp_birth_chart[3]->planet_signs[0];
                            
                               echo '<br>signs '.$kp_birth_chart[4]->signs[0];   
                          echo '<br>signs '.$kp_birth_chart[4]->signs[1];
                          echo '<br>planets '.$kp_birth_chart[4]->planets[0];
                          
                             echo '<br>signs '.$kp_birth_chart[5]->signs[0];   
                          echo '<br>signs '.$kp_birth_chart[5]->signs[1];
                          echo '<br>planets '.$kp_birth_chart[5]->planets[0];
                          
                             echo '<br>signs '.$kp_birth_chart[6]->signs[0];   
                          echo '<br>signs '.$kp_birth_chart[6]->signs[1];
                          echo '<br>planets '.$kp_birth_chart[6]->planets[0];
                          
                             echo '<br>signs '.$kp_birth_chart[7]->signs[0];   
                          echo '<br>signs '.$kp_birth_chart[7]->signs[1];
                          echo '<br>planets '.$kp_birth_chart[7]->planets[0];
                          
                             echo '<br>signs '.$kp_birth_chart[8]->signs[0];   
                          echo '<br>signs '.$kp_birth_chart[8]->signs[1];
                          echo '<br>planets '.$kp_birth_chart[8]->planets[0];
                          
                                echo '<br>signs '.$kp_birth_chart[9]->signs[0];   
                                echo '<br>signs '.$kp_birth_chart[9]->signs[1];
                                echo '<br>planets '.$kp_birth_chart[9]->planets[0];
                          
                             echo '<br>signs '.$kp_birth_chart[10]->signs[0];   
                          echo '<br>signs '.$kp_birth_chart[10]->signs[1];
                          echo '<br>planets '.$kp_birth_chart[10]->planets[0];
                         
                        ?></p>

                    </div>
                </div>
            </div>---->


                <div class="card">
<div class="card-header" id="headingFive">
<h2 class="mb-0">
<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>KP House Significator<i class="material-icons">add</i></a>                               
        </h2>
 </div>
 <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
<div class="card-body">


 <table class="table table-striped table-responsive">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>House</th>
        <th>Significator</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>House <?php echo $kp_house_significator[0]->house_id;?></td>
        <td><?php echo $kp_house_significator[0]->significators[0]?> &nbsp; , &nbsp;<?php echo$kp_house_significator[0]->significators[1];?></td>
      </tr>   

      <tr>
        <td>House <?php echo $kp_house_significator[1]->house_id;?></td>
        <td><?php echo $kp_house_significator[1]->significators[0]?> &nbsp; , &nbsp;<?php echo$kp_house_significator[1]->significators[1];?></td>
      </tr>   


    <tr>
        <td>House <?php echo $kp_house_significator[2]->house_id;?></td>
        <td><?php echo $kp_house_significator[2]->significators[0]?> &nbsp; , &nbsp;<?php echo$kp_house_significator[2]->significators[1];?></td>
      </tr> 

      <tr>
        <td>House <?php echo $kp_house_significator[3]->house_id;?></td>
        <td><?php echo $kp_house_significator[3]->significators[0]?> &nbsp; , &nbsp;<?php echo$kp_house_significator[3]->significators[1];?></td>
      </tr> 

      <tr>
        <td>House <?php echo $kp_house_significator[4]->house_id;?></td>
        <td><?php echo $kp_house_significator[4]->significators[0]?> &nbsp; , &nbsp;<?php echo$kp_house_significator[4]->significators[1];?></td>
      </tr> 

      <tr>
        <td>House <?php echo $kp_house_significator[5]->house_id;?></td>
        <td><?php echo $kp_house_significator[5]->significators[0]?> &nbsp; , &nbsp;<?php echo$kp_house_significator[5]->significators[1];?></td>
      </tr> 

       <tr>
        <td>House <?php echo $kp_house_significator[6]->house_id;?></td>
        <td><?php echo $kp_house_significator[6]->significators[0]?> &nbsp; , &nbsp;<?php echo$kp_house_significator[6]->significators[1];?></td>
      </tr>

       <tr>
        <td>House <?php echo $kp_house_significator[7]->house_id;?></td>
        <td><?php echo $kp_house_significator[7]->significators[0]?> &nbsp; , &nbsp;<?php echo$kp_house_significator[7]->significators[1];?></td>
      </tr>

       <tr>
        <td>House <?php echo $kp_house_significator[8]->house_id;?></td>
        <td><?php echo $kp_house_significator[8]->significators[0]?> &nbsp; , &nbsp;<?php echo$kp_house_significator[8]->significators[1];?></td>
      </tr>
    
    </tbody>
  </table>
                    </div>
                </div></div>


                <div class="card">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>KP Planet Significator<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                        <div class="card-body">
                         

 <table class="table table-striped table-responsive">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
        <th>Planet</th>
         <th>Planet Name</th>
        <th>Significator</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Planet <?php echo $kp_planet_significator[0]->planet_id;?></td>
        <td><?php echo $kp_planet_significator[0]->planet_name;?></td>
        <td><?php echo $kp_planet_significator[0]->significators[0]?> &nbsp; , &nbsp;<?php echo $kp_planet_significator[0]->significators[1];?></td>
      </tr>   

    <tr>
        <td>Planet <?php echo $kp_planet_significator[1]->planet_id;?></td>
        <td><?php echo $kp_planet_significator[1]->planet_name;?></td>
        <td><?php echo $kp_planet_significator[1]->significators[0]?> &nbsp; , &nbsp;<?php echo $kp_planet_significator[1]->significators[1];?></td>
      </tr>   

  <tr>
        <td>Planet <?php echo $kp_planet_significator[2]->planet_id;?></td>
        <td><?php echo $kp_planet_significator[2]->planet_name;?></td>
        <td><?php echo $kp_planet_significator[2]->significators[0]?> &nbsp; , &nbsp;<?php echo $kp_planet_significator[2]->significators[1];?></td>
      </tr> 

       <tr>
        <td>Planet <?php echo $kp_planet_significator[3]->planet_id;?></td>
        <td><?php echo $kp_planet_significator[3]->planet_name;?></td>
        <td><?php echo $kp_planet_significator[3]->significators[0]?> &nbsp; , &nbsp;<?php echo $kp_planet_significator[3]->significators[1];?></td>
      </tr> 

        <tr>
        <td>Planet <?php echo $kp_planet_significator[4]->planet_id;?></td>
        <td><?php echo $kp_planet_significator[4]->planet_name;?></td>
        <td><?php echo $kp_planet_significator[4]->significators[0]?> &nbsp; , &nbsp;<?php echo $kp_planet_significator[4]->significators[1];?></td>
      </tr> 

        <tr>
        <td>Planet <?php echo $kp_planet_significator[5]->planet_id;?></td>
        <td><?php echo $kp_planet_significator[5]->planet_name;?></td>
        <td><?php echo $kp_planet_significator[5]->significators[0]?> &nbsp; , &nbsp;<?php echo $kp_planet_significator[5]->significators[1];?></td>
      </tr> 

         <tr>
        <td>Planet <?php echo $kp_planet_significator[6]->planet_id;?></td>
        <td><?php echo $kp_planet_significator[6]->planet_name;?></td>
        <td><?php echo $kp_planet_significator[6]->significators[0]?> &nbsp; , &nbsp;<?php echo $kp_planet_significator[6]->significators[1];?></td>
      </tr> 

        <tr>
        <td>Planet <?php echo $kp_planet_significator[7]->planet_id;?></td>
        <td><?php echo $kp_planet_significator[7]->planet_name;?></td>
        <td><?php echo $kp_planet_significator[7]->significators[0]?> &nbsp; , &nbsp;<?php echo $kp_planet_significator[7]->significators[1];?></td>
      </tr> 

         <tr>
        <td>Planet <?php echo $kp_planet_significator[8]->planet_id;?></td>
        <td><?php echo $kp_planet_significator[8]->planet_name;?></td>
        <td><?php echo $kp_planet_significator[8]->significators[0]?> &nbsp; , &nbsp;<?php echo $kp_planet_significator[8]->significators[1];?></td>
      </tr> 
    
    </tbody>
  </table>

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


