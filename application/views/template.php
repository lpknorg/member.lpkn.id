<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.0.0
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<?php 
	// error_reporting(0); 
?>
<?php 
	$user_login = $this->ion_auth->user()->row(); 
	// echo $user_login->email;
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="Member Area of Vendor-Indonesia.id">
  <!-- <meta name="author" content="Łukasz Holeczek"> -->
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>Member Area | Vendor Indonesia</title>
  <!-- Icons-->
  <link href="<?php echo base_url();?>assets/vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
  <!-- Main styles for this application-->
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
  <link href="<?=base_url('assets/vendors/datatables/css/dataTables.bootstrap4.css');?>" rel="stylesheet" type="text/css" /> 
  <link href="<?php echo base_url();?>assets/vendors/zoom/css/zoom.css" rel="stylesheet">
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o), m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-118965717-1', 'auto');
    ga('send', 'pageview');
  </script>
</head>
	<body id="main_menu" class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

		  <header class="app-header navbar">
		    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <a class="navbar-brand" style="background-color: #000;" href="<?php echo base_url();?>">
		      <img class="navbar-brand-full" src="https://lpkn.id/front_assets/logo_putih.png" height="35" alt="CoreUI Logo">
		      <img class="navbar-brand-minimized" src="<?php echo base_url();?>assets/logo_kecil.png" width="30" height="30" alt="CoreUI Logo">
		    </a>
		    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <!--
		    <ul class="nav navbar-nav d-md-down-none">
		      <li class="nav-item px-3">
		        <a class="nav-link" href="#">Dashboard</a>
		      </li>
		      <li class="nav-item px-3">
		        <a class="nav-link" href="#">Users</a>
		      </li>
		      <li class="nav-item px-3">
		        <a class="nav-link" href="#">Settings</a>
		      </li>
		    </ul>
			  -->
		    <ul class="nav navbar-nav ml-auto">
		    	<!--
		      <li class="nav-item dropdown d-md-down-none">
		        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		            <i class="icon-bell"></i>
		            <span class="badge badge-pill badge-danger">5</span>
		          </a>
		        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
		          <div class="dropdown-header text-center">
		            <strong>You have 5 notifications</strong>
		          </div>
		          <a class="dropdown-item" href="#">
		              <i class="icon-user-follow text-success"></i> New user registered</a>
		          <a class="dropdown-item" href="#">
		              <i class="icon-user-unfollow text-danger"></i> User deleted</a>
		          <a class="dropdown-item" href="#">
		              <i class="icon-chart text-info"></i> Sales report is ready</a>
		          <a class="dropdown-item" href="#">
		              <i class="icon-basket-loaded text-primary"></i> New client</a>
		          <a class="dropdown-item" href="#">
		              <i class="icon-speedometer text-warning"></i> Server overloaded</a>
		          <div class="dropdown-header text-center">
		            <strong>Server</strong>
		          </div>
		          <a class="dropdown-item" href="#">
		            <div class="text-uppercase mb-1">
		              <small>
		                <b>CPU Usage</b>
		              </small>
		            </div>
		            <span class="progress progress-xs">
		              <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		            </span>
		            <small class="text-muted">348 Processes. 1/4 Cores.</small>
		          </a>
		          <a class="dropdown-item" href="#">
		            <div class="text-uppercase mb-1">
		              <small>
		                <b>Memory Usage</b>
		              </small>
		            </div>
		            <span class="progress progress-xs">
		              <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
		            </span>
		            <small class="text-muted">11444GB/16384MB</small>
		          </a>
		          <a class="dropdown-item" href="#">
		            <div class="text-uppercase mb-1">
		              <small>
		                <b>SSD 1 Usage</b>
		              </small>
		            </div>
		            <span class="progress progress-xs">
		              <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
		            </span>
		            <small class="text-muted">243GB/256GB</small>
		          </a>
		        </div>
		      </li>
		      <li class="nav-item dropdown d-md-down-none">
		        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		            <i class="icon-list"></i>
		            <span class="badge badge-pill badge-warning">15</span>
		          </a>
		        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
		          <div class="dropdown-header text-center">
		            <strong>You have 5 pending tasks</strong>
		          </div>
		          <a class="dropdown-item" href="#">
		            <div class="small mb-1">Upgrade NPM &amp; Bower
		              <span class="float-right">
		                <strong>0%</strong>
		              </span>
		            </div>
		            <span class="progress progress-xs">
		              <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
		            </span>
		          </a>
		          <a class="dropdown-item" href="#">
		            <div class="small mb-1">ReactJS Version
		              <span class="float-right">
		                <strong>25%</strong>
		              </span>
		            </div>
		            <span class="progress progress-xs">
		              <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
		            </span>
		          </a>
		          <a class="dropdown-item" href="#">
		            <div class="small mb-1">VueJS Version
		              <span class="float-right">
		                <strong>50%</strong>
		              </span>
		            </div>
		            <span class="progress progress-xs">
		              <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
		            </span>
		          </a>
		          <a class="dropdown-item" href="#">
		            <div class="small mb-1">Add new layouts
		              <span class="float-right">
		                <strong>75%</strong>
		              </span>
		            </div>
		            <span class="progress progress-xs">
		              <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
		            </span>
		          </a>
		          <a class="dropdown-item" href="#">
		            <div class="small mb-1">Angular 2 Cli Version
		              <span class="float-right">
		                <strong>100%</strong>
		              </span>
		            </div>
		            <span class="progress progress-xs">
		              <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
		            </span>
		          </a>
		          <a class="dropdown-item text-center" href="#">
		            <strong>View all tasks</strong>
		          </a>
		        </div>
		      </li>
		      <li class="nav-item dropdown d-md-down-none">
		        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		            <i class="icon-envelope-letter"></i>
		            <span class="badge badge-pill badge-info">7</span>
		          </a>
		        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
		          <div class="dropdown-header text-center">
		            <strong>You have 4 messages</strong>
		          </div>
		          <a class="dropdown-item" href="#">
		            <div class="message">
		              <div class="py-3 mr-3 float-left">
		                <div class="avatar">
		                  <img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/7.jpg" alt="admin@bootstrapmaster.com">
		                  <span class="avatar-status badge-success"></span>
		                </div>
		              </div>
		              <div>
		                <small class="text-muted">John Doe</small>
		                <small class="text-muted float-right mt-1">Just now</small>
		              </div>
		              <div class="text-truncate font-weight-bold">
		                <span class="fa fa-exclamation text-danger"></span> Important message</div>
		              <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
		            </div>
		          </a>
		          <a class="dropdown-item" href="#">
		            <div class="message">
		              <div class="py-3 mr-3 float-left">
		                <div class="avatar">
		                  <img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/6.jpg" alt="admin@bootstrapmaster.com">
		                  <span class="avatar-status badge-warning"></span>
		                </div>
		              </div>
		              <div>
		                <small class="text-muted">John Doe</small>
		                <small class="text-muted float-right mt-1">5 minutes ago</small>
		              </div>
		              <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
		              <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
		            </div>
		          </a>
		          <a class="dropdown-item" href="#">
		            <div class="message">
		              <div class="py-3 mr-3 float-left">
		                <div class="avatar">
		                  <img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/5.jpg" alt="admin@bootstrapmaster.com">
		                  <span class="avatar-status badge-danger"></span>
		                </div>
		              </div>
		              <div>
		                <small class="text-muted">John Doe</small>
		                <small class="text-muted float-right mt-1">1:52 PM</small>
		              </div>
		              <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
		              <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
		            </div>
		          </a>
		          <a class="dropdown-item" href="#">
		            <div class="message">
		              <div class="py-3 mr-3 float-left">
		                <div class="avatar">
		                  <img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/4.jpg" alt="admin@bootstrapmaster.com">
		                  <span class="avatar-status badge-info"></span>
		                </div>
		              </div>
		              <div>
		                <small class="text-muted">John Doe</small>
		                <small class="text-muted float-right mt-1">4:03 PM</small>
		              </div>
		              <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
		              <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
		            </div>
		          </a>
		          <a class="dropdown-item text-center" href="#">
		            <strong>View all messages</strong>
		          </a>
		        </div>
		      </li>
			    -->
			    <style>
						.parent_pa {
						  /*border: 1px solid;*/
						  width: 5.5vh;
						  height: 20vh;
						  overflow: hidden;
						  display: flex;
						  /*border-radius: 50%;*/
						}

						.pa {
						  max-width: inherit;
						  max-height: inherit;
						  height: inherit;
						  width: inherit;
						  object-fit: cover;
						}
			    </style>
		      <li class="nav-item dropdown">
		        <a class="nav-link nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		        	<div class="parent_pa img-avatar" style="padding: 0px;">
		        		<?php if(!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('adminofficers')){?>
			        		<?php
			        			$member = $this->db->where('nik', $user_login->username)->get('member')->row();
			        			if($member->pp == ''){
			        		?>
				          	<img class="pa" src="<?php echo base_url();?>assets/img/avatars/profile-img.jpg" alt="admin@bootstrapmaster.com">
				          <?php }else{?>
				          	<img class="pa" src="<?php echo base_url();?>uploads/foto_profile/<?=$member->pp?>" alt="admin@bootstrapmaster.com">
				          <?php } ?>
				        <?php }else{?>
				          	<img class="pa" src="<?php echo base_url();?>assets/img/avatars/profile-img.jpg" alt="admin@bootstrapmaster.com">
			          <?php } ?>
		          <!-- } -->
		        	</div>
		          <!-- <img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/profile-img.png" alt="admin@bootstrapmaster.com"> -->
		        </a>
		        <div class="dropdown-menu dropdown-menu-right">
		          <div class="dropdown-header text-center">
		            <strong><?=$user_login->first_name?></strong>
		          </div>
		          <a class="dropdown-item" href="javascript:void(0)" onclick="load_controler('profile');">
		          <!-- <a class="dropdown-item" href="#"> -->
		              <i class="fa fa-user"></i> Profile</a>
		          <a class="dropdown-item" href="javascript:void(0)" onclick="load_controler('auth/change_password');">
		              <i class="fa fa-shield"></i> Change Password</a>
		          <a class="dropdown-item" href="<?=base_url()?>auth/logout">
		              <i class="fa fa-lock"></i> Logout</a>
		        </div>
		      </li>
		    </ul>
		    <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		  </header>

		<div class="app-body">
			<div class="sidebar">
				<nav class="sidebar-nav">
					<ul class="nav" id="menu_nav">

                    <?php 
                        $this->db->order_by('sort');
                        $datalist_menu = $this->db->get('tbl_menu')->result();
                        $ref   = [];
                        $items = [];

                        foreach ($datalist_menu as $data) {

                            $thisRef = &$ref[$data->id];
                            $this->db->where('parent', $data->id);
                            $count_parent = $this->db->get('tbl_menu')->num_rows();;
                            if($count_parent > 0){
                            	$_nav = 'nav-dropdown-toggle';
                            	$_href = '';
                            }else{
                            	$_nav = '';
                            	$_href = 'href="javascript:void(0)" onclick="load_controler(\''.$data->link.'\');"';
                            }
                            $thisRef['parent'] = $data->parent;
                            $thisRef['nav'] = $_nav;
                            $thisRef['href'] = $_href;
                            $thisRef['label'] = $data->label;
                            $thisRef['icon'] = $data->icon;
                            $thisRef['link'] = $data->link;
                            $thisRef['id'] = $data->id;

                           if($data->parent == 0) {
                           		if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission($data->key)) :
                                	$items[$data->id] = &$thisRef;
                            	endif;
                           } else {
                           		if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission($data->key)) :
                                	$ref[$data->parent]['child'][$data->id] = &$thisRef;
                            	endif;
                           }

                        }

                        function get_menu($items,$class = ' nav-dropdown-toggle') {
                        		$html = '';
                            foreach($items as $key=>$value) {
                            	// $html = '';
                                $html.= '
					 						<li class="nav-item nav-dropdown">
												<a class="nav-link '.$value['nav'].'" href="javascript:void(0)" '.$value['href'].'><i class="nav-icon '.$value['icon'].'"></i> '.$value['label'].'</a>
												<ul class="nav-dropdown-items">
												';
			                                if(array_key_exists('child',$value)) {
			                                    $html .= get_menu($value['child'],'child');
			                                }
	                                    $html .= "</ul>";
                                    $html .= "</li>";
                            }
                            return $html;
                        }
                         
                        print get_menu($items);
                    ?>

					</ul>
				</nav>
				<button class="sidebar-minimizer brand-minimizer" type="button"></button>
			</div>
			<script>
              function load_perpage(link){
                      var url = "<?=site_url('page/"+link+"')?>";
                      $('main.main').load(url);
                      var element = document.getElementById("main_menu");
                      element.classList.remove("sidebar-show");
                  }
              function load_controler(link){
                      var url = "<?=site_url('"+link+"')?>";
                      $('main.main').load(url);
                      var element = document.getElementById("main_menu");
                      element.classList.remove("sidebar-show");
                  }
			</script>			
			<!-- Your content will be here-->
			<!-- <div id="load_main"> -->
			<main class="main">
			<?php echo $contents; ?>
			</main>
			<!-- </div> -->

			<!--
			<aside class="aside-menu">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">
							<i class="icon-list"></i>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#messages" role="tab">
							<i class="icon-speech"></i>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#settings" role="tab">
							<i class="icon-settings"></i>
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="timeline" role="tabpanel">
						<div class="list-group list-group-accent">
							<div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small">Today</div>
							<div class="list-group-item list-group-item-accent-warning list-group-item-divider">
								<div class="avatar float-right">
									<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/7.jpg" alt="admin@bootstrapmaster.com">
								</div>
								<div>Meeting with
									<strong>Lucas</strong>
								</div>
								<small class="text-muted mr-3">
									<i class="icon-calendar"></i>  1 - 3pm</small>
								<small class="text-muted">
									<i class="icon-location-pin"></i>  Palo Alto, CA</small>
							</div>
							<div class="list-group-item list-group-item-accent-info">
								<div class="avatar float-right">
									<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/4.jpg" alt="admin@bootstrapmaster.com">
								</div>
								<div>Skype with
									<strong>Megan</strong>
								</div>
								<small class="text-muted mr-3">
									<i class="icon-calendar"></i>  4 - 5pm</small>
								<small class="text-muted">
									<i class="icon-social-skype"></i>  On-line</small>
							</div>
							<div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small">Tomorrow</div>
							<div class="list-group-item list-group-item-accent-danger list-group-item-divider">
								<div>New UI Project -
									<strong>deadline</strong>
								</div>
								<small class="text-muted mr-3">
									<i class="icon-calendar"></i>  10 - 11pm</small>
								<small class="text-muted">
									<i class="icon-home"></i>  creativeLabs HQ</small>
								<div class="avatars-stack mt-2">
									<div class="avatar avatar-xs">
										<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/2.jpg" alt="admin@bootstrapmaster.com">
									</div>
									<div class="avatar avatar-xs">
										<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/3.jpg" alt="admin@bootstrapmaster.com">
									</div>
									<div class="avatar avatar-xs">
										<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/4.jpg" alt="admin@bootstrapmaster.com">
									</div>
									<div class="avatar avatar-xs">
										<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/5.jpg" alt="admin@bootstrapmaster.com">
									</div>
									<div class="avatar avatar-xs">
										<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/6.jpg" alt="admin@bootstrapmaster.com">
									</div>
								</div>
							</div>
							<div class="list-group-item list-group-item-accent-success list-group-item-divider">
								<div>
									<strong>#10 Startups.Garden</strong> Meetup</div>
								<small class="text-muted mr-3">
									<i class="icon-calendar"></i>  1 - 3pm</small>
								<small class="text-muted">
									<i class="icon-location-pin"></i>  Palo Alto, CA</small>
							</div>
							<div class="list-group-item list-group-item-accent-primary list-group-item-divider">
								<div>
									<strong>Team meeting</strong>
								</div>
								<small class="text-muted mr-3">
									<i class="icon-calendar"></i>  4 - 6pm</small>
								<small class="text-muted">
									<i class="icon-home"></i>  creativeLabs HQ</small>
								<div class="avatars-stack mt-2">
									<div class="avatar avatar-xs">
										<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/2.jpg" alt="admin@bootstrapmaster.com">
									</div>
									<div class="avatar avatar-xs">
										<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/3.jpg" alt="admin@bootstrapmaster.com">
									</div>
									<div class="avatar avatar-xs">
										<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/4.jpg" alt="admin@bootstrapmaster.com">
									</div>
									<div class="avatar avatar-xs">
										<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/5.jpg" alt="admin@bootstrapmaster.com">
									</div>
									<div class="avatar avatar-xs">
										<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/6.jpg" alt="admin@bootstrapmaster.com">
									</div>
									<div class="avatar avatar-xs">
										<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/7.jpg" alt="admin@bootstrapmaster.com">
									</div>
									<div class="avatar avatar-xs">
										<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/8.jpg" alt="admin@bootstrapmaster.com">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane p-3" id="messages" role="tabpanel">
						<div class="message">
							<div class="py-3 pb-5 mr-3 float-left">
								<div class="avatar">
									<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/7.jpg" alt="admin@bootstrapmaster.com">
									<span class="avatar-status badge-success"></span>
								</div>
							</div>
							<div>
								<small class="text-muted">Lukasz Holeczek</small>
								<small class="text-muted float-right mt-1">1:52 PM</small>
							</div>
							<div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
							<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
						</div>
						<hr>
						<div class="message">
							<div class="py-3 pb-5 mr-3 float-left">
								<div class="avatar">
									<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/7.jpg" alt="admin@bootstrapmaster.com">
									<span class="avatar-status badge-success"></span>
								</div>
							</div>
							<div>
								<small class="text-muted">Lukasz Holeczek</small>
								<small class="text-muted float-right mt-1">1:52 PM</small>
							</div>
							<div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
							<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
						</div>
						<hr>
						<div class="message">
							<div class="py-3 pb-5 mr-3 float-left">
								<div class="avatar">
									<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/7.jpg" alt="admin@bootstrapmaster.com">
									<span class="avatar-status badge-success"></span>
								</div>
							</div>
							<div>
								<small class="text-muted">Lukasz Holeczek</small>
								<small class="text-muted float-right mt-1">1:52 PM</small>
							</div>
							<div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
							<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
						</div>
						<hr>
						<div class="message">
							<div class="py-3 pb-5 mr-3 float-left">
								<div class="avatar">
									<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/7.jpg" alt="admin@bootstrapmaster.com">
									<span class="avatar-status badge-success"></span>
								</div>
							</div>
							<div>
								<small class="text-muted">Lukasz Holeczek</small>
								<small class="text-muted float-right mt-1">1:52 PM</small>
							</div>
							<div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
							<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
						</div>
						<hr>
						<div class="message">
							<div class="py-3 pb-5 mr-3 float-left">
								<div class="avatar">
									<img class="img-avatar" src="<?php echo base_url();?>assets/img/avatars/7.jpg" alt="admin@bootstrapmaster.com">
									<span class="avatar-status badge-success"></span>
								</div>
							</div>
							<div>
								<small class="text-muted">Lukasz Holeczek</small>
								<small class="text-muted float-right mt-1">1:52 PM</small>
							</div>
							<div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
							<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
						</div>
					</div>
					<div class="tab-pane p-3" id="settings" role="tabpanel">
						<h6>Settings</h6>
						<div class="aside-options">
							<div class="clearfix mt-4">
								<small>
									<b>Option 1</b>
								</small>
								<label class="switch switch-label switch-pill switch-success switch-sm float-right">
									<input class="switch-input" type="checkbox" checked="">
									<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
								</label>
							</div>
							<div>
								<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
							</div>
						</div>
						<div class="aside-options">
							<div class="clearfix mt-3">
								<small>
									<b>Option 2</b>
								</small>
								<label class="switch switch-label switch-pill switch-success switch-sm float-right">
									<input class="switch-input" type="checkbox">
									<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
								</label>
							</div>
							<div>
								<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
							</div>
						</div>
						<div class="aside-options">
							<div class="clearfix mt-3">
								<small>
									<b>Option 3</b>
								</small>
								<label class="switch switch-label switch-pill switch-success switch-sm float-right">
									<input class="switch-input" type="checkbox">
									<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
								</label>
							</div>
						</div>
						<div class="aside-options">
							<div class="clearfix mt-3">
								<small>
									<b>Option 4</b>
								</small>
								<label class="switch switch-label switch-pill switch-success switch-sm float-right">
									<input class="switch-input" type="checkbox" checked="">
									<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
								</label>
							</div>
						</div>
						<hr>
						<h6>System Utilization</h6>
						<div class="text-uppercase mb-1 mt-4">
							<small>
								<b>CPU Usage</b>
							</small>
						</div>
						<div class="progress progress-xs">
							<div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<small class="text-muted">348 Processes. 1/4 Cores.</small>
						<div class="text-uppercase mb-1 mt-2">
							<small>
								<b>Memory Usage</b>
							</small>
						</div>
						<div class="progress progress-xs">
							<div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<small class="text-muted">11444GB/16384MB</small>
						<div class="text-uppercase mb-1 mt-2">
							<small>
								<b>SSD 1 Usage</b>
							</small>
						</div>
						<div class="progress progress-xs">
							<div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<small class="text-muted">243GB/256GB</small>
						<div class="text-uppercase mb-1 mt-2">
							<small>
								<b>SSD 2 Usage</b>
							</small>
						</div>
						<div class="progress progress-xs">
							<div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<small class="text-muted">25GB/256GB</small>
					</div>
				</div>
			</aside>
			-->
		</div>
		<footer class="app-footer">
			<div>
				<a href="https://vendor-indonesia.id">Vendor Asosiation</a>
				<span>&copy; 2022 Vendor Asosiation.</span>
			</div>
			<div class="ml-auto">
				<span>Powered by</span>
				<a href="https://vendor-indonesia.id">Vendor Asosiation</a>
			</div>
		</footer>
		<!-- Bootstrap and necessary plugins-->
		<script src="<?php echo base_url();?>assets/vendors/jquery/js/jquery.min.js"></script>

		<script src="<?php echo base_url();?>assets/vendors/popper.js/js/popper.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
		<!-- <script src="<?php echo base_url();?>assets/vendors/@coreui/coreui/js/coreui.min.js"></script> -->
		<script src="<?php echo base_url();?>assets/vendors/@coreui/coreui-pro/js/coreui.min.js"></script>
		<!-- Plugins and scripts required by this view-->
		<script src="<?php echo base_url();?>assets/vendors/chart.js/js/Chart.min.js"></script>
		<script src="<?php echo base_url();?>assets/vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/js/custom-tooltips.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/main.js"></script>
		<script src="<?php echo base_url();?>assets/js/charts.js"></script>
        <script src="<?php echo base_url();?>assets/vendors/zoom/js/zoom-vanilla.js"></script>
      <script>
        $(document).ready(function() {
            $("#menu_nav li a").click(function() {
                $(this).parent().siblings().removeClass('open');
                $('#menu_nav li a').removeClass('active');
                $(this).removeClass('open');
                $(this).addClass('active');
            });
            $("#menu_nav li ul li a").click(function() {
                $(this).parent().parent().parent().children('a').addClass('active');
                $(this).removeClass('active');
                $(this).addClass('active');
            });
        });
      </script>
	</body>
</html>
