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
  //ADD RESTO

  if(isset($_POST['add_resto'])){

    $lokasi_resto = mysqli_real_escape_string($db,$_POST['lokasi_resto']);
    $resto_name = mysqli_real_escape_string($db, $_POST['nama_resto']);
    $resto_address = mysqli_real_escape_string($db, $_POST['alamat_resto']);
    $resto_number = mysqli_real_escape_string($db, $_POST['nomor_resto']);
    $resto_open = mysqli_real_escape_string($db, $_POST['open_resto']);
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
        $query = "INSERT INTO restoran (resto_name,resto_address,resto_number,resto_image,resto_open,loc_id) 
        VALUES ('$resto_name','$resto_address','$resto_number','$img','$resto_open','$lokasi_resto')";
        $results = mysqli_query($db, $query);
        if($results)
        {
          move_uploaded_file($_FILES['resto_image']['tmp_name'], "images/$img");
        }
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
        $_SESSION['username'] = $username;
        header('location: menu.php');
      }
  }
?>