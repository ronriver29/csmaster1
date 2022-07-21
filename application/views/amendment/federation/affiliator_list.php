<?php  $status = [1,11]; ?>
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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

<?php
$total_no_of_subscribed_capital ='';
 $total_no_of_paid_up_capital='';
if($capitalization_info!=null)
{
  $total_no_of_subscribed_capital=$capitalization_info->total_no_of_subscribed_capital;
  $total_no_of_paid_up_capital=$capitalization_info->total_no_of_paid_up_capital;
}
?>
<?php if($is_client) : ?>
  <div class="col-sm-12 col-md-12">
    <?php if(!$requirements_complete): ?>
    <div class="alert alert-info text-justify" role="alert">
      <li>The total subscribed shares of all cooperator should be <strong><?= $total_no_of_subscribed_capital?></strong>. (Current Total Subscribed Share: <strong><?= ($total_regular['total_subscribed']) ?></strong>)</li>
      <li>The total paid shares must be: <strong><?= $total_no_of_paid_up_capital ?></strong>. (Current Total Paid Shares: <strong><?= ($total_regular['total_paid']) ?></strong>)</li>
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

        

  <!--</form>-->
  </div>
<?php endif; ?>


</div>

<br>

<?php if($is_client):?>
<div class="card border-top-blue">
  <div class="card-body">
      <?php echo form_open('amendment/'.$encrypted_id.'/amendment_affiliators',array('id'=>'amendmentAddForm','name'=>'amendmentAddForm')); ?>
      <div class="row rd-row">
        <!--  <div class="col-sm-12 col-md-4">
          <div class="form-group">
            <label for="areaOfOperation">Cooperative Name: </label>
            <input type="text" name="coopName" class="form-control"/>
          </div>
        </div> -->
         <div class="col-sm-12 col-md-4">
          <div class="form-group">
            <label for="areaOfOperation">Cooperative Name: </label>
            <input type="text" name="coopName" class="form-control">
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="form-group">
            <label for="areaOfOperation">Registration No: </label>
            <input type="text" name="regNo" class="form-control">
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <p style="padding-top: 2.5rem;font-style: italic;color:red;"><?=$msg?></p>
        </div>
      </div>
      <?php
      if(in_array($coop_info->status, $status)){ ?>
      <div class="row col-sm-6 col-md-1 align-self-center col-reserve-btn">
        <input class="btn btn-color-blue" type="submit" name="btn-filter" value="search" style="float:left;">
      </div>
    <?php } ?>
      <?php echo form_close(); ?>
      <hr>
    <div class="table-responsive">
      <table class="table table-bordered">
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
                
                <button type="button" class="btn btn-info" data-regno="<?=$registeredcoop['regNo']?>" data-fname="<?=$registeredcoop['coopName']?>"  data-common_bond_membership="<?=$registeredcoop['commonBond']?>" data-region="<?=$registeredcoop['region']?>" data-province="<?=$registeredcoop['province']?>" data-city="<?=$registeredcoop['city']?>" data-dateregistered="<?=date("d-m-Y", strtotime($registeredcoop['dateRegistered'])) ?>" data-brgy="<?=$registeredcoop['brgy']?>" data-street="<?=$registeredcoop['Street']?>" data-house_blk_no="<?=$registeredcoop['noStreet']?>" data-type="<?=$registeredcoop['type']?>" data-toggle="modal" data-target="#fullInfoRegisteredModalAmdFedSecondary" > <i class='fas fa-eye'></i> View</button>
                <?php // if(($is_client && $coop_info->status<=1) || $coop_info->status==11):
                 if($is_client):
                ?>
                <button type="button" class="btn btn-success" data-reg_id="<?=encrypt_custom($this->encryption->encrypt($registeredcoop['registered_id']));?>" data-fname="<?=$registeredcoop['coopName'];?>" data-amd_fed_id="<?=$encrypted_id?>" data-type="<?=$registeredcoop['type']?>" data-commonbond="<?=$registeredcoop['commonBond']?>" data-application_id="<?=encrypt_custom($this->encryption->encrypt($registeredcoop['application_id']));?>" data-amendment_id ="<?=encrypt_custom($this->encryption->encrypt($registeredcoop['amendment_id']))?>" data-regno="<?= $registeredcoop['regNo']?>"  data-source="<?=$registeredcoop['source']?>" data-datereg="<?=$registeredcoop['dateRegistered']?>" data-street="<?=$registeredcoop['Street']?>" data-nostreet="<?=$registeredcoop['noStreet']?>" data-addrcode="<?=$registeredcoop['addrCode']?>" data-brgy="<?=$registeredcoop['brgy']?>" data-city="<?=$registeredcoop['city']?>" data-province="<?=$registeredcoop['province']?>" data-region="<?=$registeredcoop['region']?>" data-toggle="modal" data-target="#addAffiliatorModalamdFed"><i class='fas fa-plus'></i> Add</button>
                
                <?php endif;?>
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
<br>  <hr>
<?php endif; //is client?>

<?php /* if(!$is_client):?>
<div class="card border-top-blue">
  <div class="card-body">
      <?php echo form_open('amendment/'.$encrypted_id.'/amendment_affiliators',array('id'=>'amendmentAddForm','name'=>'amendmentAddForm')); ?>
      <div class="row rd-row">
        <!--  <div class="col-sm-12 col-md-4">
          <div class="form-group">
            <label for="areaOfOperation">Cooperative Name: </label>
            <input type="text" name="coopName" class="form-control"/>
          </div>
        </div> -->
         <div class="col-sm-12 col-md-4">
          <div class="form-group">
            <label for="areaOfOperation">Cooperative Name: </label>
            <input type="text" name="coopName" class="form-control">
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="form-group">
            <label for="areaOfOperation">Registration No: </label>
            <input type="text" name="regNo" class="form-control">
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <p style="padding-top: 2.5rem;font-style: italic;color:red;"><?=$msg?></p>
        </div>
      </div>
     
      <div class="row col-sm-6 col-md-1 align-self-center col-reserve-btn">
        <input class="btn btn-color-blue" type="submit" name="btn-filter" value="search" style="float:left;">
      </div>
  </div>
</div>      
<br>
<?php endif; */ //not client?>

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
          <table class="table table-bordered">
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
              if(isset($applied_coop)):
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
                        <button type="button" class="btn btn-info" data-regno="<?=$applied_coops['regNo']?>" data-fname="<?=$applied_coops['coopName']?>" data-dateregistered="<?=date("d-m-Y", strtotime($applied_coops['dateRegistered']))?>" data-common_bond_membership="<?=$applied_coops['commonBond']?>" data-region="<?=$applied_coops['region']?>" data-province="<?=$applied_coops['province']?>" data-city="<?=$applied_coops['city']?>" data-brgy="<?=$applied_coops['brgy']?>" data-street="<?=$applied_coops['Street']?>" data-house_blk_no="<?=$applied_coops['noStreet']?>" data-type="<?=$applied_coops['type']?>" data-toggle="modal" data-target="#fullInfoRegisteredModalAmdFedSecondary" > View</button>

                    <!-- EDIT -->
                    <?php // if(($is_client && $coop_info->status<=1) || $coop_info->status==11): ?>
                        <!--<input class="btn btn-color-blue" type="submit" id="offlineBtn" name="offlineBtn" value="Add">-->
                        

                    <?php   if(($is_client) && in_array($coop_info->status, $status)){ ?>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editAffiliatorModal" data-fname="<?=$applied_coops['coopName']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($applied_coops['id']))?>" data-representative="<?=$applied_coops['representative']?>" data-pos="<?=$applied_coops['position']?>" data-proofofidentity="<?=$applied_coops['proof_of_identity']?>" data-validid="<?=$applied_coops['valid_id']?>" data-placeissuance="<?=$applied_coops['place_of_issuance']?>" data-dateissued="<?=$applied_coops['date_issued']?>" data-subscribed="<?=$applied_coops['number_of_subscribed_shares']?>" data-paidshares="<?=$applied_coops['number_of_paid_up_shares']?>"><i class='fas fa-eye'></i> Edit</button>
                    <!-- END -->

                      <?php // if(($is_client && $coop_info->status<=1) || $coop_info->status==11): ?>
                        <!--<input class="btn btn-color-blue" type="submit" id="offlineBtn" name="offlineBtn" value="Add">-->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperatorModal" data-fname="<?=$applied_coops['coopName']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($applied_coops['id']))?>"><i class='fas fa-minus'></i> Remove</button>
                      <?php // endif;?>
                    <?php } ?>
                    </div>
                  </td>
                 <!--  <input type="hidden" value="<?=$applied_coops['id'];?>" name="registered_id">
                  <input type="hidden" value="<?=$encrypted_id;?>" name="cooperativesID"> -->
                </tr>
              <?php endforeach; ?>
            <?php endif;?>
            </tbody>
          </table>
          <?=$links?>
        </div>
      </div>
    </div>
  </div>
</div>
