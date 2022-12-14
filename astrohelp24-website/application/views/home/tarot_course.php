
         <!-- /Header -->
         <!-- Breadcrumb -->
         <div class="breadcrumb-bar">
            <div class="container-fluid">
               <div class="row align-items-center">
                  <div class="col-md-12 col-12">
                     <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
                           <li class="breadcrumb-item active" aria-current="page">Services</li>
                        </ol>
                     </nav>
                     <h2 class="breadcrumb-title"><?php echo $page_title; ?></h2>
                  </div>
               </div>
            </div>
         </div>
         <!-- /Breadcrumb -->
         <!-- Page Content -->
         
            <section class="section section-about">
              
               <div class="container">
                 
                  <div class="row">
                     <div class="col-md-12 mb-5">
                        <div class="about-img">
                           <img src="<?= BASE_URL_IMAGE.'common/'.$page_data->image ?>" width="100%" class="img-responsive" alt="">
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="section-header">
                           <h2 class="dtr-mb-4"><?php echo $page_data->heading ;  ?></h2>
                           <p><?php echo $page_data->desc ;  ?></p>

                        </div>
                     </div>
<div class="col-md-4">
   



    <!-- Booking Summary -->
                     <div class="card booking-card">
                        <div class="card-header">
                           <h4 class="card-title"><?php echo $page_title; ?> Enquiry</h4>
                        </div>
                         <form method="post">
                        <div class="card-body">
                            <div class="row">
                                  
                                      <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Name</label>
                                       <input type="text" name="firstname"  class="form-control" placeholder="Name" required="">
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Email</label>
                                       <input type="email" name="email" class="form-control" placeholder="" required="">
                                    </div>
                                 </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Mobile No</label>
                                       <input type="number" name="mobile"  class="form-control" placeholder="" required="">
                                    </div>
                                 </div>
                                
                                  <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Message</label>
                                       <textarea name="message"  class="form-control" placeholder="Message"></textarea>
                                    </div>
                                 </div>
                                
                              
                                    
                                     
                                      
                                     
                                       <div class="submit-section mt-2 col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md">Send</button>
                                 </div>


                                


                                    </div>
                          
                        </div>

                         </form>
                     </div>
                     <!-- /Booking Summary -->
</div>


                     
                  </div>
               </div>
            </section>
           
         
         <!-- /Page Content -->
      