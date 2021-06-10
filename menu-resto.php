<?php include('server.php');
  if(isset($_GET['resto_id']))
  {
    $res_id = $_GET['resto_id'];

    $query = mysqli_query($db, "select * from restoran where resto_id='$res_id' AND resto_status='buka'");

    $resto = mysqli_fetch_assoc($query);

    $res_img = "admin/images/".$resto['resto_image'];
    $res_name = $resto["resto_name"];
    $res_addr = $resto["resto_address"];
    $res_open = $resto["resto_open"];
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Profile</title>
  </head>
  <body>
  <?php 
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
    unset($_SESSION['cart']);
  	header("location: index.php");
  }
?>
    <header class="header" style="background-image: url(./admin/images/cover-resto.jpeg)">
    <?php 
              $user=$_SESSION['username'];
              $query = mysqli_query($db, "select user_image from users where username='$user'");
              while($users = mysqli_fetch_array($query))
              {?> 
                <?php $usr_img = "user_images/".$users['user_image'];
                      $def_img = "user_images/default.png";
                ?>
                <div class="image-avatar">
                    <a href="./profile.php">
                     <img src= <?php 
                     if(!empty($users['user_image']))
                     {
                      echo $usr_img;
                     }
                     else
                     {
                      echo $def_img;
                     }
                     ?> alt='image-avatar' />
                    </a>
        <?php }?>
        <div class="auth-container" style="display: inline;">
        <a id="masuk" href="./profile.php"><?php echo $_SESSION['username']; ?></a>
		<!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
          <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
          </h3>
        </div>
        <?php endif ?>

		<!-- logged in user information -->
        <?php  if (isset($_SESSION['username'])) : ?>
          <a id="logout" href="index.php?logout='1'" style="color: red;">logout</a>
        <?php endif ?>
    </div>
      </div>
      <a href="./homepage.php">
        <img
          style="position: absolute; top: 0px; left: 0px"
          src="./admin/images/logo.png"
          alt="logo"
        />
      </a>
      <div class="center">
        <span class="judul">NoQ!</span>
        <br />
        <span class="motto">Makan enak tanpa antre</span>
      </div>
    </header>
    <div class="content">
      <div class="restaurant-images">
        <img src="<?php echo $res_img;?>" alt="img-resto" width="800" height="500" />
        <div class="more-image-container">
        </div>
      </div>
      <div class="atribut-restoran">
        <div class="flex-row">
          <h1><?php echo $res_name;?></h1>
        </div>
        <div class="flex-column">
          <div class="lokasi-resto">
            <h4><?php echo $res_addr;?></h4>
          </div>
          <div class="flex-row">
            <img src="./admin/images/clock.png" alt="clock-icon" style="width: 20px; height: 20px; margin-right: 10px" />
            <div class="jam-buka-resto">
              <h4><?php echo $res_open;?></h4>
            <a href="homepage.php" style="text-decoration:none">
              <h4>Kembali Melihat Resto</h4>
            </a>
            </div>
          </div>
        </div>
      </div>
      <div class="nav-tabs" style="margin-top: 20px">
        <button id="menu-link">MENU</button>
        <button id="review-link">REVIEW</button>
        <button id="location-link">LOCATION</button>
      </div>
      <div id="tab-content-container">
        <div id="menu-content">
          <div class="menu-container">
            <div class="menu-cards">
            <?php
              if(isset($_POST['filter_cats']))
              {
                if(!empty($_POST['cat']))
                {
                  $selected = $_POST['cat'];
                  $query = mysqli_query($db,"select * from menu where res_id = '$res_id' and categ_id ='$selected'");
                  if(!empty($_SESSION['cart']))
                  {
                    foreach($_SESSION['cart'] as $key => $value)
                    { 
                      if($value['resto_id']!=$res_id)
                      {
                        unset($_SESSION['cart']);
                      }
                    }
                  }
                    while($menu = mysqli_fetch_array($query))
                    {?>
                    <div class="card">
                    <?php $menu_img = "admin/menu_images/".$menu['menu_image'];?>
                    <span class="card-image" style="background-image: url(<?php echo $menu_img?>)"></span>
                    <div class="card-content">
                      <span class="nama-menu"><?php echo $menu['menu_name'];?></span>
                      <span class="harga-menu"><?php echo number_format($menu['menu_price'],2);?></span>
                    <form method="post" action="menu-resto.php?action=add&menu_id=<?php echo $menu['menu_id'];?>&resto_id=<?php echo $_GET['resto_id'];?>">
                      <input type="number" name="qty_menu" value="1" min="1">
                      <input type="hidden" name="nama_menu" value="<?php echo $menu['menu_name'];?>">
                      <input type="hidden" name="harga_menu" value="<?php echo $menu['menu_price'];?>">
                      <input class="harga-menu" type="submit" name="add_to_cart" value="Tambah ke Keranjang">
                    </form>
                    </div>
                  </div><?php }
                }
              }
              else{
                $query = mysqli_query($db,"select * from menu where res_id = '$res_id'");
                  if(!empty($_SESSION['cart']))
                  {
                    foreach($_SESSION['cart'] as $key => $value)
                    { 
                      if($value['resto_id']!=$res_id)
                      {
                        unset($_SESSION['cart']);
                      }
                    }
                  }
                    while($menu = mysqli_fetch_array($query))
                    {?>
                    <div class="card">
                    <?php $menu_img = "admin/menu_images/".$menu['menu_image'];?>
                    <span class="card-image" style="background-image: url(<?php echo $menu_img?>)"></span>
                    <div class="card-content">
                      <span class="nama-menu"><?php echo $menu['menu_name'];?></span>
                      <span class="harga-menu"><?php echo number_format($menu['menu_price'],2);?></span>
                    <form method="post" action="menu-resto.php?action=add&menu_id=<?php echo $menu['menu_id'];?>&resto_id=<?php echo $_GET['resto_id'];?>">
                      <input type="number" name="qty_menu" value="1" min="1">
                      <input type="hidden" name="nama_menu" value="<?php echo $menu['menu_name'];?>">
                      <input type="hidden" name="harga_menu" value="<?php echo $menu['menu_price'];?>">
                      <input class="harga-menu" type="submit" name="add_to_cart" value="Tambah ke Keranjang">
                    </form>
                    </div>
                  </div><?php }
              }
              ?>
            </div>
            <div class="kategori-pemesanan-container">
              <div class="kategori">
                <h2 style="padding-left: 10px; margin-top: 10px; margin-bottom: 10px">KATEGORI</h2>
                <div class="category-input-container" style="padding-left: 10px; padding-top: 10px; border-top: 1px solid">
                <?php 
                $query = mysqli_query($db, "select * from menu_category where r_id='$res_id'");
                ?>
                <form method="post" action="">
                    <select name="cat" id="location">
                    <?php
                        while($cats = mysqli_fetch_array($query))
                        {
                            ?>
                            <option value = "<?php echo $cats['category_id'];?>">
                            <?php 
                                echo $cats['category_name']; ?>
                            </option>
                            <?php
                        }
                    ?>
                    </select>
                    <button type="submit" class="btn" name="filter_cats">Cari</button>
                </form>
                </div>
              </div>
              <div class="pemesanan">
              <form method="post" action="checkout.php?resto_id=<?php echo $_GET['resto_id'];?>" enctype="multipart/form-data">
                <h2 style="padding-left: 10px; margin-top: 10px; margin-bottom: 10px">PEMESANAN</h2>
                <div class="pemesanan-input-container" style="padding-left: 10px; padding-top: 10px; border-top: 1px solid">
                <?php 
                  if(!empty($_SESSION['cart']))
                  {
                    $total = 0;
                    foreach($_SESSION['cart'] as $key => $value)
                    { 
                      ?>
                      <div class="input-group">
                      <label for="menu1"><?php echo $value['nama_menu'];?></label>
                      <div class="add-remove-container">
                        <div
                          id="jumlah-item"
                          style="display: inline-block; height: 20px; width: 20px; background-color: white; border: 1px solid; text-align: center"
                        >
                          <?php echo $value['qty_menu'];?>
                        </div>
                      </div>
                      <label for="menu1"><?php echo number_format($value['harga_menu']*$value['qty_menu']);?></label>
                      <a href="menu-resto.php?action=del-cart&menu_id=<?php echo $value['menu_id'];?>&resto_id=<?php echo $value['resto_id']?>" for="menu1"><?php echo "Hapus menu"?></a>
                    </div>
                    <?php 
                     $total=$total+($value['harga_menu']*$value['qty_menu']);
                  }?>
                <?php }
                else{
                  $total = 0;
                  echo "Belum memasukkan makanan";
                }
                ?>
                </div>
              </div>
                  <?php 
                    $query = mysqli_query($db,"select * from restoran where resto_id='$res_id'");
                    $cek = mysqli_fetch_assoc($query);
                    if(!empty($cek['qr_ovo']))
                    {?>
                    <h3>PILIH METODE PEMBAYARAN</h3>
                  <div class="flex-row" style="justify-content: center; margin-top: 20px; margin-bottom: 40px">
                      <div class="flex-column pembayaran-input-container">
                      <img src="./admin/images/logo-ovo.png" alt="logo-ovo" style="width: 100px; height: 100px" />
                      <input type="radio" id="ovo" name="metode_pembayaran" value="ovo" checked/>
                    </div>
                   <?php }
                   if(!empty($cek['qr_gopay']))
                   {?>
                    <div class="flex-column pembayaran-input-container">
                      <img src="./admin/images/logo-gopay.png" alt="logo-gopay" style="width: 100px; height: 100px" />
                      <input type="radio" id="gopay" name="metode_pembayaran" value="gopay" />
                    </div>
                    </div>
                   <?php }
                  ?>
                  <span style="color:red">PERINGATAN !!! Jika ingin memesan makanan pukul 1 siang, tulis dalam 24-H format</span>
                  <span style="color:red">Jam 1 Siang = 13.00, Jam 5 Sore =  17.00</span>
                  <span style="color:red">Jika memesan diluar jam operasional tidak ada pengembalian uang dan pesanan tidak akan diproses</span>
            </div>
          </div>
        </div>
        <div id="review-content" class="hidden">
          <div class="review-container">REVIEW</div>
        </div>
        <div id="location-content" class="hidden">
          <div class="location-container">LOCATION</div>
        </div>
      </div>
      <div class="pemesanan-bottom-container" style="margin: 0px 200px">
        <h2 style="text-decoration: underline; margin-bottom: 10px">PEMESANAN</h2>
        <div
          class="form-pemesanan-container"
          style="border: 2px solid aqua; border-radius: 8px; padding-top: 20px; padding-left: 10px; padding-right: 10px; padding-bottom: 25px"
        >
            <div class="flex-wrap">
              <div class="dropdown-container">
                <img src="./admin/images/clock.png" alt="clock-icon" />
                <input type="text" id="waktu-pemesanan" name="waktu_pemesanan" style="width: 136px" placeholder="13.00"/>
              </div>
              <div class="dropdown-container">
                <img src="./admin/images/table.png" alt="table-icon" />
                <select name="meja_resto" id="location">
                    <?php
                      $query = mysqli_query($db, "select * from meja_resto where res_id='$res_id' and meja_status='free'");
                        while($meja = mysqli_fetch_array($query))
                        {
                            ?>
                            <option value = "<?php echo $meja['meja_id'];?>">
                            <?php 
                                echo $meja['meja_name']; ?>
                            </option>
                            <?php
                        }
                    ?>
                    </select>
              </div>
              <div class="dropdown-container">
                <img src="./admin/images/edit.png" alt="edit-icon" />
                <input type="text" id="catatan" name="catatan" placeholder="KETIK DISINI" />
              </div>
            </div>
            <input type="hidden" name="total_payment" value="<?php echo $total;?>">
            <hr style="margin: 20px 40px" />
            <div class="flex-row harga-pemesanan-container">
              <img src="./admin/images/money.png" alt="money-icon" style="width: 25px; height: 25px; margin-right: 5px" />
              <p id="total-harga-pemesanan" style="padding: 5px 0px; margin: 0px auto 0px 0px"><?php echo number_format($total,2);?></p>
              <?php
              if(isset($_SESSION['cart']))
              {
                $query = mysqli_query($db, "select * from meja_resto where res_id='$res_id'");
                $m = mysqli_fetch_assoc($query);
                if(count($_SESSION['cart'])>0 && $m['meja_status']=='free' && $resto['resto_status']=='buka')
                {?>
                  <input type="submit" name="checkout" style="margin-right: 40px">
                <?php }?>
              <?php }
              ?>
            </div>
          </form>
        </div>
      </div>
      <hr style="margin: 100px 0px" />
    </div>
    <script>
      // nav tabs
      const menuLink = document.querySelector("#menu-link");
      const reviewLink = document.querySelector("#review-link");
      const locationLink = document.querySelector("#location-link");

      // content tab container
      const tabContent = document.querySelector("#tab-content-container");

      // masing-masing content tab
      const menuContent = document.querySelector("#menu-content");
      const reviewContent = document.querySelector("#review-content");
      const locationContent = document.querySelector("#location-content");

      // Proses saat button diklik

      // saat menu diklik akan memunculkan konten menu
      menuLink.addEventListener("click", (e) => {
        e.preventDefault();
        tabContent.style.backgroundColor = "#e1ffff"; // mengubah warna content tab container
        menuContent.classList.remove("hidden");
        reviewContent.classList.add("hidden");
        locationContent.classList.add("hidden");
      });

      // saat review diklik akan memunculkan konten review
      reviewLink.addEventListener("click", (e) => {
        e.preventDefault();
        tabContent.style.backgroundColor = "#94b0b2"; // mengubah warna content tab container
        reviewContent.classList.remove("hidden");
        menuContent.classList.add("hidden");
        locationContent.classList.add("hidden");
      });

      // saat location diklik akan memunculkan konten location
      locationLink.addEventListener("click", (e) => {
        e.preventDefault();
        tabContent.style.backgroundColor = "#ffb990"; // mengubah warna content tab container
        locationContent.classList.remove("hidden");
        menuContent.classList.add("hidden");
        reviewContent.classList.add("hidden");
      });

      // menambah dan mengurangi item
      const removeButton = document.querySelector("#remove-item-button");
      const addButton = document.querySelector("#add-item-button");
      let jumlahItem = document.querySelector("#jumlah-item").innerHTML;
      removeButton.addEventListener("click", (e) => {
        e.preventDefault();
        if (jumlahItem > 0) {
          jumlahItem--;
        }
        document.querySelector("#jumlah-item").innerHTML = jumlahItem.toString();
      });
      addButton.addEventListener("click", (e) => {
        e.preventDefault();
        jumlahItem++;
        console.log(jumlahItem);
        document.querySelector("#jumlah-item").innerHTML = jumlahItem.toString();
      });
    </script>
  </body>
</html>