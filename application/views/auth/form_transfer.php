<!doctype html>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="">
  <!-- <meta name="author" content="Łukasz Holeczek"> -->
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>Vendor Indonesia | Form Pembayaran Manual</title>
  <!-- Icons-->
  <link href="<?php echo base_url();?>assets/vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
  <!-- Main styles for this application-->
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">

    <script src="<?php echo base_url();?>assets/vendors/jquery/js/jquery.min.js"></script>
  </head>

  <body class="bg-light">
    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
    <div class="container">
      

      <!-- <p></p> -->
      <hr class="mt-0">
      <div class="row">

        <div class="col-md-8 mx-auto order-md-1 pb-2">
          <h4 class="text-center">FORM PEMBAYARAN TRANSFER MANUAL #<?=$pembayaran->invoice?></h4>
          <p class="mb-3 text-center">(Konfirmasi Manual 1x24 Jam)</p>

            <div class="accordion" id="accordionExample">
              <div class="card">

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="text-center">
                      <!-- <h3>Selamat Datang</h3> -->
                      <h2>Yth, <?=$member->nama_lengkap?></h2>
                      <?php if($pembayaran->status == 0){ ?>

                        <?php if($pembayaran->bukti == null){ ?>
                          <div class="text-center">
                            <!-- <h3>Selamat Datang</h3> -->
                            <!-- <h2><?=$user_regis->nama_lengkap?></h2> -->
                            <h5>Untuk melakukan pembayaran, Silahkan transfer sejumlah Rp. <?=number_format($pembayaran->nominal)?>,- </h5>
                            <h4>ke rekening berikut :</h4>
                          </div>
                          <div class="row">
                            <div class="col-md-4 text-center">
                              <img src="https://event.lpkn.id/assets/img/logo-bri.png">
                            </div>
                            <div class="col-md-8 text-left">
                              <table class="table table-bordered">
                                <tr>
                                  <td width="30%">No.Rek</td>
                                  <td>201801000204308</td>
                                  <!--<td>0060010942294</td>-->
                                </tr>
                                <tr>
                                  <td>Atas Nama</td>
                                  <td>Perkumpulan Penyedia Pengadaan Pemerintah</td>
                                </tr>
                                <tr>
                                  <td>Upload Bukti</td>
                                  <td>
                                    <form method="post" action="" class="test" id="bukti_form">
                                      <input type="file" required accept="image/png, image/gif, image/jpeg" class="form-control mb-1" name="bukti" id="bukti">
                                      <p class="text-center"><button class="btn btn-primary">Upload Bukti</button></p>
                                    </form>
                                  </td>
                                </tr>
                              </table>
                            </div>

                          </div>
                        <?php }else{ ?>

                          <h5>Pembayaran Anda sedang menunggu konfirmasi</h5>
                          <h5>Selanjutnya Team kami akan melakukan verifikasi pembayaran <br/>Paling lambat 1x24 jam</h5>
                          <br/>
                            <small>Jika anda kurang yakin dengan foto bukti yg Anda upload silahkan ulangi</small>
                          <div class="d-flex justify-content-center">
                            <table>
                              <tr>
                                <td>
                                <form method="post" action="" class="test" id="bukti_form">
                                  <input type="file" accept="image/png, image/gif, image/jpeg" class="form-control mb-1" name="bukti" id="bukti">
                                  <p class="text-center"><button class="btn btn-primary">Upload Ulang Bukti</button></p>
                                </form>
                                </td>
                              </tr>
                            </table>
                          </div>
                          <?php } ?>
                      <?php }else{ ?>
                          <h5>Pembayaran Anda telah dikonfirmasi <br/>Untuk mempermudah kordinasi, silahkan bergabung ke group event melalui link dibawah ini</h5>
                          <a href="link/group" class="btn btn-primary text-white mt-2 mb-1" target="blank_"><i class="fa fa-users"></i> Gabung ke Group</a><br/>
                      <?php } ?>
                          <!-- <h4>dengan  berikut :</h4> -->
                    </div>
                    <div class="text-center">
                      <br/>
                      <h5>Info selanjutnya hubungi Panitia :</h5>
                        <h4>Nama : <a target="blank_" href="https://wa.me/62">92837458787</a></h4>
                      <!-- <h2>WhatsApp Panitia : <a target="blank_" href="https://wa.me/<?=$wa_panitia?>"><?=substr_replace($wa_panitia,'0','0',2)?></a></h2> -->
                      <!-- <h5>Untuk dapat dilakukan penanganan lebih lanjut</h5> -->
                      <h2>TERIMAKASIH</h2>
                    </div>
                  

                    
                  </div>
                </div>
              </div>
              
            </div>

        </div>
      </div>

      <footer class=" text-muted text-center text-small">
        <p class="mb-1">&copy; 2022 Vendor Indonesia</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url();?>assets/vendors/jquery/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<link href="<?php echo base_url();?>assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" />
<!-- Plugins and scripts required by this view-->
<script src="<?php echo base_url();?>assets/vendors/datatables.net/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url();?>assets/js/datatables.js"></script>
  <script>
    var uploadField = document.getElementById("bukti");

    uploadField.onchange = function() {
        if(this.files[0].size > 11097152){
           alert("Ukuran File terlalu besar, Maximal 2 Mb");
           this.value = "";
        };
    };    
    $('#bukti_form').on('submit', function(e){
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            url: "<?=base_url()?>payment/upload_bukti/<?=$pembayaran->id?>",
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
                       window.location = "<?=base_url()?>payment/transfer/<?=$pembayaran->id?>";
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
  </body>
</html>
