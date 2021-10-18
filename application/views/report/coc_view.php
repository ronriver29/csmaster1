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
  <link rel="stylesheet" href="<?=APPPATH?>../assets/css/bootstrap.min.css">
  <link rel="icon" href="<?=APPPATH?>../assets/img/cda_new.jpg" type="image/jpg">
  <style>
  @page{margin: 60px 40px 30px 40px;}
  /*.page_break { page-break-before: always; }*/
    .calibri { font-family: Calibri, sans-serif !important; }
    .arial {font-family: "Arial Narrow",sans-serif !important;}
    .monotype{font-family:"Monotype Corsiva" !important;}

    .center {
      text-align:center;
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 400px;
      height: 390px;
      margin-left:320px;
      opacity:.2;
    }

  </style>
</head> 
<body>
    <img class="center" src="<?=APPPATH?>../assets/img/logo.png" style="background-repeat: no-repeat; background-position: center;margin-top:170px;">
  <!-- <div  style="border: 10px black double; border-radius: 30px; padding: 20px"> -->
  <div style="padding:20px;">
  <table width="100%">
    <tr>

      <!-- 
        - COC PDF revised data - (on going)
        - Revised Process of COC Issuance & Reports (80%)
       -->
  
      <td width="7%"><i style="color:white;">....</i></td>
      <td width="15%"><img src="<?=APPPATH?>../assets/img/cda_new.jpg" width="100" height="100" style="margin-left:150px;">
      <img src="<?=APPPATH?>../assets/img/dti.png" width="70" height="70" style="margin-left:400px;">
      </td>
      <td style="text-align: center;" class="calibri"><b>Republic of the Philippines<br/><font face = "Calibri (Body)">COOPERATIVE DEVELOPMENT AUTHORITY</font></b><br/>
      <b><?php
      $al = '';
       switch ($region_code) {
                        case '001':
                                 $al = 'DAGUPAN';
                          break;
                        case '002':
                                 $al = 'TUGUEGARAO';
                          break;
                          case '003':
                                 $al = 'PAMPANGA';
                          break;
                          case '004':
                                 $al = 'CALAMBA';
                          break;
                          case '005':
                                $al = 'NAGA';
                          break;
                          case '006':
                                $al = 'ILOILO';
                          break;
                          case '007':
                               $al = 'CEBU';
                          break;
                          case '008':
                               $al = 'TACLOBAN';
                          break;
                          case '009':
                              $al = 'PAGADIAN';
                          break;
                          case '010':
                              $al = 'CAGAYAN DE ORO';
                          break;
                         case '011':
                              $al = 'DAVAO';
                          break;
                          case '012':
                            $al = 'KIDAPAWAN';
                          break;
                          case '013':
                            $al = 'CARAGA';
                          break;
                          case '015':
                            $al = 'CAR';
                            break;
                          case '016':
                           $al = 'NCR';
                           break;
                           case '014':
                           $al = 'ARMM';
                           break;
                          case '017':
                           $al = 'Central Office';
                           break;
                          case '018':
                           $al = 'MIMAROPA';
                          break;
                          default:
                            $al = '';
                          break;
                      }
                      echo $al;

      ?>
      <?=$extension?></b>
    </td>
      <td width="18%"><i style="color:white;">....</i></td>
    </tr>
  </table>
<?php ?>

<table width=100% >

  <tr>
    
    <td colspan="2" style="text-align: right; font-size: 12pt;" class="calibri"><b>COC No: <?=$coc_number; ?> </b></td>
    <!-- <td colspan="2" style="text-align: right; font-size: 12pt;" class="calibri"><b>COC No: N-<?=$region_code."-".date("Y",strtotime($date_registered))."-".$coc_number; ?> </b></td> -->
  </tr>

  <tr>
    <td colspan="2" class="monotype" style="text-align: center; font-size: 32pt;font-family:'Monotype Corsiva !important','Apple Chancery','ITC Zapf Chancery','URW Chancery L',cursive;">
    <b><i><font face="Monotype Corsiva">Certificate of Compliance</font></i></b></td>
  </tr>
  <tr>
    <td><i style="color:white; font-size: 8pt">....</i></td>
  </tr>

  <tr >
    <td  colspan="2" style="font-size: 10pt"><center><i><b><font face="Monotype Corsiva">is conferred upon</font></b></i></center></td>
</tr>

  <tr>
    <td  colspan="2" style="text-align: center; font-size: 20pt;"><b></b></td>
  </tr>
  <tr>
    <td  colspan="2" style="text-align: center;"><b style=" font-size: 20pt !important;" class="calibri"><?=$coopName;?></b><br>
    <div class="arial" style="font-size:12pt;"><?=$address;?></div></td>
  </tr>


  <tr>
    <td><i style="color:white;">....</i></td>
  </tr>
  <tr>
    <td  colspan="2" style="text-align: justify; ; text-indent: 40px;"> 
    <center class="arial">A cooperative duly registered with this Authority under Registration No. <b><?=$registered_no;?></b> issued on <b><?=$date_registered;?></b> <br> <!--<?=date_format($date_registered,"F d, Y"); ?>-->
        for being compliant with all the requirements of the law and issuances of the Authority pertaining to required reports submission.</center></td>
  </tr>
  <tr>
    <td><i style="color:white;">....</i></td>
  </tr>
  <tr>
    <td colspan="2" style="text-align: justify; ;;"><center class="arial">This Certificate is issued and shall be valid until April 30, <?=$validity;?>, unless revoked.</center></td>
  </tr>
    <tr>
    <td><i style="color:white;">....</i></td>
  </tr>
  <tr>
    <td colspan="2" style="text-align: justify; ;"><center class="arial">Issued this <b><?=date("jS",strtotime($issued)); ?> day of <?=date("F",strtotime($issued)); ?> <?=date("Y",strtotime($issued)); ?></b></center></td> 
  </tr>
</table>

<table width="100%" style="margin-top:55px;">
  <tr>
  
    <td style="text-align: justify;"  class="calibri"><center><b style="font-size:16pt;"><?=$full_name;?></b> <br><?=$signatory;?></center></td>
  </tr>
  
  
</table>

</div>

</div>
</body>
