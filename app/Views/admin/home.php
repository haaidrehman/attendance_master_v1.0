<?php $session = Config\Services::session(); ?>
<?php $this->extend('admin/templates/base'); ?>

<?php $this->section('main_section'); ?>
<?php echo $this->include('admin/templates/sidebar'); ?>
<?php 
if($session->getTempdata('error')){
  ?>
  <div class="alert">
		<span class="text-danger">
			<?php echo $session->getTempdata('error'); ?>
		</span>
   </div>
  <?php
 } 
?>

<?php $this->endSection(); ?>