<!doctype html>
<link href="<?php echo base_url();?>assets/vendors/select2/css/select2.min.css" rel="stylesheet" />
<!-- Plugins and scripts required by this view-->
<script src="<?php echo base_url();?>assets/vendors/jquery.maskedinput/js/jquery.maskedinput.js"></script>
<script src="<?php echo base_url();?>assets/vendors/moment/js/moment.min.js"></script>
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
                                        <h4 style="margin-top:0px">Daftar Nilai <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
	                                    <div class="form-group">
                                            <label for="int">Minimal / Sama Dengan <?php echo form_error('nilai_min') ?></label>
                                            <input type="text" class="form-control" name="nilai_min" id="nilai_min" value="<?php echo $nilai_min; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="int">Sampai <?php echo form_error('nilai_max') ?></label>
                                            <input type="text" class="form-control" name="nilai_max" id="nilai_max" value="<?php echo $nilai_max; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="char">Nilai Huruf <?php echo form_error('nilai_huruf') ?></label>
                                            <input type="text" class="form-control" name="nilai_huruf" id="nilai_huruf" placeholder="Nilai Huruf" value="<?php echo $nilai_huruf; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="char">Nilai Mutu <?php echo form_error('nilai_huruf') ?></label>
                                            <input type="text" class="form-control" name="mutu" id="mutu" placeholder="Nilai Mutu" value="<?php echo $mutu; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="ket_nilai">Ket Nilai <?php echo form_error('ket_nilai') ?></label>
                                            <textarea class="form-control" rows="3" name="ket_nilai" id="ket_nilai" placeholder="Ket Nilai"><?php echo $ket_nilai; ?></textarea>
                                        </div>
	                                    <input type="hidden" name="id_nilai" value="<?php echo $id_nilai; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('daftar_nilai');">Cancel</button>
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