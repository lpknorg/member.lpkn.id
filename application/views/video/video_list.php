<!doctype html>
                <div class="mb-3"></div>
                <div class="col-md-12">
                    <div class="animated fadeIn">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                    <div class="row" style="margin-bottom: 10px">
                                        <div class="col-md-6">
                                            <h4 style="margin-top:0px">Kumpulan Video Pembelajaran</h4>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <div class="input-group">
                                              <input class="form-control" id="q" type="text" name="input2-group1" placeholder="Search" autocomplete="search">
                                              <div class="input-group-append">
                                                <button class="input-group-text load_search" data-val = "0">
                                                    <i class="fa fa-search fa-lg c-mt-4"></i>
                                                </button>
                                              </div>
                                            </div>
	                                   </div>
                                    </div>
                                    <div class="table-responsive">

                            <script>
                              function getVideo(id){
                                    var url = "<?=site_url('video/getvideo/"+id+"')?>";
                                    $('#video_').load(url);
                                 }
                              $(function(){
                                $('#modal1').on('hidden.bs.modal', function (e) {
                                    $('#video_').empty();
                                });
                              });
                            </script>
                            <style>
                                .modal-open {
                                    padding-right: 0px !important;
                                }
                                body:not(.modal-open){
                                  padding-right: 0px !important;
                                }
                            </style>
                            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document" id="video_">
                              </div>
                            </div>

                                <div class="grid" id="ajax_table">
                                </div>
                                <!-- </div> -->
                            </div>
                            <div class="text-center">
                              <button class="btn btn-secondary btn-sm load_more" id="load_more" data-val = "0">
                                <i class="fa fa-step-forward fa-lg"> </i> Load More
                              </button><br/>
                              <img src="<?=base_url()?>assets/load_page.gif" id="loader">
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>
                            <link href="<?=base_url()?>assets/vendors/offcanvas/offcanvas.css" rel="stylesheet">
    <?php if(empty($_GET['q'])){$q='';}else{$q=$_GET['q'];}?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>

    $(document).ready(function(){
      // $("#load_more").hide();
      getproduk(0);

      $(document).on('touchmove', onScroll); // for mobile
      $(window).on('scroll', onScroll); 
      function onScroll(){ 
          if($(window).scrollTop() == $(document).height() - $(window).height()) {
            // $("#load_more").click();
          }
      };
      $(".load_more").click(function(e){
          e.preventDefault();
          var page = $(this).data('val');
          getproduk(page);

      });
      $(".load_search").click(function(e){
          e.preventDefault();
          var page = $(this).data('val');
          searchproduk(page);

      });
      //getcountry();
    });

    var getproduk = function(page){
        var qsc=document.getElementById("q").value;  
        $("#loader").show();
        $.ajax({
            url:"<?php echo base_url() ?>video/getlistvideo?q="+qsc,
            type:'GET',
            data: {page:page}
        }).done(function(response){
            $("#ajax_table").append(response);
            $("#loader").hide();
            $('#load_more').data('val', ($('#load_more').data('val')+1));
        });
    };

    var searchproduk = function(page){
        var qsc=document.getElementById("q").value;  
        $("#loader").show();
        $.ajax({
            url:"<?php echo base_url() ?>video/getlistvideo?q="+qsc,
            type:'GET',
            data: {page:page}
        }).done(function(response){
            $("#ajax_table").html(response);
            $("#loader").hide();
            $('#load_search').data('val', $('#load_more').data('val'));
            $('#load_more').data('val', 1);
        });
    };

</script>
