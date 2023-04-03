<!doctype html>
<link href="<?=base_url()?>assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" />
<!-- Plugins and scripts required by this view-->
<script src="<?=base_url()?>assets/vendors/datatables.net/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?=base_url()?>assets/js/datatables.js"></script>
    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
<script>
$(document).ready(function() {
    var t = $('#example').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'desc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    $('.status').change(function() {
        var id = $(this).prop("id");
            if(!$('#'+id).is(":checked")) {
                // this.checked = confirm("Are you sure?");
                $.ajax({
                    type: "POST",
                    url: "<?=site_url('tahun_akademik/deactivate/')?>"+$(this).val(),
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
                    url: "<?=site_url('tahun_akademik/activate/')?>"+$(this).val(),
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
} );
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
                                            <h4 style="margin-top:0px">Tahun Akademik List</h4>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div style="margin-top: 4px"  id="message">
                                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-right">
                                        <?php if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('create_tahun_akademik')) : ?>
                                            <button class="btn btn-primary btn-sm" onclick="load_controler('tahun_akademik/create');">Create</button>
                                        <?php endif; ?>
	                                      </div>
                                            </div>
                                            <div class="table-responsive">
                                            <table class="table table-striped table-sm" id="example">
                                                <thead>
                                                    <tr>
                                                        <th width="10px">No</th>
		                                                <th>Kode Tahun Akademik</th>
		                                                <th>Nama Tahun Akademik</th>
		                                                <th>Status</th>
		                                                <th>Ket</th>
		                                                <th width="90px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $th_akade = $this->db->get('tahun_akademik')->result();
                                                     foreach ($th_akade as $list):?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?=$list->kode_tahun_akademik?></td>
                                                        <td><?=$list->nama_tahun_akademik?></td>
                                                        <td>
                                                                <?php if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('edit_tahun_akademik')) { ?>
                                                                  <label class="switch switch-sm switch-label switch-pill switch-success">
                                                                    <input id="<?=$list->id_tahun_akademik?>" class="switch-input status" value="<?=$list->id_tahun_akademik?>" type="checkbox"
                                                                        <?php echo ($list->status == 1) ? "checked" : "";?> />
                                                                    <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                                                                  </label>
                                                                <?php }else{ ?>
                                                                  <label class="switch switch-sm switch-label switch-pill switch-success">
                                                                    <input class="switch-input" type="checkbox" disabled
                                                                        <?php echo ($list->status == 1) ? "checked" : "";?> />
                                                                    <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                                                                  </label>
                                                                <?php } ?>
                                                        </td>
                                                        <td><?=$list->ket?></td>
                                                        <td>
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                <button onclick="load_controler('tahun_akademik/read/<?=$list->id_tahun_akademik?>');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                                <?php if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('edit_tahun_akademik')) : ?>
                                                                <button onclick="load_controler('tahun_akademik/update/<?=$list->id_tahun_akademik?>');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>
                                                                <?php endif; ?>
                                                                <?php if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('delete_tahun_akademik')) : ?>
                                                                <button onclick="if(confirm('Are you sure?')) load_controler('tahun_akademik/delete/<?=$list->id_tahun_akademik?>');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach?>
                                                </tbody>
	    
                                        </table>
                                        </div>
                                        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables4/datatables.min.css') ?>"/>
                                        <script type="text/javascript" src="<?php echo base_url('assets/datatables4/datatables.min.js') ?>"></script>
                                        <script type="text/javascript">
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


                                                var t = $("#mytable").dataTable({
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
                                                    ajax: {"url": "tahun_akademik/json", "type": "POST", "data": {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'} },
                                                    columns: [
                                                        {
                                                            "data": "id_tahun_akademik",
                                                            "orderable": false
                                                        },{"data": "kode_tahun_akademik"},{"data": "nama_tahun_akademik"},{"data": "status"},{"data": "ket"},
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
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>