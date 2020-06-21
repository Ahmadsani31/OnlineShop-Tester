<div class='panel panel-border panel-primary'>
                                    <div class='panel-heading'> 
                                        <h3 class='panel-title'><i class='fa fa-clock-o'></i> Riwayat Transaksi</h3> 
                                    </div>  <div class='panel-body'> 
                                <table id='datatable' class='table table-hover'>
                                    <thead>
                                        <tr>
										<th><i class='icon-terminal'></i> No</th>
										<th><i class='icon-signal'></i> Konsumen</th>
										<th><i class='icon-terminal'></i> Jenis</th>
											<th><i class='icon-signal'></i> Tarif</th>
											<th><i class='icon-signal'></i> Berat</th>
											<th><i class='icon-signal'></i> Tanggal Transaksi</th>
											<th><i class='icon-signal'></i> Tanggal Ambil</th>

											<th><i class='icon-signal'></i> Kwitansi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
							$i=1;
							$tp=mysqli_query($conn, "SELECT * FROM transaksi WHERE pengguna='$usr' ORDER BY tgl_transaksi");
							while($r=mysqli_fetch_array($tp)){
							?>
							<tr>
							 <td><?php echo $i;?></td>
							 
                                    <td><?php echo $r['konsumen'];?></td>
                                    <td><?php echo $r['jenis'];?></td>
									<td><?php echo'Rp.' . number_format( $r['tarif'], 0 , '' , '.' ) . ',-'?></td>
									<td><?php echo $r['berat']?> Kg</td>
									<td><?php echo TanggalIndo($r['tgl_transaksi']);?></td>
									<td><?php echo TanggalIndo($r['tgl_ambil']);?></td>
									<td><a href="transaksi/kwitansi.php?id=<?php echo $r['id'];?>" target="_blank">Lihat Kwitansi</a></td>
                                    
							</tr>
							<?php $i=$i+1;?>
							<?php } ?>
							</tbody>
                        </table>
                                     </div><!-- /.box-body -->
          </div><!-- /.box -->   