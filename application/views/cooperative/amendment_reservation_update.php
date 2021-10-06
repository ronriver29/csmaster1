<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.css')?>" type="text/css"/>
<link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css')?>" type="text/css"/>

<div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>amendment/<?=$encrypted_id?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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
      <?php echo form_open('amendment/'.$encrypted_id.'/amendment_update',array('id'=>'reserveUpdateForm','name'=>'reserveUpdateForm')); ?>
      <div class="card-header">
        <div class="row">
          <div class="col-sm-6 col-md-6">
            <h4>Amendment Update Form</h4>
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
                    <input type="hidden" class="form-control validate[required]" id="Amendment_ID" name="Amendment_ID" value="<?= $encrypted_id ?>">
                    <input type="hidden" class="form-control validate[required]" id="status" name="status" value="<?= encrypt_custom($this->encryption->encrypt($coop_info->status))?>">
                    <?php if($is_client) : ?>
                    <input type="hidden" class="form-control validate[required]" id="userID" name="userID" value="<?= $encrypted_user_id ?>">
                    <?php else: ?>
                       <input type="hidden" class="form-control validate[required]" id="userID" name="userID" value="<?= $encrypted_user_id ?>">

                    <?php endif; ?>


                  </div>
              </div>
              <div class="col-sm-12 col-md-3">
                <div class="form-group">
                  <label for="categoryOfCooperative">Category of Cooperative:</label>
                  <select class="custom-select validate[required]" name="categoryOfCooperative" id="categoryOfCooperative">
              
                    <option value="Primary" <?php if($coop_info->category_of_cooperative=="Primary") echo "selected";?>>Primary</option>
                    <option value="Secondary" <?php if($coop_info->category_of_cooperative=="Secondary" && $coop_info->grouping=="Secondary") echo "selected";?>>Secondary</option>
                    <option value="Tertiary" <?php if($coop_info->category_of_cooperative=="Tertiary" ) echo "selected";?>>Tertiary</option>
                    <option value="Others" <?php if($coop_info->category_of_cooperative=="Others") echo "selected";?>>Others</option>
                  </select>
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
                  foreach($amd_type_of_coop as $row_type)
                  {
                    ?>
                    <div class="list_cooptype">
                      <select class="custom-select coop-type" name="typeOfCooperative[]" id="typeOfCooperatives<?=$indx  ++?>">
                        <!-- <option value=""><?=$row_type?></option> -->
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
                <?php $key=1;
                foreach($cooperative_type as $crow)
                { 
             
                ?>
                <!-- <div class="list_cooptype"> -->
                <!--   <select class="custom-select coop-type" name="typeOfCooperative[]" id="typeOfCooperatives<?=$key++?>">
                    <?php
                    foreach($crow as $optionRow)
                    {
                      $cid[]=$optionRow['id'];
                    ?>
                    <option value="<?=$optionRow['id']?>" <?=(in_array($optionRow['name'],$optionRow['amended_type']) ?"selected":"")?>><?=$optionRow['name']?> </option>
                    <?php
                    }
                    ?>
                  </select> -->
                  <!-- <a class="customDeleleBtn TypeCoopRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a> -->
                <!--   <a class="customDeleleBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                </div> -->
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
                  <?php if($date_diff_Reg):?>
                  <button type="button"  class="btn btn-success btn-sm float-right" id="addCoop"><i class="fas fa-plus"></i> Add Cooperative Type</button>
                <?php endif;?>
                </div>
              </div>
            </div>
                                                                                            

          <div class="row">
              <div class="col-sm-12 col-md-12 col-industry-subclass">
                <div class="row-cis">
                  
                </div>
              </div>
            </div>        
    
            <div class="row">
              <div class="col-sm-12 offset-md-9 col-md-3">
                <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreSubclassBtn"><i class="fas fa-plus"></i> Add More Business Activity</button>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
               <!--   <input type="hidden" class="form-control" id="typeOfCooperative_value" value=""> -->
                <div class="form-group" style="margin-bottom: 0">
                   <label for="proposedName"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top"
                  data-html="true" title="<li>Don't include the type of your cooperative in your proposed name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Proposed Name:</label>
                 <!--  <input type="text" class="form-control validate[required,funcCall[validateAmendmentWordInNameCustom],ajax[ajaxAmendmentNameCallPhp]]" name="proposedName" id="proposedName" placeholder="" value="<?php if($coop_info->status > 0) : ?><?= ucwords($coop_info->proposed_name)?> <?php endif;?>">  -->

                <input type="text" class="form-control p_name validate[required,funcCall[validateAmendmentWordInNameCustom],ajax[ajaxAmendmentNameCallPhp]]" name="newNamess" id="newNamess"
                     value="<?php if($coop_info->status > 0) : ?><?= ucwords($coop_info->proposed_name)?> <?php endif;?>"> 
                <input type="hidden" class="form-control" name="newName2" id="newName2">
                  <input type="hidden" class="form-control" id="cooperative_idss" />
                
                </div>
                 <div style="margin-bottom:20px;"> <small><span id="type_of_coop" style="margin-top:-20px;"></span></small> </div>
                   <div style="margin-bottom:20px;"><small>
                  <span id="proposed_name_msg" style="margin-top:-20px;font-style:italic;"></span></small></div>
               
              </div>
            </div>
            <input type="hidden" class="form-control" name="count_types" id="count_types" />
             <input type="hidden" id="typeOfCooperative_value" value="">

             <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="acronymofCooperative"><i class="fas fa-info-user"  data-toggle="tooltip" data-placement="top"
                  data-html="true" title="<li>Don't include the type of your cooperative in your proposed name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Acronym of Cooperative Name:</label>
                  <input type="text" class="form-control" name="acronym_name" id="acronym_name" value="<?=$coop_info->acronym?>">
                </div>
                 <label id="acronymnameerr" style="color:red;font-size:80%;display:none"><i>* Acronym Name has been disabled. Maximum Character reach on "Proposed Name".</i></label>
              </div>
            </div>
            
            <div class="row rd-row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label nfor="commonBondOfMembership">Common Bond of Membership </label>
                  <select class="custom-select validate[required]" name="commonBondOfMembership" id="commonBondOfMembership">
           
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
                  <?php
                    if($coop_info->area_of_operation =='Interregional')
                    {  
                  ?>  
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
                    <?php
                    }
                    else
                    {
                    ?>
                        <option class="opt" value="1">Luzon</option>
                        <option class="opt" value="2">Visayas</option>
                        <option class="opt" value="3">Mindanao</option>
                    <?php
                    }
                    ?>
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
              
          <!-- asldfk; -->
          <div class="row">
              <div class="col-sm-12 col-md-12 col-com insti_div" id="insti_div"> 
                <div class="form-group col-md-12">
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
                </div>
                <button type="button" class="btn btn-success btn-sm float-right" id="addMoreInsBtn" style="margin-top:-25px;"><i class="fas fa-plus"></i> Add Additional Name</button>
              </div> <!-- end insti -->
             
               
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
                 <div class="col-md-12 occupation-wrapper" id="occupation-wrapper" >
                </div> <!-- END occupation-wrapper -->
          </div>      
          
          
            <div class="row" >
              <div class="col-sm-12 col-md-12">
                    <button type="button" class="btn btn-success btn-sm float-right" id="addMoreComBtn" style="margin-top:5px;"><i class="fas fa-plus"></i> Add Composition of Members</button>
              
              </div>
            </div>
         
          <!-- alsjdfaksjd/ -->
    
        
          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Proposed Address of the Cooperative</strong>
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
                  <input type="text" class="form-control " name="streetName" id="streetName" placeholder="">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="barangay">Barangay</label>
                    <input type="hidden" name="barangay_" id="barangay_" value="<?=$coop_info->bCode?>">
                  <select class="custom-select validate[required]" name="barangay" id="barangay" disabled>
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
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="city">City/Municipality</label>
                  <select class="custom-select validate[required]" name="city" id="city" disabled>
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
                  <label for="province">Province</label>
                  <select class="custom-select validate[required]" name="province" id="province" disabled>
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
                  <label for="region">Region</label>
                  <select class="custom-select validate[required]" name="region" id="region">
                    <option value="" selected></option>
                    <?php  foreach ($regions_list as $region_list) : ?>
                      <option value ="<?php echo $region_list['regCode'];?>" <?=($region_list['regCode'] == $coop_info->rCode ? 'selected' :'')?>><?php echo $region_list['regDesc']?></option>
                    <?php endforeach; ?>
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
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?=base_url('assets/plugins/select2/js/select2.full.min.js')?>"></script>
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