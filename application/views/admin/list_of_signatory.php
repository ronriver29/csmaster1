<?php if($this->session->flashdata('redirect_admin_applications_message')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-warning text-center" role="alert">
       <?php echo $this->session->flashdata('redirect_admin_applications_message'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('add_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('add_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('add_admin_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('add_admin_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('update_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('update_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('update_admin_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('update_admin_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('delete_admin_success')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success text-center" role="alert">
       <?php echo $this->session->flashdata('delete_admin_success'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if($this->session->flashdata('delete_admin_error')): ?>
  <div class="row mt-3">
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger text-center" role="alert">
       <?php echo $this->session->flashdata('delete_admin_error'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<div class="row">
  <div class="col-sm-12 offset-md-8 col-md-4 mb-2">
    <a class="btn btn-color-blue btn-block" href="<?php echo base_url();?>admins/add_signatory" role="button"><i class="fas fa-plus"></i> Add Signatory</a>
  </div>
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="adminsTable">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Handle</th>
                <!-- <th>Effectivity Date</th> -->
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($signatory_list as $admin) : ?>
                <tr>
                  <td><?= $admin['signatory']?></td>
                  </td>
                  <td>
                    <?php $reg = $admin['region_code'];
                    switch ($reg){
                      case "0":
                          $reg = "Head Office";
                          break;
                      case "001":
                          $reg = "Region I (ILOCOS REGION)";
                          break;
                      case "002":
                          $reg = "Region II (CAGAYAN VALLEY)";
                          break;
                      case "003":
                          $reg = "Region III (CENTRAL LUZON)";
                          break;
                      case "004":
                          $reg = "Region IV-A (CALABARZON)";
                          break;
                      case "005":
                          $reg = "Region V (BICOL REGION)";
                          break;
                      case "006":
                          $reg = "Region VI (WESTERN VISAYAS)";
                          break;
                      case "007":
                          $reg = "Region VII (CENTRAL VISAYAS)";
                          break;
                      case "008":
                          $reg = "Region VIII (EASTERN VISAYAS)";
                          break;
                      case "009":
                          $reg = "Region IX (ZAMBOANGA PENINSULA)";
                          break;
                      case "010":
                          $reg = "Region X (NORTHERN MINDANAO)";
                          break;
                      case "011":
                          $reg = "Region XI (DAVAO REGION)";
                          break;
                      case "012":
                          $reg = "Region XII (KIDAPAWAN)";
                          break;
                      case "016":
                          $reg = "Region XIII (CARAGA)";
                          break;
                      case "015":
                          $reg = "Autonomous Region in Muslim Mindanao (ARMM)";
                          break;
                      case "014":
                          $reg = "Cordillera Administrative Region (CAR)";
                          break;
                      case "013":
                          $reg = "National Capital Region (NCR)";
                          break;
                      case "017":
                          $reg = "Region IV-B (MIMAROPA)";
                          break;
                      default:
                          $reg = "";
                          break;
                      }
                    echo $reg;
                    ?>

                  </td>
                  <!-- <td><?= //date('F d, Y',strtotime($admin['effectivity_date']))?></td> -->
                  <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                      <a href="<?php echo base_url();?>admins/<?= encrypt_custom($this->encryption->encrypt($admin['id'])) ?>/edit_signatory" class="btn btn-warning text-white"><i class="fas fa-edit"></i> Edit</a>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAdministratorModal" data-fname="<?= $admin['signatory']?>" data-adid="<?= encrypt_custom($this->encryption->encrypt($admin['id']))?>"><i class='fas fa-trash'></i> Delete</button>
                    </div>
                  </  td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
