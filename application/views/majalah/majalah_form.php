<!doctype html>
      <script>
        $('form.jsform').on('submit', function(e){
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: "<?php echo $action;?>",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    $('main.main').html(data);
                }

            });
        });  
      </script>
            <!-- <main class="main"> -->
                <!-- Breadcrumb-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">SISTEM INFORMASI USER & MENU</li>
                </ol>
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="margin-top:0px">Majalah <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
	                                    <div class="form-group">
                                            <label for="judul">Judul <?php echo form_error('judul') ?></label>
                                            <textarea class="form-control" rows="3" name="judul" id="judul" placeholder="Judul"><?php echo $judul; ?></textarea>
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Foto <?php echo form_error('foto') ?></label>
                                            <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" accept="image/*" value="<?php echo $foto; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">File <?php echo form_error('file') ?></label>
                                            <input type="file" class="form-control" name="file" id="file" placeholder="File" accept=".pdf,.docx,.doc,.pptx,.ppt" value="<?php echo $file; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="ket">Ket <?php echo form_error('ket') ?></label>
                                            <textarea class="form-control" rows="3" name="ket" id="ket" placeholder="Ket"><?php echo $ket; ?></textarea>
                                        </div>
	                                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('majalah');">Cancel</button>
	                                </form>
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