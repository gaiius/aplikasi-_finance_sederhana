				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>


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
                           
                                <div class="box-header" style=" margin-left:45%; font-size:36px;">
                                    <h1 >Finishing</h1>
                       
                                </div>
                                <hr /><!-- /.box-header -->
                           
                                <div class="box-body table-responsive">
                               
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                 <th>Tgl Keluar</th>
                                                 <th>Tgl Kembali</th>
                                                 <th>No PO</th>
                                                 <th>Surat Jalan</th>
                                                 <th>Model</th>
                                                 <th>Warna</th>
                                                 <th>Jumlah</th>
                                                 <th>Terima</th>
                                       
                                                <th>Status</th>
                                                 <th>Nama Toko</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $qpo=mysql_query("SELECT * FROM finishing order by id_finis DESC   ");
					                        while ($hasil=mysql_fetch_array($qpo)){ $no++;	
				                          ?>
                                            <tr>
                                               <td><?php echo $no;
											     if(empty($hasil['tgl_kembali'])){
												   echo "";
											   }else{
											   ?>
                                               <a href="<?=$base_url?>progres/edit_finis/<?php echo $hasil['id_finis'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                                 <?php 
                                                   $xlogin=mysql_query("SELECT * FROM login where user='$user' and password='$pass'");
                                                   $xlog=mysql_fetch_array($xlogin);
                                                     if($xlog['hakakses'] == 1){
	                                                    $edit="Edit";
	                                                    $del="Del";
                                                     }else{
	                                                    $edit="";
	                                                    $del="";
                                                     }
                                                     echo $edit;
											   }?>
                                                     </a>
                                            
                                               &nbsp;
                                               </td>
                                               <td>
											   <?php if(empty($hasil['tanggal'])){?>
                                                <a data-toggle="modal" data-target="#myModal_1<?php echo $hasil['id_finis'];?>" style="top:-20px;">
                                               <em>Add Barang</em>
                                               </a>
                                               <?php }else{?>
											   
											   <?php echo $hasil['tanggal'];?> 
                                              
                                               <?php } 
											   $bs=mysql_query("SELECT id_finis FROM finishing order by id_finis DESC");
            $sbb=mysql_fetch_array($bs);
			$tgl=date('dmy');
			$id=$sbb['id_finis']+1;
			$acak	  = rand(000,999);
			$val="PTG/".$id."-".$tgl;
											   ?>
                                               
                                               
    <form action="<?=$base_url?>progres/finis_kirim/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                            
<div class="modal fade" id="myModal_1<?php echo $hasil['id_finis'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Kirim Barang <?php echo $hasil['nama_finis'];?> </h4>
      </div>
      <div class="modal-body">
        <br />
        <label>Jumlah
          <input class="form-control input-sm" type="text" name="kirim" value="<?php echo $hasil['jumlah_finis'];?>" readonly="readonly"id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
         </label> 
         
         
         
         <label>Invoice
          <input class="form-control input-sm" type="text" name="invoice" value="<?php echo $val;?>" required="required"  >
         </label> 
         
          <label> Nama Toko<br />
    <script src="<?=$base_url?>public/js/jquery-customselect.js"></script>
    <link href="<?=$base_url?>public/css/jquery-customselect.css" rel="stylesheet" />
    
        <select id="standard" name="standard" class="custom-select" required="required">
        <option value="">None - Please Select</option>
        <?php 
	$selector=mysql_query("SELECT * FROM supplier where dept_toko='Finishing' ");
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
          <br>
             <label> Tanggal
          <input class="form-control input-sm" type="date" value="31/12/2012/"  name="tanggal"  required="required"  /><br>
       </label>
          <input type="hidden" name="total" value="<?php echo $hasil['total_finis'];?>" >
          <input type="hidden" name="po" value="<?php echo $hasil['po_finis'];?>" >
          <input type="hidden" name="nama" value="<?php echo $hasil['nama_finis'];?>" >
          <input type="hidden" name="id" value="<?php echo $hasil['id_finis'];?>" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" id="a"></button>
         
      </div>
    </div>
  </div>
</div>
</form>
						
                                               </td>
                                               
                                               
                                               <td> 
											   <?php if(empty($hasil['tgl_kembali'])){?>
                                                 <a data-toggle="modal" data-target="#myModal_<?php echo $hasil['id_finis'];?>" style="top:-20px;">
                                               <em>Add Barang</em>
                                               </a>
                                               <?php }elseif($hasil['jumlah_finis'] == $hasil['kirim']){
												      echo $hasil['tgl_kembali'];
											         }else{?>
											     <a data-toggle="modal" data-target="#myModal_<?php echo $hasil['id_finis'];?>" style="top:-20px;">
											   <?php echo $hasil['tgl_kembali'];?> 
                                               </a>
                                               <?php }?>
													
													
<form action="<?=$base_url?>progres/finis_kembali/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                            
<div class="modal fade" id="myModal_<?php echo $hasil['id_finis'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Proses Finishing <?php echo $hasil['nama_finis'];?> Selesai </h4>
      </div>
      <div class="modal-body">
        <br />
        <label>Jumlah Awal <?php echo number_format($hasil['jumlah_finis']);?>
        <?php 
		if(empty($hasil['sisa'])){
			$status=$hasil['jumlah_finis'];
		}else{
			$status=$hasil['sisa'];
		}
		?>
          <input class="form-control input-sm" type="text" name="kirim" value="<?php echo $status;?>" required="required" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
         </label> 
         
         <label>Biaya Per PCS
          <input class="form-control input-sm" type="text" name="biaya" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input>
         </label> 
         
         <label>Kode Barang
          <input class="form-control input-sm" type="text" name="kode"  >
         </label> 
         
         <label>Invoice
          <input class="form-control input-sm" type="text" name="invoice" value="<?php echo $hasil['invoice'];?>"  >
         </label> 
         
          
                        
        
          <br>
            <label> Tanggal
          <input class="form-control input-sm" type="date" value="31/12/2012/"  name="tgl"  required="required"  /><br>
       </label>
          <input type="hidden" name="total" value="<?php echo $hasil['jumlah_finis'];?>" >
          <input type="hidden" name="po" value="<?php echo $hasil['po_finis'];?>" >
          <input type="hidden" name="nama" value="<?php echo $hasil['nama_finis'];?>" >
          <input type="hidden" name="id" value="<?php echo $hasil['id_finis'];?>" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>
</form>
												</td>
                                               
                                                <td><?php echo $hasil['po_finis'];?></td>
                                                <td><?php echo $hasil['invoice'];?></td>
                                                <td><?php echo $hasil['nama_finis'];?></td>
                                                <td><?php echo $hasil['warna'];?></td>
                                                <td><?php echo number_format($hasil['jumlah_finis']);?></td>
                                                <td><?php echo number_format($hasil['kirim']);?></td>
                                              
                                                <td><?php echo $hasil['status'];?></td>
                                                <td><?php 
												 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$hasil[toko]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												 echo $sl2['nama'];?></td>
                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                     
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->  
							
		
							
							
							
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
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
               // $('#example2').dataTable({
                  //  "bPaginate": true,
                  //  "bLengthChange": false,
                  //  "bFilter": false,
                  //  "bSort": true,
                  //  "bInfo": true,
                  //  "bAutoWidth": false
                //});
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
  
       
	