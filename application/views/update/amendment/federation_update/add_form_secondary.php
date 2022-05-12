<style>
.select2-search__field{
  width: 100% !important;
}
</style>
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.css')?>" type="text/css"/>
<link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css')?>" type="text/css"/>  
<?php $total_subscribed = 0;?>
<?php $total_paid = 0;?>
<!-- <?php foreach ($list_cooperators as $cooperator) : ""?>
    <?php 
        $total_subscribed += $cooperator['number_of_subscribed_shares'];
        $total_paid += $cooperator['number_of_paid_up_shares'];
    ?>
<?php endforeach; ?> -->



<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="modal fade" id="addAffiliatorModal" data-backdrop="static" data-hidden.bs.modal="this.form.reset();"tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" style="width:90% !important;max-width:1360px;">
        <div class="modal-content">
          <?php echo form_open('amendment_affiliators_update/add_amendment_affiliators',array('id'=>'deleteCooperatorForm','name'=>'deleteCooperatorForm')); ?>
            <div class="modal-header">
              <h4 class="modal-title" id="deleteModalLabel">Are you sure you want to add this?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" class="form-control" id="userid" name="userid" value="<?=$this->encryption->decrypt(decrypt_custom($user_id)) ?>">
              <input type="hidden" class="form-control" id="amendment" name="amendment_id" value="<?=$encrypted_id ?>">
              
              <input type='hidden' id='available_subscribed_capital' value="<?=isset($capitalization_info->total_no_of_subscribed_capital) ? $capitalization_info->total_no_of_subscribed_capital - $total_subscribed: ''?>" />
              <input type='hidden' id='available_paid_up_capital' value="<?=isset($capitalization_info->total_no_of_paid_up_capital) ? $capitalization_info->total_no_of_paid_up_capital - $total_paid: ''?>" />
              <input type='hidden' id='minimum_subscribed_share_regular' value="<?=isset($capitalization_info->minimum_subscribed_share_regular) ? $capitalization_info->minimum_subscribed_share_regular: ''?>" />
              <input type='hidden' id='minimum_paid_up_share_regular' value="<?=isset($capitalization_info->minimum_paid_up_share_regular) ? $capitalization_info->minimum_paid_up_share_regular: ''?>" />
              <input type='hidden' id='minimum_subscribed_share_associate' value="<?=isset($capitalization_info->minimum_subscribed_share_associate) ? $capitalization_info->minimum_subscribed_share_associate: ''?>" />
              <input type='hidden' id='minimum_paid_up_share_associate' value="<?=isset($capitalization_info->minimum_paid_up_share_associate) ? $capitalization_info->minimum_paid_up_share_associate: ''?>" />
              <input type="hidden" class="validate[required]" id="cooperativeID" name="cooperativesID">
              <input type="hidden" class="validate[required]" id="application_id" name="applicationid">
              <input type="hidden" class="validate[required]" id="coopname" name="coopName">
              <input type="hidden" class="validate[required]" id="regno" name="regNo">
              <input type="hidden" class="validate[required]" id="regid" name="registered_id">
              <div class="alert alert-info" role="alert">
                <p> Are you sure you want to add <strong class="cooperator-name-text">test</strong> Cooperative?</p>
              </div> 
              <div class="alert alert-info" role="alert">
                <strong>Reminder: <small>(The information below is in your bylaws (capitalization))</small></strong>
                 <ul>
                   <li>Regu lar Member must subscribed at least <strong><?= $capitalization_info->minimum_subscribed_share_regular?></strong> shares and pay at least <strong><?= $capitalization_info->minimum_paid_up_share_regular?></strong> shares.</li>
                   <?php if($bylaw_info->kinds_of_members ==2) : ?>
                    <li>Associate Member must subscribed at least  <strong><?= $capitalization_info->minimum_subscribed_share_associate?></strong> shares and pay at least <strong><?= $capitalization_info->minimum_paid_up_share_associate?></strong> shares.</li>
                  <?php endif; ?>
                 </ul>
                </div>
            


              <div class="row">
                <div class="col-sm-12 col-md-4">
                  <div class="form-group"> 
                    <label for="position">Position:</label><br>
                    <select class="form-control validate[required] select2 select-island add-affiliators" id="position" name="position[]" multiple="" required>
                    <!-- <select class="form-control validate[required] select2" id="position" name="position[]" multiple="" required> -->
                      <!-- <option value="" selected>--</option> -->
                      <option value="Chairperson">Chairperson</option>
                      <option value="Vice-Chairperson">Vice-Chairperson</option>
                      <option value="Board of Director">Board of Director</option>
                      <option value="Treasurer">Treasurer</option>
                      <option value="Secretary">Secretary</option>
                      <option value="Member">Member</option>
                    </select>
                  </div>
                  <label id="positionexists" style="color:red;font-size: 10px;"><i>* This position is already occupied.</i></label>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="subscribedShares">No of subscribed shares:</label>
                    <input type="number"  class="form-control " id="subscribedShares" name="subscribedShares" required>
                    <div id="subscribed-note" style="color: red; font-size: 12px;"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="paidShares">No of paid-up Shares:</label>
                    <input type="number"  class="form-control" id="paidShares" name="paidShares" required> 
                    <div id="paid-note" style="color: red; font-size:12px;"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="paidShares">Name of Representative:</label>
                    <input type="text" id="representative" class="form-control validate[required]" name="representative" required>
                    <div id="paid-note" style="color: red; font-size:12px;"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="validIdType">Proof of Identity: </label>
                    <select class="custom-select validate[required]" id="validIdType" name="validIdType" required>
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
                    <input type="text" class="form-control validate[required]" id="validIdNo" name="validIdNo" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-3">
                  <div class="form-group">
                    <label for="dateIssued"><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top" data-html="true" title="<li>In Accordance with Notarial Law.</li>"></i> Date Issued:</label>
                    <input type="date" class="form-control validate[required,custom[date],past[now]]" id="dateIssued" name="dateIssued">
                   <!-- <input type="text" class="form-control validate[required]" id="dateIssued" name="dateIssued"> -->
                    <!-- <small style="margin-left: 20px;"><span><i>  yyyy-mm-dd </i></span></small> -->
                    <input type="checkbox" name="dateIssued_chk" id="chkID" value="N/A"> <small>ID Date Issued not available</small>
                  </div>
                </div>
                <div class="col-sm-12 col-md-9">
                  <div class="form-group">
                    <label for="placeIssuance">Place of Issuance: </label>
                    <textarea class="form-control validate[required]" style="resize: none;" id="placeIssuance" name="placeIssuance" rows="1" required></textarea>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer deleteCooperatorFooter">
              <input class="btn btn-color-blue btn-block" type="submit" id="aAddAffiliatorsBtn" name="deleteCooperatorBtn" value="Add">
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
// var position = $("#position").val();

// $("#position").change(function(){
//   alert(position);
//   $.ajax({
//         url : "<?php echo base_url('affiliators/check_position_not_exist')?>/" + coop_name,
//         type: "GET",
//         dataType: "JSON",
//         success: function(data)
//         {
//             var currentdate = new Date(data.date);
//             var month = currentdate.getMonth() + 1;
//             var day = currentdate.getDate();
//             var formated_date = ( (('' + day).length < 2 ? '0' : '')  + day + '-' + (('' + month).length < 2 ? '0' : '') + month + '-' +currentdate.getFullYear());

//             var s = convert(data.total);
//             $('#payment_id').val(data.id);
//             $('#tDate').text(formated_date);
//             $('#payor').text(data.payor);
//             // $('#tNo').text(data.transactionNo);
//             $('#tNo').text(data.refNo);
//             $('#cid').val(coop_id);   
//             $('#word').text(s);
//             $('#nature').text(data.nature);
//             $('#particulars').html(data.particulars);
//             $('#amount').html(data.amount);
//             $('#total').text(parseFloat(data.total).toFixed(2));

            
//             $('#paymentModal').modal('show'); // show bootstrap modal
//             $('.modal-title').text('Order of Payment');

 
//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//             alert('Error get data from ajax!');
//         }
//     });
// }

 // $(".select-island").each(function(){
 //      $(this).select2({
 //          template: "bootstrap",
 //          multiple: true,
 //          tagging: true,
 //          allowClear: true,
 //          placeholder: "Select island"
 //      });
 //  });
  
</script>
<script src="<?=base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>