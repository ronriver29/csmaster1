<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/committees" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Edit Committee</h5>
  </div>
</div>
<?php if(validation_errors()) : ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger" role="alert">
      <ul>
        <?php echo validation_errors('<li>','</li>'); ?>
      </ul>
    </div>
  </div>
</div>
<?php endif;  ?>
<?php
if($cooperator_info->position=="Board of Director" || $cooperator_info->position=="Treasurer"){
    $audit = 'disabled';
    $election = 'disabled';
    $eat = 'disabled';
    $mac = 'disabled';
    $ethics = 'disabled';
    $credits = 'disabled';
    $gad = 'enabled';
    $others = 'disabled';
} else if($cooperator_info->position=="Vice-Chairperson"){
    $audit = 'disabled';
    $election = 'disabled';
    $eat = 'enabled';
    $mac = 'disabled';
    $ethics = 'disabled';
    $credits = 'disabled';
    $gad = 'enabled';
    $others = 'disabled';
} else {
    $audit = 'enabled';
    $election = 'enabled';
    $eat = 'enabled';
    $mac = 'enabled';
    $ethics = 'enabled';
    $credits = 'enabled';
    $gad = 'enabled';
    $others = 'enabled';
}
?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('cooperatives/'.$encrypted_id.'/committees/'.$encrypted_committee_id.'/edit',array('id'=>'editCommitteeForm','name'=>'editCommitteeForm')); ?>
      <div class="card-body">
        <div class="row ac-row">
          <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
          <input type="hidden" class="form-control" id="committeeID" name="committeeID" value="<?=$encrypted_committee_id?>">
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="committeeName">Name of Committee:</label>
              <select class="custom-select validate[required]" name="committeeName" id="committeeName">
                <option value="" <?php if($committee_info->name=="") echo "selected";?> disabled>--</option>
                <option value="Audit" <?php if($committee_info->name=="Audit") echo "selected";?> <?=$audit?>>Audit</option>
                <option value="Election" <?php if($committee_info->name=="Election") echo "selected";?> <?=$election?>>Election</option>
                <option value="Education and Training" <?php if($committee_info->name=="Education and Training") echo "selected";?> <?=$eat?>>Education and Training</option>
                <option value="Mediation and Conciliation" <?php if($committee_info->name=="Mediation and Conciliation") echo "selected";?> <?=$mac?>>Mediation and Conciliation</option>
                <option value="Ethics" <?php if($committee_info->name=="Ethics") echo "selected";?> <?=$ethics?>>Ethics</option>
                <?php if ($coop_info->type_of_cooperative == 'Credit' || $coop_info->type_of_cooperative == 'Agriculture'){?>
                  <option id="A" value="Credit" <?=$credits?>>Credit</option>
                <?php } ?>
                <option value="Gender and Development" <?php if($committee_info->name=="Gender and Development") echo "selected";?> <?=$gad?>>Gender and Development</option>
                <?php foreach ($custom_committees as $custom_committee) : ?>
                  <option value="<?= $custom_committee['name'] ?> " <?php if($committee_info->name==$custom_committee['name']) echo "selected";?>> <?= $custom_committee['name'] ?> </option>
                <?php endforeach; ?>
                <option value="Others" <?=$others?>>Others</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label for="cooperatorID">Name of Cooperator:</label>
              <input type="text" value="<?= $cooperator_info->full_name?>" class="form-control validate[required]" id="cooperatorName" name="cooperatorName" disabled>
            </div>
          </div>
        </div>
        <div class="row ac-info-row">
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="position">Position:</label>
              <input type="text" value="<?= $cooperator_info->position?>" class="form-control validate[required]" id="position" name="position" disabled>
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="membershipType">Type of Membership:</label>
              <input type="text" value="<?= $cooperator_info->type_of_member?>" class="form-control validate[required]" id="membershipType" name="membershipType" disabled>
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="gender">Gender:</label>
                <input type="text" value="<?= $cooperator_info->gender?>" class="form-control validate[required]" id="gender" name="gender" disabled>
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="bDate"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>Age must be 18 years old and above.</li>"></i> Birth Date:</label>
              <input type="date" value="<?= $cooperator_info->birth_date?>"class="form-control validate[required,funcCall[validateAgeCustom]]" id="bDate" name="bDate" disabled>
            </div>
          </div>
      		<div class="col-sm-12 col-md-8">
            <div class="form-group">
              <label for="pAddress">Postal Address: </label>
              <textarea class="form-control validate[required]" style="resize: none;" id="pAddress" name="pAddress" rows="1" disabled><?= $cooperator_info->full_address?></textarea>
            </div>
      		</div>
        </div>
      </div>
      <div class="card-footer editCommitteeFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="editCommitteeBtn" name="editCommitteeBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
