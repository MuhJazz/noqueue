<?php include('admin_server.php') 
  $admin = $_SESSION['admin_username']
  $query = mysqli_query($db, "select * from admin_resto where admin_username='$admin'");
  $adm = mysqli_fetch_assoc($query);
  $rest_id = $adm['res_id'];
?>
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
      <img style="position: absolute" src="./images/logo.png" alt="logo" />
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
        <div class="card">
          <span
            class="card-image"
            style="background-image: url(./images/resto1.jpeg)"
          ></span>
          <div class="card-content">
            <span class="nama-resto">Resto1</span>
            <span class="alamat">Alamat1</span>
            <span class="rate">5.0/5.0</span>
          </div>
        </div>
        <div class="card">
          <span
            class="card-image"
            style="background-image: url(./images/resto2.jpeg)"
          ></span>
          <div class="card-content">
            <span class="nama-resto">Resto2</span>
            <span class="alamat">Alamat2</span>
            <span class="rate">4.0/5.0</span>
          </div>
        </div>
        <div class="card">
          <span
            class="card-image"
            style="background-image: url(./images/resto3.jpeg)"
          ></span>
          <div class="card-content">
            <span class="nama-resto">Resto3</span>
            <span class="alamat">Alamat3</span>
            <span class="rate">3.0/5.0</span>
          </div>
        </div>
        <div class="card">
          <span
            class="card-image"
            style="background-image: url(./images/resto4.jpeg)"
          ></span>
          <div class="card-content">
            <span class="nama-resto">Resto4</span>
            <span class="alamat">Alamat4</span>
            <span class="rate">2.0/5.0</span>
          </div>
        </div>
      </div>
    </div>
	<div class="modal-bg">
    	<div class="modal-container" style="height: 55%">
			<form method="post" action="add_meja_resto.php" class="form">
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
				<label>Nama Meja</label>
				<input type="text" name="nama_meja">
				</div>

        <input type="hidden" name="nama_meja" value="<?php echo $rest_id;?>"> 
				<button type="submit" class="btn" name="meja_resto">add meja</button>
				</div>
			</form>
		</div>
	</div>
	</body>
</html>