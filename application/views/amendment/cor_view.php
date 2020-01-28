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
  <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
  <link rel="icon" href="<?=base_url();?>assets/img/cda.png" type="image/png">
  <link rel="icon" href="<?=base_url();?>assets/img/chairman.png" type="image/png">
  <style>
  @page{margin: 60px 60px 108px 60px;}
  .page_break { page-break-before: always; }
  
  </style>
</head>
<body>
	<div  style="border: 10px black double; border-radius: 30px; padding: 20px">
	<table width=100%>
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=base_url();?>/assets/img/cda.png" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>OFFICE OF THE PRESIDENT<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
<table width=100% style="background-image: url(<?=base_url();?>/assets/img/cda3.png); background-repeat: no-repeat; background-position: center;">
	<tr>
		<td style="text-align: right; font-size: 12pt"><b>Registration No: <?= $coop_info->regNo ?></b></td>
	</tr>
        <tr>
		<td style="text-align: right; font-size: 12pt"><b>Amendment No: <?= $coop_info->amendmentNo ?></b></td>
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
		<td style="text-align: justify; text-indent: 40px;">This is to certify that the proposed amendments to the <b> ARTICLES OF COOPERATION AND BYLAWS of the
                <?=$amend_coop_info->proposed_name?>, with office address at <?= $coop_info->brgy?>, <?= $coop_info->city?>, <?= $coop_info->province?> adopted in its <b>REGULAR</b> Annual
                    General Assembly meeting held at <?=$bylaw_info->annual_regular_meeting_day_venue?> on <b><?=date('F d, Y', strtotime($bylaw_info->annual_regular_meeting_day_date))?></b> were
                    submitted to the Cooperative Development Authority (CDA) for registration pursuant to the provisions of Republic Act No. 9520.</td>
	</tr>
        <tr>
		<td><i style="color:white;">....</i></td>
	</tr>
        <tr>
		<td style="text-align: justify; text-indent: 40px;">The attached amended Articles of Cooperation consisting of <b>21</b> pages and By-Laws consisting of <b>22</b> pages, being not contrary
                to the provisions of RA 9520 and the rules and regulations prescribed by the CDA, are hereby approved and registered.</td>
	</tr>
        <tr>
		<td><i style="color:white;">....</i></td>
	</tr>
        <tr>
		<td style="text-align: justify; text-indent: 40px;"><b>IN WITNESS WHEREOF, by virtue of the powers vested in me by law, I have hereunto set my hand and cause the seal of Authority to be affixed 
                        this <b>9th day of August, 2019 at Quezon City,</b> Philippines.</td>
	</tr>
	<tr>
		<td><i style="color:white;">....</i></td>
	</tr>
        <tr>
		<td><i style="color:white;">....</i></td>
	</tr>
        <tr>
		<td style="text-align:right;"><img src="<?=base_url();?>/assets/img/chairman.png" width="240" height="150" ></td>
	</tr>
</table>

<i style="font-size: 10px"><?=date('Y/m/d');?></i>
</body>