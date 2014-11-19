				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>
<!--<script src="<?=$base_url?>public/boxOver.js"></script>-->



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
                           
                                <div class="box-header" style=" margin-left:45%;">
                                    <h2 class="box-title">Add Bahan</h2>
                       
                                </div><!-- /.box-header -->
                             
                                <div class="box-body table-responsive">
              <script src="<?=$base_url?>public/js/jquery-1.8.0.min.js" type="text/javascript"></script>
                  
                               
            <form action="<?php echo base_url() . 'purchase/out_insert1/'.$user."/".$pass; ?>" method="post" name="autoSumForm">
             <input type="hidden" name="par" value="ada"  >
            <label> No Invoice
            <?php 
			
			$bs=mysql_query("SELECT id_out FROM po_out order by id_out DESC");
            $sbb=mysql_fetch_array($bs);
			$tgl=date('dmy');
			$id=$sbb['id_out']+1;
			$acak	  = rand(000,999);
			?>
            <input class="form-control input-sm" type="text" name="vol[index][nopo]" value="<?php echo "PO-$tgl"."-".$id."-".$acak;?>" >
            </label>
            
             <label> Tanggal
            <input class="form-control input-sm" type="text" name="vol[index][tanggal]" value="<?php echo date('d/m/Y');?>" >
            </label>
            <hr />
  <script src="<?=$base_url?>public/js/jquery-customselect.js"></script>
    <link href="<?=$base_url?>public/css/jquery-customselect.css" rel="stylesheet" />
    <label> Add List Toko<br />
        <select id="standard" name="standard" class="custom-select" required="required">
        <option value=""></option>
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
          </label>
                      
            <hr />
               <label> jenis
            <input class="form-control input-sm" type="text" name="vol[index][jenis]" required="required"  >
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
            <input class="form-control input-sm" type="text" name="yard"  onFocus="startCalc();" onBlur="stopCalc();" required="required" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
            </label>
            
              <label> harga
            <input class="form-control input-sm" type="text" name="harga"  onFocus="startCalc();" onBlur="stopCalc();" required="required" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
            </label>
            <label> Total
            <input type=text name="thirdBox" class="form-control input-sm" readonly="readonly" required="required" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
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
  
       
	
	
	