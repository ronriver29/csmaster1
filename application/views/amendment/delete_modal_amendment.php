<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="deleteAmendmentForm" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteAmendmentModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('amendment/delete_amendment',array('id'=>'deleteAmendmentForm','name'=>'deleteAmendmentForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteMemberModalLabel">Are you sure you want to delete this?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="cooperativeID" name="cooperativeID">
              <div class="alert alert-warning" role="alert">
                <strong><b>Warning:</b></strong>
                <p>All <strong class="cooperative-name-text">test</strong> Cooperative's data will be deleted. There is no way to recover this.</p>
              </div>
               <label for="increaseFirst"><strong>Enter Password to Delete:</strong></label>
                <input type="password" placeholder="Password" value="" class="form-control validate[required]" id="password" name="password">
            </div>
            <div class="modal-footer deleteCooperativeFooter">
              <input class="btn btn-color-blue" type="submit" id="deleteAmendmentBtn" name="deleteAmendmentBtn" value="Delete">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
