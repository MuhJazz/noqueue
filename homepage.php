<?php include ('server.php')?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Home Page</title>
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
    <header class="header">
    <?php 
              $db = mysqli_connect('localhost','root', 'subhan2122', 'noq');
              $user=$_SESSION['username'];
              $query = mysqli_query($db, "select user_image from users where username='$user'");
              while($users = mysqli_fetch_array($query))
              {?> 
                <?php $usr_img = "user_images/".$users['user_image'];?>
                <div class="image-avatar">
                    <a href="./profile.php">
                     <img src= <?php echo $usr_img;?> alt='image-avatar' />
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
      <img style="position: absolute" src="./images/logo.png" alt="logo" />
      <div class="center">
        <span class="judul">NoQ!</span>
        <br />
        <span class="motto">Makan enak tanpa antre</span>
      </div>
      <div class="search-location">
      <?php 
                $db = mysqli_connect('localhost','root', 'subhan2122', 'noq');
                $query = mysqli_query($db, "select * from restoran_loc");
                ?>
                    <select name="location" id="location">
                    <?php
                        while($resto = mysqli_fetch_array($query))
                        {
                            ?>
                            <option name="res" value = "<?= $resto['loc_id'];?>">
                            <?php 
                                echo $resto['loc_name']; ?>
                            </option>
                            <?php
                        }
                    ?>
                    </select>
                    <button type="submit" class="btn" name="filter">Cari</button>
      </div>
    </header>
    <div class="content">
      <div class="recommendation-container">
        <h3>Rekomendasi untuk kamu!</h3>
        <button>TELUSURI</button>
      </div>
      <div class="cards">
       <?php 
              $db = mysqli_connect('localhost','root', 'subhan2122', 'noq');
                $query = mysqli_query($db, "select * from restoran");
                while($resto = mysqli_fetch_array($query))
                {?>
                 <?php $res_img = "images/".$resto['resto_image'];?>
                  <div class="card">
                    <span
                      class="card-image"
                      style="background-image: url('<?php echo $res_img;?>');"
                    ></span>
                    <div class="card-content">
                      <span class="nama-resto"><?php echo $resto['resto_name'];?></span>
                      <span class="alamat"><?php echo $resto['resto_address'];?></span>
                    </div>
                  </div>
               <?php }?>
      </div>
    </div>
  </body>
</html>