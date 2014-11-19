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
                                    <h1 >List Toko</h1>
                       
                                </div>
                                <hr /><!-- /.box-header -->
                            <a  data-toggle="modal" data-target="#myModal" style="top:-20px;">
                                <button class="btn btn-primary btn-lg">Add Toko</button>
                               </a>
                                <div class="box-body table-responsive">
                                
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                 <th>Alamat</th>
                                                <th>Telp</th>
                                                 <th>Mail</th>
                                                <th>Web Site</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $qpo=mysql_query("SELECT * FROM supplier order by id_supplier DESC   ");
					                        while ($hasil=mysql_fetch_array($qpo)){ $no++;	
				                          ?>
                                     
                                            <tr>
                                               <td>
                                              
                                             
                                               &nbsp;
                                          
                                             <a href="<?=$base_url?>master/supplier_edit/<?php echo $hasil['id_supplier'];?>/<?php echo $user;?>/<?php echo $pass;?>">
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
                                                 <a href="<?=$base_url?>master/supplier_delete/<?php echo $hasil['id_supplier'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                                  <?php echo $del;?>
                                               </a>
                                               </td>
                                               <td><?php echo $hasil['nama'];?></td>
                                               <td><?php echo $hasil['alamat'];?></td>
                                                <td><?php echo $hasil['telp'];?></td>
                                                 <td><?php echo $hasil['mail'];?></td>
                                                <td><?php echo $hasil['url'];?></td>
                                                 <td><?php echo $hasil['dept_toko'];?></td>
                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                     
                                    </table>
<form action="<?=$base_url?>master/insert_toko/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                            
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Toko </h4>
      </div>
      <div class="modal-body">
        <br />
        
           <label>Nama
          <input class="form-control input-sm" type="text" name="vol[index][nama]" >
         </label> 
         
        <label>Telp
          <input class="form-control input-sm" type="text" name="vol[index][telp]" >
         </label> 
         
         <label>Email
          <input class="form-control input-sm" type="text" name="vol[index][mail]" >
         </label> 
         
         <label>Website
          <input class="form-control input-sm" type="text" name="vol[index][url]" >
         </label> 
         <hr>
         <label>Toko Untuk proses
      
          <select name="vol[index][dept]" class="form-control input-sm">
          <option value="Belanja">Belanja</option>
          <option value="Potong">Potong</option>
          <option value="Jahit">Jahit</option>
          <option value="Laundry">Laundry</option>
          <option value="Finishing">Finishing</option>
          </select>
         </label> 
          
       <hr />
          <label>Alamat
          <textarea class="form-control input-sm" type="text" name="vol[index][alamat]" style="width:400px;"></textarea>
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
  
       
	