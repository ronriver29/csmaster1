<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="changestatusModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="assignSpecialistLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('admins/change_status',array('id'=>'changestatusForm','name'=>'changestatusForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="assignSpecialistLabel">Change Status Form</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <input type="hidden" name="statusid" id="status_id" value="">
                <input type="hidden" name="cooperativesID" id="cooperativesID" value="">
                <input type="hidden" name="module_type" id="" value="Cooperative">
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="cooperativeName" class="font-weight-bold">Name of Cooperative: </label>
                    <input type="text" class="form-control validate[required]" name="" id="cooperativeName" value="" readonly>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="statuschange" class="font-weight-bold">Change Into: </label>
                    <select class="custom-select validate[required]" name="statuschange" id="statuschange">
                      <option value="">--</option>
                        <option value="1">Back to Client</option>
                        <option value="2">For Validation</option>
                        <option value="3">For Validation of CDS II / Re-assign Validator</option>
                        <option value="6">For Re-Evaluation / Submitted by CDS II</option>
                        <option value="9">Submitted By Senior CDS</option>
                        <option value="10">Denied by Director</option>
                        <option value="11">Deferred by Director</option>
                        <option value="12">For Print & Submit</option>
                        <option value="13">Waiting For O.R</option>
                        <option value="14">For Printing</option>
                        <option value="16">For Payment</option>

                        <!-- 
                        if($cooperative['status']==2 || $cooperative['status']==3)echo "FOR VALIDATION"; 
                        else if($cooperative['status']==4) echo "DENIED BY CDS II";
                        else if($cooperative['status']==5) echo "DEFERRED BY CDS II";
                        else if($cooperative['status']==6 && $cooperative['third_evaluated_by']>0) echo "FOR RE-EVALUATION";
                        else if($cooperative['status']==6) echo "SUBMITTED BY CDS II";
                        else if($cooperative['status']==7) echo "DENIED BY SENIOR CDS";
                        else if($cooperative['status']==8) echo "DEFERRED BY SENIOR CDS";
                        else if($cooperative['status']==9 && !$is_acting_director && $admin_info->access_level==3) echo "DELEGATED BY DIRECTOR";
                        else if($cooperative['status']==9 && $supervising_ && $admin_info->access_level==4) echo "DELEGATED BY DIRECTOR";
                        else if($cooperative['status']==9) echo "SUBMITTED BY SENIOR CDS";
                        else if($cooperative['status']==10) echo "DENIED BY DIRECTOR";
                        else if($cooperative['status']==11) echo "DEFERRED BY DIRECTOR";
                        else if($cooperative['status']==12) echo "FOR PRINT&SUBMIT";
                        else if($cooperative['status']==13) echo "WAITING FOR O.R.";
                        else if($cooperative['status']==14) echo "FOR PRINTING";
                        else if($cooperative['status']==15) echo "REGISTERED"; 
                        else if($cooperative['status']==16) echo "FOR PAYMENT"; ?> -->
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer changestatusFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="statuschangeBtn" name="statuschangeBtn" value="Assign">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>