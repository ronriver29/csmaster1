<div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <?php if($is_client) : ?>
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>laboratories_update" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
  <?php else : ?>
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>updated_laboratory_info" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
  <?php endif; ?>
  </div>
  <div class="col-sm-12 col-md-2">
      <?php if($lab_info_updating->status==24):  ?> <!-- modify by json -->


        <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg3">* Director Findings</button>


  <div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="deferMemberModalLabel">The cooperative has been deferred because of the following reason/s:</h4>
          <!-- <h4 class="modal-title"></h4> -->
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body form">
          <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>
            <!-- <div class="form-group">
              <div class="col-md-12">
            <?php
                      echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
                      foreach($cooperatives_comments as $cc) :
                        echo '<p>'.nl2br($cc['tool_comments']).'</p>';
                      endforeach;
              ?>
          </div>
          </div> -->
          <?php foreach($comment_list_defer_director as $cc) :
                        echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));
                        echo '<ul type="square">';
                            echo '<li>'.$cc['comment'].'</li>';
                        echo '</ul>';
                    endforeach; ?>
    </div>
</div>
    </div>
  </div>
        <!-- <div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
            <div class="modal-content">
                <div class="modal-header">
                    The cooperative has been deferred because of the following reason/s:
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <?php if($comment_list_defer_director!=NULL) { ?>
                <div class="modal-body form" style="table-layout: fixed;">
                    <pre><?php
        //            print_r($cooperatives_comments);
                    foreach($comment_list_defer_director as $cc) :
                        echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));
                        echo '<ul type="square">';
                            echo '<li>'.$cc['comment'].'</li>';
                        echo '</ul>';
                    endforeach;
                ?></pre>
                </div>
              <?php } //end not null ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!--            <button type="button" class="btn btn-primary">Save changes</button>-->
                <!-- </div>
            </div>
          </div>
        </div> -->
      <?php endif; ?>
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
<!--<?php if($lab_info_updating->status==0): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-warning text-center" role="alert">
        Your reservation has expired. Please update your branch details.
      </div>
    </div>
  </div>
<?php endif; ?>-->


<?php if($lab_info_updating->status==25): //old 16 ?> <!-- modified by json -->

  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">The Laboratory has been denied because of the following reason/s:</p>
        <p><?= $comment_list_director->comment; ?></p>
      </div>
    </div>
  </div>
<?php endif; ?>



<?php if(!$is_client):?>
<?php if($lab_info_updating->status==12):  ?> <!-- modify by json -->
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
<?php endif; ?>
<!-- <?php if($is_client && $lab_info_updating->status==17 && strlen($lab_info_updating->evaluation_comment) >= 1 && ($lab_info_updating->evaluator1 > 0)) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">The branch has been deferred because of the following reason/s:</p>
        <pre><?= $lab_info_updating->evaluation_comment ?></pre>
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
                <?php if($lab_info_updating->status!=0): ?>
                  <span class="badge badge-success">COMPLETE</span>
                <?php endif; ?>
                <?php if($lab_info_updating->status==0) :?>
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
          <?=$lab_info_updating->laboratoryName." Laboratory Cooperative"?>
        </p>
        <hr>
<!--        <strong>Branch</strong>
        <p class="text-muted">
          <?= $lab_info_updating->branchName?>
        </p>
        <hr>-->
        <strong>Address of the Laboratory</strong>
        <p class="text-muted">
          <?php if($lab_info_updating->house_blk_no==null && $lab_info_updating->streetName==null) $x=''; else $x=', ';?>
          <?=ucwords($lab_info_updating->house_blk_no)?> <?=ucwords($lab_info_updating->streetName).$x?> <?=$lab_info_updating->brgy.', '?> <?=$lab_info_updating->city.', '?> <?= $lab_info_updating->province.', '?> <?=$lab_info_updating->region?>
        </p>
        <hr>
<!--        <strong>Business Activities - Subclass</strong>
        <p class="text-muted">
          <?php foreach($business_activities as $casd) : ?>
          &#9679; <?= $casd['bactivity_name'] ?> - <?= $casd['bactivitysubtype_name']?><br>
          <?php endforeach; ?>
            $lab_info_updating->bactivity_name
        </p>
        <hr>-->
<!--        <strong>Area of Operation</strong>
        <p class="text-muted">
          <?= $lab_info_updating->area_of_operation?>
        </p>
        <hr>-->
        <?php if($is_client) : ?>
          <strong>Status</strong>
          <p class="text-muted">
            <?php if($lab_info_updating->status==0) echo "EXPIRED"; ?>
            <?php if($lab_info_updating->status==1) echo "PENDING"; ?>
            <?php if($lab_info_updating->status>=2 && $lab_info_updating->status<=15) echo "ON EVALUATION"; ?>
            <?php if($lab_info_updating->status==25) echo "DENIED"; ?>
           <!--  <?php if($lab_info_updating->status==17) echo "DEFERRED"; ?> -->
            <?php if($lab_info_updating->status==24) echo "DEFERRED"; ?>
            <?php if($lab_info_updating->status==18) echo "FOR PRINT & SUBMIT"; ?>

            <?php if($lab_info_updating->status==19) echo "FOR PAYMENT"; ?>
            <?php if($lab_info_updating->status==20) echo "WAITING FOR O.R."; ?>
            <?php if($lab_info_updating->status==21) echo "REGISTERED"; ?>
          </p>
        <?php endif; ?>
      </small>
      </div>

      <?php if(($is_client && ($lab_info_updating->status==21))): ?>
        <div class="card-footer">
          <a href="<?php echo base_url();?>laboratories_update/<?= $encrypted_id ?>/rupdate" class="btn btn-block btn-color-blue"><i class='fas fa-edit'></i> Update Basic Information</a>
        </div>
      <?php endif; ?>
      <?php if((!$is_client && ($lab_info_updating->status==30 || $lab_info_updating->status==31))): ?>
        <div class="card-footer">
          <a href="<?php echo base_url();?>laboratories_update/<?= $encrypted_id ?>/rupdate" class="btn btn-block btn-color-blue"><i class='fas fa-edit'></i> Update Basic Information</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
    <div class="col-sm-12 col-md-8">
      <ul class="list-group">
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold ">Step 1</h5>
            <small>
              <?php if($lab_info_updating->status!=0): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if($lab_info_updating->status==0) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Laboratory Registration and Basic Information.</p>
        </li>
        <?php
          if($lab_info_updating->addrCode != ''){
            $allowed = true;
          } else {
            $allowed = false;
          }
        ?>
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

          <?php if($lab_info_updating->status != 0 && ($lab_info_updating->status!=25)): ?>
            <small class="text-muted">
              <?php if($allowed){?>
                <a href="<?php echo base_url();?>laboratories_update/<?= $encrypted_id ?>/laboratories_cooperators_update" class="btn btn-info btn-sm">View</a>
              <?php } else { ?>
                Please update basic information first.
              <?php } ?>
            </small>
          <?php endif;?>

        </li>
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 3</h5>
              <small class="text-muted">
                <?php if($lab_info_updating->status > 1 && ($lab_info_updating->status)!=24) :?>
                <span class="badge badge-success">COMPLETED</span>
                <?php endif; ?>
                <?php if($lab_info_updating->status == 1) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Finalize and review all the information you provide. After reviewing your application, click proceed for evaluation of your application.</p>
            <?php if(($lab_info_updating->status == 21 || $lab_info_updating->status == 30 || $lab_info_updating->status == 31)) : ?>
              <small class="text-muted">
                <?php if($allowed){?>
                  <?php if($lab_info_updating->status == 21 && $lab_info_updating->status != 30){?>
                    <a href="<?php echo base_url();?>laboratories_update/<?= $encrypted_id ?>/evaluate" class="btn btn-color-blue btnFinalize btn-sm ">Submit</a>
                  <?php } ?>
                  <a href="<?php echo base_url();?>laboratories_update/<?= $encrypted_id ?>/UploadDocuments" class="btn btn-info btn-sm">View</a>
                <?php } else { ?>
                  Please update basic information first.
                <?php } ?>
            <?php endif; ?>
            <?php if(!$is_client && $lab_info_updating->status==30): ?>
              <small class="text-muted">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="<?php echo base_url();?>laboratories_update/<?= $encrypted_id ?>/evaluate" class="btn btn-color-blue btnFinalize btn-sm ">Submit</a>
                </div>
              </small>
            <?php endif; ?>

            </small>
          </li>

          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 4</h5>
              <small class="text-muted">
               <!--  <?php if($lab_info_updating->status == 19 || $lab_info_updating->status == 20) :?>
                <span class="badge badge-success">COMPLETED</span>
                <?php endif; ?>
                <?php if($lab_info_updating->status == 18) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?> -->

                 <?php if($lab_info_updating->status == 18 || $lab_info_updating->status ==19 ) :?>
                <span class="badge badge-success">COMPLETED</span>
                <?php endif; ?>
                <?php if($lab_info_updating->status <= 12) :?>
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
                <?php if($lab_info_updating->status == 19 || $lab_info_updating->status == 20) :?>
                <span class="badge badge-success">COMPLETED</span>
                <?php endif; ?>
                <?php if($lab_info_updating->status <= 18) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Wait for an e-mail notification of either the payment procedure or the list of documents for compliance. If your application has been approved, a payment button will appear and you can now proceed to payment.</p>


            <?php if(($lab_info_updating->status==19) && $cooperators_count->CountCooperators >= 15): ?>
              <small class="text-muted">
                <a href="<?php echo base_url();?>laboratories/<?= $encrypted_id ?>/laboratories_payments_branch" class="btn btn-color-blue btn-sm ">Payment</a>
              </small>
            <?php endif ?>

          </li>
      </ul>
    </div>
</div>
