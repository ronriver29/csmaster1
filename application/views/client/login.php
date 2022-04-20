<?php if($this->session->flashdata('email_sent_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 offset-md-4 col-md-4">
      <div class="alert alert-success text-center" role="alert">
       <p><?php echo $this->session->flashdata('email_sent_success'); ?></p>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('email_sent_warning')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 offset-md-4 col-md-4">
      <div class="alert alert-warning text-center" role="alert">
       <p><?php echo $this->session->flashdata('email_sent_warning'); ?></p>
      </div>
    </div>
  </div>
<?php endif; ?>
<div class="row" <?php if(!$this->session->flashdata('email_sent_success')) echo 'style="margin-top: 40px;"'?>>
  <div class="col-sm-12 offset-md-4 col-md-4">
    <div class="card login-card shadow border-top-blue">
          <div class="card-body text-center">
            <?php echo form_open('users/login'); ?>
              <h5 class="h5 mb-2 font-weight-bold">Cooperative Registration Information System</h5>
              <img class="mb-4 mt-4" src="<?=base_url()?>/assets/img/cda.png" alt="" width="80" height="80">
              <h1 class="h3 mb-4 font-weight-normal">Client Login</h1>
              <div class="input-group mb-3 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text ">
                    <span style="width:15px; font-size: 15px;">
                      <i class="fas fa-envelope"></i>
                    </span>
                  </div>
                </div>
                <input type="email" style="box-shadow:none" class="form-control" name="eAddressLogin" placeholder="Email Address" required>
              </div>
              <div class="input-group mb-3 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span style="width: 15px;font-size: 15px;">
                      <i class="fas fa-lock"></i>
                    </span>
                  </div>
                </div>
                <input type="password" style="box-shadow:none" class="form-control" name="passwordLogin" placeholder="Password" required>
              </div>
              <?php echo '<small class="text-danger form-text">'.$this->session->flashdata("login_failed").'</small>';
              ?>
              <input class="btn btn-lg btn-primary btn-block btn-color-blue <?php echo ($this->session->flashdata("login_failed") ? 'mt-4' : 'mt-5'); ?>" type="submit"></button>
            <?php echo form_close(); ?>
            <!-- <a class="btn btn-linnk" href="<?php echo base_url();?>admins/login">Admin Login</a> -->
            <div>
            <a class="btn btn-link" href="<?php echo base_url('/users/signup');?>" style="float:left;">New Registration</a>
            

            <a class="btn btn-link" href="<?= base_url('/Users/forgot_password')?>" style="float:right;">Forgot password</a>

          </div>
          <a class="btn btn-linnk" href="<?php echo base_url();?>welcome">Home Page</a><br>
          <a class="btn btn-link" data-toggle="modal" data-target="#deleteCooperativeModal" href="" role="button">Click here if registered before September 1, 2020</a>
            
            
            <br/>
            

          </div>
          <div>

             <center>
              <ul>  
                  <li style="list-style: none">  
                      Users Manual
                  </li>
                  <li style="list-style: none"><a class="" target="_blank" href="<?=base_url()?>users/users_manual/<?=encrypt_custom($this->encryption->encrypt('CDA_ClientAccount - Coop_Registration.pdf'))?>">Cooperative
                  </a>
                </li>
                <?php /*
                    <li style="list-style: none">
                      <a class="" target="_blank" href="<?=base_url()?>users/users_manual/<?=encrypt_custom($this->encryption->encrypt('CDA_Client_BranchRegistration.pdf'))?>">Branches & Satellite</a>
                    </li>

                      <li style="list-style: none"><a class="" target="_blank" href="<?=base_url()?>users/users_manual/<?=encrypt_custom($this->encryption->encrypt('CDA_Client_LaboratoyRegistration.pdf'))?>">Laboratory</a>
                      </li>
                      */?>
              </ul>
            </center>
          </div>
        </div>
  </div>

</div>
