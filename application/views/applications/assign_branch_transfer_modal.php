<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="assignBranchSpecialistModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="assignBranchSpecialistLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('For_transfer/specialist',array('id'=>'assignBranchSpecialistForm','name'=>'assignBranchSpecialistForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="assignBranchSpecialistLabel">Assign Specialist Form</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <input type="hidden" name="branchID" id="branchID" value="">
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="branchName" class="font-weight-bold">Branch Name: </label>
                    <input type="text" class="form-control validate[required]" name="branchName" id="branchName" value="" readonly>
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
              <input class="btn btn-color-blue btn-block" type="submit" id="assignBranchSpecialistBtn" name="assignBranchSpecialistBtn" value="Assign">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>