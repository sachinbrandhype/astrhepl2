<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>

    
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Numerology</h2>
                        <form method='post' action='numerology.php'>
                            <div class="group-input">
                                <label for="username">Name</label>
                                <input  name="fullname" placeholder="Name" required="">
                            </div>
                        
                         <div class="group-input">
                                <label for="pass">Date</label>

                                <input  name="date" type='date'  placeholder="Date of Year" required="">
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

    
