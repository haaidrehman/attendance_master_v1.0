<?php $this->extend('student/templates/base'); ?>
<?php $this->section('main_section'); ?>
<section class="reg_success_bg">
<div class="container">
	<div class="row">
		<div class="offset-md-4 col-md-4">
			<div class="card__body">
				<div class="card-top">
					<div class="check-icon">
					<img src="<?php echo base_url('public/assets/images/icons/check.png'); ?>" alt="">
				</div>
				</div>
				<div class="card-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="heading-line">
								<h3 class="text-center">SUCCESS</h3>
								<p class="text-center my-4">Your registration has been done successfully.</p>
								<div class="signin-section text-center mt-4"><a href="<?php echo base_url('/login'); ?>">Sign In here <img src="<?php echo base_url('public/assets/images/icons/login.png'); ?>" alt="Sign In Icon" width="24" height="24"></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<?php $this->endSection(); ?>