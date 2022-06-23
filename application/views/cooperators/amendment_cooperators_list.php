<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back </a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 4
      <?php endif; ?>
    </h5> 
  </div>
</div>
<?php $total_subscribed = 0;?>
<?php $total_paid = 0;?>
<?php foreach ($list_cooperators as $cooperator) : ""?>
    <?php 

        $total_subscribed += $cooperator['number_of_subscribed_shares'];
        $total_paid += $cooperator['number_of_paid_up_shares'];
    ?>
<?php endforeach; 
    echo 'Total Subscribed: '.$total_subscribed.'<br>';
    echo 'Total Paid: '.$total_paid;
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
<?php if(!$requirements_complete): ?> 
    <div class="alert alert-info text-justify" role="alert">
       Note:
       <ul>
        <?php if($list_cooperators_count != $capitalization_info->regular_members) echo '<li>There must be total of '.$capitalization_info->regular_members.' Regular Cooperators.</li>'; ?>
        <?php if(isset($capitalization_info->total_no_of_subscribed_capital) ) : ?>
          <?php if($list_cooperators_associate_count < $capitalization_info->associate_members) echo '<li>There must be total of '.$capitalization_info->associate_members.' Associate Cooperators.</li>'; ?>
        <?php endif; ?>
        <?php if(!$directors_count) echo '<li>The Board of Directors must consist of 5 to 15 members including the chairperson and vice-chairperson.</li>'; ?>
        <?php if(!$directors_count_odd) echo'<li>The total member of board of directors must be odd number. (Current Total: '.$total_directors.')</li>'; ?>
        <?php if(!$chairperson_count) echo '<li>You need a Chairperson</li>'; ?>
        <?php if(!$vice_count) echo '<li>You need a Vice-Chairperson</li>'; ?>
        <?php if(!$treasurer_count) echo '<li>You need a Treasurer</li>'; ?>
        <?php if(!$secretary_count) echo '<li>You need a Secretary</li>'; ?>
        <?php if(!$associate_not_exists && $bylaw_info->kinds_of_members == 1) echo '<li>Please update all Associate members</li>'; ?>
        <?php if(!$minimum_regular_subscription) echo '<li>Please update all regular member whose number of subscribed shares not greater than or equal to <strong>'.$capitalization_info->minimum_subscribed_share_regular.'</strong></li>'; ?>
        <?php if(!$minimum_regular_pay) echo '<li>Please update all regular member whose number of paid shares not greater than or equal to <strong>'.$capitalization_info->minimum_paid_up_share_regular.'</strong></li>';?>
        <!-- Associate -->
        <?php if($bylaw_info->kinds_of_members==2):?>
        <?php if(!$minimum_associate_subscription) echo '<li> Please update all associate member whose number of subscribed shares not greater than or equal to <strong>'.$capitalization_info->minimum_subscribed_share_associate.'</strong></li>'; ?>

        <?php if(!$minimum_associate_pay) echo '<li>Please update all associate member whose number of paid shares not greater than or equal to <strong>'.$capitalization_info->minimum_paid_up_share_associate.'</strong></li>';?>
      <?php endif; //kinds of membership ?>
        <!-- end associate -->
       
        <?php if(isset($capitalization_info->total_no_of_subscribed_capital) ) : ?>
            <?php if($bylaw_info->kinds_of_members ==2) : ?>
                <li>The total subscribed shares of all cooperator should be <strong><?= $capitalization_info->total_no_of_subscribed_capital?></strong>. (Current Total Subscribed Share: <strong><?= ($total_regular['total_subscribed']+$total_associate['total_subscribed']) ?></strong>)</li>
                <li>The total paid shares must be: <strong><?= $capitalization_info->total_no_of_paid_up_capital ?></strong>. (Current Total Paid Shares: <strong><?= ($total_regular['total_paid']+$total_associate['total_paid']) ?></strong>)</li>
           <?php else : ?>
                <li>The total subscribed shares of all cooperator should be <strong><?= $capitalization_info->total_no_of_subscribed_capital?></strong>. (Current Total Subscribed Share: <strong><?= ($total_regular['total_subscribed']) ?></strong>)</li>
                <li>The total paid shares must be: <strong><?= $capitalization_info->total_no_of_paid_up_capital ?></strong>. (Current Total Paid Shares: <strong><?= ($total_regular['total_paid']) ?></strong>)</li>
              <?php endif; ?>

              <?php 
              if($bylaw_info->kinds_of_members==2):
                if(!$minimum_associate_subscription && $list_cooperators_associate_count < $capitalization_info->associate_members) echo '<li>Please update all associate member whose number of paid shares not greater than or equal to <strong>'.$bylaw_info->associate_percentage_shares_subscription.'</strong></li>'; 
              endif;
              ?>
        <!-- <?php if(!$minimum_associate_pay && $list_cooperators_associate_count < $capitalization_info->associate_members) echo '<li>Please update all associate member whose number of paid shares not greater than or equal tossss <strong>'.$bylaw_info->associate_percentage_shares_pay.'</strong></li>'; ?>
       <?php endif; ?> -->
       <?php // if(!$ten_percent) echo '<li>Members should only subscribed <strong>10%</strong> of the total subscribed shares</li>'; ?>
       </ul>
    </div>
<?php else: ?> 

    <?php if($check_if_equal_shares_paid){?>
    <div class="alert alert-success text-justify" role="alert">
       Note:
       <ul>
            <li>If you want to add more members and/or increase subscribed and paid share of member(s), you need to update your capitalization.</li>
       </ul>
    </div>
    <?php }//end of check if equal shares paid?>
 <?php endif; ?> 
  </div>
<?php if(($is_client && $coop_info->status<=1) || (($coop_info->status==11))): ?>
  <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
   <?php if(isset($capitalization_info->total_no_of_subscribed_capital) && ($capitalization_info->total_no_of_subscribed_capital > $total_subscribed) || $capitalization_info->total_no_of_paid_up_capital > $total_paid || $list_cooperators_associate_count < $capitalization_info->associate_members) : ?>
      <?php if($count_matching): ?>  
        <a class="btn btn-color-blue btn-block" role="button"href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_cooperators/add" role="button"><i class="fas fa-plus"></i> Add Cooperator
      </a>
      <?php endif;//count matching?>

    
   <?php endif; ?>
  </div>
<?php endif; ?>
<div class="col-sm-12 col-md-12">
    <h4 class="text-left">
      Regular
    </h4>
  </div>
  <div class="col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Position</th>
                <th>Membership</th>
                <th>Subscribed</th>
                <th>Paid</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($list_cooperators_regular as $cooperator) : ?>
                <tr>
                  <td><?= $cooperator['full_name']?></td>
                  <td><?= $cooperator['gender']?></td>
                  <td><?= date("m/d/Y", strtotime($cooperator['birth_date']))?></td>
                  <td><?= $cooperator['position']?></td>
                  <td><?= $cooperator['type_of_member']?></td>
                  <td><?= $cooperator['number_of_subscribed_shares']?></td>
                  <td><?= $cooperator['number_of_paid_up_shares']?></td>
                  <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-info" data-fname="<?=$cooperator['full_name']?>" data-placeissuance="<?= $cooperator['place_of_issuance']?>" data-dateissued="<?= $cooperator['proof_date_issued']?>" data-valididno="<?= $cooperator['proof_of_identity_number']?>" data-validid="<?= $cooperator['proof_of_identity']?>" data-paid="<?= $cooperator['number_of_paid_up_shares']?>" data-subscribed="<?= $cooperator['number_of_subscribed_shares']?>" data-membertype="<?= $cooperator['type_of_member']?>" data-pos="<?= $cooperator['position']?>" data-paddress="<?= $cooperator['house_blk_no'].' '.$cooperator['streetName'].' '.$cooperator['brgy'].', '.$cooperator['city'].' '.$cooperator['province'].' '.$cooperator['region']?>" data-bdate="<?=$cooperator['birth_date']?>" data-gender="<?=$cooperator['gender']?>" data-toggle="modal" data-target="#fullInfoCooperatorModal" ><i class='fas fa-eye'></i> View</button>
                      <?php if(($is_client && $coop_info->status<=1) || $coop_info->status==11): ?>
                        <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_cooperators/<?= encrypt_custom($this->encryption->encrypt($cooperator['id'])) ?>/edit" class="btn btn-warning text-white"><i class="fas fa-edit"></i> Edit</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCooperatorModal" data-fname="<?=$cooperator['full_name']?>" data-coopid="<?= $encrypted_id ?>" data-cooperatorid="<?= encrypt_custom($this->encryption->encrypt($cooperator['id']))?>"><i class='fas fa-trash'></i> Delete</button>
                      <?php endif;?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <?=$links?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php if($bylaw_info->kinds_of_members == 2){?>
<br>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <h4 class="text-left">
      Associate
    </h4>
  </div>
  <div class="col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperatorsTable2">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Position</th>
                <th>Membership</th>
                <th>Subscribed</th>
                <th>Paid</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($list_cooperators_associate as $cooperator) : ?>
                <tr>
                  <td><?= $cooperator['full_name']?></td>
                  <td><?= $cooperator['gender']?></td>
                  <td><?= date("m/d/Y", strtotime($cooperator['birth_date']))?></td>
                  <td><?= $cooperator['position']?></td>
                  <td><?= $cooperator['type_of_member']?></td>
                  <td><?= $cooperator['number_of_subscribed_shares']?></td>
                  <td><?= $cooperator['number_of_paid_up_shares']?></td>
                  <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-info" data-fname="<?=$cooperator['full_name']?>" data-placeissuance="<?= $cooperator['place_of_issuance']?>" data-dateissued="<?= $cooperator['proof_date_issued']?>" data-valididno="<?= $cooperator['proof_of_identity_number']?>" data-validid="<?= $cooperator['proof_of_identity']?>" data-paid="<?= $cooperator['number_of_paid_up_shares']?>" data-subscribed="<?= $cooperator['number_of_subscribed_shares']?>" data-membertype="<?= $cooperator['type_of_member']?>" data-pos="<?= $cooperator['position']?>" data-paddress="<?= $cooperator['house_blk_no'].' '.$cooperator['streetName'].' '.$cooperator['brgy'].', '.$cooperator['city'].' '.$cooperator['province'].' '.$cooperator['region']?>" data-bdate="<?=$cooperator['birth_date']?>" data-gender="<?=$cooperator['gender']?>" data-toggle="modal" data-target="#fullInfoCooperatorModal" ><i class='fas fa-eye'></i> View</button>
                      <?php if(($is_client && $coop_info->status<=1) || ($coop_info->status==11)): ?>
                        <a href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_cooperators/<?= encrypt_custom($this->encryption->encrypt($cooperator['id'])) ?>/edit" class="btn btn-warning text-white"><i class="fas fa-edit"></i> Edit</a>
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
<?php } ?>
