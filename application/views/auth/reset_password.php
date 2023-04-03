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

    <title>Reset Password</title>
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
                    <h3 class="text-white">Reset Password</h3>
                    <p class="mb-4">Sudah Ingat ? <a href="<?=base_url()?>auth/login">Login Disini</a><br/><small class="text-warning"><i>*Password minimal 8 karakter</i></small></p>
                  </div>
                  <div id="infoMessage"><?php echo $message;?></div>
				<?php echo form_open('auth/reset_password/' . $code, ['class' => 'contact-bx']);?>
                              <div class="row placeani">
                                    <div class="col-lg-12">
                                          <div class="form-group first">
                                                <div class="input-group">
                                                      <label for="new_password">New Password</label>
                                                      <?php echo form_input($new_password, '', 'class="form-control"');?>
                                                </div>
                                            </div>
                                          <div class="form-group last bm-4">
                                                <div class="input-group">
                                                      <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?>
                                                      <?php echo form_input($new_password_confirm, '', 'class="form-control"');?>
                                                </div>
                                          </div>
                                    </div>
									<?php echo form_input($user_id);?>
									<?php echo form_hidden($csrf); ?>
                                    <div class="col-lg-12 m-b30 mt-4">
                                          <button class="btn btn-block btn-danger" type="submit">Reset Password</button>
                                    </div>
                              </div>
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