<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>admins/all_admin" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Edit Administrator</h5>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('admins/'.$encrypted_aid.'/edit',array('id'=>'editAdministratorForm','name'=>'editAdministratorForm')); ?>
      <div class="card-body">
        <div class="row">
          <input type="hidden" class="form-control validate[required]" id="adID" name="adID" value="<?=$encrypted_aid?>">
          <div class="col-sm-12 col-md-8">
            <div class="form-group form-group-fName">
              <label for="fName">Full Name:</label>
              <input type="text" class="form-control validate[required,custom[fullname]]" id="fName" name="fName" value="<?=$edit_admin_info->full_name?>">
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-eAddress">
              <label for="eAddress">Email Address:</label>
              <input type="email" class="form-control validate[required,custom[email]]" id="eAddress" name="eAddress" value="<?=$edit_admin_info->email?>">
            </div>
          </div>
          <div class="w-100"></div>
          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label for="access_level">Access Level</label>
              <select class="custom-select validate[required]" name="access_level" id="access_level" onChange="myNewFunction(this);">
                <option value=""</option>
                <option value="1" <?php if($edit_admin_info->access_level==1) echo "selected";?>>Cooperative Development Specialist II</option>
                <option value="2" <?php if($edit_admin_info->access_level==2) echo "selected";?>>Senior Cooperative Development Specialist</option>
                <option value="4" <?php if($edit_admin_info->access_level==4) echo "selected";?>>Supervising CDS</option>
                <option value="3" <?php if($edit_admin_info->access_name=="Director") echo "selected";?>>Director</option>
                <option value="3" <?php if($edit_admin_info->access_name=="Acting Regional Director") echo "selected";?>>Acting Regional Director</option>
                <option value="6" <?php if($edit_admin_info->access_level==6) echo "selected";?>>Authorized Personnel</option>
              </select>
              <input type="hidden" id="access_n" name="access_name" value="<?=$edit_admin_info->access_name?>">
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label for="region">Region</label>
              <select class="custom-select validate[required]" name="region" id="region">
                <option value=""></option>
                <option value="0" <?php if($edit_admin_info->region_code=="0") echo "selected" ?>>Head Office</option>
                <?php foreach ($regions_list as $region_list) : ?>
                  <option value ="<?php echo $region_list['regCode'];?>" <?php if($edit_admin_info->region_code==$region_list['regCode']) echo "selected"?>><?php echo $region_list['regDesc']?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-pword">
              <label for="uname">Username:</label>
              <input type="text" class="form-control validate[required,minSize[4],ajax[ajaxUserNameCallPhpEdit]]" id="uname" name="uname" value="<?=$edit_admin_info->username?>">
            </div>
          </div>
         <!--  <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-pword">
              <label for="pword">Password:</label>
              <input type="password" class="form-control validate[required,minSize[4]]" id="pword" name="pword">
            </div>
          </div> -->
          <!-- <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-cPword">
              <label for="cPword">Confirm Password:</label>
              <input type="password" class="form-control validate[equals[pword]]" id="cPword" name="cPword">
            </div>
          </div>   -->  
        </div>
      </div>
      <div class="card-footer editAdministratorFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="editAdministratorBtn" name="editAdministratorBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script >
        function myNewFunction(sel) {
            var text = sel.options[sel.selectedIndex].text;
            $('#access_n').val(text);
            // if(text == 'Acting Regional Director'){
            //     text = $('#access_n').val("Acting Regional Director");
            // } else {
            //     text = $('#access_n').val("");
            // }
        }
</script>