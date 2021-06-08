<?php include('admin_server.php') ?>
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
    <header class="header" style="background-image: url(./admin/images/cover-resto.jpeg)">
      <img style="position: absolute" src="./admin/images/logo.png" alt="logo" />
      <div class="center">
        <span class="judul">NoQ!</span>
        <br />
        <span class="motto">Makan enak tanpa antre</span>
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
                if(isset($_POST['filter']))
                {?>
                <div class="content">
                  <div class="recommendation-container">
                      <h3>Rekomendasi untuk kamu!</h3>
                  </div>
                    <div class="cards">
                    <?php
                    if(!empty($_POST['location']))
                    {
                        $selected = $_POST['location'];
                        $query = mysqli_query($db, "select * from restoran where loc_id='$selected'");
                            while($resto = mysqli_fetch_array($query))
                            {?>
                            <?php $res_img = "admin/images/".$resto['resto_image'];
                                  $res_id = $resto['resto_id'];
                            ?>
                            <a href="menu-resto.php?resto_id=<?php echo $resto['resto_id']?>" style=" text-decoration:none; color:black;">
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
                            </div></a>
                        <?php }?>
              <?php }?>
          <?php }
            else{?>
              <?php $query = mysqli_query($db, "select * from restoran");?>
                <div class="content">
                  <div class="cards">
                  <?php
                          while($resto = mysqli_fetch_array($query))
                          {?>
                          <?php $res_img = "admin/images/".$resto['resto_image'];?>
                          <a href="menu-resto.php?resto_id=<?= $resto['resto_id']?>" style="text-decoration:none; color:black;">
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
                          </div></a>
                  <?php }?>
                  </div>
                </div>
              <?php }?>
      </div>
    </div></a>
	<div class="modal-bg">
    	<div class="modal-container" style="height: 55%">
			<form method="post" action="sign_admin.php" class="form">
				<?php include('error.php'); ?>
                <?php 
                $query = mysqli_query($db, "select * from restoran");
                ?>
                    <select name="nama_resto">
                    <?php
                        while($resto = mysqli_fetch_array($query))
                        {
                            ?>
                            <option value = "<?= $resto['resto_id'];?>">
                            <?php 
                                echo $resto['resto_name']; ?>
                            </option>
                            <?php
                        }
                    ?>
                    </select>
                </div>

				<div class="input-group">
				<label>Username</label>
				<input type="text" name="username_resto" value="<?php echo $admin_username; ?>">
				</div>

				<div class="input-group">
				<label>Password</label>
				<input type="password" name="password_1">
				</div>

				<div class="input-group">
				<label>Confirm password</label>
				<input type="password" name="password_2">
				</div>

				<div class="input-group">
				<button type="submit" class="btn" name="reg_admin">Register</button>
				</div>
			</form>
		</div>
	</div>
	</body>
</html>