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

    $data_seleksi = mysqli_query($koneksi,"SELECT * FROM seleksi");
    $jumlah_seleksi = mysqli_num_rows($data_seleksi);
    $data_alternatif = mysqli_query($koneksi,"SELECT * FROM alternatif");
    $jumlah_alternatif = mysqli_num_rows($data_alternatif);
    $data_kriteria = mysqli_query($koneksi,"SELECT * FROM kriteria");
    $jumlah_kriteria = mysqli_num_rows($data_kriteria);
    $data_divisi = mysqli_query($koneksi,"SELECT * FROM divisi");
    $jumlah_divisi = mysqli_num_rows($data_divisi);
    $data_login = mysqli_query($koneksi,"SELECT * FROM pengguna");
    $jumlah_login = mysqli_num_rows($data_login);
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
                    <a style="text-decoration:none" href="./" class="active"><span class="las la-igloo"></span><span>Dashboard</span></a>
                </li>
                <li>
                    <a style="text-decoration:none" href="data_seleksi.php" ><span class="las la-clipboard-list"></span><span>Seleksi</span></a>
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

                Dashboard
            </h2>

            <h4>
                <img src="./assets/img/manager.png" width="40px" height="40px" alt="" class="rounded-circle mr-2 profile-picture" />

                Hi, <?php echo $_SESSION['username']; ?>
            </h4>
        </header>
        <main style="background-color: #ffffff;">
        <div class="cards">
                <div class="card-single" style="background-color: #DD2F6E;">
                    <div>
                        <h1 style="color: #ffffff;"><?php echo $jumlah_seleksi; ?></h1>
                        <span style="color: #ffffff;">Seleksi</span>
                    </div>
                    <div>
                        <span style="color: #ffffff;" class="las la-clipboard-list"></span>
                    </div>
                </div>

                <div class="card-single" style="background-color: #DD2F6E;">
                    <div>
                    <h1 style="color: #ffffff;"><?php echo $jumlah_alternatif; ?></h1>
                    <span style="color: #ffffff;">Karyawan</span>
                    </div>
                    <div>
                        <span style="color: #ffffff;" class="las la-user-circle"></span>
                    </div>
                </div>

                <div class="card-single" style="background-color: #DD2F6E;">
                    <div>
                    <h1 style="color: #ffffff;"><?php echo $jumlah_kriteria; ?></h1>
                    <span style="color: #ffffff;">Kriteria</span>
                    </div>
                    <div>
                        <span style="color: #ffffff;" class="las la-clipboard-list"></span>
                    </div>
                </div>

                <div class="card-single" style="background-color: #DD2F6E;">
                    <div>
                    <h1 style="color: #ffffff;"><?php echo $jumlah_divisi; ?></h1>
                    <span style="color: #ffffff;">Divisi</span>
                    </div>
                    <div>
                        <span style="color: #ffffff;" class="las la-clipboard-list"></span>
                    </div>
                </div>

                <div class="card-single" style="background-color: #DD2F6E;">
                    <div>
                    <h1 style="color: #ffffff;"><?php echo $jumlah_login; ?></h1>
                    <span style="color: #ffffff;">Pengguna</span>
                    </div>
                    <div>
                        <span style="color: #ffffff;" class="las la-user-circle"></span>
                    </div>
                </div>
            </div>
            </main>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./assets/js/scripts.js"></script>
    </body>
</html>