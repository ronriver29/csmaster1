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
  
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg3">* Deferred Reason/s</button>

  <div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              The cooperative has been deferred because of the following reason/s:
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body" style="table-layout: fixed;">
              <pre><?php 
  //            print_r($cooperatives_comments);
              foreach($director_comment as $cc) :
                if(strlen($cc['comment'])>0)
                {
                  echo 'Date: '.date("F d, Y",strtotime($cc['created_at']));
                  echo '<ul type="square">';
                      echo '<li>'.$cc['comment'].'</li>';
                  echo '</ul>';
                }
              endforeach;
          ?></pre>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <!--            <button type="button" class="btn btn-primary">Save changes</button>-->
          </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<hr>
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
         
           <?php 
           $count_type =explode(',',$coop_info->type_of_cooperative);
           if(strlen($coop_info->acronym)>0)
           {
              $acronym_ = '('.$coop_info->acronym.')';
           }
           else
           {
            $acronym_='';
           }
            if(count($count_type)>1)
            {
              $proposedName_ = $coop_info->proposed_name.' Multipurpose Cooperative '.$coop_info->grouping.' '.$acronym_ ;
            }
            else
            {
               $proposedName_ = $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$coop_info->grouping.' '.$acronym_;
            }
           ?>
    
           <?= $proposedName_ ?>
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
        <p class="text-muted"> <?=$coop_info->common_bond_of_membership?></p>
         <hr>
          <?php
           if($coop_info->common_bond_of_membership=='Associational' || $coop_info->common_bond_of_membership=='Institutional')
           {
            ?>
            <strong>Field of Membership:</strong>
            <p class="text-muted"><?=$coop_info->field_of_membership?></p>
             <hr>
              <strong>Name of Associational:</strong>
              <p class="text-muted"><?=$coop_info->name_of_ins_assoc?></p>
            <?php
           }
           elseif($coop_info->common_bond_of_membership=='Occupational')
           {
            ?>

            <strong>Composition of Members</strong>
            <p class="text-muted">
              <?php foreach($members_composition as $compo) : ?>
              &#9679; <?= $compo['composition'] ?><br>
              <?php endforeach; ?>
            </p>

            <?php
           }
           else
           {
            
           }
           ?>
       
      
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
            <?php if($coop_info->status==12) echo "FOR PRINTING & SUBMISSION"; ?> 

            <?php if($coop_info->status==13 || $coop_info->status==14) echo "COMPLETE"; ?>
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
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/bylaws" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif;?>
      </li>
      
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">Additional Information: Capitalization</h5>
          <small class="text-muted">
            <?php if($capitalization_complete): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php endif; ?>
            <?php if(!$capitalization_complete) :?>
              <span class="badge badge-secondary">PENDING</span>
            <?php endif; ?>
          </small>
        </div>
        <?php if($coop_info->status!= 0): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_capitalization" class="btn btn-info btn-sm">View</a>
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
          <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_cooperators" class="btn btn-info btn-sm">View</a>
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
          <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_purposes" class="btn btn-info btn-sm">View</a>
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
          <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_articles" class="btn btn-info btn-sm">View</a>
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
          <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/committees" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li>
     <!--  <li class="list-group-item  flex-column align-items-start">
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
          <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_survey" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li> -->
      <!-- <li class="list-group-item  flex-column align-items-start">
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
          <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_staff" class="btn btn-info btn-sm">View</a>
        </small>
      <?php endif ?>
      </li> -->
      <li class="list-group-item  flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 font-weight-bold">
            Generated Bylaws, Article of Cooperation, Economic Survey, Treasurer's Affidavit and Uploaded documents
          </h5>
          <small class="text-muted">
              <?php if($status_document_one && $status_document_two && $status_document_cooptype): ?>
              <span class="badge badge-success">COMPLETE</span>
            <?php else:?>
            <span class="badge badge-secondary">PENDING</span>
          <?php endif;?>
          </small>
        </div>
        <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $economic_survey_complete && $staff_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_documents" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
      </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Finalize and review all the information provided. After reviewing the application, You can now evaluate the application.</h5>
            <small class="text-muted">
              <?php if($coop_info->status > 3) :?>
              <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if($coop_info->status == 3) :?>
              <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <?php if($coop_info->status==3 && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $economic_survey_complete && $staff_complete && $status_document_one && $status_document_two && $status_document_cooptype): ?>
          <small class="text-muted">
            <div class="btn-group" role="group" aria-label="Basic example">
              <a  class="btn btn-info btn-sm" href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_cooperative_tool">Tool</a>
              <?php
                if(strlen($coop_info->acronym)>0)
                {
                  $acronym_ = '('.$coop_info->acronym.')';
                }
                else
                {
                  $acronym_='';
                }
                if(count(explode(',',$coop_info->type_of_cooperative))>1)
                {
                  $proposedName_ = $coop_info->proposed_name.' Multipurpose Cooperative '.$acronym_;
                }
                else
                {
                  $proposedName_ = $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$acronym_;
                }
              ?>

              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveAmendmentModal"  data-cname="<?= $proposedName_?>" data-coopid="<?=encrypt_custom($this->encryption->encrypt($amendment_id))?>" <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Submit </button>
              <?php if($coop_info->status!=3){?>
              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyCooperativeModal" data-cname="<?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>"  <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Deny</button>
              <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferCooperativeModal"  data-cname="<?= $proposedName_?> " data-coopid="<?= encrypt_custom($this->encryption->encrypt($coop_info->id))?>"  <?php if($coop_info->tool_yn_answer==null) echo 'disabled';?> >Defer</button>
              <?php } ?>
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
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/bylaws_primary" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif;?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 3</h5>
            <small class="text-muted">
              <?php if($capitalization_complete): ?>
                <span class="badge badge-success">COMPLETE</span>
              <?php endif; ?>
              <?php if(!$capitalization_complete) :?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">Capitalization</p>
          <?php if($bylaw_complete): ?>
          <small class="text-muted">
           <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_capitalization" class="btn btn-info btn-sm">View </a> 
           <!--  <a href="<?php echo base_url();?>amendment/<?= $cooperative_id ?>/amendment_capitalization" class="btn btn-info btn-sm">View </a> -->

          </small>
        <?php endif;?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 4</h5>
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
          <?php if($coop_info->status!= 0 && $bylaw_complete && $capitalization_complete): ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_cooperators" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 5</h5>
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
          <?php if($coop_info->status!= 0 && $bylaw_complete && $cooperator_complete  ): // Comment insert later This () ?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_purposes" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 6</h5>
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
          <?php if($coop_info->status!= 0 && $bylaw_complete && $cooperator_complete && $purposes_complete): // Comment this && $cooperator_complete?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_articles" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li>
        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 7</h5>
            <small class="text-muted">
              <?php if($complete_position): ?>
                <span class="badge badge-success">COMPLETE</span>
             <?php else: ?>
                <span class="badge badge-secondary">PENDING</span>
              <?php endif; ?>
            </small>
          </div>
          <p class="mb-1 font-italic">List of Committees</p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $cooperator_complete && $purposes_complete && $article_complete ): //Comment this && $cooperator_complete?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/committees" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li>
        <!-- <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 8</h5>
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
          <?php if($coop_info->status!= 0 && $bylaw_complete && $cooperator_complete && $purposes_complete && $article_complete ): //Comment this && $cooperator_complete && $committees_complete?>
            <?php if(!$complete_position) {?>
            <?php } else {?>
                <small class="text-muted">
                  <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_survey" class="btn btn-info btn-sm">View</a>
                </small>
            <?php } ?>
        <?php endif ?>
        </li> -->
        <!-- <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 9</h5>
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
          <?php if($coop_info->status!= 0 && $bylaw_complete && $cooperator_complete && $purposes_complete && $article_complete && $complete_position): // comment this && $cooperator_complete && $committees_complete && $economic_survey_complete?>
          <small class="text-muted">
            <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_staff" class="btn btn-info btn-sm">View</a>
          </small>
        <?php endif ?>
        </li> -->
        <!-- <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 10</h5>
            <small class="text-muted">
          
            <?php  $count_coop_type= explode(',',$coop_info->type_of_cooperative); ?>
            <?php if(count( $count_coop_type)>1){?>
              
                <?php if($status_document_one && $status_document_two && $status_document_cooptype && $status_feasibility && $status_books_of_account): ?>
                <span class="badge badge-success">COMPLETE</span>
                <?php else: ?>
             
                <span class="badge badge-secondary">PENDING</span>
                <?php endif;?>
            <?php }else{ ?>

                 <?php if($status_document_one && $status_document_two && $status_document_cooptype): ?>
                <span class="badge badge-success">COMPLETE</span>
                <?php else: ?>
             
                <span class="badge badge-secondary">PENDING</span>
                <?php endif;?>

            <?php }//end else ?>
             
            </small>
          </div>
          <p class="mb-1 font-italic">View your Bylaws, Article of Cooperation, Economic Survey, Treasurer Affidavit and
            <?php if($is_client) : ?>
            Upload other documents
            <?php else : ?>
            Uploaded documents
            <?php endif;?>
          </p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $complete_position && $staff_complete): //&& $cooperator_complete && $committees_complete && $economic_survey_complete && $staff_complete ?>
            <small class="text-muted">
              <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_documents" class="btn btn-info btn-sm">View</a>
            </small>
          <?php endif ?>
        </li> -->

        <li class="list-group-item  flex-column align-items-start">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 font-weight-bold">Step 8</h5>
            <small class="text-muted">
          
            <?php  $count_coop_type= explode(',',$coop_info->type_of_cooperative); ?>
            <?php if(count( $count_coop_type)>1){?>
              
                <?php if($status_document_one && $status_document_two && $status_document_cooptype && $status_feasibility && $status_books_of_account): ?>
                <span class="badge badge-success">COMPLETE</span>
                <?php else: ?>
             
                <span class="badge badge-secondary">PENDING</span>
                <?php endif;?>
            <?php }else{ ?>

                 <?php if($status_document_one && $status_document_two && $status_document_cooptype): ?>
                <span class="badge badge-success">COMPLETE</span>
                <?php else: ?>
             
                <span class="badge badge-secondary">PENDING</span>
                <?php endif;?>

            <?php }//end else ?>
             
            </small>
          </div>
          <p class="mb-1 font-italic">View your Bylaws, Article of Cooperation, Treasurer Affidavit and
            <?php if($is_client) : ?>
            Upload other documents
            <?php else : ?>
            Uploaded documents
            <?php endif;?>
          </p>
          <?php if($coop_info->status!= 0 && $bylaw_complete && $purposes_complete && $article_complete && $complete_position): //&& $cooperator_complete && $committees_complete && $economic_survey_complete && $staff_complete ?>
            <small class="text-muted">
              <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_documents" class="btn btn-info btn-sm">View</a>
            </small>
          <?php endif ?>
        </li>

          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 9 </h5>
              <small class="text-muted">
                <?php if($coop_info->status > 1) :?>
                <span class="badge badge-success">COMPLETE</span>
                <?php endif; ?>
                <?php if($coop_info->status == 1) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Finalize and review all the information you provide. After reviewing your application, click proceed for evaluation of your application.</p>
            <?php if(count( $count_coop_type)>1):?>
              <?php if(($coop_info->status == 1||$coop_info->status == 11) && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $status_document_one && $status_document_two && $status_document_cooptype && $status_feasibility && $status_books_of_account && $complete_position){ ?>
              <small class="text-muted">
                <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/evaluate" class="btn btn-color-blue btnFinalize btn-sm ">Submit</a>
              </small>
              <?php  } //end if $coop->status ==1 ?>
            <?php else: ?> 
                <?php if(($coop_info->status == 1||$coop_info->status == 11) && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $status_document_one && $status_document_two && $status_document_cooptype && $complete_position){ ?>
                  <small class="text-muted">
                    <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/evaluate" class="btn btn-color-blue btnFinalize btn-sm ">Submit</a>
                  </small>
                  <?php }//end of $coop_info->status ==1 ?>
            <?php endif; //count coop type?>  
          </li>
          <li class="list-group-item  flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 font-weight-bold">Step 10</h5>
              <small class="text-muted">
                <?php if($coop_info->status == 16 || $coop_info->status == 15 || $coop_info->status == 13 || $coop_info->status == 14) :?>
                <span class="badge badge-success">COMPLETE</span>
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
              <h5 class="mb-1 font-weight-bold">Step 11</h5>
              <small class="text-muted">
                <?php if($coop_info->status == 15 || $coop_info->status == 13 || $coop_info->status == 14) :?>
                <span class="badge badge-success">COMPLETE</span>
                <?php endif; ?>
                <?php if($coop_info->status == 16) :?>
                <span class="badge badge-secondary">PENDING</span>
                <?php endif; ?>
              </small>
            </div>
            <p class="mb-1 font-italic">Wait for an e-mail notification of payment procedure.</p>
            
            <?php if(($coop_info->status==16) && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $status_document_one && $status_document_two && $status_document_cooptype): ?>
              <small class="text-muted">
                <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_payments" class="btn btn-color-blue btn-sm ">Payment</a>
              </small>
            <?php endif ?>
            <!-- Download payment -->
            <?php
            if(($coop_info->status ==13) && $bylaw_complete && $purposes_complete && $article_complete && $cooperator_complete && $committees_complete && $status_document_one && $status_document_two && $status_document_cooptype && $complete_position)
              {
                  
                if ($pay_from=='reservation')
                {
                  $rf=0;
                  $basic_reservation_fee =300; //fixed amount
                  $diff_amount = $amendment_capitalization->total_amount_of_paid_up_capital - $coop_capitalization->total_amount_of_paid_up_capital;
                  //amendment paid up is greater than coop total paid up
                  if($diff_amount>0)
                  {
                    $percentage_of_onepercent= $diff_amount * 0.01; //x 1%
                    $pecentage_of_ten_percent = $percentage_of_onepercent *0.1; //10% of one percent 
                    $total_reservation_fee = $pecentage_of_ten_percent+ $basic_reservation_fee;
                    $rf = $total_reservation_fee;
                  }
                  else
                  {
                    $rf =  $basic_reservation_fee;
                  }
                  // $lrf=(($rf+$name_reservation_fee)*.01>10) ?($rf+$name_reservation_fee)*.01 : 10;
                   $lrf=$rf*0.01;
                   if($lrf<10)
                   {
                    $lrf=10;
                   }
                }

                if(count(explode(',',$coop_info->type_of_cooperative))>1)
                {
                  $proposeName = $coop_info->proposed_name.' Multipurpose Cooperative'.$coop_info->grouping;
                }
                else
                {
                    $proposeName = $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.'  Cooperative '.$coop_info->grouping;
                }
                ?>
                
               <?php echo form_open('Amendment_payments/add_payment',array('id'=>'paymentForm','name'=>'paymentForm')); ?>
                 <input type="hidden" class="form-control" id="cooperativeID" name="cooperativeID" value="<?=$encrypted_id ?>">
                <input type="hidden" class="form-control" id="tDate" name="tDate" value="<?=date('Y-m-d',now('Asia/Manila')); ?>">
                <input type="hidden" class="form-control" id="payor" name="payor" value="<?=$proposeName?>">
                <input type="hidden" class="form-control" id="nature" name="nature" value="Amendment">
                <input type="hidden" class="form-control" id="particulars" name="particulars" value="Name Reservation Fee<br/>Registration<br/>Legal and Research Fund Fee">
                <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($name_reservation_fee,2).'<br/>'.number_format($rf,2).'<br/>'.number_format($lrf,2) ?>">
                <input type="hidden" class="form-control" id="total" name="total" value="<?=$rf+$lrf+$name_reservation_fee?>">
                <input type="hidden" class="form-control" id="nature" name="rCode" value="<?= $coop_info->rCode ?>">
                 <input style="width:20%;" class="btn btn-info btn-sm" type="submit" id="offlineBtn" name="offlineBtn" value="Downlaod O.P">
            </div>
          </form>
            <?php
             }  
            ?>
            <!-- end download payment -->
          </li>
      </ul>
    </div>
    <?php endif; ?>
</div>
