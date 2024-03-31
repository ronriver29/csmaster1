 <body oncontextmenu="return false" onselectstart="return false"
      onkeydown="if ((arguments[0] || window.event).ctrlKey) return false">
<div class="row">
  <div class="col text-center">
      <img class="mt-4" src="<?=base_url()?>/assets/img/cda.png" alt="" width="80" height="80">
  </div>
</div>
</br>
<div class="row">
  <div class="col">
    <div class="card mb-4 border-top-blue">
      <?php echo form_open('users/use_registered_email', 'name="signUpForm" id="signUpForm"');?>
        <div class="card-header">
          <h4><strong> Use Registered Email Account </strong></h4>
        </div>
      <div class="card-body">
          <div class="row">
            <?php if($this->session->flashdata('email_sent_success')): ?>
              <div class="col-sm-12 col-md-12">
                <div class="alert alert-success text-center" role="alert">
                 <p><?php echo $this->session->flashdata('email_sent_success'); ?></p>
                </div>
              </div>
          <?php endif; ?>
          <?php if($this->session->flashdata('email_sent_warning')): ?>
              <div class="col-sm-12 col-md-12">
                <div class="alert alert-warning text-center" role="alert">
                 <p><?php echo $this->session->flashdata('email_sent_warning'); ?></p>
                </div>
              </div>
          <?php endif; ?>
            <?php if(!validation_errors()) : ?>
            <div class="col-sm-12 col-md-12">
              <div class="alert alert-info" role="alert">
                Please fill up all the information.
              </div>
            </div>
          <?php else : ?>
            <div class="col-sm-12 col-md-12">
              <div class="alert alert-danger" role="alert">
                <ul>
                  <?php echo validation_errors('<li>','</li>'); ?>
                </ul>
              </div>
            </div>
          <?php endif;  ?>
            <div class="col-sm-12 col-md-4">
              <div class="form-group form-group-fName">
                <label for="LastName">Registered number:</label>
                <input type="text" class="form-control" id="regno" name="regno">
              </div>
            </div>

            <div class="col-sm-12 col-md-4">
              <div class="form-group form-group-fName">
                <label for="LastName">Last name:</label>
                <input type="text" class="form-control" id="LastName" name="LastName">
              </div>
            </div>

            <div class="col-sm-12 col-md-4">
              <div class="form-group form-group-fName">
                <label for="Name">Name:</label>
                <input type="text" class="form-control validate[required]" id="Name" name="Name">
              </div>
            </div>

            <div class="col-sm-12 col-md-4">
              <div class="form-group form-group-fName">
                <label for="middle_name">Middlename:</label>
                <input type="text" class="form-control" id="middle_name" name="middle_name">
              </div>
            </div>
            <div class="col-sm-12 col-md-4">
              <div class="form-group form-group-bDate">
                <label for="bDate"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top"
                data-html="true" title="<li>Age must be 18 years old and above.</li>"></i> Birth Date:</label>
                <input type="date" class="form-control validate[required,funcCall[validateAgeCustom]]" id="bDate" name="bDate">
              </div>
            </div>
            <div class="col-sm-12 col-md-4">
              <div class="form-group form-group-mNo">
                <label for="mNo"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top"
                data-html="true" title="<li>Must be 11 digit number starting in 0.</li><li>Only numbers are allowed.</li>"></i> Mobile Number:</label>
                <input type="text" class="form-control validate[required,custom[onlyMobileNumber]]" id="mNo" name="mNo" maxlength="11">
              </div>
            </div>
            <div class="col-sm-12 col-md-4">
              <div class="form-group form-group-eAddress">
                <label for="eAddress">Email Address:</label>
                <input type="email" class="form-control validate[required,custom[email]]" id="eAddress" name="eAddress">
              </div>
            </div>
            <div class="col-sm-12 col-md-4">
              <div class="form-group form-group-eAddress">
                <label for="eAddress">Confirm Email Address:</label>
                <input type="email" class="form-control validate[equals[eAddress]]" id="coneAddress" name="coneAddress">
              </div>
            </div>
            <div class="col-sm-12 col-md-8">
              <div class="form-group form-group-hAddress">
                <label for="hAddress">Home Address: </label>
                <textarea class="form-control validate[required]" style="resize: none;" id="hAddress" name="hAddress" rows="1"></textarea>
              </div>
            </div>
            <!-- <div class="col-sm-12 col-md-4">
              <div class="form-group form-group-pword">
                <label for="pword">Password:</label>
                <input type="password" class="form-control validate[required,minSize[4]]" id="pword" name="pword" >
              </div>
            </div>
            <div class="col-sm-12 col-md-4">
              <div class="form-group form-group-cPword">
                <label for="cPword">Confirm Password:</label>
                <input type="password" class="form-control validate[equals[pword]]" id="cPword" name="cPword">
              </div>
            </div> -->
            

            <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="Type of ID">Type of ID</label>
                <select class="custom-select validate[required]" id="type_id" name="type_id">
                <option value="">-----------</option>
                <?php foreach($list_id as $row): ?>
                  <option value="<?=$row['id']?>"><?php echo $row['id_name']; ?></option>

                <?php endforeach; ?>
               <!--  <option value="">National ID</option>
                <option value="Digitized Postal ID">Digitized Postal ID</option>
                <option value="Driver's License">Driver's License</option>
                <option value="GSIS E-Card">GSIS E-Card</option>
                <option value="IBP ID">IBP ID</option>
                <option value="OWWA ID">OWWA ID</option>
                <option value="Passport">Passport</option>
                <option value="PRC ID">PRC ID</option>
                <option value="Senior Citizen's ID">Senior Citizen's ID</option>
                <option value="SSS ID">SSS ID</option>
                <option value="TIN">TIN</option>
                <option value="Voter's ID">Voter's ID</option> -->
              </select>
              </div>
            </div>

            <div class="col-sm-12 col-md-4">
              <div class="form-group form-group-validIdNo">
                <label for="validIdNo">Valid ID No</label>
                <input type="text" class="form-control validate[required]" id="validIdNo" name="validIdNo">
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
                <select class="custom-select validate[required]" name="province" id="province" disabled>
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
                <label for="barangay">Barangay</label>
                <select class="custom-select validate[required]" name="barangay" id="barangay" disabled>
                </select>
              </div>
            </div>

            <div class="w-100"></div>
            <div class="col-sm-12 offset-md-3 col-md-6 align-self-end">
              <div class="form-group">
                <div class="custom-control custom-checkbox text-center mt-2">
                  <input type="checkbox" class="custom-control-input" id="signUpAgree" name="signUpAgree">
                  <label class="custom-control-label" for="signUpAgree"><strong>I confirm that the information given in this form is true, complete and accurate.</strong></label>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-12 col-md-2 text-center align-self-center order-xs-1 order-sm-1 order-2">
            <div class="row">
              <div class="col-md-6">
                <a class="btn btn-link" href="<?php echo base_url();?>users/login" role="button">Sign In Instead</a>
              </div>
              <div class="col-md-6">
                <a class="btn btn-link" href="<?php echo base_url();?>users/create_new_email_account" role="button">Create New  Email Account</a>
              </div>
            </div>
          </div>
          <div class="col-sm-12 offset-md-8 col-md-2 align-self-center order-xs-2 order-sm-2 order-1 col-signup-btn">
              <input class="btn btn-block btn-color-blue" type="submit" id="signUpBtn" name="signUpBtn" value="Submit" disabled>
          </div>
        </div>
      </div>
      <?php echo form_close(); ?> 
    </div>
  </div>
</div>
<script src="<?=base_url();?>assets/js/jquery-3.7.1.min.js"></script>
<script type="text/javascript">
  $('#region').on('change',function(){
      $('#province').empty();
      $("#province").prop("disabled",true);
      $('#city').empty();
      $("#city").prop("disabled",true);
      $('#barangay').empty();
      $("#barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#province").prop("disabled",false);
        var region = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../api/provinces",
          dataType: "json",
          data : {
            region: region
          },
          success: function(data){
            $('#province').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#province').append($('<option></option>').attr('value',value.provCode).text(value.provDesc));
            });
          }
        });
      }
    });

    $('#province').on('change',function(){
      $('#city').empty();
      $("#city").prop("disabled",true);
      $('#barangay').empty();
      $("#barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#city").prop("disabled",false);
        var province = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../api/cities",
          dataType: "json",
          data : {
            province: province
          },
          success: function(data){
            $('#city').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#city').append($('<option></option>').attr('value',value.citymunCode).text(value.citymunDesc));
            });
          }
        });
      }
    });

    $('#city').on('change',function(){
      $('#barangay').empty();
      $("#barangay").prop("disabled",true);
      if($(this).val() && ($(this).val()).length > 0){
        $("#barangay").prop("disabled",false);
        var cities = $(this).val();
          $.ajax({
          type : "POST",
          url  : "../api/barangays",
          dataType: "json",
          data : {
            cities: cities
          },
          success: function(data){
            $('#barangay').append($('<option></option>').attr('value',"").text(""));
            $.each(data, function(key,value){
              $('#barangay').append($('<option></option>').attr('value',value.brgyCode).text(value.brgyDesc));
            });
          }
        });
      }
    });
    
  $(document).ready(function(){
  $('#signUpAgree').click(function(){
      if ($(this).is(':checked')) {
      $("#signUpBtn").removeAttr('disabled');
      }
      else
      {
          $("#signUpBtn").attr('disabled','disabled');
      }
  });
    });
 
</script>
