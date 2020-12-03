<?php $this->extend('teacher/templates/base'); ?>
<?php $this->section('main_section'); ?>
<?php echo $this->include('teacher/templates/sidebar'); ?>
<?php
//  echo '<pre>';
//  print_r($records);
//  echo '</pre>';

 ?>

 <div class="container">
    <div class="header-msg">
        <h2>Welcome, 'name here'.</h2>
        <h2 class="pt-2 text-dark">You haven't taken any class yet!</h2>
    </div>
  <div class="attendance-chart">
  <input type="hidden" id="afct__estmsnre" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>">
  <?php 
  if($records != false){
    echo '<pre>';
    print_r($records);
    echo '</pre>';
    $i = 1;
    foreach($records as $k => $v){
        ?>
        <div class="attendance-col float-left px-3 py-4 mr-3">
              <!-- <div class="float-left">Name</div><span><?php echo $v['fname'].' '.$v['lname']; ?></span><br>
              <div class="float-left">Roll Number</div><span><?php echo $v['roll_no']; ?></span> -->
              <ul id="cell_<?php echo $i; ?>" class="list-unstyled">
              <li><strong>Name: </strong><span><?php echo $v['fname'].' '.$v['lname']; ?></span></li>
              <li><strong>Roll Number: </strong><span><?php echo $v['roll_no']; ?></span></li>
              <li class="a-card">
                <div class="attnd-btn-cell a">
                <a href="javascript:void(0);" class="btn btn-danger" onclick="add_to_attendance('0', '<?php echo $v['id']; ?>', '<?php echo $v['class_id']; ?>', '<?php echo $v['subject_id']; ?>', '<?php echo $v['roll_no']; ?>', '<?php echo $v['student_id'] ?>', '<?php echo $teacher_id; ?>', 'cell_<?php echo $i; ?>')">A</a>
                </div>
                <div class="attnd-btn-cell p">
                <a href="javascript:void(0);" class="btn btn-primary" onclick="add_to_attendance('1', '<?php echo $v['id']; ?>', '<?php echo $v['class_id']; ?>', '<?php echo $v['subject_id']; ?>', '<?php echo $v['roll_no']; ?>', '<?php echo $v['student_id'] ?>', '<?php echo $teacher_id; ?>', 'cell_<?php echo $i; ?>')">P</a>
                </div>
                <span class="result-text text-success"></span>
              </li>
              </ul>
        </div>
        <?php
        $i++;
    }
  }
  ?>
  
  </div>
 </div>
 <?php
?>
<?php $this->endSection(); ?>