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
  <style>
   @page{margin: 96px 96px 70px 96px;}
  .page_break { page-break-before: always; }
  .table-cooperator, .table-cooperator th, .table-cooperator td {
    border: 0.5px solid #000 !important;
    border-collapse: collapse;
  }
  body{
      /*font-family: 'Bookman Old Style'; font-size: 12px; */
       font-family: 'Bookman Old Style',arial !important;font-size:12px;
    }
  </style>
</head>
<body  style="font-size:12"> 
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
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-regular">Republic of the Philippines )<br>Prov./City/Mun. of _________________) S.S.<br>x--------------------------------------x</p>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left" style="margin-top: -20px;">
      <p class="text-justify" style="text-indent: 50px;">I, <?= ($treasurer_of_coop_orig!=NULL ?($treasurer_of_coop->full_name!=$treasurer_of_coop_orig->full_name ? "<b>".$treasurer_of_coop->full_name."</b>" : $treasurer_of_coop->full_name) : '__________________')?>, after having been duly sworn to in accordance with law, do hereby depose and say:</p>
  <?php
      if(strlen($coop_info->acronym)>0)
      {
      $acronym_ ='('.$coop_info->acronym.')';
      }
      else
      $acronym_='';
      $coop_type = explode(',',$coop_info->type_of_cooperative);
      if(count($coop_type)>1)
      $proposedName = ltrim(rtrim($coop_info->proposed_name)).' Multipurpose  Cooperative '.$acronym_;
      $proposedName = ltrim(rtrim($coop_info->proposed_name)).' '.$coop_info->type_of_cooperative.' Cooperative '.$acronym_;
  ?>
  <div class="row mb-4"> 
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="1" style="line-height: 1.1;text-align: justify;
  text-justify: inter-word;">
        <li>That I am the duly elected Treasurer of the <?=$proposedName?> to act as such until my successor shall have been appointed and qualified in accordance with the By-laws of the Cooperative;</li>
        <li>That as such, I hereby certify that the authorized share capital of this cooperative is
         <?= ($capitalization_info->authorized_share_capital!=$capitalization_info_orig->authorized_share_capital ? "<b>".ucwords(num_format_custom($capitalization_info->authorized_share_capital))."</b>" : ucwords(num_format_custom($capitalization_info->authorized_share_capital)))?> Pesos (Php 
          <?=$capitalization_info->authorized_share_capital!=$capitalization_info_orig->authorized_share_capital ? "<b>".number_format($capitalization_info->authorized_share_capital,2)."</b>" : number_format($capitalization_info->authorized_share_capital,2);?>)</li>
        <li>That the subscribed share capital of the cooperative is 
          <?php 
          $subscribed_shared_capitals_inwords= ($bylaw_info->kinds_of_members == 1) ? str_replace(',','',$total_regular['total_subscribed']) * str_replace(',','',$capitalization_info->par_value) : $total_regular['total_subscribed'] *$capitalization_info->par_value + $total_associate['total_subscribed'] * $capitalization_info->par_value;
         
          $subscribed_shared_capitals_orig_inwords =  ucwords(number_format(($bylaw_info->kinds_of_members == 1))) ? str_replace(',','',$total_regular_orig['total_subscribed']) * str_replace(',','',$capitalization_info->par_value) : ucwords($total_regular_orig['total_subscribed'] * $capitalization_info->par_value + $total_associate_orig['total_subscribed'] * $capitalization_info->par_value);
     
         if(strcasecmp($subscribed_shared_capitals_inwords,$subscribed_shared_capitals_orig_inwords)>0)
         {
           echo "<b>".ucwords(num_format_custom($subscribed_shared_capitals_inwords))."</b>".' Pesos';
         }
         else
            echo ucwords(num_format_custom($subscribed_shared_capitals_inwords)).' Pesos';
          ?>
           (Php <?php 
           $subscribed_shared_capitals_num =  ($bylaw_info->kinds_of_members == 1) ? number_format((str_replace(',','',$total_regular['total_subscribed']) * str_replace(',','',$capitalization_info->par_value)),2) : number_format(((str_replace(',','',$total_regular['total_subscribed']) * str_replace(',','',$capitalization_info->par_value)) + (str_replace(',','',$total_associate['total_subscribed']) * str_replace(',','',$capitalization_info->par_value))),2);
           $subscribed_shared_capitals_num_orig =  ($bylaw_info->kinds_of_members == 1) ? number_format((str_replace(',','',$total_regular_orig['total_subscribed']) * str_replace(',','',$capitalization_info->par_value)),2) : number_format(((str_replace(',','',$total_regular_orig['total_subscribed']) * str_replace(',','',$capitalization_info_orig->par_value)) + (str_replace(',','',$total_associate_orig['total_subscribed']) * str_replace(',','',$capitalization_info_orig->par_value))),2);
           echo ($subscribed_shared_capitals_num!=$subscribed_shared_capitals_num_orig ? "<b>".$subscribed_shared_capitals_num."</b>" : $subscribed_shared_capitals_num);
            ?>) which is at least twenty five (25%) percent of the authorized capital;</li>
        <li>That the paid-up share capital of the cooperative is 
          $paid_up = ucwords(number_format(($bylaw_info->kinds_of_members == 1))) ? ucwords(num_format_custom($total_regular['total_paid'] * $capitalization_info->par_value)) : ucwords(num_format_custom($total_regular['total_paid'] * $capitalization_info->par_value + $total_associate['total_paid'] * $capitalization_info->par_value));
           $paid_up_orig = ucwords(number_format(($bylaw_info->kinds_of_members == 1))) ? ucwords(num_format_custom($total_regular_orig['total_paid'] *  $capitalization_info->par_value)) : ucwords(num_format_custom($total_regular_orig['total_paid'] * $capitalization_info->par_value + $total_associate_orig['total_paid'] *  $capitalization_info->par_value));
           echo ($paid_up!=$paid_up_orig ? "<b>".$paid_up."</b>" : $paid_up).' Pesos';
           (Php 
           <?php 
           $paid_up_num =  ($bylaw_info->kinds_of_members == 1) ? number_format((str_replace(',','',$total_regular['total_paid']) * str_replace(',','', $capitalization_info->par_value)),2) : number_format(((str_replace(',','',$total_regular['total_paid']) * str_replace(',','', $capitalization_info->par_value)) + (str_replace(',','',$total_associate['total_paid']) * str_replace(',','', $capitalization_info->par_value))),2);
             $paid_up_num_orig =  ($bylaw_info->kinds_of_members == 1) ? number_format((str_replace(',','',$total_regular_orig['total_paid']) * str_replace(',','',$capitalization_info->par_value)),2) : number_format(((str_replace(',','',$total_regular_orig['total_paid']) * str_replace(',','',$capitalization_info->par_value)) + (str_replace(',','',$total_associate_orig['total_paid']) * str_replace(',','',$capitalization_info->par_value))),2);
            echo ($paid_up_num!= $paid_up_num_orig ? "<b>".$paid_up_num."</b>" : $paid_up_num); 
           ?>) which is at least twenty five (25%) percent of the subscribed capital; and</li>
        <li>That the total membership fees paid is 
          // $total_memship_fee = ucwords(num_format_custom($no_of_cooperator * $bylaw_info->membership_fee));
          //  $total_memship_fee_orig = ucwords(num_format_custom($no_of_cooperator_orig * $bylaw_info_orig->membership_fee));
          $total_memship_fee = $total_new_cooperators_added * $bylaw_info->membership_fee;
           $total_memship_fee_orig = ucwords(num_format_custom($total_new_cooperators_added_orig * $bylaw_info_orig->membership_fee));
           echo ($total_memship_fee!=$total_memship_fee_orig ? "<b>".ucwords(num_format_custom($total_memship_fee))."</b>" : ucwords(num_format_custom($total_memship_fee))).' Pesos';
          ?> 
          (Php <?php echo number_format ($total_memship_fee,2); ?>).</li>
        <li>That I have actually received the total paid-up share capital and membership fee. </li>
      </ol>
  <div class="row mb-3">
    <div class="col-sm-12 col-md-12 text-left" style="margin-top:-25px;text-align: justify;
      <p class="text-justify" style="text-indent: 50px;">IN WITNESS WHEREOF, I have hereunto affixed my signature this ___________ day of ______________, 20___ in ________________, Philippines.</p>
         <p class="font-weight-regular" style="text-align: right;"><?= $treasurer_of_coop->full_name?></p>
         <span style="float:right;margin-bottom: 1.5em;margin-right: 5.5em;margin-top:-1em;">Affiant</span>
       
    <div class="col-sm-12 col-md-12 text-left" style="text-align: justify;
      <p class="text-justify" style="text-indent: 50px;">SUBSCRIBED AND SWORN TO before me this ________ day of ______________, 20____ in ________________, Philippines, by _______________________ who exhibited to me his/her Proof of Identity ___________ issued on ___________________, in ______________________, Philippines</p>
  <div class="row">
    <div class="col-xs-12 text-left" style="text-align: justify;
      <p class="font-weight-bold" style="text-indent: 0px;float:right;">NOTARY PUBLIC</p>
      <p class="font-weight-normal">
      Doc. No. : ___________________<br>
      Page No.: ____________________<br>
      Book No.: ____________________<br>
      Series of ____________________
      </p>
</div>
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>