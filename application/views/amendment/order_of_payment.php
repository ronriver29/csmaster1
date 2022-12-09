<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="">

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <![endif]-->

  <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">

  <link rel="icon" href="<?=base_url();?>assets/img/cda.png" type="image/png">

  <style>

  @page{margin: 48px 96px 144px 96px;}

  .page_break { page-break-before: always; }

  .bord {

    border: 0.5px solid #000;

    border-collapse: collapse;

    padding: 5px;

  }

  .pera {

    

    padding: 5px;

  }

  .taas {

    border-top: 0.5px solid #000;

    border-collapse: collapse;

    padding: 5px;

  }

  </style>

</head>

<body>

  <h3 style="text-align: center;">ORDER OF PAYMENT</h3>

  <br><br>



  <table width="100%" class="bord">

     <tr>

      <td class="bord" >Order of Payment No.</td>

      <td class="bord" colspan="3" ><b><?=$refNo?></b></td>

    </tr>

    <tr>

      <td class="bord">Date</td>

      <td class="bord" colspan="3"><b><?=$tDate?></b></td>

    </tr>

    <?php

        $coop_total_amount_of_paid_up_capital=0;

        if($previous_total_paid_up_capital!=0)

        {

        $coop_total_amount_of_paid_up_capital= $previous_total_paid_up_capital;

        }



      if ($nature=='Amendment'){ 

        // $rf=0;

        // $basic_reservation_fee =300; //fixed amount

        // $name_reservation_fee =0;

        $acronym ='';

        if(strlen($coop_info->acronym)>0)

                 {

                  $acronym = '('.$coop_info->acronym.')';

                 

                 }

                

                

                if(count(explode(',',$coop_info->type_of_cooperative))>1)

                {

                  $proposeName = rtrim($coop_info->proposed_name).' Multipurpose Cooperative '.$acronym;

                }

                else

                {



                    $proposeName = rtrim($coop_info->proposed_name).' '.$coop_info->type_of_cooperative.' Cooperative '.$acronym;

                }

                

                 $orig_proposedName_formated = trim(preg_replace('/\s\s+/', ' ', $orig_proposedName_formated));

                 $proposeName = trim(preg_replace('/\s\s+/', ' ', $proposeName));

               

                $name_comparison = strcasecmp($orig_proposedName_formated,$proposeName);
                 $basic_reservation_fee =300;
                $name_reservation_fee =0;
                 if($name_comparison!=0)

                {

                

                  $name_reservation_fee = 100;

                }



                 $rf=0;
                 $percentage_amount = 0;
                 $total_amendment_fee = 0;

        //amendment paid up is greater than coop total paid up

           switch ($coop_info->category_of_cooperative) {
                  case 'Others':
                      //  if($coop_info->area_of_operation == 'National'){
                      //   $rf = 3000;
                      // } else if($coop_info->area_of_operation == 'Regional' || $coop_info->area_of_operation == 'Interregional'){
                      //   $rf = 2000;
                      // } else {
                      //   $rf = 1000;
                      // }
                      $desc = 'increased amount from dues and contribution';
                      $rf = ($coop_info->capital_contribution - $coop_info_orig->capital_contribution);

                        $diff_amount= $rf;
                        if($diff_amount>0)
                        {
                          $percentage_amount= $diff_amount * 0.001; // 1 over 10 of 1% 
                          $total_reservation_fee = $percentage_amount+ $basic_reservation_fee;
                          $rf = $total_reservation_fee;
                        }
                        else
                        {
                          $rf =  $basic_reservation_fee;
                        }

                        $lrf=(($rf)*.01>10) ?($rf)*.01 : 10;
                        if($lrf>10)
                        {
                          $total_amendment_fee=$lrf+$basic_reservation_fee;
                        }
                        else
                        {
                           $total_amendment_fee=$basic_reservation_fee;
                        }
                         if($percentage_amount>0)
                         {
                           $total_amendment_fee   = $percentage_amount +$basic_reservation_fee;  
                         }
                         else
                         {
                            $total_amendment_fee   = 300;
                         }
                           $amount_in_words = ($total_amendment_fee+$lrf+$name_reservation_fee);
                         
                      
                    break;
                  case 'Tertiary':
                  case 'Secondary':
                      $desc = 'increased in paid up capital';
                      $coop_total_amount_of_paid_up_capital=0;
                      $coop_total_amount_of_paid_up_capital= $previous_total_paid_up_capital;
                      //fixed amount
                      $diff_amount = $amendment_capitalization->total_amount_of_paid_up_capital - $coop_total_amount_of_paid_up_capital;
                      //amendment paid up is greater than coop total paid up
                      if($diff_amount>0)
                      {
                      $percentage_amount= $diff_amount * 0.001; // 1 over 10 of 1%
                      $total_reservation_fee = $percentage_amount+ $basic_reservation_fee;
                      $rf = $total_reservation_fee;
                      }
                      else
                      {
                      $rf =  $basic_reservation_fee;
                      }
                      // $lrf=(($rf+$name_reservation_fee)*.01>10) ?($rf+$name_reservation_fee)*.01 : 10;
                      $lrf=$rf*0.01;
                      if($lrf<10)
                      {
                      $lrf=10;
                      }

                      if($percentage_amount>0)
                      {
                      $total_amendment_fee   = $percentage_amount +$basic_reservation_fee;
                      }
                      else
                      {
                      $total_amendment_fee   = 300;
                      }
                      $amount_in_words = ($total_amendment_fee+$lrf+$name_reservation_fee);
                    break;  
                  default:
                      $desc = 'increased in paid up capital';
                      $coop_total_amount_of_paid_up_capital=0;
                  
                      $coop_total_amount_of_paid_up_capital=  $previous_total_paid_up_capital;
                    
                        //fixed amount
                      $diff_amount = $amendment_capitalization->total_amount_of_paid_up_capital - $coop_total_amount_of_paid_up_capital;
                      //amendment paid up is greater than coop total paid up
                      if($diff_amount>0)
                      {
                        $percentage_amount= $diff_amount * 0.001; // 1 over 10 of 1% 
                        $total_reservation_fee = $percentage_amount+ $basic_reservation_fee;
                        $rf = $total_reservation_fee;
                      }
                      else
                      {
                        $rf =  $basic_reservation_fee;
                      }

                    // $lrf=(($rf+$name_reservation_fee)*.01>10) ?($rf+$name_reservation_fee)*.01 : 10;
                     $lrf=$rf*0.01;
                     if($lrf<10)
                     {
                      $lrf=10;
                     }

              
                     if($percentage_amount>0)
                     {
                       $total_amendment_fee   = $percentage_amount +$basic_reservation_fee;  
                     }
                     else
                     {
                        $total_amendment_fee   = 300;
                     }
                       $amount_in_words = ($total_amendment_fee+$lrf+$name_reservation_fee);
                    break;
                }
             
 

             

         

          ini_set('precision', 17);

          $total_ = number_format($amount_in_words,2);

          // $total_amount_in_words = ($pos = strpos($amount_in_words,'.')) ? substr( $amount_in_words,0,$pos + 3) : number_format( $amount_in_words);

          $peso_cents = '';

          if(substr($total_,-3)=='.00')

          {

          $peso_cents ='Pesos';

          }

          $w = new Numbertowords();



    echo '

    

    <tr>

      <td class="bord">Payor</td>

      <td class="bord" colspan="3"><b>'.ucwords($proposeName).'</b></td>

    </tr>

    <tr>

      <td class="bord">Nature of Payment</td>

      <td class="bord" colspan="3"><b>'.$nature.'</b></td>

    </tr>

    <tr>

      <td class="bord">Amount in Words</td>

      <td class="bord" colspan="3"><b>'.$w->convert_number($amount_in_words).' '.$peso_cents.'</b></td>

  </tr>

  <tr>

    <td class="bord" colspan="4" align="center">Particulars</td>

  </tr>'; 



  if($name_comparison!=0)

                {

                  echo'

                

                <tr>

                  <td width="23%"></td>

                  <td class="pera" width=""><b>Name Reservation Fee</b></td>

                  <td class="pera" width="5%"> </td>

                  <td class="pera" align="right" width="13%"><b>'.number_format($name_reservation_fee,2).'</b></td>

                </tr>';

                }

                echo'

                <tr> 

                <td></td>

                <td colspan="3"><b>Amendment Fee</b></td>

                </tr>

                <tr>

                <td></td>

                <td><p style="font-style:italic;font-size:11pt;">(1/10 of 1% of Php '.number_format($diff_amount,2).' '.$desc.' amounted to Php '.number_format($percentage_amount,2).' plus Php 300.00 basic fee)<p></td>

                <td class="pera" width="5%"> </td>

                <td class="pera" align="right"><b>'.number_format($total_amendment_fee,2).'</b></td>

                </tr>

                  <tr>

                <td width="23%"></td>

                  <td class="pera" width=""><b>Legal and Research Fund Fee</b></td>

                  <td class="pera" width="5%"> </td>

                  <td class="pera" align="right" width="13%"><b>'.number_format($lrf,2).'</b></td>

                </tr>

                <tr>

                  <td colspan="4"</td>

                </tr>

                <tr>

                  <td class="bord" colspan="2">Total </td>

                  <td class="taas" width="5%">Php </td>

                  <td class="taas" align="right" width="13%"><b>'. $total_.'</b></td>

                </tr>';

    }



    ?>

    <div>

    <u>Payment of Fees</u>

        <ol type="1">

            <li>The filing fees may be paid through any of the following modes, at the option of

                the applicant:</li>

                <ol type="a">

                    <li>Online payment facilities listed and available through the CoopRIS;</li>

                    <li>Cash or manager&#39;s check, through the CDA cashier where the proposed

                        cooperative will be registered.</li>

                </ol>

            In the case of payment through mode (a), the CoopRIS will generate a &quot;Payment

            Details&quot; that will indicate the amount of filing fees to be paid by the applicant.

            <li>Failure to pay within ten (10) days period will result in the automatic removal of

                the application from the system.</li>

            <li>Fees other than the computed filing fees (e.g. bank charges) shall be shouldered

                by the applicant.</li>

        </ol>

    </div>



  </table>

  <br>

  <p style="font-size: 10px;"><i>This is system generated.</i></p>



</body>