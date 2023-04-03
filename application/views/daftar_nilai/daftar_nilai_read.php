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
                                        <h4 style="margin-top:0px">Daftar Nilai Detail</h4><br>
                                        <table class="table">
	                                        <tr><td>Minimal / Sama Dengan</td><td><?php echo $nilai_min; ?></td></tr>
	                                        <tr><td>Sampai</td><td><?php echo $nilai_max; ?></td></tr>
                                            <tr><td>Nilai Huruf</td><td><?php echo $nilai_huruf; ?></td></tr>
	                                        <tr><td>Nilai Mutu</td><td><?php echo $mutu; ?></td></tr>
	                                        <tr><td>Ket Nilai</td><td><?php echo $ket_nilai; ?></td></tr>
	                                        <tr><td></td><td><button type="button" class="btn btn-default" onclick="load_controler('daftar_nilai');">Cancel</button></td></tr>
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