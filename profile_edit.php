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
      <div class="image-avatar">
        <a href="./profile.php">
          <img src="./images/profile-picture.png" alt="image-avatar" />
        </a>
      </div>
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
      <?php include('server.php');
        $user = $_SESSION['username'];
        $query = mysqli_query($db, "select nama,email,no_hp,password from users where username='$user'");
        $users = mysqli_fetch_array($query);
        ?>
			<form method="post" action="profile_edit.php" class="form">
				<?php include('error.php'); ?>
        <div class="input-group">
					<input type="hidden" name="username" value="<?php echo $user ?>">
				</div>
				<div class="input-group">
					<label>Nama</label>
					<input type="text" name="nama" value="<?php echo $users['nama']; ?>">
				</div>
				<div class="input-group">
					<label>Email</label>
					<input type="email" name="email" value="<?php echo $users['email']; ?>">
				</div>
        <div class="input-group">
					<label>Nomor HP</label>
					<input type="text" name="no_hp" value="<?php echo $users['no_hp']; ?>">
				</div>
        <div class="input-group">
					<label>Password</label>
					<input type="password" name="password" value="<?php echo $users['password']; ?>">
				</div>
				<div class="input-group">
					<button type="submit" class="btn" name="edit">Update</button>
          <a href="./profile.php">Kembali</a>
				</div>
			</form>
		</div>
	</div>
  </body>
</html>