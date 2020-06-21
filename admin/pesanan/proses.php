<?php
include "../../koneksi.php";
    $p=isset($_GET['act'])?$_GET['act']:null;
       switch($p){
        default:

        break;
        case "update":
 $update = "UPDATE checkout SET status='2' WHERE idCart='$_GET[id]'";
 $rUpdate = mysqli_query($conn, $update)or die(mysqli_error($conn));

if ($rUpdate) {
    header('location:../index.php?p=pPesanan');  
}else{
    $errorMsg = "Unable to update";
 }

	                     

	}
                    ?>
      