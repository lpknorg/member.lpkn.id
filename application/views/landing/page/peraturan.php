<div class="content-header">
      <!-- Main content -->
      <div class="content">

        <main class="container">
        <div class="row">
              <div class="col-12 col-sm-12">
                <div class="row" style="margin-bottom: 5px">
                  <div class="col-md-4 text-white">
                      <div class="form-group">
                          <label for="sertifikasi">Nama Pasal</label>
                          <input class="form-control form-control-sm" placeholder="nama pasal" type="text" name="nama" id="nama">
                    </div>
                  </div>
                  <div class="col-md-4 text-white">
                      <div class="form-group">
                          <label for="status">Kategori</label>
                          <select class="form-control form-control-sm" style="height: 100%;" name="kategori" id="kategori">
                            <option value="">Semua Kategori</option>
                            <option value="PP">PP</option>
                            <option value="Permen">Permen</option>
                          </select>
                    </div>
                  </div>
                  <div class="col-md-3 text-white">
                      <div class="form-group">
                          <label for="tanggal_ujian">Tahun</label>
                          <input type="text" class="form-control form-control-sm" placeholder="tahun" name="tahun" id="tahun">
                    </div>
                  </div>
                  <div class="col-md-1 text-white">
                      <div class="form-group">
                          <button class="btn btn-primary btn-sm" id="tombol_filter" style="margin-top: 32px">Search</button>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                       <div class="card card-default col-md-12">
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="table-responsive">
                                <table class="table table-striped table-sm" id="listperaturan" style="width: 100%">
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Tahun</th>
                                        <th>Kategori</th>
                                        <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="data-peraturan">
                                    </tbody>

                                  </table>
                                </div>
                            </div>
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                      </div>
                  </div>
                </div>     

              </div>              
            </div>  
        </main><!-- /.container -->
      </div>
    </div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables4/datatables.min.css') ?>"/>
<script type="text/javascript" src="<?php echo base_url('assets/datatables4/datatables.min.js') ?>"></script>
<script type="text/javascript">
    loadData();
    function loadData(){
      $.ajax({
            url:"<?=base_url()?>page/download_peraturan",   
            type: "post",   
            dataType: 'json',
            data: {param:'peraturan'},
            success:function(result){
              console.log(result)
                var t =  $("#listperaturan").DataTable({
                    data: result.data,
                    "columns": [
                        {data: 'id', name: 'id'},
                        {data: 'nama', name: 'nama'},
                        {data: 'deskripsi', name: 'deskripsi'},
                        {data: 'tahun', name: 'tahun'},
                        {data: 'kategori', name: 'kategori'},
                        {data: 'link', name: 'link'},
                    ]
                })

                    $('#nama').keyup(function () {
                        t.column(1)
                      .search( $(this).val() )
                      .draw();
                      });

                    //filter Berdasarkan satuan product
                    $('#kategori').change(function () {
                        t.column(4)
                        .search($(this).val())
                        .draw();
                    });

                    $('#tahun').keyup(function () {
                        t.column(3)
                        .search($(this).val())
                        .draw();
                    });
            }
        });
    }

    // $(document).ready(function(){
    //     var t = $('#peraturan').DataTable({
    //         "processing": true,
    //         "serveSide" : true,
    //         "ordering" : true,
    //         "columnDefs": [ {
    //             "searchable": false,
    //             "orderable": false,
    //             "targets": 0
    //         } ],
    //         "order" : [[0, 'desc']],
    //         "ajax" : 
    //         {
    //             "url" : "<?= base_url('page/peraturan/json_pasal') ?>",
    //             "type" : "POST"
    //         },
    //         "deferRender" : true,
    //         "aLengthMenu": [[10, 20, 30],[ 10, 20, 30]],
    //         "columns" : [
    //             {
    //             "data": "id",
    //             "orderable": false,
    //             },
    //             {"data": "nama"},
    //             {"data": "deskripsi"},
    //             {"data": "tahun"},
    //             {"data": "kategori"},
    //             {"data": "link"}
    //         ]
    //     }); 
    //     t.on( 'draw.dt', function () {
    //     var PageInfo = $('#peraturan').DataTable().page.info();
    //         t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
    //             cell.innerHTML = i + 1 + PageInfo.start;
    //         } );
    //     } );

    //     $('#nama').keyup(function () {
    //         t.column(1)
    //     .search( $(this).val() )
    //     .draw();
    //     });

    //     //filter Berdasarkan satuan product
    //     $('#kategori').change(function () {
    //         t.column(4)
    //         .search($(this).val())
    //         .draw();
    //     });

    //     $('#tahun').keyup(function () {
    //         t.column(3)
    //         .search($(this).val())
    //         .draw();
    //     });
        
    // });
</script> 
