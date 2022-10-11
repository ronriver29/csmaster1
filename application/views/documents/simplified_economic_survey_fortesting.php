<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CoopRIS <?= $title ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
  <link rel="stylesheet" href="<?=APPPATH?>../assets/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="<?=base_url();?>assets/icons/fontawesome-free-5.5.0-web/css/all.css"> -->
  <link rel="icon" href="<?=base_url();?>assets/img/cda.png" type="image/png">
<style>
  @page{margin: 96px 96px 70px 96px;}
  .page_break { page-break-before: always; }
  .table-cooperator, .table-cooperator th, .table-cooperator td {
    border: 0.5px solid #000 !important;
    border-collapse: collapse;
}
  }
    <?php
  if($coop_info->status == 12){
  ?>
  body{
      /*font-family: 'Bookman Old Style'; font-size: 12px; */
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
        if (isset($pdf) ) {
            $x = 570;
            $y=900;
            $text = "{PAGE_NUM}";//" of {PAGE_COUNT}";
            $font = $fontMetrics->get_font("BOOKOS");

            $size = 12;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text,$font , $size, $color, $word_space, $char_space, $angle);

        }
</script>
<div class="container-fluid text-monospace" id="printPage">
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">ECONOMIC SURVEY<br>of<br><?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?> <?= $coop_info->grouping?></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-bold">I. GENERAL INFORMATION</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <ol type="A">
        <li>Type of Cooperatives</li>
          <table class="table table-borderless table-sm">
            <tbody>
              <tr>
                <td><?php echo $coop_info->type_of_cooperative?></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        <li><?php if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';?>
        Office Address of Cooperative: <?=$coop_info->house_blk_no?> <?=ucwords($coop_info->street).$x?> <?=$coop_info->brgy?> <?=($in_chartered_cities ? $chartered_cities : $coop_info->city.', '.$coop_info->province)?> <?=$coop_info->region?></li>
        <li>Area of Operation:</li>
          <table class="table table-borderless table-sm">
            <tbody>
              <tr>
                <td><?=$coop_info->area_of_operation ?></td>
              </tr>
            </tbody>
          </table>
        <li>Common Bond of Membership</li>
          <table class="table table-borderless table-sm">
            <tbody>
              <tr>
                <td><?= $coop_info->common_bond_of_membership?></td>
              </tr>
            </tbody>
          </table>
        <li>Composition/Field of Members</li>
          <table class="table table-borderless table-sm">
            <tbody>
              <tr><!--foreach-->
                <td>
                  <?php
                  if($coop_info->common_bond_of_membership=='Residential')
                  {
                    echo"Working and/or residing in the area of operaion.";
                  }
                  else if($coop_info->common_bond_of_membership=='Occupational')
                  {
                      foreach($members_composition as $compo) :
                      echo $compo['composition'].'<br/>';

                     endforeach;
                  }
                  else
                  {
                    echo $coop_info->field_of_membership.' of ';
                    $name_of_ins_assoc = explode(',',$coop_info->name_of_ins_assoc);
                    if(count($name_of_ins_assoc)==2)
                    {
                        echo $name_of_ins_assoc[0].' and '.$name_of_ins_assoc[1].'.';
                    }
                    else if(count($name_of_ins_assoc)==3)
                    {
                       echo $name_of_ins_assoc[0].', '.$name_of_ins_assoc[1].' and '.$name_of_ins_assoc[2].'.';
                    }
                    else if(count($name_of_ins_assoc)==4)
                    {
                       echo $name_of_ins_assoc[0].', '.$name_of_ins_assoc[1].', '.$name_of_ins_assoc[2].' and '.$name_of_ins_assoc[3].'.';
                    }
                    else
                    {
                      echo $coop_info->name_of_ins_assoc;
                    }
                  }
                  ?></td>
              </tr>
            </tbody>
          </table>
        <li>No. of Founding/Organizing Members: <u><?=$total_no_of_regular_cptr?></u>
        </li>
        <li></li>
        <table class="table table-borderless table-sm">
          <tbody>
            <tr>
              <td>Authorized Capital :</td>
              <td><u><?= number_format($capitalization_info->authorized_share_capital,2)?></u></td>
            </tr>
            <tr>
              <td>Subscribed Capital :</td>
              <td><u><?php echo($bylaw_info->kinds_of_members == 1) ? number_format(($total_regular['total_subscribed'] * $capitalization_info->par_value),2) : number_format((($total_regular['total_subscribed'] * $capitalization_info->par_value) + ($total_associate['total_subscribed'] * $capitalization_info->par_value)),2);?></u></td>
            </tr>
            <tr>

              <td>Paid-up Capital :</td>
              <td><u><?php echo($bylaw_info->kinds_of_members == 1) ? number_format(($total_regular['total_paid'] * $capitalization_info->par_value),2) : number_format((($total_regular['total_paid'] * $capitalization_info->par_value) + ($total_associate['total_paid'] * $capitalization_info->par_value)),2);?></u></td>
            </tr>
            <tr>
              <td>Par value :</td>
              <td><u><?php echo(($bylaw_info->kinds_of_members == 1) ? number_format($capitalization_info->par_value,2) : number_format(($capitalization_info->par_value),2));?></u></td>
            </tr>
          </tbody>
        </table>
      </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-bold">II. ECONOMIC ACTIVITIES</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-regular">A. Proposed Nature of Business</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?= $simplified_survey_info->nature_of_business?></span></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-regular">B. Sources of Initial Capital</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <table class="table table-borderless table-sm">
          <tbody>
            <tr>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($simplified_survey_info->initial_capital[0] == "1") ? "X - ": ""?></span>Share Capital Subscription </td>
            </tr>
            <tr>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($simplified_survey_info->initial_capital[1] == "1") ? "X - ": ""?></span>Acquisition of Loans/borrowings </td>
            </tr>
            <tr>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($simplified_survey_info->initial_capital[2] == "1") ? "X - ": ""?></span>Solicitation/acceptance of donations, subsidies, grants, etc. </td>
            </tr>
            <tr>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($simplified_survey_info->initial_capital[3] == "1") ? "X - ": ""?></span>Fund raising activities </td>
            </tr>
            <tr>
              <td colspan="2"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo (strlen($simplified_survey_info->initial_capital_others) > 0) ? "X - ": ""?></span>Others (specify) <?php echo (strlen($simplified_survey_info->initial_capital_others) > 0) ? "<u>".$simplified_survey_info->initial_capital_others."</u>" : "_______" ?></td>
            </tr>
          </tbody>
        </table>
    </div>
  </div>
  <div class="page_break"></div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-regular">C. Organizational Structure</p>
    </div>
  </div>
  <script>
html2canvas([document.getElementById('mydiv')], {
  onrendered: function(canvas) {
     document.body.appendChild(canvas);
     var data = canvas.toDataURL('image/png');
     // AJAX call to send `data` to a PHP file that creates an image from the dataURI string and saves it to a directory on the server
  }
});
</script>
<?php if($coop_info->status == 12){
    $bar = '<hr class="bar" />'; ?>
    <link rel="stylesheet" href="<?=APPPATH?>../assets/css/organizationalchart.css" media="all">
    <style>
      .bar {
        width: 20px !important;
        transform: rotate(90deg) !important;
        margin: 0px auto 10px auto !important;
        background: black;
      }
      .bar2{
        width: 143% !important;
        transform: rotate(90deg) !important;
        margin: 0px auto 25px auto !important;
        background: black;
        margin-top: 3% !important;
      }
      .bar3{
        position:relative;
        width: 18px !important;
        /*transform: rotate(90deg) !important;*/
        /*margin: 15px auto 15px auto !important;*/
        float:left;
        background: black;
        margin-top: 3% !important;
        margin-left: 19.4em;
      }
      .bar4{
        width: 18px !important;
        /*transform: rotate(90deg) !important;*/
        /*margin: 15px auto 15px auto !important;*/
        float:left;
        background: black;
        margin-top: 3% !important;
        margin-left: 19.4em;
      }
      .barMS {
        width: 120% !important;
        transform: rotate(90deg) !important;
        margin: 0px auto 10px auto !important;
        background: black;
        margin-top: 7% !important;
      }
      .tree {
        margin-left:-40px;
        font-size:14px !important;
      }
      .samplespan::before{
            transform: translateX(-50%);
            width: 2px;
            height: 20px;
            background: var(--black) !important;
      }
    </style>

  <?php } else {
    $bar = '';?>
    <link rel="stylesheet" href="<?=base_url();?>assets/css/organizationalcharthtmlview.css" media="all">
  <?php } ?>
<div id="mydiv">
  <ul class="tree"  style="">
    <li> <span>General</span>

      <ul>
        <li><?=$bar?> <span><u>Audit Committee</u><br>
          <?php $count=1; foreach($audit_committee as $ac){
            echo $count.'. '.$ac['full_name'].'<br>';
           $count++; }?></span>

          <!-- <ul>
            <li> <span>Our history</span>
              <ul>
                <li><span>Founder</span></li>
              </ul>
            </li>
            <li> <span>Our board</span>
              <ul>
                <li><span>Brad Whiteman</span></li>
                <li><span>Cynthia Tolken</span></li>
                <li><span>Bobby Founderson</span></li>
              </ul>
            </li>
          </ul> -->
        </li>
        <li><?=$bar?><span style="font-size: 12px !important;padding:5px;"><u>Board of Director</u><br>
          <?php $count=1; foreach($bod_committee as $bod){
            echo $count.'. '.$bod['full_name'].'<br>';
           $count++; }?></span>
          <ul>
            <!-- <li> <?=$bar?>
              <span><u>Secretary</u><br>
          <?php $count=1; foreach($secretary_committee as $sc){
            echo $count.'. '.$sc['full_name'].'<br>';
           $count++; }?></span>
            </li>
            <li> <?=$bar?>
              <span><u>Treasurer</u><br>
          <?php $count=1; foreach($treasurer_committee as $tc){
            echo $count.'. '.$tc['full_name'].'<br>';
           $count++; }?></span></span>
            </li> -->
        </li>
        <li><?=$bar?> <span><u>Election Committee</u><br>
          <?php $count=1; foreach($election_committee as $ec){
            echo $count.'. '.$ec['full_name'].'<br>';
           $count++; }?></span>
        </li>
      </ul>
      <ul class="tree" style="">
        <li>
            <hr class="bar3" />
          <ul>
              <li>
              </li>
              <li>
              </li>
              <li>
              </li>
              <li> <hr class="bar2" style="margin-left:12% !important;"/>
              </li>
              <li style="margin-top:-5px !important;">
                <span class="samplespan"><u>Treasurer</u><br>
                <?php $count=1; foreach($treasurer_committee as $tc){
                echo $count.'. '.$tc['full_name'].'<br>';
                $count++; }?></span></span>
              </li>
          </ul>
        </li>
      </ul>
    <ul class="tree"  style="">
        <li>
            <hr class="bar4" />
          <ul>
              <li>
              </li>
              <li>
              </li>
              <li>
              </li>
              <li> <hr class="bar2" style="margin-left:12% !important;"/>
              </li>
              <li style="margin-top:-2px !important;">
                <span><u>Secretary</u><br>
                <?php $count=1; foreach($secretary_committee as $sc){
                echo $count.'. '.$sc['full_name'].'<br>';
                $count++; }?></span>
              </li>
          </ul>
        </li>
      </ul>
      <ul class="tree"  style="">
        <li> <span></span>

          <ul>
              <?php
                if($coop_info->type_of_cooperative == 'Credit' || $coop_info->type_of_cooperative == 'Agriculture'){ ?>
                  <style>
                    .barMS{
                      width: 160% !important;
                      margin-left: -30% !important;
                    }
                  </style>
                  <li> <?=$bar?>
                    <span style="font-size: 12px !important;padding:5px;"><u>Credit Committee</u><br>
                <?php $count=1; foreach($credit_committee as $creditc){
                  echo $count.'. '.$creditc['full_name'].'<br>';
                 $count++; }?></span>
                  </li>
                <?php } ?>

                <?php
                if(!empty($education_committee)){ ?>
                  <style>
                    .barMS{
                      width: 160% !important;
                      margin-left: -30% !important;
                    }
                  </style>
                <li> <?=$bar?>
                  <span style="font-size: 12px !important;padding:5px;"><u>Education Committee</u><br>
              <?php $count=1; foreach($education_committee as $educc){
                echo $count.'. '.$educc['full_name'].'<br>';
               $count++; }?></span>
                </li>
                <?php } ?>
                <?php
                if($coop_info->type_of_cooperative == 'Credit' && !empty($education_committee)){?>
                  <style>
                    .barMS{
                      width: 190% !important;
                      margin-left: -45% !important;
                    }
                  </style>
                <?php } ?>
                <li> <?=$bar?>
                  <span style="font-size: 12px !important;padding:5px;"><u>Med-Con Committee</u><br>
              <?php $count=1; foreach($medcon_committee as $mcc){
                echo $count.'. '.$mcc['full_name'].'<br>';
               $count++; }?></span>
                </li>
                <li> <hr class="barMS" style="margin-bottom: 8% !important;"/>
                  <span style="font-size: 12px !important;padding:5px;"><u>Management Staff</u><br></span>
                </li>
                <li> <?=$bar?>
                  <span style="font-size: 12px !important;padding:5px;"><u>Ethics Committee</u><br>
              <?php $count=1; foreach($ethics_committee as $ec){
                echo $count.'. '.$ec['full_name'].'<br>';
               $count++; }?></span>
                </li>

                <li> <?=$bar?>
                  <span style="font-size: 12px !important;padding:5px;"><u>GAD Committee</u><br>
              <?php $count=1; foreach($gad_committee as $gadc){
                echo $count.'. '.$gadc['full_name'].'<br>';
               $count++; }?></span>
                </li>
                <li> <?=$bar?>
                  <span style="font-size: 12px !important;padding:5px;"><u>Other Committee</u><br>
              <?php $count=1; foreach($other_committee as $otherc){
                echo $count.'. '.$otherc['full_name'].' ('.$otherc['name'].')<br>';
               $count++; }?></span>
                </li>

          </ul>
        </li>
      </ul>
    </li>
  </ul>

</div>

  <div class="page_break"></div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-regular">D. Staffing Pattern</p>
    </div>
  </div>

  <div class="row mb-2" >
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <?php
          if($coop_info->status == 12){
        ?>
        <table class="table table-bordered table-sm" style="margin-left:-60px">
        <?php } else { ?>
          <table class="table table-bordered table-sm">
        <?php } ?>
          <thead>
            <tr>
              <th>Position</th>
              <th>Name</th>
              <th>STATUS OF APPOINTMENT</th>
              <th>MINIMUM EDUCATION EXPERIENCE/TRAINING</th>
              <th>MONTHLY COMPENSATION</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach($staff_list as $staff) : ?>
              <tr>
                <td><?= ucfirst($staff['position'])?></td>
                <td><?= $staff['full_name']?></td>
                <td><?= $staff['status_of_appointment']?></td>
                <td><?= $staff['minimum_education_experience_training']?></td>
                <td><?= number_format($staff['monthly_compensation'],2)?></td>
              </tr>
            <?php endforeach;?>
            <?php foreach($others_staff_list as $other_staff) : ?>
              <tr>
                <td><?= $other_staff['position_others']?></td>
                <td><?= $other_staff['full_name']?></td>
                <td><?= $other_staff['status_of_appointment']?></td>
                <td><?= $other_staff['minimum_education_experience_training']?></td>
                <td><?= number_format($other_staff['monthly_compensation'],2)?></td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php if($coop_info->grouping!='Federation') {?>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-normal" style="text-indent: 50px;">We, the Founding Board of Directors, hereby certify that the foregoing Economic Survey was prepared in accordance with the facts, information and other data we believed vital to the success of the initial operations of the Cooperative.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive text-center">
        <table class="table table-borderless table-sm table-director">
          <tbody>
            <tr>
              <td><b><?=$cooperator_chairperson->full_name?></b><br>Chairperson</td>
              <td><b><?=$cooperator_vicechairperson->full_name?></b><br>Vice-Chairperson</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
    <?php } ?>

    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
              <?php if(!empty($cooperator_directors[0]['full_name'])):?>
                <td><b><?=$cooperator_directors[0]['full_name']?></b><br>Director</td>
              <?php endif;?>
               <?php if(!empty($cooperator_directors[1]['full_name'])):?>
                <td><b><?=$cooperator_directors[1]['full_name']?></b><br>Director</td>
              <?php endif;?>
               <?php if(!empty($cooperator_directors[2]['full_name'])):?>
                <td><b><?=$cooperator_directors[2]['full_name']?></b><br>Director</td>
              <?php endif;?>
              </tr>
          </table>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
              <?php if(!empty($cooperator_directors[3]['full_name'])):?>
                <td><b><?=$cooperator_directors[3]['full_name']?></b><br>Director</td>
              <?php endif;?>
               <?php if(!empty($cooperator_directors[4]['full_name'])):?>
                <td><b><?=$cooperator_directors[4]['full_name']?></b><br>Director</td>
              <?php endif;?>
              </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
              <?php if(!empty($cooperator_directors[5]['full_name'])):?>
                <td><b><?=$cooperator_directors[5]['full_name']?></b><br>Director</td>
              <?php endif;?>
               <?php if(!empty($cooperator_directors[6]['full_name'])):?>
                <td><b><?=$cooperator_directors[6]['full_name']?></b><br>Director</td>
              <?php endif;?>
               <?php if(!empty($cooperator_directors[7]['full_name'])):?>
                <td><b><?=$cooperator_directors[7]['full_name']?></b><br>Director</td>
              <?php endif;?>
              </tr>
          </table>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                 <?php if(!empty($cooperator_directors[8]['full_name'])):?>
                <td><b><?=$cooperator_directors[8]['full_name']?></b><br>Director</td>
              <?php endif;?>
               <?php if(!empty($cooperator_directors[9]['full_name'])):?>
                <td><b><?=$cooperator_directors[9]['full_name']?></b><br>Director</td>
              <?php endif;?>
              </tr>
          </table>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                 <?php if(!empty($cooperator_directors[10]['full_name'])):?>
                <td><b><?=$cooperator_directors[10]['full_name']?></b><br>Director</td>
              <?php endif;?>
               <?php if(!empty($cooperator_directors[11]['full_name'])):?>
                <td><b><?=$cooperator_directors[11]['full_name']?></b><br>Director</td>
              <?php endif;?>
               <?php if(!empty($cooperator_directors[12]['full_name'])):?>
                <td><b><?=$cooperator_directors[12]['full_name']?></b><br>Director</td>
              <?php endif;?>
              </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                 <?php if(!empty($cooperator_directors[13]['full_name'])):?>
                <td><b><?=$cooperator_directors[13]['full_name']?></b><br>Director</td>
              <?php endif;?>
               <?php if(!empty($cooperator_directors[14]['full_name'])):?>
                <td><b><?=$cooperator_directors[14]['full_name']?></b><br>Director</td>
              <?php endif;?>
              </tr>
          </table>
        </div>
      </div>
    </div>

  <div class="row mt-5">
    <div class="col-xs-12 text-left">
      <p class="text-justify font-weight-regular">NOTE: The CDA reserves the right to review/verify the authenticity/viability of the information provided in this survey and may require the proponent to modify, revise or amend the whole or any part thereof if necessary, or, if found to be economically unfeasible, deny the registration of the Cooperative.</p>
    </div>
  </div>
</div>
<br><br>

<!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script> -->
</body>
</html>
