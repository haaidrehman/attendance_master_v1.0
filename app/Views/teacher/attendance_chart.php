<?php $this->extend('teacher/templates/base'); ?>
<?php $this->section('staff_greet') ?>
<?php echo $staff_name; ?>
<?php $this->endSection(); ?>
<?php $this->section('main_section'); ?>
<?php echo $this->include('teacher/templates/sidebar'); ?>
<?php
//  echo '<pre>';
  //  print_r($records);
//  echo '</pre>';
?>
<div class="container append-dark-bg pt-4">
  <div class="card p-4">
    <div class="header-msg">
      <div class="float-left">
        <h3><strong>Class:</strong> <?php echo $class; ?></h3>
        <h3><strong>Subject:</strong> <?php echo $subject; ?></h3>
      </div>
      <div class="float-right">
        <h3><strong>Date:</strong> <?php echo $date; ?></h3>
      </div>
    </div>
  </div>
  <div class="attendance-chart">
    <input type="hidden" id="afct__estmsnre" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>">
    <?php
    if($records != false){
    
    
    $i = 1;
    
    foreach($records as $k => $v){
    $ab_btn = 'btn-danger';
    $pr_btn = 'btn-primary';
    $style = $text = '';
    if($v['absent'] == 1){
    $ab_btn = 'btn-success';
    $text = 'Attendance added';
    $style = 'display: block';
    }
    else if($v['present'] == 1){
    $pr_btn = 'btn-success';
    $text = 'Attendance added';
    $style = 'display: block';
    }
    ?>
    <div class="card float-left p-3 ml-2">
      <ul id="cell_<?php echo $i; ?>" class="list-unstyled">
        <li><strong>Name: </strong><span><?php echo $v['fname'].' '.$v['lname']; ?></span></li>
        <li><strong>Roll Number: </strong><span><?php echo $v['roll_no']; ?></span></li>
        <li class="a-card">
          <div class="attnd-btn-cell a">
            <a href="javascript:void(0);" class="btn <?php echo $ab_btn; ?>" onclick="add_to_attendance('0', '<?php echo $v['id']; ?>', '<?php echo $v['class_id']; ?>', '<?php echo $v['subject_id']; ?>', '<?php echo $v['roll_no']; ?>', '<?php echo $v['student_id'] ?>', '<?php echo $teacher_id; ?>', 'cell_<?php echo $i; ?>')">A</a>
          </div>
          <div class="attnd-btn-cell p">
            <a href="javascript:void(0);" class="btn <?php echo $pr_btn; ?>" onclick="add_to_attendance('1', '<?php echo $v['id']; ?>', '<?php echo $v['class_id']; ?>', '<?php echo $v['subject_id']; ?>', '<?php echo $v['roll_no']; ?>', '<?php echo $v['student_id'] ?>', '<?php echo $teacher_id; ?>', 'cell_<?php echo $i; ?>')">P</a>
          </div>
          <span class="result-text text-success" style="<?php echo $style; ?>"><?php echo $text; ?></span>
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