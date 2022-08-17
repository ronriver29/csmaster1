<style type="text/css">
  #ul-admin {
  list-style-type: none;
  margin: 0;
  padding: 0;
 
  }
  #ul-admin li a{
    text-decoration:none;
    float:right;
   width: auto;
   margin-left: 5px;
  }
</style>
<?php if(!$is_client && $admin_info->access_level == 3 &&  $admin_info->is_director_active == 0) : ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info" role="alert">
        <p><strong>Note: </strong><br>You can only view the documents of a cooperative but you can't evaluate them.<br> To be able to evaluate a cooperative, you must revoke all the authority of the Supervising CDS.</p>
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
    <div class="alert alert-danger text-center" role="alert">
      <?php echo $this->session->flashdata('list_error_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('delete_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('delete_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<div class="row">
  <?php if($is_client) :?>
   <?php if($count_cooperatives->coop_count == 0){?>
  <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
    <a class="btn btn-color-blue btn-block" href="<?php echo base_url();?>cooperatives/reservation" role="button">New Registration</a>
  </div>
  <?php } ?>
  <?php endif; ?>
  <?php if(!$is_client && $admin_info->access_level == 3) : ?>
    <?php if($admin_info->is_director_active == 1) : ?>
    <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
      <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#grantSupervisorModal"><i class='fas fa-user-plus'></i> Grant all Authority to Supervising CDS</button>
    </div>
    <?php else : ?>
      <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
        <button type="button" class="btn btn-warning text-white btn-block" data-toggle="modal" data-target="#revokeSupervisorModal"><i class='fas fa-user-times'></i> Revoke all Authority of Supervising CDS</button>
      </div>
    <?php endif; ?>
  <?php endif;?>
  <div class="col-sm-12 col-md-12">
<?php if(!$is_client && $admin_info->region_code != '00') :?>
</div>

<div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <?php echo form_open('registered_cooperatives',array('id'=>'cooperativesAddForm','name'=>'cooperativesAddForm')); ?> 
           <div class="row rd-row">
          
            <div class="col-sm-12 col-md-4">
              <div class="form-group">
                <label for="areaOfOperation">Cooperative Name: </label>
                <input type="text" name="coopName" class="form-control"/>
              </div>
            </div>
          </div> 
           <div class="row col-sm-6 col-md-1 align-self-center col-reserve-btn">
                <input class="btn btn-color-blue" type="submit" name="submit" value="submit" style="float:left;">
            </div>
        <?php echo form_close(); ?>
        <hr>
        <div class="table-responsive">
          <table class="table table-bordered">  <!-- id="cooperativesTable2" -->
            <thead>
              <tr>
                <th>Name of Cooperative</th>
                <?php if(!$is_client) : ?>
                  <th>Office Address</th>
                <?php endif;?>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_cooperatives_registered as $cooperative_registered) : ?>
                <tr>
                  <td><?php if($cooperative_registered['grouping'] == 'Federation'){?>
                    <?= $cooperative_registered['proposed_name']?> Federation of <?= $cooperative_registered['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative_registered['acronym_name'])){ echo '('.$cooperative_registered['acronym_name'].')';
                    }?>
                    <?php } else if($cooperative_registered['grouping'] == 'Union' && $cooperative_registered['type_of_cooperative'] == 'Union') { ?>
                      <?= $cooperative_registered['proposed_name']?> <?= $cooperative_registered['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative_registered['acronym_name'])){ echo '('.$cooperative_registered['acronym_name'].')';}?>
                    <?php } else { ?>
                      
                      <?= $cooperative_registered['proposed_name']?> <?= $cooperative_registered['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative_registered['acronym_name'])){ echo '('.$cooperative_registered['acronym_name'].')';}?> <?= $cooperative_registered['grouping']?>
                  <?php }?></td>
                  <td>
                    <?php if($cooperative_registered['house_blk_no']==null && $cooperative_registered['street']==null) $x=''; else $x=', ';?>
                    <?=$cooperative_registered['house_blk_no']?> <?=$cooperative_registered['street'].$x?><?=$cooperative_registered['brgy']?>, <?=$cooperative_registered['city']?>, <?= $cooperative_registered['province']?> <?=$cooperative_registered['region']?>
                  </td>
                  <td>
                    <span class="badge badge-secondary">
                      <?php if($cooperative_registered['status']==15) { echo "Re-Print Certificate"; }?>
                    </span>
                  </td>
                  <td width="31%">
                    <?php $ar = array(2,5); $viewdoc_array = array(2,3,5) ?>
                    <?php if(in_array($admin_info->access_level,$ar)):?>
                      <ul id="ul-admin">
                        <li>
                      <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/registration" class="btn btn-sm btn-info"><i class='fas fa-print'></i> Re-print Registration</a>
                    </li>

                    <?php $dateRegistered = strtotime($cooperative_registered['date_of_or']); $datestr = strtotime('2021-07-16'); //echo $dateRegistered.'-'.$datestr;
                    if($dateRegistered >= $datestr){?>
                      <li>
                        <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/coc" class="btn btn-sm btn-info"><i class='fas fa-print'></i> Print COC</a>

                        <!-- <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/assign" data-toggle="modal" data-target="#assignInspectorModal" data-coopregno="<?= $cooperative_registered['regNo']?>" data-coopid="<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id']))?>" data-cname="<?= $cooperative_registered['proposed_name']?> <?= $cooperative_registered['type_of_cooperative']?> Cooperative <?php if(!empty($cooperative_registered['acronym_name'])){ echo '('.$cooperative_registered['acronym_name'].')';}?> <?= $cooperative_registered['grouping']?>" class="btn btn-sm btn-info"><i class='fas fa-print'></i> Print COC</a> -->
                      </li>
                    <?php } ?>
                     <?php endif; ?>
                     <?php if(in_array($admin_info->access_level,$viewdoc_array)): ?>
                    <li style="list-style: none;">
                      <a href="<?php echo base_url();?>cooperatives/<?= encrypt_custom($this->encryption->encrypt($cooperative_registered['id'])) ?>/documents" class="btn btn-sm btn-info"><i class='fas fa-eye'></i> View Document</a>
                    </li>
                     <?php endif; //end of viewdoc array?>
                  </ul>

                   
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <p><?php echo $links; ?></p>
      </div>
    </div>
  </div>
  </div>
  <?php endif;?>
</div>
<!-- End of Registered Coop Process by Head Office -->

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
          
          <input type="hidden" name="payment_id" id="payment_id"> 
          <input type="hidden" name="tae" id="cid">
          <div class="row">
            <div class="col-md-12">
              

              <table width="100%" class="bord">
                <tr>
                  <td class="bord">Date</td>
                  <td class="bord" colspan="3"><b id="tDate"></b></td>
                </tr>
                <tr>
                  <td class="bord">O.R. No</td>
                  <td class="bord"><input type="text" id="orNo" name="orNo" class="form-control" placeholder="Type here..."></td>
                </tr>
                <tr>
                  <td class="bord">Date of OR</td>
                  <td class="bord"><input type="date" id="dateofOR" name="dateofOR"  class="form-control"><span id="msgdate" style="font-size:11px;margin-left:100px;color:red;font-style: italic;"></span></td>
                </tr>
                <tr>
                  <!-- <td class="bord">Transaction No.</td> -->
                  <td class="bord">Order of Payment No.</td>
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
                  <td class="bord" colspan="3" style="text-transform:capitalize"><b id="word">
                </tr>
                <tr>
                  <td class="bord" colspan="4" align="center">Particulars</td>
                </tr>
                <tr>
                  <td width="23%"></td>
                  <td class="pera" width="" id="particulars" style="font-weight: bold;"></td>
                  <td class="pera" width="8%" valign="top">Php </td>
                  <td class="pera" align="right" width="13%" id="amount" style="font-weight: bold;"></td>
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
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?=base_url();?>assets/js/toword.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  function GetNow()
  {
    var currentdate = new Date(); 
    var month = currentdate.getMonth() + 1;
    var day = currentdate.getDate();
    var date1 = (currentdate.getFullYear() + '-' + (('' + month).length < 2 ? '0' : '') + month + '-' + (('' + day).length < 2 ? '0' : '')  + day);
    return date1;
  }
  $('#dateofOR').on('change',function(){
    var selectedDate = $(this).val();
    var now = GetNow();
    // alert(now+selectedDate);
    if(selectedDate > now)
    {
      $(this).val(now);
       $("#msgdate").text("Date of O.R. should not be future date");
      setTimeout(function(){
          $("#msgdate").text("");
      },5000);    
    }
    else if(selectedDate == now)
    {
      $("#msgdate").text("");
    }
    else
    {
      $("#msgdate").text("");
    }
  
  });
});
</script>

<script type="text/javascript">

  function showPayment(coop_id,coop_name) {
    //save_method = 'add';
    $('#paymentForm')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty();

    // alert(coop_id);
    $.ajax({
        url : "<?php echo base_url('cooperatives/payment')?>/" + coop_name,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            var currentdate = new Date(data.date);
            var month = currentdate.getMonth() + 1;
            var day = currentdate.getDate();
            var formated_date = ( (('' + day).length < 2 ? '0' : '')  + day + '-' + (('' + month).length < 2 ? '0' : '') + month + '-' +currentdate.getFullYear());

            var s = convert(data.total);
            $('#payment_id').val(data.id);
            $('#tDate').text(formated_date);
            $('#payor').text(data.payor);
            // $('#tNo').text(data.transactionNo);
            $('#tNo').text(data.refNo);
            $('#cid').val(coop_id);   
            $('#word').text(s);
            $('#nature').text(data.nature);
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
    var y = $('#dateofOR').val();
    if (x==''){
      alert('Missing O.R. No.');
    } else if (y==''){
      alert('Missing Date of O.R.');
    }
    else{
      var paymentFormData = new FormData($('#paymentForm')[0]);
      $.ajax({
          url : "<?php echo base_url('cooperatives/saveor')?>/" + 'fuck',
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
                  window.location.href="<?php echo base_url('cooperatives')?>";
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
