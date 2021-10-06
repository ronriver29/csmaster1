<div class="row">
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
                <strong class="cooperative-name-text">test</strong> <strong></strong>
              </div>
              
              <div class="form-group">
                <label for="comment">Documents: </label>
                <pre>
                <textarea class="form-control validate[required]" style="resize: none;" id="comment" name="comment" placeholder=""rows="8"><?php 
                foreach($senior_comment as $senior){
                  if(strlen($senior['documents'])>0)
                  {
                    echo $senior['documents'].PHP_EOL;
                  }
                }?></textarea></pre>
              </div>

              <div class="form-group">
                <label for="comment">Findings: </label>
                <pre>
                <textarea class="form-control validate[required]" style="resize: none;" id="comment" name="comment" placeholder=""rows="8"><?php 
                foreach($senior_comment as $senior){
                  if(strlen($senior['comment'])>0)
                  {
                    echo $senior['comment'].PHP_EOL;
                  }
                }?></textarea></pre>
              </div>

              <div class="form-group">
                <label for="comment">Recomended Action: </label>
                <pre>
                <textarea class="form-control validate[required]" style="resize: none;" id="comment" name="comment" placeholder=""rows="8"><?php 
                foreach($senior_comment as $senior){
                  if(strlen($senior['rec_action'])>0)
                  {
                    echo $senior['rec_action'].PHP_EOL;
                  }
                }?></textarea></pre>
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
