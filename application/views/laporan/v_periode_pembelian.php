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
      
                            
                           <?php  
						        $cari = $this->input->post('cari');
							   $po = $this->input->post('po');
							   $barang = $this->input->post('barang');
							   
						       $tanggal = $this->input->post('tanggal');
						    	$pg = '/[\-]/';
                                $hasil =  preg_replace($pg,' ', $tanggal);
								
								$awal = substr("$hasil",0,10);
								$akhir = substr("$hasil",10);
								
								$awal_pecah = '/[\/]/';
		                        $hasil_awal =  preg_replace($awal_pecah,'-', $awal);
								//--------Hasil regex------------------------------
								$bln_awal = substr("$hasil_awal",0,2);
								$tgl_awal = substr("$hasil_awal",3,2);
								$thn_awal = substr("$hasil_awal",6,4);
								$awal_list=$thn_awal."-".$bln_awal."-".$tgl_awal;
								$awalan=$tgl_awal."-".$bln_awal."-".$thn_awal;
								//echo $awal_list."-";
								
								$akhir_pecah = '/[\/]/';
		                        $hasil_akhir =  preg_replace($akhir_pecah,'-', $akhir);
								//--------Hasil regex------------------------------
								
								$bln_akhir = substr("$hasil_akhir",3,2);
								$tgl_akhir = substr("$hasil_akhir",6,2);
								$thn_akhir = substr("$hasil_akhir",9,4);
								$akhir_list=$thn_akhir."-".$bln_akhir."-".$tgl_akhir;
								$akhiran=$tgl_akhir."-".$bln_akhir."-".$thn_akhir;
								if($cari == 1){
						   ?>
                              
                        <div class="box">
                           <center>
                                <div class="box-header" style=" margin-left:1%; font-size:36px;">
                                
                                    <h1>Biaya Pengeluaran <?php echo "<span style=color:#F00;>".$barang."</span>";?> Tanggal <?php echo $awal_list;?> Sampai <?php echo $akhir_list;?></h1>
                       
                                </div>
                                </center>
                                <hr /><!-- /.box-header -->
                              
                                 
                              
                                
                                 
                                <div class="box-body table-responsive">
                               
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                 <th>Penggunaan</th>
                                                <th>Ket</th>
                                                 <th>Harga</th>
                                                 <th>Pembayaran</th>
                                                 <th>Sisa</th>
                                                <th>Status</th>
                                              
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
										   if(empty($po) AND empty($barang)){
					                        $sql=mysql_query("select * from pembelian where tgl BETWEEN '$awal_list'  AND '$akhir_list'");
										   }elseif(empty($barang)){
											$sql=mysql_query("select * from pembelian  WHERE ket='$po' AND tgl BETWEEN '$awal_list'  AND '$akhir_list' ");
										   }elseif(empty($po)){
											$sql=mysql_query("select * from pembelian  WHERE barang='$barang' AND tgl BETWEEN '$awal_list'  AND '$akhir_list' ");
										   }else{
											$sql=mysql_query("select * from pembelian  WHERE ket='$po' AND barang='$barang' AND tgl BETWEEN '$awal_list'  AND '$akhir_list' ");
										   }
					                        while ($hasil=mysql_fetch_array($sql)){ $no++	
				                          ?>
                                            <tr>
                                               <td><?php echo $no;?>
                                             
                                               </td>
                                               <td><?php echo $hasil['tgl'];?></td>
                                               <td><?php echo $hasil['dari']."&nbsp&nbsp&nbsp;<em style=color:#03F;>".$hasil['barang']."</em>";?></td>
                                                <td><?php echo $hasil['ket'];?></td>
                                                <td> <?php echo number_format($hasil['jumlah']);?></td>
                                                <td><?php echo number_format($hasil['bayar']);?></td>
                                                <td><?php echo number_format($hasil['total']);?></td>
                                                <td><?php echo $hasil['status'];?></td>
                                       
                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                        <tr>
                                        <td colspan="4">Total</td>
                                        <td>
                                        <?php
										if(empty($po) AND empty($barang)){
					                        $sql="SELECT SUM(jumlah) AS total_sumbangan FROM pembelian WHERE tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }elseif(empty($barang)){
											$sql="SELECT SUM(jumlah) AS total_sumbangan FROM pembelian  WHERE ket='$po' AND  tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }elseif(empty($po)){
											$sql="SELECT SUM(jumlah) AS total_sumbangan FROM pembelian  WHERE barang='$barang' AND  tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }else{
											$sql="SELECT SUM(jumlah) AS total_sumbangan FROM pembelian  WHERE ket='$po' AND barang='$barang' AND  tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }
										 
										 $result = mysql_query($sql) or die (mysql_error());
                                         $t = mysql_fetch_array($result);
			                              echo "" . number_format($t['total_sumbangan']) . " ";?>
                                        </td>
                                        <td>
                                        <?php
										if(empty($po) AND empty($barang)){
					                        $sql="SELECT SUM(bayar) AS total_sumbangan FROM pembelian WHERE tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }elseif(empty($barang)){
											$sql="SELECT SUM(bayar) AS total_sumbangan FROM pembelian  WHERE ket='$po' AND  tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }elseif(empty($po)){
											$sql="SELECT SUM(bayar) AS total_sumbangan FROM pembelian  WHERE barang='$barang' AND  tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }else{
											$sql="SELECT SUM(bayar) AS total_sumbangan FROM pembelian  WHERE ket='$po' AND  barang='$barang' AND  tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }
										 
										 $result = mysql_query($sql) or die (mysql_error());
                                         $t = mysql_fetch_array($result);
			                              echo "" . number_format($t['total_sumbangan']) . " ";?>
                                        </td>
                                        <td>
                                         <?php
										if(empty($po) AND empty($barang)){
					                        $sql="SELECT SUM(total) AS total_sumbangan FROM pembelian WHERE tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }elseif(empty($barang)){
											$sql="SELECT SUM(total) AS total_sumbangan FROM pembelian  WHERE ket='$po' AND  tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }elseif(empty($po)){
											$sql="SELECT SUM(total) AS total_sumbangan FROM pembelian  WHERE barang='$barang' AND  tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }else{
											$sql="SELECT SUM(total) AS total_sumbangan FROM pembelian  WHERE ket='$po' AND barang='$barang' AND  tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }
										 
										 $result = mysql_query($sql) or die (mysql_error());
                                         $t = mysql_fetch_array($result);
			                              echo "" . number_format($t['total_sumbangan']) . " ";?>
                                        
                                        </td>
                                        <td></td>
                                        </tr>
                                       
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->  
							
		<?php }elseif($cari ==2){?>
        
	<!-- ---------------------------------------------------------------Penjualan---------------------------------------->
    		
			<div class="box">
                           <center>
                                <div class="box-header" style=" margin-left:1%; font-size:36px;">
                                
                                    <h1>Penjualan <?php echo "<span style=color:#F00;>".$barang."</span>";?> Tanggal <?php echo $awal_list;?> Sampai <?php echo $akhir_list;?></h1>
                       
                                </div>
              </center>
                                <hr /><!-- /.box-header -->
                              
                                 
                              
                                
                                 
     <div class="box-body table-responsive">
                <?php
                  if(empty($po) AND empty($barang)){?>
					<a href="<?=$base_url?>chart/penjualan/po_kosong/barang_kosong/<?php echo $awalan; ?>/<?php echo $akhiran; ?>/<?php echo $user;?>/<?php echo $pass;?>">
                       <img src="<?=$base_url?>public/img/grap.jpg" height="35" />
                    </a>
                     <?php }elseif(empty($po)){?>
						<a href="<?=$base_url?>chart/penjualan/po_kosong/<?php echo $barang; ?>/<?php echo $awalan; ?>/<?php echo $akhiran; ?>/<?php echo $user;?>/<?php echo $pass;?>">
                       <img src="<?=$base_url?>public/img/grap.jpg" height="35" />
                    </a>
                    
				 <?php }elseif(empty($barang)){?>
						<a href="<?=$base_url?>chart/penjualan/<?php echo $po; ?>/barang_kosong/<?php echo $awalan; ?>/<?php echo $akhiran; ?>/<?php echo $user;?>/<?php echo $pass;?>">
                       <img src="<?=$base_url?>public/img/grap.jpg" height="35" />
                    </a>
											
				<?php }else{?>
						<a href="<?=$base_url?>chart/penjualan/<?php echo $po; ?>/<?php echo $barang; ?>/<?php echo $awalan; ?>/<?php echo $akhiran; ?>/<?php echo $user;?>/<?php echo $pass;?>">
                       <img src="<?=$base_url?>public/img/grap.jpg" height="35" />
                    </a>					
				 <?php } ?>       
                              
<table id="example1" class="table table-bordered table-striped">
        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                 <th>Barang</th>
                                             
                                                 <th>Harga Satuan</th>
                                                 <th>Jumlah</th>
                                                 <th>Total Yg Di bayarkan</th>
                                               
                                              
                                                
                                            </tr>
      </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
										   if(empty($po) AND empty($barang)){
					                        $sql=mysql_query("select * from history_jual where tgl BETWEEN '$awal_list'  AND '$akhir_list'");
										   }elseif(empty($barang)){
											$sql=mysql_query("select * from history_jual  WHERE po_jual='$po' AND tgl BETWEEN '$awal_list'  AND '$akhir_list' ");
										   }elseif(empty($po)){
											$sql=mysql_query("select * from history_jual  WHERE nama_jual='$barang' AND tgl BETWEEN '$awal_list'  AND '$akhir_list' ");
										   }else{
											$sql=mysql_query("select * from history_jual  WHERE po_jual='$po' AND nama_jual='$barang' AND tgl BETWEEN '$awal_list'  AND '$akhir_list' ");
										   }
					                        while ($hasil=mysql_fetch_array($sql)){ $no++	
				                          ?>
                                            <tr>
                                               <td><?php echo $no;?>
                                             
                                               </td>
                                               <td><?php 
											   if(empty($hasil['tgl_jual'])){
												   echo "Tempo";
											   }else{
											   
											   echo $hasil['tgl_jual'];}?></td>
                                               <td><?php 
												$ambil4=mysql_query("SELECT * FROM history_finis inner join
												                                   history_jual on
																				   history_finis.id_fn=history_jual.nama_jual
												                                   where history_jual.id_jual='$hasil[id_jual]'");
                                                       while ($dapet4=mysql_fetch_array($ambil4)){?>
                                                       <?php echo $dapet4['barang']."&nbsp;-&nbsp;".$dapet4['kode_barang'];
													   echo "<br>";
													   }?></td>
                                              
                                                <td> <?php echo number_format($hasil['harga_satuan']);?></td>
                                                <td><?php echo number_format($hasil['jumlah']);?></td>
                                                <td><?php echo number_format($hasil['bayarnya']);?></td>
                                               
                                       
                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                        <tr>
                                        <td colspan="3">Total</td>
                                        <td> </td>
                                        <td>
                                        <?php
										if(empty($po) AND empty($barang)){
					                        $sql="SELECT SUM(jumlah) AS total_sumbangan FROM history_jual WHERE tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }elseif(empty($barang)){
											$sql="SELECT SUM(jumlah) AS total_sumbangan FROM history_jual  WHERE po_jual='$po' AND tgl BETWEEN  '$awal_list'  AND '$akhir_list'";
										   }elseif(empty($po)){
											$sql="SELECT SUM(jumlah) AS total_sumbangan FROM history_jual  WHERE nama_jual='$barang' AND tgl BETWEEN  '$awal_list'  AND '$akhir_list'";
										   }else{
											$sql="SELECT SUM(jumlah) AS total_sumbangan FROM history_jual  WHERE po_jual='$po' AND nama_jual='$barang' AND tgl BETWEEN  '$awal_list'  AND '$akhir_list'";
										   }
										 
										 $result = mysql_query($sql) or die (mysql_error());
                                         $t = mysql_fetch_array($result);
			                              echo "" . number_format($t['total_sumbangan']) . " ";?>
                                        </td>
                                        <td>
                                       <?php
										if(empty($po) AND empty($barang)){
					                        $sql="SELECT SUM(bayarnya) AS total_sumbangan FROM history_jual WHERE tgl BETWEEN '$awal_list'  AND '$akhir_list'";
										   }elseif(empty($barang)){
											$sql="SELECT SUM(bayarnya) AS total_sumbangan FROM history_jual  WHERE po_jual='$po' AND tgl BETWEEN  '$awal_list'  AND '$akhir_list'";
										   }elseif(empty($po)){
											$sql="SELECT SUM(bayarnya) AS total_sumbangan FROM history_jual  WHERE nama_jual='$barang' AND tgl BETWEEN  '$awal_list'  AND '$akhir_list'";
										   }else{
											$sql="SELECT SUM(bayarnya) AS total_sumbangan FROM history_jual  WHERE po_jual='$po' AND nama_jual='$barang' AND tgl BETWEEN  '$awal_list'  AND '$akhir_list'";
										   }
										 
										 $result = mysql_query($sql) or die (mysql_error());
                                         $t = mysql_fetch_array($result);
			                              echo "" . number_format($t['total_sumbangan']) . " ";?>
                                        
                                        </td>
                                       
                                        </tr>
                                       
                                  </table>
              </div><!-- /.box-body -->
                        </div><!-- /.box -->  
			
			
		<?php }?>
							
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
     
							
		