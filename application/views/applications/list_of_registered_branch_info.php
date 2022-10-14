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
<?php if(is_array($list_branches)){?>
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
                <th>Branch/Satellite Name</th>
                <?php if(!$is_client) : ?>
                <?php endif;?>
                <th>Status</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_branches as $branches) : ?>
                <tr>
                  <td>  <?php echo $branches['coopName'] ?>
                  <td>  <?php echo $branches['branchName']; ?>
                  <td>
                   
                      <span class="badge badge-secondary">
                        <?php if($branches['bstatus']==81 )echo "UPDATED"; 
                        ?>

                      </span>
                    </td>
                  <?php if($is_client) :?>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View</a>
                      <?php if($branches['bstatus']<2 || $branches['bstatus']==10|| $branches['bstatus']==11) : ?>
                        <?php if($branches['grouping'] != 'Federation'){?>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperativeModal" data-cname="<?= $branches['proposed_name']?> <?= $branches['type_of_cooperative']?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branches['id']))?>"><i class='fas fa-trash'></i><?php echo ($branches['bstatus']==10 || $branches['bstatus']==11) ? "Delete": "Cancel" ?></button>
                        <?php } else { ?>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperativeModal" data-cname="<?= $branches['proposed_name']?> Federation of <?= $branches['type_of_cooperative']?> Cooperative <?php if(!empty($branches['acronym_name'])){ echo '('.$branches['acronym_name'].')';}?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branches['id']))?>"><i class='fas fa-trash'></i><?php echo ($branches['bstatus']==10 || $branches['bstatus']==11) ? "Delete": "Cancel" ?></button>
                        <?php }?></td>
                      <?php endif;?>
                      </div>
                    </td>
                  <?php endif;?>
                  <?php if(!$is_client) :?>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                      <?php if($admin_info->access_level == 1) : ?>
                        <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Cooperative</a>
                      <?php else: ?>
                        
                        <!-- FOR LIST OF UPDATED COOPERATIVE INFO -->
                        <?php if($branches['bstatus']==80 || $branches['bstatus']==81): ?>
                          <a href="<?php echo base_url();?>branch_update/<?= encrypt_custom($this->encryption->encrypt($branches['id']))?>/view" class="btn btn-info"><i class='fas fa-eye'></i> View Branch/Satellite</a>
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit_bns_cert" data-fname="<?= $branches['first_name'].' '.$branches['last_name']?>" data-regno="<?= $branches['regNo']?>" data-certno="<?=$branches['certNo']?>" data-regdate="<?=$branches['dateRegistered']?>" data-adid="<?= encrypt_custom($this->encryption->encrypt($branches['id']))?>" style="color:white;"><i class="fas fa-edit"></i> Edit</button>
                        <?php endif; ?>
                        <?php if($branches['bstatus']==3): ?>
                          <?php if($branches['grouping'] != 'Federation'){?>
                            <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branches['id']))?>" data-cname="<?= $branches['proposed_name']?> <?= $branches['type_of_cooperative']?> Cooperative <?php if(!empty($branches['acronym_name'])){ echo '('.$branches['acronym_name'].')';}?> <?= $branches['grouping']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Re-assign Validator</a>
                          <?php } else { ?>
                            <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branches['id']))?>" data-cname="<?= $branches['proposed_name']?> Federation of <?= $branches['type_of_cooperative']?> Cooperative <?php if(!empty($branches['acronym_name'])){ echo '('.$branches['acronym_name'].')';}?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Re-assign Validator</a>
                          <?php } ?>
                          <?php endif; ?>
                        <?php if(($branches['bstatus']>2 && $branches['bstatus']<11 && $admin_info->access_level == 1) || ($branches['bstatus']>3 && $branches['bstatus']<11 && $admin_info->access_level == 2 || $admin_info->access_level == 3) && $branches['evaluated_by']!=0) : ?>

                          <?php if($admin_info->access_level == 3 || $admin_info->access_level == 4){?>
                            <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>/documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                          <?php } ?>

                          <?php if($admin_info->access_level != 3 && $admin_info->access_level != 4){?>
                            <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Cooperative</a>
                          <?php } ?>
                        
                        <?php elseif($branches['bstatus']==2 && $branches['evaluated_by']==0): ?>
                          <?php if($branches['grouping'] != 'Federation'){?>
                            <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branches['id']))?>" data-cname="<?= $branches['proposed_name']?> <?= $branches['type_of_cooperative']?> Cooperative <?php if(!empty($branches['acronym_name'])){ echo '('.$branches['acronym_name'].')';}?> <?= $branches['grouping']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign Validator</a>
                          <?php } else { ?>
                            <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branches['id']))?>" data-cname="<?= $branches['proposed_name']?> Federation of <?= $branches['type_of_cooperative']?> Cooperative <?php if(!empty($branches['acronym_name'])){ echo '('.$branches['acronym_name'].')';}?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign Validator</a>
                          <?php } ?>
                        
                        <?php elseif($branches['bstatus']==13): ?>
                          <?php
                          if($branches['grouping'] == 'Union'){
                            if(!empty($branches['acronym_name'])){ 
                                $acronym_name = '('.$branches['acronym_name'].')';

                                if($branches['grouping'] != ''){
                                  $grouping = ' '.$branches['grouping'];
                                } else {
                                  $grouping = '';
                                }
                            } else {
                                $acronym_name = '';
                                if($branches['grouping'] != ''){
                                  $grouping = $branches['grouping'];
                                } else {
                                  $grouping = '';
                                }

                            } 
                          } else {
                            if(!empty($branches['acronym_name'])){ 
                                $acronym_name = '('.$branches['acronym_name'].')';
                            } else {
                                $acronym_name = ' ';
                            } 

                            if($branches['grouping'] != ''){
                              $grouping = ' '.$branches['grouping'];
                            } else {
                              $grouping = '';
                            }
                          }

                          if($branches['grouping'] == 'Federation'){
                          ?>
                            <input class="btn btn-color-blue offset-md-10" type="button" id="addOff" onclick="showPayment(<?=$branches['id']?>,'<?=encrypt_custom($this->encryption->encrypt($branches['proposed_name'].' Federation of '.$branches['type_of_cooperative'].' Cooperative '.$acronym_name))?>')" value="Save O.R. No.">
                          <?php } else if($branches['grouping'] == 'Union' && $branches['type_of_cooperative'] == 'Union'){ ?>
                            <input class="btn btn-color-blue offset-md-10" type="button" id="addOff" onclick="showPayment(<?=$branches['id']?>,'<?=encrypt_custom($this->encryption->encrypt($branches['proposed_name'].' '.$branches['type_of_cooperative'].' Cooperative '.$acronym_name))?>')" value="Save O.R. No.">
                          <?php } else {?>
                            <input class="btn btn-color-blue offset-md-10" type="button" id="addOff" onclick="showPayment(<?=$branches['id']?>,'<?=encrypt_custom($this->encryption->encrypt($branches['proposed_name'].' '.$branches['type_of_cooperative'].' Cooperative '.$acronym_name.$grouping))?>')" value="Save O.R. No.">
                          <?php } ?>
                        <?php elseif($branches['bstatus']==12): ?>
                          <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>/forpayment" class="btn btnOkForPayment btn-color-blue"> OK For Payment</a>
                          <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                          
                        <?php elseif($branches['bstatus']==14 || $branches['bstatus']==15): ?>
                          <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($branches['id'])) ?>/registration" class="btn btn-info"><i class='fas fa-print'></i> Print Registration</a>
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