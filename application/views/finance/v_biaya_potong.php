				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
 if($status == 'out'){
												$statusnya="Belanja";
											}elseif($status == 'potong'){
												$statusnya="Potong";
											}elseif($status == 'jahit'){
												$statusnya="Jahit";
											}elseif($status == 'loundry'){
												$statusnya="Laundry";
											}elseif($status == 'finis'){
												$statusnya="Finishing";
											}elseif($status == 'Kas'){
												$statusnya="Kas";
											}
?>


<script src="<?=$base_url?>public/js/boxOver.js" type="text/javascript"></script>

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
                                    <h1 ><?php echo $statusnya;?></h1>
                       
                                </div>
                                <hr /><!-- /.box-header -->
                           
                                <div class="box-body table-responsive">
                               
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>PO</th>
                                                 <th>Barang</th>
                                                <th>Total Biaya</th>
                                                <th>Bayar</th>
                                                 <th>Sisa</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           
											$no=0;
												
					                        $qpo=mysql_query("SELECT * FROM pembelian where dept='$statusnya'order by id_beli DESC   ");
					                        while ($hasil=mysql_fetch_array($qpo)){ $no++	
				                          ?>
                                            <tr>
                                               <td><?php echo $no;?>
                                                  &nbsp;
                                                  <a  data-toggle="modal" data-target="#myModal_<?php echo $hasil['id_beli'];?>" style="top:-20px;">
                                             <?php $xlogin=mysql_query("SELECT * FROM login where user='$user' and password='$pass'");
                                                   $xlog=mysql_fetch_array($xlogin);
                                                     if($xlog['hakakses'] == 1){
	                                                    $edit="Edit";
	                                                    $del="Del";
                                                     }else{
	                                                    $edit="";
	                                                    $del="";
                                                     }; //echo $edit;?>
                                                 </a>
                                             
                                               &nbsp;
                                               <a href="<?=$base_url?>master/customer_delete/<?php echo $hasil['id_beli'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                                <?php //echo $del;?>
                                               </a>
                                           
                                                  
<form action="<?=$base_url?>finance/edit_biaya/<?php echo $status;?>/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                            
<div class="modal fade" id="myModal_<?php echo $hasil['id_beli'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit <em style="color:#F00;"> <?php echo $hasil['barang'];?></em>  </h4>
      </div>
      <div class="modal-body">
        <br />
        <label>Total Biaya
          <input class="form-control input-sm" type="text" name="vol[index][total]" value="<?php echo $hasil['jumlah'];?>" required="required" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
         </label> 
         
         <label>Bayar
          <input class="form-control input-sm" type="text" name="vol[index][bayar]" value="<?php echo $hasil['bayar'];?>" required="required" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
         </label> 
         
         <label>Sisa
          <input class="form-control input-sm" type="text" name="vol[index][sisa]" value="<?php echo $hasil['total'];?>" required="required" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> 
         </label> 
          
       
      
               
            <input type="hidden" name="vol[index][id]" value="<?php echo $hasil['id_beli'];?>">        
        
          <br>

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
                                               <td><?php echo $hasil['tanggal'];?></td>
                                               <td><?php echo $hasil['ket'];?></td>
                                               <td><?php echo $hasil['barang'];?></td>
                                                <td><?php echo number_format($hasil['jumlah']);?></td>
                                                 <td>
												
												 <?php echo number_format($hasil['bayar']);
												 if($hasil['total'] == 0){
													 echo "<span style=float:right;>Close</span>";
												 }else{
												 ?>
                                                
                             <a  data-toggle="modal" data-target="#myModal<?php echo $hasil['id_beli'];?>" style="top:-20px; float:right;">
                                 Add
                           </a>
                           <?php } ?>
                           
<form action="<?=$base_url?>finance/bayar_pembelian/<?php echo $status;?>/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                             <!-- Modal -->
<div class="modal fade" id="myModal<?php echo $hasil['id_beli'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Bayar <?php echo $hasil['ket'];?>&nbsp; PO  <?php echo $hasil['barang'];?></h4>
      </div>
      <div class="modal-body">
       <br />
       <label> Biaya Potong Kain (<em style="font-size:12px; color:#F00;"><?php echo number_format($hasil['total'])."";?></em>)<hr />
       Dibayarkan
          <input class="form-control input-sm" type="text" name="kirim" required="required" value="<?php echo $hasil['total'];?>" required="required" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> <br>
       </label> 
        <input type="hidden" name="total" value="<?php echo $hasil['total'];?>"  >
       <input type="hidden" name="id" value="<?php echo $hasil['id_beli'];?>"  >
       <input type="hidden" name="po" value="<?php echo $hasil['ket'];?>"  >
       <input type="hidden" name="nama" value="<?php echo $hasil['barang'];?>"  >
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
                                                 <td><?php echo number_format($hasil['total']);?></td>
                                                <td><?php echo $hasil['status'];?></td>
                                       
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
  
       
	