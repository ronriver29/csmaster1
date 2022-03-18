<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="resetPasswordModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('admins/reset_password_new_user',array('id'=>'resetPasswordForm','name'=>'resetPasswordForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteModalLabel">Password Reset</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>User:<strong class="admin-name-text"></strong></p>
                <input type="hidden" class="validate[required]" id="adminID" name="adminID">
                <div class="alert alert-info" role="alert">
                      <label>New Password:</label>
                      <input type="password" id="pword" class="form-control validate[required,minSize[4]]" name="pword">
                      <label>Confirm Password:</label>
                      <input type="password" id="cPword" class="form-control validate[equals[pword]]" name="cPword"> 
                </div>
            </div>
            <div class="modal-footer deleteAdministratorFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="resetPasswordBtn" name="resetPasswordBtn" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
