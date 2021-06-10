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
                <th>ID Resto</th>
                <th>Nama Resto</th>
                <th>Status Resto</th>
                <th>Alamat Resto</th>
                <th>Nomor Resto</th>
                <th>ID Loc Resto</th>
                <th>Hapus</th>
              </tr>
              <tr>
                <?php
			 	$query = mysqli_query($db,"select * from restoran");
				 $i = 1;
				 while($res = mysqli_fetch_assoc($query))
				 {?>
                <td><?php echo $i++?></td>
                <td><?php echo $res['resto_id'];?></td>
                <td><?php echo $res['resto_name'];?></td>
                <td><?php echo $res['resto_status'];?></td>
                <td><?php echo $res['resto_address'];?></td>
                <td><?php echo $res['resto_number'];?></td>
                <td><?php echo $res['loc_id'];?></td>
                <td>
                  <button id="button-hapus" class="link">
                    <a href="deleteResto.php?resto_id=<?php echo $res['resto_id'];?>">
                      <img src="./images/hapus-icon.png" alt="hapus-icon" style="width: 20px; height: 20px" />
                    </a>
                  </button>
                </td>
              </tr>
              <?php }
			  ?>
</table>
<a href="restoran.php">tambah resto</a>
<a href="superpage.php">Kembali</a>
</body>
</html>