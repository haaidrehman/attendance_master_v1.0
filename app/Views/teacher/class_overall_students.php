<?php $this->extend('teacher/templates/base'); ?>
<?php $this->section('staff_greet'); ?>
<?php echo $staff_name; ?>
<?php $this->endSection(); ?>
<?php $this->section('main_section'); ?>
<?php echo $this->include('teacher/templates/sidebar'); ?>
<div class="content append-dark-bg pb-0">
<?php 
echo '<pre>';
print_r($records);
echo '</pre>';

?>
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h4 class="box-title">Student Detail</h4>
                  <div class="float-left">
                     <h4 class="mb-2"><strong>Class:</strong> <?php //echo $class; ?></h4>
                     <h4><strong>Subject:</strong> <?php //echo $subject; ?></h4>
                  </div>
                  <h4 class="float-right"><strong>Date:</strong> <span id="show_date"><?php //echo $date; ?></span></h4>
               </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                 <?php 
                 if($records != false){
                     ?>
                      <table class="table">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Roll Number</th>
                    <th>Action</th>
                    <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    $url = base_url().'/teacher/d/attendance_detail/students/detail/';
                    foreach($records as $k => $v){
                        echo "<tr>";
                        echo "<td>$i</td>";
                        echo "<td>{$v['fname']} {$v['lname']}</td>";
                        echo "<td>{$v['roll_no']}</td>";
                        echo "<td><a href='$url{$ad_id}/{$v['id']}/{$v['class_id']}/{$subject_id}' class='btn btn-primary'>See details</a></td>";
                        echo "<td></td>";
                        echo "</tr>";
                        $i++;
                    }
                    ?>
                    </tbody>
                  </table>
                     <?php
                 }
                 else{
                     ?>
                      <div class="mx-4">
                        <div class="alert alert-danger">
                           No records found!
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