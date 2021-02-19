<?php if($this->session->flashdata('branches_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
     <?php echo $this->session->flashdata('branches_success'); ?>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('redirect_applications_message')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
       <?php echo $this->session->flashdata('redirect_applications_message'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('list_success_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('list_success_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('list_error_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('list_error_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<div class="row">
  <?php if($is_client) :?>
  <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
    <a class="btn btn-color-blue btn-block" href="<?php echo base_url();?>branches/registration" role="button">New Branch/Satellite Registration</a>
  </div>
  <?php endif; ?>
  <?php if(!$is_client && $admin_info->access_level == 3) : ?>
    <?php if($admin_info->is_director_active == 1) : ?>
    <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
      <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#grantSupervisorModal"><i class='fas fa-user-plus'></i> Grant All Privileges to Supervisor</button>
    </div>
    <?php else : ?>
      <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
        <button type="button" class="btn btn-warning text-white btn-block" data-toggle="modal" data-target="#revokeSupervisorModal"><i class='fas fa-user-times'></i> Revoke all Authority of Supervising CDS</button>
      </div>
    <?php endif; ?>
  <?php endif;?>
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperativesTable">
            <thead>
              <tr>
                <th>Name of Cooperative</th>
                <th>Branch</th>
                <th>Location</th>
                <th>Status</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_branches as $branch) : ?>
                <tr>
                  <td><?= $branch['coopName']?></td>
                  <?php
                    if($branch['area_of_operation'] == 'Barangay' || $branch['area_of_operation'] == 'Municipality/City'){
                      $brancharea = $branch['brgy'];
                  } else if($branch['area_of_operation'] == 'Provincial') {
                      $brancharea = $branch['city'];
                  } else if ($branch['area_of_operation'] == 'Regional') {
                      $brancharea = $branch['city'].', '.$branch['province'];
                  } else if ($branch['area_of_operation'] == 'National') {
                      $brancharea = $branch['city'].', '.$branch['province'];
                  }

                    // if($branch['area_of_operation'] == 'Provincial'){
                    //     $brancharea = $branch['city'];
                    // } else if ($branch['area_of_operation'] == 'Municipality/City'){
                    //     $brancharea = $branch['brgy'];
                    // } else {
                    //     $brancharea = $branch['brgy'].', '. $branch['city'];
                    // }
                  ?>
                  <td><?php echo $brancharea .' '.$branch['branchName']?></td>
                  <td>
                    <?php if($branch['house_blk_no']==null && $branch['street']==null) $x=''; else $x=', ';?>
                    <?=$branch['house_blk_no']?> <?=$branch['street'].$x?> <?=$branch['brgy']?>, <?=$branch['city']?>, <?= $branch['province']?> <?=$branch['region']?>
                  </td>
                  <td>
                      <span class="badge badge-secondary">
                      <!-- <?php if($is_client) : ?>
                        <?php if($branch['status']==0) echo "EXPIRED"; ?>
                        <?php if($branch['status']==1) echo "PENDING"; ?>
                        <?php if($branch['status']>=2 && $branch['status']<=15) echo "ON VALIDATION"; ?>
                        <?php if($branch['status']==16) echo "DENIED"; ?>
                        <?php if($branch['status']==17) echo "DEFERRED"; ?>
                        <?php if($branch['status']==18) echo "WAITING FOR PAYMENT"; ?>
                        <?php if($branch['status']==19) echo "PAY AT CDA"; ?>
                        <?php if($branch['status']==20) echo "GET YOUR CERTIFICATE"; ?>
                        <?php if($branch['status']==21) echo "REGISTERED"; ?>
                        <?php if($branch['status']==22) echo "FOR PAYMENT"; ?>
                        <?php if($branch['status']==23) echo "SUBMITTED BY SENIOR CDS"; ?>
                        <?php if($branch['status']==24) echo "ON VALIDATION"; ?>
                      <?php else : ?> -->
                        <?php if($branch['status']==2) echo "FOR VALIDATION";
                        else if($branch['status']==3) echo "DENIED BY SENIOR CDS";
                        else if($branch['status']==4) echo "DEFERRED BY SENIOR CDS";
                        else if($branch['status']==5) echo "SUBMITTED BY SENIOR CDS";
                        else if($branch['status']==6) echo "DENIED BY DIRECTOR";
                        else if($branch['status']==7) echo "DEFERRED BY DIRECTOR";
                        else if($branch['status']==8 || $branch['status']==9)echo "FOR VALIDATION";                        
                        else if($branch['status']==10) echo "DENIED BY CDS II";
                        else if($branch['status']==11) echo "DEFERRED BY CDS II";
                        else if($branch['status']==12 && $branch['evaluator5']>0) echo "FOR VALIDATION";
                        else if($branch['status']==12) echo "SUBMITTED BY CDS II";
                        else if($branch['status']==13) echo "DENIED BY SENIOR CDS";
                        else if($branch['status']==14) echo "DEFERRED BY SENIOR CDS";
                        else if($branch['status']==15) echo "SUBMITTED BY SENIOR CDS";
                        else if($branch['status']==16) echo "DENIED BY DIRECTOR";
                        else if($branch['status']==17) echo "DEFERRED BY DIRECTOR";
                        else if($branch['status']==18) echo "FOR PAYMENT";
                        else if($branch['status']==19) echo "WAITING FOR O.R.";
                        else if($branch['status']==20) echo "FOR PRINTING";
                        else if($branch['status']==21) echo "REGISTERED";
                        else if($branch['status']==22) echo "FOR PAYMENT";
                        else if($branch['status']==23) echo "SUBMITTED BY SENIOR CDS";
                        else if($branch['status']==24) echo "FOR VALIDATION"; ?>
                          
                      <!-- <?php endif ?> -->

                      </span>
                    </td>
                 

                  <?php if(!$is_client) :?>
                    <?php 
                      if($branch['area_of_operation'] == 'Barangay' || $branch['area_of_operation'] == 'Municipality/City'){
                        $brancharea = $branch['brgy'];
                    } else if($branch['area_of_operation'] == 'Provincial') {
                        $brancharea = $branch['city'];
                    } else if ($branch['area_of_operation'] == 'Regional') {
                        $brancharea = $branch['city'].', '.$branch['province'];
                    } else if ($branch['area_of_operation'] == 'National') {
                        $brancharea = $branch['city'].', '.$branch['province'];
                    }

                    // echo $branch['regCode'];
                    ?>
                    <td>
                      <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/assign" data-toggle="modal" data-target="#changebranchstatusModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch['id']))?>" data-cname="<?=$brancharea.' '?><?= $branch['branchName']?>" data-statusid="<?= $branch['status']?>" data-regcode="<?= $branch['regCode'];?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Change Status</a>
                      <!-- 
                      <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/assign" data-toggle="modal" data-target="#changestatusModal" data-statusid="<?= $branch['status']?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch['id']))?>" data-cname="<?= $branch['proposed_name']?> <?= $branch['type_of_cooperative']?> branches <?php if(!empty($branch['acronym_name'])){ echo '('.$branches['acronym_name'].')';}?> <?= $branches['grouping']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Change Status</a> -->
                      </div>
                    </td>
                  <?php endif;?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>