<!doctype html>

		    <?php $event = $detail_event->event; ?>
		    <div class="modal-content">
		      <div class="modal-body">
		      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
		      	<div class="row">
		      		<div class="col-sm-6">
				      	<img class="img-fluid" src="https://event.lpkn.id/uploads/brosur/<?=$event->brosur?>">
		      		</div>
		      		<div class="col-sm-6">
		      			<div class="container-fluid">
		      				<br/>
		      				<div class="text-center">
		      				<h1>Daftarkan diri Anda sekarang</h1>
		      				<!-- <form method="post" class="regis_event" id="regis_event"> -->
	      					<!-- <form id="regis_event" method="post"> -->
			      				<hr style="background-color: #fff;"></hr>
			      				<input type="hidden" name="id_event" value="<?=$event->id?>">
				      			<?php
				      			if($detail_event->count_biaya_event > 1){ ?>
			      				<h5>PILIH BIAYA PELATIHAN</h5>
				      			<select class="form-control" name="biaya">
				      				<?php
				      					foreach ($detail_event->biaya as $row) {
				      						echo '<option value="'.$row->no_urut.'">Rp. '.number_format($row->nominal_biaya).' - '.$row->nama_biaya.'</option>';
				      					}
				      				?>
				      			</select>
					      		<br/>
					      		<?php }else{?>
			      				<h5>BIAYA PELATIHAN</h5>
			      				<h3>Rp. <?=number_format($detail_event->biaya_event->nominal_biaya)?>,-</h3>
					      		<!-- <input type="hidden" id="biaya" name="biaya" value="1"> -->
					      		<?php } ?>
					      		<!-- <input type="hidden" name="slug" value="<?=$event->slug?>"> -->
					      		<p>Login untuk dapat mendaftar</p>
					      		<a href="<?=base_url()?>auth/login" class="btn btn-primary">Login Sekarang</a>
					      		</div>
					      	<!-- </form> -->
				      		<hr style="background-color: #fff;"></hr>
				      		<p>
								<b>WAKTU</b><br/>
								e- Learning : 8 - 15 Agustus 2022<br/>
								Pelatihan : 23 - 24 Agustus 2022<br/>
								Ujian : 25 Agustus 2022<br/><br/>

								<b>FASILITAS PESERTA</b><br/>
								- Mengikuti Kelas Kompetensi<br/>
								- Materi Pelatihan<br/>
								- 6 Modul Hardcopy dan Softcopy<br/>
								- 6 Modul Latihan<br/>
								- SKKNI dan Perpres Pengadaan<br/>
								- Sertifikat Pelatihan Kompetensi<br/>
								- Sertifikat Komptensi BNSP (jika telah dinyatakan lulus)<br/>
								- Gelar Profesi Non akademik (CPOf)<br/>
								- Tas dan Kelengkapannya<br/>
								- Makan Siang, coffe/snack<br/>
								- Sarapan dan Makan Malam (bagi yang menginap)
				      		</p>
				      		<hr style="background-color: #fff;"></hr>
					      	<p class="modal-title w-100 text-center">
								WhatsApp Panitia :<br/>
								<?php $no = 1; foreach ($detail_event->panitia as $row) {?>
									<a class="btn btn-success btn-sm mb-2" style="border-radius: 40px;" target="blank_" href="https://wa.me/<?=$row->phone?>">
										<i class="fab fa-whatsapp"></i> Panitia <?=$no++?>
									</a>
								<?php } ?>
								<br/>
								Kontak Panitia :<br/>
								<?php foreach ($detail_event->panitia as $row) {
								  echo substr_replace($row->phone,'0','0',2).', ';
								} ?>
							</p>
						</div>
		      		</div>
		      	</div>
		      </div>
		    </div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
