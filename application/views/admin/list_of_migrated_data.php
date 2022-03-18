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
  <form method="post">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="eAddress">Cooperative Name</label>
          <div id='search'><input type="text" class="form-control" id="coopName" name="coopName"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="eAddress">Registration No.</label>
          <div id='search'><input type="text" class="form-control" id="regNo" name="regNo"></div>
        </div>
      </div>
      <div class="col-md-2">
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
  </form>
</div>
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
                <th>Cooperative Name</th>
                <th>Registration No.</th>
                <th>Date Registered</th>
                <th>Status</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($migrated_data as $md) : ?>
                <tr>
                    <td>
                        <?= $md['coopName']?>
                    </td>
                    <td>
                        <?= $md['regNo']?>
                    </td>
                    <td>
                        <?= date('d-m-Y',strtotime($md['dateRegistered']))?>
                    </td>
                    <td>
                        <?= $md['compliant']?>
                    </td>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editRegDateStatusModal" data-fname="<?= $md['coopName']?>" data-regno="<?= $md['regNo']?>" data-adid="<?= encrypt_custom($this->encryption->encrypt($md['id']))?>"><i class="fas fa-edit"></i> Edit</button>
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