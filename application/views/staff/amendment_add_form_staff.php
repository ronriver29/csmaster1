<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_staff" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Add Staff</h5>
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
    <?php echo form_open('amendment/'.$encrypted_id.'/amendment_staff/add',array('id'=>'addStaffForm','name'=>'addStaffForm')); ?>
      <div class="card-body">
        <div class="row as-row">
          <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="position">Position:</label>
              <select class="custom-select validate[required]" name="position" id="position">
                <option value="" selected>--</option>
                <?php if($list_postion!=NULL){?>
                  <?php foreach($list_postion as $row) 
                  {
                    ?>
                       <option value="<?=$row['position_name']?>"><?= ucfirst($row['position_name'])?></option>
                    <?php
                  }
                  ?>
                <?php } ?>
                 <option value="Others">Others</option>
                <!-- <option value="manager">Manager</option>
                <option value="accountant">Accountant</option>
                <option value="cashier/treasurer">Cashier/Treasurer</option>
                <option value="bookkeeper">Bookkeeper</option> -->
                <!-- <option value="Cashier">Cashier</option> -->
               <!--  <option value="collector">Collector</option>
                <option value="sales clerk">Sales clerk</option>
                <option value="Others">Others</option> -->
              </select>
            </div>
      		</div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-5">
            <div class="form-group">
              <label class="font-weight-bold" for="fName">Full Name:</label>
              <input type="text" class="form-control validate[required,custom[fullname]]" id="fName" name="fName">
              <Label class="font-weight-bold" style="font-size:10px;color:red;"><i>* No BOD members shall hold any position directly involved in day-to-day operation and management operation of the Cooperative</i></label>
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="statusOfAppointment">Status of Appointment:</label>
              <select class="custom-select validate[required]" name="statusOfAppointment" id="statusOfAppointment">
                <option value="" selected>--</option>
                <option value="Permanent">Permanent</option>
                <option value="Contractual">Contractual</option>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Volunteer">Volunteer</option>
              </select>
            </div>
      		</div>
          <div class="w-100"></div>
      		<div class="col-sm-12 col-md-7">
            <div class="form-group">
              <label class="font-weight-bold" for="pAddress">Postal Address: </label>
              <textarea class="form-control validate[required]" style="resize: none;" id="pAddress" name="pAddress" rows="1"></textarea>
            </div>
      		</div>
          <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label class="font-weight-bold" for="gender">Gender:</label>
              <select class="custom-select validate[required]" name="gender" id="gender">
                <option value="" selected>--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
      		</div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label class="font-weight-bold" for="bDate"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>Age must be 18 years old and above.</li>"></i> Birth Date:</label>
              <input type="date" class="form-control validate[required,funcCall[validateAgeCustom]]" id="bDate" name="bDate">
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label class="font-weight-bold"  for="minimumEducation">Minimum Education Experience/Training</label>
              <input type="textr" class="form-control validate[required]" id="minimumEducation" name="minimumEducation">
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label class="font-weight-bold" for="monthlyCompensation">Monthly Compensation</label>
              <input type="text" min="1" class="form-control validate[required,min[1],custom[number]]" id="monthlyCompensation" name="monthlyCompensation">
            </div>
      		</div>
        </div>
      </div>
      <div class="card-footer addStaffFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="addStaffBtn" name="addStaffBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
