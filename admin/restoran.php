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
    	<div class="modal" style="height: 55%">
			<form method="post" action="restoran.php" class="form" enctype="multipart/form-data">
				<?php include('error.php'); ?>
                <div class="input-group">
                <label>Lokasi Kota</label>
                <?php 
                $db = mysqli_connect('localhost','root', 'subhan2122', 'noq');
                $query = mysqli_query($db, "select * from restoran_loc");
                ?>
                    <select name="lokasi_resto">
                    <?php
                        while($resto = mysqli_fetch_array($query))
                        {
                            ?>
                            <option value = "<?= $resto['loc_id'];?>">
                            <?php 
                                echo $resto['loc_name']; ?>
                            </option>
                            <?php
                        }
                    ?>
                    </select>
                </div>
                
				<div class="input-group">
				<label>Nama Resto</label>
				<input type="text" name="nama_resto">
				</div>

				<div class="input-group">
				<label>Alamat Resto</label>
				<input type="text" name="alamat_resto">
				</div>

				<div class="input-group">
				<label>Nomor Resto</label>
				<input type="text" name="nomor_resto">
				</div>

        <div class="input-group">
				<label>Open Resto</label>
				<input type="text" name="open_resto" placeholder="08.00-21.00">
				</div>

				<div class="input-group">
				<label>Foto Resto</label>
				<input type="file" name="resto_image" accept=".png, .jpg, .jpeg">
			    </div> 

				<div class="input-group">
				<button type="submit" class="btn" name="add_resto">Tambah Resto</button>
				</div>
			</form>
		</div>
	</div>
	</body>
</html>
