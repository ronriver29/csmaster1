<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="editLabCertModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('updated_laboratory_info_registered/edit_lab_cert',array('id'=>'EditLabCertForm','name'=>'EditLabCertForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteModalLabel">Edit Laboratory Certificate</h4>
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
                      <label>Laboratory Certificate</label>
                      <input type="text" id="lab_cert" class="form-control" name="lab_cert">
                </div>
                <div class="alert alert-info" role="alert">
                      <label>Date Registered:</label>
                      <input type="date" id="date_registered" class="form-control" name="date_registered">
                </div>
            </div>
            <div class="modal-footer deleteAdministratorFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="editCertBtn" name="editCertBtn" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script>
  var currentdate = new Date();
  var month = currentdate.getMonth() + 1;
  var day = currentdate.getDate();
  var formated_date = ( (('' + day).length < 2 ? '0' : '')  + day + '-' + (('' + month).length < 2 ? '0' : '') + month + '-' +currentdate.getFullYear());
  $('#date_registered').text(formated_date);
</script>