<?php
include "./config/library.php";
include "./config/koneksi.php";


//ambil data yang didapat dari form
$id=antiinjec($koneksi,@$_REQUEST['id']);
$status=antiinjec($koneksi,@$_GET['act']);

$divisi=antiinjec($koneksi,@$_POST['divisi']);

if($status=="tambah" ) {
	$qcek = "SELECT count(*) as jumlah FROM divisi WHERE divisi='$divisi'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "INSERT INTO divisi (divisi)
			 	 VALUES ('$divisi')";
		$koneksi->query($query);
		header("location:data_divisi.php");
	} else {
		?>
		<script language="JavaScript">alert('Divisi sudah ada.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="edit" ) {
	$qcek = "SELECT count(*) as jumlah FROM divisi WHERE divisi='$divisi' AND id_divisi<>'$id'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "UPDATE divisi SET 
				 divisi='$divisi'
				 where id_divisi='$id' ";
		$koneksi->query($query);
		header("location:data_divisi.php");
	} else {
		?>
		<script language="JavaScript">alert('Divisi sudah ada.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="hapus" ) {
	$query= "DELETE from divisi where id_divisi='$id' ";
	$koneksi->query($query);
	header("location:data_divisi.php");
}

?>


