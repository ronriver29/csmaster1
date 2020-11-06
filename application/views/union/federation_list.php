<?php // echo substr($coop_info->refbrgy_brgyCode, 0, 4); ?>
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 4
      <?php endif; ?>
    </h5>
  </div>
</div>
<?php if($this->session->flashdata('cooperator_redirect')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
       <?php echo $this->session->flashdata('cooperator_redirect'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('cooperator_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('cooperator_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('cooperator_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('cooperator_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<div class="row">
<div class="col-sm-12 col-md-12">
    <?php foreach($business_activities as $casd) : ?>
        <?php $business_activity = $casd['bactivity_name']?>
        <?php $business_activity_sub = $casd['bactivitysubtype_name']?>
    <?php endforeach; ?>
  </div>
<?php if($is_client) : ?>
  <div class="col-sm-12 col-md-12">
      
    <?php // echo form_open('cooperatives/'.$encrypted_id.'/affiliators/add_affiliators',array('id'=>'addCooperatorForm','name'=>'addCooperatorForm')); ?>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperatorsTable">
            <thead>
              <tr>
                <th>Coop Name</th>
                <th>Registered Number</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($registered_coop as $registeredcoop) : ?>
                <tr>
                  <td><?= $registeredcoop['coopName']?></td>
                  <td><?= $registeredcoop['regNo']?></td>
                  <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" data-regno="<?=$registeredcoop['regNo']?>" data-fname="<?=$registeredcoop['coopName']?>" data-placeissuance="<?= $registeredcoop['dateRegistered']?>" data-business_activity="<?=$business_activity?>" data-business_activity_sub="<?=$business_activity_sub?>" data-common_bond_membership="<?=$registeredcoop['common_bond_of_membership']?>" data-region="<?=$registeredcoop['region']?>" data-province="<?=$registeredcoop['province']?>" data-city="<?=$registeredcoop['city']?>" data-brgy="<?=$registeredcoop['brgy']?>" data-street="<?=$registeredcoop['street']?>" data-house_blk_no="<?=$registeredcoop['house_blk_no']?>" data-type="<?=$registeredcoop['type']?>" data-toggle="modal" data-target="#fullInfoRegisteredModal" ><i class='fas fa-eye'></i> View</button>
                      <?php // if(($is_client && $coop_info->status<=1) || $coop_info->status==11): ?>
                        <button type="button" class="btn btn-success" data-reg_id="<?=$registeredcoop['registered_id'];?>" data-fname="<?=$registeredcoop['coopName'];?>" data-application_id="<?=$registeredcoop['application_id'];?>" data-regno="<?= $registeredcoop['regNo']?>" data-coopid="<?= $encrypted_id ?>" data-toggle="modal" data-target="#addAffiliatorModal"><i class='fas fa-plus'></i> Add</button>
                        <!--<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperatorModal" data-fname="<?=$cooperator['full_name']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($cooperator['id']))?>"><i class='fas fa-trash'></i> Delete</button>-->
                      <?php // endif;?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <!--</form>-->
  </div>
<?php endif; ?>
</div>
<br>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <h4 class="text-left">
      Added Cooperatives
    </h4>
  </div>
  <div class="col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperatorsTable2">
            <thead>
              <tr>
                <th>Coop Name</th>
                <th>Registered Number</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($applied_coop as $applied_coops) : ?>
                <tr>
                  <td><?= $applied_coops['coopName']?></td>
                  <td><?= $applied_coops['regNo']?></td>
                  <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" data-regno="<?=$applied_coops['regNo']?>" data-fname="<?=$applied_coops['coopName']?>" data-placeissuance="<?= $applied_coops['dateRegistered']?>" data-business_activity="<?=$business_activity?>" data-business_activity_sub="<?=$business_activity_sub?>" data-common_bond_membership="<?=$applied_coops['common_bond_of_membership']?>" data-region="<?=$applied_coops['region']?>" data-province="<?=$applied_coops['province']?>" data-city="<?=$applied_coops['city']?>" data-brgy="<?=$applied_coops['brgy']?>" data-street="<?=$applied_coops['street']?>" data-house_blk_no="<?=$applied_coops['house_blk_no']?>" data-type="<?=$applied_coops['type']?>" data-toggle="modal" data-target="#fullInfoRegisteredModal" ><i class='fas fa-eye'></i> View</button>
                      <?php // if(($is_client && $coop_info->status<=1) || $coop_info->status==11): ?>
                        <!--<input class="btn btn-color-blue" type="submit" id="offlineBtn" name="offlineBtn" value="Add">-->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperatorModal" data-fname="<?=$applied_coops['coopName']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($applied_coops['aff_id']))?>"><i class='fas fa-minus'></i> Remove</button>
                      <?php // endif;?>
                    </div>
                  </td>
                  <input type="hidden" value="<?=$applied_coops['aff_id'];?>" name="registered_id">
                  <input type="hidden" value="<?=$encrypted_id;?>" name="cooperativesID">
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>