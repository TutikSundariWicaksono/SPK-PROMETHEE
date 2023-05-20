<script type='text/javascript' src='./js/jquery.min.js?ver=3.1.2'></script>
<script type="text/javascript" src="./js/custom.js"></script>
<script type="text/javascript" src="./js/jquery.validate.js"></script>

<script type="text/javascript">
// Forms Validator
$j(function() {
    $j("#test").validate();
});
</script>

<div class="article">

    <?php
	$kode_setting=antiinjec($koneksi,@$_POST['koset']);
	$stat=antiinjec($koneksi,@$_POST['stat']);
	
	$satu=md5(antiinjec($koneksi,@$_POST['satu']));
	$dua=md5(antiinjec($koneksi,@$_POST['dua']));
	$tiga=md5(antiinjec($koneksi,@$_POST['tiga']));
	?>
	
	<h2>Ubah Password</h2>
	<form method="post" action="index.php?page=ubah-password" enctype="multipart/form-data" name="test" id="test">
	<input name="stat" type="hidden" value="ubah1">
	<input name="koset" type="hidden" value="<?php echo"$kode_setting"; ?>">
				<table width="100%" border="0" cellspacing="0" cellpadding="5px">
				  <tr bgcolor="#FFFFFF">
					<td width="23%">Password Lama </td>
					<td width="2%">:</td>
					<td width="75%"><input type="password" name="satu" class="required" value="<?php echo "$dview[1]"; ?>" maxlength="50" style="width:150px;"></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td valign="top">&nbsp;</td>
				    <td valign="top">&nbsp;</td>
				    <td>&nbsp;</td>
			      </tr>
				  <tr bgcolor="#FFFFFF">
					<td valign="top">Password Baru </td>
					<td valign="top">:</td>
					<td><input type="password" name="dua" class="required" value="<?php echo "$dview[2]"; ?>" maxlength="50" style="width:150px;"></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td valign="top">Ulangi Password Baru </td>
				    <td valign="top">:</td>
				    <td><input type="password" name="tiga" class="required" value="<?php echo "$dview[3]"; ?>" maxlength="50" style="width:150px;"></td>
			      </tr>
				  <tr bgcolor="#FFFFFF">
					<td>&nbsp;</td>
					<td></td>
					<td align="right"></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
					<td></td>
					<td></td>
					<td><input type="submit" name="submit" value="Simpan" class="tombol"></td>
				  </tr>
				</table>
				
	</form>
	<br>
	</div>
<?php
//Script untuk pemrosesan data :::
//ubah data
if ($stat=="ubah1") {
	
		if ($satu<>$dataadm['password'])
		{ ?>
			<script language="JavaScript">alert('Passwrod lama salah. Password lama adalah password yang Anda gunakan sekarang.');
			document.location='index.php?page=ubah-password'</script>
		<?php }
		else
		{
			if (($dua<>$tiga) or ($dua=="") or ($tiga==""))
			{ ?>
				<script language="JavaScript">alert('Pasword baru dan password baru ulangi tidak sama dan tidak boleh dikosongkan.');
				document.location='index.php?page=ubah-password'</script>
			<?php }
			else
			{
				$query="UPDATE pengguna SET password='$dua' WHERE id_pengguna=$dataadm[id_pengguna]";
				$koneksi->query($query);
				?>
				<script language="JavaScript">alert('Perubahan berhasil disimpan.');
				document.location='index.php'</script>
				<?php
			}
		}
	}
?>