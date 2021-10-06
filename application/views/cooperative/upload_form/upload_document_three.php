<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/documents" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <?php
        echo '<h5 class="text-primary text-right">BOD resolution on authorized representative of each of the member-cooperatives</h5>';
    ?>
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
      <?php echo form_open_multipart('documents/do_upload_three_',array('id'=>'uploadOtherDocumentTwoForm','name'=>'uploadOtherDocumentTwoForm')); ?>
      <div class="card-body">
        <div class="row ac-row">
          <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
          <input type="hidden" class="form-control" id="uID" name="uID" value="<?=$encrypted_uid ?>">
          <input type="hidden" class="form-control" id="status" name="status" value="<?=$coop_info->status?>">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <input type="file" class="form-control validate[required]" name="file2" id="file2" accept="application/pdf">
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer uploadOtherDocumentTwoFooter">
        <input class="btn btn-color-blue btn-block" type="submit" id="uploadOtherDocumentTwoBtn" name="uploadOtherDocumentTwoBtn" value="Submit">
      </div>
    </form>
    </div>
  </div>
</div>
