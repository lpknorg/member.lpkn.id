  </div>
  <!-- /.content-wrapper -->
<script>
  function get_event(slug) {
    var url = "<?=site_url('page/get_event/"+slug+"')?>";
    $('.exampleModal').load(url);
  jQuery(function($){
    $('#exampleModal').on('hidden.bs.modal', function (e) {
        $('.exampleModal').empty();
    });
  });
  }
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl exampleModal" role="document">
  </div>
</div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
<footer class="bg-dark text-center text-white">
<?php
    $ip    = $this->input->ip_address(); // Mendapatkan IP user
    $date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
    $waktu = time(); //
    $timeinsert = date("Y-m-d H:i:s");
    // Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
    $s = $this->db->query("SELECT * FROM visitor WHERE ip='".$ip."' AND date='".$date."'")->num_rows();
    $ss = isset($s)?($s):0;
    // Kalau belum ada, simpan data user tersebut ke database
    if($ss == 0){
    $this->db->query("INSERT INTO visitor(ip, date, hits, online, time) VALUES('".$ip."','".$date."','1','".$waktu."','".$timeinsert."')");
    }
    // Jika sudah ada, update
    else{
    $this->db->query("UPDATE visitor SET hits=hits+1, online='".$waktu."' WHERE ip='".$ip."' AND date='".$date."'");
    }
    $pengunjunghariini  = $this->db->query("SELECT * FROM visitor WHERE date='".$date."' GROUP BY ip")->num_rows(); // Hitung jumlah pengunjung
    $dbpengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM visitor")->row(); 
    $totalpengunjung = isset($dbpengunjung->hits)?($dbpengunjung->hits):0; // hitung total pengunjung
    $bataswaktu = time() - 300;
    $pengunjungonline  = $this->db->query("SELECT * FROM visitor WHERE online > '".$bataswaktu."'")->num_rows(); // 
?>
  <!-- Grid container -->
  <div class="container p-4">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1" href="#" target="_blank" role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <!-- Twitter -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-twitter"></i
      ></a>

      <!-- Google -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-google"></i
      ></a>

      <!-- Instagram -->
      <a class="btn btn-outline-light btn-floating m-1" href="#" target="_blank" role="button"
        ><i class="fab fa-instagram"></i
      ></a>

      <!-- Linkedin -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-linkedin-in"></i
      ></a>

      <!-- Github -->
      <a class="btn btn-outline-light btn-floating m-1" href="#" target="_blank" role="button"
        ><i class="fab fa-youtube"></i
      ></a>
    </section>
    <!-- Section: Social media -->

    <!-- Section: Form -->
    <!-- Section: Form -->

    <!-- Section: Text -->
    <section class="mb-4">
      <p>
        Lembaga Pengembangan dan Konsultasi Nasional (LPKN) merupakan lembaga Diklat resmi yang berdiri sejak tahun 2005, dan telah Terakreditasi A Oleh Lembaga Kebijakan Pengadaan Barang/ Jasa Pemerintah (LKPP) – RI, untuk kegiatan Pelaksanaan Pelatihan Pengadaan dan Sertifikasi Barang/ Jasa pemerintah. Saat ini telah memiliki Alumni sebanyak 1.300.580 orang, yang tersebar di seluruh Indonesia, LPKN juga telah medapatkan 2 Rekor MURI, dalam penyelenggaraan Webinar dengan jumlah Peserta lebih dari 100.000 orang.
      </p>
    </section>
    <!-- Section: Text -->

    <!-- Section: Links -->
    <section class="">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <div class="text-left">
            <!-- <div class="col-lg-3 col-md-12 mb-4 mb-md-0 text-center"> -->
            <img height="50" class=" text-left mb-2" src="https://lpkn.id/front_assets/logo_putih.png">
            <!-- <br> -->
            <br/>
            <!-- <h5>Statistik Pengunjung</h5> -->
            <!-- <div style="vertical-align: center"> -->
            <!-- <div class="text-left pl-5"> -->
            Pengunjung Hari ini : <?=$pengunjunghariini ?> orang<br>
            Total Pengunjung : <?=number_format($totalpengunjung) ?> orang<br>
            Pengunjung Online : <?=$pengunjungonline ?> orang
          </div>
        </div>
      <!-- </div> -->
        <!-- </div> -->
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
          <div class="text-left">
            <h5 class="text-uppercase mb-2">KANTOR PUSAT :</h5>
            <ul class="list-unstyled mb-0">
              <!-- Komplek PQT (Perumahan Qorriyah Thoyibah), Kembangan, Jakarta Barat, 11630 -->
              <li>Gedung Linggardjati Lt.1</li>
              <li>Jalan Kayu Putih II No. 7 Pulogadung</li>
              <li>Jakarta Timur</li>
              <li><i class="fas fa-phone"></i> &nbsp;&nbsp;&nbsp;(021) 47862224</li>
              <li><i class="fas fa-fax"></i> &nbsp;&nbsp;&nbsp;(021) 47867127</li>
              <li><i class="fab fa-whatsapp"></i> &nbsp;&nbsp;&nbsp;&nbsp;0811 1464 659 / 0812 1308 3944</li>
              <!-- <li><i class="fas fa-envelope"></i> &nbsp;&nbsp;&nbsp;admin@madrasahdigital.com</li> -->
            </ul>
          </div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <div class="text-left">
            <h5 class="text-uppercase">Page</h5>
            <ul class="list-unstyled mb-0">
              <li>
                <a href="#!" class="text-white">Berita</a>
              </li>
              <li>
                <a href="#!" class="text-white">Video</a>
              </li>
              <li>
                <a href="#!" class="text-white">Kegiatan</a>
              </li>
              <li>
                <a href="#!" class="text-white">Kelas</a>
              </li>
              <li>
                <a href="#!" class="text-white">Tentang Kami</a>
              </li>
            </ul>
          </div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
          <div class="text-left">
            <h5 class="text-uppercase">Link Terkait</h5>
            <ul class="list-unstyled mb-0">
              <li><a href="#!" class="text-white">Kelas Smart</a></li>
              <li><a href="#!" class="text-white">Sekolah Pengadaan</a></li>
              <li><a href="#!" class="text-white">LKPP</a></li>
              <li><a href="#!" class="text-white">KPK</a></li>
              <!-- <li><a href="#!" class="text-white">Kementerian Dalam Negeri</a></li> -->
              <li><a href="#!" class="text-white">Kementerian Keuangan</a></li>
              <li><a href="#!" class="text-white">Bappenas</a></li>
              <!-- <li><a href="#!" class="text-white">Menpan</a></li> -->
            </ul>
          </div>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </section>
    <!-- Section: Links -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 Copyright by
    <a class="text-white" target="_blank" href="https://lpkn.id/">LPKN</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->

</div>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

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

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 --><!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
<script src="<?=base_url()?>assets/vendors/popper.js/js/popper.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>assets/adminlte/dist/js/demo.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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

</body>
</html>
