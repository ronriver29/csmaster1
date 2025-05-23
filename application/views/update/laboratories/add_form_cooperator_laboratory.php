<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>laboratories_update/<?= $encrypted_id ?>/laboratories_cooperators_update" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Add Member/Cooperator</h5> 
  </div>
</div>



<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
    <?php echo form_open('laboratories_update/'.$encrypted_id.'/laboratories_cooperators_update/add',array('id'=>'addCooperatorForm','name'=>'addCooperatorForm')); ?>
      <div class="card-body">
        <div class="row">
          <input type="hidden" class="form-control" name="coop_ids" id="coopids" value="<?=$encrypted_coop_id?>"/>
          <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_coop_id ?>">
          <input type="hidden" class="form-control validate[required]" id="userID" name="userID" value="<?= $encrypted_user_id ?>" />
          <input type="hidden" class="form-control validate[required]" id="regNo" name="regNo" value="<?= $regno ?>" />

          <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="fName">First Name:</label>
              <input type="text" class="form-control validate[required]" id="fName" name="fName">
            </div>
          </div>

           <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="fName">Middlename:</label>
              <input type="text" class="form-control" id="middle_name" name="middle_name">
            </div>
          </div>

           <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="fName">Lastname:</label>
              <input type="text" class="form-control" id="last_name" name="last_name">
            </div>
          </div>
           <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="gender">Gender:</label>
              <select class="custom-select validate[required]" name="gender">
                <option value="" selected>--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-md-2">
            <div class="form-group">
              <label for="gender">Age:</label>
              <input class="form-control validate[required,custom[integer],funcCall[validateLabAge]]" id="age_" name="age">
            </div>
          </div>  
<!--          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="subscribedShares">No of subscribed shares:</label>
              <input type="number" min="1" class="form-control validate[required,min[1],custom[integer]]" id="subscribedShares" name="subscribedShares" readonly>
            </div>
          </div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label for="paidShares">No of paid-up Shares:</label>
              <input type="number" min="1" class="form-control validate[required,min[1],custom[integer],funcCall[validateAddNumberOfPaidUpGreaterCustom]]" id="paidShares" name="paidShares" readonly>
            </div>
          </div>-->
    </div> <!-- end of rows -->      

<hr>
  
      <div class="row">
          <div class="col-sm-12 col-md-12 col-com">  
              <strong><label>Educational Background </label></strong>
              <br>
              <select id="edb" name="edb" class="form-control">
                <option value="college" selected>College</option>
                 <option value="seniorhigh">Senior High</option>
                <option value="juniorhigh">Junior High</option>
                <option value="gradeschool">Grade School</option>
                <option value="outofschoolyouth">Out of School Youth</option>
              </select>
               <!--  <br />
             <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input com_check" name="com_college" id="com_member" value="college">
                <label class="form-check-label" for="college">College</label>
              </div>
         

            
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input com_check" id="com_member" name="com_highschool" value="high school">
                <label class="form-check-label" for="highschool">High School</label>
              </div>
          

         
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input com_check" id="com_member" name="com_gradeschool" value="grade school">
                <label class="form-check-label" for="gradeschool">Grade School</label>
              </div>
        

          
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input com_check" id="com_member" name="com_outofschool" value="out of school youth">
                <label class="form-check-label" for="outofschoolyouth">Out of School Youth</label>
              </div> -->
           
          </div>
        </div>
 

    <br />
    <hr>
    <div class="rows">
         
          <!-- modify commented this line of code -->
          <!-- <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label for="gender">Education Experience:</label>
              <select class="custom-select validate[required]" name="educational_experience">
                <option value="" selected>--</option>
                <option value="Grade School">Grade School</option>
                <option value="High School">High School</option>
                <option value="High School">College</option>
                <option value="High School">Out of School Youth</option>
              </select>
            </div>
          </div> -->
<!--          <div class="col-sm-12 col-md-3">
            <div class="form-group">
              <label for="bDate"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>Age must be 18 years old and above.</li>"></i> Birth Date:</label>
              <input type="date" class="form-control validate[required,custom[date],funcCall[validateAgeCustom]]" id="bDate" name="bDate">
            </div>
          </div>-->
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
          
      <?php //echo $coop_info->region?>
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
                  <input type="hidden" class="custom-select validate[required]" name="barangay2" id="barangay2" value="<?=$coop_info->bCode?>">
                  <input type="hidden" class="custom-select validate[required]" name="barangay" id="barangay2" value="<?=$coop_info->bCode?>">
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


        </div>
      </div>
      <div class="card-footer addCooperatorFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="addCooperatorBtn" name="addCooperatorBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
