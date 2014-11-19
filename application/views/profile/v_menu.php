				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>
<!--<script src="<?=$base_url?>public/boxOver.js"></script>-->

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
                                    <h1 >PO OUT</h1>
                       
                                </div>
                                <hr /><!-- /.box-header -->
                                 <a href="<?=$base_url?>profile/add_menu/<?php echo $user;?>/<?php echo $pass;?>">
                                 <button class="btn btn-primary btn-lg">Add Files</button>
                                 </a>
                                 
                             
                                 </a>
                                 
                                <div class="box-body table-responsive">
                               
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Pass</th>
                                                <th>Status</th>
                                          
                                           
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $qpo=mysql_query("SELECT * FROM menu    ");
					                        while ($hasil=mysql_fetch_array($qpo)){ $no++	
				                          ?>
                                            <tr>
                                               <td><?php echo $no;?>
                                               &nbsp;
                                                <a href="<?=$base_url?>profile/add//user/pass">
                                               Edit </a>
                                               &nbsp;
                                               <a href=<?=$base_url?>purchase/out_delete//user/pass>
                                                 Delete
                                               </a>
                                               &nbsp;
                                               </td>
                                               <td><?php echo $hasil['kode'];?></td>
                                                <td><?php echo $hasil['nama'];?></td>
                                               
                                                <td><?php echo $hasil['url_menu'];?> </td>
                                               
                                                
                                               
                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                     
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->  
							
		
							
							
							
							<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?=$base_url?>public/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?=$base_url?>public/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?=$base_url?>public/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?=$base_url?>public/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?=$base_url?>public/js/AdminLTE/demo.js" type="text/javascript"></script>
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