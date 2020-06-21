
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style>
.hero-unit {
  background: #fff url(../img/bg-k10.png);
  border-left: 4px solid #89c236;
  padding: 13px 13px 13px 15px;
  font-style: italic;
  margin: 20px auto;
  -webkit-border-radius: 0px;
     -moz-border-radius: 0px;
          border-radius: 0px;
  font-size: 14px !important;

}
.info-box {
  box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
  border-radius: 0.25rem;
  background: #ffffff;
  display: -ms-flexbox;
  display: flex;
  margin-bottom: 1rem;
  min-height: 80px;
  padding: .5rem;
  position: relative;
}


.info-box {
  box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
  border-radius: 0.25rem;
  background: #ffffff;
  display: -ms-flexbox;
  display: flex;
  margin-bottom: 1rem;
  min-height: 80px;
  padding: .5rem;
  position: relative;
}

.info-box .info-box-icon {
  border-radius: 0.25rem;
  -ms-flex-align: center;
  align-items: center;
  display: -ms-flexbox;
  display: flex;
  font-size: 1.875rem;
  -ms-flex-pack: center;
  justify-content: center;
  text-align: center;
  width: 70px;
}

.info-box .info-box-icon > img {
  max-width: 100%;
}

.info-box .info-box-content {
  -ms-flex: 1;
  flex: 1;
  padding: 5px 10px;
}

.info-box .info-box-number {
  display: block;
  font-weight: 700;
}

.info-box .progress-description,
.info-box .info-box-text {
  display: block;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
}
</style>
<?php
 $queryProduk = mysqli_query($conn, "SELECT * FROM produk") or die(mysqli_error($conn));
    $rowProduk = mysqli_num_rows($queryProduk);

  $queryUser = mysqli_query($conn, "SELECT * FROM guest WHERE level = 'user'") or die(mysqli_error($conn));
    $rowUser = mysqli_num_rows($queryUser);

   $queryCart = mysqli_query($conn, "SELECT * FROM cart ") or die(mysqli_error($conn));
    $rowCart = mysqli_num_rows($queryCart);

       $queryCart = mysqli_query($conn, "SELECT * FROM cart ") or die(mysqli_error($conn));
    $rowCart = mysqli_num_rows($queryCart);
    while ($sqlCart = mysqli_fetch_array($queryCart)) {
    $total += $sqlCart['jumlah'];
    }

    

?>

<div class="panel panel-border panel-primary">
        <div class="panel-heading"> 
           <h3 class="panel-title"><i class="fa fa-home"></i>Dashboard</h3> 
        </div> 
    <div class="panel-body"> 
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-database"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Produk</span>
                <span class="info-box-number">
                  <?php echo $rowProduk; ?>
                  <small>Produk</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-database"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Para User</span>
                <span class="info-box-number"><?php echo $rowUser; ?> User</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-database"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Produk Terjual</span>
                <span class="info-box-number"><?php echo $rowCart;  ?> Produk</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-database"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pendapatan</span>
                <span class="info-box-number">Rp. <?php echo number_format($total,2); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->
      </div><!--/. container-fluid -->
<Center><h2><b>Hai <?php echo $_SESSION['admin']['nama'];  ?>, Aplikasi E_commerce </b></h2></center>
    </div>
</html>