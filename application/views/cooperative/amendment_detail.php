<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.css')?>" type="text/css"/>

<link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css')?>" type="text/css"/>  

 <div class="row mb-2">

  <div class="col-sm-12 col-md-2">

    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>amendment" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>

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



<div class="row">

  <div class="col-sm-12 col-md-12">

    <div class="card border-top-blue mb-4">

      <?php echo form_open('amendment/application',array('id'=>'amendmentAddForm','name'=>'amendmentAddForm')); ?>

      <div class="card-header">

        <div class="row">

          <div class="col-sm-12 col-md-8">

            <h4>Cooperative Amendment Form</h4>

          </div>

          <div class="col-sm-12 offset-md-2 col-md-2">

            <h5 class="text-primary text-right"></h5>

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

              <div class="col-sm-12 col-md-6">

                <div class="form-group">

                  <label for="regNo">Registration No:</label>

                  <input type="text" class="form-control" name="regNo" id="regNo"value="<?=$regNo?>" readonly>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-sm-12 col-md-6">

                <div class="form-group">

                  <label for="regNp">Name of Cooperative:</label>

                  <input type="text" class="form-control" name="coopName" id="coopName" placeholder="" disabled>

                  <!--<input type="hidden" class="form-control coopName2" id="coopName" placeholder="" disabled>-->

                </div>

              </div>  

            </div>

            <div class="row">

              <div class="col-sm-12 col-md-6">

                <div class="form-group">

                  <label for="categoryOfCooperative">Category of Cooperative:</label>

                  <select class="custom-select validate[required]" name="categoryOfCooperative" id="categoryOfCooperative">

                    <option value="">--</option>

                    <option value="Primary">Primary</option>
                    <?php 
                  <option value="Secondary">Secondary</option>

                    <option value="Tertiary">Tertiary</option>

                     <option value="Others">Others</option> ?>

                  </select>

                </div>

              </div>

            </div>

           

            <div class="row type-coop-row">

              <div class="col-sm-12 col-md-6">

               <label for="typeOfCooperative1">Type of Cooperative</label>

             </div>

            </div>

           <!--  <span id="count_type" style="border:1px solid red;"></span> -->



          <div class="col-sm-12 col-md-12">

            <div class="row">

              <div class="col-sm-12 col-md-6">

                <div class="form-group">

                  <?php 

                  $migrated =0;

                  if(isset($coop_info->migrated))

                  {

                    $migrated= $coop_info->migrated;

                  }

                  ?>

                  <?php if($migrated ==1){?>

                    <button type="button"  class="btn btn-success btn-sm float-right" id="addCoop"><i class="fas fa-plus"></i> Add Cooperative Type</button>

                  <?php }else{?>  

                    <?php if($date_diff_Reg):?>

                    <button type="button"  class="btn btn-success btn-sm float-right" id="addCoop"><i class="fas fa-plus"></i> Add Cooperative Type</button>

                   <?php endif;?>

                 <?php }?>

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

                <div class="form-group" style="margin-bottom: 0">

                  <label for="newName"><i class="fas fa-info-user"  data-toggle="tooltip" data-placement="top"

                  data-html="true" title="<li>Don't include the type of your cooperative in your new name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Proposed Name:</label>



                    <input type="text" class="form-control p_name validate[required,funcCall[validateAmendmentWordInNameCustom],ajax[ajaxAmendmentNameCallPhp,ajaxAmendmentNameCallPhpcoop]]" name="newNamess" id="newNamess"> 

                   <!--  <input type="text" class="form-control p_name validate[required,funcCall[validateAmendmentWordInNameCustom]" name="newNamess" id="newNamess">  -->

                  <input type="hidden" class="form-control" name="newName2" id="newName2">

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

                  <input type="text" class="form-control" name="acronym_names" id="acronym_names" />

                </div>

                 <label id="acronymnameerr" style="color:red;font-size:80%;display:none"><i>* Acronym Name has been disabled. Maximum Character reach on "Proposed Name".</i></label>

              </div>

            </div>

            

            <div class="row rd-row">

              <div class="col-sm-12 col-md-6">

                <div class="form-group">

                  <input type="hidden" id="commonBond2" name="commonBond2"/>

                  <label nfor="commonBondOfMembership">Common Bond of Membership </label>

                  <select class="custom-select validate[required]" name="commonBondOfMembership" id="commonBondOfMembership" disabled>

           

                    <option value="Associational">Associational</option>

                    <option value="Institutional">Institutional</option>

                    <option value="Occupational">Occupational</option>

                    <option value="Residential">Residential</option>

                  </select>
                  <input type="hidden" value="<?=$coop_info->capital_contribution?>" class="form-control" name="capital_contribution">
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

      

            <!-- ASSOCIATIONAL -->

      <input type="hidden" value="<?=$coop_info->common_bond_of_membership?>" id="commonBond">

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

          <div class="col-md-12 occupational-wrappers" id="occupational-wrappers">

            <div class="col-md-12">

              <div class="form-group">

                <label for="compositionOfMembers1">Composition of Members </label>

                

                <div id="wrappera" class="col-md-12 occupational-wrappera">

                <?php if($comp_of_membership!=NULL):?>

                <?php foreach($comp_of_membership as $comRow):?>

              

                  <div class="col-md-12 list-compositions">

                    <div class="form-group">

                      <select class="custom-select composition-of-members validate[required]" name="compositionOfMembersa[]" id="compositionOfMembersa">

                        <?php foreach($list_of_composition as $list_comp):?>

                          <option value="<?=$list_comp['id']?>" <?=($comRow == $list_comp['composition'] ? "selected" : "" )?>> <?=$list_comp['composition']?></option>

                        <?php endforeach;?>

                      </select>

                      <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>

                    </div>  

                  </div>

                <?php endforeach;?>  

                <?php else: ?>

                   <div class="col-md-12 list-compositions">

                    <div class="form-group">

                      <select class="custom-select composition-of-members validate[required]" name="compositionOfMembersa[]" id="compositionOfMembersa">

                        <?php foreach($list_of_composition as $list_comp):?>

                          <option value="" selected></option>

                          <option value="<?=$list_comp['id']?>"> <?=$list_comp['composition']?></option>

                        <?php endforeach;?>

                      </select>

                      <a class="customDeleleBtn compositionRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>

                    </div>  

                  </div>  

                <?php endif; ?>  

                </div>

              <button type="button" class="btn btn-success btn-sm float-right" id="addMoreComBtn"><i class="fas fa-plus"></i> Add Composition of Members</button>

            </div>  

          </div><!--  end of row -->

        <?php //endif; ?>  

          <!--END OCCUPATIONAL-->

      </div> 

      </div>   <!-- END OF DIV CLASS COMMON BOND WRAPPER --> 

         <br/><br/>

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

                    <?php foreach ($regions_list as $region_list) : ?>

                      <option value ="<?php echo $region_list['regCode'];?>" <?=($coop_info->rCode == $region_list['regCode'] ? 'selected' : '')?>><?php echo $region_list['regDesc']?></option>

                    <?php endforeach; ?>

                  </select>

                </div>

              </div>

            </div>

          </div>

           <br>

         

          <div class="row">

            <div class="col-sm-12 col-md-12">

              <div class="form-group">

                <strong>General Assembly Details</strong>

              </div>

            </div><br>

            <div class="col-sm-12 col-md-4">

              <label  for="Assembly Venue">General Assembly Venue</label>

              <input type="text" class="form-control" name="assembly_venue" required>

            </div>

            <div class="col-sm-12 col-md-4">

              <label  for="Assembly Venue">General Assembly Type</label>

              <select class="form-control validate[required]" name="type" id="type" required>  

                <option value="" selected> </option>

                <option value="Special">Special</option>

                <option value="Regular" >Regular</option>

              </select>

            </div>

            

            <div class="col-sm-12 col-md-4">

              <label  for="Assembly Venue">General Assembly Date</label>

              <input type="date" name="annaul_date_venue"  class="form-control validate[required]" required>

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

      </div>

      <div class="card-footer">

        <div class="row">

          <div class="col-sm-6 offset-md-10 col-md-2 align-self-center col-reserve-btn">

              <input class="btn btn-block btn-color-blue" type="submit" id="amendmentAddBtn" name="amendmentAddBtn" value="Submit" disabled>

          </div>

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