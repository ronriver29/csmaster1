<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <?php if($coop_info->status == 0 || $coop_info->status == 80 || $coop_info->status == 81){?>
      <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>branch_update/<?= $encrypted_branch_id ?>/documents_branch_update" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php } else { ?>
      <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>branches/<?= $encrypted_branch_id ?>/documents" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php } ?>
      <h5 class="text-primary text-right">Other Requirements</h5>
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
      <?php echo form_open_multipart('documents/do_upload_others_bns',array('id'=>'uploadOtherDocumentForm','name'=>'uploadOtherDocumentForm')); ?>
      <div class="card-body">
        <div class="row ac-row">
          <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
          <input type="hidden" class="form-control" id="uID" name="uID" value="<?=$encrypted_uid ?>">
          <input type="hidden" class="form-control" id="branchID" name="branchID" value="<?=$encrypted_branch_id ?>">
          <input type="hidden" class="form-control" id="status" name="status" value="<?=$coop_info->status?>">
          <input type="hidden" class="form-control" id="application_id" name="application_id" value="<?=$coop_info->application_id?>">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <input type="file" class="form-control validate[required]" name="file42" id="file42" accept="application/pdf">
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
