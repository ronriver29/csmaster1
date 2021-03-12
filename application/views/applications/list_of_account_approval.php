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
<?php if($this->session->flashdata('email_sent_success')): ?>
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <p><?php echo $this->session->flashdata('email_sent_success'); ?></p>
      </div>
    </div>
<?php endif; ?>
<?php if($this->session->flashdata('email_sent_warning')): ?>
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-warning text-center" role="alert">
       <p><?php echo $this->session->flashdata('email_sent_warning'); ?></p>
      </div>
    </div>
<?php endif; ?>
<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="cooperativesTable">
            <thead>
              <tr>
                <th>Name of Cooperative</th>
                <th>Registered Number</th>
                <th>Client Name</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_cooperatives as $cooperative) : ?>
                <tr>
                  <td><?=$cooperative['coopName']?></td>
                  <td><?=$cooperative['regNo']?></td>
                  <td><?=$cooperative['last_name'].', '.$cooperative['first_name']?></td>
                  <td><a href="<?php echo base_url();?>account_approval/<?= encrypt_custom($this->encryption->encrypt($cooperative['usersid'])) ?>" class="btn btn-info"><i class='fas fa-eye'></i> View</a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
