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
            <h5 class="text-primary text-right">Step 1</h5>
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
                    <option value="Secondary - Union">Secondary - Union</option>
                    <option value="Tertiary - Union">Tertiary - Union</option>
                    <option value="Secondary - Federation">Secondary - Federation</option>
                    <option value="Tertiary - Federation">Tertiary - Federation</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row type-coop-row">
              <!-- <div class="col-sm-12 col-md-6  coop-col">
                <div class="form-group">
                  <label for="typeOfCooperative1">Type of Cooperative</label>
                  <select class="custom-select coop-type validate[required]" name="typeOfCooperative[]" id="typeOfCooperative1">
                    <option value="">--</option>
                    <?php
                      foreach($list_cooperative_type as $row_coop)
                      {
                        ?>
                          <option value="<?=$row_coop['id']?>"><?=$row_coop['name'] ?></option>
                        <?php
                      }
                    ?>
                  </select>
                </div>

              </div> -->
            </div>
           <!--  <span id="count_type" style="border:1px solid red;"></span> -->
          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <button type="button"  class="btn btn-success btn-sm float-right" id="addCoop"><i class="fas fa-plus"></i> Add Cooperative Type</button>
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

                  <input type="text" class="form-control p_name validate[required,funcCall[validateAmendment_proposed_name],ajax[ajaxAmendmentNameCallPhp]]" name="newNamess" id="newNamess">
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
                    <option value="National">National</option>
                  </select>
                </div>
              </div>
            </div> <!-- end of row -->
          </div> <!-- end of col md 12 -->
      
      
            <!-- ASSOCIATIONAL -->
        <div class="row" id="associational-wrappers" style="display:none">
          <div class="col-md-12">
            <div class="form-group">
             <label for="fieldmembershipname" id="fieldmembershipname">Field of Membership <i>(Note: Employees/Retirees)</i></label>
              <input type="text" class="form-control" name="assoc_field_membership" id="assoc_field_membership" >
            </div>
          </div>  

          <div class="col-md-12">
            <div class="form-group">
              <label for="compositionOfMembers1" id="name_institution_label">Name of Association</label>
              <input type="text" name="name_associational[]" id="name_associational" class="form-control"/>
            </div>  
               <div class="assoc-wrapper"></div>          
          
             <button type="button" class="btn btn-success btn-sm float-right" id="addMoreInsBtn_Associational"  style="margin-top:35px;">
                <i class="fas fa-plus"></i> Add Additional Name of Associational</button>

          </div>  
        </div>
        <!-- end of row -->
        <!-- INSTITUTIONAL -->
        <div class="col-sm-12 col-md-12" id="institutional-wrapper" style="padding:5px;border">
          <div class="form-group">
            <label for="compositionOfMembers1" id="fieldmembershipname">Field of Membership <i>(Note: Employees/Retirees)</i></label>
            <input type="text" class="form-control" name="ins_field_membership" id="ins_field_membership" >
          </div>

          <div class="form-group">
            <label for="compositionOfMembers1" id="name_institution_label">Name of Institution</label>
            <div id="wrapper" class="con-wrapper"></div><!-- end of wrapper -->
            <button type="button" class="btn btn-success btn-sm float-right" id="addMoreInsBtn_insti"  style="margin-top:35px;">
            <i class="fas fa-plus"></i> Add Additional Name of Institution</button>
          </div>
         
        </div>
         <!--END INSTITUTIONAL -->

          <!--OCCUPATIONAL-->
          <div class="row" id="occupational-wrapper">
            <div class="form-group">
              <label for="compositionOfMembers1">Composition of Members </label>
            </div>
            <div id="wrappera" class="col-md-12 occupational-wrappera"></div>
            <button type="button" class="btn btn-success btn-sm float-right" id="addMoreComBtn"><i class="fas fa-plus"></i> Add Composition of Members</button>
          </div><!--  end of row -->

          <!--END OCCUPATIONAL-->
         <br/>
          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Proposed Address of Cooperative</strong>
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
            </div>
          </div>
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

<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
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