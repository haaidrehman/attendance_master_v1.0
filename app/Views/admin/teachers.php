<?php $session = Config\Services::session(); ?>
<?php $this->extend('admin/templates/base'); ?>

<?php $this->section('main_section'); ?>
<?php echo $this->include('admin/templates/sidebar'); ?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Staff Details</h4>
                        <?php 
                        
                        if($session->getTempdata('staff_record_update')){
                            ?>
                        <p class="alert alert-success"><?php echo $session->getTempdata('staff_record_update'); ?>
                        </p>
                        <?php
                        }
                        else if($session->getTempdata('staff_record_update_err')){
                            ?>
                        <p class="alert alert-danger"><?php echo $session->getTempdata('staff_record_update_err'); ?>
                        </p>
                        <?php
                        }
                        
                        else if($session->getTempdata('resend_link')){
                            ?>
                        <p class="alert alert-primary"><?php echo $session->getTempdata('resend_link'); ?></p>
                        <?php
                        }
                        
                        ?>
                    </div>
                    <?php 
                     if($records != false){
                        ?>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Staff Name</th>
                                        <th>Gender</th>
                                        <th>Registration Date</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Class</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                        <th></th>
                                    </tr>
                                    <?php 
                                    $i = 1;
                                    foreach($records as $p => $v){

                                       ?><tr id="row_<?php echo $i; ?>">
                                        <td><?php echo $i; ?></td>
                                        <?php foreach($v as $k => $v1){
                                           
                                            if($k === 'id'){
                                                ?>
                                        <input type="hidden" id="staff_id" value="<?php echo $v1; ?>">
                                        <?php
                                                continue;
                                            }
                                           ?>
                                        <td id="td_<?php echo $k; ?>"><?php echo $v1; ?></td>
                                        <?php
                                          }
                                          ?>
                                        <input type="hidden" id="fname" value="<?php echo $split_names[$p]['fname'] ?>">
                                        <input type="hidden" id="lname" value="<?php echo $split_names[$p]['lname'] ?>">
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal" onclick="editModal('<?php echo $i; ?>')">
                                                Manage
                                            </button>
                                        </td>
                                    </tr><?php
                                    $i++;
                                    }
                                    ?>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                     }
                     ?>
                    <!-- Modal Start-->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center" id="exampleModalLabel">
                                        Staff Details
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="contact-form" method="post"
                                        action="<?php echo base_url('/teacher/manage'); ?>">
                                        <div class="form-group n_height">
                                            <input type="hidden" name="staff_id" id="staff_id">
                                            <label style="float-left">First Name</label>
                                            <input id="fname" class="form-control mb-3" type="text" name="fname"
                                                placeholder="First Name" value="">
                                                <label>Last Name</label>
                                            <input id="lname" class="form-control mt-3" type="text" value=""
                                                name="lname" placeholder="Last Name">
                                        </div>
                                        <div class="form-group c_height">
                                            <!-- <input id="my-input" class="form-control" type="text" name=""> -->
                                            <div class="form-control radio-input-field  mb-3">
                                                <label for="my-input" class="form-check-label float-left">Gender</label>
                                                <div class="form-check form-check-inline ml-3">
                                                    <input id="gender_male" class="form-check-input" type="radio"
                                                        name="gender" value="Male">
                                                    <label for="my-input" class="form-check-label">Male</label>
                                                    <input id="gender_female" class="form-check-input" type="radio"
                                                        name="gender" value="Female">
                                                    <label for="my-input" class="form-check-label">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group n_height">
                                        <label>Registration date</label>
                                            <input id="reg_date" class="form-control  mb-3" type="text" value=""
                                                name="reg_date">
                                        </div>
                                        <div class="form-group n_height">
                                        <label>Email</label>
                                            <input id="email" class="form-control  mb-3" type="email" value=""
                                                name="email" placeholder="Email">
                                                <label>Phone</label>
                                            <input id="phone" class="form-control" type="text" value="" name="phone"
                                                placeholder="Phone" style="height: 50px;">

                                        </div>
                                        <div class="form-group">
                                        <label>Status</label>
                                            <input id="status" class="form-control  mt-3" type="text" value=""
                                                name="status" placeholder="status">

                                        </div>
                                        <div class="form-group n_height">
                                        <label>Class</label>
                                            <input id="class" class="form-control  mb-3" type="text" name="class"
                                                placeholder="class">
                                                <label>Subject</label>
                                            <input id="subject" class="form-control  mt-3" type="text" value=""
                                                name="subject" placeholder="Subject">
                                        </div>
                                        <div class="form-group n_height">
                                            <input id="submit" name="submit" class="form-control submit_btn"
                                                type="submit" value="Update">
                                            <!-- <a href="" id="submit"
                                                            class="form-control submit_btn text-center">Submit</a> -->
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="<?php echo base_url().'/teacher/activation_link/'; ?>"
                                        class="btn btn-primary" id="act_link">Send Activation
                                        Link</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal End -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->include('admin/templates/footer'); ?>
<?php $this->endSection(); ?>