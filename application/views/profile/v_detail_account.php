<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
$awal=date('Y-m')."-01";
		$akhir= date('y-m-d');
?>
<script type="text/javascript" src="<?php echo base_url();?>public/js/googlechart.js"></script>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        data: {
            table: document.getElementById('datatable')
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Data Artikel Karyawan dari tanggal <?php echo $awal ."Sampai".$akhir;?>'
        },
        yAxis: {
            allowDecimals: false,
			allowHour: false,
            title: {
                text: 'Units'
            }
        },
      
    });
});
		</script>
	
<script src="<?php echo base_url();?>public/js/highcharts.js"></script>
<script src="<?php echo base_url();?>public/js/modules/data.js"></script>
<script src="<?php echo base_url();?>public/js/modules/exporting.js"></script>
 
 <link rel="stylesheet" href="<?=$base_url?>public/admin/css/sprite.tables.css">  
<h1 align="center">Artikel Berita</h1>
<div class="grid_12">
						<div class="box">
							<div class="header">
                         
								<h3>Data tables Artikel</h3><span></span>
							</div>
						
								<table width="892"  class="table" >
							
                                    
									<tbody >
                                    <?php $query= $this->m_progres->get_detail($id_user);	
                                         
	                                         foreach ($query as $mon1){ 
	                                           $stt=$mon1['user'];
	                                           
                                     ?>
							
                             <tr> 
                               <td class="center">Nama : <?php  echo $mon1['user']; ?></td></tr>
                             <tr>
                                <td class="center">Alamat : <?php echo $mon1['alamat']; ?></td>
                             </tr>
                             <tr>
							   <td class="center">Email : <?php echo $mon1['email']; ?></td>
                            </tr>
                             <tr>
                                <td>Telp : <?php echo $mon1['telp']; ?></td>
                             </tr>
                             <tr>
                                <td>Tanggal Masuk : <?php echo $mon1['masuk'];?></td>
                             </tr>
                             <tr>
                                <td>Status Karyawan : <?php echo $mon1['status'];?></td>
                             </tr>
                             <tr>
                                <td>Hak Akses : <?php echo $mon1['hakakses'];?></td>
                             </tr>
                             <tr>
                                <td>Index : <?php 
$awal=date('Y-m')."-01";
		$akhir= date('Y-m-d');
            $sql="SELECT SUM(jumlah) AS total_sumbangan FROM nilai WHERE nama='$id_user'  and tgl BETWEEN '$awal'  AND '$akhir'";

			$result = mysql_query($sql) or die (mysql_error());

            $t = mysql_fetch_array($result);

			echo "" . number_format($t['total_sumbangan']) . "";?>
</td>
                             </tr>
                             <tr>
                                <td>CV : <a href="<?php echo base_url();?>wartawan/<?php echo $mon1['cv']; ?>" target="_blank"><?php echo $mon1['cv']; ?></a></td></tr>
							<tr> <td><img src="<?php echo base_url();?>profile/<?php echo $mon1['foto']; ?>" width="70" height="70"></td></tr>
							
							 <tr><td><a href="<?php echo base_url();?>progres/edit_berita/<?php echo $user;?>/<?php echo $mon1['user']; ?>/<?php echo $stt; ?>" >Edit</a></td></tr>
    <tr><td>
	
	 <a href="<?php echo base_url();?>progres/delete_berita/<?php echo $mon1['user']; ?>/<?php echo $user;?>">DEL</a></td></tr>
     	</tbody>
     <tbody>
   	<div id="container">
    
    <table width="892"  id="datatable" >					
       <thead>		
        <tr>
			<th><br></th>
            <th><br></th>
            <th><br></th>
		</tr>
	</thead>
      <?php
        $awal=date('Y-m')."-01";
		$akhir= date('Y-m-d');
		
	  $qpelanggan=mysql_query("SELECT * FROM nilai WHERE nama = '$id_user' and tgl BETWEEN '$awal'  AND '$akhir'  ");
	  $jlh=mysql_fetch_array(mysql_query("SELECT COUNT(tgl) ada FROM nilai WHERE nama = '$id_user' and tgl BETWEEN '$awal'  AND '$akhir'  "));
	  if ($jlh['ada']>0){ 
 while ($bpelanggan=mysql_fetch_array($qpelanggan)){	?>                 
      <tbody>
		<tr>
		<th><?php echo $bpelanggan['tgl'];?></th>
		<td><?php echo $bpelanggan['jumlah'];?></td>
		<td><?php //echo $bpelanggan['penulis'];?></td>
		</tr>
	</tbody>
     <?php } 
	 
	  }?>
      </table>
      </div>
										 <?php } ?>
									</tbody>
                                     
								</table>
						  <!-- End of .content -->
						  <div class="clear"></div>
						</div> <!-- End of .box -->
					</div>
 

