<style>
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
<script>
  function addSaldo(id){
    // clearFormSB();
    $.ajax({
        type: "POST",
        url: "<?=site_url('page/add_saldo/')?>"+id,
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
                       window.location = '<?=base_url()?>page/afiliasi'+'?page=bonus';
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
  }
</script>
	<div class="content-header">
	    <!-- Main content -->
	    <div class="content">
	      <div class="container">

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

	                <h3 class="profile-username text-center"><?=$user->first_name.' '.$user->last_name?></h3>

	                <p class="text-muted text-center"><?=$member->ref?></p>

	                <ul class="list-group list-group-unbordered mb-3">
	                  <li class="list-group-item">
	                    <b>Saldo Bonus</b> <a class="float-right">Rp. <?=number_format($saldo)?>,-</a>
	                  </li>
	                </ul>

	                <!-- <a href="#" class="btn btn-primary btn-block"><b>Change Password</b></a> -->
	              </div>
	              <!-- /.card-body -->
	            </div>
	            <!-- /.card -->

	            <!-- About Me Box -->
	            <div class="card card-primary">
	              <div class="card-header">
	                <h3 class="card-title">Rek. Pencairan</h3>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	                <strong><i class="fas fa-university mr-1"></i> Nama Bank</strong>
	                  <p class="text-muted">
	                    <?=$member->bank_rek_ref?>
	                  </p>
	                <hr>
	                <strong><i class="fas fa-phone mr-1"></i> No. Rek</strong>
	                  <p class="text-muted">
	                    <?=$member->no_rek_ref ? $member->no_rek_ref : '-' ?>
	                  </p>
	                <hr>
	                <strong><i class="fas fa-user mr-1"></i> A/N</strong>
	                  <p class="text-muted">
	                    <?=$member->an_rek_ref ? $member->an_rek_ref : '-' ?>
	                  </p>
	                <hr>
	                <!--
	                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat Lengkap</strong>
	                  <p class="text-muted">
	                    <?=$member->alamat_lengkap?>
	                  </p>
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
	                  <li class="nav-item"><a class="nav-link <?=$page == 'recomended' ? 'active' : ''?>" href="#afiliasi" data-toggle="tab">Sekilas Afiliasi</a></li>
	                  <li class="nav-item"><a class="nav-link" href="#perolehan" data-toggle="tab">Perolehan Afiliasi</a></li>
	                  <li class="nav-item"><a class="nav-link <?=$page == 'bonus' ? 'active' : ''?>" href="#saldo" data-toggle="tab">Bonus Afiliasi</a></li>
	                  <li class="nav-item"><a class="nav-link" href="#sertif" data-toggle="tab">Mutasi Saldo Afiliasi</a></li>
	                </ul>
	              </div><!-- /.card-header -->
	              <div class="card-body">
	                <div class="tab-content">
	                  <div class="<?=$page == 'recomended' ? 'active' : ''?> tab-pane" id="afiliasi">
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
			              			<?php if(is_null($member->ref)){ ?>
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
				                        <label for="nik" class="col-sm-10 col-form-label">: <?=$member->ref?></label>
				                        <!-- <input type="hidden" name="nik" value="<?=$member->nik?>"> -->
				                      </div>
				                      <div class="form-group row">
				                        <label for="" class="col-sm-2 col-form-label">Nama Bank</label>
				                        <div class="col-sm-3">
				                          <input type="text" required name="bank_rek_ref" class="form-control" id="inputName" placeholder="Contoh: BRI" value="<?=$member->bank_rek_ref?>">
				                        </div>
				                        <label for="" class="col-sm-2 col-form-label">No. Rekening</label>
				                        <div class="col-sm-5">
				                          <input type="number" required name="no_rek_ref" class="form-control" id="inputName" placeholder="No. Rekening" value="<?=$member->no_rek_ref?>">
				                        </div>
				                      </div>
				                      <div class="form-group row">
				                        <label for="inputEmail" class="col-sm-2 col-form-label">A/N Rekening</label>
				                        <div class="col-sm-10">
				                          <input type="text" required name="an_rek_ref" class="form-control" id="inputEmail" placeholder="A/N Pemilik Rekening" value="<?=$member->an_rek_ref?>">
				                          <span><i><small class="text-warning">(Perubahan Email membutuhkan bantuan panitia, karena akan berdampak kepada data event Anda)</small></i></span>
				                        </div>
				                      </div>
				                      <div class="text-center">
					                      <button type="submit" class="btn btn-danger">Simpan</button>
				                      </div>
				                    </form>
			                    </div>
				                  <?php } ?>
			              		</div>
			              	</div>
	                  </div>
	                  <div class=" tab-pane" id="perolehan">
				              <h5 class="font-italic">
				                Semua Regestrasi
				              </h5>
				              <p class=" border-bottom text-warning"><i>*List data regestrasi Peserta yang mendaftar melalui link yang Anda bagikan</i></p>
			              	<div class="card">
			              		<div class="card-body">
					                <table id="registrasi" class="table table-bordered table-striped table-sm">
					                  <thead>
						                  <tr>
						                    <th>No.</th>
						                    <th>Event</th>
						                    <th>Nama</th>
						                    <th>Email</th>
						                    <th>Hp</th>
						                    <th>Status</th>
						                  </tr>
					                  </thead>
					                  <tbody>
					                  <?php $no = 1; foreach ($reg_list['all_regis'] as $row) { 
					                  	$judul = str_replace('|', ' ', $row['judul']);
					                  	if($row['status_pembayaran'] == 1){
						                  	$status = '<small class="badge badge-success">Success</small>';
					                  	}elseif($row['status_pembayaran'] == 0 && $row['status_event'] == 1){
						                  	$status = '<small class="badge badge-warning">Waiting</small>';
					                  	}elseif($row['status_pembayaran'] == 0 && $row['status_event'] > 1){
						                  	$status = '<small class="badge badge-danger">Expiered</small>';
					                  	}
					                  ?>
					                  	<tr>
					                  		<td><?=$no++?></td>
					                  		<td><?=$judul?></td>
					                  		<td><?=$row['nama_lengkap']?></td>
					                  		<td><?=$row['email']?></td>
					                  		<td><?=$row['no_hp']?></td>
					                  		<td>
					                  			<?=$status?>
					                  		</td>
					                  	</tr>
					                  <?php }?>
					                  </tbody>
					                </table>
					              </div>
					            </div>

				              <h5 class="font-italic">
				                Peserta Membayar
				              </h5>
				              <p class=" border-bottom text-warning"><i>*Data akan hilang & dipindahkan ke data BONUS setelah event berkakhir agar bisa di cairkan</i></p>
			              	<div class="card">
			              		<div class="card-body">
					                <table id="membayar" class="table table-bordered table-striped table-sm">
					                  <thead>
						                  <tr>
						                    <th>No.</th>
						                    <th>Event</th>
						                    <th>Nama</th>
						                    <th>Email</th>
						                    <th>Hp</th>
						                    <th>Status</th>
						                  </tr>
					                  </thead>
					                  <tbody>
					                  <?php $no = 1; foreach ($reg_pay_list['all_regis'] as $row) { 
					                  	$judul = str_replace('|', ' ', $row['judul']);
					                  	if($row['status_pembayaran'] == 1){
						                  	$status = '<small class="badge badge-success">Success</small>';
					                  	}elseif($row['status_pembayaran'] == 0 && $row['status_event'] == 1){
						                  	$status = '<small class="badge badge-warning">Waiting</small>';
					                  	}elseif($row['status_pembayaran'] == 0 && $row['status_event'] > 1){
						                  	$status = '<small class="badge badge-danger">Expiered</small>';
					                  	}
					                  ?>
					                  	<tr>
					                  		<td><?=$no++?></td>
					                  		<td><?=$judul?></td>
					                  		<td><?=$row['nama_lengkap']?></td>
					                  		<td><?=$row['email']?></td>
					                  		<td><?=$row['no_hp']?></td>
					                  		<td>
					                  			<?=$status?>
					                  		</td>
					                  	</tr>
					                  <?php }?>
					                  </tbody>
					                </table>
					              </div>
					            </div>

				              <h5 class="font-italic">
				                Peserta Belum Membayar
				              </h5>
				              <p class=" border-bottom text-warning"><i>*Data akan hilang setelah event berkahir</i></p>
			              	<div class="card">
			              		<div class="card-body">
					                <table id="belum-membayar" class="table table-bordered table-striped table-sm">
					                  <thead>
						                  <tr>
						                    <th>No.</th>
						                    <th>Event</th>
						                    <th>Nama</th>
						                    <th>Email</th>
						                    <th>Hp</th>
						                    <th>Status</th>
						                  </tr>
					                  </thead>
					                  <tbody>
					                  </tbody>
					                </table>
					              </div>
					            </div>
	                  </div>
	                  <div class="<?=$page == 'bonus' ? 'active' : ''?> tab-pane" id="saldo">
				              <h5 class="font-italic">
				                Saldo Bonus Afiliasi
				              </h5>
				              <p class=" border-bottom">List bonus dari masing2 Event</p>
			              	<div class="card">
			              		<div class="card-body">
					                <table id="saldo-table" class="table table-bordered table-striped table-sm">
					                  <thead>
						                  <tr>
						                    <th>No.</th>
						                    <th>Event</th>
						                    <th>Jumalah Membayar</th>
						                    <th>Total Bonus</th>
						                    <th>Aksi</th>
						                  </tr>
					                  </thead>
					                  <tbody>
					                  <?php 
					                  $no = 1; 
					                  $total = 0; 
					                  foreach ($bonus_list['bonus'] as $row) { 
					                  	$judul = str_replace('|', ' ', $row['judul']);
					                  ?>
					                  	<tr>
					                  		<td><?=$no++?></td>
					                  		<td><?=$judul?></td>
					                  		<td><?=$row['jumlah']?> x Rp. <?=number_format($row['bonus'])?>,-</td>
					                  		<td>Rp. <?=number_format($row['total'])?>,-</td>
					                  		<td>
					                  			<button class="btn btn-primary btn-sm" onclick="if(confirm('Are you sure?')) addSaldo(<?=$row['id_kelas_event']?>)">Tambah ke Saldo</button>
					                  		</td>
					                  	</tr>
					                  <?php $total += $row['total']; } ?>
					                  </tbody>
					                </table>
					                <div class="text-right mt-2">
							              <h5 class="font-italic">
							                Total Bonus : Rp. <?=number_format($total)?>,-
							              </h5>
							              <!-- <p class=" border-bottom"></p> -->
					                </div>
					                <div class="text-right mt-2">
							              <h5 class="font-italic">
							                TOTAL SALDO : Rp. <?=number_format($saldo)?>,- <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#pencairan">Ajukan Pencairan</button>
							              </h5>
							              <p class=" border-bottom text-warning font-italic">*Pencairan akan ditransfer ke rekening yang tertera pada akun<br/>Minimal Pencairan Rp. 500.000,-<br/>Proses pencairan paling lambat 2x24 jam</p>
					                </div>
					              </div>
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

	      </div><!-- /.container-fluid -->
	    </div>
	    <!-- /.content -->
	</div>
	<!-- /.content-header -->
<!-- Modal -->
<div class="modal fade" id="pencairan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    
    <div class="modal-content">
    <form action="" method="post" id="foto_form">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pengajuan Pencairan <small class="text-warning"><i>(Minimal pengajuan Rp. 500.000,-)</i></small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="500000" class="form-control" name="nominal" required="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ajukan</button>
      </div>
    </form>
    </div>
  </div>
</div>

  <script>
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
    $("#registrasi").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#registrasi_wrapper .col-md-6:eq(0)');
    $("#membayar").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#membayar_wrapper .col-md-6:eq(0)');
    $("#belum-membayar").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#belum-membayar_wrapper .col-md-6:eq(0)');
    $("#saldo-table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#saldo-table_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
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
