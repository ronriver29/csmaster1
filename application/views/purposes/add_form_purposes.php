<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/purposes" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      Edit Purposes
    </h5>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('cooperatives/'.$encrypted_id.'/purposes/edit',array('id'=>'editPurposesForm','name'=>'editPurposesForm')); ?>
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-articles-primary">
            <h4 class="float-left">That the purposes for which this Cooperative is organized are to engage in:</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <input type="hidden" class="form-control validate[required]" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 offset-md-8 col-md-4">
            <button type="button" class="btn btn-success btn-sm btn-block" name="addMorePurposeBtn" id="addMorePurposeBtn"><i class="fas fa-plus"></i> Add More Purpose</button>
          </div>
        </div>
        <div class="row row-purposes">
          <?php $tempCount = sizeof($contents);
          foreach($contents as $key => $content): ?>
          <div class="col-sm-12 col-md-12 col-purpose">
            <div class="form-group">
                <a class="customDeleleBtn purposeRemoveBtn float-left text-danger"><i class="fas fa-minus-circle"></i></a>
              <label for="purpose<?= ($tempCount - $key)?>"><strong>Purpose No. <?=  ($key + 1)?></strong></label>
              <textarea class="form-control validate[required] textarea-purpose" id="purpose<?= ($tempCount - $key)?>" name="purposes[]" placeholder="Must be in sentence "rows="2"><?= $content ?></textarea>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
      </div>
      <div class="card-footer editPurposesFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="editPurposesBtn" name="editPurposesBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
