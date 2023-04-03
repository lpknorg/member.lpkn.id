<!doctype html>

<!-- <script src="<?=base_url()?>assets/js/datatables.js"></script> -->
    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>

<script type="text/javascript">
    // var oTable = {};
    function cek(id, status) {
        if(status == 0){
            var url_ = 'activate';
        }else{
            var url_ = 'deactivate';
        }
        
        $.ajax({
            type: "POST",
            url: "<?=site_url('auth')?>/"+url_+"/"+id,
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
                // $("#"+id).prop('checked',false);
                reload_table();
            }
        });
    }
</script>

            <!-- <main class="main"> -->
                <!-- Breadcrumb-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">SISTEM INFORMASI USER & MENU</li>
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
                                        <div class="col-md-4 text-right">
                                            <button class="btn btn-secondary btn-sm" onclick="reload_table();"><i class="fa fa-refresh"></i></button>
                                        <?php if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('create_users')) : ?>
                                            <button class="btn btn-primary btn-sm" onclick="load_controler('auth/create_user');">Create</button>
                                        <?php endif; ?>
	                                      </div>
                                            </div>
                                            <div class="table-responsive">
                                            <table class="table table-striped table-sm" cellspacing="0" width="100%" id="mytable">
                                                <thead>
                                                    <tr>
                                                        <th width="10px">No</th>
		                                                <!-- <th>Ip Address</th> -->
                                                        <th>First Name</th>
		                                                <!-- <th>Username/NIK</th> -->
		                                                <!-- <th>Password</th> -->
		                                                <th>Email</th>
		                                                <!-- <th>Created On</th> -->
		                                                <!-- <th>Last Login</th> -->
                                                        <th>Group</th>
		                                                <!-- <th>Last Name</th> -->
		                                                <th>Company</th>
                                                        <th>Phone</th>
                                                        <th>Active</th>
		                                                <th width="90px">Action</th>
                                                    </tr>
                                                </thead>
	    
                                        </table>
                                        </div>
                                        <script type="text/javascript">
                                            var table;
                                            $(document).ready(function() {
                                                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                                                {
                                                    return {
                                                        "iStart": oSettings._iDisplayStart,
                                                        "iEnd": oSettings.fnDisplayEnd(),
                                                        "iLength": oSettings._iDisplayLength,
                                                        "iTotal": oSettings.fnRecordsTotal(),
                                                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                                                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                                                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                                                    };
                                                };

                                                table = $('#mytable').DataTable({ 
                                                    initComplete: function() {
                                                        var api = this.api();
                                                        $('#mytable_filter input')
                                                                .off('.DT')
                                                                .on('keyup.DT', function(e) {
                                                                    if (e.keyCode == 13) {
                                                                        api.search(this.value).draw();
                                                            }
                                                        });
                                                    },
                                                    oLanguage: {
                                                        sProcessing: "loading..."
                                                    },
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: {"url": "users/json", "type": "POST", "data": {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'} },
                                                    columns: [
                                                        {
                                                            "data": "id",
                                                            "orderable": false
                                                        },
                                                        // {"data": "ip_address"},
                                                        {"data": "first_name"},
                                                        // {"data": "username"},
                                                        // {"data": "password"},
                                                        {"data": "email"},
                                                        // {"data": "activation_selector"},
                                                        // {"data": "activation_code"},
                                                        // {"data": "forgotten_password_selector"},
                                                        // {"data": "forgotten_password_code"},
                                                        // {"data": "forgotten_password_time"},
                                                        // {"data": "remember_selector"},
                                                        // {"data": "remember_code"},
                                                        // {"data": "created_on"},
                                                        // {"data": "last_login"},
                                                        {
                                                            "data": "group",
                                                            "orderable": false,
                                                            "searchable": false
                                                        },
                                                        // {"data": "last_name"},
                                                        {"data": "company"},
                                                        {"data": "phone"},
                                                        {"data": "active"},
                                                        {
                                                            "data" : "all",
                                                            "orderable": false,
                                                            "className" : "text-center"
                                                        }
                                                    ],
                                                    order: [[0, 'desc']],
                                                    rowCallback: function(row, data, iDisplayIndex) {
                                                        var info = this.fnPagingInfo();
                                                        var page = info.iPage;
                                                        var length = info.iLength;
                                                        var index = page * length + (iDisplayIndex + 1);
                                                        $('td:eq(0)', row).html(index);
                                                        var status = data['active'];
                                                        if(status == 1){
                                                            var chk = 'checked';
                                                        }else{
                                                            var chk = '';
                                                        }
                                                        $('td', row).eq(6).html(
                                                                  '<label class="switch switch-sm switch-label switch-pill switch-success">'+
                                                                    '<input id="'+data['id']+'" onclick="if(confirm(\'Are you sure?\')) cek('+data['id']+','+data['active']+');" class="switch-input status" type="checkbox"'+chk+' />'+
                                                                    '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>'
                                                            );
                                                    }
                                                });
                                            });
                                            function reload_table()
                                            {
                                                table.ajax.reload(null,false); //reload datatable ajax 
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
        <script src="<?php echo base_url('assets/vendors/datatables/js/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/datatables/js/dataTables.bootstrap4.js') ?>"></script>
        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>
