<?php $this->extend('student/templates/base'); ?>
<?php $this->section('main_section'); ?>
<div class="container">
    <?php 
if($success_msg != null){
  ?>
    <div class="alert alert-success mx-auto text-center mt-5">
        <p style="color: #758594;"><?php echo $success_msg; ?></p>
    </div>
    <?php
}
else if($err_msg){
    ?>
    <div class="alert alert-danger mx-auto text-center mt-5">
        <p style="color: #758594;"><?php echo $err_msg; ?></p>
    </div>
    <?php
}

?>
</div>
<?php $this->endSection(); ?>