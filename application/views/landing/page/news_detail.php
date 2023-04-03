    <div class="content-header">
      <!-- Main content -->
      <div class="content">

        <main class="container">
          <div class="row">
            <div class="col-md-8 blog-main mt-2 mb-5">
              <h5 class="pb-4 mb-4 font-italic border-bottom">
                Detail Berita <small><a class="badge badge-primary" href="<?=base_url()?>page/allnews">View all</a></small>
              </h5>

              <div class="blog-post">
                <h2 class="blog-post-title"><?=$news->judul?></h2>
                <p class="blog-post-meta"><i class="fa fa-calendar text-secondary"></i> <?=date_indo(substr($news->create_at,0,10))?>, <i class="fa fa-user text-secondary"></i> <?=post_by($news->create_by)?></p>
                <img class="img-fluid" src="<?=base_url()?>uploads/news/<?=$news->gambar?>">
                <p><?php echo(substr(strip_tags($news->isi),0,200)); ?></p>
                <hr>
                <?=$news->isi?>
              </div><!-- /.blog-post -->

              <nav class="blog-pagination mt-3">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled">Newer</a>
              </nav>

            </div><!-- /.blog-main -->

            <?php include "aside.php"; ?>
          </div><!-- /.row -->

        </main><!-- /.container -->
      </div>
    </div>
