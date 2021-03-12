<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="deleteCooperativeModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteCooperativeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('cooperatives/delete_cooperative',array('id'=>'deleteCooperativeForm','name'=>'deleteCooperativeForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteMemberModalLabel">Options <i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top"
                data-html="true" title="Select for the following"></i></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success" role="alert">
                <strong class="cooperative-name-text"><center><a class="btn btn-link" href="<?php echo base_url();?>users/use_registered_email" role="button">Use Registered Email Account</a></center></strong>
              </div>
              <div class="alert alert-success" role="alert">
                <strong class="cooperative-name-text"><center><a class="btn btn-link" href="<?php echo base_url();?>users/create_new_email_account" role="button">Create New  Email Account</a></center></strong>
              </div>
            </div>
            <div class="modal-footer deleteCooperativeFooter">
              <!-- <input class="btn btn-color-blue" type="submit" id="deleteCooperativeBtn" name="deleteCooperativeBtn" value="Delete"> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
