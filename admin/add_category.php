<?php include('admin_server.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Master_Data.css" />
    <title>Homepage Admin</title>
  </head>
  <body>
    <header class="header">
      <div class="image-avatar">
        <a href="./css/profile.html">
		<a id="logout" href="master_data.php?logout='1'" style="color: red;">logout</a>
        	<img src="images/default.png" alt="image-avatar" />
        </a>
      </div>
      <div class="container">
        <a href="./css/profile.html">
          	<img class="notif" src="images/notif.svg" />
        </a>
        <img class="img-responsive" src="images/logo.png" />
      </div>
      <div class="  kk"> 
              <p class="pesan">1 Pesanan Masuk</p>
      </div>

      <div class="center">
        <span class="judul">NoQ!</span>
      </div>
    </header>
        <div id="modal-bg-kategori">
            <div class="modal-bg">
              <div class="modal-container">
                <form method="post" action="add_category.php">
                  <strong><label for="kategorimenu">Nama Kategori Menu</label></strong
                  ><br />
               	 <div class="flext-row" style="text-align: end">
					<input type="text" name="cat">
                    <input name="tambah_cat" class="button-simpan" type="submit" value="SIMPAN" />
               	 </div>
                </form>
              </div>
            </div>
          </div>
        </body>
</html>