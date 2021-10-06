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
		<!-- 	<td><img src="<?=APPPATH?>../assets/img/cda4.png" width="100" height="100" ></td> -->
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda_new.jpg" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
	<table width=100%  style="background: url(<?=base_url();?>/assets/img/cda4.png); background-repeat: no-repeat; background-position: center;margin-top:-30px;padding-bottom: 60px;opacity: 0.2;">
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
	            <td style="color: white; background-color: #003399; text-align: center; font-size: 15pt">CERTIFICATE OF REGISTRATION<br>OF<br>AMENDMENTS TO THE<br>ARTICLES OF COOPERATION AND BY LAWS</td>
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
			<?php
				$artilces_array = array($typeOfcoop,
									    $proposeName,
									    $acronym_c,
									    $common_bond,
									    $areaOf_operation,
									    $fieldOfmemship,
									    $address1,
									    $authorized_share_capital,
											$common_share,
											$preferred_share,
											$par_value,
											$authorized_share_capital,
											$total_amount_of_subscribed_capital,
											// $amount_of_common_share_subscribed,
											$amount_of_preferred_share_subscribed,
											$total_amount_of_paid_up_capital,
											// $amount_of_common_share_paidup,
											$amount_of_preferred_share_paidup,
											$purposes,
											$no_of_bod
							       );
				// echo "<pre>";print_r($artilces_array);echo"</pre>";
				$bylaws_array = array(
							      $no_of_bod,
							      $kinds_of_members,
					          $additional_requirements_for_membership,
					          $regular_qualifications,
					          $associate_qualifications, 
					          $membership_fee,
					          $act_upon_membership_days,
					          $additional_conditions_to_vote,  
					          $annual_regular_meeting_day, 
					          // $annual_regular_meeting_day_date,
					          // $annual_regular_meeting_day_venue, 
					          $members_percent_quorom,
					          $number_of_absences_disqualification,
					          $percent_of_absences_all_meettings, 
					          $director_hold_term,
					          $member_invest_per_month, 
					          $member_percentage_annual_interest, 
					          $member_percentage_service, 
					          $percent_reserve_fund, 
					          $percent_education_fund, 
					          $percent_community_fund,
					          $percent_optional_fund, 
					          $non_member_patron_years, 
					          $amendment_votes_members_with,
					          $minimum_subscribed_share_regular, 
					          $minimum_paid_up_share_regular, 
					          $minimum_subscribed_share_associate,
					          $minimum_paid_up_share_associate,
					          $committees_others 
				);
				// echo "<pre>";print_r($bylaws_array);echo"</pre>";
				$and = '';
				$and2='';
				$bylaws = false;
				$articles = false;
					if(in_array('true',$bylaws_array))
					{
						$bylaws = true;
					}
					if(in_array('true',$artilces_array))
					{
						$articles = true;
					}
				
					if($articles && $bylaws)
					{
						$and=' AND ';
						$and2=' and ';
					}
			?>

			<?php

			$street='';
			if(strlen($coop_info->street)>0)
			{
				$street=' '.$coop_info->street;
			}
			?>
			<td style="text-align: justify; text-indent: 40px;">This is to certify that the proposed amendments to the <?php if($articles){?><b>ARTICLES OF COOPERATION</b><?php }?><?=$and;?><?php if($bylaws){?><b>BY LAWS</b><?php }?> of the
	                <b><?=$coop_info->coopName?></b>, with office address at <?= $coop_info->house_blk_no.$street.' '.$coop_info->brgy?>, <?= $coop_info->city?>, <?= $coop_info->province?> adopted in its <b><?=$bylaw_info->type?></b> Annual
	                    General Assembly meeting held at <b><?=$coop_info->ga_venue?></b> on <b><?=date('F d, Y', strtotime($bylaw_info->annual_regular_meeting_day_date))?></b> were
	                    submitted to the Cooperative Development Authority (CDA) for registration pursuant to the provisions of Republic Act No. 9520.</td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	    <tr>
			<td style="text-align: justify; text-indent: 40px;">The attached amended <?php if($articles){echo'Articles of Cooperation consisting of '; if(isset($articles_pages)){echo'<b>'.$articles_pages->total_pages.'</b> pages';}else{echo'<small style="color:red">Please generate articles of cooperation document to get the total number pages</small>';}}?><?=$and2?><?php if($bylaws){echo'By Laws consisting of ';if(isset($bylaws_pages->total_pages)){echo'<b>'.$bylaws_pages->total_pages.'</b> pages';}else{echo'<small style="color:red">Please generate bylaws document to get the total number of pages</small>';}}?>, being not contrary
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

	<table width="100%" style="margin-top:40px;">
		<tr>
			<td style="text-align:right;padding-right:45px;">
				<img src="<?=QRCODE_DIR?><?= $coop_info->qr_code?>" width="100" height="100" style="float: right;margin-top: 970px;position:fixed;"/>
			</td>
		</tr>
		
	</table>

<!-- <i style="font-size: 10px"><?=date('Y/m/d');?></i> -->
</div>

<!-- START 2ND PAGE -->
	<div  style="height: 1060px;border: 10px black double; border-radius: 30px; padding: 20px">
	<table width="100%">
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda_new.jpg" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
	<table width=100%  style="background: url(<?=base_url();?>/assets/img/cda4.png); background-repeat: no-repeat; background-position: center;margin-top:-30px;padding-bottom: 60px;opacity: 0.2;">
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
			<td style="text-align: justify; text-indent: 40px;">This is to certify that the proposed amendments to the <?php if($articles){?><b>ARTICLES OF COOPERATION</b><?php }?><?=$and;?><?php if($bylaws){?><b>BY LAWS</b><?php }?> of the
	                 <b><?=$coop_info->coopName?></b>, with office address at <?= $coop_info->house_blk_no.$street.' '.$coop_info->brgy?>, <?= $coop_info->city?>, <?= $coop_info->province?> adopted in its <b><?=$bylaw_info->type?></b> Annual
	                    General Assembly meeting held at <b><?=$coop_info->ga_venue?></b> on <b><?=date('F d, Y', strtotime($bylaw_info->annual_regular_meeting_day_date))?></b> were
	                    submitted to the Cooperative Development Authority (CDA) for registration pursuant to the provisions of Republic Act No. 9520.</td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	    <tr>
			<td style="text-align: justify; text-indent: 40px;">The attached amended <?php if($articles){echo'Articles of Cooperation consisting of '; if(isset($articles_pages)){echo'<b>'.$articles_pages->total_pages.'</b> pages';}else{echo'<small style="color:red">Please generate articles of cooperation document to get the total number pages</small>';}}?><?=$and2?><?php if($bylaws){echo'By Laws consisting of ';if(isset($bylaws_pages->total_pages)){echo'<b>'.$bylaws_pages->total_pages.'</b> pages';}else{echo'<small style="color:red">Please generate bylaws document to get the total number of pages</small>';}}?>, being not contrary
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
	
	<table width="100%" style="margin-top:40px;position: fixed;">
		<tr>
			<td style="text-align:right;padding-right:45px;">
				<img src="<?=QRCODE_DIR?><?= $coop_info->qr_code?>" width="100" height="100" style="float: right;margin-top: 970px;position:fixed;"/>
			</td>
		</tr>
	</table>


	

<!-- <i style="font-size: 10px"><?=date('Y/m/d');?></i> -->
<table width="100%" style="margin-left: 35px;margin-top:1080px;position: fixed;width:100%;">
		<tr>
			<td>
				<i style="font-size: 10px;">Duplicate Copy</i>
			</td>
		</tr>
	</table>


</div>

<!-- END 2ND PAGE -->

<!-- START 3RD PAGE -->
	<!-- START 2ND PAGE -->
	<div  style="height: 1060px;border: 10px black double; border-radius: 30px; padding: 20px">
	<table width="100%">
		<tr>
			<td width="7%"><i style="color:white;">....</i></td>
			<td width="15%"><img src="<?=APPPATH?>../assets/img/cda_new.jpg" width="100" height="100" ></td>
			<td style="text-align: center"><b>Republic of the Philippines<br/>COOPERATIVE DEVELOPMENT AUTHORITY</b></td>
			<td width="18%"><i style="color:white;">....</i></td>
		</tr>
	</table>
<?php if($coop_info->noStreet==null && $coop_info->Street==null) $x=''; else $x=', ';?>
<br/><br/>
	<table width=100%  style="background: url(<?=base_url();?>/assets/img/cda4.png); background-repeat: no-repeat; background-position: center;margin-top:-30px;padding-bottom: 60px;opacity: 0.2;">
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
			<td style="text-align: justify; text-indent: 40px;">This is to certify that the proposed amendments to the <?php if($articles){?><b>ARTICLES OF COOPERATION</b><?php }?><?=$and;?><?php if($bylaws){?><b>BY LAWS</b><?php }?> of the
	                 <b><?=$coop_info->coopName?></b>, with office address at <?= $coop_info->house_blk_no.$street.' '.$coop_info->brgy?>, <?= $coop_info->city?>, <?= $coop_info->province?> adopted in its <b><?=$bylaw_info->type?></b> Annual
	                    General Assembly meeting held at <b><?=$coop_info->ga_venue?></b> on <b><?=date('F d, Y', strtotime($bylaw_info->annual_regular_meeting_day_date))?></b> were
	                    submitted to the Cooperative Development Authority (CDA) for registration pursuant to the provisions of Republic Act No. 9520.</td>
		</tr>
	        <tr>
			<td><i style="color:white;">....</i></td>
		</tr>
	    <tr>
			<td style="text-align: justify; text-indent: 40px;">The attached amended <?php if($articles){echo'Articles of Cooperation consisting of '; if(isset($articles_pages)){echo'<b>'.$articles_pages->total_pages.'</b> pages';}else{echo'<small style="color:red">Please generate articles of cooperation document to get the total number of pages</small>';}}?><?=$and2?><?php if($bylaws){echo'By Laws consisting of ';if(isset($bylaws_pages->total_pages)){echo'<b>'.$bylaws_pages->total_pages.'</b> pages';}else{echo'<small style="color:red">Please generate bylaws document to get the total number of  pages</small>';}}?>, being not contrary
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
	
	<table width="100%" style="margin-top:40px;position: fixed;">
		<tr>
			<td style="text-align:right;padding-right:45px;">
				<img src="<?=QRCODE_DIR?><?= $coop_info->qr_code?>" width="100" height="100" style="float: right;margin-top: 970px;position:fixed;"/>
			</td>
		</tr>
	</table>


	

<!-- <i style="font-size: 10px"><?=date('Y/m/d');?></i> -->
<table width="100%" style="margin-left: 35px;margin-top:1080px;position: fixed;width:100%;">
		<tr>
			<td>
				<i style="font-size: 10px;">Triplicate Copy</i>
			</td>
		</tr>
	</table>


</div>
<!-- END 3RD PAGE -->
</body>