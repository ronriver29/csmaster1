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
      <p class="text-justify font-weight-normal" style="text-indent: 50px;">We, the undersigned Filipino citizens, of legal age and residents of the Philippines, with a firm collective intent, have come together to organize voluntarily a <?= $coop_info->type_of_cooperative?> Cooperative to advance what we believe is our inherent right, under the laws of the Republic of the Philippines.</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-bold">AND WE HEREBY CERTIFY:</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article I<br>Name of the Cooperative</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify" style="text-indent: 50px;">That the name of this Cooperative shall be <?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?> <?= $coop_info->grouping?></p>
    </div>
  </div>
  <div class="row  mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article II<br>Purpose(s)</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify" style="text-indent: 50px;">That the purposes for which this Cooperative is organized are to engage in:</p>
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
        <p class="font-weight-bold">Article III<br>Goals</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the goals of this Cooperative are to help improve the quality of life of its members and thereby contribute to inclusive growth, enterprise development and employment. In furtherance thereto, it shall aim:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
          <ol class="text-justify" type="1">
            <li> To attain increased income, savings, investments, productivity, and purchasing power, and promote among themselves equitable distribution of net surplus through maximum utilization of economies of scale, costsharing and risk-sharing;</li>
            <li> To provide optimum social and economic benefits to its members;</li>
            <li> To teach members efficient ways of doing things in a Cooperative manner;</li>
            <li> To propagate Cooperative practices and innovative ideas in business undertakings and management;</li>
            <li> To empower through provision of access, ownership, control and opportunities to the poor, vulnerable, lower income and less privileged groups to increase their ownership in the wealth of the nation;</li>
            <li> To actively support the government, other Cooperatives and people oriented organizations, both local and foreign, in promoting Cooperatives as a practical means towards sustainable socio-economic development under a truly just and democratic society;</li>
            <li> To develop a dynamic savings mobilization and capital build-up schemes to sustain its developmental activities and long-term investments, thereby ensuring optimum economic benefits to the members, their families and the communities;</li>
            <li> To adopt membership expansion mechanism/scheme, thereby ensuring growth of the Cooperative movement;</li>
            <li> To implement policy guidelines that will ensure transparency, accountability and equitable access to its resources and services, and promote the interests of the members;</li>
            <li> To adopt such other plans as may help foster the welfare of the members, their families and the community;</li>
            <li> To advance the competitiveness and innovativeness of the industry;</li>
            <li> To coordinate with other Cooperatives on learning exchanges, coop trade, and information exchanges in fostering sustainable development;</li>
            <li> To advocate legal framework and enabling policies appropriate for the development of <?=$coop_info->type_of_cooperative?> Cooperative; and</li>
            <li> To be the voice and the institution of the poor and the excluded in resisting the growth-centered development aggression and instead promote people-centered development.</li>
          </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article IV<br>Powers and Capacities</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the powers, rights and capacities of this Cooperative are those prescribed under Article 9 of Republic Act 9520.</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="1">
        <li>To the exclusive use of its registered name; </li>
        <li>To sue and be sued;</li>
        <li>Of succession;</li>
        <li>To amend its Articles of Cooperation in accordance with the provisions of RA 9520;</li>
        <li>To adopt bylaws not contrary to law, morals or public policy, and to amend and repeal the same in accordance with RA 9520;</li>
        <li>To purchase, receive, take or grant, hold, convey, sell, lease, pledge, mortgage, and otherwise deal with such real and personal property as the transaction of the lawful affairs of the cooperative may reasonably and necessarily require, subject to the limitations prescribed by law and the Constitution;</li>
        <li>To enter into division, merger, or consolidation, as provided under RA 9520;</li>
        <li>To form subsidiary Cooperatives and join federations or unions, as provided in this Code;</li>
        <li>To avail of loans, be entitled to credit and to accept and receive grants, donations and assistance from foreign and domestic sources subject to the conditions of said loans, credits, grants, donations or assistance that will not undermine the autonomy of the cooperative. The Authority, upon written request, shall provide necessary assistance in the documentary requirements for the loans, credit, grants, donations and other financial support; and</li>
        <li>To avail preferential rights granted to Cooperatives under RA 7160, otherwise known as the Local Government Code, and other laws, particularly those in the grant of franchises to establish, construct, operate and maintain ferries, wharves, markets or slaughters houses and to lease public utilities, including access to extension and on-site research services and facilities related to agriculture and fishery activities;</li>
        <li>To exercise such other powers granted under RA 9520 or necessary to carry out its purposes as stated in this Articles of Cooperation. </li>
        <?php if($article_info->guardian_cooperative==1){?> <li>To act as Guardian Cooperative and accept the responsibilities of supervising and monitoring the activities of the Laboratory Cooperative and act in its behalf in dealings with third parties when capacity to contract is required. (<i class="text-danger text-left">applicable to Guardian Cooperative only</i>)</li><?php } ?>
      </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article V<br>Term of Existence</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">The term for which this Cooperative shall exist is <?= ucwords(num_format_custom($article_info->years_of_existence))?> (<?= $article_info->years_of_existence?>) years from the date of its registration with the Cooperative Development Authority.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VI<br>Common Bond and Field  of Membership</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the common bond of membership of this Cooperative is <?= $coop_info->common_bond_of_membership?> and the field of membership shall be open to all <?php if($coop_info->common_bond_of_membership=="Institutional" || $coop_info->common_bond_of_membership=="Associational"){ echo $coop_info->field_of_membership; } ?> of <?php if($coop_info->common_bond_of_membership=="Residential"){ echo 'members working and/or residing in the area of operation'; } else if($coop_info->common_bond_of_membership=="Institutional" || $coop_info->common_bond_of_membership=="Associational") { echo $coop_info->name_of_ins_assoc; } else { foreach($members_composition as $compo){ echo $compo['composition']; }} ?>
        who are natural persons, Filipino citizens, of legal age, with the capacity to contract and possess all the qualifications and none of the disqualifications provided for in the By-laws and this Articles of Cooperation.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VII<br>Area of Operation</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the membership of this Cooperative shall come from
       <?php if($coop_info->area_of_operation=="Barangay"){ ?>

         <?= ($in_chartered_cities ? $coop_info->brgy.' '.$chartered_cities.' '.$coop_info->region : $coop_info->brgy.' '.$coop_info->city.' '.$coop_info->province.' '.$coop_info->region)?>
       <?php }else if($coop_info->area_of_operation=="Municipality/City"){ ?>
         <?=($in_chartered_cities ? $chartered_cities.' '.$coop_info->region : $coop_info->city.' '.$coop_info->province.' '.$coop_info->region)?>
      <?php }else if($coop_info->area_of_operation=="Provincial"){
         echo $coop_info->province.' '.$coop_info->region;
       }else if($coop_info->area_of_operation=="Regional"){
         echo $coop_info->region;
       }else{
         echo "Philippines";
       }
       ?>. Its principal office shall be located at <?php if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';?><?=$coop_info->house_blk_no?> <?=ucwords($coop_info->street).$x?> <?=$coop_info->brgy?> <?=($in_chartered_cities ? $chartered_cities : $coop_info->city.', '.$coop_info->province)?> <?=$coop_info->region?>.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VIII<br>Name and Address of Cooperators</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the name and complete postal address of the cooperators are as follows:</p>
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
        <p class="font-weight-bold">Article IX<br>Board of Directors</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the number of Directors of this Cooperative shall be <?=num_format_custom($no_of_directors)?>(<?= $no_of_directors?>) and shall serve until their successors shall have been elected and qualified within <?=$article_info->directors_turnover_days?> days from the date of registration as provided in the By-laws.</p>
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
        <p class="font-weight-bold">Article X<br>Capitalization</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the Authorized Share Capital of this Cooperative is <?= ucwords(num_format_custom($capitalization_info->authorized_share_capital))?> Pesos (Php <?=number_format($capitalization_info->authorized_share_capital,2)?>), divided into:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li> <?= ucwords(num_format_custom($capitalization_info->common_share))?> (<?= number_format($capitalization_info->common_share)?>) common shares with a par value of <?= ucwords(num_format_custom($capitalization_info->par_value))?> Pesos (<?=number_format($capitalization_info->par_value,2)?> ) per share;</li>
        <?php if($bylaw_info->kinds_of_members == 2) :?>
        <li> <?= ucwords(num_format_custom($capitalization_info->preferred_share))?> (<?= number_format($capitalization_info->preferred_share)?>) preferred shares with a par value of <?= ucwords(num_format_custom($capitalization_info->par_value))?> Pesos (<?=number_format($capitalization_info->par_value,2)?>) per share.</li>
        <?php endif;?>
      </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article XI<br>Subscribed and Paid-up Share Capital</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That of the authorized share capital, the amount of
        <?php echo ucwords(num_format_custom(($bylaw_info->kinds_of_members == 1) ? $total_regular['total_subscribed'] * $capitalization_info->par_value : ($total_regular['total_subscribed'] * $capitalization_info->par_value) + ($total_associate['total_subscribed'] * $capitalization_info->par_value))).' Pesos';?>
        (Php <?php echo ($bylaw_info->kinds_of_members == 1) ? number_format(($total_regular['total_subscribed'] * $capitalization_info->par_value),2) : number_format((($total_regular['total_subscribed'] * $capitalization_info->par_value) + ($total_associate['total_subscribed'] * $capitalization_info->par_value)),2);?>) has been subscribed, and
        <?php echo ucwords(num_format_custom(($bylaw_info->kinds_of_members == 1) ? ($total_regular['total_paid'] * $capitalization_info->par_value) : ($total_regular['total_paid'] * $capitalization_info->par_value) + ($total_associate['total_paid'] * $capitalization_info->par_value))).' Pesos';?>
        (Php <?php echo ($bylaw_info->kinds_of_members == 1) ? number_format(($total_regular['total_paid'] * $capitalization_info->par_value),2) : number_format((($total_regular['total_paid'] * $capitalization_info->par_value) + ($total_associate['total_paid'] * $capitalization_info->par_value)),2);?>) of the total subscription has been paid by the following members-subscribers:</p>
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
        <p class="font-weight-bold">Article XII<br>Arbitral Clause</p>
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

    </div>
  </div>
</div>
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>

