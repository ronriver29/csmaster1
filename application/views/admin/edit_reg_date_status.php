<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="editRegDateStatusModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('admins/edit_reg_date_status',array('id'=>'EditRegDateStatusForm','name'=>'EditRegDateStatusForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteModalLabel">Edit Date Registered & Status</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>User: <strong class="admin-name-text"></strong></p>
                <p>Registered Number: <strong class="reg-no-text"></strong></p>
                <input type="hidden" class="validate[required]" id="adminID" name="adminID">
                <input type="hidden" class="regno" name="regno">
                <div class="alert alert-info" role="alert">
                      <label>Date Registered:</label>
                      <input type="date" id="date_registered" class="form-control" name="date_registered">
                      <!-- <label>Status:</label>
                      <select class="custom-select validate[required]" name="compliant" id="compliant">
                        <option value="">--</option>
                        <option value="Compliant">Compliant</option>
                        <option value="Dissolved">Dissolved</option>
                      </select> -->
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
<script src="<?=base_url();?>assets/js/jquery-3.7.1.min.js"></script>
<script>
  var currentdate = new Date();
  var month = currentdate.getMonth() + 1;
  var day = currentdate.getDate();
  var formated_date = ( (('' + day).length < 2 ? '0' : '')  + day + '-' + (('' + month).length < 2 ? '0' : '') + month + '-' +currentdate.getFullYear());
  $('#date_registered').text(formated_date);
</script>