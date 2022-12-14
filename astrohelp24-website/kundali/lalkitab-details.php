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

// print_r($_POST); die;
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

    // lalkitab_horoscope
$lalkitabhoroscope = getData("lalkitab_horoscope",$data);


$lalkitab_debts = getData("lalkitab_debts",$data);
    // lalkitab_planets
$lalkitab_planets = getData("lalkitab_planets",$data);
    //lalkitab_remedies/:planet_name
 $lalkitab_remedies = getData("lalkitab_remedies/sun",$data);   
    // lalkitab_houses
$lalkitab_houses = getData("lalkitab_houses",$data);   



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
    <h2 class="head-h2">Lal Kitab</h2>
    <div class="mr-34"></div>
 

        <div class="col-lg-12">
            
            <div class="accordion" id="accordionExample">
            


                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Lalkitab Horoscope<i class="material-icons">add</i></a>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">

<table class="table table-striped table-responsive">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
         <th>Sign</th>
        <th>Sign Name</th>
         <th>Planet</th>
       
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $lalkitabhoroscope[0]->sign;?></td>
        <td><?php echo $lalkitabhoroscope[0]->sign_name;?></td>
        <td><?php echo $lalkitabhoroscope[0]->planet[0];?></td>
      </tr>   

      <tr>
        <td><?php echo $lalkitabhoroscope[1]->sign;?></td>
        <td><?php echo $lalkitabhoroscope[1]->sign_name;?></td>
        <td><?php echo $lalkitabhoroscope[1]->planet[0];?></td>
      </tr> 

      <tr>
        <td><?php echo $lalkitabhoroscope[2]->sign;?></td>
        <td><?php echo $lalkitabhoroscope[2]->sign_name;?></td>
        <td><?php echo $lalkitabhoroscope[2]->planet[0];?></td>
      </tr> 

       <tr>
        <td><?php echo $lalkitabhoroscope[3]->sign;?></td>
        <td><?php echo $lalkitabhoroscope[3]->sign_name;?></td>
        <td><?php echo $lalkitabhoroscope[3]->planet[0];?></td>
      </tr> 

      <tr>
        <td><?php echo $lalkitabhoroscope[4]->sign;?></td>
        <td><?php echo $lalkitabhoroscope[4]->sign_name;?></td>
        <td><?php echo $lalkitabhoroscope[4]->planet[0];?></td>
      </tr> 


      <tr>
        <td><?php echo $lalkitabhoroscope[5]->sign;?></td>
        <td><?php echo $lalkitabhoroscope[5]->sign_name;?></td>
        <td><?php echo $lalkitabhoroscope[5]->planet[0];?></td>
      </tr> 


      <tr>
        <td><?php echo $lalkitabhoroscope[6]->sign;?></td>
        <td><?php echo $lalkitabhoroscope[6]->sign_name;?></td>
        <td><?php echo $lalkitabhoroscope[6]->planet[0];?></td>
      </tr> 


      <tr>
        <td><?php echo $lalkitabhoroscope[7]->sign;?></td>
        <td><?php echo $lalkitabhoroscope[7]->sign_name;?></td>
        <td><?php echo $lalkitabhoroscope[7]->planet[0];?></td>
      </tr> 


      <tr>
        <td><?php echo $lalkitabhoroscope[8]->sign;?></td>
        <td><?php echo $lalkitabhoroscope[8]->sign_name;?></td>
        <td><?php echo $lalkitabhoroscope[8]->planet[0];?></td>
      </tr> 


      <tr>
        <td><?php echo $lalkitabhoroscope[9]->sign;?></td>
        <td><?php echo $lalkitabhoroscope[9]->sign_name;?></td>
        <td><?php echo $lalkitabhoroscope[9]->planet[0];?></td>
      </tr> 

      <tr>
        <td><?php echo $lalkitabhoroscope[10]->sign;?></td>
        <td><?php echo $lalkitabhoroscope[10]->sign_name;?></td>
        <td><?php echo $lalkitabhoroscope[10]->planet[0];?></td>
      </tr>

       <tr>
        <td><?php echo $lalkitabhoroscope[11]->sign;?></td>
        <td><?php echo $lalkitabhoroscope[11]->sign_name;?></td>
        <td><?php echo $lalkitabhoroscope[11]->planet[0];?></td>
      </tr>
         
    </tbody>
  </table>
</div>
                </div>
            
</div>

                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Lalkitab Debts<i class="material-icons">add</i></a>                     
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        
<div class="card-body">
<p class="astro-p"><b class="astro-b">
Debt Name&nbsp;:&nbsp; </b><?php echo $lalkitab_debts[0]->debt_name;?></p>
<p class="astro-p"><b class="astro-b">
Indications&nbsp;:&nbsp; </b><?php echo $lalkitab_debts[0]->indications;?></p>
<p class="astro-p"><b class="astro-b">
Debt Name&nbsp;:&nbsp; </b><?php echo $lalkitab_debts[0]->debt_name;?></p>
<p class="astro-p"><b class="astro-b">
Events&nbsp;:&nbsp; </b><?php echo $lalkitab_debts[0]->events;?></p>

                       
                    </div>
                </div>
</div>


                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Lalkitab remedies<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                      <div class="card-body">
<p class="astro-p"><b class="astro-b">
Planet&nbsp;:&nbsp; </b><?php echo $lalkitab_remedies->planet;?></p>
<p class="astro-p"><b class="astro-b">
House&nbsp;:&nbsp; </b><?php echo $lalkitab_remedies->house;?></p>
<p class="astro-p"><b class="astro-b">
Lal Kitab Desc&nbsp;:&nbsp; </b><?php echo $lalkitab_remedies->lal_kitab_desc;?></p>


                       
                    </div>

                </div>
            </div>


                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>lal Kitab Houses<i class="material-icons">add</i></a>                               
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
<table class="table table-striped table-responsive">
    <thead style="    background-color: #ff9445;
    color: #fff;
    letter-spacing: .5px;">
      <tr>
      <th>Khana No.</th>
      <th>Maalik</th>
      <th>Pakka Ghr</th>
      <th>Kismat</th>
      <th>Soya</th>
      <th>Exalt</th>
      <th>Debilitated</th>

       
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $lalkitab_houses[0]->khana_number;?></td>
        <td><?php echo $lalkitab_houses[0]->maalik;?></td>
        <td><?php echo $lalkitab_houses[0]->pakka_ghar;?></td>
        <td><?php echo $lalkitab_houses[0]->kismat;?></td>
        <td><?php echo $lalkitab_houses[0]->soya;?></td>
        <td><?php echo $lalkitab_houses[0]->kismat[0];?></td>
        <td><?php echo $lalkitab_houses[0]->debilitated[0];?></td>

      </tr>   

      <tr>
        <td><?php echo $lalkitab_houses[1]->khana_number;?></td>
        <td><?php echo $lalkitab_houses[1]->maalik;?></td>
        <td><?php echo $lalkitab_houses[1]->pakka_ghar;?></td>
        <td><?php echo $lalkitab_houses[1]->kismat;?></td>
        <td><?php echo $lalkitab_houses[1]->soya;?></td>
        <td><?php echo $lalkitab_houses[1]->kismat[0];?></td>
        <td><?php echo $lalkitab_houses[1]->debilitated[0];?></td>

      </tr> 

         <tr>
        <td><?php echo $lalkitab_houses[2]->khana_number;?></td>
        <td><?php echo $lalkitab_houses[2]->maalik;?></td>
        <td><?php echo $lalkitab_houses[2]->pakka_ghar;?></td>
        <td><?php echo $lalkitab_houses[2]->kismat;?></td>
        <td><?php echo $lalkitab_houses[2]->soya;?></td>
        <td><?php echo $lalkitab_houses[2]->kismat[0];?></td>
        <td><?php echo $lalkitab_houses[2]->debilitated[0];?></td>

      </tr>


         <tr>
        <td><?php echo $lalkitab_houses[3]->khana_number;?></td>
        <td><?php echo $lalkitab_houses[3]->maalik;?></td>
        <td><?php echo $lalkitab_houses[3]->pakka_ghar;?></td>
        <td><?php echo $lalkitab_houses[3]->kismat;?></td>
        <td><?php echo $lalkitab_houses[3]->soya;?></td>
        <td><?php echo $lalkitab_houses[3]->kismat[0];?></td>
        <td><?php echo $lalkitab_houses[3]->debilitated[0];?></td>

      </tr>


        <tr>
        <td><?php echo $lalkitab_houses[4]->khana_number;?></td>
        <td><?php echo $lalkitab_houses[4]->maalik;?></td>
        <td><?php echo $lalkitab_houses[4]->pakka_ghar;?></td>
        <td><?php echo $lalkitab_houses[4]->kismat;?></td>
        <td><?php echo $lalkitab_houses[4]->soya;?></td>
        <td><?php echo $lalkitab_houses[4]->kismat[0];?></td>
        <td><?php echo $lalkitab_houses[4]->debilitated[0];?></td>

      </tr>


        <tr>
        <td><?php echo $lalkitab_houses[5]->khana_number;?></td>
        <td><?php echo $lalkitab_houses[5]->maalik;?></td>
        <td><?php echo $lalkitab_houses[5]->pakka_ghar;?></td>
        <td><?php echo $lalkitab_houses[5]->kismat;?></td>
        <td><?php echo $lalkitab_houses[5]->soya;?></td>
        <td><?php echo $lalkitab_houses[5]->kismat[0];?></td>
        <td><?php echo $lalkitab_houses[5]->debilitated[0];?></td>

      </tr>


       <tr>
        <td><?php echo $lalkitab_houses[6]->khana_number;?></td>
        <td><?php echo $lalkitab_houses[6]->maalik;?></td>
        <td><?php echo $lalkitab_houses[6]->pakka_ghar;?></td>
        <td><?php echo $lalkitab_houses[6]->kismat;?></td>
        <td><?php echo $lalkitab_houses[6]->soya;?></td>
        <td><?php echo $lalkitab_houses[6]->kismat[0];?></td>
        <td><?php echo $lalkitab_houses[6]->debilitated[0];?></td>

      </tr>


    <tr>
        <td><?php echo $lalkitab_houses[7]->khana_number;?></td>
        <td><?php echo $lalkitab_houses[7]->maalik;?></td>
        <td><?php echo $lalkitab_houses[7]->pakka_ghar;?></td>
        <td><?php echo $lalkitab_houses[7]->kismat;?></td>
        <td><?php echo $lalkitab_houses[7]->soya;?></td>
        <td><?php echo $lalkitab_houses[7]->kismat[0];?></td>
        <td><?php echo $lalkitab_houses[7]->debilitated[0];?></td>

      </tr>


        <tr>
        <td><?php echo $lalkitab_houses[8]->khana_number;?></td>
        <td><?php echo $lalkitab_houses[8]->maalik;?></td>
        <td><?php echo $lalkitab_houses[8]->pakka_ghar;?></td>
        <td><?php echo $lalkitab_houses[8]->kismat;?></td>
        <td><?php echo $lalkitab_houses[8]->soya;?></td>
        <td><?php echo $lalkitab_houses[8]->kismat[0];?></td>
        <td><?php echo $lalkitab_houses[8]->debilitated[0];?></td>

      </tr>


        <tr>
        <td><?php echo $lalkitab_houses[9]->khana_number;?></td>
        <td><?php echo $lalkitab_houses[9]->maalik;?></td>
        <td><?php echo $lalkitab_houses[9]->pakka_ghar;?></td>
        <td><?php echo $lalkitab_houses[9]->kismat;?></td>
        <td><?php echo $lalkitab_houses[9]->soya;?></td>
        <td><?php echo $lalkitab_houses[9]->kismat[0];?></td>
        <td><?php echo $lalkitab_houses[9]->debilitated[0];?></td>

      </tr>


        <tr>
        <td><?php echo $lalkitab_houses[10]->khana_number;?></td>
        <td><?php echo $lalkitab_houses[10]->maalik;?></td>
        <td><?php echo $lalkitab_houses[10]->pakka_ghar;?></td>
        <td><?php echo $lalkitab_houses[10]->kismat;?></td>
        <td><?php echo $lalkitab_houses[10]->soya;?></td>
        <td><?php echo $lalkitab_houses[10]->kismat[0];?></td>
        <td><?php echo $lalkitab_houses[10]->debilitated[0];?></td>

      </tr>

        <tr>
        <td><?php echo $lalkitab_houses[11]->khana_number;?></td>
        <td><?php echo $lalkitab_houses[11]->maalik;?></td>
        <td><?php echo $lalkitab_houses[11]->pakka_ghar;?></td>
        <td><?php echo $lalkitab_houses[11]->kismat;?></td>
        <td><?php echo $lalkitab_houses[11]->soya;?></td>
        <td><?php echo $lalkitab_houses[11]->kismat[0];?></td>
        <td><?php echo $lalkitab_houses[11]->debilitated[0];?></td>

      </tr>

      
    </tbody>
  </table>

                    
                    </div>
                </div></div>


                <div class="card">
                    <div class="card-header" id="headingsix">
                        <h2 class="mb-0">
<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Lal Kitab Planets<i class="material-icons">add</i></a>                               
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
      <th>Rashi</th>
      <th>Soya</th>
      <th>Position</th>
      <th>Nature</th>   
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $lalkitab_planets[0]->planet;?></td>
        <td><?php echo $lalkitab_planets[0]->rashi;?></td>
        <td><?php echo $lalkitab_planets[0]->soya;?></td>
        <td><?php echo $lalkitab_planets[0]->position;?></td>
        <td><?php echo $lalkitab_planets[0]->nature;?></td>
     </tr> 

      <tr>
        <td><?php echo $lalkitab_planets[1]->planet;?></td>
        <td><?php echo $lalkitab_planets[1]->rashi;?></td>
        <td><?php echo $lalkitab_planets[1]->soya;?></td>
        <td><?php echo $lalkitab_planets[1]->position;?></td>
        <td><?php echo $lalkitab_planets[1]->nature;?></td>
     </tr>   

<tr>
        <td><?php echo $lalkitab_planets[2]->planet;?></td>
        <td><?php echo $lalkitab_planets[2]->rashi;?></td>
        <td><?php echo $lalkitab_planets[2]->soya;?></td>
        <td><?php echo $lalkitab_planets[2]->position;?></td>
        <td><?php echo $lalkitab_planets[2]->nature;?></td>
     </tr>

     <tr>
        <td><?php echo $lalkitab_planets[3]->planet;?></td>
        <td><?php echo $lalkitab_planets[3]->rashi;?></td>
        <td><?php echo $lalkitab_planets[3]->soya;?></td>
        <td><?php echo $lalkitab_planets[3]->position;?></td>
        <td><?php echo $lalkitab_planets[3]->nature;?></td>
     </tr>

      <tr>
        <td><?php echo $lalkitab_planets[4]->planet;?></td>
        <td><?php echo $lalkitab_planets[4]->rashi;?></td>
        <td><?php echo $lalkitab_planets[4]->soya;?></td>
        <td><?php echo $lalkitab_planets[4]->position;?></td>
        <td><?php echo $lalkitab_planets[4]->nature;?></td>
     </tr>

    <tr>
        <td><?php echo $lalkitab_planets[5]->planet;?></td>
        <td><?php echo $lalkitab_planets[5]->rashi;?></td>
        <td><?php echo $lalkitab_planets[5]->soya;?></td>
        <td><?php echo $lalkitab_planets[5]->position;?></td>
        <td><?php echo $lalkitab_planets[5]->nature;?></td>
     </tr>

       <tr>
        <td><?php echo $lalkitab_planets[6]->planet;?></td>
        <td><?php echo $lalkitab_planets[6]->rashi;?></td>
        <td><?php echo $lalkitab_planets[6]->soya;?></td>
        <td><?php echo $lalkitab_planets[6]->position;?></td>
        <td><?php echo $lalkitab_planets[6]->nature;?></td>
     </tr>

    <tr>
        <td><?php echo $lalkitab_planets[7]->planet;?></td>
        <td><?php echo $lalkitab_planets[7]->rashi;?></td>
        <td><?php echo $lalkitab_planets[7]->soya;?></td>
        <td><?php echo $lalkitab_planets[7]->position;?></td>
        <td><?php echo $lalkitab_planets[7]->nature;?></td>
     </tr>

    <tr>
        <td><?php echo $lalkitab_planets[8]->planet;?></td>
        <td><?php echo $lalkitab_planets[8]->rashi;?></td>
        <td><?php echo $lalkitab_planets[8]->soya;?></td>
        <td><?php echo $lalkitab_planets[8]->position;?></td>
        <td><?php echo $lalkitab_planets[8]->nature;?></td>
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


