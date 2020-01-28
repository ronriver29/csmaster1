<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="approveBranchModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="approveBranchModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('branches/approve_branch',array('id'=>'approveBranchForm','name'=>'approveBranchForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="approveBranchModalLabel">Are you sure you want to approve this application?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="branchID" name="branchID" readonly>
              <div class="form-group">
                <label for="bName">Branch Name:</label>
                <input type="text" class="form-control validate[required]"  id="bName" name="bName" placeholder="" readonly>
              </div>
              <div class="form-group">
                    <?php if($admin_info->access_level != 3) { ?>
                        <label for="comment">Additional Comment:</label>
                        <textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8"></textarea>
                    <?php } ?>
              </div>
              <!-- <div class="alert alert-info" role="alert">
                Branch Name:<br>
                <strong class="Branch-name-text">test</strong> <strong>Branch</strong>
              </div> -->
              <!-- <div class="form-group">
                <label for="comment">Additional Comment:</label>
                <textarea class="form-control " style="resize: none;" id="comment" name="comment" placeholder=""rows="8"></textarea>
              </div> -->
            </div>
                <?php 
                    if($admin_info->access_level != 3) { 
                        $note = "Submit";
                    } else {
                        $note = "Approve";
                    }
                ?>
            <div class="modal-footer approveBranchFooter">
                <input class="btn btn-color-blue" type="submit" id="approveBranchBtn" name="approveBranchBtn" value="<?=$note?>">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
