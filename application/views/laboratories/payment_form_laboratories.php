<style>

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
<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>laboratories/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 11
      <?php endif; ?>
    </h5>
  </div>
</div>
<?php if($this->session->flashdata('payment_success')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-success text-center" role="alert">
     <?php echo $this->session->flashdata('payment_success'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if($this->session->flashdata('payment_error')): ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="alert alert-danger text-center" role="alert">
     <?php echo $this->session->flashdata('payment_error'); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue mb-4">
      <?php echo form_open('laboratories_payments_branch/add_payment',array('id'=>'paymentForm','name'=>'paymentForm')); ?>
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-payment">
            <h4 class="float-left">ORDER OF PAYMENT:</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <table class="bord" width="65%" style="table-layout: fixed;word-wrap: break-word;">
            <tr>
              <td class="bord">Order of Payment No.</td>
              <td class="bord" colspan="3">
                <b><?php

                $report_exist = $this->db->where(array('payor'=>ucwords($branch_info->laboratoryName.' - '.$branch_info->labName)))->get('payment');

                // echo $report_exist->num_rows();
                if($report_exist->num_rows()==0){
                  
                  // if($coop_info->date_for_payment == NULL){
                  //   $datee = date('d-m-Y',now('Asia/Manila'));
                  //   $datee2 = date('Y-m-d',now('Asia/Manila'));
                  // } else {
                    // $datee = date('d-m-Y',strtotime($coop_info->date_for_payment));
                    // $datee2 = date('Y-m-d',strtotime($coop_info->date_for_payment));
                    $datee = date('d-m-Y',now('Asia/Manila'));
                    $datee2 = date('Y-m-d',now('Asia/Manila'));
                  // }
                  $series = substr($branch_info->addrCode,0,2).'-'.date('Y-m',strtotime($datee)).'-'.$series;
                } else {
                  foreach($report_exist->result_array() as $row){
                    $series = $row['refNo'];
                    $datee = date('d-m-Y',strtotime($row['date']));
                    $datee2 = date('Y-m-d',now('Asia/Manila'));
                  }

                  // $series = 
                }
                ?><?=$series?></b>  
              </td>
            </tr>
            <tr>       
              <td class="bord">Date</td>
              <td class="bord" colspan="3"><b><?=$datee?></b></td>
            </tr>   
            <tr>
              <td class="bord">Payor</td>
              <td class="bord" colspan="3"><b><?= ucwords($branch_info->laboratoryName.' - '.$branch_info->labName)?></b></td>
            </tr>

            <tr>
              <td class="bord" >Nature of Payment</td>
              <td class="bord" colspan="3"><b>Laboratory Registration</b></td>
            </tr>
            <tr>
              <td class="bord">Amount in Words</td>
              <td class="bord" colspan="3"><b><?=ucwords(num_format_custom(number_format($lab_fee)))?> Pesos</b></td>
            </tr>

             <tr>
              <td class="bord" align="center" colspan="4">Particulars</td>
            </tr>
            <tr>
              <td width="23%"></td>
              <td class="pera" ><b>Processing Fee</b></td>
              <td class="pera" width="5%">Php </td>
              <td class="pera" align="right" width="13%"><b><?=number_format($lab_fee,2)?></b></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp</td>
            </tr>
            <tr>

              <td class="bord" colspan="2">Total </td>
              <td class="bord" width="5%" style="border-right:none;">Php </td>
              <td class="bord" align="right" width="13%" style="border-left:none"><b><?=number_format($lab_fee,2)?></b></td>
            </tr>

          </table>

          <input type="hidden" class="form-control" id="cooperativeID" name="cooperativeID" value="<?=encrypt_custom($this->encryption->encrypt($branch_info->application_id)) ?>">
          <input type="hidden" class="form-control" id="refno" name="refno" value="<?=$series ?>">
           <input type="hidden" class="form-control" id="branchID" name="branchID" value="<?=$encrypted_id ?>">
           <input type="hidden" class="form-control" id="payor" name="payor" value="<?=ucwords($branch_info->laboratoryName.' - '.$branch_info->labName)?>">
          <input type="hidden" class="form-control" id="tDate" name="tDate" value="<?=$datee2 ?>">
          <input type="hidden" class="form-control" id="nature" name="nature" value="Laboratory Registration">
          <input type="hidden" class="form-control" id="particulars" name="particulars" value="Processing Fee">
          <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($lab_fee,2)?>">
          <input type="hidden" class="form-control" id="total" name="total" value="<?=$lab_fee?>">
          <input type="hidden" class="form-control" id="rCode" name="rCode" value="<?= $branch_info->rCode ?>">
      </div>

      <br>
      
       <div class="row">
       <div class="col-md-9"> 
       <u><h4> Payment of Fees</h4></u>
        <ul style="list-style: none;">

          <li style="margin-top:30px;margin-bottom:20px;">1. The filing fees may be paid through any of the following modes, at the option of
        the applicant: 
      </li>

            <li style="margin-left:100px;">a. Online payment facilities listed and available through the CoopRIS; </li>

           <li style="margin-left:100px;"> b. Cash or manager&#39;s check, through the CDA cashier where the proposed
          cooperative will be registered.</li>
         <li style="margin-left:70px;margin-top:20px;"> In the case of payment through mode (a), the CoopRIS will generate a &quot;Payment
          Details&quot; that will indicate the amount of filing fees to be paid by the applicant.
        </li>
        <li style="margin-bottom:20px;margin-top:20px;">
        2. Failure to pay within ten (10) days period will result in the automatic removal of
        the application from the system.
      </li>
      <li style="margin-botton:40px;">
        3. Fees other than the computed filing fees (e.g. bank charges) shall be shouldered
        by the applicant.
      </li>
    </ul>
  </div> <!-- end -->
      </div><!-- end of rows -->
     
      <br><br>
        <input style="width:18%;" class="btn btn-color-blue" type="submit" id="offlineBtn" name="offlineBtn" value="Pay at CDA Cashier">
        <input style="width:18%;" class="btn btn-color-blue" type="submit" id="onlineBtn" name="onlineBtn" value="Pay Online">
      
    </form>
    </div>
  </div>
</div>
