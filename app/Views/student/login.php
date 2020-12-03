<?php $this->extend('student/templates/base'); ?>

<?php $this->section('main_section'); ?>
<div class="bg-dark admin-login-bg">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form mt-150">
                    <form method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="email" name="email" class="form-control"
                                value="<?php echo set_value('email'); ?>" placeholder="Email">
                            <span class="field-error">
                                <?php
                           if($valid_err_email != null){
                                echo $valid_err_email;
                           }
                           ?>

                            </span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <span class="field-error">
                                <?php
                           if($valid_err_pass != null){
                            echo $valid_err_pass;
                       }
                           ?>
                            </span>
                        </div>
                        <button type="submit" name="submit" value="submit"
                            class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    </form>
                    <div class="pt-2 register_link">Not registerd?<a href="<?php echo base_url('/register'); ?>">
                            Sign Up
                            Here</a></div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>