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
                                        <h4 style="margin-top:0px">Khs Detail</h4><br>
                                        <table class="table">
	                                        <tr><td>NIM</td><td><?php echo $NIM; ?></td></tr>
	                                        <tr><td>Kode Tahun Akademik</td><td><?php echo $kode_tahun_akademik; ?></td></tr>
	                                        <tr><td>Kode Mata Kuliah</td><td><?php echo $kode_mata_kuliah; ?></td></tr>
	                                        <tr><td>Nilai Angka</td><td><?php echo $nilai_angka; ?></td></tr>
	                                        <tr><td>Nilai Huruf</td><td><?php echo $nilai_huruf; ?></td></tr>
	                                        <tr><td>Date Time</td><td><?php echo $date_time; ?></td></tr>
	                                        <tr><td></td><td><button type="button" class="btn btn-default" onclick="load_controler('khs');">Cancel</button></td></tr>
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