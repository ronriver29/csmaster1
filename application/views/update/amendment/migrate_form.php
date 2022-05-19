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
  <?php //echo"<pre>";print_r($coop_info);echo"</pre>";?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('amendment_update/seed_data',array('id'=>'amendmentAddForm','name'=>'amendmentAddForm')); ?>
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

             <!-- <div class="row">
              <div class="col-sm-12 col-md-3">
                <div class="form-group">
                  <label for="regNo">Amendment No:</label>
                  <input type="text" class="form-control" name="amendmentNo" id="regNo">
                </div>
              </div>
            </div> -->
             <div class="row"> 
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="regNo">Users ID:</label>
                 <!--  <input type="text" class="form-control validate[required]" name="user_id" id="regNo" > -->
                  <select class="form-control validate[required]" name="user_id">
                    <option value="" selected>Select user</option>
                    <?php 
                    foreach($all_users as $user)
                    {
                      ?>
                      <option value="<?=$user->id?>"><?=$user->email.' - '.$user->regno?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="regNo">Registration No:</label>
                  <input type="text" class="form-control" name="regNo" id="regNo" >
                </div>
              </div>
            </div>
         
             <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="regNo">Registration Date:</label>
                  <input type="date" class="form-control" name="dateRegistered" id="regNo">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="regNp">Name of Cooperative:</label>
                  <input type="text" class="form-control"  name="coopName" id="coopName" >
              
                </div>
              </div>  
            </div>

           <!--   <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="regNo">Application ID:</label>
                  <input type="text" class="form-control" name="application_id" id="">
                </div>
              </div>
            </div> -->

             <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="regNo">Compliant:</label>
                  <input type="text" class="form-control" name="compliant" id="">
                </div>
              </div>
            </div>
         
           
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="categoryOfCooperative">Category of Cooperative:  </label>
                  <select class="custom-select validate[required]" name="categoryOfCooperative" id="categoryOfCooperative">
                    <option value="">--</option> 
                    <option value="Primary">Primary</option>
                    <option value="Secondary"  >Secondary</option>
                    <option value="Tertiary" >Tertiary</option>
                    <option value="Others" >Others</option>  
                  </select>
                  <input type="hidden" class="form-control"  name="grouping">
                </div>
              </div>
            </div>
           
            <div class="row">
              <div class="col-sm-12 col-md-6 coop-col">
                <div class="form-group">
                  <label for="typeOfCooperative1">Type of Cooperative</label>
              
                  <div class="list_cooptype">
                    <select class="custom-select coop-type" name="typeOfCooperative[]"  style="margin-bottom: 2px;">
                       <option value=""> </option>
                      <?php
                      foreach($list_type_coop as  $coop)
                      {
                        ?>
                       
                      <option value="<?=$coop['id']?>"><?=$coop['name']?></option>
                      <?php
                      }
                      ?>
                    </select>
                   
                    <a class="customDeleleBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                   
                  </div>
                
                </div>
                <div class="coop_type-wrapper" id="coop_type-wrapper"></div>
              </div>
            </div>

           <!--  <span id="count_type" style="border:1px solid red;"></span> -->
          <div class="col-sm-12 col-md-12" >
            <div class="row">
              
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <button type="button"  class="btn btn-success btn-sm float-right" id="addCoop"><i class="fas fa-plus"></i> Add Cooperative Type</button>
                </div>
              </div>
          
            </div>
            
          
            <div class="row businesActivity-row" >
              <div class="col-sm-12 col-md-12   col-industry-subclass">
                <div class="row-cis" style="margin-bottom: 3px;">

                  
                </div>
              </div>
            </div>
            <div class="row bussiness-btn" >
              <div class="col-sm-12 offset-md-9 col-md-3">
                <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreSubclassBtn"><i class="fas fa-plus"></i> Add More Business Activity</button>
              </div>
            </div> 
            

            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group" style="margin-bottom: 0">
                  <label for="newName"><i class="fas fa-info-user"  data-toggle="tooltip" data-placement="top"
                  data-html="true" title="<li>Don't include the type of your cooperative in your new name.</li><li>Don't include the word <b>cooperative</b>.</li>"></i> Proposed Name:</label>

                    <input type="text" class="form-control p_name validate[required]" name="proposed_name"> 
                    <input type="hidden" class="form-control " id="amendment_id" name="amendment_id" >
                 
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
                  <select class="custom-select" name="commonBondOfMembership" id="commonBondOfMembership">
                    <option value="" selected> Select...</option>
                    <option value="Associational" >Associational</option>
                    <option value="Institutional" >Institutional</option>
                    <option value="Occupational" >Occupational</option>
                    <option value="Residential" >Residential</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="areaOfOperation">Area of Operation </label>
                  <select class="custom-select validate[required]" name="areaOfOperation" id="areaOfOperation">
                    <option value="" selected>--</option>
                    <option value="Barangay" >Barangay</option>
                    <option value="Municipality/City" >Municipality/City</option>
                    <option value="Provincial" >Provincial</option>
                    <option value="Regional" >Regional</option>
                    <option value="Interregional" >Inter-Regional</option>
                    <option value="National" >National</option>
                  </select>
                </div>
              </div>
            </div> <!-- end of row -->
       
        
      
     
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
                  <input type="text" class="form-control" name="blkNo" id="blkNo" >
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="streetName">Street Name</label>
                  <input type="text" class="form-control" name="streetName" id="streetName">
                 
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
            <!-- </div> -->

      <div class="card-footer">
        <div class="row">
     
       
            <div class="col-sm-6 offset-md-10 col-md-2 align-self-center col-reserve-btn">
              <input class="btn btn-block btn-color-blue" type="submit" id="amendmentAddBtn" name="submit" value="Submit">
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
