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
  <link rel="stylesheet" href="<?=APPPATH;?>../assets/css/bootstrap.min.css">
  <link rel="icon" href="<?=APPPATH?>../assets/img/cda.png" type="image/png">
  <link rel="icon" href="<?=APPPATH?>../assets/img/chairman.png" type="image/png">
  <style>
    @page{margin: 60px 40px 30px 40px;}
  /*.page_break { page-break-before: always; }*/
  body{font-family:Bookman Old Style !important; line-height: 22px;}
  
  </style>
</head>
<body>
<div style="height: 1060px;border: 10px black double; border-radius: 30px;padding:20px;">
	<table width=100%>
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda.png" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php // if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
<table  width="100%" height="100%" style="margin-top:-30px;background-image: url(<?=base_url();?>/assets/img/cda4.png); background-repeat: no-repeat; background-position: center;opacity: 0.2;">
	<tr>

	<td colspan="2" style="text-align: right; font-size: 12pt;"><b>Certification of Recognition No: <?=$coop_info->certNo?></b></td>
	</tr>
	<tr>
		
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		
            <td colspan="2" style="color: white; background-color: #0000FF; text-align: center; font-size: 20pt">CERTIFICATE OF RECOGNITION</td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2" style="font-weight: bold; font-size: 10pt">TO ALL WHOM THESE PRESENTS MAY COME, GREETINGS:<br/></td>
	</tr>
        <tr>
        	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2" style="text-align: justify; text-indent: 40px;">By virtue of the authority vested in me by law, I hereby certify that the application for
                recognition in favor of the:</td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2" style="text-align: center;">
			<b><?= $coop_info->laboratoryName.' Laboratory Cooperative<br> 
		Laboratory Cooperative of '.$coop_info->coopName?></b>
	</td>
	</tr>
	<tr>
		
		<td colspan="2" style="text-align: center; font-size: 9pt;"><?= $coop_info->house_blk_no.' '.$coop_info->streetName.' '.$coop_info->brgy.' '.$coop_info->city.', '.$coop_info->province.' '.$coop_info->region?></td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
                <?php if($guardian_add->guardian_nostreet != ""){
                    $houseblk = $guardian_add->guardian_nostreet.' ';
                } else {
                    $houseblk = "";
                }
                if($guardian_add->guardian_street != ""){
                    $streetName = $guardian_add->guardian_street.' ';
                } else {
                    $streetName = "";
                }?>
		<td colspan="2" style="text-align: justify;"><?='is filed by <b>'.$coop_info->coopName.'</b> with address at <b>'.$houseblk.$streetName.' '.$guardian_add->brgy.' '.$guardian_add->city.', '.$guardian_add->province.' '.$guardian_add->region.'</b>, to act as Guardian Cooperative, were presented for approval of the Authority on <b> '.date('F d, Y',strtotime($coop_info->dateApplied)).'</b> and that after having complied with the requirements under <b>Article 26 of Republic Act No. 9520 and Rule 6, Revised Rules and Regulations Implementing Certain and Special Provisions of Republic Act No. 9520</b> is hereby <b style="line-height: 25px;">APPROVED.</b>'?><b></b></td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2"> &nbsp; &nbsp; &nbsp; This Certificate is hereby issued to enable the above Laboratory Cooperative to operate as such pursuant to the pertinent law and issuances thereto.</td>
	</tr>
        <tr>
        	
		<td colspan="2"><br> &nbsp; &nbsp; &nbsp; Given in Quezon City, Philippines, this <b>
		 <?=$date_day_approved?> day of <?= $date_month,', '.$date_year?>.</b></td>
	</tr>
    <tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	</tr>
  
    <tr>
        
		<td rowspan="2">		
		</td>
		<!-- <td style="background-image: url(<?=base_url();?>/assets/img/1.png); background-repeat: no-repeat; background-position: center top; text-align: center;"><br><?= $chair ?><br>Chairman</td> -->
		<!-- <td  style="text-align: center;"> 	
			<img src="<?=APPPATH?>../assets/img/1.png" style="width:270px;height:100px;padding-left:140px;">
			
		</td> -->
	</tr>
			<div style="padding-top:-130px;padding-left:425px;float:left;">
				<img src="<?=APPPATH?><?=$signature?>" style="width:270px;height:100px;">
			</div>
			<div class="text" style="padding-top: -80px;width:400px;padding-left:500px;float:left;">
				<p style="font-size:16px;padding:0px;"><?= $chair ?></p>
				<p style="font-size:12px;margin-top:-20px;padding-left:50px">Chairman</p>
			</div>
	
</table>

<table width="100%" style="margin-top:30px;">

	<tr>
		<td width="60%" colspan="2" style="padding-top:70px;"><i style="font-size: 10px">This Certificate does not bestow upon Laboratory Cooperative a juridical personality</i>
		</td>
		<td   style="text-align:right;padding-right: 50px;">

			<img src="<?=QRCODE_DIR?><?= $coop_info->qr_code ?>" width="100" height="100" />
	</td>
	</tr>

</table>

<div style="font-size: 8px"><?php echo date('Y/m/d');?></div>
</div>
</div>

<!-- 2nd page -->
<div style="height: 1060px;border: 10px black double; border-radius: 30px;padding:20px;">
	<table width=100%>
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda.png" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php // if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
<table  width="100%" height="100%" style="margin-top:-30px;background-image: url(<?=base_url();?>/assets/img/cda4.png); background-repeat: no-repeat; background-position: center;opacity: 0.2;">
	<tr>

	<td colspan="2" style="text-align: right; font-size: 12pt;"><b>Certification of Recognition No: <?=$coop_info->certNo?></b></td>
	</tr>
	<tr>
		
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		
            <td colspan="2" style="color: white; background-color: #0000FF; text-align: center; font-size: 20pt">CERTIFICATE OF RECOGNITION</td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2" style="font-weight: bold; font-size: 10pt">TO ALL WHOM THESE PRESENTS MAY COME, GREETINGS:<br/></td>
	</tr>
        <tr>
        	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2" style="text-align: justify; text-indent: 40px;">By virtue of the authority vested in me by law, I hereby certify that the application for
                recognition in favor of the:</td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2" style="text-align: center;">
			<b><?= $coop_info->laboratoryName.' Laboratory Cooperative<br> 
		Laboratory Cooperative of '.$coop_info->coopName?></b>
	</td>
	</tr>
	<tr>
		
		<td colspan="2" style="text-align: center; font-size: 9pt;"><?= $coop_info->house_blk_no.' '.$coop_info->streetName.' '.$coop_info->brgy.' '.$coop_info->city.', '.$coop_info->province.' '.$coop_info->region?></td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
                <?php if($guardian_add->guardian_nostreet != ""){
                    $houseblk = $guardian_add->guardian_nostreet.' ';
                } else {
                    $houseblk = "";
                }
                if($guardian_add->guardian_street != ""){
                    $streetName = $guardian_add->guardian_street.' ';
                } else {
                    $streetName = "";
                }?>
		<td colspan="2" style="text-align: justify;"><?='is filed by <b>'.$coop_info->coopName.'</b> with address at <b>'.$houseblk.$streetName.' '.$guardian_add->brgy.' '.$guardian_add->city.', '.$guardian_add->province.' '.$guardian_add->region.'</b>, to act as Guardian Cooperative, were presented for approval of the Authority on <b> '.date('F d, Y',strtotime($coop_info->dateApplied)).'</b> and that after having complied with the requirements under <b>Article 26 of Republic Act No. 9520 and Rule 6,'
        . '     Revised Rules and Regulations Implementing Certain and Special Provisions of Republic Act No. 9520</b> is hereby <b style="line-height: 25px;">APPROVED.</b>'?><b></b></td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2"> &nbsp; &nbsp; &nbsp; This Certificate is hereby issued to enable the above Laboratory Cooperative to operate as such pursuant to the pertinent law and issuances thereto.</td>
	</tr>
        <tr>
        	
		<td colspan="2"><br> &nbsp; &nbsp; &nbsp; Given in Quezon City, Philippines, this <b>
		 <?=$date_day_approved?> day of <?= $date_month,', '.$date_year?>.</b></td>
	</tr>
    <tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	</tr>
        
	</tr>
  
    <tr>
        	

		<td rowspan="2">		
		</td>
		<!-- <td style="background-image: url(<?=base_url();?>/assets/img/1.png); background-repeat: no-repeat; background-position: center top; text-align: center;"><br><?= $chair ?><br>Chairman</td> -->
		<
	</tr>

	<div style="padding-top:-130px;padding-left:425px;float:left;">
		<img src="<?=APPPATH?><?=$signature?>" style="width:270px;height:100px;">
	</div>
	<div class="text" style="padding-top: -80px;width:400px;padding-left:500px;float:left;">
		<p style="font-size:16px;padding:0px;"><?= $chair ?></p>
		<p style="font-size:12px;margin-top:-20px;padding-left:50px">Chairman</p>
	</div>

	
</table>

<table width="100%" style="margin-top:30px;">

	<tr>
		<td width="60%" colspan="2" style="padding-top:70px;"><i style="font-size: 10px">This Certificate does not bestow upon Laboratory Cooperative a juridical personality</i>
		</td>
		<td   style="text-align:right;padding-right: 50px;">
			<img src="<?=QRCODE_DIR?><?= $coop_info->qr_code ?>" width="100" height="100" />
	</td>
	</tr>

</table>

<div style="font-size: 8px"><?php echo date('Y/m/d');?></div>
</div>
</div>
<!-- end 2nd page -->

<!-- 3rd page -->
<div style="height: 1060px;border: 10px black double; border-radius: 30px;padding:20px;">
	<table width=100%>
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda.png" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php // if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
<table  width="100%" height="100%" style="margin-top:-30px;background-image: url(<?=base_url();?>/assets/img/cda4.png); background-repeat: no-repeat; background-position: center;opacity: 0.2;">
	<tr>

	<td colspan="2" style="text-align: right; font-size: 12pt;"><b>Certification of Recognition No: <?=$coop_info->certNo?></b></td>
	</tr>
	<tr>
		
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		
            <td colspan="2" style="color: white; background-color: #0000FF; text-align: center; font-size: 20pt">CERTIFICATE OF RECOGNITION</td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2" style="font-weight: bold; font-size: 10pt">TO ALL WHOM THESE PRESENTS MAY COME, GREETINGS:<br/></td>
	</tr>
        <tr>
        	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2" style="text-align: justify; text-indent: 40px;">By virtue of the authority vested in me by law, I hereby certify that the application for
                recognition in favor of the:</td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2" style="text-align: center;">
			<b><?= $coop_info->laboratoryName.' Laboratory Cooperative<br> 
		Laboratory Cooperative of '.$coop_info->coopName?></b>
	</td>
	</tr>
	<tr>
		
		<td colspan="2" style="text-align: center; font-size: 9pt;"><?= $coop_info->house_blk_no.' '.$coop_info->streetName.' '.$coop_info->brgy.' '.$coop_info->city.', '.$coop_info->province.' '.$coop_info->region?></td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
                <?php if($guardian_add->guardian_nostreet != ""){
                    $houseblk = $guardian_add->guardian_nostreet.' ';
                } else {
                    $houseblk = "";
                }
                if($guardian_add->guardian_street != ""){
                    $streetName = $guardian_add->guardian_street.' ';
                } else {
                    $streetName = "";
                }?>
		<td colspan="2" style="text-align: justify;"><?='is filed by <b>'.$coop_info->coopName.'</b> with address at <b>'.$houseblk.$streetName.' '.$guardian_add->brgy.' '.$guardian_add->city.', '.$guardian_add->province.' '.$guardian_add->region.'</b>, to act as Guardian Cooperative, were presented for approval of the Authority on <b> '.date('F d, Y',strtotime($coop_info->dateApplied)).'</b> and that after having complied with the requirements under <b>Article 26 of Republic Act No. 9520 and Rule 6,'
        . '     Revised Rules and Regulations Implementing Certain and Special Provisions of Republic Act No. 9520</b> is hereby <b style="line-height: 25px;">APPROVED.</b>'?><b></b></td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2"> &nbsp; &nbsp; &nbsp; This Certificate is hereby issued to enable the above Laboratory Cooperative to operate as such pursuant to the pertinent law and issuances thereto.</td>
	</tr>
        <tr>
        	
		<td colspan="2"><br> &nbsp; &nbsp; &nbsp; Given in Quezon City, Philippines, this <b>
		 <?=$date_day_approved?> day of <?= $date_month,', '.$date_year?>.</b></td>
	</tr>
    <tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	</tr>
        
	</tr>
  
    <tr>
        	

		<td rowspan="2">		
		</td>
		<!-- <td style="background-image: url(<?=base_url();?>/assets/img/1.png); background-repeat: no-repeat; background-position: center top; text-align: center;"><br><?= $chair ?><br>Chairman</td> -->
		<
	</tr>

	<div style="padding-top:-130px;padding-left:425px;float:left;">
		<img src="<?=APPPATH?><?=$signature?>" style="width:270px;height:100px;">
	</div>
	<div class="text" style="padding-top: -80px;width:400px;padding-left:500px;float:left;">
		<p style="font-size:16px;padding:0px;"><?= $chair ?></p>
		<p style="font-size:12px;margin-top:-20px;padding-left:50px">Chairman</p>
	</div>

	
</table>

<table width="100%" style="margin-top:30px;">

	<tr>
		<td width="60%" colspan="2" style="padding-top:70px;"><i style="font-size: 10px">This Certificate does not bestow upon Laboratory Cooperative a juridical personality</i>
		</td>
		<td   style="text-align:right;padding-right: 50px;">
			<img src="<?=QRCODE_DIR?><?= $coop_info->qr_code ?>" width="100" height="100" />
	</td>
	</tr>

</table>

<div style="font-size: 8px"><?php echo date('Y/m/d');?></div>
</div>
</div>
<!-- end 3rd page -->

</body>