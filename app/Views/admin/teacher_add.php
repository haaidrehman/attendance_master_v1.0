<?php  
$session = Config\Services::session();

$success_msg = $stf_err_msg = $phoneErr = $emailErr = $usernameErr = '';


if($colm_data_exist != null){
   if(isset($colm_data_exist['phone_err'])){
      $phoneErr = $colm_data_exist['phone_err'];
   }
   if(isset($colm_data_exist['email_err'])){
      $emailErr = $colm_data_exist['email_err'];
   }
   if(isset($colm_data_exist['username_err'])){
    $usernameErr = $colm_data_exist['username_err'];
 }
}
else if($session->getTempdata('staff_reg_success')){
   $success_msg = $session->getTempdata('staff_reg_success'); 
}
else if($session->getTempdata('staff_error')){
    $stf_err_msg = $session->getTempdata('staff_error');
}



// echo '<pre>';
// print_r($colm_data_exist);
// exit();
?>
<?php $this->extend('admin/templates/base'); ?>

<?php $this->section('main_section'); ?>
<?php echo $this->include('admin/templates/sidebar'); ?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Add Teacher</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Start Contact Area -->
                        <section class="t_register_section">
                            <div class="container">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="contact-form-wrap mt--60">
                                            <div class="col-xs-12">
                                                <form id="contact-form" method="post"
                                                    action="<?php echo base_url('/teacher/add'); ?>">
                                                    <div class="form-group n_height">
                                                        <input id="fname" class="form-control" type="text" name="fname"
                                                            placeholder="First Name"
                                                            value="<?php echo set_value('fname'); ?>">
                                                        <input id="lname" class="form-control" type="text"
                                                            value="<?php echo set_value('lname'); ?>" name="lname"
                                                            placeholder="Last Name">
                                                    </div>
                                                    <div class="form-group c_height">
                                                        <!-- <input id="my-input" class="form-control" type="text" name=""> -->
                                                        <div class="form-control radio-input-field">
                                                            <label for="my-input"
                                                                class="form-check-label">Gender</label>
                                                            <div class="form-check form-check-inline ml-3">
                                                                <input id="gender" class="form-check-input" type="radio"
                                                                    name="gender" value="Male">
                                                                <label for="my-input"
                                                                    class="form-check-label">Male</label>
                                                                <input id="gender" class="form-check-input" type="radio"
                                                                    name="gender" value="Female">
                                                                <label for="my-input"
                                                                    class="form-check-label">Female</label>
                                                            </div>
                                                        </div>
                                                        <input id="phone" class="form-control" type="text"
                                                            value="<?php echo set_value('phone'); ?>" name="phone"
                                                            placeholder="Phone" style="height: 50px;">
                                                    </div>
                                                    <div class="form-group n_height">
                                                        <input id="email" class="form-control" type="email"
                                                            value="<?php echo set_value('email'); ?>" name="email"
                                                            placeholder="Email">
                                                        <input id="username" class="form-control" type="text"
                                                            value="<?php echo set_value('username'); ?>" name="username"
                                                            placeholder="Username">

                                                    </div>
                                                    <div class="form-group n_height">
                                                        <input id="password" class="form-control" type="text"
                                                            name="password" placeholder="Set Password">
                                                        <input id="address" class="form-control" type="text"
                                                            value="<?php echo set_value('address'); ?>" name="address"
                                                            placeholder="Address">
                                                    </div>
                                                    <div class="form-group n_height">
                                                        <input id="submit" name="submit" class="form-control submit_btn"
                                                            type="submit">
                                                        <!-- <a href="" id="submit"
                                                            class="form-control submit_btn text-center">Submit</a> -->
                                                    </div>
                                                </form>
                                                <div class="form-output">
                                                    <?php 
                                                    if(!empty($success_msg)){
                                                       ?><p class="alert-success"><?php echo $success_msg; ?></p><?php     
                                                    }
                                                    else if(!empty($stf_err_msg)){
                                                        ?><p class="alert-danger"><?php echo $stf_err_msg; ?></p><?php
                                                    }
                                                    ?>
                                                    <p style='color: red;'><?php echo $phoneErr; ?></p>
                                                    <p style='color: red;'><?php echo $emailErr; ?></p>
                                                    <p style='color: red;'><?php echo $usernameErr; ?></p>

                                                </div>
                                                <div class="alert text-danger">
                                                    <?php 
                                                    if($errors != null){
                                                        foreach($errors as $k => $v){
                                                            ?>
                                                    <span class="text-danger"><?php echo $v.'<br>'; ?></span>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </section>
                        <!-- End Contact Area -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->include('admin/templates/footer'); ?>

<br><br><br><br>
<?php $this->endSection(); ?>