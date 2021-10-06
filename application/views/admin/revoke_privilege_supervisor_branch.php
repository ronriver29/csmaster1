<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="revokeSupervisorModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="revokeSupervisorModallLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('admins/revoke_supervisor_branch',array('id'=>'revokeSupervisorForm','name'=>'revokeSupervisorForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="revokeSupervisorModallLabel">Are you sure you want to revoke all authority to Supervising CDS?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-warning" role="alert">
                <strong><b>Note:</b></strong>
                <p>The Supervising CDS will not be able to approve, deny and defer an application.</p>
              </div>
            </div>
            <div class="modal-footer revokeSupervisorFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="revokeSupervisorBtn" name="revokeSupervisorBtn" value="Revoke">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
