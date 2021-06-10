<?php include('super_server.php') ?>
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
      <img style="position: absolute" src="./images/logo.png" alt="logo" />
      <div class="center">
        <span class="judul">NoQ!</span>
        <br />
        <span class="motto">Makan enak tanpa antre</span>
      </div>
      <div class="search-location">
      </div>
    </header>
	<div class="modal-bg">
    	<div class="modal-container">
			<form method="post" action="login_super_admin.php" class="form">
				<?php include('error.php'); ?>
				<div class="input-group">
					<label>Username Resto</label>
					<input type="text" name="username_super_admin" >
				</div>
				<div class="input-group">
					<label>Password Resto</label>
					<input type="password" name="password_super_admin">
				</div>
				<div class="input-group">
					<button type="submit" class="btn" name="login_super_admin">Login</button>
				</div>
			</form>
		</div>
	</div>
	</body>
</html>