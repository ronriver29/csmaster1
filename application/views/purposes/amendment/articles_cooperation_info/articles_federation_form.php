<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('articles/add_union',array('id'=>'articlesUnionForm','name'=>'articlesUnionForm')); ?>
      <div class="card-header">
        <div class="row">
          <div class="col-sm-12 col-md-4">
            <h4>Articles of Cooperation - Federation Information:</h4>
          </div>
          <div class="col-sm-12 offset-md-7 col-md-1">
            <h5 class="text-primary">Step 1</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
      		  <div class="form-group">
      			<label for="cooperativeExistence"><strong>How many Years does the Cooperative Union should exist?</strong></label>
      			<input type="number" class="form-control" min="1" max="50" id="cooperativeExistence" placeholder="Years">
      			<small id="emailHelp" class="form-text text-muted">Start from the date of registration </small>
      		 </div>
      		</div>
          <div class="col-sm-12 col-md-12">
      		  <div class="form-group">
      			<label for="authorizedShareCapital"><strong>What is the Authorized  Share Capital of the Cooperative?</strong></label>
      			 <input type="number" class="form-control" id="authorizedShareCapital" name="authorizedShareCapital" min="1" placeholder="&#8369; .00">
      			<small id="emailHelp" class="form-text text-muted"> </small>
      		 </div>
      		</div>
      		<div class="col-sm-12 col-md-8">
      		  <div class="form-group">
      			<label for="commonShares"><strong>Authorized Shared Capital will be divided into how many shares ?</strong></label>
      			 <input type="number" class="form-control" id="commonShares" name="commonShares" placeholder="Shares">
      		 </div>
      		</div>
      		<div class="col-sm-12 col-md-4">
      		  <div class="form-group">
      			<label for="parValueCommon"><strong>What is the Par value per share?</strong></label>
      			 <input type="number" class="form-control" id="parValueCommon" name="parValueCommon" placeholder="&#8369; .00">
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
