<?php $session = Config\Services::session(); ?>
<?php $this->extend('teacher/templates/base'); ?>
<?php $this->section('staff_greet'); ?>
<?php echo $staff_name; ?>
<?php $this->endSection(); ?>
<?php $this->section('main_section'); ?>
<?php echo $this->include('teacher/templates/sidebar'); ?>
<div class="container append-dark-bg">
  <?php
  if($session->getFlashdata('no_std_record')){
  echo "<div class='alert alert-danger d-inline' style='margin-bottom: 0px'>{$session->getFlashdata('no_std_record')}</div>";
  }
  ?>
  <div class="attendance-h">
    <input type="hidden" id="afct__estmsnre" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>">
    <div class="card mt-5 float-left ml-3 p-4">
      <div><h4 class="mb-4">See Attendance History</h4></div>
      <input type="hidden" name="" id="ad_id" value="<?php echo $ad_id; ?>">
      <input type="hidden" name="" id="class_id" value="<?php echo $class_id; ?>">
      <input type="hidden" name="" id="subject" value="<?php echo $subject; ?>">
      <input type="date" name="date_picker" id="date_picker">
      <a href="" class="mt-2" id="pick_date">Go <img src="<?php echo base_url().'/public/assets/images/icons/iconfinder_right_2_4829869.png' ?>" alt="" width="30" height="30"></a>
    </div>
    <div class="card mt-5 float-left ml-3 p-4">
      <a href="<?php echo base_url().'/teacher/d/attendance/'.$ad_id; ?>">Take Attendance <img src="<?php echo base_url().'/public/assets/images/icons/iconfinder_right_2_4829869.png' ?>" alt="" width="30" height="30"></a>
    </div>
  </div>
</div>
<?php $this->endSection(); ?>