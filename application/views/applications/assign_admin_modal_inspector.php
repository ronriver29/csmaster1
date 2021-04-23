<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="assignInspectorModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="assignSpecialistLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('cooperatives/assign_inspector',array('id'=>'assignInspectortForm','name'=>'assignInspectortForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="assignSpecialistLabel">Printing of COC</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <input type="hidden" name="cooperativesID" id="cooperativesID" value="">
                <input type="hidden" name="cooperativeRegno" id="cooperativeRegno" value="">
                <input type="hidden" name="cooperativeName" id="cooperativeName" value="">
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="cooperativeName" class="font-weight-bold">Registered Number: </label>
                    <input type="text" class="form-control validate[required]" name="cooperativeRegno" id="cooperativeRegno" value="" readonly>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="cooperativeName" class="font-weight-bold">Name of Cooperative: </label>
                    <input type="text" class="form-control validate[required]" name="cooperativeName" id="cooperativeName" value="" readonly>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="specialistID" class="font-weight-bold">Signatory:</label>
                    <input type="text" class="form-control validate[required]" name="full_name" id="full_name" value="">
                  </div>
                </div>
                <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                      <label for="specialistID" class="font-weight-bold">Signatory Designation</label>
                      <?php $arr = array("Chairperson","Director II","Director III","Administrator","Executive Director","Acting Director","OIC Director"); ?>
                      <select name="sign" class="form-control" id="sign">
                        <?php foreach($arr as $a) : ?>
                        <option value="<?=$a;?>"><?=$a;?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="specialistID" class="font-weight-bold">Year of Validity:</label>
                    <input type="number" min="2021" max="2099" step="1" value="2021"  name="validity" class="form-control" id="validity"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer assignInspectorFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="assignInspectortBtn" name="assignInspectortBtn" value="Assign">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>