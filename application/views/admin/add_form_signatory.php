<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>admins/all_signatory" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Add Administrator</h5>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('admins/add_signatory',array('id'=>'addAdministratorForm','name'=>'addAdministratorForm')); ?>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-fName">
              <label for="signatory">Full Name:</label>
              <input type="text" class="form-control validate[required,custom[fullname]]" id="signatory" name="signatory">
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="access_level">Signatory Designation</label>
              <!-- <select class="custom-select validate[required]" name="designation" id="designation"> -->
              <?php $arr = array("Chairperson","OIC Chairperson","Director II","Director III","Administrator","Executive Director","Acting Director","OIC Director"); ?>
              <select name="designation" class="custom-select form-control validate[required]" id="designation">
                <?php foreach($arr as $a) : ?>
                <option value="<?=$a;?>"><?=$a;?></option>
              <?php endforeach; ?>
              </select>
            </div>
          </div>
          <input type="hidden" id="access_n" name="access_name">
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="region">Region</label>
              <select class="custom-select validate[required]" name="region" id="region">
                <option value="" selected></option>
                  <option value="00">Head Office</option>
                <?php foreach ($regions_list as $region_list) : ?>
                  <option value ="<?php echo $region_list['regCode'];?>"><?php echo $region_list['regDesc']?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-fName">
              <label for="signatory">Effectivity Date:</label>
              <input type="date" class="form-control validate[required]" id="effectivity" name="effectivity_date">
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer addAdministratorFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="addAdministratorBtn" name="addAdministratorBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script >
        function myNewFunction(sel) {
            var text = sel.options[sel.selectedIndex].text;
            if(text == 'Acting Regional Director'){
                text = $('#access_n').val("Acting Regional Director");
            } else {
                text = $('#access_n').val("");
            }
        }
//    });
</script>