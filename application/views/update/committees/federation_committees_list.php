<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives_update/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client) : ?>
      Step 7
      <?php endif;?>
    </h5>
  </div>
</div>
<?php if($this->session->flashdata('committee_redirect')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
       <?php echo $this->session->flashdata('committee_redirect'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('committee_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('committee_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('committee_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('committee_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php

// if($coop_info->type_of_cooperative == 'Credit' || $coop_info->type_of_cooperative == 'Agriculture'){ 
if($coop_info->type_of_cooperative == 'Credit' || $coop_info->type_of_cooperative == 'Agriculture'){ 
    $credit = $credit_count == 0;
} else {
    $credit = '';
}

if($gad_count == 0 || $audit_count == 0 || $election_count == 0 || $medcon_count == 0 || $ethics_count == 0 || $credit): ?>

       <div class="col-sm-12 col-md-12">
        <div class="alert alert-info text-justify" role="alert">
           Note:
           <ul>
              <?php if($gad_count == 0) echo '<li>There must be 1 Gender and Development member on the list</li>';?>
              <?php if($audit_count == 0) echo '<li>There must be 1 Audit member on the list</li>';?>
              <?php if($election_count == 0) echo '<li>There must be 1 Election member on the list</li>';?>
              <?php if($medcon_count == 0) echo '<li>There must be 1 Mediation and Conciliation member on the list</li>';?>
              <?php if($ethics_count == 0) echo '<li>There must be 1 Ethics member on the list</li>';?>
              <?php if($coop_info->type_of_cooperative == 'Credit' || $coop_info->type_of_cooperative == 'Agriculture'){
                  if($credit_count == 0) echo '<li>There must be 1 Credit member on the list</li>';
              }?>
           </ul>
        </div>
       </div>
<?php endif;?>
<div class="row">
  <?php if(($is_client && $coop_info->status!=40) || (!$is_client && $coop_info->status==40)): ?>
    <div class="col-sm-12 offset-md-10 col-md-2 mb-2">
      <a class="btn btn-color-blue btn-block" role="button"href="<?php echo base_url();?>cooperatives_update/<?= $encrypted_id ?>/committees_update/add_fed" role="button"><i class="fas fa-plus"></i> Add Committee
      </a>
    </div>
  <?php endif; ?>
  <div class="col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="committeesTable">
            <thead>
              <tr>
                <th>Committee</th>
                <!-- <th>Full Name</th> -->
                <!-- <th>Gender</th> -->
                <!-- <th>Birth Date</th> -->
                <?php if(($is_client && $coop_info->status!=40) || (!$is_client && $coop_info->status==40)): ?>
                <th>Action</th>
              <?php endif;?>
              </tr>
            </thead>
            <tbody>
            <?php 
                // if($coop_info->grouping == 'Federation'){
                //     $grouping = $committees_federation;
                // } else {
                //     $grouping = $committees;
                // }
            ?>
            <?php foreach($committees_federation as $committee) : ?>
              <tr>
                <td><?= $committee['name']?></td>
                <!-- <td><?= $committee['representative']?></td> -->
                <!-- <td><?= $committee['gender']?></td> -->
                <!-- <td><?= $committee['birth_date']?></td> -->
                <?php if(($is_client && $coop_info->status!=40) || (!$is_client && $coop_info->status==40)): ?>
                <td>
                  <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <!-- <a href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/committees/<?= encrypt_custom($this->encryption->encrypt($committee['id'])) ?>/edit" class="btn btn-warning text-white"><i class="fas fa-edit"></i> Edit</a> -->
                    
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCommitteeModal" data-comname="<?= $committee['name'] ?>" data-fname="<?=$committee['name']?>" data-coopid="<?= $encrypted_id ?>" data-committeeid="<?= encrypt_custom($this->encryption->encrypt($committee['id']))?>"><i class='fas fa-trash'></i> Delete</button>
                    
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
</div>
