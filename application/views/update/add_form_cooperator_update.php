<?php $total_subscribed = 0;?>
<?php $total_paid = 0;?>
<?php foreach ($list_cooperators as $cooperator) : ""?>
    <?php 
        $total_subscribed += $cooperator['number_of_subscribed_shares'];
        $total_paid += $cooperator['number_of_paid_up_shares'];
    ?>
<?php endforeach; ?>
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives_update/<?= $encrypted_id ?>/cooperators_update" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Add Cooperator</h5>
  </div>
</div>
<div class="row mt-3">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info" role="alert">
    <strong>Reminder: <small>(The information below is in your bylaws (capitalization))</small></strong>
     <ul>
       <li>Regular Member must subscribed at least <strong><?php if(isset($capitalization_info->minimum_subscribed_share_regular)) { echo $capitalization_info->minimum_subscribed_share_regular; }?></strong> shares and pay at least <strong><?php if(isset($capitalization_info->minimum_paid_up_share_regular)){ echo $capitalization_info->minimum_paid_up_share_regular; }?></strong> shares.</li>
       <?php if($bylaw_info->kinds_of_members ==2) : ?>
        <li>Associate Member must subscribed at least  <strong><?= $capitalization_info->minimum_subscribed_share_associate?></strong> shares and pay at least <strong><?= $capitalization_info->minimum_paid_up_share_associate?></strong> shares.</li>
      <?php endif; ?>
     </ul>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
    <?php echo form_open('cooperatives_update/'.$encrypted_id.'/cooperators_update/add',array('id'=>'addCooperatorForm','name'=>'addCooperatorForm')); ?>
      <div class="card-body">
        <div class="row">
          <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
          <input type="hidden" class="form-control" id="userID" name="userID" value="<?= $encrypted_user_id ?>">
          <input type='hidden' id='available_subscribed_capital' value="<?=isset($capitalization_info->total_no_of_subscribed_capital) ? $capitalization_info->total_no_of_subscribed_capital - $total_subscribed: ''?>" />
          <input type='hidden' id='available_paid_up_capital' value="<?=isset($capitalization_info->total_no_of_paid_up_capital) ? $capitalization_info->total_no_of_paid_up_capital - $total_paid: ''?>" />
          <input type='hidden' id='minimum_subscribed_share_regular' value="<?=isset($capitalization_info->minimum_subscribed_share_regular) ? $capitalization_info->minimum_subscribed_share_regular: ''?>" />
          <input type='hidden' id='minimum_paid_up_share_regular' value="<?=isset($capitalization_info->minimum_paid_up_share_regular) ? $capitalization_info->minimum_paid_up_share_regular: ''?>" />
          <input type='hidden' id='minimum_subscribed_share_associate' value="<?=isset($capitalization_info->minimum_subscribed_share_associate) ? $capitalization_info->minimum_subscribed_share_associate: ''?>" />
          <input type='hidden' id='minimum_paid_up_share_associate' value="<?=isset($capitalization_info->minimum_paid_up_share_associate) ? $capitalization_info->minimum_paid_up_share_associate: ''?>" />
          <div class="col-sm-12 col-md-4">
            <div class="form-group"> 
              <label for="position">Position:</label>
              <select class="custom-select" id="position" name="position" >
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
              <select class="custom-select" id="membershipType" name="membershipType">
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
              <input type="text" class="form-control" id="fName" name="fName">
              <label for="fName" style="font-style: italic;font-size: 11px;">(Last Name, First Name Middle Name)</label>
            </div>
      		</div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="subscribedShares">No of subscribed shares:</label>
              <input type="number" min="1"  class="form-control" id="subscribedShares" name="subscribedShares" >
              <div id="subscribed-note" style="color: red; font-size: 12px;"></div>
            </div>
      		</div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label for="paidShares">No of paid-up Shares:</label>
              <input type="number" min="1"  class="form-control" id="paidShares" name="paidShares" >
              <div id="paid-note" style="color: red; font-size:12px;"></div>
            </div>
      		</div>
          <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="gender">Gender:</label>
              <select class="custom-select" name="gender">
                <option value="" selected>--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
      		</div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label for="bDate"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>Age must be 18 years old and above.</li>"></i> Birth Date:</label>
              <input type="date" class="form-control" id="bDate" name="bDate">
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
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="region">Region</label>
                  <select class="custom-select" name="region" id="region">
                    <option value="" selected></option>
                    <?php foreach ($regions_list as $region_list) : ?>
                      <option value ="<?php echo $region_list['regCode'];?>" <?=($coop_info->rCode == $region_list['regCode'] ? 'selected' : '')?>><?php echo $region_list['regDesc']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="province">Province</label>
                  <select class="custom-select" name="province" id="province" >
                    <?php 
                    foreach($list_of_provinces as $province_list)
                    {
                      ?>
                      <option value="<?=$province_list['provCode']?>" <?=($province_list['provCode']== $coop_info->pCode? 'selected' : '')?>><?=$province_list['provDesc']?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="city">City/Municipality</label>
                  <select class="custom-select" name="city" id="city" >
                    <?php
                    foreach($list_of_cities as $city_list)
                    {
                      ?>
                      <option value="<?=$city_list['citymunCode']?>" <?=($city_list['citymunCode'] == $coop_info->cCode ?'selected' :'')?>><?=$city_list['citymunDesc']?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="barangay">Barangay</label>
                  <select class="custom-select" name="barangay" id="barangay" >
                    <?php
                    foreach($list_of_brgys as $brgy_list)
                    {
                      ?>
                      <option value="<?=$brgy_list['brgyCode']?>" <?=($brgy_list['brgyCode'] == $coop_info->bCode ? 'selected' :'')?>> <?=($brgy_list['brgyDesc'])?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <?php
                  if($coop_info->area_of_operation == "Barangay"){ ?>
                    <!-- <input type="hidden" class="form-control" name="barangay" value="<?=$coop_info->bCode;?>"> -->
                  <?php }
                ?>
                
              </div>
            </div>
          </div>

          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="validIdType">Proof of Identity: </label>
              <select class="custom-select" onclick="validateSeniorAgeCustom()" id="validIdType" name="validIdType">
                <option value="">-----------</option>
                <?php foreach($list_id as $row): ?>
                  <option value="<?=$row['id_name']?>"><?php echo $row['id_name']; ?></option>
                <?php endforeach; ?>
                <!-- <option selected>--</option>
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
                <option value="Philhealth">Philhealth</option>
                <option value="OFW">OFW</option>
                <option value="Single Parent">Single Parent</option>
                <option value="PWD">PWD</option>
                <option value="pag-ibig">Pag-IBIG</option> -->
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-validIdNo">
              <label for="validIdNo">Valid ID No.</label>
              <input type="text" class="form-control" id="validIdNo" name="validIdNo" >
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="dateIssued"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>In Accordance with Notarial Law.</li>"></i> Date Issued:</label>
              <input type="date" class="form-control" id="dateIssued" name="dateIssued">
             <!-- <input type="text" class="form-control" id="dateIssued" name="dateIssued"> -->
              <!-- <small style="margin-left: 20px;"><span><i>  yyyy-mm-dd </i></span></small> -->
              <input type="checkbox" name="dateIssued_chk" id="chkID" value="N/A"> <small>ID Date Issued not available</small>
            </div>
      		</div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label for="placeIssuance">Place of Issuance: </label>
              <textarea class="form-control" style="resize: none;" id="placeIssuance" name="placeIssuance" rows="1"></textarea>
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
  // document.getElementById("membershipType").options[2].disabled = true;
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

 $(document).ready(function(){
    $("#chkID").on('click',function(){

      if($(this).is(":checked"))
      {
          $( "#dateIssued" ).prop( "disabled", true );
      }
      else
      {
           $( "#dateIssued" ).prop( "disabled", false );
      }

    });
 });
  
</script>