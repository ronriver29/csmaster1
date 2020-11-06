<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 2
      <?php endif; ?>
    </h5>
  </div>
</div>
<?php if(!$this->session->flashdata('bylaw_success') || !$this->session->flashdata('bylaw_error') || !$this->session->flashdata('bylaw_redirect')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info" role="alert">
      Whatever information you enter will appear in the by laws document.
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('bylaw_redirect')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info text-center" role="alert">
      <?php echo $this->session->flashdata('bylaws_redirect'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('bylaw_success')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('bylaw_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('bylaw_error')): ?>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('bylaw_error'); ?>
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
      <?php echo form_open('cooperatives/'.$encrypted_id.'/bylaws_federation',array('id'=>'bylawsFederationForm','name'=>'bylawsFederationForm')); ?>
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 col-md-4">
            <h4>By Laws Information:</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        <input type="hidden" class="form-control" id="bylaw_coop_id" name="bylaw_coop_id" value="<?=$encrypted_id ?>">
        <div class="row">
          <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="kindsOfMember">Kinds of Member:</label>
                <select class="custom-select validate[required]" name="kindsOfMember" id="kindsOfMember">
                  <option value="" selected>--</option>
                  <option value="1" <?php if($bylaw_info->kinds_of_members == 1) echo "selected"; ?>>Regular Member Only</option>
                  <option value="2" <?php if($bylaw_info->kinds_of_members == 2) echo "selected"; ?>>Regular And Associate Member</option>
                </select>
              </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
            <label for="membershipFee"><strong>How much is the membership fee?</strong></label>
            <input type="number" min="1" step="any" class="form-control" id="membershipFee" name="membershipFee" placeholder="&#8369; 0.00" value="<?=$bylaw_info->membership_fee?>">
            <small id="emailHelp" class="form-text text-muted">In case the application should be rejected, this fee shall be refunded to the applicant within 7-10 business days.</small>
           </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <small>
                This is the general requirements for membership.
              <ol type="1">
                <li>Approved application for membership;</li>
                <li>Certificate of completion of the prescribed Pre-Membership Education Seminar (PMES);</li>
                <li>Subscribed and paid the required minimum share capital and membership fee;</li>
              </ol>
            </small>
              <label for="additionalRequirementsForMembership"><strong>List down any additional requirements for membership in your cooperative</strong><br><small class="text-info">Note: (each item must end with (;) semi-colon and the last item must end with a (.) period)</small></label>
              <textarea class="form-control validate" style="resize: none;" id="additionalRequirementsForMembership" name="additionalRequirementsForMembership" placeholder="Ex. &#10;item 1;&#10;item2;&#10;itemlast."rows="8"><?=$bylaw_info->additional_requirements_for_membership?></textarea>
            </div>
          </div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="actUponMembershipDays"><strong>How many days will the Board of Directors have to act upon an application for membership once it has been submitted?</strong></label>
                                <input type="number" class="form-control" id="actUponMembershipDays" name="actUponMembershipDays" placeholder="Enter Days" value="<?=$bylaw_info->act_upon_membership_days?>">
        			<small id="emailHelp" class="form-text text-muted">Days from the date filing.</small>
        		 </div>
        		</div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="regularMembershipPercentageSubscription">What is the minimum percentage of shares that the applicant must subscribe to upon approval of membership?</label>
                                <input type="number" class="form-control" id="regularMembershipPercentageSubscription" name="regularMembershipPercentageSubscription" placeholder="Enter Shares" value="<?=$bylaw_info->regular_percentage_shares_subscription?>">
        			<label for="regularMembershipPercentagePay">What is the minimum percentage of shares that the applicant must pay the value of upon approval of membership?</label>
                                <input type="number" class="form-control" id="regularMembershipPercentagePay" name="regularMembershipPercentagePay" placeholder="Enter Shares" value="<?=$bylaw_info->regular_percentage_shares_pay?>">
        		  </div>
        		</div>
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="delegatePowers"><strong>Powers of the General Assembly.</strong> <br>Subject to the pertinent provisions of the Cooperative Code and the rules issued thereunder, the General Assembly shall have the following exclusive powers which cannot be delegated:<br><small>To delegate the following power/s to a smaller body of the Cooperative Union: (each item must end with (;) semi-colon and the last item must end with a (.) period)</small></label>
                <textarea class="form-control validate" style="resize: none;" id="delegatePowers" name="delegatePowers" placeholder="Ex. &#10;item 1;&#10;item2;&#10;itemlast."rows="10"><?=$bylaw_info->delegate_powers?></textarea>
              </div>
            </div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="regularMeetingDay"><strong>On what day shall the General Assembly hold its annual regular meeting at the principal office of the Cooperation or at any place that may be determined by the board?</strong></label>
                                <input type="text" class="form-control" id="regularMeetingDay" name="regularMeetingDay" placeholder="ex. 2nd saturday of may" value="<?=$bylaw_info->annual_regular_meeting_day?>">
        			<small id="emailHelp" class="form-text text-muted">Shall not be beyond ninety (90) days after the close of the calendar year.</small>
        		 </div>
        		</div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="quorumPercentage"><strong>How many percent of the members are entitled to vote to constitute the quorum?</strong></label>
                                <input type="number" class="form-control" id="quorumPercentage" name="quorumPercentage" min="25" placeholder="Enter Percent %" value="<?=$bylaw_info->members_percent_quorom?>">
        			<small id="emailHelp" class="form-text text-muted">Atleast twenty five percent.</small>
        		 </div>
        		</div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="consecutiveAbsences"><strong>How many consecutive absences in order to be disqualified?</strong></label>
                                <input type="number" class="form-control" id="consecutiveAbsences" name="consecutiveAbsences" placeholder="Enter Number" value="<?=$bylaw_info->number_of_absences_disqualification?>">
        			<label for="exampleInputEmail1"><strong>How many percent of absences of all meetings within a year in order to be disqualified?</strong></label>
                                <input type="number" class="form-control" id="consecutivePercentageAbsences" name="consecutivePercentageAbsences" min="25" placeholder="Enter Percent %" value="<?=$bylaw_info->percent_of_absences_all_meettings?>">
        			<small id="emailHelp" class="form-text text-muted">Atleast twenty five percent.</small>
        		 </div>
        		</div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="termHoldDirector"><strong>How many years should the office shall be hold before the new election of directors?</strong></label>
                                <input type="number" class="form-control" id="termHoldDirector" name="termHoldDirector" placeholder="Enter years" value="<?=$bylaw_info->director_hold_term?>">
        		 </div>
        		</div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="investPerMonth"><strong>Atleast how many Peso should invest per month?</strong></label>
                                <input type="number" class="form-control" id="investPerMonth" name="investPerMonth" placeholder="" value="<?=$bylaw_info->member_invest_per_month?>">
        			<small id="emailHelp" class="form-text text-muted"> </small>
        		 </div>
        		</div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="investAnnualInterest"><strong>How many Percent of his/her annual interest on capital and patronage should be invested?</strong></label>
                                <input type="number" class="form-control" id="investAnnualInterest" name="investAnnualInterest" placeholder="Shares" value="<?=$bylaw_info->member_percentage_annual_interest?>">
        			<small id="emailHelp" class="form-text text-muted"> </small>
        		 </div>
        		</div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="investService"><strong>How many Percent of each good procured /service acquired from the cooperative should be invested</strong></label>
                                <input type="number" class="form-control" id="investService" name="investService" placeholder="%" value="<?=$bylaw_info->member_percentage_service?>">
        			<small id="emailHelp" class="form-text text-muted"> </small>
        		 </div>
        		</div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="educationFund"><strong>How many Percent shall be set aside for Education and Training Fund?</strong></label>
                                <input type="number" class="form-control" id="educationFund" name="educationFund" placeholder="%" value="<?=$bylaw_info->percent_education_fund?>">
        			<small id="emailHelp" class="form-text text-muted"> </small>
        		 </div>
        		</div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="reserveFund"><strong>How many Percent shall be set aside for Reserve fund?</strong></label>
                                <input type="number" class="form-control" id="reserveFund" name="reserveFund" placeholder="%" value="<?=$bylaw_info->percent_reserve_fund?>">
        			<small id="emailHelp" class="form-text text-muted"> </small>
        		 </div>
        		</div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="communityFund"><strong>How many Percent shall be used for projects and activities that will benefit the community where the Cooperative operates?</strong></label>
                                <input type="number" class="form-control" id="communityFund" name="communityFund" placeholder="%" value="<?=$bylaw_info->percent_community_fund?>">
        			<small id="emailHelp" class="form-text text-muted"> </small>
        		 </div>
        		</div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="othersFund"><strong>How many Percent shall be set aside for the optioonal fund, Land and buliding and any other necessary fund?</strong></label>
                                <input type="number" class="form-control" id="othersFund" name="othersFund" placeholder="%" value="<?=$bylaw_info->percent_optional_fund?>">
        			<small id="emailHelp" class="form-text text-muted"> </small>
        		 </div>
        		</div>
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="primaryConsideration"><strong>Primary Consideration.</strong> <br>Adhering to the principle of service, list down the Cooperative Union shall endeavor to: <br><small>Engage in: (each item must end with (;) semi-colon and the last item must end with a (.) period)</small></label>
                <textarea class="form-control validate" style="resize: none;" id="primaryConsideration" name="primaryConsideration" placeholder="Ex. &#10;item 1;&#10;item2;&#10;itemlast."rows="10"><?=$bylaw_info->primary_consideration?></textarea>
              </div>
            </div>
        </div>
      </div>
      <div class="card-footer bylawsPrimaryFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="bylawsFederationBtn" name="bylawsFederationBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
