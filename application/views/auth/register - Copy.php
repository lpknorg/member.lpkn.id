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
    <meta name="description" content="Register Member Vendor-Indonesia">
    <meta name="author" content="">
    <meta name="keyword" content="Vendor-Indonesia, Asosiation, Vendor, Pengadaan">
    <title>Member Area | Register Member</title>
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
				<a href="<?=base_url()?>"><img src="https://event.lpkn.id/assets_page/images/logo/logolpkn.png" alt=""></a>
			</div>
		</div>
		<div class="account-form-inner">
			<div class="account-container">
				<div class="heading-bx left">
					<h2 class="title-head">Registrasi <span>Member</span></h2>
					<p>Sudah Punya Akun <a href="<?=base_url()?>auth/login">Klik Disini</a></p>
				</div>	
				<form method="post" action="" class="contact-bx test" id="regis_form">
					<div class="row placeani">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Nama Lengkap</label>
									<input name="nama_lengkap" type="text" required="" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Alamat Lengkap <small><i>(Minimal 50 Karakter)</i></small></label>
									<!-- <input name="nik" type="text" required="" class="form-control"> -->
                  <textarea required="" name="alamat_lengkap" minlength="50" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Email</label>
									<input name="email" type="email" required="" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Password</label>
									<input name="password" type="password" class="form-control" required="">
								</div>
							</div>
						</div>
						<!--
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Konfirmasi Password</label>
									<input name="password" type="password" class="form-control" required="">
								</div>
							</div>
						</div>
						-->
						<div class="col-lg-12 m-b30">
							<button name="submit" type="submit" value="Submit" class="btn button-md">Sign Up</button>
							<!-- <button name="submit" type="button" onclick="test()" value="Submit" class="btn button-md">Sign test</button> -->
						</div>
						<!--
						<div class="col-lg-12">
							<h6>Sign Up with Social media</h6>
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
<script>
  function get_kota(id){
    var url = "<?=site_url('auth/getKota/"+id+"')?>";
    $('#kota').load(url);
  }

    $('#regis_form').on('submit', function(e){
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            url: "<?=base_url()?>auth/regis_post",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            dataType: "json",
        })
        .done(function(res) {
            if(res.success) {
                toastr.success(res.msg, 'Success', 
                    {
                      "positionClass": "toast-top-right",
                      "preventDuplicates": false,
                      "showDuration": "300",
                      "hideDuration": "1000",
                      "timeOut": "2000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                    })
                   window.setTimeout( function(){
                       window.location = "<?=base_url()?>auth/regis_success/"+res.id_user;
                   }, 2000 );
            } else {
                toastr.error(res.msg, 'Failed', 
                    {
                      "positionClass": "toast-top-right",
                      "preventDuplicates": false,
                      "showDuration": "300",
                      "hideDuration": "1000",
                      "timeOut": "2000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                    })
                // alert('gagal');
            }
        })
            
      });
</script>
  </body>
</html>
