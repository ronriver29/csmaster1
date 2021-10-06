<?php if($this->session->flashdata('redirect_admin_applications_message')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-warning text-center" role="alert">
       <?php echo $this->session->flashdata('redirect_admin_applications_message'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('add_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('add_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('add_admin_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('add_admin_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('update_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('update_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('update_admin_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('update_admin_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('delete_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('delete_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('delete_admin_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('delete_admin_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <h5 class="text-primary text-right">API Settings</h5>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('api_settings/edit',array('id'=>'editAdministratorForm','name'=>'editAdministratorForm')); ?>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="form-group form-group-url">
              <label for="url">API Url:</label>
              <input type="text" class="form-control validate[required]" id="url" name="url" value="<?=$api_config->url?>">
            </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group form-group-apikey">
              <label for="apikey">API Key:</label>
              <input type="text" class="form-control validate[required]" id="apikey" name="apikey" value="<?=$api_config->apikey?>">
            </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group form-group-senderid">
              <label for="senderid">Sender ID:</label>
              <input type="text" class="form-control validate[required]" id="senderid" name="senderid" value="<?=$api_config->senderid?>">
            </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group form-group-maxchar">
              <label for="maxchar">Max Character:</label>
              <input type="number" class="form-control validate[required]" id="maxchar" name="maxchar" value="<?=$api_config->maxchar?>">
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer editAdministratorFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="editAdministratorBtn" name="editAdministratorBtn" value="Save">
      </div>
    </form>
    </div>
  </div>
</div>