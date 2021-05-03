<style>

  .bord {
    border: 0.5px solid #000;
    border-collapse: collapse;
    padding: 5px;
  }
  .pera {
    
    padding: 5px;
  }
  .taas {
    border-top: 0.5px solid #000;
    border-collapse: collapse;
    padding: 5px;
  }
  </style>
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 13
      <?php endif; ?>
    </h5>
  </div>
</div> 

<?php if($this->session->flashdata('payment_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
     <?php echo $this->session->flashdata('payment_success'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('payment_error')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger text-center" role="alert">
     <?php echo $this->session->flashdata('payment_error'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('payments/add_payment',array('id'=>'paymentForm','name'=>'paymentForm')); ?>
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-payment">
            <h4 class="float-left"ORDER OF PAYMENT:</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <table class="bord" width="65%">
            <tr>
              <td class="bord">Date</td>
              <td class="bord" colspan="3"><b><?= date('Y-m-d h:i:s',now('Asia/Manila')); ?></b></td>
            </tr>
            <?php
              if ($pay_from=='reservation'){ 
                $rf=(((($bylaw_info->kinds_of_members == 1) ? $total_regular['total_paid'] * $capitalization_info->par_value : $total_regular['total_paid'] * $capitalization_info->par_value + $total_associate['total_paid'] *$capitalization_info->par_value ) *0.001 >500 ) ? (($bylaw_info->kinds_of_members == 1) ?  ($total_regular['total_paid'] * $capitalization_info->par_value) : ($total_regular['total_paid'] *$capitalization_info->par_value + $total_associate['total_paid'] *$capitalization_info->par_value)) *0.001 : 500.00);
                $lrf=(($rf)*.01>10) ?($rf)*.01 : 10;
                
                if(!empty($coop_info->acronym_name)){ 
                    $acronym_name = '('.$coop_info->acronym_name.') ';
                } else {
                    $acronym_name = '';
                }
                if($coop_info->grouping == 'Union'){
                    $payorname = ucwords($coop_info->proposed_name.' '.$coop_info->grouping.' Of '.$coop_info->type_of_cooperative .' Cooperative '.$acronym_name);
                } else {
                    $payorname = ucwords($coop_info->proposed_name.' '.$coop_info->type_of_cooperative .' Cooperative '.$acronym_name.$coop_info->grouping);
                }
                $amount_in_words=0;
                  $amount_in_words = ($rf+$lrf+$name_reservation_fee+100);
                 // $amount_in_words = ($rf+$lrf+$name_reservation_fee);

                ini_set('precision', 17);
                $total_ = number_format($amount_in_words,2);
                // $total_amount_in_words = ($pos = strpos($amount_in_words,'.')) ? substr( $amount_in_words,0,$pos + 3) : number_format( $amount_in_words);
                $peso_cents = '';
                if(substr($total_,-3)=='.00')
                {
                  $peso_cents ='Pesos';
                }
                $w = new Numbertowords();
                echo '
                <tr>
                  <td class="bord">Payor</td>
                  <td class="bord" colspan="3"><b>'.$payorname.'</b></td>
                </tr>
                <tr>
                  <td class="bord">Nature of Payment</td>
                  <td class="bord" colspan="3"><b>Registration</b></td>
                </tr>
                <tr>
                  <td class="bord">Amount in Words</td>
                  <td class="bord" colspan="3" id="amt" style="text-transform:capitalize;font-weight:bold"><b>'.$w->convert_number($amount_in_words).' '.$peso_cents.'</b></td>
                </tr>
                <tr>
                  <td class="bord" align="center" colspan="4">Particulars</td>
                </tr>
                <tr>
                  <td width="23%"></td>
                  <td class="pera" width=""><b>Name Reservation Fee</b></td>
                  <td class="pera" width="5%">Php </td>
                  <td class="pera" align="right" width="13%"><b>'.number_format($name_reservation_fee,2).'</b></td>
                </tr>
                <tr>
                  <td width="23%"></td>
                  <td class="pera" width=""><b>Registration Fee</b></td>
                  <td class="pera" width="5%"> </td>
                  <td class="pera" align="right" width="13%"><b>'.number_format($rf,2).'</b></td>
                </tr>
                <tr>
                <td width="23%"></td>
                  <td class="pera" width=""><b>Legal and Research Fund Fee</b></td>
                  <td class="pera" width="5%"> </td>
                  <td class="pera" align="right" width="13%"><b>'.number_format($lrf,2).'</b></td>
                </tr>
                <tr>
                 <td width="23%"></td>
                   <td class="pera" width=""><b>COC Fee</b></td>
                   <td class="pera" width="5%"> </td>
                   <td class="pera" align="right" width="13%"><b>'.number_format(100,2).'</b></td>
                 </tr>
                <tr>
                  <td colspan="4">&nbsp</td>
                </tr>
                <tr>
                  <td class="bord" colspan="2">Total </td>
                  <td class="pera" width="5%">Php </td>
                  <td class="pera" align="right" width="13%"><b>'.number_format($rf+$lrf+$name_reservation_fee+100,2).'</b></td>
                </tr>';
              }
          ?>      
                 
          
          </table>
        <div>
            <u>Payment of Fees</u>
                <ol type="1">
                    <li>The filing fees may be paid through any of the following modes, at the option of
                        the applicant:</li>
                        <ol type="a">
                            <li>Online payment facilities listed and available through the CoopRIS;</li>
                            <li>Cash or manager&#39;s check, through the CDA cashier where the proposed
                                cooperative will be registered.</li>
                        </ol>
                    In the case of payment through mode (a), the CoopRIS will generate a &quot;Payment
                    Details&quot; that will indicate the amount of filing fees to be paid by the applicant.
                    <li>Failure to pay within ten (10) days period will result in the automatic removal of
                        the application from the system.</li>
                    <li>Fees other than the computed filing fees (e.g. bank charges) shall be shouldered
                        by the applicant.</li>
                </ol>
        </div>
          <input type="hidden" class="form-control" id="cooperativeID" name="cooperativeID" value="<?=$encrypted_id ?>">
          <input type="hidden" class="form-control" id="tDate" name="tDate" value="<?=date('Y-m-d',now('Asia/Manila')); ?>">
          <input type="hidden" class="form-control" id="payor" name="payor" value="<?=$payorname?>">
          <input type="hidden" class="form-control" id="nature" name="nature" value="Name Registration">
          <input type="hidden" class="form-control" id="particulars" name="particulars" value="Name Reservation Fee<br/>Registration<br/>Legal and Research Fund Fee<br/>COC Fee">
           <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($name_reservation_fee,2).'<br/>'.number_format($rf,2).'<br/>'.number_format($lrf,2).'<br/>'.number_format(100,2) ?>">
           <!-- <input type="hidden" class="form-control" id="particulars" name="particulars" value="Name Reservation Fee<br/>Registration<br/>Legal and Research Fund Fee">
            <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($name_reservation_fee,2).'<br/>'.number_format($rf,2).'<br/>'.number_format($lrf,2)?>"> -->
          <input type="hidden" class="form-control" id="total" name="total" value="<?=$rf+$lrf+$name_reservation_fee?>">
          <input type="hidden" class="form-control" id="nature" name="rCode" value="<?= $coop_info->rCode ?>">
      </div>
      <br><br>
        <input style="width:18%;" class="btn btn-color-blue" type="submit" id="offlineBtn" name="offlineBtn" value="Pay at CDA Cashier">
        <input style="width:18%;" class="btn btn-color-blue" type="submit" id="onlineBtn" name="onlineBtn" value="Pay Online" disabled>
      
    </form>
    </div>
  </div>
</div>

<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?=base_url();?>assets/js/toword.js"></script>

<!-- <script type="text/javascript">
  // $(document).ready(function(){
       var s=get_rupees_in_words(444,0);
  $('#amt').text(s+' Pesos');
  // });
 
</script> -->
