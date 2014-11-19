    <?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>
<style type="text/css">
.kotak1 {
	background-color: #069BFF;
	width: 30px;
	height: 20px;
}
.kotak2 {
	background-color: #003;
	width: 30px;
	height: 20px;
}
.cp {
	font-family: Calibri, 'Trebuchet MS', Verdana, Geneva, Arial, Helvetica, sans-serif;
	color: #000;
	background-color: #ffffff;
	padding: 3px;
	margin-bottom: 10px;
	border-width: 1px;
	border-style: solid;
	border-top-color: rgb(192, 192, 192);
	border-right-color: rgb(233, 233, 233);
	border-bottom-color: rgb(233, 233, 233);
	border-left-color: rgb(192, 192, 192);
	border-radius: 4px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	-khtml-border-radius: 4px;
	outline: 0;
	text-decoration: none;
	font-size: 12px;
}
</style>

 
            
 <!-----------------------------------------------------Chart-=------------------------------>           
            
        <div id="content_wrapper">      
        <div class="onecolumn"> 				
				<div class="header"> 
					<div class="description"> 
                    <div class="batas_bawah"></div>
                    <ul id="shortcut_item" class="items">   
                    <h2 align="center">Laporan  <b>Kategori Item</b> Tanggal  <span style="color:#39F;"><?php echo $awal;?>&nbsp;Sampai&nbsp;<?php echo $akhir;?></span></h2>                   
                   </ul>
                 </div> 
                 <a style="
                 margin-left:20px;" href="<?=$base_url?>aksesoris/excel_barang">
                      <img src="<?php echo base_url();?>public/images/excel.gif" width="25"  /> </a>				
				</div> 			
			<div class="content nomargin"> 
            <div style="margin-left:20px; margin-top:50px;">
            
                                   
                                   
                <div class="cp"> Terjual : <div class="kotak1"></div><br>
                                 Stock   :  <div class="kotak2"></div>
                </div>                  

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
            text: 'Data Stock barang'
        },
        yAxis: {
            allowDecimals: false,
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

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
<table id="datatable" class="global tr th"  bolder="1" bordercolor="#B7CCF0" style="font-size:11px;">
<?php

	  $qpelanggan=mysql_query("SELECT * 
						FROM barang WHERE tanggal BETWEEN '$awal'  AND '$akhir'  ");
?> 
    <thead>		
        <tr>
			<th><br></th>
            <th><br></th>

		</tr>
	</thead>
     <?php while ($bpelanggan=mysql_fetch_array($qpelanggan)){	?>
	<tbody>
		<tr>
		<th><?php echo $bpelanggan['nama_kat'];?></th>
		<td><?php echo $bpelanggan['jml_chile'];?></td>

		</tr>
	</tbody>
<?php } ?>
</table>



		</div>
            
            
            			<br class="clear"/> 
				
		  </div> 
		  </div>      
</div> 