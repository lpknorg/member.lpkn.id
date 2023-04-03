<!doctype html>
    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
      <script>
        $(document).ready(function() {
            /*
            $('form.jsform').on('submit', function(form){
                form.preventDefault();
                $.post('<?php echo uri_string();?>', $('form.jsform').serialize(), function(data){
                    $('main.main').html(data);
                });
            });
            */
          $('form.jsform').on('submit', function(e){
              e.preventDefault();
              $.ajax({
                  type: "POST",
                  url: "<?php echo uri_string();?>",
                  data: $('form.jsform').serialize(),
                  dataType: "json",
                })
                .done(function(res) {
                    if(res.success) {
                        toastr.success(res.count+' Data Changed', 'Success', 
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
                        // $('main.main').load(res.redirect);
                          window.location.href = res.redirect;
                          return;
                    } else {
                        toastr.warning('You Not Have Changed', 'Warning', 
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
                    }
                })
          })
        });
      </script>


                <ol class="breadcrumb">
                    <li class="breadcrumb-item">SISTEM INFORMASI USER & MENU</li>
                </ol>
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="margin-top:0px"><?php echo lang('change_password_heading');?></h4><br>
                      <div id="infoMessage"><?php echo $message;?></div>


<?php 
$input_att = 'class="form-control"';
                        $attributes = array('uri_string()' => 'post', 'class' => 'jsform');
                        echo form_open('', $attributes);
// echo form_open("auth/change_password");
?>

      <div class="form-group">
            <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
            <?php echo form_input($old_password, '', $input_att);?>
      </div>

      <div class="form-group">
            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
            <?php echo form_input($new_password, '', $input_att);?>
      </div>

      <div class="form-group">
            <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
            <?php echo form_input($new_password_confirm, '', $input_att);?>
      </div>

      <?php echo form_input($user_id);?>
      <p><?php echo form_submit('submit', lang('change_password_submit_btn'), 'class="btn btn-primary"');?></p>

<?php echo form_close();?>
