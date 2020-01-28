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
      <td class="bord">Date</td>
      <td class="bord" colspan="3"><b><?=$tDate?></b></td>
    </tr>
    <?php
      if ($nature=='Name Registration'){
        $rf=(((($bylaw_info->kinds_of_members == 1) ? $total_regular['total_paid'] * $article_info->par_value_common : $total_regular['total_paid'] * $article_info->par_value_common + $total_associate['total_paid'] *$article_info->par_value_preferred ) *0.001 >500 ) ? (($bylaw_info->kinds_of_members == 1) ?  ($total_regular['total_paid'] * $article_info->par_value_common) : ($total_regular['total_paid'] *$article_info->par_value_common + $total_associate['total_paid'] *$article_info->par_value_preferred)) *0.001 : 500.00);
        $lrf=(($rf+$name_reservation_fee)*.01>10) ?($rf+$name_reservation_fee)*.01 : 10;
    echo '
    <tr>
      <td class="bord">Payor</td>
      <td class="bord" colspan="3"><b>'.ucwords($coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' '.$coop_info->grouping).'</b></td>
    </tr>
    <tr>
      <td class="bord">Nature of Payment</td>
      <td class="bord" colspan="3"><b>'.$nature.'</b></td>
    </tr>
    <tr>
      <td class="bord">Amount in Words</td>
      <td class="bord" colspan="3"><b>'.ucwords(num_format_custom($rf+$lrf+$name_reservation_fee)).' Pesos</b></td>
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
      <td class="pera"width=""><b>Registration Fee</b></td>
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
      <td colspan="4"></td>
    </tr>
    <tr>
      <td class="bord" colspan="2">Total </td>
      <td class="taas"  width="5%">Php </td>
      <td class="taas" align="right" width="13%"><b>'.number_format($rf+$lrf+$name_reservation_fee,2).'</b></td>
    </tr>';
    }
    ?>
  </table>
</body>