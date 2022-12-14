<?php $id = $_GET['id'];
$id = base64_decode($id);
session_start();
$_SESSION['user_id'] = $id;

?>
<?php include 'header.php';?>

    <!-- Hero Section Begin -->
  <!--   <section class="hero-section">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/slider-1.jpg" class="img-fluid" alt="Notebook">
                    
                
                    </div>  
                   <div class="carousel-item">
                        <img src="img/slider-2.jpg" class="img-fluid" alt="Notebook">
                
                    </div> 

                     
                </div>
              
                <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
    </section> -->
    <!-- Hero Section End -->







<section class="padd-top-30 ">
    <div class="container">
    <div class="row">



        <div class="col-md-3">
            <div class="stats">
              <a href="kundali-form.php">
                <p><img src="img/kundli-images/kundli.png" alt=""></p>
                <p><span class="link-block">Kundali</span></p>
                </a>
            </div>
        </div>




        <div class="col-md-3">
            <div class="stats">
              <a href="daily-horoscope-details.php">
                  <p><img src="img/kundli-images/daily-horoscope.png" alt=""></p>
                <p><span class="link-block">Daily Horoscope</span></p>
                </a>
            </div>
        </div>


        

        <div class="col-md-3">
            <div class="stats">
              <a href="numerology-details.php">
                  <p><img src="img/kundli-images/numerology.png" alt=""></p>
                <p><span class="link-block">Numerology</span></p>
                </a>
            </div>
        </div>


        

        <div class="col-md-3">
            <div class="stats">
              <a href="lalkitab.php">
                  <p><img src="img/kundli-images/lal-kitab.png" alt=""></p>
                <p><span class="link-block">Lal Kitab</span></p>
                </a>
            </div>
        </div>


        

        <div class="col-md-3">
            <div class="stats">
              <a href="kp-system.php">
                  <p><img src="img/kundli-images/kp-system.png" alt=""></p>
                <p><span class="link-block">KP System</span></p>
                </a>
            </div>
        </div>


        

        <div class="col-md-3">
            <div class="stats">
              <a href="lifereport.php">
                  <p><img src="img/kundli-images/life-report.png" alt=""></p>
                <p><span class="link-block">Life Report</span></p>
                </a>
            </div>
        </div>


        

        <div class="col-md-3">
            <div class="stats">
              <a href="lucky-number-details.php">
                  <p><img src="img/kundli-images/lucy-number.png" alt=""></p>
                <p><span class="link-block">Know Your Lucky Number</span></p>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats">
              <a href="sadhesati-remedies-details.php">
                  <p><img src="img/kundli-images/sade-sati.png" alt=""></p>
                <p><span class="link-block">Sade Sati</span></p>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats">
              <a href="match-making.php">
                  <p><img src="img/kundli-images/puja.png" alt=""></p>
                <p><span class="link-block">Match Making</span></p>
                </a>
            </div>
        </div>


        <div class="col-md-3">
            <div class="stats">
              <a href="puja-suggestion-details.php">
                  <p><img src="img/kundli-images/puja.png" alt=""></p>
                <p><span class="link-block">Puja Suggestion</span></p>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats">
              <a href="lucky-colour-details.php">
                  <p><img src="img/kundli-images/lucy-colour.png" alt=""></p>
                <p><span class="link-block">Know Your Lucky Colour</span></p>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats">
              <a href="rudraksha-suggestion-details.php">
                  <p><img src="img/kundli-images/rudraksh.png" alt=""></p>
                <p><span class="link-block">Rudraksh Suggestion</span></p>
                </a>
            </div>
        </div>


        <div class="col-md-3">
            <div class="stats">
              <a href="gemstone-suggestion-details.php">
                  <p><img src="img/kundli-images/gemstone.png" alt=""></p>
                <p><span class="link-block">Gemstone Suggestion</span></p>
                </a>
            </div>
        </div>


        <div class="col-md-3">
            <div class="stats">
              <a href="panchang-details.php">
                  <p><img src="img/kundli-images/daily-panchang.png" alt=""></p>
                <p><span class="link-block">Daily Panchang</span></p>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats">
              <a href="daily-prediction-details.php">
                  <p><img src="img/kundli-images/daily-prediction.png" alt=""></p>
                <p><span class="link-block">Daily Prediction</span></p>
                </a>
            </div>
        </div>


        

    </div>
</div>
    </section>




    
   
<?php include 'footer.php';?>