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
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
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
  </head>
  <body>
  <div class="wrapper">
    <?php if($this->session->userdata('logged_in')) :?>
    <!-- Sidebar  -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <div class="row">
          <div class="col-sm-3">
            <img src="<?=base_url();?>assets/img/cda.png" width="50" height="50" class="d-inline-block align-top" alt="Responsive image">
          </div>
          <div class="col-sm-8 align-self-center">
            <p class="h3">Coop<strong>RIS</strong></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 text-center">
            <small><?php echo (($admin_info->access_level == 1) ? "Cooperative Development Specialist II" : (($admin_info->access_level == 2) ? "Senior Cooperative Development Specialist" : (($admin_info->access_level == 3 && $admin_info->access_name == 'Director') ? "Director" : (($admin_info->access_level == 3 && $admin_info->access_name == 'Acting Regional Director') ? "Acting Regional Director" : (($admin_info->access_level == 4) ? "Supervising CDS" : "Super Admin")))))?></small><br>
            <?php if($admin_info->access_level != 5) : ?>
              <small class="font-italic">
                <?php
                 // $reg_desc = (($admin_info->region_code =="0") ? "Central Office" : $this->region_model->get_region_by_code($admin_info->region_code)->regDesc); 
                    if($admin_info->region_code =="0")
                    {
                      $reg_desc ="Central Office";
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
        <?php endif; ?>
      
        <?php if($admin_info->access_level < 5) : ?>
          <li>   
            <a href="<?php echo base_url();?>cooperatives"><i class="fas fa-handshake"></i> Cooperatives</a>
          </li>
         
         <!--  <li>   
            <a href="<?php echo base_url();?>branches"><i class="fas fa-handshake"></i> Branches and Satellites</a>
          </li>
          <li>   
            <a href="<?php echo base_url();?>laboratories"><i class="fas fa-handshake"></i> Laboratories</a>
          </li>
          <li>   
            <a href="<?php echo base_url();?>amendment"><i class="fas fa-handshake"></i> Amendment</a>
          </li> -->

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
