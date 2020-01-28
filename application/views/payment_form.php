<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
      <?php if($is_client): ?>
      Step 10
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
      
      <div class="card-header">
        <div class="row d-flex">
          <div class="col-sm-12 col-md-12 col-btn-action-payment">
           
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <form action=" https://222.127.109.48/epp_mobile/" method="POST">
          <input type="text" name="MerchantCode"  value="00000001">
          <input type="text" name="MerchantRefNo" value="10000000">
          <input type="text" name="Particulars" value="transaction_type=Registration Fee;Desc=Registration payment;SID=1;Name=Johnny Tee;">
          <input type="text" name="Amount" value="2500.00">
          <input type="text" name="PayorName" value="Johnny Tee">
          <input type="text" name="PayorEmail" value="akotagaturomo@gmail.com">
          <input type="text" name="ReturnURLOK" value="<?=base_url()?>PaymentsKo/ok.php">
          <input type="text" name="ReturnURLError" value="<?=base_url()?>PaymentsKo/error.php">
          <input type="text" name="Hash" value="<?=LowerCase(MD5('00000001' + '10000000' + '2500.00'))?>"/>
          <input type="submit" value="POST TO EPP"/>
          </form>

      </div>
      <div class="card-footer paymentFooter" style="display: none;">
        <
      </div>
    
    </div>
  </div>
</div>
