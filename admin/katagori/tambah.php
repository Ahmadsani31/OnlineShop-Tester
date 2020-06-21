<div class='panel panel-border panel-primary'>
<div class='panel-heading'> 
    <h3 class='panel-title'><i class='fa fa-user'></i> Input Katagori</h3> 
    </div>  
  <div class='panel-body'> 
<form method="POST" enctype="multipart/form-data">
<div class="form-row">
 <div class="form-group col">
 	  <label>Nama Katagori</label>
    <input type="hidden" name="idAdmin" value="<?php echo $hasil['id']; ?>">
          <input type="text" class="form-control" name="nama" placeholder="Masukan Jenis Produk" required>
       </div>
  </div>
<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">Tambah</button>
</form>
  </div><!-- /.box-body -->
      </div><!-- /.box -->   

 <?php
if(isset($_POST['submit'])){
 $idAdmin =  $_POST['idAdmin']; 
 $nama	= $_POST['nama'];
 $newNama = ucwords($nama);

               $query = "INSERT INTO jenis(idAdmin, nama) VALUES('$idAdmin', '$newNama')";
                  $result = mysqli_query($conn, $query)or die(mysqli_error($conn));
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($conn).
                           " - ".mysqli_error($conn));
                  } else {
                    echo "<script> alert('Data Berhasil');
                          window.location.href='?p=kTambah';
                          </script>";
                  }

}
?>		

