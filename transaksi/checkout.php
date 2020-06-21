<?php
if (!isset($_SESSION['user'])) {
  echo "<script> alert('Anda belum Login, Untuk melakukan Checkout Harus login dulu!!!');
            window.location.href='login.php';
          </script>";
}
//echo"<pre>";
//print_r($_SESSION['user']);
//print_r($_SESSION['cart']);
//echo"</pre>";

function acak($panjang)
{
    $karakter= '123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}
$noPembelian= acak(7);
?>



<div class='panel panel-border panel-primary'>
  <div class='panel-heading'> 
    <h3 class='panel-title'><h3>Belanja Hari Ini</h3></h3> 
  </div>  
  <div class='panel-body'> 
<table class="table table-hover table-condensed">
<tr>
          <th><center>No Pembelian</center></th>
          <th><center>Nama Barang</center></th>
          <th><center>Jumlah</center></th>
          <th><center>Harga Satuan</center></th>
          <th><center>Sub Total</center></th>
          
        </tr>
          <?php
        //MENAMPILKAN DETAIL KERANJANG BELANJA//
                
    $total = 0;
    //mysql_select_db($database_conn, $conn);

        $no=1;
        foreach ($_SESSION['cart'] as $idProduk => $nilai) {  

              $dQuery = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$idProduk'")or die(mysqli_error($conn));
              $detail = mysqli_fetch_array($dQuery);

              $stock = $detail['stock'];

            $jumlah_harga = $detail['harga'] * $nilai;
            $total += $jumlah_harga;
      
            ?>
                <tr>
                <td><center><?php echo $no++; ?></center></td>
                <td><?php echo $detail['namaProduk']; ?></td>
                <td><center><?php echo number_format($nilai); ?></center></td>
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
        ?>

</table>

    
  </div>  
  <div class='panel-body'>
    <h3 class='panel-title'><h3>Input Biodata</h3></h3> 
  <div class="col-md-8">
 <form action="" method="POST">
    <table class="table table-condensed">
    <input type="hidden" name="totalBelanja" value="<?php echo abs((int)$_GET['total']); ?>">
    <input type="hidden" name="idUser" value="<?php echo $_SESSION['user']['id']; ?>">
    <tr>
        <td><label >Nama</label></td>
        <td><input name="nm_usr" type="text" value="<?php echo $_SESSION['user']['nama']; ?>"  size="50" /></td>
      </tr>
      <tr>
        <td><label >Email</label></td>
        <td><input name="email_usr" type="text" value="<?php echo $_SESSION['user']['gmail']; ?>" size="50" /></td>
      </tr>
       <tr>
        <td><label >No telepon</label></td>
        <td><input name="tlp" type="text" value="<?php echo $_SESSION['user']['nope']; ?>"size="50"/></td>
      </tr>
      <tr>
        <td><label >Alamat</label></td>
        <td><textarea name="almt_usr" type="text" class="required" rows="4" cols="50"></textarea></td>
      </tr>
      <tr>
        <td><label >Kode Pos</label></td>
        <td><input name="kp_usr" type="text" class="required number" minlength="5" maxlength="5" size="50"/></td>
      </tr>
      <tr>
        <td><label >Kota</label></td>
        <td><input name="kota_usr" type="text" class="required" minlength="6" size="50"  /></td>
      </tr>

       <tr>
        <td><label >Bank</label></td>
        <td><select name="bank" class="required">
        <option>Pilih Bank</option>
        <option value="Mandiri">Mandiri</option>
        <option value="BNI">BNI</option>
        <option value="CIMB">CIMB</option>
        <option value="BCA">BCA</option>
        <option value="Bank Jabar">Bank Jabar</option>
        <option value="Danamon">Danamon</option>
        <option value="BRI">BRI</option>
        <option value="Permata">Permata</option>
        </select>
        </td>
      </tr>
      <tr>
        <td><label >No Rekening</label></td>
        <td><input name="rek" type="text" class="required number" size="50" /></td>
      </tr>
      <tr>
        <td><label for="nmrek">Nama Rekening</label></td>
        <td><input name="nmrek" type="text" class="required" minlength="6" size="50" /></td>
      </tr>

      <tr>
      <td></td>
        <td><input type="submit" value="Simpan Data" name="finish"  class="btn btn-sm btn-primary"/>&nbsp;
          <a href="?p=produk" class="btn btn-sm btn-primary">Kembali</a></td>
        </tr>
    </table>
    </form>
</div> 
  </div><!-- /.box-body -->
      </div><!-- /.box --> 
<?php
//echo"<pre>";
//print_r($stock['stock']);
//print_r($_SESSION['cart']);
//echo"</pre>";
if (isset($_POST['finish'])) {
  $id = $_POST['idUser'];
  $total = $_POST['totalBelanja'];

$almt_usr = $_POST['almt_usr'];
$kp_usr = $_POST['kp_usr'];
$kota_usr = $_POST['kota_usr'];
$bank = $_POST['bank'];
$rek = $_POST['rek'];
$nmrek = $_POST['nmrek'];

$dateInsert = date('Y-m-d H:i:s'); 
 
// simpan data pemesanan 
mysqli_query($conn, "INSERT INTO cart 
  (idUser, noPembelian, almtUser, kodePosUser, kotaUser, bankUser, rekUser, nmrekUser, dateCart, jumlah) VALUES 
  ('$id','$noPembelian','$almt_usr','$kp_usr','$kota_usr','$bank','$rek','$nmrek','$dateInsert','$total')")or die (mysqli_error($conn));
 
 $ambilId = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
      while ($ambil = mysqli_fetch_array($ambilId)) {
        $idCart = $ambil[0];
      }

      foreach ($_SESSION['cart'] as $idProduk => $nilai) {
         $dQuery = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$idProduk'")or die(mysqli_error($conn));
         $sqlProduk = mysqli_fetch_array($dQuery);

        mysqli_query($conn, "INSERT INTO checkout (idCart, idUser, idProduk, jumlah ,status, dateCheckout) VALUES('$idCart', '$id', '$idProduk' , '$nilai', '1', '$dateInsert')")or die (mysqli_error($conn));

        $newStock = $sqlProduk['stock'] - $nilai;

        mysqli_query($conn, "UPDATE produk SET stock ='$newStock' WHERE id = '$idProduk' ")or die (mysqli_error($conn));

        
      }

      unset($_SESSION['cart']);

      echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=nota&idCart=$idCart'>";

}

?>