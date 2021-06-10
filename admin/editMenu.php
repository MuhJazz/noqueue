<?php include('admin_server.php');
    $menu_id = $_GET['menu_id'];
    $query = mysqli_query($db,"select * from menu where menu_id='$menu_id'");
    if(!empty($query))
    {
        $update = mysqli_fetch_assoc($query);
        $update_nama = $update['menu_name'];
        $update_price = $update['menu_price'];
        $update_img = "menu_images/".$update['menu_image'];
    }?>
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
			<form method="post" action="editMenu.php?menu_id=<?php echo $menu_id;?>" class="form" enctype="multipart/form-data">
				<?php include('error.php'); ?>
				<div class="input-group">
					<label>Nama Menu</label>
					<input type="text" name="update_nama" value="<?php echo $update_nama;?>" >
				</div>
				<div class="input-group">
					<label>Gambar Menu</label>
					<img style="height:100px" src="<?php echo $update_img?>" name="update_gambar">
                    <input type="file" name="update_gambar" accept=".png, .jpg, .jpeg" style="margin-bottom: 30px" />
				</div>
                <div class="input-group">
					<label>Harga Menu</label>
					<input type="text" name="update_harga" value="<?php echo $update_price;?>">
				</div>
				<div class="input-group">
					<button type="submit" class="btn" name="update_menu">Update</button>
				</div>
                <a href="master_data.php">Kembali</a>
			</form>
		</div>
	</div>
	</body>
</html>
