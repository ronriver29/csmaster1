<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="deleteCooperatorModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('amendment_update_cooperator/delete_cooperator',array('id'=>'deleteCooperatorForm','name'=>'deleteCooperatorForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteModalLabel">Are you sure you want to delete this?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" class="validate[required]" id="cooperativeID" name="cooperativeID">
              <input type="hidden" class="validate[required]" id="cooperatorID" name="cooperatorID">
              <div class="alert alert-warning" role="alert">
                <strong><b>Warning:</b></strong>
                <p>All <strong class="cooperator-name-text">test</strong>'s data will be delete. There is no way to recover this.</p>
              </div>
            </div>
            <div class="modal-footer deleteCooperatorFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="deleteCooperatorBtn" name="deleteCooperatorBtn" value="Delete">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
