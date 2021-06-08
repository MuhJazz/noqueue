<?php include('server.php'); 
  $res_id = $_GET['resto_id'];
  $q = mysqli_query($db,"select qr_ovo,qr_gopay from restoran where resto_id='$res_id'");
  $pay= mysqli_fetch_assoc($q);
  $id = $_SESSION['orderid'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
  </head>
  <body>
  <?php 
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
  }
?>
  <header class="header" style="background-image: url(./admin/images/cover-resto.jpeg);height:230 px">
    <?php 
              $user=$_SESSION['username'];
              $query = mysqli_query($db, "select user_image from users where username='$user'");
              while($users = mysqli_fetch_array($query))
              {?> 
                <?php $usr_img = "user_images/".$users['user_image'];
                      $def_img = "user_images/default.png";
                ?>
                <div class="image-avatar">
                    <a href="./profile.php">
                     <img src= <?php 
                     if(!empty($users['user_image']))
                     {
                      echo $usr_img;
                     }
                     else
                     {
                      echo $def_img;
                     }
                     ?> alt='image-avatar' />
                    </a>
        <?php }?>
        <div class="auth-container" style="display: inline;">
        <a id="masuk" href="./profile.php"><?php echo $_SESSION['username']; ?></a>
		<!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
          <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
          </h3>
        </div>
        <?php endif ?>

		<!-- logged in user information -->
        <?php  if (isset($_SESSION['username'])) : ?>
          <a id="logout" href="index.php?logout='1'" style="color: red;">logout</a>
        <?php endif ?>
    </div>
      </div>
      <a href="./homepage.php"> <img style="position: absolute; top: 0px; left: 0px" src="./admin/images/logo.png" alt="logo" /></a>
      <div class="center">
        <span class="judul">NoQ!</span>
        <br />
      </div>
    <div class="content">
      <h3>PILIH METODE PEMBAYARAN</h3>
      <div class="modal-bg">
        <div class="modal-container">
      <form method="post" action="checkout.php?resto_id=<?php echo $_GET['resto_id'];?>&order_id=<?php echo $id;?>" class="form" enctype="multipart/form-data">
				<?php include('error.php'); ?>
        <div class="input-group">
				</div>
        <?php 
          $id = $_SESSION['orderid'];
          $q = "SELECT * FROM order_resto WHERE order_id='$id'";
          $res = mysqli_query($db,$q);
          $order = mysqli_fetch_assoc($res);
          $ovo_img = "admin/qr_ovo_resto/".$pay['qr_ovo'];
          $gopay_img = "admin/qr_gopay_resto/".$pay['qr_gopay'];
            if($order['order_payment'] == 'ovo')
            {?>
              <img src = <?php echo $ovo_img;?> style="width:150px;height:150px"/>
            <?php }
            if($order['order_payment'] == 'gopay')
            {?>
              <img src = <?php echo $gopay_img;?> style="width:150px;height:150px"/>
            <?php }
          ?>
        <div class="input-group">
					<label>Upload Bukti Bayar</label>
					<input type="file" name="bukti" accept=".png, .jpg, .jpeg">
				</div>
        <span>Total yang harus dibayar</span>
        <span><?php echo $order['order_total'];?></span>
				<div class="input-group">
					<button type="submit" class="btn" name="bayar">Bayar</button>
			  </div>
        <a href="menu-resto.php?action=add&resto_id=<?php echo $_GET['resto_id']?>">Kembali</a>
			</form>
        </div>
    </div>
  </body>
</html>
