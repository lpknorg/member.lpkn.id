<!DOCTYPE html>
                        <div class="heading-bx left mb-3">
                              <h2 class="title-head">Data <span>Keanggotaan</span></h2>
                              <p>Login dengan Akun kamu <a href="<?=base_url()?>auth/login">Klik Disini</a></p>
                        </div>      
                        <div class="row placeani">
                              <div class="col-lg-12">
                                    <div class="card">
                                          <div class="card-body">
                                                <table class="table">
                                                      <tr>
                                                            <td>No. KTA</td>
                                                            <td>:</td>
                                                            <td><?=$no_kta?></td>
                                                      </tr>
                                                      <tr>
                                                            <td>Nama Lengkap</td>
                                                            <td>:</td>
                                                            <td><?=$nama_lengkap?></td>
                                                      </tr>
                                                      <tr>
                                                            <td>Tanggal Bergabung</td>
                                                            <td>:</td>
                                                            <td><?=$tgl_gabung?></td>
                                                      </tr>
                                                      <tr>
                                                            <td>Status</td>
                                                            <td>:</td>
                                                            <td><?=$status?></td>
                                                      </tr>
                                                </table>
                                                <div class="text-right">
                                                      <a href="<?=base_url()?>validasi_member" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                              <!--
                              <div class="col-lg-12 m-b30">
                                    <button name="submit" type="submit" value="Submit" class="btn button-md"><i class="fa fa-search"></i> Cek No. KTA</button>
                              </div>
                              -->
                        </div>
