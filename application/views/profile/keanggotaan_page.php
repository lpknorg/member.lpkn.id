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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header h3">
                                        Keanggotaan
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img src="https://a-cloud.b-cdn.net/media/original/4c9dac14ba20b1fc40b88617d0380196.svg">
                                            </div>
                                            <div class="col-sm-6 mt-2">
                                                <p class="h5 mr-4" style="line-height: 1.5; text-align: justify;">
                                                    <!-- &nbsp;&nbsp;&nbsp;&nbsp; -->
                                                    Perkumpulan Penyedia Pengadaan Pemerintah terbuka untuk semua pelaku usaha yang berkomitmen untuk <b>berkontribusi dalam Pembangunan melalui sektor Pengadaan Barang dan Jasa Pemerintah</b></p>
                                                <ul class="h5 mt-3">
                                                    <li class="mb-2">Penyedia Pengadaan Barang/Jasa Pemerintah</li>
                                                    <li class="mb-2">Penyedia di Badan Layanan Umum (BLU/BLUD)</li>
                                                    <li class="mb-2">Para Penyedia Katalog Pemerintah</li>
                                                    <li class="mb-2">Para Penyedia dalam Program Bela Pengadaan</li>
                                                    <li class="mb-2">Pelaku usaha UMKM dan Koperasi</li>
                                                    <li class="mb-2">Suppliyer, Distributor Obat dan Alat Kesehatan</li>
                                                    <li class="mb-2">Pelaku Pengadaan/Konsultan Perseorangan</li>
                                                    <li class="mb-2">Calon Penyedia Barang/Jasa</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>