<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <?php if($branch_info->status != 21 && $branch_info->status != 0 && $branch_info->status == 80 && $branch_info->status == 81){ ?>
      <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>branches/<?= $encrypted_branch_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php } else if($branch_info->status == 0) { ?>
      <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>branch_update/<?= $encrypted_branch_id ?>/view" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php } else if($branch_info->status == 80 || $branch_info->status == 81) { ?>
      <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>branch_update/<?= $encrypted_branch_id ?>/view" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php } else { ?>
      <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>branches/<?= encrypt_custom($this->encryption->encrypt($branch_info->regNo)) ?>/branch_registered" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php }?>

    <?php if($is_client) : ?>
    <h5 class="text-primary text-right">
      Step 2
    </h5>
    <hr>
    <?php else :?>
      <?php if($branch_info->status == 23 || $branch_info->status == 24){ ?>
        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <?php
                if($branch_info->area_of_operation == 'Barangay' || $branch_info->area_of_operation == 'Municipality/City'){
                $branch_name = $branch_info->brgy;
                } else if($branch_info->area_of_operation == 'Provincial') {
                    $branch_name = $branch_info->city;
                } else if ($branch_info->area_of_operation == 'Regional') {
                    if($this->charter_model->in_charter_city($branch_info->cCode)){
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    }
                } else if ($branch_info->area_of_operation == 'Interregional') {
                    if($this->charter_model->in_charter_city($branch_info->cCode)){
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    }
                } else if ($branch_info->area_of_operation == 'National') {
                    if($this->charter_model->in_charter_city($branch_info->cCode)){
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    }
                }

                if($admin_info->access_level == 3){
                    $submit = 'Approve';
                } else {
                    $submit = 'Submit';
                } 
            ?>

          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveBranchModal"  data-cname="<?= $branch_name?> <?= $branch_info->branchName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch_info->id))?>" ><?=$submit?></button>
        <?php if($branch_info->status == 23){ ?>
          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyBranchModal" data-cname="<?= $branch_name?> <?= $branch_info->branchName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch_info->id))?>">Deny</button>
          <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferBranchModal" data-cname="<?= $branch_name?> <?= $branch_info->branchName?>" data-comment="<?= $branch_info->comment_by_senior_level1?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch_info->id))?>">Defer</button>
        <?php } ?>
        </div>
        <?php } ?>
      <?php if($admin_info->access_level !=5 && $branch_info->status != 23 && $branch_info->status != 24 && $branch_info->status != 21 && $branch_info->status != 80 && $branch_info->status != 81) : ?>
        <div class="btn-group float-right" role="group" aria-label="Basic example">
          <?php if($branch_info->status>=9) echo '<a class="btn btn-info btn-sm" href="'.base_url().'branches/'.$encrypted_branch_id.'/cooperative_tool/branch">Validation Tool</a>';
          ?>
        <?php 
        if($branch_info->status != 18 && $branch_info->status != 23){
            if($admin_info->access_level == 3){
                $submit = 'Approve';
            } else {
                $submit = 'Submit';
            } 

            if($branch_info->area_of_operation == 'Barangay' || $branch_info->area_of_operation == 'Municipality/City'){
                $branch_name = $branch_info->brgy;
            } else if($branch_info->area_of_operation == 'Provincial') {
                $branch_name = $branch_info->city;
            } else if ($branch_info->area_of_operation == 'Regional') {
              if($this->charter_model->in_charter_city($branch_info->cCode)){
                $branch_name = $branch_info->city;
              } else {
                $branch_name = $branch_info->city.', '.$branch_info->province;
              }
            } else if ($branch_info->area_of_operation == 'Interregional') {
              if($this->charter_model->in_charter_city($branch_info->cCode)){
                $branch_name = $branch_info->city;
              } else {
                $branch_name = $branch_info->city.', '.$branch_info->province;
              }
            } else if ($branch_info->area_of_operation == 'National') {
                if($this->charter_model->in_charter_city($branch_info->cCode)){
                  $branch_name = $branch_info->city;
                } else {
                  $branch_name = $branch_info->city.', '.$branch_info->province;
                }
            }
            ?>
            <?php if($admin_info->access_level ==2 || $admin_info->access_level ==1 || $is_active_director || $supervising_): ?>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveBranchModal"  data-cname="<?= $branch_name.' '?><?= $branch_info->branchName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch_info->id))?>" <?php if(($branch_info->tool_yn_answer==null && $branch_info->status>=9 || $branch_info->status>=23)) echo 'disabled';?> ><?=$submit?></button>
            <?php endif; //endo fo coop info status ?>  
            <?php if($admin_info->access_level == 3 && $is_active_director || $supervising_) { ?>
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#denyBranchModal" data-cname="<?= $branch_name.' '?><?= $branch_info->branchName?>" data-bname="<?= $branch_name.' '?><?= $branch_info->branchName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch_info->id))?>" <?php if($branch_info->tool_yn_answer==null && $branch_info->status>=9) echo 'disabled';?> >Deny</button>
                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#deferBranchModal" data-comment="<?php foreach($branches_comments_cds as $cc) : echo $cc['comment']; endforeach;?>
                        

<?php foreach($branches_comments_snr as $cc) : echo $cc['comment'].'
'; endforeach;?>

<?= $branch_info->tool_findings?>" data-cname="<?= $branch_name.' '?><?= $branch_info->branchName?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($branch_info->id))?>" <?php if($branch_info->tool_yn_answer==null && $branch_info->status>=9) echo 'disabled';?> >Defer</button>
            <?php } ?>
        <?php  } ?>

        </div>
      <?php endif; ?>
  </div>
</div>
<?php if(strlen(($branch_info->comment_by_senior_level1 && $admin_info->access_level==3)) && $branch_info->status == 23) : ?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong3">
  * Senior Findings
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Senior Findings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <pre><?php 
//            print_r($cooperatives_comments);
            foreach($branches_comments_snr as $cc) :
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
<!--    <div class="row mt-3">
      <div class="col-sm-12 col-md-12">
        <div class="alert alert-info" role="alert">
          <p class="font-weight-bold">CDS Comment:</p>
          <pre><?= $branch_info->comment_by_senior_level1 ?></pre>
        </div>
      </div>
    </div>-->
<?php endif;?>
<?php if(strlen(($branch_info->comment_by_director_level1 && $admin_info->access_level==2) || $admin_info->access_level==3 || $admin_info->access_level==1) && $branch_info->status != 23 && $branch_info->regCode != 0) : ?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong2">
  * Main Region Findings
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document" style="width:90% !important;max-width:1360px;">
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
            foreach($branches_comments_main as $cc) :
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
<!--    <div class="row mt-3">
      <div class="col-sm-12 col-md-12">
        <div class="alert alert-info" role="alert">
          <p class="font-weight-bold">Level 1 Director Comment:</p>
          <pre><?= $branch_info->comment_by_director_level1 ?></pre>
        </div>
      </div>
    </div>-->
<?php endif;?>
<?php if(strlen(($branch_info->comment_by_specialist && $admin_info->access_level==2) || $admin_info->access_level==3) && $branch_info->status != 23) : ?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong">
  * CDS Findings
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">CDS Findings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <pre><?php 
//            print_r($cooperatives_comments);
            foreach($branches_comments_cds as $cc) :
                echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                echo '<ul type="square">';
                    echo '<li>'.$cc['comment'].'</li>';
                echo '</ul>';
            endforeach;
                echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
                echo '<p>'.$branch_info->tool_findings.'</p>';
        ?></pre>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
<!--    <div class="row mt-3">
      <div class="col-sm-12 col-md-12">
        <div class="alert alert-info" role="alert">
          <p class="font-weight-bold">CDS Comment:</p>
          <pre><?= $branch_info->comment_by_specialist ?></pre>
          <?php if(strlen($branch_info->tool_findings)){
              echo '<p class="font-weight-bold">CDS Tool Findings</p>';
              echo $branch_info->tool_findings;
          } ?>
        </div>
      </div>
    </div>-->
<?php endif;?>
<?php if(strlen($branch_info->comment_by_senior && $admin_info->access_level==3) || strlen($branch_info->comment_by_senior && $admin_info->access_level==2)) : ?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong3">
  * Senior Findings
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Senior Findings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <pre><?php 
//            print_r($cooperatives_comments);
            foreach($branches_comments_snr as $cc) :
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
      <div class="alert alert-info" role="alert">
        <p class="font-weight-bold">Senior Comment:</p>
        <pre><?= $branch_info->comment_by_senior ?></pre>
      </div>
    </div>
  </div>-->
<?php endif;?>
<?php if(strlen(($branch_info->temp_evaluation_comment && $admin_info->access_level==3) || ($branch_info->temp_evaluation_comment && $admin_info->access_level==2) || ($branch_info->status == 17))) : ?>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong33">
  * Deferred Reason/s
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong33" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle33" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle33">The cooperative has been deferred because of the following reason/s:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <pre><?php 
//            print_r($cooperatives_comments);
        if($branch_info->evaluator5 == NULL){
            foreach($branches_comments_level1_defer as $cc) :
                echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                echo '<ul type="square">';
                    echo '<li>'.$cc['comment'].'</li>';
                echo '</ul>';
            endforeach;
        } else {
          foreach($branches_comments as $cc) :
                echo 'Date: '.date("F d, Y",strtotime($cc['date_created']));
                echo '<ul type="square">';
                    echo '<li>'.$cc['comment'].'</li>';
                echo '</ul>';
            endforeach;
        }
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
        <p class="font-weight-bold">This cooperative has been deferred because of the following reason/s:</p>
        <pre><?= $branch_info->temp_evaluation_comment ?></pre>
      </div>
    </div>
  </div>-->
<?php endif;?>
<?php endif; ?>
<?php if($this->session->flashdata('redirect_documents')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
        <?php echo $this->session->flashdata('redirect_documents'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_5_success')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
        <?php echo $this->session->flashdata('document_5_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_5_error')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('document_5_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_6_success')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
        <?php echo $this->session->flashdata('document_6_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_6_error')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('document_6_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_7_success')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
        <?php echo $this->session->flashdata('document_7_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_7_error')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('document_7_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_40_success')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
        <?php echo $this->session->flashdata('document_40_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('document_40_error')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('document_40_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if(!$is_client){ 
  if($admin_info->access_level == 2){?><hr>
<div class="row">
  <div class="col-sm-12 col-md-4">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <h5 class="float-left font-weight-bold">Basic Information</h5>
          </div>
        </div>
      </div>
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
                if($this->charter_model->in_charter_city($branch_info->cCode)){
                $branch_name = $branch_info->city;
              } else {
                $branch_name = $branch_info->city.', '.$branch_info->province;
              }
            } else if ($branch_info->area_of_operation == 'Interregional') {
                if($this->charter_model->in_charter_city($branch_info->cCode)){
                $branch_name = $branch_info->city;
              } else {
                $branch_name = $branch_info->city.', '.$branch_info->province;
              }
            } else if ($branch_info->area_of_operation == 'National') {
              if($this->charter_model->in_charter_city($branch_info->cCode)){
                $branch_name = $branch_info->city;
              } else {
                $branch_name = $branch_info->city.', '.$branch_info->province;
              }
                // $branch_name = $branch_info->city.', '.$in_chartered_cities ? $chartered_cities : $branch_info->province;
            }
          ?>
          <?=$branch_name.' '?><?= $branch_info->branchName?>
        </p>
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
          <?php if($branch_info->area_of_operation=="Interregional"){
          $region_array = array();
          
          foreach ($regions_island_list as $region_island_list){
            array_push($region_array, $region_island_list['regDesc']);
          }
          // echo implode(", ", $region_array);
          $last  = array_slice($region_array, -1);
          $first = join(', ', array_slice($region_array, 0, -1));
          $both  = array_filter(array_merge(array($first), $last), 'strlen');
          echo 'Inter-Regional - '. join(' and ', $both);

            // echo 'Inter-Regional -';
          } else {
            echo $branch_info->area_of_operation;
          }?>
        </p>
      </div>
    </div>
  </div>

<?php }
} ?>

<div class="row mb-4">
  <?php if($this->branches_model->check_if_amended($branch_info->regNo)){?>
    <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">By Laws</h5>
          <p class="card-text">This is the generated Bylaws. </p>
          <a target="_blank" href="
          <?php if ($branch_info->category_of_cooperative === 'Primary'): ?>
                  <?= base_url().'branches/'.$encrypted_id.'/documents/bylaws_primary_branch_amend';?>
          <?php elseif ($branch_info->grouping === 'Union'): ?>
                  <?= base_url().'branches/'.$encrypted_id.'/documents/bylaws_union';?>
          <?php else: ?>
                  <?= base_url().'branches/'.$encrypted_id.'/documents/bylaws_federation';?>
          <?php endif; ?>
          " class="btn btn-primary">View</a>
        </div>
      </div>
    </div>

  <?php } else { ?>
    <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">By Laws</h5>
          <p class="card-text">This is the cooperative Bylaws. </p>
          <a target="_blank" href="
          <?php if ($branch_info->category_of_cooperative === 'Primary'): ?>
                  <?= base_url().'branches/'.$encrypted_id.'/documents/bylaws_primary_branch';?>
          <?php elseif ($branch_info->grouping === 'Union'): ?>
                  <?= base_url().'branches/'.$encrypted_id.'/documents/bylaws_union';?>
          <?php else: ?>
                  <?= base_url().'branches/'.$encrypted_id.'/documents/bylaws_federation';?>
          <?php endif; ?>
          " class="btn btn-primary">View</a>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if($this->branches_model->check_if_amended($branch_info->regNo)){?>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Articles of Cooperation</h5>
        <p class="card-text">This is the cooperative Articles of Cooperation</p>
        <a target="_blank" href="
        <?php if ($branch_info->category_of_cooperative === 'Primary'): ?>
                <?php $url_ =  base_url().'branches/'.$encrypted_id.'/documents/articles_cooperation_primary_branch_amend';?>
        <?php elseif ($branch_info->grouping === 'Union'): ?>
                <?php $url_= base_url().'branches/'.$encrypted_id.'/documents/articles_cooperation_union';?>
        <?php else: ?>
                <?php $url_ =base_url().'branches/'.$encrypted_id.'/documents/articles_cooperation_federation';?>
        <?php endif; ?>
        " class="btn btn-primary" id="btn-article">View</a>
      </div>
    </div>
  </div>
  <?php } else {?>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Articles of Cooperation</h5>
        <p class="card-text">This is the cooperative Articles of Cooperation</p>
        <a target="_blank" href="
        <?php if ($branch_info->category_of_cooperative === 'Primary'): ?>
                <?php $url_ =  base_url().'branches/'.$encrypted_id.'/documents/articles_cooperation_primary_branch';?>
        <?php elseif ($branch_info->grouping === 'Union'): ?>
                <?php $url_= base_url().'branches/'.$encrypted_id.'/documents/articles_cooperation_union';?>
        <?php else: ?>
                <?php $url_ =base_url().'branches/'.$encrypted_id.'/documents/articles_cooperation_federation';?>
        <?php endif; ?>
        " class="btn btn-primary" id="btn-article">View</a>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php if($this->branches_model->check_if_amended($branch_info->regNo)){?>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Treasurer's Affidavit</h5>
        <p class="card-text">This is the cooperative Treasurer's Affidavit.</p>
        <a target="_blank" href="
        <?php if ($branch_info->category_of_cooperative === 'Primary'): ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/affidavit_primary_bs_amend';?>
        <?php elseif ($branch_info->grouping === 'Union'): ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/affidavit_union';?>
        <?php else: ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/affidavit_federation';?>
        <?php endif; ?>
        " class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
<?php } else {?>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Treasurer's Affidavit</h5>
        <p class="card-text">This is the cooperative Treasurer's Affidavit.</p>
        <a target="_blank" href="
        <?php if ($branch_info->category_of_cooperative === 'Primary'): ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/affidavit_primary_bs';?>
        <?php elseif ($branch_info->grouping === 'Union'): ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/affidavit_union';?>
        <?php else: ?>
                <?= base_url().'branches/'.$encrypted_id.'/documents/affidavit_federation';?>
        <?php endif; ?>
        " class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
<?php }?>
<!-- <div class="row mb-2"> -->
<!--  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Economic Survey</h5>
          <p class="card-text">This is the cooperative Economic Survey.</p>
          <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/economic_survey" class="btn btn-primary">View</a>
        </div>
      </div>
  </div>-->
<!--  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Surety Bond of Accountable Officers</h5>
        <p class="card-text">This is the cooperative Surety Bond of Accountable Officers.</p>
            <a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/view_document_one/<?= encrypt_custom($this->encryption->encrypt($document_one->filename))?>" class="btn btn-primary">View</a>
          
      </div>
    </div>
  </div>-->
<!--  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Pre-Registration PRS Certificate</h5>
        <p class="card-text">This is the cooperative Pre-Registration PRS Certificate.</p>
          <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/view_document_two/<?= encrypt_custom($this->encryption->encrypt($document_two->filename))?>" class="btn btn-primary">View</a>
      </div>
    </div>
  </div>-->
<!-- </div> -->
<?php if(!$is_client){ 
  if($admin_info->access_level == 2){?>
    </div>
  <?php } }?>
<?php if($branch_info->type=='Branch') : ?>
<?php if(!$is_client){ 
  if($admin_info->access_level == 2){?>
<div class="row">


<?php }
} ?>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Business Plan</h5>
        <p class="card-text">
          <?php if($document_5) : ?>
<!--            Modify by anjury-->
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_5/<?= encrypt_custom($this->encryption->encrypt($document_5->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/5">
              This is the uploaded Business Plan.
            </a>
          <?php endif ?>
          <?php if(!$document_5) : ?>
            Please upload your Business Plan.
          <?php endif ?>
          <br>
        </p>
        <?php if(($is_client && $branch_info->status==21 && $branch_info->status != 81 && $branch_info->status != 80) || $branch_info->status==17 || (!$is_client)): ?>
          <!-- <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_5" class="btn btn-primary">Upload</a> -->
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">G.A. Resolution</h5>
        <p class="card-text">
          <?php if($document_6) : ?>
            <!--Modify by anjury-->
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_6/<?= encrypt_custom($this->encryption->encrypt($document_6->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/6">
              This is the uploaded G.A. Resolution.
            </a>
          <?php endif ?>
          <?php if(!$document_6) : ?>
            Please upload your G.A. Resolution.
          <?php endif ?>
          <br>
        </p>
        <?php if(($is_client && $branch_info->status==21 && $branch_info->status != 81 && $branch_info->status != 80) || $branch_info->status==17 || (!$is_client)): ?>
          <!-- <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_6" class="btn btn-primary">Upload</a> -->
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Certification</h5>
        <p class="card-text">
          <?php if($document_7) : ?>
            <!--Modify by anjury-->
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_7/<?= encrypt_custom($this->encryption->encrypt($document_7->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/7">
            This is the uploaded Certification.
            </a>
          <?php endif ?>
          <?php if(!$document_7) : ?>
            Please upload your Certification.
          <?php endif ?>
          <br>
        </p>
        <?php if(($is_client && $branch_info->status==21 && $branch_info->status != 81 && $branch_info->status != 80) || $branch_info->status==17 || (!$is_client)): ?>
          <!-- <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_7" class="btn btn-primary">Upload</a> -->
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php if(!$is_client){ 
  if($admin_info->access_level == 2){?>
<br>
<?php }} ?>
<div class="row">
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Letter Request for Authority</h5>
        <p class="card-text">
          <?php if($document_40) : ?>
            <!--Modify by anjury-->
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_7/<?= encrypt_custom($this->encryption->encrypt($document_7->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/40">
            This is the uploaded Letter Request for Authority.
            </a>
          <?php endif ?>
          <?php if(!$document_40) : ?>
            Please upload your Letter Request for Authority.
          <?php endif ?>
          <br>
        </p>
        <?php if(($is_client && $branch_info->status==21 && $branch_info->status != 81 && $branch_info->status != 80) || $branch_info->status==17 || (!$is_client)): ?>
          <!-- <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_40" class="btn btn-primary">Upload</a> -->
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Audited Financial Statement</h5>
          <p class="card-text">This is the cooperative Audited Financial Statement for 3 years.</p>
          <!-- <a target="_blank" href="">View</a> -->

          <?php
          if(isset($cafsis_info)){
            foreach($cafsis_info as $rowcaf){?>
              <a href="<?php echo base_url();?>branches/<?=$branch_info->regNo?>/audited_financial_statement?coverage_year=<?=$rowcaf['cafsis_year']?>" class="btn btn-primary"><?=$rowcaf['cafsis_year']?></a>
          <?php }
          } else {
            echo '<b style="color:red;">No AFS Record</b>';
          } ?>
        </div>
      </div>
  </div>
  <!-- OTHERS -->
  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Other Requirements</h5>
            <p class="card-text">
              <!-- modify by json -->
              <?php if(isset($document_others_unifed)) : ?>
               <!--  <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/view_document_one/<?= encrypt_custom($this->encryption->encrypt($document_one->filename))?>"> -->

                 <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_id_others?>/42">

                  <?php if($is_client) : ?>
                    This is your Others document.
                  <?php else : ?>
                    This is the Others document.
                  <?php endif;?>
                </a>
              <?php endif ?>
              <?php if(!isset($document_others_unifed)) : ?>
                Please upload your others document.
              <?php endif ?>
              <br>
            </p>

          <?php if(($is_client && $branch_info->status==21 && $branch_info->status != 81 && $branch_info->status != 80) || $branch_info->status == 0 || $branch_info->status==17 || (!$is_client)): ?>
                <a href="<?php echo base_url();?>branches/<?=$encrypted_id_others?>/documents/upload_document_others_bns" class="btn btn-primary">Upload</a>
          <?php endif; ?>

        </div>
      </div>
  </div>
  <!-- OTHERS END -->
</div>
  <?php else :?>
<?php if(!$is_client){ 
  if($admin_info->access_level == 2){?>
<div class="row">


<?php }
} ?>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Certification</h5>
        <p class="card-text">
          <?php if($document_7) : ?>
            <!--Modify by anjury-->
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_7/<?= encrypt_custom($this->encryption->encrypt($document_7->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/7">
                This is the uploaded Document 1.
            </a>
          <?php endif ?>
          <?php if(!$document_7) : ?>
            Please upload the Document 1.
          <?php endif ?>
          <br>
        </p>
        <?php if(($is_client && $branch_info->status==21 && $branch_info->status != 81 && $branch_info->status != 80) || $branch_info->status==17 || (!$is_client)): ?>
          <!-- <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_7" class="btn btn-primary">Upload</a> -->
        <?php endif; ?>
      </div>
    </div>
  </div>  
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Certificate of Compliance</h5>
        <p class="card-text">
          <?php if($document_8) : ?>
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_8/<?= encrypt_custom($this->encryption->encrypt($document_8->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/8">
              This is the uploaded Document 2.
            </a>
          <?php endif ?>
          <?php if(!$document_8) : ?>
            Please upload the Document 2.
          <?php endif ?>
          <br>
        </p>
        <?php if(($is_client && $branch_info->status==21 && $branch_info->status != 81 && $branch_info->status != 80) || $branch_info->status==17 || (!$is_client)): ?>
          <!-- <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_8" class="btn btn-primary">Upload</a> -->
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Oath of Undertaking</h5>
        <p class="card-text">
          <?php if($document_9) : ?>
            <!--<a target="_blank" href="<?php echo base_url();?>branches/<?=$encrypted_id?>/documents/<?=$encrypted_branch_id?>/view_document_9/<?= encrypt_custom($this->encryption->encrypt($document_9->filename))?>">-->
            <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_branch_id?>/9">
              This is the uploaded Document 3.
            </a>
          <?php endif ?>
          <?php if(!$document_9) : ?>
            Please upload the Document 3.
          <?php endif ?>
          <br>
        </p>
        <?php if(($is_client && $branch_info->status==21 && $branch_info->status != 81 && $branch_info->status != 80) || $branch_info->status==17 || (!$is_client)): ?>
          <!-- <a href="<?php echo base_url();?>branches/<?=$encrypted_branch_id?>/documents/upload_document_9" class="btn btn-primary">Upload</a> -->
        <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- OTHERS -->
  <div class="col-sm-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Other Requirements</h5>
            <p class="card-text">
              <!-- modify by json -->
              <?php if(isset($document_others_unifed)) : ?>
               <!--  <a target="_blank" href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>/documents/view_document_one/<?= encrypt_custom($this->encryption->encrypt($document_one->filename))?>"> -->

                 <a target="_blank" href="<?php echo base_url();?>documents/list_upload_pdf_branch/<?=$encrypted_id_others?>/42">

                  <?php if($is_client) : ?>
                    This is your Others document.
                  <?php else : ?>
                    This is the Others document.
                  <?php endif;?>
                </a>
              <?php endif ?>
              <?php if(!isset($document_others_unifed)) : ?>
                Please upload your others document.
              <?php endif ?>
              <br>
            </p>

          <?php if(($is_client && $branch_info->status==21 && $branch_info->status != 81 && $branch_info->status != 80) || $branch_info->status == 0 || $branch_info->status==17 || (!$is_client)): ?>
                <a href="<?php echo base_url();?>branches/<?=$encrypted_id_others?>/documents/upload_document_others_bns" class="btn btn-primary">Upload</a>
          <?php endif; ?>

        </div>
      </div>
  </div>
  <!-- OTHERS END --> 
<?php endif; ?>  



<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
      $('#btn-article').on('click',function(){
          alert("If total number of pages in Acknowledgement didn't appear, please refresh the page.");
            window.open('<?=$url_?>');
            return false;
      });
  });
  
</script>