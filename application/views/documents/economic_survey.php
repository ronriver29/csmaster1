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
    <?php 
if($coop_info->status == 12){
?>
   body{
      /*font-family: 'Bookman Old Style'; font-size: 12px; */
       font-family: 'Bookman Old Style',arial !important;font-size:12px;
    }
<?php } ?>
  @page{margin: 96px 96px 70px 96px;}
  .page_break { page-break-before: always; }
  /* table, th, td {
    border: 0.5px solid #000 !important;
    border-collapse: collapse;
  } */
  li {
    margin: 3px 0; 
  }
  </style>
</head>

<body style="font-size:12">
<script type="text/php">
        if ( isset($pdf) ) {
            $x = 570; 
            $y=900;
            $text = "{PAGE_NUM}";//" of {PAGE_COUNT}";
            $font = $fontMetrics->get_font("bokman");
            $size = 12;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);;     
        }
</script>
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
<div class="container-fluid text-monospace" id="printPage">
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">ECONOMIC SURVEY<br>of<br><?= $coop_info->proposed_name?> <?= $coop_info->type_of_cooperative?> Cooperative <?php if(!empty($coop_info->acronym_name)){ echo '('.$coop_info->acronym_name.')';}?> <?= $coop_info->grouping?></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-bold">BACKGROUND;</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-normal" style="text-indent: 50px;"><?= $survey_info->background?></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-bold">RATIONALE;</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-normal" style="text-indent: 50px;"><?= $survey_info->rationale?></p>
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
        <li>Composition of Members</li>
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
        <li>Total No. of Regular Members only. <u><?=$total_no_of_regular_cptr?></u>
        </li>
        <li>Projected Increase of Membership for:</li>
        <table class="table table-borderless table-sm">
          <tbody>
            <tr>
              <td>First Year:</td>
              <td><u><?= $survey_info->increase_first_year ?></u></td>
            </tr>
            <tr>
              <td>Second Year:</td>
              <td><u><?= $survey_info->increase_second_year ?></u></td>
            </tr>
            <tr>
              <td>Third Year:</td>
              <td><u><?= $survey_info->increase_third_year ?></u></td>
            </tr>
          </tbody>
        </table>
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
        <li>Is the proposed cooperative previously Registered with? :</li>
          <table class="table table-borderless table-sm">
            <tbody>
              <tr style="border:1px solid blue;">
                <td><span style="font-family: DejaVu Sans, sans-serif;"><?php echo ($survey_info->previously_registered_with == "1") ? "X - " : ""?></span>SEC</td>
                <td><span style="font-family: DejaVu Sans, sans-serif;"><?php echo ($survey_info->previously_registered_with_dole == "2") ? "X - ": ""?></span>DOLE</td>
                <td><span style="font-family: DejaVu Sans, sans-serif;"><?php echo ($survey_info->previously_registered_with_none == "4") ? "X - ": ""?></span>None
                 </td>
              </tr>
              <tr>
                <td colspan="2"><span style="font-family: DejaVu Sans; sans-serif;"> <?php echo (strlen($survey_info->previously_registered_with_others) > 0) ? "X - ": ""?></span> Others, specify <?php echo (strlen($survey_info->previously_registered_with_others) > 0) ? "<u>".$survey_info->previously_registered_with_others."</u>" : "___________" ?> </u></td>
              </tr>
             <!--  <tr>
                <td colspan="2">
                  <span style="font-family: DejaVu Sans, sans-serif;"></span>None</td>
                </td>
              </tr> -->
            </tbody>
          </table>
      </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-bold">II. STRATEGIC OPERATIONAL STUDIES</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-regular">A. Economic Aspect</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <ol class="text-justify" type="1">
        <li>Are there any other existing cooperative/s within your proposed area of operation that provide the same goods/services which the cooperative plans to offer? If yes, please state the name/s of such cooperative/s:<br>
          <p class="text-justify font-weight-normal"><u><?=$survey_info->exisiting_cooperative_same_area?></u></p>
        </li>
        <li>What strategies the cooperative shall implement to ensure the support of the members?<br>
          <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->strategies_support_members[0] == "1") ? "X - ": ""?></span>Collective purchases</p>
          <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->strategies_support_members[1] == "1") ? "X - ": ""?></span>Commitment on lending policies</p>
          <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->strategies_support_members[2] == "1") ? "X - ": ""?></span>Active participation in cooperative affairs</p>
          <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo (strlen($survey_info->strategies_support_members_others) > 0) ? "X - ": ""?></span>Others (please specify) <?php echo (strlen($survey_info->strategies_support_members_others) > 0) ? "<u>".$survey_info->strategies_support_members_others."</u>": "____________"?></p>
        </li>
        <li>Are you intending to transact business with
          <p class="text-justify font-weight-normal">a) members only <span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->transact_business_with == "1") ? "X - ": ""?></span> b) members and non-members <span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->transact_business_with == "2") ? "X - ": ""?></span></p>
        </li>
        <li>What business activities the Cooperative plans to undertake during the first three years of its operation:<br>
          <p class="text-justify font-weight-normal">First Year : <u><?= $survey_info->bactivities_plans_first_year?></u>.</p>
          <p class="text-justify font-weight-normal">Second Year : <u><?= $survey_info->bactivities_plans_second_year?></u>.</p>
          <p class="text-justify font-weight-normal">Third Year : <u><?= $survey_info->bactivities_plans_third_year?></u>.</p>
        </li>
      </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-regular">B. Financial Aspect</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <ol class="text-justify" type="1">
        <li>Capitalization
          <ol class="text-justify" type="a">
            <li>In pursuing its economic activities, how shall the Cooperative generate its capital?
              <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->generate_capital[0] == "1") ? "X - ": ""?></span>Share Capital Subscription</p>
              <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->generate_capital[1] == "1") ? "X - ": ""?></span>Deferred payment of patronage refund/interest on share capital (Revolving Capital)</p>
              <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->generate_capital[2] == "1") ? "X - ": ""?></span>Acquisition of Loans/borrowings</p>
              <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->generate_capital[3] == "1") ? "X - ": ""?></span>Solicitation/acceptance of donations, subsidies, grants, etc</p>
              <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->generate_capital[4] == "1") ? "X - ": ""?></span>Fund raising activities</p>
            </li>
            <li>
               How much is the Cooperative’s initial operating capital? <u><?=number_format($capitalization_info->total_amount_of_paid_up_capital,2)?></u>.
            </li>
            <li>
              Strategies for internal capital build-up. <u><?=$survey_info->strategy_capital_build_up?></u>.
            </li>
          </ol>
        </li>
        <li>Revenue<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Projected revenue based on the initial operating capital.<br>
            <p class="text-justify font-weight-normal">First Year : <u><?= number_format($survey_info->revenue_first_year,2)?></u>.</p>
            <p class="text-justify font-weight-normal">Second Year : <u><?= number_format($survey_info->revenue_second_year,2)?></u>.</p>
            <p class="text-justify font-weight-normal">Third Year : <u><?= number_format($survey_info->revenue_third_year,2)?></u>.</p>
        </li>
        <li>Expenditure<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;How much is the estimated expenses, for:<br>
            <p class="text-justify font-weight-normal">First Year : <u><?= number_format($survey_info->expenditure_first_year,2)?></u>.</p>
            <p class="text-justify font-weight-normal">Second Year : <u><?= number_format($survey_info->expenditure_second_year,2)?></u>.</p>
            <p class="text-justify font-weight-normal">Third Year : <u><?= number_format($survey_info->expenditure_third_year,2)?></u>.</p>
        </li>
        <li>Investments<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Does the Cooperative intend to invest in the following?<br></li>
          <table class="table table-borderless table-sm">
            <tbody>
              <tr>
                <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->investments[0] == "1") ? "X - ": ""?></span>Cooperative bank</td>
                <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->investments[3] == "1") ? "X - ": ""?></span>Mutual</td>
              </tr>
              <tr>
                <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->investments[1] == "1") ? "X - ": ""?></span>Federation</td>
                <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->investments[4] == "1") ? "X - ": ""?></span>Insurance</td>
              </tr>
              <tr>
                <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->investments[2] == "1") ? "X - ": ""?></span>Joint ventures</td>
                <td> <span style="font-family: DejaVu Sans; sans-serif;"><?php echo (strlen($survey_info->investments_others) > 0) ? "X - ": ""?></span>Others (specify) <?php echo (strlen($survey_info->investments_others) > 0) ? "<u>".$survey_info->investments_others."</u>": "_________"?></td>
              </tr>
            </tbody>
          </table>
      </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-regular">C. Technical Aspect</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <ol class="text-justify" type="1">
        <li>What equipment/machineries/facilities are deemed necessary for the effective and efficient operation of the Cooperative? (please check)</li>
        <table class="table table-borderless table-sm">
          <tbody>
            <tr>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[0] == "1") ? "X - ": ""?></span>Typewriter</td>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[7] == "1") ? "X - ": ""?></span>Medical Instruments</td>
            </tr>
            <tr>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[1] == "1") ? "X - ": ""?></span>Computer</td>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[8] == "1") ? "X - ": ""?></span>Warehouse</td>
            </tr>
            <tr>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[2] == "1") ? "X - ": ""?></span>Tables</td>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[9] == "1") ? "X - ": ""?></span>Milling</td>
            </tr>
            <tr>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[3] == "1") ? "X - ": ""?></span>Chairs</td>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[10] == "1") ? "X - ": ""?></span>Farm Equipment</td>
            </tr>
            <tr>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[4] == "1") ? "X - ": ""?></span>Calculator</td>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[11] == "1") ? "X - ": ""?></span>Post Harvest Equipment</td>
            </tr>
            <tr>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[5] == "1") ? "X - ": ""?></span>Vault/Safe</td>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[12] == "1") ? "X - ": ""?></span>Solar Dryer</td>
            </tr>
            <tr>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[6] == "1") ? "X - ": ""?></span>Filing Cabinet</td>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[13] == "1") ? "X - ": ""?></span>Fishing Equipment</td>
            </tr>
            <tr>
              <td colspan="2"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo (strlen($survey_info->equipments_etc_others) > 0) ? "X - ": ""?></span>Others (specify) <?php echo (strlen($survey_info->equipments_etc_others) > 0) ? "<u>".$survey_info->equipments_etc_others."</u>" : "_______" ?></td>
            </tr>
          </tbody>
        </table>
        <li> How would the Cooperative procure its equipment/machineries/facilities?</li>
        <table class="table table-borderless table-sm">
          <tbody>
            <tr>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->procure_equipments_etc[0] == "1") ? "X - ": ""?></span>Cash</td>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->procure_equipments_etc[1] == "1") ? "X - ": ""?></span>Loans</td>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->procure_equipments_etc[2] == "1") ? "X - ": ""?></span>Donations</td>
            </tr>
            <tr>
              <td colspan="3"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo (strlen($survey_info->procure_equipments_etc_others) > 0) ? "X - ": ""?></span>Others mode/s (specify) <?php echo (strlen($survey_info->procure_equipments_etc_others) > 0) ? "<u>".$survey_info->procure_equipments_etc_others."</u>": "_______"?></td>
            </tr>
          </tbody>
        </table>
        <li>What skills/experiences/trainings are deemed necessary for the operation of its equipment/machineries/facilities?</li>
        <table class="table table-borderless table-sm">
          <tbody>
            <tr>
              <td>
                <p class="text-justify font-weight-normal" style="text-indent: 10px;"> <u><?= $survey_info->skills_etc_necessary_equipments_etc?></u>.</p>
              </td>
            </tr>
          </tbody>
        </table>
      </ol>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="font-weight-regular">D. Organizational Structure/(attached organizational chart)</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify font-weight-normal" style="text-indent: 10px;">
        1. What qualifications/skills the Board of Directors should possess to enable them to formulate sound policies, strategies and guidelines which would ensure the success of the Cooperative?<br>
          <u><?= $survey_info->qualifications_directors?></u>
      </p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12">
      <p class="text-justify font-weight-normal" style="text-indent: 10px;">
        2. For its initial operations, who among the following officers/employees should be hired by the Cooperative.
      </p>
    </div>
  </div>
  <div class="row mb-2" >
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <?php if($coop_info->status == 12){?>
        <table class="table table-bordered table-sm" style="margin-left:-60px">
        <?php } else {?>
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
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-normal" style="text-indent: 10px;">
      3. What are the Cooperative’s education programs for:<br>
          <ol class="text-justify" type="a">
            <li><strong>Members: </strong> <u><?= $survey_info->education_programs_members ?></u></li>
            <li><strong>Officers: </strong> <u><?= $survey_info->education_programs_officers ?></u></li>
            <li><strong>Staff: </strong> <u><?= $survey_info->education_programs_staff ?></u></li>
          </ol>
      </p>
    </div>
  </div>
<?php if($coop_info->grouping!='Federation') {?>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-normal" style="text-indent: 10px;">
      4. Who are the Chairmen and members of the following committees?<br>
          <ol class="text-justify" type="a">
            <?php foreach($committees_list as $committee) : ?>
            <li><strong><?= $committee['name_of_committee']?></strong>
              <ol class="text-justify" type="1">
              <?php foreach($committee['committees_cooperator_list'] as $coop_name) : ?>
                <li><?=$coop_name?></li>
              <?php endforeach ;?>
              </ol>
            </li>
          <?php endforeach; ?>
          </ol>
      </p>
    </div>
  </div>

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

  <div class="row mt-4 mb-4">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-normal" style="text-indent: 50px;">Subscribed and sworn to before me this _______ day of _________, 201___ in _______________, Philippines above affiants exhibiting to me their valid proof of identity:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th class="font-weight-bold">Names</th>
              <th class="font-weight-bold">Proof of Valid Identity</th>
              <th class="font-weight-bold">Office & Place of Issue</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($cooperators_list_bods as $cooperator) :?>
              <?php $count++;?>
              <tr>
                <td><?=$count.'. '.$cooperator['full_name']?></td>
                <td><?=$cooperator['proof_of_identity']?>-<?=$cooperator['proof_of_identity_number']?></td>
                <td><?=$cooperator['place_of_issuance']?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row mb-5 mt-4">
    <div class="col-xs-12 text-left">
      <p class="font-weight-bold" style="text-indent: 450px;">NOTARY PUBLIC</p>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-xs-12 text-left">
      <p class="text-justify font-weight-regular">NOTE: The CDA reserves the right to review/verify the authenticity/viability of the information provided in this survey and may require the proponent to modify, revise or amend the whole or any part thereof if necessary, or, if found to be economically unfeasible, deny the registration of the Cooperative.</p>
    </div>
  </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script> -->
</body>
</html>
