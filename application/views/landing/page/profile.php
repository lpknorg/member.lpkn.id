

<style>
	.dokumentasi-kegiatan{
		padding: 7px;
		margin: 7px;
		background: #fff;
	}

	.parent_pp {
	/*border: 1px solid;*/
	width: 20vh;
	height: 20vh;
	overflow: hidden;
	display: flex;
	/*border-radius: 50%;*/
	}

	.pp {
	max-width: inherit;
	max-height: inherit;
	height: inherit;
	width: inherit;
	object-fit: cover;
	}


	.card-special {
		z-index: 1;
		border-radius: 6px 6px 6px 6px;
		border: 1;
		transition: 0.4s;
	}
	.card-wrapper-special {
		padding: 6px;
		/*box-shadow: 0 10px 60px 0 rgba(0, 0, 0, 0.2);*/
	}
	.card-special:hover {
		transform: scale(1.1);
		box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.4);
		z-index: 2;
	}
	.card-text-special {
		color: #fea200;
		font-weight: 500;
	}
	.card-img-top-special {
		/*border-radius: unset;*/
		border-radius: 5px 5px 5px 5px;
	}

	.img__description_layer {
		font-size: 14px;
		/*font-weight: bold;*/
		position: absolute;
		text-align: center;
		padding: 6px
		top: auto;
		/*top: 100px;*/
		width: 100%;
		bottom: 0;
		left: 0;
		right: 0;
		border-radius: 0px 0px 5px 5px;
		/*background: rgba(0 0 0 / 85%);*/
		color: white;
		visibility: hidden;
		opacity: 0;
		/*display: flex;*/
		align-items: center;
		justify-content: bottom;

		/* transition effect. not necessary */
		transition: opacity .2s, visibility .2s;
	}
	.img__wrap:hover .img__description_layer {
		visibility: visible;
		opacity: 1;
	}

	/*button load_more*/
	@media only screen and (min-width: 767px) {
	.show-large {
		display: block;
	}
	.show-mobile {
		display: none;
	}
	}

</style>

<?php
$user = $this->ion_auth->user()->row();
// $member = $this->db->where('nik', $user->username)->get('member')->row();
?>
	<div class="content-header">
	    <!-- Main content -->
	    <div class="content">
	      <!-- <div class="container"> -->

	        <div class="row">
	          <div class="col-md-3">

	            <!-- Profile Image -->
	            <div class="card card-primary card-outline">
	              <div class="card-body box-profile">
	                <div class="parent_pp profile-user-img img-circle" style="padding: 0px;">
	                    <?php if(empty($member->pp) OR $member->pp == ''){ ?>
	                        <img class="pp" src="<?=base_url()?>assets/img/avatars/profile-img.jpg" alt="User profile picture">
	                    <?php }else{?>
	                        <img class="pp" src="<?=base_url()?>uploads/foto_profile/<?=$member->pp?>" alt="User profile picture">
	                    <?php }?>
	                </div>
		            <div class="text-center">
		                <button type="button" class="text-dark btn btn-transparent btn-sm" data-toggle="modal" data-target="#update_foto">
		                    <i class="fa fa-camera"></i> Update foto
		                </button>
		                <!--
		                <div class="dropdown-menu dropdown-menu-left">
		                    <a class="dropdown-item" href="javascript:void(0)" onclick="load_profile('update');">Update Foto</a>
		                </div>
		                -->
		            </div>

	                <h3 class="profile-username text-center"><?=$user->first_name.' '.$user->last_name?></h3>

	                <p class="text-muted text-center"><?=$user->company?></p>

	                <ul class="list-group list-group-unbordered mb-3">
	                  <li class="list-group-item">
	                    <b>Ikut Event</b> <a class="float-right"><?= (isset($jum_event['event_diikuti'])) ? $jum_event['event_diikuti']:'0'; ?></a>
	                  </li>
	                  <li class="list-group-item">
	                    <b>Data Sertifikat</b> <a class="float-right"><?= (isset($jum_event['jum_sertif'])) ? $jum_sertif['jum_sertif'] : ''; ?></a>
	                  </li>
	                </ul>

	                 <a href="<?=base_url()?>page/kta" class="btn btn-primary btn-block"><b>Download KTA</b></a> 
	              </div>
	              <!-- /.card-body -->
	            </div>
	            <!-- /.card -->

	            <!-- About Me Box -->
	            <div class="card card-primary">
	              <div class="card-header">
	                <h3 class="card-title">About Me</h3>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	                <strong><i class="fas fa-at mr-1"></i> Email</strong>
	                  <p class="text-muted">
	                    <?=(!empty($user->email)) ? $user->email : ''?>
	                  </p>
	                <hr>
	                <strong><i class="fas fa-phone mr-1"></i> No. Tlp</strong>
	                  <p class="text-muted">
	                    <?=(!empty($member->no_hp)) ? $member->no_hp : '-' ?>
	                  </p>
	                <hr>
	                <strong><i class="fas fa-map-marker-alt mr-1"></i> Instansi</strong>
	                  <p class="text-muted">
	                    <?= (!empty($user->company)) ? $user->company : ''?>
	                  </p>
	                <hr>
	                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat Lengkap</strong>
	                  <p class="text-muted">
	                    <?=(!empty($member->alamat_lengkap)) ? $member->alamat_lengkap: ''?>
	                  </p>
	                <!--
	                <hr>
	                <strong><i class="fas fa-pencil-alt mr-1"></i> Profesi</strong>
	                  <p class="text-muted">
	                    <span class="tag tag-danger">UI Design</span>
	                    <span class="tag tag-success">Coding</span>
	                    <span class="tag tag-info">Javascript</span>
	                    <span class="tag tag-warning">PHP</span>
	                    <span class="tag tag-primary">Node.js</span>
	                  </p>
	                <hr>

	                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

	                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
		              -->
	              </div>
	              <!-- /.card-body -->
	            </div>
	            <!-- /.card -->
	          </div>
	          <!-- /.col -->
	          <div class="col-md-9">
	            <div class="card">
	              <div class="card-header p-2">
	                <ul class="nav nav-pills">
	                  <li class="nav-item"><a class="nav-link <?=$active == 'recomended' ? 'active' : ''?>" href="#recomended" data-toggle="tab">Rekomendasi Event</a></li>
	                  <li class="nav-item"><a class="nav-link" href="#waiting_pay" data-toggle="tab">Menuggu Pembayaran</a></li>
	                  <li class="nav-item"><a class="nav-link" href="#yourclass" data-toggle="tab">Event Kamu</a></li>
	                  <li class="nav-item"><a class="nav-link" href="#sertif" data-toggle="tab">Sertifikat Kamu</a></li>
	                  <li class="nav-item"><a class="nav-link <?=$active == 'profile' ? 'active' : ''?>" href="#settings" data-toggle="tab">Update Profile</a></li>
	                  <li class="nav-item"><a class="nav-link <?=$active == 'afiliasi' ? 'active' : ''?>" href="#afiliasi" data-toggle="tab">Afiliasi</a></li>
	                  <li class="nav-item"><a class="nav-link <?=$active == 'dokumentasi' ? 'active' : ''?>" href="#dokumentasi" data-toggle="tab">Dokumentasi</a></li>
	                  <li class="nav-item"><a class="nav-link <?=$active == 'kodevoucher' ? 'active' : ''?>" href="#kodevoucher" data-toggle="tab">Kode Voucher</a></li>
	                </ul>
	              </div><!-- /.card-header -->
	              <div class="card-body">
	                <div class="tab-content">
						<div class="<?=$active == 'recomended' ? 'active' : ''?> tab-pane" id="recomended">
							<!-- Post -->
								<h5 class="font-italic">
									Rekomentasi Event <small><a class="badge badge-primary" href="<?=base_url()?>page/allevent">Semua Event</a></small>
								</h5>
								<p class=" border-bottom">Kemi merekomendasikan Event dibawah untukmu dari beberapa aktiritas kami di web ini</p>
										<div class="row">
											<?php 
												if($new_event){													
												foreach ($new_event['event'] as $list_new_event) {
											?>
												<div class="col-sm-4 card-wrapper-special">
													<div class="card card-special img__wrap">
													<img class="card-img-top card-img-top-special" src="<?=$list_new_event['brosur_img']?>" alt="Card image cap">
													<div class="img__description_layer">
														<p style="padding: 6px">
														<!-- <?=$list_new_event['judul']?><br> -->
														<button type="button" onclick="get_event('<?=$list_new_event['slug']?>');" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Selengkapnya</button>
													</div>
													</div>
												</div> 
										<?php 
												}
											}
										?>                       
										</div>
						</div>
						<div class="tab-pane" id="waiting_pay">
							<!-- Post -->
								<h5 class="font-italic">
									Event Menunggu Pembayaran <small><a class="badge badge-primary" href="<?=base_url()?>page/allevent">Semua Event</a></small>
								</h5>
								<p class=" border-bottom">Kemi merekomendasikan Event dibawah untukmu dari beberapa aktiritas kami di web ini</p>
										<div class="row">
											<?php 
												if(!empty($waiting_event)){

												foreach ($waiting_event['event'] as $list_waiting_event) {
											?>
										<div class="col-sm-4 card-wrapper-special">
											<div class="card card-special img__wrap">
											<img class="card-img-top card-img-top-special" src="<?=$list_waiting_event['brosur_img']?>" alt="Card image cap">
											<div class="img__description_layer">
												<p style="padding: 6px">
												<!-- <?=$list_waiting_event['judul']?><br> -->
												<button type="button" onclick="get_event('<?=$list_waiting_event['slug']?>');" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Selengkapnya</button>
											</div>
											</div>
										</div> 
										<?php 
												}
											}
										?>                       
										</div>
						</div>
						<div class="tab-pane" id="sertif">
							<!-- Post -->
								<h5 class="font-italic">
									List Sertifikat <small><a class="badge badge-primary" href="<?=base_url()?>page/allevent">Semua Event</a></small>
								</h5>
								<p class=" border-bottom">Sertifikat yang telah kamu peroleh di acara kami</p>
								<!-- <div class="card-body"> -->
									<table id="example1" class="table table-bordered table-striped table-sm">
									<thead>
										<tr>
											<th>No.</th>
											<th>Judul</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											if(!empty($list_sertif['list'])){

											$no = 1;
											foreach ($list_sertif['list'] as $list) {
										?>
										<tr>
											<td><?=$no++?></td>
											<td><?=$list['judul']?></td>
											<td>
					                    	<?php 
					                    		// var_dump($list_sertif);die;
					                    		if(!empty($list['testimoni']) && is_null($list['testimoni'])){ ?>
								                    	<form method="POST" action="<?=$this->config->item('url_api_sertifikat').'member/testimoni_peserta/'.$list['sertifikat_id']?>" id="formTestimoni">
								                    		<textarea class="form-control" rows="3" placeholder="Masukkan testimoni anda" name="testimoni" required></textarea>
										        			<button type="submit" class="btn btn-success btn-sm mt-1">Kirim</button> <br>
											        			<span class="text-warning" style="font-size: 13px;">* download sertifikat dapat dilakukan setelah mengirim testimoni
											        			</span>
								                    	</form>	
						                    	<?php } else if(!empty($list['testimoni']) && $list['testimoni'] && $list['testimoni_status'] == 0){ ?>
						                    	<a class="btn btn-success btn-sm disabled" disabled>Download</a>	
						                    	<?php }else{ ?>
						                    	<a class="btn btn-success btn-sm" target="blank_" href="<?=$list['download']?>">Download</a>
						                    <?php } ?>
					                    	
					                    </td>
										</tr>
												<?php 
											}
										}
											?>
										</tbody>
									</table>
									<!-- </div> -->
						</div>
						<div class="tab-pane" id="yourclass">
							<!-- Post -->
								<h5 class="pb-2 font-italic border-bottom">
									Event yang Kamu ikuti <small><a class="badge badge-primary" href="<?=base_url()?>page/allevent">Semua Event</a></small>
								</h5>
										<div class="row">
											<?php 
												if(!empty($my_event)){
												foreach ($my_event['event'] as $list_event) {
											?>
												<div class="col-sm-4 card-wrapper-special">
													<div class="card card-special img__wrap">
													<img class="card-img-top card-img-top-special" src="<?=$list_event['brosur_img']?>" alt="Card image cap">
													<div class="img__description_layer">
														<p style="padding: 6px">
														<!-- <?=$list_event['judul']?><br> -->
														<button type="button" onclick="get_event('<?=$list_event['slug']?>');" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Selengkapnya</button>
													</div>
													</div>
												</div> 
										<?php 
												}

											}
										?>   

											<table class="table table-bordered table-striped table-sm dataTable no-footer dtr-inline" id="listmateri">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama Event</th>
														<th>Materi & Video</th>
													</tr>
												</thead>
												<tbody class="table-listmateri">
													<?php 
												if(!empty($list_sertif)){
													$no = 1;
													foreach ($list_sertif['list'] as $k => $list) {  
																?>
																<tr>
																	<td><?= $no++;?></td>
																	<td><?= $list['judul']?></td>
																	<td><?= ($list['video']) ? $list['video'] : ' - ' ;?></td>
																</tr>

															<?php 
														 	} 
														}?>
												</tbody>
											</table>            
									</div>
										
						</div>
						<!-- /.tab-pane -->
						<div class="<?=$active == 'profile' ? 'active' : ''?> tab-pane" id="settings">
								<h2>Update Profile Member</h2>
								<hr/>
							<form class="form-horizontal" method="post" action="./update_profile" class="jsform">
							<div class="form-group row">
								<label for="nik" class="col-sm-2 col-form-label">No. Member</label>
								<label for="nik" class="col-sm-10 col-form-label">: <?=(!empty($member->nik)) ? $member->nik:''?></label>
								<!-- <input type="hidden" name="nik" value="<?=$member->nik?>"> -->
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-2 col-form-label">Nama Lengkap</label>
								<div class="col-sm-10">
								<input type="text" required name="nama_lengkap" class="form-control" id="inputName" placeholder="Name" value="<?=(!empty($member->nama_lengkap) ) ? $member->nama_lengkap : ''?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
								<div class="col-sm-10">
								<input type="email" class="form-control" id="inputEmail" readonly placeholder="Email" value="<?=(!empty($member->email)) ? $member->email:''?>">
								<span><i><small class="text-warning">(Perubahan Email membutuhkan bantuan panitia, karena akan berdampak kepada data event Anda)</small></i></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputNo_Hp" class="col-sm-2 col-form-label">No Hp </label>
								<div class="col-sm-10">
								<input type="number" class="form-control" id="inputNo_Hp" required name="no_hp" placeholder="Email" value="<?=(!empty($member->no_hp))? $member->no_hp:''?>">
								<span><i><small class="text-warning">(Gunakan nomor WhatsApp Aktif)</small></i></span>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputTmptLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
								<div class="col-sm-10">
								<input type="text" name="tempat_lahir" class="form-control" id="inputTmptLahir" placeholder="Tempat Lahir" value="<?=(!empty($member->tempat_lahir) ) ? $member->tempat_lahir:''?>">
								</div>
							</div>
							<div class="form-group row">
                            	<label for="inputPropinsi" class="col-sm-2 col-form-label">Domisili Propinsi</label>
                            	<div class="col-sm-10">
	                            	<select name="id_propinsi" class="form-control"  id="select_prop">
	                                    <?php 
	                                            foreach($propinsi as $prop){
	                                            	$selected ='';
		                                            if(!empty($member->id_propinsi) && $member->id_propinsi ==  $prop->id){
		                                            	$selected = 'selected';
		                                            }
	                                            ?>
	                                            <option value="<?= $prop->id ?>" <?=$selected?>><?= $prop->nama ?></option>
	                                    <?php } ?>
	                                </select>
	                             </div>
                            </div>
							<div class="form-group row inputDataKota" style="display: none;">
								<label for="inputKota" class="col-sm-2 col-form-label">Domisili Kota</label>
								<div class="col-sm-10">
									<select name="id_kota" class="form-control" id="select_kota" >
	                                   
	                                </select>
	                            </div>
                             </div>

							<div class="form-group row">
								<label for="inputAlamat" class="col-sm-2 col-form-label">Alamat Domisili lengkap</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="inputAlamat" required name="alamat_lengkap"><?=(!empty($member->alamat_lengkap)) ? $member->alamat_lengkap : ''?></textarea>
								</div>
							</div>

							<div class="form-group row">
								<label for="profesi" class="col-sm-2 col-form-label">Profesi</label>
								<div class="col-sm-10">
									<select name="profesi" type="text" class="form-control " required="" >
										<option value=""> Pilih Profesi </option>
										<option value="asn" <?php if(!empty($member->profesi) && $member->profesi == 'asn') { ?> selected="selected"<?php } ?>> ASN </option>
										<option value="nonasn" <?php if(!empty($member->profesi) && $member->profesi == 'nonasn') { ?> selected="selected"<?php } ?>> Non ASN </option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="Instansi" class="col-sm-2 col-form-label">Instansi</label>
								<div class="col-sm-10">
								<input type="text" required name="instansi" class="form-control" id="Instansi" placeholder="Instansi" value="<?=(!empty($member->instansi)) ? $member->instansi : ''?>">
								</div>
							</div>

							<div class="form-group row">
								<label for="inputAlamatKantor" class="col-sm-2 col-form-label">Alamat Kantor </label>
								<div class="col-sm-10">
									<textarea class="form-control" id="inputAlamatKantor" required name="alamat_lengkap_kantor"><?=(!empty($member->alamat_lengkap))? $member->alamat_lengkap:''?></textarea>
								</div>
							</div>
							
							<div class="form-group row">
								<label for="fb" class="col-sm-2 col-form-label">Akun Facebook</label>
								<div class="col-sm-10">
								<input type="text" required name="fb" class="form-control" id="fb" placeholder="Akun Facebook" value="<?=(!empty($member->fb))? $member->fb: ''?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="instagram" class="col-sm-2 col-form-label">Akun Instagram</label>
								<div class="col-sm-10">
								<input type="text" required name="instagram" class="form-control" id="instagram" placeholder="Akun Instagram" value="<?=(!empty($member->instagram) )? $member->instagram : ''?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="offset-sm-2 col-sm-10">
								<div class="checkbox">
									<label>
									<input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
									</label>
								</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="offset-sm-2 col-sm-10">
								<button type="submit" class="btn btn-danger">Update Profile</button>
								</div>
							</div>
							</form>
						</div>
						<!-- /.tab-pane -->
						<div class="<?=$active == 'afiliasi' ? 'active' : ''?> tab-pane" id="afiliasi">
	<!-- 			        <h2>Afiliasi</h2>
							<hr/> -->
							<!-- <br/> -->
								<div class="card">
									<div class="card-body">
										<h5 class="font-italic text-warning">Ingin Mendapatkan Penghasilan tambahan ?<br/>Hanya dengan membagikan Informasi Event-event yang ada ke Rekan-rekan Anda..</h5>
										<p class="text-justify">Affiliate adalah sebuah strategi marketing yang memungkinkan kita mendapatkan komisi atas kegiatan pemasaran yang kita lakukan. Kemudahan yang ditawarkan melalui Program Affiliate Marketing ini adalah kamu sebagai affiliate partner tidak memerlukan modal apa pun untuk menjalankan bisnis internet ini.<br/>Bisnis ini juga bisa dilakukan pada waktu senggang di sela-sela kesibukan kamu. Mendapatkan penghasilan yang mudah saat ini adalah dengan bergabung di Affiliate Program, dan lakukan bisnis tanpa modal dengan komisi yang besar</p>
										<h5 class="font-italic text-warning">Cara Kerja Affiliate :</h5>
										<ul>
											<li>Mengaktifkan tombol dibawah</li>
											<li>Membagikan Event-event yang ada ke WhatsApp atau Sosial media lainnya</li>
											<li>Setiap orang yang mendaftarkan diri melalui Link Promosi Anda, akan otomatis tercatat dan anda dapat pantau</li>
											<li>Penghitungan Bonus : Peserta Anda yang telah melakukan Pembayaran x Bonus</li>
											<li>Ilustrasi : Peserta yang mendaftar melalui Link Affilitae anda sebanyak 250 orang, dan 200 orang telah menyelesaikan Pembayaran, maka Bonus Anda adalah 200 x Rp. 150.000 = Rp. 30.000.000,-</li>
										</ul>
										<?php if(!empty($member) && is_null($member->ref)){ ?>
										<div class="text-center">
											<div class="h5 text-warning">Aktifkan Afiliasi Kamu</div>
											<a onclick="return confirm('Are you sure?');" href="<?=base_url()?>page/act_ref" class="btn btn-success">Aktifkan Sekarang</a>
										</div>
											<?php }else{ ?>
										<div class="text-center">
											<div class="h5 text-warning">Afiliasi Kamu Telah Aktif</div>
											<!-- <a onclick="return confirm('Are you sure?');" href="<?=base_url()?>page/act_ref" class="btn btn-success">Aktifkan Sekarang</a> -->
										</div>
										<div>
										<form class="form-horizontal" method="post" action="./update_ref" class="jsform">
											<div class="form-group row">
											<label for="nik" class="col-sm-2 col-form-label">Kode Referensi</label>
											<label for="nik" class="col-sm-10 col-form-label">: <?=!empty($member->ref) ? $member->ref:''?></label>
											<!-- <input type="hidden" name="nik" value="<?=$member->nik?>"> -->
											</div>
											<div class="form-group row">
											<label for="" class="col-sm-2 col-form-label">Nama Bank</label>
											<div class="col-sm-3">
												<input type="text" required name="bank_rek_ref" class="form-control" id="inputName" placeholder="Contoh: BRI" value="<?=(!empty($member->bank_rek_ref)) ? $member->bank_rek_ref: ''?>">
											</div>
											<label for="" class="col-sm-2 col-form-label">No. Rekening</label>
											<div class="col-sm-5">
												<input type="number" required name="no_rek_ref" class="form-control" id="inputName" placeholder="No. Rekening" value="<?=(!empty($member->no_rek_ref))? $member->no_rek_ref:''?>">
											</div>
											</div>
											<div class="form-group row">
											<label for="inputEmail" class="col-sm-2 col-form-label">A/N Rekening</label>
											<div class="col-sm-10">
												<input type="text" required name="an_rek_ref" class="form-control" id="inputEmail" placeholder="A/N Pemilik Rekening" value="<?=(!empty($member->an_rek_ref))? $member->an_rek_ref:''?>">
												<span><i><small class="text-warning">(Perubahan Email membutuhkan bantuan panitia, karena akan berdampak kepada data event Anda)</small></i></span>
											</div>
											</div>
											<div class="text-center">
												<button type="submit" class="btn btn-danger">Simpan</button>
												<a href="<?=base_url()?>page/afiliasi" class="btn btn-success">Lihat Bonus</a>
											</div>
										</form>
									</div>
										<?php } ?>
									</div>
								</div>
						</div>
						
							<!-- dokumentasi -->
						<div class="tab-pane dokumentasi" id="dokumentasi">
							<h5 class="pb-2 font-italic border-bottom">
								Dokumentasi 
								<small><a class="badge badge-primary ml-2 gotoback" onclick="goToBack()" style="display:none;"><i class="fa fa-arrow-left"></i> Go To Back</a></small>
							</h5>
							<div class="row dokumentasi-kegiatan" id="dokumentasi-kegiatan" >
																
							</div>
						</div>
						<div class="tab-pane kodevoucher" id="kodevoucher">
							<h5 class="pb-2 font-italic border-bottom">Kode Voucher Kamu</h5>
							<div class="row kodevoucher" id="kodevoucher" >
								<table class="table table-bordered table-striped table-sm" id="listkodevaoucher">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Event</th>
											<th>Kode Voucher</th>
										</tr>
									</thead>
									<tbody class="table-kodevoucher">
										<?php
											if(!empty($detailevent)){
												$no = 1;
												foreach($detailevent as $key => $de){
												 ?>
													<tr>
														<td><?= $no++;?></td>
														<td><?= $de['judul']?></td>
														<td><?= $de['kdvcr']?></td>
													</tr>
										<?php	}
											}
										?>
									</tbody>

								</table>						
							</div>
						</div>

	                </div>
	                <!-- /.tab-content -->
	              </div><!-- /.card-body -->
	            </div>
	            <!-- /.card -->
	          </div>
	          <!-- /.col -->
	        </div>
	        <!-- /.row -->

	      <!-- </div>/.container-fluid -->
	    </div>
	    <!-- /.content -->
	</div>
	<!-- /.content-header -->
<!-- Modal -->

<div class="modal fade" id="update_foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    
    <div class="modal-content">
    <form action="" method="post" id="foto_form">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upate Foto Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="file" class="form-control" name="foto_profile" required="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

  <script>
	var id_artikel = 'all';
	load_dokumentasi_kegiatan(id_artikel);

	function getArtikelByid(identifier){
		var id_artikel = $(identifier).data('id');
		load_dokumentasi_kegiatan(id_artikel);
	}

	function load_dokumentasi_kegiatan(id_artikel){
		if(id_artikel != 'all'){
			$(".gotoback").show()
		}else{
			$(".gotoback").hide()
		}

		$.ajax({
            url:"<?=base_url()?>page/getArtikel",    //the page containing php script
            type: "post",    //request type,
            dataType: 'json',
            data: {id_artikel:id_artikel},
            success:function(result){
                console.log(result);
				$('.dokumentasi-kegiatan').html(result);
            }
        });
	}

	function goToBack(){
		var id_artikel = 'all';
		load_dokumentasi_kegiatan(id_artikel);
	}

	$('#formTestimoni').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'post',
                url: $(this).attr("action"),
                data: $(this).serialize(),
                beforeSend: function() {
                    // sendAjax('#btnSimpan', false)
                },
                success: function(data) {
                	if (data == 'kosong') {
                		alert('Testimoni masih kosong.')
                	}else{
                		location.reload()
                	}                    
                },
                error: function(data) {
                	console.log(data)                    
                },
                complete: function() {
                    console.log('selese')
                }
            });
        });

  	// alert($(location).attr('href'));
    $('#foto_form').on('submit', function(e){
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            url: "<?=base_url()?>page/updatepp",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
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
                    
                   window.setTimeout( function(){
                       window.location = $(location).attr('href');
                   }, 2000 );
                   
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
                // alert('gagal');
            }
        })
    });

    $("select#select_prop").change(function() {
    	var i_prop = $(this).val();
        getDataKota(i_prop);
        $(".inputDataKota").show()
        $("#select_kota").val('')
    });

    function getDataKota(i_prop){
        $.ajax({
            url:"<?=base_url()?>page/getDataKota",
            type: "post",
            data : {i_prop:i_prop},
            dataType : 'json',
            success: function(json){
            	console.log(json)
                var $el = $("#select_kota");
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.id).text(value.nama));
                })
            }
        });
    }
	
  </script>

<script src="<?=base_url()?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>

  $(function () {
    // $("#listkodevaoucher").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#listmateri').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

     $('#listkodevaoucher').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

  });
  
</script>