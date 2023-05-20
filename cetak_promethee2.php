<?php
include "./config/library.php";
include "./config/koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hasil PROMETHEE II</title>
<link rel="icon" href="./assets/img/dss.png" type="image/png">
</head>

<body style="font-family:Arial, Helvetica, sans-serif; font-size:11px;" onload="print()">

<script type="text/javascript" src="js/cek_seleksi.js"></script>
<h3>Hasil Ranking Berdasarkan PROMETHEE II</h3>
<?php

$seleksi=antiinjec($koneksi,@$_POST['seleksi']);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="13%">Nama Seleksi</td>
    <td width="1%">:</td>
    <td width="60%">
    	<?php 
		$q_per="SELECT id_seleksi, seleksi, tahun FROM seleksi WHERE id_seleksi='$seleksi'";
		$h_per=$koneksi->query($q_per);
		$d_per=mysqli_fetch_array($h_per);
		echo $d_per['seleksi'];
		?>
            	
    </td>
    <td width="26%">&nbsp;</td>
  </tr>
  <tr>
    <td>Tahun</td>
    <td>:</td>
    <td>
    	<?php echo $d_per['tahun']; ?>
    </td>
    <td>&nbsp;</td>
  </tr>
</table>

<br>
<style>
	.test table { border:1px solid #000000; }
	.test table tr td { border:1px dotted #333333; }
	.test table tr th { border:1px dotted #333333; }
	.okok { background-color:#DDD; color:#09C; }
</style>
<div class="test">
<?php
if($seleksi!="") {	
?>
<p style="margin-bottom:10px; color:#333;">Karyawan dengan nilai Net Flow (NF) paling besar merupakan karyawan terbaik.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <th width="34" style="vertical-align:middle;">No.</th>
    <th width="132" style="vertical-align:middle;">NIK</th>
    <th width="251" style="vertical-align:middle;">Nama Karyawan</th>
    <th width="81" style="vertical-align:middle;">NF</th>
    <th width="732" style="vertical-align:middle;">Rank</th>
  </tr>
  
<?php
$no=0;
$q_pes1="SELECT  a.id_alternatif, a.nik, a.alternatif, c.id_seleksi_alternatif, d.nilai_lf, d.nilai_ef, d.nilai_nf FROM alternatif as a, seleksi_alternatif as c, hasil_akhir as d
		 WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND c.id_seleksi_alternatif=d.id_seleksi_alternatif ORDER BY d.nilai_nf DESC";
$h_pes1=$koneksi->query($q_pes1);
while ($d_pes1=mysqli_fetch_array($h_pes1)){
$no=$no+1;
?>
  <tr>
    <td><?php echo"$no"; ?></td>
    <td><?php echo"$d_pes1[nik]"; ?></td>
    <td><?php echo"$d_pes1[alternatif]"; ?></td>
    <td><?php echo"$d_pes1[nilai_nf]"; ?></td>
    <td><?php echo"$no"; ?></td>
  </tr>
<?php } ?>
    <tr>
      <td colspan="5">
      </td>
    </tr>
</table>
</div>
<?php } ?>
</body>