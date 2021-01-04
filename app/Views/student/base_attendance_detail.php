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
                           <h4 class="box-title">Your Attendance Details</h4>
                           
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                           
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php 
foreach($subjects as $k => $v){
?>
<div class="col-md-2">
<div class="card subject-wrapper">
<button onclick="getMonths('<?php echo $stdId; ?>', '<?php echo $k; ?>')"><?php echo $v; ?></button>
<!-- <button id="<?php// echo $k; ?>" onclick="get_attendance_detail('<?php //echo $stdId; ?>', '<?php// echo $k; ?>')"><?php //echo $v; ?></button> -->
</div>
</div>
<?php
}
?>
<div class="col-md-12">
<!-- <div class="form-group">
   <label for="my-select">Text</label> -->
   <div class="select-year-attendance">
   <select id="attendance_year_session" class="remove__outline form-control" name="">
      <?php 
      // $date = date('Y');
      // $k = $date;
      // for($i = 1990; $i <= $date; $i++) {
      //    echo "<option value='$k'>$k</option>";
      //    $k--;
      // }
      $date = date('Y');
      for($i = $date; $i >= 1990; $i--) {
         echo "<option value='$i'>$i</option>";
      }
      ?>
   </select>
   </div>
<!-- </div> -->
</div>
<div class="col-md-12" id="attendance_result"></div>
<div class="col-md-10" id="attendance_result_chart">

<!-- </div> -->
</div>
            </div>
          </div>
<?php $this->endSection(); ?>

<?php $this->section('meta_title'); ?>
<?php echo 'Profile' ?>
<?php $this->endSection(); ?>