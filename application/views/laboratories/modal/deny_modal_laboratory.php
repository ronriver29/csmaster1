<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="denyLaboratoryModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();" tabindex="-1" role="dialog" aria-labelledby="denyLaboratoryModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('laboratories/deny_laboratory',array('id'=>'denyLaboratoryForm','name'=>'denyLaboratoryForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="denyMemberModalLabel">Are you sure you want to deny this application?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="laboratoryID" name="laboratoryID" readonly>
              <div class="alert alert-info" role="alert">
                Laboratory Name:<br>
                <strong class="laboratory-name-text">test</strong> <strong></strong>
              </div>
              <div class="form-group">
                <label for="comment">State the reason/s:</label>
                <textarea class="form-control validate[required]" style="resize: none;" id="comment" name="comment" placeholder="" rows="8"></textarea>
              </div>
            </div>
            <div class="modal-footer denyCooperativeFooter">
              <input class="btn btn-color-blue" type="submit" id="denyLaboratoryBtn" name="denyLaboratoryBtn" value="Deny">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
