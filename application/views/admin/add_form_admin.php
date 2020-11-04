<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>admins/all_admin" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Add Administrator</h5>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('admins/add',array('id'=>'addAdministratorForm','name'=>'addAdministratorForm')); ?>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12 col-md-8">
            <div class="form-group form-group-fName">
              <label for="fName">Full Name:</label>
              <input type="text" class="form-control validate[required,custom[fullname]]" id="fName" name="fName">
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-eAddress">
              <label for="eAddress">Email Address:</label>
              <input type="email" class="form-control validate[required,custom[email]]" id="eAddress" name="eAddress">
            </div>
          </div>
          <div class="w-100"></div>
          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label for="access_level">Access Level</label>
              <select class="custom-select validate[required]" name="access_level" id="access_level" onChange="myNewFunction(this);">
                <option value="" selected></option>
                <option value="1">Cooperative Development Specialist II</option>
                <option value="2">Senior Cooperative Development Specialist</option>
                <option value="4">Supervising CDS</option>
                <option value="3">Director</option>
                <option value="3">Acting Regional Director</option>
              </select>
            </div>
          </div>
          <input type="hidden" id="access_n" name="access_name">
          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label for="region">Region</label>
              <select class="custom-select validate[required]" name="region" id="region">
                <option value="" selected></option>
                  <option value="0">Central Office</option>
                <?php foreach ($regions_list as $region_list) : ?>
                  <option value ="<?php echo $region_list['regCode'];?>"><?php echo $region_list['regDesc']?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-pword">
              <label for="uname">Username:</label>
              <input type="text" class="form-control validate[required,minSize[4],ajax[ajaxUserNameCallPhp]]" id="uname" name="uname">
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-pword">
              <label for="pword">Password:</label>
              <input type="password" class="form-control validate[required,minSize[4]]" id="pword" name="pword">
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group form-group-cPword">
              <label for="cPword">Confirm Password:</label>
              <input type="password" class="form-control validate[equals[pword]]" id="cPword" name="cPword">
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