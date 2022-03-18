<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives_update/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      <?php if($coop_info->grouping == 'Federation') {
          echo 'Step 9';
        } else if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative=='Union'){
          echo 'Step 7';
        } else {
          echo 'Step 9';
        }?>
      <?php endif; ?>
    </h5>
  </div>
</div>
<?php if($this->session->flashdata('staff_redirect')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('staff_redirect'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('staff_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('staff_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('staff_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('staff_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<div class="row">

  <?php // if($requirements_complete==false) : ?>
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-justify" role="alert">
          Note:
         <ul>
          <li>No BOD members shall hold any position directly involved in day-to-day operation and management operation of the Cooperative</li>
          <?php if($manager_not_exists==false) echo '<li>You need a Manager</li>'; ?>
          <?php if($bookkeeper_not_exists==false) echo '<li>You need a Bookkeeper</li>'; ?>
          <?php if($cashier_tresurer_not_exists==false) echo '<li>You need a Cashier/Treasurer</li>';?>
         </ul>
      </div> 
    </div>
  <?php // endif; ?>
  <?php if(($is_client && $coop_info->status!=40 && $coop_info->status != 39) || (!$is_client && $coop_info->status==40 && $coop_info->status != 39)): ?>
  <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
    <a class="btn btn-color-blue btn-block" role="button" href="<?php echo base_url();?>cooperatives_update/<?= $encrypted_id ?>/staff_update/add" role="button"><i class="fas fa-plus"></i> Add Staff </a>
  </div>
  <?php endif;?>
  <div class="col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="staffTable">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Postal Address</th>
                <th>Position</th>
                <th>Status of Appointment</th>
                <th>Minimum Education Experience/Training</th>
                <th>Monthly Compensation</th>
                <?php if(($is_client && $coop_info->status!=40 && $coop_info->status != 39) || (!$is_client && $coop_info->status==40 && $coop_info->status != 39)): ?>
                  <th>Action</th>
                <?php endif;?>
              </tr>
            </thead>
            <tbody>
              <?php foreach($staff_list as $single_staff) : ?>
                <tr>
                  <td><?= $single_staff['full_name']?></td>
                  <td><?= $single_staff['gender']?></td>
                  <td><?= $single_staff['birth_date']?></td>
                  <td><?= $single_staff['postal_address']?></td>
                  <td><?php echo ($single_staff['position']=="Others") ?  $single_staff['position_others'] : ucfirst($single_staff['position']);?></td>
                  <td><?= $single_staff['status_of_appointment']?></td>
                  <td><?= $single_staff['minimum_education_experience_training']?></td>
                  <td align="right"><?= number_format($single_staff['monthly_compensation'],2)?></td>
                  <?php if(($is_client && $coop_info->status!=40 && $coop_info->status != 39) || (!$is_client && $coop_info->status==40 && $coop_info->status != 39)): ?>
                  <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                      <a href="<?php echo base_url();?>cooperatives_update/<?= $encrypted_id ?>/staff_update/<?= encrypt_custom($this->encryption->encrypt($single_staff['id'])) ?>/edit" class="btn btn-warning text-white"><i class="fas fa-edit"></i> Edit</a>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteStaffModal" data-fname="<?=$single_staff['full_name']?>" data-coopid="<?= $encrypted_id ?>" data-staffid="<?= encrypt_custom($this->encryption->encrypt($single_staff['id']))?>"><i class='fas fa-trash'></i> Delete</button>
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
