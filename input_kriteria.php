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
        <script type="text/javascript">
// Forms Validator
$j(function() {
   $j("#form1").validate();
});
</script>

<?php
$status=antiinjec($koneksi,@$_GET['act']);

if ($status=="edit") { $id=@$_REQUEST['id']; }
if ($status=="tambah") { $id=0; }
	$query="SELECT id_kriteria, kriteria, preferensi, tipe_preferensi, nilai_q, nilai_p FROM kriteria WHERE id_kriteria='$id'" ;
	$hquery=$koneksi->query($query);
	$dataquery=mysqli_fetch_array($hquery);
?>
<h1 style="font-size:40px; text-align: center;"><?php if($status=="edit") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Data Kriteria</h1>
<br>
<div class="container-fluid">
<form action="aksi_kriteria.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1">
                              <table class="table table-bordered col-4 mx-auto">
                                <tr>
                                <input type="hidden" name="id" value="<?php echo"$dataquery[id_kriteria]"; ?>" />
                                  <th scope="row">Nama Kriteria</th>
                                  <td><input class="form-control required" name="kriteria" type="text" maxlength="50" value="<?php echo @$dataquery['kriteria']; ?>" /></td>
                                </tr>
                                <tr>
                                  <th scope="row">Preferensi (Min/Max)</th>
                                  <td><select name="preferensi" class="form-control">
                                    <option value="Min" <?php if(@$dataquery['preferensi']=="Min") { echo "selected"; } ?>>Min</option>
        	                        <option value="Max" <?php if(@$dataquery['preferensi']=="Max") { echo "selected"; } ?>>Max</option>
                                  </select>
                                  </td>
                                </tr>
                                <tr>
                                  <th scope="row">Tipe Preferensi</th>
                                  <td><select name="tipe_preferensi" class="form-control">
                                    <option value="1" <?php if(@$dataquery['tipe_preferensi']==1) { echo "selected"; } ?>>Kriteria Biasa</option>
        	                        <option value="2" <?php if(@$dataquery['tipe_preferensi']==2) { echo "selected"; } ?>>Kriteria Quasi</option>
        	                        <option value="3" <?php if(@$dataquery['tipe_preferensi']==3) { echo "selected"; } ?>>Kriteria Linear</option>
        	                        <option value="4" <?php if(@$dataquery['tipe_preferensi']==4) { echo "selected"; } ?>>Kriteria Level</option>
        	                        <option value="5" <?php if(@$dataquery['tipe_preferensi']==5) { echo "selected"; } ?>>Kriteria Linear &amp; Area Tidak Berbeda</option>
                                  </select>
                                  </td>
                                </tr>
                                <tr>
                                  <th scope="row">Nilai Min (Q)</th>
                                  <td><input name="nilai_q" type="text" maxlength="5" value="<?php echo @$dataquery['nilai_q']; ?>" class="form-control required"></td>
                                </tr>
                                <tr>
                                  <th scope="row">Nilai Max (P)</th>
                                  <td><input name="nilai_p" type="text" maxlength="5" value="<?php echo @$dataquery['nilai_p']; ?>" class="form-control required"></td>
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