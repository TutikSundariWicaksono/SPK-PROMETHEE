<?php
include "./config/koneksi.php";

//ambil data yang didapat dari form
$id=@$_REQUEST['id'];
$status=@$_GET['act'];

$id_alternatif=@$_POST['id_alternatif'];
$seleksi=@$_POST['seleksi'];

if($status=="tambah" ) {
	$jml=count($id_alternatif);
	for($i=0; $i<$jml; $i++) {
		
		$query= "INSERT INTO seleksi_alternatif (id_seleksi, id_alternatif)
			 	 VALUES ('$seleksi','$id_alternatif[$i]')";
		$koneksi->query($query);
		
	}
	header("location:data_alternatif_seleksi.php");

}
elseif($status=="hapus" ) {
	
	$query= "DELETE from seleksi_alternatif where id_seleksi_alternatif='$id' ";
	$koneksi->query($query);
	
	header("location:data_alternatif_seleksi.php");
}
?>


