<?php 
session_start();

// initializing variables
$sadm_username = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost','root', '', 'noq');
if(!$db){
    die("Unable to connect to database!");
}
//login
if (isset($_POST['login_super_admin'])) {
    $sadm_username = mysqli_real_escape_string($db, $_POST['username_super_admin']);
    $sadm_password = mysqli_real_escape_string($db, $_POST['password_super_admin']);
    if (empty($sadm_username)) {
        array_push($errors, "Username is required");
    }
    if (empty($sadm_password)) {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {
        $query = mysqli_query($db,"select * from super_admin where super_name='$sadm_username' and super_pass='$sadm_password'");
        if (mysqli_num_rows($query) == 1) {
          $_SESSION['sadmin_username'] = $sadm_username;
          header('location: superpage.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
// tambah lokasi
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
        header('location: list_loc_resto.php');
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
        $query = "INSERT INTO restoran (resto_name,resto_status,resto_address,resto_number,resto_image,resto_open,loc_id,qr_ovo,qr_gopay) 
        VALUES ('$resto_name','buka','$resto_address','$resto_number','$img','$resto_open','$lokasi_resto','$img_ovo', '$img_gopay')";
        $results = mysqli_query($db, $query);
        if($results)
        {
          move_uploaded_file($_FILES['resto_image']['tmp_name'], "images/$img");
          move_uploaded_file($_FILES['resto_ovo']['tmp_name'], "qr_ovo_resto/$img_ovo");
          move_uploaded_file($_FILES['resto_gopay']['tmp_name'], "qr_gopay_resto/$img_gopay");
        }
        header('location: list_resto.php');
      }
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