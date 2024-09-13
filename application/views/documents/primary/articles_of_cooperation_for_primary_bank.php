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
  <link rel="stylesheet" href="<?=APPPATH?>../assets/css/bootstrap.min.css">
  <link rel="icon" href="<?=base_url();?>assets/img/cda.png" type="image/png">
  <link rel="shortcut/icon" href="<?=base_url();?>assets/img/cda.png" type="image/png">
  <style>
  @page{margin: 96px 96px 70px 96px;}
  .page_break { page-break-before: always; }
  table, th, td {
    border: 0.5px solid #000 !important; 
    border-collapse: collapse;
  }
  body{
        font-family: 'Bookman Old Style',arial !important;font-size:12px;
    }
  </style>

</head>
<body style="font-size:12">
  <script type="text/php">
        if ( isset($pdf) ) {

            $x = 570; 
            $y=900;
            $text = "{PAGE_NUM}";//" of {PAGE_COUNT}";
            $font = '';
            $size = 12;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
            
        }

</script>

<div class="container-fluid text-monospace">

  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-center"> 


        <p class="font-weight-bold">ARTICLES OF COOPERATION<br>of<br><?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?> <?= $coop_info->grouping?></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">

        <p class="font-weight-bold">KNOW ALL MEN BY THESE PRESENTS:</p>
    </div>
  </div>
  <div class="row mb-2 ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-normal" style="text-indent: 50px;">THAT WE, the undersigned, Filipinos of legal age and residents of the Philippines, duly authorized to represent our respective cooperative organizations, have this day voluntarily associated ourselves together for the purpose of forming a (secondary/tertiary) Cooperative Bank under the laws of the Philippines, primarily Republic Act (RA) No. 9520 or the Philippine Cooperative Code of 2008.</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-bold">AND WE HEREBY CERTIFY:</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article I<br>Name of the Cooperative Bank</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify" style="text-indent: 50px;">That the name of the bank shall be the <?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?></p>
    </div>
  </div>
  <div class="row  mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article II<br>Purpose and Scope of Business</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify" style="text-indent: 50px;">That the purpose and scope of business for which the Cooperative Bank is formed are: </p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
        <ol class="text-justify" type="1">
    			<?php foreach($purposes_list as $purpose) :?>
            <li><?=$purpose?></li>
          <?php endforeach; ?>
    		</ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article III<br>Term of Existence</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the term of existence of the Cooperative Bank is <?= ucwords(num_format_custom($article_info->years_of_existence))?> (<?= $article_info->years_of_existence?>) years from the date of registration.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article IV<br>Area of Operation and Postal Address of Principal Office</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That this Cooperative Bank shall conduct its business and admit members from
       <?php if($coop_info->area_of_operation=="Barangay"){ ?>

         <?= ($in_chartered_cities ? $coop_info->brgy.' '.$chartered_cities.' '.$coop_info->region : $coop_info->brgy.' '.$coop_info->city.' '.$coop_info->province.' '.$coop_info->region)?>
       <?php }else if($coop_info->area_of_operation=="Municipality/City"){ ?>
         <?=($in_chartered_cities ? $chartered_cities.' '.$coop_info->region : $coop_info->city.' '.$coop_info->province.' '.$coop_info->region)?>
      <?php }else if($coop_info->area_of_operation=="Provincial"){
         echo $coop_info->province.' '.$coop_info->region;
       }else if($coop_info->area_of_operation=="Regional"){
         echo $coop_info->region;
       }else{
        if($coop_info->area_of_operation=="Interregional"){
          $region_array = array();

          foreach ($regions_island_list as $region_island_list){
            array_push($region_array, $region_island_list['regDesc']);
          }
          // echo implode(", ", $region_array);
          $last  = array_slice($region_array, -1);
          $first = join(', ', array_slice($region_array, 0, -1));
          $both  = array_filter(array_merge(array($first), $last), 'strlen');
          echo join(' and ', $both);
        } else {
         echo "Philippines";
        }
       }
       ?>and its principal office shall be located in <?php if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';?><?=$coop_info->house_blk_no?> <?=ucwords($coop_info->street).$x?> <?=$coop_info->brgy?> <?=($in_chartered_cities ? $chartered_cities : $coop_info->city.', '.$coop_info->province)?> <?=$coop_info->region?>.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport' && $created_at >= $effectivity_date){ echo 'Article IX'; } else { echo 'Article V'; }?><br>Cooperators</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the names and addresses of the cooperators which are regular members/common shareholders (cooperators) of the Cooperative Bank, and the names, and addresses of their authorized representatives, are as follows:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th>Name</th>
              <th>Postal Address</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($cooperators_list_board as $cooperator) :?>
              <?=$count++;?>
              <?php
              $in_chartered_cities_cptr =false;
                              if($this->charter_model->in_charter_city($cooperator['cCode']))
                              {
                              $in_chartered_cities_cptr=true;
                              $chartered_cities_cptr =$this->charter_model->get_charter_city($cooperator['cCode']);
                              }
              ?>                
              <tr>
                <td><b><?=$count.'. '.$cooperator['full_name']?></b></td>
                <td><?php if($cooperator['house_blk_no']==null && $cooperator['streetName']==null) $x=''; else $x=', '; ?><?=$cooperator['house_blk_no'].' '.$cooperator['streetName'].$x.$cooperator['brgy'].', ';?> <?=($in_chartered_cities_cptr ? $chartered_cities_cptr : $cooperator['city'].', '.$cooperator['province'])?></td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VI<br>Common Bond and Field  of Membership</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the regular members of the Cooperative Bank are cooperative organizations duly registered with the Cooperative Development Authority (CDA).</p>
      <p class="text-justify" style="text-indent: 50px;">The common bond shall be open to all cooperatives regardless of categories (primary, secondary, tertiary) and individuals who are members of duly registered cooperatives and other institutions with cooperative programs.</p>
    </div>
  </div>
  <?php 
    $created_at = date('Y-m-d',strtotime($coop_info->created_at));
    $effectivity_date = date('2021-03-01');

    if($coop_info->type_of_cooperative == 'Transport' && $created_at >= $effectivity_date){?>
    <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VIII<br>Business Operation</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the business operation of the transport cooperative shall be based on the routes or whatever stated in the duly approved franchise/Certificate of Public Convenience and Necessity, issued by the concerned government agency.</p>
    </div>
  </div>
  <?php } ?>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport' && $created_at >= $effectivity_date){ echo 'Article X'; } else { echo 'Article VII'; }?><br>Board of Directors</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the names, nationalities, and addresses of the Directors of the Cooperative Bank are as follows:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th class="text-center">Name</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($directors_list as $director) :?>
              <?=$count++;?>
            <tr>
              <td><?=$count.'. '.$director['full_name']?></td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport' && $created_at >= $effectivity_date){ echo 'Article XI'; } else { echo 'Article VIII'; }?><br>Capitalization</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p><b>Section 1. Authorized Share Capital</b></p>
      <p class="text-justify" style="text-indent: 50px;">That the authorized share capital of the Cooperative Bank is <?= ucwords(num_format_custom($capitalization_info->authorized_share_capital))?> Pesos (Php <?=number_format($capitalization_info->authorized_share_capital,2)?>), divided into: <?= ucwords(num_format_custom($capitalization_info->common_share))?> (<?= number_format($capitalization_info->common_share)?>) common shares with a par value of <?= ucwords(num_format_custom($capitalization_info->par_value))?> Pesos (<?=number_format($capitalization_info->par_value,2)?> ) per share. <?php if($bylaw_info->kinds_of_members == 2) :?>
        <?= ucwords(num_format_custom($capitalization_info->preferred_share))?> (<?= number_format($capitalization_info->preferred_share)?>) preferred shares with a par value of <?= ucwords(num_format_custom($capitalization_info->par_value))?> Pesos (<?=number_format($capitalization_info->par_value,2)?>) per share.
        <?php endif;?></p>
      <p><b>Section 2. Subscribed and Paid-Up Share Capital</b></p>
      <p class="text-justify" style="text-indent: 50px;">That the number and amount of subscribed capital is
        <?php echo ucwords(num_format_custom(($bylaw_info->kinds_of_members == 1) ? $total_regular['total_subscribed'] * $capitalization_info->par_value : ($total_regular['total_subscribed'] * $capitalization_info->par_value) + ($total_associate['total_subscribed'] * $capitalization_info->par_value))).' Pesos';?>
        (Php <?php echo ($bylaw_info->kinds_of_members == 1) ? number_format(($total_regular['total_subscribed'] * $capitalization_info->par_value),2) : number_format((($total_regular['total_subscribed'] * $capitalization_info->par_value) + ($total_associate['total_subscribed'] * $capitalization_info->par_value)),2);?>), and of paid-up capital is
        <?php echo ucwords(num_format_custom(($bylaw_info->kinds_of_members == 1) ? ($total_regular['total_paid'] * $capitalization_info->par_value) : ($total_regular['total_paid'] * $capitalization_info->par_value) + ($total_associate['total_paid'] * $capitalization_info->par_value))).' Pesos';?>
        (Php <?php echo ($bylaw_info->kinds_of_members == 1) ? number_format(($total_regular['total_paid'] * $capitalization_info->par_value),2) : number_format((($total_regular['total_paid'] * $capitalization_info->par_value) + ($total_associate['total_paid'] * $capitalization_info->par_value)),2);?>).</p>
        <p class="text-justify" style="text-indent: 50px;">That the summary of the subscribed and paid-up shares is as follows:</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 40px;"><strong>A.</strong> Common Share</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th class="text-center">Names</th>
              <th class="text-center">No. of  Subscribed Shares</th>
              <th class="text-center">Amount of Subscribed Shares</th>
              <th class="text-center">No. of Paidup Shares</th>
              <th class="text-center">Amount of Paidup Shares</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($regular_cooperator_list as $regular) : ?>
              <?php $count++; ?>
            <tr>
              <td><?=$count.'. '. $regular['full_name']?></td>
              <td style="text-align: center;"><?= $regular['number_of_subscribed_shares']?></td>
              <td style="text-align: right;"><?= number_format(($regular['number_of_subscribed_shares'] * $capitalization_info->par_value),2)?></td>
              <td style="text-align: center;"><?= $regular['number_of_paid_up_shares']?></td>
              <td style="text-align: right;"><?= number_format(($regular['number_of_paid_up_shares'] * $capitalization_info->par_value),2)?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td>Total</td>
              <td style="text-align: center;"><?= $total_regular['total_subscribed']?></td>
              <td style="text-align: right;"><?= number_format(($total_regular['total_subscribed'] * $capitalization_info->par_value),2)?></td>
              <td style="text-align: center;"><?= $total_regular['total_paid'] ?></td>
              <td style="text-align: right;"><?= number_format(($total_regular['total_paid'] * $capitalization_info->par_value),2)?></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <?php if($bylaw_info->kinds_of_members == 2) :?>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 40px;"><strong>B.</strong> Preferred Share</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 ">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th class="text-center">Names</th>
              <th class="text-center">No. of  Subscribed Shares</th>
              <th class="text-center">Amount of Subscribed Shares</th>
              <th class="text-center">No. of Paidup Shares</th>
              <th class="text-center">Amount of Paidup Shares</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($associate_cooperator_list as $associate) : ?>
              <?=$count++;?>
            <tr>
              <td><?=$count.'. '. $associate['full_name']?></td>
              <td style="text-align: center;"><?= $associate['number_of_subscribed_shares']?></td>
              <td style="text-align: right;"><?= number_format(($associate['number_of_subscribed_shares'] * $capitalization_info->par_value),2)?></td>
              <td style="text-align: center;"><?= $associate['number_of_paid_up_shares']?></td>
              <td style="text-align: right;"><?= number_format(($associate['number_of_paid_up_shares'] * $capitalization_info->par_value),2)?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td>Total</td>
              <td style="text-align: center;"><?= $total_associate['total_subscribed']?></td>
              <td style="text-align: right;"><?= number_format(($total_associate['total_subscribed'] * $capitalization_info->par_value),2)?></td>
              <td style="text-align: center;"><?= $total_associate['total_paid'] ?></td>
              <td style="text-align: right;"><?= number_format(($total_associate['total_paid'] * $capitalization_info->par_value),2)?></td>
            </tr>
            <tr>
              <td>Grand Total</td>
              <td style="text-align: center;"><?= $total_regular['total_subscribed'] + $total_associate['total_subscribed']?></td>
              <td style="text-align: right;"><?= number_format((($total_regular['total_subscribed'] * $capitalization_info->par_value) + ($total_associate['total_subscribed'] * $capitalization_info->par_value)),2)?></td>
              <td style="text-align: center;"><?= $total_regular['total_paid'] + $total_associate['total_paid']?></td>
              <td style="text-align: right;"><?= number_format((($total_regular['total_paid'] * $capitalization_info->par_value) + ($total_associate['total_paid'] *  $capitalization_info->par_value)),2)?></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <?php endif;?>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport' && $created_at >= $effectivity_date){ echo 'Article XIII'; } else { echo 'Article XII'; }?><br>Arbitral Clause</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">Any dispute, controversy or claim arising out of or relating to this Articles of Cooperation, By-laws, the Cooperative laws and related rules, administrative guidelines of the Cooperative Development Authority, including inter-cooperative, inter-federation disputes and related concerns shall be exclusively referred to and finally resolved by voluntary arbitration under the institutional rules promulgated by the Cooperative Development Authority, after compliance with the conciliation or mediation mechanisms embodied in the Bylaws and in such other pertinent laws and issuances. </p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-bold">BE IT KNOWN THAT: </p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;"> <b><?=$treasurer_of_coop->full_name?></b> has been elected as Treasurer of this Cooperative to act as such until her/his successor shall have been duly appointed and qualified in accordance with the By-laws. As such Treasurer, he/she is authorized to receive payments and issue receipts for membership fees, share capital subscriptions and other revenues, and to pay obligations for and in the name of this Cooperative.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">IN WITNESS WHEREOF, we have hereunto affixed our signatures opposite our names this ________ day of _______ in _______________, Philippines.</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-normal">NAME AND SIGNATURE OF COOPERATORS</p>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Name of Cooperators</th>
              <th>Signature</th>
            </tr>
          </thead>
          <tbody>
            <?php  $count=0;foreach($cooperators_list_regular as $cooperator) :?>
              <?=$count++;?>
              <tr>
                <td><?=$count.'. '.$cooperator['full_name']?></td>
                <td></td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-sm-12 col-md-12 text-center">
      <p class="font-weight-normal">SIGNED IN THE PRESENCE OF: </p>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 text-center">
      <p>____________________________ ____________________________</p>
      <p>Signature Over Printed Name   Signature Over Printed Name</p>
    </div>
  </div>
  <div class="page_break"></div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Acknowledgement</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-bold">Republic of the Philippines )<br>Prov./City/Mun. of _________________) S.S.</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">Before me, a Notary Public for and in the Province/City/Municipality of _______________________ on this ________ day of _________________, 20__ the following persons personally appeared with their competent evidence of identification as indicated opposite their respective names: </p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Name of Cooperators</th>
              <th>Proof of Identity (IN ACCORDANCE WITH NOTARIAL LAW)</th>
              <th>Date issued</th>
              <th>Place of Issuance</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($cooperators_list_regular as $cooperator) :?>
              <?=$count++;?>
              <tr>
                <td><?=$count.'. '.$cooperator['full_name']?></td>
                <td><?=$cooperator['proof_of_identity']?>-<?=$cooperator['proof_of_identity_number']?></td>
                <td><?=$cooperator['proof_date_issued']?></td>
                <td><?=$cooperator['place_of_issuance']?></td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify" style="text-indent: 50px;">All known to me to be the same persons who executed the foregoing Articles of Cooperation, and acknowledged to me that the same is their free will and voluntary deed. </p>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">This instrument known as Article of Cooperation of <?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>, consists of <u><?=$this->session->userdata('pagecount')?></u> pages including this page where the acknowledgment is written signed by parties and their instrumental witnesses on each and every page thereof.</p>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">WITNESS my hand and seal this____ day of ________, 20____at_____________Philippines.</p>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 text-left">
      <p class="font-weight-bold float-right" style="text-indent: -100px;">NOTARY PUBLIC</p>
      <p class="font-weight-normal">
      Doc. No. : ___________________<br>
      Page No.: ____________________<br>
      Book No.: ____________________<br>
      Series of ____________________
      </p>
      <?php // echo "Memory usage: " . round(memory_get_usage(false) / 1024)."kb"; ?>
    </div>
  </div>
</div>
<script src="<?=base_url();?>assets/js/jquery-3.7.1.min.js"></script>
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>

