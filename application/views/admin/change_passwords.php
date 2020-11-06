<?php if($this->session->flashdata('change_password_msg')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 offset-md-4 col-md-4">
      <div class="alert alert-<?=$alert_class?> text-center" role="alert">
       <p><?php echo $this->session->flashdata('change_password_msg'); ?></p>
      </div>
    </div>
  </div>
<?php endif; ?>
<div class="row" style="margin-top: 40px;">
  <div class="col-sm-12 offset-md-4 col-md-4" style="">
   <!--  <div class="card login-card shadow border-top-blue">
          <div  class="card-body text-center">-->
          
              <?php echo form_open('admins/change_passwd'); ?>
              <!-- <img class="mb-4 mt-4" src="<?=base_url()?>/assets/img/cda.png" alt="" width="80" height="80"> -->
              <center><h1 class="h4 mb-4 font-weight-normal" style="font-style: italic;">Change Password</h1></center>
              <div class="input-group mb-3 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text ">
                   <!--  <span style="width:15px; font-size: 15px;">
                      <i class="fas fa-lock"></i>
                    </span> -->
                  </div>
                </div>
                <input type="password" class="form-control"  name="password" placeholder="Current password" required>
              </div>

              <div class="input-group mb-3 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text ">
                    <!-- <span style="width:15px; font-size: 15px;">
                      <i class="fas fa-lock"></i>
                    </span> -->
                  </div>
                </div>
                <input type="password" class="form-control" minlength="6" name="newpassword" placeholder="New password" required>
              </div>


              <div class="input-group mb-3 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text ">
                   <!--  <span style="width:15px; font-size: 15px;">
                      <i class="fas fa-lock"></i>
                    </span> -->
                  </div>
                </div>
                <input type="password" class="form-control" minlength="6" name="conf_password" placeholder="Confirm password" required>
              </div>
             
              <!-- <div class="input-group mb-3 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span style="width: 15px;font-size: 15px;">
                      <i class="fas fa-lock"></i>
                    </span>
                  </div>
                </div>
                <input type="password" class="form-control" name="passwordLogin" placeholder="Password" required>
              </div> -->
             
              <input class="btn btn-lg btn-primary btn-block btn-color-blue" type="submit" name="submit-change-passwd"></button>
            <?php echo form_close(); ?>
            <!-- <a class="btn btn-linnk" href="<?php echo base_url();?>admins/login">Admin Login</a> -->
         <!--    <a class="btn btn-linnk" href="<?php echo base_url();?>users/signup">Create an account</a><br>
            <a class="btn btn-linnk" href="<?php echo base_url();?>welcome">Home Page</a> -->
           
          </div>
        </div>
  </div>

</div>
