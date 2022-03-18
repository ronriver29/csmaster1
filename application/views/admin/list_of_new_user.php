<?php if($this->session->flashdata('redirect_admin_applications_message')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-warning text-center" role="alert">
       <?php echo $this->session->flashdata('redirect_admin_applications_message'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('add_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('add_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('add_admin_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('add_admin_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('update_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('update_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('update_admin_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('update_admin_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('delete_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('delete_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('delete_admin_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('delete_admin_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<div class="row">
  <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
    <!-- <a class="btn btn-color-blue btn-block" href="<?php echo base_url();?>admins/add" role="button"><i class="fas fa-plus"></i> Add Administrators</a> -->
  </div>
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="adminsTable">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Valid ID No.</th>
                <th>Registered No.</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users_list as $users) : ?>
                <tr>
                    <td>
                        <?= $users['first_name'].' '.$users['last_name'].' '.$users['middle_name']?>
                    </td>
                    <td>
                        <?= $users['email']?>
                    </td>
                    <td>
                        <?= $users['contact_number']?>
                    </td>
                    <td>
                        <?= $users['valid_id_number']?>
                    </td>
                    <td>
                        <?= $users['regno']?>
                    </td>
                    <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#resetPasswordModal" data-fname="<?= $users['first_name'].' '.$users['last_name'].' '.$users['middle_name']?>" data-adid="<?= encrypt_custom($this->encryption->encrypt($users['id']))?>"><i class="fas fa-edit"></i> Reset Password</button>
                        <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editRegDateStatusModal" data-fname="<?= $users['first_name'].' '.$users['last_name'].' '.$users['middle_name']?>" data-regno="<?= $users['regno']?>" data-adid="<?= encrypt_custom($this->encryption->encrypt($users['application_id']))?>"><i class="fas fa-edit"></i> Edit</button> -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAdministratorModal" data-fname="<?= $users['first_name'].' '.$users['last_name'].' '.$users['middle_name']?>" data-adid="<?= encrypt_custom($this->encryption->encrypt($users['id']))?>"><i class='fas fa-trash'></i> Delete</button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
