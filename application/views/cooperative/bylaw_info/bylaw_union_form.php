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
      <?php echo form_open('bylaws/'.$encrypted_id.'/union',array('id'=>'bylawsUnionForm','name'=>'bylawsUnionForm')); ?>
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-bylaws-primary">
            <h4 class="float-left">Details:</h4>
            <?php if(($is_client && $coop_info->status<=1) || ($coop_info->status==11)): ?>
            <a class="btn btn-primary btn-sm float-right text-white" id="btnEditBylawsSecondary"><i class="fas fa-edit"></i> Edit</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="kindsOfMember">Kinds of Member:</label>
                <select class="custom-select" name="kindsOfMember" id="kindsOfMember" disabled>
                  <option value="" selected>--</option>
                  <option value="1" <?php if($bylaw_info->kinds_of_members == 1) echo "selected"; ?>>Regular Member Only</option>
                  <?php
                    if($coop_info->type_of_cooperative == 'Union' || $coop_info->type_of_cooperative == 'Federation') {

                    } else { ?>
                      <option value="2" <?php if($bylaw_info->kinds_of_members == 2) echo "selected"; ?>>Regular And Associate Member</option>
                  <?php  } ?>
                  
                </select>
              </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
            <label for="membershipFee"><strong>How much is the membership fee?</strong></label>
            <input type="number" min="1" value="<?= number_format($bylaw_info->membership_fee,2) ?>" step="1" class="form-control" id="membershipFee" name="membershipFee"placeholder="&#8369; 0.00" disabled>
            <small id="emailHelp" class="form-text">In case the application should be rejected, this fee shall be refunded to the applicant within 7-10 business days.</small>
           </div>
          </div>
          <div class="additionalRequirementsForMembership">
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
                <div class="form-group">
                    <label for="additionalRequirementsForMembership"><strong>List down any additional requirements for membership in your cooperative</strong><br></label> 
                </div>
               <!--<label><strong>List down any additional requirements for membership in your cooperative</strong></label>--> 
               
        
              <input class="form-control " style="resize: none;" id="additionalRequirementsForMembership" name="additionalRequirementsForMembership[]" placeholder="Must be in a sentence" rows="8" value="<?= $bylaw_info->additional_requirements_for_membership ?>" disabled>
            </div>
          </div>
        </div>

        <!--<div class="row">-->
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreRequirementsBtn" disabled><i class="fas fa-plus"></i> Add More Requirements for Membership</button>
            </div>
          <!--</div>-->
          <!--</div>-->
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="actUponMembershipDays"><strong>How many days will the Board of Directors have to act upon an application for membership once it has been submitted?</strong></label>
        			<input type="number" class="form-control" id="actUponMembershipDays" name="actUponMembershipDays" placeholder="Enter Days" value="<?= $bylaw_info->act_upon_membership_days ?>" disabled>
        			<small id="emailHelp" class="form-text ">Days from the date filing.</small>
        		 </div>
           </div>
          
<!--          Delegate Powers-->

                <div class="delegatePowers">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
<!--                        <small>
                            This is the general requirements for membership.
                                <ol type="1">
                                  <li>Approved application for membership;</li>
                                  <li>Certificate of completion of the prescribed Pre-Membership Education Seminar (PMES);</li>
                                  <li>Subscribed and paid the required minimum share capital and membership fee;</li>
                                </ol>
                        </small>-->
                          <div class="form-group">
                              <label for="additionaldelegatePowers"><strong>Powers of the General Assembly.</strong> </label>
                              <br>Subject to the pertinent provisions of the Cooperative Code and the rules issued thereunder, the General Assembly shall have the following exclusive powers which cannot be delegated:<br>
                          </div>
                         <!--<label><strong>List down any additional requirements for membership in your cooperative</strong></label>--> 

                        <input class="form-control " style="resize: none;" id="additionaldelegatePowers" name="additionaldelegatePowers[]" placeholder="Must be in a sentence" rows="8" value="<?= $bylaw_info->delegate_powers ?>" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 offset-md-8 col-md-4">
                    <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoredelegatePowersBtn" disabled><i class="fas fa-plus"></i> Add More General Assembly</button>
                </div>

<!--          End Delegate Powers-->
<!--          <div class="delegatePowers">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="delegatePowers"><strong>Powers of the General Assembly.</strong> <br>Subject to the pertinent provisions of the Cooperative Code and the rules issued thereunder, the General Assembly shall have the following exclusive powers which cannot be delegated:<br><small>To delegate the following power/s to a smaller body of the Cooperative Union: (each item must end with (;) semi-colon and the last item must end with a (.) period)</small></label>
                <textarea class="form-control" style="resize: none;" id="delegatePowers" name="delegatePowers" placeholder="Ex. &#10;item 1;&#10;item2;&#10;itemlast."rows="10"></textarea>
                <input class="form-control " style="resize: none;" id="delegatePowers" name="delegatePowers[]" placeholder="Must be in a sentence" rows="8" value="<?= $bylaw_info->delegate_powers ?>">
              </div>
                <div class="col-sm-12 offset-md-8 col-md-4">
               <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoredelegatePowersBtn"><i class="fas fa-plus"></i> Add More General Assembly</button>
             </div>
            </div>
          </div>-->
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="quorumPercentage"><strong>How many percent of the members are entitled to vote to constitute the quorum?</strong></label>
        			<input type="number" class="form-control" id="quorumPercentage" name="quorumPercentage" min="25" placeholder="Enter Percent %" value="<?=$bylaw_info->members_percent_quorom?>" disabled>
        			<small id="emailHelp" class="form-text">Atleast twenty five percent.</small>
        		 </div>
           </div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="termHoldDirector"><strong>How many years should the office shall be hold before the new election of directors?</strong></label>
        			<input type="number" class="form-control" id="termHoldDirector" name="termHoldDirector" placeholder="Enter years" value="<?=$bylaw_info->director_hold_term?>" disabled>
        		 </div>
        		</div>
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
          			<label for="directorsTerm"><strong>All Directors should serve for a term of how many years?</strong></label>
          			<input type="number" class="form-control" id="directorsTerm" name="directorsTerm" placeholder="Enter years" value="<?=$bylaw_info->directors_term?>" disabled>
          		</div>
            </div>

            <div class="primaryConsideration">
                <div class="col-sm-12 col-md-12">
                    <div class="form-group">
<!--                        <small>
                        This is the general requirements for membership.
                            <ol type="1">
                              <li>Approved application for membership;</li>
                              <li>Certificate of completion of the prescribed Pre-Membership Education Seminar (PMES);</li>
                              <li>Subscribed and paid the required minimum share capital and membership fee;</li>
                            </ol>
                    </small>-->
                      <div class="form-group">
                          <label for="primaryConsideration"><strong>Primary Consideration.</strong> 
                          <br>Adhering to the principle of service, list down the Cooperative Union shall endeavor to: <br></label>
                      </div>
                     <!--<label><strong>List down any additional requirements for membership in your cooperative</strong></label>--> 

                    <input class="form-control " style="resize: none;" id="primaryConsideration" name="primaryConsideration[]" placeholder="Must be in a sentence" rows="8" value="<?= $bylaw_info->delegate_powers ?>" disabled>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 offset-md-8 col-md-4">
                <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreprimaryConsiderationBtn" disabled><i class="fas fa-plus"></i> Add More Primary Consideration</button>
            </div>

<!--            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="primaryConsideration"><strong>Primary Consideration.</strong> <br>Adhering to the principle of service, list down the Cooperative Union shall endeavor to: <br><small>Engage in: (each item must end with (;) semi-colon and the last item must end with a (.) period)</small></label>
                <textarea class="form-control" style="resize: none;" id="primaryConsideration" name="primaryConsideration" placeholder="Ex. &#10;item 1;&#10;item2;&#10;itemlast."rows="10"></textarea>
              </div>
            </div>-->
          </div>
      </div>
      <div class="card-footer bylawsOthersFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="bylawsUnionBtn" name="bylawsUnionBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
