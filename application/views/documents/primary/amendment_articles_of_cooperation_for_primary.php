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
      <?php
      if(strlen($coop_info->acronym)>0)
          {
              $acronym_ ='('.$coop_info->acronym.')';
          }
          else
          {
              $acronym_='';
          }  

           $coop_type = explode(',',$coop_info->type_of_cooperative);
          if(count($coop_type)>1)
          {
            $proposedName = $coop_info->proposed_name.' Multipurpose  Cooperative '.$coop_info->grouping.' '.$acronym_;
          } 
          else
          {
              $proposedName = $coop_info->proposed_name.' '.$coop_info->type_of_cooperative.' Cooperative '.$coop_info->grouping.' '.$acronym_;
          }
             $proposedName2= $proposedName;
          if(strlen($coop_info_orig->acronym_name)>0)
          {
            $acronymOrig_ = '('.$coop_info_orig->acronym_name.')';
          }
          else
          {
            $acronymOrig_='';
          }
          $proposedName_original = $coop_info_orig->proposed_name.' '.$coop_info_orig->type_of_cooperative  .' Cooperative '.$coop_info_orig->grouping.' '.$acronymOrig_;  

          //end cooperative
          $proposedName2 =$proposedName;
          if($proposedName!=$proposedName_original)
          {
            $proposedName ='<strong>'.$proposedName .'</strong>';
          }
        

          //end amendment
      ?>
        <p class="font-weight-bold">ARTICLES OF COOPERATION<br>of<br><?= $proposedName2?></p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-left">
        <p class="font-weight-bold">KNOW ALL MEN BY THESE PRESENTS:</p>
    </div>
  </div>
  <div class="row mb-2 ">
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify font-weight-normal" style="text-indent: 50px;">We, the undersigned Filipino citizens, of legal age and residents of the Philippines, with a firm collective intent, have come together to organize voluntarily an <?= $coop_info->type_of_cooperative?> Cooperative to advance what we believe is our inherent right, under the laws of the Republic of the Philippines.</p>
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
      <p class="text-justify" style="text-indent: 50px;">That the name of this Cooperative shall be <?=$proposedName?></p>
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

    			<?php foreach($purposes_list as $key => $purpose) :
            // if(empty($purposes_list_orig[$key]))
            // {
            //   $purposes_list_orig[$key]=;

            // }
           
          ?>

          <?php if(isset($purposes_list_orig[$key])){
               $purpose_orig =$purposes_list_orig[$key];
           ?>

                <li type="I" style="margin-top: 20px;"><?= ($purpose['cooperative_type']!==$purpose_orig['cooperative_type']?'<strong>'.$purpose['cooperative_type'].'</strong>': $purpose['cooperative_type'])?></li> 
         <?php }else{ ?>
          <li type="I" style="margin-top: 20px;"></strong><?=$purpose['cooperative_type']?></li> 

         <?php } ?>                    
                 <div> <ol>
                <?php               
                 $content = explode(';',$purpose['content']);
                 $content_orig = explode(';',$purpose_orig['content']);
                 //  echo'<pre>';print_r($content);echo'</pre>';
                 // echo'<pre>';print_r($content_orig);echo'</pre>';
                  foreach($content as $keys => $contents)
                  {
                    if(empty($content_orig[$keys]))
                    {
                      $content_orig[$keys] =0;
                    }
                    $contents_orig =  $content_orig[$keys];
                    if( $contents_orig!==$contents)
                    {
                       $contents = '<strong>'. $contents.'</strong>';
                    }
                    echo '<li>'.$contents.'</li>';
                  }
                ?> 
                  </ol></div>
            
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
            <li> To advocate legal framework and enabling policies appropriate for the development of credit Cooperatives; and</li>
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
    <?php
     $years_of_existence = '';
      $years_of_existence2='';
    if($article_info_orig->years_of_existence!=$article_info->years_of_existence)
    {
      $years_of_existence='<strong>'.ucwords(num_format_custom($article_info->years_of_existence)).'</strong>';
       $years_of_existence2='<strong>'.$article_info->years_of_existence.'</strong>';
    }
    ?>
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">The term for which this Cooperative shall exist is <?=  $years_of_existence?> (<?= $years_of_existence2?>) years from the date of its registration with the Cooperative Development Authority.</p>
    </div>
  </div>
  <div class="row mb-2">
    <div class="col-sm-12 col-md-12 text-center">
        <p class="font-weight-bold">Article VI<br>Common Bond and Field  of Membership</p>
    </div>
  </div>
  <div class="row mb-4">
    <?php
      if($coop_info_orig->common_bond_of_membership!=$coop_info->common_bond_of_membership)
      {
        $coop_info->common_bond_of_membership  ='<strong>'.$coop_info->common_bond_of_membership.'</strong>';
      }
    ?>
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the common bond of membership of this Cooperative is <?= $coop_info->common_bond_of_membership?> 
      and the field of membership shall be open to all 
      <?php 
      if($coop_info->common_bond_of_membership="Institutional" || $coop_info->common_bond_of_membership="Associational")
        { 
          $name_ins_assoc = explode(',',$coop_info->name_of_ins_assoc);
          echo $coop_info->field_of_membership; 
          echo ' of ';
          $count= count($name_ins_assoc) -1;
          foreach($name_ins_assoc as $key => $ins_assoc)
          {
           
             echo $ins_assoc;
             if($key<$count)
             {
              echo ', ';
             }
          } 
        }
       if($coop_info->common_bond_of_membership="Occupational") 
        { 
          echo' of ';
          $counts= count($members_composition) -1;
          if(is_array($members_composition)) 
          {
              foreach($members_composition as $keys => $compo)
            { 
              echo $compo['composition']; 
              if($keys<$counts)
               {
                echo ', ';
               }
            }
          }   
        }
        if($coop_info->common_bond_of_membership="Residential")
        {
           echo ' of members working and/or residing in the area of operation'; 
        }
        ?> 
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
       <?php if($coop_info->area_of_operation=="Barangay"){
         echo $coop_info->brgy.' '.$coop_info->city.' '.$coop_info->province.' '.$coop_info->region;
       }else if($coop_info->area_of_operation=="Municipality/City"){
         echo $coop_info->city.' '.$coop_info->province.' '.$coop_info->region;
       }else if($coop_info->area_of_operation=="Provincial"){
         echo $coop_info->province.' '.$coop_info->region;
       }else if($coop_info->area_of_operation=="Regional"){
         echo $coop_info->region;
       }else{
         echo "Philippines";
       }
       ?>. Its principal office shall be located at <strong><?php if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';?><?=$coop_info->house_blk_no?> <?=ucwords($coop_info->street).$x?> <?=$coop_info->brgy?> <?=$coop_info->city?> <?= $coop_info->province?> <?=$coop_info->region?>.</strong></p>
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
  <div class="row mb-4" >
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
            <?php $count=0; foreach($cooperators_list_board as $key => $cooperator) :?>
              <?=$count++;?>
              <?php
              $cooperator_orig = $cooperators_list_board_orig[$key];
              if($cooperator_orig['full_name']!=$cooperator['full_name'])
              {
                $cooperator_orig['full_name'] ='<strong>'.$cooperator_orig['full_name'].'</strong>';
              }
              if($cooperator['house_blk_no']==null && $cooperator['streetName']==null)
              {
                 $x='';
              }
              else
              {
               $x=', '; 
              } 
              $address = $cooperator['house_blk_no'].' '.$cooperator['streetName'].$x.$cooperator['brgy'].', '.$cooperator['city'].', '.$cooperator['province'];
              $address_orig = $cooperator_orig['house_blk_no'].' '.$cooperator_orig['streetName'].$x.$cooperator_orig['brgy'].', '.$cooperator_orig['city'].', '.$cooperator_orig['province'];
              if($address != $address_orig)
              {
                $address = '<strong>'.$address.'</strong>';
              }
              ?>
              <tr>
                <td><?=$count.'. '.$cooperator['full_name']?></td>
                <td><?= $address ?></td>
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
      <p class="text-justify" style="text-indent: 50px;">That the number of Directors of this Cooperative shall be <?=num_format_custom($no_of_directors)?>(<?= $no_of_directors?>) and shall serve until their successors shall have been elected and qualified within <?=($article_info->directors_turnover_days!=$article_info_orig->directors_turnover_days ? "<b>".$article_info->directors_turnover_days."</b>" : $article_info->directors_turnover_days)?> days from the date of registration as provided in the By-laws.</p>
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
    <?php
    $authorized_share_capital='';
    $authorized_share_capital2='';
    if($capitalization_info_orig->authorized_share_capital!=$capitalization_info->authorized_share_capital)
    {
      $authorized_share_capital = '<strong>'.ucwords(num_format_custom($capitalization_info->authorized_share_capital)).'</strong>';
       $authorized_share_capital2 = '<strong>'.number_format($capitalization_info->authorized_share_capital,2).'</strong>';
    }
    else
    {
       $authorized_share_capital = ucwords(num_format_custom($capitalization_info->authorized_share_capital));
        $authorized_share_capital2 = number_format($capitalization_info->authorized_share_capital,2);
    }
    if($capitalization_info_orig->common_share!=$capitalization_info->common_share)
    {
      $common_share='<strong>'.ucwords(num_format_custom($capitalization_info->common_share)).'</strong>';
       $common_share2='<strong>'.$capitalization_info->common_share.'</strong>';
    }
    else
    {
       $common_share=ucwords(num_format_custom($capitalization_info->common_share));
       $common_share2=$capitalization_info->common_share;
    }

    if($capitalization_info_orig->par_value!=$capitalization_info->par_value)
    {
     $capitalization_info->par_value='<strong>'.$capitalization_info->par_value.'</strong>';
    }

    if($capitalization_info_orig->preferred_share!=$capitalization_info->preferred_share)
    {
      $preferred_share = '<strong>'. ucwords(num_format_custom($capitalization_info->preferred_share)).'</strong>';
        $preferred_share2 = '<strong>'.$capitalization_info->preferred_share.'</strong>';
        $preferred_share3 = '<strong>'.number_format($capitalization_info->preferred_share).'</strong>';
    }
    else
    {
      $preferred_share3 = number_format($capitalization_info->preferred_share);
      $preferred_share = ucwords(num_format_custom($capitalization_info->preferred_share));
        $preferred_share2 = $capitalization_info->preferred_share;
    }

    if($capitalization_info_orig->par_value!=$capitalization_info->par_value)
    {
      $par_value_preferred='<strong>'.ucwords(num_format_custom($capitalization_info->par_value)).'</strong>';
       $par_value_preferred2='<strong>'.number_format($capitalization_info->par_value).'</strong>';
    }
    else
    {
       $par_value_preferred=ucwords(num_format_custom($capitalization_info->par_value));
       $par_value_preferred2=number_format($capitalization_info->par_value);
    }
    ?>

    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That the Authorized Share Capital of this Cooperative is <?= $authorized_share_capital?> Pesos (Php <?= $authorized_share_capital2?>), divided into:</p>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-sm-12 col-md-12">
      <ol class="text-justify" type="a">
        <li> <?= ucwords(num_format_custom($capitalization_info->common_share))?> (<?= number_format($capitalization_info->common_share)?>) common shares with a par value of <?= ucwords(num_format_custom($capitalization_info->par_value))?> Pesos (Php <?=number_format($capitalization_info->par_value,2)?> ) per share;</li>
        <?php if($bylaw_info->kinds_of_members == 2) :?>
        <li> <?= $preferred_share?> (<?= $preferred_share3?>) preferred shares with a par value of <?= $par_value_preferred?> Pesos (Php <?=number_format($article_info->par_value_preferred,2)?> ) per share.</li>
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
    <?php
      $totalRegular =  $total_regular['total_subscribed'] * $capitalization_info->par_value;

      $totalRegular_orig = $total_regular_orig['total_subscribed'] * $capitalization_info_orig->par_value;
      if($totalRegular_orig != $totalRegular)
      {
        $totalRegular='<strong>'.number_format($totalRegular,2).'</strong>';
      }

      $regular_total_subscibed = $total_regular['total_subscribed'] * $capitalization_info->par_value + ($total_associate['total_subscribed'] * $capitalization_info->par_value);
       $regular_total_subscibed_orig = $total_regular_orig['total_subscribed'] * $capitalization_info_orig->par_value + ($total_associate_orig['total_subscribed'] * $capitalization_info_orig->par_value);
         $regular_total_subscibed2='';
          $regular_total_subscibed2= $regular_total_subscibed;
      if($regular_total_subscibed_orig!=$regular_total_subscibed)
      {   
          $regular_total_subscibed2 = '<strong>'.$regular_total_subscibed2.'</strong>';
        $regular_total_subscibed = '<strong>'.number_format($regular_total_subscibed,2).'</strong>';
      
      }
      
      // echo $total_regular['total_subscribed'].'a' .$capitalization_info->par_value .'b'.$total_associate['total_subscribed'] .'c'. $preferred_share2;
      $totalRegular2 =($total_regular['total_subscribed'] * $capitalization_info->par_value) + ($total_associate['total_subscribed'] * $capitalization_info->preferred_share);
      $totalRegular2_orig =($total_regular_orig['total_subscribed'] *$capitalization_info->par_value) + ($total_associate_orig['total_subscribed'] *$capitalization_info->par_value);

      //else
      if(  $totalRegular2_orig!=  $totalRegular2)
      {
          $totalRegular2 = '<strong>'.ucwords(num_format_custom($totalRegular2)).'</strong>';
      }
      $paidUp =($total_regular['total_paid'] * $capitalization_info->par_value) + ($total_associate['total_paid'] * $capitalization_info->par_value);
      $paidUp_orig =($total_regular_orig['total_paid'] * $capitalization_info_orig->par_value) + ($total_associate_orig['total_paid'] * $capitalization_info_orig->par_value);
      if($paidUp_orig!=$paidUp)
      {
           $paidUpsss = '<strong>'.number_format($paidUp,2).'</strong>';
        $paidUp = '<strong>'.num_format_custom($paidUp).'</strong>';
       
      }
      else
      {
           $paidUpsss = number_format($paidUp,2);
        $paidUp = num_format_custom($paidUp);
      }
    ?>
    <div class="col-sm-12 col-md-12 text-left">
      <p class="text-justify" style="text-indent: 50px;">That of the authorized share capital, the amount of
        <?php echo ($bylaw_info->kinds_of_members == 1) ? $totalRegular :   num_format_custom($regular_total_subscibed2) ;?>
        (Php <?php echo ($bylaw_info->kinds_of_members == 1) ? $totalRegular : ($regular_total_subscibed);?>) has been subscribed, and
        <!-- <?php echo ($bylaw_info->kinds_of_members == 1) ? $totalRegular2 :   $paidUp;?> -->
        <?=$paidUp?>
        (Php <?php echo ($bylaw_info->kinds_of_members == 1) ? $totalRegular : $paidUpsss ;?>) of the total subscription has been paid by the following members-subscribers:</p>
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
            <?php $count=0; foreach($regular_cooperator_list as $key => $regular) : ?>
              <?php $count++; ?>
              <?php $regular_orig = $regular_cooperator_list_orig[$key];?>
            <tr>
              <td><?=$count.'. '. $regular['full_name']?></td>
              <td style="text-align: center;"><?= ($regular['number_of_subscribed_shares']!=$regular_orig['number_of_subscribed_shares'] ? '<strong>'.$regular['number_of_subscribed_shares'].'</strong>' : $regular['number_of_subscribed_shares'])?></td>
              <td style="text-align: right;"><?= number_format(($regular['number_of_subscribed_shares'] * $capitalization_info->par_value),2)?></td>
              <td style="text-align: center;"><?= ($regular['number_of_paid_up_shares']!=$regular_orig['number_of_paid_up_shares'] ? '<strong>'.$regular['number_of_paid_up_shares'].'</strong>' : $regular['number_of_paid_up_shares'])?></td>
              <td style="text-align: right;"><?= number_format(($regular['number_of_paid_up_shares'] * $capitalization_info->par_value),2)?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td>Sub Total</td>
              <td style="text-align: center;"><?= ($total_regular['total_subscribed']!=$total_regular_orig['total_subscribed'] ? "<b>".$total_regular['total_subscribed']."</b>" : $total_regular['total_subscribed'])?></td>

              <?php
              $sub =number_format(($total_regular['total_subscribed'] * $capitalization_info->par_value),2);
              $sub_orig= number_format(($total_regular_orig['total_subscribed'] * $capitalization_info_orig->par_value),2);
              if($sub_orig!= $sub)
              {
                $sub = "<b>".$sub."</b>";
              }
              ?>
              <td style="text-align: right;"><?=$sub?></td>

              <td style="text-align: center;"><?= ($total_regular['total_paid']!=$total_regular_orig['total_paid'] ? '<b>'.$total_regular['total_paid'].'</b>' : $total_regular['total_paid']) ?></td>

              <?php
             $subs1 = number_format(($total_regular['total_paid'] * $capitalization_info->par_value),2);
              $subs1_orig = number_format(($total_regular_orig['total_paid'] * $capitalization_info_orig->par_value),2);
              if($subs1_orig!= $subs1)
              {
                $subs1 = '<b>'.$subs1.'</b>';
              }

              ?>
              <td style="text-align: right;"><?= $subs1?></td>
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
            <?php $count=0; foreach($associate_cooperator_list as $key => $associate) : ?>
              <?=$count++;?>

              <?php 
              // if(empty($associate_cooperator_list_orig[$key]))
              //   {
              //     $associate_cooperator_list_orig[$key]=0;
              //   }
             // $associate_orig = $associate_cooperator_list_orig [$key];?> 
            <tr>
              <?php
                if(isset($associate_cooperator_list_orig[$key]))
                {
                  $associate_orig = $associate_cooperator_list_orig [$key];?>
                  ?>
                    <td><?=($associate['full_name']!=$associate_orig['full_name'] ? '<b>'.$count.'. '. $associate['full_name'].'</b>' : $count.'. '. $associate['full_name'])?></td>

                     <td><?=($associate['full_name']!=$associate_orig['full_name'] ? '<b>'.$count.'. '. $associate['full_name'].'</b>' : $count.'. '. $associate['full_name'])?></td>
                    <td style="text-align: center;"><?= ($associate['number_of_subscribed_shares']!=$associate_orig['number_of_subscribed_shares'] ? '<strong>'.$associate['number_of_subscribed_shares'].'</strong>' : $associate['number_of_subscribed_shares'])?></td>
                    <td style="text-align: right;"><?= number_format(($associate['number_of_subscribed_shares'] * $article_info->par_value_preferred),2)?></td>

                    <td style="text-align: center;"><?= ($associate['number_of_paid_up_shares']!=$associate_orig['number_of_paid_up_shares'] ? '<strong>'.$associate['number_of_paid_up_shares'].'</strong>' : $associate['number_of_paid_up_shares'])?></td>

                    <td style="text-align: right;"><?= number_format(($associate['number_of_paid_up_shares'] * $capitalization_info->par_value),2)?></td>

                  <?php
                }
                else
                {
                ?>
                     <td><?='<b>'.$count.'. '. $associate['full_name'].'</b>'?></td>
                      <td><?='<b>'.$count.'. '. $associate['full_name'].'</b>' ?></td>
                      <td style="text-align: center;"><?= '<strong>'.$associate['number_of_subscribed_shares'].'</strong>'?></td>
                      <td style="text-align: right;"><?= number_format(($associate['number_of_subscribed_shares'] * $article_info->par_value_preferred),2)?></td>

                      <td style="text-align: center;"><?= '<strong>'.$associate['number_of_paid_up_shares'].'</strong>'?></td>

                      <td style="text-align: right;"><?= number_format(($associate['number_of_paid_up_shares'] * $capitalization_info->par_value),2)?></td>

                <?php
                }
              ?>
             
            </tr>
          <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td>Sub Total</td>
              <td style="text-align: center;"><?= ($total_associate['total_subscribed']!=$total_associate_orig['total_subscribed'] ? "<b>".$total_associate['total_subscribed']."</b>" : $total_associate['total_subscribed'])?></td>
              <td style="text-align: right;"><?= number_format(($total_associate['total_subscribed'] * $article_info->par_value_preferred),2)?></td>
              <td style="text-align: center;"><?= $total_associate['total_paid'] ?></td>
              <td style="text-align: right;"><?= number_format(($total_associate['total_paid'] * $article_info->par_value_preferred),2)?></td>
            </tr>
            <tr>
              <td>Grand Total</td>
              <td style="text-align: center;"><?php 
              $grand_total = $total_regular['total_subscribed'] + $total_associate['total_subscribed'];
               $grand_total_orig = $total_regular_orig['total_subscribed'] + $total_associate_orig['total_subscribed'];
               echo ($grand_total!=$grand_total_orig ? "<b>".$grand_total."</b>" : $grand_total);
              ?></td>
              <td style="text-align: right;"><?= number_format((($total_regular['total_subscribed'] * $capitalization_info->par_value) + ($total_associate['total_subscribed'] * $article_info->par_value_preferred)),2)?></td>
              <td style="text-align: center;"><?= $total_regular['total_paid'] + $total_associate['total_paid']?></td>
              <td style="text-align: right;"><?= number_format((($total_regular['total_paid'] * $capitalization_info->par_value ) + ($total_associate['total_paid'] *  $article_info->par_value_preferred)),2)?></td>
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
            <?php  $count=0;foreach($regular_cooperator_list as $cooperator) :?>
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
            <?php $count=0; foreach($regular_cooperator_list as $key => $cooperator) :?>
              <?=$count++;?>
              <?php $cooperator_orig =$regular_cooperator_list_orig[$key]; ?>
              <tr>
                <td><?=$count.'. '.($cooperator['full_name']!=$cooperator_orig['full_name'] ? '<strong>'.$cooperator['full_name'].'</strong>' : $cooperator['full_name'])?></td>
                <td>
                  <?php 
                  $proof_identity = $cooperator['proof_of_identity'].'-'.$cooperator['proof_of_identity_number'];
                  $proof_identity_orig = $cooperator_orig['proof_of_identity'].'-'.$cooperator_orig['proof_of_identity_number'];
                  if($proof_identity!=$proof_identity_orig)
                  {
                    $proof_identity ='<strong>'.$proof_identity.'</strong>';
                  }
                  ?>
                  <?= $proof_identity?>
                    
                </td>
                <td><?=($cooperator['proof_date_issued']!=$cooperator_orig['proof_date_issued'] ? '<strong>'.$cooperator['proof_date_issued'].'</strong>' : $cooperator['proof_date_issued'])?></td>
                <td><?=($cooperator['place_of_issuance']!=$cooperator_orig['place_of_issuance'] ? '<strong>'.$cooperator['place_of_issuance'].'</strong>': $cooperator['place_of_issuance'])?></td>
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
