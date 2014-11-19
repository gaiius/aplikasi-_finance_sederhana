				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>




  <!-- This is what you need -->
<script src="<?=$base_url?>public/js/jquery.min.js" type="text/javascript"></script>
 

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
                                    <h2 class="box-title">Add Penjualan</h2>
                       
                                </div><!-- /.box-header -->
                             
                                <div class="box-body table-responsive">
               
              
              <script src="<?=$base_url?>public/bootstrap.min.js"></script>
             
    
    
              <div id="m3" style="display: none;">
	          <div id="tr3_{id}" >
			   {id}&nbsp;
               <label> Nama Barang
			   <br />
				<input type="text"  style="width:300px;" name="barang[]" autocomplete="off" class="span6 typeahead form-control input-sm" id="typeahead"  
                  data-provide="typeahead"   data-items="4" data-source='
                 [ <?php $qpo=mysql_query("SELECT * FROM history_finis where status='Fix' AND jumlah >0  ");
			             while ($hasil=mysql_fetch_array($qpo)){  ?>
                         "<?php echo $hasil['kode_barang']."/".$hasil['barang']."&nbsp;Stock&nbsp;&nbsp;&nbsp;".$hasil['jumlah'];?>",<?php } ?>""]'>			   
			   </label>
               
			   <label> Jumlah
			   <input class="form-control input-sm" type="text" name="jumlah[]" autocomplete="off" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>  </label>
			      <label> Harga
			   <input class="form-control input-sm" type="text" name="harga[]" autocomplete="off" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>  </label>
			    <label>
			  
			    </label>
			   <br>
			    
               </div>
			   
			   </div> 
               
                   
                             
            <form action="<?php echo base_url() . 'finance/jualan_insert/'.$user."/".$pass; ?>" method="post">
             <input type="hidden" name="par" value="ada"  >
            <label> Invoice
            <?php 
			
			$bs=mysql_query("SELECT id_out FROM po_out order by id_out DESC");
            $sbb=mysql_fetch_array($bs);
			$tgl=date('dmy');
			$id=$sbb['id_out']+1;
			$acak	  = rand(000,999);
			?>
            <input class="form-control input-sm" type="text" name="vol[index][nopo]" required="required" value="<?php echo "PO-$tgl"."-".$id."-".$acak;?>" >
            </label>
            
             <label> Tanggal
            <input class="form-control input-sm" type="text" name="vol[index][tanggal]" required="required" value="<?php echo date('d/m/Y');?>" >
            </label>
            
          <hr />
         <label> Customer<br />
                           <script src="<?=$base_url?>public/js/jquery-customselect.js"></script>
    <link href="<?=$base_url?>public/css/jquery-customselect.css" rel="stylesheet" />
    
        <select id="standard" name="standard" class="custom-select" required="required">
        <option value="">Pilih Customer</option>
        <?php 
	$selector=mysql_query("SELECT * FROM customer");
     while ($sl=mysql_fetch_array($selector)){?>
        <option value="<?php echo $sl['id_customer'];?>"><?php echo $sl['nama'];?></option>
        <?php } ?>
      </select>
    </label>
    
      <script>
      $(function() {
        $("#standard").customselect();
		
      });
      </script>	
            
            <hr />
             <label> 
             <a id="add_btn" class="btni" style="color:#FFF; background-color:#09F;">Add Barang Jual</a>
             <div class="content"></div>
             </label>
            <hr />
            
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary" />
            <a href="<?=$base_url?>finance/pembelanjaan/<?php echo $user;?>/<?php echo $pass;?>">
            <input type="button" name="Back" value="Back" class="btn btn-primary" />
            </a>
            </form>
            
            
                                </div><!-- /.box-body -->

        

             
                     <script>
		$("#add_btn").click(function(){
				  
		    var newid = 0;
			var pid = $(this).attr("data-id");
			for(newid=1;($("#tr3_"+newid).length!=0);newid++){}
			var str =  $("#m3").html();
			str = str.replace(/{id}/g,newid);
			str = str.replace(/{pid}/g,pid);
			$(".content").append(str);
			var komplet=$("#typeahead").val();
			//alert(komplet);
			  if(newid == 15){
				  alert("Maksimal Add barang 15");
				  $("#add_btn").hide();
			  }
			});
			
			
			$(".btn").click(function(){
			var id = $(".btn"+id);
			$("#tr3_"+id).remove();
			 $("#add_btn").show();
			
			});
		</script>  
       
      
		
     
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
  
       
	
	
	