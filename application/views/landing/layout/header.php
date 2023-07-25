<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Member LPKN</title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link href="<?php echo base_url();?>assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/dist/css/adminlte.min.css">
<!-- jQuery -->
<script src="<?=base_url()?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
      <style>
          .modal-open {
              padding-right: 0px !important;
          }
          body:not(.modal-open){
            padding-right: 0px !important;
          }
          .modal-body .close {
            margin: 0;
            position: absolute;
            top: 5px;
            right: 5px;
            width: 33px;
            height: 33px;
            border-radius: 23px;
            background-color: #db0000;
            color: #ffffff;
            font-size: 15px;
            opacity: 1;
            z-index: 10;
          }
      </style>
</head>
<body class="hold-transition layout-top-nav dark-mode layout-navbar-fixed">
    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container">
      <a href="<?=base_url()?>" class="navbar-brand">
        <img src="https://lpkn.id/front_assets/lpkn_iso_putih.png" alt="LPKN Logo" class="brand-image">
        <!-- <span class="brand-text font-weight-light">LPKN</span> -->
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?=base_url()?>" class="nav-link">Beranda</a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>page/allevent" class="nav-link">Event</a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>page/allnews" class="nav-link">Berita</a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>page/allvideo" class="nav-link">Video</a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>page/peraturan" class="nav-link">Peraturan</a>
          </li>
          <!-- <div class="dropdown show">
            <a class="nav-link  dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown 
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a href="<?=base_url()?>page/peraturan" class="dropdown-item download-peraturan" >Peraturan</a>
              <a href="<?=base_url()?>page/video" target="blank_" class="dropdown-item download-video" >Video</a>
            </div>
          </div> -->
          <!-- </li> -->
        </ul>

        <!-- SEARCH FORM 
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar navbar-dark" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>-->
      </div>
      
          <style>
            .parent_pa {
              /*border: 1px solid;*/
              width: 5.5vh;
              height: 20vh;
              overflow: hidden;
              display: flex;
            }

            .pa {
              max-width: inherit;
              max-height: inherit;
              height: inherit;
              width: inherit;
              object-fit: cover;
              border-radius: 50%;
              height: 32px;
            }
          </style>
      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <?php
          if ($this->ion_auth->logged_in())
          {
          $user = $this->ion_auth->user()->row();
          $member = $this->db->where('nik', $user->username)->get('member')->row();
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link" style="padding-top: 0.1rem;" data-toggle="dropdown" href="#">
            <div class="parent_pa img-avatar" style="padding: 0px;">
                <!-- <img class="pa" src="http://localhost:8080/member_vendor_v4/assets/img/avatars/profile-img.jpg" alt="admin@bootstrapmaster.com"> -->
                      <?php if(empty($member->pp) OR $member->pp == ''){ ?>
                          <img class="pa" src="<?=base_url()?>assets/img/avatars/profile-img.jpg" alt="User profile picture">
                      <?php }else{?>
                          <img class="pa" src="<?=base_url()?>uploads/foto_profile/<?=$member->pp?>" alt="User profile picture">
                      <?php }?>
            </div>
          </a>
          <script>
            function change_password(){
                  var url = "<?=site_url('page/change_password')?>";
                  $('.form_change_password').load(url);
                  // alert(url);
               }
            jQuery(function($){
              $('#ubah_password').on('hidden.bs.modal', function (e) {
                  $('.form_change_password').empty();
              });
            });
          </script>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 200px;">
            <span class="dropdown-header text-white"><h5><?=$user->first_name?></h5>  </span>
            <div class="dropdown-divider"></div>
            <a href="<?=base_url()?>page/profile" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Profile
            </a>
            <?php if(!empty($member) && !is_null($member->ref)){ ?>
              <a href="<?=base_url()?>page/afiliasi" class="dropdown-item">
                <i class="fas fa-share-alt mr-2"></i> Afiliasi
              </a>
            <?php }?>
            <a href="#" data-toggle="modal" data-target="#ubah_password" class="dropdown-item" onclick="change_password()">
              <i class="fas fa-key mr-2"></i> Ubah Password
              <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?=base_url()?>auth/logout" class="dropdown-item">
              <i class="fas fa-lock mr-2"></i> Log Out
              <!-- <span class="float-right text-muted text-sm">12 hours</span> -->
            </a>
          </div>
        </li>
        <?php
          }else{
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link" style="padding-top: 0.1rem;" data-toggle="dropdown" href="#">
            <i class="fa fa-user-plus" style="font-size: 1.7em;"></i>
            <span class="badge badge-danger navbar-badge" style="right: 2px; top: 2px;">Member</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 200px;">
            <!-- <span class="dropdown-header"><h5>Ferdiansyah</h5>  </span> -->
            <div class="dropdown-divider"></div>
            <a href="<?=base_url()?>/panel" class="dropdown-item">
              <i class="fas fa-unlock mr-2"></i> Login
              <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?=base_url()?>/auth/register" class="dropdown-item">
              <i class="fas fa-list mr-2"></i> Register
              <!-- <span class="float-right text-muted text-sm">12 hours</span> -->
            </a>
          </div>
        </li>
        <?php 
          }
        ?>
      </ul>
    </div>
  </nav>

  <!-- /.navbar -->
        <!-- Modal -->
        <div class="modal fade" id="ubah_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog change_password" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body form_change_password">

              </div>
            </div>
          </div>
        </div>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

