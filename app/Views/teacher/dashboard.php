<?php $this->extend('teacher/templates/base'); ?>
<?php $this->section('main_section'); ?>
<?php echo $this->include('teacher/templates/sidebar'); ?>
<?php
 echo '<pre>';
 print_r($_SESSION);
 echo '</pre>';

 ?>

 <div class="container">
    <div class="header-msg">
        <h2>Welcome, 'name here'.</h2>
        <h2 class="pt-2 text-dark">You haven't taken any class yet!</h2>
    </div>
    <div class="attendance-action">
         <div id="attendance_card" class="d-inline">
            <?php 
            if($records != false){
                // print_r($records);
                        foreach($records as $k => $v){
                            // foreach($v as $k1 => $v1){
                                ?>
                                <a href="http://localhost/student_attendance_master_ci_4.0.4/teacher/d/attendance/<?php echo $v['id']; ?>">
                                        <div class='inner_border'>
                                            <div>
                                                <strong>Class: </strong>
                                                <span><?php echo $v['class']; ?></span>
                                            </div>
                                            <div>
                                                <strong>Subject: </strong>
                                                <span><?php echo $v['name']; ?></span>
                                            </div>
                                            <div>
                                                <strong>Year: </strong>
                                                <span><?php echo $v['year']; ?></span>
                                            </div>
                                        </div>
                                      </a>
                                <?php
                            // }
                                // if($k1 == 'teacher_id'  || $k1 == 'id'){
                                //     continue;
                                // }
                               
                                
                        }
            }
            ?>
         </div>
        <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
        <img src="<?php echo base_url().'/public/assets/images/icons/iconfinder_plus_1814113.png'; ?>" width="75" height="75">
        </button>
         <!-- Modal Start-->
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title text-center" id="exampleModalLabel">
                                        Add Class
                                    </h2>
                                </div>
                                <div class="modal-body">
                                <!-- /teacher/d/a/class_add => /teacher/attendance/add/class_add -->
                                    <form id="attnd_class_add_form">
                                    <input type="hidden" name="teacher_id" id="teacher_id" value="<?php echo $staffId; ?>">
                                        <div class="form-group">
                                          <select name="year" id="year" class="remove__outline form-control">
                                          <?php 
                                          for($i = $date; $i >= 1985; $i--){
                                             echo "<option value='$i'>$i</option>";
                                          }
                                          ?>
                                          </select>
                                          </div>
                                          <div class="form-group">
                                              <select class="remove__outline form-control" id="class" name="class">
                                          <option value="">Select Class</option>
                                          <?php
                                          for($i = 1; $i <= 12; $i++){
                                            echo "<option value='$i'>Class $i</option>";
                                         }
                                          ?>
                                          </select>
                                          </div>
                                          <div class="form-group">
                                          <select class="remove__outline form-control" id="subject" name="subject">
                                          <option value="">Select Subject</option>
                                          <?php
                                          $subjects = ['Hindi', 'English', 'Maths', 'Science', 'Social Studies'];
                                          foreach($subjects as $k => $v){
                                            $id = $k + 1;  
                                            echo "<option value='$id'>$v</option>";
                                          } 
                                          ?>
                                          </select>
                                          </div>
                                          <div class="form-group">
                                          <input type="submit" value="Add" id="add_attendance_class" class="remove__outline form-control btn-primary">
                                          </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal End -->
    </div>
 </div>
 <?php
?>
<?php $this->endSection(); ?>