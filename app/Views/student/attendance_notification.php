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

            </div>
          </div>
<?php $this->endSection(); ?>

<?php $this->section('meta_title'); ?>
<?php echo 'Profile' ?>
<?php $this->endSection(); ?>