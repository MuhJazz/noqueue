<?php include('super_server.php');
    $r_id = $_GET['resto_id'];

    $delete = mysqli_query($db, "select resto_image from restoran where resto_id='$r_id'");
    $del = mysqli_fetch_assoc($delete);
    $del_img = "images/".$del['resto_image'];
    unlink($del_img);

    $del_order = mysqli_query($db,"delete from restoran where resto_id='$r_id'");
    if($del_order)
    {
        echo "Category Berhasil Dihapus";
        header("location: list_resto.php");
    }

?>