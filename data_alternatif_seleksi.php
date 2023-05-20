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
$txtcari=antiinjec($koneksi,@$_POST['txtcari']);
$seleksi=antiinjec($koneksi,@$_POST['seleksi']);
?>
<form method="post" action="#" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%"><input class="form-control" name="txtcari" type="text" placeholder="Pencarian" size="30" value="<?php echo"$txtcari"; ?>"/></td>
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
?>
<table width="100%" class="table table-bordered" cellpadding="0" cellspacing="0" >
  <tr>
  	<th width="5%">No.</th>
    <th width="10%">NIK</th>
    <th width="60%">Nama Karyawan</th>
    <th width="30%">Divisi</th>
	<script type="text/javascript">
    function konTambah() {
            window.location = "input_alternatif_seleksi.php?act=tambah";
    }
    </script>
    <th width="20%" align="center">
    <form method="post" enctype="multipart/form-data" action="input_alternatif_seleksi.php?act=tambah">
        <input type="hidden" name="seleksi" value="<?php echo $seleksi; ?>" />
        <input type='submit' style="font-size:12px;" class="btn btn-primary" value='Tambah'>
    </form>
    </th>
  </tr>
<?php
$halaman=@$_GET['halaman'];
$perhalaman=15;
$query_part ="SELECT c.id_seleksi_alternatif, a.id_alternatif, a.nik, a.alternatif, a.id_divisi, b.divisi
			  FROM alternatif as a, seleksi_alternatif as c, divisi as b
	    	  WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND a.id_divisi=b.id_divisi AND
			  		(a.nik LIKE '%$txtcari%' OR a.alternatif LIKE '%$txtcari%' OR b.divisi LIKE '%$txtcari%')";
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
$query="SELECT c.id_seleksi_alternatif, a.id_alternatif, a.nik, a.alternatif, a.id_divisi, b.divisi
FROM alternatif as a, seleksi_alternatif as c, divisi as b
WHERE a.id_alternatif=c.id_alternatif AND c.id_seleksi='$seleksi' AND a.id_divisi=b.id_divisi AND
        (a.nik LIKE '%$txtcari%' OR a.alternatif LIKE '%$txtcari%' OR b.divisi LIKE '%$txtcari%') ORDER BY c.id_seleksi_alternatif ASC, a.nik ASC LIMIT $halamannya, $perhalaman" ;
$hquery=$koneksi->query($query);
while ($dataquery=mysqli_fetch_array($hquery)) {
$nomor=$nomor+1;
?>
<script type="text/javascript">
function konfirmasi<?php echo $dataquery[0]; ?>() {
	var answer = confirm("Anda yakin akan menghapus data ini?")
	if (answer){
		window.location = "aksi_alternatif_seleksi.php?act=hapus&id=<?php echo"$dataquery[id_seleksi_alternatif]"; ?>";
	}
}
</script>
  <tr>
  	<td><?php echo"$nomor"; ?></td>
    <td><?php echo"$dataquery[nik]"; ?></td>
    <td><?php echo"$dataquery[alternatif]"; ?></td>
    <td><?php echo"$dataquery[divisi]"; ?></td>
    <td style="text-align:center;">
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