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

                Proses PROMETHEE (Ranking)
            </h2>

            <h4>
                <img src="./assets/img/manager.png" width="40px" height="40px" alt="" class="rounded-circle mr-2 profile-picture" />

                Hi, <?php echo $_SESSION['username']; ?>
            </h4>
        </header>
        <main style="background-color: #ffffff;">
        <?php 
$seleksi=antiinjec($koneksi,@$_POST['seleksi']);

if($seleksi!="") {	
?>
<h3>Hasil Ranking Berdasarkan PROMETHEE I</h3>
<p style="margin-bottom:10px; color:#999;">Karyawan dengan nilai Leaving Flow (LF) paling besar merupakan karyawan terbaik, dan karyawan dengan nilai Entering Flow (EF) paling kecil adalah karyawan terbaik. Jika ranking antara LF dan EF tidak sama maka dilanjutkan ke tahap PROMETHEE II</p>
<table width="100%" class="table table-bordered" cellspacing="0" cellpadding="4">
  <tr>
    <th width="24" style="vertical-align:middle;">No.</th>
    <th width="80" style="vertical-align:middle;">NIK</th>
    <th width="162" style="vertical-align:middle;">Nama Karyawan</th>
    <th width="63" style="vertical-align:middle;">LF</th>
    <th width="63" style="vertical-align:middle;">Rank</th>
    <th width="80" style="vertical-align:middle;">NIK</th>
    <th width="162" style="vertical-align:middle;">Nama Karyawan</th>
    <th width="68" style="vertical-align:middle;">EF</th>
    <th width="76" style="vertical-align:middle;">Rank</th>
  </tr>
  
<?php
$no=0;
$no_i=0;

$queryX="SELECT a.id_alternatif FROM alternatif as a, seleksi_alternatif as c, hasil_akhir as d
		 WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND c.id_seleksi_alternatif=d.id_seleksi_alternatif ORDER BY c.id_seleksi_alternatif ASC";
$hqueryX=$koneksi->query($queryX);
while ($dquX=mysqli_fetch_array($hqueryX)){
$no=$no+1;
?>
  <tr>
  	<?php
    $q_pes1="SELECT a.id_alternatif, a.nik, a.alternatif, c.id_seleksi_alternatif, d.nilai_lf, d.nilai_ef, d.nilai_nf FROM alternatif as a, seleksi_alternatif as c, hasil_akhir as d
             WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND c.id_seleksi_alternatif=d.id_seleksi_alternatif ORDER BY d.nilai_lf DESC LIMIT $no_i,$no";
    $h_pes1=$koneksi->query($q_pes1);
    $d_pes1=mysqli_fetch_array($h_pes1);
	?>
    <td><?php echo"$no"; ?></td>
    <td><?php echo"$d_pes1[nik]"; ?></td>
    <td><?php echo"$d_pes1[alternatif]"; ?></td>
    <td><?php echo number_format($d_pes1['nilai_lf'], 3, ',', '.'); ?></td>
    <td><?php echo"$no"; ?></td>
  	<?php
    $q_pes2="SELECT a.id_alternatif, a.nik, a.alternatif, c.id_seleksi_alternatif, d.nilai_lf, d.nilai_ef, d.nilai_nf FROM alternatif as a, seleksi_alternatif as c, hasil_akhir as d
             WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND c.id_seleksi_alternatif=d.id_seleksi_alternatif ORDER BY d.nilai_ef ASC LIMIT $no_i,$no";
    $h_pes2=$koneksi->query($q_pes2);
    $d_pes2=mysqli_fetch_array($h_pes2);
	?>
    <td><?php echo"$d_pes2[nik]"; ?></td>
    <td><?php echo"$d_pes2[alternatif]"; ?></td>
    <td><?php echo number_format($d_pes2['nilai_ef'], 3, ',', '.'); ?></td>
    <td><?php echo"$no"; ?></td>
    </tr>
<?php  $no_i=$no_i+1; } ?>
</table>
<table>
    <tr>
      <td colspan="9">
      <form action="cetak_promethee1.php" method="post" enctype="multipart/form-data" target="_blank">
      <input type="hidden" name="seleksi" value="<?php echo"$seleksi"; ?>" />
      <input type="submit" name="btn_next" value="Cetak" class="btn btn-primary">
      </form>
      </td>
    </tr>
</table>
<br />
<h3>Hasil Ranking Berdasarkan PROMETHEE II</h3>
<p style="margin-bottom:10px; color:#999;">Karyawan dengan nilai Net Flow (NF) paling besar merupakan karyawan terbaik.</p>
<table width="100%" class="table table-bordered" cellspacing="0" cellpadding="4">
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
    <td><?php echo number_format($d_pes1['nilai_nf'], 3, ',', '.'); ?></td>
    <td><?php echo"$no"; ?></td>
  </tr>
<?php } ?>
</table>
<table>
    <tr>
      <td colspan="5">
      <form action="cetak_promethee2.php" method="post" enctype="multipart/form-data" target="_blank">
      <input type="hidden" name="seleksi" value="<?php echo"$seleksi"; ?>" />
      <input type="submit" name="btn_next" value="Cetak" class="btn btn-primary">
      </form>
      </td>
    </tr>
</table>

<?php } ?>
        </main>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./assets/js/scripts.js"></script>
    </body>
</html>