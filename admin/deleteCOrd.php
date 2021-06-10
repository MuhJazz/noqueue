<?php include('admin_server.php');
    $od_id = $_GET['order_id'];
    $del_corder = mysqli_query($db,"delete from order_resto where order_id='$od_id'");
    if($del_corder)
    {
        echo "Category Berhasil Dihapus";
        header("location: master_data.php");
    }

?>