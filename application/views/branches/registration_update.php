<div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>branches/<?=$encrypted_id?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
  </div>
</div>
<?php if($branch_info->status == 0) :?>
<div class="row">
  <div class="col">
    <div class="alert alert-info shadow-sm" role="alert">
      <h5>Your reservation is already <strong>expired</strong>. Please fill up all the information to proceed into the next step</h5>
    </div>
  </div>
</div>
<?php endif; ?>
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
      <?php echo form_open('branches/'.$encrypted_id.'/bupdate',array('id'=>'reserveBranchUpdateForm','name'=>'reserveBranchUpdateForm')); ?>
      <div class="card-header">
        <div class="row">
          <div class="col-sm-6 col-md-6">
            <h4>Branch/Satellite Update Form</h4>
          </div>
          <div class="col-sm-4 offset-sm-2 offset-md-2 col-md-4">
            <h5 class="text-right text-primary">
              <?php if($is_client): ?>
              Step 1
              <?php endif; ?>
            </h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Application Information:</strong>
                    <input type="hidden" class="form-control validate[required]" id="cooperativeID" name="cooperativeID" value="<?= $encrypted_id ?>">
                    <input type="hidden" class="form-control validate[required]" id="status" name="status" value="<?= encrypt_custom($this->encryption->encrypt($branch_info->status))?>">
                    <?php if($is_client) : ?>
                    <input type="hidden" class="form-control validate[required]" id="userID" name="userID" value="<?= $encrypted_user_id ?>">
                    <?php endif; ?>
                  </div>
              </div>
<!--              <div class="col-sm-12 col-md-3">
                <div class="form-group">
                  <label for="categoryOfCooperative">Category of Cooperative:</label>
                  <select class="custom-select validate[required]" name="categoryOfCooperative" id="categoryOfCooperative">
                    <option value="">--</option>
                    <option value="Primary" <?php if($branch_info->category_of_cooperative=="Primary") echo "selected";?>>Primary</option>
                    <option value="Secondary - Union" <?php if($branch_info->category_of_cooperative=="Secondary" && $branch_info->grouping=="Union") echo "selected";?>>Secondary - Union</option>
                    <option value="Tertiary - Union" <?php if($branch_info->category_of_cooperative=="Tertiary" && $branch_info->grouping=="Union") echo "selected";?>>Tertiary - Union</option>
                    <option value="Secondary - Federation" <?php if($branch_info->category_of_cooperative=="Secondary" && $branch_info->grouping=="Federation") echo "selected";?>>Secondary - Federation</option>
                    <option value="Tertiary - Federation" <?php if($branch_info->category_of_cooperative=="Tertiary" && $branch_info->grouping=="Federation") echo "selected";?>>Tertiary - Federation</option>
                  </select>
                </div>
              </div>-->
            </div>
              <select class="custom-select validate[required]" name="typeOfCooperative" id="typeOfCooperative">
                <option value="">--</option>
                <option value="7" <?php if($registered_info->type =="Advocacy") echo "selected"; ?>>Advocacy</option>
                <option value="8" <?php if($registered_info->type =="Agrarian Reform") echo "selected"; ?>>Agrarian Reform</option>
                <option value="24" <?php if($registered_info->type =="Agriculture") echo "selected"; ?>>Agriculture</option>
                <option value="9" <?php if($registered_info->type =="Bank") echo "selected"; ?>>Bank</option>
                <option value="4" <?php if($registered_info->type =="Consumers") echo "selected"; ?>>Consumers</option>
                <option value="1" <?php if($registered_info->type =="Credit") echo "selected"; ?>>Credit</option>
                <option value="10" <?php if($registered_info->type =="Dairy") echo "selected"; ?>>Dairy</option>
                <option value="11" <?php if($registered_info->type =="Education") echo "selected"; ?>>Education</option>
                <option value="12" <?php if($registered_info->type =="Electric") echo "selected"; ?>>Electric</option>
                <option value="13" <?php if($registered_info->type =="Financial Service") echo "selected"; ?>>Financial Service</option>
                <option value="14" <?php if($registered_info->type =="Fishermen") echo "selected"; ?>>Fishermen</option>
                <option value="15" <?php if($registered_info->type =="Health Service") echo "selected"; ?>>Health Service</option>
                <option value="20" <?php if($registered_info->type =="Housing") echo "selected"; ?>>Housing</option>
                <option value="16" <?php if($registered_info->type =="Insurance") echo "selected"; ?>>Insurance</option>
                <option value="21" <?php if($registered_info->type =="Labor Service") echo "selected"; ?>>Labor Service</option>
                <option value="5" <?php if($registered_info->type =="Marketing") echo "selected"; ?>>Marketing</option>
                <option value="2" <?php if($registered_info->type =="Producers") echo "selected"; ?>>Producers</option>
                <option value="22" <?php if($registered_info->type =="Professionals") echo "selected"; ?>>Professionals</option>
                <option value="3" <?php if($registered_info->type =="Service") echo "selected"; ?>>Service</option>
                <option value="23" <?php if($registered_info->type =="Small Scale Mining") echo "selected"; ?>>Small Scale Mining</option>
                <option value="17" <?php if($registered_info->type =="Transport") echo "selected"; ?>>Transport</option>
                <option value="18" <?php if($registered_info->type =="Water Service") echo "selected"; ?>>Water Service</option>
                <option value="19" <?php if($registered_info->type =="Workers") echo "selected"; ?>>Workers</option>
              </select>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name of Cooperative</label>
                  <input class="form-control" value="<?=$branch_info->coopName?>" disabled="">
                </div>
              </div>
            </div>
              <?php
              if($branch_info->status == 17){
                  $disabledtype = 'readonly';
              } else {
                  $disabledtype = '';
              }
              ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Type</label>
                    <select class="custom-select validate[required]" name="typeOfbranchsatellite" id="typeOfbranchsatellite" >
                    <?php   
                    if($branch_info->status == 17)
                    {
                      ?>
                      
                      <?php if($branch_info->type =="Branch"){?> 
                      <option value="Branch" selected <?=$disabledtype?>>Branch</option>
                      <?php } ?>

                      <?php if($branch_info->type =="Satellite"){?>
                      <option value="Satellite" selected <?=$disabledtype?> >Satellite</option>
                     <?php }?>

                   
                    <?php }else{?>
                          <option value="">--</option>
                          <option value="Branch" <?=($branch_info->type =="Branch" ? "selected" :"")?> <?=$disabledtype?>>Branch</option>
                          <option value="Satellite" <?php ($branch_info->type =="Satellite" ? "selected" :"") ?> <?=$disabledtype?>>Satellite</option>
                    <?php } //end if == 17?>

                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12 col-industry-subclass">
                <?php foreach($major_industry_list as $key => $major_industry) : ?>
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                      <?php if($key>=1) :?>
                        <a class="customDeleleBtn businessActivityRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                      <?php endif; ?>
                      <label for="majorIndustry">Major Industry Classification No. <?= ($key+1)?></label>
                      <select class="custom-select form-control  validate[required]" name="majorIndustry[]" id="majorIndustry<?= ($key+1)?>" disabled="">
                        <option value=""></option>
                        <?php foreach($major_industries_by_coop_type as $key2 => $major_industry_single) : ?>
                          <option value="<?= $major_industry_single['id']?>" <?php if($major_industry_single['id'] == $major_industry['id']) echo "selected";?>><?= $major_industry_single['description']?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                      <label for="subClass<?= ($key+1)?>">Major Industry Classification No. <?= ($key+1)?> Subclass</label>
                      <select class="custom-select form-control validate[required]" name="subClass[]" disabled="">
                        <option value=""></option>
                        <?php foreach($major_industry_list as $key2 => $row) : ?>
                          <option value="<?= $row['subclassid']?>" <?php if($row['subclassid'] == $major_industry['subclassid']) echo "selected";?>><?= $row['subclassdesc']?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
<!--            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="proposedName"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top"
                  data-html="true" title="<li>Don't include the type of your cooperative in your proposed name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Proposed Name:</label>
                 
                    <input type="text" class="form-control validate[required,funcCall[validateActivityNotNullUpdateCustom], funcCall[validateActivityInNameUpdateCustom],  <?php echo ($branch_info->status >0) ? "ajax[ajaxCoopNameUpdateCallPhp]" : "ajax[ajaxCoopNameExpiredCallPhp]";?>]" name="proposedName" id="proposedName" placeholder="" value="<?php if($branch_info->status > 0) : ?><?=$branch_info->brgy.', '. $branch_info->city.$branch_info->branchName;?> <?php endif;?>" disabled="">
                </div>
              </div>
            </div>-->
              <input type="hidden" id="areaOfOperation" name="areaOfOperation" value="<?=$branch_info->area_of_operation?>">
<!--            <div class="row rd-row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="areaOfOperation">Area of Operation </label>
                  <select class="custom-select validate[required]" name="areaOfOperation" id="areaOfOperation">
                    <option value="Barangay" <?php if($branch_info->area_of_operation =="Barangay") echo "selected"; ?>>Barangay</option>
                    <option value="Municipality/City" <?php if($branch_info->area_of_operation =="Municipality/City") echo "selected"; ?>>Municipality/City</option>
                    <option value="Provincial" <?php if($branch_info->area_of_operation =="Provincial") echo "selected"; ?>>Provincial</option>
                    <option value="Regional" <?php if($branch_info->area_of_operation =="Regional") echo "selected"; ?>>Regional</option>
                    <option value="National" <?php if($branch_info->area_of_operation =="National") echo "selected"; ?>>National</option>
                  </select>
                </div>
              </div>
            </div>-->
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Proposed Address of the Cooperative</strong>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="blkNo">House/Lot & Blk No.</label>
                  <input type="text" class="form-control" name="blkNo" id="blkNo" placeholder="" value="<?=$branch_info->house_blk_no?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="streetName">Street Name</label>
                  <input type="text" class="form-control" name="streetName" id="streetName" placeholder="" value="<?=$branch_info->street?>">
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
                <input type="hidden" class="custom-select validate[required]" name="region2" id="region">
                
             <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="province">Province</label>
                  <select class="custom-select" name="province" id="province">
                  </select>
                </div>
              </div>
              
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="city">City/Municipality</label>
                  <select class="custom-select" name="city" id="city">
                  </select>
                </div>
              </div>
           
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                   <label for="barangay">Barangay</label>
                        <input type="hidden" class="custom-select validate[required]" name="barangay2" id="barangay2">
                        <input type="hidden" class="custom-select validate[required]" name="barangay" id="barangay2">
                        <select class="custom-select" name="barangay" id="barangay">
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 offset-md-1 col-md-10 align-self-end">
            <div class="form-group">
              <div class="custom-control custom-checkbox text-center mt-2">
                <input type="checkbox" class="custom-control-input" id="reserveUpdateAgree" name="reserveUpdateAgree">
                <label class="custom-control-label" for="reserveUpdateAgree"><p>I have read and agreed to our Terms and Conditions.</p></label>
                <!--  The applicant fully understands that this application for name reservation is subject to change in accordance with pertinent CDA guildelines when presented at any CDA Extension Office.The applicant should also note that FOUR (4) days from the date of online application, the applicant MUST visit any regional offices for name reservation.-->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-12 offset-md-10 col-md-2 align-self-center order-sm-2 order-1 col-reserveupdate-btn">
              <input class="btn btn-block btn-color-blue" type="submit" id="reserveBranchUpdateBtn" name="reserveBranchUpdateBtn" value="Submit" disabled>
          </div>
        </div>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>

$(document).ready(function() {

var title = "opt1";

$("#typeOfCooperative").hide();

});

</script>