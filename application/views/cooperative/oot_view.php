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
  <link rel="icon" href="<?=APPPATH?>../assets/img/cda_new.jpg" type="image/jpg">
  <style>
  @page{margin: 60px 40px 30px 40px;}
  /*.page_break { page-break-before: always; }*/
    body{font-family:Bookman Old Style !important; line-height: 20px;}

    .center {
      text-align:center;
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 115%;
      height: 30%;
      margin-left:-7.5%;
      margin-top: -6.8%;
    }
    .center_footer {
    	position: fixed !important;
      text-align:center;
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 115%;
      height: 30%;
      margin-left:-7.5%;
      margin-top: 93%;
    }
    sup {
      vertical-align: sup;
      font-size: 6pt;
      line-height: 12pt;
    }
  </style>
</head> 
<body>
    <img class="center" src="<?=APPPATH?>../assets/img/header_ooc.png" style="background-repeat: no-repeat; background-position: center;"><br><br><br><br><br><br>
  	<div class="row">
  		<div class="col-md-4">
  		</div>
  		<div class="col-md-4">
  			<center><b>ORDER OF TRANSFER</b></center>
  		</div>
  		<div class="col-md-4">
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-md-4">
  		</div>
  		<div class="col-md-4">
  			<center>(of <?=$branch_info->region?> Branch Office)</center>
  		</div>
  		<div class="col-md-4">
  		</div>
  	</div><br><br>

	<table width=100%>
		<tr>
			<?php if($branch_info_region_trans->transferred_street==null) $x=''; else $x=', ';?>
			<?php $dateReg = substr($branch_info->rdr,0,4).'-'.substr($branch_info->rdr,5,2).'-'.substr($branch_info->rdr,8,2);

			 $orgDate = substr($branch_info->rdr,6,4).'-'.substr($branch_info->rdr,0,2).'-'.substr($branch_info->rdr,3,2);  
    		$newDate = date("F d, Y", strtotime($orgDate));  

			?>
			<td colspan="2" style="text-align: justify !important; text-indent: 40px;"><b>WHEREAS, </b>the <?=$branch_info->coopName?> with registered principal office address at <?= ucwords($branch_info->noStreet)?> <?=$x?> <?= $branch_info->brgy?>, <?=$branch_info->city.', '.$branch_info->province?>, <?= $branch_info->region?> is a registered cooperative organization pursuant to the provisions of RA 9520 under Certificate of Registration No. <?=$branch_info->regNo?> dated <?=$newDate?>.</td>
		</tr>
		<tr>
			<td><i style="color:white;">....</i></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: justify !important; text-indent: 40px;"><b>WHEREAS, </b>this cooperative applied for and was issued Letter of Authority No. <?=$branch_info->certNo?> for the establishment of a <?=$branch_info->type?> Office at <?= ucwords($branch_info_region_trans->transferred_street)?> <?= ucwords($branch_info_region_trans->transferred_street).$x?> <?= $branch_info_region_trans->brgy?> <?= $branch_info_region_trans->city?>, <?= $branch_info_region_trans->province?>, <?= $branch_info_region_trans->region?>  dated <?=date("F d, Y", strtotime($branch_info->dateRegistered)); ?>.</td>
		</tr>
		<tr>
			<td><i style="color:white;">....</i></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: justify !important; text-indent: 40px;"><b>WHEREAS, </b>this cooperative applied for transfer of Branch Office to <?= ucwords($branch_info_region_trans->transferred_street)?> <?= ucwords($branch_info_region_trans->transferred_street).$x?> <?= $branch_info_region_trans->brgy?> <?= $branch_info_region_trans->city?>, <?= $branch_info_region_trans->province?>, <?= $branch_info_region_trans->region?>.</td>
		</tr>
		<tr>
			<td><i style="color:white;">....</i></td>
		</tr>
		<tr>
			<td><i style="color:white;">....</i></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: justify !important; text-indent: 40px;"><b>WHEREAS, </b><?=$branch_info->reason?>.</td>
		</tr>
		<tr>
			<td><i style="color:white;">....</i></td>
		</tr>
		<?php 
			if($branch_info->area_of_operation == 'Barangay' || $branch_info->area_of_operation == 'Municipality/City'){
          $brancharea = $branch_info->brgy;
      } else if($branch_info->area_of_operation == 'Provincial') {
          $brancharea = $branch_info->city;
      } else if ($branch_info->area_of_operation == 'Regional') {
          if($this->charter_model->in_charter_city($branch_info->cCode)){
            $brancharea = $branch_info->city;
          } else {
            $brancharea = $branch_info->city.', '.$branch_info->province;
          }
      } else if ($branch_info->area_of_operation == 'Interregional') {
          if($this->charter_model->in_charter_city($branch_info->cCode)){
            $brancharea = $branch_info->city;
          } else {
            $brancharea = $branch_info->city.', '.$branch_info->province;
          }
      }else if ($branch_info->area_of_operation == 'National') {
          if($this->charter_model->in_charter_city($branch_info->cCode)){
            $brancharea = $branch_info->city;
          } else {
            $brancharea = $branch_info->city.', '.$branch_info->province;
          }
      }
		?>
		<tr>
			<td colspan="2" style="text-align: justify !important; text-indent: 40px;"><b>NOW, THEREFORE</b>, by virtue of the powers and duties vested in me by law, I hereby Order the Transfer of <?=$brancharea?> <?=$branch_info->type?> Office of the <?=$branch_info->coopName?> and the Cancellation of the Letter of Authority under <?=$branch_info->certNo?> dated <?=date("F d, Y", strtotime($branch_info->date_transferred)); ?>.</td>
		</tr>
		<tr>
			<td><i style="color:white;">....</i></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: justify !important; text-indent: 40px;">Done this <?=date("F d, Y", strtotime($branch_info->ok_for_transfer)); ?> in Quezon City, Metro Manila, Philippines.</td>
		</tr>
		<tr>
			<td><i style="color:white;">....</i></td>
		</tr>
		<tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	</table>
	<table width=100%>
		<tr>
			<td><i style="color:white;">....</i></td>
			<td><i style="color:white;">....</i></td>
			<td><i style="color:white;">....</i></td>
			<td><i style="color:white;">....</i></td><td><i style="color:white;">....</i></td>
			<td><center><b><?=$director?></b><br><i>Regional Director/Executive Director</i></center></td>
		</tr>
	</table>
	<img class="center_footer" src="<?=APPPATH?>../assets/img/footer_ooc.png" style="background-repeat: no-repeat; background-position: center;">
	<!-- <div class="page_break">
	</div> -->
</body>
