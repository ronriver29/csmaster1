<!-- <div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="approveCooperativeModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="approveCooperativeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('cooperatives/approve_cooperative',array('id'=>'approveCooperativeForm','name'=>'approveCooperativeForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="approveCooperativeModalLabel">Are you sure you want to submit this application?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>
              <div class="form-group">
                <label for="cName">Cooperative Name:</label>
                <input type="text" class="form-control validate[required]"  id="cName" name="cName" placeholder="" readonly>
              </div> -->
<!--              <div class="alert alert-info" role="alert">
                Cooperative Name:<br>
                <strong class="cooperative-name-text">test</strong> <strong>Cooperative</strong>
              </div>-->
              <!-- <div class="form-group">
                    <?php if($admin_info->access_level != 3) { ?>
                        <label for="comment">Additional Comment:</label>
                        <textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8"></textarea>
                    <?php } ?>
              </div>
            </div>
            <div class="modal-footer approveCooperativeFooter">
              <input class="btn btn-color-blue" type="submit" id="approveCooperativeBtn" name="approveCooperativeBtn" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> -->

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="approveCooperativeModal" role="dialog">
      <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
        <div class="modal-content">
          <?php echo form_open('cooperatives/approve_cooperative',array('id'=>'approveCooperativeForm','name'=>'approveCooperativeForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deferMemberModalLabel">Are you sure you want to submit this application?</h4>
              <!-- <h4 class="modal-title"></h4> -->
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form"> 
              <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>
                <div class="form-group">
                  <label for="cName">Cooperative Name:</label>
                  <input type="text" class="form-control validate[required]"  id="cName" name="cName" placeholder="" readonly>
                </div>
                <?php
                if($this->cooperatives_model->check_if_revert($coop_info->id) && $coop_info->status != 9 && $admin_info->access_level != 3 && $admin_info->access_level != 4){ ?>
                    <div class="row">
	                  <div class="col-md-12">
	                    <label class="font-weight-bold">CDS Tool Findings:</label>
            			<textarea class="form-control cooperative-comment-text" style="resize: none;" id="revert_tool" name="revert_tool" placeholder="" rows="4"><?php foreach($cooperatives_comments_defer as $cc) : echo $cc['revert_tool']."\n";endforeach; ?></textarea><br>
	                  </div>
	                </div>
                <?php } ?>
                <?php if($coop_info->status != 9){?>
                <?php if($admin_info->access_level == 1 || ($admin_info->access_level == 2 && $coop_info->third_evaluated_by!=0 && !$this->cooperatives_model->check_if_revert($coop_info->id)) && $admin_info->access_level != 3 && $admin_info->access_level != 4) { ?>
                <div class="row">
                  <div class="col-md-12">
                        <label class="font-weight-bold">CDS Tool Findings:</label>
                        <?php if(isset($cooperatives_comments_defer)){?>
                        	<textarea class="form-control cooperative-comment-text" style="resize: none;" id="revert_tool" name="revert_tool" placeholder="" rows="4"><?php 
                        foreach($cooperatives_comments_defer as $cc) : echo $cc['tool_comments']."\n";endforeach; ?></textarea><br>
                    	<?php } else {?>
                    		<textarea class="form-control validate[required] cooperative-comment-text" style="resize: none;" id="revert_tool" name="revert_tool" placeholder="" rows="4"><?=$coop_info->tool_findings?></textarea><br>
                        <?php } ?>
                      <br>
                  </div>
                </div>
              <?php } else if($admin_info->access_level == 2 && $coop_info->third_evaluated_by==0){?>
                <label class="font-weight-bold">CDS Tool Findings:</label>
                <textarea class="form-control cooperative-comment-text" style="resize: none;" id="revert_tool" name="revert_tool" placeholder="" rows="4"><?php foreach($cooperatives_comments_cds as $cc) : echo $cc['tool_comments']."\n";endforeach; ?></textarea><br>
              <?php } ?>
              <!-- <div class="row"> -->
              	<?php if($admin_info->access_level != 3 && $admin_info->access_level != 4){?>
                <table class="table"  with="100%">
                  <thead>
                    <tr>
                      <th style="border:1px solid black;">Documents</th>
                      <th style="border:1px solid black;">Findings</th>
                      <th style="border:1px solid black;">Recommended Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if($coop_info->third_evaluated_by==0){?>
                        <td style="border:1px solid black;padding-top:5px;">
                          <?php if($admin_info->access_level != 3 && $admin_info->access_level !=1) { ?>
                              <textarea class="form-control validate[required] cooperative-comment-text" style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder="" rows="8"><?php foreach($cooperatives_comments_cds as $cc) : echo $cc['comment']."\n";endforeach; ?></textarea>
                              <!-- <textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8"></textarea> -->
                          <?php } else {?>
                              <textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8"></textarea>
                          <?php } ?>
                        </td>
                        <td style="border:1px solid black;padding-top:5px;">
                          <?php if($admin_info->access_level != 3 && $admin_info->access_level !=1) { ?>
                              <textarea class="form-control validate[required] cooperative-documents-text" style="resize: none;" id="documents" name="documents" placeholder="" rows="8"><?php foreach($cooperatives_comments_cds as $cc) : echo $cc['documents']."\n";endforeach; ?></textarea>
                              <!-- <textarea class="form-control " style="resize: none;" id="documents" name="documents" placeholder=""rows="8"></textarea> -->
                          <?php } else {?>
                              <textarea class="form-control " style="resize: none;" id="documents" name="documents" placeholder=""rows="8"></textarea>
                          <?php } ?>
                        </td>
                        <td style="border:1px solid black;padding-top:5px;">
                          <?php if($admin_info->access_level != 3 && $admin_info->access_level !=1) { ?>
                              <textarea class="form-control " style="resize: none;" id="rec_action" name="rec_action" placeholder=""rows="8"><?php foreach($cooperatives_comments_cds as $cc) : echo $cc['rec_action']."\n";endforeach; ?></textarea>
                          <?php } else {?>
                              <textarea class="form-control " style="resize: none;" id="rec_action" name="rec_action" placeholder=""rows="8"></textarea>
                          <?php } ?>
                        </td>
                      <?php } else {?>
                        <td style="border:1px solid black;padding-top:5px;">
                        <?php if($admin_info->access_level != 3 && $admin_info->access_level !=1) { ?>
                            <textarea class="form-control validate[required] cooperative-comment-text" style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder="" rows="8"><?php if(isset($cooperatives_comments_defer)){ 
                                    foreach($cooperatives_comments_defer as $cc) {
                                      echo $cc['comment']."\n".""; 
                                    }
                                    echo '</textarea>';
                              } else {?>
                              <?php } ?>
                            <!-- <textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8"></textarea> -->
                        <?php } else {?>
                            <textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8"></textarea>
                        <?php } ?>
                      </td>
                      <td style="border:1px solid black;padding-top:5px;">
                        <?php if($admin_info->access_level != 3 && $admin_info->access_level !=1) { ?>
                            <textarea class="form-control validate[required] cooperative-documents-text" style="resize: none;" id="documents" name="documents" placeholder="" rows="8"><?php
                                  if(isset($cooperatives_comments_defer)){ 
                                    foreach($cooperatives_comments_defer as $cc) {
                                      echo $cc['documents']."\n"."</textarea>"; 
                                    }
                              } else {?></textarea>
                              <?php } ?>
                        <?php } else {?>
                            <textarea class="form-control " style="resize: none;" id="documents" name="documents" placeholder=""rows="8"></textarea>
                        <?php } ?>
                      </td>
                      <td style="border:1px solid black;padding-top:5px;">
                        <?php if($admin_info->access_level != 3 && $admin_info->access_level !=1) { ?>
                            <textarea class="form-control " style="resize: none;" id="rec_action" name="rec_action" placeholder=""rows="8"><?php 
                                  if(isset($cooperatives_comments_defer)){ 
                                    foreach($cooperatives_comments_defer as $cc) {
                                      echo $cc['rec_action']."\n"."</textarea>"; 
                                    }
                              } else {?></textarea>
                              <?php } ?>
                        <?php } else {?>
                            <textarea class="form-control " style="resize: none;" id="rec_action" name="rec_action" placeholder=""rows="8"></textarea>
                        <?php } ?>
                      </td>
                      <?php } ?>
                    </tr>
                  </tbody>
                </table>
              <?php } }?>
              <!-- </div> -->
            </div>
            <div class="modal-footer approveCooperativeFooter">
              <input class="btn btn-color-blue" type="submit" id="approveCooperativeBtn" name="approveCooperativeBtn" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>