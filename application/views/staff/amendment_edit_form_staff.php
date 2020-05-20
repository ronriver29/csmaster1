<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_staff" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Edit Staff</h5>
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
    <?php echo form_open('amendment/'.$encrypted_id.'/amendment_staff/'.$encrypted_staff_id.'/edit',array('id'=>'editStaffForm','name'=>'editStaffForm')); ?>
      <div class="card-body">
        <div class="row as-row">
          <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
          <input type="hidden" class="form-control" id="staffID" name="staffID" value="<?= $encrypted_staff_id?>">
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="position">Position:</label>
              <select class="custom-select validate[required]" name="position" id="position">
            
             
              <?php if($list_position!=NULL){ ?>
                <?php foreach($list_position as $rows){
                  $positionss = $rows['position_name'];
                ?>

                  <option value="<?=$rows['position_name']?>" <?=($rows['position_name']==$staff_info->position ? "selected" :"")?>><?=ucfirst($rows['position_name'])?></option>
                  
                <?php } ?>
                 <option value="Others" <?php if($positionss=="Others") echo "selected";?>>Others</option> 

              <?php } //end if list position ?>
               </select>
            </div>
      		</div>
          <?php if($staff_info->position=="Others") :?>
            <div class="col-sm-12 col-md-4 col-staff-position-specify">
              <div class="form-group">
                <label for="staffPositionSpecify">Specify Others:</label>
                <input type="text" class="form-control validate[required]" name="staffPositionSpecify" id="staffPositionSpecify" value="<?= $staff_info->position_others?>">
              </div>
            </div>
          <?php endif; ?>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-5">
            <div class="form-group">
              <label class="font-weight-bold" for="fName">Full Name:</label>
              <input type="text" class="form-control validate[required,custom[fullname]]" id="fName" name="fName" value="<?= $staff_info->full_name?>">
               <Label class="font-weight-bold" style="font-size:10px;color:red;"><i>* No BOD members shall hold any position directly involved in day-to-day operation and management operation of the Cooperative</i></label>
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="position">Status of Appointment:</label>
              <select class="custom-select validate[required]" name="statusOfAppointment">
                <option value="">--</option>
                <option value="Permanent" <?php if($staff_info->status_of_appointment=="Permanent") echo "selected";?>>Permanent</option>
                <option value="Contractual" <?php if($staff_info->status_of_appointment=="Contractual") echo "selected";?>>Contractual</option>
                <option value="Full-time" <?php if($staff_info->status_of_appointment=="Full-time") echo "selected";?>>Full-time</option>
                <option value="Part-time" <?php if($staff_info->status_of_appointment=="Part-time") echo "selected";?>>Part-time</option>
                <option value="Volunteer" <?php if($staff_info->status_of_appointment=="Volunteer") echo "selected";?>>Volunteer</option>
              </select>
            </div>
      		</div>
          <div class="w-100"></div>
      		<div class="col-sm-12 col-md-7">
            <div class="form-group">
              <label class="font-weight-bold" for="pAddress">Postal Address: </label>
              <textarea class="form-control validate[required]" style="resize: none;" id="pAddress" name="pAddress" rows="1"><?= $staff_info->postal_address?></textarea>
            </div>
      		</div>
          <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label class="font-weight-bold" for="gender">Gender:</label>
              <select class="custom-select validate[required]" name="gender">
                <option value="">--</option>
                <option value="Male" <?php if($staff_info->gender=="Male") echo "selected";?>>Male</option>
                <option value="Female" <?php if($staff_info->gender=="Female") echo "selected";?>>Female</option>
              </select>
            </div>
      		</div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label class="font-weight-bold" for="bDate"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>Age must be 18 years old and above.</li>"></i> Birth Date:</label>
              <input type="date" class="form-control validate[required,funcCall[validateAgeCustom]]" id="bDate" name="bDate" value="<?= $staff_info->birth_date?>">
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label class="font-weight-bold"  for="subscribedShares">Minimum Education Experience/Training</label>
              <input type="textr" class="form-control validate[required]" id="minimumEducation" name="minimumEducation" value="<?= $staff_info->minimum_education_experience_training?>">
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="paidShares">Monthly Compensation</label>
              <input type="text" min="1" class="form-control validate[required,min[1],custom[number]]" id="monthlyCompensation" name="monthlyCompensation" value="<?= number_format($staff_info->monthly_compensation,2)?>">
            </div>
      		</div>
        </div>
      </div>
      <div class="card-footer editStaffFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="editStaffBtn" name="editStaffBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
