				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>



	<script src="<?=$base_url?>public/js/jquery.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?=$base_url?>public/js/bootstrap.min.js" type="text/javascript"></script>
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
                                    <h1 >Proses Jahit</h1>
                       
                                </div>
                                <hr /><!-- /.box-header -->
                           
                                <div class="box-body table-responsive">
                               
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                 <th>Kirim</th>
                                                <th>Sisa</th>
                                                <th>TGL Kembali</th>
                                                 <th>No PO </th>
                                                  <th>Surat jalan</th>
                                                <th>Model</th>
                                                 <th>JML/PCS</th>
                                                <th>Status</th>
                                              <th>Nama Toko</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $qpo=mysql_query("SELECT * FROM jahit order by id_jahit DESC   ");
					                        while ($hasil=mysql_fetch_array($qpo)){ $no++	
				                          ?>
                                            <tr>
                                               <td><?php echo $no;
											     if(empty($hasil['tgl_kembali'])){
												   echo "";
											   }else{
											   ?>
                                               &nbsp;
                                                <a href="<?=$base_url?>progres/edit_jahit/<?php echo $hasil['id_jahit'];?>/<?php echo $user;?>/<?php echo $pass;?>">
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
                                            
                                               &nbsp;
                                               </td>
                                               <td>
                                               <?php if(empty($hasil['tanggal'])){?>
                                               <a  data-toggle="modal" data-target="#myModal<?php echo $hasil['id_jahit'];?>" style="top:-20px;">
                                               <em>Add Barang</em>
                                               </a>
                                               <?php }else{?>
											    <a  data-toggle="modal" data-target="#myModal<?php echo $hasil['id_jahit'];?>" style="top:-20px;">
											   <?php echo $hasil['tanggal'];?> 
                                              </a>
                                               <?php } ?>
                                                 <a style="float:right;"  data-toggle="modal" data-target="#myModal_3<?php echo $hasil['id_jahit'];?>" >
                                               History
                                               </a>
                   
<form action="<?=$base_url?>progres/jahit_kirim/<?php echo $user;?>/<?php echo $pass;?>" method="post" id="frm">                                             
<div class="modal fade" id="myModal<?php echo $hasil['id_jahit'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Kirim Barang Proses Jahit</h4>
      </div>
      <div class="modal-body">
        <br />
          
     <input type="hidden" value="<?php echo $hasil['total'];?>" name="cek" />
        <label>Jumlah
          <input class="b1 form-control input-sm" type="text" name="kirim" min="1" max="<?php echo $hasil['total'];?>" value="<?php echo $hasil['total'];?>" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
          </label>
          <?php 
		  $acak	  = rand(000,999);
		  $t=date('dmy');
		  $d=$hasil['id_jahit'];
		  ?>
          <label>No Invoice
          <input class="form-control input-sm" type="text" name="ivn" value="<?php echo "JHT/".$t."-".$d."-".$acak;?>" required >
          </label>
          
          <label> Nama Toko<br />
 <link href="<?=$base_url?>public/css/jquery-customselect.css" rel="stylesheet" />
     <script src="<?=$base_url?>public/js/jquery-customselect.js"></script>
    
        <select id="standard" name="standard" class="custom-select" required="required">
        <option value="">None - Please Select</option>
        <?php 
	$selector=mysql_query("SELECT * FROM supplier where dept_toko='Jahit' ");
     while ($sl=mysql_fetch_array($selector)){?>
        <option value="<?php echo $sl['id_supplier'];?>"><?php echo $sl['nama'];?></option>
        <?php } ?>
      </select>
    </label>
       <script type="text/javascript">
		   $(function() {
        $("#standard").customselect();
      });
	  </script>
   
          <br>
        <label> Tanggal
          <input class="form-control input-sm" type="date"  name="tanggal"  required="required" id="tanggal"  /><br>
       </label>
          <input type="hidden" name="total" value="<?php echo $hasil['total'];?>" >
          <input type="hidden" name="po" value="<?php echo $hasil['po_jahit'];?>" >
          <input type="hidden" name="nama" value="<?php echo $hasil['barang_jahit'];?>" >
          <input type="hidden" name="id" value="<?php echo $hasil['id_jahit'];?>" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>
</form>
                        
                                              
<div class="modal fade" id="myModal_3<?php echo $hasil['id_jahit'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">History Barang <?php echo $hasil['barang_jahit'];?></h4>
      </div>
      <div class="modal-body">
        <br />
         <table  id="example1" class="table table-bordered table-striped">
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
				                           
					                        $qp9=mysql_query("SELECT * FROM history_jahit where kode_jht='$hasil[id_jahit]' and stt='Keluar'   ");
					                        while ($hasil3=mysql_fetch_array($qp9)){ 
				                          ?>
                                        <tr>
                                        <td><?php echo $no;?>&nbsp;
                                        
                                        
                                          <a href="<?=$base_url?>progres/del_jht/<?php echo $hasil['id_jahit'];?>/<?php echo $hasil3['id_jht'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                        Del
                                        </a>
                                      
                                        </td>
                                        <td><?php echo $hasil3['tanggal'];?></td>
                                        <td><?php echo $hasil3['kode_jbarang'];?></td>
                                        <td><?php echo number_format($hasil3['kirim_jht']);?></td>
                                         <td> <?php 
												 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$hasil3[toko_jht]' ");
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
                                                <td><?php echo number_format($hasil['kirim']);?></td>
                                                <td><?php echo $hasil['total'];?></td>
                                                
                                                <td>
												<?php if(empty($hasil['tgl_kembali'])){?>
            <a href="<?=$base_url?>progres/jahitan/<?php echo $hasil['id_jahit'];?>/<?php echo $user;?>/<?php echo $pass;?>" >
                                               <em>Add Barang</em>
                                               </a>
                                               <?php }else{?>
		    <a href="<?=$base_url?>progres/jahitan/<?php echo $hasil['id_jahit'];?>/<?php echo $user;?>/<?php echo $pass;?>" >
											   <?php echo $hasil['tgl_kembali'];?> 
                                              </a>
                                               <?php } ?>
                                                      
    <a style="float:right;"  data-toggle="modal" data-target="#myModal_4<?php echo $hasil['id_jahit'];?>" >
                                               History
                                               </a>
<div class="modal fade" id="myModal_4<?php echo $hasil['id_jahit'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">History Barang <?php echo $hasil['barang_jahit'];?></h4>
      </div>
      <div class="modal-body">
        <br />
         <table id="example1"  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Barang</th>
                                                <th>Jumlah </th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                                <th>Toko</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           
					                        $qp9=mysql_query("SELECT * FROM history_jahit where kode_jht='$hasil[id_jahit]' and stt='Kembali'   ");
					                        while ($hasil3=mysql_fetch_array($qp9)){ 
				                          ?>
                                        <tr>
                                        <td><?php echo $no;?>&nbsp;
                                        
                                        
                                       <a href="<?=$base_url?>progres/del_jht/<?php echo $hasil['id_jahit'];?>/<?php echo $hasil3['id_jht'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                        Del
                                        </a>
                                      
                                        </td>
                                        <td><?php echo $hasil3['tanggal'];?></td>
                                        <td><?php echo $hasil3['kode_jbarang'];?></td>
                                        <td><?php echo number_format($hasil3['kirim_jht']);?></td>
                                        <td><?php echo number_format($hasil3['biaya_jht']);?></td>
                                        <td><?php echo number_format($hasil3['total_jht']);?></td>
                                         <td> <?php 
												 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$hasil3[toko_jht]' ");
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
                                               <td><?php echo $hasil['po_jahit'];?> </td>
                                               <td><?php echo $hasil['invoice'];?></td>
                                                <td><?php echo $hasil['barang_jahit'];?></td>
                                                <td><?php echo number_format($hasil['jumlah'])."&nbsp;<em style=color:#F00;>PCS</em>";?></td>
                                                
                                    
                                                 
                                                <td><?php echo $hasil['status'];?></td>
                                                  <td>
												  <?php 
												 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$hasil[toko]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												 echo $sl2['nama'];?>
												  
												 </td>
                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                     
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->  
							
		
							
							
							
	
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
  
       
	