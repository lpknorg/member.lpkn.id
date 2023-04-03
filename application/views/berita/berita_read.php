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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="margin-top:0px">Berita Detail</h4><br>
                                        <table class="table">
	                                        <tr><td>Kategori Berita</td><td><?php echo $kategori_berita; ?></td></tr>
	                                        <tr><td>Judul</td><td><?php echo $judul; ?></td></tr>
	                                        <tr><td>Slug</td><td><?php echo $slug; ?></td></tr>
	                                        <tr><td>Gambar</td><td><?php echo $gambar; ?></td></tr>
	                                        <tr><td>Isi</td><td><?php echo $isi; ?></td></tr>
	                                        <tr><td>Create By</td><td><?php echo $create_by; ?></td></tr>
	                                        <tr><td>Create At</td><td><?php echo $create_at; ?></td></tr>
	                                        <tr><td>Update By</td><td><?php echo $update_by; ?></td></tr>
	                                        <tr><td>Update At</td><td><?php echo $update_at; ?></td></tr>
	                                        <tr><td></td><td><button type="button" class="btn btn-default" onclick="load_controler('berita');">Cancel</button></td></tr>
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