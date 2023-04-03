<!doctype html>
<!-- <link href="<?php echo base_url();?>assets/vendors/select2/css/select2.min.css" rel="stylesheet" /> -->
<!-- Plugins and scripts required by this view-->
<!-- <script src="<?php echo base_url();?>assets/vendors/jquery.maskedinput/js/jquery.maskedinput.js"></script> -->
<!-- <script src="<?php echo base_url();?>assets/vendors/select2/js/select2.min.js"></script> -->
<script src="<?php echo base_url();?>assets/js/advanced-forms.js"></script>
<script>
	$('.semester').on('change', function() {
		// var NIM = $('.mahasiswa').value;
		var semester = this.value;
		var url = "<?=site_url('khs/get_khs_admin/'.$NIM.'/')?>"+semester;
		$('#table_krs').load(url);
	  // alert( url );
	});
</script> 
	                                            <select name="semester" style="width: 100%" class="form-control select2-single semester" id="select2-2">
	                                              <option value>Pilih Semester</option>
	                                              <?php foreach (range(1, $semester) as $x) {
	                                              // <?php foreach ($tahun_akademik as $list) {
	                                                echo '<option value="'.$x.'">Semester '.$x.'</option>';
	                                              } ?>
	                                            </select>
        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>
