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
                                        <h4 style="margin-top:0px">Member <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
	                                    <div class="form-group">
                                            <label for="int">Nik <?php echo form_error('nik') ?></label>
                                            <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?php echo $nik; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Email <?php echo form_error('email') ?></label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
                                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="int">Alamat Lengkap <?php echo form_error('alamat_lengkap') ?></label>
                                            <input type="text" class="form-control" name="alamat_lengkap" id="alamat_lengkap" placeholder="alamat_lengkap" value="<?php echo $alamat_lengkap; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="timestamp">Create Date <?php echo form_error('create_date') ?></label>
                                            <input type="text" class="form-control" name="create_date" id="create_date" placeholder="Create Date" value="<?php echo $create_date; ?>" />
                                        </div>
	                                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('member');">Cancel</button>
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