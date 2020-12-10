<?php $this->extend('teacher/templates/base'); ?>
<?php $this->section('staff_greet'); ?>
<?php echo $staff_name; ?>
<?php $this->endSection(); ?>
<?php $this->section('main_section'); ?>
<?php echo $this->include('teacher/templates/sidebar'); ?>
<div class="content append-dark-bg pb-0">
<?php 
// echo '<pre>';
// print_r($records);
// echo '</pre>';

?>
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <div class="float-left">
                    <h4 class="box-title">Student Detail</h4>
                     <h4 class="mb-2"><strong>Class:</strong> <?php echo $class_id; ?></h4>
                  </div>
                  <div class="float-right">
                  <strong>Attendance detail</strong>
                  <span class="ml-3">
                  <table>
                  <tr>
                  <td><small><b>Starting date</b></small></td>
                  <td>&nbsp;<small><b>Ending date</b></small></td>
                  </tr>
                  <tr>
                  <td><input type="date" name="starting_date" id="a_starting_date"></td>
                  <td>&nbsp;<input type="date" name="ending_date" id="a_ending_date"></td>
                  <td><button onclick="attendance_search_result('<?php echo $ad_id; ?>', '<?php echo $records[0]['id']; ?>', '<?php echo $subject_id; ?>')">Search</button></td>
                  </tr>
                  </table>
                 
                  
                  </span>
                  </div>
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
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
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
                        echo "<td>{$v['age']}</td>";
                        echo "<td>{$v['gender']}</td>";
                        echo "<td>{$v['phone']}</td>";
                        echo "<td>{$v['email']}</td>";
                        echo "<td>{$v['address']}</td>";
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
            <div id="range_table">
                    
             </div>
         </div>
      </div>
   </div>
</div>
<?php $this->endSection(); ?>