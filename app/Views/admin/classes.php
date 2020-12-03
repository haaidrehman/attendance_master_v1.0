<?php $this->extend('admin/templates/base'); ?>

<?php $this->section('main_section'); ?>
<?php echo $this->include('admin/templates/sidebar'); ?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Classes</h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Class</th>
                                       <th>Session</th>
                                       <th>Class Teacher</th>
                                       <th>Action</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
          </div>
<?php echo $this->include('admin/templates/footer'); ?>
<?php $this->endSection(); ?>