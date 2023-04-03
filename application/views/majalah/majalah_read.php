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
                                        <h4 style="margin-top:0px">Majalah Detail</h4><br>
                                        <table class="table">
	                                        <tr><td>Judul</td><td><?php echo $judul; ?></td></tr>
	                                        <tr><td>Foto</td><td><?php echo $foto; ?></td></tr>
	                                        <tr><td>File</td><td><?php echo $file; ?></td></tr>
	                                        <tr><td>Ket</td><td><?php echo $ket; ?></td></tr>
	                                        <tr><td>Create Date</td><td><?php echo $create_date; ?></td></tr>
	                                        <tr><td></td><td><button type="button" class="btn btn-default" onclick="load_controler('majalah');">Cancel</button></td></tr>
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