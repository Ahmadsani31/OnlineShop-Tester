<div class='panel panel-border panel-primary'>
  <div class='panel-heading'> 
    <h3 class='panel-title'><i class='fa fa-user'></i> Input Sembako</h3> 
  </div>  
  <div class='panel-body'> 
 <form method="POST" enctype="multipart/form-data">
<div class="form-row">
  <input type="hidden" name="idAdmin" value="<?php echo $hasil['id']; ?>">
     <div class="form-group">
 	    <select name="jenis" id="jenis" class="btn btn-warning" required>
        <option disabled selected> Pilih Katagori</option>
          <?php 
           $sql=mysqli_query($conn, "SELECT * FROM jenis");
           while ($data=mysqli_fetch_array($sql)) {
          ?>
        <option value="<?=$data['id']?>"><?=$data['nama']?></option> 
          <?php
           }
          ?>
     </select>
      </div>
     <div class="form-group col">
          <label>Nama Produk</label>
          <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Produk" required>
      </div>
      <div class="row">
    <div class="form-group col-md-4">
      <label for="inputCity">Harga</label>
      <input type="text" class="form-control"  name="harga" placeholder="Masukan harga Produk">
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Stock</label>
      <input type="text" class="form-control"  name="stock" placeholder="Masukan Stock produk">
    </div>
    <div class="form-group col-md-4 " style="padding-top:25px;">
      <select name="size" id="size" class="btn btn-warning" required>
        <option disabled selected> Pilih Size</option>
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
    <div class="form-group">
          <label>Keterangan</label>
          <textarea type="text" class="form-control" name="keterangan" COLS=40 ROWS=10 placeholder="Masukan Nama Deskripsi Produk" ></textarea>
      </div>
    <div class="form-group">
    <label for="exampleFormControlFile1">Input File Image</label>
    <input type="file" class="form-control-file" name="imageProduk">
  </div>
  </div>
<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light pull-right">Tambah</button>
</form>
  </div><!-- /.box-body -->
      </div><!-- /.box -->   

 <?php
if(isset($_POST['submit'])){

$idAdmin =  $_POST['idAdmin'];
$katagori = $_POST['jenis']; 
$nama		= $_POST['nama'];
$size = $_POST['size'];
$harga		= $_POST['harga'];
$stock		= $_POST['stock'];
$keterangan = $_POST['keterangan'];
$image = $_FILES['imageProduk']['name'];
$date = date('Y-m-d H:i:s');	

  $ekstensi_diperbolehkan = array('png','jpg','jpeg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $image); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['imageProduk']['tmp_name'];   
  $angka_acak     = rand(1,9999);
  $newName_image = $angka_acak.'-'.$image;
  $path = '../images/produk/'.$newName_image;

 if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
   if (move_uploaded_file($file_tmp, $path)) {
     
     //memindah file gambar ke folder gambar

    $query = "INSERT INTO produk (idAdmin, jenis, namaProduk, size, harga, stock, keterangan, imageProduk, insertProduk) VALUES('$idAdmin', '$katagori', '$nama','$size','$harga', '$stock','$keterangan', '$newName_image', '$date')";
                  $result = mysqli_query($conn, $query)or die(mysqli_error($conn));
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo '<div class="alert alert-success alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><b>Tambah Konsumen Berhasil!</b></h4>';		//Pesan jika proses tambah sukses
		            echo '
		                  ============================<Br>
		                  <b>Data Produk</b><br>
		                  Nama : <b>'.$nama.'</b><br>
		                  </div>
		             ';
                  }
                }else{
                  echo "<script>alert(' gambar tidak tersimpan');</script>";
                }

            } else {     
             //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');</script>";
            }

}
?>		

