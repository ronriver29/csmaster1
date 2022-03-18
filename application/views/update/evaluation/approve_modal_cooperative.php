<!-- <div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="approveCooperativeModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="approveCooperativeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('cooperatives/approve_cooperative',array('id'=>'approveCooperativeForm','name'=>'approveCooperativeForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="approveCooperativeModalLabel">Are you sure you want to submit this application?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>
              <div class="form-group">
                <label for="cName">Cooperative Name:</label>
                <input type="text" class="form-control validate[required]"  id="cName" name="cName" placeholder="" readonly>
              </div> -->
<!--              <div class="alert alert-info" role="alert">
                Cooperative Name:<br>
                <strong class="cooperative-name-text">test</strong> <strong>Cooperative</strong>
              </div>-->
              <!-- <div class="form-group">
                    <?php if($admin_info->access_level != 3) { ?>
                        <label for="comment">Additional Comment:</label>
                        <textarea class="form-control " style="resize: none;" id="comment" name="comment_by_specialist_senior" placeholder=""rows="8"></textarea>
                    <?php } ?>
              </div>
            </div>
            <div class="modal-footer approveCooperativeFooter">
              <input class="btn btn-color-blue" type="submit" id="approveCooperativeBtn" name="approveCooperativeBtn" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> -->

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="approveCooperativeModal" role="dialog">
      <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
        <div class="modal-content">
          <?php echo form_open('cooperatives_update/approve_cooperative',array('id'=>'approveCooperativeForm','name'=>'approveCooperativeForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deferMemberModalLabel">Are you sure you want to approve this application?</h4>
              <!-- <h4 class="modal-title"></h4> -->
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form"> 
              <input type="hidden" id="cooperativeID" name="cooperativeID" readonly>
                <div class="form-group">
                  <label for="cName">Cooperative Name:</label>
                  <input type="text" class="form-control validate[required]"  id="cName" name="cName" placeholder="" readonly>
                </div>
              <!-- </div> -->
            </div>
            <div class="modal-footer approveCooperativeFooter">
              <input class="btn btn-color-blue" type="submit" id="approveCooperativeBtn" name="approveCooperativeBtn" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>