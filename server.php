<?php 
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost','root', '', 'noq');
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
        $delete = mysqli_query($db, "select user_image from users where username='$user'");
        $del = mysqli_fetch_assoc($delete);
        $del_img = "user_images/".$del['user_image'];
        unlink($del_img);
        
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

  //ADD CART
  $menu_ids = array();  
  if(isset($_POST['add_to_cart']))
  { 
    if(isset($_SESSION['cart']))
    {
      $count = count($_SESSION['cart']); 
      $menu_ids = array_column($_SESSION['cart'],'menu_id');
      if(!in_array($_GET['menu_id'], $menu_ids))
      {
        $_SESSION['cart'][$count] = array(
          'resto_id' => $_GET['resto_id'],
          'menu_id' => $_GET['menu_id'],
          'nama_menu' => $_POST['nama_menu'],
          'harga_menu' => $_POST['harga_menu'],
          'qty_menu' => $_POST['qty_menu']
        );
      }
      else
      {
        for($i=0 ; $i < count($menu_ids); $i++)
        {
          if($menu_ids[$i]==$_GET['menu_id'])
          {
            $_SESSION['cart'][$i]['qty_menu'] += $_POST['qty_menu'];
          }
        }
      }
    }
    else
    {
      $_SESSION['cart'][0] = array(
        'resto_id' => $_GET['resto_id'],
        'menu_id' => $_GET['menu_id'],
        'nama_menu' => $_POST['nama_menu'],
        'harga_menu' => $_POST['harga_menu'],
        'qty_menu' => $_POST['qty_menu']
      );
    }
  }
  if(isset($_GET['action']))  
  {
    if($_GET['action']=='del-cart')
    {
      foreach($_SESSION['cart'] as $key => $m)
      {
        if($m['menu_id'] == $_GET['menu_id'])
        {
          unset($_SESSION['cart'][$key]);
        }
      }
      $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
  }
// ADD ORDER
if(isset($_POST['checkout']))
{
  $time = $_POST['waktu_pemesanan'];
  $meja = $_POST['meja_resto'];
  $ctt = $_POST['catatan'];
  $total = $_POST['total_payment'];
  $user = $_SESSION['username'];
  $payment = $_POST['metode_pembayaran'];
  $res = $_GET['resto_id'];
  if(empty($time))
  {
    array_push($errors, "Silahkan Pilih Waktu Makan Ditempat");
  }
  if(empty($meja))
  {
    array_push($errors, "Silahkan Pilih Meja");
  }
  if(count($errors)==0)
  {
    $order = "INSERT INTO order_resto (order_user, order_total, order_meja, order_waktu, order_catatan, order_payment, res_id) 
    VALUES('$user','$total', '$meja', '$time', '$ctt', '$payment', '$res')";

    if(mysqli_query($db,$order))
    {
      $orderid = mysqli_insert_id($db);
      if(!empty($_SESSION['cart']))
      {
        foreach($_SESSION['cart'] as $key => $value)
        {
          $m_id = $value['menu_id'];
          $m_p = $value['harga_menu'];
          $m_qty = $value['qty_menu'];
          $r_id = $value['resto_id'];
          $orderItem = "INSERT INTO order_menu_resto (order_id, menu_id, menu_price, menu_qty, rest_id) 
          VALUES('$orderid','$m_id','$m_p','$m_qty','$r_id')";
          if(mysqli_query($db,$orderItem))
          {
            $_SESSION['orderid'] = $orderid;
            echo 'Pesanan Ditambahkan';
          }
        }
      }
    }
  }
}
// PEMBAYARAN
if(isset($_POST['bayar']))
{
  $user = $_SESSION['username'];
  $id = $_SESSION['orderid'];
  $bukti = mysqli_real_escape_string($db,$_FILES['bukti']['name']);
  if (empty($bukti)) {
    array_push($errors, "Silahkan upload bukti bayar terlebih dahulu");
  }
  if(count($errors) == 0)
  {
    $test = mysqli_query($db,"select * from order_resto where order_id='$id'");
    $htest = mysqli_fetch_assoc($test);
    if(empty($htest['order_bukti_bayar']))
    {
      $query = "UPDATE order_resto SET order_bukti_bayar='$bukti', order_status='sedang verif' WHERE order_id='$id'";
      $result = mysqli_query($db,$query);
      if($result)
      {
         move_uploaded_file($_FILES['bukti']['tmp_name'], "admin/bukti_bayar/$bukti");
         header("Location: homepage.php");
         unset($_SESSION['cart']);
         unset($_SESSION['orderid']);
      }
    }
  }
}
?>
