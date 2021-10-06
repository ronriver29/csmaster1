<style type="text/css">
  .cl1{
    width: 380px;
  }
  .cl11{
    width: 230px;
  }
  .cl12{
    width: 147px;
  }
  .hdr{
  
  border:1px solid black;
  text-align:center;
  background-color: lightblue;
  font-weight: bold;
  padding: 5px;
  }
  .tdbox{
          border:1px solid black;
          padding: 5px;
  }
</style>
<body>  
	<b>COOPERATIVE PROFILE</b><br/><br/>
  <table width="100%"> 
    <tr>
      <td width="38%">Name of Cooperative</td>
      <td width="62%"><?php echo $coopName; ?></td>
    </tr>
    <tr>
      <td>Registration No.</td>
      <td><?=$coop->regNo.(isset($amendment_no) ? '-'.$amendment_no : null); ?></td>
    </tr> 
    <tr>
      <td>T.I.N.</td>
      <td><?php echo $genInfo[6]?></td>
    </tr> 
    <tr>
      <td colspan="2">Address</td>
    </tr>
    <tr>
      <td><i style="color:white">....</i><i>House/Lot & Blk No.</i></td>
      <td>
        <?php echo $houseNo?></td>
    </tr>
    <tr>
      <td><i style="color:white">....</i><i>Street</i></td>
      <td><?php echo $street?></td>
    </tr>
    <tr>
      <td><i style="color:white">....</i><i>Barangay</i></td>
      <td><?php echo $brgy?></td>
    </tr>
    <tr>
      <td><i style="color:white">....</i><i>Municipality/City</i></td>
      <td><?php echo $city?></td>
    </tr>
    <tr>
      <td><i style="color:white">....</i><i>Province</i></td>
      <td><?php echo $province?></td>
    </tr>
    <tr>
      <td><i style="color:white">....</i><i>Region</i></td>
      <td><?php echo $region?></td>
    </tr>
    <tr>
      <td>Contact No.</td>
      <td><?php echo $mobileNo; ?></td>
    </tr>
    <tr>
      <td>E-mail</td>
      <td><?php echo $email; ?></td>
    </tr>
    <tr>
      <td>Cooperative Type</td>
      <td><?= join(", ",$coopType);?></td>
    </tr>
    <tr>
      <td>Asset Classification</td>
      <td><?php echo $assetSize?></td>
    </tr>
    <?php if ($assetSize=="Micro"){

        echo '<tr><td>AFS Audited by</td><td>';
        if ($afsby[0]=="1")
          echo 'Audit Committee</td></tr><tr><td>Name of Auditor other than CEA</td><td>'.$afsby[1].'</td></tr>';
        elseif ($afsby[0]=="2")
          echo 'Audit Committee of federation</td></tr><tr><td>Name of Auditor other than CEA</td><td>'.$afsby[1].'</td></tr>';
        elseif ($afsby[0]=="3")
          echo 'BOA Accredited External Auditor</td></tr><tr><td>Name of Auditor other than CEA</td><td>'.$afsby[1].'</td></tr>';
        elseif ($afsby[0]=="4")
                echo 'CDA Accredited External Auditor</td><td></td></tr>';
     }
       if ($ceaN!=null){
        echo
      '<tr>
        <td >CEA No.</td>
        <td>'.$ceaN.'</td>
      </tr>
      <tr>
        <td>Name of Accredited External Auditor</td>
        <td>'.$ceaName.'</td>
      </tr>
      <tr>
        <td>Date Issued</td>
        <td>'.(!empty($dateReg) ? date("F d, Y", strtotime($dateReg)) : null).'</td>
      </tr>
      <tr>
        <td>Validity Date</td>
        <td>'.(!empty($dateValid) ? date("F d, Y", strtotime($dateValid)) : null).'</td>
      </tr>';
    }?>
  </table>
	<br/><br/>
  <b>STATEMENT OF FINANCIAL CONDITION</b><br/><br/>
  <table>
    <tr>
      <td><b>ASSETS</b></td>
    </tr>
    <tr>
      <td><b><i style="color: white;">....</i>Current Assets</b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Cash and Cash Equivalent</td>
      <td style="text-align: right"><?php echo $sagot1; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Loans and Receivable</td>
      <td style="text-align: right"><?php echo $sagot2; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Financial Assets</td>
      <td style="text-align: right"><?php echo $sagot3; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Inventories</td>
      <td style="text-align: right"><?php echo $sagot4; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Biological Assets</td>
      <td style="text-align: right"><?php echo $sagot5; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Other Current Assets</td>
      <td style="text-align: right"><?php echo $sagot6; ?></td>
    </tr>
    <tr>
      <td class ="cl1" style="color:blue; font-weight:bold;"><i style="color: white;">........</i>Total Current Assets</td>
      <td style="color:blue;text-align: right"><b><?php echo $sagot[0]; ?></b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">.</i></td>
    </tr>
    <tr>
      <td class ="cl1"><b><i style="color: white;">....</i>Non-Current Assets</b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Financial Assets - Long Term</td>
      <td style="text-align: right"><?php echo $sagot7; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Invesment in Subsidiaries</td>
      <td style="text-align: right"><?php echo $sagot[1]; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Investment in Associates</td>
      <td style="text-align: right"><?php echo $sagot[2]; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Investment in Joint Venture</td>
      <td style="text-align: right"><?php echo $sagot[3]; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Investment Property</td>
      <td style="text-align: right"><?php echo $sagot8; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Property, Plant & Equipment</td>
      <td style="text-align: right"><?php echo $sagot9; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Biological Assets </td>
      <td style="text-align: right"><?php echo $sagot10; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Intangible Assets</td>
      <td style="text-align: right"><?php echo $sagot11; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Other Non-Current Assets</td>
      <td style="text-align: right"><?php echo $sagot12; ?></td>
    </tr>
    <tr>
      <td class ="cl1" style="color:blue; font-weight:bold;"><i style="color: white;">........</i>Total Non-Current Assets</td>
      <td style="color:blue;text-align: right"><b><?php echo $sagot[4]; ?></b></td>            
    </tr>
    <tr>
      <td class ="cl1"><b><i style="color: white;">....</i>Total Assets</b></td>
      <td style="text-align: right"><b><?php echo $sagot[5]; ?></b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">.</i></td>
    </tr>
  </table>
  <table style="page-break-before: always;">
    <tr>
      <td class ="cl1"><b>LIABILITIES</b></td>
    </tr>
    <tr>
      <td class ="cl1"><b><i style="color: white;">....</i>Current Liabilities</b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Deposit Liabilities</td>
      <td style="text-align: right"><?php echo $sagot13; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Trade and Other Payables</td>
      <td style="text-align: right"><?php echo $sagot14; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Accrued Expenses</td>
      <td style="text-align: right"><?php echo $sagot15; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Other Current Liabilities</td>
      <td style="text-align: right"><?php echo $sagot16; ?></td>
    </tr>
    <tr>
      <td class ="cl1" style="color:blue; font-weight:bold;"><i style="color: white;">........</i>Total Current Liabilities</td>
      <td style="color:blue;text-align: right"><b><?php echo $sagot[6]; ?></b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">.</i></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i><b>Non-Current Liabilities</b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Loans Payable</td>
      <td style="text-align: right"><?php echo $sagot17; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Bonds Payable</td>
      <td style="text-align: right"><?php echo $sagot18; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Revolving Capital Payable</td>
      <td style="text-align: right"><?php echo $sagot[7]; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Retirement Fund Payable</td>
      <td style="text-align: right"><?php echo $sagot[8]; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Finance Lease Payable - Long Term</td>
      <td style="text-align: right"><?php echo $sagot[9]; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Other Non-Current Liabilities</td>
      <td style="text-align: right"><?php echo $sagot19; ?></td>
    </tr>
    <tr>
      <td class ="cl1" style="color:blue; font-weight:bold;"><i style="color: white;">........</i>Total Non-Current Liabilities</td>
      <td style="color:blue;text-align: right"><b><?php echo $sagot[10]; ?></b></td>
    </tr>
    <tr>
      <td class ="cl1"><b><i style="color: white;">....</i>Total Liabilities</b></td>
      <td style="text-align: right"><b><?php echo $sagot[11]; ?></b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">.</i></td>
    </tr>
    <tr>
      <td class ="cl1"><b>MEMBERS' EQUITY</b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Paid-up Capital, Common</td>
      <td style="text-align: right"><?php echo $sagot20; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Paid-up Capital, Preferred</td>
      <td style="text-align: right"><?php echo $sagot21; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Deposit for Share Capital Subscription</td>
      <td style="text-align: right"><?php echo $sagot[12]; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Retained Earnings - Restricted (for coop banks only)</td>
      <td style="text-align: right"><?php echo $sagot[13]; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Statutory Funds</td>
      <td style="text-align: right"><?php echo $sagot22; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Donations and Grants</td>
      <td style="text-align: right"><?php echo $sagot[14]; ?></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Revatuation Surplus</td>
      <td style="text-align: right"><?php echo $sagot[15]; ?></td>
    </tr>
      <tr>
      <td class ="cl1"><i style="color: white;">....</i>Reinvestment Fund for Sustainable CAPEX (RFSC)</td>
      <td style="text-align: right"><?php echo $sagot[18]; ?></td>
    </tr>
    <tr>
      <td class ="cl1" style="color:blue; font-weight:bold;"><i style="color: white;">........</i>Total Members' Equity</td>
      <td style="color:blue;text-align: right"><b><?php echo $sagot[16]; ?></b></td>  
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">.</i></td>
    </tr>
    <tr>
      <td class ="cl1"><b><i style="color: white;">....</i>Total Liabilities and Members' Equity</b></td>
      <td style="text-align: right"><b><?php echo $sagot[17]; ?></b></td>
    </tr>
  </table><br/><br/>
  <b style="page-break-before: always;">STATEMENT OF OPERATION</b><br/><br/>
  <table>
    <tr>
      <td><b>REVENUES</b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Income from Credit Operations</td>
      <td style="text-align:right"><?php echo $sagot23; ?></td>
      
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Income from Service Operations</td>
      <td style="text-align:right"><?php echo $sagot24; ?></td>
      
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Income from Marketing Operations</td>
      <td style="text-align:right"><?php echo $sagot25; ?></td>
      
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Income from Consumers/Catering Operations</td>
      <td style="text-align:right"><?php echo $sagot26; ?></td>
      
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Income from Production Operations</td>
      <td style="text-align:right"><?php echo $sagot27; ?></td>
      
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Other Income</td>
      <td style="text-align:right"><?php echo $sagot28; ?></td>
      
    </tr>
    <tr>
      <td class ="cl1" style="color:blue; font-weight:bold;"><i style="color: white;">........</i>Total Revenues</td>
      <td style="color:blue; text-align:right"><b><?php echo $sagut[0]; ?></b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">.</i></td>
    </tr>
    <tr>
      <td class ="cl1"><b>EXPENSES</b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Financing Cost</td>
      <td style="text-align:right"><?php echo $sagot29; ?></td>
      
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Selling/Marketing Cost</td>
      <td style="text-align:right"><?php echo $sagot30; ?></td>
      
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Administrative Cost</td>
      <td style="text-align:right"><?php echo $sagot31; ?></td>
      
    </tr>
    <tr>
      <td class ="cl1" style="color:blue; font-weight:bold;"><i style="color: white;">........</i>Total Expenses</td>
      <td style="color:blue; text-align:right"><b><?php echo $sagut[1]; ?></b></td>            
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">.</i></td>
    </tr>
    <tr>
      <td class ="cl1"><b>NET SURPLUS before Other Items</b></td>
      <td style="text-align:right"><?php echo $sagut[2]; ?></td>
    </tr>
    <tr>
      <td class ="cl1">OTHER ITEMS</td>
      <td style="text-align:right"><?php echo $sagot32; ?></td>
      
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">.</i></td>
    </tr>
    <tr>
      <td class ="cl1" style="color:blue; font-weight:bold;">NET SURPLUS</td>
      <td style="color:blue; text-align:right"><b><?php echo $sagut[3]; ?></b></td>
    </tr>
    <tr>
      <td class ="cl1"><i style="color: white;">....</i>Less:  Income Tax Due</td>
      <td style="text-align:right"><?php echo $sagut[4]; ?></td>
    </tr>
    <tr>
      <td class ="cl1" style="color:blue; font-weight:bold;">NET SURPLUS (FOR ALLOCATION)</td>
      <td style="color:blue; text-align:right"><b><?php echo $sagut[5]; ?></b></td>
    </tr>
  </table>
  <br/>
  <br/>
  <table>
    <tr>
      <td class ="cl11"><b>Allocation</b></td>
      <td style="text-align: center;" class ="cl12"><b>% of Net Surplus</b></td>
    </tr>
    <tr>
      <td class ="cl11">Reserve Fund</td>
      <td style="text-align: center;" class ="cl12"><?php echo number_format($sagut[6],0); ?></td>
      <td style="text-align:right"><?php echo $sagut[7]; ?></td>
    </tr>
    <tr>
      <td class ="cl11">Coop. Education & Training Fund</td>
    </tr>
    <tr>
      <td class ="cl11"><i style="color: white;">........</i>CETF - LOCAL</td>
      <td style="text-align: center;" class ="cl12"><?php echo number_format($sagut[8],0); ?></td>
      <td style="text-align:right"><?php echo $sagut[9]; ?></td>
    </tr>
    <tr>
      <td class ="cl11"><i style="color: white;">........</i>DUE TO CETF</td>
      <td style="text-align: center;" class ="cl12"><?php echo number_format($sagut[10],0); ?></td>
      <td style="text-align:right"><?php echo $sagut[11]; ?></td>
    </tr>
    <tr>
      <td class ="cl11">Community Development Fund</td>
      <td style="text-align: center;" class ="cl12"><?php echo number_format($sagut[12],0); ?></td>
      <td style="text-align:right"><?php echo $sagut[13]; ?></td>
    </tr>
    <tr>
      <td class ="cl11">Optional Fund</td>
      <td style="text-align: center;" class ="cl12"><?php echo number_format($sagut[14],0); ?></td>
      <td style="text-align:right"><?php echo $sagut[15]; ?></td>
    </tr>
    <tr>
      <td class ="cl11">Total Statutory Reserves</td>
      <td style="text-align: center;" class ="cl12"><i style="color: white;">.</i></td>
      <td style="text-align:right"><?php echo $sagut[16]; ?></td>
    </tr>
    <tr>
      <td class ="cl11"><i style="color: white;">........</i>Interest on Share Capital </td>
      <td style="text-align: center;" class ="cl12"><i style="color: white;">.</i></td>
      <td style="text-align:right"><?php echo $sagut[17]; ?></td>
    </tr>
    <tr>
      <td class ="cl11"><i style="color: white;">........</i>Patronage Refund</td>
      <td style="text-align: center;" class ="cl12"><i style="color: white;">.</i></td>
      <td style="text-align:right"><?php echo $sagut[18]; ?></td>
    </tr>
    <tr>
      <td class ="cl11"><b>Total</b></td>
      <td style="text-align: center;" class ="cl12"><i style="color: white;">.</i></td>
      <td style="text-align:right"><b><?php echo $sagut[19]; ?></b></td>
    </tr>
  </table>
  <br/><br/>
 
</body>