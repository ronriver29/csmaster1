<style type="text/css">
  #ul-admin {
  list-style-type: none;
  margin: 0;
  padding: 0;
 
  }
  #ul-admin li a{
    text-decoration:none;
    float:right;
   width: auto;
   margin-left: 5px;
  }
</style>
<?php if(!$is_client && $admin_info->access_level == 3 &&  $admin_info->is_director_active == 0) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p><strong>Note: </strong><br>You can only view the documents of a cooperative but you can't evaluate them.<br> To be able to evaluate a cooperative, you must revoke all the authority of the Supervising CDS.</p>
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
   <?php if($count_cooperatives->coop_count == 0){?>
  <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
    <a class="btn btn-color-blue btn-block" href="<?php echo base_url();?>cooperatives/reservation" role="button">New Registration</a>
  </div>
  <?php } ?>
  <?php endif; ?>
  <?php if(!$is_client && $admin_info->access_level == 3) : ?>
    <?php if($admin_info->is_director_active == 1) : ?>
    <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
      <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#grantSupervisorModal"><i class='fas fa-user-plus'></i> Grant all Authority to Supervising CDS</button>
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
                <th>Amendment No.</th>
                <th>Name of Cooperative</th>
                 <th>Amended Name</th>
                <?php if(!$is_client) : ?>
                  <th>Office Address</th>
                <?php endif;?>
                
                <th>Current Status</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_amendments as $amendment) : ?>
                <tr>
                  <td><?=$amendment['amendmentNo']?></td>
                  <td>
                    <?php
                       if(strlen($amendment['acronym'])>0)
                       {
                        $acronym_ = '('.$amendment['acronym'].')';
                       }
                       else
                       {
                        $acronym_='';
                       }
                        $count_tYpe = explode(',',$amendment['type_of_cooperative']);
                        if(count($count_tYpe)>1)

                        {
                          $proposeNames = $amendment['proposed_name'].' Multipurpose Cooperative '.$acronym_.' '.$amendment['grouping'];
                        }
                        else
                        {
                          $proposeNames = $amendment['proposed_name'].' '.$amendment['type_of_cooperative']. ' Cooperative '.$acronym_.' '.$amendment['grouping'];
                        }
                         echo $this->amendment_model->proposed_name_comparison($amendment['regNo'],$amendment['amendmentNo'],$proposeNames);
                         
                    ?>
                   </td>
                    <td>  <?php echo (strcasecmp(trim(preg_replace('/\s\s+/', ' ',$this->amendment_model->get_last_proposed_name($amendment['regNo'],$amendment['amendmentNo']))),trim(preg_replace('/\s\s+/', ' ',$proposeNames)))!=0 ? $proposeNames : ""); ?></td>
                  <?php if(!$is_client) : ?>
                    <td>
                      <?php if($amendment['house_blk_no']==null && $amendment['street']==null) $x=''; else $x=', ';?>
                      <?=$amendment['house_blk_no']?> <?=$amendment['street'].$x?><?=$amendment['brgy']?>, <?=$amendment['city']?>, <?= $amendment['province']?> <?=$amendment['region']?>
                    </td>
                  <?php endif; ?>
                
                  <td>
                      <span class="badge badge-secondary">
                      <?php if($is_client) : ?>
                        <?php if($amendment['status']==0) echo "EXPIRED";
                        else if($amendment['status']==1) echo "PENDING";
                        else if($amendment['status']>=2 && $amendment['status']<=9) echo "ON VALIDATION";
                        else if($amendment['status']==10) echo "DENIED";
                        else if($amendment['status']==11) echo "DEFERRED";
                        else if($amendment['status']==12) echo "FOR PRINTING & SUBMISSION";
                        else if($amendment['status']==13) echo "PAY AT CDA";
                        else if($amendment['status']==14) echo "GET YOUR CERTIFICATE";
                        else if($amendment['status']==15) echo "REGISTERED";
                        else if($amendment['status']==16) echo "FOR PAYMENT"; 
                        else if($amendment['status']==17) echo "REVERT FOR RE-EVALUATION";?>
                      <?php else : ?>
                        <?php
                        if($amendment['status']==2 || $amendment['status']==3)echo "FOR VALIDATION"; 
                        else if($amendment['status']==4) echo "DENIED BY CDS II";
                        else if($amendment['status']==5) echo "DEFERRED BY CDS II";
                        else if($amendment['status']==6 && $amendment['third_evaluated_by']>0) echo "FOR RE-EVALUATION";
                        else if($amendment['status']==6) echo "SUBMITTED BY CDS II";
                        else if($amendment['status']==7) echo "DENIED BY SENIOR CDS";
                        else if($amendment['status']==8) echo "DEFERRED BY SENIOR CDS";
                        else if($amendment['status']==9 && !$is_acting_director && $admin_info->access_level==3) echo "DELEGATED BY DIRECTOR";
                        else if($amendment['status']==9 && $supervising_ && $admin_info->access_level==4) echo "DELEGATED BY DIRECTOR";
                        else if($amendment['status']==9) echo "SUBMITTED BY SENIOR CDS";
                        else if($amendment['status']==10) echo "DENIED BY DIRECTOR";
                        else if($amendment['status']==11) echo "DEFERRED BY DIRECTOR";
                        else if($amendment['status']==12) echo "FOR PRINT&SUBMIT";
                        else if($amendment['status']==13) echo "WAITING FOR O.R.";
                        else if($amendment['status']==14) echo "FOR PRINTING";
                        else if($amendment['status']==15) echo "REGISTERED"; 
                        else if($amendment['status']==16) echo "FOR PAYMENT";
                        else if($amendment['status']==17) echo "REVERT FOR RE-EVALUATION"; ?>
                      <?php endif ?>

                      </span>
                    </td>
                  <?php if($is_client) :?>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($amendment['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View</a>
                      <?php if($amendment['status']<2 || $amendment['status']==10|| $amendment['status']==11) : ?>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperativeModal" data-cname="<?= $amendment['proposed_name']?> <?= $amendment['type_of_cooperative']?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($amendment['id']))?>"><i class='fas fa-trash'></i><?php echo ($amendment['status']==10 || $amendment['status']==11) ? "Delete": "Cancel" ?></button>
                      <?php endif;?>
                      </div>
                    </td>
                  <?php endif;?>
                  <?php if(!$is_client) :?>

                    <td>
                      <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($amendment['id'])) ?>/assign" data-toggle="modal" data-target="#changestatusModal" data-statusid="<?= $amendment['status']?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($amendment['id']))?>" data-cname="<?= $amendment['proposed_name']?> <?= $amendment['type_of_cooperative']?> Cooperative <?php if(!empty($amendment['acronym_name'])){ echo '('.$amendment['acronym_name'].')';}?> <?= $amendment['grouping']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Change Status</a>
                      <!-- <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                      <?php if($admin_info->access_level == 1) : ?>
                        <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($amendment['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Cooperative</a>
                      <?php else: ?>
                        
                        <?php if($amendment['status']==3): ?>
                          <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($amendment['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($amendment['id']))?>" data-cname="<?= $amendment['proposed_name']?> <?= $amendment['type_of_cooperative']?> Cooperative <?php if(!empty($amendment['acronym_name'])){ echo '('.$amendment['acronym_name'].')';}?> <?= $amendment['grouping']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Re-assign Validator</a>
                          <?php endif; ?>
                        <?php if(($amendment['status']>2 && $amendment['status']<11 && $admin_info->access_level == 1) || ($amendment['status']>3 && $amendment['status']<11 && $admin_info->access_level == 2 || $admin_info->access_level == 3 || $supervising_) && $amendment['evaluated_by']!=0) : ?>
                    
                          <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($amendment['id'])) ?>/documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                        
                        <?php elseif($amendment['status']==2 && $amendment['evaluated_by']==0): ?>
                          <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($amendment['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($amendment['id']))?>" data-cname="<?= $amendment['proposed_name']?> <?= $amendment['type_of_cooperative']?> Cooperative <?php if(!empty($amendment['acronym_name'])){ echo '('.$amendment['acronym_name'].')';}?> <?= $amendment['grouping']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign Validator</a>
                        
                        <?php elseif($amendment['status']==13): ?>
                          <?php
                            if(!empty($amendment['acronym_name'])){ 
                                $acronym_name = '('.$amendment['acronym_name'].')';
                            } else {
                                $acronym_name = '';
                            }
                          ?>
                          <input class="btn btn-color-blue offset-md-10" type="button" id="addOff" onclick="showPayment(<?=$amendment['id']?>,'<?= encrypt_custom($this->encryption->encrypt($amendment['proposed_name'].' '.$amendment['type_of_cooperative'].' Cooperative '.$acronym_name.' '.$amendment['grouping']))?>')" value="Save O.R. No.">
                       
                        <?php elseif($amendment['status']==12): ?>
                          <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($amendment['id'])) ?>/forpayment" class="btn btnOkForPayment btn-color-blue"> OK For Payment</a>
                          <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($amendment['id'])) ?>/documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                          
                        <?php elseif($amendment['status']==14 || $amendment['status']==15): ?>
                          <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($amendment['id'])) ?>/registration" class="btn btn-info"><i class='fas fa-print'></i> Print Registration</a>
                        <?php endif; ?>
                      <?php endif;?>
                      </div> -->
                    </td>
                  <?php endif;?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>