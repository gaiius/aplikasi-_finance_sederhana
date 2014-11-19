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
                                    <h1 >Stock Gudang</h1>
                       
                                </div>
                                <hr /><!-- /.box-header -->
                           
                                <div class="box-body table-responsive">
                                <a  data-toggle="modal" data-target="#myModal_10" >
                                <button class="btn btn-primary btn-lg" style="top:-20px;">Add Files</button>
                               </a>
                               <hr />
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama</th>
                                                 <th>Warna</th>
                                                <th>Kode</th>
                                                 <th>Stock Awal</th>
                                                  <th>Terjual / <em style="color:#F00;">Retur</em></th>
                                                <th>Stock Sekarang</th>
                                               
                                                <th>Retur</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $qpo=mysql_query("SELECT * FROM history_finis order by id_fn DESC
																			");
					                        while ($hasil=mysql_fetch_array($qpo)){ $no++	
				                          ?>
                                            <tr>
                                            <?php if($hasil['status'] == 'Fix'){
												
												$td="<td style=color:#000>";
												$url="";
												$retur="";
											}else{
												$td="<td style=color:#F00>";
												$url="<a  data-toggle=modal data-target=#myModal".$hasil['id_fn']." style=top:-20px; color:#F00;>";
												$retur="<div style=float:right;><em>Retur</em></div>";
											}?>
                                               <?php echo $td;?><?php echo $no;?>
                                              
                                              <a  data-toggle="modal" data-target="#myModal_<?php echo $hasil['id_fn'];?>" style="top:-20px;">
                                             <?php $xlogin=mysql_query("SELECT * FROM login where user='$user' and password='$pass'");
                                                   $xlog=mysql_fetch_array($xlogin);
                                                     if($xlog['hakakses'] == 1){
	                                                    $edit="Edit";
	                                                    $del="Del";
                                                     }else{
	                                                    $edit="";
	                                                    $del="";
                                                     }; echo $edit;?>
                                                 </a>
                                                 
                                                 &nbsp;&nbsp;
                                                 
                                               <a href="<?=$base_url?>finance/stock_delete/<?php echo $hasil['id_fn'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                                <?php echo $del;?>
                                               </a>
                                               
                                               
                                               
<form action="<?=$base_url?>finance/update_stock/<?php echo $hasil['id_fn'];?>/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                            
<div class="modal fade" id="myModal_<?php echo $hasil['id_fn'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Toko </h4>
      </div>
      <div class="modal-body">
        <br />
        
         <label>Nama Barang
          <input class="form-control input-sm" type="text" name="vol[index][nama]" value="<?php echo $hasil['barang'];?>" required="required" >
         </label> 
         
          <label>kode Barang
          <input class="form-control input-sm" type="text" name="vol[index][kode]" value="<?php echo $hasil['kode_barang'];?>" required="required" >
         </label>
         
        <label>Jumlah
          <input class="form-control input-sm" type="text" name="vol[index][jumlah]" value="<?php echo $hasil['kirim_jual'];?>" required="required" >
         </label> 
         
         <label>Harga Satuan
          <input class="form-control input-sm" type="text" name="vol[index][harga]" value="<?php echo $hasil['biaya'];?>" required="required" >
         </label> 
         
    
               
        
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
                                           
                                          
<form action="<?=$base_url?>finance/returan/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                             <!-- Modal -->
<div class="modal fade" id="myModal<?php echo $hasil['id_fn'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Clear  <?php echo $hasil['barang'];?>&nbsp;<?php echo $hasil['status'];?></h4>
      </div>
      <div class="modal-body">
       <br />
       <label> Jumlah (<em style="font-size:12px; "><?php echo number_format($hasil['jumlah'])."FIX";?></em>)<hr />
     
          <?php echo $hasil['kode_barang'];?><br>
       </label> 
       <input type="hidden" name="kode" value="<?php echo $hasil['kode_barang'];?>"  >
       <input type="hidden" name="jumlah" value="<?php echo $hasil['jumlah'];?>"  >
       <input type="hidden" name="id" value="<?php echo $hasil['id_fn'];?>"  >
       <input type="hidden" name="status" value="<?php echo "Fix";?>"  >
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
                                               <?php echo $td;?><?php echo $hasil['tanggal'];?></td>
                                               <?php echo $td;?><?php echo $hasil['barang'];?></td>
                                                <?php echo $td;?>
												
												<?php  $fin=mysql_query("SELECT * FROM finishing where id_finis='$hasil[kode_fn]'");
                                              $f=mysql_fetch_array($fin);
											 
											  echo $f['warna'];
											  ?>
                                              
                                              </td>
                                               <?php echo $td;?>
                                                
											   <?php echo $url.$hasil['kode_barang'];?>
                                               </a>
                                               </td>
                                              
                                                <?php echo $td;?><?php 
												$total=$hasil['jumlah']+$hasil['kirim_jual'];
												echo number_format($total);
												
												?></td>
                                               
                                                <?php echo $td;?><?php echo "".number_format($hasil['kirim_jual']).$retur;?>
                                                
                                                </td>
                                                
                                                <?php echo $td;?><?php 
												
												if($hasil['status'] == 'Fix'){
												echo number_format($hasil['jumlah']);
												}else{
												echo "0";	
												}
												?></td>
                                                
                                                <?php echo $td;?><?php echo $hasil['status'];?></td>

                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                     
                                    </table>
<form action="<?=$base_url?>finance/insert_stock/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                            
<div class="modal fade" id="myModal_10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Toko </h4>
      </div>
      <div class="modal-body">
        <br />
        
         <label>Nama Barang
          <input class="form-control input-sm" type="text" name="vol[index][nama]" required="required" >
         </label> 
          <?php 
			
			$bs=mysql_query("SELECT id_fn FROM history_finis order by id_fn DESC");
            $sbb=mysql_fetch_array($bs);
			$tgl=date('dmy');
			$id=$sbb['id_fn']+1;
			$acak	  = rand(000,999);
			?>
          <label>kode Barang
          <input class="form-control input-sm" type="text" name="vol[index][kode]" value="<?php echo "BRLAMA/".$id.$tgl;?>" required="required" >
         </label>
         
        <label>Jumlah
          <input class="form-control input-sm" type="text" name="vol[index][jumlah]" required="required" >
         </label> 
         
         <label>Harga Satuan
          <input class="form-control input-sm" type="text" name="vol[index][harga]" required="required" >
         </label> 
         
    
               
        
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
        </script>
  
       
	