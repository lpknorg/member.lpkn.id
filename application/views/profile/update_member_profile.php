<?php
$user = $this->ion_auth->user()->row();
$member = $this->db->where('nik', $user->username)->get('member')->row();
?>
    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
      <script>
        function get_kota(t){
          var val = t.value.split("-");
          var id = val[0];
          var url = "<?=site_url('profile/getKota/"+id+"')?>";
          document.getElementById("prov").value = val[1];
          $('#kota').load(url);
        }
        function get_kec(t){
          var val = t.value.split("-");
          var id = val[0];
          var url = "<?=site_url('profile/getKec/"+id+"')?>";
          document.getElementById("kabkot").value = val[1];
          $('#kec').load(url);
        }
        function get_kel(t){
          var val = t.value.split("-");
          var id = val[0];
          var url = "<?=site_url('profile/getKel/"+id+"')?>";
          document.getElementById("kecamatan").value = val[1];
          $('#kel').load(url);
        }
        $(document).ready(function() {
          $('form.jsform').on('submit', function(e){
              e.preventDefault();
              $.ajax({
                  type: "POST",
                  url: "<?php echo uri_string();?>_action",
                  data: $('form.jsform').serialize(),
                  dataType: "json",
                })
                .done(function(res) {
                    if(res.success) {
                        toastr.success(res.count+' Data Changed', 'Success', 
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
                               load_controler('profile');
                           }, 2000 );
                          return;
                    } else {
                        toastr.warning('You Not Have Changed', 'Warning', 
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
                    }
                })
          })
        });
      </script>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 style="margin-top:0px">Update Profile Member</h4><br>
                        </div>
                    </div>
                    <form class="jsform">
                      <table class="table">
                        <tbody>
                            <tr>
                              <td width="200px">Nama Lengkap</td>
                              <td><input class="form-control" type="text" name="first_name" value="<?=$user->first_name?>"> </td>
                            </tr>
                            <tr>
                              <td width="200px">NIK</td>
                              <td><input class="form-control" type="number" name="username" value="<?=$user->username?>"> </td>
                            </tr>
                            <tr>
                              <td>Email</td>
                              <td>
                                <input type="email" name="email" class="form-control" value="<?=$user->email?>">
                              </td>
                            </tr>
                            <tr>
                              <td>Company</td>
                              <td>
                                <input type="text" name="company" class="form-control" value="<?=$user->company?>">
                              </td>
                            </tr>
                            <tr>
                              <td>Provinsi</td>
                              <td>
                                <select class="form-control" onchange="get_kota(this)" required="">
                                  <option value="<?=$member->prov?>"><?=$member->prov?></option>
                                  <?php foreach ($getprov as $prov) {?>
                                  <option value="<?=$prov->id?>-<?=$prov->name?>"><?=$prov->name?></option>
                                  <?php } ?>
                                </select>
                                <input type="hidden" name="prov" id="prov" value="<?=$member->prov?>">
                              </td>
                            </tr>
                            <tr>
                              <td>Kabupaten / Kota</td>
                              <td>
                                <select class="form-control" id="kota" onchange="get_kec(this)" required="">
                                  <option value="<?=$member->kabkota?>"><?=$member->kabkota?></option>
                                </select>
                                <input type="hidden" name="kabkot" id="kabkot" value="<?=$member->kabkota?>">
                              </td>
                            </tr>
                            <tr>
                              <td>Kecamatan</td>
                              <td>
                                <select class="form-control" id="kec" onchange="get_kel(this)" required="">
                                  <option value="<?=$member->kecamatan?>"><?=$member->kecamatan?></option>
                                </select>
                                <input type="hidden" name="kecamatan" id="kecamatan" value="<?=$member->kecamatan?>">
                              </td>
                            </tr>
                            <tr>
                              <td>Kelurahan</td>
                              <td>
                                <select class="form-control" id="kel" name="kelurahan" required="">
                                  <option value="<?=$member->kelurahan?>"><?=$member->kelurahan?></option>
                                </select>
                                <!-- <input type="hidden" name="kabkot" id="kabkot"> -->
                              </td>
                            </tr>
                            <tr>
                              <td>Phone</td>
                              <td>
                                <input type="number" name="phone" class="form-control" value="<?=$user->phone?>">
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td><button type="submit" class="btn btn-primary">Simpan</button>
                              <button type="reset" class="btn btn-secondary">Reset</button></td>
                            </tr>
                        </tbody>
                      </table>
                    </form>