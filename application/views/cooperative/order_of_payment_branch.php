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
      <td class="bord" colspan="3"><b><?=$payment->date?></b></td>
    </tr>
    <tr>
      <td class="bord">Payor</td>
      <td class="bord" colspan="3"><b><?=$payment->payor?></b></td>
    </tr>
    <tr>
      <td class="bord">Nature of Payment</td>
      <td class="bord" colspan="3"><b><?=$payment->nature?></b></td>
    </tr>
    <tr>
      <td class="bord">Amount in Words</td>
      <td class="bord" colspan="3"><b><?=ucwords(num_format_custom($payment->total))?> Pesos</b></td>
    </tr>
    <tr>
      <td class="bord" align="center" colspan="4">Particulars</td>
    </tr>
    <tr>  
      <td class="pera" colspan="4" align="center"><b><?=$payment->particulars?></b></td>
    </tr>
    <tr>
      <td width="23%"></td>
      <td>  </td>
      <td class="pera" width="5%">Php </td>
      <td class="pera" align="right" width="13%"><b><?=$payment->amount?></b></td>
    </tr>
    <tr>
      <td colspan="4"><i style="color:white;">...</i></td>
    </tr>
    <tr>
      <td class="bord" colspan="2">Total </td>
      <td class="pera taas" width="5%">Php </td>
      <td class="pera taas" align="right" width="13%"><b><?=number_format($payment->total,2)?></b></td>
    </tr>
  </table>
  <u>Payment of Fees</u>
    <ul type="1">
        <li>
            The filing fees may be paid through any of the following modes, at the option of the applicant:
            <ul type="a">
                <li>
                    Online payment facilities listed and available through the CoopRIS;
                </li>
                <li>
                    Cash or manager's check, through the CDA cashier where the proposed cooperative will be registered.
                </li>
            </ul>
            In the case of payment through mode (a), the CoopRIS will generate a "Payment Details" that will indicate the amount of filing fees to be paid by the applicant.
        </li>
        <li>
            Failure to pay within ten (10) days period will result in the automatic removal of the application from the system.
        </li>
        <li>
            Fees other than the computed filing fees (e.g bank charges) shall be shouldered by the applicant.
        </li>
    </ul>
</body>
