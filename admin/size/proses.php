<?php
include "../../koneksi.php";
    $p=isset($_GET['act'])?$_GET['act']:null;
                    switch($p){
                        default:

                            break;
                        case "input":                       
                       
                                break;
                        case "hapus":
      $deleteProduk = "DELETE FROM size WHERE id='$_GET[id]'";
         $rDelete = mysqli_query($conn, $deleteProduk)or die(mysqli_error($conn));

            if ($rDelete) {
                header('location:../index.php?p=sSize');      
            }else{
                $errorMsg = "Unable to delete Image";
                }


                         

    }
                    ?>
      

