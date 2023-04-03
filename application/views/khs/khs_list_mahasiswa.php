<!doctype html>
<link href="<?php echo base_url();?>assets/vendors/select2/css/select2.min.css" rel="stylesheet" />
<!-- Plugins and scripts required by this view-->
<script src="<?php echo base_url();?>assets/vendors/jquery.maskedinput/js/jquery.maskedinput.js"></script>
<script src="<?php echo base_url();?>assets/vendors/select2/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/advanced-forms.js"></script>
<script>
	$('.kode_tahun_akademik').on('change', function() {
		var thn = this.value;
		var url = "<?=site_url('khs/get_khs/')?>"+thn;
		$('#table_krs').load(url);
	  // alert( url );
	});
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
                                            <h4 style="margin-top:0px">Kartu Hasil Studi</h4>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div style="margin-top: 4px"  id="message">
                                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 10px">
											<div class="col-md-2">
	                                            <select name="kode_tahun_akademik" style="width: 100%" class="form-control select2-single kode_tahun_akademik" id="select2-2">
	                                              <option value>Pilih Semester</option>
	                                              <?php foreach (range(1, $semester) as $x) {
	                                              // <?php foreach ($tahun_akademik as $list) {
	                                                echo '<option value="'.$x.'">Semester '.$x.'</option>';
	                                              } ?>
	                                            </select>
	                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div style="margin-top: 4px"  id="message">
                                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-right">
                                        <?php if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('create_khs')) : ?>
                                            <button class="btn btn-primary btn-sm" onclick="load_controler('khs/create');">Print</button>
                                        <?php endif; ?>
	                                   </div>
	                                </br></br>
	                                	<div class="table-responsive" id="table_krs">
												<!--
												<br><br>

												<b> Detail Nilai : </b>
												<table class="table table-striped table-sm" style="width: 50%;">
													<thead>
													    <tr>
													        <th width="30">No.</th>
													        <th>Mata Kuliah</th>
													        <th>Kehadiran</th>
													        <th>Tugas</th>
													        <th>UTS</th>
													        <th>UAS</th>
													    </tr>
												  	</thead>

													<tbody>
																		<tr>
															<td>1</td>
															<td>Manajemen Koperasi</td>
															<td class="text-center">92</td>
															<td class="text-center">0.00</td>
															<td class="text-center">0.00</td>
															<td class="text-center">0.00</td>
															</tr>
																	<tr>
															<td>2</td>
															<td>Manajemen Pemasaran 1</td>
															<td class="text-center">0</td>
															<td class="text-center"></td>
															<td class="text-center"></td>
															<td class="text-center"></td>
															</tr>
																	<tr>
															<td>3</td>
															<td>Manajemen Sumber Daya Manusia</td>
															<td class="text-center">0</td>
															<td class="text-center"></td>
															<td class="text-center"></td>
															<td class="text-center"></td>
															</tr>
																	<tr>
															<td>4</td>
															<td>Perilaku Keorganisasian</td>
															<td class="text-center">58</td>
															<td class="text-center">0.00</td>
															<td class="text-center">50.00</td>
															<td class="text-center">0.00</td>
															</tr>
																	<tr>
															<td>5</td>
															<td>Statistik Ekonomi 1</td>
															<td class="text-center">70</td>
															<td class="text-center">0.00</td>
															<td class="text-center">50.00</td>
															<td class="text-center">0.00</td>
															</tr>
																	<tr>
															<td>6</td>
															<td>Akuntansi  Biaya</td>
															<td class="text-center">82</td>
															<td class="text-center">0.00</td>
															<td class="text-center">70.00</td>
															<td class="text-center">0.00</td>
															</tr>
														</tbody>
												</table>
											-->
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