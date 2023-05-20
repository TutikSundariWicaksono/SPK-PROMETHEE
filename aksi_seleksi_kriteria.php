<?php
include "./config/library.php";
include "./config/koneksi.php";


//ambil data yang didapat dari form
$id=antiinjec($koneksi,@$_REQUEST['id']);
$status=antiinjec($koneksi,@$_GET['act']);

$seleksi=antiinjec($koneksi,@$_POST['seleksi']);
$kriteria=antiinjec($koneksi,@$_POST['kriteria']);
$bobot=antiinjec($koneksi,@$_POST['bobot']);

if($status=="tambah" ) {
	$qcek = "SELECT count(*) as jumlah FROM seleksi_kriteria WHERE id_seleksi='$seleksi' AND id_kriteria='$kriteria'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "INSERT INTO seleksi_kriteria (id_seleksi, id_kriteria, bobot)
			 	 VALUES ('$seleksi','$kriteria','$bobot')";
		$koneksi->query($query);
		header("location:data_seleksi_kriteria.php");
	} else {
		?>
		<script language="JavaScript">alert('Kriteria sudah ada dalam seleksi.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="edit" ) {
	$qcek = "SELECT count(*) as jumlah FROM seleksi_kriteria WHERE id_seleksi='$seleksi' AND id_kriteria='$kriteria' AND id_seleksi_kriteria<>'$id'";
	$hcek = $koneksi->query($qcek);
	$dcek = mysqli_fetch_array($hcek);
	if($dcek[0]==0) {
		$query= "UPDATE seleksi_kriteria SET 
				 id_seleksi='$seleksi', id_kriteria='$kriteria', bobot='$bobot'
				 where id_seleksi_kriteria='$id' ";
		$koneksi->query($query);
		header("location:data_seleksi_kriteria.php");
	} else {
		?>
		<script language="JavaScript">alert('Kriteria sudah ada dalam seleksi.'); history.go(-1); </script>
        <?php
	}		
}
elseif($status=="hapus" ) {
	$query= "DELETE from seleksi_kriteria where id_seleksi_kriteria='$id' ";
	$koneksi->query($query);
	header("location:data_seleksi_kriteria.php");
}

?>