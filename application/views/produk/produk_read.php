<!doctype html>
            <!-- <main class="main"> -->
                <!-- Breadcrumb-->
                <div class="mb-3"></div>
                <div class="container-fluid">
                <?php 
                    if ($this->ion_auth->in_group('register')){ 
                        $this->load->view('notif'); }
                    elseif ($this->ion_auth->in_group('expired')) {
                        $this->load->view('notif_expired'); }
                ?>
                    <div class="animated fadeIn">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="margin-top:0px">Produk Detail</h4><br>
                                        <table class="table">
	                                        <tr><td>Id Member</td><td><?php echo $id_member; ?></td></tr>
	                                        <tr><td>Id Jenis</td><td><?php echo $id_jenis; ?></td></tr>
	                                        <tr><td>Nama Produk</td><td><?php echo $nama_produk; ?></td></tr>
	                                        <tr><td>Foto</td><td><?php echo $foto; ?></td></tr>
	                                        <tr><td>Ket</td><td><?php echo $ket; ?></td></tr>
	                                        <tr><td>Link</td><td><?php echo $link; ?></td></tr>
	                                        <tr><td>Create Date</td><td><?php echo $create_date; ?></td></tr>
	                                        <tr><td></td><td><button type="button" class="btn btn-default" onclick="load_controler('produk');">Cancel</button></td></tr>
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