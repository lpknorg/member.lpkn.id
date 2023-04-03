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
                                        <h4 style="margin-top:0px">Khs <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
	                                    <div class="form-group">
                                            <label for="int">NIM <?php echo form_error('NIM') ?></label>
                                            <input type="text" class="form-control" name="NIM" id="NIM" placeholder="NIM" value="<?php echo $NIM; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="char">Kode Tahun Akademik <?php echo form_error('kode_tahun_akademik') ?></label>
                                            <input type="text" class="form-control" name="kode_tahun_akademik" id="kode_tahun_akademik" placeholder="Kode Tahun Akademik" value="<?php echo $kode_tahun_akademik; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Kode Mata Kuliah <?php echo form_error('kode_mata_kuliah') ?></label>
                                            <input type="text" class="form-control" name="kode_mata_kuliah" id="kode_mata_kuliah" placeholder="Kode Mata Kuliah" value="<?php echo $kode_mata_kuliah; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="double">Nilai Angka <?php echo form_error('nilai_angka') ?></label>
                                            <input type="text" class="form-control" name="nilai_angka" id="nilai_angka" placeholder="Nilai Angka" value="<?php echo $nilai_angka; ?>" />
                                        </div>
	                                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('khs');">Cancel</button>
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