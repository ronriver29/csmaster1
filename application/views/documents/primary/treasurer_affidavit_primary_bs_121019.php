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
  <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
  <link rel="icon" href="<?=base_url();?>assets/img/cda.png" type="image/png">
  <style>
  @page{margin: 96px 96px 144px 96px;}
  .page_break { page-break-before: always; }
  table, th, td {
    border: 0.5px solid #000 !important;
    border-collapse: collapse;
  }

   body{font-family:Bookman Old Style !important;}
  </style>
</head>
<body style="font-family: 12 Bookman Old Style">
<div class="container-fluid text-monospace">
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><b>TREASURER’S AFFIDAVIT</b></p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-regular">Republic of the Philippines )<br>Prov./City/Mun. of _________________) S.S.<br>x--------------------------------------x</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">I, <strong><?= $treasurer_of_coop->full_name?></strong>, after having been duly sworn to in accordance with law, do hereby depose and say:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="1">
        <li>That I am the duly elected Treasurer of the <b><?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?> Cooperative <?= $coop_info->grouping?></b> to act as such until my successor shall have been appointed and qualified in accordance with the By-laws of the Cooperative;</li>
        <li>That as such, I hereby certify that the authorized share capital of this cooperative is <b><?= number_format(str_replace(',','',$article_info->authorized_share_capital))?></b> (<b>Php <?= number_format(str_replace(',','',$article_info->authorized_share_capital),2)?></b>)</li>
        <li>That the subscribed share capital of the cooperative is <b><?php echo ucwords(number_format(($bylaw_info->kinds_of_members == 1) ? str_replace(',','',$total_regular['total_subscribed']) * str_replace(',','',$article_info->par_value_common) : (str_replace(',','',$total_regular['total_subscribed']) * str_replace(',','',$article_info->par_value_common)) + (str_replace(',','',$total_associate['total_subscribed']) * str_replace(',','',$article_info->par_value_preferred))));?></b> (<b>Php <?php echo ($bylaw_info->kinds_of_members == 1) ? number_format((str_replace(',','',$total_regular['total_subscribed']) * str_replace(',','',$article_info->par_value_common)),2) : number_format(((str_replace(',','',$total_regular['total_subscribed']) * str_replace(',','',$article_info->par_value_common)) + (str_replace(',','',$total_associate['total_subscribed']) * str_replace(',','',$article_info->par_value_preferred))),2);?></b>) which is at least twenty five (25%) percent of the authorized capital;</li>
        <li>That the paid-up share capital of the cooperative is <b><?php echo ucwords(number_format(($bylaw_info->kinds_of_members == 1) ? str_replace(',','',$total_regular['total_paid']) * str_replace(',','',$article_info->par_value_common) : (str_replace(',','',$total_regular['total_paid']) * str_replace(',','',$article_info->par_value_common)) + (str_replace(',','',$total_associate['total_paid']) * str_replace(',','',$article_info->par_value_preferred))));?></b> (<b>Php <?php echo ($bylaw_info->kinds_of_members == 1) ? number_format((str_replace(',','',$total_regular['total_paid']) * str_replace(',','',$article_info->par_value_common)),2) : number_format(((str_replace(',','',$total_regular['total_paid']) * str_replace(',','',$article_info->par_value_common)) + (str_replace(',','',$total_associate['total_paid']) * str_replace(',','',$article_info->par_value_preferred))),2);?></b>) which is at least twenty five (25%) percent of the subscribed capital; and</li>
        <li>That the total membership fees paid is <b><?= ucwords(number_format(str_replace(',','',$no_of_cooperator) * str_replace(',','',$bylaw_info->membership_fee)))?></b> (<b>Php <?= number_format((str_replace(',','',$no_of_cooperator) * str_replace(',','',$bylaw_info->membership_fee)),2)?></b>).</li>
        <li>That I have actually received the total paid-up share capital and membership fee. </li>
      </ol>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">IN WITNESS WHEREOF, I have hereunto affixed my signature this ___________ day of ______________, 20___ in ________________, Philippines.</p>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-regular"><b><?= $treasurer_of_coop->full_name?></b><br>Affiant</p>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">SUBSCRIBED AND SWORN TO before me this ________ day of ______________, 20____ in ________________, Philippines, by _______________________ who exhibited to me his/her Proof of Identity ___________ issued on ___________________, in ______________________, Philippines</p>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 text-left" style="padding-top:30px;">
      <p class="font-weight-bold float-right" style="text-indent: -100px;">NOTARY PUBLIC</p>
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
