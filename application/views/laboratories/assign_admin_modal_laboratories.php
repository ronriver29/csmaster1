<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="assignSpecialistModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="assignSpecialistLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('laboratories/specialist',array('id'=>'assignSpecialistForm','name'=>'assignSpecialistForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="assignSpecialistLabel">Assign Specialist Form</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <input type="hidden" name="cooperativesID" id="cooperativesID" value="">
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="cooperativeName" class="font-weight-bold">Name of Cooperative: </label>
                    <input type="text" class="form-control validate[required]" name="cooperativeName" id="cooperativeName" value="" readonly>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="specialistID" class="font-weight-bold">Name of Cooperative Development Specialist II</label>
                    <select class="custom-select validate[required]" name="specialistID" id="specialistID">
                      <option value="">--</option>
                      <?php foreach($list_specialist as $specialist) : ?>
                        <option value="<?= encrypt_custom($this->encryption->encrypt($specialist['id']))?>"><?= $specialist['full_name']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer assignSpecialistFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="assignSpecialistBtn" name="assignSpecialistBtn" value="Assign">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>