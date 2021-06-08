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

// REGISTER USER
if (isset($_POST['reg_admin'])) {
  // receive all input values from the form
  $nama = $_POST['nama_resto'];
  $admin_username = $_POST['username_resto'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($admin_username)) { array_push($errors, "Username is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
    array_push($errors, "Password tidak sama");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM admin_resto WHERE admin_username='$admin_username' OR res_id='$nama' LIMIT 1";
  $result = mysqli_query($db,$user_check_query);
  $admin = mysqli_fetch_assoc($result);
  
  if ($admin) { // if user exists
    if ($admin['admin_username'] === $admin_username) {
      array_push($errors, "Username telah diambil");
    }
    if ($admin['res_id'] === $nama) {
      array_push($errors, "Restoran telah memiliki admin");
    }
  }
  
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
      //$password = md5($password_1);//encrypt the password before saving in the database
      $query = "INSERT INTO admin_resto (admin_username, admin_password, res_id) 
                VALUES('$admin_username','$password_1','$nama')";
      $results = mysqli_query($db, $query);
      $_SESSION['admin_username'] = $admin_username;
      header('location: login_admin.php');
  }
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
        $_SESSION['admin_username'] = $admin_username;
        header('location: sign_admin.php');
      }else {
          array_push($errors, "Wrong username/password combination");
      }
  }
}
  //ADD RESTO

  if(isset($_POST['add_resto'])){

    $lokasi_resto = mysqli_real_escape_string($db,$_POST['lokasi_resto']);
    $resto_name = mysqli_real_escape_string($db, $_POST['nama_resto']);
    $resto_address = mysqli_real_escape_string($db, $_POST['alamat_resto']);
    $resto_number = mysqli_real_escape_string($db, $_POST['nomor_resto']);
    $resto_open = mysqli_real_escape_string($db, $_POST['open_resto']);
    $img_ovo = mysqli_real_escape_string($db, $_FILES['resto_ovo']['name']);
    $img_gopay = mysqli_real_escape_string($db, $_FILES['resto_gopay']['name']);
    $img = mysqli_real_escape_string($db, $_FILES['resto_image']['name']);
  
    if(empty($resto_name))
      array_push($errors, "Masukan Nama");
    if(empty($resto_address))
      array_push($errors, "Masukan Alamat");
    if(empty($resto_number))
      array_push($errors, "Masukan Nomor");
    if(empty($resto_open))
      array_push($errors, "Masukan Jam Buka Resto");
      
    if (count($errors) == 0) {
        $query = "INSERT INTO restoran (resto_name,resto_address,resto_number,resto_image,resto_open,loc_id,qr_ovo,qr_gopay) 
        VALUES ('$resto_name','$resto_address','$resto_number','$img','$resto_open','$lokasi_resto','$img_ovo', '$img_gopay')";
        $results = mysqli_query($db, $query);
        if($results)
        {
          move_uploaded_file($_FILES['resto_image']['tmp_name'], "images/$img");
          move_uploaded_file($_FILES['resto_ovo']['tmp_name'], "qr_ovo_resto/$img_ovo");
          move_uploaded_file($_FILES['resto_gopay']['tmp_name'], "qr_gopay_resto/$img_gopay");
        }
        header('location: restoran.php');
      }
  }
  
    //ADD KOTA RESTO
  if (isset($_POST['resto_loc'])){
  
    $loc_name = mysqli_real_escape_string($db, $_POST['loc_name']);
  
    if (empty($loc_name)) {
      array_push($errors, "Masukan Kota");
  }
    $user_check_query = "SELECT * FROM restoran_loc WHERE loc_name='$loc_name' LIMIT 1";
    $result = mysqli_query($db,$user_check_query);
    $user = mysqli_fetch_assoc($result);
      if ($user) { // if user exists
        if ($user['loc_name'] === $loc_name) {
          array_push($errors, "Kota sudah ada");
        }
      }
        
      if (count($errors) == 0) {
        $query = "INSERT INTO restoran_loc (loc_name) VALUES ('$loc_name')";
        $results = mysqli_query($db, $query);
        header('location: homepage.php');
      }
    }
  
  //ADD MENU
  
  if(isset($_POST['add_menu'])){
  
    $nama_resto = mysqli_real_escape_string($db,$_POST['nama_resto']);
    $menu_name = mysqli_real_escape_string($db, $_POST['nama_menu']);
    $menu_price = mysqli_real_escape_string($db, $_POST['harga_menu']);
    $menu_desc = mysqli_real_escape_string($db, $_POST['desc_menu']);
    $img = mysqli_real_escape_string($db, $_FILES['menu_image']['name']);
  
    if(empty($menu_name))
      array_push($errors, "Masukan Nama Menu");
    if(empty($menu_price))
      array_push($errors, "Masukan Harga Menu");
    if(empty($menu_desc))
      array_push($errors, "Masukan Deskripsi Menu");
    if(empty($img))
      array_push($errors, "Masukan Gambar Menu");
  
    if (count($errors) == 0) {
        $query = "INSERT INTO menu (menu_name,menu_price,menu_desc,menu_image,res_id) VALUES ('$menu_name','$menu_price','$menu_desc','$img','$nama_resto')";
        $results = mysqli_query($db, $query);
        if($results)
        {
          move_uploaded_file($_FILES['menu_image']['tmp_name'], "menu_images/$img");
        }
        header('location: menu.php');
      }
  }

    //ADD MEJA
  
    if(isset($_POST['meja_resto'])){
  
      $nama_resto = mysqli_real_escape_string($db,$_POST['nama_resto']);
      $nama_meja = mysqli_real_escape_string($db,$_POST['nama_meja']);
    
      //if(!empty($nama_meja))
      //{
       // $reser = "UPDATE meja_resto SET meja_status='reserved' WHERE meja_id='4' AND res_id='2'";
       // $res = mysqli_query($db, $reser);
       // if($res)
      //  {
     //   array_push($errors, "Masukan Nama Meja");
        //}
     // }
    
      if (count($errors) == 0) {
          $query = "INSERT INTO meja_resto (meja_name, meja_status, res_id) VALUES ('$nama_meja','free','$nama_resto')";
          $results = mysqli_query($db, $query);
          if($results)
          {
            header('location: add_meja.php'); 
          }
        }
    }
?>