<?php
    $nota = mysqli_query($conn, "SELECT * FROM cart WHERE idCart = '$_GET[idCart]'") or mysql_error($conn);
    $sqlNota = mysqli_fetch_array($nota);
    $idCart = $sqlNota['idCart'];
?>
<?php

$aksi="pesanan/proses.php";
     $p=isset($_GET["aksi"])?$_GET["aksi"]:null;
     switch($p){
default:
?>
<div class='panel panel-border panel-primary'>
  <div class='panel-heading'> 
    <h3 class='panel-title'><h4><?php echo $sqlNota['nmUser']; ?></h4></h3> 
  </div>  
  <div class='panel-body'> 
    <div class="col-md-6">

<table>
<tr>
        <tr>
            <td width="200">No Telpon</td>
            <td width="20">:</td>
            <td><?php echo $sqlNota['tlpUser']; ?></td>
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
 
  <table class="table table-hover table-condensed">
<tr>
          <th><center>No</center></th>
          <th>Nama Barang</th>
          <th><center>Jumlah</center></th>
          <th><center>Harga Satuan</center></th>
          <th><center>Sub Total</center></th>
          
        </tr>
          <?php
        //MENAMPILKAN DETAIL KERANJANG BELANJA//
                
    $total = 0;
    //mysql_select_db($database_conn, $conn);

        $no=1;

            $query = mysqli_query($conn, "SELECT * FROM checkout WHERE idCart = '$_GET[idCart]' ");
              while (   $sql = mysqli_fetch_array($query)){
                $idProduk = $sql['idProduk']; 
              $dQuery = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$idProduk'")or die(mysqli_error($conn));
           $detail = mysqli_fetch_array($dQuery);

            $jumlah_harga = $detail['harga'] * $sql['jumlah'];
            $total += $jumlah_harga;
      
            ?>
                <tr>
                <td><center><?php echo $no++; ?></center></td>
                <td><?php echo $detail['namaProduk']; ?></td>
                <td><center><?php echo number_format($sql['jumlah']); ?></center></td>
                <td><center><?php echo number_format($detail['harga']); ?></center></td>
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
                        <tr style="background-color: #DDD;"><td colspan="4" align="right"><b>Total :</b></td><td align=""><b>Rp. '.number_format($total,2,",",".").'</b></td></td></td><td></td></tr></table>
         
                    ';
                }

//echo"<pre>";
//print_r($_GET['idCart']);
//echo"</pre>";
        ?>

</table>  
<div class="pull">
  <?php
  $query = mysqli_query($conn, "SELECT * FROM checkout WHERE idCart = '$_GET[idCart]' ");
  $sql = mysqli_fetch_array($query);
if ($sql['status'] == 1) {

  ?>
  <a href="<?php echo $aksi ?>?act=update&id=<?php echo $_GET[idCart] ?>"> <button class="col-md-4 btn btn-info">Proses</button></a>
  <?php
}else if ($sql['status'] == 2) {
  echo "<h4> Barang Sudah di Proses...!!";
  echo "<h4> Siap Untuk di Kirim";
}
   ?>

</div>
   </div><!-- /.box --> 
       </div>
<?php
break;
}
?>