<?php 
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost','root', 'subhan2122', 'noq');
if(!$db){
    die("Unable to connect to database!");
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $no_hp = $_POST['no_hp'];
  
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
      array_push($errors, "Password tidak sama");
    }
  
    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db,$user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) { // if user exists
      if ($user['username'] === $username) {
        array_push($errors, "Username telah diambil");
      }
  
      if ($user['email'] === $email) {
        array_push($errors, "Email telah diambil");
      }
    }
  
    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database
  
        $query = "INSERT INTO users (nama, username, email, password, no_hp) 
                  VALUES('$nama','$username', '$email', '$password', '$no_hp')";
        $results = mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        header('location: login.php');
    }
  }
  // LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          header('location: homepage.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }


  //ADD RESTO

if(isset($_POST['add_resto'])){
    $filename = $_FILES['resto_image']['name'];
    $filetmpname = $_FILES['resto_image']['tmp_name'];
    $folder = 'images/';

    $q = "INSERT INTO restoran ('resto_image') VALUES ('$file')";
    $res = mysqli_query($db,$q);
    if($res)
      {
        move_uploaded_file($filetmpname, $folder.$filename);
        $msg = "Foto Terupload";
      }
      else{
        $msg = "Foto gagal";
      }

  $lokasi_resto = mysqli_real_escape_string($db,$_POST['lokasi_resto']);
  $resto_name = mysqli_real_escape_string($db, $_POST['nama_resto']);
  $resto_address = mysqli_real_escape_string($db, $_POST['alamat_resto']);
  $resto_number = mysqli_real_escape_string($db, $_POST['nomor_resto']);

  if(empty($resto_name))
    array_push($errors, "Masukan Nama");
  if(empty($resto_address))
    array_push($errors, "Masukan Alamat");
  if(empty($resto_number))
    array_push($errors, "Masukan Nomor");

  if (count($errors) == 0) {
      $query = "INSERT INTO restoran (resto_name,resto_address,resto_number,loc_id) VALUES ('$resto_name','$resto_address','$resto_number','$lokasi_resto')";
      $results = mysqli_query($db, $query);
      $_SESSION['username'] = $username;
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
      $_SESSION['username'] = $username;
      header('location: homepage.php');
    }
  }
?>
