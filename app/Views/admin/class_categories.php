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
                    <div class="card-body">
                        <h4 class="box-title">New Registrations</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class</th>
                                        <th>New Registrations</th>
                                        <th>Action</th>
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
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <?php
                                        foreach($v as $k => $v1){
                                            if($k == 'id' || $k == 'status'){
                                                continue;
                                            }
                                            else if($k == 'new_reg' && $v['new_reg'] == 'YES'){
                                              ?>
                                        <td style="color: red;"><?php echo $v1; ?></td>
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
                                            <a
                                                href="<?php echo base_url('/registrations/class/'.$v['id']); ?>">Explore</a>
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

<?php echo $this->include('admin/templates/footer'); ?>
<?php $this->endSection(); ?>