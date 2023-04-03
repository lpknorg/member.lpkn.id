<!doctype html>
      <script>
        $(document).ready(function() {
            $('form.jsform').on('submit', function(form){
                form.preventDefault();
                $.post('<?php echo $action;?>', $('form.jsform').serialize(), function(data){
                    $('main.main').html(data);
                });
            });
        });
        function getVideo(){
            var qsc=document.getElementById("code").value; 
            var url = "<?=site_url('video/getytvideo/"+qsc+"')?>";
            $('#review').load(url);
         }
      </script>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">SISTEM INFORMASI USER & MENU</li>
                </ol>
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="margin-top:0px">Video <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
	                                    <div class="form-group">
                                            <label for="char">Judul <?php echo form_error('judul') ?></label>
                                            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="ket">Ket <?php echo form_error('ket') ?></label>
                                            <textarea class="form-control" rows="3" name="ket" id="ket" placeholder="Ket"><?php echo $ket; ?></textarea>
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Code <?php echo form_error('code') ?></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="code" id="code" placeholder="Code" value="<?php echo $code; ?>" />
                                                  <span class="input-group-append">
                                                    <a class="input-group-text load_search" onclick="getVideo()">
                                                        <i class="fa fa-youtube-play fa-lg"></i>&nbsp; Review
                                                    </a>
                                                  </span>
                                            </div>
                                        </div>
	                                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('video');">Cancel</button>
	                                </form>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .video-container { position: relative; padding-bottom: 56.25%; padding-top: 30px; height: 0; overflow: hidden; } .video-container iframe, .video-container object, .video-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
                            </style>
                            <div class="col-sm-6">
                                <div id="review">
                                    <div class="card">
                                        <div class="card-body video-container">
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$code?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
            <!-- </main> -->
        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>