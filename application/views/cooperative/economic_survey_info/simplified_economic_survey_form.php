<style>
.tree,
.tree ul,
.tree li {
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
}
.tree {
    margin: 0 0 1em;
    text-align: center;
}
.tree,
.tree ul {
    display: table;
}
.tree ul {
    width: 100%;
}
.tree li {
    display: table-cell;
    padding: .5em 0;
    vertical-align: top;
}
.tree li:before {
    outline: solid 1px #666;
    content: "";
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
}
.tree li:first-child:before {
    left: 50%;
}
.tree li:last-child:before {
    right: 50%;
}
.tree code,
.tree span {
    border: solid .1em #666;
    border-radius: .2em;
    display: inline-block;
    margin: 0 .2em .5em;
    padding: .2em .5em;
    position: relative;
}
.tree ul:before,
.tree code:before,
.tree span:before {
    outline: solid 1px #666;
    content: "";
    height: .5em;
    left: 50%;
    position: absolute;
}
.tree ul:before {
    top: -.5em;
}
.tree code:before,
.tree span:before {
    top: -.55em;
}
.tree>li {
    margin-top: 0;
}
.tree>li:before,
.tree>li:after,
.tree>li>code:before,
.tree>li>span:before {
    outline: none;
}
</style>
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client) : ?>
      Step 8
      <?php endif; ?>
    </h5>
  </div>
</div>
<?php if(!$this->session->flashdata('survey_update_success') && (!$this->session->flashdata('survey_update_error'))): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info" role="alert">
      Whatever information you enter in this form will appear in the <strong>Economic Survey</strong> document.
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('survey_update_success')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('survey_update_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('survey_update_error')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('survey_update_error'); ?>
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
      <?php // echo form_open('cooperatives/'.$encrypted_id.'/simplified_survey',array('id'=>'economicSurveyForm','name'=>'economicSurveyForm')); ?>
      <?php echo form_open('cooperatives/'.$encrypted_id.'/simplified_survey', 'name="economicSurveyForm" id="economicSurveyForm" enctype="multipart/form-data"');?>
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-survey-primary">
            <h4 class="float-left">Additional Information:</h4>
            <?php if(($is_client && $coop_info->status<=1) || ($is_client && $coop_info->status ==11)): ?>
              <a class="btn btn-primary btn-sm float-right text-white" id="btnEditEconomicSurvey"><i class="fas fa-edit"></i> Edit</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="card-body">
        <input type="hidden" class="form-control" id="survey_coop_id" name="survey_coop_id" value="<?=$encrypted_id ?>">
        <div class="row mb-2">
          <div class="col-sm-12 col-md-12">
            <p class="font-weight-bold h5 text-color-blue-custom">II. ECONOMIC ACTIVITIES</p>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label class="font-weight-bold h5 text-color-blue-custom" for="natureofbusiness">Proposed Nature of Business</label>
              <textarea class="form-control validate[required]" style="resize: none;" id="natureofbusiness" name="natureofbusiness" rows="4" disabled><?php if(isset($survey_info->nature_of_business)){ echo $survey_info->nature_of_business;}?></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label class="font-weight-bold h5 text-color-blue-custom" for="sourceofinitial">Sources of Initial Capital (Select as many as applicable)</label>
              </div>
          </div>
        </div>
        <div class="row mb-2 row-initial">
          <!-- <div class="col-sm-12 col-md-2">
            <div class="form-check">
              <?php if(empty($survey_info->initial_capital[0])){$survey_info->initial_capital[0]=0;}?>
              <input type="checkbox" class="form-check-input validate[minCheckbox[1]]" value="1" name="initial_capital[]" id="initial_capital_1" disabled <?=($survey_info->initial_capital[0] == 1 ?  "checked" : "")?> >
              <label class="form-check-label" for="registeredSec">Share Capital Subscription </label>
            </div>
          </div> -->
          <div class="col-sm-12 col-md-2">
            <div class="form-check">
              <?php if(empty($survey_info->initial_capital[0])){$survey_info->initial_capital[0]=0;}?>
              <input type="checkbox" class="form-check-input validate[minCheckbox[1]]" value="1" name="initial_capital[]" id="initial_capital_1" disabled <?=($survey_info->initial_capital[0] == 1 ?  "checked" : "")?> >
              <label class="form-check-label" for="registeredSec">Share Capital Subscription </label>
            </div>
          </div>
          <div class="col-sm-12 col-md-2">
            <div class="form-check">
              <?php if(empty($survey_info->initial_capital[1])){$survey_info->initial_capital[1]=0;}?>
              <input type="checkbox" class="form-check-input validate[minCheckbox[1]]" value="2" name="initial_capital[]" id="initial_capital_2" disabled <?=($survey_info->initial_capital[1] == 1 ?  "checked" : "")?> >
              <label class="form-check-label" for="registeredDole">Acquisition of Loans/borrowings </label>
            </div>
          </div>
          <div class="col-sm-12 col-md-2">
            <div class="form-check">
              <?php if(empty($survey_info->initial_capital[2])){$survey_info->initial_capital[2]=0;}?>
              <input type="checkbox" class="form-check-input validate[minCheckbox[1]]" value="3" name="initial_capital[]" id="initial_capital_3" disabled <?=($survey_info->initial_capital[2] == 1 ?  "checked" : "")?> >
              <label class="form-check-label" for="registeredDole">Solicitation/acceptance of donations, subsidies, grants, etc. </label>
            </div>
          </div>
          <div class="col-sm-12 col-md-2">
            <div class="form-check">
              <?php if(empty($survey_info->initial_capital[3])){$survey_info->initial_capital[3]=0;}?>
              <input type="checkbox" class="form-check-input validate[minCheckbox[1]]" value="4" name="initial_capital[]" id="initial_capital_4" disabled <?=($survey_info->initial_capital[3] == 1 ?  "checked" : "")?> >
              <label class="form-check-label" for="registeredDole">Fund raising activities </label>
            </div>
          </div>

        <div class="col-sm-12 col-md-3">
            <div class="form-check">  <!-- name='previouslyRegisteredWith_other' -->
              <input type="checkbox" class="form-check-input" value="3" name="initial_capital_other" id="initial_capital_other" disabled <?php if(isset($survey_info->initial_capital_others)) { if(strlen($survey_info->initial_capital_others) > 0)  echo "checked"; } ?> >
              <label class="form-check-label" for="registeredOthers">Others</label>
            </div>
        </div>
        <?php if(isset($survey_info->initial_capital_others)) { if(strlen($survey_info->initial_capital_others) > 0) :?>
        <div class="col-sm-12 col-md-12 col-initial-specify">
            <div class="form-group">
              <label for="initialCapitalSpecify">Specify Others:</label> <!-- name='registeredOthersSpecify' -->
              <input type="text" class="form-control validate[required]" name="initialCapitalSpecify" id="initialCapitalSpecify" value="<?php if(isset($survey_info->initial_capital_others)){ echo $survey_info->initial_capital_others; } ?>" disabled>
            </div>
          </div>
        <?php endif; } ?>
       </div>

        <div class="row mb-2">
          <div class="col-sm-12 col-md-12">
            <label class="font-weight-bold h5 text-color-blue-custom" for="sourceofinitial">Organizational Structure</label>
          </div>
        </div>

        See generated Economic Survey

      </div>
      <div class="card-footer economicSurveyFooter" style="display:none;">
        <input class="btn btn-color-blue btn-block" type="submit" id="economicSurveyBtn" name="economicSurveyBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
