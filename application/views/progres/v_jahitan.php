				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>

<meta http-equiv='cache-control' content='no-cache'>

<meta http-equiv='pragma' content='no-cache'>
<meta http-equiv="Expires" content="-1">

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
			
			$bs=mysql_query("SELECT * FROM jahit where id_jahit='$id'");
            $hasil=mysql_fetch_array($bs);
			?>
<form action="<?=$base_url?>progres/jahit_kembali/<?php echo $user;?>/<?php echo $pass;?>" method="post" onFocus="startCalc();" onBlur="stopCalc();">                                            

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Proses Jahit <?php echo $hasil['barang_jahit'];?> </h4>
      </div>
      <div class="modal-body">
        <br />


    <link href="<?=$base_url?>public/css/jquery-customselect.css" rel="stylesheet" />
     <script src="<?=$base_url?>public/js/jquery-customselect.js"></script>
           <script type="text/javascript">
		   $(function() {
        $("#standard").customselect();
      });
	     $(document).ready(function() {
		      $("#standard").change(function() {
		       var stat2 = $("#standard").val();
			 //  alert(stat2);
			   $('#jml').html(stat2);
			    var regek =/^([0-9-])+([-])/;
				var stat2 = stat2.replace(regek,"");
				$('#hasil').html(stat2);
				document.getElementById('id1').value=stat2 ; 
				
				
$(".biaya").keyup(function() {
	var biaya=$(".biaya").val();
	var total=biaya*stat2;
	
	document.getElementById('total').value=total ; 
	 });
		 });
	 });	

	
</script>
        <select id="standard" name="standard" class="custom-select" required="required"  onFocus="startCalc();" onBlur="stopCalc();">
        <option value="">None - Please Select</option>
        <?php 
	$selector=mysql_query("SELECT * FROM history_jahit  where kode_jht='$hasil[id_jahit]' AND status='0' and stt='Keluar'");
     while ($sl=mysql_fetch_array($selector)){?>
        <option value="<?php echo $sl['id_jht']."-".$sl['kirim_jht'];?>" >
		<?php
		 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$sl[toko_jht]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												
		 echo $sl2['nama']."&nbsp;&nbsp;JML&nbsp;&nbsp;".$sl['kirim_jht'];?>
        
        </option>
        <?php } ?>
        </select>

        <label>Jumlah
        <input type=text name="kirim" class="form-control input-sm" value="" id="id1" readonly="readonly" />
         </label> 
         <br />
         <label>Biaya Per PCS
          <input type="text" name="biaya" autocomplete="off" class="biaya form-control input-sm" required id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
         <input type=text name="total1" class="form-control input-sm" value="" id="total" readonly="readonly" />
         </label> 
          <br>
            <label> Tanggal
          <input class="form-control input-sm" type="date" value="31/12/2012/"  name="tanggal_kembali"  required="required"  /><br>
       </label>
          <input type="hidden" name="total" value="<?php echo $hasil['total'];?>" >
          <input type="hidden" name="po" value="<?php echo $hasil['po_jahit'];?>" >
          <input type="hidden" name="nama" value="<?php echo $hasil['barang_jahit'];?>" >
          <input type="hidden" name="id" value="<?php echo $hasil['id_jahit'];?>" >
      </div>
  <div class="modal-footer">
      <a href="<?=$base_url?>progres/jahis/<?php echo $user;?>/<?php echo $pass;?>">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </a>
        <input type="submit" class="btn btn-primary"></button>
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
  
  
       
	