<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="editAffiliatorModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('unioncoop/edit_unioncoop',array('id'=>'editAffiliatorForm','name'=>'editAffiliatorForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="editModalLabel">Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>"> -->

              <input type="hidden" class="validate[required]" id="cooperatorID" name="cooperatorID">
              <input type="hidden" class="validate[required]" id="cooperativeID" name="cooperativesID">
              
              <!-- <input type="hidden" class="validate[required]" id="application_id" name="applicationid">
              <input type="hidden" class="validate[required]" id="coopname" name="coopName">
              <input type="hidden" class="validate[required]" id="regno" name="regNo">
              <input type="hidden" class="validate[required]" id="regid" name="registered_id"> -->
              <!-- <div class="alert alert-info" role="alert">
                <p> Are you sure you want to add <strong class="cooperator-name-text">test</strong> Cooperative?</p>
              </div> -->

           

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
                <label for="paidShares">Name of Representative:</label>
                <input type="text" class="form-control validate[required]" id="repre" name="repre">
                <!-- <input type="text" id="repre" name="repre" class="form-control validate[required]"> -->
              </div>
            </div>

            <div class="modal-footer deleteCooperatorFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="deleteCooperatorBtn" name="deleteCooperatorBtn" value="Add">
            </div>
             </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
