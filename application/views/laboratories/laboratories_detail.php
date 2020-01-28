<div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>laboratories" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
  </div>
</div>
<?php if($this->session->flashdata('redirect_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info text-center" role="alert">
      <?php echo $this->session->flashdata('redirect_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('laboratories_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('laboratories_success'); ?>
    </div>
  </div> 
</div>
<?php endif; ?>
<?php if($this->session->flashdata('laboratories_error')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger text-center" role="alert">
      <?php echo $this->session->flashdata('laboratories_error'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<!--<?php if($branch_info->status==0): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-warning text-center" role="alert">
        Your reservation has expired. Please update your branch details.
      </div>
    </div>
  </div>
<?php endif; ?>-->
<?php if($branch_info->status==25): //old 16 ?> <!-- modify by json -->

  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">The Laboratory has been denied because of the following reason/s:</p>
        <p><?= $comment_list_director->comment; ?></p>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if($branch_info->status==24):  ?> <!-- modify by json -->

  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">The Laboratory has been deferred because of the following reason/s:</p>
        <p><pre><?php echo $comment_list_defer_director->comment; ?></pre></p>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if($branch_info->status==12):  ?> <!-- modify by json -->
<?php if(isset($comment_list_senior) && !empty($comment_list_senior)){?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p class="font-weight-bold">Senior Comment:</p>
        <p><pre><?php echo $comment_list_senior->comment; ?></pre></p>
      </div>
    </div>
  </div>
  <?php }?>
<?php endif; ?>

<!-- <?php if($is_client && $branch_info->status==17 && strlen($branch_info->evaluation_comment) >= 1 && ($branch_info->evaluator1 > 0)) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">The branch has been deferred because of the following reason/s:</p>
        <pre><?= $branch_info->evaluation_comment ?></pre>
      </div>
    </div>
  </div>
<?php endif; ?> -->
<div class="row mb-2">
  <div class="col-sm-12 col-md-4">
    <div class="card border-top-blue shadow-sm mb-4">
      <?php if(!$is_client) : ?>
        <div class="card-header">
          <div class="row">
            <div class="col-sm-6 col-md-8">
              <h5 class="float-left font-weight-bold">Basic Information</h5>
            </div>
            <div class="col-sm-6 col-md-4">
              <small class="float-right">
                <?php if($branch_info->status!=0): ?>
                  <span class="badge badge-success">COMPLETE</span>
                <?php endif; ?>
                <?php if($branch_info->status==0) :?>
                  <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
          </div>
        </div>
      <?php endif;?>
      <?php if($is_client) : ?>
        <div class="card-header">
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <h5 class="float-left font-weight-bold">Basic Information</h5>
            </div>
          </div>
        </div>
      <?php endif;?>
      <div class="card-body">
        <small>
        <strong>Name of the Laboratory:</strong>
        <p class="text-muted">
          <?="Laboratory Cooperative of ". $branch_info->laboratoryName?>
        </p>
        <hr>
<!--        <strong>Branch</strong>
        <p class="text-muted">
          <?= $branch_info->branchName?>
        </p>
        <hr>-->
        <strong>Address of the Branch</strong>
        <p class="text-muted">
          <?php if($branch_info->house_blk_no==null && $branch_info->streetName==null) $x=''; else $x=', ';?>
          <?=ucwords($branch_info->house_blk_no)?> <?=ucwords($branch_info->streetName).$x?> <?=$branch_info->brgy.', '?> <?=$branch_info->city.', '?> <?= $branch_info->province.', '?> <?=$branch_info->region?>
        </p>
        <hr>
<!--        <strong>Business Activities - Subclass</strong>
        <p class="text-muted">
          <?php foreach($business_activities as $casd) : ?>
          &#9679; <?= $casd['bactivity_name'] ?> - <?= $casd['bactivitysubtype_name']?><br>
          <?php endforeach; ?>
            $branch_info->bactivity_name 
        </p>
        <hr>-->
<!--        <strong>Area of Operation</strong>
        <p class="text-muted">
          <?= $branch_info->area_of_operation?>
        </p>
        <hr>-->
        <?php if($is_client) : ?>
          <strong>Status</strong>
          <p class="text-muted">
            <?php if($branch_info->status==0) echo "EXPIRED"; ?>
            <?php if($branch_info->status==1) echo "PENDING"; ?>
            <?php if($branch_info->status>=2 && $branch_info->status<=15) echo "ON EVALUATION"; ?>
            <?php if($branch_info->status==25) echo "DENIED"; ?>
           <!--  <?php if($branch_info->status==17) echo "DEFERRED"; ?> -->
            <?php if($branch_info->status==24) echo "DEFERRED"; ?>
            <?php if($branch_info->status==18) echo "WAITING FOR PAYMENT"; ?>

            <?php if($branch_info->status==19 || $branch_info->status==20) echo "COMPLETED"; ?>
            <?php if($branch_info->status==21) echo "REGISTERED"; ?>
          </p>
        <?php endif; ?>
      </small>
      </div>
     
      <?php if(($is_client && ($branch_info->status<=1 || $branch_info->status==17)) || (!$is_client &&  $branch_info->status==9) ||  ($branch_info->status==24)): ?>
        <div class="card-footer">
          <a href="<?php echo base_url();?>laboratories/<?= $encrypted_id ?>/rupdate" class="btn btn-block btn-color-blue"><i class='fas fa-edit'></i> Update Basic Information</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php if(!$is_client) : ?>
  <div class="col-sm-12 col-md-8">
    <ul class="list-group">
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">
            Articles of Cooperation, By-Laws, Economic Survey, Treasurer's Affidavit, Audited Financial Statement and Uploaded documents
          </h5>
          <small class="text-muted">
          <?php if($document_5 && $document_6 && $document_7): ?>
            <span class="badge badge-success">COMPLETE</span>
          <?php endif;?>
          <?php if(!$document_5 && !$document_6 && !$document_7): ?>
            <span class="badge badge-secondary">PENDING</span>
          <?php endif;?>
          </small>
        </div>
        <?php if($branch_info->status!= 0): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>branches/<?= $encrypted_id ?>/documents" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
      </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Finalize and review all the information provided. After reviewing the application, You can now evaluate the application.</h5>
            <small class="text-muted">
              <?php if($branch_info->status > 3) :?>
                <span class="badge badge-success">COMPLETED</span>
              <?php endif; ?>
              <?php if($branch_info->status == 3) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <?php if(($branch_info->status>=2 && $branch_info->status<=15)  && $document_5 && $document_6 && $document_7): ?>
            <small class="text-muted">
              <div class="btn-group" role="group" aria-label="Basic example">
                
              </div>
            </small>
          <?php endif; ?>
        </li>
    </ul>
  </div>
<?php else : ?>
    <div class="col-sm-12 col-md-8">
      <ul class="list-group">
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold ">Step 1</h5>
            <small>
              <?php if($branch_info->status!=0): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if($branch_info->status==0) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Laboratory Registration and Basic Information.</p>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 2</h5>
            <small class="text-muted">
            <?php if($cooperators_count->CountCooperators >= 15): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif;?>
            <?php if($cooperators_count->CountCooperators < 15): ?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif;?>
            </small>
          </div>
          <p class="mb-1 font-italic">List of Members/Cooperators          
          </p>
          <?php if($branch_info->status!= 0 && ($branch_info->status!=25)): ?>
            <small class="text-muted">
              <a href="<?php echo base_url();?>laboratories/<?= $encrypted_id ?>/laboratories_cooperators" class="btn btn-info btn-sm">View</a>
            </small>
          <?php endif;?>
        </li>
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 3</h5>
              <small class="text-muted">
                <?php if($branch_info->status > 1 && ($branch_info->status)!=24) :?>
                <span class="badge badge-success">COMPLETED</span>
                <?php endif; ?>
                <?php if($branch_info->status == 1) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Finalize and review all the information you provide. After reviewing your application, click proceed for evaluation of your application.</p>
            <?php if(($branch_info->status == 1) && $cooperators_count->CountCooperators >= 15 || ($branch_info->status == 24)): ?>
              <?php if($manual_operation && $board_resolution) :?>
              <small class="text-muted">
                <a href="<?php echo base_url();?>laboratories/<?= $encrypted_id ?>/evaluate" class="btn btn-color-blue btnFinalize btn-sm ">Submit</a>
              <?php else: // end of manual and board?>
                   <!-- <?php if(($branch_info->status == 1) && $cooperators_count->CountCooperators >= 15):?> -->
                 
               <!--  <?php endif; ?>   -->
              <?php endif; ?>
               <a href="<?php echo base_url();?>laboratories/<?= $encrypted_id ?>/UploadDocuments" class="btn btn-info btn-sm">View</a>
            <?php endif; ?>
           
            </small>
          </li>
 
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 4</h5>
              <small class="text-muted">
               <!--  <?php if($branch_info->status == 19 || $branch_info->status == 20) :?>
                <span class="badge badge-success">COMPLETED</span>
                <?php endif; ?>
                <?php if($branch_info->status == 18) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?> -->

                 <?php if($branch_info->status == 18 || $branch_info->status ==19 ) :?>
                <span class="badge badge-success">COMPLETED</span>
                <?php endif; ?>
                <?php if($branch_info->status <= 12) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>

              </small>
            </div>
            <p class="mb-1 font-italic">Wait for an e-mail notification list of documents for submission.</p>
            
          </li>

          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 5</h5>
              <small class="text-muted">
                <?php if($branch_info->status == 19 || $branch_info->status == 20) :?>
                <span class="badge badge-success">COMPLETED</span>
                <?php endif; ?>
                <?php if($branch_info->status <= 18) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Wait for an e-mail notification of either the payment procedure or the list of documents for compliance. If your application has been approved, a payment button will appear and you can now proceed to payment.</p>
        

            <?php if(($branch_info->status==19) && $cooperators_count->CountCooperators >= 15): ?>
              <small class="text-muted">
                <a href="<?php echo base_url();?>laboratories/<?= $encrypted_id ?>/laboratories_payments_branch" class="btn btn-color-blue btn-sm ">Payment</a>
              </small>
            <?php endif ?>
          </li>
      </ul>
    </div>
<?php endif; ?>
</div>
