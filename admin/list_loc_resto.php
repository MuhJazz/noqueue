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
                <th>ID Lokasi</th>
                <th>Nama Lokasi</th>
              </tr>
              <tr>
                <?php
			 	$query = mysqli_query($db,"select * from restoran_loc");
				 $i = 1;
				 while($loc = mysqli_fetch_assoc($query))
				 {?>
                <td><?php echo $i++?></td>
                <td><?php echo $loc['loc_id'];?></td>
                <td><?php echo $loc['loc_name'];?></td>
              </tr>
              <?php }
			  ?>
</table>
<a href="restoran_loc.php">tambah lokasi</a>
<a href="superpage.php">Kembali</a>
</body>
</html>