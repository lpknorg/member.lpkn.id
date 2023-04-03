<!doctype html>
<link href="<?php echo base_url();?>assets/vendors/select2/css/select2.min.css" rel="stylesheet" />
<!-- Plugins and scripts required by this view-->
<script src="<?php echo base_url();?>assets/vendors/jquery.maskedinput/js/jquery.maskedinput.js"></script>
<script src="<?php echo base_url();?>assets/vendors/select2/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/advanced-forms.js"></script>


      <script>
        $('form.jsform').on('submit', function(e){
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: "<?php echo $action;?>",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    $('main.main').html(data);
                    // $('#proses101').html(data);
                }

            });
        });   
      </script>

  <script src="<?php echo base_url();?>assets/vendors/tinymce/js/tinymce/tinymce.js"></script>

   <script type="text/javascript">
  tinymce.init({
    selector: "textarea",
    plugins: [
       "advlist autolink lists link image charmap print preview hr anchor pagebreak",
       "searchreplace wordcount visualblocks visualchars code fullscreen",
       "insertdatetime nonbreaking save table contextmenu directionality",
       "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager",
    automatic_uploads: true,
    image_advtab: true,
    images_upload_url: "<?php echo base_url("berita/tinymce_upload/")?>",
    file_picker_types: 'image', 
    paste_data_images:true,
    relative_urls: false,
    remove_script_host: false,
      file_picker_callback: function(cb, value, meta) {
       var input = document.createElement('input');
       input.setAttribute('type', 'file');
       input.setAttribute('accept', 'image/*');
       input.onchange = function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
           var id = 'post-image-' + (new Date()).getTime();
           var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
           var blobInfo = blobCache.create(id, file, reader.result);
           blobCache.add(blobInfo);
           cb(blobInfo.blobUri(), { title: file.name });
        };
       };
       input.click();
      },
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        },
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
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="margin-top:0px">Berita <?php echo $button ?></h4><br>
                                        <form action="<?php echo $action; ?>" method="post" class="jsform">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>">
	                                    <div class="form-group">
                                            <label for="int">Kategori Berita <?php echo form_error('kategori_berita') ?></label>
                                            <select name="kategori_berita" class="form-control select2-single" id="select2-1">
                                              <option value>Pilih Kategori Berita</option>
                                              <?php foreach ($list_kategori as $list) {
                                                echo '<option value="'.$list->id.'" '.(($kategori_berita==$list->id)?'selected="selected"':"").'>'.$list->kategori_berita.'</option>';
                                              } ?>
                                            </select>
                                            <!-- <input type="text" class="form-control" name="kategori_berita" id="kategori_berita" placeholder="Kategori Berita" value="<?php echo $kategori_berita; ?>" /> -->
                                        </div>
	                                    <div class="form-group">
                                            <label for="judul">Judul <?php echo form_error('judul') ?></label>
                                            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="gambar">Gambar <?php echo form_error('gambar') ?></label>
                                            <!-- <textarea class="form-control" rows="3" name="gambar" id="gambar" placeholder="Gambar"><?php echo $gambar; ?></textarea> -->
                                            <input type="file" class="form-control" name="gambar" id="gambar" placeholder="gambar" value="<?php echo $gambar; ?>" />
                                        </div>
	                                    <div class="form-group">
                                            <label for="isi">Isi <?php echo form_error('isi') ?></label>
                                            <!-- <textarea class="form-control" rows="3" name="isi" id="isi" placeholder="Isi"><?php echo $isi; ?></textarea> -->
                                            <div id="editor"></div>
                                            <textarea class="form-control mceEditor" rows="15" name="isi" id="content" placeholder="Isi"><?php echo $isi; ?></textarea>
                                        </div>
	                                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                                    <button type="button" class="btn btn-default" onclick="load_controler('berita');">Cancel</button>
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