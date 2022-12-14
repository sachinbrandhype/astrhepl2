
<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>


   <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Daily Horoscope</h2>
                    <form method='post' action='dailyHoroscope.php'>
                       <?php 
 $signArray = ['Aries','Taurus','Gemini','Cancer','Leo','Virgo','Libra','Scorpio','Sagittarius','Capricorn','Aquarius','Pisces'];
 ?>     
                            <div class="group-input">
    <label for="pass"> Your Rashi</label>
                                
 <select name="rashi_name">
    <option>- Select Your Rashi -</option>
    <?php foreach($signArray as $key=>$val){?>
    <option value="<?php echo $val;?>"><?php echo $val;?></option>
    <?php }?>
</select>

</div>
 
 <button type="submit" class="site-btn register-btn">Submit Now</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php';?>


