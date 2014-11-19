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
        
        <?php 
			
			$bs=mysql_query("SELECT * FROM hasil_produksi where id_produk='$id'");
            $sb=mysql_fetch_array($bs);
			?>
                 <script src="<?=$base_url?>public/js/jquery-1.8.0.min.js" type="text/javascript"></script>
              <script type="text/html" id="m3">
	          <div id="tr3_{id}" >
               
			   {id}&nbsp;<label> Nama Barang
			   
			   
			   
			  <select name="barang[]" class="form-control input-sm" required="required" id="c"  >
             <option value="0"></option>
             <?php 
				 $no=0;
				 $qpo=mysql_query("SELECT * FROM history_finis where status='Fix' AND jumlah >0  ");
				 while ($hasil=mysql_fetch_array($qpo)){ $no++; 
				
				 ?>
                <option value="<?php echo $hasil['id_fn'];?>"><?php echo $hasil['kode_barang']."-".$hasil['barang']."&nbsp;Stock&nbsp;&nbsp;&nbsp;<div style='color:#F00;'>".$hasil['jumlah']."</div>";?></option>
				<div class="jml9">gfhf</div>
             <?php } ?>
             </select> 
			   
			   
			   </label>
			   <label> Jumlah
			   <input class="form-control input-sm" type="text" name="jumlah[]" required="required"  id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>  </label>
			      <label> Harga
			   <input class="form-control input-sm" type="text" name="harga[]" required="required"  id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>  </label>
			    <label>
			   <input type="submit" value="del" class="btn" data-id="{id}" >
			    </label>
			   <br>
			    
               </div>
			   
			   </script>  
               
                      <script>
		$("#add_btn").live("click",function(){
				  
		    var newid = 0;
			var pid = $(this).attr("data-id");
			for(newid=1;($("#tr3_"+newid).length!=0);newid++){}
			var str =  $("#m3").html();
			str = str.replace(/{id}/g,newid);
			str = str.replace(/{pid}/g,pid);
			$(".content").append(str);
			
			  if(newid == 5){
				  alert("Maksimal Add barang 5");
				  $("#add_btn").hide();
			  }
			});
			
			$(".btn").live('click',function(){
			var id = $(this).attr("data-id");
			$("#tr3_"+id).remove();
			 $("#add_btn").show();
			
			});
		</script>              
                   
                            <div class="box">
                           
                                <div class="box-header" style=" margin-left:45%;">
                                    <h2 class="box-title">Edit Penjualan <?php echo $sb['customer'];?></h2>
                       
                                </div><!-- /.box-header -->
                             
                                <div class="box-body table-responsive">
                               
                               
            <form action="<?php echo base_url() . 'finance/jualan_update/'.$id."/".$user."/".$pass; ?>" method="post">
             <input type="hidden" name="id" value="<?php echo $id;?>"  >
            <label> No PO
            
            <input class="form-control input-sm" type="text" name="vol[index][nopo]" value="<?php echo $sb['invoice'];?>" readonly="readonly" >
            </label>
            
             <label> Tanggal
            <input class="form-control input-sm" type="text" name="vol[index][tanggal]" value="<?php echo $sb['tgl_masuk'];?>" required  >
            </label>
             <input  type="hidden" name="tanggal" value="<?php echo $sb['tgl_masuk'];?>"   >
            <label> Customer
            <input class="form-control input-sm" type="text" name="vol[index][sp]" value="<?php echo $sb['customer'];?>" required  >
            </label>
            <br />
            <?php $ambil2=mysql_query("SELECT * FROM history_jual where kode_jual='$id'");
                     while ($dapet2=mysql_fetch_array($ambil2)){?>
                  <label>Nama Barang
                      <select name="barang[]" class="form-control input-sm" >
                      <?php $ambil3=mysql_query("SELECT * FROM history_finis inner join
											history_jual on
											history_finis.id_fn=history_jual.nama_jual
											where history_jual.nama_jual='$dapet2[nama_jual]'");
                                            while ($dapet3=mysql_fetch_array($ambil3)){?>
                                            <?php $idd=$dapet3['id_fn'];?>
                                            
                        <option value="<?php echo $dapet2['nama_jual'];?>"><?php echo $dapet3['kode_barang']."-".$dapet3['barang'];}?></option>
                        
                        
                        <?php  $qpo=mysql_query("SELECT * FROM history_finis where status='Fix' AND jumlah >0  ");
				               while ($hasil=mysql_fetch_array($qpo)){ ?>
                              <option value="<?php echo $hasil['id_fn'];?>"><?php echo $hasil['kode_barang']."-".$hasil['barang'];?></option>
                       <?php } ?>
                     </select> 
                   </label>
                     
                     <label>Jumlah
                     <input class="form-control input-sm" type="text" name="jumlah[]" value="<?php echo $dapet2['jumlah'];?>"  required  >
                     
                     </label>
                        <label>Harga
                     <input class="form-control input-sm" type="text" name="harga[]" value="<?php echo $dapet2['harga_satuan'];?>"  required  >
                     </label>
                      <input type="hidden" name="id_fn[]" value="<?php echo $idd;?>"  >
                       <input type="hidden" name="id_jual[]" value=" <?php echo $dapet2['id_jual'];?>"  >
                   
                    
                         <br />                          
												<?php }?>
             <hr />                                   
                     <label>
                                       
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
        </script>
  
       
	
	