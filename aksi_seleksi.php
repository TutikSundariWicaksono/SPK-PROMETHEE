<?php
include "./config/library.php";
include "./config/koneksi.php";


//ambil data yang didapat dari form
$id=antiinjec($koneksi,@$_REQUEST['id']);
$status=antiinjec($koneksi,@$_GET['act']);

$seleksi=antiinjec($koneksi,@$_POST['seleksi']);
$tahun=antiinjec($koneksi,@$_POST['tahun']);
$keterangan=antiinjec($koneksi,@$_POST['keterangan']);

if($status=="tambah" ) {
	$qcek = "SELECT count(*) as jumlah FROM seleksi WHERE seleksi='$seleksi' AND tahun='$tahun'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "INSERT INTO seleksi (seleksi, tahun, keterangan)
			 	 VALUES ('$seleksi','$tahun','$keterangan')";
		$koneksi->query($query);
		header("location:data_seleksi.php");
	} else {
		?>
		<script language="JavaScript">alert('Seleksi sudah ada.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="edit" ) {
	$qcek = "SELECT count(*) as jumlah FROM seleksi WHERE seleksi='$seleksi' AND tahun='$tahun' AND id_seleksi<>'$id'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "UPDATE seleksi SET 
				 seleksi='$seleksi', tahun='$tahun', keterangan='$keterangan'
				 where id_seleksi='$id' ";
		$koneksi->query($query);
		header("location:data_seleksi.php");
	} else {
		?>
		<script language="JavaScript">alert('Seleksi sudah ada.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="hapus" ) {
	$query= "DELETE from seleksi where id_seleksi='$id' ";
	$koneksi->query($query);
	header("location:data_seleksi.php");
}

?>


