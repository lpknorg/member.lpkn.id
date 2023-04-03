			<?php
				$user = $this->ion_auth->user()->row();
				$count_produk = $this->db->where('id_member', $user->id)->get('produk')->num_rows();
				$sum = $this->db->select('sum(view) AS views, sum(quot) AS quots, sum(`like`) AS likes')->where('id_member', $user->id)->get('produk')->row();
			?>
			<!-- <main class="main"> -->
				<!-- Breadcrumb-->
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Home</li>
					<li class="breadcrumb-item">
						<a href="#">Member</a>
					</li>
					<li class="breadcrumb-item active">Dashboard</li>
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
							<div class="col-sm-6 col-lg-3">
								<div class="card text-white bg-primary">
									<div class="card-body pb-0">
										<button type="button" class="btn btn-transparent p-0 float-right">
											<i class="icon-pin"></i>
										</button>
										<div class="text-value"><?=number_format($count_produk)?></div>
										<div>Product</div>
									</div>
									<div class="chart-wrapper mt-3 mx-3" style="height:70px;">
										<canvas id="card-chart1" class="chart" height="70"></canvas>
									</div>
								</div>
							</div>
							<!--/.col-->
							<div class="col-sm-6 col-lg-3">
								<div class="card text-white bg-info">
									<div class="card-body pb-0">
										<button type="button" class="btn btn-transparent p-0 float-right">
											<i class="icon-pin"></i>
										</button>
										<div class="text-value"><?=number_format($sum->views)?></div>
										<div>Viewer </div>
									</div>
									<div class="chart-wrapper mt-3 mx-3" style="height:70px;">
										<canvas id="card-chart2" class="chart" height="70"></canvas>
									</div>
								</div>
							</div>
							<!--/.col-->
							<div class="col-sm-6 col-lg-3">
								<div class="card text-white bg-warning">
									<div class="card-body pb-0">
										<button type="button" class="btn btn-transparent p-0 float-right">
											<i class="icon-pin"></i>
										</button>
										<div class="text-value"><?=number_format($sum->quots)?></div>
										<div>Request Quotations</div>
									</div>
									<div class="chart-wrapper mt-3" style="height:70px;">
										<canvas id="card-chart3" class="chart" height="70"></canvas>
									</div>
								</div>
							</div>
							<!--/.col-->
							<div class="col-sm-6 col-lg-3">
								<div class="card text-white bg-danger">
									<div class="card-body pb-0">
										<button type="button" class="btn btn-transparent p-0 float-right">
											<i class="icon-pin"></i>
										</button>
										<div class="text-value"><?=number_format($sum->likes)?></div>
										<div>Like</div>
									</div>
									<div class="chart-wrapper mt-3 mx-3" style="height:70px;">
										<canvas id="card-chart4" class="chart" height="70"></canvas>
									</div>
								</div>
							</div>
							<!--/.col-->
						</div>
						<!--/.row-->



						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										Majalah
									</div>
									<div class="card-body">
                                        <div class="table-responsive">
                                            <table style="width: 100%" class="table table-striped table-sm" id="mytable">
                                                <thead>
                                                    <tr>
                                                        <th width="10px">No</th>
		                                                <th>Judul</th>
		                                                <th>Brosur</th>
		                                                <th>Ket</th>
		                                                <th>Create Date</th>
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
                                                    ajax: {"url": "majalah/json", "type": "POST", "data": {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'} },
                                                    columns: [
                                                        {
                                                            "data": "id",
                                                            "orderable": false
                                                        },{"data": "judul"},{"data": "foto"},{"data": "ket"},{"data": "create_date"},
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
                                                        if( data['foto'] == 'gagal' ) {
                                                            $('td', row).eq(2).html('-')
                                                        }else{
                                                            $('td', row).eq(2).html('<img height="40" src="<?=base_url('uploads/foto_majalah')?>/'+data['foto']+'" data-action="zoom">')
                                                        }
                                                        if( data['foto'] == 'gagal' ) {
                                                            $('td', row).eq(5).html('-')
                                                        }else{
                                                            $('td', row).eq(5).html('<a class="btn btn-success btn-sm" href="<?=base_url()?>majalah/download/'+data['id']+'" target=_blank"><i class="fa fa-download"></i> Download File</a>')
                                                        }
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
			<!-- </main> -->
		<script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/@coreui/coreui-pro/js/coreui.min.js"></script>
		<!-- <script src="<?php echo base_url();?>assets/vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/js/custom-tooltips.min.js"></script> -->
		<script src="<?php echo base_url();?>assets/js/main.js"></script>
		<script src="<?php echo base_url();?>assets/js/charts.js"></script>
