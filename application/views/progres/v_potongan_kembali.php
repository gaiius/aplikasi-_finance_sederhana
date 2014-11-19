				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>

<script src="<?=$base_url?>public/js/boxOver.js" type="text/javascript"></script>
  <script src="<?=$base_url?>public/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?=$base_url?>public/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?=$base_url?>public/css/jquery.ui.all.css">
    <link href="<?=$base_url?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?=$base_url?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?=$base_url?>public/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
       
        <!-- Theme style -->
        <link href="<?=$base_url?>public/css/AdminLTE.css" rel="stylesheet" type="text/css" />
     <div class="box">
                           
                                <div class="box-header" style=" margin-left:45%; font-size:36px;">
                                    <h1 > Potong Kain Kembali</h1>
                                </div>
                                <hr /><!-- /.box-header -->
                               
                     
                                <div class="box-body table-responsive" style="margin-left:100px;">
        <?php 
			
			$bs=mysql_query("SELECT * FROM potong where id_potong='$id'");
            $hasil=mysql_fetch_array($bs);
			?>
	  <form action="<?=$base_url?>progres/potong_kembali/<?php echo $user;?>/<?php echo $pass;?>" method="post" name="autoSumForm">                                  
                          
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Bahan kembali <?php echo $hasil['barang_potong'];?>&nbsp; PO  <?php echo $hasil['no_po'];?></h4>
      </div>
      <div class="modal-body">
       <br />
       <label>
 
    <link href="<?=$base_url?>public/css/jquery-customselect.css" rel="stylesheet" />
     <script src="<?=$base_url?>public/js/jquery-customselect.js"></script>
        <select id="standard" name="standard" class="custom-select" required="required"  onFocus="startCalc();" onBlur="stopCalc();">
        <option value="">None - Please Select</option>
        <?php 
	$selector=mysql_query("SELECT * FROM history_potong  where kode_ptk='$hasil[id_potong]' AND status='0' and stt='Keluar'");
     while ($sl=mysql_fetch_array($selector)){?>
        <option value="<?php echo $sl['id_ptk']."-".$sl['kirim_ptk'];?>" >
		<?php
		 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$sl[toko_ptk]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												
		 echo $sl2['nama']."&nbsp;&nbsp;JML&nbsp;&nbsp;".$sl['kirim_ptk'];?>
        
        </option>
        <?php } ?>
        </select>
        
        
    </label>
  
      <script>
      $(function() {
        $("#standard").customselect();
      });
	  
	   
      </script> 
      <hr />
      <label>Kiriman Hasil Potong Kain
          <input class="form-control input-sm" type="text" name="kirim" readonly="readonly"   onFocus="startCalc();" onBlur="stopCalc();" id="id1" >
       </label> 
       <br />
       <label>
       <em>PCS</em>
       <input class="form-control input-sm" type=text name="pcs" value="" onFocus="startCalc();" onBlur="stopCalc();" required  onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>  
       </label>
       <label> Dalam Lusin
       <script type="text/javascript">
	    $(".modal-footer").hide(800);  
	     $(document).ready(function() {
		      $("#standard").change(function() {
		       var stat2 = $("#standard").val();
			 //  alert(stat2);
			   $('#jml').html(stat2);
			    var regek =/^([0-9-])+([-])/;
				var stat2 = stat2.replace(regek,"");
				$('#hasil').html(stat2);
				document.getElementById('id1').value=stat2 ; 
				
				
		 });
	 });	
function startCalc()
{interval=setInterval("calc()",1)}

function calc()
{
one=document.autoSumForm.kirim.value;
two=document.autoSumForm.pcs.value;
tiga=document.autoSumForm.biaya.value;
var srt1 = document.autoSumForm.pakai.value=(one*1)/(two*1)*12;
var srt2 = document.autoSumForm.total.value=(tiga*1)*(two*1);
var srt3 = document.autoSumForm.lusin.value=(two*1)/12}
function stopCalc()
{clearInterval(interval)}
</script>
          
        
          <input class="form-control input-sm" type=text name="lusin" required readonly="readonly" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
       </label>   
       
        
       
         <label> Pemakaian bahan
          <input class="form-control input-sm" type="text" name="pakai" required readonly="readonly" >
       </label>
       <br />
       <label> Biaya
          <input class="form-control input-sm" type="text" name="biaya"  value="" onFocus="startCalc();" onBlur="stopCalc();" required id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
          Total Biaya
          <input class="form-control input-sm" type="text" name="total" required readonly="readonly" >
         
       </label>
       <hr />
   
        <label> Invoice
          <input class="form-control input-sm" type="text" name="invoice" value="<?php echo $hasil['invoice'];?>" required >
       </label>
       
       <label> 
        <br>
         <label> Nama Toko
         <?php 
												 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$hasil[ket]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												 $tokonya=$sl2['nama'];?>
          <input class="form-control input-sm" type="text"  value="<?php echo $tokonya;?>" readonly="readonly" >
       </label>
       
        <label>Tanggal Keluar
        <input class="form-control input-sm" type="text" type="date" value="<?php echo $hasil['tanggal'];?>" readonly="readonly" name="tanggal"  >
       </label>
       
         <label>Kembali
        <input class="form-control input-sm" type="date" name="tanggal_kembali" required="required"  >
       </label>
       
       <input type="hidden" name="id" value="<?php echo $hasil['id_potong'];?>"  >
       <input type="hidden" name="po" value="<?php echo $hasil['no_po'];?>"  >
       <input type="hidden" name="nama" value="<?php echo $hasil['barang_potong'];?>"  >
      </div>
      <hr />
      <label>Model
      <?php 
												 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$hasil[ket]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												 $tokonya=$sl2['nama'];?>
     
      <input class="form-control input-sm" type="text" name="model" style="width:500px;" required="required" >
                                        </label>
      <div class="modal-footer">
      <a href="<?=$base_url?>progres/potong/<?php echo $user;?>/<?php echo $pass;?>">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </a>
        <input type="submit" class="btn btn-primary" id="sm"></button>
      </div>
    </div>

       </form>  
           </div><!-- /.box-body -->
          </div><!-- /.box -->  
							
                                  
     
     <!-- DATA TABES SCRIPT -->
     
        <!-- AdminLTE App -->
        <script src="<?=$base_url?>public/js/AdminLTE/app.js" type="text/javascript"></script>
<script>

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
  
  
       
	