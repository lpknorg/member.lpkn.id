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
                                        <div class="row">
                                            <div class="col-lg-6"><h4 style="margin-top:0px">Pembayaran Detail</h4><br></div>
                                            <div class="col-lg-6 text-right">
                                                    <button type="button" class="btn btn-secondary btn-sm" onclick="load_controler('pembayaran');"><i class="fa fa-arrow-left"></i> History Payment List</button>
                                            </div>
                                        </div>
                                        
                                        <table class="table">
                                            <tr><td>No.Invoice</td><td><?php echo $invoice; ?></td></tr>
	                                        <tr><td>Jenis Pembayaran</td><td><?php echo $jenis_pembayaran; ?></td></tr>
	                                        <tr><td>Nominal</td><td>Rp. <?php echo number_format($nominal); ?></td></tr>
	                                        <tr>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                  <?php if($status == 0){ if($metode == 'manual'){
                                                    ?>
                                                        <a class="btn btn-primary" target="_blank" href="<?=base_url()?>payment/transfer/<?=$id?>"><i class="fa fa-shopping-cart"></i> Bayar Sekarang</a>
                                                        <button type="button" class="btn btn-warning" onclick="if(confirm('Are you sure?')) load_controler('pembayaran/cencel_transaction_manual/<?=$id?>');">Batal</button>
                                                    <?php }else{ ?>
                                                        <a class="btn btn-primary" target="_blank" href="https://app.midtrans.com/snap/v2/vtweb/<?=$snaptoken?>"><i class="fa fa-shopping-cart"></i> Bayar Sekarang</a>
                                                        <button type="button" class="btn btn-warning" onclick="if(confirm('Are you sure?')) load_controler('pembayaran/cencel_transaction/<?=$id?>');">Batal</button>
                                                  <?php } }elseif($status == 1){?>
                                                    <a class="btn btn-success" target="_blank" href="<?=base_url()?>pembayaran/invoice/<?=$id?>"><i class="fa fa-download"></i> Download Invoice</a>
                                                  <?php }else{ ?>
                                                  <?php } ?>
                                                    <!-- <button type="button" class="btn btn-warning" onclick="load_controler('pembayaran');">Batal</button> -->
                                                </td>
                                            </tr>
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