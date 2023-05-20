<?php
include "./config/koneksi.php";
include("./config/library.php");
if (isset($_POST['button']))
	{
		$username=antiinjec($koneksi, $_POST['username']);
		$password=md5(antiinjec($koneksi, $_POST['password']));
		$querylogin = mysqli_query($koneksi, "SELECT id_pengguna, nama, username, peran FROM pengguna WHERE username='$username' AND password='$password'");
		if ($datalogin = mysqli_fetch_array($querylogin))
		{
			session_start();
			$_SESSION['username'] = $datalogin['nama'];
			$_SESSION['username'] = $datalogin['username'];
			$_SESSION['peran'] = $datalogin['peran'];
			header("location:index.php");	
		}
		else
		{
			echo "<script>alert('Username atau Password Anda Salah!') </script>";
			header("location:login.php?pesan=Login Gagal");
		}
	}
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Login SPK PROMETHEE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./assets/css/style.css">
	<link rel="icon" href="./assets/img/dss.png" type="image/png">
	</head>
	<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
				<img src="./images/jnt.png" width="350" height="85">
				<br>
				<br>
					<h2 class="heading-section">SISTEM PENDUKUNG KEPUTUSAN</h2>
					<h2 class="heading-section">PT. SHEN MAKMUR SENTOSA</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
				
		      	<form action="" method="post" enctype="multipart/form-data" class="signin-form">
		      		<div class="form-group">
		      			<input type="text" name="username" maxlength="100" class="form-control" placeholder="Username" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" name="password" type="password" maxlength="100" class="form-control" placeholder="Password" required>
	            </div>
	            <div class="form-group">
	            	<button type="submit" name="button" id="button" class="form-control btn btn-primary submit px-3">Login</button>
	            </div>
	          </form>
			  <br>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="./assets/js/jquery.min.js"></script>
  <script src="./assets/js/popper.js"></script>
  <script src="./assets/js/bootstrap.min.js"></script>
  <script src="./assets/js/main.js"></script>

	</body>
</html>