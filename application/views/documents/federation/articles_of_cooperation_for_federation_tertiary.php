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
  <?php 
  if($coop_info->status == 12){
  ?>
  body{
        font-family: 'Bookman Old Style',arial !important;font-size:12px;
    }
  <?php } ?>

  </style>
<?php 
if($coop_info->status != 12){
?>
<style type="text/css">
  #printPage
{
  margin-left: 450px;
  padding: 0px;
  width: 670px; / width: 7in; /
  height: 900px; / or height: 9.5in; /
  clear: both;
  page-break-after: always;
}
</style>
<a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>/documents" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
<?php } ?>

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

<div class="container-fluid text-monospace" id="printPage">

  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-center"> 


        <p class="font-weight-bold">ARTICLES OF COOPERATION<br>of<br><?= $coop_info->proposed_name?> Federation of <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">

        <p class="font-weight-bold">KNOW ALL MEN BY THESE PRESENTS:</p>
    </div>
  </div>
  <div class="row mb-2 ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-normal" style="text-indent: 50px;">We, the undersigned duly authorized representative(s) of our respective cooperatives, all of legal age and Filipino citizens, have on this day voluntarily agreed to organize a Tertiary Cooperative, under the laws of the Republic of the Philippines, hereinafter referred to as the Tertiary Cooperative.</p>
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
      <p class="text-justify" style="text-indent: 50px;">That the name of this Tertiary Cooperative shall be <?= $coop_info->proposed_name?> <?= $coop_info->grouping?> of <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?></p>
    </div>
  </div>
  <div class="row  mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article II<br>Purpose(s)</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify" style="text-indent: 50px;">That the purpose(s) for which this Tertiary Cooperative is organized is/are to engage in:</p>
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
      <p class="text-justify" style="text-indent: 50px;">The goal of this Tertiary Cooperative is to help improve the quality of services of its members and in furtherance thereto shall aim:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
          <ol class="text-justify" type="1">
            <li> To carry on any cooperative enterprise authorized under Article 6 of RA 9520 that compliments, augments, supplements but do not conflict, compete with nor supplant the business or economic activities of its members;</li>
            <li> To carry on, encourage and assist educational and advisory work relating to its members' cooperatives;</li>
            <li> To render services designed to encourage simplicity, efficiency, and economy in the conduct of the business of its members and to facilitate the implementation of their bookkeeping, accounting, and other systems and procedures;</li>
            <li> To print, publish, and circulate any newspaper or other publication in the interest of its members and enterprises;</li>
            <li> To coordinate and facilitate the activities of its member- cooperatives;</li>
            <li> To mandatorily act as conciliator-mediator in intra-cooperative disputes within and among the primary cooperative members;</li>
            <li> To assist the members to become sustainable cooperative organizations and to comply with the laws, regulations, policies, inspection/examination findings of any government regulatory bodies;</li>

            <li> To assist the members in the submission of required reports and other compliance to CDA and other government and regulatory bodies; and</li>
            <li> To perform such other functions as may be necessary to attain its objectives.</li>
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
      <p class="text-justify" style="text-indent: 50px;">That the powers, rights and capacities of this Tertiary Cooperative are those prescribed under Article 9 of Republic Act 9520. as follows</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="1">
        <li>To the exclusive use of its registered name, To sue and be sued; </li>
        <!-- <li>To sue and be sued;</li> -->
        <li>; Of succession;</li>
        <li>To amend its Articles of Cooperation in accordance with the provisions of RA 9520;</li>
        <li>To adopt bylaws not contrary to law, morals or public policy, and to amend and repeal the same in accordance with RA 9520;</li>
        <li>To purchase, receive, take or grant, hold, convey, sell, lease, pledge, mortgage, and otherwise deal with such real and personal property as the transaction of the lawful affairs of the cooperative may reasonably and necessarily require, subject to the limitations prescribed by law and the Constitution;</li>
        <li>To enter into division, merger, or consolidation, as provided under RA 9520;</li>
        <li>To avail of loans, be entitled to credit and to accept and receive grants, donations and assistance from foreign and domestic sources subject to the conditions of said loans, credits, grants, donations or assistance that will not undermine the autonomy of the cooperative. The Authority, upon written request, shall provide necessary assistance in the documentary requirements for the loans, credit, grants, donations and other financial support; and</li>
        <li>To enter into joint ventures with national or international cooperatives   in the manufacture and sale of products and/or services in the   Philippines and abroad;</li>
        <!-- <li>To exercise such other powers granted under RA 9520 or necessary to carry out its purposes as stated in this Articles of Cooperation. </li> -->
        <li>To avail preferential rights granted to cooperatives under RA 7160, otherwise known as the Local Government Code, and other laws, particularly those in the grant of franchises to establish, construct, operate and maintain ferries, wharves, markets or slaughters houses and to lease public utilities, including access to extension and on-site research services and facilities related to agriculture and fishery activities; and</li>
        <li>To exercise such other powers granted under RA 9520 or necessary to carry out its purposes as stated in this articles of cooperation.  </li>
        <!-- <?php if($article_info->guardian_cooperative==1){?> <li>To act as Guardian Cooperative and accept the responsibilities of supervising and monitoring the activities of the Laboratory Cooperative and act in its behalf in dealings with third parties when capacity to contract is required. (<i class="text-danger text-left">applicable to Guardian Cooperative only</i>)</li><?php } ?> -->
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
      <p class="text-justify" style="text-indent: 50px;">The term of existence of the  Tertiary Cooperative is <?= ucwords(num_format_custom($article_info->years_of_existence))?> (<?= $article_info->years_of_existence?>) years from the date of its registration <span style="color:darkblue;">with the Cooperative Development Authority.</span></p>
    </div>
  </div>
  <!-- <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VI<br>Common Bond and Field  of Membership</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the common bond of membership of this Cooperative is <?= $coop_info->common_bond_of_membership?> and the field of membership shall be open to all <?php if($coop_info->common_bond_of_membership=="Institutional" || $coop_info->common_bond_of_membership=="Associational"){ echo $coop_info->field_of_membership; } ?> of <?php if($coop_info->common_bond_of_membership=="Residential"){ echo 'members working and/or residing in the area of operation'; } else if($coop_info->common_bond_of_membership=="Institutional" || $coop_info->common_bond_of_membership=="Associational") { echo $coop_info->name_of_ins_assoc; } else { foreach($members_composition as $compo){ echo $compo['composition']; }} ?>
        who are natural persons, Filipino citizens, of legal age, with the capacity to contract and possess all the qualifications and none of the disqualifications provided for in the By-laws and this Articles of Cooperation.</p>
    </div>
  </div> -->
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VI<br>Area of Operation and Postal Address of the Principal Office</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the membership of this Tertiary Cooperative shall come from
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
       ?>. Its principal office shall be located at <?php if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';?><?=$coop_info->house_blk_no?> <?=ucwords($coop_info->street).$x?> <?=$coop_info->brgy?> <?=($in_chartered_cities ? $chartered_cities : $coop_info->city.', '.$coop_info->province)?> <?=$coop_info->region?>.</p>
    </div>
  </div>
  <?php if($coop_info->type_of_cooperative == 'Transport'){?>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VII<br>Business Operation</p>
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
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport'){ echo 'Article VIII'; } else { echo 'Article VII'; }?><br>Cooperators</p>
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
              <th><center>Name of Member-Cooperator</center></th>
              <th><center>Postal Address of Cooperative</center></th>
              <th><center>Name of Representative</center></th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($members_list as $members) :?>
              <?php $count++;?>
                          
              <tr>
                <td><?=$count.'. '.$members['coopName']?></td>
                <td><?php if($members['noStreet']==null && $members['Street']==null) $x=''; else $x=', '; ?><?=$members['noStreet'].' '.$members['Street'].$x.$members['brgy'].', ';?><?= $members['city'].', '.$members['province']?></td>
                <td><?=$members['representative']?></td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport'){ echo 'Article IX'; } else { echo 'Article VIII'; }?><br>Board of Directors</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the number of Directors of this Tertiary Cooperative shall be <?=num_format_custom($no_of_directors)?>(<?= $no_of_directors?>) and the names of the Board of  Directors are as follows: </p>
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
              <?php $count++;?>
            <tr>
              <td><?=$count.'. '.$director['representative']?></td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport'){ echo 'Article X'; } else { echo 'Article IX'; }?><br>Common Bond of Membership</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That this  Tertiary Cooperative is composed of duly registered Federation of Cooperatives engaged in <?=$coop_info->type_of_cooperative?>, willing to patronize the services of this Tertiary Cooperative and possess all the qualifications  and none of the disqualifications provided for in the Bylaws.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport'){ echo 'Article XI'; } else { echo 'Article X'; }?><br>Capitalization</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the Authorized Share Capital of this Tertiary Cooperative is <?= ucwords(num_format_custom($capitalization_info->authorized_share_capital))?> Pesos (Php <?=number_format($capitalization_info->authorized_share_capital,2)?>), divided into <?= ucwords(num_format_custom($capitalization_info->common_share))?> (<?= number_format($capitalization_info->common_share)?>) common shares with a par value of <?= ucwords(num_format_custom($capitalization_info->par_value))?> Pesos (<?=number_format($capitalization_info->par_value,2)?> ) per share;</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <!-- <li></li> -->
        <?php if($bylaw_info->kinds_of_members == 2) :?>
        <li> <?= ucwords(num_format_custom($capitalization_info->preferred_share))?> (<?= number_format($capitalization_info->preferred_share)?>) preferred shares with a par value of <?= ucwords(num_format_custom($capitalization_info->par_value))?> Pesos (<?=number_format($capitalization_info->par_value,2)?>) per share.</li>
        <?php endif;?>
      </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport'){ echo 'Article XII'; } else { echo 'Article XI'; }?><br>Subscribed and Paid-up Share Capital</p>
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
  <!-- <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 40px;"><strong>A.</strong> Common Share</p>
    </div>
  </div> -->
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th class="text-center">Names of Cooperative</th>
              <th class="text-center">No. of  Subscribed Shares</th>
              <th class="text-center">Amount of Subscribed Shares</th>
              <th class="text-center">No. of Paid-up Shares</th>
              <th class="text-center">Amount of Paidup Shares</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($members_list as $regular) : ?>
              <?php $count++; ?>
            <tr>
              <td><?=$count.'. '. $regular['coopName']?></td>
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
              <?php $count++;?>
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
        <p class="font-weight-bold"><?php if($coop_info->type_of_cooperative == 'Transport'){ echo 'Article XIII'; } else { echo 'Article XII'; }?><br>Arbitral Clause</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">Any dispute, controversy, or claim arising out of or relating to this  Articles of Cooperation, the cooperative law, and related rules, administrative guidelines of the Cooperative Development Authority, including inter-federation disputes and related concerns, and any question regarding the existence, interpretation, validity, breach or termination of the business relationship shall be exclusively referred to and finally resolved by voluntary arbitration under the institutional rules promulgated by the Cooperative  Development Authority, after compliance with the conciliation or mediation mechanisms embodied in the applicable bylaws and such other pertinent laws.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-bold">BE IT KNOWN THAT: </p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;"> <b><?=$treasurer_of_coop->representative?></b> has been elected as Treasurer of this Tertiary Cooperative to act as such until her/his successor shall have been duly appointed and qualified in accordance with the By-laws. As such Treasurer, he/she is authorized to receive payments and issue receipts for membership fees, share capital subscriptions and other revenues, and pay obligations for and in the name of this Tertiary Cooperative.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">IN WITNESS WHEREOF, we have hereunto affixed our signatures opposite our names this ________ day of _______ in _______________, Philippines.</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-normal">NAME AND SIGNATURE OF COOPERATORS/MEMBERS</p>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <td><center>Cooperator/Member</center></td>
              <td><center>Name of Representative</center></td>
              <td><center>Signature of Representative</center></td>
            </tr>
          </thead>
          <tbody>
            <?php  $count=0;foreach($members_list as $cooperator) :?>
              <?php $count++;?>
              <tr>
                <td><?=$count.'. '.$cooperator['coopName']?></td>
                <td><?=$cooperator['representative']?></td>
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
      <p class="text-justify" style="text-indent: 50px;">Before me, a Notary Public for and in the Province/City/Municipality of _______________________ on this ________ day of _________________, the following persons personally appeared with their Community Tax Certificates/Proof of Identity as indicated opposite their respective names: </p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Name of Member-Cooperative and its representative</th>
              <th>Proof of Identity</th>
              <th>Date and Place of Issuance</th>
              <!-- <th></th> -->
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($members_list as $cooperator) :?>
              <?php $count++;?>
              <tr>
                <td><?=$count.'. '.$cooperator['coopName'].' - '.$cooperator['representative']?></td>
                <td><?=$cooperator['proof_of_identity']?>-<?=$cooperator['valid_id']?></td>
                <td><?php if($cooperator['date_issued'] == "1970-01-01"){
                  echo 'N/A';
                } else {
                  echo $cooperator['date_issued'];
                }?> <?=$cooperator['place_of_issuance']?></td>
                <!-- <td></td> -->
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
      <p class="text-justify" style="text-indent: 50px;">This instrument known as Article of Cooperation of <?= $coop_info->proposed_name?> Federation of <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>, consists of <u><?=$this->session->userdata('pagecount')?></u> pages including this page where the acknowledgment is written signed by parties and their instrumental witnesses on each and every page thereof.</p>
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
      Doc. No.: ___________________<br>
      Page No.: ____________________<br>
      Book No.: ____________________<br>
      Series of ____________________
      </p>
      <?php // echo "Memory usage: " . round(memory_get_usage(false) / 1024)."kb"; ?>
    </div>
  </div>
</div>
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>

