<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>

    
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Lucky Colour</h2>
                       <form method='post' action='lucky-colour.php'>
                           
<div class="group-input">
                                <label for="username">Name</label>
                                <input  name="name" placeholder="Name" required="">
                            </div>
                            
                            <div class="group-input">
                                <label for="pass">Date</label>

                                <input  name="date" type='date'  placeholder="Date of Year" required="">
                            </div>



                           <div class="group-input" style='display:none'>
                                <label for="pass">Time</label>

                                <input  name="time" type='time'>
                            </div>  
                     
                            <div class="group-input" style='display:none'> 
                                <label for="pass">Latitude</label>
                                <input id="latitude" readonly name="latitude"  placeholder="Latitude">
                            </div>


                             <div class="group-input" style='display:none'> 
                                <label for="pass">Longitude</label>
                                <input id="longitude" readonly name="longitude"  placeholder="Longitude">
                            </div>

                            <div class="group-input" style='display:none'> 
                            <div class="autocomplete">
                                <label for="pass">Place</label>
                                <input id="place"  name="place" onkeyup="placeAPI(this.value)"  placeholder="Search Place Name e.g. New Delhi, Mumbai etc." >
                            </div>
                            </div>



                            <button type="submit" class="site-btn register-btn">Submit Now</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
    

<?php include 'footer.php';?>

<script src="place-api.js"></script>
    
