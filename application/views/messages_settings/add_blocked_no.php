<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="addAffiliatorModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('api_settings/add_blocked_no',array('id'=>'deleteCooperatorForm','name'=>'deleteCooperatorForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteModalLabel">Are you sure you want to add this?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <!-- <div class="form-group">
              <label for="membershipType">Type of Membership:</label>
              <select class="custom-select validate[required]" id="membershipType" name="membershipType">
                <option value="" selected>--</option>
                <option value="Regular">Regular</option>
                <?php if($bylaw_info->kinds_of_members==2) :?>
                  <option value="Associate">Associate</option>
                <?php endif?>
              </select>
            </div> -->
            <div class="col-md-12">
              <div class="form-group">
                <label for="subscribedShares">Mobile:</label>
                <input type="text" class="form-control validate[required]" id="mobile" name="mobile">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="paidShares">Reason:</label>
                <textarea type="text" class="form-control" id="reason" name="reason"></textarea>
              </div>
            </div>
            <div class="modal-footer deleteCooperatorFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="deleteCooperatorBtn" name="deleteCooperatorBtn" value="Add">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
