<style>
    .list-video li:nth-child(1) {
        background-color: #fff !important;
    }
</style>

<div class="content-header">
      <!-- Main content -->
      <div class="content">

        <main class="container">
            <div class="row">
              <div class="col-12 col-sm-12">
                
                <div class="row">
                  <div class="col-md-12">
                       <div class="card card-default col-md-12">
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="table-responsive ">
                                    <p class="link-terkait" style="display:none;"> Berikut Link Materi dan Video Terkait: </p> 
                                    <div class="list-video mt-2"></div>                               
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
            url:"<?=base_url()?>page/download_video",   
            type: "post",   
            dataType: 'json',
            data: {param:'video'},
            success:function(result){
              console.log(result.link_email)
              if(result != 'Data tidak ditemukan'){
                  $(".link-terkait").show();
                  $(".list-video").html(result.link_email);
                  $(".list-video ul").closest('ul').addClass('list-group');
                  $(".list-video li").closest('li').addClass('list-group-item active');
                }else{
                  $(".link-terkait").show();
                  $(".link-terkait").html(result);

              }
            }
        });
    }

</script> 
