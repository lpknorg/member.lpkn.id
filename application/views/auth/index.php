<!doctype html>

<!-- <link href="<?=base_url()?>assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" /> -->
<!-- Plugins and scripts required by this view-->
<!-- <script src="<?=base_url()?>assets/vendors/datatables.net/js/jquery.dataTables.js"></script> -->
<!-- <script src="<?=base_url()?>assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.js"></script> -->
<script src="<?=base_url()?>assets/js/datatables.js"></script>
    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.status').change(function() {
			var id = $(this).prop("id");
			if(!$('#'+id).is(":checked")) {
				// this.checked = confirm("Are you sure?");
                $.ajax({
                    type: "POST",
                    url: "<?=site_url('auth/deactivate/')?>"+$(this).val(),
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
                        $("#"+id).prop('checked',false);
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
                        $("#"+id).prop('checked', "checked");
                    }
                })
				
			}else{
                $.ajax({
                    type: "POST",
                    url: "<?=site_url('auth/activate/')?>"+$(this).val(),
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
                        $("#"+id).prop('checked', "checked");
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
                        $("#"+id).prop('checked', false);
                    }
                })
			}
		});
	});
</script>

            <!-- <main class="main"> -->
                <!-- Breadcrumb-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">SISTEM INFORMASI USER & MENU</li>
                    <input type="hidden" id="msg">
                    <!-- Breadcrumb Menu-->
                    <li class="breadcrumb-menu d-md-down-none">
                        <div class="btn-group" role="group" aria-label="Button group">
                            <a class="btn" href="#">
                                <i class="icon-speech"></i>
                            </a>
                            <a class="btn" href="./">
                                <i class="icon-graph"></i>  Dashboard</a>
                            <a class="btn" href="#">
                                <i class="icon-settings"></i>  Settings</a>
                        </div>
                    </li>
                </ol>
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                    <div class="row" style="margin-bottom: 10px">
                                        <div class="col-md-4">
                                            <h4 style="margin-top:0px">Users List</h4>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div style="margin-top: 4px"  id="message">
                                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                            </div>
                                        </div>
                                        <?php if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('create_users')) : ?>
                                        <div class="col-md-4 text-right">
                                            <button class="btn btn-primary btn-sm" onclick="load_controler('auth/create_user');">Create</button>
	                                      </div>
                                          <?php endif; ?>
                                            </div>
	                                            <div class="table-responsive">
													<table class="table table-striped table-sm datatable">
      												<!-- <table class="table table-striped table-bordered datatable"> -->
      													<thead>
															<tr>
																<th><?php echo lang('index_uname_th');?></th>
																<th><?php echo lang('index_fname_th');?></th>
																<th><?php echo lang('index_lname_th');?></th>
																<th><?php echo lang('index_email_th');?></th>
																<th><?php echo lang('index_groups_th');?></th>
																<th><?php echo lang('index_status_th');?></th>
																<th><?php echo lang('index_action_th');?></th>
															</tr>
														</thead>
														<tbody>
														<?php foreach ($users as $user):?>
															<tr>
													            <td><?php echo $user->username;?></td>
													            <td><?php echo $user->first_name;?></td>
													            <td><?php echo $user->last_name;?></td>
													            <td><?php echo $user->email;?></td>
																<td>
																	<?php foreach ($user->groups as $group):?>
																		<span class="badge badge-success"><?=$group->description?></span>
                                                                    <?php endforeach?>
																</td>
																<td>
                                        						<?php if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('edit_users')) { ?>
														          <label class="switch switch-sm switch-label switch-pill switch-success">
														            <input id="<?=$user->id?>" class="switch-input status" value="<?=$user->id?>" type="checkbox"
														            	<?php echo ($user->active) ? "checked" : "";?> />
														            <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
														          </label>
														        <?php }else{ ?>
														          <label class="switch switch-sm switch-label switch-pill switch-success">
														            <input class="switch-input" type="checkbox" disabled
														            	<?php echo ($user->active) ? "checked" : "";?> />
														            <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
														          </label>
														        <?php } ?>
																</td>
																<td>
					                                                    <button onclick="load_controler('auth/profile/<?=$user->id?>');" class="btn btn-sm btn-default" type="button"><i class="fa fa-eye"></i></button>
                                        								<?php if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('edit_users')) : ?>
					                                                    	<button onclick="load_controler('auth/edit_user/<?=$user->id?>');" class="btn btn-sm btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>
					                                                    <?php endif; ?>
																</td>
															</tr>
														<?php endforeach;?>
														</tbody>
													</table>
	                                        	</div>

                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>
