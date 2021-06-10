<?php 
session_start();

// initializing variables
$admin_username = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost','root', '', 'noq');
if(!$db){
    die("Unable to connect to database!");
}


// LOGIN USER
if (isset($_POST['login_admin'])) {
  $adm_username = mysqli_real_escape_string($db, $_POST['username_admin']);
  $adm_password = mysqli_real_escape_string($db, $_POST['password_admin']);
  if (empty($adm_username)) {
      array_push($errors, "Username is required");
  }
  if (empty($adm_password)) {
      array_push($errors, "Password is required");
  }
  if (count($errors) == 0) {
      $query = mysqli_query($db,"select * from admin_resto where admin_username='$adm_username' and admin_password='$adm_password'");
      if (mysqli_num_rows($query) == 1) {
        $_SESSION['admin_username'] = $adm_username;
        header('location: master_data.php');
      }else {
          array_push($errors, "Wrong username/password combination");
      }
  }
}
  
  
  //ADD MENU
  
  if(isset($_POST['add_menu'])){
    $menu_category = mysqli_real_escape_string($db,$_POST['categories']);
    $nama_resto = mysqli_real_escape_string($db,$_POST['nama_resto']);
    $menu_name = mysqli_real_escape_string($db, $_POST['nama_menu']);
    $menu_price = mysqli_real_escape_string($db, $_POST['harga_menu']);
    $img = mysqli_real_escape_string($db, $_FILES['menu_images']['name']);
  
    if(empty($menu_name))
    {
      array_push($errors, "Masukan Nama Menu");
    }
    if(empty($menu_price))
      {
        array_push($errors, "Masukan Harga Menu");
      }
    if(empty($menu_category))
      {
        array_push($errors, "Pilih Kategori");
      }
    if(empty($img))
      {
        array_push($errors, "Masukan Gambar");
      }
  
    if (count($errors) == 0) {
        $query = "INSERT INTO menu (menu_name,menu_price,menu_image,res_id,categ_id) VALUES ('$menu_name','$menu_price','$img','$nama_resto','$menu_category')";
        $results = mysqli_query($db, $query);
        if($results)
        {
          move_uploaded_file($_FILES['menu_images']['tmp_name'], "menu_images/$img");
        }
        header('location: master_data.php');
      }
  }

    //ADD MEJA
  
    if(isset($_POST['meja_resto'])){
  
      $r_id = mysqli_real_escape_string($db,$_GET['resto_id']);
      $nama_meja = mysqli_real_escape_string($db,$_POST['nama_meja']);
    
      if(empty($nama_meja))
      {
        array_push($errors, "Masukan Nama Meja");
      }

      $user_check_query = "SELECT * FROM meja_resto WHERE meja_name='$nama_meja' AND res_id = '$r_id' LIMIT 1";
      $result = mysqli_query($db,$user_check_query);
      $mej = mysqli_fetch_assoc($result);
      if($mej) 
      { // if cat exists
        if ($mej['meja_name'] === $nama_meja || $mej['res_id'] === $r_id) 
        {
          array_push($errors, "Nama Meja Telah Ada");
        }
      }

      if (count($errors) == 0) {
          $query = "INSERT INTO meja_resto (meja_name, meja_status, res_id) VALUES ('$nama_meja','free','$r_id')";
          $results = mysqli_query($db, $query);
          if($results)
          {
            header('location:master_data.php'); 
          }
        }
    }

  // ADD CATEGORY
  if(isset($_POST['tambah_cat']))
  {
    $cat_name =  mysqli_real_escape_string($db,$_POST['cat']);
    $rst_id = mysqli_real_escape_string($db,$_POST['rest_id']);

    if(empty($cat_name))
    {
      array_push($errors, "Masukan Nama Kategori");
    }
    $user_check_query = "SELECT * FROM menu_category WHERE category_name='$cat_name' AND r_id = '$rst_id' LIMIT 1";
    $result = mysqli_query($db,$user_check_query);
    $cat = mysqli_fetch_assoc($result);
    if($cat) 
    { // if cat exists
      if ($cat['category_name'] === $cat_name || $cat['r_id'] === $rst_id) 
      {
        array_push($errors, "Username telah diambil");
        header("location: master_data.php");
      }
    }
    if(empty($cat_name))
    {
      array_push($errors,"Masukan Kategori");
    }

    if (count($errors) == 0)
    {
      $query = "INSERT INTO menu_category (category_name,r_id) VALUES ('$cat_name','$rst_id')";
      $result = mysqli_query($db,$query);
      if($result)
      {
        echo "Kategori Berhasil Ditambahkan";
      }
    }
  }

// STATUS RESTO
if(isset($_POST['ubah_status']))
{
  $r_id = mysqli_real_escape_string($db,$_GET['resto_id']);
  $sts =  mysqli_real_escape_string($db,$_POST['status']);
  $query = mysqli_query($db,"update restoran set resto_status='$sts' where resto_id='$r_id'");
  if($query)
  {
    echo "Status Resto Berubah";
    header("location: master_data.php");
  }
}

//STATUS BAYAR
if(isset($_POST['ubah_status_bayar']))
{
  $o_id = mysqli_real_escape_string($db,$_GET['order_id']);
  $status = mysqli_real_escape_string($db,$_POST['status_bayar']);
  $query = mysqli_query($db,"update order_resto set order_status='$status' where order_id = '$o_id'");
  if($query)
  {
    $input = mysqli_query($db,"select * from order_resto where order_id = '$o_id'");
    if($input)
    {
      $cek = mysqli_fetch_assoc($input);
      if($cek['order_status']=='valid')
      {
        $m_id = $cek['order_meja'];
        $meja = mysqli_query($db,"update meja_resto set meja_status='reserved' where meja_id='$m_id'");
        if($meja)
        {
          header("location: master_data.php");
        }
      }
      if($cek['order_status']=='not_valid')
      {
        $hapus = mysqli_query($db,"delete from order_menu_resto where order_id = '$o_id'");
        if($hapus)
        {
          echo 'pesanan dibatalkan';
        }
        $m_id = $cek['order_meja'];
        $meja = mysqli_query($db,"update meja_resto set meja_status='free' where meja_id='$m_id'");
        if($meja)
        {
          header("location: master_data.php");
        }
      }
    }
  }
}
//UPDATE MENU
if(isset($_POST['update_menu']))
{
  $m_id = mysqli_real_escape_string($db,$_GET['menu_id']);
  $nama_menu = mysqli_real_escape_string($db,$_POST['update_nama']);
  $gambar_menu = mysqli_real_escape_string($db,$_FILES['update_gambar']['name']);
  $harga_menu = mysqli_real_escape_string($db,$_POST['update_harga']);
  if(empty($nama_menu))
  {
    array_push($errors,"Silahkan Masukkan Nama Menu");
  }
  if(empty($harga_menu))
  {
    array_push($errors,"Silahkan Masukkan Harga");
  }
  if (count($errors) == 0)
  {
    if(empty($gambar_menu))
    {
      $query = mysqli_query($db,"update menu set menu_name = '$nama_menu', menu_price='$harga_menu' where menu_id='$m_id'");
      if($query)
      {
        echo 'Menu Berhasil Di Ubah';
        header("location:master_data.php");
      }
    }
    else
    {
      $delete = mysqli_query($db, "select menu_image from menu where menu_id='$m_id'");
      $del = mysqli_fetch_assoc($delete);
      $del_img = "menu_images/".$del['menu_image'];
      unlink($del_img);

      $query = mysqli_query($db,"update menu set menu_name = '$nama_menu', menu_price='$harga_menu', menu_image='$gambar_menu' where menu_id='$m_id'");
      if($query)
      {
        echo 'Menu Berhasil Di Ubah';
        move_uploaded_file($_FILES['update_gambar']['tmp_name'], "menu_images/$gambar_menu");
        header("location:master_data.php");
      }
    }
  }
}
?>