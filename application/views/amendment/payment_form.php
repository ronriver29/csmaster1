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
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 11
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
      <?php echo form_open('Amendment_payments/add_payment',array('id'=>'paymentForm','name'=>'paymentForm')); ?>
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-payment">
            <h4 class="float-left"ORDER OF PAYMENT:></h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <table class="bord" width="65%">
            <tr>
              <td class="bord" >Order of Payment No.</td>
              <td class="bord" colspan="3"><b><?=$ref_no?></b></td>
            </tr>
            <tr>
              <td class="bord">Date</td>
              <td class="bord" colspan="3"><b><?= date("d-m-Y", strtotime($date_ok_for_payment)); ?></b></td>
            </tr>

            <?php 
             $coop_total_amount_of_paid_up_capital=0;
              if($coop_capitalization!=null)
              {
                $coop_total_amount_of_paid_up_capital= $coop_capitalization->total_amount_of_paid_up_capital;
              }
              if ($pay_from=='reservation'){
               
                 $basic_reservation_fee =300;
                 $name_reservation_fee =0;
                 $acronym ='';
                 // $amendment_name = ''; 
                 if(strlen($coop_info->acronym)>0)
                 {
                  $acronym = '('.$coop_info->acronym.')';
                 
                 }
                
                
                if(count(explode(',',$coop_info->type_of_cooperative))>1)
                {
                  $proposeName = ltrim(rtrim($coop_info->proposed_name)).' Multipurpose Cooperative '.$acronym;
                }
                else
                {

                    $proposeName = ltrim(rtrim($coop_info->proposed_name)).' '.$coop_info->type_of_cooperative.' Cooperative '.$acronym;
                }
                   
              $orig_proposedName_formated = trim(preg_replace('/\s\s+/', ' ', $orig_proposedName_formated));
               $proposeName = trim(preg_replace('/\s\s+/', ' ', $proposeName));
                $name_comparison = strcasecmp($orig_proposedName_formated,$proposeName);
                if($name_comparison!=0)
                {
                  $name_reservation_fee = 100;
                }
                
                
                 $rf=0;
                 $percentage_amount = 0;
                 $total_amendment_fee = 0;
                //fixed amount

                $diff_amount = $amendment_capitalization->total_amount_of_paid_up_capital - $coop_total_amount_of_paid_up_capital;
                //amendment paid up is greater than coop total paid up
                if($diff_amount>0)
                {
                  $percentage_amount= $diff_amount * 0.001; // 1 over 10 of 1% 
                  $total_reservation_fee = $percentage_amount+ $basic_reservation_fee;
                  $rf = $total_reservation_fee;

                }
                else
                {
                  $rf =  $basic_reservation_fee;
                }
                // $lrf=(($rf+$name_reservation_fee)*.01>10) ?($rf+$name_reservation_fee)*.01 : 10;
                 $lrf=$rf*0.01;
                 if($lrf<10)
                 {
                  $lrf=10;

                 }
               
                 if($percentage_amount>0)
                 {
                   $total_amendment_fee   = $percentage_amount +$basic_reservation_fee;
                    
                 }
                 else
                 {
                    $total_amendment_fee   = 300;
                 }
                 $amount_in_words = ($total_amendment_fee+$lrf+$name_reservation_fee);
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
                  <td class="bord" colspan="3"><b>'.ucwords($proposeName).'</b></td>
                </tr>
                <tr>
                  <td class="bord">Nature of Payment</td>
                  <td class="bord" colspan="3"><b>Amendment</b></td>
                </tr>
                <tr>
                  <td class="bord">Amount in Words</td>
                  <td class="bord" colspan="3"><b>'.$w->convert_number($amount_in_words).' '.$peso_cents.'</b></td>
                </tr>
                <tr>
                  <td class="bord" align="center" colspan="4">Particulars</td>
                </tr>';
                if($name_comparison!=0)
                {
                  echo'
                
                <tr>
                  <td width="23%"></td>
                  <td class="pera" width=""><b>Name Reservation Fee</b></td>
                  <td class="pera" width="5%"> </td>
                  <td class="pera" align="right" width="13%"><b>'.number_format($name_reservation_fee,2).'</b></td>
                </tr>';
                }
                echo'
                <tr> 
                <td></td>
                <td><b>Amendment Fee</b></td>
                </tr>
                <tr>
                <td></td>
                <td><p style="font-style:italic;font-size:11pt;">(1/10 of 1% of Php '.number_format($diff_amount,2).' increased in paid up capital<br> amounted to Php '.number_format($percentage_amount,2).' plus Php 300.00 basic fee)<p></td>
                <td class="pera" width="5%"> </td>
                <td class="pera" align="right"><b>'.number_format($total_amendment_fee,2).'</b></td>
                </tr>
                  <tr>
                <td width="23%"></td>
                  <td class="pera" width=""><b>Legal and Research Fund Fee</b></td>
                  <td class="pera" width="5%"> </td>
                  <td class="pera" align="right" width="13%"><b>'.number_format($lrf,2).'</b></td>
                </tr>
                <tr>
                  <td colspan="4">&nbsp</td>
                </tr>
                <tr>
                  <td class="bord" colspan="2">Total </td>
                  <td class="taas" width="5%">Php </td>
                  <td class="taas" align="right" width="13%"><b>'.number_format($total_amendment_fee+$lrf+$name_reservation_fee,2).'</b></td>
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
          <input type="hidden" class="form-control" id="ref_no" name="ref_no" value="<?=$ref_no?>">
         <!--  <input type="hidden" class="form-control" id="tDate" name="tDate" value="<?=date('Y-m-d',now('Asia/Manila')); ?>"> -->
          <input type="hidden" class="form-control" id="payor" name="payor" value="<?=$proposeName?>">
          <input type="hidden" class="form-control" id="nature" name="nature" value="Amendment">
          <?php if($name_comparison!=0):?>
          <input type="hidden" class="form-control" id="particulars" name="particulars" value="<b>Name Reservation Fee<br><br/>Amendment Fee</b> <br>(1/10 of 1% of Php <?=number_format($diff_amount,2)?> increased in paid up capital<br> amounted to Php <?=number_format($percentage_amount,2)?> plus Php 300.00 basic fee)<br><br><b>Legal and Research Fund Fee<b>">
           <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($name_reservation_fee,2).'<br><br><br><br>'.number_format($total_amendment_fee,2).'<br><br><br>'.number_format($lrf,2) ?>">
          <?php else: ?>
          <input type="hidden" class="form-control" id="particulars" name="particulars" value="<b>Amendment Fee<b> <br/>(1/10 of 1% of Php <?=number_format($diff_amount,2)?> increased in paid up capital<br> amounted to Php <?=number_format($percentage_amount,2)?> plus Php 300.00 basic fee)<br><br><b>Legal and Research Fund Fee</b>">
          <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($total_amendment_fee,2).'<br><br><br>'.number_format($lrf,2) ?>">
          <?php endif;?>
         
          <input type="hidden" class="form-control" id="total" name="total" value="<?= $total_amendment_fee+$lrf+$name_reservation_fee?>">
          <input type="hidden" class="form-control" id="nature" name="rCode" value="<?= $coop_info->rCode ?>">
      </div>
      <br><br>
        <input style="width:18%;" class="btn btn-color-blue" type="submit" id="offlineBtn" name="offlineBtn" value="Pay at CDA Treasury">
        <input style="width:18%;" class="btn btn-color-blue" type="submit" id="onlineBtn" name="onlineBtn" value="Pay Online" disabled>
      
    </form>
    </div>
  </div>
</div>
