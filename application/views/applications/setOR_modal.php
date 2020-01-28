<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="setORModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="assignSpecialistLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('cooperatives/assign_specialist',array('id'=>'assignSpecialistForm','name'=>'assignSpecialistForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="assignSpecialistLabel">Order of Payment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <input type="text" name="coopID" id="coopID" value="">
              
              <label for="coopName" class="font-weight-bold">Name of Cooperative: </label>
              <input type="text" class="form-control validate[required]" name="coopName" id="coopName" value="" readonly>
                  
              </div>
            </div>
            <div class="modal-footer assignSpecialistFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="assignSpecialistBtn" name="assignSpecialistBtn" value="Save Official Receipt No.">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

