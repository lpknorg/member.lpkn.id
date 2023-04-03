<!doctype html>
<link href="<?php echo base_url();?>assets/vendors/select2/css/select2.min.css" rel="stylesheet" />
<!-- Plugins and scripts required by this view-->
<script src="<?php echo base_url();?>assets/vendors/jquery.maskedinput/js/jquery.maskedinput.js"></script>
<script src="<?php echo base_url();?>assets/vendors/select2/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/advanced-forms.js"></script>
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
                                        <h4 style="margin-top:0px">Mata Kuliah <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
	                                    <div class="form-group">
                                            <label for="char">Kode Mata Kuliah <?php echo form_error('kode_mata_kuliah') ?></label>
                                            <input type="text" class="form-control" name="kode_mata_kuliah" id="kode_mata_kuliah" placeholder="Kode Mata Kuliah" value="<?php echo $kode_mata_kuliah; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Nama Mata Kuliah <?php echo form_error('nama_mata_kuliah') ?></label>
                                            <input type="text" class="form-control" name="nama_mata_kuliah" id="nama_mata_kuliah" placeholder="Nama Mata Kuliah" value="<?php echo $nama_mata_kuliah; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="int">Sks <?php echo form_error('sks') ?></label>
                                            <input type="text" class="form-control" name="sks" id="sks" placeholder="Sks" value="<?php echo $sks; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Kode Prodi <?php echo form_error('kode_prodi') ?></label>
                                            <!-- <input type="text" class="form-control" name="kode_prodi" id="kode_prodi" placeholder="Kode Prodi" value="<?php echo $kode_prodi; ?>" /> -->
                                            <select name="kode_prodi" class="form-control select2-single" id="select2-1">
                                              <option value>Pilih Program Studi</option>
                                              <?php foreach ($list_prodi as $list) {
                                                echo '<option value="'.$list->kode_prodi.'" '.(($kode_prodi==$list->kode_prodi)?'selected="selected"':"").'>'.$list->kode_prodi.' - '.$list->nama_prodi.'</option>';
                                              } ?>
                                            </select>
                                        </div>
	                                    <div class="form-group">
                                            <label for="int">Kode Semester <?php echo form_error('kode_semester') ?></label>
                                            <input type="number" class="form-control" name="kode_semester" id="kode_semester" placeholder="Kode Semester" value="<?php echo $kode_semester; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="ket">Ket <?php echo form_error('ket') ?></label>
                                            <textarea class="form-control" rows="3" name="ket" id="ket" placeholder="Ket"><?php echo $ket; ?></textarea>
                                        </div>
	                                    <input type="hidden" name="id_mata_kuliah" value="<?php echo $id_mata_kuliah; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('mata_kuliah');">Cancel</button>
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