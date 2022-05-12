<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="deleteCommitteeModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('amendment_committees_update/delete_committee',array('id'=>'deleteCommitteeForm','name'=>'deleteCommitteeForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteModalLabel">Are you sure you want to delete this?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" class="validate[required]" id="cooperativeID" name="cooperativeID">
              <input type="hidden" class="validate[required]" id="committeeID" name="committeeID">
              <div class="alert alert-warning" role="alert">
                <strong><b>Warning:</b></strong>
                <p><strong class="committee-name-text">test</strong> will be remove in <strong class="committee-cname-text">test</strong> committee. There is no way to recover this.</p>
              </div>
            </div>
            <div class="modal-footer deleteCommitteeFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="deleteCommitteeBtn" name="deleteCommitteeBtn" value="Delete">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
