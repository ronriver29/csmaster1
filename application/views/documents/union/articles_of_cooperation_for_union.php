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
        <p class="font-weight-bold">ARTICLES OF COOPERATION<br>of<br><?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-bold">KNOW ALL MEN BY THESE PRESENTS:</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-normal" style="text-indent: 50px;">We, the undersigned duly authorized representative(s) of our respective cooperatives, all of legal age and Filipino citizens, have on this day voluntarily agreed to organize <u>a Cooperative Union</u>, under the laws of the Republic of the Philippines, hereinafter referred to as the Cooperative Union.</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-bold">AND WE HEREBY CERTIFY:</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article I<br>Name of the Cooperative Union</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify" style="text-indent: 50px;">That the name of this Cooperative Union shall be <?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article II<br>Purpose(s)</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify" style="text-indent: 50px;">That the purpose(s) for which this Cooperative Union is organized are:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
        <ol class="text-justify" type="a">
          
         <!--  <li>To represent its member organizations;</li>
          <li>To acquire, analyze, and disseminate, economic, statistical, and other information relating to its members and all types of cooperatives within its area of operation;</li>
          <li>To sponsor studies in the economic, legal, financial, social, and other phases of cooperation, and publish the results thereof;</li>
          <li>To promote the knowledge of cooperative principles and practices;</li>
          <li>To develop the cooperative movement in their respective jurisdiction;</li>
          <li>To advise the appropriate authorities on all questions relating to cooperatives;</li>
          <li>To conduct mandatory training to cooperatives as an accredited training provider;</li>
          <li>To assist the national and local government units in development activities within their jurisdiction;</li> 
          <li>To act as conciliator or mediator in cooperative disputes of their members;</li>
          <li>To assist its members in the submission of required reports and other compliances to CDA and other government regulatory bodies;</li>
          <li>To raise funds through membership fees, dues and contributions, donations, and subsidies from local and foreign sources whether private or government; and</li>
          <li>To do and perform such other non-business activities as may be necessary to attain the foregoing objectives.</li> 04082024 -->
          <?php foreach($purposes_list as $purpose) :?>
            <li><?=$purpose?></li>
          <?php endforeach; ?>
        </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article III<br>Goal</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">The goal of this Cooperative Union is to help improve the quality of services of its members and in furtherance thereto shall aim:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
          <ol class="text-justify" type="a">
            <li>To represent its member organizations;</li>
            <li>To acquire, analyze, and disseminate, economic, statistical, and other information relating to its members and all types of cooperatives within its area of operation;</li>
            <li>To sponsor studies in the economic, legal, financial, social, and other phases of cooperation, and publish the results thereof;</li>
            <li>To promote the knowledge of cooperative principles and practices;</li>
            <li>To develop the cooperative movement in their respective jurisdiction;</li>
            <li>To advise the appropriate authorities on all questions relating to cooperatives;</li>
            <li>To assist the national and local government units in development activities within its jurisdiction;</li>
            <li>To act as conciliator or mediator in cooperative disputes of its members;</li>
            <li>To assist its members in the submission of required reports and other compliances to CDA and other government regulatory bodies;</li>
            <li>To raise funds through membership fees, dues and contributions, donations, and subsidies from local and foreign sources whether private or government; and</li>
            <li>To do and perform such other non-business activities as may be necessary to attain the foregoing objectives.</li>
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
      <p class="text-justify" style="text-indent: 50px;">This Cooperative Union registered under RA 9520 shall have the following powers, rights and capacities:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="1">
        <li>To the exclusive use of its registered name, to sue and be sued; </li>
        <li>Of succession;</li>
        <li>To amend its articles of cooperation in accordance with the provisions of RA 9520;</li>
        <li>To adopt bylaws not contrary to law, morals, or public policy, and to amend and repeal the same in accordance with RA 9520;</li>
        <li>To purchase, receive, take or grant, hold, convey, sell, lease, pledge, mortgage, and otherwise deal with such real and personal property as the transaction of the lawful affairs of the cooperative may reasonably and necessarily require, subject to the limitations prescribed by law and the Constitution;</li>
        <li>To enter into division, merger, or consolidation, as provided under RA  9520;</li>
        <li>To avail of loans, be entitled to credit, and to accept and receive grants, donations, and assistance from foreign and domestic sources subject to the conditions of said loans, credits, grants, donations, or assistance that will not undermine the autonomy of the cooperative. The Authority, upon written request, shall provide necessary assistance in the documentary requirements for the loans, credit, grants, donations, and other financial support; and</li>
        <li>To exercise such other powers granted under RA 9520 or necessary to carry out its purposes as stated in this articles of cooperation.</li>
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
      <p class="text-justify" style="text-indent: 50px;">The term for which this Cooperative Union shall exist is <?= ucwords(num_format_custom($article_info->years_of_existence))?> (<?= $article_info->years_of_existence?>) years from the date of its registration with the Cooperative Development Authority.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VI<br>Area of Operation and Postal Address of the Principal Office</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the membership of this Union shall come from <?php if($coop_info->area_of_operation=="Barangay"){ ?>

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
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VII<br>Cooperators</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the names and complete postal addresses of the cooperators are as follows:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th><center>Cooperative Name</center></th>
              <th><center>Postal Address of Cooperative</center></th>
              <th><center>Name of Authorized Representative of the Cooperative</center></th>
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
        <p class="font-weight-bold">Article VIII<br>Board of Directors</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the number of Directors of this Union shall be <?=num_format_custom($no_of_directors)?>(<?= $no_of_directors?>) and the names of the Board of Directors are as follows:</p>
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
        <p class="font-weight-bold">Article IX<br>Fees, Dues, and Contribution</p>
    </div>
  </div>
  <div class="row ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the capital contribution of the Cooperative Union shall be <?= ucwords(num_format_custom($coop_info->capital_contribution))?> Pesos (Php <?=number_format($coop_info->capital_contribution,2)?>). That the amount of capital contributions of members is, as follows:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th><center>Names of Cooperator/Member</center></th>
              <th><center>Amount of Contribution</center></th>
            </tr>
          </thead>
          <tbody>
            <?php $sumofcc=array(); $count=0; foreach($members_list as $members) :?>
              <?php $count++;?>
                          
              <tr>
                <td><?=$count.'. '.$members['coopName']?></td>
                <td><?=$members['cc']?></td>
              </tr>
            <?php $sumofcc[] = $members['cc']; endforeach;?>
          </tbody>
          <tfoot>
            <tr>
              <th><strong>Total</strong></th>
              <th><?=array_sum($sumofcc);?></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article X<br>Arbitral Clause</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">Any dispute, controversy or claim arising out of or relating to this Articles of Cooperation, the cooperative law and related rules, administrative guidelines of the Cooperative Development Authority, including inter and intra cooperative member disputes and related concerns, and any question regarding the existence, interpretation, validity, breach or termination of the business relationship shall be exclusively referred to and finally resolved by voluntary arbitration under the institutional rules promulgated by the Cooperative  Development Authority, after compliance with the conciliation or mediation mechanisms embodied in this Articles and such other pertinent laws.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-normal">BE IT KNOWN THAT: </p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;"><b><?=$treasurer_of_coop->representative?></b> has been appointed as Treasurer of this Cooperative Union to act as such until her/his successor shall have been duly appointed and qualified in accordance with the by-laws. As such Treasurer, he/she is authorized to receive payments and issue receipts for membership fees, capital contribution and other revenues, and to pay obligations for and in the name of this Cooperative Union.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">IN WITNESS WHEREOF, we have hereunto signed our names this ________ day of _______ in _______________, Philippines.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-normal">NAME AND SIGNATURE OF COOPERATORS/MEMBERS</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th><center>Name of Cooperative</center> </th>
              <th><center>Name of Representative</center></th>
              <th><center>Signature of Representatives</center></th>
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
      <p class="text-justify" style="text-indent: 50px;">Before me, a Notary Public for and in the Province/City/Municipality of ____________________________ on this ________ day of ______________________________ the following persons personally appeared with their Proof of Identity as indicated opposite their respective names: </p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th><center>Name of Cooperative Member and its Representative</center></th>
              <th><center>Proof of Identity</center></th>
              <th><center>Date Issued</center></th>
              <th><center>Place of Issuance</center></th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($members_list as $cooperator) :?>
              <?php $count++;?>
              <tr>
                <td><?=$count.'. '.$cooperator['coopName'].' - '.$cooperator['representative']?></td>
                <td><?=$cooperator['proof_of_identity']?>-<?=$cooperator['valid_id']?></td>
                <td><?php if($cooperator['date_issued'] == NULL){
                  echo 'N/A';
                } else {
                  echo $cooperator['date_issued'];
                }?> 
                </td>
                <td><?=$cooperator['place_of_issuance']?></td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12">
        <p class="text-justify font-weight-normal">All known to me to be the same persons who executed the foregoing Articles of Cooperation, and acknowledged to me that the same is their free will and voluntary deed.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">This instrument known as Article of Cooperation of <?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?>, consists of <u><?=$this->session->userdata('pagecount')?></u> pages including this page where the acknowledgment is written signed by parties and their instrumental witnesses on each and every page thereof. WITNESS my hand and seal this day and place first above mentioned.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 text-left">
      <p class="font-weight-bold" style="text-indent: 450px;">NOTARY PUBLIC</p>
      <p class="font-weight-normal">
      Doc. No.: ___________________<br>
      Page No.: ____________________<br>
      Book No.: ____________________<br>
      Series of ____________________
      </p>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>
