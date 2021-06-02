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
			<form method="post" action="menu.php" class="form" enctype="multipart/form-data">
				<?php include('error.php'); ?>
                <div class="input-group">
                <label>Nama Resto</label>
                <?php 
                $db = mysqli_connect('localhost','root', '', 'noq');
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
				<label>Nama Menu</label>
				<input type="text" name="nama_menu">
				</div>

				<div class="input-group">
				<label>Harga Menu</label>
				<input type="text" placeholder="50000" name="harga_menu">
				</div>

				<div class="input-group">
				<label>Deskripsi Menu</label>
				<input type="text" name="desc_menu">
				</div>

				<div class="input-group">
				<label>Foto Menu</label>
				<input type="file" name="menu_image" accept=".png, .jpg, .jpeg">
			    </div> 

				<div class="input-group">
				<button type="submit" class="btn" name="add_menu">Tambah Menu</button>
				</div>
			</form>
		</div>
	</div>
	</body>
</html>
