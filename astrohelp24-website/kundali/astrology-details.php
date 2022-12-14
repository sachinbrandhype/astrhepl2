<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>

    
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Astrology</h2>
                        <form method='post' action='astrology.php'>
                            <div class="group-input">
                                <label for="username">Name</label>
                                <input  name="fullname" placeholder="Name">
                            </div>
                            <div class="group-input">
            <label for="pass"> Day of Birth</label>
                                
 <select name="date">
<option>- Day -</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
                                </select>
</div>


 <div class="group-input">
<label for="pass">Select Day of Birth</label>
                                
 <select name="month">
<option>- Month -</option>
<option value="1">January</option>
<option value="2">Febuary</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>   


</div>

 

                            <div class="group-input">
                                <label for="pass">Select Date of Year</label>

                                <input  name="year"  placeholder="Date of Year">
                            </div>

                                <div class="group-input">
                                <label for="pass">Hour</label>

                                <input  name="hour"  placeholder="Hour">
                            </div>

                              <div class="group-input">
                                <label for="pass">Minute</label>

                                <input  name="minute"  placeholder="Minute">
                            </div>

                            
                            <div class="group-input"> 
                            <div class="autocomplete">
                                <label for="pass">Place</label>
                                <input id="place" name="place" onkeyup="placeAPI(this.value)"  placeholder="Search Place Name e.g. New Deihi, Mumbai etc.">
                            </div>
                            </div>

                            <div class="group-input"> 
                                <label for="pass">Latitude</label>
                                <input id="latitude" readonly name="latitude"  placeholder="Latitude">
                            </div>


                             <div class="group-input"> 
                                <label for="pass">Longitude</label>
                                <input id="longitude" readonly name="longitude"  placeholder="Longitude">
                            </div>
                            
                             <div class="group-input">
                                <label for="pass">Timezone</label>
                                <input id='timezone' name="timezone"  placeholder="timezone">
                            </div>

                            <div class="group-input">
                                <label for="pass">prediction_timezone</label>

                                <input  name="prediction_timezone"  placeholder="prediction_timezone">
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


