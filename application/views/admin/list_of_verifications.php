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
                <th>Reg No.</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($verification_list as $users) : ?>
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
                    <td><?php if($users['regno'] == NULL){
                      echo '';
                    } else {
                      echo $users['regno'];
                    }?></td>
                    <td><?php if($users['regno'] == NULL){
                      echo 'For Verification of Client';
                    } else {
                      echo 'For Verification of Senior';
                    }?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
