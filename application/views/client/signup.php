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
      <?php echo form_open('users/signup', 'name="signUpForm" id="signUpForm"');?>
        <div class="card-header">
          <h4><strong> Account Creation </strong></h4>
        </div>
      <div class="card-body">
          <div class="row">
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
                <input type="email" class="form-control validate[required,custom[email],ajax[ajaxEmailCallPhp]]" id="eAddress" name="eAddress">
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
            <div class="col-sm-12 col-md-4">
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
            </div>
            

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
            <a class="btn btn-link" href="<?php echo base_url();?>users/login" role="button">Sign In Instead</a>
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
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
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
