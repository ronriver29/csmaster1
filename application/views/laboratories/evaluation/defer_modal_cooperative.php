<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="deferCooperativeModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deferCooperativeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document" style="width:90% !important;max-width:1360px;">
        <div class="modal-content">
          <?php echo form_open('cooperatives/defer_cooperative',array('id'=>'deferCooperativeForm','name'=>'deferCooperativeForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deferMemberModalLabel">Are you sure you want to defer this application?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>
              <div class="alert alert-info" role="alert">
                Cooperative Name:<br>
                <strong class="cooperative-name-text">test</strong> <strong>Cooperative</strong>
              </div>
              <div class="form-group">
                <label for="comment">State the reason/s:</label>
                <textarea class="form-control validate[required]" style="resize: none;" id="comment" name="comment" placeholder=""rows="8"><?php echo $coop_info->evaluation_comment;?></textarea>
              </div>
            </div>
            <div class="modal-footer deferCooperativeFooter">
              <input class="btn btn-color-blue" type="submit" id="deferCooperativeBtn" name="deferCooperativeBtn" value="Defer">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
