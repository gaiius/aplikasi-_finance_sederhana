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
                                    <h1 >Laundry</h1>
                       
                                </div>
                                <hr /><!-- /.box-header -->
                           
                                <div class="box-body table-responsive">
                               
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jumlah</th>
                                                <th style="background-color:#F30; color:#FFF;">Tgl Keluar</th>
                                                 <th style="background-color:#F30;color:#FFF;">Kirim </th>
                                                 <th style="background-color:#009933;color:#FFF;">Tgl Kembali</th>
                                                 <th style="background-color:#009933;color:#FFF;">Kirim / History</th>
                                                 <th>No PO</th>
                                                 <th>Surat Jalan</th>
                                                 <th>warna</th>
                                                 <th>Barang</th>
                                                 <th>Sisa</th>
                                                <th>Status</th>
                                              
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $q=mysql_query("SELECT * FROM laundry order by id_laundry DESC   ");
					                        while ($hasil=mysql_fetch_array($q)){ $no++;	
				                          ?>
                                            <tr>
                                               <td><?php echo $no;
											    
											   ?>
                                               &nbsp;
                                             <a href="<?=$base_url?>progres/edit_laundry/<?php echo $hasil['id_laundry'];?>/<?php echo $user;?>/<?php echo $pass;?>">
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
													 
											   ?>
                                                     </a>
                                               &nbsp;
                                             
                                               &nbsp;
                                               </td>
                                               <td><?php echo number_format($hasil['jumlah_laundry']);?></td>
                                               <td><?php 
											                                     
			
			$bs=mysql_query("SELECT id_laundry FROM laundry order by id_laundry DESC");
            $sbb=mysql_fetch_array($bs);
			$tgl=date('dmy');
			$id=$sbb['id_laundry']+1;
			$acak	  = rand(000,999);
			$val="PTG/".$id."-".$tgl;
			
				
											if(empty($hasil['tanggal'])){?>
                                                <a  data-toggle="modal" data-target="#myModal_1<?php echo $hasil['id_laundry'];?>" style="top:-20px;">
                                               <em>Add Barang</em>
                                               </a>
                                               
                                               <?php }elseif($hasil['sisa_tkeluar'] == 0){
												    echo $hasil['tanggal'];
											    }else{?>
											   <a  data-toggle="modal" data-target="#myModal_1<?php echo $hasil['id_laundry'];?>" style="top:-20px;">
											   <?php echo $hasil['tanggal'];?> 
                                               </a>
                                               <?php } ?>
<form action="<?=$base_url?>progres/laundry_kirim/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                            
<div class="modal fade" id="myModal_1<?php echo $hasil['id_laundry'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Kirim Barang <?php echo $hasil['nama_laundry'];?> </h4>
      </div>
      <div class="modal-body">
        <br />
        <label>Jumlah
          <input class="form-control input-sm" type="text" name="kirim" value="<?php echo $hasil['sisa_tkeluar'];?>" required id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
         </label> 
         
         
         
         <label>Invoice
          <input class="form-control input-sm" type="text" name="invoice" value="<?php echo $val;?>" required  >
         </label> 
         
                <label> Nama Toko<br />
    <script src="<?=$base_url?>public/js/jquery-customselect.js"></script>
    <link href="<?=$base_url?>public/css/jquery-customselect.css" rel="stylesheet" />
    
        <select id="standard" name="standard" class="custom-select" required="required">
        <option value="">None - Please Select</option>
        <?php 
	$selector=mysql_query("SELECT * FROM supplier where dept_toko='Laundry' ");
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
          <input type="hidden" name="total" value="<?php echo $hasil['total_laundry'];?>" >
          <input type="hidden" name="po" value="<?php echo $hasil['po_laundry'];?>" >
          <input type="hidden" name="nama" value="<?php echo $hasil['nama_laundry'];?>" >
          <input type="hidden" name="id" value="<?php echo $hasil['id_laundry'];?>" >
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
                                    <td><?php 
									echo number_format($hasil['kirim_keluar'])."&nbsp;&nbsp;&nbsp;Sisa&nbsp;<em style=color:#F00;>".number_format($hasil['sisa_tkeluar'])."</em>";?>
                                    
                                    
                                     <a style="float:right;"  data-toggle="modal" data-target="#myModal_3<?php echo $hasil['id_laundry'];?>" >
                                               <em>History</em>
                                     </a>
                                     
<div class="modal fade" id="myModal_3<?php echo $hasil['id_laundry'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">History Barang <?php echo $hasil['nama_laundry'];?></h4>
      </div>
      <div class="modal-body">
        <br />
         <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Barang</th>
                                                <th>Jumlah </th>
                                                <th>Toko</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $qp9=mysql_query("SELECT * FROM history_ly where kode_ly='$hasil[id_laundry]'   ");
					                        while ($hasil3=mysql_fetch_array($qp9)){ $no++;	
				                          ?>
                                        <tr>
                                        <td><?php echo $no;?>&nbsp;
                                        
                                        
                                          <a href="<?=$base_url?>progres/del_ly/<?php echo $hasil['id_laundry'];?>/<?php echo $hasil3['id_ly'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                        Del
                                        </a>
                                      
                                        </td>
                                        <td><?php echo $hasil3['tanggal'];?></td>
                                        <td><?php echo $hasil3['kode_lbarang'];?></td>
                                        <td><?php echo number_format($hasil3['kirim_ly']);?></td>
                                         <td> <?php 
												 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$hasil3[toko_ly]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												 echo $sl2['nama'];?></td>
                                       
                                        
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

                                    </td>
                                   <td>
                                               <?php if(empty($hasil['tgl_kembali'])){?>
                                                <a  data-toggle="modal" data-target="#myModal_<?php echo $hasil['id_laundry'];?>" style="top:-20px;">
                                               <em>Add Barang</em>
                                               </a>
                                                <?php }elseif($hasil['total_laundry'] == 0){
													echo $hasil['tgl_kembali'];
													
													?>
                                         
                                         
                                               <?php }else{?>
											    <a  data-toggle="modal" data-target="#myModal_<?php echo $hasil['id_laundry'];?>" style="top:-20px;">
											   <?php echo $hasil['tgl_kembali'];?> 
                                               </a>
                                               <?php } ?>
                                               
                                                                                                    
                                                      
<form action="<?=$base_url?>progres/laundry_kembali/<?php echo $user;?>/<?php echo $pass;?>" method="post" name="autoSumForm">                                            
<div class="modal fade" id="myModal_<?php echo $hasil['id_laundry'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Proses Laundry <?php echo $hasil['nama_laundry'];?> Selesai </h4>
      </div>
      <div class="modal-body">
        <br />

<hr />
       <label> Nama Toko<br />
   
    <link href="<?=$base_url?>public/css/jquery-customselect.css" rel="stylesheet" />
    
        <select id="standard" name="standard" class="custom-select" required="required">
        
        <?php 
	$selector=mysql_query("SELECT * FROM history_ly  where kode_ly='$hasil[id_laundry]' AND kirim_ly >0");
     while ($sl=mysql_fetch_array($selector)){?>
        <option value="<?php echo $sl['id_ly'];?>">
		<?php
		 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$sl[toko_ly]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												
		 echo $sl2['nama']."&nbsp;&nbsp;JML".$sl['kirim_ly'];?>
        
        </option>
        <?php } ?>
      </select>
    </label>

        <label>Jumlah
          <input class="form-control input-sm" type="text" name="kirim"  onFocus="startCalc();" onBlur="stopCalc();"  required id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
         </label> 
         
         <label>Biaya per PCS
          <input class="form-control input-sm" type="text" name="biaya" value="" onFocus="startCalc();" onBlur="stopCalc();"  required id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
          
         </label> 
     
         <hr />
         
         <label>Invoice
          <input class="form-control input-sm" type="text" name="invoice" value="<?php echo $val;?>"  >
         </label> 
         
        <label>Warna
          <input class="form-control input-sm" type="text" name="warna" value="<?php echo $hasil['warna'];?>" required  >
         </label>
         
      
          <br>
            <label> Tanggal
          <input class="form-control input-sm" type="date" value="31/12/2012/"  name="tgl"  required="required"  /><br>
       </label>
       
       
    
 
          <input type="hidden" name="total" value="<?php echo $hasil['kirim'];?>" >
          <input type="hidden" name="jt" value="<?php echo $hasil['jumlah_laundry'];?>" >
          <input type="hidden" name="po" value="<?php echo $hasil['po_laundry'];?>" >
          <input type="hidden" name="nama" value="<?php echo $hasil['nama_laundry'];?>" >
          <input type="hidden" name="id" value="<?php echo $hasil['id_laundry'];?>" >
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
                                                      <td><?php echo number_format($hasil['kirim']);?>
												 <a style="float:right;"  data-toggle="modal" data-target="#myModal_2<?php echo $hasil['id_laundry'];?>" >
                                               <em>History</em>
                                               </a>
												
                                                
<div class="modal fade" id="myModal_2<?php echo $hasil['id_laundry'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">History Barang <?php echo $hasil['nama_laundry'];?></h4>
      </div>
      <div class="modal-body">
        <br />
         <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Warna</th>
                                                 <th>Jumlah </th>
                                                  <th>Harga</th>
                                                <th>Total Harga</th>
                                                 <th>Toko</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $qpo=mysql_query("SELECT * FROM history_laundry where kode_hl='$hasil[id_laundry]'   ");
					                        while ($hasil2=mysql_fetch_array($qpo)){ $no++;	
				                          ?>
                                        <tr>
                                        <td><?php echo $no;?></td>
                                        <td><?php echo $hasil2['tanggal'];?></td>
                                        <td><?php echo $hasil2['warna'];?></td>
                                        <td><?php echo number_format($hasil2['jumlah']);?></td>
                                        <td><?php echo number_format($hasil2['biaya']);?></td>
                                        <td><?php echo number_format($hasil2['total']);?></td>
                                        <td> <?php 
										         $sel=mysql_query("SELECT * FROM history_ly where id_ly='$hasil2[kode_ly2]' ");
                                                 $l2=mysql_fetch_array($sel);
												 
												 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$l2[toko_ly]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												 echo $sl2['nama'];?></td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

                                                
                                                </td>
                                                <td><?php echo $hasil['po_laundry'];?></td>
                                                <td><?php echo $hasil['invoice'];?></td>
                                                <td><?php echo $hasil['warna'];?></td>
                                                <td><?php echo $hasil['nama_laundry'];?></td>
                                                
                                          
                                                <td><?php echo number_format($hasil['total_laundry']);?></td>
                                                <td><?php echo $hasil['status'];?></td>
                                              
                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                     
                                    </table>
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
              $(function() {
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
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
  
       
	