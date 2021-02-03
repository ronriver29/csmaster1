<div class="row mb-2">
  <div class="col-sm-12 col-md-2">
    <a class="btn btn-secondary btn-sm btn-block"  href="<?php echo base_url();?>/laboratories" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('laboratories/'.$encrypted_id.'/rupdate',array('id'=>'reserveUpdateForm','name'=>'reserveUpdateForm')); ?>
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 col-md-8">
            <h4>Laboratories Update Form</h4>
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
                    <strong>Application Information:</strong>
                  
               
                  </div>
              </div>
            </div>
            <div class="row">

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <input type="hidden" id="cooperativeID" name="cooperativeID" value="<?= $encrypted_id ?>" />
                  <input type="hidden" id="userID" name="user_id" value="<?=$encrypted_user_id ?>" />
                  <label for="regNo">Registration No of the Cooperative</label> 
                  <input type="text" value="<?= $lab_info->coop_id?>" class="form-control validate[required]" name="regNo" id="regNo" >
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="coopName">Name of the Cooperative</label>
                  <input type="text" value="<?=$lab_info->labName ?>" class="form-control validate[required]" name="coopName" id="coopName" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="laboratory"> Name of Laboratory</label>
                  <input type="text" value="<?=$lab_info->laboratoryName?>" class="form-control validate[required]" name="labName" id="labName">
                </div>
              </div>
            </div>


        <div class="row">
          <div class="col-sm-12 col-md-12 col-com">  
              <label>Composition of Members </label>

                <br />
            <?php if($lab_info->comp_college=='college') :?>
                      <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input com_check" name="com_college" id="com_member" value="college" checked>
                <label class="form-check-label" for="college">College</label>
              </div>
         
              <?php else: ?>

                 <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input com_check" name="com_college" id="com_member" value="college" >
                <label class="form-check-label" for="college">College</label>
              </div>

              <?php endif; ?>
            
            <?php if($lab_info->comp_highschool=='high school') :?>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input com_check" id="com_member" name="com_highschool" value="high school" checked >
                <label class="form-check-label" for="highschool">High School</label>
              </div>
          <?php else: ?>
               <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input com_check" id="com_member" name="com_highschool" value="high school">
                <label class="form-check-label" for="highschool">High School</label>
              </div>

          <?php endif; ?>

        <?php if($lab_info->comp_grade=='grade school') :?>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input com_check" id="com_member" name="com_grade" value="grade school" checked>
                <label class="form-check-label" for="gradeschool">Grade School</label>
              </div>
        <?php else: ?>
              <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input com_check" id="com_member" name="com_grade" value="grade school" >
                <label class="form-check-label" for="gradeschool">Grade School</label>
              </div>

        <?php endif; ?>

         <?php if($lab_info->comp_outschool=='out of school youth') :?>
                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input com_check" id="com_member" name="com_outofschool" value="out of school youth" checked>
                <label class="form-check-label" for="outofschoolyouth">Out of School Youth</label>
              </div>
              <?php else: ?>

                <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input com_check" id="com_member" name="com_outofschool" value="out of school youth">
                <label class="form-check-label" for="outofschoolyouth">Out of School Youth</label>
              </div>
            <?php endif; ?>

          </div>
        </div> <!-- end of row -->
        <br />

        <!-- modify by jayson commented this line of code -->
         <!-- <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <button type="button" class="btn btn-success btn-sm float-right" id="addMoreComBtn"><i class="fas fa-plus"></i> Add Composition of Members</button>
                </div>
              </div>
            </div>
          </div> -->
          <div class="col-sm-12 col-md-12">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Proposed Address</strong>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="blkNo">House/Lot & Blk No.</label>
                  <input type="text" value="<?=$lab_info->house_blk_no ?>" class="form-control" name="blkNo" id="blkNo" placeholder="">
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="streetName">Street Name</label>
                  <input type="text" value="<?=$lab_info->streetName?>" class="form-control" name="stName" id="stName" />
                   
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


                <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="province">Province</label>
                  <select class="custom-select" name="province" id="province" readonly>
                  </select>
                </div>
              </div>

               <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="city">City/Municipality</label>
                  <select class="custom-select validate[required]" name="city" id="city" readonly>
                  </select>
                </div>
              </div>
              

              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="barangay">Barangay</label>
                  <select class="custom-select validate[required]" name="barangay" id="barangay" readonly>
                  </select>
                </div>
              </div>
             

            

              

            </div>
          </div>
          <div class="col-sm-12 offset-md-1 col-md-10 align-self-end">
            <div class="form-group">
              <div class="custom-control custom-checkbox text-center mt-2">
                <input type="checkbox" class="custom-control-input" id="reserveUpdateAgree" name="reserveUpdateAgree">
                <label class="custom-control-label" for="reserveUpdateAgree"><p class="font-weight-bolder">I have read and agreed to our Terms and Conditions.</p></label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-6 offset-md-10 col-md-2 align-self-center col-reserve-btn">
              <input class="btn btn-block btn-color-blue" type="submit" id="reserveUpdateBtn" name="reserveUpdateBtn" value="Submit" disabled>
          </div>
        </div>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
</div>

