
<div style="text-align:center">
	<!-- <img align="center" height="60px" src="assets/img/header_kwitansi.jpg"> -->
</div>

<!-- <br/> -->
<div style="text-align:left; font-size: 20px;">
	<img align="center" src="assets/kopsurat.jpg" style="width: 100%">
    <h1 align="center" style="align-content: center; font-family: 'Cambria', Arial, Helvetica, sans-serif; margin-bottom: 5px;">KUITANSI</h1>
    <!-- <hr/> -->
    <p align="center" style="font-family: 'Cambria', Arial, Helvetica, sans-serif; margin-top: 2px; margin-bottom: 1px;">No. Invoice : <?=$invoice?></p>
    <p style="font-family: 'Cambria', Arial, Helvetica, sans-serif; margin-top: 10px; margin-bottom: 1px;">Nama : <?=$nama_lengkap?></p>
    <p style="font-family: 'Cambria', Arial, Helvetica, sans-serif; margin-top: 2px; margin-bottom: 1px;">Invoice status: Paid</p>
    <!-- <p style="font-family: 'Cambria', Arial, Helvetica, sans-serif; margin-top: 2px; margin-bottom: 1px;">Untuk pembayaran :</p> -->
</div>

<div style="align-content: center; margin-top: 15px;">
	<table style="margin-left: auto; margin-right: auto;font-family: 'Cambria', Arial, Helvetica, sans-serif;  font-size: 18px; width: 100%;" cellspacing="0" cellpadding="2" border="1">
		<tr align="center">
	      <td style="padding: 0.3rem;"><b>No.</b></td>
	      <td style="padding: 0.3rem;"><b>Title</b></td>
	      <td style="padding: 0.3rem;"><b>Price</b></td>
	      <td style="padding: 0.3rem;"><b>Subtotal</b></td>
		</tr>
		<tr>
	      <td style="padding: 0.3rem;" align="center">1.</td>
	      <td style="padding: 0.3rem;">Aktifasi Keanggotaan Asosiation Vandor Indonesia</td>
	      <td style="padding: 0.3rem;" align="right">Rp. <?=number_format(500000)?>,-</td>
	      <td style="padding: 0.3rem;" align="right"><b>Rp. <?=number_format(500000)?>,-</b></td>
		</tr>
		<tr>
	      <td style="padding: 0.3rem;" align="center">2.</td>
	      <td style="padding: 0.3rem;">Biaya Iuran Bulanan Asosiation Vandor Indonesia (Selama <?=$paket?> Bulan @Rp. <?=number_format((($nominal-500000)/$paket))?>,-)</td>
	      <td style="padding: 0.3rem;" align="right">Rp. <?=number_format(($nominal-500000))?>,-</td>
	      <td style="padding: 0.3rem;" align="right"><b>Rp. <?=number_format(($nominal-500000))?>,-</b></td>
		</tr>
		<tr>
			<td colspan="3" style="padding: 0.3rem;" align="center"><b>Total</b></td>
			<td style="padding: 0.3rem;" align="right"><b>Rp. <?=number_format($nominal)?>,-</b></td>
		</tr>
	</table>
	<br/>
	<br/>
	<table style="align-content: right; margin-left: auto; font-family: 'Cambria', Arial, Helvetica, sans-serif;  font-size: 18px;" cellspacing="0" cellpadding="2">
		<tr>
	      <td width="50"></td>
	      <td></td>
	      <td width="300" align="center"><b>Jakarta, <?=dash_longdate_indo(substr($tgl,0,10))?></b></td>
		</tr>
		<tr>
	      <td></td>
	      <td></td>
	      <td></td>
	      <!-- <td align="center">Diterima Oleh :</td> -->
		</tr>
		<tr>
	      <td></td>
	      <td></td>
	      <td align="center" height="120px">
	      	<!-- <img align="center" height="150px" src="assets/ttd/<?=$panitia->ttd?>"> -->
	      </td>
		</tr>
		<tr>
	      <td></td>
	      <td></td>
	      <td align="center"><b>( Finance Manager )</b></td>
		</tr>
	</table>
</div>