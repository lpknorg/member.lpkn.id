<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrasi Sukses</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>lte_assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link href="<?php echo base_url();?>assets/vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>lte_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>lte_assets/dist/css/adminlte.min.css">
   <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/vendors/jquery/js/jquery.min.js"></script>
</head>
<body class="hold-transition register-page">
<!-- <body class="hold-transition register-page" style="background-image:url(<?php echo base_url('assets/img/beach-1852945.jpg') ?>); background-size: 100% auto;"> -->
<link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
<!-- Plugins and scripts required by this view-->
<script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
<script src="<?php echo base_url();?>assets/js/toastr.js"></script>
<div class="register-box">
  <div class="register-logo">
    <!-- <a href=""><b>Sertifikasi</b>Pengadaan</a> -->
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <!-- <p class="login-box-msg">Register a new membership</p> -->
      <center>
        <!-- <img style="height: 50px" src="<?php echo base_url() ?>assets/img/lsp-bnsp-logo.png"> -->
        <br><br>
        <h2><b>Registrasi Berhasil</b></h2> 
        <h4>Untuk dapat menggunakan akun, silahkan melakukan verifikasi email ke <b><i><?=$user->email?></i></b></h4>
      <br>

      Halaman Login <a href="<?php echo base_url() ?>auth/login" class="text-center">klik disini</a>
      </center>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>lte_assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>lte_assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>lte_assets/dist/js/adminlte.min.js"></script>
<!-- toastr -->
<script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
<script src="<?php echo base_url();?>assets/js/toastr.js"></script>
  <script>
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
                  /*
                   window.setTimeout( function(){
                       window.location = "<?=base_url()?>pmb/status";
                   }, 2000 );
                   */
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
