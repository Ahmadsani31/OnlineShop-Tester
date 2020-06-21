<?php
if (!isset($_SESSION['user'])) {
  echo "<script> alert('Anda Harus Login Dahulu');
            window.location.href='login.php';
          </script>";
}
//echo"<pre>";
//print_r($_SESSION['user']);
//echo"</pre>";
$idUser = $_SESSION['user']['id'];

?>
<div class='panel panel-border panel-primary'>
<div class="panel-heading"><h3>Detail Keranjang Belanja</h3></div>
<table class="table table-hover table-condensed">
<tr>
					<th>No Pesanan</th>
					<th>Biodata User</th>
					<th>Alamat</th>
					<th>Kota</th>
					<th>Akun Bank</th>
          <th>Date / Time</th>
          <th>Jumlah</th>
          <th><center>Total</center></th>
          <th><center>Status</center></th>
					<th>Opsi</th>
				</tr>
			    <?php
				//MENAMPILKAN DETAIL KERANJANG BELANJA//
                
    $total = 0;
    //mysql_select_db($database_conn, $conn);

        $no=1;

        $query = mysqli_query($conn, "SELECT * FROM cart WHERE idUser = '$idUser'") or die (mysqli_error($conn));
        while ($check = mysqli_fetch_array($query)) {
            $queryJml = mysqli_query($conn, "SELECT * FROM checkout WHERE idCart ='$check[idCart]'");
            $jml = mysqli_num_rows($queryJml);
            $jmlArray = mysqli_fetch_array($queryJml);

            $queryUser = mysqli_query($conn, "SELECT * FROM guest WHERE id ='$jmlArray[idUser]' ")or die(mysqli_error($conn));
            $sqlUser = mysqli_fetch_array($queryUser);

       $dateJam = $check['dateCart'];
       $year = explode(' ', $dateJam);
       $tahunUser = $year['0'];
       $tahun = explode('-', $dateJam);
       $tgl = $tahun['2'];
       $waktu = explode(' ',$tgl); 
       $jam = $waktu['1'];

            $pro = $jmlArray['status'];



//echo"<pre>";
//print_r($pro);
//echo"</pre>";
            ?>
                <tr>
                <td rowspan="3"><center><?php echo $check['noPembelian']; ?></center></td>
                <td><?php echo $sqlUser['nama']; ?></td>       
                <td width="250" rowspan="3"><?php echo $check['almtUser']; ?></td>
                <td rowspan=""><?php echo $check['kodePosUser']; ?></td>
                
                <td rowspan=""><?php echo $check['bankUser']; ?></td>
                
                
                <td rowspan=""><?php echo $tahunUser; ?></td>
                <td ><center><?php echo $jml; ?></center> </td>
                <td rowspan="">Rp. <?php echo number_format($check['jumlah']); ?></td>
               <td >
                <?php 
                if ($pro == 1) {  $nilai = 'ON Proses';  ?>
                <div class="btn btn-warning"><?php echo $nilai ?>
                  <?php }elseif ($pro == 2 ) { $nilai = 'Di Kirim'; ?>
                <div class="btn btn-success"><?php echo $nilai ?>
                   <?php } ?>
                </div></td>
                <td><center>
                	<a href="?p=riwayatdetail&idCart=<?php echo $check[idCart] ?>" class="btn btn-xs btn-success">Lihat</a></center></td>
                </tr>
                <tr>
                	<td><?php echo $check['emailUser']; ?></td>
                	<td><?php echo $check['kotaUser']; ?></td>
                	<td ><?php echo $check['rekUser']; ?></td>
                  <td ><?php echo $jam; ?></td>
                </tr>
                <tr>
                	<td colspan="3"><?php echo $check['tlpUser']; ?></td>
					<td ><?php echo $check['nmrekUser']; ?></td>
          

					<?php
         $total =  $check['jumlah'];
                     }
                     if($total == 0){
                    echo '<tr><td colspan="9" align="center">Ups, Keranjang kosong!</td></tr></table>';
                   
                }
            
                
				?>

</table>
</div>