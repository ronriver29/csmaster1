<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 5
      <?php endif; ?>
    </h5>
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
<div class="row mt-3">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info" role="alert">
      <strong>Reminder:</strong>
       <ul>
         <?php if($bylaw_info->kinds_of_members ==2) : ?>
           <li>The product of common shares and par value per common share must be <strong>75%</strong> of Authorized Shared Capital.</li>
           <li>The product of preferred shares and par value per preferred share must be <strong>25%</strong> of Authorized Shared Capital.</li>
           <li>The total number of common shares must be greater than or equal to <strong class="text-total-primary-subscribed-common-less"><?= $total_regular['total_subscribed'] ?></strong>.</li>
           <li>The total number of preferred shares must be greater than or equal to <strong class="text-total-primary-subscribed-preferred-less"><?= $total_associate['total_subscribed'] ?></strong>.</li>
        <?php else : ?>
          <li>The total subscribed common shares of all cooperator is <strong><?= $total_regular['total_subscribed'] ?></strong>.</li>
          <li>The total number of common shares must be greater than or equal to <strong class="text-total-primary-subscribed-common-less"><?= $total_regular['total_subscribed'] ?></strong> and less than or equal to <strong class="text-total-subscribed-common-greater"><?= $total_regular['total_subscribed']*4 ?></strong>.</li>
        <?php endif; ?>
       </ul>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('cooperatives/'.$encrypted_id.'/articles_primary',array('id'=>'articlesPrimaryForm','name'=>'articlesPrimaryForm')); ?>
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-articles-primary">
            <h4 class="float-left">Details:</h4>
            <?php if(($is_client && $coop_info->status<=1) || (!$is_client &&  $coop_info->status==3)): ?>
              <a class="btn btn-primary btn-sm float-right text-white" id="btnEditArticlesPrimary"><i class="fas fa-edit"></i> Edit</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="card-body">
        <input type="hidden" class="form-control" id="article_coop_id" name="article_coop_id" value="<?=$encrypted_id ?>">
        <div class="row">
          <div class="col-sm-12 col-md-12 text-center">
            <p class="font-weight-bold h5 text-color-blue-custom">Article V. Term of Existence</p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
      		  <div class="form-group">
        			<label for="cooperativeExistence"><strong>How many years does the Cooperative should exist?</strong></label>
        			<input type="number" value="<?= $articles_info->years_of_existence ?>"class="form-control validate[required,min[1],max[50],custom[integer]]" min="1" max="50" name="cooperativeExistence" id="cooperativeExistence" placeholder="Years" disabled>
        			<small id="emailHelp" class="form-text text-muted">Start from the date of registration </small>
      		 </div>
      		</div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12 text-center">
            <p class="font-weight-bold h5 text-color-blue-custom">Article IX. Board of Directors</p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
      		  <div class="form-group">
        			<label for="turnOverDirectors"><strong>The Board of Directors shall serve until their successors shall have been elected and qualified within ___ days from the date of registration as provided in the By-laws.</strong></label>
        			<input type="number" value="<?= $articles_info->years_of_existence ?>"class="form-control validate[required,min[1],custom[integer]]" min="1" step="any" name="turnOverDirectors" id="turnOverDirectors" placeholder="Days" disabled>
      		 </div>
      		</div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12 text-center">
            <p class="font-weight-bold h5 text-color-blue-custom">Article X. Capitalization</p>
          </div>
        </div>
        <div class="row">
      		<div class="col-sm-12 col-md-7">
      		  <div class="form-group">
      			<label for="commonShares"><strong>Authorized Shared Capital will be divided into how many common shares ?</strong></label>
      			 <input type="number" min="1" step="any" value="<?= $articles_info->common_share?>" class="form-control validate[required,min[<?php echo ($bylaw_info->kinds_of_members==1) ? $total_regular['total_subscribed']."],max[".($total_regular['total_subscribed']*4)."]" : $total_regular['total_subscribed']."]" ?> ,custom[number]]" id="commonShares" name="commonShares" placeholder="Shares" disabled>
      		 </div>
      		</div>
      		<div class="col-sm-12 col-md-5">
      		  <div class="form-group">
      			<label for="parValueCommon"><strong>What is the Par value per common share?</strong></label>
      			 <input type="number" min="1" step="any" value="<?= $articles_info->par_value_common?>" class="form-control validate[required,min[100],max[1000],custom[number]]" id="parValueCommon" name="parValueCommon" placeholder="&#8369;" disabled>
      		 </div>
      		</div>
          <?php if($bylaw_info->kinds_of_members==2): ?>
          <div class="col-sm-12 col-md-7">
      		  <div class="form-group">
      			<label for="preferredShares"><strong>Authorized Shared Capital will be divided into how many preferred shares ?</strong></label>
      			 <input type="number" min="1" step="any" value="<?= $articles_info->preferred_share?>" class="form-control validate[required,min[<?=$total_associate['total_subscribed'] ?>],custom[number]]" id="preferredShares" name="preferredShares" placeholder="Shares" disabled>
      		 </div>
      		</div>
      		<div class="col-sm-12 col-md-5">
      		  <div class="form-group">
      			<label for="parValuePreferred"><strong>What is the Par value per preferred share?</strong></label>
      			 <input type="text" min="1" step="any" value="<?= number_format($articles_info->par_value_preferred,2)?>" class="form-control validate[required,min[100],max[1000],custom[number]]" id="parValuePreferred" name="parValuePreferred" placeholder="&#8369;" disabled>
      		 </div>
      		</div>
        <?php endif ?>
        <div class="col-sm-12 col-md-12">
          <div class="form-group">
          <label for="authorizedShareCapital"><strong>The Authorized Share Capital of the Cooperative</strong></label>
          <!-- <input type="number" value="<?= $articles_info->authorized_share_capital?>" class="form-control validate[required,min[1],custom[integer],<?php echo ($bylaw_info->kinds_of_members==1) ? "funcCall[validateTotalAuthorizedShareCapitalRegularCustom]" : "funcCall[validateTotalAuthorizedShareCapitalAssociateCustom]" ?>]" id="authorizedShareCapital" name="authorizedShareCapital" min="1" placeholder="&#8369;" readonly> -->
          <input type="text"  step="any" min="1" value="<?= number_format($articles_info->authorized_share_capital,2)?>"  class="form-control validate[required,min[1],custom[number]<?php if($bylaw_info->kinds_of_members==2) echo ",funcCall[validateRegularAssociateAuthorizedCapitalCustom]";?>]"  id="authorizedShareCapital" name="authorizedShareCapital" placeholder="&#8369;" readonly>
         </div>
        </div>
        </div>
      </div>
      <div class="card-footer articlesPrimaryFooter" style="display: none;">
        <input class="btn btn-color-blue btn-block" type="submit" id="articlesPrimaryBtn" name="articlesPrimaryBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
