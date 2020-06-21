<?php

$aksi="katagori/proses.php";
     $p=isset($_GET["aksi"])?$_GET["aksi"]:null;
     switch($p){
default:
?>

<div class="panel panel-border panel-primary">
    <div class="panel-heading"> 
         <a href="?p=kTambah" class="btn btn-primary"><i class="fa fa-user-plus"></i> Tambah Size</a>  
    </div>  
    <div class="panel-body"> 
		<div class="panel-body"> 
            <table id="" class="table table-hover">
             <thead>
              <tr>
			<th><i class="icon-terminal"></i> No</th>
			<th><i class="icon-signal"></i> Nama</th>
             </tr>
             </thead>
             <tbody>
	<?php
$i=1;
$tp=mysqli_query($conn, "SELECT * FROM jenis")or die(mysqli_error($conn));
while($r=mysqli_fetch_array($tp)){
	?>
	<tr> 
	 <td><?php echo $i;?></td>
	 <td><?php echo $r["nama"];?></td>
	 <td><a class="btn btn-danger" href="<?php echo $aksi ?>?act=hapus&id=<?php echo $r[id] ?>"><i class="icon-trash"></i>Hapus</td>
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
}
?>

 
 