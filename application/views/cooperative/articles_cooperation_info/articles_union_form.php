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
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
    </h5>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('cooperatives/'.$encrypted_id.'/articles_union',array('id'=>'articlesUnionForm','name'=>'articlesUnionForm')); ?>
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 col-md-4">
            <h4>Articles of Cooperation - Union Information:</h4>
          </div>
          <div class="col-sm-12 offset-md-7 col-md-1">
            <h5 class="text-primary">Step 5</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <input type="hidden" class="form-control" id="article_coop_id" name="article_coop_id" value="<?=$encrypted_id ?>">
        <div class="row">
          <div class="col-sm-12 col-md-12 text-center">
            <p class="font-weight-bold h5 text-color-blue-custom">Article IV. Powers and Capacities</p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
                        <label for="cooperativeExistence"><strong>Applicable  to  Guardian Cooperative</strong></label>
                        <input type="radio" value="1" name="guardian_cooperative" <?php if($articles_info->guardian_cooperative==1){ echo 'checked';}?>> Yes <input type="radio" value="0" name="guardian_cooperative" <?php if($articles_info->guardian_cooperative==0){ echo 'checked';}?>> No
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
      			<label for="cooperativeExistence"><strong>How many Years does the Cooperative Union should exist?</strong></label>
      			<input type="number" class="form-control" min="1" max="50" id="cooperativeExistence" name="cooperativeExistence" placeholder="Years" value="<?= $articles_info->years_of_existence ?>">
      			<small id="emailHelp" class="form-text text-muted">Start from the date of registration </small>
      		 </div>
      		</div>
        </div>
      </div>
      <div class="card-footer articlesUnionFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="articlesUnionBtn" name="articlesUnionBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
