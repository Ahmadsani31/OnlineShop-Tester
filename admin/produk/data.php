<?php

$aksi="produk/proses.php";
     $p=isset($_GET["aksi"])?$_GET["aksi"]:null;
     switch($p){
default:
?>

<div class="panel panel-border panel-primary">
    <div class="panel-heading"> 
         <a href="?p=pTambah" class="btn btn-primary"><i class="fa fa-user-plus"></i> Tambah Produk</a>  
    </div>  
    <div class="panel-body"> 
		<div class="panel-body"> 
            <table id="" class="table table-hover">
             <thead>
              <tr>
			<th>No</th>
			<th>Image</th>
		  <th>Keteragan</th>	
			<th>Description</th>
			<th>Date / Time</th>
			<th><center>Aksi</center></th>
             </tr>
             </thead>
             <tbody>
	<?php
$i=1;
$tp=mysqli_query($conn, "SELECT * FROM produk ORDER BY id ")or die(mysqli_error($conn));
while($r=mysqli_fetch_array($tp)){

 $qJenis = mysqli_query($conn, "SELECT * FROM jenis WHERE id = '$r[jenis]'");
 	$sJenis = mysqli_fetch_array($qJenis);

 	 $qSize = mysqli_query($conn, "SELECT * FROM size WHERE id = '$r[size]'");
 		$sSize = mysqli_fetch_array($qSize);

       $dateJam = $r['insertProduk'];
       $year = explode(' ', $dateJam);
       $tahunUser = $year['0'];
       $tahun = explode('-', $dateJam);
       $tgl = $tahun['2'];
       $waktu = explode(' ',$tgl); 
       $jam = $waktu['1'];
	?>
     <tr>
    <td rowspan="3"><?php echo $i;?></td>
    <td rowspan="3"><img src='../images/produk/<?php echo $r["imageProduk"];?>' width='100' height='100' class='img-responsive' alt='Cinque Terre'></td>
    <td width="250px"><?php echo $r["namaProduk"];?></td>
    <td width="350px" rowspan=""><?php echo $r["keterangan"];?></td>
    <td rowspan=""><?php echo $tahunUser;?></td>
    <td rowspan=""><center>
    	<a class="btn btn-primary" href="?p=pProduk&aksi=edit&id=<?php echo $r[id] ?>"><i class="fa fa-edit fa-fw"></i></a>
    	<a class="btn btn-danger" href="<?php echo $aksi ?>?act=hapus&id=<?php echo $r[id] ?>"><i class="fa fa-close fa-fw"></i></a></center>
</td>
  </tr>
  <tr>
    <td><?php echo $r["harga"];?></td>
    <td>Stock -> <?php echo $r["stock"];?></td>
    <td><?php echo $jam;?></td>
    
  </tr>
    <tr>
    <td><?php echo $sSize["nama"];?></td>
  </tr>

	<?php $i=$i+1;?>
	<?php } ?>
			</tbody>
           </table>
        </div><!-- /.box-body -->
     </div><!-- /.box -->   						 
  </div>

<?php
break;

case "edit":
	$qEdit = mysqli_query($conn, "SELECT * FROM produk WHERE id='$_GET[id]'");
    $sEdit = mysqli_fetch_array($qEdit);

$qJenis = mysqli_query($conn, "SELECT * FROM jenis WHERE id = '$sEdit[jenis]'");
 	$sJenis = mysqli_fetch_array($qJenis);

 	 $qSize = mysqli_query($conn, "SELECT * FROM size WHERE id = '$sEdit[size]'");
 		$sSize = mysqli_fetch_array($qSize);
    ?>

<form method="POST" action="produk/proses.php?act=update" enctype="multipart/form-data">
<div class="form-row">
  <input type="hidden" name="id" value="<?php echo $sEdit['id']; ?>">
  <div class="row">
  	 <div class='form-group col-md-4'>
      	<label>Image</label>
        <img src="../images/sembako/<?php echo $sEdit[imageProduk]; ?>" width="200" height="200" class="img-responsive" alt="Cinque Terre">
     </div>
     <div class="form-group col-md-8">
          <label>Nama Produk</label>
          <input type="text" class="form-control" name="nama" value="<?php echo $sEdit['namaProduk']; ?>">
      </div>
          <div class="form-group col-md-4">
      <label for="inputCity">Harga</label>
      <input type="text" class="form-control"  name="harga" value="<?php echo $sEdit['harga']; ?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Stock</label>
      <input type="text" class="form-control"  name="stock" value="<?php echo $sEdit['stock']; ?>">
    </div>
         <div class="form-group col-md-2">
         	 <label>Jenis Produk</label>
 	    <input type="text" class="form-control"  name="jenis" value="<?php echo $sJenis['nama']; ?>" readonly>
      </div>
    <div class="form-group col-md-2 " >
    	 <label>Ukuran Produk</label>
      <select name="size" id="size" class="btn btn-warning" required="">
        <option value="<?php echo $sEdit['size']; ?>" selected><?php echo $sSize['nama']; ?></option>
          <?php 
           $sql=mysqli_query($conn, "SELECT * FROM size");
           while ($data=mysqli_fetch_array($sql)) {
          ?>
        <option value="<?=$data['id']?>"><?=$data['nama']?></option> 
          <?php
           }
          ?>
     </select>
    </div>
      </div>
      <div class="row">

  </div>
    <div class="form-group">
          <label>Keterangan</label>
          <textarea type="text" class="form-control" name="keterangan" COLS=40 ROWS=10><?php echo $sEdit['keterangan']; ?></textarea>
      </div>
  </div>
<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light pull-right">Update</button>
</form>
					
<?php	
echo "";
break;
}
?>

 
 