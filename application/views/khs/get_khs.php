<!DOCTYPE html>
										<div class="col-md-12 col-xs-12">
												<table class="table table-striped table-sm">
												  	<thead>
													      <tr>
													        <th class="text-center" width="30" rowspan="2">No.</th>
													        <th rowspan="2">Kode</th>
													        <th rowspan="2">Mata Kuliah</th>
													        <th class="text-center" rowspan="2">SKS</th>
													        <th class="text-center" colspan="2">Nilai</th>
													        <th class="text-center" rowspan="2">Angka Mutu</th>
													        <th class="text-center" rowspan="2">Nilai Mutu</th>
													      </tr>
													    <tr>
													      <th class="text-center">Angka</th>
													      <th class="text-center">Huruf</th>
													    </tr>
												  	</thead>

													<tbody>
														<?php 
															$no = 1; 
															$total_nilai_mutu = 0;
															$total_sks = 0;
															foreach ($data_khs as $row) { 
																$nilai_mutu = $row->sks*$row->mutu;
																$sks = $row->sks; ?>
																<tr>
																	<td class="text-center"><?=$no++?></td>
																	<td><?=$row->kode_mata_kuliah?></td>
																	<td><?=$row->nama_mata_kuliah?></td>
																	<td class="text-center"><?=$row->sks?></td>
																	<td class="text-center"><?=$row->nilai_angka?></td>
																	<td class="text-center"><?=$row->nilai_huruf?></td>
																	<td class="text-center"><?=$row->mutu?></td>
																	<td class="text-center"><?=$row->sks*$row->mutu?></td>
																</tr>
														<?php 
															$total_nilai_mutu += $nilai_mutu;
															$total_sks += $sks;  } ?>
															<tr>
																<th class="text-right" colspan="3">Total</th>
																<th class="text-center"><?=$total_sks?></th>
																<th colspan="3"></th>
																<th class="text-center"><?=$total_nilai_mutu?></th>
															</tr>
															<tr>
																<th class="text-right" colspan="3">Indeks Prestasi Semester</th>
																<th class="text-center" colspan="5"><?=$total_nilai_mutu/$total_sks?></th>
															</tr>
															</tbody>
													</table>
													<button class="btn btn-primary btn-sm" onclick="load_controler('khs/create');">Print</button>

													
        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>

