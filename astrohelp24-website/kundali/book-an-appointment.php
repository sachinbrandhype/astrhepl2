<?php include 'header.php';?>
<!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Book An Appointment</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->
<section class="padd-top-30">
<div class="section-title">
    <h3 class="text-center">Book An Appointment</h3>
</div>  
<div class="container">
      <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="register-form">
                    
                        <form method='post' action='#'>
<div class="row">
<div class="col-md-6">
<div class="group-input">
<label for="username">Enter Your Name</label>
<input type="text" name="name" id="name" placeholder="Name" required="">
</div>
</div>
<div class="col-md-6">
<div class="group-input">
<label for="pass"> Enter Your Email</label>
<input type="email"  name="email" id="email" placeholder="Email" required="">                          
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="group-input">
<label for="username">Phone No.</label>
<input type="text" name="phone" id="phone" placeholder="Phone No." required="">
</div>
</div>
<div class="col-md-6">
<div class="group-input">
<label for="pass"> Date</label>
<input  type="text" name="date" id="date" placeholder="Date" required="">                          
</div>
</div>
</div>
 

 <div class="group-input">
<label for="pass">Message</label>
<textarea name="message" id="message"  placeholder="Message" required="">
</textarea></div>
<button type="submit" class="site-btn register-btn">Submit Now</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

</section>
    
   
<?php include 'footer.php';?>