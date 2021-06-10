<?php include('super_server.php');
    $a_id = $_GET['admin_id'];
    $del_order = mysqli_query($db,"delete from admin_resto where admin_id='$a_id'");
    if($del_order)
    {
        echo "Category Berhasil Dihapus";
        header("location: list_resto.php");
    }

?>