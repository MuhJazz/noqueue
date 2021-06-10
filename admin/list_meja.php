<?php include('admin_server.php');
$res_id = mysqli_real_escape_string($db,$_GET['resto_id']);
?>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
}
td{
    text-align:center;
}
</style>
</head>
<body>
<?php 
  if (!isset($_SESSION['admin_username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login_admin.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['admin_username']);
  	header("location: login_admin.php");
  }
?>
<table style="width:50%">
              <tr>
                <th>No</th>
                <th>ID Meja</th>
                <th>Nama Meja</th>
                <th>Status Meja</th>
                <th>Hapus Meja</th>
              </tr>
              <tr>
                <?php
			 	$query = mysqli_query($db,"select * from meja_resto where res_id='$res_id'");
				 $i = 1;
				 while($mej = mysqli_fetch_assoc($query))
				 {?>
                <td><?php echo $i++?></td>
                <td><?php echo $mej['meja_id'];?></td>
                <td><?php echo $mej['meja_name'];?></td>
                <td><?php echo $mej['meja_status'];?></td>
                <td>
                  <button id="button-hapus" class="link">
                    <a href="deleteMeja.php?meja_id=<?php echo $mej['meja_id'];?>">
                      <img src="./images/hapus-icon.png" alt="hapus-icon" style="width: 20px; height: 20px" />
                    </a>
                  </button>
                </td>
              </tr>
              <?php }
			  ?>
</table>
<a href="add_meja.php?resto_id=<?php echo $res_id;?>">Tambah Meja Resto</a>
<a href="master_data.php">Kembali</a>
</body>
</html>