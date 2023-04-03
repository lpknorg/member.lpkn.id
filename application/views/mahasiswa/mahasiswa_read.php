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
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="margin-top:0px">Mahasiswa Detail</h4><br>
                                        <table class="table">
	                                        <tr><td>NIM</td><td><?php echo $NIM; ?></td></tr>
	                                        <tr><td>Nama Depan</td><td><?php echo $nama_depan; ?></td></tr>
	                                        <tr><td>Nama Belakang</td><td><?php echo $nama_belakang; ?></td></tr>
	                                        <tr><td>Email</td><td><?php echo $email; ?></td></tr>
                                            <tr><td>Kode Prodi</td><td><?php echo $kode_prodi; ?></td></tr>
	                                        <tr><td>Kode Semester</td><td><?php echo $kode_semester; ?></td></tr>
	                                        <tr><td>Tmpt Lahir</td><td><?php echo $tmpt_lahir; ?></td></tr>
	                                        <tr><td>Tgl Lahir</td><td><?php echo $tgl_lahir; ?></td></tr>
	                                        <tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
	                                        <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	                                        <tr><td></td><td><button type="button" class="btn btn-default" onclick="load_controler('mahasiswa');">Cancel</button></td></tr>
	                                    </table>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>