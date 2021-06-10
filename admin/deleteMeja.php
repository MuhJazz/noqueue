<?php include('admin_server.php');
    $m_id = $_GET['meja_id'];
    $del_order = mysqli_query($db,"delete from meja_resto where meja_id='$m_id'");
    if($del_order)
    {
        echo "Category Berhasil Dihapus";
        header("location: master_data.php");
    }

?>