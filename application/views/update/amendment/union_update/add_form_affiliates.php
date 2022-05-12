<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="addAffiliatorModalamd" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
        <div class="modal-content">
          <?php echo form_open('amendment_union_update/add_affiliates',array('id'=>'deleteCooperatorForm','name'=>'deleteCooperatorForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteModalLabel">Are you sure you want to add this?asfdasd</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" class="validate[required]" id="types" name="types">
              <input type="hidden" class="validate[required]" id="amd_union_id" name="amd_union_id">
              <input type="hidden" class="validate[required]" id="cooperativeID" name="cooperativesID">
              <input type="hidden" class="validate[required]" id="amendment_id" name="amendment_id">
              <input type="hidden" class="validate[required]" id="coopname" name="coopName">
              <input type="hidden" class="validate[required]" id="regno" name="regNo">
              <input type="hidden" class="validate[required]" id="regid" name="registered_id">
              <div class="alert alert-info" role="alert">
                <p> Are you sure you want to add <strong class="cooperator-name-text">test</strong> Cooperative?</p>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group"> 
                    <label for="position">Position:</label>
                    <select class="custom-select validate[required]" id="position" name="position" >
                      <option value="" selected>--</option>
                      <option value="Chairperson">Chairperson</option>
                      <option value="Vice-Chairperson">Vice-Chairperson</option>
                      <option value="Board of Director">Board of Director</option>
                      <option value="Treasurer">Treasurer</option>
                      <option value="Secretary">Secretary</option>
                      <option value="Member">Member</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="paidShares">Name of Representative:</label>
                    <input type="text" id="fName" class="form-control validate[required]" name="fName">
                    <div id="paid-note" style="color: red; font-size:12px;"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="validIdType">Proof of Identity: </label>
                    <select class="custom-select validate[required]" id="validIdType" name="validIdType">
                      <option selected>--</option>
                      <option value="Digitized Postal ID">Digitized Postal ID</option>
                      <option value="Driver's License">Driver's License</option>
                      <option value="GSIS E-Card">GSIS E-Card</option>
                      <option value="IBP ID">IBP ID</option>
                      <option value="OWWA ID">OWWA ID</option>
                      <option value="Passport">Passport</option>
                      <option value="PRC ID">PRC ID</option>
                      <option value="Senior Citizen's ID">Senior Citizen's ID</option>
                      <option value="SSS ID">SSS ID</option>
                      <option value="TIN">TIN</option>
                      <option value="Voter's ID">Voter's ID</option>
                      <option value="Philhealth">Philhealth</option>
                      <option value="OFW">OFW</option>
                      <option value="Single Parent">Single Parent</option>
                      <option value="PWD">PWD</option>
                      <option value="pag-ibig">Pag-IBIG</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-4">
                  <div class="form-group form-group-validIdNo">
                    <label for="validIdNo">Valid ID No.</label>
                    <input type="text" class="form-control validate[required]" id="validIdNo" name="validIdNo">
                  </div>
                </div>
                <div class="col-sm-12 col-md-4">
                  <div class="form-group">
                    <label for="dateIssued"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>In Accordance with Notarial Law.</li>"></i> Date Issued:</label>
                    <input type="date" class="form-control validate[required,custom[date],past[now]]" id="dateIssued" name="dateIssued">
                   <!-- <input type="text" class="form-control validate[required]" id="dateIssued" name="dateIssued"> -->
                    <!-- <small style="margin-left: 20px;"><span><i>  yyyy-mm-dd </i></span></small> -->
                    <input type="checkbox" name="dateIssued_chk" id="chkID" value="N/A"> <small>ID Date Issued not available</small>
                  </div>
                </div>
                <div class="col-sm-12 col-md-4">
                  <div class="form-group">
                    <label for="placeIssuance">Place of Issuance: </label>
                    <textarea class="form-control validate[required]" id="placeIssuance" name="placeIssuance" rows="1"></textarea>
                  </div>
                </div>
              </div>
              <?php if($coop_info->capital_contribution != $cc_count->total_cc){
                $max = $coop_info->capital_contribution - $cc_count->total_cc;
              } else {
                $max = '';
              }?>
              <div class="row">
                <div class="col-sm-12 col-md-4">
                  <div class="form-group form-group-validIdNo">
                    <label for="validIdNo">Capital Contribution</label>
                    <input type="text" class="form-control validate[required,min[1],max[<?=$max?>]]" id="cc" name="cc">
                  </div>
                </div>
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

<!-- PRIMARY -->

<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="addAffiliatorModalcoop" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
        <div class="modal-content">
          <?php echo form_open('amendment_union_update/add_affiliates',array('id'=>'deleteCooperatorForm','name'=>'deleteCooperatorForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteModalLabel">Are you sure you want to add this?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" class="validate[required]" id="cooperativeID" name="cooperativesID">
              <input type="hidden" class="validate[required]" id="application_id" name="applicationid">
              <input type="hidden" class="validate[required]" id="coopname" name="coopName">
              <input type="hidden" class="validate[required]" id="regno" name="regNo">
              <input type="hidden" class="validate[required]" id="regid" name="registered_id">
              <input type="hidden" class="validate[required]" id="types" name="types">
              <div class="alert alert-info" role="alert">
                <p> Are you sure you want to add <strong class="cooperator-name-text">test</strong> Cooperative?</p>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group"> 
                    <label for="position">Position:</label>
                    <select class="custom-select validate[required]" id="position" name="position" >
                      <option value="" selected>--</option>
                      <option value="Chairperson">Chairperson</option>
                      <option value="Vice-Chairperson">Vice-Chairperson</option>
                      <option value="Board of Director">Board of Director</option>
                      <option value="Treasurer">Treasurer</option>
                      <option value="Secretary">Secretary</option>
                      <option value="Member">Member</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="paidShares">Name of Representative:</label>
                    <input type="text" id="fName" class="form-control validate[required]" name="fName">
                    <div id="paid-note" style="color: red; font-size:12px;"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="validIdType">Proof of Identity: </label>
                    <select class="custom-select validate[required]" id="validIdType" name="validIdType">
                      <option selected>--</option>
                      <option value="Digitized Postal ID">Digitized Postal ID</option>
                      <option value="Driver's License">Driver's License</option>
                      <option value="GSIS E-Card">GSIS E-Card</option>
                      <option value="IBP ID">IBP ID</option>
                      <option value="OWWA ID">OWWA ID</option>
                      <option value="Passport">Passport</option>
                      <option value="PRC ID">PRC ID</option>
                      <option value="Senior Citizen's ID">Senior Citizen's ID</option>
                      <option value="SSS ID">SSS ID</option>
                      <option value="TIN">TIN</option>
                      <option value="Voter's ID">Voter's ID</option>
                      <option value="Philhealth">Philhealth</option>
                      <option value="OFW">OFW</option>
                      <option value="Single Parent">Single Parent</option>
                      <option value="PWD">PWD</option>
                      <option value="pag-ibig">Pag-IBIG</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-4">
                  <div class="form-group form-group-validIdNo">
                    <label for="validIdNo">Valid ID No.</label>
                    <input type="text" class="form-control validate[required]" id="validIdNo" name="validIdNo">
                  </div>
                </div>
                <div class="col-sm-12 col-md-4">
                  <div class="form-group">
                    <label for="dateIssued"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>In Accordance with Notarial Law.</li>"></i> Date Issued:</label>
                    <input type="date" class="form-control validate[required,custom[date],past[now]]" id="dateIssued" name="dateIssued">
                   <!-- <input type="text" class="form-control validate[required]" id="dateIssued" name="dateIssued"> -->
                    <!-- <small style="margin-left: 20px;"><span><i>  yyyy-mm-dd </i></span></small> -->
                    <input type="checkbox" name="dateIssued_chk" id="chkID" value="N/A"> <small>ID Date Issued not available</small>
                  </div>
                </div>
                <div class="col-sm-12 col-md-4">
                  <div class="form-group">
                    <label for="placeIssuance">Place of Issuance: </label>
                    <textarea class="form-control validate[required]" id="placeIssuance" name="placeIssuance" rows="1"></textarea>
                  </div>
                </div>
              </div>
              <?php if($coop_info->capital_contribution != $cc_count->total_cc){
                $max = $coop_info->capital_contribution - $cc_count->total_cc;
              } else {
                $max = '';
              }?>
              <div class="row">
                <div class="col-sm-12 col-md-4">
                  <div class="form-group form-group-validIdNo">
                    <label for="validIdNo">Capital Contribution</label>
                    <input type="text" class="form-control validate[required,min[1],max[<?=$max?>]]" id="cc" name="cc">
                  </div>
                </div>
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
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
 $(document).ready(function(){
    $("#chkID").on('click',function(){

      if($(this).is(":checked"))
      {
          $( "#dateIssued" ).prop( "disabled", true );
      }
      else
      {
           $( "#dateIssued" ).prop( "disabled", false );
      }

    });
 });
  
</script>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
 $(document).ready(function(){
    $("#chkID").on('click',function(){

      if($(this).is(":checked"))
      {
          $( "#dateIssued" ).prop( "disabled", true );
      }
      else
      {
           $( "#dateIssued" ).prop( "disabled", false );
      }

    });
 });
  
</script>