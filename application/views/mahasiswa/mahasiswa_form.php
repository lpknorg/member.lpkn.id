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
                                        <h4 style="margin-top:0px">Mahasiswa <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
	                                    <div class="form-group">
                                            <label for="int">NIM <?php echo form_error('NIM') ?></label>
                                            <input type="text" class="form-control" name="NIM" id="NIM" placeholder="NIM" value="<?php echo $NIM; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Nama Depan <?php echo form_error('nama_depan') ?></label>
                                            <input type="text" class="form-control" name="nama_depan" id="nama_depan" placeholder="Nama Depan" value="<?php echo $nama_depan; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Nama Belakang <?php echo form_error('nama_belakang') ?></label>
                                            <input type="text" class="form-control" name="nama_belakang" id="nama_belakang" placeholder="Nama Belakang" value="<?php echo $nama_belakang; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="char">Email <?php echo form_error('email') ?></label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="char">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="password" />
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
                                            <label for="char">Semester <?php echo form_error('kode_semester') ?></label>
                                            <input type="number" class="form-control" name="kode_semester" id="kode_semester" placeholder="Semester" value="<?php echo $kode_semester; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="char">Tmpt Lahir <?php echo form_error('tmpt_lahir') ?></label>
                                            <input type="text" class="form-control" name="tmpt_lahir" id="tmpt_lahir" placeholder="Tmpt Lahir" value="<?php echo $tmpt_lahir; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="date">Tgl Lahir <?php echo form_error('tgl_lahir') ?></label>
                                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tgl Lahir" value="<?php echo $tgl_lahir; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="enum">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
                                            <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
                                            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                                        </div>
	                                    <input type="hidden" name="id_mahasiswa" value="<?php echo $id_mahasiswa; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('mahasiswa');">Cancel</button>
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