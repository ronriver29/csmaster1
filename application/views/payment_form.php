<div class="row mb-2">
  <div class="col-sm-12 col-md-12">
    <a class="btn btn-secondary btn-sm float-left"  href="<?php echo base_url();?>cooperatives/<?= $encrypted_id ?>" role="button"><i class="fas fa-arrow-left"></i> Go Back</a>
    <h5 class="text-primary text-right">
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
          <?=form_open('https://222.127.109.48/epp20200915/');?>
          <?php // echo form_open('paymentsKo/submit',array('id'=>'editAffiliatorForm','name'=>'editAffiliatorForm')); ?>
          <!-- Late -->
          <input type="text" name="MerchantCode" value="2018070336">
          <input type="text" name="MerchantRefNo" value="1234">
          <input type="text" name="Particulars" value="transaction_type=Accreditation of CEA - New;Regional Office=NCR;Name of Individual/Partnership/Firm=Individual;Order of Payment No.=20220211;">
          <input type="text" name="Amount" value="2500.00">
          <input type="text" name="PayorName" value="John Doe">
          <input type="text" name="PayorEmail" value="john.doe@gmail.com">
          <input type="text" name="ReturnURLOK"
          value="http://merchant.com/merchant/ok.php">
          <input type="text" name="ReturnURLError"
          value="http://merchant.com/merchant/error.php">
          <input type="text" name="Hash" value=" fe38b7924be81e629bb142ccbb71757c">
          <!-- END -->

          <input type="submit" value="POST TO EPP">
          <?=form_close();?>

      </div>
      <div class="card-footer paymentFooter" style="display: none;">
        
      </div>
    
    </div>
  </div>
</div>


