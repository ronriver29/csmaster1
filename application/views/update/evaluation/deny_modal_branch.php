<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="denyBranchModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="denyBranchModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document" style="width:90% !important;max-width:1360px;">
        <div class="modal-content">
          <?php echo form_open('branches/deny_branch',array('id'=>'denyBranchForm','name'=>'denyhBranchForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="denyMemberModalLabel">Are you sure you want to deny this application?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="branchID" name="branchID" readonly>
              <input type="hidden" id="bnameorig" name="bnameorig">
              <div class="alert alert-info" role="alert">
                <?=$branch_info->type?> Name:<br>
                <strong class="branch-name-text" name="bname"></strong>
              </div>
              <div class="form-group">
                <label for="comment">State the reason/s:</label>
                <textarea class="form-control validate[required]" style="resize: none;" id="comment" name="comment" placeholder=""rows="8"><?php foreach($branches_comments_snr_limit as $cc) : echo $cc['comment']."\n";endforeach; ?></textarea>
              </div>
            </div>
            <div class="modal-footer denyBranchFooter">
              <input class="btn btn-color-blue" type="submit" id="denyBranchBtn" name="denyBranchBtn" value="Deny">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
