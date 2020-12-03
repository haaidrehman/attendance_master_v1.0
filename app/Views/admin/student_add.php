<?php
$session = Config\Services::session();

?>
<?php $this->extend('admin/templates/base'); ?>

<?php $this->section('main_section'); ?>
<?php echo $this->include('admin/templates/sidebar'); ?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">

                    <?php
                        if($records != null){
                            ?>
                    <div class="card-body">
                        <h4 class="box-title">New Registrations For Class <?php echo $std_class; ?></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fisrt Name</th>
                                        <th>Last Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Class</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    echo '<pre>';
                                    print_r($records); 
                                    echo '</pre>';
                                        $i = 1;
                                       foreach($records as $v){
                                         ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <?php 
                                          foreach($v as $k => $v1){
                                             if($k == 'uniqid'){
                                                continue;
                                             }
                                           ?>
                                        <td><?php echo $v1; ?></td>
                                        <?php 
                                          } 
                                          ?>
                                        <td><a href="<?php echo base_url('/registrations/class/'.$std_class.'/'.$v['uniqid']); ?>"
                                                class="std_add_btn">Add</a></td>
                                    </tr>
                                    <?php 
                                       $i++;
                                       }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                        }
                        else{
                            ?>
                    <div class="card-body">
                        <h4 class="box-title p_request_msg">No Pending Registrations For Class <?php echo $std_class; ?>
                        </h4>
                    </div>
                    <?php
                         }
                       ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->include('admin/templates/footer'); ?>
<?php $this->endSection(); ?>