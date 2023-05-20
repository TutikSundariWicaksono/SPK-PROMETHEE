<?php
include "./config/library.php";
include "./config/koneksi.php";

//ambil data yang didapat dari form
$id=antiinjec($koneksi,@$_REQUEST['id']);
$status=antiinjec($koneksi,@$_GET['act']);

$seleksi=antiinjec($koneksi,@$_POST['seleksi']);
$nilai=@$_POST['nilai'];

$queryX="SELECT a.id_alternatif, a.nik, a.alternatif, c.id_seleksi_alternatif FROM alternatif as a, seleksi_alternatif as c
		 WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' ORDER BY c.id_seleksi_alternatif ASC";
$hqueryX=$koneksi->query($queryX);
while ($dquX=mysqli_fetch_array($hqueryX)){
	$urut=0;
	$qk2="SELECT a.*, b.kriteria FROM seleksi_kriteria as a, kriteria as b WHERE a.id_kriteria=b.id_kriteria AND a.id_seleksi='$seleksi'";
	$hk2=$koneksi->query($qk2);
	while($dk2=mysqli_fetch_array($hk2)){
		//Nilai Kriteria
		$isi_nilai=$nilai[$dk2['id_seleksi_kriteria']][$dquX['id_seleksi_alternatif']];
		
		//Cek apakah nilai pernah disimpan
		$qn="SELECT count(*) FROM nilai_kriteria WHERE id_seleksi_kriteria='$dk2[0]' and id_seleksi_alternatif='$dquX[id_seleksi_alternatif]'";
		$hn=$koneksi->query($qn);
		$dn=mysqli_fetch_array($hn);
		if($dn[0]==0) {
			$query= "INSERT INTO nilai_kriteria (id_seleksi_alternatif, id_seleksi_kriteria, nilai)
					 VALUES ('$dquX[id_seleksi_alternatif]','$dk2[id_seleksi_kriteria]','$isi_nilai')";
			$koneksi->query($query);
		} else {
			$query= "UPDATE nilai_kriteria SET nilai='$isi_nilai'
					 WHERE id_seleksi_alternatif='$dquX[id_seleksi_alternatif]' AND id_seleksi_kriteria='$dk2[id_seleksi_kriteria]'";
			$koneksi->query($query);
		}
	}
}

?>
<form action="data_nilai.php" name="fr_back" id="fr_back" method="post">
    <input type="hidden" name="seleksi" value="<?php echo $seleksi; ?>" />
</form>
<script type="text/javascript">
  alert('Data sudah berhasil disimpan.');
  document.getElementById('fr_back').submit(); // SUBMIT FORM
</script>