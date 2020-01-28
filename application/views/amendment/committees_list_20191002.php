<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client) : ?>
      Step 6
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
<?php foreach($committeescount as $committeecount) : ?>
    <?php $count = $committeecount['count'];?>
<?php endforeach; ?>
<?php if($count <= 0) : ?>
    <div class="col-sm-12 col-md-12">
        <div class="alert alert-info text-justify" role="alert">
           Note:
           <ul>
               <li>At least one (1) member of GAD committee shall come from the Board</li>
           </ul>
        </div>
    </div>
<?php endif;?>
<div class="row">
  <?php if(($is_client && $coop_info->status<=1) || (!$is_client &&  $coop_info->status==3)): ?>
    <div class="col-sm-12 offset-md-10 col-md-2 mb-2">
      <a class="btn btn-color-blue btn-block" role="button"href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_committees/add" role="button"><i class="fas fa-plus"></i> Add Committee
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
                <th>Full Name</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <?php if(($is_client && $coop_info->status<=1) || (!$is_client &&  $coop_info->status==3)): ?>
                <th>Action</th>
              <?php endif;?>
              </tr>
            </thead>
            <tbody>
            <?php foreach($committees as $committee) : ?>
              <tr>
                <td><?= $committee['name']?></td>
                <td><?= $committee['full_name']?></td>
                <td><?= $committee['gender']?></td>
                <td><?= $committee['birth_date']?></td>
                <?php if(($is_client && $coop_info->status<=1) || (!$is_client &&  $coop_info->status==3)): ?>
                <td>
                  <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/committees/<?= encrypt_custom($this->encryption->encrypt($committee['comid'])) ?>/edit" class="btn btn-warning text-white"><i class="fas fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCommitteeModal" data-comname="<?= $committee['name'] ?>" data-fname="<?=$committee['full_name']?>" data-coopid="<?= $encrypted_id ?>" data-committeeid="<?= encrypt_custom($this->encryption->encrypt($committee['comid']))?>"><i class='fas fa-trash'></i> Delete</button>
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
