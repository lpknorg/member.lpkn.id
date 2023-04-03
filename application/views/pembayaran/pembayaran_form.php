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
                                        <h4 style="margin-top:0px">Pembayaran <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
	                                    <div class="form-group">
                                            <label for="char">Jenis Pembayaran <?php echo form_error('jenis_pembayaran') ?></label>
                                            <input type="text" class="form-control" name="jenis_pembayaran" id="jenis_pembayaran" placeholder="Jenis Pembayaran" value="<?php echo $jenis_pembayaran; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="int">Paket <?php echo form_error('paket') ?></label>
                                            <input type="text" class="form-control" name="paket" id="paket" placeholder="Paket" value="<?php echo $paket; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="int">Nominal <?php echo form_error('nominal') ?></label>
                                            <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal" value="<?php echo $nominal; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="snaptoken">Snaptoken <?php echo form_error('snaptoken') ?></label>
                                            <textarea class="form-control" rows="3" name="snaptoken" id="snaptoken" placeholder="Snaptoken"><?php echo $snaptoken; ?></textarea>
                                        </div>
	                                    <div class="form-group">
                                            <label for="int">Status <?php echo form_error('status') ?></label>
                                            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="timestamp">Create Date <?php echo form_error('create_date') ?></label>
                                            <input type="text" class="form-control" name="create_date" id="create_date" placeholder="Create Date" value="<?php echo $create_date; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="datetime">Update Date <?php echo form_error('update_date') ?></label>
                                            <input type="text" class="form-control" name="update_date" id="update_date" placeholder="Update Date" value="<?php echo $update_date; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Update By <?php echo form_error('update_by') ?></label>
                                            <input type="text" class="form-control" name="update_by" id="update_by" placeholder="Update By" value="<?php echo $update_by; ?>" />
                                        </div>
	                                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('pembayaran');">Cancel</button>
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