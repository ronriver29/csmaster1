<?php // echo substr($coop_info->refbrgy_brgyCode, 0, 4); ?>
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 3
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
<?php foreach($business_activities as $casd) : ?>
    <?php $business_activity = $casd['bactivity_name']?>
    <?php $business_activity_sub = $casd['bactivitysubtype_name']?>
<?php endforeach; ?>
<?php if($is_client) : ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <div class="alert alert-info text-justify" role="alert">
                <?php if(!$requirements_complete || $coop_info->capital_contribution != $cc_count->total_cc): ?>
                  <b>Note:</b>
                   <ul>
                      <?php echo '<li>To add member, you need to save first the "Dues and Contribution" field (value must not be 0).</li>'; ?>
                      <?php if($coop_info->capital_contribution != $cc_count->total_cc && $coop_info->capital_contribution != 0) echo '<li>Dues and Contribution must be equal to '.$coop_info->capital_contribution.'. (Current Dues and Contribution: <b>'.$cc_count->total_cc.'</b>)</li>';?>
                      <?php if(!$directors_count) echo '<li>The Board of Directors must consist of 5 to 15 members including the chairperson and vice-chairperson.</li>'; ?>
                      <?php if(!$directors_count_odd) echo'<li>The total member of board of directors must be odd number. (Current Total: '.$total_directors.')</li>'; ?>
                      <?php if(!$chairperson_count) echo '<li>You need a Chairperson</li>'; ?>
                      <?php if(!$vice_count) echo '<li>You need a Vice-Chairperson</li>'; ?>
                      <?php if(!$treasurer_count) echo '<li>You need a Treasurer</li>'; ?>
                      <?php if(!$secretary_count) echo '<li>You need a Secretary</li>'; ?>
                   </ul>
                <?php else: ?>
                  <div class="alert alert-success text-justify" role="alert">
                     Note:
                     <ul>
                          <li>If you want to add more members, you need to update your Dues and Contribution.</li>
                          <li>To add member, you need to save first the "Dues and Contribution" field (value must not be 0).</li>
                     </ul>
                  </div>
                <?php endif; ?>
                 <b>Reminder:</b>
                 <ul>
                   For every changes on Fees and Contribution, you must click the Save button.
                 </ul>
              </div>
      <?php echo form_open('unioncoop/update_cc',array('id'=>'addAdministratorForm','name'=>'addAdministratorForm')); ?>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-8 col-md-2">
            <div class="form-group form-group-fName">
              Dues and Contribution:
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-fName">
              <input type="hidden" class="form-control" id="cooperativeID" name="cooperativeID" value="<?=$encrypted_id ?>">
              <!-- <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$this->encryption->encrypt(encrypt_custom($coop_info->id))?>"> -->
              <input type="text" class="form-control validate[required]" id="cc" name="cc" value="<?=$coop_info->capital_contribution?>">
              <input type="hidden" class="form-control validate[required]" id="cc2" name="cc2" value="<?=$coop_info->capital_contribution?>">
              <span id="editeddc" style="color:red;font-size: 12px;"><i> * To add member, you need to save first the "Dues and Contribution" field.</i></span>
            </div>
          </div>

          <div class="col-sm-12 col-md-2">
            <input class="btn btn-color-blue btn-block" type="submit" id="addAdministratorBtn" name="addAdministratorBtn" value="Save">
          </div>
        </div>
      </div>
      <!-- <div class="card-footer addAdministratorFooter">
        
      </div> -->
    </form>
    </div>
  </div>
</div>

<?php // if($coop_info->capital_contribution != $cc_count->total_cc){ ?>
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
                <th>Representative</th>
                <th>Position</th>
                <th>Dues and Contribution</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($applied_coop as $applied_coops) : ?>
                <tr>
                  <td><?= $applied_coops['coopName']?></td>
                  <td><?= $applied_coops['regNo']?></td>
                  <td><?= $applied_coops['representative']?></td>
                  <td><?= $applied_coops['position']?></td>
                  <td><?= $applied_coops['cc']?></td>
                  <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" data-regno="<?=$applied_coops['regNo']?>" data-fname="<?=$applied_coops['coopName']?>" data-placeissuance="<?= $applied_coops['dateRegistered']?>" data-business_activity="<?=$business_activity?>" data-business_activity_sub="<?=$business_activity_sub?>" data-common_bond_membership="<?=$applied_coops['common_bond_of_membership']?>" data-region="<?=$applied_coops['region']?>" data-province="<?=$applied_coops['province']?>" data-city="<?=$applied_coops['city']?>" data-brgy="<?=$applied_coops['brgy']?>" data-street="<?=$applied_coops['street']?>" data-house_blk_no="<?=$applied_coops['house_blk_no']?>" data-type="<?=$applied_coops['type']?>" data-toggle="modal" data-target="#fullInfoRegisteredModal" ><i class='fas fa-eye'></i> View</button>

                      <?php if($is_client && $applied_coops['status'] != 15){ ?>
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editAffiliatorModal" data-fname="<?=$applied_coops['coopName']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($applied_coops['aff_id']))?>" data-representative="<?=$applied_coops['representative']?>" data-pos="<?=$applied_coops['position']?>" data-proofofidentity="<?=$applied_coops['proof_of_identity']?>" data-validid="<?=$applied_coops['valid_id']?>" data-placeissuance="<?=$applied_coops['place_of_issuance']?>" data-dateissued="<?=$applied_coops['date_issued']?>" data-capitalcontribution="<?=$applied_coops['cc']?>"><i class='fas fa-eye'></i> Edit</button>
                      
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperatorModal" data-fname="<?=$applied_coops['coopName']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($applied_coops['aff_id']))?>"><i class='fas fa-minus'></i> Remove</button>
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
<br>
<!-- <div class="row">
  <div class="col-sm-12 col-md-12">
    
  </div>
</div> -->
<?php // } ?>
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
    <?php // echo form_open('cooperatives/'.$encrypted_id.'/affiliators/add_affiliators',array('id'=>'addCooperatorForm','name'=>'addCooperatorForm')); ?>
    <?php echo form_open('cooperatives/'.$encrypted_id.'/unioncoop',array('id'=>'cooperativesAddForm','name'=>'cooperativesAddForm')); ?> 
       <div class="row rd-row">
        <div class="col-sm-12 col-md-4">
          <div class="form-group">
            <label for="coopName">Cooperative Name: </label>
            <input type="text" name="coopName" class="form-control"/>
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="form-group">
            <label for="regNo">Registration Number: </label>
            <input type="text" name="regNo" class="form-control"/>
          </div>
        </div>
      </div> 
       <div class="row col-sm-6 col-md-1 align-self-center col-reserve-btn">
            <input class="btn btn-color-blue" type="submit" name="submit" value="submit" style="float:left;">
        </div>
    <?php echo form_close(); ?>
    <hr>
        <div class="table-responsive">
          <table class="table table-bordered">
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
                      <?php if($coop_info->capital_contribution != $cc_count->total_cc && $coop_info->capital_contribution != 0){?>
                          <button type="button" id="add_members" class="btn btn-success" data-reg_id="<?=$registeredcoop['registered_id'];?>" data-fname="<?=$registeredcoop['coopName'];?>" data-application_id="<?=$registeredcoop['application_id'];?>" data-regno="<?= $registeredcoop['regNo']?>" data-coopid="<?= $encrypted_id ?>" data-toggle="modal" data-target="#addAffiliatorModal"><i class='fas fa-plus'></i> Add</button>
                      <?php } ?>
                        <!--<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperatorModal" data-fname="<?=$cooperator['full_name']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($cooperator['id']))?>"><i class='fas fa-trash'></i> Delete</button>-->
                      <?php // endif;?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <p><?php echo $links; ?></p>
      </div>
    </div>
  <!--</form>-->
  </div>
<?php endif; ?>
<?php if(!$is_client) : ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      
      <?php echo form_open('unioncoop/update_cc',array('id'=>'addAdministratorForm','name'=>'addAdministratorForm')); ?>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-8 col-md-2">
            <div class="form-group form-group-fName">
              Dues and Contribution:
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-fName">
              <input type="hidden" class="form-control" id="cooperativeID" name="cooperativeID" value="<?=$encrypted_id ?>">
              <!-- <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$this->encryption->encrypt(encrypt_custom($coop_info->id))?>"> -->
              <input type="text" class="form-control validate[required]" id="cc" name="cc" value="<?=$coop_info->capital_contribution?>">
              <input type="hidden" class="form-control validate[required]" id="cc2" name="cc2" value="<?=$coop_info->capital_contribution?>">
              <span id="editeddc" style="color:red;font-size: 12px;"><i> * To add member, you need to save first the "Dues and Contribution" field.</i></span>
            </div>
          </div>

          <div class="col-sm-12 col-md-2">
            <!-- <input class="btn btn-color-blue btn-block" type="submit" id="addAdministratorBtn" name="addAdministratorBtn" value="Save"> -->
          </div>
        </div>
      </div>
      <!-- <div class="card-footer addAdministratorFooter">
        
      </div> -->
    </form>
    </div>
  </div>
</div>

<?php // if($coop_info->capital_contribution != $cc_count->total_cc){ ?>
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
                <th>Representative</th>
                <th>Position</th>
                <th>Dues and Contribution</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($applied_coop as $applied_coops) : ?>
                <tr>
                  <td><?= $applied_coops['coopName']?></td>
                  <td><?= $applied_coops['regNo']?></td>
                  <td><?= $applied_coops['representative']?></td>
                  <td><?= $applied_coops['position']?></td>
                  <td><?= $applied_coops['cc']?></td>
                  <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" data-regno="<?=$applied_coops['regNo']?>" data-fname="<?=$applied_coops['coopName']?>" data-placeissuance="<?= $applied_coops['dateRegistered']?>" data-business_activity="<?=$business_activity?>" data-business_activity_sub="<?=$business_activity_sub?>" data-common_bond_membership="<?=$applied_coops['common_bond_of_membership']?>" data-region="<?=$applied_coops['region']?>" data-province="<?=$applied_coops['province']?>" data-city="<?=$applied_coops['city']?>" data-brgy="<?=$applied_coops['brgy']?>" data-street="<?=$applied_coops['street']?>" data-house_blk_no="<?=$applied_coops['house_blk_no']?>" data-type="<?=$applied_coops['type']?>" data-toggle="modal" data-target="#fullInfoRegisteredModal" ><i class='fas fa-eye'></i> View</button>

                      <?php if($is_client){ ?>
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editAffiliatorModal" data-fname="<?=$applied_coops['coopName']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($applied_coops['aff_id']))?>" data-representative="<?=$applied_coops['representative']?>" data-pos="<?=$applied_coops['position']?>" data-proofofidentity="<?=$applied_coops['proof_of_identity']?>" data-validid="<?=$applied_coops['valid_id']?>" data-placeissuance="<?=$applied_coops['place_of_issuance']?>" data-dateissued="<?=$applied_coops['date_issued']?>" data-capitalcontribution="<?=$applied_coops['cc']?>"><i class='fas fa-eye'></i> Edit</button>
                      
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperatorModal" data-fname="<?=$applied_coops['coopName']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($applied_coops['aff_id']))?>"><i class='fas fa-minus'></i> Remove</button>
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
<br>
<!-- <div class="row">
  <div class="col-sm-12 col-md-12">
    
  </div>
</div> -->
<?php // } ?>
  
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>

$('#editeddc').hide();
// var test = document.getElementById('cc').value;
$('#cc').on('change',function(){
  var test = document.getElementById('cc2').value;
  var test2 = $(this).val();

  if(test != test2){
    $("#editeddc").show();
    $("#cooperatorsTable").hide();
  } else{
    $('#editeddc').hide();
    $("#cooperatorsTable").show();
  }
  console.log(test3);
  console.log(test2);
});
// console.log(test);

  
</script>