<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="revertCooperativeModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deferCooperativeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document"> 
        <div class="modal-content">
          <?php echo form_open('amendment/defer_cooperative',array('id'=>'deferCooperativeForm','name'=>'deferCooperativeForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deferMemberModalLabel">Are you sure you want to revert this application?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>
              <div class="alert alert-info" role="alert">
                Cooperative Name:<br>
                <strong class="cooperative-name-text">test</strong> <strong></strong>
              </div>

  
               
               <label class="font-weight-bold">Tools Additional Comments:</label>
                <pre><textarea class="form-control" rows="4" style="resize: none;text-align: left;padding:0px;margin-bottom:40px;" name="tool_findings"><?php if(isset($revert_comment_array)){foreach($revert_comment_array as $cc){echo $cc['tool_findings'].PHP_EOL;}}?></textarea></pre>
              
              
             
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
                    <td style="border:1px solid black;padding-top:5px;">
                     
                      <div class="form-group">
                              <pre><textarea class="form-control " style="resize: none;" id="comment" name="documents" placeholder=""rows="8"><?php if(isset($revert_comment_array)){foreach($revert_comment_array as $cc){ echo$cc['documents'].PHP_EOL;}}?></textarea></pre>
                        </div>
                    </td>
                    <td style="border:1px solid black;padding-top:5px;">
                        <div class="form-group">
                              <pre><textarea class="form-control " style="resize: none;" id="comment" name="comment" placeholder=""rows="8"><?php if(isset($revert_comment_array)){foreach($revert_comment_array as $cc){echo $cc['comment'].PHP_EOL;}}?></textarea></pre>
                        </div>
                    </td>
                    <td style="border:1px solid black;padding-top:5px;">
                        <div class="form-group">
                              <pre><textarea class="form-control " style="resize: none;" id="comment" name="recomended_action" placeholder=""rows="8"><?php if(isset($revert_comment_array)){foreach($revert_comment_array as $cc){echo $cc['rec_action'].PHP_EOL;}}?></textarea></pre>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
        
            </div>
            <div class="modal-footer deferCooperativeFooter">
              <input class="btn btn-color-blue" type="submit" id="deferCooperativeBtn" name="deferCooperativeBtn" value="<?=($coop_info->status==12 ? "Submit" : "Defer")?>">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
