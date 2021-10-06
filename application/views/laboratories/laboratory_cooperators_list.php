<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>laboratories/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 2
      <?php endif; ?>
    </h5>
  </div>
</div>
<?php $total_subscribed[] = 0;?>
<?php $total_paid[] = 0;?>
<?php foreach ($list_cooperators as $cooperator) : ""?>

       
<?php endforeach; 
//    echo 'Total Subscribed: '.array_sum($total_subscribed).'<br>';
//    echo 'Total Paid: '.array_sum($total_paid);
?>
<?php if($this->session->flashdata('cooperator_redirect')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
       <?php echo $this->session->flashdata('cooperator_redirect'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('member_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('member_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('member_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('member_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<div class="row">
<?php // if(!$requirements_complete): ?>
<?php if(count($list_cooperators) <= 15){?>
<div class="col-sm-12 col-md-12">
    <div class="alert alert-info text-justify" role="alert">
       Note:
       <ul>
           <li>Members/Cooperators must consist 15 members.</li>
       </ul>
    </div>
</div>
<?php } ?>
<!--  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info text-justify" role="alert">
       Note:
       <ul>
        <?php if(!$directors_count) echo '<li>The Board of Directors must consist of 5 to 15 members including the chairperson and vice-chairperson.</li>'; ?>
        <?php if(!$directors_count_odd) echo'<li>The total member of board of directors must be odd number. (Current Total: '.$total_directors.')</li>'; ?>
        <?php if(!$chairperson_count) echo '<li>You need a Chairperson</li>'; ?>
        <?php if(!$vice_count) echo '<li>You need a Vice-Chairperson</li>'; ?>
        <?php if(!$treasurer_count) echo '<li>You need a Treasurer</li>'; ?>
        <?php if(!$secretary_count) echo '<li>You need a Secretary</li>'; ?>
        <?php if(!$associate_not_exists && $bylaw_info->kinds_of_members == 1) echo '<li>Please update all Associate members</li>'; ?>
        <?php if(!$minimum_regular_subscription) echo '<li>Please update all regular member whose number of subscribed shares not greater than or equal to <strong>'.$bylaw_info->regular_percentage_shares_subscription.'</strong></li>'; ?>
        <?php if(!$minimum_regular_pay) echo '<li>Please update all regular member whose number of paid shares not greater than or equal to <strong>'.$bylaw_info->regular_percentage_shares_pay.'</strong></li>';?>
        <?php if(!$minimum_associate_subscription) echo '<li>Please update all associate member whose number of paid shares not greater than or equal to <strong>'.$bylaw_info->associate_percentage_shares_subscription.'</strong></li>'; ?>
        <?php if(!$minimum_associate_pay) echo '<li>Please update all associate member whose number of paid shares not greater than or equal to <strong>'.$bylaw_info->associate_percentage_shares_pay.'</strong></li>'; ?>
        <?php if($bylaw_info->kinds_of_members ==2) : ?>
          <?php if(!$check_with_associate_paid) : ?>
            <li>The total subscribed shares of all cooperator is <strong><?= ($total_regular['total_subscribed'] + $total_associate['total_subscribed'])?></strong>.</li>
            <li>The total paid shares must be greater than or equal to the 25% of the total subscribed shares. (25% of total subscribed shares: <strong><?= ceil(($total_regular['total_subscribed'] + $total_associate['total_subscribed']) * 0.25) ?></strong>)(Current Total Paid Shares: <strong><?= ($total_regular['total_paid']+$total_associate['total_paid']) ?></strong>)</li>
          <?php endif; ?>
       <?php else : ?>
         <?php if(!$check_regular_paid) : ?>
           <li>The total subscribed shares of all cooperator is <strong><?= $total_regular['total_subscribed'] ?></strong>.</li>
           <li>The total paid shares must be greater than or equal to the 25% of the total subscribed shares. (25% of total subscribed shares: <strong><?= ceil($total_regular['total_subscribed']*0.25) ?></strong>)(Current Total Paid Shares: <strong><?= $total_regular['total_paid'] ?></strong>)</li>
          <?php endif; ?>
       <?php endif; ?>
       <?php if(!$ten_percent) echo '<li>Members should only subscribed <strong>10%</strong> of the total subscribed shares</li>'; ?>
        
       </ul>
    </div>
  </div>-->


<?php if($is_client && $coop_info->status!=2 && ($is_client && $coop_info->status!=12) || ($is_client && $coop_info->status==24)): ?>
  <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
    <a class="btn btn-color-blue btn-block" role="button" href="<?php echo base_url();?>laboratories/<?= $encrypted_id ?>/laboratories_cooperators/add" role="button"><i class="fas fa-plus"></i> Add Member/Cooperator
    </a>
  </div>
<?php endif; ?>
  <div class="col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperatorsTable">
            <thead>
              <tr>
                <th>Firstname</th>
                <th>Middlename</th>
                 <th>Lastname</th>
                <th>Address</th>
            
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($list_cooperators as $cooperator) : ?>
                <tr>
                  <td><?= ucfirst($cooperator['full_name'])?></td>
                  <td><?= ucfirst($cooperator['middle_name'])?></td>
                  <td><?= ucfirst($cooperator['last_name'])?></td>
                  <td><?php 
                  if($cooperator['house_blk_no'] != ""){ 
                      echo $cooperator['house_blk_no'].','; 
                  } 
                  if ($cooperator['streetName'] != ""){ 
                      echo ucfirst($cooperator['streetName']).','; 
                  } echo $cooperator['brgy'].','.$cooperator['city'].','.$cooperator['province'].','.$cooperator['region']; ?>
                  <!--<td><?= $cooperator['gender']?></td>
                  <!--<td><?= date("m/d/Y", strtotime($cooperator['birth_date']))?></td>-->
                  <!--<td><?= $cooperator['position']?></td>-->
                 <!--  <td><?= $cooperator['position']?></td> -->
                 <!--  <td><?= $cooperator['type_of_member']?></td> -->
                  <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                     <!--  <button type="button" class="btn btn-info" data-fname="<?=$cooperator['full_name']?>" data-placeissuance="<?= $cooperator['place_of_issuance']?>" data-dateissued="<?= $cooperator['proof_date_issued']?>" data-valididno="<?= $cooperator['proof_of_identity_number']?>" data-validid="<?= $cooperator['proof_of_identity']?>" data-membertype="<?= $cooperator['type_of_member']?>" data-pos="<?= $cooperator['position']?>" data-paddress="<?= $cooperator['addrCode']?>" data-bdate="<?=$cooperator['birth_date']?>" data-gender="<?=$cooperator['gender']?>" data-toggle="modal" data-target="#fullInfoCooperatorModal" ><i class='fas fa-eye'></i> View</button> -->
                      <?php if(($is_client && $coop_info->status!=2) && ($is_client && $coop_info->status!=12) || (!$is_client &&  $coop_info->status==24) && (count($list_cooperators) >= 15)): ?>
                        <a href="<?php echo base_url();?>laboratories/<?= $encrypted_id ?>/laboratories_cooperators/<?= encrypt_custom($this->encryption->encrypt($cooperator['id'])) ?>/edit" class="btn btn-warning text-white"><i class="fas fa-edit"></i> Edit</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperatorModal" data-fname="<?=$cooperator['full_name']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($cooperator['id']))?>"><i class='fas fa-trash'></i> Delete</button>
                      <?php endif;?>
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
