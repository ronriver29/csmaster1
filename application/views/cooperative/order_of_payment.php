<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
  <link rel="icon" href="<?=base_url();?>assets/img/cda.png" type="image/png">
  <style>
  @page{margin: 48px 96px 144px 96px;}
  .page_break { page-break-before: always; }
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
</head>
<body>
  <h3 style="text-align: center;">ORDER OF PAYMENT</h3>
  <br><br>

  <table width="100%" class="bord">
    <tr>
      <td class="bord">Order of Payment No.</td>
      <td class="bord" colspan="3"><b><?=substr($coop_info->refbrgy_brgyCode,0,2)?>-<?= date('Y-m',now('Asia/Manila')); ?>-<?=$series?></b></td>
    </tr>
    <tr>
      <td class="bord">Date</td>
      <td class="bord" colspan="3"><b><?=$tDate?></b></td>
    </tr>
    <?php //  var_dump($capitalization_info);
    if(!empty($coop_info->acronym_name)){ 
        $acronym_name = '('.$coop_info->acronym_name.')';
    } else {
        $acronym_name = '';
    }
      if ($nature=='Registration'){
        if($coop_info->category_of_cooperative == 'Tertiary'){
          $registrationfeename = 'Tertiary';
        } else if ($coop_info->category_of_cooperative == 'Secondary'){
          $registrationfeename = 'Secondary';
        } else {
          $registrationfeename = 'Primary';
        }
        if($coop_info->grouping == 'Union'){
          if($coop_info->area_of_operation == 'National'){
            $rf = 3000;
          } else if($coop_info->area_of_operation == 'Regional'){
            $rf = 2000;
          } else {
            $rf = 1000;
          }
            $lrf=(($rf)*.01>10) ?($rf)*.01 : 10;
        } else {
          $rf=(((($bylaw_info->kinds_of_members == 1) ? $total_regular['total_paid'] * $capitalization_info->par_value : $total_regular['total_paid'] * $capitalization_info->par_value + $total_associate['total_paid'] *$capitalization_info->par_value ) *0.001 >500 ) ? (($bylaw_info->kinds_of_members == 1) ?  ($total_regular['total_paid'] * $capitalization_info->par_value) : ($total_regular['total_paid'] *$capitalization_info->par_value + $total_associate['total_paid'] *$capitalization_info->par_value)) *0.001 : 500.00);
          $lrf=(($rf)*.01>10) ?($rf)*.01 : 10;
        }
        
        $amount_in_words=0;
        $amount_in_words = ($rf+$lrf+$name_reservation_fee+100);
         $amount_in_words = ($rf+$lrf+$name_reservation_fee);
        ini_set('precision', 17);
        $total_ = number_format($amount_in_words,2);
        $peso_cents = '';
        if(substr($total_,-3)=='.00')
        {
          $peso_cents ='Pesos';
        }
        $w = new Numbertowords();

    echo '
    <tr>
      <td class="bord">Payor</td>
      <td class="bord" colspan="3"><b>'.ucwords($coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$acronym_name.' '.$coop_info->grouping).'</b></td>
    </tr>
    <tr>
      <td class="bord">Nature of Payment</td>
      <td class="bord" colspan="3"><b>'.$nature.'</b></td>
    </tr>
    <tr>
      <td class="bord">Amount in Words</td>
      <td class="bord" colspan="3"><b>'.$w->convert_number($amount_in_words).' '.$peso_cents.'</b></td>
    </tr>
    <tr>
      <td class="bord" colspan="4" align="center">Particulars</td>
    </tr>
    <tr>
      <td width="23%"></td>
      <td class="pera"width=""><b>Name Reservation Fee</b></td>
      <td class="pera"width="5%">Php </td>
      <td class="pera" align="right" width="13%"><b>'.number_format($name_reservation_fee,2).'</b></td>
    </tr>
    <tr>
      <td width="23%"></td>
      <td class="pera"width=""><b>Registration Fee - '.$registrationfeename.'</b><br><i>(1/10 of 1% of Php'.number_format($capitalization_info->total_amount_of_paid_up_capital,2).' paid up capital amounted to Php'.number_format($capitalization_info->total_amount_of_paid_up_capital*0.001,2).' or a minimum of Php500.00, whichever is higher)</i></td>
      <td class="pera"width="5%"> </td>
      <td class="pera" align="right" width="13%"><b>'.number_format($rf,2).'</b></td>
    </tr>
    <tr>
    <td width="23%"></td>
      <td class="pera"width=""><b>Legal and Research Fund Fee</b></td>
      <td class="pera"width="5%"> </td>
      <td class="pera" align="right" width="13%"><b>'.number_format($lrf,2).'</b></td>
    </tr>
    <tr>
    <td width="23%"></td>
      <td class="pera"width=""><b>COC Fee</b></td>
      <td class="pera"width="5%"> </td>
      <td class="pera" align="right" width="13%"><b>'.number_format(100,2).'</b></td>
    </tr>
    <tr>
      <td colspan="4"></td>
    </tr>
    <tr>
      <td class="bord" colspan="2">Total </td>
      <td class="taas"  width="5%">Php </td>
      <td class="taas" align="right" width="13%"><b>'.number_format($rf+$lrf+$name_reservation_fee+100,2).'</b></td>
    </tr>';
}
?>  
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
  </table>
  <br>
  <p style="font-size: 10px;"><i>This is system generated.</i></p>
</body>