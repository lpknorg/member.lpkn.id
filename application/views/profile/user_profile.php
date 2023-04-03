<!doctype html>
<link href="<?=base_url()?>assets/vendors/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
   ====================================================================== -->
<script src="<?=base_url()?>assets/vendors/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('fine_upload'); ?>
<style type="text/css">
.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}
.box-header>.fa, .box-header>.glyphicon, .box-header>.ion, .box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}
.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;
}
.profile-user-img {
    margin: 0 auto;
    width: 100px;
    padding: 3px;
    border: 3px solid #d2d6de;
}
.img-circle {
    border-radius: 50%;
}
.carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img {
    display: block;
    max-width: 100%;
    height: auto;
}
.nav-tabs-custom {
    margin-bottom: 20px;
    background: #fff;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 3px;
}
.nav-tabs-custom>.nav-tabs {
    margin: 0;
    border-bottom-color: #f4f4f4;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
}
.nav-tabs {
    border-bottom: 1px solid #ddd;
}
.nav {
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}

</style>

<?php
$user = $this->ion_auth->user()->row();
?>

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
<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="http://localhost/khs/assets/img/avatars/profile-img.jpg" alt="User profile picture">

              <h3 class="profile-username text-center"><?=$user->first_name?> <?=$user->last_name?></h3>

              <p class="text-muted text-center">

                                  <?php 
                                  $groups = $this->ion_auth->get_users_groups($user->id)->result();
                                  foreach ($groups as $group):?>
                                    <span class="badge badge-success"><?=$group->description?></span>
                                  <?php endforeach?>
              </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Change Password</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
<!--           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
          </div> -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                  <h4 style="margin-top:0px">Profile User</h4><br>
                  <table class="table">
                    <tbody>
                        <tr>
                          <td>Nama Depan</td>
                          <td><?=$user->first_name?></td>
                        </tr>
                        <tr>
                          <td>Nama Belakang</td>
                          <td><?=$user->last_name?></td>
                        </tr>
                        <tr>
                          <td>Email</td>
                          <td><?=$user->email?></td>
                        </tr>
                        <tr>
                          <td>Company</td>
                          <td><?=$user->company?></td>
                        </tr>
                        <tr>
                          <td>Tmpt Lahir</td>
                          <td>tangerang</td>
                        </tr>
                        <tr>
                          <td>Phone</td>
                          <td><?=$user->phone?></td>
                        </tr>
                        <tr>
                          <td>Status</td>
                          <td><?=($user->active == 1)? 'Active' : 'Inactive';?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><button type="button" class="btn btn-default" onclick="load_controler('mahasiswa');">Cancel</button></td>
                        </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

        <script>
           $(document).ready(function() {
             $('#user_avatar_galery').fineUploader({
                 template: 'qq-template-gallery',
                 request: {
                     endpoint: <?=base_url()?> + 'administrator/user/upload_avatar_file',
                     params: {
                         '__40o8ggw8s0g80c4ggsg0c00scw0g88ggko4800kk': 'bb80796a9c13ffecced8b705d3df477f'
                     }
                 },
                 deleteFile: {
                     enabled: true,
                     endpoint: <?=base_url()?> + 'administrator/user/delete_avatar_file',
                 },
                 thumbnails: {
                     placeholders: {
                         waitingPath: <?=base_url()?> + '/asset/fine-upload/placeholders/waiting-generic.png',
                         notAvailablePath: <?=base_url()?> + '/asset/fine-upload/placeholders/not_available-generic.png'
                     }
                 },
                 session: {
                     endpoint: <?=base_url()?> + 'administrator/user/get_avatar_file/1',
                     refreshOnRequest: true
                 },
                 multiple: false,
                 validation: {
                     allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
                 },
                 showMessage: function(msg) {
                     toastr['error'](msg);
                 },
                 callbacks: {
                     onComplete: function(id, name) {
                         var uuid = $('#user_avatar_galery').fineUploader('getUuid', id);
                         $('#user_avatar_uuid').val(uuid);
                         $('#user_avatar_name').val(name);
                     },
                     onSubmit: function(id, name) {
                         var uuid = $('#user_avatar_uuid').val();
                         $.get(<?=base_url()?> + '/administrator/user/delete_image_file/' + uuid);
                     }
                 }
             }); /*end image galey*/

         }); /*end doc ready*/
        </script>
        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>