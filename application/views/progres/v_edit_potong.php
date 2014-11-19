				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>

<script src="<?=$base_url?>public/js/jquery.min.js" type="text/javascript"></script>
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
                                    <h1 >Edit Potong Kain</h1>
                                </div>
                                <hr /><!-- /.box-header -->
                               
                     
                                <div class="box-body table-responsive" style="margin-left:100px;">
        <?php 
			
			$bs=mysql_query("SELECT * FROM potong where id_potong='$id'");
            $sb=mysql_fetch_array($bs);
			if(empty($sb['tgl_kembali'])){
				 for($i=0; $i<12; $i++){
				$s="readonly='readonly'";
				$r=$s.$i;
				$m="";
				$p="readonly='readonly'";
				}
			}else{
				 for($a=0; $a<10; $a++){
				$s="readonly='readonly'";
				$m=$s.$a;
				$p="readonly='readonly'";
				$r="";
				 }
			}
			?>
	   <form action="<?php echo base_url() . 'progres/upgrade_potong/'.$user."/".$pass; ?>" method="post" name="autoSumForm">           
       <script type="text/javascript">
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
        <label> No Po
            <input class="form-control input-sm" type="text" name="vol[index][po]" value="<?php echo $sb['no_po'];?>" required <?php echo $p;?> >
        </label>
        
        <label> Nama Barang
            <input class="form-control input-sm" type="text" name="vol[index][barang]" value="<?php echo $sb['barang_potong'];?>" required <?php echo $p;?> >
        </label>
         <br />
          <label> Jumlah
            <input class="form-control input-sm" type="text" name="vol[index][jumlah]" value="<?php echo $sb['jumlah'];?>" required <?php echo $p;?> id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
        </label>
        
         <label> Kirim Kembali&nbsp;&nbsp;(<em style="color:#F00;">Yard</em>)
            <input class="form-control input-sm" type="text" name="kirim" value="<?php echo $sb['kirim'];?>" required <?php echo $p;?> onFocus="startCalc();" onBlur="stopCalc();" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
        </label>
       
        
        <hr />
        
        
          <label><em style="color:#F00;">PCS</em>
            <input class="form-control input-sm" type="text" name="pcs" value="<?php echo $sb['pcs'];?>" required <?php echo $r;?> onFocus="startCalc();" onBlur="stopCalc();" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
        </label>
        
       <label> Dalam Lusin 
            <input class="form-control input-sm" type="text" name="lusin" value="<?php echo $sb['lusin'];?>" required <?php echo $p;?> id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
        </label>
       
              <label> Pemakaian
            <input class="form-control input-sm" type="text" name="pakai" value="<?php echo $sb['pakai'];?>" required <?php echo $p;?> id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
        </label>
        
        
       
           <hr />
        <label> Harga Per PCS
            <input class="form-control input-sm" type="text" name="biaya" value="<?php echo $sb['biaya'];?>" required <?php echo $r;?> onFocus="startCalc();" onBlur="stopCalc();" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
        </label>
      
          <label> Total
        <input class="form-control input-sm" type="text" name="total" value="<?php echo $sb['total'];?>" required readonly="readonly" >
        </label>
        <br />
  
         
         
        
       
        <label> Invoice
            <input class="form-control input-sm" type="text" name="vol[index][invoice]" value="<?php echo $sb['invoice'];?>" required >
        </label>
         <br />
        <label> Tanggal Keluar
            <input class="form-control input-sm" type="text" name="vol[index][tanggal]" value="<?php echo $sb['tanggal'];?>" required  >
        </label>
    
        <label> Tanggal Kembali
            <input class="form-control input-sm" type="text" name="vol[index][tgl_kembali]" value="<?php echo $sb['tgl_kembali'];?>" required="required">
        </label>
         <input  type="hidden" name="vol[index][id]" value="<?php echo $id;?>" >
        <hr />
             <label> Nama Toko<br />
    <script src="<?=$base_url?>public/js/jquery-customselect.js"></script>
    <link href="<?=$base_url?>public/css/jquery-customselect.css" rel="stylesheet" />
    <?php 
		$selector2=mysql_query("SELECT * FROM supplier where id_supplier='$sb[ket]' ");
        $sl2=mysql_fetch_array($selector2);?>
        <select id="standard" name="standard" class="custom-select" <?php echo $m;?>>
        <option value="<?php echo $sb['ket'];?>"><?php echo $sl2['nama'];?></option>
        <?php 
	$selector=mysql_query("SELECT * FROM supplier where dept_toko='Potong' ");
     while ($sl=mysql_fetch_array($selector)){?>
        <option value="<?php echo $sl['id_supplier'];?>"><?php echo $sl['nama'];?></option>
        <?php } ?>
      </select>
    </label>
  
      <script>
      $(function() {
        $("#standard").customselect();
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
        <hr /><label> Model<br />
        
         <input class="form-control input-sm" type="text" name="model" style="width:500px;" value="<?php echo $sb['model'];?>"  >                               
                                        </label>
                                        <hr />
                                        
                                         <?php 
				                           $no=0;
					                        $qp9=mysql_query("SELECT * FROM history_potong where kode_ptk='$sb[id_potong]'   ");
					                        while ($hasil3=mysql_fetch_array($qp9)){ $no++;	
				                          ?>
                                        
                                        <?php } ?>
                                        <hr />
                                        
                                        
        <input type="submit" name="edit" value="Simpan" />
        </form>
        
        
           </div><!-- /.box-body -->
          </div><!-- /.box -->  
							
                                  
        
        <!-- DATA TABES SCRIPT -->
      
        <!-- AdminLTE App -->
        <script src="<?=$base_url?>public/js/AdminLTE/app.js" type="text/javascript"></script>

 
     
  
       
	