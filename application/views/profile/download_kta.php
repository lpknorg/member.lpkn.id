<?php
$user = $this->ion_auth->user()->row();
$member = $this->db->where('nik', $user->username)->get('member')->row();
?>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 style="margin-top:0px">Download KTA</h4><br>
                        </div>
                    </div>
                      <div class="container">

    <script type="text/javascript">
      $(document).ready(function () {
        document.getElementById("load_image").click();
      });
    </script>
    <div class="row">
      <div class="col-lg-12 col-md-12 mb-0">
        <div class="card card-body shadow-sm mb-0">
          <img id="img1" src="<?=base_url()?>assets/img/avatars/profile-img.png" width="500px" height="500px" hidden="true" class="img-fluid">
          <img src="<?=base_url()?>assets_new/kta_depan.png" id="img2" hidden="true" class="img-fluid">
          <h2>

            <canvas id="canvas" class="img-fluid"></canvas>
          </h2>
          <a id="download" class="btn btn-primary mb-3 text-white">Download gambar</a>
          <!-- <form method="post" enctype="multipart/form-data"> -->
            <label class="font-weight-light mt-2"><b>Ganti Foto</b></label>
            <div class="input-group">
              <input type="file" name="file" id="image" accept="image/*" onchange="upload_image(event)"  class="form-control">
                <div class="input-group-append">
                  <button class="btn btn-primary" onclick="getImage_()" type="button">Load Foto</button>
                </div>
            </div>
            <div class="mb-2 font-italic">
              <small>Tips: gunakan ukuran foto 1:1 untuk hasil terbaik</small>
            </div>
<!--            <button onclick="getImage_()" id="load_image" class="btn btn-primary btn-sm">
              Buat Twibbon!
            </button>
 -->          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
  <a onclick="getImage_()" id="load_image"></a>
  <script>


    // getImage_();





    function getImage_() {
      var img1 = document.getElementById('img1');
      var img2 = document.getElementById('img2');
      var canvas = document.getElementById("canvas");
      var context = canvas.getContext("2d");
      var width = img2.width;
      var height = img2.height;
      canvas.width = width;
      canvas.height = height;
    var fontFamily = "Arial";
    var fontSize = "36px";
    var fontColour = "blue";

        context.drawImage(img1, 58, 230, 250, 250);
        var image1 = context.getImageData(0, 0, width, height);
        var imageData1 = image1.data;

        context.drawImage(img2, 0, 0, width, height);
        var image2 = context.getImageData(0, 0, width, height);
        var imageData2 = image2.data;

        // context.font = "normal 36pt Verdana";
        context.fillStyle = "white";
        context.font = "bold " + fontSize + " " + fontFamily;
        context.textAlign = "center";
        // context.fillStyle = fontColour;


    function fragmentText(text, maxWidth) {
        var words = text.split(' '),
            lines = [],
            line = "";
        if (context.measureText(text).width < maxWidth) {
            return [text];
        }
        while (words.length > 0) {
            while (context.measureText(words[0]).width >= maxWidth) {
                var tmp = words[0];
                words[0] = tmp.slice(0, -1);
                if (words.length > 1) {
                    words[1] = tmp.slice(-1) + words[1];
                } else {
                    words.push(tmp.slice(-1));
                }
            }
            if (context.measureText(line + words[0]).width < maxWidth) {
                line += words.shift() + " ";
            } else {
                lines.push(line);
                line = "";
            }
            if (words.length === 0) {
                lines.push(line);
            }
        }
        return lines;
    }



        var lines = fragmentText('<?=$member->nama_lengkap?>', 500 - parseInt('36pt',0));
        var non = 0;
        lines.forEach(function(line, i) {
            context.fillText(line, 720, (i + 9) * parseInt('36px',0));
            non += 36;
        });
        // var line_no = forEach(function(line, i) { return (i + 6) * parseInt('36px',0)},0);
        // context.fillText("<?=$member->nama_lengkap?>",525,270);
        context.font = "normal 16pt Verdana";
        context.fillText('Anggota', 720,320+non);
        context.font = "normal 20pt Verdana";
        context.fillText("<?=$member->no_member?>",720,360+non);

        $(document).on('input','#fn',function(){
        context.drawImage(img1, 18, 135, 200, 240);
        var image1 = context.getImageData(0, 0, width, height);
        var imageData1 = image1.data;
        context.drawImage(img2, 0, 0, width, height);
        var image2 = context.getImageData(0, 0, width, height);
        var imageData2 = image2.data;
          context.fillText($(this).val(),225,230);
          context.fillText(document.getElementById("ln").value,225,260);
        });
        $(document).on('input','#ln',function(){
        context.drawImage(img1, 18, 135, 200, 240);
        var image1 = context.getImageData(0, 0, width, height);
        var imageData1 = image1.data;
        context.drawImage(img2, 0, 0, width, height);
        var image2 = context.getImageData(0, 0, width, height);
        var imageData2 = image2.data;
        context.fillText(document.getElementById("fn").value,225,230);
          context.fillText('$(this).val()',225,260);
        });

    };

    function upload_image(event){
        var img1_up = document.getElementById('img1');
        img1_up.src = URL.createObjectURL(event.target.files[0]);
        img2.onload = function() {
          URL.revokeObjectURL(img1_up.src);
          getImage_(); // free memory
        };
      };
        
      function test(){
        alert('test');
      }

    function downloadCanvas(link, canvasId, filename) {
      link.href = document.getElementById(canvasId).toDataURL();
      link.download = filename;
    }

    document.getElementById('download').addEventListener('click', function() {
      downloadCanvas(this, 'canvas', 'wfi-twibbon.png');
    }, false);
  </script>

  <script>
    /*
    function getImage_() {
      var img1 = document.getElementById('img1');
      var img2 = document.getElementById('img2');
      var canvas = document.getElementById("canvas");
      var context = canvas.getContext("2d");
      var width = img2.width;
      var height = img2.height;
      canvas.width = width;
      canvas.height = height;

      context.drawImage(img1, 18, 135, 200, 240);
      var image1 = context.getImageData(0, 0, width, height);
      var imageData1 = image1.data;
      context.drawImage(img2, 0, 0, width, height);
      var image2 = context.getImageData(0, 0, width, height);
      var imageData2 = image2.data;
      context.font = "normal 16pt Verdana";
        context.fillStyle = "white";
    };
    */

    function downloadCanvas(link, canvasId, filename) {
      link.href = document.getElementById(canvasId).toDataURL();
      link.download = filename;
    }

    document.getElementById('download').addEventListener('click', function() {
      downloadCanvas(this, 'canvas', 'KTA-<?=$member->no_member?>.png');
    }, false);

  </script>
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
