<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 5
      <?php endif; ?>
    </h5>
  </div>
</div>
<?php if($this->session->flashdata('edit_purposes_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('edit_purposes_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('edit_purposes_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('edit_purposes_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if(!$purposes_complete): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info" role="alert">
      <strong>Reminder:</strong>
      <ul>
        <?php if(!$purpose_not_null) : ?><li>Please enter the purposes of the cooperative</li> <?php endif; ?>
        <?php if(!$purpose_blank_not_exists) : ?><li>Please fill up/remove all the blank.</li> <?php endif; ?>
      </ul>
    </div>
  </div>
</div>
<?php endif; ?>
<div class="row mt-2 mb-4"> 
  <?php if(($is_client && $is_update_cooperative && $coop_info->status ==15) || $this->session->userdata('access_level')==6):// if(($is_client && $coop_info->status<=1) || (!$is_client &&  $coop_info->status==3)): ?>
    <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
      <a href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>/amendment_purposes/edit" class="btn btn-color-blue btn-block" id="btnEditPurposes"><i class="fas fa-<?php echo (count(array_filter($contents)) > 0) ? "edit":"plus"?>"></i> <?php echo (count(array_filter($contents)) > 0) ? "Edit":"Add"?> Purposes</a>
    </div>
  <?php endif;?>
  <div class="col-sm-12 col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-purposes">
            <h4>That the purposes for which this Cooperative is organized are to engage in:</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
          
             <?php if(count(array_filter($contents)) > 0) :?>
            
              <?php foreach ($contents as $type_names) : ?>
                  <ol class="text-justified" type="1">
             <strong><span style="margin-left:-20px;"> <?php echo $type_names['cooperative_type'];?></span></strong><br><br>
                   <?php foreach  ($type_names['content_purpose'] as $row_content){?> 
                 <li class="mb-3"> <?= $row_content?></li> 
                <?php }//end foreac?> 
                  </ol>
                  <hr style="margin-top:40px;margin-bottom:40px;">
              <?php endforeach; ?>
          
          <?php else :?>
            <h5 class="text-center">Cooperative's purpose is empty.</h5>
          <?php endif;?> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
