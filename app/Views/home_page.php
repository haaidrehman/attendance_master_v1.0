<?php $session = Config\Services::session(); ?>
<?php $this->extend('admin/templates/base'); ?>

<?php $this->section('main_section'); ?>
<style>
/* h2 a:hover{
    color: #c5c1c1;
} */
.login-form {
    padding: 40px 30px 42px;
    border-radius: 26px;
}
.login-circle a{
    color: #ca4cfc;
}
.login-circle a:hover{
    color: white;
}
.login-circle{
    padding-top: 15px;
    padding-bottom: 5px;
    -webkit-transition: all 0.3s ease-in;
     -moz-transition: all 0.3s ease-in;
      -ms-transition: all 0.3s ease-in;
          transition: all 0.3s ease-in;
          position: relative;
}
.login-circle.l:hover{ 
    border-radius: 20px;
    transform: scale(1.2);
    background: linear-gradient(to right,#2250a2,#01a8b1);
}
.login-circle.m:hover{ 
    border-radius: 20px;
    transform: scale(1.2);
    background: linear-gradient(to right,#dc2e3e,#fdc894);
}
.login-circle.r:hover{
    border-radius: 20px;
    transform: scale(1.2);
    background: linear-gradient(to right,#e517e8,#6fd0ff);
}

</style>
<div class="bg-dark admin-login-bg">
    <div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container-fluid">
    <h2 class="pt-3 pl-3" style="color: #c5c1c1; font-family: sans-serif"><a href="<?php echo base_url(); ?>">Student Attendance Master <span style="font-size: 18px; color: #868e96; letter-spacing: -1px" class="ml-2">v1.0</span></a></h2>
    </div>
        <div class="container">
            <div class="login-content">
                <div class="login-form mt-15">
                    <div class="row">
                    <div class="col-md-4">
                    <div class="login-circle l text-center">
                    <a href="<?php echo base_url().'/student/login'; ?>" target="_blank"><img src="<?php echo base_url().'/public/assets/images/icons/password.png'; ?>" alt="" width="100"><div class="pt-3">Student Login</div></a>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="login-circle m text-center">
                    <a href="<?php echo base_url().'/teacher/login'; ?>" target="_blank"><img src="<?php echo base_url().'/public/assets/images/icons/password.png'; ?>" alt="" width="100"><div class="pt-3">Teacher Login</div></a>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="login-circle r text-center">
                    <a href="<?php echo base_url().'/admin'; ?>" target="_blank"><img src="<?php echo base_url().'/public/assets/images/icons/password.png'; ?>" alt="" width="100"><div class="pt-3">Admin Login</div></a>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>