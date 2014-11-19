				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>


<script src="<?=$base_url?>public/js/boxOver.js" type="text/javascript"></script>

 <link href="<?=$base_url?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?=$base_url?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?=$base_url?>public/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?=$base_url?>public/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?=$base_url?>public/css/AdminLTE.css" rel="stylesheet" type="text/css" />
      
                            <div class="box">
                           
                                <div class="box-header" style=" margin-left:45%; font-size:36px;">
                                    <h1 >Penjualan</h1>
                       
                                </div>
                                <hr /><!-- /.box-header -->
                               <a class="btn btn-primary btn-lg" href="<?=$base_url?>finance/add_jual/<?php echo $user;?>/<?php echo $pass;?>">

  Add 
</a>
                                <div class="box-body table-responsive">
                               
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Customer</th>
                                                <th>TGL Keluar</th>
                                                 <th>Invoice</th>
                                                 <th>Barang / Retur</th>
                                                 <th>Jumlah</th>
                                                 <th>Penjualan</th>
                                                 <th>Harga / Bayar hutang</th>
                                              <th>Sisa / History</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $qpo=mysql_query("SELECT * FROM hasil_produksi ORDER BY tgl_masuk DESC ");
					                       while ($hasil=mysql_fetch_array($qpo)){ $no++;	
										  
										   $sql="SELECT SUM(harga) AS total_sumbangan FROM history_jual where kode_jual='$hasil[id_produk]'  ";
										    $result = mysql_query($sql) or die (mysql_error());
                                            $t = mysql_fetch_array($result);
			                                $hitung=$t['total_sumbangan'];
											
										?>
                                            <tr>
                                               <td><?php echo $no;?>
                                               &nbsp;
                                               &nbsp;
                                                 <?php 
												 if($hitung == 0){
												    echo "<span style=color:#F00;>Close</span>";	 
												 }else{?>
													  <a href="<?=$base_url?>finance/belanjan_edit/<?php echo $hasil['id_produk'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                                      <?php
                                                   $xlogin=mysql_query("SELECT * FROM login where user='$user' and password='$pass'");
                                                   $xlog=mysql_fetch_array($xlogin);
                                                     if($xlog['hakakses'] == 1){
	                                                    $edit="Edit";
	                                                    $del="Del";
                                                     }else{
	                                                    $edit="";
	                                                    $del="";
                                                     }
                                                     echo $edit;?>
                                               <a href="<?=$base_url?>finance/belanja_delete2/<?php echo $hasil['id_produk'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                                 <?php echo $del;?>
                                               </a>
                                               <?php } ?>
                                               </td>
                                               <td>
                               <?php $awal=$hasil['tgl_masuk'];
				                $awal_pecah = '/[\/]/';
		                        $hasil_awal =  preg_replace($awal_pecah,'-', $awal);
								//--------Hasil regex------------------------------
								$bln_awal = substr("$hasil_awal",0,2);
								$tgl_awal = substr("$hasil_awal",3,2);
								$thn_awal = substr("$hasil_awal",6,4);
								$awal_list=$thn_awal."-".$bln_awal."-".$tgl_awal;
								$cs=$hasil['customer'];
								$fin=mysql_query("SELECT * FROM customer where id_customer='$cs'");
                                $f=mysql_fetch_array($fin);
								$id_customer=$f['id_customer'];
								?>
                                
                                
                                               
 <a href="<?=$base_url?>chart/cetak/<?php echo $hasil['id_produk'];?>/<?php echo $id_customer;?>/<?php echo $user;?>/<?php echo $pass;?>/<?php echo $hasil_awal;?>" target="_blank">
                                                  
                                                       <?php 
													    $p=mysql_query("SELECT * FROM customer where id_customer='$hasil[customer]' ");
					                                    while ($l=mysql_fetch_array($p))
													    echo $l['nama'];?> &nbsp;<em>Cetak</em>
                                               
                                               </td>
                                               
                                                

                                               <td><?php echo $hasil['tgl_masuk'];?></td>
                                                <td><?php echo $hasil['invoice'];?></td>
                                                <td><?php 
												$ambil2=mysql_query("SELECT * FROM history_jual where kode_jual='$hasil[id_produk]'");
                                                      $dapet2=mysql_fetch_array($ambil2)?>
                                                        
                                                       <?php 
												$ambil4=mysql_query("SELECT * FROM history_finis inner join
												                                   history_jual on
																				   history_finis.id_fn=history_jual.nama_jual
												                                   where history_jual.kode_jual='$hasil[id_produk]'");
                                                       while ($dapet4=mysql_fetch_array($ambil4)){?>
                                                         <a  data-toggle="modal" data-target="#myModal_4<?php echo $dapet4['id_fn'];?>" style="top:-20px;">
                                                           <?php echo $dapet4['barang']."&nbsp;-&nbsp;".$dapet4['kode_barang'];?>
															</a>
                <a style="float:right; color:#F00;" data-toggle="modal" data-target="#myModal_3<?php echo $dapet4['id_jual'];?>" style="top:-20px;">
                                                          Retur
															</a>
                                                            
                                                            
                                                            <br />
                                                            
<form action="<?=$base_url?>finance/bayar_customer/<?php echo $user;?>/<?php echo $pass;?>" method="post" >                                            
<div class="modal fade" id="myModal_4<?php echo $dapet4['id_fn'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Retur Barang </h4>
      </div>
      <div class="modal-body">
        <br />
    

        <label>Jumlah &nbsp;(sisa  Kekurangan <?php echo number_format($dapet2['harga']);?>)
          <input class="form-control input-sm" type="text" name="kirim"   required id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
         </label> 
         
         <label>Jenis pembayaran
          <input class="form-control input-sm" type="text" name="jenis"   required >
         </label> 
         
    
         <hr />
         
           <label>Keterangan
          <textarea class="form-control input-sm" type="text" name="ket"   required ></textarea>
         </label> 
          <br>
         
          <input type="hidden" name="id" value="<?php echo $dapet2['id_jual'];?>" >
           <input type="text" name="id_produk" value="<?php echo $hasil['id_produk'];?>" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>
</form>
<form action="<?=$base_url?>finance/retur_customer/<?php echo $user;?>/<?php echo $pass;?>" method="post" >                                            
<div class="modal fade" id="myModal_3<?php echo $dapet4['id_jual'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Retur </h4>
      </div>
      <div class="modal-body">
        <br />
    

        <label>Harga Satuan<?php echo number_format($dapet4['harga_satuan']);?>
          <input class="form-control input-sm" type="text" name="kirim" value="<?php echo $dapet4['harga_satuan'];?>"   required id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
         </label> 
         
         <label>Jumlah Retur
          <input class="form-control input-sm" type="text" name="jumlah"   required id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
         </label> 
         
    
         <hr />
         
           <label>Keterangan
          <textarea class="form-control input-sm" type="text" name="ket"   ></textarea>
         </label> 
          <br>
          <input type="hidden" name="jm" value=" <?php echo $dapet2['jumlah'];?>" >
          <input type="hidden" name="barangnya" value="<?php echo $dapet4['barang'];?>" >
         <input type="hidden" name="namanya" value="<?php echo $hasil['customer'];?>" >
          <input type="hidden" name="kode" value="<?php echo $dapet4['kode_barang'];?>" >
          <input type="hidden" name="id" value="<?php echo $dapet4['id_jual'];?>" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>
</form>
												<?php }?>
												</td>
                                                <td><?php 
												$ambil2=mysql_query("SELECT * FROM history_jual where kode_jual='$hasil[id_produk]'");
                                                       while ($dapet2=mysql_fetch_array($ambil2)){?>
                                                        
                                                           <?php echo number_format($dapet2['jumlah']);?>
															
                                                            <br />
												<?php }?></td>
                                                <td>
                                                <?php 
												$ambil2=mysql_query("SELECT * FROM history_jual where kode_jual='$hasil[id_produk]'");
                                                       while ($dapet2=mysql_fetch_array($ambil2)){?>
                                                        
                                                           <?php echo number_format($dapet2['jumlah']);?>
															
                                                            <br />
												<?php }?>
                                                </td>
                                                
                                                   <td align="right">
                                                <?php 
												$ambil2=mysql_query("SELECT * FROM history_jual where kode_jual='$hasil[id_produk]'");
                                                       while ($dapet2=mysql_fetch_array($ambil2)){
														   if($dapet2['harga'] == 0){
															 echo number_format($dapet2['harga_satuan'])."&nbsp;/&nbsp;&nbsp;&nbsp;".number_format($dapet2['harga']);
														   }else{
														   ?>
                                                         <a  data-toggle="modal" data-target="#myModal_<?php echo $dapet2['id_jual'];?>" style="top:-20px;">
                                                           <?php echo number_format($dapet2['harga_satuan'])."&nbsp;/&nbsp;&nbsp;&nbsp;".number_format($dapet2['harga']);?>
															</a>
                                                            <?php } ?>
                                                            <br />
                                                            
<form action="<?=$base_url?>finance/bayar_customer/<?php echo $user;?>/<?php echo $pass;?>" method="post" >                                            
<div class="modal fade" id="myModal_<?php echo $dapet2['id_jual'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Bayar Pembelian Customer <?php echo $hasil['customer'];?></h4>
      </div>
      <div class="modal-body">
        <br />
    

        <label>Jumlah &nbsp;(sisa  Kekurangan <?php echo number_format($dapet2['harga']);?>)
          <input class="form-control input-sm" type="text" name="kirim" value="<?php echo $dapet2['harga'];?>" required id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
         </label> 
         
         <label>Jenis pembayaran
          <input class="form-control input-sm" type="text" name="jenis"   required >
         </label> 
         
    
         <hr />
         
           <label>Keterangan
          <textarea class="form-control input-sm" type="text" name="ket"   required ></textarea>
         </label> 
          <br>
         
          <input type="hidden" name="id" value="<?php echo $dapet2['id_jual'];?>" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>
</form>
												<?php }?>
                                                </td>
                                               <td> <?php 
												$ambil2=mysql_query("SELECT * FROM history_jual where kode_jual='$hasil[id_produk]'");
                                                       while ($dapet2=mysql_fetch_array($ambil2)){?>
                                                         <a  data-toggle="modal" data-target="#myModal_2<?php echo $dapet2['id_jual'];?>" style="top:-20px;">
                                                           <?php echo number_format($dapet2['bayarnya']);?>
															</a>
                                                            <br />
                                                            
                                                            
<div class="modal fade" id="myModal_2<?php echo $dapet2['id_jual'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">History Bayar Customer</h4>
      </div>
      <div class="modal-body">
        <br />
         <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Bayar</th>
                                                 <th>Sisa</th>
                                              <th>Jenis Pemb</th>
                                              <th>Keterangan</th>
                                         
                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no1=0;
					                        $q=mysql_query("SELECT * FROM history_bayar where kode_bayar='$dapet2[id_jual]'   ");
					                        while ($hasil2=mysql_fetch_array($q)){ $no1++;	
				                          ?>
                                        <tr>
                                        <td><?php echo $no1;?></td>
                                        <td><?php echo $hasil2['tanggal'];?></td>
      
                                        <td><?php echo number_format($hasil2['bayar']);?></td>
                                        <td><?php echo number_format($hasil2['sisa']);?></td>
                                       <td><?php echo $hasil2['jenis'];?></td>
                                                <td><?php echo $hasil2['ket'];?></td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>             
												<?php }?>
                                                
                                                
                                                </td>
                                               
                                       
                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                     
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->  
							
		
							
							
							
		<script src="<?=$base_url?>public/js/jquery.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?=$base_url?>public/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?=$base_url?>public/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?=$base_url?>public/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?=$base_url?>public/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
       
        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $("#example2").dataTable();
            });
			
												  			$(document).ready(function() {
$("#masknumber").keydown(function (e) {
if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
// Allow: Ctrl+A
 (e.keyCode == 65 && e.ctrlKey === true) || 
// Allow: home, end, left, right
(e.keyCode >= 35 && e.keyCode <= 39)) {
 // let it happen, don't do anything
return;
}
// Ensure that it is a number and stop the keypress
if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
 e.preventDefault();
}
 
});
});
        </script>
  
       
	