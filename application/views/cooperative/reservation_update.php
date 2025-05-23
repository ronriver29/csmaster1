<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.css')?>" type="text/css"/>
<link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css')?>" type="text/css"/>
<div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>cooperatives/<?=$encrypted_id?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
  </div>
</div>
<?php if($coop_info->status == 0) :?>
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
      <?php echo form_open('cooperatives/'.$encrypted_id.'/rupdate',array('id'=>'reserveUpdateForm','name'=>'reserveUpdateForm')); ?>
      <div class="card-header">
        <div class="row">
          <div class="col-sm-6 col-md-6">
            <h4>Cooperative Update Form</h4>
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
                    <input type="hidden" class="form-control validate[required]" id="status" name="status" value="<?= encrypt_custom($this->encryption->encrypt($coop_info->status))?>">
                    <?php if($is_client) : ?>
                    <input type="hidden" class="form-control validate[required]" id="userID" name="userID" value="<?= $encrypted_user_id ?>">
                    <?php endif; ?>
                  </div>
              </div>
              <div class="col-sm-12 col-md-12">
                <label>
                  Youth Cooperative? &nbsp;&nbsp;
                  <input type="checkbox" id="is_youth" name="is_youth" <?php if($coop_info->is_youth == 1) echo 'checked'; ?> value="1">
                  Yes
                </label>
              </div>
              <div class="col-sm-12 col-md-3">
                <div class="form-group">
                  <label for="categoryOfCooperative">Category of Cooperative:</label>
                  <select class="custom-select validate[required]" name="categoryOfCooperative" id="categoryOfCooperative">
                    <option value="">--</option>
                    <option value="Primary" <?php if($coop_info->category_of_cooperative=="Primary") echo "selected";?>>Primary</option>
                    <!-- <option value="Tertiary - Union" <?php if($coop_info->category_of_cooperative=="Tertiary" && $coop_info->grouping=="Union") echo "selected";?>>Tertiary - Union</option> -->
                     <option value="Secondary - Federation" <?php if($coop_info->category_of_cooperative=="Secondary" && $coop_info->grouping=="Federation") echo "selected";?>>Secondary</option>
                    <option value="Tertiary - Federation" <?php if($coop_info->category_of_cooperative=="Tertiary" && $coop_info->grouping=="Federation") echo "selected";?>>Tertiary</option>  
                    <option value="Secondary - Union" <?php if($coop_info->category_of_cooperative=="Secondary" && $coop_info->grouping=="Union") echo "selected";?>>Others</option> 
                    
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
                    <option value="7" <?php if($coop_info->type_of_cooperative =="Advocacy") echo "selected"; ?>>Advocacy</option>
                    <option value="8" <?php if($coop_info->type_of_cooperative =="Agrarian Reform") echo "selected"; ?>>Agrarian Reform</option>
                    <option value="24" <?php if($coop_info->type_of_cooperative =="Agriculture") echo "selected"; ?>>Agriculture</option>
                    <!-- <option value="9" <?php if($coop_info->type_of_cooperative =="Bank") echo "selected"; ?>>Bank</option> -->
                    <option value="4" <?php if($coop_info->type_of_cooperative =="Consumers") echo "selected"; ?>>Consumers</option>
                    <!-- <option value="27" <?php if($coop_info->type_of_cooperative =="Cooperative Bank") echo "selected"; ?>>Cooperative Bank</option> -->
                    <option value="1" <?php if($coop_info->type_of_cooperative =="Credit") echo "selected"; ?>>Credit</option>
                    <option value="10" <?php if($coop_info->type_of_cooperative =="Dairy") echo "selected"; ?>>Dairy</option>
                    <option value="11" <?php if($coop_info->type_of_cooperative =="Education") echo "selected"; ?>>Education</option>
                    <option value="12" <?php if($coop_info->type_of_cooperative =="Electric") echo "selected"; ?>>Electric</option>
                    <!-- <option value="25" <?php if($coop_info->type_of_cooperative =="Federation") echo "selected"; ?>>Federation</option> -->
                    <option value="13" <?php if($coop_info->type_of_cooperative =="Financial Service") echo "selected"; ?>>Financial Service</option>
                    <option value="14" <?php if($coop_info->type_of_cooperative =="Fishermen") echo "selected"; ?>>Fishermen</option>
                    <option value="15" <?php if($coop_info->type_of_cooperative =="Health Service") echo "selected"; ?>>Health Service</option>
                    <option value="20" <?php if($coop_info->type_of_cooperative =="Housing") echo "selected"; ?>>Housing</option>
                    <!-- <option value="16" <?php if($coop_info->type_of_cooperative =="Insurance") echo "selected"; ?>>Insurance</option> -->
                    <option value="21" <?php if($coop_info->type_of_cooperative =="Labor Service") echo "selected"; ?>>Labor Service</option>
                    <option value="5" <?php if($coop_info->type_of_cooperative =="Marketing") echo "selected"; ?>>Marketing</option>
                    <option value="2" <?php if($coop_info->type_of_cooperative =="Producers") echo "selected"; ?>>Producers</option>
                    <option value="22" <?php if($coop_info->type_of_cooperative =="Professionals") echo "selected"; ?>>Professionals</option>
                    <option value="3" <?php if($coop_info->type_of_cooperative =="Service") echo "selected"; ?>>Service</option>
                    <option value="23" <?php if($coop_info->type_of_cooperative =="Small Scale Mining") echo "selected"; ?>>Small Scale Mining</option>
                    <option value="17" <?php if($coop_info->type_of_cooperative =="Transport") echo "selected"; ?>>Transport</option>
                    <option value="26" <?php if($coop_info->type_of_cooperative =="Union") echo "selected"; ?>>Union</option>
                    <option value="28" <?php if($coop_info->type_of_cooperative =="Technology Service") echo "selected"; ?>>Technology Service</option>
                    <option value="18" <?php if($coop_info->type_of_cooperative =="Water Service") echo "selected"; ?>>Water Service</option>
                    <option value="19" <?php if($coop_info->type_of_cooperative =="Workers") echo "selected"; ?>>Workers</option>
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
                      <label for="majorIndustry" id="majorlabel">Major Industry Classification No. <?= ($key+1)?></label>
                      <select class="custom-select form-control  validate[required]" name="majorIndustry[]" id="majorIndustry<?= ($key+1)?>">
                        <option value=""></option>
                        <?php foreach($major_industries_by_coop_type as $key2 => $major_industry_single) : ?>
                          <option value="<?= $major_industry_single['id']?>" <?php if($major_industry_single['id'] == $major_industry['id']) echo "selected";?>><?= $major_industry_single['description']?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                      <label for="subClass<?= ($key+1)?>" id="subclasslabel">Major Industry Classification No. <?= ($key+1)?> Subclass</label>
                      <select class="custom-select form-control validate[required]" name="subClass[]" id="subClass<?= ($key+1)?>">
                      </select>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 offset-md-9 col-md-3">
                <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreSubclassBtn"><i class="fas fa-plus"></i> Add More Business Activity</button>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="proposedName"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top"
                  data-html="true" title="<li>Don't include the type of your cooperative in your proposed name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Proposed Name:</label>
                  <input type="text" class="form-control validate[required,funcCall[validateActivityNotNullUpdateCustom],funcCall[validateCooperativeWordInNameCustom], funcCall[validateActivityInNameUpdateCustom],<?php echo ($coop_info->status > 0) ? "ajax[ajaxCoopNameUpdateCallPhp]" : "ajax[ajaxCoopNameExpiredCallPhp]";?>]" name="proposedName" id="proposedName" placeholder="" value="<?php if($coop_info->status > 0) : ?><?= $coop_info->proposed_name;?> <?php endif;?>">
                  <div style="margin-bottom:20px;"> <small><span id="type_of_coop" style="margin-top:-20px;"></span></small> </div>
                   <div style="margin-bottom:20px;"><small>
                  <span id="proposed_name_msg" style="margin-top:-20px;font-style:italic;"></span></small></div>
                </div>
              </div>
            </div>
<!--              <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="proposedName"><i class="fas fa-info-user"  data-toggle="tooltip" data-placement="top"
                  data-html="true" title="<li>Don't include the type of your cooperative in your proposed name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Proposed Name:</label>
                  <input type="text" class="form-control validate[required,funcCall[validateActivityNotNullAddCustom],funcCall[validateActivityInNameAddCustom],funcCall[validateCooperativeWordInNameCustom],ajax[ajaxCoopNameCallPhp]]" name="proposedName" id="proposedName" placeholder="" disabled>
                </div>
              </div>
            </div>-->
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="acronymofCooperative"><i class="fas fa-info-user"  data-toggle="tooltip" data-placement="top"
                  data-html="true" title="<li>Don't include the type of your cooperative in your proposed name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Acronym of Cooperative Name:</label>
                  <input type="text" class="form-control" value="<?php if(!empty($coop_info->acronym_name)){ echo $coop_info->acronym_name; } else echo ""; ?>" name="acronym_name" id="acronymname" placeholder="(Optional)">
                  <label id="acronymnameerr" style="color:red;font-size:80%;"><i>* Acronym Name has been disabled. Maximum Character reach on "Proposed Name".</i></label>
                </div>
              </div>
            </div>
            <div class="row rd-row">
              <div class="col-sm-12 col-md-6" id='commonbond'>
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
                  <input type="hidden" class="form-control validate[required]" id="areaOfOperation2" name="areaOfOperation2" value="<?= $coop_info->area_of_operation ?>">
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
                    <?php
                    if(strpos($coop_info->interregional, '1') !== false) {
                        $luzon = 'selected';
                    } else {
                      $luzon = '';
                    }
                    if(strpos($coop_info->interregional, '2') !== false) {
                        $visayas = 'selected';
                    } else {
                      $visayas = '';
                    }
                    if(strpos($coop_info->interregional, '3') !== false) {
                        $mindanao = 'selected';
                    } else {
                      $mindanao = '';
                    }
                    ?>

                    <option class="opt" value="1" <?=$luzon?>>Luzon</option>
                    <option class="opt" value="2" <?=$visayas?>>Visayas</option>
                    <option class="opt" value="3" <?=$mindanao?>>Mindanao</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-8">
                <div class="form-group" id="allregions">
                  <label for="selectregion" id="selectregion">Select a Regions</label>
                  <select class="form-control validate[required] select2 select-region" name="regions[]" id="regions" multiple="">
                    <?php foreach ($regions_island_list as $region_island_list) : ?>

                      <?php if(strpos($coop_info->regions, $region_island_list['region_code']) !== false){
                        $selected = 'selected';
                      } else {
                        $selected = '';
                      }

                      ?>
                      <option value ="<?php echo $region_island_list['region_code'];?>" <?=$selected?>><?php echo $region_island_list['regDesc']?></option>
                      }
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <!-- <div class="col-sm-12 col-md-10">
                <div class="form-group">
                  <label for="areaOfOperation">Select a Island </label>
                  <select name="interregional[]" class="form-control" multiple="">
                    <option value="1">Luzon</option>
                    <option value="2">Visayas</option>
                    <option value="3">Mindanao</option>
                  </select>
                </div>
              </div> -->
            </div>
            <div class="row rd-row">
              <div class="col-sm-12 col-md-10 col-com">
                    
                            <label for="compositionOfMembers1" id="fieldmembershipname">Field of Membership <i>(Note: Employees/Retirees)</i></label>
                            <label for="compositionOfMembers1" id="fieldmembershipmemofficname">Field of Membership <i>(Note: Members, Officers)</i></label>
                            <input type="text" class="form-control" name="field_membership" id="field_membership" value="<?=$coop_info->field_of_membership?>">
                            <label for="compositionOfMembers1" id="name_institution_label">Name of Institution</label>
                            <label for="compositionOfMembers1" id="name_associational_label">Name of Association</label>
                        <?php

                            foreach($inssoc as $key=> $insoc){
                              // if($insoc!=" " && $insoc!="")
                              // {
                                echo '<div class="ins-div"><input type="text" class="form-control" name="name_institution[]" id="name_institution" value="'.$insoc.'"><br>';
                                 if($key>0)
                                  {
                                    echo'<a id="remove_ins" class="customDeleleBtn institutionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a></div>';
                                  }
                                  else
                                  {
                                    echo"</div>";
                                  }
                              // }

                            }
                        ?>
                            <label for="compositionOfMembers" id="composition_of_members_label">Composition of Members </label> 
                            
                            <?php if(empty($members_composition)) {?>
                            <select class="custom-select" name="compositionOfMembers[]" id="compositionOfMembers1">
                                <option value="" selected></option>
                                <?php
                                  foreach ($composition as $key) {
                                    echo '<option value="'.$key->composition.'">'.$key->composition.'</option>';
                                  }
                                ?>
                              </select>
                            <?php } ?>
                            <?php $no=0;
                              foreach($members_composition as $key){


                                echo '<div class="form-group">

                                <table>
                                  <tr>
                                    <td><select class="custom-select form-control  validate[required]" name="compositionOfMembers[]" id="compositionOfMembers'.++$no.'">
                                        <option value=""></option>';
                                        foreach($composition as $key2){
                                          echo '<option value="'.$key2->composition;
                                          if ($key['composition']==$key2->composition)
                                            echo '" selected>';
                                          else
                                            echo '">';
                                          echo $key2->composition.'</option>';}

                                        echo '</select>
                                    </td>
                                    <td><a class="customDeleleBtn compositionRemoveBtn float-right text-danger"  onclick="$(this).parent().parent().remove()"><i class="fas fa-minus-circle"></i></a>
                                    </td>
                                  </tr>
                                </table>                     

                            </div>';
                          } 
              ?>
                
              </div>
            </div>
          </div>

          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-10">
                <div class="form-group">
                    <button type="button" class="btn btn-success btn-sm float-right" id="addMoreInsBtn"><i class="fas fa-plus"></i> Add Additional Name</button>
                    <button type="button" class="btn btn-success btn-sm float-right" id="addMoreComBtn"><i class="fas fa-plus"></i> Add Composition of Members</button>
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
                      <option value ="<?php echo $region_list['regCode'];?>" <?=($coop_info->rCode == $region_list['regCode'] ? 'selected' : '')?>><?php echo $region_list['regDesc']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
                 <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="province">Province</label>
                  <!-- <select class="custom-select validate[required]" name="province" id="province" disabled>
                  </select> -->
                  <select class="custom-select validate[required]" name="province" id="province">
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
                  <select class="custom-select validate[required]" name="city" id="city">
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
                  <select class="custom-select validate[required]" name="barangay" id="barangay">
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
              </div>
            </div>
          </div>
            <?php if($is_client): ?>
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
              <input class="btn btn-block btn-color-blue" type="submit" id="reserveUpdateBtn" name="reserveUpdateBtn" value="Submit" disabled>
              <?php endif;?>
          </div>
        </div>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<style type="text/css">input{border:1px solid red;}</style>
<script src="<?=base_url('assets/plugins/select2/js/select2.full.min.js')?>"></script>