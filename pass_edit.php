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
      <a href="./index.php">
        <img
          style="position: absolute; top: 0px; left: 0px"
          src="./images/logo.png"
          alt="logo"
      /></a>
      <div class="center">
        <span class="judul">NoQ!</span>
        <br />
        <span class="motto">Makan enak tanpa antre</span>
      </div>
      <div class="search-location">
        <select name="location" id="location">
          <option value="bogor">Bogor</option>
          <option value="jakarta">Jakarta</option>
          <option value="depok">Depok</option>
          <option value="bekasi">Bekasi</option>
        </select>
        <div class="search-bar">
          <input
            class="text"
            type="text"
            placeholder="Find your nearest restaurant..."
          />
        </div>
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
    <div class="modal-bg">
    	<div class="modal" style="height: 55%">
			<form method="post" action="pass_edit.php" class="form" enctype="multipart/form-data">
				<?php include('error.php'); ?>
                    <div class="input-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password">
                    </div>
                    <div class="input-group">
                        <label>New Password</label>
                        <input type="password" name="new_password">
                    </div>
                    <div class="input-group">
                        <label>Confirm Password</label>
                        <input type="password" name="new_password_1">
                    </div>
				<div class="input-group">
					<button type="submit" class="btn" name="pass_edit">Update</button>
          <a href="./profile.php">Kembali</a>
				</div>
			</form>
		</div>
	</div>
  </body>
</html>