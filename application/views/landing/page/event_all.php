      <script>
        function getVideo(id){
              var url = "<?=site_url('page/getvideo/"+id+"')?>";
              $('#video_').load(url);
           }
        jQuery(function($){
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
    <style type="text/css">

      .card-special {
         z-index: 1;
         border-radius: 6px 6px 6px 6px;
         border: 1;
         transition: 0.4s;
      }
       .card-wrapper-special {
         padding: 6px;
         /*box-shadow: 0 10px 60px 0 rgba(0, 0, 0, 0.2);*/
      }
       .card-special:hover {
         transform: scale(1.1);
         box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.4);
         z-index: 2;
      }
       .card-text-special {
         color: #fea200;
         font-weight: 500;
      }
       .card-img-top-special {
         /*border-radius: unset;*/
         border-radius: 5px 5px 5px 5px;
      }

      .img__description_layer {
        font-size: 14px;
        /*font-weight: bold;*/
        position: absolute;
        text-align: center;
        padding: 6px
        top: auto;
        /*top: 100px;*/
        width: 100%;
        bottom: 0;
        left: 0;
        right: 0;
        border-radius: 0px 0px 5px 5px;
        /*background: rgba(0 0 0 / 85%);*/
        color: white;
        visibility: hidden;
        opacity: 0;
        /*display: flex;*/
        align-items: center;
        justify-content: bottom;

        /* transition effect. not necessary */
        transition: opacity .2s, visibility .2s;
      }
      .img__wrap:hover .img__description_layer {
        visibility: visible;
        opacity: 1;
      }

      /*button load_more*/
      @media only screen and (min-width: 767px) {
        .show-large {
          display: block;
        }
        .show-mobile {
          display: none;
        }
      }

      .has-search .form-control-feedback {
          position: absolute;
          z-index: 2;
          display: block;
          width: 2.375rem;
          height: 2.375rem;
          line-height: 2.375rem;
          text-align: center;
          pointer-events: none;
          color: #aaa;
      }
    </style>
      <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" id="video_">
        </div>
      </div>
    <div class="content-header">
      <!-- Main content -->
      <div class="content">

        <main class="container">
          <div class="row">
            <div class="col-md-8 blog-main mt-2 mb-5">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h5 class="pb-4 mb-4 font-italic border-bottom">
                        Semua Event <small><a class="badge badge-primary" href="<?=base_url()?>">Kembali Ke Beranda</a></small>
                      </h5>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item">
                        <form class="form-inline ml-0 ml-md-3">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search event" id="search-keyword" >
                            <div class="input-group-append">
                              <button class="btn btn-secondary" type="button" id="serch_event">
                                <i class="fa fa-search"></i>
                              </button>
                            </div>
                          </div>
                        </form>
                      </li>
                    </ol>
                  </div><!-- /.col -->
                </div>
              

              

              <div class="blog-post">
                <h2 class="blog-post-title total-event">Total Event : <?= (isset($event->count)) ? $event->count : ''?></h2>
                <div class="row" id="content-event">
                  <!-- <div class="grid" style="padding: 0em 0 1em;"> -->
                    <?php
                      if(!empty($event)){
                      foreach ($event->event as $row) {
                    ?>
                      <div class="col-lg-4 col-6 card-wrapper-special">
                        <div class="card card-special img__wrap">
                          <img class="card-img-top card-img-top-special" src="<?=$row->brosur_img?>" alt="Card image cap">
                          <div class="img__description_layer">
                            <p style="padding: 6px">
                              <button type="button" onclick="get_event('<?=$row->slug?>');" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                Selengkapnya
                              </button>
                            </p>
                          </div>
                        </div>
                      </div>   
                    <?php
                        }
                      }
                    ?>
                  <!-- </div> -->
                </div>

              </div><!-- /.blog-post -->
               <div id='pagination'>
                  <?=$pagination?>
               </div>

            </div><!-- /.blog-main -->

            <?php include "aside_event.php"; ?>
          </div><!-- /.row -->

        </main><!-- /.container -->
      </div>
    </div>

   

<link href="<?=base_url()?>assets/vendors/offcanvas/tworows.css" rel="stylesheet">
<script type="text/javascript">
  $(document).ready(function(){
      $("#serch_event").on("click", function() {
        var keyword = $("#search-keyword").val();
      
      $("#pagination").html('')
        getevent(keyword);

      });


      $('.modal').on('show.bs.modal', function () {
          $('.modal').not($(this)).each(function () {
              $(this).modal('hide');
          });
      });

  })

  function getevent(keyword) 
  { 
    $('#content-event').html('')

    $.ajax({
          type: "GET", 
          // url: '<?php echo base_url('page/searchEvent'); ?>', 
          url: '<?php echo base_url('page/search_event'); ?>', 
          data: {keyword : keyword},
          success: function (response) {
            response = JSON.parse(response);
            console.log(response.event)
            $('.total-event').html("Total Event : "+response.total_rows);
            $('#pagination').html(response.pagination);
            var html = '';

              $.each(response.event, function(key,value) {
                html += `<div class="col-lg-4 col-6 card-wrapper-special">
                          <div class="card card-special img__wrap">
                            <img class="card-img-top card-img-top-special" src="${value.brosur_img}" alt="Card image cap">
                            <div class="img__description_layer">
                              <p style="padding: 6px">
                                <button type="button" onclick="get_event('${value.slug}');" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Selengkapnya
                                </button>
                              </p>
                            </div>
                          </div>
                        </div>`;

                    });

            $('#content-event').html(html);      
            

          },
      });
  }

</script>
