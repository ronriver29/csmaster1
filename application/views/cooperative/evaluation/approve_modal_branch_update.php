<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="approveBranchModal" role="dialog">
      <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
          <div class="modal-content">
            <?php echo form_open('branch_update/approve_branch',array('id'=>'approveBranchForm','name'=>'approveBranchForm')); ?>
              <div class="modal-header">
                <?php if($branch_info->status==9 || ($branch_info->status==12 && $branch_info->evaluator5 == NULL || $branch_info->evaluator5 == 0)){
                  $submit = 'submit';
                } else {
                  $submit = 'approve';
                }?>
                <h4 class="modal-title" id="approveBranchModalLabel">Are you sure you want to <?=$submit?> this application?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body form">
                <input type="hidden" id="branchID" name="branchID" readonly>
                <div class="form-group">
                  <label for="bName"><?=$branch_info->type?> Name:</label>
                  <input type="text" class="form-control validate[required]"  id="bName" name="bName" placeholder="" readonly>
                </div>
              </div>
              <div class="modal-footer approveBranchFooter">
                  <input class="btn btn-color-blue" type="submit" id="approveBranchBtn" name="approveBranchBtn" value="Approve">
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
