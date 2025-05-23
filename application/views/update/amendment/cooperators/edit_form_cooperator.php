<?php
$minimum_subscribed_share_regular='';
$minimum_paid_up_share_regular='';
if(isset($capitalization_info))
{
  $minimum_subscribed_share_regular =$capitalization_info->minimum_subscribed_share_regular;
  $minimum_paid_up_share_regular=$capitalization_info->minimum_paid_up_share_regular;
}
?>
<?php $total_subscribed = 0;?>
<?php $total_paid = 0;?>
<?php $total_subscribed_orig = 0;?>
<?php $total_paid_orig = 0;?>
<?php foreach ($list_cooperators as $cooperator) : ""?>
    <?php 
        $total_subscribed += $cooperator['number_of_subscribed_shares'];
        $total_paid += $cooperator['number_of_paid_up_shares'];
    ?>
<?php endforeach; ?>
<?php foreach ($list_cooperators_orig as $cooperator_orig) : ""?>
    <?php 
        $total_subscribed_orig += $cooperator_orig['number_of_subscribed_shares'];
        $total_paid_orig += $cooperator_orig['number_of_paid_up_shares'];
    ?>
<?php endforeach; ?>

<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/amendment_cooperators" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Edit Cooperator</h5>
  </div>
</div>
<?php if(!$is_original_cptr):?>
<div class="row mt-3">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info" role="alert">
    <strong>Reminder: <small>(The information below is in your bylaws (capitalization))</small></strong>
     <ul>
       <li>Regular Member must subscribed at least <strong><?= $minimum_subscribed_share_regular?></strong> shares and pay at least <strong><?= $minimum_paid_up_share_regular?></strong> shares.</li>
       <?php if($bylaw_info->kinds_of_members ==2) : ?>
        <li>Associate Member must subscribed at least  <strong><?= $capitalization_info->minimum_subscribed_share_associate?></strong> shares and pay at least <strong><?= $capitalization_info->minimum_paid_up_share_associate?></strong> shares.</li>
      <?php endif; ?>
     </ul>
    </div>
  </div> 
</div>
<?php else: ?>
<div class="row mt-3">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info" role="alert">
    <strong>Reminder: <small>(The information below is in your bylaws (capitalization))</small></strong>
     <ul>
       <li>Regular Member must subscribed at least <strong><?= $capitalization_info_orig->minimum_subscribed_share_regular?></strong> shares and pay at least <strong><?= $capitalization_info_orig->minimum_paid_up_share_regular?></strong> shares.</li>
       <?php if($bylaw_info_orig->kinds_of_members ==2) : ?>
        <li>Associate Member must subscribed at least  <strong><?= $capitalization_info_orig->minimum_subscribed_share_associate?></strong> shares and pay at least <strong><?= $capitalization_info_orig->minimum_paid_up_share_associate?></strong> shares.</li>
      <?php endif; ?>
     </ul>
    </div>
  </div> 
</div>

<?php endif //is not original cptr?> 

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
    <?php echo form_open('amendment_update/'.$encrypted_id.'/amendment_cooperator/'.$encrypted_cooperator_id.'/edit',array('id'=>'editCooperatorForm','name'=>'editCooperatorForm')); ?>
      <div class="card-body">
        <div class="row">
          
          <input type="hidden" class="form-control" id="amd_id" name="amd_id" value="<?=$encrypted_id ?>">
          <input type="hidden" class="form-control" value="<?=$encrypted_coop_id?>" id="cooperative_id" name="cooperative_id"/>

          <input type="hidden" class="form-control" id="cooperatorID" name="cooperatorID" value="<?= $encrypted_cooperator_id?>">
          <input type="hidden" class="form-control" id="regCode" name="regCode" value="<?= $cooperator_info->rCode ?>">
          <input type="hidden" class="form-control" id="provCode" name="provCode" value="<?= $cooperator_info->pCode ?>">
          <input type="hidden" class="form-control" id="cityCode" name="cityCode" value="<?= $cooperator_info->cCode ?>">
          <input type="hidden" class="form-control" id="brgyCode" name="brgyCode" value="<?= $cooperator_info->bCode ?>">
          <?php 
            $cooperator_info_orig_number_of_subscribed_shares =0;
            $cooperator_info_orig_number_of_paid_up_shares = 0;
            if(isset($cooperator_info_orig))
            {
              $cooperator_info_orig_number_of_subscribed_shares =$cooperator_info_orig->number_of_subscribed_shares;
               $cooperator_info_orig_number_of_paid_up_shares = $cooperator_info_orig->number_of_paid_up_shares;
            }
            $available_subscribed_capital = isset($capitalization_info->total_no_of_subscribed_capital) ? (($capitalization_info->total_no_of_subscribed_capital - $total_subscribed)>=0 ? ($capitalization_info->total_no_of_subscribed_capital - $total_subscribed) + $cooperator_info->number_of_subscribed_shares : '') : '';
             $available_subscribed_capital_orig = isset($capitalization_info_orig->total_no_of_subscribed_capital) ? (($capitalization_info_orig->total_no_of_subscribed_capital - $total_subscribed_orig)>=0 ? ($capitalization_info_orig->total_no_of_subscribed_capital - $total_subscribed_orig) + $cooperator_info_orig_number_of_subscribed_shares : '') : '';

            $available_paid_up_capital = isset($capitalization_info->total_no_of_paid_up_capital) ? (($capitalization_info->total_no_of_paid_up_capital - $total_paid)>=0 ? ($capitalization_info->total_no_of_paid_up_capital - $total_paid) + $cooperator_info->number_of_paid_up_shares : '') : '';

             $available_paid_up_capital_orig = isset($capitalization_info_orig->total_no_of_paid_up_capital) ? (($capitalization_info_orig->total_no_of_paid_up_capital - $total_paid_orig)>=0 ? ($capitalization_info_orig->total_no_of_paid_up_capital - $total_paid_orig) +  $cooperator_info_orig_number_of_paid_up_shares : '') : '';

          ?>

        
            <input type='hidden' id='available_subscribed_capital' value="<?=$available_subscribed_capital?>" />
            <input type='hidden' id='available_paid_up_capital' value="<?=$available_paid_up_capital?>" />
            <input type='hidden' id='minimum_subscribed_share_regular' value="<?=isset($capitalization_info->minimum_subscribed_share_regular) ? $capitalization_info->minimum_subscribed_share_regular: ''?>" />
            <input type='hidden' id='minimum_paid_up_share_regular' value="<?=isset($capitalization_info->minimum_paid_up_share_regular) ? $capitalization_info->minimum_paid_up_share_regular: ''?>" />
            <input type='hidden' id='minimum_subscribed_share_associate' value="<?=isset($capitalization_info->minimum_subscribed_share_associate) ? $capitalization_info->minimum_subscribed_share_associate: ''?>" />
            <input type='hidden' id='minimum_paid_up_share_associate' value="<?=isset($capitalization_info->minimum_paid_up_share_associate) ? $capitalization_info->minimum_paid_up_share_associate: ''?>" />
        
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="position">Position:</label>
              <select class="custom-select validate[required]" id="position" name="position">
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
               
                  <option value="Associate" <?php if($cooperator_info->type_of_member == "Associate") echo "selected"; ?>>Associate</option>
                
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-md-5">
            <div class="form-group">
              <label for="fName">Full Name:</label>
              <input type="hidden" value="<?=$cooperative_id?>" id="cooperativesID" name="cooperativesID">
              <input type="text" value="<?= $cooperator_info->full_name ?>" class="form-control validate[required]" id="fName" name="fName">
              <label for="fName" style="font-style: italic;font-size: 11px;">(Last Name, First Name Middle Name)</label>
            </div>
          </div> 
         
          <div class="col-sm-12 col-md-4"> 
            <div class="form-group">
              <input type="hidden" id="is_original_cooperator" value="<?=$is_original_cooperator?>">
              <label for="subscribedShares">No of subscribed shares:</label>
              <?php 
              if(!$is_original_cptr)
              {
              ?>  
              <input type="number" value="<?= $cooperator_info->number_of_subscribed_shares ?>"  class="form-control " id="amd_subscribedShares" name="amd_subscribedShares">
              <?php 
              }
              else
              { 
              ?>

              <input type="number" value="<?=$cooperator_info->number_of_subscribed_shares ?>"  class="form-control " id="subscribedShares" name="amd_subscribedShares">

              <?php  
              }
              ?>
          
          
              <div id="subscribed-note" style="color: red; font-size: 12px;"></div>
            </div>
          </div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
               <label for="paidShares">No of paid-up Shares:</label>
               <?php
              if(!$is_original_cptr)
              {
              ?>  
              <input type="number" value="<?= $cooperator_info->number_of_paid_up_shares ?>"  class="form-control" id="amd_paidShares" name="paidShares">
              <?php
               }
               else
               {
                ?>
                 <input type="number" value="<?= $cooperator_info->number_of_paid_up_shares ?>"  class="form-control" id="paidShares" name="paidShares">
              <?php
               }
              ?>
              <div id="paid-note" style="color: red; font-size:12px;"></div>
            </div>
          </div>
          <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="gender">Gender:</label>
              <select class="custom-select " name="gender">
                <option value="" selected>--</option>
                <option value="Male" <?php if($cooperator_info->gender == "Male") echo "selected"; ?>>Male</option>
                <option value="Female" <?php if($cooperator_info->gender == "Female") echo "selected"; ?>>Female</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label for="bDate"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>Age must be 18 years old and above.</li>"></i> Birth Date:</label>
              <input type="date" value="<?= $cooperator_info->birth_date ?>" class="form-control" id="bDate" name="bDate">
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
                  <?php if($is_original_cptr): ?>
                     <input type="text" class="form-control" name="blkNo"  placeholder="" value="<?= $cooperator_info->house_blk_no?>">
                  <?php else: ?>
                  <input type="text" class="form-control" name="blkNo" id="blkNo" placeholder="" value="<?= $cooperator_info->house_blk_no?>">
                  <?php endif;?>  
                  
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="streetName">Street Name</label>
                  <?php if($is_original_cptr): ?> 
                    <input type="text" class="form-control" name="streetName"  placeholder="" value="<?=$cooperator_info->streetName?>">
                  <?php else: ?>
                  <input type="text" class="form-control" name="streetName" id="streetName" placeholder="" value="<?=$cooperator_info->streetName?>">
                <?php endif; ?>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group"> 
                  <label for="barangay">Barangay</label>
                   <?php if($is_original_cptr): ?>
                    <select class="custom-select barangay validate[required]" id="barangay" name="barangay" >
                       <?php
                    foreach($list_of_brgys as $brgy_list)
                    {
                      ?>
                      <option value="<?=$brgy_list['brgyCode']?>" <?=($brgy_list['brgyCode'] == $cooperator_info->bCode ? 'selected' :'')?>> <?=($brgy_list['brgyDesc'])?></option>
                      <?php
                    }
                    ?>
                  </select>
                  <?php else: ?>
                  <select class="custom-select barangay validate[required]" id="barangay"  >
                       <?php
                    foreach($list_of_brgys as $brgy_list)
                    {
                      ?>
                      <option value="<?=$brgy_list['brgyCode']?>" <?=($brgy_list['brgyCode'] == $cooperator_info->bCode ? 'selected' :'')?>> <?=($brgy_list['brgyDesc'])?></option>
                      <?php
                    }
                    ?>
                  </select>
                <?php endif;?>
                  <input type="hidden" class="form-control validate[required]" id="addr_barangay" name="addr_barangay" value="<?=$cooperator_info->bCode;?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="city">City/Municipality</label>
                   <?php if($is_original_cptr): ?>
                    <select class="custom-select validate[required]" name="city" id="city" >
                        <?php
                        foreach($list_of_cities as $city_list)
                        {
                          ?>
                          <option value="<?=$city_list['citymunCode']?>" <?=($city_list['citymunCode'] == $cooperator_info->cCode ?'selected' :'')?>><?=$city_list['citymunDesc']?></option>
                          <?php
                        }
                        ?>
                      </select>
                  <?php else: ?>
                      <select class="custom-select validate[required]" name="city" id="city" >
                        <?php
                        foreach($list_of_cities as $city_list)
                        {
                          ?>
                          <option value="<?=$city_list['citymunCode']?>" <?=($city_list['citymunCode'] == $cooperator_info->cCode ?'selected' :'')?>><?=$city_list['citymunDesc']?></option>
                          <?php
                        }
                        ?>
                      </select>
                  <?php endif;?>    
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="province">Province</label>
                  <?php if($is_original_cptr): ?>
                     <select class="custom-select validate[required]" name="province" id="province" disabled>
                        <?php
                        foreach($list_of_provinces as $province_list)
                        {
                        ?>
                         <option value="<?=$province_list['provCode']?>" <?=($province_list['provCode']== $cooperator_info->pCode? 'selected' : '')?>><?=$province_list['provDesc']?></option>
                        <?php
                        }
                        ?>
                      </select>
                  <?php else: ?>
                       <select class="custom-select validate[required]" name="province" id="province" disabled>
                        <?php
                        foreach($list_of_provinces as $province_list)
                        {
                        ?>
                         <option value="<?=$province_list['provCode']?>" <?=($province_list['provCode']== $cooperator_info->pCode? 'selected' : '')?>><?=$province_list['provDesc']?></option>
                        <?php
                        }
                        ?>
                      </select>
                  <?php endif;?>    
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="region">Region</label>
                   <?php if($is_original_cptr): ?>
                      <select class="custom-select validate[required]" name="region" id="region" disabled>
                        <option value="" selected></option>
                        <?php foreach ($regions_list as $region_list) : ?>
                          <option value ="<?php echo $region_list['regCode'];?>" <?=($cooperator_info->rCode == $region_list['regCode'] ? 'selected' :'')?> ><?php echo $region_list['regDesc']?></option>
                        <?php endforeach; ?>
                      </select>
                  <?php else: ?>
                      <select class="custom-select validate[required]" name="region" id="region">
                        <option value="" selected></option>
                        <?php foreach ($regions_list as $region_list) : ?>
                          <option value ="<?php echo $region_list['regCode'];?>" <?=($cooperator_info->rCode == $region_list['regCode'] ? 'selected' :'')?> ><?php echo $region_list['regDesc']?></option>
                        <?php endforeach; ?>
                      </select>
                  <?php endif; ?>    
                </div>
              </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="validIdType">Proof of Identity: </label>
              <select class="custom-select " id="validIdType" name="validIdType">
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
                <option value="Philhealth" <?php if($cooperator_info->proof_of_identity == "Philhealth") echo "selected"; ?>>Philhealth</option>
                <option value="OFW" <?php if($cooperator_info->proof_of_identity == "OFW") echo "selected"; ?>>OFW</option>
                <option value="Single Parent" <?php if($cooperator_info->proof_of_identity == "Single Parent") echo "selected"; ?>>Single Parent</option>
                <option value="PWD" <?php if($cooperator_info->proof_of_identity == "PWD") echo "selected"; ?>>PWD</option>
                  <option value="pag-ibig" <?php if($cooperator_info->proof_of_identity == "pag-ibig") echo "selected"; ?>>Pag-IBIG</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-validIdNo">
              <label for="validIdNo">Valid ID No.</label>
              <input type="text" class="form-control " id="validIdNo" name="validIdNo" value="<?=$cooperator_info->proof_of_identity_number ?>">
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="dateIssued"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>In Accordance with Notarial Law.</li>"></i> Date Issued:</label>
               <?php if($cooperator_info->proof_date_issued=='N/A'):
                ?>
               <input type="date" class="form-control" id="dateIssued" name="dateIssued" disabled>
                <input type="checkbox" name="dateIssued_chk" value="N/A" id="chkID" checked> <small>ID Date Issued not available</small>
              <?php else: ?>
                    <input type="date" class="form-control"  id="dateIssued" name="dateIssued"  value="<?=$cooperator_info->proof_date_issued?>">
                     <input type="checkbox" name="dateIssued_chk" value="N/A" id="chkID"> <small>ID Date Issued not available</small>
              <?php endif;?>
              <!-- <input type="date" class="form-control validate[required,custom[date],past[now]" id="dateIssued" name="dateIssued" value="<?=$cooperator_info->proof_date_issued ?>"> -->
            </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label for="placeIssuance">Place of Issuance: </label>
              <textarea class="form-control " style="resize: none;" id="placeIssuance" name="placeIssuance" rows="1"><?=$cooperator_info->place_of_issuance ?></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-xs-12 card-footer editCooperatorFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="editCooperatorBtn" name="editCooperatorBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#chkID").on('click',function(){

      if($(this).is(":checked"))
      {
          $( "#dateIssued" ).prop( "disabled", true );
          $("#dateIssued").prop('required',false);
            $("#dateIssued").val('');
      }
      else
      {
           $( "#dateIssued" ).prop( "disabled", false );
            $("#dateIssued").prop('required',true);
      }

    });

    $(".barangay").on('change', function(){
     $("#addr_barangay").val($(this).val());
    });
 });
</script>
