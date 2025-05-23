<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/cooperators" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Edit Cooperator</h5>
  </div>
</div>
<div class="row mt-3">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info" role="alert">
    <strong>Reminder: <small>(The information below is in your bylaws)</small></strong>
     <ul>
       <li>Regular Member must subscribed at least <strong><?= $bylaw_info->regular_percentage_shares_subscription?></strong> shares and pay at least <strong><?= $bylaw_info->regular_percentage_shares_pay?></strong> shares.</li>
       <?php if($bylaw_info->kinds_of_members ==2) : ?>
        <li>Associate Member must subscribed at least  <strong><?= $bylaw_info->associate_percentage_shares_subscription?></strong> shares and pay at least <strong><?= $bylaw_info->associate_percentage_shares_pay?></strong> shares.</li>
      <?php endif; ?>
     </ul>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
    <?php echo form_open('cooperatives/'.$encrypted_id.'/cooperators/'.$encrypted_cooperator_id.'/edit',array('id'=>'editCooperatorForm','name'=>'editCooperatorForm')); ?>
      <div class="card-body">
        <div class="row">
          <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?= $encrypted_id?>">
          <input type="hidden" class="form-control" id="cooperatorID" name="cooperatorID" value="<?= $encrypted_cooperator_id?>">
          <input type="hidden" class="form-control" id="regCode" name="regCode" value="<?= $cooperator_info->rCode ?>">
          <input type="hidden" class="form-control" id="provCode" name="provCode" value="<?= $cooperator_info->pCode ?>">
          <input type="hidden" class="form-control" id="cityCode" name="cityCode" value="<?= $cooperator_info->cCode ?>">
          <input type="hidden" class="form-control" id="brgyCode" name="brgyCode" value="<?= $cooperator_info->bCode ?>">
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="position">Position:</label>
              <select class="custom-select validate[required,ajax[ajaxEditCooperatorPosition]]" id="position" name="position">
                <option value="" >--</option>
                <option value="Chairperson" <?php if($cooperator_info->position == "Chairperson") echo "selected"; ?>>Chairperson</option>
                <option value="Vice-Chairperson" <?php if($cooperator_info->position == "Vice-Chairperson") echo "selected"; ?>>Vice-Chairperson</option>
                <option value="Board of Director" <?php if($cooperator_info->position == "Board of Director") echo "selected"; ?>>Board of Director</option>
                <option value="Treasurer" <?php if($cooperator_info->position == "Treasurer") echo "selected"; ?>>Treasurer</option>
                <option value="Secretary" <?php if($cooperator_info->position == "Secretary") echo "selected"; ?>>Secretary</option>
                <option value="Member" <?php if($cooperator_info->position == "Member") echo "selected"; ?>>Member</option>
              </select>
            </div>
      		</div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label for="membershipType">Type of Membership:</label>
              <select class="custom-select validate[required]" id="membershipType" name="membershipType">
                <option value="" selected>--</option>
                <option value="Regular" <?php if($cooperator_info->type_of_member == "Regular") echo "selected"; ?>>Regular</option>
                <?php if($bylaw_info->kinds_of_members==2) :?>
                  <option value="Associate" <?php if($cooperator_info->type_of_member == "Associate") echo "selected"; ?>>Associate</option>
                <?php endif?>
              </select>
            </div>
      		</div>
          <div class="col-sm-12 col-md-5">
            <div class="form-group">
              <label for="fName">Full Name:</label>
              <input type="text" value="<?= $cooperator_info->full_name ?>" class="form-control validate[required,custom[fullname],ajax[ajaxEditCooperatorName]" id="fName" name="fName">
              <label for="fName" style="font-style: italic;font-size: 11px;">(Last Name, First Name Middle Name)</label>
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="subscribedShares">No of subscribed shares:</label>
              <input type="number" value="<?= $cooperator_info->number_of_subscribed_shares ?>" min="1" class="form-control validate[required,min[1],custom[integer]]" id="subscribedShares" name="subscribedShares">
            </div>
      		</div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label for="paidShares">No of paid-up Shares:</label>
              <input type="number" value="<?= $cooperator_info->number_of_paid_up_shares ?>" min="1" class="form-control validate[required,min[1],custom[integer],funcCall[validateEditNumberOfPaidUpGreaterCustom]]" id="paidShares" name="paidShares">
            </div>
      		</div>
          <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="gender">Gender:</label>
              <select class="custom-select validate[required]" name="gender">
                <option value="" selected>--</option>
                <option value="Male" <?php if($cooperator_info->gender == "Male") echo "selected"; ?>>Male</option>
                <option value="Female" <?php if($cooperator_info->gender == "Female") echo "selected"; ?>>Female</option>
              </select>
            </div>
      		</div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label for="bDate"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>Age must be 18 years old and above.</li>"></i> Birth Date:</label>
              <input type="date" value="<?= $cooperator_info->birth_date ?>" class="form-control validate[required,funcCall[validateAgeCustom]]" id="bDate" name="bDate">
            </div>
      		</div>
          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Address of the Cooperator</strong>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="blkNo">House/Lot & Blk No.</label>
                  <input type="text" class="form-control" name="blkNo" id="blkNo" placeholder="" value="<?= $cooperator_info->house_blk_no?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="streetName">Street Name</label>
                  <input type="text" class="form-control" name="streetName" id="streetName" placeholder="" value="<?=$cooperator_info->streetName?>">
                </div>
              </div>
            <?php if($coop_info->area_of_operation == 'Barangay'){ ?>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="barangay">Barangay</label>
                  <input type="text" class="form-control validate[required]" name="barangay" value="<?=$coop_info->brgy?>" disabled>
                  <input type="hidden" class="form-control validate[required]" name="barangay" value="<?=$coop_info->bCode?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="city">City/Municipality</label>
                  <input class="form-control validate[required]" name="city" value="<?=$coop_info->city?>" disabled>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="province">Province</label>
                  <input class="form-control validate[required]" name="province" value="<?=$coop_info->province?>" disabled>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="region">Region</label>
                  <input type="text" class="form-control validate[required]" name="region" value="<?=$coop_info->region?>" disabled>
                </div>
              </div>
            <?php } elseif($coop_info->area_of_operation == 'Municipality/City') { ?>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="barangay">Barangay</label>
                  <select class="custom-select validate[required]" name="barangay" id="barangay" disabled>
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
                  <label for="province">Province</label>
                  <select class="custom-select validate[required]" name="province" id="province" disabled>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="region">Region</label>
                  <select class="custom-select validate[required]" name="region" id="region">
                    <option value="" selected></option>
                    <?php foreach ($regions_list as $region_list) : ?>
                      <option  value ="<?php echo $region_list['regCode'];?>"><?php echo $region_list['regDesc']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            <?php } else {?>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="barangay">Barangay</label>
                  <select class="custom-select validate[required]" name="barangay" id="barangay" disabled>
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
                  <label for="province">Province</label>
                  <select class="custom-select validate[required]" name="province" id="province" disabled>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="region">Region</label>
                  <select class="custom-select validate[required]" name="region" id="region">
                    <option value="" selected></option>
                    <?php foreach ($regions_list as $region_list) : ?>
                      <option  value ="<?php echo $region_list['regCode'];?>"><?php echo $region_list['regDesc']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            <?php } ?>
            </div>
          </div>

          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="validIdType">Proof of Identity: </label>
              <select class="custom-select validate[required]" id="validIdType" name="validIdType">
                <option value ="" selected></option>
                <option value="Digitized Postal ID" <?php if($cooperator_info->proof_of_identity == "Digitized Postal ID") echo "selected"; ?>>Digitized Postal ID</option>
                <option value="Driver's License" <?php if($cooperator_info->proof_of_identity == "Driver's License") echo "selected"; ?>>Driver's License</option>
                <option value="GSIS E-Card" <?php if($cooperator_info->proof_of_identity == "GSIS E-Card") echo "selected"; ?>>GSIS E-Card</option>
                <option value="IBP ID" <?php if($cooperator_info->proof_of_identity == "IBP ID") echo "selected"; ?>>IBP ID</option>
                <option value="OWWA ID" <?php if($cooperator_info->proof_of_identity == "OWWA ID") echo "selected"; ?>>OWWA ID</option>
                <option value="Passport" <?php if($cooperator_info->proof_of_identity == "Passport") echo "selected"; ?>>Passport</option>
                <option value="PRC ID" <?php if($cooperator_info->proof_of_identity == "PRC ID") echo "selected"; ?>>PRC ID</option>
                <option value="Senior Citizen's ID" <?php if($cooperator_info->proof_of_identity == "Senior Citizen's ID") echo "selected"; ?>>Senior Citizen's ID</option>
                <option value="SSS ID" <?php if($cooperator_info->proof_of_identity == "SSS ID") echo "selected"; ?>>SSS ID</option>
                <option value="TIN" <?php if($cooperator_info->proof_of_identity == "TIN") echo "selected"; ?>>TIN</option>
                <option value="Voter's ID" <?php if($cooperator_info->proof_of_identity == "Voter's ID") echo "selected"; ?>>Voter's ID</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-validIdNo">
              <label for="validIdNo">Valid ID No.</label>
              <input type="text" class="form-control validate[required]" id="validIdNo" name="validIdNo" value="<?=$cooperator_info->proof_of_identity_number ?>">
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="dateIssued"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>In Accordance with Notarial Law.</li>"></i> Date Issued:</label>
              <input type="date" class="form-control validate[required,custom[date],past[now]" id="dateIssued" name="dateIssued" value="<?=$cooperator_info->proof_date_issued ?>">
            </div>
      		</div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label for="placeIssuance">Place of Issuance: </label>
              <textarea class="form-control validate[required]" style="resize: none;" id="placeIssuance" name="placeIssuance" rows="1"><?=$cooperator_info->place_of_issuance ?></textarea>
            </div>
      		</div>
        </div>
      </div>
      <div class="card-footer editCooperatorFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="editCooperatorBtn" name="editCooperatorBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
