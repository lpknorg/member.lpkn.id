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
                                        <h4 style="margin-top:0px">Tbl Menu <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
                                        <div class="form-group">
                                            <label for="varchar">Key <?php echo form_error('key') ?></label>
                                            <input type="text" class="form-control" name="key" id="key" placeholder="key" value="<?php echo $key; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="varchar">Label <?php echo form_error('label') ?></label>
                                            <input type="text" class="form-control" name="label" id="label" placeholder="Label" value="<?php echo $label; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="varchar">Icon <?php echo form_error('icon') ?></label>
                                            <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="varchar">Type <?php echo form_error('type') ?></label>
                                            <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="<?php echo $type; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="varchar">Link <?php echo form_error('link') ?></label>
                                            <input type="text" class="form-control" name="link" id="link" placeholder="Link" value="<?php echo $link; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="int">Parent <?php echo form_error('parent') ?></label>
                                            <input type="text" class="form-control" name="parent" id="parent" placeholder="Parent" value="<?php echo $parent; ?>" />
                                        </div>
	                                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('menu_dinamic');">Cancel</button>
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