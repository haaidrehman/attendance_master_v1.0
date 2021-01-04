<?php $session = Config\Services::session(); ?>
<?php $this->extend('student/templates/base'); ?>




<?php $this->section('main_section'); ?>
<?php echo $this->include('student/templates/sidebar'); ?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Your Profile Details</h4>
                           <?php
                                if($session->getFlashdata('profile_updated')){
                                    ?>
                                    <div class="alert">
                                    <p class="alert-success"><?php echo $session->getFlashdata('profile_updated'); ?></p>
                                    </div>
                                    <?php
                                }
                              ?>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                           
                           <?php
                           if($records != false){
                             
                              ?>
                              <div class="user-info offset-md-1 col-md-6">
                              <div class="row">
                              <?php
                              foreach($records as $k => $v){
                                 if($v['profile_pic'] == 'null'){
                                    ?>
                                    <div class="col-md-12">
                                       <div class="text-center">
                                           <img src="<?php echo base_url().'/public/assets/images/icons/password.png'; ?>" alt="">
                                       </div>
                                       <div>
                                           <form method="post" action="<?php echo base_url().'/student/profile/upload'; ?>" enctype="multipart/form-data">
                                           <input type="file" name="profile_pic" id="profile_pic">
                                            <div id="file_upload_wrapper" style="display:inline; display:none">
                                            
                                                    <input type="submit" class="btn btn-primary" value="Upload">
                                            </div>
                                           <?php
                                           if($session->getTempdata('validation_error')){
                                              ?>
                                              <div class="alert">
                                              <?php 
                                              foreach($session->getTempdata('validation_error') as $ek => $ev){
                                                    ?>
                                                    <p class="alert-danger p-3"><?php echo $ev; ?></p>
                                                    <?php    
                                              }
                                              ?>
                                              </div>
                                              <?php
                                           }  
                                           ?>
                                           </form>

                                       </div>
                                    </div>
                                    <?php
                                 }else{
                                    //  echo $v['profile_pic'];
                                    ?>
                                       <div class="col-md-12">
                                          <div>
                                              <img src="<?php echo base_url().'/writable/uploads/students/name.png'; ?>"  width="200" height="200">
                                          </div>
                                       </div>
                                    <?php
                                     if($session->getFlashdata('profile_uploaded')){
                                        ?>
                                        <div class="px-4"><div class="alert alert-success"><?php echo $session->getFlashdata('profile_uploaded'); ?></div></div>
                                        <?php
                                     }
                                 } ?>
                                 <div class="col-md-12 user-info-detailing">
                                    <div class="float-left">First Name:</div>
                                    <div class="float-right"><?php echo $v['fname']; ?></div>
                                 </div>
                                <div class="col-md-12 user-info-detailing">
                                <div class="float-left">
                                Last Name:
                                </div>
                                <div class="float-right">
                                <?php echo $v['lname']; ?>
                                </div>
                                </div>
                                

                                <div class="col-md-12 user-info-detailing">
                                <div class="float-left">
                                Age:
                                </div>
                                <div class="float-right">
                                <?php echo $v['age']; ?>
                                </div>
                                </div>

                                <div class="col-md-12 user-info-detailing">
                                <div class="float-left">
                                Class:
                                </div>
                                <div class="float-right">
                                <?php echo $v['class_id']; ?>
                                </div>
                                </div>

                                <div class="col-md-12 user-info-detailing">
                                <div class="float-left">
                                Roll Number:
                                </div>
                                <div class="float-right">
                                <?php echo $v['roll_no']; ?>
                                </div>
                                </div>


                                <div class="col-md-12 user-info-detailing">
                                <div class="float-left">
                                Phone:
                                </div>
                                <div class="float-right">
                                <?php echo $v['phone']; ?>
                                </div>
                                </div>

                                <div class="col-md-12 user-info-detailing">
                                <div class="float-left">
                                Email:
                                </div>
                                <div class="float-right">
                                <?php echo $v['email']; ?>
                                </div>
                                </div>


                                <div class="col-md-12 user-info-detailing">
                                <div class="float-left">
                                Address:
                                </div>
                                <div class="float-right">
                                <?php echo $v['address']; ?>
                                </div>
                                </div>


                                <div class="col-md-12 user-info-detailing">
                                <div class="float-left">
                                Registration ID:
                                </div>
                                <div class="float-right">
                                <?php echo $v['reg_id']; ?>
                                </div>
                                </div>

                                 <!-- Modal Start-->
                              <!-- Button trigger modal -->
                              <div class="mt-5">
                               <a type="button" class="" data-toggle="modal"
                                                data-target="#exampleModal">
                                                <span style="color: #007bff; font-weight: bold;">Click here</span>
                              </a> to update your details.
                              
                              </div>
                              

                    <div class="modal" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center" id="exampleModalLabel">
                                        Update your details here
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="contact-form" method="post"
                                        action="<?php echo base_url('/student/dashboard'); ?>">
                                        <div class="form-group n_height">
                                            <input type="hidden" name="staff_id" id="staff_id">
                                            <label style="float-left">First Name</label>
                                            <input id="fname" class="remove__outline form-control mb-3" type="text" name="fname" value="<?php echo $v['fname']; ?>">
                                                <label>Last Name</label>
                                            <input id="lname" class="remove__outline form-control mt-3" type="text" value="<?php echo $v['lname']; ?>"
                                                name="lname">
                                        </div>
                                        <div class="form-group c_height">
                                        <label>Age</label>
                                            <input id="age" class="remove__outline form-control  mb-3" type="text" value="<?php echo $v['age']; ?>"
                                                name="age">
                                        </div>
                                        <div class="form-group n_height">
                                        <label>Class</label>
                                            <input id="class" class="remove__outline form-control  mb-3" type="text" value="<?php echo $v['class_id']; ?>"
                                                name="class">
                                        </div>
                                        <div class="form-group n_height">
                                        <label>Roll Number</label>
                                            <input id="roll_no" class="remove__outline form-control  mb-3" type="text" value="<?php echo $v['roll_no']; ?>"
                                                name="roll_no">
                                        </div>
                                        <div class="form-group n_height">
                                        <label>Phone</label>
                                            <input id="phone" class="remove__outline form-control  mb-3" type="text" value="<?php echo $v['phone']; ?>"
                                                name="phone">
                                        </div>
                                        <div class="form-group n_height">
                                        <label>Email</label>
                                            <input id="email" class="remove__outline form-control  mb-3" type="email" value="<?php echo $v['email']; ?>"
                                                name="email">
                                        </div>
                                        <div class="form-group n_height">
                                        <label>Address</label>
                                            <input id="address" class="remove__outline form-control  mb-3" type="text" name="address"
                                               value="<?php echo $v['address']; ?>">
                                        </div>
                                        <div class="form-group n_height">
                                            <input id="submit" name="submit" class="remove__outline form-control submit_btn"
                                                type="submit" value="Update">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal End -->
                                 <?php
                              }                              
                              ?>
                              </div>

                            
                              </div>
                              <?php
                           } 
                           ?>
                           
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
          </div>
<?php $this->endSection(); ?>

<?php $this->section('meta_title'); ?>
<?php echo 'Profile' ?>
<?php $this->endSection(); ?>