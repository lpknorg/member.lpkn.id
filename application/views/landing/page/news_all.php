    <div class="content-header">
      <!-- Main content -->
      <div class="content">

        <main class="container">
          <div class="row">
            <div class="col-md-8 blog-main mt-2 mb-5">
              <h5 class="pb-4 mb-4 font-italic border-bottom">
                Semua Berita <small><a class="badge badge-primary" href="<?=base_url()?>">Kembali Ke Beranda</a></small>
              </h5>

              <div class="blog-post">
                <h2 class="blog-post-title">Total Berita : <?=$total_berita?></h2>
                <div class="row">
                <?php
                  foreach ($berita as $new) {
                ?>
                  <div class="col-md-6 mt-3">
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
                </div>
              </div><!-- /.blog-post -->

              <nav class="blog-pagination mt-3">
                <?=$pagination?>
              </nav>

            </div><!-- /.blog-main -->

            <?php include "aside.php"; ?>
          </div><!-- /.row -->

        </main><!-- /.container -->
      </div>
    </div>
