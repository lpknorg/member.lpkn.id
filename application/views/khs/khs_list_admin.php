<!doctype html>
<link href="<?php echo base_url();?>assets/vendors/select2/css/select2.min.css" rel="stylesheet" />
<!-- Plugins and scripts required by this view-->
<script src="<?php echo base_url();?>assets/vendors/jquery.maskedinput/js/jquery.maskedinput.js"></script>
<script src="<?php echo base_url();?>assets/vendors/select2/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/advanced-forms.js"></script>
<script>
	$('.mahasiswa').on('change', function() {
		var NIM = this.value;
		var url = "<?=site_url('khs/get_semester/')?>"+NIM;
		$('#semester').load(url);
		$('#table_krs').html('');
		// alert( NIM );
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
											<div class="col-md-4">
	                                            <select name="mahasiswa" style="width: 100%" class="form-control select2-single mahasiswa" id="select2-1">
	                                              <option value>Pilih Mahasiswa</option>
	                                              <?php foreach ($mahasiswa as $list) {
	                                                echo '<option value="'.$list->NIM.'">'.$list->NIM.' - '.$list->nama_depan.' '.$list->nama_belakang.'</option>';
	                                              } ?>
	                                            </select>
	                                        </div>
                                        <div class="col-md-2" id="semester">
                                            <div style="margin-top: 4px"  id="message">
                                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                            </div>
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