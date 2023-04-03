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
    <meta name="description" content="Lupa Password dengan menggunakan email akun">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <title>Member Area | Lupa Password</title>
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

</head>
<body id="bg">
<div class="page-wraper">
      <!-- <div id="loading-icon-bx"></div> -->
      <div class="account-form">
            <div class="account-head" style="background-image:url(<?=base_url()?>assets_new/images/background/bg2.jpg);">
                  <div class="mx-auto col-9">                     
                        <a href="<?=base_url()?>"><img src="https://event.lpkn.id/assets_page/images/logo/logolpkn.png" alt=""></a>
                  </div>
            </div>
            <div class="account-form-inner">
                  <div class="account-container">
                        <div class="heading-bx left">
                              <h2 class="title-head">Lupa <span>Sandi</span></h2>
                              <p>Login dengan Akun kamu <a href="<?=base_url()?>auth/login">Klik Disini</a></p>
                        </div>      
                        <div id="infoMessage"><?php echo $message;?></div>
                        <?php echo form_open("auth/forgot_password", ['class' => 'contact-bx']);?>

                              <div class="row placeani">
                                    <div class="col-lg-12">
                                          <div class="form-group">
                                                <div class="input-group">
                                                      <label>Masukan Alamat Email Kamu</label>
                                                      <input name="identity" id="identity" type="email" required="" class="form-control">
                                                      <small><i>*Link reset password akan di kirim ke email kamu</i></small>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="col-lg-12 m-b30">
                                          <button name="submit" type="submit" value="Submit" class="btn button-md">Submit</button>
                                    </div>
                              </div>
                        </form>
                  </div>
            </div>
      </div>
</div>
<!-- External JavaScripts -->
<script src="<?=base_url()?>assets_new/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/popper.js/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/@coreui/coreui/js/coreui.min.js"></script>

<script src="<?=base_url()?>assets_new/vendors/bootstrap/js/popper.min.js"></script>
<script src="<?=base_url()?>assets_new/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets_new/vendors/bootstrap-select/bootstrap-select.min.js"></script>
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
<!-- <script src='<?=base_url()?>assets_new/vendors/switcher/switcher.js'></script> -->
</body>

</html>
