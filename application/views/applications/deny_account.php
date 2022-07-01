<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="denyaccountModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="assignSpecialistLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open(base_url().'account_approval/'.encrypt_custom($this->encryption->encrypt($account_info->usersid)).'/deny/'.encrypt_custom($this->encryption->encrypt($account_info->email)).'',array('id'=>'denyaccountForm','name'=>'denyaccountForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="assignSpecialistLabel">Deny Account</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="cooperativeName" class="font-weight-bold">Reason: </label>
                    <input type="hidden" class="form-control validate[required]" name="adminID" id="reason" value="<?=encrypt_custom($this->encryption->encrypt($account_info->id))?>">
                    <input type="hidden" class="form-control validate[required]" name="name" id="reason" value="<?=$account_info->first_name.' '.$account_info->last_name?>">
                    <input type="hidden" class="form-control validate[required]" name="regno" id="reason" value="<?=$account_info->regno?>">
                    <input type="hidden" class="form-control validate[required]" name="email" id="reason" value="<?=$account_info->email.' - (DFV)'?>">
                    <textarea type="text" class="form-control validate[required]" name="reason" id="reason"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer denyaccountFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="assignSpecialistBtn" name="assignSpecialistBtn">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- assignSpecialistModal -->