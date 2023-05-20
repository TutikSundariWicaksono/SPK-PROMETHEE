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
                    <a style="text-decoration:none" href="data_nilai.php" class="active"><span class="las la-clipboard-list"></span><span>Data Penilaian</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_seleksi_hasil.php"><span class="las la-clipboard-list"></span><span>Perhitungan Seleksi</span></a>
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

                Data Penilaian
            </h2>

            <h4>
                <img src="./assets/img/manager.png" width="40px" height="40px" alt="" class="rounded-circle mr-2 profile-picture" />

                Hi, <?php echo $_SESSION['username']; ?>
            </h4>
        </header>
        <main style="background-color: #ffffff;">

        <?php 
$seleksi=antiinjec($koneksi,@$_POST['seleksi']);
$stat=antiinjec($koneksi,@$_REQUEST['stat']);
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
    <td width="77%"><input name="" type="submit" value="Tampilkan" class="btn btn-primary"/></td>
  </tr>
</table>
</form>
<br>
<?php
if($seleksi=="") {
  $q_bea="SELECT id_seleksi FROM seleksi ORDER BY tahun DESC, seleksi ASC LIMIT 0, 1";
  $h_bea=$koneksi->query($q_bea);
  $d_bea=mysqli_fetch_array($h_bea);
  $seleksi=$d_bea['id_seleksi'];
}


$qk="SELECT a.*, b.kriteria FROM seleksi_kriteria as a, kriteria as b WHERE a.id_kriteria=b.id_kriteria AND a.id_seleksi='$seleksi'";
$hk=$koneksi->query($qk);
$jmlkkolom=mysqli_num_rows($hk);
?>
<style>
	.test table { border:1px solid #000000; }
	.test table tr td { border:1px dotted #333333; }
	.test table tr th { border:1px dotted #333333; }
	.okok { background-color:#DDD; color:#09C; }
</style>
<div class="test2">
<form action="aksi_nilai.php" method="post" enctype="multipart/form-data" id="form1">
<table width="100%" class="table table-bordered" cellspacing="0" cellpadding="4">
  <tr>
    <th width="24" rowspan="2">No.</th>
    <th width="74" rowspan="2">NIK</th>
    <th width="162" rowspan="2">Nama Karyawan</th>
    <th colspan="<?php echo $jmlkkolom; ?>"><div style="text-align:center;">Nilai Kriteria</div></th>
    </tr>
  <tr>
    <?php 
		while($dk=mysqli_fetch_array($hk)){
	?>
    <th width="97"><div style="text-align:center;"><?php echo "$dk[kriteria]"; ?></div></th>
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
        <input class="form-control" type="text" name="nilai[<?php echo $dk2['id_seleksi_kriteria'];?>][<?php echo $dquX['id_seleksi_alternatif']; ?>]" value="<?php echo @$dn['nilai']; ?>">
        </div>
        </td>
    <?php } ?>
    </tr>
<?php } ?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td>
      <input type="hidden" name="seleksi" value="<?php echo"$seleksi"; ?>" />
      <input type="submit" name="btn_simpan" value="Simpan" class="btn btn-success">
      </td>
      <td colspan="<?php echo $jmlkkolom; ?>"><?php if($stat=="ok") { ?> <span style="font-size:14px; color:#0066CC; font-weight:bold;"><?php echo "Data berhasil disimpan."; ?></span><?php } ?> </td>
  </tr>
</table>
</form>
</div>
        </main>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./assets/js/scripts.js"></script>
    </body>
</html>