<?php
$session = Config\Services::session();
$box_title = 'Select Students According To Class'; 
if($class_id != null){                    
    $box_title = "Students - Class $class_id";
 }
?>
<?php $this->extend('admin/templates/base'); ?>

<?php $this->section('main_section'); ?>
<?php echo $this->include('admin/templates/sidebar'); ?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title"><?php echo $box_title; ?></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>

                                        <?php
                                        if($class_id != null){
                                          ?>
                                        <th>#</th>
                                        <th>Fisrt Name</th>
                                        <th>Last Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Class</th>
                                        <th>Roll No.</th>
                                        <th>Reg. Id.</th>
                                        <th>Added On</th>
                                        <th>Action</th>
                                        <?php
                                        }
                                        else{
                                            ?>
                                        <th>#</th>
                                        <th>Class</th>
                                        <th>Action</th>
                                        <?php
                                        }
                                        ?>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  if($records != null){
                                    //   echo '<pre>';
                                    //   print_r($records);
                                    //   echo '</pre>';
                                    $i = 1;
                                    foreach($records as $v){
                                        ?>
                                    <tr id="row_<?php echo $i; ?>">
                                        <td><?php echo $i; ?></td>
                                        <?php
                                        foreach($v as $k => $v1){
                                            if($k == 'id' || $k == 'class_id'){
                                                continue;
                                            }
                                            else if($k == 'roll_no'){
                                                ?>
                                        <td id="roll_no_field"><?php echo $v1; ?></td>
                                        <?php 
                                            }
                                          else{
                                            ?>
                                        <td><?php echo $v1; ?></td>
                                        <?php 
                                          }
                                        }
                                        ?>
                                        <td>
                                            <?php
                                            if($class_id == null){
                                            ?>
                                            <a href="<?php echo base_url('/class/detail/'.$v['id']); ?>">Explore</a>
                                            <?php
                                            }
                                            else if($v['roll_no'] != 'null'){
                                               ?>
                                            <span style="color: green;">Roll Assigned</span>
                                            <?php
                                            }
                                            else{
                                                ?>
                                            <a href="javascript:void(0);" class="btn btn-primary" id="<?php echo $i; ?>"
                                                onclick="make_input_field('<?php echo $i; ?>', '<?php echo $class_id; ?>', '<?php echo $v['id']; ?>')">
                                                Add Roll No
                                            </a>
                                            <?php// echo $i; ?>
                                            <?php
                                            }
                                            ?>

                                        </td>
                                        <td></td>
                                    </tr>
                                    <?php
                                     $i++;
                                    }
                                  }
                                  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Roll No.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label>First Name</label>
                        <input id="fname" class="form-control r_outline" type="text">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input id="lname" class="form-control r_outline" type="text">
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input id="age" class="form-control r_outline" type="text">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <input id="gender" class="form-control r_outline" type="text">
                    </div>
                    <div class="form-group">
                        <label>Class</label>
                        <input id="class" class="form-control r_outline" type="text">
                    </div>
                    <div class="form-group">
                        <label>Roll No.</label>
                        <input id="roll_no" class="form-control r_outline" type="text">
                    </div>
                    <div class="form-group">
                        <label>Registration Id</label>
                        <input id="reg_id" class="form-control r_outline" type="text">
                    </div>
                    <div class="form-group">
                        <label>Added On</label>
                        <input id="added_on" class="form-control r_outline" type="text">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php echo $this->include('admin/templates/footer'); ?>
<?php $this->endSection(); ?>