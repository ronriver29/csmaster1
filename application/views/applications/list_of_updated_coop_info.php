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
    <div class="alert alert-danger text-center" role="alert">
      <?php echo $this->session->flashdata('list_error_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('delete_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('delete_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<center><h3>Search</h3></center>
<div class="portlet-body">
  <form method="post">
    <div class="row">
      <div class="col-md-10">
        <div class="form-group">
          <label for="eAddress">Cooperative Name</label>
          <div id='search'><input type="text" class="form-control" id="coopname" name="coopname"></div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="eAddress">Show</label>
          <select class="form-control" id="limit" name="limit" required=""></div>
            <option value="10">10</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="500">500</option>
            <option value="750">750</option>
          </select>
        </div>
      </div>
    </div>
    <center><button type="submit" name="submit" value="submit" class="btn btn-info" >Submit</button></center>
  </form>
</div>
<br>
<?php if(is_array($list_cooperatives)){?>
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
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name of Cooperative</th>
                <?php if(!$is_client) : ?>
                  <!-- <th>Office Address</th> -->
                <?php endif;?>
                <th>Status</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_cooperatives as $cooperative) : ?>
                <tr>
                  <td>  <?php echo $cooperative['coopName'] ;/* if($cooperative['category_of_cooperative'] == 'Primary' || $cooperative['type_of_cooperative'] == "Bank" || $cooperative['type_of_cooperative'] == "Insurance"){?>
                      <?= $cooperative['proposed_name']?> <?= $cooperative['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative['acronym_name'])){ echo '('.$cooperative['acronym_name'].')';}?>
                    <?php } else if($cooperative['grouping'] == 'Union' && $cooperative['type_of_cooperative'] == 'Union'){?>
                        <?= $cooperative['proposed_name']?> <?= $cooperative['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative['acronym_name'])){ echo '('.$cooperative['acronym_name'].')';}?>
                    <?php } else { ?>
                      <?= $cooperative['proposed_name']?> Federation of <?= $cooperative['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative['acronym_name'])){ echo '('.$cooperative['acronym_name'].')';
                    }?>
                  <?php }?></td>
                  <?php if(!$is_client) : ?>
                    <td>
                      <?php if($cooperative['house_blk_no']==null && $cooperative['street']==null) $x=''; else $x=', ';?>
                      <?=$cooperative['house_blk_no']?> <?=$cooperative['street'].$x?><?=$cooperative['brgy']?>, <?=$cooperative['city']?>, <?= $cooperative['province']?> <?=$cooperative['region']?>
                    </td>
                  <?php endif; */?>
                  <td>
                   
                      <span class="badge badge-secondary">
                      <?php if($is_client) : ?>
                        <?php if($cooperative['status']==0) echo "EXPIRED";
                        else if($cooperative['status']==1) echo "PENDING";
                        else if($cooperative['status']==2) echo "FOR VALIDATION";
                        else if($cooperative['status']==6 && $cooperative['third_evaluated_by']>0) echo "FOR RE-EVALUATION";
                        else if($cooperative['status']>=2 && $cooperative['status']<=5) echo "FOR VALIDATION";
                        else if($cooperative['status']>=6 && $cooperative['status']<=9 && $cooperative['third_evaluated_by']<=0) echo "FOR EVALUATION";
                        else if($cooperative['status']==9 && $cooperative['third_evaluated_by']>0) echo "FOR RE-EVALUATION";
                        else if($cooperative['status']==10) echo "DENIED";
                        else if($cooperative['status']==11 && !$this->cooperatives_model->check_if_revert($cooperative['id'])) echo "DEFERRED";
                        else if($cooperative['status']==11 && $this->cooperatives_model->check_if_revert($cooperative['id'])) echo "REVERTED-DEFERRED";
                        else if($cooperative['status']==12) echo "FOR PRINTING & SUBMISSION";
                        else if($cooperative['status']==13) echo "PAY AT CDA";
                        else if($cooperative['status']==14) echo "GET YOUR CERTIFICATE";
                        else if($cooperative['status']==15) echo "REGISTERED";
                        else if($cooperative['status']==16) echo "FOR PAYMENT";
                        else if($cooperative['status']==17) echo "FOR REVERSION-FOR RE-EVALUATION"; ?>
                      <?php else : ?>
                        <?php if($cooperative['status']==2 || $cooperative['status']==3)echo "FOR VALIDATION"; 
                        else if($cooperative['status']==4) echo "DENIED BY CDS II";
                        else if($cooperative['status']==5) echo "DEFERRED BY CDS II";
                        else if($cooperative['status']==6 && $cooperative['third_evaluated_by']>0) echo "FOR RE-EVALUATION";
                        else if($cooperative['status']==6) echo "SUBMITTED BY CDS II";
                        else if($cooperative['status']==7) echo "DENIED BY SENIOR CDS";
                        else if($cooperative['status']==8) echo "DEFERRED BY SENIOR CDS";
                        else if($cooperative['status']==9 && !$is_acting_director && $admin_info->access_level==3) echo "DELEGATED BY DIRECTOR";
                        else if($cooperative['status']==9 && $supervising_ && $admin_info->access_level==4) echo "DELEGATED BY DIRECTOR";
                        else if($cooperative['status']==9 && $cooperative['third_evaluated_by']>0) echo "FOR RE-EVALUATION";
                        else if($cooperative['status']==9 || $cooperative['third_evaluated_by']<0) echo "SUBMITTED BY SENIOR CDS";
                        else if($cooperative['status']==10) echo "DENIED BY DIRECTOR";
                        else if($cooperative['status']==11 && !$this->cooperatives_model->check_if_revert($cooperative['id'])) echo "DEFERRED";
                        else if($cooperative['status']==11 && $this->cooperatives_model->check_if_revert($cooperative['id'])) echo "REVERTED-DEFERRED";
                        else if($cooperative['status']==12) echo "FOR PRINT&SUBMIT";
                        else if($cooperative['status']==13) echo "WAITING FOR O.R.";
                        else if($cooperative['status']==14) echo "FOR PRINTING";
                        else if($cooperative['status']==15) echo "REGISTERED"; 
                        else if($cooperative['status']==16) echo "FOR PAYMENT";
                        else if($cooperative['status']==17) echo "FOR REVERSION-FOR RE-EVALUATION";
                        else if($cooperative['status']==40) echo "FOR APPROVAL"; ?>
                      <?php endif ?>

                      </span>
                    </td>
                  <?php if($is_client) :?>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View</a>
                      <?php if($cooperative['status']<2 || $cooperative['status']==10|| $cooperative['status']==11) : ?>
                        <?php if($cooperative['grouping'] != 'Federation'){?>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperativeModal" data-cname="<?= $cooperative['proposed_name']?> <?= $cooperative['type_of_cooperative']?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($cooperative['id']))?>"><i class='fas fa-trash'></i><?php echo ($cooperative['status']==10 || $cooperative['status']==11) ? "Delete": "Cancel" ?></button>
                        <?php } else { ?>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperativeModal" data-cname="<?= $cooperative['proposed_name']?> Federation of <?= $cooperative['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative['acronym_name'])){ echo '('.$cooperative['acronym_name'].')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($cooperative['id']))?>"><i class='fas fa-trash'></i><?php echo ($cooperative['status']==10 || $cooperative['status']==11) ? "Delete": "Cancel" ?></button>
                        <?php }?></td>
                      <?php endif;?>
                      </div>
                    </td>
                  <?php endif;?>
                  <?php if(!$is_client) :?>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                      <?php if($admin_info->access_level == 1) : ?>
                        <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Cooperative</a>
                      <?php else: ?>
                        
                        <!-- FOR LIST OF UPDATED COOPERATIVE INFO -->
                        <?php if($cooperative['status']==40): ?>
                          <a href="<?php echo base_url();?>cooperatives_update/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Cooperative</a>
                        <?php endif; ?>
                        <?php if($cooperative['status']==3): ?>
                          <?php if($cooperative['grouping'] != 'Federation'){?>
                            <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($cooperative['id']))?>" data-cname="<?= $cooperative['proposed_name']?> <?= $cooperative['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative['acronym_name'])){ echo '('.$cooperative['acronym_name'].')';}?> <?= $cooperative['grouping']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Re-assign Validator</a>
                          <?php } else { ?>
                            <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($cooperative['id']))?>" data-cname="<?= $cooperative['proposed_name']?> Federation of <?= $cooperative['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative['acronym_name'])){ echo '('.$cooperative['acronym_name'].')';}?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Re-assign Validator</a>
                          <?php } ?>
                          <?php endif; ?>
                        <?php if(($cooperative['status']>2 && $cooperative['status']<11 && $admin_info->access_level == 1) || ($cooperative['status']>3 && $cooperative['status']<11 && $admin_info->access_level == 2 || $admin_info->access_level == 3) && $cooperative['evaluated_by']!=0) : ?>

                          <?php if($admin_info->access_level == 3 || $admin_info->access_level == 4){?>
                            <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                          <?php } ?>

                          <?php if($admin_info->access_level != 3 && $admin_info->access_level != 4){?>
                            <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Cooperative</a>
                          <?php } ?>
                        
                        <?php elseif($cooperative['status']==2 && $cooperative['evaluated_by']==0): ?>
                          <?php if($cooperative['grouping'] != 'Federation'){?>
                            <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($cooperative['id']))?>" data-cname="<?= $cooperative['proposed_name']?> <?= $cooperative['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative['acronym_name'])){ echo '('.$cooperative['acronym_name'].')';}?> <?= $cooperative['grouping']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign Validator</a>
                          <?php } else { ?>
                            <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($cooperative['id']))?>" data-cname="<?= $cooperative['proposed_name']?> Federation of <?= $cooperative['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative['acronym_name'])){ echo '('.$cooperative['acronym_name'].')';}?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign Validator</a>
                          <?php } ?>
                        
                        <?php elseif($cooperative['status']==13): ?>
                          <?php
                          if($cooperative['grouping'] == 'Union'){
                            if(!empty($cooperative['acronym_name'])){ 
                                $acronym_name = '('.$cooperative['acronym_name'].')';

                                if($cooperative['grouping'] != ''){
                                  $grouping = ' '.$cooperative['grouping'];
                                } else {
                                  $grouping = '';
                                }
                            } else {
                                $acronym_name = '';
                                if($cooperative['grouping'] != ''){
                                  $grouping = $cooperative['grouping'];
                                } else {
                                  $grouping = '';
                                }

                            } 
                          } else {
                            if(!empty($cooperative['acronym_name'])){ 
                                $acronym_name = '('.$cooperative['acronym_name'].')';
                            } else {
                                $acronym_name = ' ';
                            } 

                            if($cooperative['grouping'] != ''){
                              $grouping = ' '.$cooperative['grouping'];
                            } else {
                              $grouping = '';
                            }
                          }

                          if($cooperative['grouping'] == 'Federation'){
                          ?>
                            <input class="btn btn-color-blue offset-md-10" type="button" id="addOff" onclick="showPayment(<?=$cooperative['id']?>,'<?=encrypt_custom($this->encryption->encrypt($cooperative['proposed_name'].' Federation of '.$cooperative['type_of_cooperative'].' Cooperative '.$acronym_name))?>')" value="Save O.R. No.">
                          <?php } else if($cooperative['grouping'] == 'Union' && $cooperative['type_of_cooperative'] == 'Union'){ ?>
                            <input class="btn btn-color-blue offset-md-10" type="button" id="addOff" onclick="showPayment(<?=$cooperative['id']?>,'<?=encrypt_custom($this->encryption->encrypt($cooperative['proposed_name'].' '.$cooperative['type_of_cooperative'].' Cooperative '.$acronym_name))?>')" value="Save O.R. No.">
                          <?php } else {?>
                            <input class="btn btn-color-blue offset-md-10" type="button" id="addOff" onclick="showPayment(<?=$cooperative['id']?>,'<?=encrypt_custom($this->encryption->encrypt($cooperative['proposed_name'].' '.$cooperative['type_of_cooperative'].' Cooperative '.$acronym_name.$grouping))?>')" value="Save O.R. No.">
                          <?php } ?>
                        <?php elseif($cooperative['status']==12): ?>
                          <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/forpayment" class="btn btnOkForPayment btn-color-blue"> OK For Payment</a>
                          <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                          
                        <?php elseif($cooperative['status']==14 || $cooperative['status']==15): ?>
                          <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/registration" class="btn btn-info"><i class='fas fa-print'></i> Print Registration</a>
                        <?php endif; ?>
                      <?php endif;?>
                      </div>
                    </td>
                  <?php endif;?> 
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?=$links?>
      </div>
    </div>
<?php } ?>
<!-- 
  <?php if(!$is_client) :?>
<h4 style="
padding: 15px 10px;
background: #fff;
background-color: rgb(255, 255, 255);
border: none;
border-radius: 0;
margin-bottom: 20px;
box-shadow: 1px 1px 1px 2px rgba(0, 0, 0, 0.1);">Registered</h4>
</div>

<div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperativesTable2">
            <thead>
              <tr>
                <th>Name of Cooperative</th>
                <?php if(!$is_client) : ?>
                  <th>Office Address</th>
                <?php endif;?>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_cooperatives_registered as $cooperative_registered) : ?>
                <tr>
                  <td>
                      <?=$cooperative_registered['coopName']?>
                  <td>
                    <?php if($cooperative_registered['house_blk_no']==null && $cooperative_registered['street']==null) $x=''; else $x=', ';?>
                    <?=$cooperative_registered['house_blk_no']?> <?=$cooperative_registered['street'].$x?><?=$cooperative_registered['brgy']?>, <?=$cooperative_registered['city']?>, <?= $cooperative_registered['province']?> <?=$cooperative_registered['region']?>
                  </td>
                  <td>
                    <span class="badge badge-secondary">
                      <?php if($cooperative_registered['status']==39) { echo "REGISTERED"; }?>
                    </span>
                  </td>
                  <td width="31%">
                    <li style="list-style: none;">
                      <a href="<?php echo base_url();?>cooperatives_update/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/documents_update" class="btn btn-sm btn-info"><i class='fas fa-eye'></i> View Document</a>
                    </li>
                  </ul>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>
  <?endif;?> -->
