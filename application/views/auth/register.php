<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url();?>assets/loginform/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/loginform/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/loginform/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/loginform/css/style.css">

    <script src="<?php echo base_url();?>assets/vendors/jquery/js/jquery.min.js"></script>

    <title>Register Member</title>
  </head>
  <body>
  

  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center" id="gambar">
          <img src="<?php echo base_url();?>assets/loginform/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
          <!-- <img style="width: 80%;" src="https://pbs.twimg.com/profile_images/1282529466476974080/OafEsWxz_400x400.jpg" alt="Image" class="img-fluid"> -->
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <div class="text-center mb-4" id="logo_mobile">
                  <img class="img-fluid" width="300px" src="https://lpkn.id/front_assets/lpkn_iso_putih.png">
                </div>
              <h3 class="text-white">Register Member</h3>
              <p class="mb-4">Sudah punya akun ? <a href="<?=base_url()?>auth/login">Login Disini</a></p>
            </div>
      				<form method="post" action="" class="contact-bx test" id="regis_form">
      					<div class="row placeani">
      						<div class="col-lg-12">
      							<div class="form-group first">
      								<div class="input-group">
      									<label>Nama Lengkap</label>
      									<input name="nama_lengkap" type="text" required="" class="form-control">
      								</div>
      							</div>
      						</div>
                  <div class="col-lg-12">
      							<div class="form-group">
      								<div class="input-group"> 
      									<label class="mb-2">Profesi </label>
      									<select name="profesi" type="text" class="form-control mt-3" required="" style="font-size: 14px !important;">
                          <option value=""> Pilih Profesi </option>
                          <option value="asn"> ASN </option>
                          <option value="nonasn"> Non ASN </option>
                        </select>
      								</div>
      							</div>
      						</div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="input-group">
                        <label>Email</label>
                        <input name="email" type="email" required="" class="form-control mt-3" style="font-size: 14px !important;">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="input-group">
                        <label>No WhatsApp</label>
                        <input name="phone" type="number" required="" class="form-control mt-3" style="font-size: 14px !important;">
                      </div>
                    </div>
                  </div>
      						<div class="col-lg-12">
      							<div class="form-group last mb-4">
      								<div class="input-group"> 
      									<label>Password</label>
      									<input name="password" type="password" class="form-control mt-3" style="font-size: 14px !important;" required="">
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
                    <button class="btn btn-block btn-primary" type="submit">Buat Akun</button>
      							<!-- <button name="submit" type="submit" value="Submit" class="btn button-md">Sign Up</button> -->
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
    </div>
  </div>

  
    <!-- <script src="<?php echo base_url();?>assets/loginform/js/jquery-3.3.1.min.js"></script> -->
    <script src="<?php echo base_url();?>assets/loginform/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/loginform/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/loginform/js/main.js"></script>
  <script src="<?php echo base_url();?>assets/vendors/jquery/js/jquery.min.js"></script>
  <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
  <!-- Plugins and scripts required by this view-->
  <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
  <script src="<?php echo base_url();?>assets/js/toastr.js"></script>

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
