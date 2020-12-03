<?php 
$session = Config\Services::session();

$otp_btn = 'Send OTP';
// $disabled = '';
// $submit_disabled = 'disabled';

if($session->getTempdata('OTP_SENT')){
   $otp_btn = $session->getTempdata('OTP_SENT');
}
if($session->has('OTP_VERIFIED')){
  // $disabled = 'disabled';
  // $submit_disabled = '';
}

?>
<?php $this->extend('student/templates/base'); ?>
<?php $this->section('main_section'); ?>
<style>
.width-max {
    width: 26px;
}
</style>
<!-- Start Contact Area -->
<section class="std_register_section" style="background: #b2c1ff;">
    <div class="container">
        <div class="row">

            <div class="offset-md-3 col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line__6" style="color: white">Register Here</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="contact-form" method="post" action="<?php echo base_url('/register'); ?>">
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" id="fname" name="fname" placeholder="Your First Name*"
                                        style="width:100%" value="<?php echo set_value('fname'); ?>">
                                </div>
                                <span id="fname_err_msg" class="err_msg"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" id="lname" name="lname" placeholder="Your Last Name*"
                                        style="width:100%" value="<?php echo set_value('lname'); ?>">
                                </div>
                                <span id="lname_err_msg" class="err_msg"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name pos_relative">
                                    <input type="text" id="age" name="age" placeholder="Your Age*" style="width:50%"
                                        value="<?php echo set_value('age'); ?>">
                                    <span id="age_err_msg" class="err_msg"></span>
                                    <div class="right_gender_section">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-check-label text-white"><strong>Gender
                                                        *</strong></label>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check-inline">
                                                    <input type="radio" name="gender" class="form-check-input width-max"
                                                        id="gender" value="Male">Male
                                                </div>
                                                <div class="form-check-inline">
                                                    <input type="radio" name="gender" class="form-check-input width-max"
                                                        id="gender" value="Female">Female
                                                </div>

                                            </div>
                                        </div>
                                        <span id="gender_err_msg" class="err_msg"></span>
                                    </div>



                                </div>
                                <div class="contact-box name">
                                </div>
                            </div>
                            <div class="single-contact-form my-2">
                                <div class="contact-box name">
                                    <select name="class" id="std_class" class="ht__select"
                                        style="background: white; width:50%">
                                        <option value="">Select Class*</option>
                                        <?php
										$i = 1;
										while($i <= 12){
										?>
                                        <option value="<?php echo $i; ?>">Class <?php echo $i; ?></option>
                                        <?php
										$i++;
										}
										?>

                                    </select>
                                    <span id="class_err_msg" class="err_msg"></span>
                                </div>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" id="phone" name="phone" placeholder="Your Mobile*"
                                        style="width:100%" value="<?php echo set_value('phone'); ?>">
                                </div>
                                <?php 
                                if($phone_exist != null){
                                    ?>
                                <span id="phone_err_msg"
                                    class="p_err_msg text-danger"><?php echo $phone_exist; ?></span>
                                <?php
                                }
                                ?>
                                <span id="phone_err_msg" class="p_err_msg"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <?php
                                  if($session->getTempdata('OTP_VERIFIED')){
                                      ?>
                                    <input type="text" id="email" name="email" placeholder="Email*" style="width:45%"
                                        value="<?php echo set_value('email'); ?>">
                                    <input type="text" id="email_otp" name="email_otp" class="email_verify_otp"
                                        placeholder="OTP*" style="width:45%"
                                        value="<?php echo set_value('email_otp'); ?>">
                                    <button type="button" class="fv-btn otp-btn email_verify_otp" disabled>OTP
                                        Verified</button>
                                    <?php
                                    $dis = '';
                                  }
                                  else{
                                      ?>
                                    <input type="text" id="email" name="email" placeholder="Email*" style="width:45%"
                                        value="<?php echo set_value('email'); ?>">
                                    <span id="email_err_msg" class="err_msg"></span>
                                    <button type="button" id="otp_sent_btn" class="fv-btn otp-btn"
                                        onclick="email_sent_otp()"><?php echo $otp_btn; ?></button>
                                    <input type="text" id="email_otp" name="email_otp" class="email_verify_otp"
                                        placeholder="OTP*" style="width:45%"
                                        value="<?php echo set_value('email_otp'); ?>">
                                    <span id="otp_err_msg" class="err_msg"></span>
                                    <button type="button" id="otp_verify_btn" class="fv-btn otp-btn email_verify_otp"
                                        onclick="email_verify_otp()" disabled>Verify OTP</button>
                                    <span id="otp_result"></span>
                                    <?php
                                     $dis = 'disabled';
                                  }  
                                ?>

                                </div>
                                <span id="email_err_msg" class="err_msg"></span>
                            </div>

                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" id="password" name="password" placeholder="Your Password*"
                                        style="width:100%" value="<?php echo set_value('password'); ?>">
                                </div>
                                <span id="password_err_msg" class="p_err_msg"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" id="address" name="address" placeholder="Your Address*"
                                        style="width:100%" value="<?php echo set_value('address'); ?>">
                                </div>
                                <span id="addr_err_msg" class="err_msg"></span>
                            </div>
                            <div class="contact-btn">
                                <button type="submit" id="form_register" class="fv-btn"
                                    <?php echo $dis; ?>>Register</button>
                            </div>
                            <!-- <input type="hidden" id="email_true">
							<input type="hidden" id="phone_true"> -->
                        </form>
                        <div class="form-output">
                            <p class="form-messege" id="reg_success_msg"></p>

                            <?php 
                             if($validator != null){
                             	echo '<pre>';
                                print_r($validator->listErrors());
                                echo '</pre>';
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
<?php $this->endSection(); ?>