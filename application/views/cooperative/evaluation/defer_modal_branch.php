<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="deferBranchModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deferBranchModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('branches/defer_branch',array('id'=>'deferBranchForm','name'=>'deferBranchForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deferMemberModalLabel">Are you sure you want to defer this application?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="branchID" name="branchID" readonly>
              <div class="alert alert-info" role="alert">
                Branch Name:<br>
                <strong class="branch-name-text">test</strong>
              </div>
              <div class="form-group">
                <label for="comment">State the reason/s:</label>
                <textarea class="form-control validate[required]" style="resize: none;" id="branch-comment-text" name="comment" rows="8"></textarea>
              </div>
            </div>
            <div class="modal-footer deferBranchFooter">
              <input class="btn btn-color-blue" type="submit" id="deferBranchBtn" name="deferBranchBtn" value="Defer">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
