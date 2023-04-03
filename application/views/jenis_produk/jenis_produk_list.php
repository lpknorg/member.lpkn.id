<!doctype html>
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
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th width="80px">No</th>
                                                    <th>Jenis</th>
                                                    <th>Ket</th>
                                                    <th width="90px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $data_jenis = $this->db->get('jenis_produk')->result();
                                                $no = 1;
                                                foreach ($data_jenis as $jp) {
                                            ?>
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <td>
                                                        <input class="form-control jumlah" type="text" name="">
                                                    </td>
                                                    <td>
                                                        <input class="form-control petugas" type="text" name="">
                                                    </td>
                                                    <td>
                                                        <input class="form-control pending" type="text" name="">
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                            <button class="btn btn-primary btn-sm" onclick="myFunc()">Cek</button>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
    <script type="text/javascript">
        function myFunc() {
            let jumlah = document.getElementsByClassName('jumlah');
            let petugas = document.getElementsByClassName('petugas');
            let pending = document.getElementsByClassName('pending');
            let data_jumlah = [].map.call(jumlah, elem => elem.value);
            let data_petugas = [].map.call(petugas, elem => elem.value);
            let data_pending = [].map.call(pending, elem => elem.value);
            var position_jumlah = [];
            for (var i = 0; i < data_jumlah.length; i++) {
                if (data_jumlah[i] === "") position_jumlah.push(i+1);
            }
            var position_petugas = [];
            for (var i = 0; i < data_petugas.length; i++) {
                if (data_petugas[i] === "") position_petugas.push(i+1);
            }
            var position_pending = [];
            for (var i = 0; i < data_pending.length; i++) {
                if (data_pending[i] === "") position_pending.push(i+1);
            }
            if(position_jumlah.length === data_jumlah.length && position_petugas.length === data_petugas.length && position_pending.length === data_pending.length){
                alert("data belum terisi");
            }else{
                if(position_jumlah.join("") === position_petugas.join("") && position_jumlah.join("") === position_pending.join("")){
                    alert('Siap disimpan');
                }else{
                    alert('Data blm lengkap');
                }
            }
            console.log(position_jumlah.length);
            console.log(data_jumlah.length);
            console.log(position_petugas.length);
            console.log(data_petugas.length);
            console.log(position_pending.length);
            console.log(data_pending.length);

        }
    </script>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                    <div class="row" style="margin-bottom: 10px">
                                        <div class="col-md-4">
                                            <h4 style="margin-top:0px">Jenis Produk List</h4>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div style="margin-top: 4px"  id="message">
                                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-right">
                                        <?php if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('create_jenis_produk')) : ?>
                                            <button class="btn btn-primary btn-sm" onclick="load_controler('jenis_produk/create');">Create</button>
                                        <?php endif; ?>
	                                      </div>
                                            </div>
                                            <div class="table-responsive">
                                            <table class="table table-striped table-sm" id="mytable">
                                                <thead>
                                                    <tr>
                                                        <th width="80px">No</th>
		                                                <th>Jenis</th>
		                                                <th>Ket</th>
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
                                                    ajax: {"url": "jenis_produk/json", "type": "POST", "data": {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'} },
                                                    columns: [
                                                        {
                                                            "data": "id",
                                                            "orderable": false
                                                        },{"data": "jenis"},{"data": "ket"},
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