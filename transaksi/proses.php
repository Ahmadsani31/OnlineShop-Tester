<?php
session_start();
$timezone = "Asia/Jakarta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
$date=date('Y-m-d');

$idProduk = $_GET['idProduk'];
$jml = $_GET['jml'];

            include "../koneksi.php";
                    $p=isset($_GET['act'])?$_GET['act']:null;
                    switch($p){
                        default:

                            break;
                        case "input":   

if (isset($_SESSION['cart'][$idProduk])) {
    $_SESSION['cart'][$idProduk] += 1; 
}else{
  $_SESSION['cart'][$idProduk] = 1 ; 
}
echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=detail'>";
//  echo "<script> alert('Data berhasil di Input');
  //          window.location.href='?p=detail';
    //      </script>";           


           break;
                        case "plus":
if (isset($_SESSION['cart'][$idProduk])) {
        $_SESSION['cart'][$idProduk] += 1;
        echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=detail'>";
}         
                                break;
                         case "minus":
if (isset($_SESSION['cart'][$idProduk])) 
{
    if ($jml == 1) {
            unset($_SESSION['cart'][$idProduk]);
            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=detail'>";        # code...
    }else{

          $_SESSION['cart'][$idProduk] -= 1;
            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=detail'>";
 }
   // foreach ($_SESSION['cart'] as $idProduk => $nilai) {
   //             if ($nilai > 1) {
 //
   ///             }else if($nilai == 1){
   //     unset($_SESSION['cart'][$idProduk]);
   //     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=detail'>";
   // }
 // }
}         
                                break;
                        case "hapus":
unset($_SESSION['cart'][$idProduk]);
//echo "<script> alert('Data berhasil di Input')</script>";
//echo "<script> location = '?p=detail';</script>";
echo "<META HTTP-EQUIV='Refresh' Content='0; URL=?p=detail'>";

                                break;
                        case "update":

                                break;
                        case "pakai":

    }
                    ?>
      