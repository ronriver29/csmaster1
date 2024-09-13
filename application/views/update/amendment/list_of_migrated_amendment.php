
<div class="row"> 
  <div class="col-md-12">
<?php if($this->session->flashdata('amendment_msg')) :?>       
       <div class="alert alert-<?=$this->session->flashdata('msg_class')?> alert-dismissible">
         <button type = "button" class="close" data-dismiss = "alert">x</button>
         <?=$this->session->flashdata('amendment_msg')?>
       </div>
   <?php endif; ?>
 </div>
</div>

<?php 
if($is_client && !$has_registered_coop):?>
<div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
       <center> <p>"A Cooperative must be registered first to open Amendment module."</p></center>
      </div>
    </div>
  </div>
<?php endif;?>
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
    <div class="alert alert-danger text-center" role="alert">
      <?php echo $this->session->flashdata('list_error_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<div class="row">
  <?php if($is_client && $has_registered_coop) : ?>
  <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
    <?php  if($is_coop_updated && $is_amendment_updated): ?>
    <a class="btn btn-color-blue btn-block" href="<?php echo base_url();?>amendment/application" role="button">Amend a Cooperative</a>
   <?php endif; ?>
  </div>
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

  <?php if($has_registered_coop):?>
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperativesTable">
            <thead>
              <tr>
                <th>Amendment No.</th>
                <th>Name of Cooperative</th>
                <?php if(!$is_client) : ?>
                  <th>Office Address</th>
                <?php endif;?>
                <th>Amended Name</th>
                <th>Status</th>
                <?php if(!$is_client){?>
                <th>Date Registered</th>
              <?php } ?>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
              <?php if($list_cooperatives!=null){?>
              <?php foreach ($list_cooperatives as $cooperative) : ?>
                <tr>
                  <td><center><?=$cooperative['amendmentNo']?></center></td>
                  <td>
                   <?php
                   // if(strlen($cooperative['acronym'])>0)
                   // {
                   //  $acronym_ = '('.$cooperative['acronym'].')';
                   // }
                   // else
                   // {
                   //  $acronym_='';
                   // }
                   //  $count_tYpe = explode(',',$cooperative['type_of_cooperative']);
                   //  if(count($count_tYpe)>1)

                   //  {
                   //    $proposeNames = $cooperative['proposed_name'].' Multipurpose Cooperative '.$acronym_.' '.$cooperative['grouping'];
                   //  }
                   //  else
                   //  {
                   //    $proposeNames = $cooperative['proposed_name'].' '.$cooperative['type_of_cooperative']. ' Cooperative '.$acronym_.' '.$cooperative['grouping'];
                   //  }
                    echo $cooperative['coopName'];
                    // echo $this->amendment_model->proposed_name_comparison($cooperative['regNo'],$cooperative['amendmentNo'],$proposeNames);
                    ?>  
                   
                  <?php if(!$is_client) : ?>
                    <td>
                      <?php if($cooperative['house_blk_no']==null && $cooperative['street']==null) $x=''; else $x=', ';?>
                      <?=$cooperative['house_blk_no']?> <?=$cooperative['street'].$x?><?=$cooperative['brgy']?>, <?=$cooperative['city']?>, <?= $cooperative['province']?> <?=$cooperative['region']?>
                    </td>
                  <?php endif; ?>
                   <td><!-- <?= (strcasecmp(trim(preg_replace('/\s\s+/', ' ',$this->amendment_model->get_last_proposed_name($cooperative['regNo'],$cooperative['amendmentNo']))),trim(preg_replace('/\s\s+/', ' ',$proposeNames)))!=0 ? $proposeNames : "")?> --></td>
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
                        else if($cooperative['status']==11 && !$this->amendment_model->check_if_revert($cooperative['id'])) echo "DEFERRED";
                        else if($cooperative['status']==11 && $this->amendment_model->check_if_revert($cooperative['id'])) echo "REVERTED-DEFERRED";
                        else if($cooperative['status']==12) echo "FOR PRINTING & SUBMISSION";
                        else if($cooperative['status']==13) echo "PAY AT CDA";
                        else if($cooperative['status']==14) echo "GET YOUR CERTIFICATE";
                        else if($cooperative['status']==15) echo "FOR UPDATING";
                        else if($cooperative['status']==16) echo "FOR PAYMENT";
                        else if($cooperative['status']==17) echo "FOR REVERSION-FOR RE-EVALUATION"; 
                        else if($cooperative['status']==40) echo "FOR UPDATING";
                        else if($cooperative['status']==41) echo "REGISTERED";?>

                      <?php else : ?>
                        <?php /*if($cooperative['status']==2)echo "FOR VALIDATION"; 
                         else if($cooperative['status']==3) echo "FOR VALIDATION";
                        else if($cooperative['status']==4) echo "DENIED BY CDS II";
                        else if($cooperative['status']==5) echo "DEFERRED BY CDS II";
                        else if($cooperative['status']==6 && $cooperative['third_evaluated_by']>0) echo "FOR RE-EVALUATION";
                        else if($cooperative['status']==6) echo "SUBMITTED BY CDS II";
                        else if($cooperative['status']==7) echo "DENIED BY SENIOR CDS";
                        else if($cooperative['status']==8) echo "DEFERRED BY SENIOR CDS";
                        else if($cooperative['status']==9 && !$is_acting_director && $admin_info->access_level==3) echo "DELEGATED BY DIRECTOR";
                        else if($cooperative['status']==9 && $supervising_ && $admin_info->access_level==4) echo "DELEGATED BY DIRECTOR";
                        else if($cooperative['status']==9 && $cooperative['third_evaluated_by']>0) echo "FOR RE-EVALUATION";
                        else if($cooperative['status']==9) echo "SUBMITTED BY SENIOR CDS";
                        else if($cooperative['status']==10) echo "DENIED BY DIRECTOR";
                        else if($cooperative['status']==11) echo "DEFERRED BY DIRECTOR";
                        else if($cooperative['status']==12) echo "FOR PRINT&SUBMIT";
                        else if($cooperative['status']==13) echo "WAITING FOR O.R.";
                        else if($cooperative['status']==14) echo "FOR PRINTING";
                        else if($cooperative['status']==15) echo "REGISTERED"; 
                        else if($cooperative['status']==16) echo "FOR PAYMENT";
                        else if($cooperative['status']==17) echo "REVERT FOR RE-EVALUATION"; */?>
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
                        else if($cooperative['status']==11 && !$this->amendment_model->check_if_revert($cooperative['id'])) echo "DEFERRED";
                        else if($cooperative['status']==11 && $this->amendment_model->check_if_revert($cooperative['id'])) echo "REVERTED-DEFERRED";
                        else if($cooperative['status']==12) echo "FOR PRINT&SUBMIT";
                        else if($cooperative['status']==13) echo "WAITING FOR O.R.";
                        else if($cooperative['status']==14) echo "FOR PRINTING";
                        else if($cooperative['status']==15) echo "REGISTERED"; 
                        else if($cooperative['status']==16) echo "FOR PAYMENT";
                        else if($cooperative['status']==17) echo "FOR REVERSION-FOR RE-EVALUATION";
                        else if($cooperative['status']==40) echo "FOR UPDATING";
                        else if($cooperative['status']==41) echo "REGISTERED";?> ?>


                      <?php endif ?>

                      </span>
                    </td>
                    <?php if(!$is_client){?>
                    <td><?=date("F d, Y",strtotime($cooperative['dateRegistered'])) ?></td>
                  <?php } ?>
                  <?php if($is_client) :?>  
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="<?php echo base_url();?>amendment_update/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> Click to update </a>
                      <?php if($cooperative['status']<2 || $cooperative['status']==10|| $cooperative['status']==11) : ?>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAmendmentForm" data-cname="<?= $cooperative['proposed_name']?> <?= $cooperative['type_of_cooperative']?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($cooperative['id']))?>"><i class='fas fa-trash'></i><?php echo ($cooperative['status']==10 || $cooperative['status']==11) ? "Delete": "Cancel" ?></button>
                      <?php endif;?>
                      </div>
                    </td>
                  <?php endif;?>
                  <?php if(!$is_client) :?>

                    <?php 
                    if(strlen($cooperative['acronym'])>0)
                    {
                      $acronym_ = '('.$cooperative['acronym'].')';
                    }
                    else
                    {
                      $acronym_='';
                    }
                    if(count(explode(',',$cooperative['type_of_cooperative']))>1)
                    {
                      $proposeName_ = $cooperative['proposed_name'].' Multipurpose Cooperative '.$acronym_.' '.$cooperative['grouping'];
                    }
                    else
                    {
                      $proposeName_ =  $cooperative['proposed_name'].' '.$cooperative['type_of_cooperative'].' Cooperative '.$acronym_.' '.$cooperative['grouping'];
                    }
                    ?>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                      <?php if($admin_info->access_level == 1 || ($admin_info->access_level == 2 && $cooperative['status']==6 )) : ?>
                        <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Cooperative</a>
                      <?php else: ?>
                         
                        <?php if(($cooperative['status'] ==17) ||  $cooperative['status']>2 && $cooperative['status']<11  && $cooperative['status']!=3 && $cooperative['evaluated_by']!=0 ) : ?>
                          <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/amendment_documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                        <?php elseif($cooperative['status']==2 && $cooperative['evaluated_by']==0): ?>
                          <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistAmendmentModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($cooperative['id']))?>" data-cname="<?= $proposeName_?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign Validator</a>
                        <?php elseif($cooperative['status']==3): ?>  
                           <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistAmendmentModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($cooperative['id']))?>" data-cname="<?= $proposeName_?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Re-assign Validator</a>

                        <?php elseif($cooperative['status']==12): ?>
                          <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/amendment_forpayment" class="btn btn-color-blue"> OK For Payment</a>
                          <!--  <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/amendment_documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a> -->
                            <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Cooperative</a>
                       

                        <?php elseif($cooperative['status']==13): ?>
                          <?php if(count(explode(',',$cooperative['type_of_cooperative']))>1):?>
                             <?php $proposeName =$cooperative['proposed_name'].' Multipurpose Cooperative '.$cooperative['grouping']?>

                            <input class="btn btn-color-blue offset-md-10" type="button" id="addOff" onclick="showPayment('<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>')" value="Save O.R. No.">

                          <?php else: ?>
                              <input class='btn btn-color-blue offset-md-10' type='button' id='addOff' onclick='showPayment("<?=encrypt_custom($this->encryption->encrypt($cooperative['id']))?>")' value="Save O.R. No.">
                          <?php endif; ?>
                          
                       
                        <?php elseif($cooperative['status']==14 || $cooperative['status']==15): ?>
                          <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>/amendment_registration" class="btn btn-info"><i class='fas fa-print'></i> Print Registration</a>
                        <?php endif; ?>
                      <?php endif;?>
                      </div>
                    </td>
                  <?php endif;?>
                </tr>
              <?php endforeach; ?>
              <?php } //end not null ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> 
</div>
<?php endif; //end if has registered coop?>    
<?php if(!$is_client && $admin_info->region_code != '00' && $admin_info->access_level==2) :?>
<h4 style="
padding: 15px 10px;
background: #fff;
background-color: rgb(255, 255, 255);
border: none;
border-radius: 0;
margin-bottom: 20px;
box-shadow: 1px 1px 1px 2px rgba(0, 0, 0, 0.1);">Deferred/Denied</h4>

<div class="card border-top-blue shadow-sm mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="cooperativesTable">
        <thead>
          <tr>
            <th>Name of Cooperative</th>
            <?php if(!$is_client) : ?>
            <th>Office Address</th>
            <?php endif;?>
            <th>Status</th>
            
            <th>Action </th>
          </tr>
        </thead>
        <?php
          foreach($list_of_defer_deny as $cooperative)
          {
        ?>
            <tr>
                  <td>
                   <?php
                   if(strlen($cooperative['acronym'])>0)
                   {
                    $acronym_ = '('.$cooperative['acronym'].')';
                   }
                   else
                   {
                    $acronym_='';
                   }
                    $count_tYpe = explode(',',$cooperative['type_of_cooperative']);
                    if(count($count_tYpe)>1)

                    {
                      $proposeNames = $cooperative['proposed_name'].' Multipurpose Cooperative '.$acronym_.' '.$cooperative['grouping'];
                    }
                    else
                    {
                      $proposeNames = $cooperative['proposed_name'].' '.$cooperative['type_of_cooperative']. ' Cooperative '.$acronym_.' '.$cooperative['grouping'];
                    }
                    echo $proposeNames;
                    ?>  
                  </td>

                  <td>
                      <?php if($cooperative['house_blk_no']==null && $cooperative['street']==null) $x=''; else $x=', ';?>
                      <?=$cooperative['house_blk_no']?> <?=$cooperative['street'].$x?><?=$cooperative['brgy']?>, <?=$cooperative['city']?>, <?= $cooperative['province']?> <?=$cooperative['region']?>
                  </td>
                  <td>  
                  <span class="badge badge-secondary">
                        <!-- <?php
                         if($cooperative['status']==10) echo "DENIED BY DIRECTOR";
                        else if($cooperative['status']==11) echo "DEFERRED BY DIRECTOR";
                        ?> -->
                        <?php if($is_client) : ?>
                        
                      <?php else : ?>
                        <?php if($cooperative['status']==10) echo "DENIED BY DIRECTOR";
                        else if($cooperative['status']==11 && !$this->amendment_model->check_if_revert($cooperative['id'])) echo "DEFERRED";
                        else if($cooperative['status']==11 && $this->amendment_model->check_if_revert($cooperative['id'])) echo "REVERTED-DEFERRED";
                        else if($cooperative['status']==6 && $cooperative['third_evaluated_by']>0) echo "FOR RE-EVALUATION"; ?>
                      <?php endif ?>
                  </span>
                  </td>

                  <td> 
                  <?php if($cooperative['status'] ==10 || $cooperative['status'] ==11 && $admin_info->access_level ==2):?>
                    <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                  <?php endif;?>
                  </td>                    
            </tr>        
        <?php    
          }
        ?>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php endif;?>          

<?php if(!$is_client && $admin_info->region_code != '00') :?>
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
                    <?php
                      if(strlen($cooperative_registered['acronym'])>0)
                     {
                      $acronym_ = '('.$cooperative_registered['acronym'].')';
                     }
                     else
                     {
                      $acronym_='';
                     }
                      $count_tYpe = explode(',',$cooperative_registered['type_of_cooperative']);
                    if(count($count_tYpe)>1)

                    {
                      $proposeNames = $cooperative_registered['proposed_name'].' Multipurpose Cooperative '.$acronym_;
                    }
                    else
                    {
                      $proposeNames = $cooperative_registered['proposed_name'].' '.$cooperative_registered['type_of_cooperative']. ' Cooperative '.$acronym_;
                    }
                    echo $proposeNames;
                    ?>
                  </td>
                  <td>
                    <?php if($cooperative_registered['house_blk_no']==null && $cooperative_registered['street']==null) $x=''; else $x=', ';?>
                    <?=$cooperative_registered['house_blk_no']?> <?=$cooperative_registered['street'].$x?><?=$cooperative_registered['brgy']?>, <?=$cooperative_registered['city']?>, <?= $cooperative_registered['province']?> <?=$cooperative_registered['region']?>
                  </td>
                  <td>
                    <span class="badge badge-secondary">
                      <?php $array_status = array(15,40,41);
                      if(in_array($cooperative_registered['status'],$array_status)) { echo "REGISTERED"; }?>
                    </span>
                  </td>
                  <td width="31%">
                    <?php $ar = array(2,5); $viewdoc_array = array(2,3,5) ?>
                    <?php if(in_array($admin_info->access_level,$ar)):?>
                      <ul id="ul-admin">
                        <li style="list-style: none;">
                      <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/amendment_registration" class="btn btn-sm btn-info"><i class='fas fa-print'></i> Re-print Registration</a>
                    </li>
                     <?php endif; ?>
                     <?php if(in_array($admin_info->access_level,$viewdoc_array)): ?>
                    <li style="list-style: none;">
                      <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/amendment_documents" class="btn btn-sm btn-info"><i class='fas fa-eye'></i> View Document</a>
                    </li>
                     <?php endif; //end of viewdoc array?>
                  </ul>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div><?endif;?>

  

    <!-- HO PROCESS -->
    <?php if(!$is_client  && $admin_info->region_code == '00') :?>
    <div class="col-sm-12 col-md-12">
        <h4 style="
        padding: 15px 10px;
        background: #fff;
        background-color: rgb(255, 255, 255);
        border: none;
        border-radius: 0;
        margin-bottom: 20px;
        box-shadow: 1px 1px 1px 2px rgba(0, 0, 0, 0.1);">Registered Coop Processed by Head Office</h4>
   
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
                <?php foreach ($list_cooperatives_registered_by_ho as $cooperative_registered) : ?>
                <tr>
                  <td><?= $cooperative_registered['proposed_name']?> <?= $cooperative_registered['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative_registered['acronym_name'])){ echo '('.$cooperative_registered['acronym_name'].')';}?> <?= $cooperative_registered['grouping']?>
                  </td>
                  <td>
                    <?php if($cooperative_registered['house_blk_no']==null && $cooperative_registered['street']==null) $x=''; else $x=', ';?>
                    <?=$cooperative_registered['house_blk_no']?> <?=$cooperative_registered['street'].$x?><?=$cooperative_registered['brgy']?>, <?=$cooperative_registered['city']?>, <?= $cooperative_registered['province']?> <?=$cooperative_registered['region']?>
                  </td>
                  <td>
                    <span class="badge badge-secondary">
                      <?php if($cooperative_registered['status']==15) { echo "Re-Print Certificate"; }?>
                    </span>
                  </td>
                  <td width="31%">
                    <?php $ar = array(2,5); $viewdoc_array = array(2,3,5) ?>
                    <?php if(in_array($admin_info->access_level,$ar)):?>
                    <ul id="ul-admin">
                      <li>
                        <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/amendment_registration" class="btn btn-sm btn-info"><i class='fas fa-print'></i> Re-print Registration</a>
                      </li>
                      <?php endif; ?>
                      <?php if(in_array($admin_info->access_level,$viewdoc_array)): ?>
                      <li style="list-style: none;">
                        <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/amendment_documents" class="btn btn-sm btn-info"><i class='fas fa-eye'></i> View Document</a>
                      </li>
                      <?php endif; //end of viewdoc array?>
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
     <?php endif;?>
    <!-- END HO PROCESS -->

    <!-- PROCESS BY HO -->
    <?php if(!$is_client  && $admin_info->region_code != '00') :?>
    <div class="col-sm-12 col-md-12">
        <h4 style="
        padding: 15px 10px;
        background: #fff;
        background-color: rgb(255, 255, 255);
        border: none;
        border-radius: 0;
        margin-bottom: 20px;
        box-shadow: 1px 1px 1px 2px rgba(0, 0, 0, 0.1);">Registered Coop Processed by Head Office</h4>
   
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
                <?php foreach ($list_of_cooperative_by_ho_process as $cooperative_registered) : ?>
                <tr>
                  <td><?= $cooperative_registered['proposed_name']?> <?= $cooperative_registered['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative_registered['acronym_name'])){ echo '('.$cooperative_registered['acronym_name'].')';}?> <?= $cooperative_registered['grouping']?>
                  </td>
                  <td>
                    <?php if($cooperative_registered['house_blk_no']==null && $cooperative_registered['street']==null) $x=''; else $x=', ';?>
                    <?=$cooperative_registered['house_blk_no']?> <?=$cooperative_registered['street'].$x?><?=$cooperative_registered['brgy']?>, <?=$cooperative_registered['city']?>, <?= $cooperative_registered['province']?> <?=$cooperative_registered['region']?>
                  </td>
                  <td>
                    <span class="badge badge-secondary">
                      <?php if($cooperative_registered['status']==15) { echo "Re-Print Certificate"; }?>
                    </span>
                  </td>
                  <td width="31%">
                    <?php $ar = array(2,5); $viewdoc_array = array(2,3,5) ?>
                    <?php if(in_array($admin_info->access_level,$ar)):?>
                    <ul id="ul-admin">
                      <li>
                        <a href="<?php echo base_url();?>amendment/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/amendment_registration" class="btn btn-sm btn-info"><i class='fas fa-print'></i> Re-print Registration</a>
                      </li>
                      <?php endif; ?>
                      <?php if(in_array($admin_info->access_level,$viewdoc_array)): ?>
                      <li style="list-style: none;">
                        <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/documents" class="btn btn-sm btn-info"><i class='fas fa-eye'></i> View Document</a>
                      </li>
                      <?php endif; //end of viewdoc array?>
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
    <?php endif;?>
    <!-- END PROCESS BY HO -->
</div>
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
          
          <input type="hidden" name="payment_id" id="payment_id"> 
          <input type="hidden" name="cid" id="cid">
          <div class="row">
            <div class="col-md-12">
              

              <table width="100%" class="bord">
                
                <tr>
                  <td class="bord">Date</td>
                  <td class="bord" colspan="3"><b id="tDate"></b></td>
                </tr>
               
                <tr>
                  <td class="bord">O.R. No</td>
                  <td class="bord"><input type="text" id="orNo" name="orNo" class="form-control" placeholder="Type here..." required></td>
                </tr>
                 <tr>
                  <td class="bord">Date of OR</td>
                  <td class="bord"><input type="date" id="dateofOR" name="dateofOR"  class="form-control" required><span id="msgdate" style="font-size:11px;margin-left:100px;color:red;font-style: italic;"></span></td>
                </tr>
                 <tr>
                  <td class="bord">Order of Payment No.</td>
                    <td class="bord" colspan="3"><b id="ref_nos"></b></td>
                </tr>

               <!--  <tr>
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
                  <td class="pera" width="" id="particulars" ></td>
                  <td class="pera" width="8%" valign="top"> </td>
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
  $('#dateofOR').on('change',function(){
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

  // function showPayment(coop_id,$coop_name) {
  function showPayment(coop_id) {
    //save_method = 'add';
   // coop_name = escape(coop_name);
    $('#paymentForm')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty();

    $.ajax({
        url : "<?php echo base_url('amendment/payment')?>",
        type: "post",
        dataType: "JSON",
        data: {coop_id:coop_id},
        success: function(data)
        { 
          var currentdate = new Date(data.date);
          var month = currentdate.getMonth() + 1;
          var day = currentdate.getDate();
          var formated_date = ( (('' + day).length < 2 ? '0' : '')  + day + '-' + (('' + month).length < 2 ? '0' : '') + month + '-' +currentdate.getFullYear());

         
            var s=convert(data.total);
            $('#ref_nos').text(data.refNo);
            $('#payment_id').val(data.id);
            $('#tDate').text(formated_date);
            $('#payor').text(data.payor);
            $('#tNo').text(data.transactionNo);
            $('#cid').val(coop_id);   
            $('#word').text(s);
            $('#nature').text(data.nature);
            $('#particulars').html(data.particulars);
            $('#amount').html(data.amount); 
            $('#total').text(parseFloat(data.total).toFixed(2));
 
            
            $('#paymentModal').modal('show'); // show bootstrap modal
            $('.modal-title').text('Order of Payment');

 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax!');
        }
    });
  }

  function save(){
    var x = $('#orNo').val(); 
    if (x==''){
      alert('Missing O.R. No.');
    }
    else{
      var paymentFormData = new FormData($('#paymentForm')[0]);
      $.ajax({
          url : "<?php echo base_url('amendment/saveor')?>/" + 'res',
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
                  window.location.href="<?php echo base_url('amendment')?>";
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