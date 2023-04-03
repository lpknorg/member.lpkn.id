<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.15
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Member Area | Login</title>
    <!-- Icons-->
    <link href="<?php echo base_url();?>assets/vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <!-- <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet"> -->
    <link href="<?php echo base_url();?>assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">


  <!-- All PLUGINS CSS ============================================= -->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_new/css/assets.css">
  
  <!-- TYPOGRAPHY ============================================= -->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_new/css/typography.css">
  
  <!-- SHORTCODES ============================================= -->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_new/css/shortcodes/shortcodes.css">
  
  <!-- STYLESHEETS ============================================= -->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_new/css/style.css">
  <link class="skin" rel="stylesheet" type="text/css" href="<?=base_url()?>assets_new/css/color/color-1.css">




    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script src="<?php echo base_url();?>assets/vendors/jquery/js/jquery.min.js"></script>
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
  </head>

    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
    <script>
      function test()
      {
          toastr.warning('Username Cannot Empty', 'Warning', 
            {
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": true,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            })
      }

        function validateForm() {
          var identity = document.forms["myForm"]["identity"].value;
          var password = document.forms["myForm"]["password"].value;
          if (identity == "") {
          toastr.warning('Username Cannot Empty', 'Warning', 
            {
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": true,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            })
            return false;
          }
          if (password == "") {
          toastr.warning('Password Cannot Empty', 'Warning', 
            {
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": true,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            })
            return false;
          }
        }
    </script>

  <body class="app flex-row align-items-center">
<div class="page-wraper">
  <!-- <div id="loading-icon-bx"></div> -->
  <div class="account-form">
    <div class="account-head" style="background-image:url(<?=base_url()?>assets_new/images/background/bg2.jpg);">
      <div class="mx-auto col-9">       
        <a href="<?=base_url()?>"><img class="img-fluid" src="https://event.lpkn.id/assets_page/images/logo/logolpkn.png" alt=""></a>
      </div>
    </div>
    <div class="account-form-inner">
      <div class="account-container">
        <div class="heading-bx left">
          <h2 class="title-head">Login <span>Member</span></h2>
          <p>Tidak punya akun? <a href="<?=base_url()?>auth/register">Buat disini</a></p>
        </div>  
        <!-- <form class="contact-bx"> -->
        <div id="infoMessage"><?php echo $message;?></div>
              <?php 
              $attributes = array('class' => 'contact-bx', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
              echo form_open("auth/login", $attributes);?>
          <div class="row placeani">
            <div class="col-lg-12">
              <div class="form-group">
                <div class="input-group">
                  <label>Your Email</label>
                            <?php echo form_input($identity, $identity, ' class="form-control"');?>
                  <!-- <input name="dzName" type="text" required="" class="form-control"> -->
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <div class="input-group"> 
                  <label>Your Password</label>
                            <?php echo form_input($password, '', ' class="form-control"');?>
                  <!-- <input name="dzEmail" type="password" class="form-control" required=""> -->
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group form-forget">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                  <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                </div>
                <a href="forgot_password" class="ml-auto">Lupa Sandi?</a>
              </div>
            </div>
            <div class="col-lg-12 m-b30">
              <button class="btn button-md" type="submit">Login</button>
              <!-- <button class="btn btn-primary px-4" type="button" onclick="test();" >test</button> -->
            </div>
            <!--
            <div class="col-lg-12">
              <h6>Login with Social media</h6>
              <div class="d-flex">
                <a class="btn flex-fill m-r5 facebook" href="#"><i class="fa fa-facebook"></i>Facebook</a>
                <a class="btn flex-fill m-l5 google-plus" href="#"><i class="fa fa-google-plus"></i>Google Plus</a>
              </div>
            </div>
            -->
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- CoreUI and necessary plugins-->
<script src="<?=base_url()?>assets_new/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/popper.js/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/@coreui/coreui/js/coreui.min.js"></script>
<script src="<?=base_url()?>assets_new/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="<?=base_url()?>assets_new/vendors/magnific-popup/magnific-popup.js"></script>
<script src="<?=base_url()?>assets_new/vendors/counter/waypoints-min.js"></script>
<script src="<?=base_url()?>assets_new/vendors/counter/counterup.min.js"></script>
<!-- <script src="<?=base_url()?>assets_new/vendors/imagesloaded/imagesloaded.js"></script> -->
<script src="<?=base_url()?>assets_new/vendors/masonry/masonry.js"></script>
<script src="<?=base_url()?>assets_new/vendors/masonry/filter.js"></script>
<script src="<?=base_url()?>assets_new/vendors/owl-carousel/owl.carousel.js"></script>
<script src="<?=base_url()?>assets_new/js/functions.js"></script>
<script src="<?=base_url()?>assets_new/js/contact.js"></script>
  </body>
</html>
