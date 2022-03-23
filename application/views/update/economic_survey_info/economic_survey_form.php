<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives_update/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client) : ?>
      Step 8
      <?php endif; ?>
    </h5>
  </div>
</div>
<?php // if(!$this->session->flashdata('survey_update_success') && (!$this->session->flashdata('survey_update_error'))): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info" role="alert">
      Whatever information you enter in this form will appear in the <strong>Economic Survey</strong> document. <br><br>
      <ul>
      <?php
        if(!isset($survey_info->background) || $survey_info->background == '') echo '<li><b>"Background" must not be empty.<b></li>';
        if(!isset($survey_info->rationale) || $survey_info->rationale == '') echo '<li><b>"Rationale" must not be empty.<b></li>';
        if(!isset($survey_info->increase_first_year) || $survey_info->increase_first_year == 0) echo '<li><b>General Information. "First Year" must not be empty.<b></li>';
        if(!isset($survey_info->increase_second_year) || $survey_info->increase_second_year == 0) echo '<li><b>General Information. "Second Year" must not be empty.<b></li>';
        if(!isset($survey_info->increase_third_year) || $survey_info->increase_third_year == 0) echo '<li><b>General Information. "Third Year" must not be empty.<b></li>';
        if(!isset($survey_info->exisiting_cooperative_same_area) || $survey_info->exisiting_cooperative_same_area == '') echo '<li><b>"Economic Aspect" must not be empty.<b></li>';
        if(!isset($survey_info->strategies_support_members) || $survey_info->strategies_support_members == '' || $survey_info->strategies_support_members == 0) echo '<li><b>"Strategies Support Members" must not be empty.<b></li>';
        if(!isset($survey_info->transact_business_with) || $survey_info->transact_business_with == '') echo '<li><b>"Intending to Business with" must not be empty.<b></li>';
        if(!isset($survey_info->bactivities_plans_first_year) || $survey_info->bactivities_plans_first_year == '') echo '<li><b>Strategic Operational Studies. "First year" must not be empty.<b></li>';
        if(!isset($survey_info->bactivities_plans_second_year) || $survey_info->bactivities_plans_second_year == '') echo '<li><b>Strategic Operational Studies. "Second Year" must not be empty.<b></li>';
        if(!isset($survey_info->bactivities_plans_third_year) || $survey_info->bactivities_plans_third_year == '') echo '<li><b>Strategic Operational Studies. "Third Year" must not be empty.<b></li>';
        if(!isset($survey_info->generate_capital) || $survey_info->generate_capital == '' || $survey_info->generate_capital == 0) echo '<li><b>"Economic Activities" must not be empty.<b></li>';
        if(!isset($survey_info->strategy_capital_build_up) || $survey_info->strategy_capital_build_up == '') echo '<li><b>"Strategies for internal capital build-up" must not be empty.<b></li>';
        if(!isset($survey_info->revenue_first_year) || $survey_info->revenue_first_year == 0) echo '<li><b>"Revenue First Year" must not be empty.<b></li>';
        if(!isset($survey_info->revenue_second_year) || $survey_info->revenue_second_year == 0) echo '<li><b>"Revenue Second Year" must not be empty.<b></li>';
        if(!isset($survey_info->revenue_third_year) || $survey_info->revenue_third_year == 0) echo '<li><b>"Revenue Third Year" must not be empty.<b></li>';
        if(!isset($survey_info->expenditure_first_year) || $survey_info->expenditure_first_year == 0) echo '<li><b>"Expenditure First Year" must not be empty.<b></li>';
        if(!isset($survey_info->expenditure_second_year) || $survey_info->expenditure_second_year == 0) echo '<li><b>"Expenditure Second Year" must not be empty.<b></li>';
        if(!isset($survey_info->expenditure_third_year) || $survey_info->expenditure_third_year == 0) echo '<li><b>"Expenditure Third Year" must not be empty.<b></li>';
        if(!isset($survey_info->investments) || $survey_info->investments == '' || $survey_info->investments == 0) echo '<li><b>"Cooperative Investment" must not be empty.<b></li>';
        if(!isset($survey_info->equipments_etc) || $survey_info->equipments_etc == '' || $survey_info->equipments_etc == 0) echo '<li><b>"Equipments" must not be empty.<b></li>';
        if(!isset($survey_info->procure_equipments_etc) || $survey_info->procure_equipments_etc == '') echo '<li><b>"Procure Equipment" must not be empty.<b></li>';
        if(!isset($survey_info->skills_etc_necessary_equipments_etc) || $survey_info->skills_etc_necessary_equipments_etc == '') echo '<li><b>"Necessary for the Operation" must not be empty.<b></li>';
        if(!isset($survey_info->qualifications_directors) || $survey_info->qualifications_directors == '') echo '<li><b>"Board of Directors Qualification" must not be empty.<b></li>';
        if(!isset($survey_info->education_programs_members) || $survey_info->education_programs_members == '') echo '<li><b>"Members" must not be empty.<b></li>';
        if(!isset($survey_info->education_programs_officers) || $survey_info->education_programs_officers == '') echo '<li><b>"Officers" must not be empty.<b></li>';
        if(!isset($survey_info->education_programs_staff) || $survey_info->education_programs_staff == '') echo '<li><b>"Staff" must not be empty.<b></li>';
      ?>
    </ul>
    </div>
  </div>
</div>
<?php // endif; ?>
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
      <?php echo form_open('cooperatives_update/'.$encrypted_id.'/survey_update',array('id'=>'economicSurveyForm','name'=>'economicSurveyForm')); ?>
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-survey-primary">
            <h4 class="float-left">Additional Information:</h4>
            <?php if(($is_client && $coop_info->status!=40 && $coop_info->status != 39) || (!$is_client && $coop_info->status==40 && $coop_info->status != 39)): ?>
              <a class="btn btn-primary btn-sm float-right text-white" id="btnEditEconomicSurvey"><i class="fas fa-edit"></i> Edit</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="card-body">
        <input type="hidden" class="form-control" id="survey_coop_id" name="survey_coop_id" value="<?=$encrypted_id ?>">
        <div class="row mb-2">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label class="font-weight-bold h5 text-color-blue-custom" for="backgroundCooperative">Background</label>
              <textarea class="form-control" style="resize: none;" id="backgroundCooperative" name="backgroundCooperative" rows="4" disabled><?=(isset($survey_info->background) ?  $survey_info->background : "") ?></textarea>
            </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label class="font-weight-bold h5 text-color-blue-custom" for="rationaleCooperative">Rationale</label>
              <textarea class="form-control" style="resize: none;" id="rationale" name="rationaleCooperative" rows="4" disabled><?=(isset($survey_info->rationale) ?  $survey_info->rationale : "") ?></textarea>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-12 col-md-12">
            <p class="font-weight-bold h5 text-color-blue-custom">I. General Information</p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <strong class="text-justify">What is the projected increase of Membership for:</strong>
              </div>
          </div>
          <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="increaseFirst"><strong>First year</strong></label>
                <input type="number" value="<?=(isset($survey_info->increase_first_year) ?  $survey_info->increase_first_year : "") ?>" class="form-control" id="increaseFirst" name="increaseFirst" disabled>
              </div>
          </div>
          <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="increaseSecond"><strong>Second year</strong></label>
                <input type="number" value="<?=(isset($survey_info->increase_second_year) ?  $survey_info->increase_second_year : "") ?>" class="form-control" name="increaseSecond" id="increaseSecond" disabled>
              </div>
          </div>
          <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="increaseThird"><strong>Third year</strong></label>
                <input type="number" value="<?=(isset($survey_info->increase_third_year) ?  $survey_info->increase_third_year : "") ?>" class="form-control" name="increaseThird" id="increaseThird" disabled>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <strong class="text-justify">Is the proposed cooperative previously registered with?</strong>
              </div>
          </div>
        </div>

        <div class="row mb-2 row-pre-reg">
            <div class="col-sm-12 col-md-3">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" value="1" name="previouslyRegisteredWith" id="registeredSec" disabled <?php if(isset($survey_info->previously_registered_with)){ if($survey_info->previously_registered_with == 1){ echo "checked"; } }  ?> >
              <label class="form-check-label" for="registeredSec">SEC</label>
            </div>
          </div>
          <div class="col-sm-12 col-md-2">
            <div class="form-check">
              <input type="checkbox" class="form-check-input " value="2" name="previouslyRegisteredWith_dole" id="registeredDole" disabled <?php if(isset($survey_info->previously_registered_with_dole)){ if($survey_info->previously_registered_with_dole == 1){ echo "checked"; } }  ?> >
              <label class="form-check-label" for="registeredDole">DOLE</label>
            </div>
          </div>  

               <div class="col-sm-12 col-md-2">
            <div class="form-check">
              <input type="checkbox" class="form-check-input " value="4" name="previously_registered_with_none" id="registeredDole" disabled <?php if(isset($survey_info->previously_registered_with_none)){ if($survey_info->previously_registered_with_none == 1){ echo "checked"; } }  ?> >
              <label class="form-check-label" for="registeredDole">None</label>
            </div>
          </div> 
        


     
        <div class="col-sm-12 col-md-3">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" value="3" name="previouslyRegisteredWith_other" id="registeredOthers" disabled <?php if(isset($survey_info->previously_registered_with_others)){ if($survey_info->previously_registered_with_others == 1){ echo "checked"; } }  ?> >
              <label class="form-check-label" for="registeredOthers">Others</label>
            </div>
          </div>
          <?php if(isset($survey_info->previously_registered_with_others)){
                  if(strlen($survey_info->previously_registered_with_others)> 0) { ?>
          <div class="col-sm-12 col-md-12 col-registered-specify">
            <div class="form-group">
              <label for="registeredOthersSpecify">Specify Others:</label>
              <input type="text" class="form-control validate[required]" name="registeredOthersSpecify" id="registeredOthersSpecify" value="<?=(isset($survey_info->previously_registered_with_others) ?  $survey_info->previously_registered_with_others : "") ?>" disabled>
            </div>
          </div>
          <?php } 
          } ?>
       </div>

    
        <div class="row mb-2">
          <div class="col-sm-12 col-md-12">
            <p class="font-weight-bold h5 text-color-blue-custom">II. Strategic Operational Studies</p>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-12 col-md-12">
            <p class="h6 font-weight-bold text-color-blue-custom">A. <em>Economic Aspect</em></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label for="sameArea"><strong>Are there any other existing cooperative/s within your proposed area of operation that provide the same goods/services which the cooperative plans to offer? If yes, please state the name/s of such cooperative/s otherwise enter "None": </strong></label>
              <input type="text" value="<?=(isset($survey_info->exisiting_cooperative_same_area) ?  $survey_info->exisiting_cooperative_same_area : "") ?>" class="form-control" name="sameArea" id="sameArea" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <strong class="text-justify">What strategies the cooperative shall implement to ensure the support of the members?</strong>
              </div>
          </div>
        </div>
        <div class="row row-strat">
          <div class="col-sm-12 col-md-4">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" value="1" name="strategiesSupport[]" id="collectivePurchases" disabled <?php if(!empty($survey_info->strategies_support_members[0])){ if($survey_info->strategies_support_members[0] == 1) { echo "checked"; } }?>>
              <label class="form-check-label" for="collectivePurchases">Collective purchases</label>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" value="2" name="strategiesSupport[]" id="lendingPolicies" disabled <?php if(!empty($survey_info->strategies_support_members[1])){ if($survey_info->strategies_support_members[1] == 1) { echo "checked"; } }?>>
              <label class="form-check-label" for="lendingPolicies">Commitment on lending policies</label>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" value="3" name="strategiesSupport[]" id="activeParticipation" disabled <?php if(!empty($survey_info->strategies_support_members[2])){ if($survey_info->strategies_support_members[2] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="activeParticipation">Active participation in cooperative affairs</label>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-check">

              <input type="checkbox" class="form-check-input" value="4"  name="strategiesSupport[]" id="strategiesSupportOthers" disabled <?=(isset($survey_info->strategies_support_members_others) ? (strlen($survey_info->strategies_support_members_others)> 0 ?  "checked" :"") : "") ?>>
              <label for="strategiesSupportOthers">Others</label>
            </div>
          </div>
          <?php if(isset($survey_info->strategies_support_members_others)) : if(strlen($survey_info->strategies_support_members_others)> 0) :?>
          <div class="col-sm-12 col-md-12 col-strategies-specify">
            <div class="form-group">
              <label for="strategiesSupportOthersSpecify">Specify others strategies:</label>
              <input type="text" class="form-control validate[required]" name="strategiesSupportOthersSpecify" id="strategiesSupportOthersSpecify" disabled value="<?=(isset($survey_info->strategies_support_members_others) ?  $survey_info->strategies_support_members_others : "") ?>">
            </div>
          </div>
          <?php endif; ?>
        <?php endif; ?>
          <div class="w-100">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="transactBusiness"><strong>Are you intending to business with?</strong></label>
              <select class="custom-select" name="transactBusiness" id="transactBusiness" disabled>
                <option value="" selected>--</option>
                <option value="1" <?php if(isset($survey_info->transact_business_with)){ if($survey_info->transact_business_with == 1) echo "selected"; }?>>Members Only</option>
                <option value="2" <?php if(isset($survey_info->transact_business_with)){ if($survey_info->transact_business_with == 2) echo "selected"; }?>>Members and Non-members</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <strong class="text-justify">What business activities the Cooperative plans to undertake during the first three years of its operation:</strong>
              </div>
          </div>
          <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="businessActivityFirst"><strong>First year</strong></label>
                <input type="text" class="form-control" name="businessActivityFirst"id="businessActivityFirst" disabled value="<?=(isset($survey_info->bactivities_plans_first_year) ?  $survey_info->bactivities_plans_first_year : "") ?>">
              </div>
          </div>
          <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="businessActivitySecond"><strong>Second year</strong></label>
                <input type="text" class="form-control" name="businessActivitySecond" id="businessActivitySecond" disabled value="<?=(isset($survey_info->bactivities_plans_second_year) ?  $survey_info->bactivities_plans_second_year : "") ?>">
              </div>
          </div>
          <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="businessActivityThird"><strong>Third year</strong></label>
                <input type="text" class="form-control" name="businessActivityThird" id="businessActivityThird" disabled value="<?=(isset($survey_info->bactivities_plans_third_year) ?  $survey_info->bactivities_plans_third_year : "") ?>">
              </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-12 col-md-12">
            <p class="h6 font-weight-bold text-color-blue-custom">B. <em>Financial Aspect</em></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <strong>In pursuing its economic activities, how shall the Cooperative generate its capital?</strong>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="generateCapital[]" id="capitalSubscription" disabled <?php if(!empty($survey_info->generate_capital[0])){ if($survey_info->generate_capital[0] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="capitalSubscription">
                Share Capital Subscription
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="2" name="generateCapital[]" id="deferredPayment" disabled <?php if(!empty($survey_info->generate_capital[1])){ if($survey_info->generate_capital[1] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="deferredPayment">
                Deferred payment of patronage refund/interest on share capital (Revolving Capital)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="3" name="generateCapital[]" id="acquisitionLoans" disabled <?php if(!empty($survey_info->generate_capital[2])){ if($survey_info->generate_capital[2] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="acquisitionLoans">
                Acquisition of Loans/borrowings
              </label>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="4" name="generateCapital[]" id="solicitationDonations" disabled <?php if(!empty($survey_info->generate_capital[3])){ if($survey_info->generate_capital[3] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="solicitationDonations">
                Solicitation/acceptance of donations, subsidies, grants, etc.
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="5" name="generateCapital[]" id="fundRaising" disabled  <?php if(!empty($survey_info->generate_capital[4])){ if($survey_info->generate_capital[4] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="fundRaising">
                Fund raising activities
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="initialCapital"><strong>How much is the cooperative's initial operating capital</strong></label>
                <input type="number" class="form-control" id="initialCapital" name="initialCapital" value="<?= $InitialCapital?>" >
              </div>
          </div>
          <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="strategyCapitalBuildUp"><strong>Strategies for internal capital build-up:</strong></label>
                <textarea type="text" class="form-control" name="strategyCapitalBuildUp" id="strategyCapitalBuildUp" disabled value=""><?=(isset($survey_info->strategy_capital_build_up) ?  $survey_info->strategy_capital_build_up : "") ?></textarea>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Projected revenue based on the initial operating capital:</strong>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="revenueFirst"><strong>First year</strong></label>
                <input type="number" class="form-control" name="revenueFirst" id="revenueFirst" disabled value="<?=(isset($survey_info->revenue_first_year) ?  $survey_info->revenue_first_year : "") ?>">
              </div>
          </div>
          <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="revenueSecond"><strong>Second year</strong></label>
                <input type="number" class="form-control" name="revenueSecond" id="revenueSecond" disabled value="<?=(isset($survey_info->revenue_second_year) ?  $survey_info->revenue_second_year : "") ?>">
              </div>
          </div>
          <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="revenueThird"><strong>Third year</strong></label>
                <input type="number" class="form-control" name="revenueThird" id="revenueThird" disabled value="<?=(isset($survey_info->revenue_third_year) ?  $survey_info->revenue_third_year : "") ?>">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <strong>How much is the estimated expenses, for:</strong>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="expenditureFirst"><strong>First year</strong></label>
                <input type="number" class="form-control" name="expenditureFirst" id="expenditureFirst" disabled value="<?=(isset($survey_info->expenditure_first_year) ?  $survey_info->expenditure_first_year : "") ?>">
              </div>
          </div>
          <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="expenditureSecond"><strong>Second year</strong></label>
                <input type="number" class="form-control" name="expenditureSecond" id="expenditureSecond" disabled value="<?=(isset($survey_info->expenditure_second_year) ?  $survey_info->expenditure_second_year : "") ?>">
              </div>
          </div>
          <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="expenditureThird"><strong>Third year</strong></label>
                <input type="number" class="form-control" name="expenditureThird" id="expenditureThird" disabled value="<?=(isset($survey_info->expenditure_third_year) ?  $survey_info->expenditure_third_year : "") ?>">
              </div>
          </div>
        </div>
        <div class="row mb-2 row-investments">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Does the Cooperative intend to invest in the following?</strong>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="investments[]" id="cooperativeBank" disabled  <?php if(!empty($survey_info->investments[0])){ if($survey_info->investments[0] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="cooperativeBank">
                Cooperative bank
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="2" name="investments[]" id="federation" disabled <?php if(!empty($survey_info->investments[1])){ if($survey_info->investments[1] == 1) { echo "checked" ; } } ?>>
              <label class="form-check-label" for="federation">
                Federation
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="3" name="investments[]" id="jointVentures" disabled <?php if(!empty($survey_info->investments[2])){ if($survey_info->investments[2] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="jointVentures">
                Joint ventures
              </label>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="4" name="investments[]" id="mutual" disabled <?php if(!empty($survey_info->investments[3])){ if($survey_info->investments[3] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="mutual">
                Mutual
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="5" name="investments[]" id="insurance" disabled <?php if(!empty($survey_info->investments[4])){ if($survey_info->investments[4] == 1) { echo "checked" ; } } ?>>
              <label class="form-check-label" for="insurance">
                Insurance
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="6" name="investments[]" id="investOthers" disabled <?php if(isset($survey_info->investments_others)) { if(strlen($survey_info->investments_others) > 0)  "checked"; } ?>>
              <label class="form-check-label" for="investOthers">
                Others
              </label>
            </div>
          </div>
          <div class="w-100"></div>
           <?php if(isset($survey_info->investments_others)) { if(strlen($survey_info->investments_others) > 0)   : ?>
          <div class="col-sm-12 col-md-12 col-investments-specify">
            <div class="form-group"><label for="investOthersSpecify">Specify other investments:</label>
              <input type="text" class="form-control validate[required]" name="investOthersSpecify" id="investOthersSpecify" disabled value="<?= $survey_info->investments_others?>">
            </div>
          </div>
        <?php endif; } ?>
        </div>
        <div class="row mb-2">
          <div class="col-sm-12 col-md-12">
            <p class="h6 font-weight-bold text-color-blue-custom">C. <em>Technical Aspect</em></p>
          </div>
        </div>
        <div class="row row-equipments">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <strong class="text-justify">What equipment/machineries/facilities are deemed necessary for the effective and efficient operation of the Cooperative? (please check)</strong>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="equipments[]" id="typewriter" disabled <?php if(!empty($survey_info->equipments_etc[0])){ if($survey_info->equipments_etc[0] == 1) { echo "checked"; } }?>>
              <label class="form-check-label" for="typewriter">
                Typewriter
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="2" name="equipments[]" id="computer" disabled <?php if(!empty($survey_info->equipments_etc[1])){ if($survey_info->equipments_etc[1] == 1) { echo "checked"; } }?>>
              <label class="form-check-label" for="computer">
                Computer
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="3" name="equipments[]"  id="tables" disabled <?php if(!empty($survey_info->equipments_etc[2])){ if($survey_info->equipments_etc[2] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="tables">
                Tables
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="4" name="equipments[]"  id="chairs" disabled <?php if(!empty($survey_info->equipments_etc[3])){ if($survey_info->equipments_etc[3] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="chairs">
                Chairs
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="5" name="equipments[]"  id="calculator" disabled <?php if(!empty($survey_info->equipments_etc[4])){ if($survey_info->equipments_etc[4] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="calculator">
                Calculator
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="6" name="equipments[]"  id="vault" disabled <?php if(!empty($survey_info->equipments_etc[5])){ if($survey_info->equipments_etc[5] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="vault">
                Vault/Safe
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="7" name="equipments[]"  id="fillingCabinet" disabled <?php if(!empty($survey_info->equipments_etc[6])){ if($survey_info->equipments_etc[6] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="fillingCabinet">
                Filing Cabinet
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="8" name="equipments[]"  id="medicalIntruments" disabled <?php if(!empty($survey_info->equipments_etc[7])){ if($survey_info->equipments_etc[7] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="medicalIntruments">
                Medical Instruments
              </label>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="9" name="equipments[]"  id="warehouse" disabled <?php if(!empty($survey_info->equipments_etc[8])){ if($survey_info->equipments_etc[8] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="warehouse">
                Warehouse
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="10" name="equipments[]"  id="milling" disabled <?php if(!empty($survey_info->equipments_etc[9])){ if($survey_info->equipments_etc[9] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="milling">
                Milling
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="11" name="equipments[]"  id="farmEquipment" disabled <?php if(!empty($survey_info->equipments_etc[10])){ if($survey_info->equipments_etc[10] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="farmEquipment">
                Farm Equipment
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="12" name="equipments[]"  id="postHarvestEquipment" disabled <?php if(!empty($survey_info->equipments_etc[11])){ if($survey_info->equipments_etc[11] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="postHarvestEquipment">
                Post Harvest Equipment
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="13" name="equipments[]"  id="solarDryer" disabled <?php if(!empty($survey_info->equipments_etc[12])){ if($survey_info->equipments_etc[12] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="solarDryer">
                Solar Dryer
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="14" name="equipments[]"  id="fishingEquipment" disabled <?php if(!empty($survey_info->equipments_etc[13])){ if($survey_info->equipments_etc[13] == 1) {echo "checked"; } }?>>
              <label class="form-check-label" for="fishingEquipment">
                Fishing Equipment
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="15" name="equipments[]"  id="equipmentOthers" disabled <?=(isset($survey_info->equipments_etc_others) ? (strlen($survey_info->equipments_etc_others) >0 ? "checked" : "") : "") ?>>
              <label class="form-check-label" for="equipmentOthers">
                Others
              </label>
            </div>
          </div>
          <div class="w-100"></div>
          <?php if(isset($survey_info->equipments_etc_others)) { if(strlen($survey_info->equipments_etc_others) >0) : ?>
            <div class="col-sm-12 col-md-12 col-equipments-specify">
              <div class="form-group">
                <label for="equipmentOthersSpecify">Specify other equipments:</label>
                <input type="text" class="form-control validate[required]" name="equipmentOthersSpecify" id="equipmentOthersSpecify" disabled value="<?= $survey_info->equipments_etc_others ?>">
              </div>
            </div>
          <?php endif; } ?>
        </div>
        <div class="row row-procurements">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <strong class="text-justify">How would the Cooperative procure its equipment/machineries/facilities?</strong>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-check">=
              <input class="form-check-input" type="checkbox" value="1" name="procureEquipments[]" id="procureCashPurchase" disabled <?php if(!empty($survey_info->procure_equipments_etc[0])){ if($survey_info->procure_equipments_etc[0] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="procureCashPurchase">
                Cash purchase
              </label>
            </div>
            <div class="form-check">=
              <input class="form-check-input" type="checkbox" value="2" name="procureEquipments[]" id="procureLoans" disabled <?php if(!empty($survey_info->procure_equipments_etc[1])){ if($survey_info->procure_equipments_etc[1] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="procureLoans">
                Loans
              </label>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-check">=
              <input class="form-check-input" type="checkbox" value="3" name="procureEquipments[]" id="procureDonations" disabled <?php if(!empty($survey_info->procure_equipments_etc[2])){ if($survey_info->procure_equipments_etc[2] == 1) { echo "checked"; } } ?>>
              <label class="form-check-label" for="procureDonations">
                Donations
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="4" name="procureEquipments[]" id="procureEquipmentOthers" disabled <?php if(isset($survey_info->procure_equipments_etc_others)){ if(strlen($survey_info->procure_equipments_etc_others) > 0) echo "checked"; } ?>>
              <label class="form-check-label" for="procureEquipmentOthers">
                Other Mode/s
              </label>
            </div>
          </div>
          <?php if(isset($survey_info->procure_equipments_etc_others)) { if(strlen($survey_info->procure_equipments_etc_others) > 0) : ?>
          <div class="col-sm-12 col-md-12 col-procurements-specify">
            <div class="form-group">
              <label for="procureEquipmentOthersSpecify">Specify other mode/s:</label>
              <input type="text" class="form-control validate[required]" name="procureEquipmentOthersSpecify" id="procureEquipmentOthersSpecify" disabled value="<?= $survey_info->procure_equipments_etc_others?>">
            </div>
          </div>
          <?php endif; } ?>
        </div>
        <div class="row mb-2">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label class="text-justify" for="necessarySkills"><strong>What skills/experiences/trainings are deemed necessary for the operation of its equipment/machineries/facilities?</strong></label>
              <textarea class="form-control" style="resize: none;" name="necessarySkills" id="necessarySkills" rows="2" disabled><?=(isset($survey_info->skills_etc_necessary_equipments_etc) ?  $survey_info->skills_etc_necessary_equipments_etc : "") ?></textarea>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-12 col-md-12">
            <p class="h6 font-weight-bold text-color-blue-custom">D. <em>Organizational Structure/(attached organizational chart)</em></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label class="text-justify" for="qualificationsBoard"><strong>What qualifications/skills the Board of Directors should possess to enable them to formulate sound policies, strategies and guidelines which would ensure the success of the Cooperative?</strong></label>
              <textarea class="form-control" style="resize: none;" name="qualificationsBoard" id="qualificationsBoard" rows="2" disabled><?=(isset($survey_info->qualifications_directors) ?  $survey_info->qualifications_directors : "") ?></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <strong class="text-justify">What are the Cooperative’s education programs for:</strong>
            </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label for="educationProgramMembers"><strong>Members</strong></label>
              <textarea type="text" class="form-control" name="educationProgramMembers" id="educationProgramMembers" disabled value=""><?=(isset($survey_info->education_programs_members) ?  $survey_info->education_programs_members : "") ?></textarea>
            </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label for="educationProgramOfficers"><strong>Officers</strong></label>
              <textarea type="text" class="form-control" name="educationProgramOfficers" id="educationProgramOfficers" disabled value=""><?=(isset($survey_info->education_programs_officers) ?  $survey_info->education_programs_officers : "") ?></textarea>
            </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label for="educationProgramStaff"><strong>Staff</strong></label>
              <textarea type="text" class="form-control" name="educationProgramStaff" id="educationProgramStaff" disabled value=""><?=(isset($survey_info->education_programs_staff) ?  $survey_info->education_programs_staff : "") ?></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer economicSurveyFooter" style="display:none;">
        <input class="btn btn-color-blue btn-block" type="submit" id="economicSurveyBtn" name="economicSurveyBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
