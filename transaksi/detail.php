<?php
session_start();
//echo"<pre>";
//print_r($_SESSION['cart']);
//print_r($_SESSION['user']);
//echo"</pre>";
?>
<div class='panel panel-border panel-primary'>
<div class="panel-heading"><h3>Detail Keranjang Belanja</h3></div>
<table class="table table-hover table-condensed">
<tr>
					<th><center>No Pembelian</center></th>
					<th><center>Nama Barang</center></th>
					<th><center>Jumlah</center></th>
					<th><center>Harga Satuan</center></th>
					<th><center>Sub Total</center></th>
					<th><center>Opsi</center></th>
				</tr>
			    <?php
				//MENAMPILKAN DETAIL KERANJANG BELANJA//
                
    $total = 0;
    //mysql_select_db($database_conn, $conn);

        $no=1;
        foreach ($_SESSION['cart'] as $idProduk => $nilai) {  

            	$dQuery = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$idProduk'")or die(mysqli_error($conn));
            	$detail = mysqli_fetch_array($dQuery);

            $jumlah_harga = $detail['harga'] * $nilai;
            $total += $jumlah_harga;
      
            ?>
                <tr>
                <td><center><?php echo $no++; ?></center></td>
                <td><?php echo $detail['namaProduk']; ?></td>
                <td><center><?php echo number_format($nilai); ?></center></td>
                <td><center><?php echo number_format($detail['harga']); ?></center></td>
                <td><center><?php echo number_format($jumlah_harga); ?></center></td>
                <td><center>
                	<a href="?p=proses&act=plus&idProduk=<?php echo $idProduk ?>" class="btn btn-xs btn-success">Tambah</a> 
                    <a href="?p=proses&act=minus&idProduk=<?php echo $idProduk ?>&jml=<?php echo $nilai ?>" class="btn btn-xs btn-warning">Kurang</a> 
                	<a href="?p=proses&act=hapus&idProduk=<?php echo $idProduk ?>" class="btn btn-xs btn-danger">Hapus</a></center></td>
                </tr>            
					<?php
                     }
                if($total == 0){
                    echo '<tr><td colspan="5" align="center">Ups, Keranjang kosong!</td></tr></table>';
                    echo '<p><div align="right">
                        <a href="?p=produk" class="btn btn-info btn-lg">&laquo; Continue Shopping</a>
                        </div></p>';
                } else {
                    echo '
                        <tr style="background-color: #DDD;"><td colspan="4" align="right"><b>Total :</b></td><td align="right"><b>Rp. '.number_format($total,2,",",".").'</b></td></td></td><td></td></tr></table>
                        <p><div align="right">
                        <a href="?p=produk" class="btn btn-info">&laquo; CONTINUE SHOPPING</a>
                        <a href="?p=checkout&total='.$total.'" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> CHECK OUT &raquo;</a>
                        </div></p>
                    ';
                }
				?>

</table>
</div>