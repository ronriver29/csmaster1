<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.css')?>" type="text/css"/>
<link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css')?>" type="text/css"/>
<div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>cooperatives" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
  </div>
</div>
<div class="row">
  <div class="col">
    <div class="alert alert-info shadow-sm mt-2" role="alert">
      <h5>Please fill up all the information to proceed into the next step.</h5>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('cooperatives/reservation',array('id'=>'reserveAddForm','name'=>'reserveAddForm')); ?>
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 col-md-8">
            <h4>Cooperative Reservation Form</h4>
          </div>
          <div class="col-sm-12 offset-md-2 col-md-2">
            <h5 class="text-primary text-right">Step 1</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
        <?php if(validation_errors()) : ?>
          <div class="col-sm-12 col-md-12">
            <div class="alert alert-danger" role="alert">
              <ul>
                <?php echo validation_errors('<li>','</li>'); ?>
              </ul>
            </div>
          </div>
        <?php endif;  ?>
          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Application Information:</strong>
                  </div>
              </div>
              <div class="col-sm-12 col-md-3">
                <div class="form-group">
                  <label for="categoryOfCooperative">Category of Cooperative:</label>
                  <select class="custom-select validate[required]" name="categoryOfCooperative" id="categoryOfCooperative">
                    <option value="">--</option>
                    <option value="Primary">Primary</option>
                     <!-- <option value="Tertiary - Union">Tertiary - Union</option>  -->
                    <option value="Secondary - Federation">Secondary</option>
                    <option value="Tertiary - Federation">Tertiary</option>  
                    <option value="Secondary - Union">Others</option> 
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="typeOfCooperative">Type of Cooperative</label>
                  <select class="custom-select validate[required]" name="typeOfCooperative" id="typeOfCooperative">
                    <option value="">--</option>
                    <option value="7">Advocacy</option>
                    <option value="8">Agrarian Reform</option>
                    <option value="24">Agriculture</option>
                    <!-- <option value="9">Bank</option> -->
                    <option value="4">Consumers</option>
                    <!-- <option value="27" id="coopbank">Cooperative Bank</option> -->
                    <option value="1">Credit</option>
                    <option value="10">Dairy</option>
                    <option value="11">Education</option>
                    <option value="12">Electric</option>
                    <!-- <option value="25">Federation</option> -->
                    <option value="13">Financial Service</option>
                    <option value="14">Fishermen</option>
                    <option value="15">Health Service</option>
                    <option value="20">Housing</option>
                    <!-- <option value="16">Insurance</option> -->
                    <option value="21">Labor Service</option>
                    <option value="5">Marketing</option>
                    <option value="2">Producers</option>
                    <option value="22">Professionals</option>
                    <option value="3">Service</option>
                    <option value="23">Small Scale Mining</option>
                    <option value="17">Transport</option>
                    <option value="26">Union</option>
                    <option value="18">Water Service</option>
                    <option value="19">Workers</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12 col-industry-subclass">
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                      <label for="majorIndustry1" id="majorlabel">Major Industry Classification No. 1</label>
                      <select class="custom-select form-control  validate[required]" name="majorIndustry[]" id="majorIndustry1">
                      
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                      <label for="subClass1" id="subclasslabel">Major Industry Classification No. 1 Subclass</label>
                      <select class="custom-select form-control validate[required]" name="subClass[]" id="subClass1" disabled>
                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 offset-md-9 col-md-3">
                <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreSubclassBtn" disabled><i class="fas fa-plus"></i> Add More Subclass</button>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="proposedName"><i class="fas fa-info-user"  data-toggle="tooltip" data-placement="top"
                  data-html="true" title="<li>Don't include the type of your cooperative in your proposed name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Proposed Name:</label>
                  <input type="text" class="form-control validate[required,funcCall[validateActivityNotNullAddCustom],funcCall[validateActivityInNameAddCustom],funcCall[validateCooperativeWordInNameCustom],ajax[ajaxCoopNameCallPhp]]" name="proposedName" id="proposedName" placeholder="" disabled>
                  <div style="margin-bottom:20px;"> <small><span id="type_of_coop" style="margin-top:-20px;"></span></small> </div>
                   <div style="margin-bottom:20px;"><small>
                  <span id="proposed_name_msg" style="margin-top:-20px;font-style:italic;"></span></small></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="acronymofCooperative"><i class="fas fa-info-user"  data-toggle="tooltip" data-placement="top"
                  data-html="true" title="<li>Don't include the type of your cooperative in your proposed name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Acronym of Cooperative Name:</label>
                  <input type="text" class="form-control validate[funcCall[validateCooperativeParenthesesInAcronymCustom]]" name="acronym_name" id="acronymname" placeholder="(Optional)">
                  <label id="" style="color:red;font-size:80%;"><i>* For subsidiary cooperative, kindly input this format here after you encode your proposed name: "A subsidiary cooperative of [Cooperative Name]".</i></label>
                  <label id="acronymnameerr" style="color:red;font-size:80%;"><i>* Acronym Name has been disabled. Maximum Character reach on "Proposed Name".</i></label>
                </div> 
              </div>
            </div>
            <div class="row rd-row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label nfor="commonBondOfMembership">Common Bond of Membership </label>
                  <select class="custom-select validate[required]" name="commonBondOfMembership" id="commonBondOfMembership">
                    <option value="" selected></option>
                    <option value="Associational">Associational</option>
                    <option value="Institutional">Institutional</option>
                    <option value="Occupational">Occupational</option>
                    <option value="Residential">Residential</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="areaOfOperation">Area of Operation </label>
                  <select class="custom-select validate[required]" name="areaOfOperation" id="areaOfOperation">
                    <option value="" selected>--</option>
                    <option value="Barangay">Barangay</option>
                    <option value="Municipality/City">Municipality/City</option>
                    <option value="Provincial">Provincial</option>
                    <option value="Regional">Regional</option>
                    <option value="Interregional">Inter-Regional</option>
                    <option value="National">National</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-4">
                <div class="form-group" id="allisland">
                  <label for="selectisland" id="selectisland">Select a Island</label>
                  <select name="interregional[]" id="interregional" class="form-control validate[required] select2 select-island" multiple="">
                    <option class="opt" value="1">Luzon</option>
                    <option class="opt" value="2">Visayas</option>
                    <option class="opt" value="3">Mindanao</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-8">
                <div class="form-group"  id="allregions">
                  <label for="selectregion" id="selectregion">Select a Regions</label>
                  <select class="form-control validate[required] select2 select-region" name="regions[]" id="regions" multiple="">
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-10">
                <div class="form-group">
                  <!-- <label for="areaOfOperation">Select a Island </label>
                  <select name="interregional[]" class="form-control" multiple="">
                    <option value="1">Luzon</option>
                    <option value="2">Visayas</option>
                    <option value="3">Mindanao</option>
                  </select> -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12 col-com">
                <div class="form-group">
                  <label for="compositionOfMembers1" id="commonbondname">Composition of Members </label>
                  <label for="compositionOfMembers1" id="fieldmembershipname">Field of Membership <i>(Note: Employees/Retirees)</i></label>
                  <label for="compositionOfMembers1" id="fieldmembershipmemofficname">Field of Membership <i>(Note: Members, Officers)</i></label>
                  <select class="custom-select" name="compositionOfMembers[]" id="compositionOfMembers1">
                    <option value="" selected></option>
                    <?php
                      foreach ($composition as $key) {
                        echo '<option value="'.$key->composition.'">'.$key->composition.'</option>';
                      }
                    ?>
                  </select>
                  <input type="text" class="form-control" name="field_membership" id="field_membership">
                  <label for="compositionOfMembers1" id="name_institution_label">Name of Institution</label>
                  <input type="text" class="form-control" name="name_institution[]" id="name_institution">
                  <label for="compositionOfMembers1" id="name_associational_label">Name of Association</label>
                  <input type="text" class="form-control" name="name_associational[]" id="name_associational">
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <button type="button" class="btn btn-success btn-sm float-right" id="addMoreComBtn"><i class="fas fa-plus"></i> Add Composition of Members</button>
                  <button type="button" class="btn btn-success btn-sm float-right" id="addMoreInsBtn"><i class="fas fa-plus"></i> Add Additional Name of Institution</button>
                  <button type="button" class="btn btn-success btn-sm float-right" id="addMoreAssocBtn"><i class="fas fa-plus"></i> Add Additional Name of Associational</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Proposed Address of the Cooperative</strong><br>
                  <div style="color:red;font-size: 11px;"><i>*Please leave the House/Lot and Blk No. and Street Name blank if not applicable</i></div>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="blkNo">House/Lot & Blk No.</label>
                  <input type="text" class="form-control" name="blkNo" id="blkNo" placeholder="">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="streetName">Street Name</label>
                  <input type="text" class="form-control" name="streetName" id="streetName" placeholder="">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
             
                <div class="form-group">
                  <label for="region">Region</label>
                  <select class="custom-select validate[required]" name="region" id="region">
                    <option value="" selected></option>
                    <?php foreach ($regions_list as $region_list) : ?>
                      <option value ="<?php echo $region_list['regCode'];?>"><?php echo $region_list['regDesc']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="province">Province</label>
                  <select class="custom-select validate[required]" name="province" id="province" disabled>
                  </select>
                </div>
              </div>

              <div class="col-sm-12 col-md-4">
                

                 <div class="form-group">
                  <label for="city">City/Municipality</label>
                  <select class="custom-select validate[required]" name="city" id="city" disabled>
                  </select>
                </div>

              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="barangay">Barangay</label>
                  <select class="custom-select validate[required]" name="barangay" id="barangay" disabled>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 offset-md-1 col-md-10 align-self-end">
            <div class="form-group">
              <div class="custom-control custom-checkbox text-center mt-2">
                <input type="checkbox" class="custom-control-input" id="reserveAddAgree" name="reserveAddAgree">
                <label class="custom-control-label" for="reserveAddAgree"><p class="font-weight-bolder">I have read and agreed to our Terms and Conditions.</p></label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-6 offset-md-10 col-md-2 align-self-center col-reserve-btn">
              <input class="btn btn-block btn-color-blue" type="submit" id="reserveAddBtn" name="reserveAddBtn" value="Submit" disabled onclick="return confirm('Are you sure you want to Submit?')" >
          </div>
        </div>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<style type="text/css">input{border:1px solid red;}</style>
<script src="<?=base_url('assets/plugins/select2/js/select2.full.min.js')?>"></script>
<script>
 
</script>
