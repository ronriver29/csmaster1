<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.css')?>" type="text/css"/>
<link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css')?>" type="text/css"/> 
<?php if($this->session->flashdata('redirect_applications_message')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('redirect_applications_message'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if($this->session->flashdata('error_redirect_applications_message')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('error_redirect_applications_message'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 25px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 22px;
  width: 22px;
  left: 4px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 15px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>




<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <h4>Allow Access Data</h4>
          </div>
        </div>
      </div>
      
      <div class="card-body">
            <?php
            foreach($list_access as $row)
            {
            ?>
           <!-- <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
              <label class="form-check-label" for="defaultCheck1">
                Default checkbox
              </label>
            </div>  -->
             <div class="row " >
              <div class="col-md-3" style="">
                <div class=" form-check" style="overflow: hidden;padding:8px;">
                <label class="form-check-label" for="defaultCheck1"><strong><?=$row['alias']?></strong></label>
                <label class="switch" style="float:right;">
                  <small><input type="checkbox" name="switchbtn" class="form-control onOff" id='defaultCheck1' value="<?=$row['table']?>" <?=($row['active']==1 ? 'checked' : '')?> style="float:right;border-bottom: 1px solid #ccc;">
                  <span class="slider round"></span></small>
                </label>
              </div>
              </div>
            
               </div>  <!-- <hr> -->
            <?php
            }
            ?>  
      </div>
    </div>
  </div>
</div>


<script src="<?=base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>   