<?php include('server.php') ?>
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
            style="background-image: url(./admin/images/resto1.jpeg)"
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
    	<div class="modal-container">
			<form method="post" action="signup.php" class="form" enctype="multipart/form-data">
				<?php include('error.php'); ?>
				<div class="input-group">
				<label>Nama</label>
				<input type="text" name="nama">
				</div>
				<div class="input-group">
				<label>Username</label>
				<input type="text" name="username" value="<?php echo $username; ?>">
				</div>
				<div class="input-group">
				<label>Email</label>
				<input type="email" name="email" value="<?php echo $email; ?>">
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
				<label>Nomor Handphone</label>
				<input type="text" name="no_hp">
				</div>
        <div class="input-group">
					<label>Foto Profil</label>
					<input type="file" name="user_image" accept=".png, .jpg, .jpeg">
				</div>
				<div class="input-group">
				<button type="submit" class="btn" name="reg_user">Register</button>
				</div>
				<p>
					Sudah memiliki akun ? <a href="login.php">Sign in</a>
				</p>
			</form>
		</div>
	</div>
	</body>
</html>