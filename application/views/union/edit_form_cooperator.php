<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="editAffiliatorModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
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
                  <input type="text" class="form-control validate[required]" id="repre" name="repre">
                  <!-- <input type="text" id="repre" name="repre" class="form-control validate[required]"> -->
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
                    <textarea class="form-control validate[required]" id="place_of_issuance" name="place_of_issuance" rows="1"></textarea>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                  <div class="form-group form-group-validIdNo">
                    <label for="validIdNo">Capital Contribution</label>
                    <input type="text" class="form-control validate[required]" id="cc" name="cc">
                  </div>
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
