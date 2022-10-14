<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>branches/<?= $encrypted_branch_id ?>/documents_conversion_submission" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Upload Letter Request for Authority </h5>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-info" role="alert">
      Only <strong>PDF</strong> file is allowed.
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open_multipart('documents_conversion_submission/do_upload_54',array('id'=>'uploadOtherDocumentForm','name'=>'uploadOtherDocumentForm')); ?>
      <div class="card-body">
        <div class="row ac-row">
          <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
          <input type="hidden" class="form-control" id="uID" name="uID" value="<?=$encrypted_uid ?>">
          <input type="hidden" class="form-control" id="branchID" name="branchID" value="<?=$encrypted_branch_id ?>">
          <input type="hidden" class="form-control" id="status" name="status" value="<?=$coop_info->status?>">
          <input type="hidden" class="form-control" id="application_id" name="application_id" value="<?=$coop_info->application_id?>">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <input type="file" class="form-control validate[required]" name="file54" id="file54" accept="application/pdf">
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer uploadOtherDocumentFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="uploadOtherDocumentBtn" name="uploadOtherDocumentBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
