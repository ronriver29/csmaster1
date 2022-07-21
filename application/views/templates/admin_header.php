 <!DOCTYPE html>
<html lang="en">
  <head>
    <title>CoopRIS <?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- <meta http-equiv="refresh" content="1800;url=<?=base_url('admins/logout')?>" /> -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css" media="all">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/validationEngine.jquery.css" type="text/css"/>
    <link rel="stylesheet" href="<?=base_url();?>assets/icons/fontawesome-free-5.5.0-web/css/all.css">
    <link rel="icon" href="<?=base_url();?>/assets/img/cda.png" type="image/png">
    <link rel="stylesheet" href="<?=base_url();?>/assets/css/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/custom-style.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/malibu_scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/sweetalert2.min.css">
    <style type="text/css">
      select,input,textarea {
        /*border:0.2px solid #47748b !important;*/
        box-shadow: 1px 1px;
      }
    </style>
    <script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
  </head>
  <body>
  <div class="wrapper">
    <?php if($this->session->userdata('logged_in')) :?>
    <!-- Sidebar  -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <div class="row">
          <div class="col-sm-3">
            <img src="<?=base_url();?>assets/img/cda_new.png" width="50" height="50" class="d-inline-block align-top" alt="Responsive image">
          </div>
          <div class="col-sm-9 align-self-center" >
            <p class="h4">E-Coop<strong>RIS</strong></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 text-center">
            <small><?php echo (($admin_info->access_level == 1) ? "Cooperative Development Specialist II" : (($admin_info->access_level == 2) ? "Senior Cooperative Development Specialist" : (($admin_info->access_level == 3 && $admin_info->access_name == 'Director') ? "Director" : (($admin_info->access_level == 3 && $admin_info->access_name == 'Acting Regional Director') ? "Acting Regional Director" : (($admin_info->access_level == 4) ? "Supervising CDS"  :  (($admin_info->access_level == 6) ? "Authorized Personnel" : "Super Admin"))))))?></small><br>
            <?php if($admin_info->access_level != 5) : ?>
              <small class="font-italic">
                <?php
                 // $reg_desc = (($admin_info->region_code =="0") ? "Central Office" : $this->region_model->get_region_by_code($admin_info->region_code)->regDesc); 
                    if($admin_info->region_code == "0")
                    {
                      $reg_desc ="Head Office";
                    }
                    else
                    {
                        $readdesc= $this->region_model->get_region_by_code($admin_info->region_code);
                         $reg_desc = (!empty($readdesc) ? $readdesc->regDesc : "");
                    }
                    echo $reg_desc;
                ?>
                
                </small>
              
            <?php endif;?>
          </div>
        </div>
      </div>
      <ul class="list-unstyled components">
        <p class="text-left h5"><i class="fas fa-user"></i> <?=$admin_info->full_name ?></p>
        <?php if($admin_info->access_level == 5) : ?>
          <li>
            <a href="<?php echo base_url();?>admins/all_admin"><i class="fas fa-user-tie"></i> Admins</a>
          </li>
          <li>
            <a href="<?php echo base_url();?>admins/all_user"><i class="fas fa-user-tie"></i> Users</a>
          </li>
          <li>
            <a href="<?php echo base_url();?>admins/all_new_user"><i class="fas fa-user-tie"></i> New Email Users</a>
          </li>
          <li>
            <a href="<?php echo base_url();?>admins/for_verifications"><i class="fas fa-user-tie"></i> For Verifications</a>
          </li>
          <li>
            <a href="<?php echo base_url();?>admins/migration_coop"><i class="fas fa-user-tie"></i> Migration Cooperatives</a>
          </li>
          <li>   
            <a href="<?php echo base_url();?>admins/all_signatory"><i class="fas fa-handshake"></i> COC Signatory</a>
          </li>  
          <li>   
            <a href="<?php echo base_url();?>admins/cooperatives_list"><i class="fas fa-handshake"></i> All Cooperatives List</a>
          </li>
             <li>   
            <a href="<?php echo base_url();?>admins/amendment_list"><i class="fas fa-handshake"></i> All Amendments List</a>
          </li>
           <li>   
            <a href="<?php echo base_url();?>admins/branches_list"><i class="fas fa-handshake"></i> All Branches List</a>
          </li> 

           <li>
          <a href="#pageSubmenu7" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-cog"></i> API</a>
          <ul class="collapse list-unstyled" id="pageSubmenu7">
            <li>
               <a href="#pageSubmenu8" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-cog"></i> Davao</a>
                <ul class="collapse list-unstyled" id="pageSubmenu8">
                 
                      <li>
                        <a href="<?php echo base_url();?>api_access" style="padding-left:5%;"><i class="fas fa-cog"></i> Settings</a>
                      </li>
                      <li>
                        <a href="<?php echo base_url();?>api_access/request"><i class="fas fa-cog"></i> Api request </a>
                      </li>
                 
                </ul>
            </li>
          </ul>
        </li>
          <!-- <li>
            <a href="<?php echo base_url();?>report"><i class="fas fa-cog"></i> Query Builder</a>
          </li> -->
          <li>
          <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-cog"></i> SMS Settings</a>
          <ul class="collapse list-unstyled" id="pageSubmenu2">
            <li>
              <a href="<?php echo base_url();?>api_settings"><i class="fas fa-cog"></i> API Settings</a>
            </li>

            <li>
                <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-cog"></i> SMS Allowed Actions</a>

              <ul class="collapse list-unstyled" id="pageSubmenu3">
                <li>
                    <a href="<?php echo base_url();?>api_settings/primary"><i class="fas fa-cog" style="padding-left:15%;"></i> PRIMARY</a>
                </li>
                <li>
                  <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-cog" style="padding-left:15%;"></i> B&S</a>
                  <ul class="collapse list-unstyled" id="pageSubmenu4">
                    <li>
                      <a href="<?php echo base_url();?>api_settings/bns_inside"><i class="fas fa-cog" style="padding-left:25%;"></i> INSIDE</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url();?>api_settings/bns_outside"><i class="fas fa-cog" style="padding-left:25%;"></i> OUTSIDE</a>
                    </li>
                  </ul>
                </li>
                <!-- <li>
                    <a href="<?php echo base_url();?>api_settings/bns"><i class="fas fa-cog" style="padding-left:15%;"></i> BRANCH AND SATELLITE</a>
                </li> -->
                <li>
                    <a href="<?php echo base_url();?>api_settings/laboratories"><i class="fas fa-cog" style="padding-left:15%;"></i> LABORATORIES</a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>api_settings/amendment"><i class="fas fa-cog" style="padding-left:15%;"></i> AMENDMENT</a>
                </li>
            </ul>
            </li>
            
            <!-- <li>
              <a href="<?php echo base_url();?>admins/change_passwd"><i class="fas fa-cog"></i> SMS Messages Page</a>
            </li> -->

            <li>
              <a href="<?php echo base_url();?>api_settings/blocked_no"><i class="fas fa-cog"></i> SMS Block Nos.</a>
            </li>

          </ul>
        </li>

        <li>   
          <a href="<?php echo base_url();?>api_settings/messages_list"><i class="fas fa-cog"></i> SMS Messages</a>
        </li>
        <?php endif; ?>
      
        <?php if($admin_info->access_level < 5) : ?>
          <li>
            <a href="#pageSubmenu5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-handshake"></i> Cooperatives Menu</a>
            <ul class="collapse list-unstyled" id="pageSubmenu5">
              <li>
                <a href="<?php echo base_url();?>cooperatives"><i class="fas fa-cog"></i> Cooperatives</a>
              </li>
              <?php if($admin_info->access_level == 2) : ?>
              <li>
                <a href="<?php echo base_url();?>denied_defered_cooperatives"><i class="fas fa-cog"></i> Deferred / Denied</a>
              </li>
              <?php endif; ?>
              <li>
                <a href="<?php echo base_url();?>registered_cooperatives"><i class="fas fa-cog"></i> Registered</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>process_by_ho"><i class="fas fa-cog"></i> Registered Coop Processed by Head Office</a>
              </li>
            </ul>
          </li>
          <!-- <li>   
            <a href="<?php echo base_url();?>cooperatives"><i class="fas fa-handshake"></i> Cooperatives</a>
          </li> -->
         
           <li>   

            <a href="<?php echo base_url();?>branches"><i class="fas fa-handshake"></i> Branches and Satellites</a>
          </li>
            <li>   

            <a href="<?php echo base_url();?>For_closure"><i class="fas fa-handshake"></i> Closure of Branches and Satellites</a>
          </li>
          <li>   

            <a href="<?php echo base_url();?>For_transfer"><i class="fas fa-handshake"></i> Transfer of Branches and Satellites</a>
          </li>
          <li>   

            <a href="<?php echo base_url();?>For_conversion"><i class="fas fa-handshake"></i> Conversion of Branches and Satellites</a>
          </li>
          <li>   
            <a href="<?php echo base_url();?>laboratories"><i class="fas fa-handshake"></i> Laboratories</a>
          </li>
        <!--   <li>   
            <a href="<?php echo base_url();?>amendment"><i class="fas fa-handshake"></i> Amendment</a>
          </li>   -->

             <li>
            <a href="#pageSubmenu10" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-handshake"></i> Amendment</a>
            <ul class="collapse list-unstyled" id="pageSubmenu10">
              <li>
                <a href="<?php echo base_url();?>amendment"><i class="fas fa-cog"></i> For Validation</a>
              </li>
              <?php if($admin_info->access_level == 2) : ?>
              <li>
                <a href="<?php echo base_url();?>amendment/deferred_denied"><i class="fas fa-cog"></i> Deferred / Denied</a>
              </li>
              <?php endif; ?>
              <li>
                <a href="<?php echo base_url();?>amendment/registered"><i class="fas fa-cog"></i> Registered</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>amendment/registered_ho"><i class="fas fa-cog"></i> Registered Coop Processed by Head Office</a>
              </li>
            </ul>
          </li>

          <?php if($admin_info->access_level == 2) : ?>
          <li>   
            <a href="<?php echo base_url();?>account_approval"><i class="fas fa-handshake"></i> Account Approval</a>
          </li> 
          <?php endif; ?>
        <?php endif; ?>
        <?php if($admin_info->access_level == 6) : ?>
          <li>
            <a href="#pageSubmenu6" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-handshake"></i> Updated Cooperative Info</a>
            <ul class="collapse list-unstyled" id="pageSubmenu6">
              <li>
                <a href="<?php echo base_url();?>updated_cooperative_info"><i class="fas fa-handshake"></i> Ongoing</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>updated_cooperative_info_registered"><i class="fas fa-handshake"></i> Registered</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#pageSubmenubns" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-handshake"></i> Updated Branch/Satellite Info</a>
            <ul class="collapse list-unstyled" id="pageSubmenubns">
              <li>
                <a href="<?php echo base_url();?>updated_branch_info"><i class="fas fa-handshake"></i> Ongoing</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>updated_branch_info_registered"><i class="fas fa-handshake"></i> Registered</a>
              </li>
            </ul>
          </li>
          <!--  <li>   
            <a href="<?php echo base_url();?>updated_amendment_info"><i class="fas fa-handshake"></i> Updated Amendment Info</a>
          </li>  -->
          <li>
           <a href="#pageSubmenuamd" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-handshake"></i> Updated Amendment Info</a>
            <ul class="collapse list-unstyled" id="pageSubmenuamd">
                <li>
                <a href="<?php echo base_url();?>updated_amendment_info"><i class="fas fa-handshake"></i> Ongoing</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>registered_updated"><i class="fas fa-handshake"></i> Registered</a>
              </li>
            </ul>
          </li>
          <li>
           <a href="#pageSubmenuLab" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-handshake"></i> Updated Laboratory Info</a>
            <ul class="collapse list-unstyled" id="pageSubmenuLab">
                <li>
                <a href="<?php echo base_url();?>updated_laboratory_info"><i class="fas fa-handshake"></i> Ongoing</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>updated_laboratory_info_registered"><i class="fas fa-handshake"></i> Registered</a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
       
        <li>

          <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-cog"></i> Settings</a>
          <ul class="collapse list-unstyled" id="pageSubmenu">
             <li>
              <a href="<?php echo base_url();?>admins/change_passwd"><i class="fas fa-sign-out-alt"></i> Change password</a>
            </li>
            
            <li>
              <a href="<?php echo base_url();?>admins/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
            
          </ul>
        </li>
      </ul>
    </nav>
    <!-- Page Content  -->
    <div id="content">

      <nav class="navbar navbar-custom navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <button type="button" id="sidebarCollapse" class="btn btn-color-blue d-inline-block d-lg-none">
              <i class="fas fa-bars"></i>
          </button>
          <h5><?= $header?></h5>
        </div>
      </nav>
        <?php endif; ?>
      <div class="container-fluid">
