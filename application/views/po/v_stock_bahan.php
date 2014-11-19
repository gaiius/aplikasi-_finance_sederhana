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
                                    <h1 >Stock Bahan </h1>
                                </div>
                                <hr /><!-- /.box-header -->
                               
                     
                                <div class="box-body table-responsive">
                               
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                      
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>No PO</th>
                                                <th>Barang</th>
                                                <th>jumlah </th>
                                                <th>Status / History</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $qpo=mysql_query("SELECT * FROM po_barang order by id_barang DESC   ");
					                        while ($hasil=mysql_fetch_array($qpo)){ $no++	
				                          ?>
                                            <tr>
                                               <td><?php echo $no;?>
                                               &nbsp;
                                                <a href="<?=$base_url?>purchase/out_edit/<?php echo $hasil['id_barang'];?>/<?php echo $user;?>/<?php echo $pass;?>">
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
                                                     ;?>
                                               </a>
                                               &nbsp;
                                           <a href="<?=$base_url?>purchase/out_delete/<?php echo $hasil['id_barang'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                                 <?php echo $del;?>
                                               </a>
                                               &nbsp;
                                               </td>
                                               <td><?php echo $hasil['tanggal'];?></td>
                                                <td><?php echo $hasil['po'];?></td>
                                                <td>
			 <a  data-toggle="modal" data-target="#myModal_1<?php echo $hasil['id_barang'];?>" style="top:-20px;">
												<?php echo $hasil['nama'];?></a>
                                                
                                                
                                                
                                                
<form action="<?=$base_url?>purchase/out_retur/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                            
<div class="modal fade" id="myModal_1<?php echo $hasil['id_barang'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Retur Barang <?php echo $hasil['nama'];?></h4>
      </div>
      <div class="modal-body">
      Jumlah Stock <?php echo number_format($hasil['jumlah_barang']);?>
        <br />
        <label>Kirim Barang Retur
          <input class="form-control input-sm" type="text" name="kirim" required >
          </label>
          <br>
          <label>Harga di Kurangi
          <input class="form-control input-sm" type="text" name="harga" required title="harga" >
          </label>
          <br>
          <input class="form-control input-sm" type="hidden" name="id_retur" value="<?php echo $hasil['id_barang'];?>"  >
          <input class="form-control input-sm" type="hidden" name="id" value="<?php echo $hasil['kode_barang'];?>"  >
         
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
                                                <td><?php echo number_format($hasil['jumlah_barang']);?></td>
                                           
                                                
 <!-------------------------Hystorii---------------------------------------------------------------->                                                
                                                <td>
												<?php
												if($hasil['status'] =='Open'){
													echo "<span style=color:#F00;>".$hasil['status']."</span>";
												}else{
												echo $hasil['status'];}?>
                                           

                                                
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
        </script>
  
       
	