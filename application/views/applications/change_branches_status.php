<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="changebranchstatusModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="assignSpecialistLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <?php echo form_open('admins/change_status',array('id'=>'changebranchstatusForm','name'=>'changebranchstatusForm')); ?>
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
                <input type="hidden" name="reg_code" id="reg_code" value="">
                <input type="hidden" name="module_type" id="" value="Branches">
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="cooperativeName" class="font-weight-bold">Name of Branch: </label>
                    <input type="text" class="form-control validate[required]" name="" id="cooperativeName" value="" readonly>
                  </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script>
                $(document).ready(function(){
                    // Get value on button click and show alert
                    $("#statuschange").hide();
                    $("#changelabel").hide();
                    $("#statuschange2").hide();
                    $("#changelabel2").hide();
                    $("#determine").show();
                    $("#determine").click(function(){
                        $("#determine").hide();
                        var str = $("#reg_code").val();
                        if(str == 0){
                          // function addOption() { 
                              // optionText = 'Premium'; 
                              // optionValue = 'premium'; 
                              // $('#statuschange').append(`<option value="${optionValue}"> 
                              //                            ${optionText} 
                              //                       </option>`); 
                          // } 
                          $("#statuschange").show();
                          $("#changelabel").show();
                          $("#statuschange2").hide();
                          $("#changelabel2").hide();
                        } else {
                          $("#statuschange").hide();
                          $("#changelabel").hide();
                          $("#statuschange2").show();
                          $("#changelabel2").show();
                        }
                    });
                    $(".close").click(function(){
                      $("#statuschange").hide();
                      $("#changelabel").hide();
                      $("#statuschange2").hide();
                      $("#changelabel2").hide();
                      $("#determine").show();
                    });
                });
                </script>
                <div class="col-md-12">
                  <input class="btn btn-color-blue btn-block" type="" id="determine" name="determine" value="Click here to determine if it's Outside / Inside the Region">
                </div>
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="statuschange" id="changelabel" class="font-weight-bold"><h3><b>Outside the Region</b></h3> <br> Change Into: </label>
                    <select class="custom-select" name="statuschange" id="statuschange" required="">
                      <option value="">--</option>
                        <option value="1">Back to Client</option>
                        <option value="2">For Validation</option>
                        <!-- <option value="4">Denied by CDS II</option> -->
                        <option value="5">Submitted by Senior CDS</option>
                        <option value="6">Denied by Director</option>
                        <option value="7">Deferred by Director Within the Region</option>
                        <option value="8">For Validation Inside the Region</option>
                        <option value="24">For Validation of Senior Outside the region OR Head Office type</option>
                        <option value="23">For Validation of Director Outside the region OR Head Office type</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="statuschange" id="changelabel2" class="font-weight-bold"><h3><b>Inside the Region </b></h3><br>Change Into: </label>
                    <select class="custom-select" name="statuschange" id="statuschange2" required="">
                      <option value="">--</option>
                        <option value="1">Back to Client</option>
                        <option value="2">For Validation</option>
                        <!-- <option value="4">Denied by CDS II</option> -->
                        <option value="5">Submitted by Senior CDS</option>
                        <option value="6">Denied by Director</option>
                        <option value="7">Deferred by Director Within the Region</option>
                        <option value="8">For Validation Inside the Region</option>
                        <option value="24">For Validation of Senior Outside the region OR Head Office type</option>
                        <option value="23">For Validation of Director Outside the region OR Head Office type</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer changebranchstatusFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="branchstatuschangeBtn" name="branchstatuschangeBtn" value="Assign">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- else if($branch['status']==3) echo "DENIED BY SENIOR CDS";
else if($branch['status']==4) echo "DEFERRED BY SENIOR CDS";
else if($branch['status']==5) echo "SUBMITTED BY SENIOR CDS";
else if($branch['status']==6) echo "DENIED BY DIRECTOR";
else if($branch['status']==7) echo "DEFERRED BY DIRECTOR";
else if($branch['status']==8 || $branch['status']==9)echo "FOR VALIDATION";                        
else if($branch['status']==10) echo "DENIED BY CDS II";
else if($branch['status']==11) echo "DEFERRED BY CDS II";
else if($branch['status']==12 && $branch['evaluator5']>0) echo "FOR VALIDATION";
else if($branch['status']==12) echo "SUBMITTED BY CDS II";
else if($branch['status']==13) echo "DENIED BY SENIOR CDS";
else if($branch['status']==14) echo "DEFERRED BY SENIOR CDS";
else if($branch['status']==15) echo "SUBMITTED BY SENIOR CDS";
else if($branch['status']==16) echo "DENIED BY DIRECTOR";
else if($branch['status']==17) echo "DEFERRED BY DIRECTOR";
else if($branch['status']==18) echo "FOR PAYMENT";
else if($branch['status']==19) echo "WAITING FOR O.R.";
else if($branch['status']==20) echo "FOR PRINTING";
else if($branch['status']==21) echo "REGISTERED";
else if($branch['status']==22) echo "FOR PAYMENT";
else if($branch['status']==23) echo "SUBMITTED BY SENIOR CDS";
else if($branch['status']==24) echo "FOR VALIDATION";  -->