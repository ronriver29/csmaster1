<!-- <div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-primary" role="alert">
      WELCOME!!!
    </div>
  </div>
</div> -->
<?php
    if($gc == 0){ 
        echo '<div class="alert alert-danger" role="alert">';
            echo '<h4 class="alert-heading">Unable to Create Laboratories.</h4>';
            echo '<hr>';
            echo 'Because of the following:';
                echo '<p><ul>';
                    echo '<li>Not applicable to Guardian Cooperative.</li>';
                    echo '<li>No Cooperatives created.</li>';
                echo '</ul>';
        echo '</div>';
                
        } else {
?>
<?php if(!$is_client && $admin_info->access_level == 3 &&  $admin_info->is_director_active == 0) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p><strong>Note: </strong><br>You can only view the documents of a cooperative but you can't evaluate them.<br> To be able to evaluate a cooperative, you must revoke all the privileges of the Supervising CDS.</p>
      </div>
    </div>
  </div>
<?php endif;?>
<?php if($this->session->flashdata('redirect_applications_message')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
       <?php echo $this->session->flashdata('redirect_applications_message'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>


<?php if($this->session->flashdata('Email_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('Email_success'); ?>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('success_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('success_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('error_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('error_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>


<?php if($this->session->flashdata('list_success_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('list_success_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('list_error_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('list_error_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<div class="row">
  <?php if($is_client) :?>
  <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
    <a class="btn btn-color-blue btn-block" href="<?php echo base_url();?>laboratories/registration" role="button">New Laboratory Registration</a>
  </div>
  <?php endif; ?>
  <?php if(!$is_client && $admin_info->access_level == 3) : ?>
    <?php if($admin_info->is_director_active == 1) : ?>
    <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
      <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#grantSupervisorModal"><i class='fas fa-user-plus'></i> Grant All Privileges to Supervisor</button>
    </div>
    <?php else : ?>
      <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
        <button type="button" class="btn btn-warning text-white btn-block" data-toggle="modal" data-target="#revokeSupervisorModal"><i class='fas fa-user-times'></i> Revoke all Authority of Supervising CDS</button>
      </div>
    <?php endif; ?>
  <?php endif;?>
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperativesTable">
            <thead>
              <tr>
                <th>Name of Laboratory</th>
                <th>Name of Cooperative</th>
                <th>Location</th>
                <th>Status</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($list_laboratories as $laboratory) : ?>
                <!-- <tr> modify by jayson -->

       
                  
                  <td><?=$laboratory['laboratoryName'].' Laboratory Cooperative'?></td>
                  <td><?=$laboratory['coopName']?></td> 
                  <td>
                    <?php if($laboratory['house_blk_no']==null && $laboratory['streetName']==null) $x=''; else $x=', ';?>
                    <?=$laboratory['house_blk_no']?> <?=$laboratory['streetName'].$x?> <?=$laboratory['brgy']?>, <?=$laboratory['city']?>, <?= $laboratory['province']?> <?=$laboratory['region']?>
                  </td>
                  <td>
                      <span class="badge badge-secondary">
                      <?php if($is_client) : ?>
                        <?php if($laboratory['status']==0) echo "EXPIRED"; ?>
                        <?php if($laboratory['status']==1) echo "PENDING"; ?>
                        <?php if($laboratory['status']>=2 && $laboratory['status']<=15) echo "FOR VALIDATION"; ?>
                        <!-- <?php if($laboratory['status']==16) echo "DENIED"; ?> -->
                       
                        <?php if($laboratory['status']==25) echo "DENIED"; ?>
                        <?php if($laboratory['status']==24) echo "DEFFERED"; ?>
                        <?php if($laboratory['status']==18) echo "OK FOR PAYMENT"; ?>
                        <?php if($laboratory['status']==19) echo "PAY AT CDA"; ?>
                        <?php if($laboratory['status']==20) echo "GET YOUR CERTIFICATE"; ?>
                        <?php if($laboratory['status']==21) echo "REGISTERED"; ?>
                      <?php else : ?>
                        <!-- admin view -->
                        <?php if($laboratory['status']==2) echo "FOR VALIDATION"; ?>
                         <?php // if($laboratory['status']==12) echo "SUBMITTED BY SENIOR";
                          if($laboratory['status']==12 && $is_acting_director && $admin_info->access_level==3) echo "SUBMITTED BY SENIOR";
                          else if($laboratory['status']==12) echo "DELEGATED BY DIRECTOR"; ?>

                          <?php if($laboratory['status']==24) echo "DEFERRED"; ?>
                        <!-- <?php if($laboratory['status']==3 || $laboratory['status']==6 || $laboratory['status']==10 || $laboratory['status']==13 || $laboratory['status']==16) echo "DENIED"; ?> -->
                       <!--  <?php if($laboratory['status']==4 || $laboratory['status']==7 || $laboratory['status']==11 || $laboratory['status']==14 || $laboratory['status']==17) echo "DEFERRED"; ?> -->
                        <?php if($laboratory['status']==18) echo "FOR PAYMENT"; ?>
                        <?php if($laboratory['status']==19 || $laboratory['status']==20) echo "WAITING FOR O.R."; ?>
                        <?php if($laboratory['status']==21) echo "REGISTERED"; ?>
                      <?php endif ?>

                      </span>
                    </td>
                  <?php if($is_client) :?>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View</a>
                      <?php if($laboratory['status']<2||$laboratory['status']==16||$laboratory['status']==17) : ?>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteLabModal" data-cname="<?= "Laboratory Cooperative of ".$laboratory['laboratoryName']?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($laboratory['id']))?>"><i class='fas fa-trash'></i><?php echo ($laboratory['status']==16 || $laboratory['status']==17) ? "Delete": "Cancel" ?></button>
                      <?php endif;?>
                      
                      
                      </div>
                    </td>
                  <?php endif;?>
              

                  <?php if(!$is_client) :?>
                    <td>
                      <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                      <?php if(($supervising_) || ($admin_accesslevel==3 && $is_acting_director) || ($admin_accesslevel==5)){?>
                        <?php if($laboratory['status']>=2 && $laboratory['status']<=17  && $laboratory['status']!=8) : ?>
                          <a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>/laboratories_documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                            <!--<a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($laboratory['id']))?>" data-cname="<?= $laboratory['labName']?> Cooperative " class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign Validator</a>-->

                        <?php elseif($laboratory['status']==8 && $laboratory['third_evaluated_by']==0): ?>
                          <a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>/assign" data-toggle="modal" data-target="#assignBranchSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($laboratory['id']))?>" data-cname="<?= $laboratory['labName']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign to Evaluator</a>
                        
                        <?php elseif($laboratory['status']==18): ?>
                          <a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>/laboratories_forpayment" class="btn btn-color-blue"> OK For Payment</a>

                        
                       <?php elseif($laboratory['status']==20): ?>
                          <input class="btn btn-color-blue offset-md-10" type="button" id="addOff" onclick="showPayment('<?= encrypt_custom($this->encryption->encrypt($laboratory['laboratoryName']))?>','<?= encrypt_custom($this->encryption->encrypt($laboratory['labName']))?>')" value="Save O.R. No.">
                           <?php elseif($laboratory['status']==21): ?>
                          <a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>/laboratories_registration" class="btn btn-info"><i class='fas fa-print'></i> Print Registration</a>
                        <?php endif; ?>
                      
                      </div>
                    </td>
                   <?php } //end of access leve admin 3 and 5 ?> 

                     <?php if($admin_accesslevel==2 || ($admin_accesslevel==5)){?>
                      <?php $accepted = array(2,3,4,5,6,7,9,10,11); ?>
                      <?php /*if($laboratory['status']>=2 && $laboratory['status']<=11  && $laboratory['status']!=8 || $laboratory['status']==24) : */?>
                        <?php if(in_array($laboratory['status'],$accepted)) : ?>
                          <a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>/laboratories_documents" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                            <!--<a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>/assign" data-toggle="modal" data-target="#assignSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($laboratory['id']))?>" data-cname="<?= $laboratory['labName']?> Cooperative " class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign Validator</a>-->

                        <?php elseif($laboratory['status']==8 && $laboratory['third_evaluated_by']==0): ?>
                          <a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>/assign" data-toggle="modal" data-target="#assignBranchSpecialistModal" data-coopid="<?= encrypt_custom($this->encryption->encrypt($laboratory['id']))?>" data-cname="<?= $laboratory['labName']?>" class="btn btn-color-blue"><i class='fas fa-user-check'></i> Assign to Evaluator</a>
                        
                        <?php elseif($laboratory['status']==18): ?>
                          <a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>/laboratories_forpayment" class="btn btn-color-blue"> OK For Payment</a>

                           <a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>/laboratories_documents/document_view_review" class="btn btn-info"><i class='fas fa-eye'></i> View Document</a>
                        
                       <?php elseif($laboratory['status']==20): ?>
                          <input class="btn btn-color-blue offset-md-10" type="button" id="addOff" onclick="showPayment('<?= encrypt_custom($this->encryption->encrypt($laboratory['laboratoryName']))?>','<?= encrypt_custom($this->encryption->encrypt($laboratory['labName']))?>')" value="Save O.R. No.">
                           <?php elseif($laboratory['status']==21): ?>
                          <a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>/laboratories_registration" class="btn btn-info"><i class='fas fa-print'></i> Print Registration</a>
                        <?php endif; ?>
                      
                      </div>
                    </td>
                   <?php } //end of access leve admin 2 and 5 ?> 

                  <?php endif;?>
                 
                </tr>
              <?php endforeach; ?>


            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<?php if($is_client) :?>
<?php else : ?>
  <h3 style="margin-left:30px;">Registered</h3>
<div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperativesTable2">
            <thead>
              <tr>
                <th>Name of Laboratory</th>
                <th>Name of Cooperative</th>
                <th>Location</th>
                <th>Status</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
       
              <?php foreach ($registered_laboratories as $laboratory1) : ?>
                <td><?='Laboratory Cooperative of '.$laboratory1['laboratoryName']?></td>
                <td><?=$laboratory1['coopName']?></td> 
                <td>
                  <?php if($laboratory1['house_blk_no']==null && $laboratory1['streetName']==null) $x=''; else $x=', ';?>
                  <?=$laboratory1['house_blk_no']?> <?=$laboratory1['streetName'].$x?> <?=$laboratory1['brgy']?>, <?=$laboratory1['city']?>, <?= $laboratory1['province']?> <?=$laboratory1['region']?>
                </td>
                <td><span class="badge badge-secondary">REGISTERED</span></td>
                <td>
                    <?php if($laboratory1['status']==21): ?>
                        <a href="<?php echo base_url();?>laboratories/<?= encrypt_custom($this->encryption->encrypt($laboratory1['id'])) ?>/laboratories_registration" class="btn btn-info"><i class='fas fa-print'></i> Print Registration</a>
                    <?php endif; ?>
                </td>
          </tbody>
          <?php endforeach;?>
          </table>
        </div>
      </div>
    </div>
</div>
<?php endif; ?>
</div>


<!-- Bootstrap modal -->
 <div class="modal fade" id="paymentModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="#" role="form" id="paymentForm" name="paymentForm">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div> 
        <div class="modal-body form">
          <input type="hidden" value="" name="payment_id" id="payment_id"/> 
          <input type="hidden" value="" name="bid" id="branch_ID"/> 
          <div class="row">
            <div class="col-md-12">
              

              <table width="100%" class="bord">
                <tr>
                  <td class="bord">Date</td>
                  <td class="bord">
                   <span><strong><?= date('Y-m-d')?></strong></span>
                   <input type="hidden" id="laboratoryID" name="laboratoryID" value="<?= encrypt_custom($this->encryption->encrypt($laboratory['id'])) ?>" />
          
                  </td>
                </tr>
                <tr>
                  <td class="bord">O.R. No</td>
                  <td class="bord"><input type="text" id="orNo" name="orNo" class="form-control" placeholder="Type here..."></td>
                </tr>

                <tr>
                  <td class="bord">Date OR</td>
                  <td class="bord">
                    <input type="date" data-date-format="YYYY-MM-DD" class="form-control date-picker " name="date_or" />
                  </td>
                </tr>

                <tr>
                  <td class="bord">Transaction No.</td>
                  <td class="bord" colspan="3"><b id="tNo"></b></td>
                </tr>
                <tr>
                  <td class="bord">Payor</td>
                  <td class="bord" colspan="3"><b id="payor"></b></td>
                </tr>
                <tr>
                  <td class="bord">Nature of Payment</td>
                  <td class="bord" colspan="3"><b id="nature"></b></td>
                </tr>
                <tr>
                  <td class="bord">Amount in Words</td>
                  <td class="bord" colspan="3" style="text-transform:capitalize"><b id="word"> </b></td>
                </tr>
                <tr>
                  <td class="bord" colspan="4" align="center">Particulars</td>
                </tr>
                <tr>
                  <td width="23%"></td>
                  <td class="pera" width="" id="particulars" style="font-weight: bold;text-align: center"></td>
                   <td class="pera" width="8%" valign="top">Php </td>
                  <td  class="pera" align="right" width="13%" id="amount" style="font-weight: bold;"></td> 
                </tr>
                <tr>
                  <td colspan="4"></td>
                </tr>
                <tr>
                  <td class="bord" colspan="2">Total </td>
                  <td class="taas"  width="8%">Php </td>
                  <td class="taas" align="right" width="13%"><b id="total"></b></td>
                </tr>       
              </table>
              <table id="test"></table>

            </div>
          </div>
        </div><!-- /.modal-content -->    
        <div class="modal-footer">
            <button type="button" id="saveOR" onclick= "save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?=base_url();?>assets/js/toword.js"></script>

<script type="text/javascript">
  


  function showPayment(labname,coop_name) {
    //save_method = 'add';
    $('#paymentForm')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty();

    $.ajax({
        // url : "<?php echo base_url('laboratories/payment')?>/" + coop_name,
        // type: "GET",
        // dataType: "JSON",
        url : "<?php echo base_url('laboratories/payment')?>",
        method: "POST",
        dataType: "JSON",
        data:{lab_name:labname,coop_name:coop_name},
        success: function(data)
        {
          
            var s=convert(data.total);
            $('#payment_id').val(data.id);
            $('#tDate').text(data.date);
            $('#payor').text(data.payor);
            $('#tNo').text(data.transactionNo);
            // $('#branch_ID').val(coop_id);   
            $('#word').text(s+' Pesos');
            // $('#nature').text(data.nature);
            $('#nature').text("Laboratory Registration");
            $('#particulars').html(data.particulars);
            $('#amount').html(data.amount);
            $('#total').text(parseFloat(data.total).toFixed(2));
          
            
            $('#paymentModal').modal('show'); // show bootstrap modal
            $('.modal-title').text('Order of Payment');

 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax!');
        }
    });
  }

  function save(){

    var x = $('#orNo').val();
    
    if (x==''){
      alert('Missing O.R. No.');
    }
    else{
      var paymentFormData = new FormData($('#paymentForm')[0]);
      $.ajax({
          url : "<?php echo base_url('laboratories/saveor')?>/" + 'fuck',
          type: "POST",
          data: paymentFormData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
              if(data.status) //if success close modal and reload ajax table
              {
                  $('#paymentModal').modal('hide');
                  $('#paymentForm')[0].reset();
                  window.location.href="<?php echo base_url('laboratories')?>";
              }
              else
              {
                  for (var i = 0; i < data.inputerror.length; i++) 
                  {
                      $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                      $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                  }
              }
   
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding / update data!');
             // $('#saveOR').text('save'); //change button text
              //$('#saveOR').attr('disabled',false); //set button enable 
   
          }
      });
    }
  }
</script>
    <?php } ?>