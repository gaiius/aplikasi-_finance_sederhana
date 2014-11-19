				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>
<style>
th {
	margin-left:10px;
	margin-right:10px;
	
	}
td{
	margin-left:10px;
	margin-right:10px;
	}
</style>
 <link href="<?=$base_url?>public/css/bootstrap2.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
       
  
        <!-- Theme style -->
        <!-- DATA TABLES -->
        <link href="<?=$base_url?>public/css/cetak.css" rel="stylesheet" type="text/css" />
    <center><center>

	
	<div class="laporanperiode"></div>
	<table width="786" style="font-size:12px;">
    <thead>
			<?php
				$qs=mysql_query("SELECT * FROM customer WHERE id_customer='$customer'");
				$bs=mysql_fetch_array($qs);
			?>
      
		<tr  style="font-size:12;">
		  <td width="406" ><strong>INDAH JAYA GARMENT</strong></td>
		  <td width="200">Tanggal:&nbsp;&nbsp;<?php

echo $tanggal
?></td>
		  <td width="79" style="font-size:12px;">Costumer</td>
		  <td width="199">: <?php echo $bs['nama'];?></td>
		</tr>
		
        <tr style="font-size:12;">
		  <td  >Telp  : 081316650518</td>
		  <td></td>
		  <td>Alamat</td>
		  <td>: <?php echo $bs['alamat'];?></td>
	  </tr>
		<tr style="font-size:10;">
		  <td  ><?php $sup3=mysql_query("SELECT * FROM hasil_produksi where id_produk='$id'");
            $sp3=mysql_fetch_array($sup3);
			echo "Nota No&nbsp;:&nbsp;<span style=color:#F00;>".$sp3['invoice']."</span>";
			?></td>
			<td></td>
		  <td>Telp</td>
		  <td>: <?php echo $bs['telp'];?></td>
	  </tr>
      </thead>
  </table>
                    
                            
<table id="example1" style="width:750px; font-size:12px;" border="1" bordercolor="#333333">

        <thead>
                                            <tr style="padding-left:15px; height:30px;">
                                                <th width="28" >
                                                <div align="center">No</div></th>
                                                 <th width="242">
                                                 <div align="center">Nama Barang</div></th>
                                                  <th width="87">
                                                  <div align="center">Warna</div></th>
                                                 <th width="84">
                                                 <div align="center">Jumlah</div></th>
                                                 <th width="90">
                                                 <div align="center">Harga Satuan</div></th>
                                                 <th width="179">
                                                 <div align="center">Total</div></th>
                                            </tr>
  </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $sql=mysql_query("select * from history_jual where kode_jual='$id' ");
					                        while ($hasil=mysql_fetch_array($sql)){ $no++;	
				                          ?>
                                          <tr style="font-size:12px;">
                                               <td><?php echo $no;?>&nbsp;&nbsp;</td>
                                             
                                               <td>
                                                    <?php 
													$sup3=mysql_query("SELECT * FROM history_finis where id_fn='$hasil[nama_jual]'");
                                                    $dapet4=mysql_fetch_array($sup3);
												?>
                                                        
                                                            <?php echo $dapet4['barang']."&nbsp;-&nbsp;<em style=color:#F00>".$dapet4['kode_barang']."</em>";?>
															
                                                            <br />
												
                                               </td>
                                              <td>
                                             <?php  $fin=mysql_query("SELECT * FROM finishing where id_finis='$dapet4[kode_fn]'");
                                              $f=mysql_fetch_array($fin);
											  echo $f['warna'];
											  ?>
                                              
                                              
                                              </td>
                                                <td align="right"> <?php echo number_format($hasil['jumlah']);?>&nbsp;&nbsp;</td>
                                                <td align="right"><?php echo number_format($hasil['harga_satuan']);?>&nbsp;&nbsp;</td>
                                                <td align="right"><?php echo number_format($hasil['harga']);?>&nbsp;&nbsp;</td>
                                          
                                       
                                          </tr>
                                           <?php } ?>
                                        </tbody>
                                        <tr style="font-size:12px;">
                                        <td colspan="3">Total</td>
                                        <td align="right">     <?php
										$sql="SELECT SUM(jumlah) AS total_sumbangan from history_jual where kode_jual='$id' ";
										 
										 
										 $result = mysql_query($sql) or die (mysql_error());
                                         $t = mysql_fetch_array($result);
			                              echo "" . number_format($t['total_sumbangan']) . " ";?>&nbsp;</td>
                                        <td>
                                    
                                        </td>
                                        <td align="right">
                                       <?php
										$sql="SELECT SUM(harga) AS total_sumbangan from history_jual where kode_jual='$id'";
										 
										 $result = mysql_query($sql) or die (mysql_error());
                                         $t = mysql_fetch_array($result);
			                              echo "" . number_format($t['total_sumbangan']) . " ";?>
                                       &nbsp;
                                        </td>
                                      
                                        </tr>
                                        </tbody>
                                        
                                       
    </table>
                        
		
	<table width="750" style="font-size:12px;">
		<tr>
		  <td width="162" style="margin-bottom:10px; padding-bottom:8px;"  >Tanda Terima</td>
		  <td width="393" valign="2"><div align="center">Perhatian<br />
          Barang yang sudah dibeli tidak dapat di kembalikan atau di tukar</div></td>
		  <td width="179" style="margin-bottom:10px; padding-bottom:8px;" >Hormat Kami</td>
		</tr>
  </table>			
							
							
		
  
       
	

