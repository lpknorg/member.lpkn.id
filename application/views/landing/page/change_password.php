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
                  url: "<?=base_url()?>page/change_password",
                  data: $('form.jsform').serialize(),
                  dataType: "json",
                })
                .done(function(res) {
                    if(res.success) {
                        // toastr.success(res.count+' Data Changed', 'Success', 
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
                        // $('main.main').load(res.redirect);
                          window.location.href = res.redirect;
                          return;
                    } else {
                        toastr.warning(res.msg, 'Warning', 
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


<?php 
$input_att = 'class="form-control"';
                        $attributes = array('uri_string()' => 'post', 'class' => 'jsform');
                        echo form_open(base_url('page/change_password'), $attributes);
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
      <p><?php echo form_submit('submit', 'Ubah Password & Keluar', 'class="btn btn-primary"');?></p>

<?php echo form_close();?>
