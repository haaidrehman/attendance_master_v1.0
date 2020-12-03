<?php $session = Config\Services::session(); ?>
<?php $this->extend('admin/templates/base'); ?>

<?php $this->section('main_section'); ?>
<div class="bg-dark admin-login-bg">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form mt-150">
                    <form method="post">
                        <input type="hidden" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control"
                                value="<?php echo set_value('username'); ?>" placeholder="Username">
                            <span class="field-error">
                                <?php
                           if($valid_username_err != null){
                                echo $valid_username_err;
                           }
                           ?>

                            </span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <span class="field-error">
                                <?php
                           if($valid_password_err != null){
                                 echo $valid_password_err;   
                           }
                           ?>
                            </span>
                        </div>
                        <button type="submit" name="submit" value="submit"
                            class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>