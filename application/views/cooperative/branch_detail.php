<div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>branches" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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
<?php if($this->session->flashdata('branch_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('branch_success'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('branch_error')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger text-center" role="alert">
      <?php echo $this->session->flashdata('branch_error'); ?>
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
<?php if($branch_info->status==16): ?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong2">
  * Deferred Reason/s
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">The cooperative has been deferred because of the following reason/s:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <pre><?php 
//            print_r($cooperatives_comments);
            foreach($branches_comments as $cc) :
                echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                echo '<ul type="square">';
                    echo '<li>'.$cc['comment'].'</li>';
                echo '</ul>';
            endforeach;
        ?></pre>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
<!--  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">The branch has been denied because of the following reason/s:</p>
        <p><?= $branch_info->evaluation_comment ?></p>
      </div>
    </div>
  </div>-->
<?php endif; ?>
<?php if($is_client && $branch_info->status==17 && strlen($branch_info->evaluation_comment) >= 1) : ?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong2">
  * Deferred Reason/s
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">The cooperative has been deferred because of the following reason/s:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <pre><?php 
//            print_r($cooperatives_comments);
            foreach($branches_comments as $cc) :
                echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                echo '<ul type="square">';
                    echo '<li>'.$cc['comment'].'</li>';
                echo '</ul>';
            endforeach;
        ?></pre>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
<!--  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">The branch has been deferred because of the following reason/s:</p>
        <pre><?= $branch_info->evaluation_comment ?></pre>
      </div>
    </div>
  </div>-->
<?php endif; ?>
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
        <strong>Name of the Cooperative:</strong>
        <p class="text-muted">
          <?= $branch_info->coopName?>
        </p>
        <hr>
        <strong>Branch</strong>
        <p class="text-muted">
          <?php
            if($branch_info->area_of_operation == 'Barangay' || $branch_info->area_of_operation == 'Municipality/City'){
                $branch_name = $branch_info->brgy;
            } else if($branch_info->area_of_operation == 'Provincial') {
                $branch_name = $branch_info->city;
            } else if ($branch_info->area_of_operation == 'Regional') {
                $branch_name = $branch_info->city.', '.$branch_info->province;
            } else if ($branch_info->area_of_operation == 'National') {
                $branch_name = $branch_info->city.', '.$branch_info->province;
            }
          ?>
          <?=$branch_name.' '?><?= $branch_info->branchName?>
        </p>
        <hr>
        <strong>Address of the Branch</strong>
        <p class="text-muted">
          <?php if($branch_info->house_blk_no==null && $branch_info->street==null) $x=''; else $x=', ';?>
          <?=ucwords($branch_info->house_blk_no)?> <?=ucwords($branch_info->street).$x?> <?=$branch_info->brgy.', '?> <?=$branch_info->city.', '?> <?= $branch_info->province.', '?> <?=$branch_info->region?>
        </p>
        <hr>
        <strong>Business Activities - Subclass</strong>
        <p class="text-muted">
          <?php foreach($business_activities as $casd) : ?>
          &#9679; <?= $casd['bactivity_name'] ?> - <?= $casd['bactivitysubtype_name']?><br>
          <?php endforeach; ?>
          <!--  $branch_info->bactivity_name -->
        </p>
        <hr>
        <strong>Area of Operation</strong>
        <p class="text-muted">
          <?= $branch_info->area_of_operation?>
        </p>
        <hr>
        <?php if($is_client) : ?>
          <strong>Status</strong>
          <p class="text-muted">
            <?php if($branch_info->status==0) echo "EXPIRED"; ?>
            <?php if($branch_info->status==1) echo "PENDING"; ?>
            <?php if($branch_info->status>=2 && $branch_info->status<=15) echo "ON EVALUATION"; ?>
            <?php if($branch_info->status==16) echo "DENIED"; ?>
            <?php if($branch_info->status==17) echo "DEFERRED"; ?>
            <?php if($branch_info->status==18) echo "WAITING FOR PAYMENT"; ?>

            <?php if($branch_info->status==19 || $branch_info->status==20) echo "COMPLETED"; ?>
            <?php if($branch_info->status==21) echo "REGISTERED"; ?>
          </p>
        <?php endif; ?>
      </small>
      </div>
      <?php if(($is_client && ($branch_info->status<=1 || $branch_info->status==17)) || (!$is_client &&  $branch_info->status==9)): ?>
        <div class="card-footer">
          <a href="<?php echo base_url();?>branches/<?= $encrypted_id ?>/bupdate" class="btn btn-block btn-color-blue"><i class='fas fa-edit'></i> Update Basic Information</a>
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
            Articles of Cooperation, By-Laws, Treasurer's Affidavit, Audited Financial Statement and Uploaded documents
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
          <p class="mb-1 font-italic"><?php if($branch_info->type == "Branch"){ echo 'Branch'; } else { echo 'Satellite'; }?> Registration and Basic Information.</p>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 2</h5>
            <small class="text-muted">
                <?php if($branch_info->type == "Branch"){ ?>
                    <?php if($document_5 && $document_6 && $document_7): ?>
                      <span class="badge badge-success">COMPLETE</span>
                    <?php endif;?>
                    <?php if(!$document_5 && !$document_6 && !$document_7): ?>
                      <span class="badge badge-secondary">PENDING</span>
                    <?php endif;?>
                <?php } if($branch_info->type == "Satellite"){ ?>
                      <?php if($document_7 && $document_8 && $document_9): ?>
                      <span class="badge badge-success">COMPLETE</span>
                    <?php endif;?>
                    <?php if(!$document_7 && !$document_8 && !$document_9): ?>
                      <span class="badge badge-secondary">PENDING</span>
                    <?php endif;?>
                <?php } ?>
            </small>
          </div>
          <p class="mb-1 font-italic">View Article of Cooperation, By-Laws, Treasurer Affidavit, Audited Financial Statement and Other Uploaded documents            
          </p>
          <?php if($branch_info->status!= 0): ?>
            <small class="text-muted">
              <a href="<?php echo base_url();?>branches/<?= $encrypted_id ?>/documents" class="btn btn-info btn-sm">View</a>
            </small>
          <?php endif;?>
        </li>
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 3</h5>
              <small class="text-muted">
                <?php if($branch_info->status > 1) :?>
                <span class="badge badge-success">COMPLETED</span>
                <?php endif; ?>
                <?php if($branch_info->status == 1) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Finalize and review all the information you provide. After reviewing your application, click proceed for evaluation of your application.</p>
            <?if($branch_info->type == "Branch"){ ?>
            <?php if(($branch_info->status == 1||$branch_info->status == 17) && $document_5 && $document_6 && $document_7): ?>
            <small class="text-muted">
              <a href="<?php echo base_url();?>branches/<?= $encrypted_id ?>/evaluate" class="btn btn-color-blue btnFinalize btn-sm ">Submit</a>
            </small>
            <?php endif; ?>
            <?php } else {?>
            <?php if(($branch_info->status == 1||$branch_info->status == 17) && $document_7 && $document_8 && $document_9): ?>
            <small class="text-muted">
              <a href="<?php echo base_url();?>branches/<?= $encrypted_id ?>/evaluate" class="btn btn-color-blue btnFinalize btn-sm ">Submit</a>
            </small>
            <?php endif; ?>
            <?php } ?>
          </li>
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 4</h5>
              <small class="text-muted">
                <?php if($branch_info->status == 19 || $branch_info->status == 20 || $branch_info->status == 21 || $branch_info->status == 22) :?>
                <span class="badge badge-success">COMPLETE</span>
                <?php endif; ?>
                <?php if($branch_info->status == 18) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Wait for an e-mail notification list of documents for submission.</p>
            <?if($branch_info->type == "Branch"){ ?>
            <?php if(($branch_info->status==22 || $branch_info->status==19) && $document_5 && $document_6 && $document_7): ?>
              <!-- <small class="text-muted">
                <a href="<?php echo base_url();?>branches/<?= $encrypted_id ?>/Payments_branch" class="btn btn-color-blue btn-sm ">Payment</a>
              </small> -->
            <?php endif ?>
            <?php } else {?>
            <?php if(($branch_info->status==22 || $branch_info->status==19) && $document_7 && $document_8 && $document_9): ?>
            <!-- <small class="text-muted">
                <a href="<?php echo base_url();?>branches/<?= $encrypted_id ?>/Payments_branch" class="btn btn-color-blue btn-sm ">Payment</a>
              </small> -->
            <?php endif ?>
            <?php } ?>
          </li>
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 5</h5>
              <small class="text-muted">
                <?php if($branch_info->status == 19 || $branch_info->status == 20 || $branch_info->status == 21) :?>
                <span class="badge badge-success">COMPLETE</span>
                <?php endif; ?>
                <?php if($branch_info->status == 18) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Wait for an e-mail notification of either the payment procedure or the list of documents for compliance. If your application has been approved, a payment button will appear and you can now proceed to payment.</p>
            <?if($branch_info->type == "Branch"){ ?>
            <?php if(($branch_info->status==22 || $branch_info->status==19) && $document_5 && $document_6 && $document_7): ?>
              <small class="text-muted">
                <a href="<?php echo base_url();?>branches/<?= $encrypted_id ?>/Payments_branch" class="btn btn-color-blue btn-sm ">Payment</a>
              </small>
            <?php endif ?>
            <?php } else {?>
            <?php if(($branch_info->status==22 || $branch_info->status==19) && $document_7 && $document_8 && $document_9): ?>
            <small class="text-muted">
                <a href="<?php echo base_url();?>branches/<?= $encrypted_id ?>/Payments_branch" class="btn btn-color-blue btn-sm ">Payment</a>
              </small>
            <?php endif ?>
            <?php } ?>
          </li>
      </ul>
    </div>
<?php endif; ?>
</div>
