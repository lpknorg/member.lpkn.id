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
                                        <h4 style="margin-top:0px">Users Detail</h4><br>
                                        <table class="table">
	                                        <tr><td>Ip Address</td><td><?php echo $ip_address; ?></td></tr>
	                                        <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	                                        <tr><td>Password</td><td><?php echo $password; ?></td></tr>
	                                        <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	                                        <tr><td>Activation Selector</td><td><?php echo $activation_selector; ?></td></tr>
	                                        <tr><td>Activation Code</td><td><?php echo $activation_code; ?></td></tr>
	                                        <tr><td>Forgotten Password Selector</td><td><?php echo $forgotten_password_selector; ?></td></tr>
	                                        <tr><td>Forgotten Password Code</td><td><?php echo $forgotten_password_code; ?></td></tr>
	                                        <tr><td>Forgotten Password Time</td><td><?php echo $forgotten_password_time; ?></td></tr>
	                                        <tr><td>Remember Selector</td><td><?php echo $remember_selector; ?></td></tr>
	                                        <tr><td>Remember Code</td><td><?php echo $remember_code; ?></td></tr>
	                                        <tr><td>Created On</td><td><?php echo $created_on; ?></td></tr>
	                                        <tr><td>Last Login</td><td><?php echo $last_login; ?></td></tr>
	                                        <tr><td>Active</td><td><?php echo $active; ?></td></tr>
	                                        <tr><td>First Name</td><td><?php echo $first_name; ?></td></tr>
	                                        <tr><td>Last Name</td><td><?php echo $last_name; ?></td></tr>
	                                        <tr><td>Company</td><td><?php echo $company; ?></td></tr>
	                                        <tr><td>Phone</td><td><?php echo $phone; ?></td></tr>
	                                        <tr><td></td><td><button type="button" class="btn btn-default" onclick="load_controler('users');">Cancel</button></td></tr>
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