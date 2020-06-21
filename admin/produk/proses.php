

<?php
$timezone = "Asia/Jakarta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
$date=date('Y-m-d');

$id = $_POST['id'];
$namaUpdate = $_POST['nama'];
$hargaUpdate = $_POST['harga'];
$stockUpdate = $_POST['stock'];
$sizeUpdate = $_POST['size'];
$keteranganUpdate = $_POST['keterangan'];

            include "../../koneksi.php";
                    $p=isset($_GET['act'])?$_GET['act']:null;
                    switch($p){
                        default:

                            break;
                        case "input":                       
                       
                                break;
                        case "hapus":
    $hapus = mysqli_query($conn, "SELECT * FROM produk WHERE id='$_GET[id]'")or die(mysqli_error($conn));
    $rHapus   = mysqli_fetch_array($hapus);
    $image = $rHapus['imageProduk'];
 
$deletePath = "/opt/lampp/htdocs/ecommerce/images/produk/".$image;

if (unlink($deletePath)) {
    $deleteImage = "DELETE FROM produk WHERE id='$_GET[id]'";
    $rDelete = mysqli_query($conn, $deleteImage)or die(mysqli_error($conn));

    if ($rDelete) {
        header('location:../index.php?p=pProduk');      
    }
 }else{
    $errorMsg = "Unable to delete Image";
 }

                                break;
                        case "update":
 $update = "UPDATE produk SET namaProduk='$namaUpdate', harga='$hargaUpdate', stock='$stockUpdate', size='$sizeUpdate', keterangan='$keteranganUpdate', updateProduk='$date' WHERE id='$id'";
 $rUpdate = mysqli_query($conn, $update)or die(mysqli_error($conn));

if ($rUpdate) {
    header('location:../index.php?p=pProduk');  
}else{
    $errorMsg = "Unable to update";
 }
    
                                break;
                        case "pakai":

    }
                    ?>
      