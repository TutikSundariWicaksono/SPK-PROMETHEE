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
                    <a style="text-decoration:none" href="data_kriteria.php" class="active"><span class="las la-clipboard-list"></span><span>Kriteria</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_seleksi_kriteria.php"><span class="las la-clipboard-list"></span><span>Bobot Kriteria</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_alternatif.php"><span class="las la-user-circle"></span><span>Data Karyawan</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_alternatif_seleksi.php"><span class="las la-user-circle"></span><span>Karyawan Yang Diseleksi</span></a>
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

                Data Kriteria
            </h2>

            <h4>
                <img src="./assets/img/manager.png" width="40px" height="40px" alt="" class="rounded-circle mr-2 profile-picture" />

                Hi, <?php echo $_SESSION['username']; ?>
            </h4>
        </header>
        <main style="background-color: #ffffff;">
        <?php 
$txtcari=antiinjec($koneksi,@$_POST['txtcari']);
?>
<form method="post" action="#" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%"><input class="form-control" name="txtcari" type="text" placeholder="Pencarian" size="30" value="<?php echo"$txtcari"; ?>"/></td>
    <td width="77%"><input name="" class="btn btn-primary" type="submit" value="Cari"/></td>
  </tr>
</table>
</form>
<br>
<table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0" >
  <tr>
  	<th width="2%">No.</th>
    <th width="30%">Kriteria</th>
    <th width="20%">Preferensi (Min/Max)</th>
    <th width="20%">Tipe Preferensi</th>
    <th width="15%">Nilai Min (Q)</th>
    <th width="20%">Nilai Max (P)</th>
	<script type="text/javascript">
    function konTambah() {
            window.location = "input_kriteria.php?act=tambah";
    }
    </script>
    <th width="20%" align="center"><input type='button' style="font-size:12px;" class="btn btn-primary" value='Tambah' onclick="konTambah()"></th>
  </tr>
<?php
$halaman=@$_GET['halaman'];
$perhalaman=15;
@$kat=@$_GET['kat'];
$query_part ="SELECT id_kriteria, kriteria, preferensi, tipe_preferensi, nilai_q, nilai_p FROM kriteria
	    	  WHERE (kriteria LIKE '%$txtcari%' OR preferensi LIKE '%$txtcari%')";
$hasil_part = $koneksi->query($query_part);
$jmlhalaman_part = ceil(mysqli_num_rows($hasil_part)/$perhalaman);

if (!isset($halaman))
{
$halaman=0;
}
else
{
$halaman=$halaman-1;
}
$halamannya = $halaman * $perhalaman;

$nomor=$halamannya;
$query="SELECT id_kriteria, kriteria, preferensi, tipe_preferensi, nilai_q, nilai_p FROM kriteria
	    	  WHERE (kriteria LIKE '%$txtcari%' OR preferensi LIKE '%$txtcari%') ORDER BY id_kriteria ASC LIMIT $halamannya, $perhalaman" ;
$hquery=$koneksi->query($query);
while ($dataquery=mysqli_fetch_array($hquery)) {
$nomor=$nomor+1;
?>
<script type="text/javascript">
function konfirmasi<?php echo $dataquery[0]; ?>() {
	var answer = confirm("Anda yakin akan menghapus data ini?")
	if (answer){
		window.location = "aksi_kriteria.php?act=hapus&id=<?php echo"$dataquery[0]"; ?>";
	}
}
</script>
  <tr>
  	<td><?php echo"$nomor"; ?></td>
    <td><?php echo"$dataquery[kriteria]"; ?></td>
    <td><?php echo"$dataquery[preferensi]"; ?></td>
    <td>
	<?php 
	if($dataquery['tipe_preferensi']==1) { echo "Kriteria Biasa"; } 
	elseif($dataquery['tipe_preferensi']==2) { echo "Kriteria Quasi"; } 
	elseif($dataquery['tipe_preferensi']==3) { echo "Kriteria Linear"; } 
	elseif($dataquery['tipe_preferensi']==4) { echo "Kriteria Level"; } 
	elseif($dataquery['tipe_preferensi']==5) { echo "Kriteria Linear &amp; Area Tidak Berbeda"; } 
	?>
    </td>
    <td><?php echo"$dataquery[nilai_q]"; ?></td>
    <td><?php echo"$dataquery[nilai_p]"; ?></td>
    <td align="center">
    <a href="input_kriteria.php?act=edit&id=<?php echo"$dataquery[0]"; ?>">
    <img src="./images/bt_edit.png" width="30" alt="Ubah" border="0" title="Ubah Data" style="float:left;"/>
    </a>
    <img src="./images/bt_del.png" width="30" alt="Hapus" border="0" title="Hapus Data" style="float:left; cursor:pointer;" onclick="konfirmasi<?php echo $dataquery[0]; ?>()"/>
    </td>
  </tr>
<?php
}
?>
</table>
<div class="mb-3">
		<div style="padding:4px; margin:1px; border:1px solid; border-color:#999999; background-color:#DD2F6E; color:#CCCCCC; float:left;">Halaman :</div> 
          <?php
			for($j=1;$j<($jmlhalaman_part+1);$j++)
			{
			?>
			<div style="padding:4px; margin:1px; border:1px solid; border-color:#77BBFF; <?php if (($halaman+1)==$j) { echo"background-color:#FFF"; } else {  echo"background-color:#B0D8FF"; } ?>; float:left;"><a href="?page=kriteria&halaman=<?php echo"$j"; ?><?php if(@$kat<>"") { echo"&kat=@$kat"; } ?>" title="Halaman : <?php echo"$j"; ?>" style="text-decoration:none; color:#06C;"><?php echo"$j"; ?></a></div>
			<?php }
		?>
</div>
        </main>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./assets/js/scripts.js"></script>
    </body>
</html>
