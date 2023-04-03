<!doctype html>
<link href="<?php echo base_url();?>assets/vendors/select2/css/select2.min.css" rel="stylesheet" />
<!-- Plugins and scripts required by this view-->
<script src="<?php echo base_url();?>assets/vendors/jquery.maskedinput/js/jquery.maskedinput.js"></script>
<script src="<?php echo base_url();?>assets/vendors/select2/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/advanced-forms.js"></script>
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
                <div class="mb-3"></div>
                <div class="container-fluid">
                <?php 
                    if ($this->ion_auth->in_group('register')){ 
                        $this->load->view('notif'); }
                    elseif ($this->ion_auth->in_group('expired')) {
                        $this->load->view('notif_expired'); }
                ?>
                    <div class="animated fadeIn">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="margin-top:0px">Produk <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
	                                    <!--
                                        <div class="form-group">
                                            <label for="int">Id Member <?php echo form_error('id_member') ?></label>
                                            <input type="text" class="form-control" name="id_member" id="id_member" placeholder="Id Member" value="<?php echo $id_member; ?>" />
                                        </div>
                                        -->
	                                    <div class="form-group">
                                            <label for="int">Jenis Produk <?php echo form_error('id_jenis') ?></label>
                                            <!-- <input type="text" class="form-control" name="id_jenis" id="id_jenis" placeholder="Id Jenis" value="<?php echo $id_jenis; ?>" /> -->
                                            <select name="id_jenis" class="form-control select2-single" id="select2-1">
                                              <option value>Pilih Jenis</option>
                                              <?php foreach ($this->db->get('jenis_produk')->result() as $list) {
                                                echo '<option value="'.$list->id.'" '.(($id_jenis==$list->id)?'selected="selected"':"").'>'.$list->jenis.'</option>';
                                              } ?>
                                            </select>
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Nama Produk <?php echo form_error('nama_produk') ?></label>
                                            <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk" value="<?php echo $nama_produk; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Foto <?php echo form_error('foto') ?></label>
                                            <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="ket">Ket <?php echo form_error('ket') ?></label>
                                            <textarea class="form-control" rows="3" name="ket" id="ket" placeholder="Ket"><?php echo $ket; ?></textarea>
                                        </div>
	                                    <div class="form-group">
                                            <label for="link">Link Web <?php echo form_error('link') ?></label>
                                            <textarea class="form-control" rows="3" name="link" id="link" placeholder="Link"><?php echo $link; ?></textarea>
                                            <small><i>(Isi apabila ingin langsung ke link prodak Anda)</i></small>
                                        </div>
                                        <!--
	                                    <div class="form-group">
                                            <label for="datetime">Create Date <?php echo form_error('create_date') ?></label>
                                            <input type="text" class="form-control" name="create_date" id="create_date" placeholder="Create Date" value="<?php echo $create_date; ?>" />
                                        </div>
                                        -->
	                                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('produk');">Cancel</button>
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