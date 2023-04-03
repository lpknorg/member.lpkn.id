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
                                        <h4 style="margin-top:0px">Menu <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
                                        <div class="form-group">
                                            <label for="char">Key <?php echo form_error('key') ?></label>
                                            <input type="text" class="form-control" name="key" id="key" placeholder="Key Name" value="<?php echo $key; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="char">Menu Name <?php echo form_error('menu_name') ?></label>
                                            <input type="text" class="form-control" name="menu_name" id="menu_name" placeholder="Menu Name" value="<?php echo $menu_name; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Icon Menu <?php echo form_error('icon_menu') ?></label>
                                            <input type="text" class="form-control" name="icon_menu" id="icon_menu" placeholder="Icon Menu" value="<?php echo $icon_menu; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="int">Id Group Menu <?php echo form_error('id_group_menu') ?></label>
                                            <input type="text" class="form-control" name="id_group_menu" id="id_group_menu" placeholder="Id Group Menu" value="<?php echo $id_group_menu; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="char">Menu Link <?php echo form_error('menu_link') ?></label>
                                            <input type="text" class="form-control" name="menu_link" id="menu_link" placeholder="Menu Link" value="<?php echo $menu_link; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="description_menu">Description Menu <?php echo form_error('description_menu') ?></label>
                                            <textarea class="form-control" rows="3" name="description_menu" id="description_menu" placeholder="Description Menu"><?php echo $description_menu; ?></textarea>
                                        </div>
	                                    <div class="form-group">
                                            <label for="enum">Status <?php echo form_error('status') ?></label>
                                            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                                        </div>
	                                    <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('menu');">Cancel</button>
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