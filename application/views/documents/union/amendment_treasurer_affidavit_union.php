<!DOCTYPE html>

<html lang="en">

  <head>

    <title>CoopRIS <?= $title ?></title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="">

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <![endif]-->

  <link rel="stylesheet" href="<?=APPPATH?>../../../assets/css/bootstrap.min.css">

  <link rel="icon" href="<?=base_url();?>assets/img/cda.png" type="image/png">

  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css">

  

  <style>

  @page{margin: 26px 96px 70px 96px;}

  .page_break { page-break-before: always; }

  table, th, td {

    border: 0.5px solid #000 !important;

    border-collapse: collapse;

  }



  body{

      /*font-family: 'Bookman Old Style'; font-size: 12px; */

       font-family: 'Bookman Old Style',arial !important;font-size:12px;

    }

/*

font-face {

    font-family: new_font;

    src: url('BOOKOS.TTF');

}*/

  </style>

</head>

<body style="font-size:12">

  <script type="text/php">

        if ( isset($pdf) ) {

            $x = 570; 

            $y=900;

            $text = "{PAGE_NUM}";//" of {PAGE_COUNT}";

            $font = $fontMetrics->get_font("bokman");

            $size = 12;

            $color = array(0,0,0);

            $word_space = 0.0;  //  default

            $char_space = 0.0;  //  default

            $angle = 0.0;   //  default

            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);;     

        }

</script>

<div class="container-fluid text-monospace">

  <div class="row mb-4">

    <div class="col-sm-12 col-md-12 text-center">

        <center><p class="font-weight-bold"><b>TREASURER’S AFFIDAVIT</b></p></center>

    </div>

  </div>

  <div class="row mb-4">

    <div class="col-sm-12 col-md-12 text-left">

      <p class="font-weight-regular">Republic of the Philippines )<br>Prov./City/Mun. of _________________) S.S.<br>x--------------------------------------x</p>

    </div>

  </div>

  <div class="row mb-2">

    <div class="col-sm-12 col-md-12 text-left">

      <p class="text-justify" style="text-indent: 50px;">I, <?= $treasurer_of_coop->representative?>, after having been duly sworn to in accordance with law, do hereby depose and say:</p>

    </div>

  </div>

    <div class="row mb-4">
      <div class="col-sm-12 col-md-12">
        <ol class="text-justify" type="1" style="line-height: 1.1;text-align: justify;
          text-justify: inter-word;">
          <li>That I am the duly elected Treasurer of the <?= $coop_info->proposed_name?>  <?= $coop_info->grouping?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?> to act as such until my successor shall have been appointed and qualified in accordance with the By-laws of the Cooperative Union;</li>
          <li>That as such, I hereby certify that the actual total capital contribution collected for the registration of this Cooperative Union is <?= ucwords(num_format_custom($coop_info->capital_contribution)).' Pesos'?> (Php <?= number_format(str_replace(',','',$coop_info->capital_contribution),2)?>); and</li>
          <li>That the total membership fees paid and actually received by me is <?= ucwords(num_format_custom($no_of_cooperator * $bylaw_info->membership_fee)).' Pesos'?> (Php <?= number_format((str_replace(',','',$no_of_cooperator) * str_replace(',','',$bylaw_info->membership_fee)),2)?>).</li>
        </ol>
      </div>
    </div>

  <div class="row mb-4">

    <div class="col-sm-12 col-md-12 text-left">

      <p class="text-justify" style="text-indent: 50px;">IN WITNESS WHEREOF, I have hereunto affixed my signature this ___________ day of ______________, 20___ in ________________, Philippines.</p>

    </div>

  </div>

  <div class="row mb-3">

    <div class="col-sm-12 col-md-12 text-center">

         <p class="font-weight-regular" style="text-align: right;"><?= $treasurer_of_coop->representative?></p>

         <span style="float:right;margin-bottom: 1.5em;margin-right: 3.5em;margin-top:-1em;">Affiant</span>

       

    </div>

  </div>

  <!-- <div class="row mb-4">

    <div class="col-sm-12 col-md-12 text-center">

        <p class="font-weight-regular"><?= $treasurer_of_coop->representative?><br>Affiant</p>

    </div>

  </div> -->

  <div class="row mb-4">

    <div class="col-sm-12 col-md-12 text-left">

      <p class="text-justify" style="text-indent: 50px;">SUBSCRIBED AND SWORN TO before me this ________ day of ______________, 20____ in ________________, Philippines, by _______________________ who exhibited to me his/her Proof of Identity ___________ issued on ___________________, in ______________________, Philippines</p>

    </div>

  </div>

  <div class="row">

    <div class="col-xs-12 text-left">

      <p class="font-weight-bold" style="text-indent: 430px;">NOTARY PUBLIC</p>

      <p class="font-weight-normal">

      Doc. No. : ___________________<br>

      Page No.: ____________________<br>

      Book No.: ____________________<br>

      Series of ____________________

      </p>

    </div>

  </div>

</div>

<script src="<?=base_url();?>assets/js/jquery-3.7.1.min.js"></script>
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>

</body>

</html>

