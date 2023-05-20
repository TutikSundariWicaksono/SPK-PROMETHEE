<?php
include "./config/library.php";
include "./config/koneksi.php";


//ambil data yang didapat dari form
$id=antiinjec($koneksi,@$_REQUEST['id']);
$status=antiinjec($koneksi,@$_GET['act']);

$nik=antiinjec($koneksi,@$_POST['nik']);
$alternatif=antiinjec($koneksi,@$_POST['alternatif']);
$divisi=antiinjec($koneksi,@$_POST['divisi']);

if($status=="tambah" ) {
	$qcek = "SELECT count(*) as jumlah FROM alternatif WHERE nik='$nik'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "INSERT INTO alternatif (nik, alternatif, id_divisi) VALUES ('$nik','$alternatif','$divisi')";
		$koneksi->query($query);
		header("location:data_alternatif.php");
	} else {
		?>
		<script language="JavaScript">alert('Alternatif sudah terdaftar.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="edit" ) {
	$qcek = "SELECT count(*) as jumlah FROM alternatif WHERE nik='$nik' AND id_alternatif<>'$id'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "UPDATE alternatif SET nik='$nik', alternatif='$alternatif', id_divisi='$divisi'
				 WHERE id_alternatif='$id' ";
		$koneksi->query($query);
		header("location:data_alternatif.php");
	} else {
		?>
		<script language="JavaScript">alert('Alternatif sudah terdaftar.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="hapus" ) {
	$query= "DELETE from alternatif where id_alternatif='$id' ";
	$koneksi->query($query);
	header("location:data_alternatif.php");
}

?>


