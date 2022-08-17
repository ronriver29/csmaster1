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
              <td class="bord">Order of Payment No.</td>
              <?php
                if(!empty($coop_info->acronym_name)){ 
                    $acronym_name = '('.$coop_info->acronym_name.') ';
                } else {
                    $acronym_name = '';
                }

                if($coop_info->is_youth == 1){
                  $youth_name = ' Youth';
                } else {
                  $youth_name = '';
                }

                if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union'){
                      $payorname = ucwords($coop_info->proposed_name.' '.$coop_info->type_of_cooperative .' Cooperative '.$acronym_name);
                  } else if($coop_info->grouping == 'Federation'){
                      $payorname = ucwords($coop_info->proposed_name.' Federation of '.$coop_info->type_of_cooperative .' Cooperative '.$acronym_name);
                  } else {
                      $payorname = ucwords($coop_info->proposed_name.$youth_name.' '.$coop_info->type_of_cooperative .' Cooperative '.$acronym_name);
                  }

                $report_exist = $this->db->where(array('payor'=>$payorname))->get('payment');

                // echo $report_exist->num_rows();
                if($report_exist->num_rows()==0){
                  
                  if($coop_info->date_for_payment == NULL){
                    $datee = date('d-m-Y',now('Asia/Manila'));
                    $datee2 = date('Y-m-d',now('Asia/Manila'));
                  } else {
                    $datee = date('d-m-Y',strtotime($coop_info->date_for_payment));
                    $datee2 = date('Y-m-d',strtotime($coop_info->date_for_payment));
                  }
                  $series = substr($coop_info->refbrgy_brgyCode,0,2).'-'.date('Y-m',strtotime($datee)).'-'.$series;
                } else {
                  foreach($report_exist->result_array() as $row){
                    $series = $row['refNo'];
                    $datee = date('d-m-Y',strtotime($row['date']));
                    $datee2 = date('Y-m-d',now('Asia/Manila'));
                  }

                  // $series = 
                }

                // print_r($report_exist->result());
              ?>
              <td class="bord" colspan="3"><b><?=$series?></b></td>
            </tr>
            <tr>
              <td class="bord">Date</td>
              <td class="bord" colspan="3"><b><?=$datee;?></b></td>
            </tr>
            <?php
            $refNo = $series;
              if ($pay_from=='reservation'){ 
                if($coop_info->type_of_cooperative == 'Technology Service'){
                  $registrationfeename = 'Others';
                } else if($coop_info->category_of_cooperative == 'Tertiary'){
                  $registrationfeename = 'Tertiary';
                } else if ($coop_info->category_of_cooperative == 'Secondary'){
                  $registrationfeename = 'Secondary';
                } else {
                  $registrationfeename = 'Primary';
                }
                if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union' && $coop_info->type_of_cooperative != 'Technology Service'){
                  if($coop_info->area_of_operation == 'National'){
                    $rf = 3000;
                  } else if($coop_info->area_of_operation == 'Regional' || $coop_info->area_of_operation == 'Interregional'){
                    $rf = 2000;
                  } else {
                    $rf = 1000;
                  }
                    $lrf=(($rf)*.01>10) ?($rf)*.01 : 10;
                } else if($coop_info->type_of_cooperative == 'Technology Service') {
                  $rf=(((($bylaw_info->kinds_of_members == 1) ? $total_regular['total_paid'] * $capitalization_info->par_value : $total_regular['total_paid'] * $capitalization_info->par_value + $total_associate['total_paid'] *$capitalization_info->par_value ) *0.001 > 100 ) ? (($bylaw_info->kinds_of_members == 1) ?  ($total_regular['total_paid'] * $capitalization_info->par_value) : ($total_regular['total_paid'] *$capitalization_info->par_value + $total_associate['total_paid'] *$capitalization_info->par_value)) *0.001 : 100.00);
                  $lrf=(($rf)*.01>10) ?($rf)*.01 : 10;
                } else {
                  $rf=(((($bylaw_info->kinds_of_members == 1) ? $total_regular['total_paid'] * $capitalization_info->par_value : $total_regular['total_paid'] * $capitalization_info->par_value + $total_associate['total_paid'] *$capitalization_info->par_value ) *0.001 >500 ) ? (($bylaw_info->kinds_of_members == 1) ?  ($total_regular['total_paid'] * $capitalization_info->par_value) : ($total_regular['total_paid'] *$capitalization_info->par_value + $total_associate['total_paid'] *$capitalization_info->par_value)) *0.001 : 500.00);
                  $lrf=(($rf)*.01>10) ?($rf)*.01 : 10;
                }
                
                if($coop_info->type_of_cooperative == 'Technology Service'){
                  $minimum = 100000.00;
                  if($capitalization_info->total_amount_of_paid_up_capital*0.001 >= $minimum){
                    $rf = $capitalization_info->total_amount_of_paid_up_capital*0.001;
                    $lrf = $rf*0.01;
                  } else {
                    $rf = 100000.00;
                    $lrf = $rf*0.01;
                  }
                } else if($coop_info->grouping == 'Federation' && $coop_info->category_of_cooperative == 'Secondary'){
                  $minimum = 2000.00;
                  if($capitalization_info->total_amount_of_paid_up_capital*0.001 >= $minimum){
                    $rf = $capitalization_info->total_amount_of_paid_up_capital*0.001;
                    $lrf = $rf*0.01;
                  } else {
                    $rf = 2000.00;
                    $lrf = $rf*0.01;
                  }
                } else if ($coop_info->grouping == 'Federation' && $coop_info->category_of_cooperative == 'Tertiary'){
                  $minimum = 5000.00;
                  if($capitalization_info->total_amount_of_paid_up_capital*0.001 >= $minimum){
                    $rf = $capitalization_info->total_amount_of_paid_up_capital*0.001;
                    $lrf = $rf*0.01;
                  } else {
                    $rf = 5000.00;
                  }
                } else {
                  $minimum = 500.00;
                  // $rf = $rf;
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



                if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union') {
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
                    <td class="pera" width=""><b>Registration Fee - Union</b></i></td>
                    <td class="pera" width="5%"> </td>
                    <td class="pera" align="right" width="13%"><b>'.number_format($rf,2).'</b></td>
                  </tr>
                  <tr>
                  <td width="23%"></td>
                    <td class="pera" width=""><b>Legal and Research Fund Fee</b></td>
                    <td class="pera" width="5%"> </td>
                    <td class="pera" align="right" width="13%"><b>'.number_format($lrf,2).'</b></td>
                  </tr>
                  
                    <td colspan="4">&nbsp</td>
                  </tr>
                  <tr>
                   <td width="23%"></td>
                     <td class="pera" width=""><b>COC Fee</b></td>
                     <td class="pera" width="5%"> </td>
                     <td class="pera" align="right" width="13%"><b>'.number_format(100,2).'</b></td>
                   </tr>
                  <tr>
                  <tr>
                    <td class="bord" colspan="2">Total </td>
                    <td class="taas" width="5%">Php </td>
                    <td class="taas" align="right" width="13%"><b>'.number_format($rf+$lrf+$name_reservation_fee+100,2).'</b></td>
                  </tr>';
                } else {
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
                    <td class="pera" width=""><b>Registration Fee - '.$registrationfeename.'</b><br><i>(1/10 of 1% of Php'.number_format($capitalization_info->total_amount_of_paid_up_capital,2).' paid up capital amounted to Php'.number_format($capitalization_info->total_amount_of_paid_up_capital*0.001,2).' or a minimum of Php'.number_format($minimum,2).', whichever is higher)</i></td>
                    <td class="pera" width="5%"> </td>
                    <td class="pera" align="right" width="13%"><b>'.number_format($rf,2).'</b></td>
                  </tr>
                  <tr>
                  <td width="23%"></td>
                    <td class="pera" width=""><b>Legal and Research Fund Fee</b></td>
                    <td class="pera" width="5%"> </td>
                    <td class="pera" align="right" width="13%"><b>'.number_format($lrf,2).'</b></td>
                  </tr>
                  
                    <td colspan="4">&nbsp</td>
                  </tr>
                  <tr>
                   <td width="23%"></td>
                     <td class="pera" width=""><b>COC Fee</b></td>
                     <td class="pera" width="5%"> </td>
                     <td class="pera" align="right" width="13%"><b>'.number_format(100,2).'</b></td>
                   </tr>
                  <tr>
                  <tr>
                    <td class="bord" colspan="2">Total </td>
                    <td class="taas" width="5%">Php </td>
                    <td class="taas" align="right" width="13%"><b>'.number_format($rf+$lrf+$name_reservation_fee+100,2).'</b></td>
                  </tr>';
                }
              }
          ?>      
                 <!-- <tr>
                 <td width="23%"></td>
                   <td class="pera" width=""><b>COC Fee</b></td>
                   <td class="pera" width="5%"> </td>
                   <td class="pera" align="right" width="13%"><b>'.number_format(100,2).'</b></td>
                 </tr>
                <tr> -->
                  <!-- <td class="taas" align="right" width="13%"><b>'.number_format($rf+$lrf+$name_reservation_fee+100,2).'</b></td> -->
          
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
          <input type="hidden" class="form-control" id="tDate" name="tDate" value="<?=$datee2?>">
          <input type="hidden" class="form-control" id="refNo" name="refNo" value="<?=$refNo?>">
          <input type="hidden" class="form-control" id="payor" name="payor" value="<?=$payorname?>">
          <input type="hidden" class="form-control" id="nature" name="nature" value="Name Registration">
          <?php if($coop_info->grouping == 'Union' && $coop_info->type_of_cooperative == 'Union') { ?>
          <input type="hidden" class="form-control" id="particulars" name="particulars" value="Name Reservation Fee<br/>Registration Fee - Union</i><br/>Legal and Research Fund Fee<br/>COC Fee"> <!-- <br/>COC Fee -->
           <!-- <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($name_reservation_fee,2).'<br/>'.number_format($rf,2).'<br/>'.number_format($lrf,2)?>"> -->
         <?php } else {?>
          <input type="hidden" class="form-control" id="particulars" name="particulars" value="Name Reservation Fee<br/>Registration Fee - <?=$registrationfeename?><br><i>(1/10 of 1% of Php<?=number_format($capitalization_info->total_amount_of_paid_up_capital,2)?> paid up capital amounted to Php<?=number_format($capitalization_info->total_amount_of_paid_up_capital*0.001,2)?> or a minimum of Php<?=number_format($minimum,2)?>, whichever is higher)</i><br/>Legal and Research Fund Fee<br/>COC Fee">
          <!-- <?=number_format($capitalization_info->total_amount_of_paid_up_capital,2)?> paid up capital amounted to Php<?=number_format($capitalization_info->total_amount_of_paid_up_capital*0.001,2)?> or a minimum of Php<?=number_format($minimum,2)?>, whichever is higher)</i><br/>Legal and Research Fund Fee<br/>COC Fee"> <!-- <br/>COC Fee -->
           <!-- <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($name_reservation_fee,2).'<br/>'.number_format($rf,2).'<br/>'.number_format($lrf,2)?>"> -->
         <?php } ?>
           <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($name_reservation_fee,2).'<br/>'.number_format($rf,2).'<br/>'.number_format($lrf,2).'<br/>'.number_format(100,2) ?>">
           <!-- <input type="hidden" class="form-control" id="particulars" name="particulars" value="Name Reservation Fee<br/>Registration<br/>Legal and Research Fund Fee">
            <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($name_reservation_fee,2).'<br/>'.number_format($rf,2).'<br/>'.number_format($lrf,2)?>"> -->
          <input type="hidden" class="form-control" id="total" name="total" value="<?=$rf+$lrf+$name_reservation_fee+100?>"> <!-- +100 -->
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
