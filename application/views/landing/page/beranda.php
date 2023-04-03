
    <style>
        .modal-open {
            padding-right: 0px !important;
        }
        body:not(.modal-open){
          padding-right: 0px !important;
        }
    </style>


    <!-- Content Header (Page header) -->
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



    </style>

    <div class="content-header">
      <div class="container">

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Selamat Datang <small>( Member area LPKN )</small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <?php
              if ($this->ion_auth->logged_in())
              {}else{
            ?>
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="badge badge-success" href="<?=base_url()?>auth/register"><i class="fa fa-users"></i> Bergabung Gratis</a></li>
              <!-- <li class="breadcrumb-item active">Profile Member</li> -->
            </ol>
            <?php } ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
      <div class="container" style="padding: 0em 0 1em;">
        <div class="bd-example mb-2">
          <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1" class=""></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <a href="#" target="blank_">
                  <img class="d-block w-100" data-src="holder.js/800x400?auto=yes&amp;bg=777&amp;fg=555&amp;text=First slide" alt="First slide [800x400]" src="https://lpkn.id//upload/slide/WEB-01.jpg" data-holder-rendered="true">
                </a>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" data-src="holder.js/800x400?auto=yes&amp;bg=666&amp;fg=444&amp;text=Second slide" alt="Second slide [800x400]" src="https://lpkn.id//upload/slide/WEB-02.jpg" data-holder-rendered="true">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
      <div class="container" style="padding: 0em 0 1em;">
        <div class="row">
          <div class="col-sm-6">
            <h4 class="m-0"> 8 Kelas Terbaru <small><a class="badge badge-primary" href="<?=base_url()?>page/allevent">View More</a></small></h4>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
          <?php 
            foreach ($home_event['event'] as $row) {
          ?>
          <div class="col-lg-3 col-6 card-wrapper-special">
            <div class="card card-special img__wrap">
              <img class="card-img-top card-img-top-special" src="<?=$row['brosur_img']?>" alt="Card image cap">
              <div class="img__description_layer">
                <p style="padding: 6px">
                  <!-- PENGADAAN BARANG/JASA PEMERINTAH (PBJP) LEVEL - 1<br>(48 JP, Model Pembelajaran Blended Learning)<br> -->
                  <!-- <a class="btn btn-primary btn-sm" target="blank_" href="<?=$row['link']?>">Selengkapnya</a> -->
                  <button type="button" onclick="get_event('<?=$row['slug']?>');" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    Selengkapnya
                  </button>
                </p>
              </div>
            </div>
          </div>   
          <?php } ?>              
        </div>

      </div><!-- /.container-fluid -->


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
      <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" id="video_">
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h4 class="m-0"> Galeri Video <small><a class="badge badge-primary" href="<?=base_url()?>page/allvideo">View More</a></small></h4>
          </div><!-- /.col -->
          <div class="grid" style="padding: 0em 0 1em;">
            <?php
              $this->db->limit(6);
              $this->db->order_by('id', 'DESC');
              $videos = $this->db->get('video')->result();
              foreach ($videos as $video) {
            ?>
            <figure class="effect-milo">
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
      </div>


      <div class="container" style="padding: 0em 0 1em;">
          <div class="col-sm-6">
            <h4 class="m-0"> Berita Terbaru <small><a class="badge badge-primary" href="<?=base_url()?>page/allnews">View More</a></small></h4>
          </div><!-- /.col -->
        <div class="row">
          <?php
            $this->db->limit(10);
            $news = $this->db->get('berita')->result();
            foreach ($news as $new) {
          ?>
          <div class="col-md-4 mt-3">
            <div class="card h-100">
              <a href="<?=base_url()?>page/detailnews/<?=$new->slug?>"><img style="height: 200px" src="<?=base_url()?>uploads/news/<?=$new->gambar?>" class="card-img-top" alt="..."></a> 
              <div class="card-body">
                <h5 class="card-title"><b><?=$new->judul?></b></h5>
                <p class="card-text"><?php echo(substr(strip_tags($new->isi),0,200)); ?>... <a href="<?=base_url()?>page/detailnews/<?=$new->slug?>">Selengkapnya</a></p>
              </div>
              <div class="card-footer">
                <p class="card-text"><small class="text-muted"><i class="fa fa-calendar text-secondary"></i> <?=date_indo(substr($new->create_at,0,10))?>, <i class="fa fa-user text-secondary"></i> <?=post_by($new->create_by)?></small></p>
              </div>
            </div>
          </div>
          <?php 
            }
          ?>
        </section>
      </div>
    </div>
    <!-- /.content-header -->
<!--
<link rel="stylesheet" href="<?=base_url()?>assets/grid/gridnews.css">
    
<script src="<?=base_url()?>assets/grid/gridnews.js"></script>

      <div class="container">
        <section id="pinBoot">
          <?php
            $this->db->limit(10);
            $news = $this->db->get('berita')->result();
            foreach ($news as $new) {
          ?>
          <article class="white-panel"><img src="<?=base_url()?>uploads/news/<?=$new->gambar?>" alt="">
            <h4><a href="#"><?=$new->judul?></a></h4>
            <p><?php echo(substr(strip_tags($new->isi),0,200)); ?></p>
          </article>
          <?php 
            }
          ?>

        </section>
      </div>
    </div>
-->


<link href="<?=base_url()?>assets/vendors/offcanvas/offcanvas.css" rel="stylesheet">
