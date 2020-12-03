<?php $this->extend('admin/templates/base'); ?>

<?php $this->section('main_section'); ?>
<?php echo $this->include('admin/templates/sidebar'); ?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Time Table</h4>
                        </div>
                        <div class="card-body--">
                           <div class="time_tbl">
                              <table class="table ">
                                 <thead>
                                 <tr>
                                 <th></th>
                                 <th colspan="5"><strong>Subjects</strong></th>
                                 </tr>
                                    <tr>
                                       <th>Class</th>
                                       <th>Hindi</th>
                                       <th>English</th>
                                       <th>Maths</th>
                                       <th>Science</th>
                                       <th>Social Studies</th>
                                    </tr>
                                    <tr><td align="center" colspan="6" style="letter-spacing: 7px">Subject Teachers</td></tr>
                                 </thead>
                                 <tbody>
                                 <?php 
                                    for($i = 1; $i <= 12; $i++){
                                        ?>
                                        <tr colspan="1">
                                        <td><?php echo $i; ?></td>
                                        
                                        </tr>
                                        
                                        <?php
                                    }
                                    ?>
                                 </tbody>
                              </table>
                              <table class="table">
                              <tr>
                                       <th>Hindi</th>
                                       <th>English</th>
                                       <th>Maths</th>
                                       <th>Science</th>
                                       <th>Social Studies</th>
                                    </tr>
                                    <tr>
                                    
                                    </tr>
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