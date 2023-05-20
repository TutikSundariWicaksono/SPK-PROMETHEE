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
                    <a style="text-decoration:none" href="data_seleksi.php" class="active"><span class="las la-clipboard-list"></span><span>Seleksi</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_divisi.php" ><span class="las la-clipboard-list"></span><span>Data Divisi</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_kriteria.php"><span class="las la-clipboard-list"></span><span>Kriteria</span></a>
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

                Data Seleksi
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
	$query="SELECT id_seleksi, seleksi, tahun, keterangan FROM seleksi WHERE id_seleksi='$id'" ;
	$hquery=$koneksi->query($query);
	$dataquery=mysqli_fetch_array($hquery);
?>
<h1 style="font-size:40px; text-align: center;"><?php if($status=="edit") { echo "Ubah"; } elseif ($status=="tambah") { echo "Tambah"; } ?> Data Seleksi</h1>
<br>
<div class="container-fluid">
<form action="aksi_seleksi.php?act=<?php echo"$status"; ?>" method="post" enctype="multipart/form-data" id="form1" class="card card-body col-4 mx-auto">
                            <div class="mb-3">
                            <input type="hidden" name="id" value="<?php echo"$dataquery[id_seleksi]"; ?>" />
                            <label for="seleksi" class="form-label">Nama Seleksi</label>
                            <input type="text" class="form-control required" maxlength="50" name="seleksi" value="<?php echo @$dataquery['seleksi']; ?>"/>
                            </div>
                            <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="text" name="tahun" maxlength="4" class="form-control col-12 required number" value="<?php echo @$dataquery['tahun']; ?>">
                            </div>
                            <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" cols="30" rows="3"><?php echo @$dataquery['keterangan']; ?></textarea>
                            </div>
                            <button type="submit" name="simpan" value="Simpan" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
        </main>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./assets/js/scripts.js"></script>
    </body>
</html>