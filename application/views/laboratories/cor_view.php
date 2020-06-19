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
  .page_break { page-break-before: always; }
  body{font-family:Bookman Old Style !important;font-size:12;}
  
  </style>
</head>
<body>
<div style="height: 1060px;border: 10px black double; border-radius: 30px;padding:20px;">
	<table width=100%>
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda.png" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>OFFICE OF THE PRESIDENT<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php // if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
<table  width="100%" height="100%" style="margin-top:-30px;background-image: url(<?=base_url();?>/assets/img/cda3.png); background-repeat: no-repeat; background-position: center;">
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
		Laboratory Coop of '.$coop_info->coopName?></b>
	</td>
	</tr>
	<tr>
		
		<td colspan="2" style="text-align: center; font-size: 9pt;"><?= $coop_info->house_blk_no.''.$coop_info->streetName.' '.$coop_info->brgy.' '.$coop_info->city.','.$coop_info->province.' '.$coop_info->region?></td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
                <?php if($coop_info->house_blk_no != ""){
                    $houseblk = $coop_info->house_blk_no.' ';
                } else {
                    $houseblk = "";
                }
                if($coop_info->streetName != ""){
                    $streetName = $coop_info->streetName.' ';
                } else {
                    $streetName = "";
                }?>
		<td colspan="2"><?='is filed by <b>'.$coop_info->coopName.'</b> with address at '.$houseblk.$streetName.$coop_info->city.', '.$coop_info->province.' '.$coop_info->region.', to act as Guardian Cooperative, were presented for approval of the Authority on <b> '.date('F d, Y',strtotime($coop_info->dateRegistered)).' and that after having complied with the requirements under <b>Article 26 of Republic Act No. 9520 and Rule 6,'
        . '     Revised Rules and Regulations Implementing Certain and Special Provisions of Republic Act No. 9520</b> is hereby <b>APPROVED.</b>'?><b></b></td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2"> &nbsp; &nbsp; &nbsp; This Certificate is hereby issued to enable the above Laboratory Cooperative to Operate as such pursuant to the pertinent Law and issuances thereto.</td>
	</tr>
        <tr>
        
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
        <tr>
        	
		<td colspan="2"> &nbsp; &nbsp; &nbsp; Given in Quezon City, Philippines, this <b>
		 <?=$date_day_approved?> day of <?= $date_month,', '.$date_year?>.</b></td>
	</tr>
        <tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	</tr>
        <tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	</tr>
        <tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
  
    <tr>
        	

		<td rowspan="2">		
		</td>
		<!-- <td style="background-image: url(<?=base_url();?>/assets/img/1.png); background-repeat: no-repeat; background-position: center top; text-align: center;"><br><?= $chair ?><br>Chairman</td> -->
		<td style="text-align: center;padding-left:150px;"> 	
			<img src="<?=APPPATH?>../assets/img/1.png">
			<div class="text" style="margin-top:-92px;">
				<p><?= $chair ?></p>
				<p style="margin-top:-20px;">Chairman</p></div>
		</td>
	</tr>

    <tr>
        	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>

	
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
			<td style="text-align: center"><b>Republic of the Philippines<br/>OFFICE OF THE PRESIDENT<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php // if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
<table  width="100%" height="100%" style="margin-top:-30px;background-image: url(<?=base_url();?>/assets/img/cda3.png); background-repeat: no-repeat; background-position: center;">
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
		Laboratory Coop of '.$coop_info->coopName?></b>
	</td>
	</tr>
	<tr>
		
		<td colspan="2" style="text-align: center; font-size: 9pt;"><?= $coop_info->house_blk_no.''.$coop_info->streetName.' '.$coop_info->brgy.' '.$coop_info->city.','.$coop_info->province?></td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2"><?='is filed by <b>'.$coop_info->coopName.'</b> with address at '.$coop_info->house_blk_no.' '.$coop_info->streetName.' '.$coop_info->brgy.', '.$coop_info->city.', '.$coop_info->province
                .' '.$coop_info->region.', to act as Guardian Cooperative, were presented for approval of the Authority on <b> '.date('F d, Y').' and that after having complied with the requirements under <b>Article 26 of Republic Act No. 9520 and Rule 6,'
        . '     Revised Rules and Regulations Implementing Certain and Special Provisions of Republic Act No. 9520</b> is hereby <b>APPROVED.</b>'?><b></b></td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2"> &nbsp; &nbsp; &nbsp; This Certificate is hereby issued to enable the above Laboratory Cooperative to Operate as such pursuant to the pertinent Law and issuances thereto.</td>
	</tr>
        <tr>
        
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
        <tr>
        	
		<td colspan="2"> &nbsp; &nbsp; &nbsp; Given in Quezon City, Philippines, this <b> <?=$date_day_approved?> day of <?= $date_month,', '.$date_year?>.</b></td>
	</tr>
        <tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	</tr>
        <tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	</tr>
        <tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
  
    <tr>
        	

		<td rowspan="2">	
		</td>
		<!-- <td style="background-image: url(<?=base_url();?>/assets/img/1.png); background-repeat: no-repeat; background-position: center top; text-align: center;"><br><?= $chair ?><br>Chairman</td> -->

		<td style="text-align: center;padding-left:150px;"> 	
			<img src="<?=APPPATH?>../assets/img/1.png">
			<div class="text" style="margin-top:-92px;">
				<p><?= $chair ?></p>
				<p style="margin-top:-20px;">Chairman</p></div>
		</td>
	</tr>

    <!-- <tr>
        	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr> -->

	
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
			<td style="text-align: center"><b>Republic of the Philippines<br/>OFFICE OF THE PRESIDENT<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php // if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
<table  width="100%" height="100%" style="margin-top:-30px;background-image: url(<?=APPPATH?>../assets/img/cda3.png); background-repeat: no-repeat; background-position: center;">
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
		(Laboratory Coop of '.$coop_info->coopName.')'?></b>
	</td>
	</tr>
	<tr>
		
		<td colspan="2" style="text-align: center; font-size: 9pt;"><?= $coop_info->house_blk_no.''.$coop_info->streetName.' '.$coop_info->brgy.' '.$coop_info->city.','.$coop_info->province?></td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2"><?='is filed by <b>'.$coop_info->coopName.'</b> with address at '.$coop_info->house_blk_no.' '.$coop_info->streetName.' '.$coop_info->brgy.' '.$coop_info->city.', '.$coop_info->province
                .' '.$coop_info->region.', to act as Guardian Cooperative, were presented for approval of the Authority on <b> '.date('F d, Y').' and that after having complied with the requirements under <b>Article 26 of Republic Act No. 9520 and Rule 6,'
        . '     Revised Rules and Regulations Implementing Certain and Special Provisions of Republic Act No. 9520</b> is hereby <b>APPROVED.</b>'?><b></b></td>
	</tr>
	<tr>
		
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	<tr>
		
		<td colspan="2"> &nbsp; &nbsp; &nbsp; This Certificate is hereby issued to enable the above Laboratory Cooperative to Operate as such pursuant to the pertinent Law and issuances thereto.</td>
	</tr>
        <tr>
        
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
        <tr>
        	
		<td colspan="2"> &nbsp; &nbsp; &nbsp; Given in Quezon City, Philippines, this <b> <?=$date_day_approved?> day of <?= $date_month,', '.$date_year?>.</b></td>
	</tr>
        <tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	</tr>
        <tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
	</tr>
        <tr>	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr>
  
    <tr>
        	

		<td rowspan="2">	
		</td>
		

		<td style="text-align: center;padding-left:150px;"> 	
			<img src="<?=APPPATH?>../assets/img/1.png">
			<div class="text" style="margin-top:-92px;">
				<p><?= $chair ?></p>
				<p style="margin-top:-20px;">Chairman</p></div>
		</td>

		
	</tr>

    <!-- <tr>
        	
		<td colspan="2"><i style="color:white;">....</i></td>
	</tr> -->

	
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