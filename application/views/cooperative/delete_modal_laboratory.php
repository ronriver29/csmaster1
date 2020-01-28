<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="deleteBranchModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteBranchModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('branches/delete_branch',array('id'=>'deleteBranchForm','name'=>'deleteBranchForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteBranchModalLabel">Are you sure you want to delete this?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="branchID" name="branchID">
              <div class="alert alert-warning" role="alert">
                <strong><b>Warning:</b></strong>
                <p>All <strong class="branch-name-text">test</strong>' data will be deleted. There is no way to recover this.</p>
              </div>
            </div>
            <div class="modal-footer deleteBranchFooter">
              <input class="btn btn-color-blue" type="submit" id="deleteBranchBtn" name="deleteBranchBtn" value="Delete">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
