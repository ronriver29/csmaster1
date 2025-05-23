<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.css')?>" type="text/css"/>
<link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css')?>" type="text/css"/>
<div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>cooperatives_update/<?=$encrypted_id?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
<?php if($this->session->flashdata('cooperative_update_msg')) :?>       
       <div class="alert alert-<?=$this->session->flashdata('msg_class')?> alert-dismissible">
         <button type = "button" class="close" data-dismiss = "alert">x</button>
         <?=$this->session->flashdata('cooperative_update_msg')?>
       </div>
   <?php endif; ?>
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
      <?php // if($is_client){?>
        <?php // echo form_open('cooperatives_update/update',array('id'=>'updatereserveUpdateForm','name'=>'updatereserveUpdateForm')); ?>
      <?php // } else {?>
        <?php echo form_open('cooperatives_update/'.$encrypted_id.'/rupdate',array('id'=>'reserveUpdateForm','name'=>'reserveUpdateForm')); ?>
      <?php // }?>
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
                  
                    <?php /* if($is_client) : ?>
                    <input type="hidden" class="form-control validate[required]" id="userID" name="userID" value="<?= $encrypted_user_id ?>">
                    <?php endif; */ ?>
                  </div>
              </div>
              <div class="col-sm-12 col-md-3">
                <div class="form-group">
                  <label for="categoryOfCooperative">Category of Cooperative:</label>
                  <select class="custom-select validate[required]" name="categoryOfCooperative" id="categoryOfCooperative">
                    <option value="">--</option>
                    <option value="Primary" <?php if($coop_info->category_of_cooperative=="Primary") echo "Selected='selected'";?>>Primary</option>
                    <!-- <option value="Tertiary - Union" <?php if($coop_info->category_of_cooperative=="Tertiary" && $coop_info->grouping=="Union") echo "Selected='selected'";?>>Tertiary - Union</option> -->
                     <option value="Secondary - Federation" <?php if(($coop_info->category_of_cooperative=="Secondary" && $coop_info->grouping=="Federation"))echo "Selected='selected'";?>>Secondary</option>
                    <option value="Tertiary - Federation" <?php if(($coop_info->category_of_cooperative=="Tertiary" && $coop_info->grouping=="Federation")) echo "Selected='selected'";?>>Tertiary</option>
                    <option value="Secondary - Union" <?php if($coop_info->category_of_cooperative=="Secondary" && $coop_info->grouping=="Union") echo "Selected='selected'";?>>Others</option> 
                    
                  </select>
                </div>
              </div>
            </div>

          <?php 
          // if(strpos($coop_info->type_of_cooperative, ',') !== false){
          //   echo 'Found';
          // } else {
          //   echo 'Not Found';
          // }
          if($coop_info->type_of_cooperative != 'Multipurpose' && strpos($coop_info->type_of_cooperative, ',') === false ){?>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="typeOfCooperative">Type of Cooperative</label>
                  <select class="custom-select validate[required]" name="typeOfCooperative" id="typeOfCooperative">
                    <option value="">--</option>
                    <option value="7" <?php if($coop_info->type_of_cooperative =="Advocacy") echo "Selected='selected'"; ?>>Advocacy</option>
                    <option value="8" <?php if($coop_info->type_of_cooperative =="Agrarian Reform") echo "Selected='selected'"; ?>>Agrarian Reform</option>
                    <option value="24" <?php if($coop_info->type_of_cooperative =="Agriculture") echo "Selected='selected'"; ?>>Agriculture</option>
                    <!-- <option value="9" <?php if($coop_info->type_of_cooperative =="Bank") echo "Selected='selected'"; ?>>Bank</option> -->
                    <option value="4" <?php if($coop_info->type_of_cooperative =="Consumers") echo "Selected='selected'"; ?>>Consumers</option>
                    <option value="27" <?php if($coop_info->type_of_cooperative =="Cooperative Bank") echo "Selected='selected'"; ?>>Bank</option>
                    <option value="1" <?php if($coop_info->type_of_cooperative =="Credit") echo "Selected='selected'"; ?>>Credit</option>
                    <option value="10" <?php if($coop_info->type_of_cooperative =="Dairy") echo "Selected='selected'"; ?>>Dairy</option>
                    <option value="11" <?php if($coop_info->type_of_cooperative =="Education") echo "Selected='selected'"; ?>>Education</option>
                    <option value="12" <?php if($coop_info->type_of_cooperative =="Electric") echo "Selected='selected'"; ?>>Electric</option>
                    <!-- <option value="25" <?php if($coop_info->type_of_cooperative =="Federation") echo "Selected='selected'"; ?>>Federation</option> -->
                    <option value="13" <?php if($coop_info->type_of_cooperative =="Financial Service") echo "Selected='selected'"; ?>>Financial Service</option>
                    <option value="14" <?php if($coop_info->type_of_cooperative =="Fishermen") echo "Selected='selected'"; ?>>Fishermen</option>
                    <option value="15" <?php if($coop_info->type_of_cooperative =="Health Service") echo "Selected='selected'"; ?>>Health Service</option>
                    <option value="20" <?php if($coop_info->type_of_cooperative =="Housing") echo "Selected='selected'"; ?>>Housing</option>
                    <option value="16" <?php if($coop_info->type_of_cooperative =="Insurance") echo "Selected='selected'"; ?>>Insurance</option>
                    <option value="21" <?php if($coop_info->type_of_cooperative =="Labor Service") echo "Selected='selected'"; ?>>Labor Service</option>
                    <option value="5" <?php if($coop_info->type_of_cooperative =="Marketing") echo "Selected='selected'"; ?>>Marketing</option>
                    <option value="2" <?php if($coop_info->type_of_cooperative =="Producers") echo "Selected='selected'"; ?>>Producers</option>
                    <option value="22" <?php if($coop_info->type_of_cooperative =="Professionals") echo "Selected='selected'"; ?>>Professionals</option>
                    <option value="3" <?php if($coop_info->type_of_cooperative =="Service") echo "Selected='selected'"; ?>>Service</option>
                    <option value="23" <?php if($coop_info->type_of_cooperative =="Small Scale Mining") echo "Selected='selected'"; ?>>Small Scale Mining</option>
                    <option value="17" <?php if($coop_info->type_of_cooperative =="Transport") echo "Selected='selected'"; ?>>Transport</option>
                    <option value="26" <?php if($coop_info->type_of_cooperative =="Union") echo "Selected='selected'"; ?>>Union</option>
                    <option value="18" <?php if($coop_info->type_of_cooperative =="Water Service") echo "Selected='selected'"; ?>>Water Service</option>
                    <option value="19" <?php if($coop_info->type_of_cooperative =="Workers") echo "Selected='selected'"; ?>>Workers</option>
                  </select>
                </div>
              </div>
            </div>
          <?php } else {?>
            <div class="row type-coop-row">
              <div class="col-sm-12 col-md-6 coop-col">
                <div class="form-group">
                  <label for="typeOfCooperative1">Type of Cooperative</label>
                  
                  <?php
                  $count_coop_type = count($amd_type_of_coop);
                  $indx = 1;
                  foreach($amd_type_of_coop as $row_type)
                  {
                  ?>
                  <div class="list_cooptype">
                    <select class="custom-select coop-type" name="typeOfCooperative[]" id="typeOfCooperatives<?=$indx++?>">
                       <option value=""> </option>
                      <?php
                      foreach($list_type_coop as $coop)
                      {
                        $selected ='';
                        if($coop['name'] == $row_type)
                        {
                        $selected = 'selected';
                        }
                        ?>
                      <option value="<?=$coop['id']?>" <?=$selected?>><?=$coop['name']?></option>
                      <?php
                      }
                      ?>
                    </select>
                    <?php if( $count_coop_type >1):?>
                    <a class="customDeleleBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                    <?php endif;?>
                  </div>
                  <?php
                  }
                  ?>
                </div>
              <div class="coop_type-wrapper" id="coop_type-wrapper"></div>
            </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <button type="button"  class="btn btn-success btn-sm float-right" id="addCoop"><i class="fas fa-plus"></i> Add Cooperative Type</button>
                </div>
              </div>
            </div>
          <?php } ?>
          <?php if($coop_info->type_of_cooperative != 'Multipurpose' && strpos($coop_info->type_of_cooperative, ',') === false ){ ?>
            <div class="row">
              <div class="col-sm-12 col-md-12 col-industry-subclass">
                <?php if(isset($business_activity)) : ?>
                  <?php if(count($business_activity)>0) : ?>
                      <?php foreach($business_activity as $key => $major_industry) : ?>
                     
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <div class="form-group">
                            <?php if($key>=1) :?>
                              <a class="customDeleleBtn businessActivityRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                            <?php endif; ?>
                            <label for="majorIndustry" id="majorlabel">Major Industry Classification No. <?= ($key+1)?></label>
                            <select class="custom-select form-control" name="majorIndustry[]" id="majorIndustry<?= ($key+1)?>">
                              <option value=""></option>
                              <?php foreach($major_industries_by_coop_type as $key2 => $major_industry_single) : ?>
                                <option value="<?= $major_industry_single['id']?>" <?=($major_industry_single['id'] == $major_industry['bactivity_id'] ? 'selected' : '')?>><?= $major_industry_single['description']?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                          <div class="form-group">
                            <label for="subClass<?= ($key+1)?>" id="subclasslabel">Major Industry Classification No. <?= ($key+1)?> Subclass</label>
                            <select class="custom-select form-control" name="subClass[]" id="subClass<?= ($key+1)?>">
                              <?php 
                              foreach($major_industries_subclass as $subclass_list){?>
                              <option value="<?=$subclass_list['id']?>" <?=($major_industry['bactivitysubtype_id'] == $subclass_list['id'] ? 'selected' :'')?>><?=$subclass_list['description']?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                  <?php elseif($coop_info->type_of_cooperative != 'Multipurpose' && strpos($coop_info->type_of_cooperative, ',') === false ) : ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <div class="form-group">
                            <label for="majorIndustry1" id="majorlabel">Major Industry Classification No. 1</label>
                            <select class="custom-select form-control" name="majorIndustry[]" id="majorIndustry1">
                            
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                          <div class="form-group">
                            <label for="subClass1" id="subclasslabel">Major Industry Classification No. 1 Subclass</label>
                            <select class="custom-select form-control" name="subClass[]" id="subClass1" disabled>
                              
                            </select>
                          </div>
                        </div>
                      </div>
                  <?php else : ?> 
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                        <div class="row-cis">

                          
                        </div>
                      </div>
                    </div> 
                        
                  <?php endif; ?>  
                <?php else: ?> 
                  <div class="row">
                    <div class="col-sm-12 col-md-12">
                      <div class="form-group">
                        <label for="majorIndustry1" id="majorlabel">Major Industry Classification No. 1</label>
                        <select class="custom-select form-control" name="majorIndustry[]" id="majorIndustry1">
                        
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                      <div class="form-group">
                        <label for="subClass1" id="subclasslabel">Major Industry Classification No. 1 Subclass</label>
                        <select class="custom-select form-control" name="subClass[]" id="subClass1" disabled>
                          
                        </select>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>  
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 offset-md-9 col-md-3">
                <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreSubclassBtn"><i class="fas fa-plus"></i> Add More Business Activity</button>
              </div>
            </div>
          <?php } else { //echo '<pre>';echo print_r($business_activity); echo '</pre>';?>

            <div class="row">
              <div class="col-sm-12 col-md-12 col-industry-subclass">
                <?php if(isset($business_activity)) : ?>
                  <?php if(count($business_activity)>0) : ?>
                    <?php 
                      // echo '<pre>';
                      // echo print_r($business_activity);
                      // echo '</pre>';
                      // echo '<pre>';
                      // echo print_r($major_industries_by_coop_type);
                      // echo '</pre>';
                    ?>
                      <?php foreach($business_activity as $key => $major_industry) : ?>
                     
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <div class="form-group">
                            <?php if($key>=1) :?>
                              <a class="customDeleteBtn businessActivityRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                            <?php endif; ?>
                            <label for="majorIndustry<?= ($key+1)?>" id="majorlabel">Major Industry Classification No. <?= ($key+1)?></label>
                            <select class="custom-select form-control major-type" name="majorIndustry[<?= ($key+1)?>][major_id]" id="majorIndustry<?= ($key+1)?>">
                              <?php 
                              foreach($major_industries_by_coop_type as $major_industry_single){?>
                              <option value="<?=$major_industry_single['id']?>" <?=($major_industry['bactivity_id'] == $major_industry_single['id'] ? 'selected' :'')?>><?=$major_industry_single['description']?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                          <div class="form-group">
                            <label for="subClass<?= ($key+1)?>" id="subclasslabel">Major Industry Classification No. <?= ($key+1)?> Subclass</label>
                            <select class="custom-select form-control" name="majorIndustry[<?= ($key+1)?>][subclass_id]" id="subClass<?= ($key+1)?>">
                              <?php 
                              foreach($major_industries_subclass as $subclass_list){?>
                              <option value="<?=$subclass_list['id']?>" <?=($major_industry['bactivitysubtype_id'] == $subclass_list['id'] ? 'selected' :'')?>><?=$subclass_list['description']?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                  <?php elseif($coop_info->type_of_cooperative != 'Multipurpose' && strpos($coop_info->type_of_cooperative, ',') === false ) : ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <div class="form-group">
                            <label for="majorIndustry1" id="majorlabel">Major Industry Classification No. 1</label>
                            <select class="custom-select form-control" name="majorIndustry[]" id="majorIndustry1">
                            
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                          <div class="form-group">
                            <label for="subClass1" id="subclasslabel">Major Industry Classification No. 1 Subclass</label>
                            <select class="custom-select form-control" name="subClass[]" id="subClass1" disabled>
                              
                            </select>
                          </div>
                        </div>
                      </div>
                  <?php else : ?> 
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                        <!-- <input type="hidden" value=""> -->
                        <div class="row-cis">

                          
                        </div>
                      </div>
                    </div> 
                        
                  <?php endif; ?>  
                <?php else: ?> 
                  <div class="row">
                    <div class="col-sm-12 col-md-12">
                      <div class="form-group">
                        <label for="majorIndustry1" id="majorlabel">Major Industry Classification No. 1</label>
                        <select class="custom-select form-control" name="majorIndustry[]" id="majorIndustry1">
                        
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                      <div class="form-group">
                        <label for="subClass1" id="subclasslabel">Major Industry Classification No. 1 Subclass</label>
                        <select class="custom-select form-control" name="subClass[]" id="subClass1" disabled>
                          
                        </select>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>  
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 offset-md-9 col-md-3">
                <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreSubclassBtn"><i class="fas fa-plus"></i> Add More Business Activity</button>
              </div>
            </div>

          <?php } ?>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="proposedName"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top"
                  data-html="true" title="<li>Don't include the type of your cooperative in your proposed name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Proposed Name:</label>
                  <input type="text" class="form-control validate[required]" name="proposedName" id="proposedName" placeholder="" value="<?php if($coop_info->status > 0) : ?><?= $coop_info->coopName;?> <?php endif;?>" readonly>
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
                  <input type="text" class="form-control" value="<?php if(!empty($coop_info->acronym_name)){ echo $coop_info->acronym_name; } else echo ""; ?>" name="acronym_name" id="acronymname" placeholder="(Optional)" readonly>
               <!--    <label id="acronymnameerr" style="color:red;font-size:80%;"><i>* Acronym Name has been disabled. Maximum Character reach on "Proposed Name".</i></label> -->
                </div>
              </div>
            </div>
            <div class="row rd-row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label nfor="commonBondOfMembership">Common Bond of Membership <?=($coop_info->common_bond_of_membership == 'Associational' ? :'selected')?></label>
                  <select class="custom-select " name="commonBondOfMembership" id="commonBondOfMembership">
                    <option value=""></option>
                    <option value="Associational" <?=($coop_info->common_bond_of_membership == 'Associational' ? 'selected' :'')?>>Associational</option>
                    <option value="Institutional" <?=($coop_info->common_bond_of_membership == 'Institutional' ? 'selected' :'')?>>Institutional</option>
                    <option value="Occupational" <?=($coop_info->common_bond_of_membership == 'Occupational' ? 'selected' :'')?>>Occupational</option>
                    <option value="Residential" <?=($coop_info->common_bond_of_membership == 'Residential' ? 'selected' :'')?>>Residential</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="areaOfOperation">Area of Operation </label>
                  <input type="hidden" class="form-control validate[required]" id="areaOfOperation2" name="areaOfOperation2" value="<?= $coop_info->area_of_operation ?>">
                  <select class="custom-select validate[required]" name="areaOfOperation" id="areaOfOperation">
                    <option value="" >--</option>
                    <option value="Barangay" <?=($coop_info->area_of_operation =='Barangay' ? 'selected' :'')?>>Barangay</option>
                    <option value="Municipality/City" <?=($coop_info->area_of_operation =='Municipality/City' ? 'selected' :'')?>>Municipality/City</option>
                    <option value="Provincial" <?=($coop_info->area_of_operation =='Provincial' ? 'selected' :'')?>>Provincial</option>
                    <option value="Regional" <?=($coop_info->area_of_operation =='Regional' ? 'selected' :'')?>>Regional</option>
                    <option value="Interregional" <?=($coop_info->area_of_operation =='interregional' ? 'selected' :'')?>>Inter-Regional</option>
                    <option value="National" <?=($coop_info->area_of_operation =='National' ? 'selected' :'')?>>National</option>
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
                  <select class="form-control select2 select-region" name="regions[]" id="regions" multiple="">
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
                                    <td><select class="custom-select form-control" name="compositionOfMembers[]" id="compositionOfMembers'.++$no.'">
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
                  <input type="text" class="form-control" name="blkNo" id="blkNo" placeholder="" value="<?=$coop_info->house_blk_no?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="streetName">Street Name</label> 
                  <?php if($coop_info->reg_street == "15"){
                    $street_name = $coop_info->rStreet;
                  } else {
                    $street_name = $coop_info->reg_street;
                  }?>
                  <input type="text" class="form-control" name="streetName" value="<?=$street_name?>"> <!-- id="streetName" -->
                </div>
              </div>
              <?php if($is_client){?>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                 <?php 
                 $rCode ='';
                 $pCode='';
                 $cCode = '';
                 $bCode='';
                 if(isset($coop_info))
                 {
                  $rCode =$coop_info->rCode;
                  $pCode = $coop_info->pCode;
                  $cCode = $coop_info->cCode;
                  $bCode = $coop_info->bCode;
                 }
                 ?>
                   <label for="region">Region</label>
                    <select class="custom-select validate[required]" name="region" id="region">
                    <option value="" selected></option>
                    <?php  foreach ($regions_list as $region_list) : ?>
                      <option value ="<?php echo $region_list['regCode'];?>" <?=($rCode == $region_list['regCode'] ? 'selected' : '')?>><?php echo $region_list['regDesc']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="province">Province</label>
                  <!-- <select class="custom-select validate[required]" name="province" id="province" disabled>
                  </select> -->
                  <select class="custom-select" name="province" id="province">
                    <?php 
                    foreach($list_of_provinces as $province_list)
                    {
                      ?>
                      <option value="<?=$province_list['provCode']?>" <?=($province_list['provCode']== $pCode? 'selected' : '')?>><?=$province_list['provDesc']?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="city">City/Municipality</label>
                  <select class="custom-select" name="city" id="city">
                    <?php
                    foreach($list_of_cities as $city_list)
                    {
                      ?>
                      <option value="<?=$city_list['citymunCode']?>" <?=($city_list['citymunCode'] == $cCode ?'selected' :'')?>><?=$city_list['citymunDesc']?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
           
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                   <label for="barangay">Barangay</label>
                  <select class="custom-select" name="barangay" id="barangay">
                     <?php
                    foreach($list_of_brgys as $brgy_list)
                    {
                      ?>
                      <option value="<?=$brgy_list['brgyCode']?>" <?=($brgy_list['brgyCode'] == $bCode ? 'selected' :'')?>> <?=($brgy_list['brgyDesc'])?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <?php } else {?>
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
              <?php } ?>
              
            </div>
          </div>
            <?php if(($is_client && $coop_info->status != 40 && $coop_info->status != 39) || !$is_client): ?>
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
              <input class="btn btn-block btn-color-blue" type="submit" id="reserveUpdateBtn" name="reserveUpdateBtn" value="Submit">
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