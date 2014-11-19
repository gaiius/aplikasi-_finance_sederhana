				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>

<script src="<?=$base_url?>public/js/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?=$base_url?>public/css/jquery.ui.all.css">
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
                                    <h1 >Edit Laundry</h1>
                                </div>
                                <hr /><!-- /.box-header -->
                               
                     
                                <div class="box-body table-responsive" style="margin-left:100px;">
        <?php 
			
			$bs=mysql_query("SELECT * FROM laundry where id_laundry='$id'");
            $sb=mysql_fetch_array($bs);
			?>
	   <form action="<?php echo base_url() . 'progres/upgrade_loundry/'.$user."/".$pass; ?>" method="post">
	     <br />
        <label> Jumlah
            <input class="form-control input-sm" type="text" name="vol[index][jumlah]" value="<?php echo $sb['jumlah_laundry'];?>" readonly="readonly"  id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
        </label>
       
        <label> Sisa
            <input class="form-control input-sm" type="text" name="vol[index][kirim]" value="<?php echo $sb['total_laundry'];?>" readonly="readonly"  id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
        </label>
        
   
        <br />
       
        
         <input type="hidden" name="barang" value="<?php echo $sb['nama_laundry'];?>" >
       
        <label> Invoice
            <input class="form-control input-sm" type="text" name="vol[index][invoice]" value="<?php echo $sb['invoice'];?>" required  >
        </label>
        <label> Warna
            <input class="form-control input-sm" type="text" name="vol[index][warna]" value="<?php echo $sb['warna'];?>" required  >
        </label>
         <br />
        <label> Tanggal Keluar
            <input class="form-control input-sm" type="text" name="vol[index][tanggal]" value="<?php echo $sb['tanggal'];?>" >
        </label>
    
       
      
      
        
   
        <br />
        <br />
        <hr />
        
        <b>History Barang Keluar</b>
        <hr />
        <?php  
		
		$p=mysql_query("SELECT * FROM history_ly where kode_ly='$id'   ");
		  while ($s2=mysql_fetch_array($p)){ ?>
          
              
        <?php 
		$selector2=mysql_query("SELECT * FROM supplier where id_supplier='$s2[toko_ly]' ");
        $sl2=mysql_fetch_array($selector2);
		
		?>
	<label> Nama Toko
            <br />
     
        <?php 
	$selector=mysql_query("SELECT * FROM supplier where dept_toko='Laundry' ");
     $sl=mysql_fetch_array($selector)?>
        <input value="<?php echo $sl['nama'];?>" class="form-control" type="text" readonly="readonly" >
        
  </label>
 
    
      
               <label> Jumlah
         <input class="form-control input-sm" type="text" readonly="readonly" value="<?php echo $s2['kirim_ly'];?>"  id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
           </label>  
           
         <label> Tanggal
         <input class="form-control input-sm" type="text" readonly="readonly"  value="<?php echo $s2['tanggal'];?>"  id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
         </label>  
                               
                   <br />  
          
          <?php } ?>
        <hr />
        <b>History Barang Kembali</b><hr />
        <?php 
		
		//$jlh=mysql_fetch_array(mysql_query("SELECT COUNT(id_hl) ada FROM history_laundry where kode_hl='$id'  "));
		//$jumlahnya=$jlh['ada'];
		 $no=0;
		  $qpo=mysql_query("SELECT * FROM history_laundry where kode_hl='$id'   ");
		  while ($hasil2=mysql_fetch_array($qpo)){ $no++;
		  
		  //$qp4=mysql_query("SELECT * FROM history_laundry where kode_hl='$id' order by id_hl DESC   ");
		 // $h21=mysql_fetch_array($qp4);
		  //echo $h21['id_hl'];
		  ?>
                                          
         
           <a href="<?=$base_url?>progres/del_chile/<?php echo $hasil2['id_hl'];?>/<?php echo $id;?>/<?php echo $hasil2['jumlah'];?>/<?php echo $user;?>/<?php echo $pass;?>">
          Delete 
          </a>
          &nbsp;
          <label> Jumlah
         <input class="form-control input-sm" type="text" name="jumlah[]"  value="<?php echo $hasil2['jumlah'];?>" r id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
           </label>                           
                                        
                                        
           <label> Harga
            <input class="form-control input-sm" type="text" name="biaya[]"  value="<?php echo $hasil2['biaya'];?>"  id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
           </label>    
           
            <label> Total Harga
            <input class="form-control input-sm" type="text" name="total[]" value="<?php echo $hasil2['total'];?>" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
           </label>      
           
                 
           
           <label> tanggal
            <input class="form-control input-sm" type="text" name="tanggal[]" value="<?php echo $hasil2['tanggal'];?>" >
           </label> 
           <input  type="hidden" name="id_hl[]" value="<?php echo $hasil2['id_hl'];?>" >                   
                                
                                        <br />
                                          <?php } ?>
        
     
        
        
        
        <hr />
         <input  type="hidden" name="vol[index][id]" value="<?php echo $id;?>" >
        <hr />
        <input type="submit" name="edit" value="Simpan" />
        </form>
        
        
           </div><!-- /.box-body -->
          </div><!-- /.box -->  
							
                                  
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
  
       
	