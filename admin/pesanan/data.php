<?php

$aksi="katagori/proses.php";
     $p=isset($_GET["aksi"])?$_GET["aksi"]:null;
     switch($p){
default:
?>

<div class="panel panel-border panel-primary">
    <div class="panel-heading"> 
        <div class="title"><h3>Pesanan Baru</h3></div>
    </div>  
    <div class="panel-body"> 
		<div class="panel-body"> 
            <table id="" class="table table-hover">
             <thead>
              <tr>
			<th>No</th>
			<th>Nama Pemesan</th>
            <th>Alamat</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Status</th>
             <th>Aksi</th>
             </tr>
             </thead>
             <tbody>
	<?php
$i=1;
$tp=mysqli_query($conn, "SELECT * FROM cart")or die(mysqli_error($conn));
while($r=mysqli_fetch_array($tp)){
    $queryCheckout = mysqli_query($conn, "SELECT * FROM checkout WHERE idCart ='$r[idCart]' ")or die(mysqli_error($conn));
        $sqlCheckout = mysqli_num_rows($queryCheckout);
        $checkoutArray = mysqli_fetch_array($queryCheckout);

        $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE id ='$sqlCheckout[idProduk]' ")or die(mysqli_error($conn));
            $sqlProduk = mysqli_fetch_array($queryProduk);

        $queryUser = mysqli_query($conn, "SELECT * FROM guest WHERE id ='$checkoutArray[idUser]' ")or die(mysqli_error($conn));
            $sqlUser = mysqli_fetch_array($queryUser);

           $pro = $checkoutArray['status'];

	?>
	<tr> 
	 <td><?php echo $i;?></td>
	 <td><?php echo $sqlUser["nama"];?></td>
     <td><?php echo $r["almtUser"];?></td>
     <td><?php echo $sqlCheckout;?></td>
     <td><?php echo $r["jumlah"];?></td>
               <td >
                <?php 
                if ($pro == 1) {  $nilai = 'ON Proses';  ?>
                <div class="btn btn-warning"><?php echo $nilai ?>
                  <?php }elseif ($pro == 2 ) { $nilai = 'Di Kirim'; ?>
                <div class="btn btn-success"><?php echo $nilai ?>
                   <?php } ?>
                </div></td>
	 <td><a class="btn btn-primary" href="?p=onProses&idCart=<?php echo $r[idCart] ?>">Lihat</td>
	</tr>
	<?php $i=$i+1;?>
	<?php } ?>
			</tbody>
           </table>
        </div><!-- /.box-body -->
     </div><!-- /.box -->   						 
  </div>

<?php
break;
}
?>

 
 