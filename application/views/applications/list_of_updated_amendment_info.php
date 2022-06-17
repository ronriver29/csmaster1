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
   .page-link{
    height: 3.5rem;
    width: 3.5rem;
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
<div class="row">
 


  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
          <?php echo form_open('updated_amendment_info',array('id'=>'amendmentAddForm','name'=>'amendmentAddForm')); ?> 
         <div class="row rd-row">
        
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="areaOfOperation">Cooperative Name: </label>
              <input type="text" name="coopName" class="form-control"/>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="areaOfOperation">Registration No.: </label>
              <input type="text" name="regNo" class="form-control">
            </div>
          </div>
        </div> 
         <div class="row col-sm-6 col-md-1 align-self-center col-reserve-btn">
              <input class="btn btn-color-blue" type="submit" name="btn-filter" value="search" style="float:left;">
          </div>
      <?php echo form_close(); ?>

      <hr>
        <div class="table-responsive">
          
       

          <table class="table table-bordered">
            <thead>
              <tr>
                 <th>Amendment No.</th>
                <th>Name of Cooperative</th>
                <?php if(!$is_client) : ?>
                  <th>Office Address</th>
                <?php endif;?>
                <th>Status</th>
                <th>Date Amendment</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_cooperatives as $cooperative) : ?>
                <tr>
                    <td><?=$cooperative['amendmentNo']?></td>
                  <td><?=$cooperative['coopName']?> <?php /*if($cooperative['category_of_cooperative'] == 'Primary' || $cooperative['type_of_cooperative'] == "Bank" || $cooperative['type_of_cooperative'] == "Insurance"){?>
                      <?= $cooperative['proposed_name']?> <?= $cooperative['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative['acronym_name'])){ echo '('.$cooperative['acronym_name'].')';}?>
                    <?php } else if($cooperative['grouping'] == 'Union' && $cooperative['type_of_cooperative'] == 'Union'){?>
                        <?= $cooperative['proposed_name']?> <?= $cooperative['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative['acronym_name'])){ echo '('.$cooperative['acronym_name'].')';}?>
                    <?php } else { ?>
                      <?= $cooperative['proposed_name']?> Federation of <?= $cooperative['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative['acronym_name'])){ echo '('.$cooperative['acronym_name'].')';
                    }?>
                  <?php } */?></td>
                
                  <?php if(!$is_client) : ?>
                    <td>
                      <?php if($cooperative['house_blk_no']==null && $cooperative['street']==null) $x=''; else $x=', ';?>
                      <?=$cooperative['house_blk_no']?> <?=$cooperative['street'].$x?><?=$cooperative['brgy']?>, <?=$cooperative['city']?>, <?= $cooperative['province']?> <?=$cooperative['region']?>
                    </td>
                  <?php endif; ?>
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
                    <td><?=date("F d, Y",strtotime($cooperative['dateRegistered']))?></td>
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
                        <!-- FOR LIST OF UPDATED COOPERATIVE INFO -->
                        <?php if($cooperative['status']==40): ?>
                          <a href="<?php echo base_url();?>amendment_update/<?= encrypt_custom($this->encryption->encrypt($cooperative['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View Cooperative</a>
                        <?php endif; ?>           
                      </div>
                    </td>
                  <?php endif;?> 
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

        </div>  <?=$links?>
      </div>
    </div>

