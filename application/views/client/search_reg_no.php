<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="deleteCooperativeModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteCooperativeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('cooperatives/delete_cooperative',array('id'=>'deleteCooperativeForm','name'=>'deleteCooperativeForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteMemberModalLabel">Search <i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top"
                data-html="true" title="Select for the following"></i></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label for="RegNo">Registered number:</label>
                <input type="text" class="form-control" id="regno" name="regno">
            </div>
            <div class="modal-footer deleteCooperativeFooter">
              <!-- <input class="btn btn-color-blue" type="submit" id="deleteCooperativeBtn" name="deleteCooperativeBtn" value="Delete"> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
