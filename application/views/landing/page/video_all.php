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
              <h5 class="pb-4 mb-4 font-italic border-bottom">
                Semua Video <small><a class="badge badge-primary" href="<?=base_url()?>">Kembali Ke Beranda</a></small>
              </h5>

              <div class="blog-post">
                <h2 class="blog-post-title">Total Videos : <?=$total_videos?></h2>
                <div class="row">
                  <div class="grid" style="padding: 0em 0 1em;">
                    <?php
                      // $this->db->limit(6);
                      // $this->db->order_by('id', 'DESC');
                      // $videos = $this->db->get('video')->result();
                      foreach ($videos as $video) {
                    ?>
                    <figure class="effect-milo" style="">
                      <img src="https://i3.ytimg.com/vi/<?=$video->code?>/maxresdefault.jpg" alt="img03"/>
                      <figcaption>
                        <!-- <h5>Tentang Bisnis Online</h5> -->
                        <p>
                          <b><?=$video->judul?></b><br/>
                          <i><?=$video->ket?></i><br/>
                          <a href="#" class="btn btn-outline-danger btn-sm mt-2" data-toggle="modal" data-target="#modal1" onclick="getVideo(<?=$video->id?>)">Play <i class="fa fa-youtube-play fa-lg c-mt-4 fa-2x"></i></a>
                        </p>              
                      </figcaption>     
                    </figure>
                    <?php
                      }
                    ?>
                  </div>
                </div>

              </div><!-- /.blog-post -->

              <?=$pagination?>
              
            </div><!-- /.blog-main -->

            <?php include "aside_video.php"; ?>
          </div><!-- /.row -->

        </main><!-- /.container -->
      </div>
    </div>
<link href="<?=base_url()?>assets/vendors/offcanvas/tworows.css" rel="stylesheet">
