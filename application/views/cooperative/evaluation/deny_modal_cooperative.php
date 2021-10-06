<!-- <div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="denyCooperativeModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="denyCooperativeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('cooperatives/deny_cooperative',array('id'=>'denyCooperativeForm','name'=>'denyCooperativeForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="denyMemberModalLabel">Are you sure you want to deny this application?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>
              <div class="alert alert-info" role="alert">
                Cooperative Name:<br>
                <strong class="cooperative-name-text">test</strong>
              </div>
              <div class="form-group">
                <label for="comment">State the reason/s:</label>
                <textarea class="form-control validate[required]" style="resize: none;" id="comment" name="comment" placeholder=""rows="8"><?php echo $coop_info->evaluation_comment;?></textarea>
              </div>
            </div>
            <div class="modal-footer denyCooperativeFooter">
              <input class="btn btn-color-blue" type="submit" id="denyCooperativeBtn" name="denyCooperativeBtn" value="Deny">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
 -->
 <?php
if(!$this->cooperatives_model->check_if_revert($coop_info->id)){
?>
<div class="modal fade" id="denyCooperativeModal" role="dialog">
  <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
      <?php echo form_open('cooperatives/deny_cooperative',array('id'=>'denyCooperativeForm','name'=>'denyCooperativeForm')); ?>
        <div class="modal-header">
          <h4 class="modal-title" id="denyCooperativeModalLabel">Are you sure you want to deny this application?</h4>
          <!-- <h4 class="modal-title"></h4> -->
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body form"> 
          <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>
          <input type="hidden" id="cnameorig" name="cnameorig">
                <div class="alert alert-info" role="alert">
                  Cooperative Name:<br>
                  <strong class="cooperative-name-text">test</strong>
                </div>
          <!-- <div class="row"> -->
          <div class="row">
            <div class="col-md-12">
              <label class="font-weight-bold">Tools Additional Comments:</label>
              <?php if($this->cooperatives_model->check_if_revert($coop_info->id)){ ?>
                <textarea class="form-control cooperative-comment-text" style="resize: none;" id="tool_comments" name="tool_comments" placeholder="" rows="4"><?php foreach($cooperatives_comments_snr_revert_defer as $cc) : echo $cc['revert_tool']."\n";endforeach; ?></textarea><br>
              <?php } else {?>
                <textarea class="form-control cooperative-comment-text" style="resize: none;" id="tool_comments" name="tool_comments" placeholder="" rows="4"><?php foreach($cooperatives_comments_snr_defer as $cc) : echo $cc['tool_comments']."\n";endforeach; ?></textarea><br>
              <?php }
                        // echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
                        // foreach($cooperatives_comments_snr as $cc) :
                        //   echo '<p>'.nl2br($cc['tool_comments']).'</p>'; 
                        // endforeach;
                ?>
            </div>
          </div>
            <table class="table"  with="100%">
              <thead>
                <tr>
                  <th style="border:1px solid black;">Documents</th>
                  <th style="border:1px solid black;">Findings</th>
                  <th style="border:1px solid black;">Recomended Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="border:1px solid black;padding-top:5px;">
                    <textarea class="form-control validate[required] cooperative-comment-text" style="resize: none;" id="comment" name="comment" placeholder="" rows="8"><?php foreach($cooperatives_comments_snr_defer as $cc) : echo $cc['comment']."\n";endforeach; ?></textarea>
                  </td>
                  <td style="border:1px solid black;padding-top:5px;">
                    <textarea class="form-control validate[required] cooperative-documents-text" style="resize: none;" id="documents" name="documents" placeholder="" rows="8"><?php foreach($cooperatives_comments_snr_defer as $cc) : echo $cc['documents']."\n";endforeach; ?></textarea>
                  </td>
                  <td style="border:1px solid black;padding-top:5px;">
                    <textarea class="form-control validate[required] cooperative-rec_action-text" style="resize: none;" id="rec_action" name="rec_action" placeholder="" rows="8"><?php foreach($cooperatives_comments_snr_defer as $cc) : echo $cc['rec_action']."\n";endforeach; ?></textarea>
                  </td>
                </tr>
              </tbody>
            </table>
          <!-- </div> -->
        </div>
        <div class="modal-footer denyCooperativeFooter">
          <input class="btn btn-color-blue" type="submit" id="denyCooperativeBtn" name="denyCooperativeBtn" value="Deny">
        </div>
      </form>
    </div>
  </div>
</div>
<?php } else {?>
<div class="modal fade" id="denyCooperativeModal" role="dialog">
  <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
      <?php echo form_open('cooperatives/deny_cooperative',array('id'=>'denyCooperativeForm','name'=>'denyCooperativeForm')); ?>
        <div class="modal-header">
          <h4 class="modal-title" id="denyCooperativeModalLabel">Are you sure you want to deny this application?</h4>
          <!-- <h4 class="modal-title"></h4> -->
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body form"> 
          <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>
                <div class="alert alert-info" role="alert">
                  Cooperative Name:<br>
                  <strong class="cooperative-name-text">test</strong>
                </div>
          <!-- <div class="row"> -->
          <div class="row">
            <div class="col-md-12">
              <label class="font-weight-bold">Tools Additional Comments:</label>
                <textarea class="form-control cooperative-comment-text" style="resize: none;" id="tool_comments" name="tool_comments" placeholder="" rows="4"><?php foreach($cooperatives_comments_snr_revert_defer as $cc) : echo $cc['revert_tool']."\n";endforeach; ?></textarea><br>
              <?php 
                        // echo '<p class="font-weight-bold">CDS Tool Findings:</p>';
                        // foreach($cooperatives_comments_snr as $cc) :
                        //   echo '<p>'.nl2br($cc['tool_comments']).'</p>'; 
                        // endforeach;
                ?>
            </div>
          </div>
            <table class="table"  with="100%">
              <thead>
                <tr>
                  <th style="border:1px solid black;">Documents</th>
                  <th style="border:1px solid black;">Findings</th>
                  <th style="border:1px solid black;">Recomended Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="border:1px solid black;padding-top:5px;">
                    <textarea class="form-control validate[required] cooperative-comment-text" style="resize: none;" id="comment" name="comment" placeholder="" rows="8"><?php foreach($cooperatives_comments_snr_revert_defer as $cc) : echo $cc['comment']."\n";endforeach; ?></textarea>
                  </td>
                  <td style="border:1px solid black;padding-top:5px;">
                    <textarea class="form-control validate[required] cooperative-documents-text" style="resize: none;" id="documents" name="documents" placeholder="" rows="8"><?php foreach($cooperatives_comments_snr_revert_defer as $cc) : echo $cc['documents']."\n";endforeach; ?></textarea>
                  </td>
                  <td style="border:1px solid black;padding-top:5px;">
                    <textarea class="form-control validate[required] cooperative-rec_action-text" style="resize: none;" id="rec_action" name="rec_action" placeholder="" rows="8"><?php foreach($cooperatives_comments_snr_revert_defer as $cc) : echo $cc['rec_action']."\n";endforeach; ?></textarea>
                  </td>
                </tr>
              </tbody>
            </table>
          <!-- </div> -->
        </div>
        <div class="modal-footer denyCooperativeFooter">
          <input class="btn btn-color-blue" type="submit" id="denyCooperativeBtn" name="denyCooperativeBtn" value="Deny">
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>