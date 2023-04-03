<!doctype html>

            <!-- <main class="main"> -->
                <!-- Breadcrumb-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">SISTEM INFORMASI USER & MENU</li>
                    <!-- Breadcrumb Menu-->
                    <li class="breadcrumb-menu d-md-down-none">
                        <div class="btn-group" role="group" aria-label="Button group">
                            <a class="btn" href="#">
                                <i class="icon-speech"></i>
                            </a>
                            <a class="btn" href="./">
                                <i class="icon-graph"></i>  Dashboard</a>
                            <a class="btn" href="#">
                                <i class="icon-settings"></i>  Settings</a>
                        </div>
                    </li>
                </ol>
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="margin-top:0px">Menu Detail</h4><br>
                                        <table class="table">
	                                        <tr><td>Menu Name</td><td><?php echo $menu_name; ?></td></tr>
	                                        <tr><td>Icon Menu</td><td><?php echo $icon_menu; ?></td></tr>
	                                        <tr><td>Id Group Menu</td><td><?php echo $id_group_menu; ?></td></tr>
	                                        <tr><td>Menu Link</td><td><?php echo $menu_link; ?></td></tr>
	                                        <tr><td>Description Menu</td><td><?php echo $description_menu; ?></td></tr>
	                                        <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	                                        <tr><td></td><td><button type="button" class="btn btn-default" onclick="load_controler('menu');">Cancel</button></td></tr>
	                                    </table>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>