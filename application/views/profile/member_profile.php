<!doctype html>
<script src="<?php echo base_url();?>assets/vendors/jquery/js/jquery.min.js"></script>
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

.parent_pp {
  /*border: 1px solid;*/
  width: 20vh;
  height: 20vh;
  overflow: hidden;
  display: flex;
  /*border-radius: 50%;*/
}

.pp {
  max-width: inherit;
  max-height: inherit;
  height: inherit;
  width: inherit;
  object-fit: cover;
}

</style>

<?php
$user = $this->ion_auth->user()->row();
// $member = $this->db->where('nik', $user->username)->get('member')->row();
?>
<script>
      function load_profile(link){
              var url = "<?=site_url('profile/"+link+"')?>";
              $('#main-profile').load(url);
              var element = document.getElementById("main-profile");
              element.classList.remove("sidebar-show");
          }
</script>

    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>

<div class="mb-3"></div>
<div class="container-fluid">
<section class="content">
    <?php 
        if ($this->ion_auth->in_group('register')){ 
            $this->load->view('notif'); }
        elseif ($this->ion_auth->in_group('expired')) {
            $this->load->view('notif_expired'); }
    ?>
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">

            <div class="box-body box-profile">
                <div class="parent_pp profile-user-img img-circle" style="padding: 0px;">
                    <?php if($member->pp == ''){ ?>
                        <img class="pp" src="<?=base_url()?>assets/img/avatars/profile-img.jpg" alt="User profile picture">
                    <?php }else{?>
                        <img class="pp" src="<?=base_url()?>uploads/foto_profile/<?=$member->pp?>" alt="User profile picture">
                    <?php }?>
                </div>
            <div class="text-center">
                <button type="button" class="text-dark btn btn-transparent btn-lg p-0" data-toggle="modal" data-target="#update_foto">
                    <i class="icon-camera"></i>
                </button>
                <!--
                <div class="dropdown-menu dropdown-menu-left">
                    <a class="dropdown-item" href="javascript:void(0)" onclick="load_profile('update');">Update Foto</a>
                </div>
                -->
            </div>
              <!-- <img class="profile-user-img img-responsive img-circle" src="<?=base_url()?>assets/img/avatars/profile-img.png" alt="User profile picture"> -->

              <h3 class="profile-username text-center"><?=$user->first_name?></h3>

              <p class="text-muted text-center">

              <?php 
              $groups = $this->ion_auth->get_users_groups($user->id)->result();
              foreach ($groups as $group):?>
                <span class="badge badge-success"><?=$group->description?></span>
              <?php endforeach?>
              <!-- <br/><?=$member->no_member?> -->
              </p>
              <!-- <p></p> -->
              
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Status :</b>
                  <a class="pull-right">
                    <?php
                        if ($this->ion_auth->in_group('member')){
                            echo "Aktif";
                        }elseif ($this->ion_auth->in_group('expired')) {
                            echo "Expired";
                        }else{
                            echo "Belum Aktif";
                        }
                    ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>No.KTA :</b><br/>
                  <div class="text-center">
                    <?php if($member->no_member == NULL){
                        echo "-";
                    }else{
                        echo $member->no_member;
                    }
                    ?>
                  </div>
                </li>
                <li class="list-group-item">
                  <b>Tgl Bergabung :</b><br/>
                  <div class="text-center">
                    <?=date_indo(substr($member->create_date,0,10))?>
                  </div>
                </li>
                <li class="list-group-item">
                  <b>Tgl Kadaluarsa :</b><br/>
                  <div class="text-center">
                    <?php
                        if($member->expired_date == null){
                            echo "Akun Anda belum aktif";
                        }else{
                            echo date_indo($member->expired_date);
                        }
                    ?>
                  </div>
                </li>
                <li class="list-group-item">
                  <b>Link Group</b><br/>
                  <div class="text-center">
                    <a class="btn btn-primary btn-sm" href="https://t.me/+welAQmSSTk85ZGM1" target="_blank">Group Telegram</a>
                  </div>
                </li>
              </ul>
              

              <!--
              <a href="javascript:void(0)" onclick="load_controler('auth/change_password');" class="btn btn-primary btn-block"><b>Change Password</b></a>
              -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                        <div class="btn-group float-right">
                            <button type="button" class="text-dark btn btn-transparent btn-lg dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-settings"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- <a class="dropdown-item" href="#">Detail Profile</a> -->
                                <a class="dropdown-item" href="javascript:void(0)" onclick="load_profile('update');">Update Profile</a>
                                <?php if ($this->ion_auth->in_group('member')){ ?>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="load_profile('kta/<?=$user->username?>');">Download KTA</a>
                                <?php } ?>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="load_profile('change_password');">Update Password</a>
                                <!-- <a class="dropdown-item" href="#">LogOut</a> -->
                            </div>
                        </div>
                  <div id="main-profile">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 style="margin-top:0px">Profile Member</h4><br>
                        </div>
                    </div>
                    
                      <table class="table">
                        <tbody>
                            <tr>
                              <td width="200px">Nama Depan</td>
                              <td><?=$user->first_name?></td>
                            </tr>
                            <tr>
                              <td>NIK</td>
                              <td><?=$user->username?></td>
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
                              <td>Alamat</td>
                              <td>
                                KEL.<?=$member->kelurahan?>, KEC.<?=$member->kecamatan?>, KAB/KOTA.<?=$member->kabkota?>, PROV.<?=$member->prov?> 
                              </td>
                            </tr>
                            <tr>
                              <td>Phone</td>
                              <td><?=$user->phone?></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td class="text-right"><button type="button" class="btn btn-default" onclick="load_controler('mahasiswa');">Cancel</button></td>
                            </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
        </div>        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

<!-- Modal -->
<div class="modal fade" id="update_foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    
    <div class="modal-content">
    <form action="" method="post" id="foto_form">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upfate Foto Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="file" class="form-control" name="foto_profile" required="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

  <script>
    $('#foto_form').on('submit', function(e){
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            url: "<?=base_url()?>profile/updatepp/<?=$member->id?>",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            dataType: "json",
        })
        .done(function(res) {
            if(res.success) {
                toastr.success(res.msg, 'Success', 
                    {
                      "positionClass": "toast-top-right",
                      "preventDuplicates": false,
                      "showDuration": "300",
                      "hideDuration": "1000",
                      "timeOut": "2000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                    })
                    
                   window.setTimeout( function(){
                       window.location = "<?=base_url()?>";
                   }, 2000 );
                   
            } else {
                toastr.error(res.msg, 'Failed', 
                    {
                      "positionClass": "toast-top-right",
                      "preventDuplicates": false,
                      "showDuration": "300",
                      "hideDuration": "1000",
                      "timeOut": "2000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                    })
                // alert('gagal');
            }
        })
        
            
      });
    
  </script>

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