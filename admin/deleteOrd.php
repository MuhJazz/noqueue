<?php include('admin_server.php');
    $o_id = $_GET['order_menu_id'];
    $del_order = mysqli_query($db,"delete from order_menu_resto where order_menu_id='$o_id'");
    if($del_order)
    {
        echo "Category Berhasil Dihapus";
        header("location: master_data.php");
    }

?>