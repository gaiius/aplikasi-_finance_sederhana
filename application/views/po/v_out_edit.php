				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>




 <link href="<?=$base_url?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?=$base_url?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?=$base_url?>public/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?=$base_url?>public/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?=$base_url?>public/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <script src="<?=$base_url?>public/js/jquery-1.8.0.min.js" type="text/javascript"></script>
               <script type="text/html" class="m3">
			   <label> Nama Barang
			   <input class="form-control input-sm" type="text" name="barang2[]" required  ></label>
			   <label> Jumlah
			   <input class="form-control input-sm" type="text" name="jumlah2[]" required  ></label>
			     <label> harga
			   <input class="form-control input-sm" type="text" name="harga2[]" required  ></label>
			   <input  type="hidden" name="tambah" value="tambah"  >
			   <input  type="hidden" name="id2" value"<?php echo $id;?>"  ></label>
			   <br>
			   </script>  
               
               <script>
			   $("#add_btn").live("click",function(){
				  var str=$(".m3").html()
				  $(".content").append(str,"<br>"); 
			   });
			   
			   </script>   
                            <div class="box">
                           
                                <div class="box-header" style=" margin-left:45%;">
                                    <h2 class="box-title">Edit Bahan</h2>
                       
                                </div><!-- /.box-header -->
                             
                                <div class="box-body table-responsive">
                               
                               
            
            <?php 
			
			$bs=mysql_query("SELECT * FROM po_out where id_out='$id'");
            $sb=mysql_fetch_array($bs);
			?>
            <form action="<?php echo base_url() . 'purchase/out_edit/'.$id."/".$user."/".$pass; ?>" method="post" name="autoSumForm">
             <input type="hidden" name="par" value="ada"  >
            <label> 
             Invoice
            <input class="form-control input-sm" type="text" name="vol[index][nopo]" value="<?php echo $sb['kode'];?>" >
            </label>
            
             <label> Tanggal
            <input class="form-control input-sm" type="text" name="vol[index][tanggal]" value="<?php echo $sb['tgl'];?>" >
            </label>
            <hr />
              <script src="<?=$base_url?>public/js/jquery-customselect.js"></script>
    <link href="<?=$base_url?>public/css/jquery-customselect.css" rel="stylesheet" />
    <label> Add List Toko<br />
        <select id="standard" name="standard" class="custom-select" required="required">
        <?php 
		 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$sb[supplier]' ");
         $sl2=mysql_fetch_array($selector2); ?>
        <option value="<?php echo $sb['supplier'];?>"><?php echo $sl2['nama'];?> </option>
        <?php 
	$selector=mysql_query("SELECT * FROM supplier where dept_toko='Belanja'");
     while ($sl=mysql_fetch_array($selector)){?>
        <option value="<?php echo $sl['id_supplier'];?>"><?php echo $sl['nama'];?></option>
        <?php } ?>
      </select>
    </label>
    
      <script>
      $(function() {
        $("#standard").customselect();
      });
      </script>
            <hr />
               <label> jenis
            <input class="form-control input-sm" type="text" name="vol[index][jenis]" required="required" value="<?php echo $sb['barang'];?>"  >
            </label>
			<script type="text/javascript">
function startCalc(){interval=setInterval("calc()",1)}function calc()
{
one=document.autoSumForm.yard.value;
two=document.autoSumForm.harga.value;
document.autoSumForm.thirdBox.value=(one*1)*(two*1)}
function stopCalc()
{clearInterval(interval)}
</script>
            
               <label> Yard
            <input class="form-control input-sm" type="text" name="yard" value="<?php echo $sb['jumlah'];?>"  onFocus="startCalc();" onBlur="stopCalc();" required="required" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
            </label>
            
              <label> harga
            <input class="form-control input-sm" type="text" name="harga" value="<?php echo $sb['harga_satuan'];?>"  onFocus="startCalc();" onBlur="stopCalc();" required="required" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
            </label>
            <label> Total
            <input type=text name="thirdBox" class="form-control input-sm" value="<?php echo $sb['total'];?>" required="required" readonly="readonly" >
            </label>
            <hr />
            
         
            
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary" />
            </form>
            
                                </div><!-- /.box-body -->

        
       
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
  
       
	
	
	