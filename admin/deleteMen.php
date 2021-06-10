<?php include('admin_server.php');
    $m_id = $_GET['menu_id'];

    $delete = mysqli_query($db, "select menu_image from menu where menu_id='$m_id'");
    $del = mysqli_fetch_assoc($delete);
    $del_img = "menu_images/".$del['menu_image'];
    unlink($del_img);

    $del_men = mysqli_query($db,"delete from menu where menu_id='$m_id'");
    if($del_men)
    {
        echo "Category Berhasil Dihapus";
        header("location: master_data.php");
    }

?>