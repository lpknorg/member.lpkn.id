<!doctype html>
            <!-- <main class="main"> -->
                <!-- Breadcrumb-->
                <div class="mb-3"></div>
                <div class="container-fluid">
                <?php 
                    if ($this->ion_auth->in_group('register')){ 
                        $this->load->view('notif'); }
                    elseif ($this->ion_auth->in_group('expired')) {
                        $this->load->view('notif_expired'); }
                ?>
                    <div class="animated fadeIn">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                    <div class="row" style="margin-bottom: 10px">
                                        <div class="col-md-4">
                                            <h4 style="margin-top:0px">Pembayaran List</h4>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div style="margin-top: 4px"  id="message">
                                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-right">
                                        <?php if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('create_pembayaran')) : ?>
                                            <button class="btn btn-primary btn-sm" onclick="load_controler('pembayaran/create');">Create</button>
                                        <?php endif; ?>
                                        <?php 
                                        if($this->ion_auth->in_group('member')){
                                            $this->load->view('notif_topup');
                                        }
                                        ?>
	                                      </div>
                                            </div>
                                            <div class="table-responsive">
                                            <table class="table table-striped table-sm" id="mytable">
                                                <thead>
                                                    <tr>
                                                        <th width="10px">No</th>
                                                        <th>No.Invoice</th>
		                                                <th>Jenis Pembayaran</th>
		                                                <th>Paket</th>
		                                                <th>Nominal</th>
		                                                <th>Bukti</th>
		                                                <th>Status</th>
		                                                <!-- <th>Create Date</th> -->
		                                                <!-- <th>Update Date</th> -->
		                                                <!-- <th>Update By</th> -->
		                                                <th width="90px">Action</th>
                                                    </tr>
                                                </thead>
	    
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
                                                    ajax: {"url": "pembayaran/json", "type": "POST", "data": {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'} },
                                                    columns: [
                                                        {
                                                            "data": "id",
                                                            "orderable": false
                                                        },
                                                        {"data": "invoice"},
                                                        {"data": "jenis_pembayaran"},
                                                        {"data": "paket"},
                                                        {"data": "nominal"},
                                                        {"data": "bukti"},
                                                        // {"data": "snaptoken"},
                                                        {"data": "status_name"},
                                                        // {"data": "create_date"},
                                                        // {"data": "update_date"},
                                                        // {"data": "update_by"},
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
                                                        var n = parseInt(data['nominal']);
                                                        $('td:eq(0)', row).html(index);
                                                        $('td:eq(4)', row).html('Rp. '+n.toLocaleString());
                                                        if( data['bukti'] == null ) {
                                                            $('td', row).eq(5).html('-')
                                                        }else{
                                                            $('td', row).eq(5).html('<img height="40" src="<?=base_url('uploads/bukti')?>/'+data['bukti']+'" data-action="zoom">')
                                                        }
                                                        // alert(n.toLocaleString());
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