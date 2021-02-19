<?php if($this->session->flashdata('branches_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
     <?php echo $this->session->flashdata('branches_success'); ?>
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
           <center>"Not yet allowed to register Branch or Satellite. Unless registered 3 years from the day of Coop Registration"</center>
        </div>
    </div>
<?php } else {
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
  <?php if($is_client){
    $adminregioncode = '';
  } else {
    $adminregioncode = $admin_info->region_code;
  }?>
  <?php if($adminregioncode != '00'){ ?>
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
                      <?php if($is_client) : ?>
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
                      <?php else : ?>
                        <?php if($branch['status']==2) echo "FOR VALIDATION";
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
                          <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/assign" data-toggle="modal" data-target="#assignBranchSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch['id']))?>" data-cname="<?=$brancharea.' '?><?= $branch['branchName']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Re-Assign Validator</a>
                        <?php endif; ?>
                          
<<<<<<< Updated upstream
                        <?php if(($branch['status']>=2 && $branch['status']<17 && $admin_info->access_level == 1) || ($branch['status']>9 && $branch['status']<17 && $admin_info->access_level == 2 || ($admin_info->access_level == 3 && $is_acting_director)) || ($supervising_)  && $branch['status']!=8 || ($branch['status']==2 && $admin_info->access_level == 2)) : ?>
=======
                        <?php  if(($branch['status']>=2 && $branch['status']<17 && $admin_info->access_level == 1) || ($branch['status']>9 && $branch['status']<17 && $admin_info->access_level == 2 || $admin_info->access_level == 3)  && $branch['status']!=8 || ($branch['status']==2 && $admin_info->access_level == 2)) : ?>
>>>>>>> Stashed changes
                          <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                          
                        <?php elseif($branch['status']==8 && $branch['evaluator3']==0): ?>
                          <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/assign" data-toggle="modal" data-target="#assignBranchSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch['id']))?>" data-cname="<?=$brancharea.' '?><?= $branch['branchName']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign to Validator</a>
                        
                        <?php elseif($branch['status']==18): ?>
                          <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/forpaymentbranches" class="btn btnOkForPayment btn-color-blue"> OK For Payment</a>
                          <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                          
                        <?php elseif($branch['status']==19): ?>
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
                            } else if ($branch['area_of_operation'] == 'National') {
                                if($this->charter_model->in_charter_city($branch['cCode'])){
                                  $branch_name = $branch['city'];
                                } else {
                                  $branch_name = $branch['city'].', '.$branch['province'];
                                }
                            }
                        ?>
                          <input class="btn btn-color-blue offset-md-10" type="button" id="addOff" onclick="showPayment(<?=$branch['id']?>,'<?= encrypt_custom($this->encryption->encrypt($branch['coopName'].' - '.$branch_name.' '.$branch['branchName']))?>')" value="Save O.R. No.">
                          
                        <?php elseif($branch['status']==21 || $branch['status']==20): ?>
                          <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch['id'])) ?>/registration" class="btn btn-info"><i class='fas fa-print'></i> Print Registration</a>
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
<?php } ?>
<?php if($is_client) :?>
<?php else : ?>
<?php
  if($admin_info->access_level == 3 || $admin_info->access_level == 2){
?>
<div class="col-sm-12 col-md-12">
    <?php if($admin_info->region_code != '00'){ ?>
    <h3>Outside The Region</h3>
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
                foreach ($outside_the_region as $outside_the_region) : ?>
                <tr>
                  <td><?= $outside_the_region['coopName']?></td>
                  <?php if($outside_the_region['area_of_operation'] == 'Barangay' || $outside_the_region['area_of_operation'] == 'Municipality/City'){
                                $brancharea = $outside_the_region['brgy'];
                            } else if($outside_the_region['area_of_operation'] == 'Provincial') {
                                $brancharea = $outside_the_region['city'];
                            } else if ($outside_the_region['area_of_operation'] == 'Regional') {
                                if($this->charter_model->in_charter_city($outside_the_region['cCode'])){
                                  $brancharea = $outside_the_region['city'];
                                } else {
                                  $brancharea = $outside_the_region['city'].', '.$outside_the_region['province'];
                                }
                                
                            } else if ($outside_the_region['area_of_operation'] == 'National') {
                                $brancharea = $outside_the_region['city'].', '.$outside_the_region['province'];
                            }
                        ?>
                  <td><?php echo $brancharea.' '.$outside_the_region['branchName']?></td>
                  <td>
                    <?php if($outside_the_region['house_blk_no']==null && $outside_the_region['street']==null) $x=''; else $x=', ';?>
                    <?=$outside_the_region['house_blk_no']?> <?=$outside_the_region['street'].$x?> <?=$outside_the_region['brgy']?>, <?=$outside_the_region['city']?>, <?= $outside_the_region['province']?> <?=$outside_the_region['region']?>
                  </td>
                  <td>
                      <span class="badge badge-secondary">FOR VALIDATION</span>
                  </td>
                  <td>
                      <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($outside_the_region['id'])) ?>/documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php } else if($admin_info->access_level == 2){
                foreach ($outside_the_region_senior as $outside_the_region) : ?>
                <tr>
                  <td><?= $outside_the_region['coopName']?></td>
                  <?php if($outside_the_region['area_of_operation'] == 'Barangay' || $outside_the_region['area_of_operation'] == 'Municipality/City'){
                                $brancharea = $outside_the_region['brgy'];
                            } else if($outside_the_region['area_of_operation'] == 'Provincial') {
                                $brancharea = $outside_the_region['city'];
                            } else if ($outside_the_region['area_of_operation'] == 'Regional') {
                                $brancharea = $outside_the_region['city'].', '.$outside_the_region['province'];
                            } else if ($outside_the_region['area_of_operation'] == 'National') {
                                $brancharea = $outside_the_region['city'].', '.$outside_the_region['province'];
                            }
                        ?>
                  <td><?php echo $brancharea.' '.$outside_the_region['branchName']?></td>
                  <td>
                    <?php if($outside_the_region['house_blk_no']==null && $outside_the_region['street']==null) $x=''; else $x=', ';?>
                    <?=$outside_the_region['house_blk_no']?> <?=$outside_the_region['street'].$x?> <?=$outside_the_region['brgy']?>, <?=$outside_the_region['city']?>, <?= $outside_the_region['province']?> <?=$outside_the_region['region']?>
                  </td>
                  <td>
                      <span class="badge badge-secondary">FOR VALIDATION</span>
                  </td>
                  <td>
                      <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($outside_the_region['id'])) ?>/documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
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
                        <?php if($branch_registered['status']==21 || $branch_registered['status']==20): ?>
                            <a href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch_registered['id'])) ?>/registration" class="btn btn-info"><i class='fas fa-print'></i> Print Registration</a>
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
</div>


<!-- Bootstrap modal -->
 <div class="modal fade" id="paymentModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="#" role="form" id="paymentForm" name="paymentForm">
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
                  <td class="bord">Date</td>
                  <td class="bord" colspan="3"><b id="tDate"></b></td>
                </tr>
                <tr>
                  <td class="bord">O.R. No</td>
                  <td class="bord"><input type="text" id="orNo" name="orNo" class="form-control" placeholder="Type here..."></td>
                </tr>
                <tr>
                  <td class="bord">Date O.R</td>
                  <td class="bord"><input class="form-control validate[required,custom[date]]" type="date" id="orDate" name="orDate" class="form-control" placeholder="Click here..."></td>
                </tr>
                <tr>
                  <td class="bord">Transaction No.</td>
                  <td class="bord" colspan="3"><b id="tNo"></b></td>
                </tr>
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
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?=base_url();?>assets/js/toword.js"></script>

<script type="text/javascript">
  


  function showPayment(coop_id,coop_name) {
    //save_method = 'add';
    $('#paymentForm')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty();
<<<<<<< Updated upstream
=======
    // alert(coop_name);
>>>>>>> Stashed changes
    $.ajax({
        url : "<?php echo base_url('branches/payment')?>/" + coop_name,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            var s=convert(data.total);
            $('#payment_id').val(data.id);
            $('#tDate').text(data.date);
            $('#payor').text(data.payor);
            $('#tNo').text(data.transactionNo);
<<<<<<< Updated upstream
            $('#branch_ID').val(coop_id);   
            $('#word').text(s);
=======
            // $('#branch_ID').val(coop_id);   
            $('#word').text(s+' Pesos');
>>>>>>> Stashed changes
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
            alert(jqXHR.responseText);
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
          url : "<?php echo base_url('branches/saveor')?>/" + 'fuck',
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
                  window.location.href="<?php echo base_url('branches')?>";
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
<?php } ?>