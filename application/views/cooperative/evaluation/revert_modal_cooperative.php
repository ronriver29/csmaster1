<!-- <div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="revertCooperativeModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deferCooperativeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('cooperatives/revert_cooperative',array('id'=>'revertCooperativeForm','name'=>'revertCooperativeForm')); ?>
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
                <strong class="cooperative-name-text">test</strong>
              </div>
              <div class="form-group">
                <label for="comment">State the reason/s:</label>
                <textarea class="form-control validate[required] cooperative-comment-text" style="resize: none;" id="comment" name="comment" placeholder="" rows="8"></textarea>
              </div>
            </div>
            <div class="modal-footer deferCooperativeFooter">
              <input class="btn btn-color-blue" type="submit" id="revertCooperativeBtn" name="revertCooperativeBtn" value="Defer">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> -->

<div class="modal fade" id="revertCooperativeModal" role="dialog">
  <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
    <div class="modal-content">
      <?php echo form_open('cooperatives/revert_cooperative',array('id'=>'revertCooperativeForm','name'=>'revertCooperativeForm')); ?>
        <div class="modal-header">
          <h4 class="modal-title" id="deferMemberModalLabel">Are you sure you want to revert this application?</h4>
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
            <label>Tool</label>
            <textarea class="form-control cooperative-comment-text" style="resize: none;" id="revert_tool" name="revert_tool" placeholder="" rows="3"></textarea><br>
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
                    <textarea class="form-control validate[required] cooperative-comment-text" style="resize: none;" id="comment" name="comment" placeholder="" rows="8"></textarea>
                  </td>
                  <td style="border:1px solid black;padding-top:5px;">
                    <textarea class="form-control validate[required] cooperative-documents-text" style="resize: none;" id="documents" name="documents" placeholder="" rows="8"></textarea>
                  </td>
                  <td style="border:1px solid black;padding-top:5px;">
                    <textarea class="form-control validate[required] cooperative-rec_action-text" style="resize: none;" id="rec_action" name="rec_action" placeholder="" rows="8"></textarea>
                  </td>
                </tr>
              </tbody>
            </table>
          <!-- </div> -->
        </div>
        <div class="modal-footer deferCooperativeFooter">
          <input class="btn btn-color-blue" type="submit" id="revertCooperativeBtn" name="revertCooperativeBtn" value="Revert">
        </div>
      </form>
    </div>
  </div>
</div>