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
                                        <h4 style="margin-top:0px">Jurusan <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
	                                    <div class="form-group">
                                            <label for="char">Kode Jurusan <?php echo form_error('kode_jurusan') ?></label>
                                            <input type="text" class="form-control" name="kode_jurusan" id="kode_jurusan" placeholder="Kode Jurusan" value="<?php echo $kode_jurusan; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Nama Jurusan <?php echo form_error('nama_jurusan') ?></label>
                                            <input type="text" class="form-control" name="nama_jurusan" id="nama_jurusan" placeholder="Nama Jurusan" value="<?php echo $nama_jurusan; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="ket">Ket <?php echo form_error('ket') ?></label>
                                            <textarea class="form-control" rows="3" name="ket" id="ket" placeholder="Ket"><?php echo $ket; ?></textarea>
                                        </div>
	                                    <input type="hidden" name="id_jurusan" value="<?php echo $id_jurusan; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('jurusan');">Cancel</button>
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