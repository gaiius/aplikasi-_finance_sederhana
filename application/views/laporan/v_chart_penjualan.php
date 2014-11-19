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

<?php

$awal_pecah = '/[\-]/';
$awal_list =  preg_replace($awal_pecah,'/', $awalan);

$akhir_pecah = '/[\-]/';
$akhir_list =  preg_replace($akhir_pecah,'/', $akhiran);

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
      
                            
         <div class="content nomargin"> 
            <div style="margin-left:20px; margin-top:50px;">
            
                                   
                                   
                <div class="cp"> Tempo : <div class="kotak1"></div><br>
                                 Penjualan   :  <div class="kotak2"></div>
                </div>                  

		<script type="text/javascript" src="<?=$base_url?>public/js/googlechart.js"></script>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        data: {
            table: document.getElementById('example1')
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Data Penjualan dan Harga Barang dari <?php echo $akhir_list;?> Sampai <?php echo $akhir_list;?>'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: ''
            }
        },
      
    });
});
		</script>
	
<script src="<?=$base_url?>public/js/highcharts.js"></script>
<script src="<?=$base_url?>public/js/modules/data.js"></script>
<script src="<?php echo base_url();?>public/js/modules/exporting.js"></script>

<div id="container" ></div>
 
<table id="example1" class="table table-bordered table-striped">
    <thead>		
        <tr>
			<th>Barang</th>
            <th>Lunas</th>
            <th>Tempo</th>
		</tr>
	</thead>
    <tbody>
     <?php 
	  if($po =='po_kosong' AND $barang == 'barang_kosong'){
	$sql=mysql_query("select * from history_jual where tgl_jual BETWEEN '$awal_list'  AND '$akhir_list'");
}elseif($barang == 'barang_kosong'){
	$sql=mysql_query("select * from history_jual  WHERE po_jual='$po' AND tgl_jual BETWEEN '$awal_list'  AND '$akhir_list' ");
}elseif($po =='po_kosong'){
	$sql=mysql_query("select * from history_jual  WHERE nama_jual='$barang' AND tgl_jual BETWEEN '$awal_list'  AND '$akhir_list' ");
}else{
	$sql=mysql_query("select * from history_jual  WHERE po_jual='$po' AND nama_jual='$barang' AND tgl_jual BETWEEN '$awal_list'  AND '$akhir_list' ");
} 
	 while ($bpelanggan=mysql_fetch_array($sql)){	?>
	
		<tr>
		<th><?php 
		$sup3=mysql_query("SELECT * FROM history_finis where id_fn='$bpelanggan[nama_jual]'");
                                                    $dapet4=mysql_fetch_array($sup3);
		echo $dapet4['barang']."/".$dapet4['kode_barang'];?></th>
		
        <td><?php echo $bpelanggan['bayarnya'];?></td>
        <td><?php echo $bpelanggan['harga'];?></td>
		</tr>
        <?php } ?>
	</tbody>

</table>


</div>
		</div>
					
	
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
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
				

	
     
							
		