
<!doctype html>
<link href="<?php echo base_url();?>assets/vendors/select2/css/select2.min.css" rel="stylesheet" />
<!-- Plugins and scripts required by this view-->
<script src="<?php echo base_url();?>assets/vendors/jquery.maskedinput/js/jquery.maskedinput.js"></script>
<script src="<?php echo base_url();?>assets/vendors/moment/js/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/vendors/select2/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/advanced-forms.js"></script>
      <script>
        $(document).ready(function() {
            $('form.jsform').on('submit', function(form){
                form.preventDefault();
                $.post('<?php echo uri_string();?>', $('form.jsform').serialize(), function(data){
                    $('main.main').html(data);
                });
            });
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
                                        <h4 style="margin-top:0px"><?php echo lang('edit_user_heading');?></h4><br>
											<div id="infoMessage"><?php echo $message;?></div>

											<?php 
												$attributes = array('uri_string()' => 'post', 'class' => 'jsform');
												echo form_open('', $attributes);
												$input_att = 'class="form-control"';
											?>

										      <div class="form-group">
										            <?php echo lang('edit_user_uname_label', 'username');?> 
										            <?php echo form_input($username, '', $input_att);?>
										      </div>
										      <div class="form-group">
										            <?php echo lang('edit_user_email_label', 'email');?> 
										            <?php echo form_input($email, '', $input_att);?>
										      </div>
										      <div class="form-group">
										            <?php echo lang('edit_user_fname_label', 'first_name');?> 
										            <?php echo form_input($first_name, '', $input_att);?>
										      </div>
										      <div class="form-group">
										            <?php echo lang('edit_user_lname_label', 'last_name');?> 
										            <?php echo form_input($last_name, '', $input_att);?>
										      </div>
										      <div class="form-group">
										            <?php echo lang('edit_user_company_label', 'company');?> 
										            <?php echo form_input($company, '', $input_att);?>
										      </div>
										      <div class="form-group">
										            <?php echo lang('edit_user_phone_label', 'phone');?> 
										            <?php echo form_input($phone, '', $input_att);?>
										      </div>
										      <div class="form-group">
										            <?php echo lang('edit_user_password_label', 'password');?> 
										            <?php echo form_input($password, '', $input_att);?>
										      </div>
										      <div class="form-group">
										            <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?>
										            <?php echo form_input($password_confirm, '', $input_att);?>
										      </div>

										      <?php if ($this->ion_auth->is_admin()): ?>
										      <div class="form-group">
									            <label><?php echo lang('edit_user_groups_heading');?></label>
									            <select class="form-control select2-multiple" name="groups[]" id="select2-2" multiple="">
										          <?php foreach ($groups as $group):?>
										              <?php
										                  $gID=$group['id'];
										                  $selected = null;
										                  $item = null;
										                  foreach($currentGroups as $grp) {
										                      if ($gID == $grp->id) {
										                          $selected= 'selected';
										                      break;
										                      }
										                  }
										              ?>
										              <option value="<?=$gID?>" <?=$selected?>><?php echo htmlspecialchars($group['description'],ENT_QUOTES,'UTF-8');?></option>
										          <?php endforeach?>
									            </select>
									          </div>
										      <?php endif ?>

										      <?php echo form_hidden('id', $user->id);?>
										      <?php echo form_hidden($csrf); ?>
										      
										      <?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="btn btn-primary"');?>
										      <button type="button" class="btn btn-default" onclick="load_controler('users');">Cancel</button>

										<?php echo form_close();?>

        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>
