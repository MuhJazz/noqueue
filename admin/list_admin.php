<?php include('super_server.php');?>
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
<table style="width:50%">
              <tr>
                <th>No</th>
                <th>ID Admin</th>
                <th>Username Admin</th>
                <th>Password Admin</th>
                <th>ID Resto</th>
                <th>Hapus</th>
              </tr>
              <tr>
                <?php
			 	$query = mysqli_query($db,"select * from admin_resto");
				 $i = 1;
				 while($adm = mysqli_fetch_assoc($query))
				 {?>
                <td><?php echo $i++?></td>
                <td><?php echo $adm['admin_id'];?></td>
                <td><?php echo $adm['admin_username'];?></td>
                <td><?php echo $adm['admin_password'];?></td>
                <td><?php echo $adm['res_id'];?></td>
                <td>
                  <button id="button-hapus" class="link">
                    <a href="deleteAdmin.php?admin_id=<?php echo $adm['admin_id'];?>">
                      <img src="./images/hapus-icon.png" alt="hapus-icon" style="width: 20px; height: 20px" />
                    </a>
                  </button>
                </td>
              </tr>
              <?php }
			  ?>
</table>
<a href="sign_admin.php">tambah admin</a>
<a href="superpage.php">Kembali</a>
</body>
</html>