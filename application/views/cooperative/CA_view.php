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
  	/*body{font-family:Bookman Old Style !important;}*/
  	body{font-family:Bookman Old Style !important; line-height: 20px;}

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
<?php if($branch_info->house_blk_no==null && $branch_info->street==null) $x=''; else $x=', ';
if($branch_info->noStreet==null && $branch_info->st==null) $x=''; else $x=', ';
if ($branch_info->type=="Branch"){
	$certLabel='Certificate';
	$certTitle='CERTIFICATE OF AUTHORITY';
	$certOffice='';
	$typ='Branch';
        $mcno = '2015-11';
        $mcdated = 'December 3, 2015';
}else{
	$certLabel='Letter';
	$certTitle='LETTER OF AUTHORITY';
	$certOffice=' Office';
	$typ='Satellite';
        $mcno = '2016-05';
        $mcdated = 'October 18, 2016';
}

?>
<br/><br/>
<table width=100% style="background-image: url(<?=base_url();?>/assets/img/cda4.png); background-repeat: no-repeat; background-position: center;opacity: 0.2;">
	<tr>
		<td style="text-align: right; font-size: 12pt"><b><?= $certLabel?> of Authority No: <?= $branch_info->certNo ?></b></td>
	</tr>
	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		<td style="color: white; background-color: #0000FF; text-align: center; font-size: 20pt"><?=$certTitle?></td>
	</tr>
	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		<td style="font-weight: bold; font-size: 10pt">TO ALL WHOM THESE PRESENTS MAY COME:<br/></td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: justify; text-indent: 40px;">By the virtue of the authority vested in me by law, I hereby certify that the application of the:</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: center; font-size: 20pt;"><b><?= $branch_info->coopName?></b></td>
	</tr>
	<tr>
		<td style="text-align: center; font-size: 9pt;"><?= $branch_info->regNo?></td>
	</tr>
	<tr>
            <?php if($branch_info->area_of_operation == 'Barangay' || $branch_info->area_of_operation == 'Municipality/City'){
                    $branch_name = $branch_info->brgy;
                } else if($branch_info->area_of_operation == 'Provincial') {
                    $branch_name = $branch_info->city;
                } else if ($branch_info->area_of_operation == 'Regional') {
                    if($this->charter_model->in_charter_city($branch_info->cCode)){
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    } 
                } else if ($branch_info->area_of_operation == 'Interregional') {
                    if($this->charter_model->in_charter_city($branch_info->cCode)){
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    } 
                } else if ($branch_info->area_of_operation == 'National') {
                    if($this->charter_model->in_charter_city($branch_info->cCode)){
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    } 
                }
            ?>
		<td style="text-align: center; font-size: 20pt;"><b><?=$branch_name.' '.$branch_info->branchName.$certOffice?></b></td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<?php
			if($branch_info->house_blk_no == "" && $branch_info->street == ""){
				$branchnostreet = '';
			} else {
				$branchnostreet = $branch_info->house_blk_no.' '.$branch_info->street.$x;
			}
		?>
		<td style="text-align: justify;">with address at <b><?= ucwords($branch_info->noStreet)?> <?= ucwords($branch_info->st).$x?> <?= $branch_info->brg?> <?= $branch_info->municipality?>, <?= $branch_info->provins?>, <?= $branch_info->regun?></b>, to confirm the establishment of a <?=$typ ?> at <b><?=$branchnostreet?> <?= $branch_info->brgy?> <?= $branch_info->city?>, <?= $branch_info->province?>, <?= $branch_info->region?></b> were presented for approval of the Authority on <b><?=date("F d, Y", strtotime($branch_info->date_approved_director)); ?></b> and that after having complied with the requirements under MC No. <?=$mcno?> dated <?=$mcdated?> is hereby <b>APPROVED</b>.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: justify; ; text-indent: 40px;">This <?=$certLabel?> is hereby issued to enable the Cooperative to operate the new <?=$typ ?> pursuant to the pertinent Circular thereto and the powers of the Authority under <b>RA 11364</b>.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: justify; text-indent: 40px;">Given in Quezon City, Philippines, this <b><?=date("F d, Y", strtotime($branch_info->date_of_or)); ?></b>.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
</table>

<table width="100%"> 
	<tr>
		<td><i style="color:white;">....</i></td>
		<td width="50%"></td>
	</tr>
	<tr>
		<td rowspan="2"></td>
		<!-- <td style="text-align: center;padding-left:150px;"> 	
			<img src="<?=APPPATH?><?=$signature?>" style="width:270px;height:100px;">
			<div class="text" style="margin-top:-92px;">
				<p><?= $chair ?></p>
				<p style="margin-top:-20px;">Chairman</p>
			</div>
		</td> -->

	</tr>
	
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
</table>

<div style="padding-top:-130px;padding-left:425px;float:left;">
	<img src="<?=APPPATH?><?=$signature?>" style="width:270px;height:100px;">
</div>
<div class="text" style="padding-top: -80px;width:400px;padding-left:500px;float:left;">
	<p style="font-size:16px;padding:0px;"><?= $chair ?></p>
	<p style="font-size:12px;margin-top:-20px;padding-left:50px">Chairman</p>
</div>

<table width="100%" style="margin-top:<?=($branch_info->type=="Branch" ? '20px' :'0px')?>;">
	<tr>
		<td style="text-align:right;padding-right:45px;">
			<img src="<?=QRCODE_DIR.$branch_info->certNo?>.png" width="100" height="100" style="float-right;"/>
		</td>
	</tr>
</table>
</div>
<!-- END OF PAGE 1 -->

<!-- START PAGE 2 -->
<div class="page_break" style="height: 1060px;border: 10px black double; border-radius: 30px;padding:20px;">
	<table width=100%>
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda.png" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>

<br/><br/>
<table width=100% style="background-image: url(<?=base_url();?>/assets/img/cda4.png); background-repeat: no-repeat; background-position: center;opacity: 0.2;">
	<tr>
		<td style="text-align: right; font-size: 12pt"><b><?= $certLabel?> of Authority No: <?= $branch_info->certNo ?></b></td>
	</tr>
	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		<td style="color: white; background-color: #0000FF; text-align: center; font-size: 20pt"><?=$certTitle?></td>
	</tr>
	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		<td style="font-weight: bold; font-size: 10pt">TO ALL WHOM THESE PRESENTS MAY COME:<br/></td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: justify; text-indent: 40px;">By the virtue of the authority vested in me by law, I hereby certify that the application of the:</td>
	</tr>
	<!-- <tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: center; font-size: 20pt;"><b><?= $branch_info->coopName?></b></td>
	</tr>
	<tr>
		<td style="text-align: center; font-size: 9pt;"><?= $branch_info->regNo?></td>
	</tr>
	<tr>
		<td style="text-align: center; font-size: 20pt;"><b><?= $branch_info->branchName.$certOffice?></b></td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr> -->

		<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: center; font-size: 20pt;"><b><?= $branch_info->coopName?></b></td>
	</tr>
	<tr>
		<td style="text-align: center; font-size: 9pt;"><?= $branch_info->regNo?></td>
	</tr>
	<tr>
            <?php if($branch_info->area_of_operation == 'Barangay' || $branch_info->area_of_operation == 'Municipality/City'){
                    $branch_name = $branch_info->brgy;
                } else if($branch_info->area_of_operation == 'Provincial') {
                    $branch_name = $branch_info->city;
                } else if ($branch_info->area_of_operation == 'Regional') {
                    if($this->charter_model->in_charter_city($branch_info->cCode)){
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    } 
                } else if ($branch_info->area_of_operation == 'Interregional') {
                    if($this->charter_model->in_charter_city($branch_info->cCode)){
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    } 
                } else if ($branch_info->area_of_operation == 'National') {
                    if($this->charter_model->in_charter_city($branch_info->cCode)){
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    } 
                }
            ?>
		<td style="text-align: center; font-size: 20pt;"><b><?=$branch_name.' '.$branch_info->branchName.$certOffice?></b></td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td style="text-align: justify;">with address at <b><?= ucwords($branch_info->noStreet)?> <?= ucwords($branch_info->st).$x?> <?= $branch_info->brg?> <?= $branch_info->municipality?>, <?= $branch_info->provins?>, <?= $branch_info->regun?></b>, to confirm the establishment of a <?=$typ ?> at <b><?=$branchnostreet?> <?= $branch_info->brgy?> <?= $branch_info->city?>, <?= $branch_info->province?>, <?= $branch_info->region?></b> were presented for approval of the Authority on <b><?=date("F d, Y", strtotime($branch_info->date_approved_director)); ?></b> and that after having complied with the requirements under MC No. <?=$mcno?> dated <?=$mcdated?> is hereby <b>APPROVED</b>.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: justify; ; text-indent: 40px;">This <?=$certLabel?> is hereby issued to enable the Cooperative to operate the new <?=$typ ?> pursuant to the pertinent Circular thereto and the powers of the Authority under <b>RA 11364</b>.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: justify; text-indent: 40px;">Given in Quezon City, Philippines, this <b><?=date("F d, Y", strtotime($branch_info->date_of_or)); ?></b>.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td><i style="color:white;">....</i></td>
		<td width="50%"></td>
	</tr>
	<tr>
		<td rowspan="2"></td>
		<!-- <td style="text-align: center;padding-left:150px;"> 	
			<img src="<?=APPPATH?>../assets/img/1.png">
			<div class="text" style="margin-top:-92px;">
				<p><?= $chair ?></p>
				<p style="margin-top:-20px;">Chairman</p></div>
		</td> -->
	</tr>
	
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
</table>	

<div style="padding-top:-130px;padding-left:425px;float:left;">
	<img src="<?=APPPATH?><?=$signature?>" style="width:270px;height:100px;">
</div>
<div class="text" style="padding-top: -80px;width:400px;padding-left:500px;float:left;">
	<p style="font-size:16px;padding:0px;"><?= $chair ?></p>
	<p style="font-size:12px;margin-top:-20px;padding-left:50px">Chairman</p>
</div>

<table width="100%" style="margin-top:<?=($branch_info->type=="Branch" ? '10px':'-10px')?>;">
	<tr>
		<td style="text-align:right;padding-right:45px;">
			<img src="<?=QRCODE_DIR.$branch_info->certNo?>.png" width="100" height="100" style="float-right;"/>
		</td>
	</tr>
</table>
<i style="font-size: 10px">Duplicate Copy</i>
</div>
<!-- END OF PAGE 2 -->

<!-- START OF PAGE 3 -->
<div class="page_break" style="height: 1060px;border: 10px black double; border-radius: 30px;padding:20px;">
	<table width=100%>
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda.png" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<br/><br/>
<table width=100% style="background-image: url(<?=base_url();?>/assets/img/cda4.png); background-repeat: no-repeat; background-position: center;opacity: 0.2;">
	<tr>
		<td style="text-align: right; font-size: 12pt"><b><?= $certLabel?> of Authority No: <?= $branch_info->certNo ?></b></td>
	</tr>
	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		<td style="color: white; background-color: #0000FF; text-align: center; font-size: 20pt"><?=$certTitle?></td>
	</tr>
	<tr>
		<td><i style="color:white; font-size: 8pt">....</i></td>
	</tr>
	<tr>
		<td style="font-weight: bold; font-size: 10pt">TO ALL WHOM THESE PRESENTS MAY COME,<br/></td>
	</tr>
	<tr>
		<td><i style="color:white; font-size: 10pt">....</i></td>
	</tr>
	<tr>
		<td style="text-align: justify; text-indent: 40px;">By the virtue of the authority vested in me by law, I hereby certify that the application of the:</td>
	</tr>
	<!-- <tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: center; font-size: 20pt;"><b><?= $branch_info->coopName?></b></td>
	</tr>
	<tr>
		<td style="text-align: center; font-size: 9pt;"><?= $branch_info->regNo?></td>
	</tr>
	<tr>
		<td style="text-align: center; font-size: 20pt;"><b><?= $branch_info->branchName.$certOffice?></b></td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr> -->

		<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: center; font-size: 20pt;"><b><?= $branch_info->coopName?></b></td>
	</tr>
	<tr>
		<td style="text-align: center; font-size: 9pt;"><?= $branch_info->regNo?></td>
	</tr>
	<tr>
            <?php if($branch_info->area_of_operation == 'Barangay' || $branch_info->area_of_operation == 'Municipality/City'){
                    $branch_name = $branch_info->brgy;
                } else if($branch_info->area_of_operation == 'Provincial') {
                    $branch_name = $branch_info->city;
                } else if ($branch_info->area_of_operation == 'Regional') {
                    if($this->charter_model->in_charter_city($branch_info->cCode)){
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    } 
                } else if ($branch_info->area_of_operation == 'Interregional') {
                    if($this->charter_model->in_charter_city($branch_info->cCode)){
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    } 
                } else if ($branch_info->area_of_operation == 'National') {
                    if($this->charter_model->in_charter_city($branch_info->cCode)){
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    } 
                }
            ?>
		<td style="text-align: center; font-size: 20pt;"><b><?=$branch_name.' '.$branch_info->branchName.$certOffice?></b></td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: justify;">with address at <b><?= ucwords($branch_info->noStreet)?> <?= ucwords($branch_info->st).$x?> <?= $branch_info->brg?> <?= $branch_info->municipality?>, <?= $branch_info->provins?>, <?= $branch_info->regun?></b>, to confirm the establishment of a <?=$typ ?> at <b><?=$branchnostreet?> <?= $branch_info->brgy?> <?= $branch_info->city?>, <?= $branch_info->province?>, <?= $branch_info->region?></b> were presented for approval of the Authority on <b><?=date("F d, Y", strtotime($branch_info->date_approved_director)); ?></b> and that after having complied with the requirements under MC No. <?=$mcno?> dated <?=$mcdated?> is hereby <b>APPROVED</b>.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: justify; ; text-indent: 40px;">This <?=$certLabel?> is hereby issued to enable the Cooperative to operate the new <?=$typ ?> pursuant to the pertinent Circular thereto and the powers of the Authority under <b>RA 11364</b>.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
	<tr>
		<td style="text-align: justify; text-indent: 40px;">Given in Quezon City, Philippines, this <b><?=date("F d, Y", strtotime($branch_info->date_of_or)); ?></b>.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td><i style="color:white;">....</i></td>
		<td width="55%"></td>
	</tr>
	<tr>
		<td rowspan="2"></td>
		<!-- <td style="text-align: center;padding-left:150px;"> 	
			<img src="<?=APPPATH?>../assets/img/1.png">
			<div class="text" style="margin-top:-92px;">
				<p><?= $chair ?></p>
				<p style="margin-top:-20px;">Chairman</p></div>
		</td> -->
	</tr>
	
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>

	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
</table>

<div style="padding-top:-130px;padding-left:425px;float:left;">
	<img src="<?=APPPATH?><?=$signature?>" style="width:270px;height:100px;">
</div>
<div class="text" style="padding-top: -80px;width:400px;padding-left:500px;float:left;">
	<p style="font-size:16px;padding:0px;"><?= $chair ?></p>
	<p style="font-size:12px;margin-top:-20px;padding-left:50px">Chairman</p>
</div>

<table width="100%" style="margin-top:<?=$branch_info->type=="Branch" ? '10px':'-10px'?>;">
	<tr>
		<td style="text-align:right;padding-right:45px;">
			<img src="<?=QRCODE_DIR?><?= $branch_info->certNo ?>.png" width="100" height="100" style="float-right;"/>
		</td>
	</tr>
</table>
<i style="font-size: 10px">Triplicate Copy</i>
</div>
</body>