<?php // echo substr($coop_info->refbrgy_brgyCode, 0, 4); ?>
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives_update/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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
  <div class="col-sm-12 col-md-12">
    <?php if(!$requirements_complete): ?>
    <div class="alert alert-info text-justify" role="alert">
      <li>The total subscribed shares of all cooperator should be <strong><?php if(isset($capitalization_info->total_no_of_subscribed_capital)) { echo $capitalization_info->total_no_of_subscribed_capital; }?></strong>. (Current Total Subscribed Share: <strong><?= ($total_regular['total_subscribed']) ?></strong>)</li>
      <li>The total paid shares must be: <strong><?php if(isset($capitalization_info->total_no_of_paid_up_capital)) { echo $capitalization_info->total_no_of_paid_up_capital; } ?></strong>. (Current Total Paid Shares: <strong><?= ($total_regular['total_paid']) ?></strong>)</li>
      <?php if(!$directors_count) echo '<li>The Board of Directors must consist of 5 to 15 members including the chairperson and vice-chairperson.</li>'; ?>
      <?php if(!$directors_count_odd) echo'<li>The total member of board of directors must be odd number. (Current Total: '.$total_directors.')</li>'; ?>
      <?php if(!$chairperson_count) echo '<li>You need a Chairperson</li>'; ?>
      <?php if(!$vice_count) echo '<li>You need a Vice-Chairperson</li>'; ?>
      <?php if(!$treasurer_count) echo '<li>You need a Treasurer</li>'; ?>
      <?php if(!$secretary_count) echo '<li>You need a Secretary</li>'; ?>
    </div>
    <?php else: ?>
      <div class="alert alert-success text-justify" role="alert">
         Note:
         <ul>
              <li>If you want to add more members and/or increase subscribed and paid share of member(s), you need to update your capitalization.</li>
         </ul>
      </div>
    <?php endif; ?>
    <?php // echo form_open('cooperatives/'.$encrypted_id.'/affiliators/add_affiliators',array('id'=>'addCooperatorForm','name'=>'addCooperatorForm')); ?>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperatorsTable">
            <thead>
              <tr>
                <th>Coop Name </th>
                <th>Registered Number</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              if(isset($registered_coop)){
                foreach ($registered_coop as $registeredcoop) : ?>
                  <tr>
                    <td><?= $registeredcoop['coopName']?></td>
                    <td><?= $registeredcoop['regNo']?></td>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                          <!-- <button type="button" class="btn btn-info" data-regno="<?=$registeredcoop['regNo']?>" data-fname="<?=$registeredcoop['coopName']?>" data-placeissuance="<?= $registeredcoop['dateRegistered']?>" data-business_activity="<?=$business_activity?>" data-business_activity_sub="<?=$business_activity_sub?>" data-common_bond_membership="<?=$registeredcoop['common_bond_of_membership']?>" data-region="<?=$registeredcoop['region']?>" data-province="<?=$registeredcoop['province']?>" data-city="<?=$registeredcoop['city']?>" data-brgy="<?=$registeredcoop['brgy']?>" data-street="<?=$registeredcoop['street']?>" data-house_blk_no="<?=$registeredcoop['house_blk_no']?>" data-type="<?=$registeredcoop['type']?>" data-toggle="modal" data-target="#fullInfoRegisteredModal" ><i class='fas fa-eye'></i> View</button> -->
                          <button type="button" class="btn btn-info" data-regno="<?=$registeredcoop['regNo']?>" data-fname="<?=$registeredcoop['coopName']?>" data-placeissuance="<?= $registeredcoop['dateRegistered']?>" data-common_bond_membership="<?=$registeredcoop['common_bond_of_membership']?>" data-region="<?=$registeredcoop['region']?>" data-province="<?=$registeredcoop['province']?>" data-city="<?=$registeredcoop['city']?>" data-brgy="<?=$registeredcoop['brgy']?>" data-street="<?=$registeredcoop['street']?>" data-house_blk_no="<?=$registeredcoop['house_blk_no']?>" data-type="<?=$registeredcoop['type']?>" data-toggle="modal" data-target="#fullInfoRegisteredModal" ><i class='fas fa-eye'></i> View</button>
                        <?php // if(($is_client && $coop_info->status<=1) || $coop_info->status==11):
                          // if($applied_coop_count!=$capitalization_info->regular_members):
                        ?>
                          <button type="button" class="btn btn-success" data-reg_id="<?=$registeredcoop['registered_id'];?>" data-fname="<?=$registeredcoop['coopName'];?>" data-application_id="<?=$registeredcoop['application_id'];?>" data-regno="<?= $registeredcoop['regNo']?>" data-coopid="<?= $encrypted_id ?>" data-toggle="modal" data-target="#addAffiliatorModal"><i class='fas fa-plus'></i> Add</button>
                          <!--<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperatorModal" data-fname="<?=$cooperator['full_name']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($cooperator['id']))?>"><i class='fas fa-trash'></i> Delete</button>-->
                        <?php //endif;?>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; 
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <!--</form>-->
  </div>
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
                <th>Position</th>
                <th>Subscribed</th>
                <th>Paid</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php
              // echo '<pre>'.var_dump($applied_coop).'</pre>';
               foreach ($applied_coop as $applied_coops) : ?>
                <tr>
                  <td><?= $applied_coops['coopName']?></td>
                  <td><?= $applied_coops['regNo']?></td>
                  <td><?= $applied_coops['position']?></td>
                  <td><?= $applied_coops['number_of_subscribed_shares']?></td>
                  <td><?= $applied_coops['number_of_paid_up_shares']?></td>
                  <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <!-- <button type="button" class="btn btn-info" data-regno="<?=$applied_coops['regNo']?>" data-fname="<?=$applied_coops['coopName']?>" data-placeissuance="<?= $applied_coops['dateRegistered']?>" data-business_activity="<?=$business_activity?>" data-business_activity_sub="<?=$business_activity_sub?>" data-common_bond_membership="<?=$applied_coops['common_bond_of_membership']?>" data-region="<?=$applied_coops['region']?>" data-province="<?=$applied_coops['province']?>" data-city="<?=$applied_coops['city']?>" data-brgy="<?=$applied_coops['brgy']?>" data-street="<?=$applied_coops['street']?>" data-house_blk_no="<?=$applied_coops['house_blk_no']?>" data-type="<?=$applied_coops['type']?>" data-toggle="modal" data-target="#fullInfoRegisteredModal" > View</button> -->
                        <button type="button" class="btn btn-info" data-regno="<?=$applied_coops['regNo']?>" data-fname="<?=$applied_coops['coopName']?>" data-placeissuance="<?= $applied_coops['dateRegistered']?>" data-common_bond_membership="<?=$applied_coops['common_bond_of_membership']?>" data-region="<?=$applied_coops['region']?>" data-province="<?=$applied_coops['province']?>" data-city="<?=$applied_coops['city']?>" data-brgy="<?=$applied_coops['brgy']?>" data-street="<?=$applied_coops['street']?>" data-house_blk_no="<?=$applied_coops['house_blk_no']?>" data-type="<?=$applied_coops['type']?>" data-toggle="modal" data-target="#fullInfoRegisteredModal" > View</button>

                    <!-- EDIT -->
                    <?php // if(($is_client && $coop_info->status<=1) || $coop_info->status==11): ?>
                        <!--<input class="btn btn-color-blue" type="submit" id="offlineBtn" name="offlineBtn" value="Add">-->
                        

                    <?php if(($is_client && $coop_info->status != 39) || (!$is_client && $coop_info->status == 40 && $coop_info->status != 39)){ ?>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editAffiliatorModal" data-fname="<?=$applied_coops['coopName']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($applied_coops['aff_id']))?>" data-representative="<?=$applied_coops['representative']?>" data-pos="<?=$applied_coops['position']?>" data-proofofidentity="<?=$applied_coops['proof_of_identity']?>" data-validid="<?=$applied_coops['valid_id']?>" data-placeissuance="<?=$applied_coops['place_of_issuance']?>" data-dateissued="<?=$applied_coops['date_issued']?>" data-subscribed="<?=$applied_coops['number_of_subscribed_shares']?>" data-paidshares="<?=$applied_coops['number_of_paid_up_shares']?>"><i class='fas fa-eye'></i> Edit</button>
                    <!-- END -->

                      <?php // if(($is_client && $coop_info->status<=1) || $coop_info->status==11): ?>
                        <!--<input class="btn btn-color-blue" type="submit" id="offlineBtn" name="offlineBtn" value="Add">-->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperatorModal" data-fname="<?=$applied_coops['coopName']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($applied_coops['aff_id']))?>"><i class='fas fa-minus'></i> Remove</button>
                      <?php // endif;?>
                    <?php } ?>
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