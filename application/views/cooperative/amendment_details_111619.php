<div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>amendment" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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
<?php if($this->session->flashdata('cooperative_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('cooperative_success'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('cooperative_error')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger text-center" role="alert">
      <?php echo $this->session->flashdata('cooperative_error'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($coop_info->status==0): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-warning text-center" role="alert">
        Your reservation has expired. Please update your cooperative details.
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($coop_info->status==10): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">The cooperative has been denied because of the following reason/s:</p>
        <pre><?= $coop_info->evaluation_comment ?></pre>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($is_client && $coop_info->status==11 && strlen($coop_info->evaluation_comment) >= 1 && ($coop_info->evaluated_by > 0)) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger" role="alert">
        <p class="font-weight-bold">The cooperative has been deferred because of the following reason/s:</p>
        <pre><?= $coop_info->evaluation_comment ?></pre>
      </div>
    </div>
  </div>
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
                <?php if($coop_info->status!=0): ?>
                  <span class="badge badge-success">COMPLETE</span>
                <?php endif; ?>
                <?php if($coop_info->status==0) :?>
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
        <strong>Proposed Name:</strong>
        <p class="text-muted">
          <?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?= $coop_info->grouping?>
        </p>
        <hr>
        <strong>Category of Cooperative</strong>
        <p class="text-muted">
          <?= $coop_info->category_of_cooperative?>
        </p>
        <hr>
        <strong>Business Activities - Subclass</strong>
        <p class="text-muted">
          <?php foreach($business_activities as $casd) : ?>
          &#9679; <?= $casd['bactivity_name'] ?> - <?= $casd['bactivitysubtype_name']?><br>
          <?php endforeach; ?>
          <!--  $coop_info->bactivity_name -->
        </p>
        <hr>
        <strong>Common Bond of Membership</strong>
        <p class="text-muted">
          <?= $coop_info->common_bond_of_membership?>
        </p>
        <hr>
        <strong>Composition of Members</strong>
        <p class="text-muted">
          <?php foreach($members_composition as $compo) : ?>
          &#9679; <?= $compo['composition'] ?><br>
          <?php endforeach; ?>
        </p>
        <hr>
        <strong>Area of Operation</strong>
        <p class="text-muted">
          <?= $coop_info->area_of_operation?>
        </p>
        <hr>
        <strong>Proposed address of the cooperative</strong>
        <p class="text-muted">
          <?php if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';?>
          <?=ucwords($coop_info->house_blk_no)?> <?=ucwords($coop_info->street).$x?> <?=$coop_info->brgy.', '?> <?=$coop_info->city.', '?> <?= $coop_info->province.', '?> <?=$coop_info->region?>
        </p>
        <hr>
        <?php if($is_client) : ?>
          <strong>Status</strong>
          <p class="text-muted">
            <?php if($coop_info->status==0) echo "EXPIRED"; ?>
            <?php if($coop_info->status==1) echo "PENDING"; ?>
            <?php if($coop_info->status>=2 && $coop_info->status<=9) echo "ON EVALUATION"; ?>
            <?php if($coop_info->status==10) echo "DENIED"; ?>
            <?php if($coop_info->status==11) echo "DEFERRED"; ?>
            <?php if($coop_info->status==12) echo "WAITING FOR PAYMENT"; ?>

            <?php if($coop_info->status==13 || $coop_info->status==14) echo "COMPLETED"; ?>
            <?php if($coop_info->status==15) echo "REGISTERED"; ?>
              <?php if($coop_info->status==16) echo "FOR PAYMENT"; ?>
          </p>
          <hr>
          <?php if($coop_info->status==1 || $coop_info->status==12) :?>
            <strong>Expiration</strong>
            <p class="text-muted">
              <?= date("Y-m-d h:i:sa",strtotime($coop_info->expire_at)) ?>
            </p>
          <?php endif; ?>
        <?php endif; ?>
      </small>
      </div>
      <?php if(($is_client && ($coop_info->status==11||$coop_info->status<=1)) || (!$is_client &&  $coop_info->status==3)): ?>
        <div class="card-footer">
          <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_update" class="btn btn-block btn-color-blue"><i class='fas fa-edit'></i> Update Basic Information</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php if(!$is_client) : ?>
  <div class="col-sm-12 col-md-8">
    <ul class="list-group">
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">Additional Information: By Laws</h5>
          <small class="text-muted">
            <?php if($bylaw_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$bylaw_complete) :?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <?php if($coop_info->status!= 0): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/bylaws" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif;?>
      </li>
      
      
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">List of Cooperators</h5>
          <small class="text-muted">
            <?php if($cooperator_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$cooperator_complete): ?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <?php if($coop_info->status!= 0 && $bylaw_complete): ?>
        <small class="text-muted">
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/cooperators" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">Cooperative's Purposes</h5>
          <small class="text-muted">
            <?php if($purposes_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$purposes_complete) :?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <?php if($coop_info->status!= 0 && $bylaw_complete && $cooperator_complete): ?>
        <small class="text-muted">
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/purposes" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">Additional Information: Articles of Cooperation</h5>
          <small class="text-muted">
            <?php if($article_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$article_complete) :?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <?php if($coop_info->status!= 0 && $bylaw_complete && $cooperator_complete && $purposes_complete): ?>
        <small class="text-muted">
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/articles" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">List of Committees</h5>
          <small class="text-muted">
            <?php if($committees_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$committees_complete): ?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <?php if($coop_info->status!= 0 && $bylaw_complete && $article_complete && $cooperator_complete && $purposes_complete): ?>
        <small class="text-muted">
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/committees" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">Additional Information: Economic Survey</h5>
          <small class="text-muted">
            <?php if($economic_survey_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$economic_survey_complete): ?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <?php if($coop_info->status!= 0 && $bylaw_complete && $article_complete && $cooperator_complete && $committees_complete && $purposes_complete): ?>
        <small class="text-muted">
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/survey" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">List of Staff/Employees</h5>
          <small class="text-muted">
            <?php if($staff_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$staff_complete): ?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <?php if($coop_info->status!= 0 && $bylaw_complete && $article_complete && $purposes_complete && $cooperator_complete && $committees_complete && $economic_survey_complete): ?>
        <small class="text-muted">
          <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/staff" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li>
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">
            Generated Bylaws, Article of Cooperation, Economic Survey, Treasurer's Affidavit and Uploaded documents
          </h5>
          <small class="text-muted">
              <?php if($document_one && $document_two): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif;?>
            <?php if(!$document_one && !$document_two): ?>
            <span class="badge badge-secondary">PENDING</span>
          <?php endif;?>
          </small>
        </div>
        <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $economic_survey_complete && $staff_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/documents" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
      </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Finalize and review all the information provided. After reviewing the application, You can now evaluate the application.</h5>
            <small class="text-muted">
              <?php if($coop_info->status > 3) :?>
              <span class="badge badge-success">COMPLETED</span>
              <?php endif; ?>
              <?php if($coop_info->status == 3) :?>
              <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <?php if($coop_info->status==3 && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $economic_survey_complete && $staff_complete && $document_one && $document_two): ?>
          <small class="text-muted">
            <div class="btn-group" role="group" aria-label="Basic example">
              <a  class="btn btn-info btn-sm" href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_cooperative_tool">Tool</a>
              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveCooperativeModal"  data-cname="<?= $coop_info->proposed_name?> <?=$coop_info->type_of_cooperative?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Approve</button>
              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyCooperativeModal" data-cname="<?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>"  <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Deny</button>
              <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferCooperativeModal"  data-cname="<?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>"  <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Defer</button>
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
              <?php if($coop_info->status!=0): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if($coop_info->status==0) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Cooperative Name Reservation and Basic Information.</p>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 2</h5>
            <small class="text-muted">
              <?php if($bylaw_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$bylaw_complete) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Additional Information: By Laws</p>
          <?php if($coop_info->status!= 0): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/bylaws" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif;?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 3</h5>
            <small class="text-muted">
              <?php if($cooperator_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$cooperator_complete): ?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">List of Cooperators</p>
          <?php if($coop_info->status!= 0 && $bylaw_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_cooperators" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 4</h5>
            <small class="text-muted">
              <?php if($purposes_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$purposes_complete) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Cooperative's Purposes</p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $cooperator_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_purposes" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 5</h5>
            <small class="text-muted">
              <?php if($article_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$article_complete) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Additional Information: Articles of Cooperation</p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $cooperator_complete && $purposes_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_articles" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 6</h5>
            <small class="text-muted">
              <?php if($committees_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$committees_complete): ?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">List of Committees</p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/committees" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 7</h5>
            <small class="text-muted">
              <?php if($economic_survey_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$economic_survey_complete): ?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Additional Information: Economic Survey</p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete): ?>
                <small class="text-muted">
                  <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_survey" class="btn btn-info btn-sm">View</a>
                </small>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 8</h5>
            <small class="text-muted">
              <?php if($staff_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$staff_complete): ?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">List of Staff/Employees</p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $economic_survey_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_staff" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 9</h5>
            <small class="text-muted">
                <?php if($document_one && $document_two): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif;?>
              <?php if(!$document_one && !$document_two): ?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif;?>
            </small>
          </div>
          <p class="mb-1 font-italic">View your Bylaws, Article of Cooperation, Economic Survey, Treasurer Affidavit and
            <?php if($is_client) : ?>
            Upload other documents
            <?php else : ?>
            Uploaded documents
            <?php endif;?>
          </p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $economic_survey_complete && $staff_complete): ?>
            <small class="text-muted">
              <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_documents" class="btn btn-info btn-sm">View</a>
            </small>
          <?php endif ?>
        </li>
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 10</h5>
              <small class="text-muted">
                <?php if($coop_info->status > 1) :?>
                <span class="badge badge-success">COMPLETED</span>
                <?php endif; ?>
                <?php if($coop_info->status == 1) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Finalize and review all the information you provide. After reviewing your application, click proceed for evaluation of your application.</p>
            <?php if(($coop_info->status == 1||$coop_info->status == 11) && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $economic_survey_complete && $staff_complete && $document_one && $document_two): ?>
            <small class="text-muted">
              <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/evaluate" class="btn btn-color-blue btnFinalize btn-sm ">Submit</a>
            </small>
            <?php endif; ?>
          </li>
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 11</h5>
              <small class="text-muted">
                <?php if($coop_info->status == 16 || $coop_info->status == 15 || $coop_info->status == 13 || $coop_info->status == 14) :?>
                <span class="badge badge-success">COMPLETED</span>
                <?php endif; ?>
                <?php if($coop_info->status == 12) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Wait for an e-mail notification list of documents for submission.</p>
          </li>
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 12</h5>
              <small class="text-muted">
                <?php if($coop_info->status == 15 || $coop_info->status == 13 || $coop_info->status == 14) :?>
                <span class="badge badge-success">COMPLETED</span>
                <?php endif; ?>
                <?php if($coop_info->status == 16) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Wait for an e-mail notification of payment procedure.</p>
            <?php if(($coop_info->status==16) && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $economic_survey_complete && $staff_complete && $document_one && $document_two): ?>
              <small class="text-muted">
                <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_payments" class="btn btn-color-blue btn-sm ">Payment</a>
              </small>
            <?php endif ?>
          </li>
      </ul>
    </div>
    <?php endif; ?>
</div>
