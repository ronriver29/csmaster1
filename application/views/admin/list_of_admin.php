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
    <a class="btn btn-color-blue btn-block" href="<?php echo base_url();?>admins/add" role="button"><i class="fas fa-plus"></i> Add Administrators</a>
  </div>
  <div class="col-sm-12 col-md-12">
    <div class="card border-top-blue shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="adminsTable">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Username</th>
                <th>Access Level</th>
                <th>Handle</th>
                <th>Action </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($admins_list as $admin) : ?>
                <tr>
                  <td><?= $admin['full_name']?></td>
                  <td><?= $admin['username']?></td>
                  <td>
                    <?php
                    $access_level ='';
                      if($admin['access_level'] == 1)
                      {
                          $access_level ="Cooperative Development Specialist II"  ;
                      }
                      else if($admin['access_level'] == 2)
                      {
                          $access_level  ="Senior Cooperative Development Specialist";
                      }
                      else if($admin['access_level'] == 3 && $admin['access_name'] == 'Director')
                      {
                            $access_level ="Director";
                      }else if($admin['access_level'] == 3 && $admin['access_name'] == 'Acting Regional Director')
                      {
                        $access_level  = "Acting Regional Director";
                      }
                      else if($admin['access_level'] == 4)
                      {
                        $access_level = "Supervising CDS";
                      }
                      else
                      {
                         $access_level='';
                      }
                      echo $access_level  ;
                    ?>
                    <!-- <?php echo (
                      ($admin['access_level'] == 1) ? "Cooperative Development Specialist II" :
                       (
                         ($admin['access_level'] == 2) ? "Senior Cooperative Development Specialist" : (
                          ($admin['access_level'] == 3 && $admin['access_name'] == 'Director') ? "Director" : (
                            ($admin['access_level'] == 3 && $admin['access_name'] == 'Acting Regional Director') ? "Acting Regional Director" : "")

                        )
                       )
                    )?> -->
                  </td>
                  <td>
                    <?php $reg = $admin['region_code'];
                    switch ($reg){
                      case "0":
                          $reg = "Central Office";
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
                      case "013":
                          $reg = "Region XIII (CARAGA)";
                          break;
                      case "014":
                          $reg = "Autonomous Region in Muslim Mindanao (ARMM)";
                          break;
                      case "015":
                          $reg = "Cordillera Administrative Region (CAR)";
                          break;
                      case "016":
                          $reg = "National Capital Region (NCR)";
                          break;
                      // case "017":
                      //     $reg = "Region IV-B (MIMAROPA)";
                      //     break;
                      default:
                          $reg = "Region IV-B (MIMAROPA)";
                          break;
                      }
                    echo $reg;
                    ?>

                  </td>
                  <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                      <a href="<?php echo base_url();?>admins/<?= encrypt_custom($this->encryption->encrypt($admin['id'])) ?>/edit" class="btn btn-warning text-white"><i class="fas fa-edit"></i> Edit</a>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAdministratorModal" data-fname="<?= $admin['full_name']?>" data-adid="<?= encrypt_custom($this->encryption->encrypt($admin['id']))?>"><i class='fas fa-trash'></i> Delete</button>
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
