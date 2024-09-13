<?php if($this->session->flashdata('branches_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
     <?php echo $this->session->flashdata('branches_success'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('branches_error')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger text-center" role="error">
     <?php echo $this->session->flashdata('branches_error'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php
$plus = date('Y-m-d',strtotime($date2));
$tomorrow = date('Y-m-d',strtotime($plus . "+3 year"));
$now = date('Y-m-d');

if($tomorrow>=$now){
    ?>
    <div class="col-sm-12 col-md-12">
        <div class="alert alert-info text-justify" role="alert">
           <center>"Not yet allowed to register Branch. Unless registered 3 years from the day of Coop Registration"</center>
        </div>
    </div>
<?php }  //else { ?>
  <?php
    if(!$coop_exists && $is_client){

    ?>
    <div class="col-sm-12 col-md-12">
        <div class="alert alert-info text-justify" role="alert">
           <center>"A Cooperative must be registered first before you can establish/apply for Satellite"</center>
        </div>
    </div>
  <?php } ?>
  <!-- <div class="col-sm-12 col-md-12">
        <div class="alert alert-info text-justify" role="alert">
           The cooperative is qualified to establish a branch office based on the following requirement;
                    a.  The cooperative did not incur net loss for the last three consecutive years and its net worth is progressive for the last three years from the date of application.<br>

                    b. The principal office must have a minimum paid-up capital, as provided for in the Articles of Cooperation, to wit: <br>
                    Paid-up Capital&emsp;&emsp;&emsp;Category of Coop<br>
                    Php 10 Million&emsp;&emsp;&emsp;- Primary<br>
                    Php 15 Million&emsp;&emsp;&emsp;- Secondary<br>
                    Php 20 Million&emsp;&emsp;&emsp;- Tertiary
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="alert alert-info text-justify" role="alert">
           a.  The cooperative incur net loss for the last three consecutive years and its net worth is not progressive for the last three years from the date of application.<br>

           b. The principal office do not have the required minimum paid-up capital, as provided for in the Articles of Cooperation, to wit: <br>
            Paid-up Capital&emsp;&emsp;&emsp;Category of Coop<br>
            Php 10 Million&emsp;&emsp;&emsp;- Primary<br>
            Php 15 Million&emsp;&emsp;&emsp;- Secondary<br>
            Php 20 Million&emsp;&emsp;&emsp;- Tertiary
        </div>
    </div> -->
<?php
//$thirtyDaysUnix = strtotime('+30 days', strtotime($plus));
//echo $dateregistered;
//$end = date('Y-m-d', strtotime('+1 year',$dateregistered));
//echo $end;

//echo date('m-d-Y', strtotime($dateregistered. ' + 1 year'));
?>

<?php if(!$is_client && $admin_info->access_level == 3 &&  $admin_info->is_director_active == 0) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p><strong>Note: </strong><br>You can only view the documents of a cooperative but you can't evaluate them.<br> To be able to evaluate a cooperative, you must revoke all the privileges of the Supervising CDS.</p>
      </div>
    </div>
  </div>
<?php endif;?>
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
    <?php
    if($coop_exists){

    ?>
    <a class="btn btn-color-blue btn-block" href="<?php echo base_url();?>branches/registration" role="button">New Branch/Satellite Registration</a>
  <?php } ?>
  </div>
  <?php endif; ?>
  <?php if(!$is_client && $admin_info->access_level == 3) : ?>
    <?php if($admin_info->is_director_active == 1) : ?>
    <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
      <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#grantSupervisorModal"><i class='fas fa-user-plus'></i> Grant All Authority to Supervisor</button>
    </div>
    <?php else : ?>
      <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
        <button type="button" class="btn btn-warning text-white btn-block" data-toggle="modal" data-target="#revokeSupervisorModal"><i class='fas fa-user-times'></i> Revoke all Authority of Supervising CDS</button>
      </div>
    <?php endif; ?>
  <?php endif;?>
  <?php if($is_client){
    $adminregioncode = '';
  } else {
    $adminregioncode = $admin_info->region_code;
  }?>
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperativesTable">
            <thead>
              <tr>
                <th>Name of Cooperative</th>
                <th>Branch/Satellite</th>
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
                      if($this->charter_model->in_charter_city($branch['cCode'])){
                        $brancharea = $branch['city'];
                      } else {
                        $brancharea = $branch['city'].', '.$branch['province'];
                      }
                  } else if ($branch['area_of_operation'] == 'Interregional') {
                      if($this->charter_model->in_charter_city($branch['cCode'])){
                        $brancharea = $branch['city'];
                      } else {
                        $brancharea = $branch['city'].', '.$branch['province'];
                      }
                  }else if ($branch['area_of_operation'] == 'National') {
                      if($this->charter_model->in_charter_city($branch['cCode'])){
                        $brancharea = $branch['city'];
                      } else {
                        $brancharea = $branch['city'].', '.$branch['province'];
                      }
                  }

                  if($branch['migrated'] == 1){
                    $brancharea = $branch['branchName'];
                  } else {
                    $brancharea = $brancharea;
                  }
                    // if($branch['area_of_operation'] == 'Provincial'){
                    //     $brancharea = $branch['city'];
                    // } else if ($branch['area_of_operation'] == 'Municipality/City'){
                    //     $brancharea = $branch['brgy'];
                    // } else {
                    //     $brancharea = $branch['brgy'].', '. $branch['city'];
                    // }
                  ?>
                  <td><?php echo $brancharea?></td>
                  <td>
                    <?php if($branch['house_blk_no']==null && $branch['street']==null) $x=''; else $x=', ';?>
                    <?=$branch['house_blk_no']?> <?=$branch['street'].$x?> <?=$branch['brgy']?>, <?=$branch['city']?>, <?= $branch['province']?> <?=$branch['region']?>
                  </td>
                  <td>
                      <span class="badge badge-secondary">
                      <?php if($is_client) : ?>
                        <?php if($branch['status']==0) echo "EXPIRED"; ?>
                        <?php if($branch['status']==1) echo "PENDING"; ?>
                        <?php if($branch['status']>=3 && $branch['status']<=15 && ($branch['evaluator5']==0 || $branch['evaluator5']==NULL) && $branch['status'] != 8 && $branch['status'] != 9) echo "FOR EVALUATION"; ?>
                        <?php if($branch['status']==8 || $branch['status']==9) echo "FOR VALIDATION"; ?>
                        <?php if($branch['status']==2 && $branch['evaluator5']==NULL) echo "ON VALIDATION"; ?>
                        <?php if($branch['status']==2 && $branch['evaluator5']!=NULL) echo "FOR RE-EVALUATION"; ?>
                        <?php if($branch['status']==12 && ($branch['evaluator5']!=0 || $branch['evaluator5']!=NULL)) echo "FOR RE-EVALUATION"; ?>
                        <?php if($branch['status']==15 && ($branch['evaluator5']!=0 || $branch['evaluator5']!=NULL)) echo "FOR RE-EVALUATION"; ?>
                        <?php if($branch['status']==16) echo "DENIED"; ?>
                        <?php if($branch['status']==17) echo "DEFERRED"; ?>
                        <?php if($branch['status']==18) echo "FOR PRINT & SUBMIT"; ?>
                        <?php if($branch['status']==19) echo "PAY AT CDA"; ?>
                        <?php if($branch['status']==20) echo "GET YOUR CERTIFICATE"; ?>
                        <?php if($branch['status']==21) echo "REGISTERED"; ?>
                        <?php if($branch['status']==22) echo "FOR PAYMENT"; ?>
                        <?php if($branch['status']==23) echo "FOR EVALUATION"; ?>
                        <?php if($branch['status']==24) echo "FOR VALIDATION"; ?>

                        <?php if($branch['status']==41) echo "LETTER INTENT-TRANSFER"; ?>
                      <?php else : ?>
                        <?php if($branch['status']==2 && $branch['evaluator5']==NULL) echo "FOR VALIDATION";
                        else if($branch['status']==2 && $branch['evaluator5']!=NULL) echo "FOR RE-EVALUATION";
                        else if($branch['status']==3) echo "DENIED BY SENIOR CDS";
                        else if($branch['status']==4) echo "DEFERRED BY SENIOR CDS";
                        else if($branch['status']==5) echo "SUBMITTED BY SENIOR CDS";
                        else if($branch['status']==6) echo "DENIED BY DIRECTOR";
                        else if($branch['status']==7) echo "DEFERRED BY DIRECTOR";
                        else if($branch['status']==8 || $branch['status']==9)echo "FOR VALIDATION";
                        else if($branch['status']==10) echo "DENIED BY CDS II";
                        else if($branch['status']==11) echo "DEFERRED BY CDS II";
                        else if($branch['status']==12 && $branch['evaluator5']>0) echo "FOR RE-EVALUATION";
                        else if($branch['status']==12) echo "SUBMITTED BY CDS II";
                        else if($branch['status']==13) echo "DENIED BY SENIOR CDS";
                        else if($branch['status']==14) echo "DEFERRED BY SENIOR CDS";
                        else if($branch['status']==15 && !$is_acting_director && $admin_info->access_level==3) echo "DELEGATED BY DIRECTOR";
                        else if($branch['status']==15 && $supervising_ && $admin_info->access_level==4) echo "DELEGATED BY DIRECTOR";
                        else if($branch['status']==15 && ($branch['evaluator5']==0 || $branch['evaluator5']==NULL)) echo "SUBMITTED BY SENIOR CDS";
                        else if($branch['status']==15 && ($branch['evaluator5']!=0 || $branch['evaluator5']!=NULL)) echo "FOR RE-EVALUATION";
                        else if($branch['status']==16) echo "DENIED BY DIRECTOR";
                        else if($branch['status']==17) echo "DEFERRED BY DIRECTOR";
                        else if($branch['status']==18) echo "FOR PRINT & SUBMIT";
                        else if($branch['status']==19) echo "WAITING FOR O.R.";
                        else if($branch['status']==20) echo "FOR PRINTING";
                        else if($branch['status']==21) echo "REGISTERED";
                        else if($branch['status']==22) echo "FOR PAYMENT";
                        else if($branch['status']==23) echo "SUBMITTED BY SENIOR CDS";
                        else if($branch['status']==24) echo "FOR VALIDATION"; ?>
                        <?php
                        $addrCode = '0'.mb_substr($branch['addrCode'], 0, 2);
                        $transreg = '0'.mb_substr($branch['transferred_region'], 0, 2);
                          if($addrCode != $transreg){
                            if($branch['status']==41 || $branch['status']==42) echo "LETTER INTENT-TRANSFER (".$branch['region'].")";
                            if($branch['status']==43 && $branch['sent_lapse_notif'] == 0) echo "LETTER RECEIVED";
                            if($branch['status']==43 && $branch['sent_lapse_notif'] == 1) echo "FOR UPLOADING";
                            if($branch['status']==44) echo "APPLICATION FOR TRANSFER SUBMITTED (".$branch['region'].")/ FOR ASSIGNMENT OF VALIDATOR";
                            if($branch['status']==45) echo "FOR VALIDATION";
                            if($branch['status']==46) echo "VALIDATION REPORT-SUBMITTED BY CDS II / FOR EVALUATION";
                            if($branch['status']==47) echo "APPLICATION FOR TRANSFER (".$branch['region'].") SUBMITTED BY SR.CDS";
                            if($branch['status']==48) echo "APPROVED FOR PRINTING AND SUBMISSION OF THE REQUIREMENTS";
                            if($branch['status']==49) echo "DEFERRED";
                            if($branch['status']==50) echo "DENIED";
                            if($branch['status']==51) echo "FOR PAYMENT";
                            if($branch['status']==52) echo "SAVE O.R";
                            if($branch['status']==53) echo "FOR PRINTING OF ORDER OF TRANSFER";
                            if($branch['status']==54) echo "ISSUED ORDER OF TRANSFER";
                          } else {
                            if($branch['status']==41 || $branch['status']==42) echo "LETTER INTENT-TRANSFER";
                            if($branch['status']==43 && $branch['sent_lapse_notif'] == 0) echo "LETTER RECEIVED";
                            if($branch['status']==43 && $branch['sent_lapse_notif'] == 1) echo "FOR UPLOADING";
                            // if($branch['status']==43) echo "FOR UPLOADING";
                            if($branch['status']==44) echo "APPLICATION FOR TRANSFER SUBMITTED/FOR ASSIGNMENT OF VALIDATOR";
                            if($branch['status']==45) echo "FOR VALIDATION";
                            if($branch['status']==46) echo "VALIDATION REPORT-SUBMITTED BY CDS II / FOR EVALUATION";
                            if($branch['status']==47) echo "APPLICATION FOR TRANSFER-SUBMITTED BY SR.CDS/FOR EVALUATION";
                            if($branch['status']==48) echo "APPROVED FOR PRINTING AND SUBMISSION OF THE REQUIREMENTS";
                            if($branch['status']==49) echo "DEFERRED";
                            if($branch['status']==50) echo "DENIED";
                            if($branch['status']==51) echo "FOR PAYMENT";
                            if($branch['status']==52) echo "SAVE O.R";
                            if($branch['status']==53) echo "FOR PRINTING OF ORDER OF TRANSFER";
                            if($branch['status']==54) echo "ISSUED ORDER OF TRANSFER";
                          }
                        ?>

                      <?php endif ?>

                      </span>
                    </td>
                  <?php if($is_client) :?>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View</a>
                      <?php if($branch['status']<2||$branch['status']==16||$branch['status']==17) : ?>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteBranchModal" data-cname="<?= $branch['branchName']?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch['id']))?>"><i class='fas fa-trash'></i><?php echo ($branch['status']==16 || $branch['status']==17) ? "Delete": "Cancel" ?></button>
                      <?php endif;?>
                      <?php if($branch['status']==21) : ?>
                        <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/bns_closure" class="btn btn-warning" style="color:white;"><i class='fas fa-eye'></i> Close</a>
                        <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/bns_transfer" class="btn btn-success" style="color:white;"><i class='fas fa-eye'></i> Transfer</a>
                      <?php endif;?>
                      </div>
                    </td>
                  <?php endif;?>


                  <?php if(!$is_client) :?>
                    <?php
                      if($branch['area_of_operation'] == 'Barangay' || $branch['area_of_operation'] == 'Municipality/City'){
                        $brancharea = $branch['brgy'];
                    } else if($branch['area_of_operation'] == 'Provincial') {
                        $brancharea = $branch['city'];
                    } else if ($branch['area_of_operation'] == 'Regional') {
                        if($this->charter_model->in_charter_city($branch['cCode'])){
                          $brancharea = $branch['city'];
                        } else {
                          $brancharea = $branch['city'].', '.$branch['province'];
                        }
                    } else if ($branch['area_of_operation'] == 'National') {
                        if($this->charter_model->in_charter_city($branch['cCode'])){
                          $brancharea = $branch['city'];
                        } else {
                          $brancharea = $branch['city'].', '.$branch['province'];
                        }
                    }
                    ?>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <?php if($branch['status']==9 && $branch['evaluator3']!=0 && $admin_info->access_level==2): ?>
                          <?php if(!in_array($branch['rtype'],$typearr) || $admin_info->region_code == '00'){?>
                            <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/assign" data-toggle="modal" data-target="#assignBranchSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch['id']))?>" data-cname="<?=$brancharea.' '?><?= $branch['branchName']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Re-Assign Validator</a>
                          <?php } ?>
                        <?php endif; ?>
                        <?php  if(($branch['status']>=2 && $branch['status']<17 && $admin_info->access_level == 1) || ($branch['status']>9 && $branch['status']<17 && $admin_info->access_level == 2 || $admin_info->access_level == 3)  && $branch['status']!=8 || ($branch['status']==2 && $admin_info->access_level == 2 || ($branch['status']>9 && $branch['status']<17 && $supervising_ && $admin_info->access_level==4)) || $branch['status'] == 41 || $branch['status'] == 33 || $branch['status'] == 45 || $branch['status'] == 46) : ?>
                          <?php if(!in_array($branch['rtype'],$typearr) || $admin_info->region_code == '00'){?>
                            <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/documents_transfer" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                          <?php } ?>

                        <?php // elseif($branch['status']==8 && $branch['evaluator3']==0): ?>
                          <!-- <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/assign" data-toggle="modal" data-target="#assignBranchSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch['id']))?>" data-cname="<?=$brancharea.' '?><?= $branch['branchName']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign to Validator</a> -->
                        <?php elseif($branch['status']==44): ?>
                          <?php if(!in_array($branch['rtype'],$typearr) || $admin_info->region_code == '00'){?>
                            <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/assign" data-toggle="modal" data-target="#assignBranchSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch['id']))?>" data-cname="<?=$brancharea.' '?><?= $branch['branchName']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign to Validator</a>
                          <?php } ?>
                        <?php elseif($branch['status']==48): ?>
                          <?php if(!in_array($branch['rtype'],$typearr) || $admin_info->region_code == '00'){?>
                            <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/forpaymentbranches_for_transfer" class="btn btnOkForPayment btn-color-blue"> OK For Payment</a>
                            <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/documents_transfer" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                          <?php } ?>

                        <?php elseif($branch['status']==52): ?>
                          <?php if($branch['area_of_operation'] == 'Barangay' || $branch['area_of_operation'] == 'Municipality/City'){
                                $branch_name = $branch['brgy'];
                            } else if($branch['area_of_operation'] == 'Provincial') {
                                $branch_name = $branch['city'];
                            } else if ($branch['area_of_operation'] == 'Regional') {
                                if($this->charter_model->in_charter_city($branch['cCode'])){
                                  $branch_name = $branch['city'];
                                } else {
                                  $branch_name = $branch['city'].', '.$branch['province'];
                                }
                            } else if ($branch['area_of_operation'] == 'Interregional') {
                                if($this->charter_model->in_charter_city($branch['cCode'])){
                                  $branch_name = $branch['city'];
                                } else {
                                  $branch_name = $branch['city'].', '.$branch['province'];
                                }
                            } else if ($branch['area_of_operation'] == 'National') {
                                if($this->charter_model->in_charter_city($branch['cCode'])){
                                  $branch_name = $branch['city'];
                                } else {
                                  $branch_name = $branch['city'].', '.$branch['province'];
                                }
                            }
                        ?>
                        <?php if(!in_array($branch['rtype'],$typearr) || $admin_info->region_code == '00'){?>
                          <input class="btn btn-color-blue offset-md-10" type="button" id="addOff" onclick="showPayment(<?=$branch['id']?>,'<?= encrypt_custom($this->encryption->encrypt($branch['coopName'].' - '.$branch_name.' '.$branch['branchName']))?>')" value="Save O.R. No.">
                        <?php } ?>

                        <?php elseif($branch['status']==21 || $branch['status']==20): ?>
                          <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/registration" class="btn btn-info"><i class='fas fa-print'></i> Print Registration</a>
                        <?php endif; ?>

                        <?php if($branch['status']==53 || $branch['status']==54): ?>
                          <?php if(!in_array($branch['rtype'],$typearr) || $admin_info->region_code == '00'){?>
                            &nbsp;<a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/registration_transfer" class="btn btn-info"><i class='fas fa-print'></i> Print Order of Transfer</a>
                            &nbsp;<a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/registration_cloa" class="btn btn-info"><i class='fas fa-print'></i> Print Registration</a>
                          <?php } ?>
                        <?php endif; ?>

                        <?php if($branch['status']==45 && $admin_info->access_level == 2): ?>
                          &nbsp;<a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/assign" data-toggle="modal" data-target="#assignBranchSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch['id']))?>" data-cname="<?=$brancharea.' '?><?= $branch['branchName']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Re-Assign to Validator</a>
                        <?php endif; ?>

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
<?php //} ?>
<?php if($is_client) :?>
<?php else : ?>
<?php
  if($admin_info->access_level == 3 || $admin_info->access_level == 2){
?>
<div class="col-sm-12 col-md-12">
    <?php if($admin_info->region_code != '00'){ ?>
    <h3>Transferred Region</h3>
    <?php } ?>
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperativesTable2">
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
              <?php if($admin_info->access_level == 3){
                foreach ($transferred_branch as $transferred) : ?>
                <tr>
                  <td><?= $transferred['coopName']?></td>
                  <?php if($transferred['area_of_operation'] == 'Barangay' || $transferred['area_of_operation'] == 'Municipality/City'){
                                $brancharea = $transferred['brgy'];
                            } else if($transferred['area_of_operation'] == 'Provincial') {
                                $brancharea = $transferred['city'];
                            } else if ($transferred['area_of_operation'] == 'Regional') {
                                if($this->charter_model->in_charter_city($transferred['cCode'])){
                                  $brancharea = $transferred['city'];
                                } else {
                                  $brancharea = $transferred['city'].', '.$transferred['province'];
                                }
                            } else if ($transferred['area_of_operation'] == 'Interregional') {
                                if($this->charter_model->in_charter_city($transferred['cCode'])){
                                  $brancharea = $transferred['city'];
                                } else {
                                  $brancharea = $transferred['city'].', '.$transferred['province'];
                                }
                            } else if ($transferred['area_of_operation'] == 'National') {
                                if($this->charter_model->in_charter_city($transferred['cCode'])){
                                  $brancharea = $transferred['city'];
                                } else {
                                  $brancharea = $transferred['city'].', '.$transferred['province'];
                                }
                            }
                        ?>
                  <td><?php echo $brancharea.' '.$transferred['branchName']?></td>
                  <td>
                    <?php if($transferred['house_blk_no']==null && $transferred['street']==null) $x=''; else $x=', ';?>
                    <?=$transferred['house_blk_no']?> <?=$transferred['street'].$x?> <?=$transferred['brgy']?>, <?=$transferred['city']?>, <?= $transferred['province']?> <?=$transferred['region']?>
                  </td>
                  <td>
                    <?php
                        $addrCode = '0'.mb_substr($transferred['addrCode'], 0, 2);
                        $transreg = '0'.mb_substr($transferred['transferred_region'], 0, 2);
                        $regionname = $this->branches_model->get_region_name($transreg);
                          if($addrCode != $transreg){
                            if($transferred['status']==41 || $transferred['status']==42) echo "LETTER INTENT-TRANSFER (".$regionname->regDesc.")";
                            if($transferred['status']==43) echo "LETTER RECEIVED";
                            if($transferred['status']==44) echo "APPLICATION FOR TRANSFER SUBMITTED (".$regionname->regDesc.")/ FOR ASSIGNMENT OF VALIDATOR";
                            if($transferred['status']==45) echo "VALIDATION REPORT TRANSFER-SUBMITTED BY CDS II / FOR EVALUATION";
                            if($transferred['status']==46) echo "APPLICATION FOR TRANSFER (".$regionname->regDesc.") SUBMITTED BY SR.CDS / FOR EVALUATION";
                            if($transferred['status']==47) echo "APPLICATION FOR TRANSFER (".$regionname->regDesc.") SUBMITTED BY SR.CDS / FOR EVALUATION";
                            if($transferred['status']==48) echo "APPROVED FOR PRINTING AND SUBMISSION OF THE REQUIREMENTS";
                            if($transferred['status']==49) echo "DEFERRED";
                            if($transferred['status']==50) echo "DENIED";
                          } else {
                            if($transferred['status']==41) echo "LETTER INTENT-TRANSFER";
                            if($transferred['status']==43) echo "LETTER RECEIVED";
                            if($transferred['status']==44) echo "FOR UPLOADING";
                            if($transferred['status']==45) echo "VALIDATION REPORT TRANSFER-SUBMITTED BY CDS II / FOR EVALUATION";
                            if($transferred['status']==46) echo "APPLICATION FOR TRANSFER-SUBMITTED BY SR.CDS / FOR EVALUATION";
                            if($transferred['status']==47) echo "APPLICATION FOR TRANSFER-SUBMITTED BY SR.CDS / FOR EVALUATION";
                            if($transferred['status']==48) echo "APPROVED FOR PRINTING AND SUBMISSION OF THE REQUIREMENTS";
                            if($transferred['status']==49) echo "DEFERRED";
                            if($transferred['status']==50) echo "DENIED";
                          }
                        ?>
                  </td>
                  <td>
                      <!-- <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($transferred['id'])) ?>/documents_transfer" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a> -->
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php } else if($admin_info->access_level == 2){
                foreach ($transferred_branch as $transferred) : ?>
                <tr>
                  <td><?= $transferred['coopName']?></td>
                  <?php if($transferred['area_of_operation'] == 'Barangay' || $transferred['area_of_operation'] == 'Municipality/City'){
                                $brancharea = $transferred['brgy'];
                            } else if($transferred['area_of_operation'] == 'Provincial') {
                                $brancharea = $transferred['city'];
                            } else if ($transferred['area_of_operation'] == 'Regional') {
                                if($this->charter_model->in_charter_city($transferred['cCode'])){
                                  $brancharea = $transferred['city'];
                                } else {
                                  $brancharea = $transferred['city'].', '.$transferred['province'];
                                }
                            } else if ($transferred['area_of_operation'] == 'Interregional') {
                                if($this->charter_model->in_charter_city($transferred['cCode'])){
                                  $brancharea = $transferred['city'];
                                } else {
                                  $brancharea = $transferred['city'].', '.$transferred['province'];
                                }
                            } else if ($transferred['area_of_operation'] == 'National') {
                                if($this->charter_model->in_charter_city($transferred['cCode'])){
                                  $brancharea = $transferred['city'];
                                } else {
                                  $brancharea = $transferred['city'].', '.$transferred['province'];
                                }
                            }
                        ?>
                  <td><?php echo $brancharea.' '.$transferred['branchName']?></td>
                  <td>
                    <?php if($transferred['house_blk_no']==null && $transferred['street']==null) $x=''; else $x=', ';?>
                    <?=$transferred['house_blk_no']?> <?=$transferred['street'].$x?> <?=$transferred['brgy']?>, <?=$transferred['city']?>, <?= $transferred['province']?> <?=$transferred['region']?>
                  </td>
                  <td>
                      <span class="badge badge-secondary">
                        <?php if($is_client) : ?>
                        <?php if($transferred['status']==17) echo "DEFERRED"; ?>
                        <?php if($transferred['status']==24) echo "FOR VALIDATION"; ?>

                        <?php if($transferred['status']==44) echo "FOR VALIDATION"; ?>
                      <?php else : ?>
                        <?php
                        if($transferred['status']==17) echo "DEFERRED BY DIRECTOR";
                        else if($transferred['status']==24) echo "FOR VALIDATION"; ?>

                        <?php
                        $addrCode = '0'.mb_substr($transferred['addrCode'], 0, 2);
                        $transreg = '0'.mb_substr($transferred['transferred_region'], 0, 2);
                        $regionname = $this->branches_model->get_region_name($transreg);
                          if($addrCode != $transreg){
                            if($transferred['status']==41 || $transferred['status']==42) echo "LETTER INTENT-TRANSFER (".$regionname->regDesc.")";
                            if($transferred['status']==43) echo "LETTER RECEIVED";
                            if($transferred['status']==44) echo "APPLICATION FOR TRANSFER SUBMITTED (".$regionname->regDesc.")/ FOR ASSIGNMENT OF VALIDATOR";
                            if($transferred['status']==45) echo "VALIDATION REPORT TRANSFER-SUBMITTED BY CDS II / FOR EVALUATION";
                            if($transferred['status']==46) echo "APPLICATION FOR TRANSFER (".$regionname->regDesc.") SUBMITTED BY SR.CDS / FOR EVALUATION";
                            if($transferred['status']==47) echo "APPLICATION FOR TRANSFER (".$regionname->regDesc.") SUBMITTED BY SR.CDS / FOR EVALUATION";
                            if($transferred['status']==48) echo "APPROVED FOR PRINTING AND SUBMISSION OF THE REQUIREMENTS";
                            if($transferred['status']==49) echo "DEFERRED";
                            if($transferred['status']==50) echo "DENIED";
                          } else {
                            if($transferred['status']==41) echo "LETTER INTENT-TRANSFER";
                            if($transferred['status']==43) echo "LETTER RECEIVED";
                            if($transferred['status']==44) echo "FOR UPLOADING";
                            if($transferred['status']==45) echo "VALIDATION REPORT TRANSFER-SUBMITTED BY CDS II / FOR EVALUATION";
                            if($transferred['status']==46) echo "APPLICATION FOR TRANSFER-SUBMITTED BY SR.CDS / FOR EVALUATION";
                            if($transferred['status']==47) echo "APPLICATION FOR TRANSFER-SUBMITTED BY SR.CDS / FOR EVALUATION";
                            if($transferred['status']==48) echo "APPROVED FOR PRINTING AND SUBMISSION OF THE REQUIREMENTS";
                            if($transferred['status']==49) echo "DEFERRED";
                            if($transferred['status']==50) echo "DENIED";
                          }
                        ?>

                      <?php endif ?>
                      </span>
                  </td>
                  <td>
                    <?php if($transferred['status']==24 || $transferred['status']==46){?>
                      <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($transferred['id'])) ?>/documents_transfer" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                    <?php } ?>

                  </td>
                </tr>
                <?php endforeach; ?>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
<?php } ?>
<!--
<div class="col-sm-12 col-md-12">
    <h3>Registered</h3>
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperativesTable3">
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
              <?php foreach ($registered_branches as $branch_registered) : ?>
                <tr>
                  <td><?= $branch_registered['coopName']?></td>
                  <?php
                    if($branch_registered['area_of_operation'] == 'Provincial'){
                        $brancharea = $branch_registered['city'];
                    } else if ($branch_registered['area_of_operation'] == 'Municipality/City'){
                        $brancharea = $branch_registered['brgy'];
                    } else {
                        $brancharea = $branch_registered['brgy'].', '. $branch_registered['city'];
                    }
                  ?>
                  <td><?php echo $brancharea.' '.$branch_registered['branchName']?></td>
                  <td>
                    <?php if($branch_registered['house_blk_no']==null && $branch_registered['street']==null) $x=''; else $x=', ';?>
                    <?=$branch_registered['house_blk_no']?> <?=$branch_registered['street'].$x?> <?=$branch_registered['brgy']?>, <?=$branch_registered['city']?>, <?= $branch_registered['province']?> <?=$branch_registered['region']?>
                  </td>
                  <td>
                      <span class="badge badge-secondary">REGISTERED</span>
                  </td>
                  <td>
                        <?php if($branch_registered['status']==21 || $branch_registered['status']==20): ?><center>
                            <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch_registered['regNo'])) ?>/branch_registered" class="btn btn-warning" style="color:white;width:70%;"><i class='fas fa-eye'></i> View More </a>
                            <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch_registered['id'])) ?>/registration" class="btn btn-info"><i class='fas fa-print'></i> Print Registration</a></center>
                        <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
    <?php endif;?>
</div> -->


<!-- Bootstrap modal -->
 <div class="modal fade" id="paymentModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <?=form_open('#', ['id'=>'paymentForm', 'name'=>'paymentForm', 'role'=>'form']);?>
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body form">
          <input type="hidden" value="" name="payment_id" id="payment_id"/>
          <input type="hidden" value="" name="bid" id="branch_ID"/>
          <div class="row">
            <div class="col-md-12">


              <table width="100%" class="bord">
                <tr>
                  <td class="bord">Order of Payment No.</td>
                  <td class="bord" colspan="3"><b id="refNo"></b></td>
                </tr>
                <tr>
                  <td class="bord">Date</td>
                  <td class="bord" colspan="3"><b id="tDate"></b></td>
                </tr>
                <tr>
                  <td class="bord">O.R. No</td>
                  <td class="bord"><input type="text" id="orNo" name="orNo" class="form-control" placeholder="Type here..."></td>
                </tr>
                <tr>
                  <td class="bord">Date O.R</td>
                  <td class="bord"><input class="form-control validate[required,custom[date]]" type="date" id="orDate" name="orDate" class="form-control" placeholder="Click here..."><span id="msgdate" style="font-size:11px;margin-left:100px;color:red;font-style: italic;"></span></td>
                </tr>
                <!-- <tr>
                  <td class="bord">Transaction No.</td>
                  <td class="bord" colspan="3"><b id="tNo"></b></td>
                </tr> -->
                <tr>
                  <td class="bord">Payor</td>
                  <td class="bord" colspan="3"><b id="payor"></b></td>
                </tr>
                <tr>
                  <td class="bord">Nature of Payment</td>
                  <td class="bord" colspan="3"><b id="nature"></b></td>
                </tr>
                <tr>
                  <td class="bord">Amount in Words</td>
                  <td class="bord" colspan="3"><b id="word"> </b></td>
                </tr>
                <tr>
                  <td class="bord" colspan="4" align="center">Particulars</td>
                </tr>
                <tr>
                  <td width="23%"></td>
                  <td class="pera" width="" id="particulars" style="font-weight: bold;"></td>
                  <td class="pera" width="8%" valign="top">Php </td>
                  <td class="pera" align="right" width="13%" id="amount" style="font-weight: bold;"></td>
                </tr>
                <tr>
                  <td colspan="4"></td>
                </tr>
                <tr>
                  <td class="bord" colspan="2">Total </td>
                  <td class="taas"  width="8%">Php </td>
                  <td class="taas" align="right" width="13%"><b id="total"></b></td>
                </tr>
              </table>
              <table id="test"></table>

            </div>
          </div>
        </div><!-- /.modal-content -->
        <div class="modal-footer">
            <button type="button" id="saveOR" onclick= "save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="<?=base_url();?>assets/js/jquery-3.7.1.min.js"></script>
<script src="<?=base_url();?>assets/js/toword.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
  function GetNow()
  {
    var currentdate = new Date();
    var month = currentdate.getMonth() + 1;
    var day = currentdate.getDate();
    var date1 = (currentdate.getFullYear() + '-' + (('' + month).length < 2 ? '0' : '') + month + '-' + (('' + day).length < 2 ? '0' : '')  + day);
    return date1;
  }
  $('#orDate').on('change',function(){
    var selectedDate = $(this).val();
    var now = GetNow();
    // alert(now+selectedDate);
    if(selectedDate > now)
    {
      $(this).val(now);
       $("#msgdate").text("Date of O.R. should not be future date");
      setTimeout(function(){
          $("#msgdate").text("");
      },5000);
    }
    else if(selectedDate == now)
    {
      $("#msgdate").text("");
    }
    else
    {
      $("#msgdate").text("");
    }

  });
});
</script>

<script type="text/javascript">

  function showPayment(coop_id,coop_name) {
    //save_method = 'add';
    $('#paymentForm')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty();
    $.ajax({
        url : "<?php echo base_url('for_transfer/payment')?>/" + coop_id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            var currentdate = new Date(data.date);
            var month = currentdate.getMonth() + 1;
            var day = currentdate.getDate();
            var formated_date = ( (('' + day).length < 2 ? '0' : '')  + day + '-' + (('' + month).length < 2 ? '0' : '') + month + '-' +currentdate.getFullYear());

            var s=convert(data.total);
            $('#payment_id').val(data.id);
            $('#refNo').text(data.refNo);
            $('#tDate').text(formated_date);
            $('#payor').text(data.payor);
            $('#tNo').text(data.transactionNo);
            $('#branch_ID').val(coop_id);
            $('#word').text(s);
            // $('#branch_ID').val(coop_id);
            $('#word').text(s+' Pesos');
            $('#nature').text(data.nature);
            $('#particulars').html(data.particulars);
            $('#amount').html(data.amount);
            $('#total').text(parseFloat(data.total).toFixed(2));


            $('#paymentModal').modal('show'); // show bootstrap modal
            $('.modal-title').text('Order of Payment');
            // console.log(data);

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            // alert('Error get data from ajax!');
            alert('Error get data from ajax!');
        }
        // error: function (ts)
        // {
        //     // alert('Error get data from ajax!');
        //     alert(ts.responseText);
        // }
        // error: function(xhr, status, error) {
        //   var err = eval("(" + xhr.responseText + ")");
        //   alert(err.Message);
        // }
    });
  }

  function save(){

    var x = $('#orNo').val();
    var y = $('#orDate').val();

    if (x==''){
      alert('Missing O.R. No.');
    } else if (y==''){
      alert('Missing O.R. Date');
    }
    else{
      var paymentFormData = new FormData($('#paymentForm')[0]);
      $.ajax({
          url : "<?php echo base_url('for_transfer/saveORTransfer')?>/" + 'fuck',
          type: "POST",
          data: paymentFormData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
              if(data.status) //if success close modal and reload ajax table
              {
                  $('#paymentModal').modal('hide');
                  $('#paymentForm')[0].reset();
                  window.location.href="<?php echo base_url('for_transfer')?>";
              }
              else
              {
                  for (var i = 0; i < data.inputerror.length; i++)
                  {
                      $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                      $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                  }
              }

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding / update data!');
             // $('#saveOR').text('save'); //change button text
              //$('#saveOR').attr('disabled',false); //set button enable

          }
      });
    }
  }
</script>
