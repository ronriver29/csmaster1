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
      <?php echo form_open('cooperatives_update/'.$encrypted_id.'/bylaws_federation',array('id'=>'bylawsPrimaryForm','name'=>'bylawsPrimaryForm')); ?>
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-bylaws-primary">
            <h4 class="float-left">Details:</h4>
            <?php if(($is_client && $coop_info->status != 40 && $coop_info->status != 39) || (!$is_client && $coop_info->status == 40 && $coop_info->status != 39)):?>  
            <a class="btn btn-primary btn-sm float-right text-white" id="btnEditBylawsPrimary"><i class="fas fa-edit"></i> Edit</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="card-body">
        <input type="hidden" class="form-control" id="bylaw_coop_id" name="bylaw_coop_id" value="<?=$encrypted_id ?>">
        <div class="row">
          <div class="col-sm-12 col-md-12 text-center">
            <p class="font-weight-bold h5 text-color-blue-custom">Article II. Membership</p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <p class="h6 font-weight-bold text-color-blue-custom">Section 1. <em>Kinds of Membership</em></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="kindsOfMember"><strong>Define Membership:</strong></label>
                <select class="custom-select" name="kindsOfMember" id="kindsOfMember" disabled>
                  <option value="1" <?php if(isset($bylaw_info->kinds_of_members)){ if($bylaw_info->kinds_of_members == 1) echo "selected"; }?>>Regular Member Only</option>
                  <!-- <option value="2" <?php if($bylaw_info->kinds_of_members == 2) echo "selected"; ?>>Regular And Associate Member</option> -->
                </select>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <p class="h6 font-weight-bold text-color-blue-custom">Section 2. <em>Qualifications for Membership</em></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <strong>List down the qualifications for regular members:</strong>
          </div>
        </div>
        <?php if(isset($bylaw_info->regular_qualifications)){ if(strlen($bylaw_info->regular_qualifications) <= 0) : ?>
          <div class="row row-regular-qualifications">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="regularQualifications1">Regular member qualification 1</label>
                <textarea type="text" value="" class="form-control" name="regularQualifications[]" id="regularQualifications1" placeholder="Must be in a sentence" disabled></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreQualificationsRegularBtn" disabled><i class="fas fa-plus"></i> Add More Qualifications for Regular Member</button>
            </div>
          </div>
        <?php endif; } else {?>
          <div class="row row-regular-qualifications">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="regularQualifications1">Regular member qualification 1</label>
                <textarea type="text" value="" class="form-control" name="regularQualifications[]" id="regularQualifications1" placeholder="Must be in a sentence" disabled></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreQualificationsRegularBtn" disabled><i class="fas fa-plus"></i> Add More Qualifications for Regular Member</button>
            </div>
          </div>
        <?php } ?>
        <?php if(isset($bylaw_info->regular_qualifications)){ if(strlen($bylaw_info->regular_qualifications) > 0) : ?>
          <div class="row row-regular-qualifications">
            <?php foreach($reg_qualifications as $key => $reg_qualification) : ?>
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <?php if($key>=1) :?>
                    <a class="customDeleleBtn regularQualificationRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                  <?php endif; ?>
                  <label for="regularQualifications<?= $key + 1?>">Regular member qualification <?= $key + 1?></label>
                  <textarea type="text" value="" class="form-control" name="regularQualifications[]" id="regularQualifications<?= $key + 1?>" disabled><?= $reg_qualification?></textarea>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="row">
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreQualificationsRegularBtn" disabled><i class="fas fa-plus"></i> Add More Qualifications for Regular Member</button>
            </div>
          </div>
        <?php endif; } ?>
            <div class="row row-assoc" style="<?php if(isset($bylaw_info->kinds_of_members)) { echo ($bylaw_info->kinds_of_members == 1) ? "display: none;" : ""; } ?>">
              <div class="col-sm-12 col-md-12">
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                    <strong>List down the qualifications for associate members:</strong>
                  </div>
                </div>
                <?php if(isset($bylaw_info->associate_qualifications)){ if(strlen($bylaw_info->associate_qualifications) <= 0) : ?>
                <div class="row row-associate-qualifications">
                  <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                      <label for="associateQualifications1">Associate member qualification 1</label>
                      <input type="text" value="" class="form-control" name="associateQualifications[]" id="associateQualifications1" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 offset-md-8 col-md-4">
                    <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreQualificationsAssociateBtn" disabled><i class="fas fa-plus"></i> Add More Qualifications for Associate Member</button>
                  </div>
                </div>
                <?php endif; }?>
                <?php if(isset($bylaw_info->associate_qualifications)){ if(strlen($bylaw_info->associate_qualifications) > 0) : ?>
                  <div class="row row-associate-qualifications">
                    <?php foreach($asc_qualifications as $key => $asc_qualification) : ?>
                      <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                          <?php if($key>=1) :?>
                            <a class="customDeleleBtn associateQualificationRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                          <?php endif; ?>
                          <label for="associateQualifications<?= $key + 1?>">Associate member qualification <?= $key + 1?></label>
                          <input type="text" value="<?= $asc_qualification?>" class="form-control" name="associateQualifications[]" id="associateQualifications<?= $key + 1?>" disabled>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 offset-md-8 col-md-4">
                      <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreQualificationsAssociateBtn" disabled><i class="fas fa-plus"></i> Add More Qualifications for Associate Member</button>
                    </div>
                  </div>
                <?php endif; }?>
              </div>
            </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <p class="h6 font-weight-bold text-color-blue-custom">Section 3. <em>Requirements for Membership</em></p>
          </div>
        </div>
        <?php if(isset($bylaw_info->regular_qualifications)){ if(strlen($bylaw_info->regular_qualifications) <= 0) : ?>
        <div class="row additionalRequirementsForMembership">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <small>
                A member must have complied with the following requirements:
              <ol type="a">
                <li> Approved application for membership; </li>
                <li> General Assembly Resolution indicating membership and share capital contribution to this Federation of Cooperatives; </li>
                <li> Board of Directors Resolution on authorized representative; </li>
                <li> Certification of line of business activities engaged in; </li>
                <li> Subscribed and paid the required minimum share capital and membership fee; and </li>
              </ol>
            </small>
              <!-- <label for="additionalRequirementsForMembership"><strong>List down any additional requirements for membership in your cooperative</strong><br><small class="text-info">Note: (each item must end with (;) semi-colon and the last item must end with a (.) period)</small></label> -->
        
              <textarea class="form-control " style="resize: none;" id="additionalRequirementsForMembership" name="additionalRequirementsForMembership[]" placeholder="Must be in a sentence" rows="8" value="<?php if(isset($bylaw_info->additional_requirements_for_membership)) { echo $bylaw_info->additional_requirements_for_membership; } ?>" disabled></textarea>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreRequirementsBtn" disabled><i class="fas fa-plus"></i> Add More Requirements for Membership</button>
            </div>
          </div>
          <?php endif; } else { ?>
            <div class="row additionalRequirementsForMembership">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <small>
                A member must have complied with the following requirements:
              <ol type="a">
                <li> Approved application for membership; </li>
                <li> General Assembly Resolution indicating membership and share capital contribution to this Federation of Cooperatives; </li>
                <li> Board of Directors Resolution on authorized representative; </li>
                <li> Certification of line of business activities engaged in; </li>
                <li> Subscribed and paid the required minimum share capital and membership fee; and </li>
              </ol>
            </small>
              <!-- <label for="additionalRequirementsForMembership"><strong>List down any additional requirements for membership in your cooperative</strong><br><small class="text-info">Note: (each item must end with (;) semi-colon and the last item must end with a (.) period)</small></label> -->
        
              <textarea class="form-control " style="resize: none;" id="additionalRequirementsForMembership" name="additionalRequirementsForMembership[]" placeholder="Must be in a sentence" rows="8" value="<?php if(isset($bylaw_info->additional_requirements_for_membership)){ echo $bylaw_info->additional_requirements_for_membership; } ?>" disabled></textarea>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreRequirementsBtn" disabled><i class="fas fa-plus"></i> Add More Requirements for Membership</button>
            </div>
          </div>
          <?php } ?>
          <?php if(isset($bylaw_info->regular_qualifications)){ if(strlen($bylaw_info->regular_qualifications) > 0) : ?>
          <div class="row additionalRequirementsForMembership">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <small>
                  This is the general requirements for membership.
                <ol type="1">
                  <li> Approved application for membership; </li>
                  <li> General Assembly Resolution indicating membership and share capital contribution to this Federation of Cooperatives; </li>
                  <li> Board of Directors Resolution on authorized representative; </li>
                  <li> Certification of line of business activities engaged in; </li>
                  <li> Subscribed and paid the required minimum share capital and membership fee; and </li>
                </ol>
              </small>
              </div>
            </div>
            <?php foreach($add_membership as $key => $add_memberships) : ?>
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <?php if($key>=1) :?>
                    <a class="customDeleleBtn regularQualificationRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                  <?php endif; ?>
                  <label for="regularQualifications<?= $key + 4?>">Requirements for membership <?= $key + 6?></label>
                  <textarea type="text" value="" class="form-control" name="additionalRequirementsForMembership[]" id="additionalRequirementsForMembership<?= $key + 4?>" disabled><?= $add_memberships?></textarea>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="row">
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreRequirementsBtn" disabled><i class="fas fa-plus"></i> Add More Requirements for Membership</button>
            </div>
          </div>
        <?php endif; }?>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <p class="h6 font-weight-bold text-color-blue-custom">Section 4. <em>Application for Membership</em></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
            <label for="actUponMembershipDays"><strong>An applicant for membership shall file a duly accomplished form to the Board of Directors who shall act upon the application within _________ (_____) days from the date of filing.  The Board of Directors shall devise a form for the purpose which shall, aside from the personal data of the applicant, include the duties of a member to participate in all programs including but not limited to capital build-up and savings mobilization of the Cooperative and, such other information as may be deemed necessary.</strong></label>
            <input type="number" value="<?php if(isset($bylaw_info->act_upon_membership_days)) { echo $bylaw_info->act_upon_membership_days; }  ?>" class="form-control" id="actUponMembershipDays" name="actUponMembershipDays" placeholder="Enter Days" disabled>
            <small id="emailHelp" class="form-text text-muted">Days from the date filing.</small>
           </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
            <label for="membershipFee"><strong>How much is the membership fee?</strong></label>
            <input type="text" value="<?php if(isset($bylaw_info->membership_fee)) { echo number_format($bylaw_info->membership_fee,2); } ?>" min="0" step="any" class="form-control" id="membershipFee" name="membershipFee"   placeholder="&#8369; 0.00" disabled>
            <small id="emailHelp" class="form-text text-muted">In case the application should be rejected, this fee shall be refunded to the applicant within 7-10 business days.</small>
           </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <p class="h6 font-weight-bold text-color-blue-custom">Section 6. <em>Minimum Share Capital Requirement</em></p>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <small id="emailHelp" class="form-text text-muted">Please see capitalization in Step 3</small>
            </div>
        </div>
        <br/>
<!--          <div class="row row-subscriptions">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="regularMembershipPercentageSubscription"><strong>Regular Membership</strong><br>What is the minimum number of shares that the applicant must subscribe upon approval of regular membership?</label>
                <input type="number" value="<?= $bylaw_info->regular_percentage_shares_subscription ?>"
                 class="form-control validate[required,min[1],custom[integer]]" id="regularMembershipPercentageSubscription" name="regularMembershipPercentageSubscription" placeholder="Enter Shares" disabled>

              </div>
              <div class="form-group">
                <label for="regularMembershipPercentagePay">What is the minimum number of shares that the applicant must pay upon approval of regular membership?</label>
                <input type="number" value="<?= $bylaw_info->regular_percentage_shares_pay ?>" 
                 class="form-control validate[required,min[1],custom[integer],funcCall[validateMinimumPaidRegularPrimaryCustom]]" id="regularMembershipPercentagePay" name="regularMembershipPercentagePay" 
                placeholder="Enter Shares" disabled>
                <span id="rg" style="color:red"></span>

              </div>
            </div>
            <div class="col-sm-12 col-md-12" id="colAssociateSubscription" <?php if($bylaw_info->kinds_of_members == 1) echo "style='display:none;'"; ?>>
              <div class="form-group">
                <label for="associateMembershipPercentageSubscription"><strong>Associate Membership</strong><br>What is the minimum number of shares that the applicant must subscribe upon approval of associate membership?</label>
                <input type="number" value="<?=$bylaw_info->associate_percentage_shares_subscription?>" class="form-control <?php if($bylaw_info->kinds_of_members == 2) echo "validate[required,min[1],custom[integer]]'"; ?>" id="associateMembershipPercentageSubscription" name="associateMembershipPercentageSubscription" placeholder="Enter Shares" disabled>
              </div>

              <div class="form-group">
                <label for="associateMembershipPercentagePay">What is the minimum number of shares that the applicant must pay upon approval of associate membership?</label>
                <input type="number" value="<?=$bylaw_info->associate_percentage_shares_pay?>" class="form-control <?php if($bylaw_info->kinds_of_members == 2) echo "validate[required,min[1],custom[integer],funcCall[validateMinimumPaidAssociatePrimaryCustom]]'"; ?>" id="associateMembershipPercentagePay" name="associateMembershipPercentagePay" placeholder="Enter Shares" disabled>
                <span id="sg" style="color:red"></span>
              </div>
            </div>
          </div>-->
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <p class="h6 font-weight-bold text-color-blue-custom">Section 9. <em>Affiliate Entitled to Vote</em></p>
            </div>
          </div>
          <?php if(isset($bylaw_info->additional_conditions_to_vote)){ if(strlen($bylaw_info->additional_conditions_to_vote) <= 0) : ?>
          <div class="row additionalConditionsForVoting">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <small>
                  This is the general conditions for members to vote.
                <ol type="a">
                  <li> Has paid the membership fee and the value of the minimum shares required for membership; </li>
                  <li> Is not delinquent in the payment of its share capital subscriptions and other accounts or obligations; </li>
                  <li> Has not violated any provision of cooperative laws, CDA administrative issuances, Articles of Cooperation and this By laws, the terms and conditions of the subscription agreement;  and the decisions, guidelines, rules and regulations promulgated by the Board of Directors and the General Assembly; </li>
                  <li> Has completed the continuing education program prescribed by the Board of Directors; </li>
                  <li> Has remitted the Cooperative Education and Training Fund (CETF)  due to the Federation/Union; and</li>
                  <li> Has participated in the affairs of the Federation and patronized its businesses in accordance with the policies and guidelines.</li>
                </ol>
              </small>
                <!-- <label for="additionalConditionsForVoting"><strong>List down any additional condition for members to be able to vote</strong><br><small class="text-info">Note: (each item must end with (;) semi-colon and the last item must end with a (.) period)</small></label> -->
                
                <textarea class="form-control " style="resize: none;" id="additionalConditionsForVoting" name="additionalConditionsForVoting[]" placeholder="Must be in a sentence"rows="8"  value="" disabled><?php if(isset($bylaw_info->additional_conditions_to_vote)){ echo $bylaw_info->additional_conditions_to_vote; } ?></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreMembersEntitledtoVoteBtn" disabled><i class="fas fa-plus"></i> Add More Members Entitled to Vote</button>
            </div>
          </div>
        <?php endif; } else {?>
          <div class="row additionalConditionsForVoting">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <small>
                  This is the general conditions for members to vote.
                <ol type="a">
                  <li> Has paid the membership fee and the value of the minimum shares required for membership; </li>
                  <li> Is not delinquent in the payment of its share capital subscriptions and other accounts or obligations; </li>
                  <li> Has not violated any provision of cooperative laws, CDA administrative issuances, Articles of Cooperation and this By laws, the terms and conditions of the subscription agreement;  and the decisions, guidelines, rules and regulations promulgated by the Board of Directors and the General Assembly; </li>
                  <li> Has completed the continuing education program prescribed by the Board of Directors; </li>
                  <li> Has remitted the Cooperative Education and Training Fund (CETF)  due to the Federation/Union; and</li>
                  <li> Has participated in the affairs of the Federation and patronized its businesses in accordance with the policies and guidelines.</li>
                </ol>
              </small>
                <!-- <label for="additionalConditionsForVoting"><strong>List down any additional condition for members to be able to vote</strong><br><small class="text-info">Note: (each item must end with (;) semi-colon and the last item must end with a (.) period)</small></label> -->
                
                <textarea class="form-control " style="resize: none;" id="additionalConditionsForVoting" name="additionalConditionsForVoting[]" placeholder="Must be in a sentence"rows="8"  value="" disabled><?php if(isset($bylaw_info->additional_conditions_to_vote)) { echo $bylaw_info->additional_conditions_to_vote; } ?></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreMembersEntitledtoVoteBtn" disabled><i class="fas fa-plus"></i> Add More Members Entitled to Vote</button>
            </div>
          </div>
        <?php } ?>
          <?php if(isset($bylaw_info->additional_conditions_to_vote)){ if(strlen($bylaw_info->additional_conditions_to_vote) > 0) : ?>
          <div class="row additionalConditionsForVoting">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <small>
                    This is the general conditions for members to vote.
                  <ol type="a">
                    <li> Has paid the membership fee and the value of the minimum shares required for membership; </li>
                  <li> Is not delinquent in the payment of its share capital subscriptions and other accounts or obligations; </li>
                  <li> Has not violated any provision of cooperative laws, CDA administrative issuances, Articles of Cooperation and this By laws, the terms and conditions of the subscription agreement;  and the decisions, guidelines, rules and regulations promulgated by the Board of Directors and the General Assembly; </li>
                  <li> Has completed the continuing education program prescribed by the Board of Directors; </li>
                  <li> Has remitted the Cooperative Education and Training Fund (CETF)  due to the Federation/Union; and</li>
                  <li> Has participated in the affairs of the Federation and patronized its businesses in accordance with the policies and guidelines.</li>
                  </ol>
                </small>
                </div>
              </div>
            <?php foreach($add_members_vote as $key => $add_members_votes) : ?>
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <?php if($key>=1) :?>
                    <a class="customDeleleBtn regularQualificationRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                  <?php endif; ?>
                  <label for="additionalConditionsForVoting<?= $key + 5?>">Entitled to vote <?= $key + 7?></label>
                  <textarea type="text" value="" class="form-control" name="additionalConditionsForVoting[]" id="additionalConditionsForVoting<?= $key + 5?>" disabled><?= $add_members_votes?></textarea>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="row">
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreMembersEntitledtoVoteBtn" disabled><i class="fas fa-plus"></i> Add More Members Entitled to Vote</button>
            </div>
          </div>
        <?php endif; }?>
          <div class="row">
            <div class="col-sm-12 col-md-12 text-center">
              <p class="font-weight-bold h5 text-color-blue-custom">Article III. Administration</p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <p class="h6 font-weight-bold text-color-blue-custom">Section 2. <em>Powers  of  the  General  Assembly</em></p>
            </div>
          </div>
          <div class="row additionaldelegatePowers">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <small>
                    This is the general conditions for Powers of General Assembly.
                  <ol type="a">
                    <li>To determine and approve amendments to the cooperative Articles of Cooperation and By-laws;</li>
                    <li>To elect or appoint the members of the board of directors, and to remove them for cause;</li>
                    <li>To approve developmental plans of the cooperative; and </li>
                    <li>To delegate the following power/s to a smaller body of the Federation:</li>
                  </ol>
                </small>
                </div>
              </div>
            <?php if($delegate_powers != '') { foreach($delegate_powers as $key => $add_members_votes) : ?>
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <?php if($key>=1) :?>
                      <a class="customDeleleBtn delegatePowersRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                    <?php endif; ?>
                    <label for="additionaldelegatePowers<?= $key + 5?>">General Assembly</label>
                    <textarea type="text" value="" class="form-control" name="additionaldelegatePowers[]" id="additionaldelegatePowers<?= $key + 5?>" disabled><?= $add_members_votes?></textarea>
                  </div>
                </div>
                <?php endforeach; } else {?>
                  <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <?php $key=0;?>
                      <a class="customDeleleBtn delegatePowersRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                    <label for="additionaldelegatePowers<?= $key + 5?>">General Assembly</label>
                    <textarea type="text" value="" class="form-control" name="additionaldelegatePowers[]" id="additionaldelegatePowers<?= $key + 5?>" disabled><?php if(isset($add_members_votes)) { echo $add_members_votes; } ?></textarea>
                  </div>
                </div>
                <?php } ?>
          </div>
          <div class="row">
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoredelegatePowersBtn" disabled><i class="fas fa-plus"></i> Add More General Assembly</button>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 col-md-12">
              <p class="h6 font-weight-bold text-color-blue-custom">Section 4. <em>Regular General Assembly Meeting</em></p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
<!--                                <select class="form-control validate[required]" id="regularMeetingDay" name="regularMeetingDay" placeholder="ex. second/2nd saturday of february" disabled>
                                    <option value="<?=$bylaw_info->annual_regular_meeting_day?>"><?=$bylaw_info->annual_regular_meeting_day?></option>
                                    <option value="first/1st saturday of January">first/1st saturday of January</option>
                                    <option value="second/2nd saturday of January">second/2nd saturday of January</option>
                                    <option value="third/3rd saturday of January">third/3rd saturday of January</option>
                                    <option value="fourth/4th saturday of January">fourth/4th saturday of January</option>
                                    <option value="first/1st saturday of February">first/1st saturday of February</option>
                                    <option value="second/2nd saturday of February">second/2nd saturday of February</option>
                                    <option value="third/3rd saturday of February">third/3rd saturday of February</option>
                                    <option value="fourth/4th saturday of February">fourth/4th saturday of February</option>
                                    <option value="first/1st saturday of March">first/1st saturday of March</option>
                                    <option value="second/2nd saturday of March">second/2nd saturday of March</option>
                                    <option value="third/3rd saturday of March">third/3rd saturday of March</option>
                                    <option value="fourth/4th saturday of March">fourth/4th saturday of March</option>
                                  </select>-->
              <label for="regularMeetingDay"><strong>On what day shall the General Assembly hold its annual regular meeting at the principal office of the Cooperation or at any place that may be determined by the board?</strong>  <small class="text-info">Shall not be beyond ninety (90) days after the close of the calendar year.</small></label>
              <input type="text" value="<?php if(isset($bylaw_info->annual_regular_meeting_day)) { echo $bylaw_info->annual_regular_meeting_day; } ?>" class="form-control" id="regularMeetingDay" name="regularMeetingDay" placeholder="ex. second/2nd saturday of february" disabled>
             </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <p class="h6 font-weight-bold text-color-blue-custom">Section 8. <em>Quorum for General Assembly Meeting</em></p>
            </div>
          </div>
        <?php if($coop_info->type_of_cooperative=='Electric'){
            $percenttext = 'Atleast five percent.';
            $percentage = 5;
        } else {
            $percenttext = 'Atleast twenty five percent.';
            $percentage = 25;
        }?>
          <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                      <label for="quorumPercentage"><strong>How many percent of the members are entitled to vote to constitute the quorum?</strong> <small  class="text-info"><?=$percenttext?></small></label>
                      <input type="number" value="<?php if(isset($bylaw_info->members_percent_quorom)) { echo $bylaw_info->members_percent_quorom; } ?>"  class="form-control" id="quorumPercentage" name="quorumPercentage" placeholder="Enter Percent %" value="25" disabled>
               </div>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12 text-center">
              <p class="font-weight-bold h5 text-color-blue-custom">Article IV. Board of Directors</p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <p class="h6 font-weight-bold text-color-blue-custom">Section 1. <em>Composition of the Board of Directors (BOD)</em></p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                   <label for="compositionoftheboard"><strong>The Board of Directors shall be composed of _____________() members.</strong></label>
                 <input type="number" value="<?php if(isset($bylaw_info->composition_of_bod)) { echo $bylaw_info->composition_of_bod; }?>" class="form-control" id="compositionoftheboard" name="compositionoftheboard" placeholder="Enter Number" disabled>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <p class="h6 font-weight-bold text-color-blue-custom">Section 4. <em>Disqualifications</em></p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                   <label for="consecutiveAbsences"><strong>How many consecutive absences in order to be disqualified?</strong></label>
                 <input type="number" value="<?php if(isset($bylaw_info->number_of_absences_disqualification)){ echo $bylaw_info->number_of_absences_disqualification; }?>" class="form-control" id="consecutiveAbsences" name="consecutiveAbsences" placeholder="Enter Number" disabled>
              </div>
               <div class="form-group">
                  <label for="consecutivePercentageAbsences"><strong>How many percent of absences of all meetings within a year in order to be disqualified?</strong> <small class="text-info">(Atleast twenty five percent.)</small></label>
                 <input type="number" value="<?php if(isset($bylaw_info->percent_of_absences_all_meettings)){ echo $bylaw_info->percent_of_absences_all_meettings; }?>" class="form-control" id="consecutivePercentageAbsences" name="consecutivePercentageAbsences" placeholder="Enter Percent %" disabled>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <p class="h6 font-weight-bold text-color-blue-custom">Section 5. <em>Election of Directors</em></p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="termHoldDirector"><strong>How many years should the directors hold office before the new election of directors?</strong></label>
                <input type="number" value="<?php if(isset($bylaw_info->director_hold_term)){ echo $bylaw_info->director_hold_term; }?>" class="form-control" id="termHoldDirector" name="termHoldDirector" placeholder="Enter years" disabled>
             </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12 text-center">
              <p class="font-weight-bold h5 text-color-blue-custom">Article VII. Capital Structure</p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <p class="h6 font-weight-bold text-color-blue-custom">Section 2. <em>Continuous Capital Build-Up</em></p>
              <p style="font-size:80%;" class="text-color-blue-custom"">*Note: Atleast one of the three is required.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
              <label for="investPerMonth"><strong>At least how much a member should invest per annum?</strong></label>
               <input type="text" value="<?php if(isset($bylaw_info->member_invest_per_month)){ if($bylaw_info->member_invest_per_month !== ''){ echo number_format($bylaw_info->member_invest_per_month,2); } }?>" class="form-control validate[custom[number]]" min="1" id="investPerMonth" name="investPerMonth" placeholder="" disabled>
             </div>
            </div>
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
              <label for="investAnnualInterest"><strong>Percentage of every member's annual interest on share capital and patronage refund should be invested?</strong></label>
               <input type="number" value="<?php if(isset($bylaw_info->member_percentage_annual_interest)) { echo $bylaw_info->member_percentage_annual_interest; } ?>" class="form-control" id="investAnnualInterest" name="investAnnualInterest" placeholder="%" disabled>
             </div>
            </div>
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
              <label for="investService"><strong>Percentage of goods procured/services availed by every member should be invested?</strong></label>
               <input type="number" value="<?php if(isset($bylaw_info->member_percentage_service)){ echo $bylaw_info->member_percentage_service; }?>" class="form-control" id="investService" name="investService" placeholder="%" disabled>
             </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12 text-center">
              <p class="font-weight-bold h5 text-color-blue-custom">Article VIII.Operations</p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <p class="h6 font-weight-bold text-color-blue-custom">Section 1. <em>Primary Consideration</em></p>
            </div>
          </div>

          <div class="row additionalPrimaryConsideration">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <small>
                    Adhering to the principle of service over and above profit, the Federation shall endeavor to:
                  <ol type="a">
                    <li>Engage in:</li>
                  </ol>
                </small>
                </div>
              </div>
            <?php if($primary_consideration != ''){ foreach($primary_consideration as $key => $add_members_votes) : ?>
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <?php if($key>=1) :?>
                      <a class="customDeleleBtn delegatePowersRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                    <?php endif; ?>
                    <label for="additionalPrimaryConsideration<?= $key + 5?>">a.<?=$key+1?></label>
                    <textarea type="text" value="" class="form-control" name="additionalPrimaryConsideration[]" id="additionalPrimaryConsideration<?= $key + 1?>" disabled><?= $add_members_votes?></textarea>
                  </div>
                </div>
                <?php endforeach; } else {?>
                  <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <?php $key = 0?>
                      <a class="customDeleleBtn delegatePowersRemoveBtn float-right text-danger"><i class="fas fa-minus-circle"></i></a>
                    <label for="additionalPrimaryConsideration<?= $key + 5?>">a.<?=$key+1?></label>
                    <textarea type="text" value="" class="form-control" name="additionalPrimaryConsideration[]" id="additionalPrimaryConsideration<?= $key + 1?>" disabled></textarea>
                  </div>
                </div>
                <?php } ?>
          </div>
          <div class="row">
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMorePrimaryConsiderationBtn" disabled><i class="fas fa-plus"></i> Add More Primary Consideration</button>
            </div>
          </div><br>

<!--          <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Adhering to the principle of service over and above profit, the Federation shall endeavor to:</label>
                    <p>a. Engage in:</p>
                </div>
            </div>
          </div>-->
          <div class="row">
            <div class="col-sm-12 col-md-12 text-center">
              <p class="font-weight-bold h5 text-color-blue-custom">Article IX.Allocation and Distribution of Net Surplus</p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <p class="h6 font-weight-bold text-color-blue-custom">Section 1. <em>Allocation</em></p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
              <label for="educationFund"><strong>Percentage to be set aside for Cooperative Education and Training Fund?</strong></label>
               <input type="number" value="<?php if(isset($bylaw_info->percent_education_fund)) { echo $bylaw_info->percent_education_fund; }?>" class="form-control" id="educationFund" name="educationFund" placeholder="%" disabled>
             </div>
            </div>
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
              <label for="reserveFund"><strong>Percentage to be set aside for Reserve Fund?</strong></label>
               <input type="number" value="<?php if(isset($bylaw_info->percent_reserve_fund)) { echo $bylaw_info->percent_reserve_fund; } ?>" class="form-control" id="reserveFund" name="reserveFund" placeholder="%" disabled>
             </div>
            </div>
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
              <label for="communityFund"><strong>Percentage to be set aside for Community Development Fund?</strong></label>
               <input type="number" value="<?php if(isset($bylaw_info->percent_community_fund)) { echo $bylaw_info->percent_community_fund; } ?>" class="form-control" id="communityFund" name="communityFund" placeholder="%" disabled>
             </div>
            </div>
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
              <label for="othersFund"><strong>Percentage to be set aside for Optional Fund?</strong></label>
               <input type="number" value="<?php if(isset($bylaw_info->percent_optional_fund)){ echo $bylaw_info->percent_optional_fund; } ?>" class="form-control" id="othersFund" name="othersFund" placeholder="%" disabled>
             </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <p class="h6 font-weight-bold text-color-blue-custom">Section 2. <em>Interest on Share Capital and Patronage Refund</em></p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                      <label for="nonMemberPatronYears"><strong>In the case of non-member patron, his/her proportionate amount of patronage refunds shall be set aside in a general fund for such patron and shall be allocated to individual non-member patron and only upon request and presentation of evidence of the amount of his/her patronage. The amount so allocated shall be credited to such patron toward payment of the minimum capital contribution for membership. When a sum equal to this amount has accumulated at any time within how many years?</strong></label>
                       <input type="number" value="<?php if(isset($bylaw_info->non_member_patron_years)) { echo $bylaw_info->non_member_patron_years; } ?>" class="form-control" id="nonMemberPatronYears" name="nonMemberPatronYears" placeholder="how many years" disabled>
                </div>
                </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12 text-center">
              <p class="font-weight-bold h5 text-color-blue-custom">Article XII. Amendments</p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <p class="h6 font-weight-bold text-color-blue-custom">Section 1. <em>Amendment of Articles of Cooperation and Bylaws</em></p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
              <label for="amendmentMembersWith"><strong>Amendments to the Articles of Cooperation and this By-Laws may be adopted by at least two-thirds (2/3) votes of all members with_________, present and constituting a quorum.</strong></label>
              <select class="custom-select" name="amendmentMembersWith" id="amendmentMembersWith" disabled>
                <option value="" selected>--</option>
                <option value="Voting Rights" <?php if(isset($bylaw_info->amendment_votes_members_with)) { if($bylaw_info->amendment_votes_members_with == "Voting Rights") echo "selected"; } ?>>Voting Rights</option>
                <!-- <option value="Members Entitled to Vote" <?php if($bylaw_info->amendment_votes_members_with == "Members Entitled to Vote") echo "selected"; ?>>Members Entitled to Vote</option> -->
              </select>
             </div>
            </div>
          </div>
      </div>
      <div class="card-footer bylawsPrimaryFooter" style="display: none;">
        <input class="btn btn-color-blue btn-block" type="submit" id="bylawsPrimaryBtn" name="bylawsPrimaryBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
<script src="<?=base_url();?>assets/js/jquery-3.7.1.min.js"></script>
<script type="text/javascript">
$("#optionalfund").hide();
$(document).ready(function(){

$("#regularMembershipPercentageSubscription").on('change', function(){

    var subscription_input1 =$(this).val();
    var expd1 =0;
     expd1 =Number(subscription_input1*0.25);
   $('#regularMembershipPercentagePay').val(expd1);
   //console.log($('#regularMembershipPercentagePay').val());
  

});

$("#associateMembershipPercentageSubscription").on('change', function(){

    var subscription_input =$(this).val();
    var expd =0;
     expd =Number(subscription_input*0.25);
   $('#associateMembershipPercentagePay').val(expd);
 

});

$("#communityFund").on('change', function(){
    
    var communityFund =$(this).val();
    var othersFund =$("#othersFund").val();
    var expd1 = 0;
    var total;
    expd1 = Math.abs(Number(communityFund-10));
    $('#othersFund').val(expd1);
    
});

$("#othersFund").on('change', function(){
    
    var othersFund =$(this).val();
    var communityFund =$("#communityFund").val();
    var expd1 = 0;
    var total;
    expd1 = Math.abs(Number(othersFund-10));
    $('#communityFund').val(expd1);
    
});

  });

jQuery(function ($) {
    var $inputs = $('input[name=investPerMonth],input[name=investAnnualInterest],input[name=investService]');
    $inputs.on('input', function () {
        var total = $('input[name=investPerMonth]').val().length + $('input[name=investAnnualInterest]').val().length + $('input[name=investService]').val().length;
        $inputs.not(this).prop('required', !total);

    });
});
</script>
