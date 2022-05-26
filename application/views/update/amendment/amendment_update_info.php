<?php 

$cCode='';
$pCode='';
$bCode='';
$rCode='';
if(isset($coop_info2))
{
  $bCode = $coop_info2->bCode;
  $cCode= $coop_info2->cCode;
  $pCode = $coop_info2->pCode;
  $rCode = $coop_info2->rCode;
}

$annual_meeting_regular_day_date = '';
$annual_meeting_regular_day_venue='';
$bylaw_type ='';

// echo"<pre>";print_r($bylaw_info); echo"</pre>";
if(isset($bylaw_info))
{
  $annual_meeting_regular_day_date= $bylaw_info->annual_regular_meeting_day_date;
  $annual_meeting_regular_day_venue = $bylaw_info->annual_regular_meeting_day_venue;
  $bylaw_type = $bylaw_info->type;
}
?>
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.css')?>" type="text/css"/>
<link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css')?>" type="text/css"/>  
 <div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>amendment_update/<?=$encrypted_id?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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
  <div class="col-md-12">
<?php if($this->session->flashdata('amendment_msg')) :?>       
       <div class="alert alert-<?=$this->session->flashdata('msg_class')?> alert-dismissible">
         <button type = "button" class="close" data-dismiss = "alert">x</button>
         <?=$this->session->flashdata('amendment_msg')?>
       </div>
   <?php endif; ?>
 </div>
</div>
  <?php //echo"<pre>";print_r($coop_info);echo"</pre>";?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('amendment_update/'.$encrypted_id.'/update',array('id'=>'amendmentAddForm','name'=>'amendmentAddForm')); ?>
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 col-md-8">
            <h4>Cooperative Amendment Form</h4>
          </div>
          <div class="col-sm-12 offset-md-2 col-md-2">
            <h5 class="text-primary text-right"><!-- Step 1 --></h5>
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
                    <strong>Cooperative Information:</strong>
                  </div>
              </div>
            </div>

             <div class="row">
              <div class="col-sm-12 col-md-3">
                <div class="form-group">
                  <label for="regNo">Amendment No:</label>
                  <input type="text" class="form-control" name="amendmentNo" id="regNo"value="<?=$coop_info->amendmentNo?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="regNo">Registration No:</label>
                  <input type="text" class="form-control" name="regNo" id="regNo"value="<?=$regNo?>" readonly>
                </div>
              </div>
            </div>
            <?php
            $readonly = 'readonly'; 
            if(!$is_client && $admin_info->access_level==6){
              $readonly='';
            ?>
             <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="regNo">Amendment Date:</label>
                  <input type="date" class="form-control" name="dateRegistered" id="regNo"value="<?=$coop_info2->dateRegistered?>">
                </div>
              </div>
            </div>
          <?php }?>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="regNp">Name of Cooperative:</label>
                  <input type="text" class="form-control" value="<?=$name_of_coop_primary->coopName?>" name="coopName" id="coopName"  readonly>
              
                </div>
              </div>  
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="categoryOfCooperative">Category of Cooperative:  </label>
                  <select class="custom-select validate[required]" name="categoryOfCooperative" id="categoryOfCooperative">
                    <option value="">--</option> 
                    <option value="Primary" <?=($coop_info->category_of_cooperative == 'Primary' ? 'selected' :'')?>>Primary</option>
                    <option value="Secondary" <?=($coop_info->category_of_cooperative == 'Secondary' ? 'selected' :'')?> >Secondary</option>
                    <option value="Tertiary" <?=($coop_info->category_of_cooperative == 'Tertiary' ? 'selected' :'')?> >Tertiary</option>
                    <option value="Others" <?=($coop_info->category_of_cooperative == 'Others' ? 'selected' :'')?>>Others</option>  
                  </select>
                  <input type="hidden" class="form-control" value="<?=($coop_info->type_of_cooperative =='Federation' ? $coop_info->type_of_cooperative :'')?>" name="grouping">
                </div>
              </div>
            </div>
           
            <div class="row">
              <div class="col-sm-12 col-md-6 coop-col">
                <div class="form-group">
                  <label for="typeOfCooperative1">Type of Cooperative</label>
                  
                  <?php
                  $count_coop_type = count($amd_type_of_coop);
                  $indx = 1;
                  foreach($amd_type_of_coop as $keys => $row_type)
                  { 
                  ?>
                  <div class="list_cooptype">
                    <select class="custom-select coop-type validate[required]" name="typeOfCooperative[]" id="typeOfCooperatives<?=$indx  ++?>" style="margin-bottom: 2px;">
                       <option value=""> </option>
                      <?php
                      foreach($list_type_coop as  $coop)
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
                    <?php if( $keys >0):?>
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

           <!--  <span id="count_type" style="border:1px solid red;"></span> -->
          <div class="col-sm-12 col-md-12" >
            <div class="row">
              <?php if($coop_info->category_of_cooperative == 'Primary'):?>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <button type="button"  class="btn btn-success btn-sm float-right" id="addCoop"><i class="fas fa-plus"></i> Add Cooperative Type</button>
                </div>
              </div>
            <?php endif; ?>
            </div>
            
            <?php 
            $business_value = '';
            if($coop['name']=='Union')
            {
              $business_value = 'none';
            }
           
            ?>
            <div class="row businesActivity-row" style="display:<?=$business_value?>;">
              <div class="col-sm-12 col-md-12   col-industry-subclass">
                <div class="row-cis" style="margin-bottom: 3px;">

                  
                </div>
              </div>
            </div>
            <div class="row bussiness-btn" style="display:<?=$business_value?>;">
              <div class="col-sm-12 offset-md-9 col-md-3">
                <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreSubclassBtn"><i class="fas fa-plus"></i> Add More Business Activity</button>
              </div>
            </div> 
            

            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group" style="margin-bottom: 0">
                  <label for="newName"><i class="fas fa-info-user"  data-toggle="tooltip" data-placement="top"
                  data-html="true" title="<li>Don't include the type of your cooperative in your new name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Proposed Name:</label>

                    <input type="text" class="form-control p_name validate[required]" name="proposed_name" value="<?=$coop_info->coopName?>" <?=$readonly?>> 
                    <input type="hidden" class="form-control " id="amendment_id" name="amendment_id" value="<?=encrypt_custom($this->encryption->encrypt($coop_info->id))?>">
                 
                  <input type="hidden" id="cooperative_idss" />
                </div>
                <div style="margin-bottom:0px;"> <small><span id="type_of_coop" style="margin-top:-20px;"></span></small></div>
                
                  <div style="margin-bottom:20px;"> <small><span id="proposed_name_msg" style="margin-top:-20px;font-style:italic;"></span></small></div>
              </div>
            </div>

            <input type="hidden" id="typeOfCooperative_value" value="">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="acronymofCooperative"><i class="fas fa-info-user"  data-toggle="tooltip" data-placement="top"
                  data-html="true" title="<li>Don't include the type of your cooperative in your proposed name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Acronym of Cooperative Name:</label>
                  <input type="text" class="form-control" name="acronym_names" id="acronym_names" value="<?=$coop_info->acronym?>" readonly/>
                </div>
                 <label id="acronymnameerr" style="color:red;font-size:80%;display:none"><i>* Acronym Name has been disabled. Maximum Character reach on "Proposed Name".</i></label>
              </div>
            </div>
            
            <div class="row rd-row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <input type="hidden" id="commonBond2" name="commonBond2"/>
                  <label nfor="commonBondOfMembership">Common Bond of Membership  <?=($coop_info->common_bond_of_membership)?></label>
                  <select class="custom-select" name="commonBondOfMembership" id="commonBondOfMembership">
                    <option value="" selected> Select...</option>
                    <option value="Associational" <?=($coop_info->common_bond_of_membership =='Associational' ? 'selected' :'')?>>Associational</option>
                    <option value="Institutional" <?=($coop_info->common_bond_of_membership =='Institutional' ? 'selected' :'')?>>Institutional</option>
                    <option value="Occupational" <?=($coop_info->common_bond_of_membership =='Occupational' ? 'selected' :'')?>>Occupational</option>
                    <option value="Residential" <?=($coop_info->common_bond_of_membership =='Residential' ? 'selected' :'')?>>Residential</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="areaOfOperation">Area of Operation </label>
                  <select class="custom-select validate[required]" name="areaOfOperation" id="areaOfOperation">
                    <option value="" selected>--</option>
                    <option value="Barangay" <?=($coop_info->area_of_operation =='Barangay' ? 'selected' :'')?>>Barangay</option>
                    <option value="Municipality/City" <?=($coop_info->area_of_operation =='Municipality/City' ? 'selected' :'')?>>Municipality/City</option>
                    <option value="Provincial" <?=($coop_info->area_of_operation =='Provincial' ? 'selected' :'')?>>Provincial</option>
                    <option value="Regional" <?=($coop_info->area_of_operation =='Regional' ? 'selected' :'')?>>Regional</option>
                    <option value="Interregional" <?=($coop_info->area_of_operation =='Interregional' ? 'selected' :'')?>>Inter-Regional</option>
                    <option value="National" <?=($coop_info->area_of_operation =='National' ? 'selected' :'')?>>National</option>
                  </select>
                </div>
              </div>
            </div> <!-- end of row -->
          </div> <!-- end of col md 12 -->
        
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
                <div class="form-group"  id="allregions">
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
                            
                            <?php   if(empty($members_composition)) {?>
                            <select class="custom-select" name="compositionOfMembers[]" id="compositionOfMembers1">
                               <!--  <option value="" selected></option> -->
                                <?php
                                  foreach ($composition as $key) {
                                    echo '<option value="'.$key->id.'">'.$key->composition.'</option>';
                                  }
                                ?>
                              </select>
                            <?php } else { ?>
                            <?php $no=0;
                              foreach($members_composition as $key){

                                echo '<div class="form-group">

                                <table>
                                  <tr>
                                    <td><select class="custom-select form-control" name="compositionOfMembers[]" id="compositionOfMembers'.++$no.'">';
                                        // <option value=""></option>';
                                        foreach($composition as $key2){
                                          echo '<option value="'.$key2->id;
                                          if ($key['composition']==$key2->id)
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
                           }//end if else
                          } 
              ?>
                <!-- <?php echo"<pre>";print_r($members_composition);echo"</pre>";?> -->
              </div>
            </div>
          </div>

          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-10">
                <div class="form-group">
                    <button type="button" class="btn btn-success btn-sm float-right" id="addMoreInsBtn"><i class="fas fa-plus"></i> Add Additional Name</button>
                    <button type="button" class="btn btn-success btn-sm float-right" id="addMoreComBtn" style="margin-top:5px;"><i class="fas fa-plus"></i> Add Composition of Members</button>
                </div>
              </div>
            </div>
          </div>
    <?php /*      
            <!-- ASSOCIATIONAL -->
     <!--  <input type="hidden" value="<?=$coop_info->common_bond_of_membership?>" id="commonBond"> -->
      <div class="row rd-row" id="common_bond_wrapper">      
         <?php //if($coop_info->common_bond_of_membership == 'Associational' || $coop_info->common_bond_of_membership == 'Institutional') :?>     
        <div class="col-md-12" id="associational-wrappers">
          <!-- <div class="col-md-12"> -->
            <div class="form-group">
             <label for="fieldmembershipname" id="fieldmembershipname">Field of Membership <i>(Note: Employees/Retirees)</i></label>
              <input type="text" class="form-control" name="assoc_field_membership" id="assoc_field_membership" value="<?=$coop_info->field_of_membership?>">
            </div>
          <!-- </div>   -->

          <!-- <div class="col-md-12"> -->
            <div class="form-group">
              <label for="compositionOfMembers1" id="name_institution_label">Name of Association</label>
              <?php 
              $name_associational = explode(',',$coop_info->name_of_ins_assoc);
              foreach($name_associational as $associational):
              ?>
              <input type="text" name="name_associational[]" id="name_associational" value="<?=$associational?>" class="form-control"/><br>
              <?php
            endforeach;
              ?>
            <!-- </div>   -->
               <div class="assoc-wrapper"></div>          
          
             <button type="button" class="btn btn-success btn-sm float-right btn-assoc" id="addMoreInsBtn_Associational"  style="margin-top:35px;">
                <i class="fas fa-plus"></i> Add Additional Name of Associational</button>
          </div>  
        </div>
      <?php //endif;?>

        
        <?php //if($coop_info->common_bond_of_membership == 'Occupational') :?> 
         <div class="col-md-12 ocu-div">
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
                  <?php
                  if($members_composition)
                  {
                  $no=0;
                  foreach($members_composition as $key){
                    echo '<div class="form-group">
                      <table id="comp_tbl" width="100%">
                        <tr>
                          <td><select class="custom-select form-control  validate[required]" name="compositionOfMembers[]" id="compositionOfMembers'.++$no.'">
                            <option value=""></option>';
                            foreach($composition as $key2){
                            echo '<option value="'.$key2->id;
                              if ($key['composition']==$key2->composition)
                              echo '" selected>';
                              else
                              echo '">';
                            echo $key2->composition.'</option>';}
                          echo '</select><br>
                        </td>';
                        ?>
                        <?php 
                        if(count($members_composition)>1)
                        {
                          echo' <td><a class="customDeleleBtn compositionRemoveBtn float-right text-danger"  onclick="$(this).parent().parent().remove()"><i class="fas fa-minus-circle"></i></a>
                        </td>';
                        }
                        ?>
                     <?php
                       echo' </tr>
                      </table>
                    </div>';
                  }//end no emtpy
                }
                ?>
              </div> <!-- end of ocu-div -->
                 <div class="col-md-12 occupation-wrapper" id="occupation-wrapper" ></div> <!-- END occupation-wrapper -->
      
          <!--END OCCUPATIONAL-->

      </div> 
      </div>   <!-- END OF DIV CLASS COMMON BOND WRAPPER --> 
      */?>

     
          <div class="row col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Proposed Address of Cooperative</strong>
                   <div style="color:red;font-size: 11px;"><i>*Please leave the House/Lot and Blk No. and Street Name blank if not applicable</i></div>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="blkNo">House/Lot & Blk No.</label>
                  <input type="text" class="form-control" name="blkNo" id="blkNo" value="<?=$coop_info->house_blk_no?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="streetName">Street Name</label>
                  <input type="text" class="form-control" name="streetName" id="streetName" value="<?=$coop_info->street?>">
                 
                </div>
              </div>
             
             
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="region">Region</label>
                  <select class="custom-select validate[required]" name="region" id="region">
                    <option value="" selected></option>
                    <?php foreach ($regions_list as $region_list) : ?>
                      <option value ="<?php echo $region_list['regCode'];?>" <?=($rCode == $region_list['regCode'] ? 'selected' : '')?>><?php echo $region_list['regDesc']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>

           <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="province">Province</label>
                  <select class="custom-select validate[required]" name="province" id="province" >
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
                  <select class="custom-select validate[required]" name="city" id="city" >
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
                  <input type="hidden" name="barangay_" id="barangay_" value="<?=$bCode?>">
                  <select class="custom-select validate[required]" name="barangay" id="barangay">
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
             

           <br>
            
            <div class="row col-md-12">
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>General Assembly Details</strong>
                  </div>
                </div><br>

                <div class="col-sm-12 col-md-4">
                  <label  for="Assembly Venue">General Assembly Venue</label>
                  <input type="text" class="form-control" name="assembly_venue" value="<?=$annual_meeting_regular_day_venue?>">
                </div>

                <div class="col-sm-12 col-md-4">
                  <label  for="Assembly Venue">General Assembly Type</label>
                  <select class="form-control " name="type" id="type" >
                    <option value="" selected> </option>
                    <option value="Special" <?=($bylaw_type == 'Special' ? 'selected' :'')?>>Special</option>
                    <option value="Regular" <?=($bylaw_type == 'Regular' ? 'selected' :'')?>>Regular</option>
                  </select>
                </div>
              
                <div class="col-sm-12 col-md-4">
                  <label  for="Assembly Venue">General Assembly Date </label>
                  <input type="date" name="annaul_date_venue" value="<?=$annual_meeting_regular_day_date?>"  class="form-control validate[required]" >
                </div>

            </div> 

            <br>
              <div class="col-sm-12 offset-md-1 col-md-10 align-self-end">
                <div class="form-group">
                  <div class="custom-control custom-checkbox text-center mt-2">
                    <input type="checkbox" class="custom-control-input" id="amendmentAddAgree" name="amendmentAddAgree">
                    <label class="custom-control-label" for="amendmentAddAgree"><p class="font-weight-bolder">I have read and agreed to our Terms and Conditions.</p></label>
                  </div>
                </div>
              </div>

            </div>
            <!-- </div> -->

      <div class="card-footer">
        <div class="row">
        <?php if($is_client){ ?>
          <?php $array_status = array(40,41);
          if(!in_array($coop_info->status,$array_status))
          {
          ?>
            <div class="col-sm-6 offset-md-10 col-md-2 align-self-center col-reserve-btn">
              <input class="btn btn-block btn-color-blue" type="submit" id="amendmentAddBtn" name="amendmentAddBtn" value="Submit" disabled>
          </div>
         <?php  }?>
        <?php }?>

         <?php if(!$is_client){ ?>
          <?php $array_status = array(40,41);
          if(in_array($coop_info->status,$array_status))
          {
          ?>
            <div class="col-sm-6 offset-md-10 col-md-2 align-self-center col-reserve-btn">
              <input class="btn btn-block btn-color-blue" type="submit" id="amendmentAddBtn" name="amendmentAddBtn" value="Submit" disabled>
          </div>
         <?php  }?>
        <?php }?>
        
        </div>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- <script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script> -->
<script type="text/javascript">
  $(document).ready(function(){


  $("#newNamess").bind("keyup change", function(e) {
     var typeCoop_array=[]; 
     $('select[name="typeOfCooperative[]"] option:selected').each(function() {
     typeCoop_array.push($(this).val());
      console.log(typeCoop_array);
      $('#typeOfCooperative_value').val(typeCoop_array);
     });
    });
  });

  

</script>
<script src="<?=base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>