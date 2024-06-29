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
<center><h3>Search</h3></center>
<div class="portlet-body">
  <?=form_open();?>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="eAddress">First Name</label>
          <div id='search'><input type="text" class="form-control" id="first_name" name="first_name"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="eAddress">Middle Name</label>
          <div id='search'><input type="text" class="form-control" id="middle_name" name="middle_name"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="eAddress">Last Name</label>
          <div id='search'><input type="text" class="form-control" id="last_name" name="last_name"></div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="eAddress">Registration No.</label>
          <div id='search'><input type="text" class="form-control" id="regno" name="regno"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="eAddress">Email</label>
          <div id='search'><input type="text" class="form-control" id="email" name="email"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="eAddress">Contact Number</label>
          <div id='search'><input type="text" class="form-control" id="contact_number" name="contact_number"></div>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label for="eAddress">Show</label>
          <select class="form-control" id="limit" name="limit" required=""></div>
            <option value="10">10</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </div>
      </div>
    </div>
    <center><button type="submit" name="submit" value="submit" class="btn btn-info" >Submit</button></center>
    <?=form_close();?>
</div>
<br>
<?php if(is_array($verification_list)){?>
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
                <th>Action</th>
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
                    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAdministratorModal" data-fname="<?= $users['first_name'].' '.$users['last_name'].' '.$users['middle_name']?>" data-email="<?=$users['email']?>" data-regno="<?= $users['regno'];?>" data-adid="<?= encrypt_custom($this->encryption->encrypt($users['id']))?>"><i class='fas fa-trash'></i> Delete</button></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>