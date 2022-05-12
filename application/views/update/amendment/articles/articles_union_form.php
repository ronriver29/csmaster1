<?php
$directors_turnover_days='';
$guardian_cooperative='';
$years_of_existence='';
if(isset($articles_info))
{
  $directors_turnover_days = $articles_info->directors_turnover_days;
  $guardian_cooperative = $articles_info->guardian_cooperative;
  $years_of_existence = $articles_info->years_of_existence;
}

$common_share = '';
$par_value = '';
$authorized_share_capital  ='';
if(isset($capitalization_info))
{
  $common_share=$capitalization_info->common_share;
  $par_value = $capitalization_info->par_value;
  $authorized_share_capital = $capitalization_info->authorized_share_capital;
}

$kinds_of_members='';
if(isset($bylaw_info))
{
  $kinds_of_members = $bylaw_info->kinds_of_members;
}
?>
<style type="text/css">
  input[type="radio"] {
    box-shadow: none;
  }
</style>
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment_update/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
   <!--  <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 6
      <?php endif; ?>
    </h5> -->
  </div>
</div>
<?php if($this->session->flashdata('article_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
     <?php echo $this->session->flashdata('article_success'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('article_error')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger text-center" role="alert">
     <?php echo $this->session->flashdata('article_error'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if(validation_errors()) : ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger" role="alert">
      <ul>
        <?php echo validation_errors('<li>','</li>'); ?>
      </ul>
    </div>
  </div>
</div>
<?php endif;  ?>

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('amendment_update/'.$encrypted_id.'/article_union',array('id'=>'articlesPrimaryForm','name'=>'articlesPrimaryForm')); ?>
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-articles-primary">
            <h4 class="float-left">Details:</h4>
            <?php //if(($is_client && $coop_info->status<=1 || $coop_info->status==11 )):
             //if(($is_client && $coop_info->status<=1) || (!$is_client &&  $coop_info->status==3)): ?>
              <a class="btn btn-primary btn-sm float-right text-white" id="btnEditArticlesPrimary"><i class="fas fa-edit"></i> Edit</a>
            <?php //endif; ?>
          </div>
        </div>
      </div>
      <div class="card-body">
        <input type="hidden" class="form-control" id="article_coop_id" name="article_coop_id" value="<?=$encrypted_id ?>">
         <input type="hidden" class="form-control" id="article_coop_id" name="article_amendment_id" value="<?=$encrypted_articles_id ?>">
     
         <div class="row">
          <div class="col-sm-12 col-md-12 text-center">
            <p class="font-weight-bold h5 text-color-blue-custom">Article IV. Powers and Capacities</p>
          </div>
        </div>

         <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
                        <label for="cooperativeExistence"><strong>Applicable  to  Guardian Cooperative</strong></label>
                        <input type="radio" value="1" name="guardian_cooperative" <?php if($guardian_cooperative==1){ echo 'checked';}?>> Yes <input type="radio" value="0" name="guardian_cooperative" <?php if($guardian_cooperative==0){ echo 'checked';}?>> No
           </div>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-12 col-md-12 text-center">
            <p class="font-weight-bold h5 text-color-blue-custom">Article V. Term of Existence</p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
      		  <div class="form-group">
        			<label for="cooperativeExistence"><strong>How many years does the Cooperative should exist?</strong></label>
        			<input type="number" value="<?= $years_of_existence ?>"class="form-control "  name="cooperativeExistence" id="cooperativeExistence" placeholder="Years" disabled>
        			<small id="emailHelp" class="form-text text-muted">Start from the date of registration </small>
      		 </div>
      		</div>
        </div>
        
        </div>
      </div>
      <div class="card-footer articlesPrimaryFooter" style="display: none;">
        <input class="btn btn-primary btn-block" type="submit" id="articlesPrimaryBtn" name="articlesPrimaryBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
