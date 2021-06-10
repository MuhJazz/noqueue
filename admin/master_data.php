<?php include('admin_server.php');
$admin = $_SESSION['admin_username'];
$query = mysqli_query($db,"select * from admin_resto where admin_username='$admin'");
if($query)
{
	$adm = mysqli_fetch_assoc($query);
	$res_id = $adm['res_id'];
	$res = mysqli_query($db,"select * from restoran where resto_id='$res_id'");
	if($res)
	{
		$resto = mysqli_fetch_assoc($res);
	}
}
$ctg = mysqli_query($db, "select * from menu where res_id = '$res_id'");
if(!empty($ctg))
{
    $categ = mysqli_fetch_assoc($ctg);
    if(!empty($categ['categ_id']))
    {
      $ctg_id = $categ['categ_id'];
      $c = mysqli_query($db,"select * from menu_category where category_id = '$ctg_id'");
      if($c)
      {
          $categories = mysqli_fetch_assoc($c);
      }
    }
}
$r = mysqli_query($db, "select * from order_resto where res_id = '$res_id'");
if(!empty($r))
{
    $meja = mysqli_fetch_assoc($r);
    if(!empty($meja['order_meja']))
    {
      $meja_id = $meja['order_meja'];
      $m = mysqli_query($db,"select * from meja_resto where meja_id = '$meja_id'");
      if($m)
      {
          $meja_resto = mysqli_fetch_assoc($m);
      }
    }
}
?>
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
    <?php 
  if (!isset($_SESSION['admin_username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login_admin.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['admin_username']);
  	header("location: login_admin.php");
  }
?>
    <header class="header">
      <div class="image-avatar">
        <?php echo $admin;?>
        <a id="logout" href="master_data.php?logout='1'" style="color: red">logout</a>
        <img src="images/default.png" alt="image-avatar" />
      </div>
      <div class="container">
        <a href="./css/profile.html">
          <img class="notif" src="images/notif.svg" />
        </a>
        <a href="master_data.php">
          <img class="img-responsive" src="images/logo.png" />
        </a>
      </div>
      <div class="kk">
        <p class="pesan">1 Pesanan Masuk</p>
      </div>
      <div class="center">
        <span class="judul">NoQ!</span>
        <br />
        <span class="namaresto"
          >Nama Resto Anda:
          <?php echo $resto['resto_name'];?> (<?php echo ($resto['resto_status']);?>)</span>
      </div>
    </header>
    <div class="content">
      <div class="nav-tabs" style="margin-top: 30px">
      <form method="post" action="master_data.php?resto_id=<?php echo $res_id;?>">
      <select name="status">
        <option value="none" selected disabled hidden>-Status Restoran-</option>
        <option value="buka">Buka</option>
        <option value="tutup">Tutup</option>
      </select>
      <button type="submit" name="ubah_status">Ubah Status</button>
      </form>
      <a href="list_meja.php?resto_id=<?php echo $res_id;?>">List Meja Resto</a>
        <a href="#">
          <button id="master-link" class="link">Master Data</button>
        </a>
        <a href="#">
          <button id="transaksi-link" class="link">Data Transaksi</button>
        </a>
        <a href="#">
          <button id="laporan-link" class="link">Data Laporan</button>
        </a>
      </div>
      <div id="tab-content-container">
        <div id="master-content">
          <div id="master-container">
            <div id="menu-contents">
              <div id="menu-content1" class="menu-content">
                <div class="kotak1">
                  <a id="kotak1" href="#">
                    <div class="data-kategori-menu">
                      <div class="card">
                        <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
                        <span class="iconify" data-inline="false" data-icon="bx:bxs-food-menu" style="font-size: 120px; color: black; margin-top: 10px"></span>
                      </div>
                    </div>
                  </a>
                  <div class="card-content1">
                    <span class="nama-data">DATA KATEGORI MENU</span>
                  </div>
                </div>
              </div>
              <div id="menu-content2" class="menu-content">
                <div class="kotak2">
                  <a id="kotak2" href="#">
                    <div class="data-menu">
                      <div class="card">
                        <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
                        <span class="iconify" data-inline="false" data-icon="ic:baseline-menu-book" style="font-size: 120px; color: black"></span>
                      </div>
                    </div>
                  </a>
                  <div class="card-content2">
                    <span class="nama-data">DATA MENU</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="kategori-menu-container" class="hidden">
            <div class="flex-row">
              <h2 style="margin-top: 0px">DATA KATEGORI MENU</h2>
              <img id="exit-kategori-menu" src="./images/exit.png" alt="exit-icon" height="26px" width="26px" style="margin-left: auto; cursor: pointer" />
            </div>
            <hr width="100%" align-text="center" style="margin-top: -10px; border: solid" />
            <div class="flex-row">
              <div class="menu-icon">
                <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
                <span class="iconify" data-inline="false" data-icon="bx:bx-menu" style="font-size: 24px; color: black"></span>
              </div>
              <p style="font-size: 20px; padding: 0px">Kategori Menu</p>
            </div>
            <div class="flex-row">
              <a href="tambah_kategori.php">
                <div id="tambah-data-kategori" class="button-tambah-data flex-row">
                  <img src="./images/plus-icon.png" alt="plus-icon" height="25px" width="25px" style="margin-right: 10px" />
                  <p style="font-size: 21px; margin-right: 5px">Tambah Data</p>
                </div>
              </a>
              <input type="text" placeholder="Search" style="border-radius: 4px; width: 120px; height: 20px; margin-top: auto; margin-left: auto" />
            </div>
            <table>
              <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Hapus</th>
              </tr>
              <tr>
                <?php
			 	$query = mysqli_query($db,"select * from menu_category where r_id = '$res_id'");
				 $i = 1;
				 while($cat = mysqli_fetch_assoc($query))
				 {?>
                <td><?php echo $i++?></td>
                <td><?php echo $cat['category_name'];?></td>
                <td>
                  <button id="button-hapus" class="link">
                    <a href="deleteCat.php?category_id=<?php echo $cat['category_id'];?>">
                      <img src="./images/hapus-icon.png" alt="hapus-icon" style="width: 20px; height: 20px" />
                    </a>
                  </button>
                </td>
              </tr>
              <?php }
			  ?>
            </table>
          </div>
          <div id="menu-container" class="hidden">
            <div class="flex-row">
              <h2 style="margin-top: 0px">DATA MENU</h2>
              <img id="exit-menu" src="./images/exit.png" alt="exit-icon" height="26px" width="26px" style="margin-left: auto; cursor: pointer" />
            </div>
            <hr width="100%" align-text="center" style="margin-top: -10px; border: solid" />
            <div class="flex-row">
              <div class="menu-icon">
                <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
                <span class="iconify" data-inline="false" data-icon="bx:bx-menu" style="font-size: 24px; color: black"></span>
              </div>
              <p style="font-size: 20px; padding: 0px">Daftar Menu</p>
            </div>
            <div class="flex-row">
              <a href="tambah_menu.php">
                <div id="tambah-data-menu" class="button-tambah-data flex-row">
                  <img src="./images/plus-icon.png" alt="plus-icon" height="25px" width="25px" style="margin-right: 10px" />
                  <p style="font-size: 21px; margin-right: 5px">Tambah Data</p>
                </div>
              </a>
              <input type="text" placeholder="Search" style="border-radius: 4px; width: 120px; height: 20px; margin-top: auto; margin-left: auto" />
            </div>
            <table>
              <tr>
                <th>No</th>
                <th>Kategori Menu</th>
                <th>Nama Menu</th>
                <th>Gambar</th>
                <th>Harga</th>
                <th>Edit</th>
                <th>Hapus</th>
              </tr>
              <tr>
              <?php
			 	$query = mysqli_query($db,"select * from menu where res_id = '$res_id'");
				 $i = 1;
				 while($menu = mysqli_fetch_assoc($query))
				 {?>
                <td><?php echo $i++;?></td>
                <td><?php echo $categories['category_name'];?></td>
                <td><?php echo $menu['menu_name'];?></td>
                <td><img src="<?php echo "menu_images/".$menu['menu_image'];?>" style="height:100px;"></td>
                <td><?php echo number_format($menu['menu_price'],2);?></td>
                <td>
                  <button>
                    <a href="editMenu.php?menu_id=<?php echo $menu['menu_id'];?>">
                      EDIT MENU
                    </a> 
                  </button>
                </td>
                <td>
                <button id="button-hapus" class="link">
                <a href="deleteMen.php?menu_id=<?php echo $menu['menu_id'];?>">
                    <img src="./images/hapus-icon.png" alt="hapus-icon" style="width: 20px; height: 20px" />
                    </a>
                    </button>
                </td>
              </tr>
              <?php }
			  ?>
              </tr>
            </table>
          </div>
          <div id="modal-bg-kategori" class="hidden">
            <div class="modal-bg">
              <div class="modal-container">
                <form method="post" action="master_data.php">
                  <strong><label for="kategorimenu">Nama Kategori Menu</label></strong
                  ><br />
                  <input type="text" name="cat" id="categories" />
                  <input type="hidden" name="rest_id" value="<?php echo $res_id;?>" />
                  <div class="flext-row" style="text-align: end">
                    <input name="tambah_cat" class="button-simpan" type="submit" value="SIMPAN" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div id="transaksi-content" class="hidden">
          <div class="transaksi-container">
            <h2 style="margin-top: 0px">DATA TRANSAKSI PEMESANAN</h2>
            <hr width="100%" align-text="center" style="margin-top: -10px; border: solid" />
            <div class="flex-row">
              <div class="menu-icon">
                <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
                <span class="iconify" data-inline="false" data-icon="bx:bx-menu" style="font-size: 24px; color: black"></span>
              </div>
              <p style="font-size: 20px; padding: 0px">Pemesanan Menu</p>
            </div>
            <table>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No. Meja</th>
                <th>Username</th>
                <th>Total</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Hapus</th>
              </tr>
              <tr>
              <?php
              $query = mysqli_query($db,"select * from order_resto where res_id = '$res_id'");
              if(!empty($query))
              {
                $i = 1;
                while($order = mysqli_fetch_array($query))
                {?>
                  <td><?php echo $i++;?></td>
                  <td><?php echo $order['order_date'];?></td>
                  <td><?php echo $meja_resto['meja_name'];?></td>
                  <td><?php echo $order['order_user'];?></td>
                  <td><?php echo number_format($order['order_total'],2);?></td>
                  <td><?php echo $order['order_status'];?></td>
                  <td>
                    <form method="post" action="master_data.php?order_id=<?php echo $order['order_id'];?>">
                        <select name="status_bayar">
                          <option value="none" selected disabled hidden>-Valid/Not Valid-</option>
                          <option value="valid">Valid</option>
                          <option value="not_valid">Tidak Valid</option>
                        </select>
                      <input type="submit" name="ubah_status_bayar" value="Ubah Status">
                    </form>
                  </td>
                  <td>
                    <?php
                    if($order['order_status']=='not_valid')
                    {?>
                      <button id="button-hapus" class="link">
                          <a href="deleteCOrd.php?order_id=<?php echo $order['order_id'];?>">
                          <img src="./images/hapus-icon.png" alt="hapus-icon" style="width: 20px; height: 20px"/>
                        </a>
                        </button>
                      </td>
                   <?php }
                    ?>
                <?php }
              }
              ?>
              </tr> 
            </table>
            <div id="modal-bg-transaksi" class="hidden">
              <div class="modal-bg">
                <div class="modal-container" style="width: fit-content">
                  <form action="">
                    <strong><label for="tanggal">Tanggal</label></strong
                    ><br />
                    <input type="date" style="width: 100%" /><br />
                    <strong><label for="nomormeja">No. Meja</label></strong
                    ><br />
                    <input type="number" name="nomormeja" style="width: 100%" /><br />
                    <strong><label for="nama">Atas Nama</label></strong
                    ><br />
                    <input type="text" name="nama" id="nama" style="width: 100%" />
                    <br />
                    <strong><label for="pesanan">Tambah Pesanan</label></strong
                    ><br />
                    <select name="pesanan" id="pesanan">
                      <option value="none" selected disabled hidden>-Silahkan Pilih Menu-</option>
                      <option value="menu1">Nasi Padang</option>
                    </select>
                    <table>
                      <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Hapus</th>
                      </tr>
                    </table>
                    <div class="flext-row" style="text-align: end; margin-top: 30px">
                      <input class="button-simpan" type="button" value="SIMPAN" />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="laporan-content" class="hidden">
          <div class="laporan-container">
            <h2 style="margin-top: 0px">DATA LAPORAN PEMESANAN</h2>
            <hr width="100%" align-text="center" style="margin-top: -10px; border: solid" />
            <div class="flex-row">
              <input type="date" style="border-radius: 4px; width: 150px; height: 25px; margin-top: 10px; margin-right: auto" />
              <input type="date" style="border-radius: 4px; width: 150px; height: 25px; margin-top: 10px; margin-right: 600px" />
              <a href="#">
                <div class="button-cari flex-row">
                  <button id="button-carilaporan" class="link">
                    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
                    <span class="iconify" data-inline="false" data-icon="akar-icons:search" style="font-size: 24px; color: white"></span>
                  </button>
                </div>
              </a>
              <a href="#">
                <div class="button-cetak flex-row">
                  <button id="button-cetaklaporan" class="link">Cetak Laporan Pemesanan</button>
                </div>
              </a>
            </div>
            <table>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Menu</th>
                <th>Username</th>
                <th>Harga</th>
                <th>Jumlah Beli</th>
                <th>Total</th>
                <th>Hapus</th>
              </tr>
              <tr>
              <?php
              $lapor = mysqli_query($db,"select * from order_menu_resto where rest_id = '$res_id'");
              if(!empty($lapor))
              {
                $i = 1;
                while($order_menu = mysqli_fetch_array($lapor))
                {?>
                <td><?php echo $i++;?></td>
                <td><?php echo $order_menu['order_date'];?></td>
                <td>
                  <?php
                    $m_id = $order_menu['menu_id'];
                    $query = mysqli_query($db,"select * from menu where menu_id='$m_id'");
                    $m_name = mysqli_fetch_assoc($query);
                    if($query)
                    {
                      echo $m_name['menu_name'];
                    }
                  ?>
                </td>
                <td><?php 
                $ord_id = $order_menu['order_id'];
                $om = mysqli_query($db, "select * from order_resto where res_id = '$res_id' and order_id = '$ord_id'");
                if($om)
                {
                  $om_nama = mysqli_fetch_assoc($om);
                  echo $om_nama['order_user'];
                }
                ?></td>
                <td><?php echo number_format($order_menu['menu_price'],2);?></td>
                <td><?php echo $order_menu['menu_qty'];?> porsi</td>
                <td><?php echo number_format($order_menu['menu_qty']*$order_menu['menu_price']);?></td>
                <td><button id="button-hapus" class="link">
                      <a href="deleteOrd.php?order_menu_id=<?php echo $order_menu['order_menu_id'];?>">
                      <img src="./images/hapus-icon.png" alt="hapus-icon" style="width: 20px; height: 20px"/>
                    </a>
                    </button>
                </td>
                <?php }
              }?>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script>
      // nav tabs
      const masterDataLink = document.querySelector("#master-link");
      const dataTransaksiLink = document.querySelector("#transaksi-link");
      const dataLaporanLink = document.querySelector("#laporan-link");

      // content tab container
      const tabContent = document.querySelector("#tab-content-container");

      // masing-masing content tab
      const masterDataContent = document.querySelector("#master-content");
      const dataTransaksiContent = document.querySelector("#transaksi-content");
      const dataLaporanContent = document.querySelector("#laporan-content");

      // Proses saat tab link diklik

      // saat master-data tab diklik akan memunculkan konten master-data
      masterDataLink.addEventListener("click", (e) => {
        e.preventDefault();
        tabContent.style.backgroundColor = "#e6f4f1"; // mengubah warna content tab container
        masterDataContent.classList.remove("hidden");
        dataTransaksiContent.classList.add("hidden");
        dataLaporanContent.classList.add("hidden");
      });

      // saat data-transaksi tab diklik akan memunculkan konten data-transaksi
      dataTransaksiLink.addEventListener("click", (e) => {
        e.preventDefault();
        tabContent.style.backgroundColor = "#ffb990"; // mengubah warna content tab container
        dataTransaksiContent.classList.remove("hidden");
        masterDataContent.classList.add("hidden");
        dataLaporanContent.classList.add("hidden");
      });

      // saat data-laporan tab diklik akan memunculkan konten data-laporan
      dataLaporanLink.addEventListener("click", (e) => {
        e.preventDefault();
        tabContent.style.backgroundColor = "#94b0b2"; // mengubah warna content tab container
        dataLaporanContent.classList.remove("hidden");
        masterDataContent.classList.add("hidden");
        dataTransaksiContent.classList.add("hidden");
      });

      // saat card kategori menu diklik
      const kategoriMenuCard = document.querySelector("#kotak1");
      const menuCard = document.querySelector("#kotak2");
      const kategoriMenuContainer = document.querySelector("#kategori-menu-container");
      const menuContainer = document.querySelector("#menu-container");
      const masterContainer = document.querySelector("#master-container");

      kategoriMenuCard.addEventListener("click", (e) => {
        e.preventDefault();
        masterContainer.classList.add("hidden");
        kategoriMenuContainer.classList.remove("hidden");
      });
      menuCard.addEventListener("click", (e) => {
        e.preventDefault();
        masterContainer.classList.add("hidden");
        menuContainer.classList.remove("hidden");
      });

      // Menambahkan Data Kategori Menu
      // const tambahDataKategori = document.querySelector("#tambah-data-kategori");
      // const modalBgKategori = document.querySelector("#modal-bg-kategori");
      // const buttonSimpanKategori = document.querySelector("#button-simpan-kategori");
      // tambahDataKategori.addEventListener("click", (e) => {
      //   e.preventDefault();
      //   modalBgKategori.classList.remove("hidden");
      // });
      // buttonSimpanKategori.addEventListener("click", (e) => {
      //   e.preventDefault();
      //   modalBgKategori.classList.add("hidden");
      // });

      // Edit Data Kategori Menu
      const editKategori = document.getElementsByClassName("edit-kategori");
      [...editKategori].forEach((edit) => {
        edit.addEventListener("click", (e) => {
          e.preventDefault();
          modalBgKategori.classList.remove("hidden");
        });
      });

      // Menambahkan Data Menu
      // const tambahDataMenu = document.querySelector("#tambah-data-menu");
      // const modalBgMenu = document.querySelector("#modal-bg-menu");
      // const buttonSimpanMenu = document.querySelector("#button-simpan-menu");
      // tambahDataMenu.addEventListener("click", (e) => {
      //   e.preventDefault();
      //   modalBgMenu.classList.remove("hidden");
      // });
      // buttonSimpanMenu.addEventListener("click", (e) => {
      //   e.preventDefault();
      //   modalBgMenu.classList.add("hidden");
      // });

      // Edit Data Menu
      const editMenu = document.getElementsByClassName("edit-menu");
      [...editMenu].forEach((edit) => {
        edit.addEventListener("click", (e) => {
          e.preventDefault();
          modalBgMenu.classList.remove("hidden");
        });
      });

      // keluar dari tampilan kategori menu
      const exitKategoriMenu = document.querySelector("#exit-kategori-menu");
      // const resetKategoriMenu = document.querySelector("#reset-kategori-menu");
      exitKategoriMenu.addEventListener("click", (e) => {
        e.preventDefault();
        masterContainer.classList.remove("hidden");
        kategoriMenuContainer.classList.add("hidden");
      });
      // resetKategoriMenu.addEventListener("click", (e) => {
      //   e.preventDefault();
      //   modalBgKategori.classList.add("hidden");
      // });

      // keluar dari tampilan menu
      const exitMenu = document.querySelector("#exit-menu");
      // const resetMenu = document.querySelector("#reset-menu");
      exitMenu.addEventListener("click", (e) => {
        e.preventDefault();
        masterContainer.classList.remove("hidden");
        menuContainer.classList.add("hidden");
      });
      // resetMenu.addEventListener("click", (e) => {
      //   e.preventDefault();
      //   modalBgMenu.classList.add("hidden");
      // });

      // Menambahkan Data Transaksi
      //const tambahDataTransaksi = document.querySelector("#tambah-data-transaksi");
      // const modalBgTransaksi = document.querySelector("#modal-bg-transaksi");
      // const buttonSimpanTransaksi = document.querySelector("#button-simpan-transaksi");
      // tambahDataTransaksi.addEventListener("click", (e) => {
      //   e.preventDefault();
      //   modalBgTransaksi.classList.remove("hidden");
      // });
      // buttonSimpanTransaksi.addEventListener("click", (e) => {
      //   e.preventDefault();
      //   modalBgTransaksi.classList.add("hidden");
      // });

      // reset data transaksi
      // const resetTransaksi = document.querySelector("#reset-transaksi");
      // resetTransaksi.addEventListener("click", (e) => {
      //   e.preventDefault();
      //   modalBgTransaksi.classList.add("hidden");
      // });

      // Edit Data Transaksi
      const editTransaksi = document.getElementsByClassName("edit-transaksi");
      [...editTransaksi].forEach((edit) => {
        edit.addEventListener("click", (e) => {
          e.preventDefault();
          modalBgTransaksi.classList.remove("hidden");
        });
      });

      // Mengubah button status pembayaran
      const buttonsStatus = document.getElementsByClassName("button-status");
      [...buttonsStatus].forEach((button) => {
        button.addEventListener("click", (e) => {
          e.preventDefault();
          if (button.classList.contains("belum-bayar")) {
            button.innerHTML = "Sudah Bayar";
            button.classList.remove("belum-bayar");
            button.classList.add("sudah-bayar");
          } else {
            button.innerHTML = "Belum Bayar";
            button.classList.remove("sudah-bayar");
            button.classList.add("belum-bayar");
          }
        });
      });
    </script>
  </body>
</html>

