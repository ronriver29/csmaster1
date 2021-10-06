<?php if($this->session->flashdata('branches_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
     <?php echo $this->session->flashdata('branches_success'); ?>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('redirect_applications_message')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
       <?php echo $this->session->flashdata('redirect_applications_message'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('list_success_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('list_success_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('list_error_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('list_error_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<div class="col-sm-12 offset-md-8 col-md-4 mb-2">
  <!-- <a class="btn btn-color-blue btn-block" href="<?php echo base_url();?>admins/add" role="button"><i class="fas fa-plus"></i> Add Administrators</a> -->
  <button type="button" class="btn btn-color-blue btn-block" data-toggle="modal" data-target="#addAffiliatorModal"><i class='fas fa-plus'></i> Add</button>
</div>


<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperativesTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Mobile No.</th>
                <th>Reason</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_blocked_no as $row) : ?>
                <tr>
                  <td><?=$row['id']?></td>
                  <td><?=$row['mobile']?></td>
                  <td><?=$row['reason']?></td>
                  <td><button type="button" class="btn btn-warning" data-toggle="modal" data-blockedid="<?=encrypt_custom($this->encryption->encrypt($row['id']))?>" data-mobile="<?=$row['mobile']?>" data-reason="<?=$row['reason']?>" data-target="#editBlockedNoModal" style="color:white;" ><i class='fas fa-eye'></i> Edit</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-blockedid="<?=encrypt_custom($this->encryption->encrypt($row['id']))?>" data-mobile="<?=$row['mobile']?>" data-target="#deleteBlockedNoModal"><i class='fas fa-minus'></i> Remove</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>