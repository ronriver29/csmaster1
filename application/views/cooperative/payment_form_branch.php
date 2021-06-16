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
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>branches/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
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
      <?php echo form_open('payments_branch/add_payment',array('id'=>'paymentForm','name'=>'paymentForm')); ?>
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-payment">
            <h4 class="float-left"ORDER OF PAYMENT:</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <table class="bord" width="65%">
            <tr>
              <td class="bord">Date</td>
              <td class="bord" colspan="3"><b><?= date('d-m-Y',now('Asia/Manila')); ?></b></td>
            </tr>       
        
            <tr>
              <td class="bord">Payor</td>
              <?php if($branch_info->area_of_operation == 'Barangay' || $branch_info->area_of_operation == 'Municipality/City'){
                    $branch_name = $branch_info->brgy;
                } else if($branch_info->area_of_operation == 'Provincial') {
                    $branch_name = $branch_info->city;
                } else if ($branch_info->area_of_operation == 'Regional') {
                    if($this->charter_model->in_charter_city($branch_info->cCode))
                    {
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    }
                } else if ($branch_info->area_of_operation == 'National') {
                    if($this->charter_model->in_charter_city($branch_info->cCode))
                    {
                      $branch_name = $branch_info->city;
                    } else {
                      $branch_name = $branch_info->city.', '.$branch_info->province;
                    }
                }
            ?>
              <td class="bord" colspan="3"><b><?= ucwords($branch_info->coopName.' - '.$branch_name.' '.$branch_info->branchName)?></b></td>
            </tr>
            <tr>
              <td class="bord">Nature of Payment</td>
              <td class="bord" colspan="3"><b><?=$last?> Registration</b></td>
            </tr>
            <tr>
              <td class="bord">Amount in Words</td>
              <td class="bord" colspan="3"><b><?=ucwords(num_format_custom($branching_fee))?> Pesos</b></td>
            </tr>
            <tr>
              <td class="bord" align="center" colspan="4">Particulars</td>
            </tr>
            <tr>
              <td width="23%"></td>
              <td class="pera" width=""><b>Processing Fee</b></td>
              <td class="pera" width="5%">Php </td>
              <td class="pera" align="right" width="13%"><b><?=number_format($branching_fee,2)?></b></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp</td>
            </tr>
            <tr>
              <td class="bord" colspan="2">Total </td>
              <td class="pera" width="5%">Php </td>
              <td class="pera" align="right" width="13%"><b><?=number_format($branching_fee,2)?></b></td>
            </tr>
          </table>
          <input type="hidden" class="form-control" id="cooperativeID" name="cooperativeID" value="<?=encrypt_custom($this->encryption->encrypt($branch_info->application_id)) ?>">
           <input type="hidden" class="form-control" id="branchID" name="branchID" value="<?=$encrypted_id ?>">
           <input type="hidden" class="form-control" id="payor" name="payor" value="<?= ucwords($branch_info->coopName.' - '.$branch_name.' '.$branch_info->branchName)?>">
          <input type="hidden" class="form-control" id="tDate" name="tDate" value="<?=date('Y-m-d',now('Asia/Manila')); ?>">
          <input type="hidden" class="form-control" id="nature" name="nature" value="<?=$last?>Registration">
          <input type="hidden" class="form-control" id="particulars" name="particulars" value="Processing Fee">
          <input type="hidden" class="form-control" id="amount" name="amount" value="<?=number_format($branching_fee,2)?>">
          <input type="hidden" class="form-control" id="total" name="total" value="<?=$branching_fee?>">
          <input type="hidden" class="form-control" id="rCode" name="rCode" value="<?= $branch_info->rCode ?>">
      </div>
      <u>Payment of Fees</u>
            <ul type="1">
                <li>
                    The filing fees may be paid through any of the following modes, at the option of the applicant:
                    <ul type="a">
                        <li>
                            Online payment facilities listed and available through the CoopRIS;
                        </li>
                        <li>
                            Cash or manager's check, through the CDA cashier where the proposed cooperative will be registered.
                        </li>
                    </ul>
                    In the case of payment through mode (a), the CoopRIS will generate a "Payment Details" that will indicate the amount of filing fees to be paid by the applicant.
                </li>
                <li>
                    Failure to pay within ten (10) days period will result in the automatic removal of the application from the system.
                </li>
                <li>
                    Fees other than the computed filing fees (e.g bank charges) shall be shouldered by the applicant.
                </li>
            </ul>
      <br><br>
        <input style="width:18%;" class="btn btn-color-blue" type="submit" id="offlineBtn" name="offlineBtn" value="Pay at CDA Cashier">
        <input style="width:18%;" class="btn btn-color-blue" type="submit" id="onlineBtn" name="onlineBtn" value="Pay Online" disabled>
      
    </form>
    </div>
  </div>
</div>
