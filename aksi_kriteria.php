<?php
include "./config/library.php";
include "./config/koneksi.php";

//ambil data yang didapat dari form
$id=antiinjec($koneksi,@$_REQUEST['id']);
$status=antiinjec($koneksi,@$_GET['act']);

$kriteria=antiinjec($koneksi,@$_POST['kriteria']);
$preferensi=antiinjec($koneksi,@$_POST['preferensi']);
$tipe_preferensi=antiinjec($koneksi,@$_POST['tipe_preferensi']);
$nilai_q=antiinjec($koneksi,@$_POST['nilai_q']);
$nilai_p=antiinjec($koneksi,@$_POST['nilai_p']);

if($status=="tambah" ) {
	$qcek = "SELECT count(*) as jumlah FROM kriteria WHERE kriteria='$kriteria'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "INSERT INTO kriteria (kriteria, preferensi, tipe_preferensi, nilai_q, nilai_p)
			 	 VALUES ('$kriteria','$preferensi','$tipe_preferensi','$nilai_q','$nilai_p')";
		$koneksi->query($query);
		header("location:data_kriteria.php");
	} else {
		?>
		<script language="JavaScript">alert('Kriteria sudah ada.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="edit" ) {
	$qcek = "SELECT count(*) as jumlah FROM kriteria WHERE kriteria='$kriteria' AND id_kriteria<>'$id'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "UPDATE kriteria SET 
				 kriteria='$kriteria', preferensi='$preferensi', tipe_preferensi='$tipe_preferensi', nilai_q='$nilai_q', nilai_p='$nilai_p'
				 where id_kriteria='$id' ";
		$koneksi->query($query);
		header("location:data_kriteria.php");
	} else {
		?>
		<script language="JavaScript">alert('Kriteria sudah ada.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="hapus" ) {
	$query= "DELETE from kriteria where id_kriteria='$id' ";
	$koneksi->query($query);
	header("location:data_kriteria.php");
}

?>