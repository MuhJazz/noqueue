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
    $img = $_FILES['user_image']['name'];
  
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if (empty($img)) { array_push($errors, "Foto Profil is required"); }
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
        move_uploaded_file($_FILES['user_image']['tmp_name'], "user_images/$img");
        $query = "INSERT INTO users (nama, username, email, password, no_hp, user_image) 
                  VALUES('$nama','$username', '$email', '$password', '$no_hp', '$img')";
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
  //PASS EDIT
  if(isset($_POST['pass_edit']))
  {
    $user = mysqli_real_escape_string($db,$_SESSION['username']);
    $cur_pass = mysqli_real_escape_string($db,$_POST['current_password']);
    $new_pass = mysqli_real_escape_string($db,$_POST['new_password']);
    $new_pass_1 = mysqli_real_escape_string($db,$_POST['new_password_1']);

    $query = "SELECT * FROM users WHERE username='$user'";
    $results = mysqli_query($db, $query);
    $users = mysqli_fetch_array($results);

    $cur_pass = md5($cur_pass);

    if (empty($cur_pass)) {
      array_push($errors, "Current Pass is required");
    }
    if (empty($new_pass)) {
      array_push($errors, "Pass is required");
    }
    if (empty($new_pass_1)) {
      array_push($errors, "Confirm Pass is required");
    }
    if ($new_pass != $new_pass_1) {
      array_push($errors, "Password tidak sama");
    }
    if($cur_pass != $users['password']){
      array_push($errors, "Current Password salah");
    }

    if(count($errors) == 0)
    {
      $new_pass = md5($new_pass);
      $pass_updt = mysqli_query($db,"UPDATE users SET password='$new_pass' WHERE username='$user' AND password='$cur_pass'");
          if($pass_updt)
        {
          session_destroy();
          header("location: index.php");
        }
    }
    else
    {
       array_push($errors, "gagal update password");
    }
  }
// IMAGE PROFILE EDIT
if(isset($_POST['img_edit']))
{
  $user = mysqli_real_escape_string($db,$_SESSION['username']);
  $img = mysqli_real_escape_string($db,$_FILES['user_image']['name']);
  if (empty($img)) {
    array_push($errors, "Foto Profil is required");
  }
  if(count($errors) == 0)
      {
        $query = "UPDATE users SET user_image='$img' WHERE username='$user'";
        $result = mysqli_query($db,$query);
        if($result)
        {
          move_uploaded_file($_FILES['user_image']['tmp_name'], "user_images/$img");
          header("Location: profile.php");
        }
        else 
        {
          array_push($errors, "Gagal Update");
        }
      }
}
 // PROFILE EDIT
  if(isset($_POST['edit']))
  {
    $user = mysqli_real_escape_string($db,$_SESSION['username']);
    $nama = mysqli_real_escape_string($db,$_POST['nama']);
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $no_hp = mysqli_real_escape_string($db,$_POST['no_hp']);

    if (empty($nama)) {
        array_push($errors, "Name is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($no_hp)) {
        array_push($errors, "Nomor HP is required");
    }
      if(count($errors) == 0)
      {
        $query = "UPDATE users SET nama='$nama', email='$email', no_hp='$no_hp' WHERE username='$user'";
        $result = mysqli_query($db,$query);
        if($result)
        {
          header("Location: profile.php");
        }
        else 
        {
          array_push($errors, "Gagal Update");
        }
      }
  }
?>
