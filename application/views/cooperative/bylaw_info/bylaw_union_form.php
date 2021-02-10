<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('bylaws/'.$encrypted_id.'/union',array('id'=>'bylawsUnionForm','name'=>'bylawsUnionForm')); ?>
      <div class="card-header">
          <input type="hidden" class="form-control" id="bylaw_coop_id" name="bylaw_coop_id" value="<?=$encrypted_id ?>">
        <div class="row">
          <div class="col-sm-12 col-md-4">
            <h4>By Laws Information:</h4>
          </div>
          <div class="col-sm-12 offset-md-7 col-md-1">
            <h5 class="text-primary">Step 1</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="kindsOfMember">Kinds of Member:</label>
                <select class="custom-select" name="kindsOfMember" id="kindsOfMember">
                  <option value="" selected>--</option>
                  <option value="1" <?php if($bylaw_info->kinds_of_members == 1) echo "selected"; ?>>Regular Member Only</option>
                  <option value="2" <?php if($bylaw_info->kinds_of_members == 2) echo "selected"; ?>>Regular And Associate Member</option>
                </select>
              </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
            <label for="membershipFee"><strong>How much is the membership fee?</strong></label>
            <input type="number" min="1" value="<?= number_format($bylaw_info->membership_fee,2) ?>" step="1" class="form-control" id="membershipFee" name="membershipFee"placeholder="&#8369; 0.00">
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
               
        
              <input class="form-control " style="resize: none;" id="additionalRequirementsForMembership" name="additionalRequirementsForMembership[]" placeholder="Must be in a sentence" rows="8" value="<?= $bylaw_info->additional_requirements_for_membership ?>">
            </div>
          </div>
        </div>

        <!--<div class="row">-->
            <div class="col-sm-12 offset-md-8 col-md-4">
              <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreRequirementsBtn"><i class="fas fa-plus"></i> Add More Requirements for Membership</button>
            </div>
          <!--</div>-->
          <!--</div>-->
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="actUponMembershipDays"><strong>How many days will the Board of Directors have to act upon an application for membership once it has been submitted?</strong></label>
        			<input type="number" class="form-control" id="actUponMembershipDays" name="actUponMembershipDays" placeholder="Enter Days" value="<?= $bylaw_info->act_upon_membership_days ?>">
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

                        <input class="form-control " style="resize: none;" id="additionaldelegatePowers" name="additionaldelegatePowers[]" placeholder="Must be in a sentence" rows="8" value="<?= $bylaw_info->delegate_powers ?>">
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 offset-md-8 col-md-4">
                    <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoredelegatePowersBtn"><i class="fas fa-plus"></i> Add More General Assembly</button>
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
        			<input type="number" class="form-control" id="quorumPercentage" name="quorumPercentage" min="25" placeholder="Enter Percent %" value="<?=$bylaw_info->members_percent_quorom?>">
        			<small id="emailHelp" class="form-text">Atleast twenty five percent.</small>
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
          			<label for="directorsTerm"><strong>All Directors should serve for a term of how many years?</strong></label>
          			<input type="number" class="form-control" id="directorsTerm" name="directorsTerm" placeholder="Enter years" value="<?=$bylaw_info->directors_term?>">
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

                    <input class="form-control " style="resize: none;" id="primaryConsideration" name="primaryConsideration[]" placeholder="Must be in a sentence" rows="8" value="<?= $bylaw_info->delegate_powers ?>">
                    </div>
                </div>
            </div>

            <div class="col-sm-12 offset-md-8 col-md-4">
                <button type="button" class="btn btn-success btn-block btn-sm float-right" id="addMoreprimaryConsiderationBtn"><i class="fas fa-plus"></i> Add More Primary Consideration</button>
            </div>

<!--            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="primaryConsideration"><strong>Primary Consideration.</strong> <br>Adhering to the principle of service, list down the Cooperative Union shall endeavor to: <br><small>Engage in: (each item must end with (;) semi-colon and the last item must end with a (.) period)</small></label>
                <textarea class="form-control" style="resize: none;" id="primaryConsideration" name="primaryConsideration" placeholder="Ex. &#10;item 1;&#10;item2;&#10;itemlast."rows="10"></textarea>
              </div>
            </div>-->
          </div>
      </div>
      <div class="card-footer addCooperatorFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="bylawsUnionBtn" name="bylawsUnionBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
