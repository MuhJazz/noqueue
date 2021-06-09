<?php include('admin_server.php');
    $c_id = $_GET['category_id'];
    $del_cat = mysqli_query($db,"delete from menu_category where category_id='$c_id'");
    if($del_cat)
    {
        echo "Category Berhasil Dihapus";
        header("location: master_data.php");
    }

?>