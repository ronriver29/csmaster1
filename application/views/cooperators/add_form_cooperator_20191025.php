<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/cooperators" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Add Cooperator</h5>
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
    <?php echo form_open('cooperatives/'.$encrypted_id.'/cooperators/add',array('id'=>'addCooperatorForm','name'=>'addCooperatorForm')); ?>
      <div class="card-body">
        <div class="row">
          <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
          <input type="hidden" class="form-control validate[required]" id="userID" name="userID" value="<?= $encrypted_user_id ?>">
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="position">Position:</label>
              <select class="custom-select validate[required,ajax[ajaxCooperatorPositionCallPhp]]" id="position" name="position" >
                <option value="" selected>--</option>
                <option value="Chairperson">Chairperson</option>
                <option value="Vice-Chairperson">Vice-Chairperson</option>
                <option value="Board of Director">Board of Director</option>
                <option value="Treasurer">Treasurer</option>
                <option value="Secretary">Secretary</option>
                <option value="Member">Member</option>
              </select>
            </div>
      		</div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label for="membershipType">Type of Membership:</label>
              <select class="custom-select validate[required]" id="membershipType" name="membershipType">
                <option value="" selected>--</option>
                <option value="Regular">Regular</option>
                <?php if($bylaw_info->kinds_of_members==2) :?>
                  <option value="Associate">Associate</option>
                <?php endif?>
              </select>
            </div>
      		</div>
          <div class="col-sm-12 col-md-5">
            <div class="form-group">
              <label for="fName">Full Name:</label>
              <input type="text" class="form-control validate[required,custom[fullname],ajax[ajaxCooperatorCallPhp]]" id="fName" name="fName">
              <label for="fName" style="font-style: italic;font-size: 11px;">(Last Name, First Name Middle Name)</label>
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="subscribedShares">No of subscribed shares:</label>
              <input type="number" min="1" class="form-control validate[required,min[1],custom[integer]]" id="subscribedShares" name="subscribedShares" readonly>
            </div>
      		</div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label for="paidShares">No of paid-up Shares:</label>
              <input type="number" min="1" class="form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom]]" id="paidShares" name="paidShares" readonly>
            </div>
      		</div>
          <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="gender">Gender:</label>
              <select class="custom-select validate[required]" name="gender">
                <option value="" selected>--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
      		</div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label for="bDate"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>Age must be 18 years old and above.</li>"></i> Birth Date:</label>
              <input type="date" class="form-control validate[required,custom[date],funcCall[validateAgeCustom]]" id="bDate" name="bDate">
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
                  <input type="text" class="form-control" name="blkNo" id="blkNo" placeholder="">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="streetName">Street Name</label>
                  <input type="text" class="form-control" name="streetName" id="streetName" placeholder="">
                </div>
              </div>
            <?php if($coop_info->area_of_operation == 'Barangay'){ ?>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="barangay">Barangay</label>
                  <select class="custom-select validate[required]" disabled>
                      <option value ="<?=$coop_info->bCode;?>"><?=$coop_info->brgy?></option>
                  </select>
                  <input type="hidden" class="form-control validate[required]" name="barangay" value="<?=$coop_info->bCode;?>">
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
                  <input class="form-control validate[required]" name="region" value="<?=$coop_info->region?>" disabled>
                </div>
              </div>
            <?php } elseif($coop_info->area_of_operation == 'Municipality/City') {?>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="barangay">Barangay</label>
                  <select class="custom-select validate[required]" name="barangay" id="barangay">
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
                      <option value ="<?php echo $region_list['regCode'];?>"><?php echo $region_list['regDesc']?></option>
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
                      <option value ="<?php echo $region_list['regCode'];?>"><?php echo $region_list['regDesc']?></option>
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
              <select class="custom-select validate[required,funcall[validateSeniorAgeCustom]]" onclick="validateSeniorAgeCustom()" id="validIdType" name="validIdType">
                <option selected>--</option>
                <option value="Digitized Postal ID">Digitized Postal ID</option>
                <option value="Driver's License">Driver's License</option>
                <option value="GSIS E-Card">GSIS E-Card</option>
                <option value="IBP ID">IBP ID</option>
                <option value="OWWA ID">OWWA ID</option>
                <option value="Passport">Passport</option>
                <option value="PRC ID">PRC ID</option>
                <option value="Senior Citizen's ID">Senior Citizen's ID</option>
                <option value="SSS ID">SSS ID</option>
                <option value="TIN">TIN</option>
                <option value="Voter's ID">Voter's ID</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-validIdNo">
              <label for="validIdNo">Valid ID No.</label>
              <input type="text" class="form-control validate[required]" id="validIdNo" name="validIdNo" disabled>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="dateIssued"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>In Accordance with Notarial Law.</li>"></i> Date Issued:</label>
              <input type="date" class="form-control validate[required,custom[date],past[now]]" id="dateIssued" name="dateIssued">
            </div>
      		</div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label for="placeIssuance">Place of Issuance: </label>
              <textarea class="form-control validate[required]" style="resize: none;" id="placeIssuance" name="placeIssuance" rows="1"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer addCooperatorFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="addCooperatorBtn" name="addCooperatorBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
  document.getElementById("membershipType").options[2].disabled = true;
  document.getElementById("position").options[0].disabled = true;
  $( "#position" ).click(function() {
    var x = document.getElementById("position").value;
    // alert(x);
    if(x == "Member"){
      document.getElementById("membershipType").options[2].disabled = false;
    } else {
      document.getElementById("membershipType").options[2].disabled = true;
    }
    // alert( "Handler for .click() called." );
  });
</script>