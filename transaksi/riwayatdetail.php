<?php
if (!isset($_SESSION['user'])) {
  echo "<script> alert('Anda Harus Login Dahulu');
            window.location.href='login.php';
          </script>";
}

$idUser = $_SESSION['user']['id'];
  $queryUser = mysqli_query($conn, "SELECT * FROM guest WHERE id = '$idUser'") or mysql_error($conn);
  $sqlUser = mysqli_fetch_array($queryUser);

  $nota = mysqli_query($conn, "SELECT * FROM cart WHERE idUser = '$sqlUser[id]'") or mysql_error($conn);
  $sqlNota = mysqli_fetch_array($nota);
  $idCart = $sqlNota['idCart'];




?>

<div class='panel panel-border panel-primary'>
  <div class='panel-heading'> 
    <h3 class='panel-title'><h3>Nota</h3></h3> 
  </div>  
  <div class='panel-body'> 
  	<div class="col-md-8">


<table style="font-style: bold;">
<tr>
        <tr>
            <td width="200">Nama</</td>
            <td width="20"><h5>:</h5></td>
            <td><?php echo $sqlUser['nama']; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td width="20">:</td>
            <td><?php echo $sqlUser['gmail']; ?></td>
        </tr>
        <tr>
            <td>No Telpon</td>
            <td width="20"><h5>:</td>
            <td><?php echo $sqlUser['nope']; ?></td>
        </tr>
        <tr>
            <td>Kode Pos</td>
            <td width="20">:</td>
            <td><?php echo $sqlNota['kodePosUser']; ?></td>
        </tr>
        <tr>
            <td>Kota</td>
            <td width="20">:</td>
            <td><?php echo $sqlNota['kotaUser']; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td width="20">:</td>
            <td><?php echo $sqlNota['almtUser']; ?></td>
        </tr>
</table>
</div>
  </div> 
  <table class="table table-hover table-condensed">
<tr>
          <th><center>No Pembelian</center></th>
          <th><center>Nama Barang</center></th>
          <th><center>Jumlah</center></th>
          <th><center>Harga Satuan</center></th>
          <td><center>Status</center></td>
          <th><center>Sub Total</center></th>
          
        </tr>
          <?php
        //MENAMPILKAN DETAIL KERANJANG BELANJA//
                
    $total = 0;
    //mysql_select_db($database_conn, $conn);

        $no=1;

        	$query = mysqli_query($conn, "SELECT * FROM checkout WHERE idCart = '$idCart' ");
        	  while (	$sql = mysqli_fetch_array($query)){
        		$idProduk = $sql['idProduk']; 
              $dQuery = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$idProduk'")or die(mysqli_error($conn));
           $detail = mysqli_fetch_array($dQuery);

            $jumlah_harga = $detail['harga'] * $sql['jumlah'];
            $total += $jumlah_harga;
        $pro = $sql['status'];

            if ($pro == 1) {
                $nilai = 'ON Proses';
            }elseif ($pro == 2) {
                $nilai = 'Di Kirim';
            }

            ?>
                <tr>
                <td><center><?php echo $no++; ?></center></td>
                <td><?php echo $detail['namaProduk']; ?></td>
                <td><center><?php echo number_format($sql['jumlah']); ?></center></td>
                <td><center><?php echo number_format($detail['harga']); ?></center></td>
                <td><div class="btn btn-warning"><?php echo $nilai; ?></div></td>
                <td><center><?php echo number_format($jumlah_harga); ?></center></td>
      
                </tr>            
          <?php
                     }
                if($total == 0){
                    echo '<tr><td colspan="5" align="center">Ups, Keranjang kosong!</td></tr></table>';
                    echo '<p><div align="right">
                        <a href="index.php" class="btn btn-info btn-lg">&laquo; Continue Shopping</a>
                        </div></p>';
                } else {
                    echo '
                        <tr style="background-color: #DDD;"><td colspan="4" align="right"><b>Total :</b></td><td align="right"><b>Rp. '.number_format($total,2,",",".").'</b></td></td></td><td></td></tr></table>
         
                    ';
                }
        ?>

</table>  
<div class="hero-unit">Biaya bisa di kirimkan melalui Rekening Bank Mandiri cabang Suka Maju dengan nomor rekening 123-234-56347-8 atas nama NoboDy.</div>
      </div><!-- /.box --> 