<!DOCTYPE html>

<html lang="en">

  <head>

    <title>CoopRIS <?= $title ?></title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="">


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

        

         $proposedName_previousinal = trim(preg_replace('/\s\s+/', ' ', $proposedName_previousinal));

          $proposedName = trim(preg_replace('/\s\s+/', ' ', $proposedName));

          if(trim($proposedName) === trim($proposedName_previousinal))

          {

              

          }

          else

          {

            $proposedName ='<strong>'.$proposedName .'</strong>';

          }


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

          <p class="font-weight-bold">Article VI<br>Area of Operation and Postal Address of the Principal Office</p>

    </div>

   

  </div>

  <div class="row mb-4">

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

    <div class="col-sm-12 col-md-12 text-left">
      <?php
       $address = $coop_info->house_blk_no.' '.ucwords($coop_info->street).$x.' '.$coop_info->brgy.' '.($in_chartered_cities ? $chartered_cities : $coop_info->city.', '.$coop_info->province).' '.$coop_info->region;

      $address_previous = $coop_info_previous->house_blk_no.' '.ucwords($coop_info_previous->street).$x.' '.$coop_info_previous->brgy.' '.($in_chartered_cities_previous ? $chartered_cities_previous : $coop_info_previous->city.', '.$coop_info_previous->province).' '.$coop_info_previous->region;
      ?>
      <p class="text-justify" style="text-indent: 50px;">That the membership of this Union shall come from <?=$area_of_operation_?> 

      Its principal office shall be located at <?=(strcasecmp($address, $address_previous)!=0 ? '<b>'.$address.'</b>' : $address)?>.
        
      </p>

    </div>

  </div>

  <!-- <div class="row mb-2">

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

  </div> -->

  <!--  <?php 

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

  ?> -->

  <div class="row mb-2">

    <div class="col-sm-12 col-md-12 text-center">

        <p class="font-weight-bold">Article VII <!-- <?=$article8?> --><br>Cooperators</p>

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

               <th><center>Cooperative Name</center></th>

              <th><center>Postal Address of Cooperative</center></th>

              <th><center>Name of Authorized Representative of the Cooperative</center></th>

            </tr>

          </thead>

          <tbody>
      
            <?php $count=1; foreach($members_list as $key => $cooperator) :?>

              <tr>
                <td><?=$cooperator['coopName']?></td>
            
                    <td><?=$count++.'. '.$cooperator['representative']?></td>

                    <td><?= $address ?></td>

            <?php endforeach; ?>

          </tbody>

        </table>

      </div>

    </div>

  </div>



  <div class="row mb-2">

    <div class="col-sm-12 col-md-12 text-center">

        <p class="font-weight-bold">Article VIII <!-- <?=$article9?> --><br>Board of Directors</p>

    </div>

  </div>

  <div class="row ">

    <div class="col-sm-12 col-md-12 text-left">

      <p class="text-justify" style="text-indent: 50px;">That the number of Directors of this Cooperative shall be <?=num_format_custom($no_of_directors)?>(<?= $no_of_directors?>) and shall serve until their successors shall have been elected and qualified within <?=($bylaw_info->director_hold_term!=$bylaw_info_previous->director_hold_term ? "<b>".$bylaw_info->director_hold_term."</b>" : $bylaw_info->director_hold_term)?> days from the date of registration as provided in the By-laws.</p>

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

          

           <?php  $count=1; foreach($directors_list as $keys => $director) :?>

            

              <?php

            

              ?>

                <tr>

              <td>

                <?php echo $count++.'. '.$director['representative']?>

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

        <p class="font-weight-bold">Article X<!-- <?=$article12?> --><br>Arbitral Clause</p>

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

      <p class="text-justify" style="text-indent: 50px;"> <?=($treasurer_of_coop!=NULL ? $treasurer_of_coop->representative : '_____________');?> has been elected as Treasurer of this Cooperative to act as such until her/his successor shall have been duly appointed and qualified in accordance with the By-laws. As such Treasurer, he/she is authorized to receive payments and issue receipts for membership fees, share capital subscriptions and other revenues, and to pay obligations for and in the name of this Cooperative.</p>

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

              <th>Name of Cooperative</th>
              <th>Name of Representative</th>
              <th>Signature</th>

            </tr>

          </thead>

          <tbody>

            <?php /* $count=0;foreach($regular_cooperator_list as $key => $cooperator) :?>

              <?=$count++;?>

              <?php  if(isset($regular_cooperator_list_previous[$key]))

                {


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



             <?php  $count=1;foreach($members_list as $key => $cooperator) :?>

              <tr>
                <td><?=$count++.'. '.$cooperator['coopName']?></td>
                <td><?=$cooperator['representative']?></td>

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

            <?php  $count=1; foreach($members_list as $key => $cooperator) :?>

            <tr>



                <td><?=$count++.'. '.$cooperator['representative']?></td>

                <td>

                 <?=$cooperator['proof_of_identity']?>-<?=$cooperator['valid_id']?>

                </td>

                <td><?=($cooperator['date_issued']==NULL ? 'N/A' : $cooperator['date_issued'])?></td>

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

      <p class="text-justify" style="text-indent: 50px;">This instrument known as Article of Cooperation of <?= $coop_info->proposed_name?> <?=$type_of_coop?> Cooperative <?php if(strlen($coop_info->acronym)>0){ echo '('.$coop_info->acronym.')';}?>, consists of <u><?=$this->session->userdata('pagecount')?></u> pages including this page where the acknowledgment is written signed by parties and their instrumental witnesses on each and every page thereof.</p>

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

<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>

<script src="<?=base_url();?>assets/js/popper.min.js"></script>

<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>

</body>



</html>

 