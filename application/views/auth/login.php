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

    <title>Login Memeber</title>
  </head>
  <body>
  
  <script src="<?php echo base_url();?>assets/vendors/jquery/js/jquery.min.js"></script>
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

  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center" id="gambar">
          <img src="<?php echo base_url();?>assets/loginform/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <div class="text-center mb-4" id="logo_mobile">
                  <img class="img-fluid" width="300px" src="https://lpkn.id/front_assets/lpkn_iso_putih.png">
                </div>
              <h3 class="text-white">Log In Member</h3>
              <p class="mb-4">Silahkan login untuk dapat masuk<br/>Belum punya akun ? <a href="<?=base_url()?>auth/register">Buat Akun</a></p>
            </div>
            <div id="infoMessage"><?php echo $message;?></div>
              <?php 
              $attributes = array('class' => 'contact-bx', 'name' => 'myForm', 'onsubmit' => 'return validateForm()');
              echo form_open("auth/login", $attributes);?>
              <div class="form-group first">
                <label for="username">Email</label>
                <!-- <input type="text" class="form-control" id="username"> -->
                <?php echo form_input($identity, $identity, ' class="form-control"');?>

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <!-- <input type="password" class="form-control" id="password"> -->
                <?php echo form_input($password, '', ' class="form-control"');?>
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" name="remember" id="remember" value="1" />
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="forgot_password" class="forgot-pass">Forgot Password</a></span> 
              </div>
              <button class="btn btn-block btn-success pl-3 pr-3" type="submit">Login</button>
              <!-- <input type="submit" value="Log In" class="btn btn-block btn-danger"> -->

            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="<?php echo base_url();?>assets/loginform/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/loginform/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/loginform/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/loginform/js/main.js"></script>
  </body>
</html>