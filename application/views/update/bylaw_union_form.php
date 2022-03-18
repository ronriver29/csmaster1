<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives_update/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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
      <?php echo form_open('cooperatives_update/'.$encrypted_id.'/bylaws_union',array('id'=>'bylawsUnionForm','name'=>'bylawsUnionForm')); ?>
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-bylaws-primary">
            <h4 class="float-left">Details:</h4>
            <?php if(($is_client  && $coop_info->status!=40) || (!$is_client && $coop_info->status==40)): ?>
            <a class="btn btn-primary btn-sm float-right text-white" id="btnEditBylawsSecondary"><i class="fas fa-edit"></i> Edit</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12 col-md-12 text-center">
            <p class="font-weight-bold h5 text-color-blue-custom">Article II. Membership</p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="kindsOfMember">Kinds of Member:</label>
                <select class="custom-select" name="kindsOfMember" id="kindsOfMember" disabled="">
                  <option value="" selected>--</option>
                  <option value="1" <?php if(isset($bylaw_info->kinds_of_members)){ if($bylaw_info->kinds_of_members == 1) echo "selected"; } ?>>Regular Member Only</option>
                  <?php
                    if($coop_info->type_of_cooperative == 'Union' || $coop_info->type_of_cooperative == 'Federation') {

                    } else { ?>
                      <option value="2" <?php if($bylaw_info->kinds_of_members == 2) echo "selected"; ?>>Regular And Associate Member</option>
                  <?php  } ?>
                  
                </select>
              </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <p class="h6 font-weight-bold text-color-blue-custom">Section 4.</p>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
            <label for="membershipFee"><strong style="color: red;">*</strong><strong> How much is the membership fee?</strong></label>
            <input type="text" value="<?php if(isset($bylaw_info->membership_fee)){ echo number_format($bylaw_info->membership_fee,2); }?>" class="form-control" id="membershipFee" name="membershipFee" placeholder="&#8369; 0.00" disabled>
            <small id="emailHelp" class="form-text">In case the application should be rejected, this fee shall be refunded to the applicant within 7-10 business days.</small>
           </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <p class="h6 font-weight-bold text-color-blue-custom">Section 3.</p>
          </div>
          <?php // if(strlen($bylaw_info->additional_requirements_for_membership) > 0) : ?>
          <div class="row additionalRequirementsForMembership">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <small>
                  This is the general requirements for membership.
                <ol type="a">
                  <li> Approved application for membership;  </li>
                  <li> General Assembly Resolution stating that the General Assembly has approved their membership and the amount of dues to the Cooperative Union; </li>
                  <li> Resolution of the Board of Directors designating an authorized representative; </li>
                  <li> Subscribed and paid the required minimum share capital and  membership fee; and </li>
                </ol>
              </small>
              </div>
              <div class="form-group">
                <label for="additionalRequirementsForMembership"><strong>List down any additional requirements for membership in your cooperative</strong><br></label> 
              </div>
            </div>
            <?php if(isset($add_membership)){ foreach($add_membership as $key => $add_memberships) : ?>
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <?php if($key>=1) :?>
                    <a class="customDeleleBtn regularQualificationRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                  <?php endif; ?>
                  <label for="regularQualifications<?= $key + 4?>">Requirements for membership <?= $key + 4?></label>
                  <textarea type="text" value="" class="form-control" name="additionalRequirementsForMembership[]" id="additionalRequirementsForMembership<?= $key + 4?>" disabled><?= $add_memberships?></textarea>
                </div>
              </div>
            <?php endforeach; }?>
          </div>
        <?php //endif;?>

        <!--<div class="row">-->
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreRequirementsBtn" disabled><i class="fas fa-plus"></i> Add More Requirements for Membership</button>
            </div>
          <!--</div>-->
          <!--</div>-->
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="actUponMembershipDays"><strong style="color: red;">*</strong><strong> How many days will the Board of Directors have to act upon an application for membership once it has been submitted?</strong></label>
        			<input type="number" class="form-control" id="actUponMembershipDays" name="actUponMembershipDays" placeholder="Enter Days" value="<?php if(isset($bylaw_info->act_upon_membership_days)) { echo $bylaw_info->act_upon_membership_days; } ?>" disabled>
        			<small id="emailHelp" class="form-text ">Days from the date filing.</small>
        		 </div>
           </div>
          
<!--          Delegate Powers-->
            <?php if(isset($bylaw_info->delegate_powers)){ if(strlen($bylaw_info->delegate_powers) > 0) : ?>
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
                         <?php foreach($delegate_power as $key => $delegate_powers) : ?>
                            <div class="col-sm-12 col-md-12">
                              <div class="form-group">
                                <?php if($key>=1) :?>
                                  <a class="customDeleleBtn regularQualificationRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                                <?php endif; ?>
                                <label for="regularQualifications<?= $key + 2?>">Regular member qualification <?= $key + 2?></label>
                                <textarea class="form-control" id="additionaldelegatePowers1" name="additionaldelegatePowers[]" placeholder="Must be in a sentence" rows="2" value="" disabled><?= $delegate_powers ?></textarea>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 offset-md-8 col-md-4">
                    <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoredelegatePowersBtn" disabled><i class="fas fa-plus"></i> Add More General Assembly</button>
                </div>
            <?php endif; }?>

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
        			<label for="quorumPercentage"><strong style="color: red;">*</strong><strong> How many percent of the members are entitled to vote to constitute the quorum?</strong></label>
        			<input type="number" class="form-control" id="quorumPercentage" name="quorumPercentage" placeholder="Enter Percent %" value="<?php if(isset($bylaw_info->members_percent_quorom)){ echo $bylaw_info->members_percent_quorom; }?>" disabled>
        			<small id="emailHelp" class="form-text">Atleast twenty five percent.</small>
        		 </div>
           </div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="termHoldDirector"><strong style="color: red;">*</strong><strong> How many years shall the directors serve until their successors shall have been elected and qualified?</strong></label>
        			<input type="number" class="form-control" id="termHoldDirector" name="termHoldDirector" placeholder="Enter years" value="<?php if(isset($bylaw_info->members_percent_quorom)){ echo $bylaw_info->director_hold_term; }?>" disabled>
        		 </div>
        		</div>
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
          			<label for="directorsTerm"><strong style="color: red;">*</strong><strong> All Directors should serve for a term of how many years?</strong></label>
          			<input type="number" class="form-control" id="directorsTerm" name="directorsTerm" placeholder="Enter years" value="<?php if(isset($bylaw_info->members_percent_quorom)){ echo $bylaw_info->directors_term; }?>" disabled>
          		</div>
            </div>

            <div class="row additionalPrimaryConsideration">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <small>
                    Adhering to the principle of service over and above profit, the Union shall endeavor to:
                  <ol type="a">
                    <li>Engage in:</li>
                  </ol>
                </small>
                </div>
              </div>
            <?php if(isset($primary_consideration)){ foreach($primary_consideration as $key => $add_members_votes) : ?>
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <?php if($key>=1) :?>
                      <a class="customDeleleBtn delegatePowersRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                    <?php endif; ?>
                    <label for="additionalPrimaryConsideration<?= $key + 5?>">a.<?=$key+1?></label>
                    <textarea type="text" value="" class="form-control" name="additionalPrimaryConsideration[]" id="additionalPrimaryConsideration<?= $key + 1?>" disabled><?= $add_members_votes?></textarea>
                  </div>
                </div>
                <?php endforeach; }?>
          </div>

            <div class="col-sm-12 offset-md-8 col-md-4">
                <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreprimaryConsiderationBtn" disabled><i class="fas fa-plus"></i> Add More Primary Consideration</button>
            </div>
          </div>
      </div>
      <?php if(($is_client  && $coop_info->status!=40) || (!$is_client && $coop_info->status==40)): ?>
        <div class="card-footer bylawsOthersFooter">
          <input class="btn btn-color-blue btn-block" type="submit" id="bylawsUnionBtn" name="bylawsUnionBtn" value="Submit">
        </div>
      <?php endif; ?>
    </form>
    </div>
  </div>
</div>
