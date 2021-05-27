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
    <header class="header" style="background-image: url(./admin/images/cover-resto.jpeg)">
    <?php 
              $db = mysqli_connect('localhost','root', 'subhan2122', 'noq');
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
      <a href="homepage.php">
      <img style="position: absolute" src="./admin/images/logo.png" alt="logo" />
        </a>
      <div class="center">
        <span class="judul">NoQ!</span>
        <br />
        <span class="motto">Makan enak tanpa antre</span>
        <br />
        <a style="color: white">Silahkan Cari Kota Anda Terlebih Dahulu</a>
      </div>
      <div class="search-location">
      <?php 
                $query = mysqli_query($db, "select * from restoran_loc");
                ?>
                <form method="post" action="">
                    <select name="location" id="location">
                    <?php
                        while($resto = mysqli_fetch_array($query))
                        {
                            ?>
                            <option value = "<?php echo $resto['loc_id'];?>">
                            <?php 
                                echo $resto['loc_name']; ?>
                            </option>
                            <?php
                        }
                    ?>
                    </select>
                    <button type="submit" class="btn" name="filter">Cari</button>
                </form>
      </div>
    </header>
       <?php 
              $db = mysqli_connect('localhost','root', 'subhan2122', 'noq');
                if(isset($_POST['filter']))
                {?>
                <div class="content">
                  <div class="recommendation-container">
                      <h3>Rekomendasi untuk kamu!</h3>
                  </div>
                  <a href="#" style="text-decoration:none; color:black;">
                    <div class="cards">
                    <?php
                    if(!empty($_POST['location']))
                    {
                        $selected = $_POST['location'];
                        $query = mysqli_query($db, "select * from restoran where loc_id='$selected'");
                            while($resto = mysqli_fetch_array($query))
                            {?>
                            <?php $res_img = "admin/images/".$resto['resto_image'];?>
                            <div class="card">
                                <span
                                class="card-image"
                                style="background-image: url('<?php echo $res_img;?>');"
                                ></span>
                                <div class="card-content">
                                <h3 class="nama-resto"><?php echo $resto['resto_name'];?></h3>
                                <span class="alamat"><?php echo $resto['resto_address'];?></span>
                                <span class="alamat"><?php echo $resto['resto_open'];?></span>
                                </div>
                            </div>
                        <?php }?>
              <?php }?>
          <?php }
            else{?>
              <?php $query = mysqli_query($db, "select * from restoran");?>
                <div class="content">
                <a href="#" style="text-decoration:none; color:black;">
                  <div class="cards">
                  <?php
                          while($resto = mysqli_fetch_array($query))
                          {?>
                          <?php $res_img = "admin/images/".$resto['resto_image'];?>
                          <div class="card">
                              <span
                              class="card-image"
                              style="background-image: url('<?php echo $res_img;?>');"
                              ></span>
                              <div class="card-content">
                                <h3 class="nama-resto"><?php echo $resto['resto_name'];?></h3>
                                <span class="alamat"><?php echo $resto['resto_address'];?></span>
                                <span class="alamat"><?php echo $resto['resto_open'];?></span>
                              </div>
                          </div>
                  <?php }?>
                  </div>
                </div></a>
              <?php }?>
      </div>
    </div></a>
  </body>
</html>
