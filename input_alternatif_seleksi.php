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
                    <a style="text-decoration:none" href="data_alternatif_seleksi.php" class="active"><span class="las la-user-circle"></span><span>Karyawan Yang Diseleksi</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_nilai.php"><span class="las la-clipboard-list"></span><span>Data Penilaian</span></a>
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

                Karyawan Yang Diseleksi
            </h2>

            <h4>
                <img src="./assets/img/manager.png" width="40px" height="40px" alt="" class="rounded-circle mr-2 profile-picture" />

                Hi, <?php echo $_SESSION['username']; ?>
            </h4>
        </header>
        <main style="background-color: #ffffff;">
        <?php 
$status=antiinjec($koneksi,@$_GET['act']);
$seleksi=antiinjec($koneksi,@$_POST['seleksi']);
$txtcari="";
?>
<h1 style="font-size:30px;"><?php if($status=="edit") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Data Karyawan Untuk Setiap Seleksi</h1>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="13%" style="font-size:15px;">Nama Seleksi :</td>
    <td width="87%" style="font-size:15px;">
    	<?php 
		$q_per="SELECT id_seleksi, seleksi, tahun FROM seleksi WHERE id_seleksi='$seleksi'";
		$h_per=$koneksi->query($q_per);
		$d_per=mysqli_fetch_array($h_per);
		echo $d_per['tahun']." - ".$d_per['seleksi'];
		?>
    </td>
  </tr>
</table>
<form action="aksi_alternatif_seleksi.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1">
<input type="hidden" name="seleksi" value="<?php echo $seleksi; ?>" />
<table width="100%" class="table table-bordered" cellpadding="0" cellspacing="0" >
  <tr>
  	<th width="3%">No.</th>
    <th width="3%" align="center"><img src="images/check.png" width="15"/></th>
    <th width="10%">NIK</th>
    <th width="60%">Nama Karyawan</th>
    <th width="30%">Divisi</th>
  </tr>
<?php
$nomor=0;
$query="SELECT a.id_alternatif, a.nik, a.alternatif, a.id_divisi, b.divisi
		FROM alternatif as a, divisi as b
	    WHERE a.id_divisi=b.id_divisi AND id_alternatif NOT IN (SELECT id_alternatif FROM seleksi_alternatif WHERE id_seleksi='$seleksi') AND
			  (a.nik LIKE '%$txtcari%' OR a.alternatif LIKE '%$txtcari%' OR b.divisi LIKE '%$txtcari%') ORDER BY nik ASC" ;
$hquery=$koneksi->query($query);
while ($dataquery=mysqli_fetch_array($hquery)) {
$nomor=$nomor+1;
?>
  <tr>
  	<td><?php echo"$nomor"; ?></td>
    <td align="center">
    <input type="checkbox" name="id_alternatif[]" value="<?php echo"$dataquery[id_alternatif]"; ?>" style="width: 20px; height: 20px;"/>
    </td>
    <td><?php echo"$dataquery[nik]"; ?></td>
    <td><?php echo"$dataquery[alternatif]"; ?></td>
    <td><?php echo"$dataquery[divisi]"; ?></td>
  </tr>
<?php
}
?>
<script type="text/javascript">
    function kembali() {
            window.location = "data_alternatif_seleksi.php";
    }
</script>
<br>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="10%"><input type='submit' class="btn btn-primary" value='Simpan'></td>  
  <td width="90%"><input type='button' class="btn btn-danger" value='Kembali' onclick="kembali()"></td>
  </tr>
</table>
</form>
        </main>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./assets/js/scripts.js"></script>
    </body>
</html>