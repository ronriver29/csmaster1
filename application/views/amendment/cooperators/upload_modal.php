<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="UploadCooperatorModal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Upload excel file</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <?=form_open_multipart(base_url('/amendment_update_cooperator/importcptr'));?>
            <div class="form-group">
              <input type="hidden" name="cid" class="form-control" value="<?=$encrypted_coop_id?>">
              <input type="hidden" name="aid" class="form-control" value="<?=$encrypted_id?>">
              <input type="file" name="excel_file" class="form-control" required="required">

            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-success" value="submit" name="submit">
            </div>
          <?=form_close();?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
