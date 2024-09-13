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

   #printPage

{

  margin-left: 150px;
  padding: 0px;
  width: 770px; / width: 7in; /
  height: 900px; / or height: 9.5in; /
  clear: both;
  page-break-after: always;
  box-shadow: 2px 2px;
  margin-bottom: 10px;
}  
  </style>


<a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>amendment/<?= $encrypted_id ?>/amendment_documents" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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

<?php

// function stringToNumber($string) {

//     // return 0 if the string contains no number at all or is not a string:

//           if (!is_string($string) || !preg_match('/\d/', $string)) {

//               return 0;

//           } 



//           // Replace all ',' with '.':

//           $workingString = str_replace(',', '.', $string);



//           // Keep only number and '.':

//           $workingString = preg_replace("/[^0-9.]+/", "", $workingString);



//           // Split the integer part and the decimal part,

//           // (and eventually a third part if there are more 

//           //     than 1 decimal delimiter in the string):

//           $explodedString = explode('.', $workingString, 3);



//           if ($explodedString[0] === '') {

//               // No number was present before the first decimal delimiter, 

//               // so we assume it was meant to be a 0:

//               $explodedString[0] = '0';

//           } 



//           if (sizeof($explodedString) === 1) {

//               // No decimal delimiter was present in the string,

//               // create a string representing an integer:

//               $workingString = $explodedString[0];

//           } else {

//               // A decimal delimiter was present,

//               // create a string representing a float:

//               $workingString = $explodedString[0] . '.' .  $explodedString[1];

//           }



//           // Create a number from this now non-ambiguous string:

//           $number_ = $workingString * 1;



//           return $number_;

//       }

?>

<div class="container-fluid text-monospace" id="printPage" style=" border:1px solid black;padding:50px;">

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

            $proposedName = ltrim(rtrim($coop_info->proposed_name)).' Multipurpose  Cooperative '.$acronym_;

          } 

          else

          {

            $proposedName = ltrim(rtrim($coop_info->proposed_name)).' '.$coop_info->type_of_cooperative.' Cooperative '.$acronym_;

          }

           

              if($nextAmendment)

              {

                $proposedName_previousinal = $orig_proposedName_formated;

              }

              else

              {

                $proposedName_previousinal = $orig_proposedName_formated;

              }



          //end cooperative

            

          // $proposedName2 =$proposedName;

        

         $proposedName_previousinal = trim(preg_replace('/\s\s+/', ' ', $proposedName_previousinal));

          $proposedName = trim(preg_replace('/\s\s+/', ' ', $proposedName));

          //   var_dump($proposedName);

          // var_dump($proposedName_previousinal);

          // echo strcmp($proposedName_previousinal,trim($proposedName)); //"prints" 0

          if(trim($proposedName) === trim($proposedName_previousinal))

          {

              

          }

          else

          {

            $proposedName ='<strong>'.$proposedName .'</strong>';

          }

        



          //end amendment

      ?>

        <p class="font-weight-bold">AMENDED ARTICLES OF COOPERATION<br>of<br></p><p><?= $proposedName?></p>

    </div>

  </div>

  <div class="row mb-2">

    <div class="col-sm-12 col-md-12 text-left">

        <p class="font-weight-bold">KNOW ALL MEN BY THESE PRESENTS:</p>

    </div>

  </div>

  <div class="row mb-2 ">

    <div class="col-sm-12 col-md-12 text-left">

      <?php



      if(count(explode(',',$coop_info->type_of_cooperative))>1)

      {

        $type_of_coop ='Multipurpose';

      }

      else

      {

        $type_of_coop =$coop_info->type_of_cooperative; 

      }

      ?>

      <p class="text-justify font-weight-normal" style="text-indent: 50px;">We, the undersigned Filipino citizens, of legal age and residents of the Philippines, with a firm collective intent, have come together to organize voluntarily an <?=$type_of_coop?> Cooperative to advance what we believe is our inherent right, under the laws of the Republic of the Philippines.</p>

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

      <?php

      $new_purposes = array();

     

       // echo'<pre>';print_r($purposes_list);echo'<pre>';

      foreach($purposes_list as $key => $purpose)

        {

           $content_array = array_reverse(explode(';',$purpose['content']));

          if(isset($purposes_list_previous[$key]))

          {

            $content_array_previousn = array_reverse(explode(';',$purposes_list_previous[$key]['content']));

            if(strcasecmp($purposes_list_previous[$key]['cooperative_type'],$purpose['cooperative_type'])!=0)

            {

              $purpose['cooperative_type'] ='<b>'.$purpose['cooperative_type'].'</b>';

            }

             $new_content = array();

            foreach($content_array as $keys => $content_)

            {

              if(isset($content_array_previousn[$keys]))

              {

                // echo $content_array_previousn[$keys].'<br> '.$content_.'<br>';

                 if(strcasecmp($content_array_previousn[$keys],$content_)!=0)

                  {

                    array_push($new_content,'<b>'.$content_.'</b>');

                  }

                  else

                  {

                     array_push($new_content,$content_);

                  }  

              }

              else

              {

                  array_push($new_content,'<b>'.$content_.'</b>');

              }   

            }

            $new_content = array_reverse($new_content);

            array_push($new_purposes,array('type'=>$purpose['cooperative_type'],'content'=>$new_content));

          }

          else

          { 

            $new_content =array(); // reset content array 

            //  $new_purposes = array(); //reset array so it wont repear the previous index

            foreach($content_array as $keys => $content_)

            {

               array_push($new_content,'<b>'.$content_.'</b>');

            }

            $new_content = array_reverse($new_content);

             array_push($new_purposes,array('type'=>'<b>'.$purpose['cooperative_type'].'</b>','content'=>$new_content));

          }  

        }



        foreach($new_purposes as $final_purpose)

          {

          ?>  

            <li type="I" style="margin-top: 20px;"><?=$final_purpose['type']?></li>

          <?php

            echo'<ol><div>';     

              foreach($final_purpose['content'] as $row_content)

              {

                echo '<li>'.$row_content.'</li>';

              }

            echo'</div></ol>';  

          }



          // echo'<pre>';print_r($new_purposes);echo'<pre>';

          //  echo'<pre>';print_r($new_content);echo'<pre>';

      ?>

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

            <li> To advocate legal framework and enabling policies appropriate for the development of <?=$type_of_coop?> Cooperatives; and</li>

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

        <?php if($article_info->guardian_cooperative==1){?> <li>To act as Guardian Cooperative and accept the responsibilities of supervising and monitoring the activities of the Laboratory Cooperative and act in its behalf in dealings with third parties when capacity to contract is required. <!-- (<i class="text-danger text-left">applicable to Guardian Cooperative only</i>) --></li><?php } ?>

      </ol>

    </div>

  </div>

  <div class="row mb-2">

    <div class="col-sm-12 col-md-12 text-center">

        <p class="font-weight-bold">Article V<br>Term of years_of_existence</p>

    </div>

  </div>

  <div class="row mb-4">

    <?php

    $years_of_existence = $article_info->years_of_existence;

    $years_of_existence2=ucwords(num_format_custom($article_info->years_of_existence));



    if($article_info_previous->years_of_existence!=$article_info->years_of_existence)

    {

      $years_of_existence='<strong>'.$years_of_existence.'</strong>';

       $years_of_existence2='<strong>'. $years_of_existence2.'</strong>';

    }

  

    ?>

    <div class="col-sm-12 col-md-12 text-left">

      <p class="text-justify" style="text-indent: 50px;">The term for which this Cooperative shall exist is <?=  $years_of_existence2?> (<?= $years_of_existence?>) years from the date of its registration with the Cooperative Development Authority.</p>

    </div>

  </div>

  <div class="row mb-2">

    <div class="col-sm-12 col-md-12 text-center">

        <p class="font-weight-bold">Article VI<br>Common Bond and Field  of Membership</p>

    </div>

   

  </div>

  <div class="row mb-4">

    <?php

      

      if(strcasecmp($coop_info_previous->common_bond_of_membership,$coop_info->common_bond_of_membership)!=0)

      {

        $coop_info->common_bond_of_membership  ='<strong>'.$coop_info->common_bond_of_membership.'</strong>';

      }

    ?>

    <div class="col-sm-12 col-md-12 text-left">

      <p class="text-justify" style="text-indent: 50px;">That the common bond of membership of this Cooperative is <?= $coop_info->common_bond_of_membership?> 

      and the field of membership shall be open to all 

      <?php 

      echo $commonBond_;

      ?> 

        who are natural persons, Filipino citizens, of legal age, with the capacity to contract and possess all the qualifications and none of the disqualifications provided for in the By-laws and this Articles of Cooperation.</p>

    </div>

  </div>

  <div class="row mb-2">

    <div class="col-sm-12 col-md-12 text-center">

        <p class="font-weight-bold">Article VII<br>Area of Operation</p>

    </div>

  </div>

   <?php $area_of_operation_previous ='';?>

       <?php if($coop_info_previous->area_of_operation=="Barangay"){ ?>

        <?php

         if($in_chartered_cities_previous)

          {

            $area_of_operation_previous= $coop_info_previous->brgy.' '.$chartered_cities_previous.' '.$coop_info_previous->region;

          }

          else

          {

            $area_of_operation_previous =$coop_info_previous->brgy.' '.$coop_info_previous->city.' '.$coop_info_previous->province.' '.$coop_info_previous->region;

          }

        ?>

       <?php }else if($coop_info_previous->area_of_operation=="Municipality/City"){ ?>

         <?php

         if($in_chartered_cities)

         {

            $area_of_operation_previous = $chartered_cities.' '.$coop_info_previous->region;

         }

         else

         {

            $area_of_operation_previous =$coop_info_previous->city.' '.$coop_info_previous->province.' '.$coop_info_previous->region;

         }

         ?>

      <?php }else if($coop_info_previous->area_of_operation=="Provincial"){

         $area_of_operation_previous=$coop_info_previous->province.' '.$coop_info_previous->region;

       }else if($coop_info_previous->area_of_operation=="Regional"){

         $area_of_operation_previous= $coop_info_previous->region;

       }else{

         $area_of_operation_previous= "Philippines";

       }

       ?>

       <?php if($coop_info->area_of_operation=="Barangay"){ ?>

        <?php

          if($in_chartered_cities)

          {

            $area_of_operation_ =  $coop_info->brgy.' '.$chartered_cities.' '.$coop_info->region;

          }

          else

          {

            $area_of_operation_ =$coop_info->brgy.' '.$coop_info->city.' '.$coop_info->province.' '.$coop_info->region;

          }  

          ?>

       <?php }else if($coop_info->area_of_operation=="Municipality/City"){ ?>

         <?php

         if($in_chartered_cities)

         {

            $area_of_operation_ = $chartered_cities.' '.$coop_info->region;

         }

         else

         {

           $area_of_operation_ = $coop_info->city.' '.$coop_info->province.' '.$coop_info->region;

         }

        ?>

      <?php }else if($coop_info->area_of_operation=="Provincial"){

           $area_of_operation_= $coop_info->province.' '.$coop_info->region;

       }else if($coop_info->area_of_operation=="Regional"){

          $area_of_operation_= $coop_info->region;

       }else if($coop_info->area_of_operation=="Interregional"){

         $regions_array  = array();

          foreach ($regions_island_list as $region_island_list)

          {

            array_push($regions_array, $region_island_list['regDesc']);

          }

          $last  = array_slice($regions_array, -1);

          $first = join(', ', array_slice($regions_array, 0, -1));

          $both  = array_filter(array_merge(array($first), $last), 'strlen');

          $area_of_operation_= join(' and ', $both);

 

       }

       else{

         $area_of_operation_= "Philippines";

       }



         if(strcasecmp($area_of_operation_, $area_of_operation_previous)!=0)

         {

          $area_of_operation_= '<b>'.$area_of_operation_.'</b>';

         }

        

      if($coop_info->house_blk_no==null && $coop_info->street==null) $x=''; else $x=', ';

       ?>

  <div class="row mb-4">

    <div class="col-sm-12 col-md-12 text-left">

      <p class="text-justify" style="text-indent: 50px;">That the membership of this Cooperative shall come from <?=$area_of_operation_?><?php 

       $address = $coop_info->house_blk_no.' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.' '.($in_chartered_cities ? $chartered_cities : $coop_info->city.', '.$coop_info->province).' '.$coop_info->region;

      $address_previous = $coop_info_previous->house_blk_no.' '.ucwords($coop_info_previous->street).$x.' '.$coop_info_previous->brgy.' '.($in_chartered_cities_previous ? $chartered_cities_previous : $coop_info_previous->city.', '.$coop_info_previous->province).' '.$coop_info_previous->region;

       ?>. Its principal office shall be located at <?=(strcasecmp($address, $address_previous)!=0 ? '<b>'.$address.'</b>' : $address)?>.</p>

       <?php //strcasecmp($address, $address_previous);?>

    </div>

  </div>

   <?php 

  // if($coop_info->type_of_cooperative =='Transport' && $new_reg_coop){

   $array_type_coop = explode(',',$coop_info->type_of_cooperative);

  if(in_array('Transport',$array_type_coop)){

    $article8 = 'IX';

    $article9 = 'X';

    $article10 = 'XI';

    $article11 = 'XII';

    $article12 ='XIII';

  ?>

  <div class="row mb-2">

    <div class="col-sm-12 col-md-12 text-center">

        <p class="font-weight-bold">Article VIII<br>Business Operation</p>

    </div>

  </div>

  <div class="row ">

    <div class="col-sm-12 col-md-12 text-left">

      <p class="text-justify">That the business operation of the transport cooperative shall be based on the routes or whatever stated in the duly approved franchise/Certificate of Public Convenience and Necessity, issued by the concerned government agency.</p>

    </div>

  </div>

  <?php 

  }

  else

  {

    $article8 = 'VIII';

    $article9 = 'IX';

    $article10 = 'X';

    $article11 = 'XI';

    $article12 ='XII';

  }

  ?>

  <div class="row mb-2">

    <div class="col-sm-12 col-md-12 text-center">

        <p class="font-weight-bold">Article <?=$article8?><br>Name and Address of Cooperators</p>

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

            <?php /*$count=0; foreach($cooperators_list_board as $key => $cooperator) :?>

              <tr>

              <?=$count++;?>

              <?php

              // var_dump($cooperator['brgy']);

              $in_chartered_cities_cptr =false;

              if($this->charter_model->in_charter_city($cooperator['cCode']))

              {

                $in_chartered_cities_cptr=true;

                $chartered_cities_cptr =$this->charter_model->get_charter_city($cooperator['cCode']);

              }

              ?>                



              <?php

              if(isset($cooperators_list_board_previous[$key]))

              {

                  $cooperator_previous = $cooperators_list_board_previous[$key];

                   $in_chartered_cities_cptr_previous =false;

                  if($this->charter_model->in_charter_city($cooperator_previous['cCode']))

                  {

                    $in_chartered_cities_cptr_previous=true;

                    $in_chartered_cities_cptr_previous =$this->charter_model->get_charter_city($cooperator_previous['cCode']);

                  }



                  if(strcasecmp($cooperator_previous['full_name'],$cooperator['full_name'])!=0)

                  {

                    $cooperator['full_name'] ='<strong>'.$cooperator['full_name'].'</strong>';

                  }

                  if($cooperator['house_blk_no']==null && $cooperator['streetName']==null)

                  {

                     $x='';

                  }

                  else

                  {

                   $x=', '; 

                  }

                  $charter_cptr_previous='';

                  $charter_cptr = '';

                  if($in_chartered_cities_cptr)

                  {

                    $charter_cptr =$cooperator['city'];

                  }

                  else

                  {

                    $charter_cptr=$cooperator['city'].', '.$cooperator['province'];

                  }

                  if($in_chartered_cities_cptr_previous)

                  {

                    $charter_cptr_previous=$cooperator_previous['city'];

                  }

                  else

                  {

                    $charter_cptr_previous = $cooperator_previous['city'].', '.$cooperator_previous['province'];

                  }



                  $address = $cooperator['house_blk_no'].' '.$cooperator['streetName'].$x.$cooperator['brgy'].', '.$charter_cptr;



                  $address_previous = $cooperator_previous['house_blk_no'].' '.$cooperator_previous['streetName'].$x.$cooperator_previous['brgy'].', '.$charter_cptr_previous;



                  if($address != $address_previous)

                  {

                    $address = '<strong>'.$address.'</strong>';

                  } 

                  ?>

                 

                    <td><?=$count.'. '.$cooperator['full_name']?></td>

                    <td><?= $address ?></td>

                 

          <?php        

              }

              else

              {

                  if(strcasecmp($cooperator_previous['full_name'],$cooperator['full_name'])!=0)

                  {

                    $cooperator['full_name'] ='<strong>'.$cooperator['full_name'].'</strong>';

                  }

                  if($cooperator['house_blk_no']==null && $cooperator['streetName']==null)

                  {

                     $x='';

                  }

                  else

                  {

                   $x=', '; 

                  } 

                  $address = $cooperator['house_blk_no'].' '.$cooperator['streetName'].$x.$cooperator['brgy'].', '. $charter_cptr;

                  $address_previous = $cooperator_previous['house_blk_no'].' '.$cooperator_previous['streetName'].$x.$cooperator_previous['brgy'].', '.$charter_cptr_previous;

                   $address = '<strong>'.$address.'</strong>';

          ?>

                  <td><?=$count.'. '.$cooperator['full_name']?></td>

                  <td><?= $address ?></td>

                </tr>

          <?php      

              }

          ?>      

              

            <?php endforeach; */?>

           

            <?php $count=0; foreach($cooperators_list_board as $key => $cooperator) :?>

              <tr>

              <?php $count++;?>

                       



              <?php

                   $in_chartered_cities_cptr =false;

                  if($this->charter_model->in_charter_city($cooperator['cCode']))

                  {

                    $in_chartered_cities_cptr=true;

                    $chartered_cities_cptr =$this->charter_model->get_charter_city($cooperator['cCode']);

                  }

                  

                  if($cooperator['house_blk_no']==null && $cooperator['streetName']==null)

                  {

                     $x='';

                  }

                  else

                  {

                   $x=', '; 

                  }

                  $charter_cptr = '';

                  if($in_chartered_cities_cptr)

                  {

                    $charter_cptr =$cooperator['city'];

                  }

                  else

                  {

                    $charter_cptr=$cooperator['city'].', '.$cooperator['province'];

                  }


                  $address = $cooperator['house_blk_no'].' '.$cooperator['streetName'].$x.$cooperator['brgy'].', '.$charter_cptr;

                  ?>

                    <td><?=$count.'. '.$cooperator['full_name']?></td>

                    <td><?= $address ?></td> 

          
            <?php endforeach;?>

          </tbody>

        </table>

      </div>

    </div>

  </div>



  <div class="row mb-2">

    <div class="col-sm-12 col-md-12 text-center">

        <p class="font-weight-bold">Article <?=$article9?><br>Board of Directors</p>

    </div>

  </div>

  <div class="row ">

    <div class="col-sm-12 col-md-12 text-left">

      <p class="text-justify" style="text-indent: 50px;">That the number of Directors of this Cooperative shall be <?=num_format_custom($no_of_directors)?>(<?= $no_of_directors?>) and shall serve until their successors shall have been elected and qualified within <?=($article_info->directors_turnover_days!=$article_info_previous->directors_turnover_days ? "<b>".$article_info->directors_turnover_days."</b>" : $article_info->directors_turnover_days)?> days from the date of registration as provided in the By-laws.</p>

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

            <?php /* $count=0; foreach($directors_list as $keys => $director) :?>

              <?=$count++;?>

              <?php

              // var_dump($directors_list_previous);  

              if(isset($directors_list_previous[$keys]))

              {

                $director_previous = $directors_list_previous[$keys];

              ?>

                <tr>

              <td>

                <?php

                if(strcasecmp($director_previous['full_name'],$director['full_name'])!=0)

                {

                  $director['full_name'] = "<b>".$director['full_name']."</b>";

                }

                echo $count.'. '.$director['full_name']?>

                </td>

             </tr> 

              <?php

              }

              else

              {

              ?>

                 <tr>

              <td>

                <?php

               

                echo $count.'. <b>'.$director['full_name'].'</b>'?>

                </td>

             </tr> 

              <?php

              } */

              ?>

           <?php  $count=0; foreach($directors_list as $keys => $director) :?>

              <?php $count++;?>

              <?php

            

              ?>

                <tr>

              <td>

                <?php echo $count.'. '.$director['full_name']?>

                </td>

             </tr> 

             

           

          <?php endforeach;?>

          </tbody>

        </table>

      </div>

    </div>

  </div>

  <div class="row mb-2">

    <div class="col-sm-12 col-md-12 text-center">

        <p class="font-weight-bold">Article <?=$article10?><br>Capitalization</p>

    </div> 

  </div>

  <div class="row ">

    <?php

    $authorized_share_capital='';

    $authorized_share_capital2='';

    if($capitalization_info_previous->authorized_share_capital!=$capitalization_info->authorized_share_capital)

    {

      $authorized_share_capital = '<strong>'.ucwords(num_format_custom($capitalization_info->authorized_share_capital)).'</strong>';

       $authorized_share_capital2 = '<strong>'.number_format($capitalization_info->authorized_share_capital,2).'</strong>';

    }

    else

    {

       $authorized_share_capital = ucwords(num_format_custom($capitalization_info->authorized_share_capital));

        $authorized_share_capital2 = number_format($capitalization_info->authorized_share_capital,2);

    }

    if($capitalization_info_previous->common_share!=$capitalization_info->common_share)

    {

      $common_share='<strong>'.ucwords(num_format_custom($capitalization_info->common_share)).'</strong>';

       $common_share2='<strong>'.$capitalization_info->common_share.'</strong>';

    }

    else

    {

       $common_share=ucwords(num_format_custom($capitalization_info->common_share));

       $common_share2=$capitalization_info->common_share;

    }



    if($capitalization_info_previous->par_value!=$capitalization_info->par_value)

    {

     $capitalization_info->par_value='<strong>'.$capitalization_info->par_value.'</strong>';

    }



    if($capitalization_info_previous->preferred_share!=$capitalization_info->preferred_share)

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



    if($capitalization_info_previous->par_value!=$capitalization_info->par_value)

    {

      $par_value_preferred='<strong>'.ucwords(num_format_custom($capitalization_info->par_value)).'</strong>';

       $par_value_preferred2='<strong>'.$capitalization_info->par_value.'</strong>';

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

        <li> <?= (strcasecmp($capitalization_info->common_share,$capitalization_info_previous->common_share)!=0 ? '<b>'.ucwords(num_format_custom($capitalization_info->common_share)).'</b>' : ucwords(num_format_custom($capitalization_info->common_share)))?>  (<?= (strcasecmp($capitalization_info->common_share, $capitalization_info_previous->common_share)!=0 ? '<b>'.number_format($capitalization_info->common_share).'</b>' : number_format($capitalization_info->common_share))?>) common shares with a par value of <?= ucwords(num_format_custom($capitalization_info->par_value))?> Pesos (Php <?=number_format($capitalization_info->par_value,2)?> ) per share;</li>

        <?php if($bylaw_info->kinds_of_members == 2) :?>

        <li> <?= $preferred_share?> (<?= $preferred_share3?>) preferred shares with a par value of <?= number_format($capitalization_info->par_value,2)?> Pesos (Php <?=number_format($capitalization_info->par_value,2)?> ) per share.</li>

        <?php endif;?>

      </ol>

    </div>

  </div> 

  <div class="row mb-2">

    <div class="col-sm-12 col-md-12 text-center">

        <p class="font-weight-bold">Article <?=$article11?><br>Subscribed and Paid-up Share Capital</p>

    </div>

  </div>

  <div class="row ">

    <?php

      $totalRegular =  $total_regular['total_subscribed'] * $capitalization_info->par_value;

      $total_regular_words=$total_regular['total_subscribed'] * $capitalization_info->par_value;

      $totalRegular_previous = $total_regular_previous['total_subscribed'] * $capitalization_info_previous->par_value;

      if(strcasecmp($totalRegular_previous,$totalRegular)!=0)

      {

        $totalRegular='<strong>'.number_format($totalRegular,2).'</strong>';

         $total_regular_words = '<b>'.ucwords(num_format_custom( $total_regular_words)).'</b>';

      }

      else

      {

         $totalRegular=number_format($totalRegular,2);

          $total_regular_words = ucwords(num_format_custom($totalRegular));



      }



      $regular_total_subscibed = $total_regular['total_subscribed'] * $capitalization_info->par_value + ($total_associate['total_subscribed'] * $capitalization_info->par_value);

       $regular_total_subscibed_previous = $total_regular_previous['total_subscribed'] * $capitalization_info_previous->par_value + ($total_associate_previous['total_subscribed'] * $capitalization_info_previous->par_value);

         $regular_total_subscibed2='';

          $regular_total_subscibed2= num_format_custom($regular_total_subscibed);

      if($regular_total_subscibed_previous!=$regular_total_subscibed)

      {   

          $regular_total_subscibed2 = '<strong>'.ucwords(num_format_custom($regular_total_subscibed)).'</strong>';

        $regular_total_subscibed = '<strong>'.number_format($regular_total_subscibed,2).'</strong>';

      

      }

      else

      {

          $regular_total_subscibed2 =ucwords(num_format_custom($regular_total_subscibed));

        $regular_total_subscibed = number_format($regular_total_subscibed,2);

      }

      

      // echo $total_regular['total_subscribed'].'a' .$capitalization_info->par_value .'b'.$total_associate['total_subscribed'] .'c'. $preferred_share2;

      $totalRegular2 =($total_regular['total_subscribed'] * $capitalization_info->par_value) + ($total_associate['total_subscribed'] * $capitalization_info->preferred_share);

      $totalRegular2_previous =($total_regular_previous['total_subscribed'] * $capitalization_info->par_value) + ($total_associate_previous['total_subscribed'] *$capitalization_info->par_value);



      //else

      if(  $totalRegular2_previous!=  $totalRegular2)

      {

          $totalRegular2 = '<strong>'.ucwords(num_format_custom($totalRegular2)).'</strong>';

      }

      $paidUp =($total_regular['total_paid'] * $capitalization_info->par_value) + ($total_associate['total_paid'] * $capitalization_info->par_value);

      $paidUp_previous =($total_regular_previous['total_paid'] * $capitalization_info_previous->par_value) + ($total_associate_previous['total_paid'] * $capitalization_info_previous->par_value);

      if($paidUp_previous!=$paidUp)

      {

           $paidUpsss = '<strong>'.number_format($paidUp,2).'</strong>';

        $paidUp = '<strong>'.ucfirst(num_format_custom($paidUp)).'</strong>';

       

      }

      else

      {

           $paidUpsss = number_format($paidUp,2);

        $paidUp = ucfirst(num_format_custom($paidUp));

      }



    ?>

    <div class="col-sm-12 col-md-12 text-left"> 

      <p class="text-justify" style="text-indent: 50px;">That of the authorized share capital, the amount of

        <?php echo ($bylaw_info->kinds_of_members == 1) ? $total_regular_words : $regular_total_subscibed2 ;?> Pesos

        (Php <?php echo ($bylaw_info->kinds_of_members == 1) ? $totalRegular : ($regular_total_subscibed);?>) has been subscribed, and

        <!-- <?php echo ($bylaw_info->kinds_of_members == 1) ? $totalRegular2 :   $paidUp;?> -->

        <?=ucwords($paidUp)?> Pesos

        (Php <?php echo ($bylaw_info->kinds_of_members == 1) ? $paidUpsss : $paidUpsss ;?>) of the total subscription has been paid by the following members-subscribers:</p>

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

      

               <?php

               $count=0; 

               foreach($regular_cooperator_list_new as $key => $regular) : ?>

              <tr>

              <?php $count++; ?>


                  <td><?=$count?> <?=($regular['full_name']!=$regular['orig_full_name'] ? "<b>".$regular['full_name']."</b>" : $regular['full_name'])?></td>

                  <td style="text-align: center;">

                    <?= ($regular['number_of_subscribed_shares']!=$regular['orig_number_of_subscribed_shares'] ? '<strong>'.$regular['number_of_subscribed_shares'].'</strong>' : $regular['number_of_subscribed_shares'])?></td>

                  <td style="text-align: right;"><?= number_format(($regular['number_of_subscribed_shares'] * $capitalization_info->par_value),2)?></td>

                  <td style="text-align: center;"><?= ($regular['number_of_paid_up_shares']!=$regular['orig_number_of_paid_up_shares'] ? '<strong>'.$regular['number_of_paid_up_shares'].'</strong>' : $regular['number_of_paid_up_shares'])?></td>

                  <td style="text-align: right;"><?= number_format(($regular['number_of_paid_up_shares'] * $capitalization_info->par_value),2)?></td>

            

                

            </tr>

          <?php endforeach; ?>

          

          </tbody>

          <tfoot>

            <tr>

              <td>Sub Total</td>

              <td style="text-align: center;"><?= (strcasecmp($total_regular['total_subscribed'],$total_regular_previous['total_subscribed'])!=0 ? "<b>".$total_regular['total_subscribed']."</b>" : $total_regular['total_subscribed'])?></td>



              <?php

              $sub =number_format(($total_regular['total_subscribed'] * $capitalization_info->par_value),2);

              $sub_previous= number_format(($total_regular_previous['total_subscribed'] * $capitalization_info_previous->par_value),2);

              if(strcasecmp($sub_previous, $sub)!=0)

              {

                $sub = "<b>".$sub."</b>";

              }

              ?>

              <td style="text-align: right;"><?=$sub?></td>



              <td style="text-align: center;"><?= (strcasecmp($total_regular['total_paid'],$total_regular_previous['total_paid'])!=0 ? '<b>'.$total_regular['total_paid'].'</b>' : $total_regular['total_paid']) ?></td>



              <?php

             $subs1 = number_format(($total_regular['total_paid'] * $capitalization_info->par_value),2);

              $subs1_previous = number_format(($total_regular_previous['total_paid'] * $capitalization_info_previous->par_value),2);

              if(strcasecmp($subs1_previous,$subs1)!=0)

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

              <?php $count++;?>

            <tr>

              <?php

                if(isset($associate_cooperator_list_previous[$key]))

                {

                  $associate_previous = $associate_cooperator_list_previous [$key];?>

                  ?>

                    <td><?=($associate['full_name']!=$associate_previous['full_name'] ? '<b>'.$count.'. '.$associate['full_name'].'</b>' : $count.'. '. $associate['full_name'])?></td>



                    <!--  <td><?=($associate['full_name']!=$associate_previous['full_name'] ? '<b>'.$count.'. '. $associate['full_name'].'</b>' : $count.'. '. $associate['full_name'])?></td> -->

                    <td style="text-align: center;"><?= ($associate['number_of_subscribed_shares']!=$associate_previous['number_of_subscribed_shares'] ? '<strong>'.$associate['number_of_subscribed_shares'].'</strong>' : $associate['number_of_subscribed_shares'])?></td>

                    <td style="text-align: right;"><?= number_format(($associate['number_of_subscribed_shares'] * $capitalization_info->par_value),2)?></td>



                    <td style="text-align: center;"><?= ($associate['number_of_paid_up_shares']!=$associate_previous['number_of_paid_up_shares'] ? '<strong>'.$associate['number_of_paid_up_shares'].'</strong>' : $associate['number_of_paid_up_shares'])?></td>



                    <td style="text-align: right;"><?= number_format(($associate['number_of_paid_up_shares'] * $capitalization_info->par_value),2)?></td>



                  <?php

                }

                else

                {

                ?>

                     <!-- <td><?='<b>'.$count.'. '. $associate['full_name'].'</b>'?></td> -->

                      <td><?='<b>'.$count.'. '. $associate['full_name'].'</b>' ?></td>

                      <td style="text-align: center;"><?= '<strong>'.$associate['number_of_subscribed_shares'].'</strong>'?></td>

                      <td style="text-align: right;"><?= number_format(($associate['number_of_subscribed_shares'] *$capitalization_info->par_value),2)?></td>



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

              <td style="text-align: center;"><?= ($total_associate['total_subscribed']!=$total_associate_previous['total_subscribed'] ? "<b>".$total_associate['total_subscribed']."</b>" : $total_associate['total_subscribed'])?></td>

              <td style="text-align: right;"><?= number_format(($total_associate['total_subscribed'] * $capitalization_info->par_value),2)?></td>

              <td style="text-align: center;"><?= $total_associate['total_paid'] ?></td>

              <td style="text-align: right;"><?= number_format(($total_associate['total_paid'] * $capitalization_info->par_value),2)?></td>

            </tr>

            <tr>

              <td>Grand Total</td>

              <td style="text-align: center;"><?php 

              $grand_total = $total_regular['total_subscribed'] + $total_associate['total_subscribed'];

               $grand_total_previous = $total_regular_previous['total_subscribed'] + $total_associate_previous['total_subscribed'];

               echo ($grand_total!=$grand_total_previous ? "<b>".$grand_total."</b>" : $grand_total);

              ?></td>

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

        <p class="font-weight-bold">Article <?=$article12?><br>Arbitral Clause</p>

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

      <p class="text-justify" style="text-indent: 50px;"> <?=($treasurer_of_coop!=NULL ? $treasurer_of_coop->full_name : '_____________');?> has been elected as Treasurer of this Cooperative to act as such until her/his successor shall have been duly appointed and qualified in accordance with the By-laws. As such Treasurer, he/she is authorized to receive payments and issue receipts for membership fees, share capital subscriptions and other revenues, and to pay obligations for and in the name of this Cooperative.</p>

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

            <?php /* $count=0;foreach($regular_cooperator_list as $key => $cooperator) :?>

              <?=//$count++;?>

              <?php  if(isset($regular_cooperator_list_previous[$key]))

                {

                // echo"<pre>";print_r($regular_cooperator_list_previous[$key]['full_name']).' : '.($cooperator['full_name']);echo"<pre>";

                //   var_dump($regular_cooperator_list_previous[$key]['full_name']);var_dump($cooperator['full_name']);

                  if(strcasecmp($regular_cooperator_list_previous[$key]['full_name'],$cooperator['full_name'])!=0)

                  {

                    $cooperator['full_name'] = '<b>'.$cooperator['full_name'].'</b>';

                  }

                }

                else

                {

                   $cooperator['full_name'] = '<b>'.$cooperator['full_name'].'</b>';

                }

                ?>

              <tr>

                <td><?=$count.'. '.$cooperator['full_name']?></td>

                <td></td>

              </tr>

            <?php endforeach; */?>



             <?php  $count=0;foreach($regular_cooperator_list_coop as $key => $cooperator) :?>

              <?php $count++;?>

              <tr>

                <td><?=$count.'. '.$cooperator['full_name']?></td>

                <td>Signed</td>

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

        <?php /*

        $coop_list_regular_fullname[]= array();

       

          foreach($regular_cooperator_list as $key => $cooperator)

          {

             if(isset($regular_cooperator_list_previous[$key]))

              {

                 $cooperator_previous =$regular_cooperator_list_previous[$key];

              }

              else

              {

                $regular_cooperator_list_previous[$key] =null;

                  $cooperator_previous =$regular_cooperator_list_previous[$key];

                  $cooperator_previous['full_name']=null;

              }

               $cooperator['full_name']  = trim(preg_replace('/\s\s+/', ' ', $cooperator['full_name'] ));

               $cooperator_previous['full_name'] = trim(preg_replace('/\s\s+/', ' ', $cooperator_previous['full_name']));

              if($cooperator['full_name'] !== $cooperator_previous['full_name'])

              {

                array_push($coop_list_regular_fullname,

                  array("fullname"=>"<b>".$cooperator['full_name']."</b>",

                        "proof_of_identity"=>"<b>".$cooperator['proof_of_identity']."</b>",

                         "proof_of_identity_number"=>"<b>".$cooperator['proof_of_identity_number']."</b>",

                        "proof_date_issued" => "<b>".$cooperator['proof_date_issued']."</b>",

                        "place_of_issuance" => "<b>".$cooperator['place_of_issuance']."</b>"

                      )

                );

              }

              else

              {

                 array_push($coop_list_regular_fullname,

                  array("fullname"=>$cooperator['full_name'],

                        "proof_of_identity"=>$cooperator['proof_of_identity'],

                        "proof_of_identity_number"=>$cooperator['proof_of_identity_number'],

                        "proof_date_issued" => $cooperator['proof_date_issued'],

                        "place_of_issuance" => $cooperator['place_of_issuance']

                      )

                );

              }

          }

           

            sort($coop_list_regular_fullname);

            array_filter($coop_list_regular_fullname);

            // echo"<pre>";print_r($coop_list_regular_fullname);echo"</pre>";

            // echo"<pre>";print_r($regular_cooperator_list);echo"</pre>";

        */?>

        <!-- <table class="table table-sm">

          <thead>

            <tr>

              <th>Name of Cooperators</th>

              <th>Proof of Identity (IN ACCORDANCE WITH NOTARIAL LAW)</th>

              <th>Date issued</th>

              <th>Place of Issuance</th>

            </tr>

          </thead>

          <tbody>

            <?php $count=0; foreach(array_filter($coop_list_regular_fullname) as $key => $cooperator) :?>

            <tr>

              <?=$count++;?>



                <td><?=$count.'. '.$cooperator['fullname']?></td>

                <td>

                 <?=$cooperator['proof_of_identity']?>-<?=$cooperator['proof_of_identity_number']?>

                </td>

                <td><?=$cooperator['proof_date_issued']?></td>

                <td><?=$cooperator['place_of_issuance']?></td>

              </tr>

            <?php endforeach;?>

          </tbody>

        </table> -->



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

            <?php  $count=0; foreach($regular_cooperator_list_coop as $key => $cooperator) :?>

            <tr>

              <?php $count++;?>



                <td><?=$count.'. '.$cooperator['full_name']?></td>

                <td>

                 <?=$cooperator['proof_of_identity']?>-<?=$cooperator['proof_of_identity_number']?>

                </td>

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

      <p class="text-justify" style="text-indent: 50px;">This instrument known as Article of Cooperation of <?= $coop_info->proposed_name?> <?=$type_of_coop?> Cooperative <?php if(strlen($coop_info->acronym)>0){ echo '('.$coop_info->acronym.')';}?>, consists of <u><?=($articles_pages !=NULL ?$articles_pages->total_pages :'');?></u> pages including this page where the acknowledgment is written signed by parties and their instrumental witnesses on each and every page thereof.</p>

    </div>

  </div>



  <div class="row mb-3">

    <div class="col-sm-12 col-md-12 text-left">

      <p class="text-justify" style="text-indent: 50px;">WITNESS my hand and seal this____ day of ________, 20____at_____________Philippines.</p>

    </div>

  </div>

  <div class="row">

    <div class="col-xs-12 text-left">

      <p class="font-weight-bold float-right" style="text-indent: 300px;">NOTARY PUBLIC</p>

      <p class="font-weight-normal">

      Doc. No. : ___________________<br>

      Page No.: ____________________<br>

      Book No.: ____________________<br>

      Series of ____________________

      </p>



    </div>

  </div>

</div>

<script src="<?=base_url();?>assets/js/jquery-3.7.1.min.js"></script>

<script src="<?=base_url();?>assets/js/popper.min.js"></script>

<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>

</body>



</html>

 