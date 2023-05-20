<?php
session_start();
include "./config/library.php";
include "./config/koneksi.php";
$user = $_SESSION['username'];

if ($user == "")
{
    header("location:login.php?pesan=Belum Login");
}
else{
    $queryuser="SELECT * FROM pengguna WHERE username='$user'";
    $hasiluser=$koneksi->query($queryuser);
    $datauser=mysqli_fetch_array($hasiluser);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SPK - PROMETHEE</title>
        <link href="./assets/css/styles.css" rel="stylesheet" />
        <link href="./assets/css/style2.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
		<link rel="icon" href="./assets/img/dss.png" type="image/png">
    </head>
    <body">
         <input type="checkbox" id="nav-toggle">
        <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"></span> <span style="font-size: 25px;">SPK PROMETHEE</span>  </h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a style="text-decoration:none" href="./" ><span class="las la-igloo"></span><span>Dashboard</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_seleksi.php" ><span class="las la-clipboard-list"></span><span>Seleksi</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_divisi.php" ><span class="las la-clipboard-list"></span><span>Data Divisi</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_kriteria.php" ><span class="las la-clipboard-list"></span><span>Kriteria</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_seleksi_kriteria.php" ><span class="las la-clipboard-list"></span><span>Bobot Kriteria</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_alternatif.php" ><span class="las la-user-circle"></span><span>Data Karyawan</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_alternatif_seleksi.php" ><span class="las la-user-circle"></span><span>Karyawan Yang Diseleksi</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_nilai.php" ><span class="las la-clipboard-list"></span><span>Data Penilaian</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_seleksi_hasil.php" class="active"><span class="las la-clipboard-list"></span><span>Perhitungan Seleksi</span></a>
                </li>
				<?php if ($datauser['peran']==1) { ?>
    <li>
        <a style="text-decoration:none" href="data_pengguna.php"><span class="las la-user-circle"></span><span>Pengguna</span></a>
    </li>
<?php
}
?> 
                <li>
                  <a style="text-decoration:none" href="logout.php"><span class="las la-user-circle"></span><span>Logout</span></a>
                </li>
            </ul>
        </div>
        </div>


        <div class="main-content">
        <header> 
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>

                Proses PROMETHEE
            </h2>

            <h4>
                <img src="./assets/img/manager.png" width="40px" height="40px" alt="" class="rounded-circle mr-2 profile-picture" />

                Hi, <?php echo $_SESSION['username']; ?>
            </h4>
        </header>
        <main style="background-color: #ffffff;">
		<?php 
$seleksi	=antiinjec($koneksi,@$_POST['seleksi']);
$stat		=antiinjec($koneksi,@$_REQUEST['stat']);
$kriteria	=antiinjec($koneksi,@$_POST['kriteria']);
$urut		=antiinjec($koneksi,@$_POST['urut']);
if($urut=="") { $urut="DESC"; }

?>
<form method="post" action="#" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15%" style="font-size:17px;">Nama Seleksi :</td>
    <td width="30%">
    <select name="seleksi" class="form-control">
    	<?php 
		$q_bea="SELECT id_seleksi, seleksi, tahun FROM seleksi ORDER BY tahun DESC, seleksi ASC";
		$h_bea=$koneksi->query($q_bea);
		while($d_bea=mysqli_fetch_array($h_bea)){
		?>
			<option value="<?php echo $d_bea['id_seleksi']; ?>" <?php if($d_bea['id_seleksi']==$seleksi) { echo "selected"; } ?>>
            	<?php echo $d_bea['tahun']." - ".$d_bea['seleksi']; ?>
            </option>
        <?php		
		}
		?>
    </select>
    </td>
    <td width="82%"><input name="proses_hitung" type="submit" value="Proses PROMETHEE" class="btn btn-primary"/></td>
  </tr>
</table>
</form>
<br>
<?php
if($seleksi<>"" && @$_POST['proses_hitung']) {

//Tampilkan Nilai yang sudah diinputkan beserta data kriteria
$qk="SELECT a.*, b.kriteria, b.preferensi, b.tipe_preferensi, b.nilai_q, b.nilai_p FROM seleksi_kriteria as a, kriteria as b WHERE a.id_kriteria=b.id_kriteria AND a.id_seleksi='$seleksi'";
$hk=$koneksi->query($qk);
$jmlkkolom=mysqli_num_rows($hk);
?>
<table width="100%" class="table table-bordered" cellspacing="0" cellpadding="4">
  <tr>
    <th width="24" rowspan="2" style="vertical-align:middle;">No.</th>
    <th width="74" rowspan="2" style="vertical-align:middle;">NIK</th>
    <th width="162" rowspan="2" style="vertical-align:middle;">Karyawan</th>
    <th colspan="<?php echo $jmlkkolom; ?>"><div style="text-align:center;">Nilai Kriteria</div></th>
    </tr>
  <tr>
    <?php 
		while($dk=mysqli_fetch_array($hk)){
	?>
    <th width="97">
    <div style="text-align:center;">
		<?php echo "$dk[kriteria]"; ?><br />
        <span style="color:#000; font-size:11px;">
        (<?php 
		if($dk['tipe_preferensi']==1) { echo "Kriteria Biasa"; } 
		elseif($dk['tipe_preferensi']==2) { echo "Kriteria Quasi"; } 
		elseif($dk['tipe_preferensi']==3) { echo "Kriteria Linear"; } 
		elseif($dk['tipe_preferensi']==4) { echo "Kriteria Level"; } 
		elseif($dk['tipe_preferensi']==5) { echo "Kriteria Linear &amp; Area Tidak Berbeda"; } 
		elseif($dk['tipe_preferensi']==6) { echo "Kriteria Gausian"; }
		?>)
        </span><br />
        <span style="font-size:11px; line-height:15px;">
        <?php echo "$dk[preferensi]"; ?>, q:<?php echo "$dk[nilai_q]"; ?>, p:<?php echo "$dk[nilai_p]"; ?><br />
		Bobot:<?php echo "$dk[bobot]"; ?><br />
        </span>
    </div>
    </th>
    <?php } ?>
  </tr>
  
<?php
$no=0;
$queryX="SELECT a.id_alternatif, a.nik, a.alternatif, c.id_seleksi_alternatif FROM alternatif as a, seleksi_alternatif as c
		 WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' ORDER BY c.id_seleksi_alternatif ASC";
$hqueryX=$koneksi->query($queryX);
while ($dquX=mysqli_fetch_array($hqueryX)){
	$no=$no+1;
?>
  <tr>
    <td><?php echo"$no"; ?></td>
    <td><?php echo"$dquX[nik]"; ?></td>
    <td><?php echo"$dquX[alternatif]"; ?></td>
    <?php
		$urut=0;
		$qk2="SELECT a.*, b.kriteria FROM seleksi_kriteria as a, kriteria as b WHERE a.id_kriteria=b.id_kriteria AND a.id_seleksi='$seleksi'";
		$hk2=$koneksi->query($qk2);
		while($dk2=mysqli_fetch_array($hk2)){
			$urut=$urut+1;
    
		//Ambil Nilai yang sudah disimpan (lalu tampilkan)
		$qn="SELECT nilai FROM nilai_kriteria WHERE id_seleksi_kriteria='$dk2[0]' and id_seleksi_alternatif='$dquX[id_seleksi_alternatif]'";
		$hn=$koneksi->query($qn);
		$dn=mysqli_fetch_array($hn);
		?>
        <td>
        <div style="text-align:center;">
        <?php echo number_format(@$dn['nilai'],0,',','.'); ?>
        </div>
        </td>
    <?php } ?>
    </tr>
<?php } ?>
    <tr>
      <td colspan="<?php echo $jmlkkolom; ?>"><?php if($stat=="ok") { ?> <span style="font-size:14px; color:#0066CC; font-weight:bold;"><?php echo "Data berhasil disimpan."; ?></span><?php } ?> </td>
    </tr>
</table>
	
<?php
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
//AWAL METODE PROMETHEE
//Ubah semua status pada hasil awal menjadi NOL
$q_ubah="UPDATE hasil_awal SET status=0 WHERE id_seleksi='$seleksi'";
$koneksi->query($q_ubah);

//1. Menghitung derajat preferensi dan index preferensi multikriteria  ||>>>>>>>
$q_alternatif="SELECT b.id_seleksi_alternatif FROM alternatif as a, seleksi_alternatif as b
		 WHERE a.id_alternatif=b.id_alternatif AND b.id_seleksi='$seleksi' ORDER BY b.id_seleksi_alternatif ASC";
$h_alternatif=$koneksi->query($q_alternatif);
while ($d_alternatif=mysqli_fetch_array($h_alternatif)){
	//Perulangan untuk menghitung preferensi (membandingkan setiap alternatif/alternatif)
	$q_alternatif_in="SELECT b.id_seleksi_alternatif FROM alternatif as a, seleksi_alternatif as b
			 WHERE a.id_alternatif=b.id_alternatif AND b.id_seleksi='$seleksi' AND b.id_seleksi_alternatif<>'$d_alternatif[0]' 
			 ORDER BY b.id_seleksi_alternatif ASC";
	$h_alternatif_in=$koneksi->query($q_alternatif_in);
	while ($d_alternatif_in=mysqli_fetch_array($h_alternatif_in)){
		$index_preferensi=0;	//Untuk menyimpan index preferensi
		//Lihat data kriteria yang digunakan untuk seleksi
		$q_kriteria="SELECT a.*, b.kriteria, b.preferensi, b.tipe_preferensi, b.nilai_q, b.nilai_p
					 FROM seleksi_kriteria as a, kriteria as b WHERE a.id_kriteria=b.id_kriteria AND a.id_seleksi='$seleksi'";
		$h_kriteria=$koneksi->query($q_kriteria);
		$jml_kriteria=mysqli_num_rows($h_kriteria);
		while($d_kriteria=mysqli_fetch_array($h_kriteria)){
			//Ambil nilai kriteria untuk setiap alternatif #1
			$q_nilai="SELECT nilai FROM nilai_kriteria WHERE id_seleksi_kriteria='$d_kriteria[0]' and id_seleksi_alternatif='$d_alternatif[0]'";
			$h_nilai=$koneksi->query($q_nilai);
			$d_nilai=mysqli_fetch_array($h_nilai);
			$nilai_1=$d_nilai[0]; //Nilai Alternatif #1
			
			//Ambil nilai kriteria untuk setiap alternatif #2
			$q_nilai="SELECT nilai FROM nilai_kriteria WHERE id_seleksi_kriteria='$d_kriteria[0]' and id_seleksi_alternatif='$d_alternatif_in[0]'";
			$h_nilai=$koneksi->query($q_nilai);
			$d_nilai=mysqli_fetch_array($h_nilai);
			$nilai_2=$d_nilai[0]; //Nilai Alternatif #2
			
			//Cek untuk Min/Max
			$q_cek_minmax="SELECT count(*) as jml FROM hasil_awal WHERE id_seleksi='$seleksi' AND status=1
						   AND id_seleksi_alternatif_1='$d_alternatif_in[0]' AND id_seleksi_alternatif_2='$d_alternatif[0]'";
			$h_cek_minmax=$koneksi->query($q_cek_minmax);
			$d_cek_minmax=mysqli_fetch_array($h_cek_minmax);
			if($d_cek_minmax[0]==0) { $stat_mm=1; } else { $stat_mm=0; } //Urut pertama atau tidak
			//echo $q_cek_minmax."<br>";

			$d=$nilai_1-$nilai_2;  //Selisih nilai kriteria
			//Hitung hasil derajat preferensi setiap kriteria
			if($d_kriteria['tipe_preferensi']==1) { 
				//Kriteria Biasa 
				if($d<=0) { $Hd=0; }
				elseif($d>0) { $Hd=1; }
			} elseif($d_kriteria['tipe_preferensi']==2) { 
				//Kriteria Quasi
				if($d<=$d_kriteria['nilai_q']) { $Hd=0; }
				elseif($d>$d_kriteria['nilai_q']) { $Hd=1; }
			} elseif($d_kriteria['tipe_preferensi']==3) { 
				//Kriteria Linear
				if($d<0) { $Hd=0; }
				elseif($d>=0 && $d<=$d_kriteria['nilai_p']) { $Hd=$d/$d_kriteria['nilai_p']; }
				elseif($d>$d_kriteria['nilai_p']) { $Hd=1; }
			} elseif($d_kriteria['tipe_preferensi']==4) { 
				//Kriteria Level
				if($d<=$d_kriteria['nilai_q']) { $Hd=0; }
				elseif($d>$d_kriteria['nilai_q'] && $d<=$d_kriteria['nilai_p']) { $Hd=0.5; }
				elseif($d>$d_kriteria['nilai_p']) { $Hd=1; }
			} elseif($d_kriteria['tipe_preferensi']==5) { 
				//Kriteria Linear dan area tdk berbeda 
				if($d<=$d_kriteria['nilai_q']) { $Hd=0; }
				elseif($d>$d_kriteria['nilai_q'] && $d<=$d_kriteria['nilai_p']) { $Hd=($d-$d_kriteria['nilai_q'])/($d_kriteria['nilai_p']-$d_kriteria['nilai_q']); }
				elseif($d>$d_kriteria['nilai_p']) { $Hd=1; }
			} elseif($d_kriteria['tipe_preferensi']==6) { 
				//Kriteria Gausian
				//BELUM !!!! //DILEWATI DULU
			}
			
			//echo $Hd." - ";
			
			//Gunakan Kaidah Maksimum dan Minimum (Max/Min)
			if($d_kriteria['preferensi']=="Max") {	//Kaidah Maksimum
				//d>=0 dan P(A1, A2)
				if($d>=0 && $stat_mm==1) { $P12=$Hd; }
				//d>=0 dan P(A2, A1)
				elseif($d>=0 && $stat_mm==0) { $P12=0; }
				//d<0 dan P(A1, A2)
				elseif($d<0 && $stat_mm==1) { $P12=0; }
				//d<0 dan P(A2, A1)
				elseif($d<0 && $stat_mm==0) { $P12=$Hd; }
			} elseif($d_kriteria['preferensi']=="Min") { //Kaidah Minimum
				//d>=0 dan P(A1, A2)
				if($d>=0 && $stat_mm==1) { $P12=0;}
				//d>=0 dan P(A2, A1)
				elseif($d>=0 && $stat_mm==0) { $P12=$Hd; }
				//d<0 dan P(A1, A2)
				elseif($d<0 && $stat_mm==1) { $P12=0; }
				//d<0 dan P(A2, A1)
				elseif($d<0 && $stat_mm==0) { $P12=$Hd; }
			}
			//echo $P12." - ";
			
			$index_preferensi=$index_preferensi+($P12*$d_kriteria['bobot']);
		}
		//echo "<hr>";
		
		$index_preferensi=(1/$jml_kriteria)*$index_preferensi;
		
		
		//Simpan Hasil Awal (Nilai Index Preferensi)
		$q_cek="SELECT count(*) as jml FROM hasil_awal WHERE id_seleksi='$seleksi'
				AND id_seleksi_alternatif_1='$d_alternatif[0]' AND id_seleksi_alternatif_2='$d_alternatif_in[0]'";
		//echo $q_cek."<br>";
		$h_cek=$koneksi->query($q_cek);
		$d_cek=mysqli_fetch_array($h_cek);
		if($d_cek[0]==0) {
			$q_simpan="INSERT INTO hasil_awal (id_seleksi_alternatif_1, id_seleksi_alternatif_2, nilai, id_seleksi, status)
					   VALUES ('$d_alternatif[0]', '$d_alternatif_in[0]', '$index_preferensi', '$seleksi', 1)";
			$koneksi->query($q_simpan);
			//echo $q_simpan."<br>";
		} else {
			$q_ubah="UPDATE hasil_awal SET nilai='$index_preferensi', status=1
					   WHERE id_seleksi_alternatif_1='$d_alternatif[0]' AND id_seleksi_alternatif_2='$d_alternatif_in[0]'";
			$koneksi->query($q_ubah);
			//echo $q_ubah."<br>";
		}
		
	}
}
//Akhir Menghitung derajat preferensi dan index preferensi multikriteria  ||>>>>>>>

//Menghitung LF, EF dan NF
$q_alternatif="SELECT b.id_seleksi_alternatif FROM alternatif as a, seleksi_alternatif as b
		 WHERE a.id_alternatif=b.id_alternatif AND b.id_seleksi='$seleksi' ORDER BY b.id_seleksi_alternatif ASC";
$h_alternatif=$koneksi->query($q_alternatif);
$jml_alternatif=mysqli_num_rows($h_alternatif);
while ($d_alternatif=mysqli_fetch_array($h_alternatif)){
	$LF=0;
	$EF=0;
	$NF=0;
	
	$q_lf="SELECT SUM(nilai) FROM hasil_awal WHERE id_seleksi_alternatif_1='$d_alternatif[0]' AND id_seleksi='$seleksi' AND status=1";
	$h_lf=$koneksi->query($q_lf);
	$d_lf=mysqli_fetch_array($h_lf);
	$LF=(1/($jml_alternatif-1))*$d_lf[0];
	
	$q_ef="SELECT SUM(nilai) FROM hasil_awal WHERE id_seleksi_alternatif_2='$d_alternatif[0]' AND id_seleksi='$seleksi' AND status=1";
	$h_ef=$koneksi->query($q_ef);
	$d_ef=mysqli_fetch_array($h_ef);
	$EF=(1/($jml_alternatif-1))*$d_ef[0];

	$NF=$LF-$EF;  //NIlai Net Flow
	
	//Simpan Hasil
	$q_cek="SELECT count(*) as jml FROM hasil_akhir WHERE id_seleksi_alternatif='$d_alternatif[0]'";
	$h_cek=$koneksi->query($q_cek);
	$d_cek=mysqli_fetch_array($h_cek);
	if($d_cek[0]==0) {
		$q_simpan="INSERT INTO hasil_akhir (id_seleksi_alternatif, nilai_lf, nilai_ef, nilai_nf)
				   VALUES ('$d_alternatif[0]', '$LF', '$EF', '$NF')";
		$koneksi->query($q_simpan);
	} else {
		$q_ubah="UPDATE hasil_akhir SET nilai_lf='$LF', nilai_ef='$EF', nilai_nf='$NF'
				   WHERE id_seleksi_alternatif='$d_alternatif[0]'";
		$koneksi->query($q_ubah);
	}
}
//AKHIR METODE PROMETHEE
}


if(@$_POST['proses_hitung'] || @$_POST['proses_lihat']) {	
//Tampilkan Nilai yang sudah diinputkan beserta data kriteria
$qk="SELECT a.id_alternatif, a.nik, a.alternatif, c.id_seleksi_alternatif FROM alternatif as a, seleksi_alternatif as c
		 WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' ORDER BY c.id_seleksi_alternatif ASC";
$hk=$koneksi->query($qk);
$jmlkkolom=mysqli_num_rows($hk);
?>

<style>
.abc th
{
	background-color: #DD2F6E;
	color: black;
	text-align: center;
	vertical-align: bottom;
	height: 100px;
	padding-bottom: 3px;
	padding-left: 5px;
	padding-right: 5px;
	font-weight:bold;
}

.abc .verticalText
{
	text-align: center;
	vertical-align: middle;
	width: 20px;
	margin: 0px;
	padding: 0px;
	padding-left: 3px;
	padding-right: 3px;
	padding-top: 5px;
	white-space: nowrap;
	-webkit-transform: rotate(-60deg); 
	-moz-transform: rotate(-60deg); 
	font-weight:500;         
};


</style>
<div class="abc">
<table width="100%" class="table table-bordered" cellspacing="0" cellpadding="4">
  <tr>
    <th width="24" style="vertical-align:middle;">No.</th>
    <th width="80" style="vertical-align:middle;">NIK</th>
    <th width="162" style="vertical-align:middle;">Karyawan</th>
    <?php 
		while($dk=mysqli_fetch_array($hk)){
	?>
    <th width="741"><div class="verticalText"><?php echo "$dk[alternatif]"; ?></div>
    </th>
    <?php } ?>
    <th width="63" style="vertical-align:middle;">LF</th>
    <th width="68" style="vertical-align:middle;">EF</th>
    <th width="76" style="vertical-align:middle;">NF</th>
  </tr>
  
<?php
$no=0;
$queryX="SELECT a.id_alternatif, a.nik, a.alternatif, c.id_seleksi_alternatif, d.nilai_lf, d.nilai_ef, d.nilai_nf FROM alternatif as a, seleksi_alternatif as c, hasil_akhir as d
		 WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND c.id_seleksi_alternatif=d.id_seleksi_alternatif ORDER BY c.id_seleksi_alternatif ASC";
$hqueryX=$koneksi->query($queryX);
while ($dquX=mysqli_fetch_array($hqueryX)){
	$no=$no+1;
?>
  <tr>
    <td><?php echo"$no"; ?></td>
    <td><?php echo"$dquX[nik]"; ?></td>
    <td><?php echo"$dquX[alternatif]"; ?></td>
    <?php
		$urut=0;
		$qk2="SELECT a.id_alternatif, a.nik, a.alternatif, c.id_seleksi_alternatif FROM alternatif as a, seleksi_alternatif as c
		 WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' ORDER BY c.id_seleksi_alternatif ASC";
		$hk2=$koneksi->query($qk2);
		while($dk2=mysqli_fetch_array($hk2)){
			$urut=$urut+1;
    
		//Ambil Nilai yang sudah disimpan (lalu tampilkan)
		$qn="SELECT nilai FROM hasil_awal WHERE id_seleksi_alternatif_1='$dquX[id_seleksi_alternatif]' and id_seleksi_alternatif_2='$dk2[id_seleksi_alternatif]'";
		$hn=$koneksi->query($qn);
		$dn=mysqli_fetch_array($hn);
		$nilai=0;
		if(@$dn['nilai']=="") { $nilai="-"; } else { $nilai=@$dn['nilai']; }
		?>
        <td>
        <div style="text-align:left;">
        <?php
        if($nilai!="-"){ 
        	echo number_format($nilai, 3, ',', '.'); 
        } else {
        	echo $nilai;
        }
        ?>
        </div>
        </td>
    <?php } ?>
    <td><?php echo number_format($dquX['nilai_lf'], 3, ',', '.'); ?></td>
    <td><?php echo number_format($dquX['nilai_ef'], 3, ',', '.'); ?></td>
    <td><?php echo number_format($dquX['nilai_nf'], 3, ',', '.'); ?></td>
    </tr>
<?php } ?>
	<tr><td colspan="<?php echo $jmlkkolom; ?>"><?php if($stat=="ok") { ?> <span style="font-size:14px; color:#0066CC; font-weight:bold;"><?php echo "Data berhasil disimpan."; ?></span><?php } ?> </td></tr>
</table>
<table>
    <tr>
      <td colspan="3">
      <form action="data_seleksi_rank.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="seleksi" value="<?php echo"$seleksi"; ?>" />
      <input type="submit" name="btn_next" value="Selanjutnya (Hasil Ranking)" class="btn btn-success">
      </form>
      </td>
    </tr>
</table>
</div>
<?php } ?>
        </main>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./assets/js/scripts.js"></script>
    </body>
</html>
