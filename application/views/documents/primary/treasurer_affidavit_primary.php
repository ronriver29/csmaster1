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
  @page{margin: 96px 96px 70px 96px;}
  .page_break { page-break-before: always; }
  table, th, td {
    border: 0.5px solid #000 !important;
    border-collapse: collapse;
  }
<?php 
if($coop_info->status == 12 && $is_client){
?>
  body{
      /*font-family: 'Bookman Old Style'; font-size: 12px; */
       font-family: 'Bookman Old Style',arial !important;font-size:12px;
    }
  <?php } ?>
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
<?php 
if($coop_info->status != 12){
?>
<style type="text/css">
  #printPage
{
  margin-left: 450px;
  padding: 0px;
  width: 670px; / width: 7in; /
  height: 900px; / or height: 9.5in; /
  clear: both;
  page-break-after: always;
}
</style>
<a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/documents" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
<?php } ?>
<div class="container-fluid text-monospace" id="printPage">
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
    <div class="col-sm-12 col-md-12 text-left" style="margin-top: -20px;">
      <p class="text-justify" style="text-indent: 50px;">I, <?= $treasurer_of_coop->full_name?>, after having been duly sworn to in accordance with law, do hereby depose and say:</p>
    </div>
  </div>
  <div class="row mb-4"> 
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="1">
        <li>That I am the duly elected Treasurer of the <?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?> <?= $coop_info->grouping?> to act as such until my successor shall have been appointed and qualified in accordance with the By-laws of the Cooperative;</li>
        <li>That as such, I hereby certify that the authorized share capital of this cooperative is <?= ucwords(num_format_custom($capitalization_info->authorized_share_capital)).' Pesos'?> (Php <?= number_format(str_replace(',','',$capitalization_info->authorized_share_capital),2)?>)</li>
        <li>That the subscribed share capital of the cooperative is <?php echo ucwords(number_format(($bylaw_info->kinds_of_members == 1))) ? ucwords(num_format_custom($total_regular['total_subscribed'] * $capitalization_info->par_value)).' Pesos' : ucwords(num_format_custom($total_regular['total_subscribed'] * $capitalization_info->par_value + $total_associate['total_subscribed'] * $capitalization_info->par_value)).' Pesos';?> (Php <?php echo ($bylaw_info->kinds_of_members == 1) ? number_format((str_replace(',','',$total_regular['total_subscribed']) * str_replace(',','',$capitalization_info->par_value)),2) : number_format(((str_replace(',','',$total_regular['total_subscribed']) * str_replace(',','',$capitalization_info->par_value)) + (str_replace(',','',$total_associate['total_subscribed']) * str_replace(',','',$capitalization_info->par_value))),2);?>) which is at least twenty five (25%) percent of the authorized capital;</li>
        <li>That the paid-up share capital of the cooperative is 
          <?php $pd_up='';
            if($bylaw_info->kinds_of_members == 1):
            
             $pd_up = str_replace(',','',$total_regular['total_paid']) * str_replace(',','',$capitalization_info->par_value);
            
            else :
            
               $pd_up = str_replace(',','',$total_regular['total_paid']) * str_replace(',','',$capitalization_info->par_value) + str_replace(',','',$total_associate['total_paid']) * str_replace(',','',$capitalization_info->par_value);
            endif;
            echo ucwords(num_format_custom($pd_up,2)).' Pesos';
           ?>
         (Php <?php echo ($bylaw_info->kinds_of_members == 1) ? number_format((str_replace(',','',$total_regular['total_paid']) * str_replace(',','',$capitalization_info->par_value)),2) : number_format(((str_replace(',','',$total_regular['total_paid']) * str_replace(',','',$capitalization_info->par_value)) + (str_replace(',','',$total_associate['total_paid']) * str_replace(',','',$capitalization_info->par_value))),2);?>) which is at least twenty five (25%) percent of the subscribed capital; and</li>
        <li>That the total membership fees paid is <?= ucwords(num_format_custom($no_of_cooperator * $bylaw_info->membership_fee)).' Pesos'?> (Php <?= number_format((str_replace(',','',$no_of_cooperator) * str_replace(',','',$bylaw_info->membership_fee)),2)?>).</li>
        <li>That I have actually received the total paid-up share capital and membership fee. </li>
      </ol>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-sm-12 col-md-12 text-left" style="margin-top:-25px">
      <p class="text-justify" style="text-indent: 50px;">IN WITNESS WHEREOF, I have hereunto affixed my signature this ___________ day of ______________, 20___ in ________________, Philippines.</p>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-regular"><?= $treasurer_of_coop->full_name?><br>Affiant</p>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">SUBSCRIBED AND SWORN TO before me this ________ day of ______________, 20____ in ________________, Philippines, by _______________________ who exhibited to me his/her Proof of Identity ___________ issued on ___________________, in ______________________, Philippines</p>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 text-left" style="">
      <p class="font-weight-bold" style="text-indent: 0px;float:right;">NOTARY PUBLIC</p>
      <p class="font-weight-normal">
      Doc. No. : ___________________<br>
      Page No.: ____________________<br>
      Book No.: ____________________<br>
      Series of ____________________
      </p>
    </div>
  </div>
</div>
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>
