<!doctype html>
<link href="<?=base_url()?>assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" />
<!-- Plugins and scripts required by this view-->
<script src="<?=base_url()?>assets/vendors/datatables.net/js/jquery.dataTables.js"></script>
<script src="<?=base_url()?>assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?=base_url()?>assets/js/datatables.js"></script>
<link href="<?=base_url()?>assets/vendors/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
   ====================================================================== -->

    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
<script>
$(document).ready(function() {
    var t = $('#example').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
</script>
<script>
  $(document).ready(function() {
    $('form.jsform').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>khs/input_nilai_action/<?=$kode_mata_kuliah?>",
            data: $('form.jsform').serialize(),
            dataType: "json",
          })
          .done(function(res) {
              if(res.success) {
                  toastr.success(res.count+' Data Changed', 'Success', 
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
                  $('main.main').load(res.redirect);

              } else {
                  toastr.warning('You Not Have Changed', 'Warning', 
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
              }
          })
    })
  });
</script>

<style type="text/css">
.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}
.box-header>.fa, .box-header>.glyphicon, .box-header>.ion, .box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}
.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;
}
.profile-user-img {
    margin: 0 auto;
    width: 100px;
    padding: 3px;
    border: 3px solid #d2d6de;
}
.img-circle {
    border-radius: 50%;
}
.carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img {
    display: block;
    max-width: 100%;
    height: auto;
}
.nav-tabs-custom {
    margin-bottom: 20px;
    background: #fff;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 3px;
}
.nav-tabs-custom>.nav-tabs {
    margin: 0;
    border-bottom-color: #f4f4f4;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
}
.nav-tabs {
    border-bottom: 1px solid #ddd;
}
.nav {
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}

</style>



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
<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <!-- <img class="profile-user-img img-responsive img-circle" src="http://localhost/khs/assets/img/avatars/profile-img.jpg" alt="User profile picture"> -->

              <h3 class="profile-username text-center"><?=$kode_mata_kuliah.'</br>'.$nama_mata_kuliah?></h3>

              <!-- <p class="text-muted text-center"><?=$kode_mata_kuliah.' - '.$nama_mata_kuliah?></p> -->

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Jumlah SKS</b> <a class="pull-right"><?=$sks?></a>
                </li>
                <li class="list-group-item">
                  <b>Kode Prodi</b> <a class="pull-right"><?=$kode_prodi?></a>
                </li>
                <li class="list-group-item">
                  <b>Semester</b> <a class="pull-right"><?=$kode_semester?></a>
                </li>
              </ul>
              <button onclick="load_controler('khs');" class="btn btn-default btn-block" type="button">Back</button>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                  <div class="row" style="margin-bottom: 10px">
                      <div class="col-md-6">
                          <h4 style="margin-top:0px">Form Input Nilai Mahasiswa</h4>
                      </div>
                      <div class="col-md-4 text-center">
                          <div style="margin-top: 4px"  id="message">
                              <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                          </div>
                      </div>
                      <div class="col-md-2 text-right">
                          <button type="submit" form="myform" name="save" value="save" class="btn btn-sm btn-primary">Save</button>
                      </div>
                    </div>
                  <form action="" method="pos" class="jsform" id="myform">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" id="example">
                          <thead>
                            <tr>
                              <th width="10px">No</th>
                              <th width="100px">NIM</th>
                              <th>Nama Lengkap</th>
                              <th width="70px">Nilai</th>
                              <!-- <th width="90px">Action</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            foreach ($list_mahasiswa as $list) { ?>
                            <tr>
                              <td></td>
                              <td><?=$list->NIM?></td>
                              <td><?=$list->nama_depan?> <?=$list->nama_belakang?></td>
                              <td><input class="form-control form-control-sm" type="text" name="nim_<?=$list->NIM?>"></td>
                              <!-- <td></td> -->
                            </tr>
                            <?php }?>
                          </tbody>
                        </table>
                    </div>
                  </form>
                </div>
            </div>
        </div>        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables4/datatables.min.css') ?>"/>
    <script type="text/javascript" src="<?php echo base_url('assets/datatables4/datatables.min.js') ?>"></script>

    <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>