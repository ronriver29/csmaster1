<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>admins/all_signatory" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Edit Administrator</h5>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('admins/'.$encrypted_aid.'/edit_signatory',array('id'=>'editAdministratorForm','name'=>'editAdministratorForm')); ?>
      <div class="card-body">
        <div class="row">
          <input type="hidden" class="form-control validate[required]" id="adID" name="adID" value="<?=$encrypted_aid?>">
          <div class="col-sm-12 col-md-8">
            <div class="form-group form-group-fName">
              <label for="fName">Full Name:</label>
              <input type="text" class="form-control validate[required,custom[fullname]]" id="signatory" name="signatory" value="<?=$edit_signatory_info->signatory?>">
            </div>
          </div>
          <div class="w-100"></div>
          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label for="access_level">Signatory Designation</label>
              <?php $arr = array("Chairperson","Regional Director","Administrator","Acting Director","OIC Director"); ?>
              <select name="designation" class="custom-select form-control validate[required]" id="designation">
                <?php foreach($arr as $a) : ?>
                  <option value="<?=$a;?>" <?php if($edit_signatory_info->signatory_designation==$a) echo "selected";?>><?=$a;?></option>
                <!-- <option value="<?=$a;?>"><?=$a;?></option> -->
              <?php endforeach; ?>
              </select>
              <!-- <select class="custom-select validate[required]" name="access_level" id="access_level" onChange="myNewFunction(this);">
                <option value=""</option>
                <option value="Chairperson" <?php if($edit_signatory_info->signatory_designation=='Chairperson') echo "selected";?>>Chairperson</option>
                <option value="Director II" <?php if($edit_signatory_info->signatory_designation=='Director II') echo "selected";?>>Director II</option>
                <option value="4" <?php if($edit_signatory_info->signatory_designation=='Director III') echo "selected";?>>Director III</option>
                <option value="3" <?php if($edit_signatory_info->signatory_designation=="Administrator") echo "selected";?>>Administrator</option>
                 <option value="3" <?php if($edit_signatory_info->signatory_designation=="Executive Director") echo "selected";?>>Executive Director</option>
              </select> -->
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label for="region">Region</label>
              <select class="custom-select validate[required]" name="region" id="region">
                <option value=""></option>
                <option value="0" <?php if($edit_signatory_info->region_code=="0") echo "selected" ?>>Head Office</option>
                <?php foreach ($regions_list as $region_list) : ?>
                  <option value ="<?php echo $region_list['regCode'];?>" <?php if($edit_signatory_info->region_code==$region_list['regCode']) echo "selected"?>><?php echo $region_list['regDesc']?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div> 
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
