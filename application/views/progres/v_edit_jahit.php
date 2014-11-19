				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>

<script src="<?=$base_url?>public/js/jquery.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?=$base_url?>public/js/bootstrap.min.js" type="text/javascript"></script>
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
                                    <h1 >Edit Jahit Kain</h1>
                                </div>
                                <hr /><!-- /.box-header -->
                               
                     
                                <div class="box-body table-responsive" style="margin-left:100px;">
        <?php 
			
			$bs=mysql_query("SELECT * FROM jahit where id_jahit='$id'");
            $sb=mysql_fetch_array($bs);
			?>
	   <form action="<?php echo base_url() . 'progres/upgrade_jahit/'.$user."/".$pass; ?>" method="post" name="autoSumForm">                       
       <script type="text/javascript">
function startCalc()
{interval=setInterval("calc()",1)}

function calc()
{
one=document.autoSumForm.kirim.value;
two=document.autoSumForm.harga.value;

var srt1 = document.autoSumForm.total.value=(one*1)*(two*1);}

function stopCalc()
{clearInterval(interval)}
</script>
        <label> No Po
<input class="form-control input-sm" type="text" name="vol[index][po_jahit]" value="<?php echo $sb['po_jahit'];?>" required  readonly="readonly">
        </label>
        
        <label> Nama Barang
<input class="form-control input-sm" type="text" name="vol[index][barang_jahit]" value="<?php echo $sb['barang_jahit'];?>" required >
        </label>
         <br />
        <label> Jumlah
            <input class="form-control input-sm" type="text" name="vol[index][jumlah]" value="<?php echo $sb['jumlah'];?>" required  readonly="readonly"> 
        </label>
       
        <label> Kirim Kembali&nbsp;&nbsp;(<em style="color:#F00;">Yard</em>)
            <input class="form-control input-sm" type="text" name="kirim" value="<?php echo $sb['kirim'];?>" required onFocus="startCalc();" onBlur="stopCalc();" readonly="readonly"> 
        </label>
        
        <label> Harga
            <input class="form-control input-sm" type="text" name="harga" value="<?php echo $sb['harga'];?>" required onFocus="startCalc();" onBlur="stopCalc();"  id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
        </label>
        
         <label> Total harga
            <input class="form-control input-sm" type="text" name="total" value="<?php echo $sb['total'];?>" required readonly="readonly"  >
        </label>
        
        <br />
       
        
       
       
        <label> Invoice
            <input class="form-control input-sm" type="text" name="vol[index][invoice]" value="<?php echo $sb['invoice'];?>" required  >
        </label>
         <br />
        <label> Tanggal Keluar
            <input class="form-control input-sm" type="text" name="vol[index][tanggal]" value="<?php echo $sb['tanggal'];?>" required="required"> 
        </label>
    
        <label> Tanggal Kembali
            <input class="form-control input-sm" type="text" name="vol[index][tgl_kembali]" value="<?php echo $sb['tgl_kembali'];?>" required="required" >
        </label>
        
        <hr />
                       <label> Nama Toko
    <script src="<?=$base_url?>public/js/jquery-customselect.js"></script>
    <link href="<?=$base_url?>public/css/jquery-customselect.css" rel="stylesheet" />
    
        <select id="standard" name="standard" class="custom-select" required="required">
        <?php 
		 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$sb[toko]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												
												 ?>
        <option value="<?php echo $sb['toko'];?>"><?php  echo $sl2['nama'];?></option>
        <?php 
	$selector=mysql_query("SELECT * FROM supplier where dept_toko='Jahit' ");
     while ($sl=mysql_fetch_array($selector)){?>
        <option value="<?php echo $sl['id_supplier'];?>"><?php echo $sl['nama'];?></option>
        <?php } ?>
      </select>
    </label>
    
      <script>
      $(function() {
        $("#standard").customselect();
		  var stat2 = $("#standard").val();			
			  if(stat2 == 'None - Please Select'){
			        $('#form_wizard_1').hide();
					
					 
					alert("Anda Memilih Opsi Guest");
			  }else {
			    $('#form_wizard_1').show("<hr>");
			
				 //alert("Anda Memilih Opsi Interview");
			  }
	        
      });
	  
	  
	  
	
		     
		     
	       
      </script>
      
      
         <input  type="hidden" name="vol[index][id]" value="<?php echo $id;?>" >
        <hr />
        <input type="submit" name="edit" value="Simpan" id="form_wizard_1"  />
        <div class="button-next"></div>
        </form>
        
        
           </div><!-- /.box-body -->
          </div><!-- /.box -->  
							
     						
		 
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
  
       
	