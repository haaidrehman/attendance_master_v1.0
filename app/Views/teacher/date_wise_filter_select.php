<?php $this->extend('teacher/templates/base'); ?>
<?php $this->section('staff_greet') ?>
<?php echo $staff_name; ?>
<?php $this->endSection(); ?>
<?php $this->section('main_section'); ?>
<?php echo $this->include('teacher/templates/sidebar'); ?>
<?php
if($records != false){
?>
<div class="content append-dark-bg pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <?php
            if(isset($dynamic_date)){
            ?>
            <div class="card my-3 p-3">
               <div class="float-right">
                  <label><strong>Select date:</strong></label>
                  <input type="date" name="date" id="select_date" onchange="date_selector('<?php echo $ad_id; ?>', '<?php echo $class; ?>')">
               </div>
            </div>
            <?php
            }
            ?>
            <div class="card">
               <div class="card-body">
                  <h4 class="box-title">Attendance History</h4>
                  <div class="float-left">
                     <h4 class="mb-2"><strong>Class:</strong> <?php echo $class; ?></h4>
                     <h4><strong>Subject:</strong> <?php echo $subject; ?></h4>
                  </div>
                  <h4 class="float-right"><strong>Date:</strong> <span id="show_date"><?php echo $date; ?></span></h4>
               </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                     
                     <table class="table">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Roll Number</th>
                              <th>Present</th>
                              <th>Absent</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $i = 1;
                           foreach($records as $k => $v){
                           ?>
                           <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $v['fname'].' '.$v['lname']; ?></td>
                              <td><?php echo $v['roll_no']; ?></td>
                              <td>
                                 <?php
                                 if($v['present'] == 1){
                                 ?>
                                 <img src="<?php echo base_url().'/public/assets/images/icons/iconfinder_check_square_3830978.png'; ?>">
                                 <?php
                                 }
                                 else if($v['present'] == 0){
                                 ?>
                                 <img src="<?php echo base_url().'/public/assets/images/icons/iconfinder_close_3830967.png'; ?>" width="36" height="36">
                                 <?php
                                 }
                                 ?>
                              </td>
                              <td>
                                 <?php
                                 if($v['absent'] == 1){
                                 ?>
                                 <img src="<?php echo base_url().'/public/assets/images/icons/iconfinder_check_square_3830978.png'; ?>">
                                 <?php
                                 }
                                 else if($v['absent'] == 0){
                                 ?>
                                 <img src="<?php echo base_url().'/public/assets/images/icons/iconfinder_close_3830967.png'; ?>" width="36" height="36">
                                 <?php
                                 }
                                 ?>
                              </td>
                              <td></td>
                           </tr>
                           <?php
                           $i++;
                           }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
}
else{
?>

<div class="content append-dark-bg pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <?php
            if(isset($dynamic_date)){
            ?>
            <div class="card my-3 p-3">
               <div class="float-right">
                  <label><strong>Select date:</strong></label>
                  <input type="date" name="date" id="select_date" onchange="date_selector('<?php echo $ad_id; ?>', '<?php echo $class; ?>')">
               </div>
            </div>
            <?php
            }
            ?>
            <div class="card">
               <div class="card-body">
                  <h4 class="box-title">Attendance History</h4>
                  <div class="float-left">
                     <h4 class="mb-2"><strong>Class:</strong> <?php echo $class; ?></h4>
                     <h4><strong>Subject:</strong> <?php echo $subject; ?></h4>
                  </div>
                  <h4 class="float-right"><strong>Date:</strong> <span id="show_date"><?php echo $date; ?></span></h4>
               </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                     <div class="mx-4">
                        <div class="alert alert-danger">
                           No records found!
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php
}
?>

<?php $this->endSection(); ?>