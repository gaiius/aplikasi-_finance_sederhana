				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
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
                                    <h1 >Master Bahan </h1>
                                </div>
                                <hr /><!-- /.box-header -->
                                 <a href="<?=$base_url?>purchase/out_insert/<?php echo $user;?>/<?php echo $pass;?>">
                                 <button class="btn btn-primary btn-lg">Add Bahan</button>
                                 </a>
                     
                                <div class="box-body table-responsive">
                               
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                        <th colspan="6"></th>
                                        <th colspan="2"><div align="center">Harga</div></th>
                                        <th colspan="2"></th>
                                        </tr>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>No Invoice</th>
                                                <th>Supplier</th>
                                                <th>Barang </th>
                                                 <th>Retur </th>
                                                <th>Yard/Stock Gudang</th>
                                                <th >Harga Satuan</th>
                                                <th>Total Harga</th>
                                                <th>Status / History</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $noUrut=0;
					                        $qpo=mysql_query("SELECT * FROM po_out order by id_out DESC   ");
					                        while ($hasil=mysql_fetch_array($qpo)){ $noUrut++;	
				                          ?>
                                            <tr>
                                               <td><?php echo $noUrut;?>
                                               
                                               &nbsp;
                                                <a href="<?=$base_url?>purchase/out_edit/<?php echo $hasil['id_out'];?>/<?php echo $user;?>/<?php echo $pass;?>">
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
                                                     echo $edit;?>
                                               </a>
                                               &nbsp;
                                           <a href="<?=$base_url?>purchase/poout_delete/<?php echo $hasil['id_out'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                                 <?php echo $del;?>
                                               </a>
                                               &nbsp;
                                               </td>
                                               <td><?php echo $hasil['tgl'];?></td>
                                                <td><?php echo $hasil['kode'];?></td>
                                                <td><?php 
												 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$hasil[supplier]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												 echo $sl2['nama'];?></td>
<!-------------------------Add Kirim----------------------------------------------------------------------->  
                                                <td>
												
												<?php
												if($hasil['kirim'] >0 ){?>
												  <a  data-toggle="modal" data-target="#myModal_1<?php echo $hasil['id_out'];?>" style="top:-20px; float:left;">
												   <?php echo $hasil['barang'];?>
                                                  </a>
                                                  <?php }elseif($hasil['kirim'] < 0){?>
                                                  sb
                                                  <?php }else{
													   echo $hasil['barang'];
												  }?>
<form action="<?=$base_url?>purchase/out_barang/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                            
<div class="modal fade" id="myModal_1<?php echo $hasil['id_out'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Kirim Ke Stock</h4>
      </div>
      <div class="modal-body">
        <?php echo $hasil['barang'];?><br />
          <input class="form-control input-sm" type="text" max="<?php echo $hasil['kirim'];?>" name="kirim" required value="<?php echo $hasil['kirim'];?>" id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input><br>
          <label>No PO
          <input class="form-control input-sm" type="text" name="po" required    >
          </label>
           <input type="hidden" name="nama" value="<?php echo $hasil['barang'];?>" >
          <input type="hidden" name="total" value="<?php echo $hasil['kirim'];?>" >
       
          <input type="hidden" name="id" value="<?php echo $hasil['id_out'];?>" >
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
<td>
         <a  data-toggle="modal" data-target="#myModal_10<?php echo $hasil['id_out'];?>" style=" float:left;">
                                               Retur
                                               </a>
      <?php
	  $po_brg=mysql_query("SELECT * FROM po_barang where kode_barang='$hasil[id_out]'");
      $brg=mysql_fetch_array($po_brg);
	  
	  ?>                                         
<form action="<?=$base_url?>purchase/out_retur/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                            
<div class="modal fade" id="myModal_10<?php echo $hasil['id_out'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Retur Barang <?php echo $hasil['barang'];?></h4>
      </div>
      <div class="modal-body">
      Jumlah Stock <?php echo number_format($hasil['jumlah']);?>
        <br />
        <label>Kirim Barang Retur
          <input class="form-control input-sm" type="text" name="kirim" required placeholder="Max barang <?php echo number_format($hasil['jumlah']);?>" >
          </label>
          <br>
          <label>Harga di Kurangi
          <input class="form-control input-sm" type="text" name="harga" required title="harga" placeholder="<?php echo number_format($hasil['harga_satuan']);?>" >
          </label>
          <br>
          <input class="form-control input-sm" type="hidden" name="id_retur" value="<?php echo $brg['id_barang'];?>"  >
          <input class="form-control input-sm" type="hidden" name="id" value="<?php echo $hasil['id_out'];?>"  >
         <input type="hidden" name="total" value="<?php echo $hasil['jumlah'];?>" >
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
                                                <td><?php echo number_format($hasil['jumlah']);?>
                                                
                                                &nbsp;&nbsp;
                                                <em>
                                               <?php echo number_format($hasil['kirim']);?>
                                                &nbsp;&nbsp;
                                                </em>
                                          <a  data-toggle="modal" data-target="#myModal<?php echo $hasil['id_out'];?>" style="top:-20px; float:right;">
                                             <?php if($hasil['status'] == 'Open'){
                                                       echo "Add";
                                                      }else{
	                                                   echo ""; 
                                                 }?>
                                                    </a>  
 <!-------------------------Add Kirim----------------------------------------------------------------------->                                                     
<form action="<?=$base_url?>purchase/out_datang/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                            
<div class="modal fade" id="myModal<?php echo $hasil['id_out'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Barang Datang</h4>
      </div>
      <div class="modal-body">
        <?php echo $hasil['barang'];?><br />
          <input class="form-control input-sm" type="text" name="kirim" required value="<?php echo $hasil['sisa_out'];?>"  id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input><br>
         
           <input type="hidden" name="nama" value="<?php echo $hasil['barang'];?>" >
          <input type="hidden" name="total" value="<?php echo $hasil['jumlah'];?>" >
          <input type="hidden" name="id" value="<?php echo $hasil['id_out'];?>" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>
</form>         
                                                  
 <!-------------------------Add Kirim-Selesai---------------------------------------------------------------->  
                                                </td>
                                                <td><?php echo number_format($hasil['harga_satuan']);?></td>
                                                <td><?php echo number_format($hasil['total']);?></td>
 <!-------------------------Hystorii---------------------------------------------------------------->                                                
                                                <td>
												 <a  data-toggle="modal" data-target="#myModal_<?php echo $hasil['id_out'];?>" style="top:-20px; float:right;">
												<?php 
												if($hasil['status'] =='Open'){
													echo "<span style=color:#F00;>".$hasil['status']."</span>";
												}else{
												echo $hasil['status'];}?>
                                                </a>
<div class="modal fade" id="myModal_<?php echo $hasil['id_out'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">History Barang Datang</h4>
      </div>
      <div class="modal-body">
                           <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Jumlah Barang Datang</th>
                                                 <th>Sisa </th>
                                                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $q=mysql_query("SELECT * FROM history_out where kode_out='$hasil[id_out]'");
					                        while ($hasil2=mysql_fetch_array($q)){ $no++;	
				                          ?>
                                        <tr>
                                        <td><?php echo $no;?></td>
                                        <td><?php echo $hasil2['tanggal'];?></td>
                                          <td><?php 
										$hasil_awal=$hasil2['Keterangan'];
										$bln_awal = substr("$hasil_awal",5,100);
										$bln_akhir = substr("$hasil_awal",0,4);
										echo $bln_akhir."&nbsp;&nbsp;";?></td>
                                        <td><?php echo number_format($hasil2['jml_kirim']);?></td>
                                      
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
                                                
    <!-------------------------History-Selesai---------------------------------------------------------------->                                             </td>
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
  
       
	