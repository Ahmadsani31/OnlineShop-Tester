<?php
session_start();

if (empty($_SESSION['level'] == "admin")) {
   // header('location:.../login.php'); 
     echo "<script> alert('anda berhasil logint');
           window.location.href='.../login.php';
       </script>";

}
else { 
    $usr = $_SESSION['admin']['user']; 
} 
require_once('../koneksi.php');
$query = mysqli_query($conn ,"SELECT * FROM guest WHERE user = '$usr'");
$hasil = mysqli_fetch_array($query);
if (empty($hasil['user'])) {
    header('Location: ../login.php');
}

@ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <title>Aplikasi Laundry</title>

        <link href="../css/bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="../assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="../css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet" />
        <link href="../css/waves-effect.css" rel="stylesheet">
        <link href="../assets/tagsinput/jquery.tagsinput.css" rel="stylesheet" />
        <link href="../assets/toggles/toggles.css" rel="stylesheet" />
        <link href="../assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="../assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        <link href="../assets/colorpicker/colorpicker.css" rel="stylesheet" type="text/css" />
        <link href="../assets/jquery-multi-select/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="../assets/select2/select2.css" rel="stylesheet" type="text/css" />
        <link href="../css/helper.css" rel="stylesheet" type="text/css" />
        <link href="../css/style.css" rel="stylesheet" type="text/css" /><script src="js/modernizr.min.js"></script> 
    </head>
        



    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.php" class="logo"><span>Aplikasi Ecommerce </span></a>
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                    

                            <ul class="nav navbar-nav navbar-right pull-right">

                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">Selamat Datang, <?php echo $hasil['nama']; ?> Sebagai Admin <img src="../images/user.png" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                              
                                        <li><a href="logout.php"><i class="md md-settings-power"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
                            <img src="../images/user.png" alt="" class="thumb-md img-circle">
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $hasil['nama']; ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="logout.php"><i class="md md-settings-power"></i>&amp; Logout</a></li>
                                </ul>
                            </div>
                            
                            <p class="text-muted m-0"><?php echo $hasil['level']; ?></p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                    <ul>
                        <li>
                        <a href="?p=home" class="waves-effect"><i class="md md-home"></i><span>Dashboard </span></a>
                            </li>
                            <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="fa fa-list"></i> <span>Input Katagori</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="?p=kKatagori">Jenis</a></li>
                                    <li><a href="?p=sSize">Size</a></li>                                                  
                                </ul>
                            </li>
                            <li>
                        <a href="?p=pProduk" class="waves-effect"><i class="fa fa-user-plus"></i><span>Input Produk</span></a>
                            </li>
                            <li>
                        <a href="?p=pPesanan" class="waves-effect"><i class="fa fa-clock-o"></i><span>Pesanan Baru </span></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>                    
            <div class="content-page">
             
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Aplikasi Ecommerce</h4>
                   
                            </div>
                        </div>

<?php

//echo"<pre>";
//print_r($_SESSION['admin']);
//echo"</pre>";
    if(isset($_GET['p'])){
      if ($_GET['p']== "login" || $_GET['p'] == ""){
        include "login.php";
      }
      else if($_GET['p'] == "home") {
        include "dashboard.php";

        //KATAGORI
      }else if($_GET['p'] == "kKatagori") {
        include "katagori/data.php";
      }else if($_GET['p'] == "kTambah") {
        include "katagori/tambah.php";
      }else if($_GET['p'] == "kProses") {
        include "katagori/proses.php";
      }

        //SIZE
      else if($_GET['p'] == "sSize") {
        include "size/data.php";
      }else if($_GET['p'] == "sTambah") {
        include "size/tambah.php";
      }else if($_GET['p'] == "sProses") {
        include "size/proses.php";
      }

        //PRODUK
      else if($_GET['p'] == "pProduk") {
        include "produk/data.php";
      }else if($_GET['p'] == "pTambah") {
        include "produk/tambah.php";
      }else if($_GET['p'] == "pProses") {
        include "produk/proses.php";
      }

      //PESANAN
      else if($_GET['p'] == "pPesanan") {
        include "pesanan/data.php";
      }else if($_GET['p'] == "onProses") {
        include "pesanan/onProses.php";
      }else if($_GET['p'] == "prosesPesanan") {
        include "pesanan/proses.php";
      }


      else if ($_GET['p'] == "beli") {
        include "transaksi/beli.php";
      }else if ($_GET['p'] == "detail") {
        include "transaksi/detail.php";
      }else if ($_GET['p'] == "cart") {
        include "transaksi/cart.php";
      }


      else if ($_GET['p'] == "proses") {
        include "proses.php";
      }

    }else{
      include "dashboard.php";
    }
        ?>



                    </div> 
                               
                </div> 

                <footer class="footer text-right">
                    Copyright &copy; 2020 Aplikasi Ecommerce
                </footer>

            </div>
        </div>
    
        <script>
            var resizefunc = [];
        </script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/waves.js"></script>
        <script src="../js/wow.min.js"></script>
        <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="../js/jquery.scrollTo.min.js"></script>
        <script src="../assets/jquery-detectmobile/detect.js"></script>
        <script src="../assets/fastclick/fastclick.js"></script>
        <script src="../assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="../assets/jquery-blockui/jquery.blockUI.js"></script>
        <script src="../js/jquery.app.js"></script>
        <script src="../assets/tagsinput/jquery.tagsinput.min.js"></script>
        <script src="../assets/toggles/toggles.min.js"></script>
        <script src="../assets/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="../assets/timepicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../assets/colorpicker/bootstrap-colorpicker.js"></script>
        <script type="text/javascript" src="../assets/jquery-multi-select/jquery.multi-select.js"></script>
        <script type="text/javascript" src="../assets/jquery-multi-select/jquery.quicksearch.js"></script>
        <script src="../assets/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../assets/spinner/spinner.min.js"></script>
        <script src="../assets/select2/select2.min.js" type="text/javascript"></script>

	</body>
</html>