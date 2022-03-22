<style>
.select2-search__field{
  width: 100% !important;
}
</style>
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.css')?>" type="text/css"/>
<link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css')?>" type="text/css"/>  
<?php $total_subscribed = 0;?>
<?php $total_paid = 0;?>
<?php foreach ($list_cooperators as $cooperator) : ""?>
    <?php 
        $total_subscribed += $cooperator['number_of_subscribed_shares'];
        $total_paid += $cooperator['number_of_paid_up_shares'];
    ?>
<?php endforeach; ?>



<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="editAffiliatorModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
        <div class="modal-content">
          <?php echo form_open('affiliators_update/edit_affiliators',array('id'=>'editAffiliatorForm','name'=>'editAffiliatorForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="editModalLabel">Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" class="form-control" id="cooperativesID" name="cooperativesID" value="<?=$encrypted_id ?>">
              <?php
              // if(isset($capitalization_info->total_no_of_subscribed_capital)){
              //   if(($capitalization_info->total_no_of_subscribed_capital - $total_subscribed)>=0) {
              //     $available_subscribed_capital = $capitalization_info->total_no_of_subscribed_capital - $total_subscribed;
              //   } else {
              //     $available_subscribed_capital = ($capitalization_info->total_no_of_subscribed_capital - $total_subscribed) + $capitalization_info->minimum_subscribed_share_regular;
              //   }
              // } else {
              //   $available_subscribed_capital = $affiliator_info->number_of_subscribed_shares;
              // }
              // if($capitalization_info->total_no_of_subscribed_capital - $total_subscribed != 0){
                $available_subscribed_capital = isset($capitalization_info->total_no_of_subscribed_capital) ? (($capitalization_info->total_no_of_subscribed_capital - $total_subscribed)>=0 ? ($capitalization_info->total_no_of_subscribed_capital - $total_subscribed) + $capitalization_info->minimum_subscribed_share_regular : '') : '';
              // } else {
              //   $available_subscribed_capital = '';
              // }
                $available_paid_up_capital = isset($capitalization_info->total_no_of_paid_up_capital) ? (($capitalization_info->total_no_of_paid_up_capital - $total_paid)>=0 ? ($capitalization_info->total_no_of_paid_up_capital - $total_paid) + $capitalization_info->minimum_paid_up_share_regular : '') : '';
              
              
              ?>
              <input type='hidden' id='maxvalue'/>
              <?php if(isset($capitalization_info->total_no_of_subscribed_capital)){
                echo "<input type='hidden' id='maxvalue_asc' value='".($capitalization_info->total_no_of_subscribed_capital - $total_subscribed)."'/>";
              }?>
              
              <input type='hidden' id='maxvalue2'/>

              <?php if(isset($capitalization_info->total_no_of_subscribed_capital)){
                echo "<input type='hidden' id='maxvalue_apuc' value='".($capitalization_info->total_no_of_paid_up_capital - $total_paid)."'/>";
              }?>
              

              <input type='hidden' id='available_subscribed_capital2' value="<?=$available_subscribed_capital?>" />
              <input type='hidden' id='available_paid_up_capital2' value="<?=$available_paid_up_capital?>" />
              <input type='hidden' id='minimum_subscribed_share_regular2' value="<?=isset($capitalization_info->minimum_subscribed_share_regular) ? isset($capitalization_info->minimum_subscribed_share_regular): ''?>" />
              <input type='hidden' id='minimum_paid_up_share_regular2' value="<?=isset($capitalization_info->minimum_paid_up_share_regular) ? isset($capitalization_info->minimum_paid_up_share_regular): ''?>" />

              <input type="hidden" id="cooperatorID" name="cooperatorID">
              <div class="alert alert-info" role="alert">
                <strong>Reminder: <small>(The information below is in your bylaws (capitalization))</small></strong>
                 <ul>
                   <li>Regular Member must subscribed at least <strong><?php if(isset($capitalization_info->minimum_subscribed_share_regular)){ echo $capitalization_info->minimum_subscribed_share_regular;}?></strong> shares and pay at least <strong><?php if(isset($capitalization_info->minimum_paid_up_share_regular)) { echo $capitalization_info->minimum_paid_up_share_regular;}?></strong> shares.</li>
                   <?php if(isset($bylaw_info->kinds_of_members) ==2) : ?>
                    <li>Associate Member must subscribed at least  <strong><?php if(isset($capitalization_info->minimum_subscribed_share_associate)){ echo $capitalization_info->minimum_subscribed_share_associate;}?></strong> shares and pay at least <strong><?php if(isset($capitalization_info->minimum_paid_up_share_associate)){ echo $capitalization_info->minimum_paid_up_share_associate;}?></strong> shares.</li>
                  <?php endif; ?>
                 </ul>
                </div>
              <!-- <input type="hidden" class="validate[required]" id="cooperativeID" name="cooperativesID"> -->
              
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
              <div class="col-sm-12 col-md-4">
                  <div class="form-group"> 
                    <label for="position">Position:</label><br>
                    <select class="form-control validate[required] select2 select-island edit-affiliators" id="position2" name="position[]" multiple="">
                    <!-- <select class="form-control validate[required,ajax[ajaxAffiliatorsPositionCallPhp] select2" id="position2" name="position[]" multiple="" required> -->
                      <!-- <option value="" selected>--</option> -->
                      <option id="Chairperson" value="Chairperson">Chairperson</option>
                      <option value="Vice-Chairperson">Vice-Chairperson</option>
                      <option value="Board of Director">Board of Director</option>
                      <option value="Treasurer">Treasurer</option>
                      <option value="Secretary">Secretary</option>
                      <option value="Member">Member</option>
                    </select>
                  </div>
                  <!-- <label id="editpositionexists" style="color:red;font-size: 10px;"><i>* This position is already occupied.</i></label> -->
                </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="subscribedShares2">No of subscribed shares:</label>
                  <input type="number" class="form-control" id="subscribedShares2" name="subscribedShares2">
                  <!-- <div style="color: red; font-size: 12px;" id="clicktoverify"><i>* Click the field to verify</i></div> -->
                  <div id="subscribed-note2" style="color: red; font-size: 12px;"></div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="paidShares2">No of paid-up Shares:</label>
                  <input type="number" class="form-control" id="paidShares2" name="paidShares2">
                  <!-- <div style="color: red; font-size: 12px;" id="clicktoverify2"><i>* Click the field to verify</i></div> -->
                  <div id="paid-note2" style="color: red; font-size:12px;"></div>
                </div>
              </div>
              
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="paidShares">Name of Representative:</label>
                  <input type="text" class="form-control" id="repre" name="repre">
                  <!-- <input type="text" id="repre" name="repre" class="form-control validate[required]"> -->
                </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                    <label for="validIdType">Proof of Identity: </label>
                    <select class="custom-select" id="validIdType" name="validIdType">
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
                <div class="col-sm-12 col-md-4">
                  <div class="form-group form-group-validIdNo">
                    <label for="validIdNo">Valid ID No.</label>
                    <input type="text" class="form-control" id="validIdNo" name="validIdNo">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="dateIssued"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>In Accordance with Notarial Law.</li>"></i> Date Issued:</label>
                    <input type="date" class="form-control" id="dateIssued" name="dateIssued">
                   <!-- <input type="text" class="form-control validate[required]" id="dateIssued" name="dateIssued"> -->
                    <!-- <small style="margin-left: 20px;"><span><i>  yyyy-mm-dd </i></span></small> -->
                    <input type="checkbox" name="dateIssued_chk" id="chkID" value="N/A"> <small>ID Date Issued not available</small>
                  </div>
                </div>
                <div class="col-sm-12 col-md-9">
                  <div class="form-group">
                    <label for="placeIssuance">Place of Issuance: </label>
                    <textarea class="form-control" style="resize: none;" id="place_of_issuance" name="place_of_issuance" rows="1"></textarea>
                  </div>
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
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
 $(document).ready(function(){

    var str3 = $("#maxvalue_apuc").val();

    if(str3 >= $("#subscribedShares2").val()){
      $("#paidShares2").one('click',function(){
          var str4 = $("#paidShares2").val();
          var str4 = parseInt(str4) + parseInt(str3);
          // $('#maxvalue2').val(str4);

          $("#paidShares2").attr({
             "max" : str4,        // substitute your own
             "min" : 1          // values (or variables) here
          });
      });
    }

    if(str3 == 0){
        $("#paidShares2").one('click',function(){
          $("#clicktoverify2").hide();
            var str4 = $("#paidShares2").val();
            $('#maxvalue2').val(str4);

            $("#paidShares2").attr({
               "max" : str4,        // substitute your own
               "min" : 1          // values (or variables) here
            });
        });
      } else {
        $("#paidShares2").on('click',function(){
          $("#clicktoverify2").hide();
        });
      }

    $(".close").on('click',function(){
      $("#clicktoverify2").show();
      if(str3 == 0){
        $("#paidShares2").one('click',function(){
            var str4 = $("#paidShares2").val();
            $('#maxvalue2').val(str4);

            $("#paidShares2").attr({
               "max" : str4,        // substitute your own
               "min" : 1          // values (or variables) here
            });
        });
      }
    });

    var str2 = $("#maxvalue_asc").val();

    if(str2 == 0){
        $("#subscribedShares2").one('click',function(){
          $("#clicktoverify").hide();
            var str = $("#subscribedShares2").val();
            $('#maxvalue').val(str);

            $("#subscribedShares2").attr({
               "max" : str,        // substitute your own
               "min" : 1          // values (or variables) here
            });

        });
        
      } else {
        $("#subscribedShares2").on('click',function(){
          $("#clicktoverify").hide();
        });
      }

    if(str3 == 0 && str2){
      var str = $("#subscribedShares2").val();
      $('#maxvalue').val(str);

      $("#subscribedShares2").attr({
         "max" : str,        // substitute your own
         "min" : 1          // values (or variables) here
      });

      var str4 = $("#paidShares2").val();
            $('#maxvalue2').val(str4);

            $("#paidShares2").attr({
               "max" : str4,        // substitute your own
               "min" : 1          // values (or variables) here
            });
    }

    $(".close").on('click',function(){
      $("#clicktoverify").show();
      if(str2 == 0){
        $("#subscribedShares2").one('click',function(){
            var str = $("#subscribedShares2").val();
            $('#maxvalue').val(str);

            $("#subscribedShares2").attr({
               "max" : str,        // substitute your own
               "min" : 1          // values (or variables) here
            });
        });
      }
    });

    $("#chkID").on('click',function(){

      if($(this).is(":checked"))
      {
          $( "#dateIssued" ).prop( "disabled", true );
          $("#dateIssued").prop('required',false);
            $("#dateIssued").val('');
      }
      else
      {
           $( "#dateIssued" ).prop( "disabled", false );
            $("#dateIssued").prop('required',true);
      }

    });
 });
</script>
<script src="<?=base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>