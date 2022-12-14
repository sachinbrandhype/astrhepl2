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

if(isset($_POST['rashi_report'])) {
	echo (json_encode(getData('general_rashi_report/'.$_POST['planet'],$_POST['data'])));
	exit();
}
if(isset($_POST['house_report'])) {
	echo (json_encode(getData('general_house_report/'.$_POST['planet'],$_POST['data'])));
	exit();
}

?>
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


$planetnature = getData("planet_nature",$data);
$generalnakshatrareport = getData("general_nakshatra_report",$data);
$generalascendantreport = getData("general_ascendant_report",$data);
$generalrashireport = getData("reports",$data);



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
    <h2 class="head-h2">Life Reports</h2>
   <div class="mr-34"></div>
 

		<div class="col-lg-12">
			
			<div class="accordion" id="accordionExample">


		<div class="card">
					<div class="card-header" id="headingone">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseone" aria-expanded="false" aria-controls="collapseone"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>House Report<i class="material-icons">add</i></a>                               
						</h2>
					</div>
					<div id="collapseone" class="collapse" aria-labelledby="headingone" data-parent="#accordionExample">
						<div class="card-body">
						
<div class="row">
								<div class="col-md-4">
						<form action="#">
							 <div class="form-group">
                              <label for="sel1"><b>Planet</b></label>
                              <select id="house_report_select" class="form-control">
                                <option selected="">Mars</option>
                                <option value="Mercury">Mercury</option>
                                <option value="Jupiter">Jupiter</option>
                                <option value="Venus">Venus</option>
                              </select>
  </div>
						</form>	
					</div>

					<div class="col-md-12">
						<p class="astro-p">
					    <b class="astro-b">
                        Report&nbsp;:&nbsp; </b>   

                        <p class="house_report"></p>
                        </p>
					</div>
					
						</div>


					</div>
				</div>
            </div>



<div class="card">
					<div class="card-header" id="headingtwo">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="false" aria-controls="collapsetwo"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Rashi Report<i class="material-icons">add</i></a>                               
						</h2>
					</div>
					<div id="collapsetwo" class="collapse" aria-labelledby="headingtwo" data-parent="#accordionExample">
						<div class="card-body">
						
<div class="row">
								<div class="col-md-4">
						<form action="#">
							 <div class="form-group">
      <label for="sel1"><b>Planet</b></label>
      <select id="rashi_report_select" class="form-control">
        <option selected="">Mars</option>
        <option value="Mercury">Mercury</option>
        <option value="Jupiter">Jupiter</option>
        <option value="Venus">Venus</option>
      </select>
  </div>
						</form>	
					</div>

					<div class="col-md-12">
					<p class="astro-p">
					    <b class="astro-b">
                        Report&nbsp;:&nbsp; </b>   <?php echo $generalnakshatrareport->asc_report->report;?></p>
                        <p class="rashi_report"></p>
					</div>
					
						</div>


					</div>
				</div>
            </div>


		
		<div class="card">
					<div class="card-header" id="headingthree">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsethree" aria-expanded="false" aria-controls="collapsethree"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>General Ascendant Report<i class="material-icons">add</i></a>                               
						</h2>
					</div>
					<div id="collapsethree" class="collapse" aria-labelledby="headingthree" data-parent="#accordionExample">
						<div class="card-body">
						
<div class="row mt-10">
<div class="col-md-12">
        
<p class="astro-p"><b class="astro-b">
Ascendant&nbsp;:&nbsp; </b>   <?php echo $generalascendantreport->asc_report->ascendant;?></p>

<p class="astro-p"><b class="astro-b">
Report&nbsp;:&nbsp; </b>   <?php echo $generalascendantreport->asc_report->report;?></p>


</div>

</div>


					</div>
				</div>
            </div>


				<div class="card">
	<div class="card-header" id="headingFive">
			<h2 class="mb-0">
<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><i class="fa fa-angle-double-right" style="float: left; top: 2px; padding-right: 8px;"></i>Planet Nature<i class="material-icons">add</i></a>                               
						</h2>
					</div>
<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
						<div class="card-body">

<div class="card-body">
						
<div class="row mt-10">
<div class="col-md-12">
        
<p class="astro-p"><b class="astro-b">
Good Planets&nbsp;:&nbsp; </b> <?php echo $planetnature->GOOD[0];?>&nbsp;,&nbsp;<?php echo $planetnature->GOOD[1];?>&nbsp;,&nbsp;<?php echo $planetnature->GOOD[2];?></p>

<p class="astro-p"><b class="astro-b">
Bad Planets&nbsp;:&nbsp; </b> <?php echo $planetnature->BAD[0];?>&nbsp;,&nbsp;<?php echo $planetnature->BAD[1];?>&nbsp;,&nbsp;<?php echo $planetnature->BAD[2];?></p>

<p class="astro-p"><b class="astro-b">
Killer Planets&nbsp;:&nbsp; </b> <?php echo $planetnature->KILLER[0];?>&nbsp;,&nbsp;<?php echo $planetnature->KILLER[1];?>&nbsp;,&nbsp;<?php echo $planetnature->KILLER[2];?></p>


<p class="astro-p"><b class="astro-b">
Killer Planets&nbsp;:&nbsp; </b> <?php echo $planetnature->YOGAKARAKA[0];?>&nbsp;,&nbsp;<?php echo $planetnature->YOGAKARAKA[1];?>&nbsp;,&nbsp;<?php echo $planetnature->YOGAKARAKA[2];?></p>



</div>

</div>
</div>
                         

					</div>
				</div></div>

			</div>
		</div>


</div>

<script>
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
</script>

<?php include 'footer.php';?>
<script>
$(document).ready(function(){
        	$.ajax({
        url: '#',
        type: 'post',
         data: { "rashi_report":1,"planet": $('#rashi_report_select').val(),"data":<?php echo json_encode($data);?>},
        success: function(response) {
			console.log(response);
		$('.rashi_report').html(jQuery.parseJSON(response).rashi_report);
        }
        });
        
         	$.ajax({
        url: '#',
        type: 'post',
         data: { "house_report":1,"planet": $('#house_report_select').val(),"data":<?php echo json_encode($data);?>},
        success: function(response) {
			console.log(response);
		    $('.house_report').html(jQuery.parseJSON(response).house_report);
        }
        });
    
        $('#rashi_report_select').on('change', function() {
        var value = $(this).val();
            console.log('beore',value);
        $.ajax({
        url: '#',
        type: 'post',
        data: { "rashi_report":1,"planet": value,"data":<?php echo json_encode($data);?>},
        success: function(response) {
			    $('.rashi_report').html(jQuery.parseJSON(response).rashi_report);
			}
        });
        });
        
     $('#house_report_select').on('change', function() {
        var value = $(this).val();
            console.log(value);
        $.ajax({
        url: '#',
        type: 'post',
         data: { "house_report":1,"planet": value,"data":<?php echo json_encode($data);?>},
        success: function(response) {
			console.log(response);
			 $('.house_report').html(jQuery.parseJSON(response).house_report);
        }
        });
        });

});

</script>

