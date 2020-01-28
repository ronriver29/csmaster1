<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="grantSupervisorModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="grantSupervisorModallLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('admins/grant_supervisor',array('id'=>'grantSupervisorForm','name'=>'grantSupervisorForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="grantSupervisorModallLabel">Are you sure you want to grant all privilege to Supervising CDS?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-warning" role="alert">
                <strong><b>Note:</b></strong>
                <p>The Supervising CDS will be able to approve, deny and defer an application.</p>
              </div>
            </div>
            <div class="modal-footer grantSupervisorFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="grantSupervisorBtn" name="grantSupervisorBtn" value="Grant">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
