<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-6 col-md-8">
              <h5 class="float-left font-weight-bold">Information</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <strong>Registered Number:</strong>
              <p class="text-muted">
                  <?=$account_info->regno?>
              </p>
            </div>
            <div class="col-md-4">
              <strong>Cooperative Name:</strong>
              <p class="text-muted">
                  <?=$account_info->coopName?>
              </p>
            </div>
            <div class="col-md-4">
              <strong>Account Name:</strong>
              <p class="text-muted">
                  <?=$account_info->first_name.' '.$account_info->last_name?>
              </p>
            </div>
            <div class="col-md-4">
              <strong>Contact Number:</strong>
              <p class="text-muted">
                  <?=$account_info->contact_number?>
              </p>
            </div>
            <div class="col-md-4">
              <strong>Email:</strong>
              <p class="text-muted">
                  <?=$account_info->email?>
              </p>
            </div>
            <div class="col-md-4">
              <strong>Account File Uploaded:</strong>
              <p class="text-muted">
                <?php $pieces = explode("|", $account_info->files);
                $count = 0; 
                // echo $pieces[0];
                foreach($pieces as $cheese) {?>
                  <a href="<?php echo base_url();?>account_approval/<?= $pieces[$count]?>/download" class="btn btn-info"><?=$pieces[$count]?></a>
                  <?php $count++;
                }?>
                  <!-- <a href='./uploads/<?=$account_info->files?>'><?=$account_info->files?></a> -->
              </p>
            </div>
            <div class="col-md-4">
              
            </div>
            <div class="col-md-4">
                <a href="<?php echo base_url();?>account_approval/<?=encrypt_custom($this->encryption->encrypt($account_info->usersid))?>/approve/<?=encrypt_custom($this->encryption->encrypt($account_info->email))?>" class="btn btn-success">Approve</a>
                <a href="<?php echo base_url();?>account_approval/<?=encrypt_custom($this->encryption->encrypt($account_info->usersid))?>/deny" class="btn btn-danger">Deny</a>
              </p>
            </div>
            <div class="col-md-4">
              
            </div>
          </div>
        </div>
    </div>
  </div>
</div>