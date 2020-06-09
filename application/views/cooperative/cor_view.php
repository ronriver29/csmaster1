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
  <style>
  @page{margin: 60px 40px 30px 40px;}
  /*.page_break { page-break-before: always; }*/
  	body{font-family:Bookman Old Style !important;}

  </style>
</head> 
<body>
	
	<!-- <div  style="border: 10px black double; border-radius: 30px; padding: 20px"> -->
	<div style="height: 1060px;border: 10px black double; border-radius: 30px;padding:20px;">
	<table width="100%">
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda.png" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>OFFICE OF THE PRESIDENT<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>

<table width=100% style="background-image: url(<?=base_url();?>/assets/img/cda3.png); background-repeat: no-repeat; background-position: center;margin-top:-30px;padding-bottom: 60px;">

	<tr>
		
		<td colspan="2" style="text-align: right; font-size: 12pt;"><b>Registration No: <?= $coop_info->regNo ?></b></td>
	</tr>


	<tr>
		<td></td>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>

	<tr>
		<td colspan="2" style="color: white; background-color: #0000FF; text-align: center; font-size: 20pt">CERTIFICATE OF REGISTRATION</td>
	</tr>
	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>

	<tr >
		<td  colspan="2" style="font-weight: bold; font-size: 10pt">TO ALL WHOM THESE PRESENTS MAY COME,<br/></td>
	</tr>

		<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>

	<tr>
	<td  colspan="2" style="text-align: justify; text-indent: 40px;">This is to certify that</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: center; font-size: 20pt;"><b><?= $coop_info->coopName?></b></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: center; font-size: 9pt;">Name of Cooperative</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: justify;">with address at <b><?= ucwords($coop_info->noStreet)?> <?= ucwords($coop_info->Street).$x?> <?= $coop_info->brgy?>, <?= $coop_info->city?>, <?= $coop_info->province?>, <?= $coop_info->region?></b>, has presented and filed with the Authority its Articles of Cooperation and By-laws duly signed and acknowledged for its organization in accordance with the provisions of Republic Act 9520. This certifies further that the said Articles of Cooperation and By-laws have complied with the provisions of the said Republic Act 9520 and its Implementing Rules and Regulations.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: justify; ; text-indent: 40px;">By virtue of the powers and duties vested upon me by law, the above named cooperative is hereby registered with the Cooperative Development Authority and shall continue to enjoy the rights and privileges in accordance with Republic Act 9520 and all other laws appurtenant thereto unless this Certificate is suspended or cancelled for cause.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: justify; text-indent: 40px;">Given in Quezon City, Philippines, this <?=date("F d, Y", strtotime( (substr($coop_info->dateofor,0,2).'-'.substr($coop_info->dateofor,6,4)) ) ); ?>.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
</table>
<
<table width="100%" style="margin-top:-50px;">
	<tr>
		<td><i style="color:white;">....</i></td>
		<td width="50%"></td>
	</tr>
	<tr>
		<td rowspan="2"><!-- <img src="<?=base_url();?>/assets/qr_code/tmp/qr_codes_images/<?= $coop_info->regNo ?>.png" width="100" height="100" > -->		
		</td>
		<td style="background-image: url(<?=base_url();?>/assets/img/1.png); background-repeat: no-repeat; background-position: center top; text-align: center;"><br><?= $chair ?><br>Chairman</td>
	</tr>
	
	
</table>
<table width="100%" style="margin-top:40px;">
	<tr>

		<td style="text-align:right;padding-right:45px;">
			<img src="<?=QRCODE_DIR?><?= $coop_info->regNo ?>.png" width="100" height="100" style="float-right;"/>
		</td>
	</tr>
</table>
</div>
<!-- end of first page -->

<!-- 2nd page -->
	<div style="height: 1060px;border: 10px black double; border-radius: 30px;padding:20px;">
	<table width="100%">
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda.png"" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>OFFICE OF THE PRESIDENT<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>

<table width=100% style="background-image: url(<?=base_url();?>/assets/img/cda3.png); background-repeat: no-repeat; background-position: center;margin-top:-30px;padding-bottom: 60px;">

	<tr>
		
		<td colspan="2" style="text-align: right; font-size: 12pt;"><b>Registration No: <?= $coop_info->regNo ?></b></td>
	</tr>

	<tr>
		<td></td>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
		<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>

	<tr>
		<td colspan="2" style="color: white; background-color: #0000FF; text-align: center; font-size: 20pt">CERTIFICATE OF REGISTRATION</td>
	</tr>
	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>

	<tr >
		<td  colspan="2" style="font-weight: bold; font-size: 10pt">TO ALL WHOM THESE PRESENTS MAY COME,<br/></td>
	</tr>

		<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>

	<tr>
	<td  colspan="2" style="text-align: justify; text-indent: 40px;">This is to certify that</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: center; font-size: 20pt;"><b><?= $coop_info->coopName?></b></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: center; font-size: 9pt;">Name of Cooperative</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: justify;">with address at <b><?= ucwords($coop_info->noStreet)?> <?= ucwords($coop_info->Street).$x?> <?= $coop_info->brgy?>, <?= $coop_info->city?>, <?= $coop_info->province?>, <?= $coop_info->region?></b>, has presented and filed with the Authority its Articles of Cooperation and By-laws duly signed and acknowledged for its organization in accordance with the provisions of Republic Act 9520. This certifies further that the said Articles of Cooperation and By-laws have complied with the provisions of the said Republic Act 9520 and its Implementing Rules and Regulations.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: justify; ; text-indent: 40px;">By virtue of the powers and duties vested upon me by law, the above named cooperative is hereby registered with the Cooperative Development Authority and shall continue to enjoy the rights and privileges in accordance with Republic Act 9520 and all other laws appurtenant thereto unless this Certificate is suspended or cancelled for cause.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: justify; text-indent: 40px;">Given in Quezon City, Philippines, this <?=date("F d, Y", strtotime( (substr($coop_info->dateofor,0,2).'-'.substr($coop_info->dateofor,6,4)) ) ); ?>.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
</table>

<table width="100%" style="margin-top:-50px;">
	<tr>
		<td><i style="color:white;">....</i></td>
		<td width="50%"></td>
	</tr>
	<tr>
		<td rowspan="2"><!-- <img src="<?=base_url();?>/assets/qr_code/tmp/qr_codes_images/<?= $coop_info->regNo ?>.png" width="100" height="100" > -->			
		</td>
		<td style="background-image: url(<?=base_url();?>/assets/img/1.png); background-repeat: no-repeat; background-position: center top; text-align: center;"><br><?= $chair ?><br>Chairman</td>
	</tr>
	
	
</table>
<table width="100%" style="margin-top:40px;">
	<tr>
		<td style="text-align:right;padding-right:45px;">
			<img src="<?=QRCODE_DIR?><?= $coop_info->regNo ?>.png" width="100" height="100" style="float-right;"/>
		</td>
	</tr>
	<tr>	
		<td><i style="font-size: 10px">Duplicate Copy</i></td>
	</tr>
</table>
</div>
<!-- end of 2nd page -->

<!-- start 3page -->
	<div style="height: 1060px;border: 10px black double; border-radius: 30px;padding:20px;">
	<table width="100%">
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda.png"" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>OFFICE OF THE PRESIDENT<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>

<table width=100% style="background-image: url(<?=base_url();?>/assets/img/cda3.png); background-repeat: no-repeat; background-position: center;margin-top:-30px;padding-bottom: 60px;">

	<tr>
		
		<td colspan="2" style="text-align: right; font-size: 12pt;"><b>Registration No: <?= $coop_info->regNo ?></b></td>
	</tr>

	<tr>
		<td></td>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		<td colspan="2" style="color: white; background-color: #0000FF; text-align: center; font-size: 20pt">CERTIFICATE OF REGISTRATION</td>
	</tr>
	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>

	<tr >
		<td  colspan="2" style="font-weight: bold; font-size: 10pt">TO ALL WHOM THESE PRESENTS MAY COME,<br/></td>
	</tr>

		<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>

	<tr>
	<td  colspan="2" style="text-align: justify; text-indent: 40px;">This is to certify that</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: center; font-size: 20pt;"><b><?= $coop_info->coopName?></b></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: center; font-size: 9pt;">Name of Cooperative</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: justify;">with address at <b><?= ucwords($coop_info->noStreet)?> <?= ucwords($coop_info->Street).$x?> <?= $coop_info->brgy?>, <?= $coop_info->city?>, <?= $coop_info->province?>, <?= $coop_info->region?></b>, has presented and filed with the Authority its Articles of Cooperation and By-laws duly signed and acknowledged for its organization in accordance with the provisions of Republic Act 9520. This certifies further that the said Articles of Cooperation and By-laws have complied with the provisions of the said Republic Act 9520 and its Implementing Rules and Regulations.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: justify; ; text-indent: 40px;">By virtue of the powers and duties vested upon me by law, the above named cooperative is hereby registered with the Cooperative Development Authority and shall continue to enjoy the rights and privileges in accordance with Republic Act 9520 and all other laws appurtenant thereto unless this Certificate is suspended or cancelled for cause.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td  colspan="2" style="text-align: justify; text-indent: 40px;">Given in Quezon City, Philippines, this <?=date("F d, Y", strtotime( (substr($coop_info->dateofor,0,2).'-'.substr($coop_info->dateofor,6,4)) ) ); ?>.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
</table>

<table width="100%" style="margin-top:-50px;">
	<tr>
		<td><i style="color:white;">....</i></td>
		<td width="50%"></td>
	</tr>
	<tr>
		<td rowspan="2"><!-- <img src="<?=base_url();?>/assets/qr_code/tmp/qr_codes_images/<?= $coop_info->regNo ?>.png" width="100" height="100" > -->			
		</td>
		<td style="background-image: url(<?=base_url();?>/assets/img/1.png); background-repeat: no-repeat; background-position: center top; text-align: center;"><br><?= $chair ?><br>Chairman</td>
	</tr>
	
	
</table>
<table width="100%" style="margin-top:40px;">
	<tr>
		<td style="text-align:right;padding-right:45px;">
			<img src="<?=QRCODE_DIR?><?= $coop_info->regNo ?>.png" width="100" height="100" style="float-right;"/>
		</td>
	</tr>
	<tr>	
				<td><i style="font-size: 10px">Triplicate Copy</i></td>
	</tr>
</table>
</div>
<!-- end page 3 -->


<div  style="padding-top:30px;text-align: justify; font-family: Calibri,sans-serif; font-size: 12.5px; background-image: url(<?=base_url();?>/assets/img/cda2.png); background-repeat: no-repeat; background-position: center;">
<p >
<?=date("F d, Y", strtotime( (substr($coop_info->dateRegistered,3,2).'-'.substr($coop_info->dateRegistered,0,2).'-'.substr($coop_info->dateRegistered,6,4) ) ) ); ?><br/>
<br/>
<b>THE BOARD OF DIRECTORS</b><br/>
<?=$coop_info->coopName?><br/>
<?= ucwords($coop_info->noStreet)?> <?= ucwords($coop_info->Street).$x ?><?= $coop_info->brgy?>, <?= $coop_info->city?>, <?= $coop_info->province?>, <?= $coop_info->region?><br/>
<br/>
<br/>
Gentlemen:<br/>
<br/>
Please find enclosed Certificate of Registration No. <?= $coop_info->regNo ?> dated <u><?=date("F d, Y", strtotime( (substr($coop_info->dateofor,0,2).'-'.substr($coop_info->dateofor,6,4)) ) ); ?></u> of the <u><?=$coop_info->coopName?></u> together with Articles of Cooperation and By-laws which gives the organization legal personality. We commend you for the initiative you have taken in the organization of said cooperative.
<br/><br/>
For the proper guidance of the members of the board of directors and committees, as well as the officers in the discharge of their respective duties, you are hereby required to call a special general assembly within ninety (90) days from the date of Registration of your cooperative pursuant to Article 34 (3) Chapter IV of the R. A. 9520 to consider the following:
<br/>
<ol><li>To approve developmental plans of the cooperative; and</li>
<li>Such other matters that the Board may wish to bring to the attention of the members.</li>
</ol>
The success of the cooperative depends on the quality and loyalty of the members. It is, therefore, imperative that the following activities should be duly programmed:
<br/><br/>
<ol type="a">
 <li>Continuous education for the members, officers and employees, not only on the principles and practices of cooperatives, but also on how the members can increase their income and resources;</li>
 <li>Continuous savings of the members to increase the capital of the cooperative. Increased capital would mean greater members? participation, improved business service and adequate salaries and wages for the employees.</li>
 <li>Constant meetings, seminars and dialogue with the members is highly recommended for immediate solution of common problems through group action and to make them aware of their duties and responsibilities.</li>
</ol>
You should refer to your economic feasibility study and compare your budget with actual performance of the cooperative. Any material variance of the actual with your forecasts should be immediately discussed, noted and acted upon by your board, committee and the hired management.
<br/><br/>
Further, we advise you to secure the necessary permits and/or licenses for the operation of your business as may be required by the national and/or local rules, and to register your books of accounts with the nearest local BIR Office. Likewise, we encourage you to secure a Certificate of Tax Exemption from the BIR to avail of the privileges pursuant to Article 60 & 61 of RA 9520 and DOF Joint Rules and Regulations implementing Articles 60, 61 and 144 (2) of RA 9520 in relation to RA no. 8424 or the National Internal Revenue Code, as amended.
<br/><br/>
You are further enjoined to file a copy of your Cooperative Annual Performance Report, Social Audit Report, Performance Audit Report, Audited Financial Statement duly stamped "Received" by BIR and List of Officers and Trainings Undertaken/Completed with the Cooperative Development Authority within One Hundred Twenty (120) Days from the end of every calendar year pursuant to Article 53 (1) of R.A. 9520 and Rule 8 Section 2 of its IRR on certain provisions.
<br/><br/>
Lastly, if you have any concern/issue about your cooperative, please feel free to communicate with us. It is our pleasure to share with you our knowledge and experience.
<br/><br/>
Very truly yours,<br/>
<br/>
<br/>
<br/>
<b><?=strtoupper($director) ?></b><br/>
<?=strtoupper('Regional Director') ?>
</p>
</div>
</body>