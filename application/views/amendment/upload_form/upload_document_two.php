<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_documents" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">Upload Pre-Registration PRS Certificate</h5>
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
      <?php echo form_open_multipart('amendment_documents/do_upload_two',array('id'=>'uploadOtherDocumentTwoForm','name'=>'uploadOtherDocumentTwoForm')); ?>
      <div class="card-body">
        <div class="row ac-row">
          <input type="hidden" class="form-control" id="amendment_id" name="amendment_id" value="<?=$encrypted_id ?>">
      
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
