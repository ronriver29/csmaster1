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
  <link rel="stylesheet" href="<?=APPPATH?>../assets/css/bootstrap.min.css">
  <link rel="icon" href="<?=APPPATH?>../assets/img/cda.png" type="image/png">
  <link rel="icon" href="<?=APPPATH?>../assets/img/chairman.png" type="image/png">

  
  <style>
  @page{margin:60px 40px 30px 40px;}
  .page_break { page-break-before: always; }
  
  </style>
</head>
<body>  

	<div  style="height: 1060px;border: 10px black double; border-radius: 30px; padding: 20px">
	<table width=100%>
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda_new.jpg" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>OFFICE OF THE PRESIDENT<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
	<table width=100% style="background-image: url(<?=base_url();?>/assets/img/cda3.png); background-repeat: no-repeat; background-position: center;">
		<tr>
			<td style="text-align: right; font-size: 12pt"><b>Registration No: <?= $coop_info->regNo?></b></td>
		</tr>
	        <tr>
			<td style="text-align: right; font-size: 12pt"><b>Amendment No: <?= $coop_info->regNo.'-'.$coop_info->amendmentNo ?></b></td>
		</tr>
		<tr>
			<td><i style="color:white; font-size: 8pt">....</i></td>
		</tr>
		<tr>
	            <td style="color: white; background-color: #003399; text-align: center; font-size: 15pt">CERTIFICATE OF REGISTRATION<br>OF<br>AMENDMENTS TO THE<br>ARTICLES OF COOPERATION AND BYLAWS</td>
		</tr>
		<tr>
			<td><i style="color:white; font-size: 8pt">....</i></td>
		</tr>
		<tr>
			<td style="font-weight: bold; font-size: 10pt">KNOW ALL MEN BY THESE PRESENTS, GREETINGS:<br/></td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
		<tr>
			<td style="text-align: justify; text-indent: 40px;">This is to certify that the proposed amendments to the <b> ARTICLES OF COOPERATION AND BYLAWS</b> of the
	                <?=$amend_coop_info->proposed_name?>, with office address at <?= $coop_info->house_blk_no.' '.$coop_info->brgy?>, <?= $coop_info->city?>, <?= $coop_info->province?> adopted in its <b>REGULAR</b> Annual
	                    General Assembly meeting held at <b><?=$coop_info->ga_venue?></b> on <b><?=date('F d, Y', strtotime($bylaw_info->annual_regular_meeting_day_date))?></b> were
	                    submitted to the Cooperative Development Authority (CDA) for registration pursuant to the provisions of Republic Act No. 9520.</td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	    <tr>
			<td style="text-align: justify; text-indent: 40px;">The attached amended Articles of Cooperation consisting of <b><?=(isset($articles_pages) ? $articles_pages->total_pages : '<small style="color:red">Please generate artilcles of cooperation document to get the total pages</small>' )?></b> pages and By-Laws consisting of <b><?=(isset($bylaws_pages->total_pages) ? $bylaws_pages->total_pages : '<small style="color:red">Please generate bylaws document to get the total pages</small>')?></b> pages, being not contrary
	                to the provisions of RA 9520 and the rules and regulations prescribed by the CDA, are hereby approved and registered.</td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	        <tr>
			<td style="text-align: justify; text-indent: 40px;">IN WITNESS WHEREOF, by virtue of the powers vested in me by law, I have hereunto set my hand and cause the seal of Authority to be affixed 
	                        this <b><?=$date_day?> day of <?= $date_month,', '.$date_year?> at Quezon City,</b> Philippines.</td> 
		</tr>
		 <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	<!-- 	</tr>
	        <tr>
			<td style="text-align:right;"><img src="<?=base_url();?>/assets/img/chairman.png" width="240" height="150" ></td>
		</tr>  -->
	</table>
	<table width="100%" style="margin-top:-50px;">
		<tr>
			<td><i style="color:white;">....</i></td>
			<td width="50%"></td>
		</tr>
		<tr>
			<td rowspan="2"><!-- <img src="<?=base_url();?>/assets/qr_code/tmp/qr_codes_images/<?= $coop_info->regNo ?>.png" width="100" height="100" > -->			
			</td> 
			<td  style="text-align: center;padding-left:150px;"> 	
			<img src="<?=APPPATH.$signature?>" style="width:270px;height:100px;padding-left:140px;">
			<div class="text" style="margin-top:-75px;width:400px;padding-left: 140px;">
				<p style="font-size:16px;padding:0px;"><?= $chair ?></p>
				<p style="font-size:12px;margin-top:-20px;">Chairman</p></div>
			</td>
		</tr>
		
		
	</table>

	<table width="100%" style="margin-top:50px;">
		<tr>
			<td style="text-align:right;padding-right:45px;">
				<img src="<?=QRCODE_DIR?><?= $coop_info->qr_code?>" width="100" height="100" style="float-right;"/>
			</td>
		</tr>
		
	</table>

<!-- <i style="font-size: 10px"><?=date('Y/m/d');?></i> -->
</div>

<!-- START 2ND PAGE -->
		<div  style="height: 1060px;border: 10px black double; border-radius: 30px; padding: 20px">
	<table width=100%>
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda_new.jpg" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>OFFICE OF THE PRESIDENT<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
	<table width=100% style="background-image: url(<?=base_url();?>/assets/img/cda3.png); background-repeat: no-repeat; background-position: center;">
		<tr>
			<td style="text-align: right; font-size: 12pt"><b>Registration No: <?= $coop_info->regNo?></b></td>
		</tr>
	        <tr>
			<td style="text-align: right; font-size: 12pt"><b>Amendment No: <?= $coop_info->regNo.'-'.$coop_info->amendmentNo ?></b></td>
		</tr>
		<tr>
			<td><i style="color:white; font-size: 8pt">....</i></td>
		</tr>
		<tr>
	            <td style="color: white; background-color: #003399; text-align: center; font-size: 15pt">CERTIFICATE OF REGISTRATION<br>OF<br>AMENDMENTS TO THE<br>ARTICLES OF COOPERATION AND BYLAWS</td>
		</tr>
		<tr>
			<td><i style="color:white; font-size: 8pt">....</i></td>
		</tr>
		<tr>
			<td style="font-weight: bold; font-size: 10pt">KNOW ALL MEN BY THESE PRESENTS, GREETINGS:<br/></td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
		<tr>
			<td style="text-align: justify; text-indent: 40px;">This is to certify that the proposed amendments to the <b> ARTICLES OF COOPERATION AND BYLAWS</b> of the
	                <?=$amend_coop_info->proposed_name?>, with office address at <?= $coop_info->house_blk_no.' '.$coop_info->brgy?>, <?= $coop_info->city?>, <?= $coop_info->province?> adopted in its <b>REGULAR</b> Annual
	                    General Assembly meeting held at <b><?=$coop_info->ga_venue?></b> on <b><?=date('F d, Y', strtotime($bylaw_info->annual_regular_meeting_day_date))?></b> were
	                    submitted to the Cooperative Development Authority (CDA) for registration pursuant to the provisions of Republic Act No. 9520.</td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	    <tr>
			<td style="text-align: justify; text-indent: 40px;">The attached amended Articles of Cooperation consisting of <b><?=(isset($articles_pages) ? $articles_pages->total_pages : '<small style="color:red">Please generate artilcles of cooperation document to get the total pages</small>' )?></b> pages and By-Laws consisting of <b><?=(isset($bylaws_pages) ? $bylaws_pages->total_pages : '<small style="color:red">Please generate bylaws document to get the total pages</small>')?></b> pages, being not contrary
	                to the provisions of RA 9520 and the rules and regulations prescribed by the CDA, are hereby approved and registered.</td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	        <tr>
			<td style="text-align: justify; text-indent: 40px;"><b>IN WITNESS WHEREOF, by virtue of the powers vested in me by law, I have hereunto set my hand and cause the seal of Authority to be affixed </b>
	                        this <b><?=$date_day?> day of <?= $date_month,', '.$date_year?> at Quezon City,</b> Philippines.</td>
		</tr>
		 <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	<!-- 	</tr>
	        <tr>
			<td style="text-align:right;"><img src="<?=base_url();?>/assets/img/chairman.png" width="240" height="150" ></td>
		</tr>  -->
	</table>
	<table width="100%" style="margin-top:-50px;">
		<tr>
			<td><i style="color:white;">....</i></td>
			<td width="50%"></td>
		</tr>
		<tr>
			<td rowspan="2"><!-- <img src="<?=base_url();?>/assets/qr_code/tmp/qr_codes_images/<?= $coop_info->regNo ?>.png" width="100" height="100" > -->			
			</td>
			<td  style="text-align: center;padding-left:150px;"> 	
			<img src="<?=APPPATH.$signature?>" style="width:270px;height:100px;padding-left:140px;">
			<div class="text" style="margin-top:-75px;width:400px;padding-left: 140px;">
				<p style="font-size:16px;padding:0px;"><?= $chair ?></p>
				<p style="font-size:12px;margin-top:-20px;">Chairman</p></div>
			</td>
		</tr>
		
		
	</table>

	<table width="100%" style="margin-top:50px;">
		<tr>
			<td style="text-align:right;padding-right:45px;">
				<img src="<?=QRCODE_DIR?><?= $coop_info->qr_code?>" width="100" height="100" style="float-right;"/>
			</td>
		</tr>
		<tr>	
			<td style="padding-top:10px;"><i style="font-size: 10px">Duplicate Copy</i></td>
		</tr>
		
	</table>



</div>
<!-- END 2ND PAGE -->

<!-- START 3RD PAGE -->
	<div  style="height: 1060px;border: 10px black double; border-radius: 30px; padding: 20px">
	<table width=100%>
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda_new.jpg" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>OFFICE OF THE PRESIDENT<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
	<table width=100% style="background-image: url(<?=base_url();?>/assets/img/cda3.png); background-repeat: no-repeat; background-position: center;">
		<tr>
			<td style="text-align: right; font-size: 12pt"><b>Registration No: <?= $coop_info->regNo?></b></td>
		</tr>
	        <tr>
			<td style="text-align: right; font-size: 12pt"><b>Amendment No: <?= $coop_info->regNo.'-'.$coop_info->amendmentNo ?></b></td>
		</tr>
		<tr>
			<td><i style="color:white; font-size: 8pt">....</i></td>
		</tr>
		<tr>
	            <td style="color: white; background-color: #003399; text-align: center; font-size: 15pt">CERTIFICATE OF REGISTRATION<br>OF<br>AMENDMENTS TO THE<br>ARTICLES OF COOPERATION AND BYLAWS</td>
		</tr>
		<tr>
			<td><i style="color:white; font-size: 8pt">....</i></td>
		</tr>
		<tr>
			<td style="font-weight: bold; font-size: 10pt">KNOW ALL MEN BY THESE PRESENTS, GREETINGS:<br/></td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
		<tr>
			<td style="text-align: justify; text-indent: 40px;">This is to certify that the proposed amendments to the <b> ARTICLES OF COOPERATION AND BYLAWS</b> of the
	                <?=$amend_coop_info->proposed_name?>, with office address at <?= $coop_info->house_blk_no.' '.$coop_info->brgy?>, <?= $coop_info->city?>, <?= $coop_info->province?> adopted in its <b>REGULAR</b> Annual
	                    General Assembly meeting held at <b><?=$coop_info->ga_venue?></b> on <b><?=date('F d, Y', strtotime($bylaw_info->annual_regular_meeting_day_date))?></b> were
	                    submitted to the Cooperative Development Authority (CDA) for registration pursuant to the provisions of Republic Act No. 9520.</td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	    <tr>
			<td style="text-align: justify; text-indent: 40px;">The attached amended Articles of Cooperation consisting of <b><?=(isset($articles_pages) ? $articles_pages->total_pages : '<small style="color:red">Please generate artilcles of cooperation document to get the total pages</small>' )?></b> pages and By-Laws consisting of <b><?=(isset($bylaws_pages) ? $bylaws_pages->total_pages : '<small style="color:red">Please generate bylaws document to get the total pages</small>')?></b> pages, being not contrary
	                to the provisions of RA 9520 and the rules and regulations prescribed by the CDA, are hereby approved and registered.</td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	        <tr>
			<td style="text-align: justify; text-indent: 40px;"><b>IN WITNESS WHEREOF, by virtue of the powers vested in me by law, I have hereunto set my hand and cause the seal of Authority to be affixed </b>
	                        this <b><?=$date_day?> day of <?= $date_month,', '.$date_year?> at Quezon City,</b> Philippines.</td>
		</tr>
		 <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	<!-- 	</tr>
	        <tr>
			<td style="text-align:right;"><img src="<?=base_url();?>/assets/img/chairman.png" width="240" height="150" ></td>
		</tr>  -->
	</table>
	<table width="100%" style="margin-top:-50px;">
		<tr>
			<td><i style="color:white;">....</i></td>
			<td width="50%"></td>
		</tr>
		<tr>
			<td rowspan="2"><!-- <img src="<?=base_url();?>/assets/qr_code/tmp/qr_codes_images/<?= $coop_info->regNo ?>.png" width="100" height="100" > -->			
			</td>
			<td  style="text-align: center;padding-left:150px;"> 	
			<img src="<?=APPPATH.$signature?>" style="width:270px;height:100px;padding-left:140px;">
			<div class="text" style="margin-top:-75px;width:400px;padding-left: 140px;">
				<p style="font-size:16px;padding:0px;"><?= $chair ?></p>
				<p style="font-size:12px;margin-top:-20px;">Chairman</p></div>
			</td>
		</tr>
		
		
	</table>

	<table width="100%" style="margin-top:50px;">
		<tr>
			<td style="text-align:right;padding-right:45px;">
				<img src="<?=QRCODE_DIR?><?= $coop_info->qr_code?>" width="100" height="100" style="float-right;"/>
			</td>
		</tr>
		<tr>	
			<td style="padding-top:10px;"><i style="font-size: 10px">Triplicate Copy</i></td>
		</tr>
		
	</table>

</div>
<!-- END 3RD PAGE -->
</body>