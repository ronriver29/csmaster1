<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('bylaws/add_union',array('id'=>'bylawsUnionForm','name'=>'bylawsUnionForm')); ?>
      <div class="card-header">
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
                <select class="custom-select validate[required]" name="kindsOfMember" id="kindsOfMember">
                  <option value="" selected>--</option>
                  <option value="1">Regular Member Only</option>
                  <option value="2">Regular And Associate Member</option>
                </select>
              </div>
          </div>
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
            <label for="membershipFee"><strong>How much is the membership fee?</strong></label>
            <input type="number" min="1" step="1" class="form-control" id="membershipFee" name="membershipFee"placeholder="&#8369; 0.00">
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
              <textarea class="form-control validate" style="resize: none;" id="additionalRequirementsForMembership" name="additionalRequirementsForMembership" placeholder="Ex. &#10;item 1;&#10;item2;&#10;itemlast."rows="8"></textarea>
            </div>
          </div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="actUponMembershipDays"><strong>How many days will the Board of Directors have to act upon an application for membership once it has been submitted?</strong></label>
        			<input type="number" class="form-control" id="actUponMembershipDays" name="actUponMembershipDays" placeholder="Enter Days">
        			<small id="emailHelp" class="form-text text-muted">Days from the date filing.</small>
        		 </div>
           </div>
           <div class="col-sm-12 col-md-12">
             <div class="form-group">
               <label for="delegatePowers"><strong>Powers of the General Assembly.</strong> <br>Subject to the pertinent provisions of the Cooperative Code and the rules issued thereunder, the General Assembly shall have the following exclusive powers which cannot be delegated:<br><small>To delegate the following power/s to a smaller body of the Cooperative Union: (each item must end with (;) semi-colon and the last item must end with a (.) period)</small></label>
               <textarea class="form-control validate" style="resize: none;" id="delegatePowers" name="delegatePowers" placeholder="Ex. &#10;item 1;&#10;item2;&#10;itemlast."rows="10"></textarea>
             </div>
           </div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="quorumPercentage"><strong>How many percent of the members are entitled to vote to constitute the quorum?</strong></label>
        			<input type="number" class="form-control" id="quorumPercentage" name="quorumPercentage" min="25" placeholder="Enter Percent %">
        			<small id="emailHelp" class="form-text text-muted">Atleast twenty five percent.</small>
        		 </div>
           </div>
        		<div class="col-sm-12 col-md-12">
        		  <div class="form-group">
        			<label for="termHoldDirector"><strong>How many years should the office shall be hold before the new election of directors?</strong></label>
        			<input type="number" class="form-control" id="termHoldDirector" name="termHoldDirector" placeholder="Enter years">
        		 </div>
        		</div>
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
          			<label for="directorsTerm"><strong>All Directors should serve for a term of how many years?</strong></label>
          			<input type="number" class="form-control" id="directorsTerm" name="directorsTerm" placeholder="Enter years">
          		</div>
            </div>
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label for="primaryConsideration"><strong>Primary Consideration.</strong> <br>Adhering to the principle of service, list down the Cooperative Union shall endeavor to: <br><small>Engage in: (each item must end with (;) semi-colon and the last item must end with a (.) period)</small></label>
                <textarea class="form-control validate" style="resize: none;" id="primaryConsideration" name="primaryConsideration" placeholder="Ex. &#10;item 1;&#10;item2;&#10;itemlast."rows="10"></textarea>
              </div>
            </div>
          </div>
      </div>
      <div class="card-footer addCooperatorFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="bylawsPrimaryBtn" name="bylawsPrimaryBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
