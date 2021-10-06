<?php
//    $galleries = array(1,2,5);
//    $ids = join(",",$galleries);   
//    echo $ids;
//    
//    print_r($applied_coop);
//    print_r($testing);
//echo join(",",$testing);
?>
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/committees" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Add Committee</h5>
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
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('cooperatives/'.$encrypted_id.'/committees/add',array('id'=>'addCommitteeForm','name'=>'addCommitteeForm')); ?>
      <input type="hidden" class="form-control validate[required]" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
      <div class="card-body">
        <div class="row ac-row">
          
          
        <?php 
        // $grouping = array();
            if($coop_info->grouping == 'Federation'){
              // array_push($grouping, $cooperators_federation);
                $grouping = $cooperators_federation;
            } if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union'){
                $grouping = $cooperators_union;
            } else {
                $grouping = $cooperators;
            }
            // print_r($grouping);
        ?>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="cooperatorID">Name of Cooperator:</label>
              <select class="custom-select validate[required] cooperator_id" name="cooperatorID" id="cooperatorID">
                <option value="" selected></option>
                <?php
                  if($coop_info->grouping == 'Federation'){
                      ?>
                      <?php foreach ($cooperators_federation as $cooperator) : ?>
                        <?=$cooperator['representative'];?>
                      <option value ="<?php echo encrypt_custom($this->encryption->encrypt($cooperator['id']));?>"><?php echo $cooperator['representative']?></option>
                    <?php endforeach; ?>
                      <?php
                  } else if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union'){
                      ?>
                      <?php foreach ($cooperators_union as $cooperator) : ?>
                        <?=$cooperator['representative'];?>
                      <option value ="<?php echo encrypt_custom($this->encryption->encrypt($cooperator['id']));?>"><?php echo $cooperator['representative']?></option>
                    <?php endforeach; ?>
                      <?php
                  } else {
                ?>
                <?php foreach ($grouping as $cooperator) : ?>
                  <option value ="<?php echo encrypt_custom($this->encryption->encrypt($cooperator['id']));?>"><?php echo $cooperator['full_name']?></option>
                <?php endforeach; ?>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="committeeName">Name of Committee:</label>
              <select class="custom-select validate[required]" name="committeeName" id="committeeName" >
                <option value="" selected>--</option>
                <option id="A" value="Audit">Audit</option>
                <option id="A" value="Election">Election</option>
                <option id="C" value="Education and Training">Education and Training</option>
                <option id="A" value="Mediation and Conciliation">Mediation and Conciliation</option>
                <option id="A" value="Ethics">Ethics</option>
                <?php if ($coop_info->type_of_cooperative == 'Credit' || $coop_info->type_of_cooperative == 'Agriculture'){?>
                  <option id="A" value="Credit">Credit</option>
                <?php } ?>
                <option id="B" value="Gender and Development">Gender and Development</option>
				<!-- <option disabled id="A" value="Audit">Audit</option>
                <option disabled id="A" value="Election">Election</option>
                <option disabled id="C" value="Education and Training">Education and Training</option>
                <option disabled id="A" value="Mediation and Conciliation">Mediation and Conciliation</option>
                <option disabled id="A" value="Ethics">Ethics</option>
                <option disabled id="A" value="Credit">Credit</option>
                <option disabled id="B" value="Gender and Development">Gender and Development</option> -->
                <?php foreach ($custom_committees as $custom_committee) : ?>
                  <option id="A" value="<?= $custom_committee['name'] ?> "> <?= $custom_committee['name'] ?> </option>
                <?php endforeach; ?>
                <option id="A" value="Others">Others</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row ac-info-row">
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="position">Position:</label>
              <input type="text" class="form-control validate[required]" id="position" name="position" disabled>
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="membershipType">Type of Membership:</label>
              <input type="text" class="form-control validate[required]" id="membershipType" name="membershipType" disabled>
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="gender">Gender:</label>
                <input type="text" class="form-control validate[required]" id="gender" name="gender" disabled>
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="bDate"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>Age must be 18 years old and above.</li>"></i> Birth Date:</label>
              <input type="date" class="form-control validate[required,funcCall[validateAgeCustom]]" id="bDate" name="bDate" disabled>
            </div>
          </div>
      		<div class="col-sm-12 col-md-8">
            <div class="form-group">
              <label for="pAddress">Postal Address: </label>
              <textarea class="form-control validate[required]" style="resize: none;" id="pAddress" name="pAddress" rows="1" disabled></textarea>
            </div>
      		</div>
        </div>
      </div>
      <div class="card-footer addCommitteeFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="addCommitteeBtn" name="addCommitteeBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
