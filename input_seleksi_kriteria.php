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
        <script type='text/javascript' src='./js/jquery.min.js?ver=3.1.2'></script>
<script type="text/javascript" src="./js/custom.js"></script>
<script type="text/javascript" src="./js/jquery.validate.js"></script>
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
                    <a style="text-decoration:none" href="data_seleksi_kriteria.php" class="active"><span class="las la-clipboard-list"></span><span>Bobot Kriteria</span></a>
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

                Bobot Kriteria
            </h2>

            <h4>
                <img src="./assets/img/manager.png" width="40px" height="40px" alt="" class="rounded-circle mr-2 profile-picture" />

                Hi, <?php echo $_SESSION['username']; ?>
            </h4>
        </header>
        <main style="background-color: #ffffff;">
        <script type="text/javascript">
// Forms Validator
$j(function() {
   $j("#form1").validate();
});
</script>

<?php
$status=antiinjec($koneksi,@$_GET['act']);

if ($status=="edit") { $id=antiinjec($koneksi,@$_REQUEST['id']); }
if ($status=="tambah") { $id=0; }
	$query="SELECT id_seleksi_kriteria, id_seleksi, id_kriteria, bobot FROM seleksi_kriteria WHERE id_seleksi_kriteria='$id'" ;
	$hquery=$koneksi->query($query);
	$dataquery=mysqli_fetch_array($hquery);
?>
<h1 style="font-size:40px; text-align: center;"><?php if($status=="edit") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Bobot Kriteria</h1>
<br>
<div class="container-fluid">
<form action="aksi_seleksi_kriteria.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1">
                              <table class="table table-bordered col-4 mx-auto">
                                <tr>
                                <input type="hidden" name="id" value="<?php echo @$dataquery['id_seleksi_kriteria']; ?>" />
                                  <th scope="row">Nama Seleksi</th>
                                  <td><select name="seleksi" class="form-control">
                                  <?php
        $q_bea="SELECT id_seleksi, seleksi, tahun FROM seleksi ORDER BY tahun DESC, seleksi ASC" ;
        $h_bea=$koneksi->query($q_bea);
        while($d_bea=mysqli_fetch_array($h_bea)) {
    	?>
		<option value="<?php echo $d_bea[0]; ?>" <?php if($d_bea[0]==@$dataquery['id_seleksi']) { echo "selected"; } ?>><?php echo $d_bea[2]; ?> - <?php echo $d_bea[1]; ?></option>
        <?php } ?>
                                  </select>
                                  </td>
                                </tr>
                                <tr>
                                  <th scope="row">Nama Kriteria</th>
                                  <td><select name="kriteria" class="form-control">
                                  <?php
        $q_kri="SELECT id_kriteria, kriteria FROM kriteria ORDER BY kriteria ASC" ;
        $h_kri=$koneksi->query($q_kri);
        while($d_kri=mysqli_fetch_array($h_kri)) {
    	?>
		<option value="<?php echo $d_kri[0]; ?>" <?php if($d_kri[0]==@$dataquery['id_kriteria']) { echo "selected"; } ?>><?php echo $d_kri[1]; ?></option>
        <?php } ?>
                                  </select>
                                  </td>
                                </tr>
                                <tr>
                                  <th scope="row">Bobot Kriteria</th>
                                  <td><input name="bobot" type="text" maxlength="3" value="<?php echo @$dataquery['bobot']; ?>" class="form-control required number"></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><input type="submit" class="form-control btn btn-primary" name="simpan" value="Simpan" /></td>
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