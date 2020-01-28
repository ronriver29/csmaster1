<div class="row" style="margin-top: 40px;">
  <div class="col-sm-12 offset-md-4 col-md-4">
    <div class="card login-card shadow border-top-blue">
          <div class="card-body text-center">
            <?php echo form_open('admins/login'); ?>
              <h5 class="h5 mb-2 font-weight-bold">Cooperative Registration Information System</h5>
              <img class="mb-4 mt-4" src="<?=base_url()?>/assets/img/cda.png" alt="" width="80" height="80">
              <h1 class="h3 mb-4 font-weight-normal">Admin Log-In</h1>
              <div class="input-group mb-3 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text ">
                    <span style="width:15px; font-size: 15px;">
                      <i class="fas fa-user"></i>
                    </span>
                  </div>
                </div>
                <input type="text" class="form-control" name="usernameAdminLogin" id="usernameAdminLogin" placeholder="Username" required>
              </div>
              <div class="input-group mb-3 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span style="width: 15px;font-size: 15px;">
                      <i class="fas fa-lock"></i>
                    </span>
                  </div>
                </div>
                <input type="password" class="form-control" name="passwordAdminLogin" id="passwordAdminLogin" placeholder="Password" required>
              </div>
              <?php echo '<small class="text-danger form-text">'.$this->session->flashdata("login_admin_failed").'</small>';
              ?>
              <input class="btn btn-lg btn-primary btn-block btn-color-blue <?php echo ($this->session->flashdata("login_admin_failed") ? 'mt-4' : 'mt-5'); ?>" type="submit"></button>
            <?php echo form_close(); ?>
            <a class="btn btn-linnk" href="<?php echo base_url();?>users/login">Client Log-in</a>
          </div>

                   <div>
             <center>
              <ul>  
                  <li style="list-style: none;">  
                      Users Manual
                  </li>
                  <li style="list-style: none"><a class="" target="_blank" href="<?=base_url()?>users/users_manual/<?=encrypt_custom($this->encryption->encrypt('CDA_AdminAccount - Coop_Registration.pdf'))?>">Cooperative
                  </a>
                </li>

                    <li style="list-style: none">
                      <a class="" target="_blank" href="<?=base_url()?>users/users_manual/<?=encrypt_custom($this->encryption->encrypt('CDA_Admin_BranchRegistration.pdf'))?>">Branches & Satellite</a>
                    </li>

                      <li style="list-style: none"><a class="" target="_blank" href="<?=base_url()?>users/users_manual/<?=encrypt_custom($this->encryption->encrypt('CDA_Admin_LaboratoryRegistration.pdf'))?>">Laboratory</a>
                      </li>
              </ul>
            </center>
          </div>
          
        </div>
  </div>
</div>
