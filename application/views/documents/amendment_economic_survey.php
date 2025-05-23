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
  <link rel="stylesheet" href="<?=base_url();?>assets/icons/fontawesome-free-5.5.0-web/css/all.css">
  <link rel="icon" href="<?=base_url();?>assets/img/cda.png" type="image/png">
  <style>
    
 
 @page{margin: 96px 96px 70px 96px;}
  .page_break { page-break-before: always; }
  /* table, th, td {
    border: 0.5px solid #000 !important;
    border-collapse: collapse;
  } */
  li {
    margin: 3px 0;
  }
   body{
      /*font-family: 'Bookman Old Style'; font-size: 12px; */
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
            $font = $fontMetrics->get_font("bokman");
            $size = 12;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);;     
        }
</script>
<div class="container-fluid text-monospace">
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12 text-center">

      <?php
        if(strlen($coop_info->acronym)>0)
        {
          $acronym_ = '('.$coop_info->acronym.')';
        }
        else
        {
          $acronym_='';
        }
        if(count(explode(',',$coop_info->type_of_cooperative))>1)
        {
          $proposedName = $coop_info->proposed_name.' Multipurpose Cooperative '.$coop_info->grouping.' '. $acronym_;
        }
        else
        {
           $proposedName = $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$coop_info->grouping.' '. $acronym_;
        }
      ?>
        <p class="font-weight-bold">ECONOMIC SURVEY<br>of<br><strong><?= $proposedName?></strong></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-bold">BACKGROUND;</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
     <!--  <?php  
        $survey_background = $survey_info->background;
        if($survey_info->background != $survey_info_orig->background)
        {
          $survey_background = '<b>'. $survey_background.'</b>';
        }
        else
        {
          $survey_background=$survey_background;
        }
      ?> -->
      <p class="text-justify" style="text-indent: 50px;"><?= ($survey_info->background!=$survey_info_orig->background ? '<b>'.$survey_info->background.'</b>' : $survey_info->background)?></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-bold">RATIONALE;</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
      <?php
      $rationale_ = $survey_info->rationale; 
      if($survey_info->rationale!=$survey_info_orig->rationale)
      {

        $rationale_ = '<b>'.$survey_info->rationale.'</b>';
      }
      else
      {
        $rationale_ = $survey_info->rationale; ;
      }
      ?>
      <p class="text-justify " style="text-indent: 50px;"><?php echo $rationale_; ?></p>
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
        <li>Type of Cooperatives model <?php var_dump($in_chartered_cities_orig);?></li>
          <table class="table table-borderless table-sm">
            <tbody>
              <tr>
                <td><?php 
               
                if($coop_info->type_of_cooperative!=$coop_info_orig->type_of_cooperative)
                {
                  $coop_info->type_of_cooperative='<b>'.$coop_info->type_of_cooperative.'</b>';
                } 
                echo $coop_info->type_of_cooperative;
                ?></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        <li>
          <?php 
          if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';
           $chartered = '';
           $chartered_orig='';
              if($in_chartered_cities){
                $chartered = $chartered_cities;
              }
              else
              {
                $chartered = $coop_info->city.', '.$coop_info->province;
              } 

              if($in_chartered_cities_orig){
                $chartered_orig = $chartered_cities_orig;
              }
              else
              {
                $chartered_orig = $coop_info_orig->city.', '.$coop_info_orig->province;
              } 

            $address_ = $coop_info->house_blk_no.' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.' '.$chartered.' '.($coop_info->region);
         
            $address_orig_ = $coop_info_orig->house_blk_no.' '.ucwords($coop_info_orig->street).$x.' '.$coop_info_orig->brgy.' '.$chartered_orig.' '.$coop_info_orig->region;
            ?>
          <?php  
            if($address_!=$address_orig_)
            {
              $address_ = '<b>'.$address_.'</b>';
            }  
          ?>

        Office Address of Cooperative: <?=$address_?></li>
        <li>Area of Operation:</li>
          <table class="table table-borderless table-sm">
            <tbody>
              <tr>
                <td><?=($coop_info->area_of_operation!=$coop_info_orig->area_of_operation ? '<b>'.$coop_info->area_of_operation.'</b>' : $coop_info->area_of_operation) ?></td>
              </tr>
            </tbody>
          </table>
        <li>Common Bond of Membership</li>
          <table class="table table-borderless table-sm">
            <tbody>
              <tr>
                <td><?= ($coop_info->common_bond_of_membership !=$coop_info_orig->common_bond_of_membership ? '<b>'.$coop_info->common_bond_of_membership.'</b>' : $coop_info->common_bond_of_membership)?></td>
              </tr>
            </tbody>
          </table>
        <li>Composition of Members</li>
          <table class="table table-borderless table-sm">
            <tbody>
              <tr><!--foreach-->
                <td>
                  <?php
                  $bold_tag = null;
                  $bold_tag_close = null;
                    if($coop_info->common_bond_of_membership!=$coop_info_orig->common_bond_of_membership  )
                    {
                     $bold_tag='<b>';
                     $bold_tag_close ='</b>';
                    }

                  if($coop_info->common_bond_of_membership=='Residential')
                  {
                    
                      echo $bold_tag."Working and/or residing in the area of operaion.</b>".$bold_tag_close  ;
                   
                   
                  }
                  else if($coop_info->common_bond_of_membership=='Occupational')
                  {
                      foreach($members_composition as $compo) : 
                      echo $bold_tag.$compo['composition'].$bold_tag_close.'<br/>';

                     endforeach;
                  }
                  else
                  {
                    echo $bold_tag.$coop_info->field_of_membership.' of ';
                    $name_of_ins_assoc = explode(',',$coop_info->name_of_ins_assoc);
                    if(count($name_of_ins_assoc)==2)
                    {
                        echo $name_of_ins_assoc[0].' and '.$name_of_ins_assoc[1].'.'.$bold_tag_close;
                    }
                    else if(count($name_of_ins_assoc)==3)
                    {
                       echo $name_of_ins_assoc[0].', '.$name_of_ins_assoc[1].' and '.$name_of_ins_assoc[2].'.'.$bold_tag_close;
                    }
                    else if(count($name_of_ins_assoc)==4)
                    {
                       echo $name_of_ins_assoc[0].', '.$name_of_ins_assoc[1].', '.$name_of_ins_assoc[2].' and '.$name_of_ins_assoc[3].'.'.$bold_tag_close;
                    }
                    else
                    {
                      echo $coop_info->name_of_ins_assoc.$bold_tag_close;
                    }
                  }
                  ?>
                    
                  </td>
              </tr>
            </tbody>
          </table>
        <li>Total No. of Regular Members only. <u><?=($total_regular!=$total_regular_orig ? '<b>'.$total_regular2.'</b>' : $total_regular2)?></u> 
        </li>
        <li>Projected Increase of Membership for:</li>
        <table class="table table-borderless table-sm">
          <tbody>
            <tr>
              <td>First Year:</td>
              <td><u><?= ($survey_info->increase_first_year!=$survey_info_orig->increase_first_year ? '<b>'.$survey_info->increase_first_year.'</b>' : $survey_info->increase_first_year) ?></u></td>
            </tr>
            <tr>
              <td>Second Year:</td>
              <td><u><?= ($survey_info->increase_second_year!=$survey_info_orig->increase_second_year ? '<b>'.$survey_info->increase_second_year.'</b>' : $survey_info->increase_second_year) ?></u></td>
            </tr>
            <tr>
              <td>Third Year:</td>
              <td><u><?= ($survey_info->increase_third_year!=$survey_info_orig->increase_third_year ? '<b>'.$survey_info->increase_third_year.'</b>' : $survey_info->increase_third_year) ?></u></td>
            </tr>
          </tbody>
        </table>
        <li></li>
        <table class="table table-borderless table-sm">
          <tbody>
            <tr>
              <td>Authorized Capital :</td>
              <td><u><?= ($capitalization_info->authorized_share_capital!=$capitalization_info_orig->authorized_share_capital ? '<b>'.number_format($capitalization_info->authorized_share_capital,2).'</b>' : number_format($capitalization_info->authorized_share_capital,2))?></u></td>
            </tr>
            <tr>
              <td>Subscribed Capital :</td>
            
             <?php
              $total_reg_subscribed = ($total_regular['total_subscribed'] * $capitalization_info->par_value);
                $total_reg_subscribed_orig = ($total_regular_orig['total_subscribed'] *$capitalization_info->par_value);
              if($total_reg_subscribed!=$total_reg_subscribed_orig)
              {
                $total_reg_subscribed = '<b>'.number_format($total_reg_subscribed,2).'</b>';
              }
              else
              {
                $total_reg_subscribed = number_format($total_reg_subscribed,2);
              }  
              // var_dump( $total_regular);
              // echo 'subscribled'.$total_regular['total_subscribed'] .'<br> par value :'. $capitalization_info->par_value .'<br> total_associate :'.$total_associate['total_subscribed'].'<br> par value: '. $capitalization_info->par_value;
                  
              $total_regSubscribed = ($total_regular['total_subscribed'] * $capitalization_info->par_value) + ($total_associate['total_subscribed'] * $capitalization_info->par_value);

              $total_regSubscribed_orig = ($total_regular_orig['total_subscribed'] * $capitalization_info->par_value) + ($total_associate_orig['total_subscribed'] * $capitalization_info->par_value);
              if( $total_regSubscribed!= $total_regSubscribed_orig)
              {
                 $total_regSubscribed = '<b>'.number_format($total_regSubscribed,2).'</b>';
              }
              else
              {
                  $total_regSubscribed = number_format($total_regSubscribed,2);
              }
             ?>
              <td><u><?php echo($bylaw_info->kinds_of_members == 1) ? $total_reg_subscribed : $total_regSubscribed;?></u></td>

            </tr>
            <tr>
              <td>Paid-up Capital :
              </td>
              <?php
                $tot_reg_paid =($total_regular['total_paid'] * $capitalization_info->par_value);
                $tot_reg_paid_orig =($total_regular_orig['total_paid'] * $capitalization_info_orig->par_value);
                if($tot_reg_paid != $tot_reg_paid_orig)
                {
                   $tot_reg_paid ='<b>'.number_format($tot_reg_paid,2).'</b>';
                }
                $tot_reg_paid2 = ($total_regular['total_paid'] * $capitalization_info->par_value) + ($total_associate['total_paid'] * $capitalization_info->par_value);
                
                $tot_reg_paid2_orig = ($total_regular_orig['total_paid'] * $capitalization_info->par_value) + ($total_associate_orig['total_paid'] * $capitalization_info->par_value);
                if($tot_reg_paid2!= $tot_reg_paid2_orig)
                {
                   $tot_reg_paid2 = '<b>'.number_format($tot_reg_paid2,2).'</b>';
                }
              ?>
              <td><u><?php echo (($bylaw_info->kinds_of_members == 1) ?  $tot_reg_paid :  number_format($tot_reg_paid2,2));?></u></td>   
            </tr>
            <tr> 
              <td>Par value :</td>
              <!-- <td><u><?php echo(($bylaw_info->kinds_of_members == 1) ? number_format($article_info->par_value_common,2) : number_format(($article_info->par_value_common + $article_info->par_value_preferred),2));?></u></td> -->
              <?php
                $par_val = ($capitalization_info->par_value!=$capitalization_info_orig->par_value ? '<b>'.number_format($capitalization_info->par_value,2).'</b>' : number_format($capitalization_info->par_value,2));

                $par_value = ($capitalization_info->par_value);
                $par_value_orig = ($capitalization_info_orig->par_value);
                if($par_value!=$par_value_orig)
                {
                  $par_value = '<b>'.number_format($par_value,2).'</b>';
                }
              ?>
              <td><u><?php echo(($bylaw_info->kinds_of_members == 1) ? number_format($par_val,2) : number_format($par_value,2));?></u></td>

            </tr>
          </tbody>
        </table>
        <li>Is the proposed cooperative previously Registered with? :</li>
          <table class="table table-borderless table-sm">
            <tbody>
              <tr style="border:1px solid blue;">
                <?php
                  $sec = ($survey_info->previously_registered_with == "1" ? "X - " : "");
                  $sec_orig = ($survey_info_orig->previously_registered_with == "1" ? "X - " : "");
                  if($sec !=$sec_orig)
                  {
                    $sec = '<b>'.$sec.'</b>';
                  }
                  $dole =($survey_info->previously_registered_with_dole == "2" ? "X - ": "");
                  $dole_orig =($survey_info_orig->previously_registered_with_dole == "2" ? "X - ": "");
                  if($dole != $dole_orig)
                  {
                    $dole = '<b>'.$dole.'</b>';
                  }

                  $none_ = ($survey_info->previously_registered_with_none == "4" ? "X - ": "");
                   $none_orig = ($survey_info_orig->previously_registered_with_none == "4" ? "X - ": "");  
                ?>
                <!-- <td><span style="font-family: DejaVu Sans, sans-serif;"><?php echo ($survey_info->previously_registered_with == "1") ? "X - " : ""?></span>SEC</td>
                <td><span style="font-family: DejaVu Sans, sans-serif;"><?php echo ($survey_info->previously_registered_with_dole == "2") ? "X - ": ""?></span>DOLE</td>
                <td><span style="font-family: DejaVu Sans, sans-serif;"><?php echo ($survey_info->previously_registered_with_none == "4") ? "X - ": ""?></span>None
                 </td> -->
                 <td><span style="font-family: DejaVu Sans, sans-serif;"><?= $sec ?></span>SEC</td>
                <td><span style="font-family: DejaVu Sans, sans-serif;"><?=$dole ?></span>DOLE</td>
                <td><span style="font-family: DejaVu Sans, sans-serif;"><?= $none_?></span>None
                 </td>
              </tr>
              <tr>
               <!--  <td colspan="2"><span style="font-family: DejaVu Sans; sans-serif;"> <?php echo (strlen($survey_info->previously_registered_with_others) > 0) ? "X - ": ""?></span> Others, specify <?php echo (strlen($survey_info->previously_registered_with_others) > 0) ? "<u>".$survey_info->previously_registered_with_others."</u>" : "___________" ?> </u></td> -->

               <?php
                $others_ = (strlen($survey_info->previously_registered_with_others) > 0 ? "X - ": "");
                $others_orig_ = (strlen($survey_info_orig->previously_registered_with_others) > 0 ? "X - ": "");
                if($others_ != $others_orig_)
                {
                  $others_ = '<b>'.$others_.'</b>';
                }
                $others2_ =$survey_info->previously_registered_with_others;
                $others2_orig= $survey_info_orig->previously_registered_with_others;
                if($others2_ != $others2_orig)
                {
                  $others2_ = '<b>'.$others2_.'</b>';
                }
               ?>
                <td colspan="2"><span style="font-family: DejaVu Sans; sans-serif;"> <?= $others_?></span> Others, specify <?php echo (strlen( $others2_) > 0) ? "<u>".$others2_."</u>" : "___________" ?> </u></td>

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
          <p class="text-justify"><u><?=($survey_info->exisiting_cooperative_same_area!=$survey_info_orig->exisiting_cooperative_same_area ? '<b>'.$survey_info->exisiting_cooperative_same_area.'</b>' : $survey_info->exisiting_cooperative_same_area)?></u></p>
        </li>
        <?php

          $str_support_members ='<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->strategies_support_members[0] == "1" ? "X - ": "").'</span>Collective purchases';
          $str_support_members_orig ='<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->strategies_support_members[0] == "1" ? "X - ": "").'</span>Collective purchases';


          $str_support_members2 = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->strategies_support_members[1] == "1" ? "X - ": "").'</span>Commitment on lending policies';
         
          $str_support_members2_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->strategies_support_members[1] == "1" ? "X - ": "").'</span>Commitment on lending policies';

           if($survey_info->strategies_support_members!=$survey_info_orig->strategies_support_members)
          {
            $str_support_members =($survey_info->strategies_support_members[0] == "1" ? "<b>X - Collective purchases</b>" : "Collective purchases");
            $str_support_members2 = ($survey_info->strategies_support_members[1] == "1" ? "<b>X - Commitment on lending policies</b>" : "Commitment on lending policies" );
          }
         
        ?>
        <li>What strategies the cooperative shall implement to ensure the support of the members?<br>
          <p class="text-justify "><?= $str_support_members ?></p>
         <!--  <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->strategies_support_members[1] == "1") ? "X - ": ""?></span>Commitment on lending policies</p> -->
          <p class="text-justify "><?=$str_support_members2?></p>

          <p class="text-justify "><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->strategies_support_members[2] == "1") ? "X - ": ""?></span>Active participation in cooperative affairs</p>

          <p class="text-justify "><span style="font-family: DejaVu Sans; sans-serif;"><?php echo (strlen($survey_info->strategies_support_members_others) > 0) ? "X - ": ""?></span>Others (please specify) <?php echo (strlen($survey_info->strategies_support_members_others) > 0) ? "<u>".$survey_info->strategies_support_members_others."</u>": "____________"?></p>
        </li>

        <?php
        $trans_business_with1='';
        $trans_business_with2='';
          $trans_business_with1 = ($survey_info->transact_business_with == "1" ? "X - ": "");
            $trans_business_with2 = ($survey_info->transact_business_with == "2" ? "X - ": "");
           $trans_business_with_orig = ($survey_info_orig->transact_business_with == "1" ? "X - ": "");
           if($trans_business_with1 !=  $trans_business_with_orig)
           {
              $trans_business_with1 = '<b>'.$trans_business_with1.'</b>';
           }
            if($trans_business_with2 !=  $trans_business_with_orig)
           {
              $trans_business_with2 = '<b>'.$trans_business_with2.'</b>';
           }



        ?>
        <li>Are you intending to transact business with
          <p class="text-justify "><span style="font-family: DejaVu Sans; sans-serif;"><?= $trans_business_with1?></span> a) members only <span style="font-family: DejaVu Sans; sans-serif;"><?=  $trans_business_with2?></span> b) members and non-members </p>
        </li>

        <li>What business activities the Cooperative plans to undertake during the first three years of its operation:<br>
          <p class="text-justify ">First Year : <u><?= ($survey_info->bactivities_plans_first_year!=$survey_info_orig->bactivities_plans_first_year ? '<b>'.$survey_info->bactivities_plans_first_year.'</b>' : $survey_info->bactivities_plans_first_year)?></u>.</p>
          <p class="text-justify ">Second Year : <u><?= ($survey_info->bactivities_plans_second_year!=$survey_info_orig->bactivities_plans_second_year ? '<b>'.$survey_info->bactivities_plans_second_year.'</b>' : $survey_info->bactivities_plans_second_year)?></u>.</p>
          <p class="text-justify">Third Year : <u><?= ($survey_info->bactivities_plans_third_year!=$survey_info_orig->bactivities_plans_third_year ? '<b>'.$survey_info->bactivities_plans_third_year.'</b>' : $survey_info->bactivities_plans_third_year)?></u>.</p>
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
          <?php
          $generate_capital0 = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->generate_capital[0] == "1" ? "X - ": "").'</span>Share Capital Subscription';
          if($survey_info->generate_capital[0]!=$survey_info_orig->generate_capital[0])
          {
              $generate_capital0 = '<b>'. $generate_capital0.'</b>';
          }
          else
          {
              $generate_capital0=  $generate_capital0;
          }

          $generate_capital1 ='<span style="font-family: DejaVu Sans; sans-serif;">'. ($survey_info->generate_capital[1] == "1" ? "X - ": "").'</span>Deferred payment of patronage refund/interest on share capital (Revolving Capital)';
          if($survey_info->generate_capital[1]!=$survey_info_orig->generate_capital[1])
          {
              $generate_capital1 = '<b>'.  $generate_capital1.'</b>';
          }
          else
          {
              $generate_capital1=  $generate_capital1;
          }

          $generate_capital2 = ($survey_info->generate_capital[2] == "2" ? "X - ": "");
          if($survey_info->generate_capital[2]!=$survey_info_orig->generate_capital[2])
          {
              $generate_capital2 = '<b>'.  $generate_capital2.'</b>';
          }
          else
          {
              $generate_capital2=  $generate_capital2;
          }

          ?>
          <ol class="text-justify" type="a">
            <li>In pursuing its economic activities, how shall the Cooperative generate its capital?
              <p class="text-justify "><?php echo $generate_capital0; ?></p>

              <p class="text-justify "><?php echo $generate_capital1;//($survey_info->generate_capital[1] == "1") ? "X - ": ""?></p>
              <p class="text-justify "><span style="font-family: DejaVu Sans; sans-serif;"><?php echo $generate_capital2;//($survey_info->generate_capital[2] == "1") ? "X - ": ""?></span>Acquisition of Loans/borrowings</p>

              <!-- <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->generate_capital[3] == "1") ? "X - ": ""?></span>Solicitation/acceptance of donations, subsidies, grants, etc</p> -->
              <?php
                 $generate_captal =  ($survey_info->generate_capital[3] == "1" ? "X - ": "").'</span>Solicitation/acceptance of donations, subsidies, grants, etc';
                 $generate_captal_orig =  ($survey_info_orig->generate_capital[3] == "1" ? "X - ": "").'</span>Solicitation/acceptance of donations, subsidies, grants, etc';
                 if($generate_captal != $generate_captal_orig )
                 {
                  $generate_captal = '<b>'.$generate_captal.'</b>';
                 }
              ?>
              <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?=  $generate_captal ?> </p>

              <p class="text-justify font-weight-normal"><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->generate_capital[4] == "1") ? "X - ": ""?></span>Fund raising activities</p>
            </li>
            <li>
               How much is the Cooperative’s initial operating capital? <u><?php
               $operating_capital = ($capitalization_info->total_amount_of_paid_up_capital!=$capitalization_info->total_amount_of_paid_up_capital ? '<b>'.number_format($capitalization_info->total_amount_of_paid_up_capital,2).'</b>': number_format($capitalization_info->total_amount_of_paid_up_capital,2));
               echo $operating_capital;
               ?></u>.
            </li>
            <li>
              Strategies for internal capital build-up. <u><?=($survey_info->strategy_capital_build_up!=$survey_info_orig->strategy_capital_build_up ? '<b>'.$survey_info->strategy_capital_build_up.'</b>' : $survey_info->strategy_capital_build_up)?></u>.
            </li>
          </ol>
        </li>
        <li>Revenue<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Projected revenue based on the initial operating capital.<br>
            <p class="text-justify">First Year : <u><?= ($survey_info->revenue_first_year!=$survey_info_orig->revenue_first_year ? '<b>'.number_format($survey_info->revenue_first_year,2).'</b>' : number_format($survey_info->revenue_first_year,2))?></u>.</p>
            <p class="text-justify ">Second Year : <u><?=($survey_info->revenue_second_year!=$survey_info_orig->revenue_second_year ? '<b>'. number_format($survey_info->revenue_second_year,2).'</b>' :  number_format($survey_info->revenue_second_year,2))?></u>.</p>
            <p class="text-justify">Third Year : <u><?= ($survey_info->revenue_third_year!=$survey_info_orig->revenue_third_year ? '<b>'.number_format($survey_info->revenue_third_year,2).'</b>' : number_format($survey_info->revenue_third_year,2))?></u>.</p>
        </li>
        <li>Expenditure<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;How much is the estimated expenses, for:<br>
            <p class="text-justify ">First Year : <u><?= ($survey_info->expenditure_first_year!=$survey_info_orig->expenditure_first_year ? '<b>'.number_format($survey_info->expenditure_first_year,2).'</b>' : number_format($survey_info->expenditure_first_year,2))?></u>.</p>
            <p class="text-justify">Second Year : <u><?= ($survey_info->expenditure_second_year!=$survey_info_orig->expenditure_second_year ? '<b>'.number_format($survey_info->expenditure_second_year,2).'</b>' : number_format($survey_info->expenditure_second_year,2))?></u>.</p>
            <p class="text-justify">Third Year : <u><?= ($survey_info->expenditure_third_year!=$survey_info_orig->expenditure_third_year ? '<b>'.number_format($survey_info->expenditure_third_year,2).'</b>' : number_format($survey_info->expenditure_third_year))?></u>.</p>
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
                <!-- <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->investments[1] == "1") ? "X - ": ""?></span>Federation</td>
                <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->investments[4] == "1") ? "X - ": ""?></span>Insurance</td> -->
                <?php
                $invesments_federation =  ($survey_info->investments[1] == "1" ? "X - ": "");
                 $invesments_federation_orig =  ($survey_info_orig->investments[1] == "1" ? "X - ": "");
                 if(  $invesments_federation !=  $invesments_federation_orig)
                 {
                    $invesments_federation = '<b>'.  $invesments_federation.'</b>';
                 }

                 $investments_insurance = ($survey_info->investments[4] == "1" ? "X - ": "");
                  $investments_insurance_orig = ($survey_info_orig->investments[4] == "1" ? "X - ": "");
                 if( $investments_insurance!= $investments_insurance_orig)
                 {
                   $investments_insurance = '<b>'. $investments_insurance.'</b>';
                 } 
                ?>
                <td><span style="font-family: DejaVu Sans; sans-serif;"><?=  $invesments_federation ?></span>Federation</td>
                <td><span style="font-family: DejaVu Sans; sans-serif;"><?= $investments_insurance?></span>Insurance</td>
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
             <!--  <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[0] == "1") ? "X - ": ""?></span>Typewriter</td>
              <td><span style="font-family: DejaVu Sans; sans-serif;"><?php echo ($survey_info->equipments_etc[7] == "1") ? "X - ": ""?></span>Medical Instruments</td> -->
              <?php
                $Typewriter_ = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[0] == "1" ? "X - ": "").'</span>Typewriter';
                $Typewriter_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[0] == "1" ? "X - ": "").'</span>Typewriter';
                if($Typewriter_!=$Typewriter_orig)
                {
                  $Typewriter_=  '<b>'.$Typewriter_.'</b>';
                }

                $medical_inst ='<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[7] == "1" ? "X - ": "").'</span>Medical Instruments';
                 $medical_inst_orig ='<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[7] == "1" ? "X - ": "").'</span>Medical Instruments';
                 if( $medical_inst != $medical_inst_orig)
                 {
                   $medical_inst = '<b>'. $medical_inst.'</b>';
                 }
              ?>
               <td><?=$Typewriter_?></td>
              <td><?= $medical_inst?></td>

            </tr>
            <tr>
              <?php
                $computer = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[1] == "1" ? "X - ": "").'</span>Computer';
               $computer_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[1] == "1" ? "X - ": "").'</span>Computer';
              if($computer!=$computer_orig)
              {
                $computer = '<b>'.$computer.'</b>';
              }
             
              $warehouse ='<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[8] == "1" ? "X - ": "").'</span>Warehouse';
                $warehouse_orig ='<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[8] == "1" ? "X - ": "").'</span>Warehouse';
                $warehouse = ($warehouse != $warehouse_orig ? '<b>'.$warehouse.'</b>' : $warehouse);
               ?>
              <td><?=$computer?></td>
              <td><?=  $warehouse?></td>
            </tr>

            <tr>
              <?php
                  $tables = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[2] == "1" ? "X - ": "").'</span>Tables';
                   $tables_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[2] == "1" ? "X - ": "").'</span>Tables';
                   $tables = ($tables != $tables_orig ? '<b>'.$tables.'</b>' : $tables);

                $milling = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[9] == "1" ? "X - ": "").'</span>Milling';
                $milling_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[9] == "1" ? "X - ": "").'</span>Milling';   
                $milling = ($milling != $milling_orig ? '<b>'.$milling.'</b>' : $milling);
              ?>
              <td><?=$tables?></td>
              <td><?= $milling?></td>
            </tr>

            <tr>
              <?php
              $chairs = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[3] == "1" ? "X - ": "").'</span>Chairs';
                 $chairs_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[3] == "1" ? "X - ": "").'</span>Chairs';
                 $chairs = ($chairs != $chairs_orig ? '<b>'.$chairs.'</b>' : $chairs);

              $farm_eq = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[10] == "1" ? "X - ": "").'</span>Farm Equipment';  
              $farm_eq_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[10] == "1" ? "X - ": "").'</span>Farm Equipment';   
              $farm_eq = ($farm_eq!=$farm_eq_orig ? '<b>'.$farm_eq.'</b>' : $farm_eq);
              ?>
              <td><?=$chairs ?></td>
              <td><?=  $farm_eq ?></td>
            </tr>

            <tr>
              <?php
              $calculator = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[4] == "1" ? "X - ": "").'</span>Calculator';
              $calculator_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[4] == "1" ? "X - ": "").'</span>Calculator';
              $calculator = ($calculator != $calculator_orig ? '<b>'.$calculator.'</b>' : $calculator);

              $post_harvest = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[11] == "1" ? "X - ": "").'</span>Post Harvest Equipment';
              $post_harvest_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[11] == "1" ? "X - ": "").'</span>Post Harvest Equipment';
              $post_harvest = ($post_harvest!=$post_harvest_orig ? '<b>'.$post_harvest.'</b>' : $post_harvest );
              ?>
              <td><?=$calculator?></td>
              <td><?=$post_harvest ?></td>
            </tr>

            <tr>
              <?php
              $vault_safe = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[5] == "1" ? "X - ": "").'</span>Vault/Safe';
              $vault_safe_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[5] == "1" ? "X - ": "").'</span>Vault/Safe';
              $vault_safe=($vault_safe!=$vault_safe_orig ? '<b>'.$vault_safe.'</b>' : $vault_safe);

              $solar_dryer ='<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[12] == "1" ? "X - ": "").'</span>Solar Dryer';
              $solar_dryer_orig ='<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[12] == "1" ? "X - ": "").'</span>Solar Dryer';
              $solar_dryer = ($solar_dryer!=$solar_dryer_orig ? '<b>'.$solar_dryer.'</b>' : $solar_dryer);
              ?>
              <td><?= $vault_safe?></td>
              <td><?= $solar_dryer?></td>
            </tr>

            <tr>
              <?php
              $filing_cabinet = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[6] == "1" ? "X - ": "").'</span>Filing Cabinet';
              $filing_cabinet_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[6] == "1" ? "X - ": "").'</span>Filing Cabinet';
              $filing_cabinet=($filing_cabinet!=$filing_cabinet_orig ? '<b>'.$filing_cabinet.'</b>' : $filing_cabinet);

              $fishing_eq ='<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->equipments_etc[13] == "1" ? "X - ": "").'</span>Fishing Equipment';
              $fishing_eq_orig ='<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->equipments_etc[13] == "1" ? "X - ": "").'</span>Fishing Equipment';

              $fishing_eq = ($fishing_eq!=$fishing_eq_orig ? '<b>'.$fishing_eq.'</b>' : $fishing_eq);
              ?>
              <td><?=$filing_cabinet?></td>
              <td><?=$fishing_eq?></td>
            </tr>

            <tr>
              <?php
              $othr = '';
              $othr_orig='';
              $othr = $survey_info->equipments_etc_others;
              $othr_orig = $survey_info_orig->equipments_etc_others;
              if($othr!==$othr_orig)
              {
                if(strlen($othr)>0)
                {
                 $othr = "<b>X -</b> Others (specify) <b><u>". $othr."</u></b>";
                }
              }
              else
              {
                $othr = "X - Others (specify)_______";
              }

              $othr = ($othr!=$othr_orig ? '<b>'.$othr.'</b>' : $othr);
              ?>
              <td colspan="2"><span style="font-family: DejaVu Sans; sans-serif;"></span><?= $othr?> </td>
            </tr>
          </tbody>
        </table>
        <li> How would the Cooperative procure its equipment/machineries/facilities?</li>
        <table class="table table-borderless table-sm">
          <tbody>
            <tr>
              <?php
              $cash = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->procure_equipments_etc[0] == "1" ? "X - ": "").'</span>Cash';
               $cash_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->procure_equipments_etc[0] == "1" ? "X - ": "").'</span>Cash';
               $cash = ($cash!=$cash_orig ? '<b>'.$cash.'</b>' : $cash);

               $loans = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->procure_equipments_etc[1] == "1" ? "X - ": "").'</span>Loans';
              $loans_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->procure_equipments_etc[1] == "1" ? "X - ": "").'</span>Loans';
              $loans=($loans!=$loans_orig);

              $donations = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info->procure_equipments_etc[2] == "1" ? "X - ": "").'</span>Donations';
               $donations_orig = '<span style="font-family: DejaVu Sans; sans-serif;">'.($survey_info_orig->procure_equipments_etc[2] == "1" ? "X - ": "").'</span>Donations';
               $donations =($donations!=$donations_orig ? '<b>'.$donations.'</b>' : $donations);
              ?>
              <td><?=$cash?></td>
              <td><?=$loans?></td>
              <td><?= $donations?></td>
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
                <p class="text-justify" style="text-indent: 10px;"> <u><?= ($survey_info->skills_etc_necessary_equipments_etc!=$survey_info_orig->skills_etc_necessary_equipments_etc ? '<b>'.$survey_info->skills_etc_necessary_equipments_etc.'</b>' : $survey_info->skills_etc_necessary_equipments_etc)?></u>.</p>
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
      <p class="text-justify" style="text-indent: 10px;">
        1. What qualifications/skills the Board of Directors should possess to enable them to formulate sound policies, strategies and guidelines which would ensure the success of the Cooperative?<br>
          <u><?= ($survey_info->qualifications_directors!=$survey_info_orig->qualifications_directors ? '<b>'.$survey_info->qualifications_directors.'</b>' : $survey_info->qualifications_directors)?></u>
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
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered table-sm" style="margin-left:-60px">
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
            <?php foreach($staff_list as $key => $staff) : ?>
              <?php
              
               if(empty($staff_list_orig[$key]))
               {
                $staff_list_orig[$key] =0;
               }

                 $staff_orig = $staff_list_orig[$key];
              ?>
              <tr>
                <td><?= ucfirst(($staff['position']!=$staff_orig['position'] ? '<b>'.$staff['position'].'</b>' : $staff['position']))?></td>
                <td><?= ($staff['full_name']!=$staff_orig['full_name'] ? '<b>'.$staff['full_name'].'</b>' : $staff['full_name'])?></td>
                <td><?= ($staff['status_of_appointment']!=$staff_orig['status_of_appointment'] ? '<b>'.$staff['status_of_appointment'].'</b>' : $staff['status_of_appointment'])?></td>
                <td><?= ($staff['minimum_education_experience_training']!=$staff_orig['minimum_education_experience_training'] ? '<b>'.$staff['minimum_education_experience_training'].'</b>' : $staff['minimum_education_experience_training'])?></td>
                <td><?= ($staff['monthly_compensation']!=$staff_orig['monthly_compensation'] ? '<b>'.number_format($staff['monthly_compensation'],2).'</b>' : number_format($staff['monthly_compensation'],2))?></td>
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
            <li><strong>Members: </strong> <u><?= ($survey_info->education_programs_members!=$survey_info_orig->education_programs_members ? '<b>'.$survey_info->education_programs_members.'</b>' : $survey_info->education_programs_members) ?></u></li>
            <li><strong>Officers: </strong> <u><?= ($survey_info->education_programs_officers!=$survey_info_orig->education_programs_officers ? '<b>'.$survey_info->education_programs_officers.'</b>' : $survey_info->education_programs_officers) ?></u></li>
            <li><strong>Staff: </strong> <u><?= ($survey_info->education_programs_staff!=$survey_info_orig->education_programs_staff ? '<b>'.$survey_info->education_programs_staff.'</b>' : $survey_info->education_programs_staff) ?></u></li>
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
            <?php //echo '<pre>';print_r($committees_list); echo'</pre>'; ?>
            <?php foreach($committees_list as $key => $committee) : ?>
              <?php //$committee_orig =array();
              if(isset($committees_list_orig[$key]))
              {
                // $committees_list_orig[$key]=0;
                $committee_orig = $committees_list_orig[$key]; 
              }
               
               ?>
            <li><strong><?= ($committee['name_of_committee']!=$committee_orig['name_of_committee'] ? '<b>'.$committee['name_of_committee'].'</b>' : $committee['name_of_committee'])?></strong>
              <ol class="text-justify" type="1">

              <?php foreach($committee['committees_cooperator_list'] as $keys => $coop_name) :
                // var_dump($committee_orig['committees_cooperator_list']);
                // var_dump($committee['committees_cooperator_list']);
               ?>
                <?php 
                // $committee_orig['committees_cooperator_list']=[];
                $keys = 0;
                if(empty($committee_orig['committees_cooperator_list'][$keys]) || $committee_orig['committees_cooperator_list'][$keys] =NULL )
                {
                     $coop_name_orig = '';
                }
                
                // echo '<pre>';print_r($committee_orig['committees_cooperator_list'][$keys]);echo'</pre>';
                // echo'<pre>'; print_r($committee['committees_cooperator_list'][$keys]);  echo'</pre>';

                $coop_name_orig = array();
                 $coop_name_orig = $committee_orig['committees_cooperator_list'][$keys]; 
                 ?>
                <li><?=($coop_name!=$coop_name_orig ? '<b>'.$coop_name.'</b>' : $coop_name)?></li> 
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
  <?php if(sizeof($cooperator_directors) >=3) :?>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <td><b><?=$cooperator_directors[0]['full_name']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[1]['full_name']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[2]['full_name']?></b><br>Director</td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif;?>
  <?php if(sizeof($cooperator_directors) >=5) :?>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <td><b><?=$cooperator_directors[3]['full_name']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[4]['full_name']?></b><br>Director</td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif;?>
  <?php if(sizeof($cooperator_directors) >=8) :?>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <td><b><?=$cooperator_directors[5]['full_name']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[6]['full_name']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[7]['full_name']?></b><br>Director</td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif;?>
  <?php if(sizeof($cooperator_directors) >=10) :?>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <td><b><?=$cooperator_directors[8]['full_name']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[9]['full_name']?></b><br>Director</td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif;?>
  <?php if(sizeof($cooperator_directors) >=13) :?>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <td><b><?=$cooperator_directors[10]['full_name']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[11]['full_name']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[12]['full_name']?></b><br>Director</td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif;?>
  <?php if(sizeof($cooperator_directors) >=15) :?>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="table-responsive text-center">
          <table class="table table-borderless table-sm table-director">
              <tr>
                <td><b><?=$cooperator_directors[13]['full_name']?></b><br>Director</td>
                <td><b><?=$cooperator_directors[14]['full_name']?></b><br>Director</td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif;?>
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
            <!--   <?=$count++;?> -->
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
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>
