<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="approveBranchModal" role="dialog">
      <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
          <div class="modal-content">
            <?php echo form_open('for_closure/approve_branch',array('id'=>'approveBranchForm','name'=>'approveBranchForm')); ?>
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
                <div class="form-group">
                  <!-- Level 1 -->
                      <?php if(($admin_info->access_level != 3 || $branch_info->status==23) && ( $admin_info->access_level != 3 && $branch_info->status!=9 && $branch_info->status!=12 && $branch_info->status!=2 && ($branch_info->evaluator1 == NULL || $branch_info->evaluator1 != NULL))) { ?>
                        <label for="comment">Additional Comment:</label>
                        <textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8"><?php foreach($branches_comments_director_level1 as $cc) : echo $cc['comment']."\n";endforeach; ?></textarea>
                      <?php } else if(($admin_info->access_level == 3 && $branch_info->status==23) && $branch_info->evaluator1 != NULL) {?>
                        <label for="comment">Additional Comment:</label>
                        <textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8"><?php foreach($branches_comments_snr_limit as $cc) : echo $cc['comment']."\n";endforeach; ?></textarea>
                      <?php } ?>
                  <!-- End Level 1  -->
                      <!-- <?php if(($admin_info->access_level != 3 || $branch_info->status==23) && $branch_info->evaluator2 != NULL) { ?>
                          <label for="comment">Additional CommenTTt:</label>
                          <?php if($branch_info->status==9){
                            echo '<textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8">'.$branch_info->tool_findings.'</textarea>';
                          } else if($branch_info->status==12 && $branch_info->evaluator5 == NULL && $branch_info->evaluator5 == 0){
                            echo '<textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8">'.$branch_info->comment_by_specialist.'</textarea>';
                          } else {
                          ?>
                          <?php if($branch_info->status==12 && $branch_info->evaluator5 == NULL || $branch_info->evaluator5 == 0) { ?>
                            <textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8"><?php foreach($branches_comments_cds as $cc) : echo $cc['comment']."\n";endforeach; ?></textarea>
                          <?php } else if($branch_info->status==12 && $branch_info->evaluator5 != NULL || $branch_info->evaluator5 != 0) {?>
                            <textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8"><?php foreach($branches_comments_director_limit as $cc) : echo $cc['comment']."\n";endforeach; ?></textarea>
                          <?php } ?>
                      <?php } } ?> -->
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
