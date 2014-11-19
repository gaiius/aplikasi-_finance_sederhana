				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>


<script src="<?=$base_url?>public/js/boxOver.js" type="text/javascript"></script>
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
                                    <h1 >Edit Finishing</h1>
                                </div>
                                <hr /><!-- /.box-header -->
                               
                     
                                <div class="box-body table-responsive" style="margin-left:100px;">
        <?php 
			
			$bs=mysql_query("SELECT * FROM finishing where id_finis='$id'");
            $sb=mysql_fetch_array($bs);
			?>
	   <form action="<?php echo base_url() . 'progres/upgrade_finis/'.$user."/".$pass; ?>" method="post" name="autoSumForm"> 
       <script type="text/javascript">
function startCalc()
{interval=setInterval("calc()",1)}

function calc()
{
one=document.autoSumForm.jumlah.value;
two=document.autoSumForm.harga.value;
tiga=document.autoSumForm.kirim.value;

var srt2 = document.autoSumForm.total.value=(one*1)*(two*1);
var srt3 = document.autoSumForm.sisa.value=(one*1)-(tiga*1)}
function stopCalc()
{clearInterval(interval)}
</script>
        <label> Invoice
            <input class="form-control input-sm" type="text" name="vol[index][invoice]" value="<?php echo $sb['invoice'];?>" required >
        </label>
        
        <label> Nama Barang
            <input class="form-control input-sm" type="text" name="vol[index][nama]" value="<?php echo $sb['nama_finis'];?>" required readonly="readonly" >
        </label>
         <br />
        <label> Jumlah
            <input class="form-control input-sm" type="text" name="jumlah" value="<?php echo $sb['jumlah_finis'];?>" onFocus="startCalc();" onBlur="stopCalc();" required id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
        </label>
       
        <label> Kirim Kembali&nbsp;&nbsp;(<em style="color:#F00;">Yard</em>)
            <input class="form-control input-sm" type="text" name="kirim" value="<?php echo $sb['kirim'];?>" onFocus="startCalc();" onBlur="stopCalc();" required id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
        </label>
        
        <label> Harga
            <input class="form-control input-sm" type="text" name="harga" value="<?php echo $sb['biaya'];?>" onFocus="startCalc();" onBlur="stopCalc();" required id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
        </label>
        
        <label> Total
            <input class="form-control input-sm" type="text" name="total" value="<?php echo $sb['total_finis'];?>" required readonly="readonly"  />
        </label>
         <label> Sisa
            <input class="form-control input-sm" type="text" name="sisa" value="<?php echo $sb['sisa'];?>" required  readonly="readonly"/>
        </label>
        <br />
       
        
       
       
         <br />
        <label> Tanggal Keluar
            <input class="form-control input-sm" type="text" name="vol[index][tanggal]" value="<?php echo $sb['tanggal'];?>" >
        </label>
    
        <label> Tanggal Kembali
            <input class="form-control input-sm" type="text" name="vol[index][tgl_kembali]" value="<?php echo $sb['tgl_kembali'];?>" >
        </label>
          <input type="hidden" name="vol[index][nama]" value="<?php echo $sb['nama_finis'];?>" >
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
  
       
	