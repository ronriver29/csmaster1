<style type="text/css">
  #ul-admin {
  list-style-type: none;
  margin: 0;
  padding: 0;

  }
  #ul-admin li a{
    text-decoration:none;
    float:right;
   width: auto;
   margin-left: 5px;
  }
</style>
<?php if($this->session->flashdata('redirect_applications_message')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-info text-center" role="alert">
       <?php echo $this->session->flashdata('redirect_applications_message'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('list_success_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('list_success_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('list_error_message')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
      <?php echo $this->session->flashdata('list_error_message'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<center><h3>Search</h3></center>
<div class="portlet-body">
  <form method="post">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="eAddress">Transaction Reference Number</label>
          <div id='search'><input type="text" class="form-control" id="epp_number" name="epp_number"></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="eAddress">Transaction Number</label>
          <div id='search'><input type="text" class="form-control" id="trans_number" name="trans_number"></div>
        </div>
      </div>
      </div>
    </div>
    <center><button type="submit" name="submit" value="submit" class="btn btn-info" >Submit</button></center>
  </form>
</div>
<br>
<div class="row">
  <?php if(isset($no_data)){ ?>
    <div class="col-sm-12 col-md-12">
       <div class="card border-top-blue shadow-sm mb-4">
        <div class="card-body">
          <center><?=$no_data?></center>
        </div>
      </div>
    </div>
  <?php }?>
<?php
if(isset($list_laboratory_inquiry)){?>
<div class="col-sm-12 col-md-12">
   <div class="card border-top-blue shadow-sm mb-4">
    <div class="card-body">
      <?php
    if(count($list_laboratory_inquiry) >= 1){
      foreach($list_laboratory_inquiry as $row){
        echo '<center><h3><b>'.$row['payor'].'</b></h3></center><br/><hr/>';
        $obj = json_decode($row['epp_number'], true);

        $hash = strtolower(md5('2018070336'.$obj['MERCHANTREFNO'].'9fd681eab5130912791ec76fa1572995'));
        $postdata = array(
        'MerchantCode' => '2018070336',
        'MerchantRefNo' => $obj['MERCHANTREFNO'],
        'Hash' => $hash
        );
        // echo $hash;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://222.127.109.48/epp20200915/api2-status.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $output = curl_exec($ch);

        $obj = json_decode($output, true);
        //
        // echo $output->STATUS;
        if(curl_errno($ch))
        {
            echo 'Curl error: ' . curl_error($ch);
        }

        // print_r($postdata);
        curl_close($ch);
        
        $exp_particulars = explode(';',$obj['PARTICULARS']);


        echo '<div class="row">';
          echo '<div class="col-md-2"></div>';
          echo '<div class="col-md-4"><b>Transaction Reference Number</b></div>';
          echo '<div class="col-md-4"><center>'.$obj['EPPREFNO'].'</center></div>';
          echo '<div class="col-md-2"></div>';
        echo '</div>';

        echo '<div class="row">';
          echo '<div class="col-md-2"></div>';
          echo '<div class="col-md-4"><b>Date</b></div>';
          echo '<div class="col-md-4"><center>'.$obj['EPPTIMESTAMP'].'</center></div>';
          echo '<div class="col-md-2"></div>';
        echo '</div>';

        echo '<div class="row">';
          echo '<div class="col-md-2"></div>';
          echo '<div class="col-md-4"><b>Transaction Type</b></div>';
          echo '<div class="col-md-4"><center>'.str_replace('transaction_type=','',$exp_particulars[0]).'</center></div>';
          echo '<div class="col-md-2"></div>';
        echo '</div>';

        echo '<div class="row">';
          echo '<div class="col-md-2"></div>';
          echo '<div class="col-md-4"><b>Transaction Number</b></div>';
          echo '<div class="col-md-4"><center>'.str_replace('TransactionNo=','',$exp_particulars[1]).'</center></div>';
          echo '<div class="col-md-2"></div>';
        echo '</div>';

        echo '<div class="row">';
          echo '<div class="col-md-2"></div>';
          echo '<div class="col-md-4"><b>Regional Office</b></div>';
          echo '<div class="col-md-4"><center>'.str_replace('Regional Office=','',$exp_particulars[2]).'</center></div>';
          echo '<div class="col-md-2"></div>';
        echo '</div>';

        echo '<div class="row">';
          echo '<div class="col-md-2"></div>';
          echo '<div class="col-md-4"><b>Registration Number</b></div>';
          $regno = str_replace('Registration Number=','',$exp_particulars[3]);
          $regno = substr($regno,0,4).'-'.substr($regno,4,12);
          echo '<div class="col-md-4"><center>'.$regno.'</center></div>';
          echo '<div class="col-md-2"></div>';
        echo '</div>';

        echo '<div class="row">';
          echo '<div class="col-md-2"></div>';
          echo '<div class="col-md-4"><b>Name of Cooperative</b></div>';
          echo '<div class="col-md-4"><center>'.str_replace('Name of Cooperative=','',$exp_particulars[4]).'</center></div>';
          echo '<div class="col-md-2"></div>';
        echo '</div>';

        echo '<hr><center><h5><b>Payment Summary</b></h5></center><hr/>';

        echo '<div class="row">';
          echo '<div class="col-md-2"></div>';
          echo '<div class="col-md-4"><b>Payment Option</b></div>';
          echo '<div class="col-md-4"><center>'.$obj['PAYMENTOPTION'].'</center></div>';
          echo '<div class="col-md-2"></div>';
        echo '</div>';

        echo '<div class="row">';
          echo '<div class="col-md-2"></div>';
          echo '<div class="col-md-4"><b>Transaction Amount</b></div>';
          echo '<div class="col-md-4"><center>'.$obj['AMOUNT'].'</center></div>';
          echo '<div class="col-md-2"></div>';
        echo '</div>';

        // echo '<br>'.print_r($list_laboratory_inquiry);
        // echo '<br>'.print_r($exp_particulars);
      }
    } else {
      echo '<center>No Record Found!</center>';
    }
      ?>
    </div>
  </div>
  </div>
<?php } ?>
