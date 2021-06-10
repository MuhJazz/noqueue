<?php include('super_server.php');
$admin = $_SESSION['sadmin_username'];?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Master_Data.css" />
    <title>Homepage Admin</title>
  </head>
  <body>
    <?php 
  if (!isset($_SESSION['sadmin_username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login_super_admin.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['sadmin_username']);
  	header("location: login_super_admin.php");
  }
?>
    <header class="header">
        <br/>
      <div class="image-avatar">
        <?php echo $admin;?>
        <a id="logout" href="superpage.php?logout='1'" style="color: red">logout</a>
        <img src="images/default.png" alt="image-avatar" />
      </div>
      <div class="container">
        <a href="superpage.php">
          <img class="img-responsive" src="images/logo.png" />
        </a>
      </div>
      <div class="center">
        <span class="judul">NoQ!</span>
        <br />
        <span class="namaresto">Selamat Datang 
          <?php echo $admin;?></span>
      </div>
    </header>
    <div class="content">
        <div class="nav-tabs" style="margin-top: 30px">
        <span>Menambahkan 1 Resto dengan adminnya</span>
        <span>Menambah Lokasi Resto (jika belum ada) -> Menambah Resto -> Menambah Admin</span>
        </div>
        <div class="nav-tabs" style="margin-top: 30px">
        <span>Menghapus 1 Resto dengan adminnya</span>
        <span>Menghapus Admin Resto -> Menghapus Resto</span>
        </div>
        <div class="nav-tabs" style="margin-top: 30px">
        <a href="list_loc_resto.php">lihat lokasi resto</a>
        </div>
        <div class="nav-tabs" style="margin-top: 30px">
        <a href="list_admin.php">lihat admin</a>
        </div>
        <div class="nav-tabs" style="margin-top: 30px">
        <a href="list_resto.php">lihat resto</a>
        </div>
    </div>