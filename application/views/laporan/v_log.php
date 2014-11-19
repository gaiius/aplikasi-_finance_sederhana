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
                                    <h1 >LOG</h1>
                       
                                </div>
                                <hr /><!-- /.box-header -->
                           
                                <div class="box-body table-responsive">
                               
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                 <th>No PO</th>
                                                <th>User</th>
                                                 <th>Jumlah</th>
                                                <th>Keterangan</th>
                                              
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                        $qpo=mysql_query("SELECT * FROM log_user order by id_log DESC   ");
					                        while ($hasil=mysql_fetch_array($qpo)){ $no++	
				                          ?>
                                          
                                            <tr>
                                               <td><?php echo $no;?>
                                               &nbsp;
                                             
                                               &nbsp;
                                               <a href="<?=$base_url?>laporan/log_delete/<?php echo $hasil['id_log'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                                 Delete
                                               </a>
                                               &nbsp;
                                               </td>
                                               <td><?php echo $hasil['tanggal'];?></td>
                                               <td><?php echo $hasil['no_po'];?></td>
                                                <td>
                                                <a id="myHeader2" href="javascript:showonlyone('<?php echo $hasil['id_log'];?>');" >
												<?php echo $hasil['nama'];?>
                                                </a>
                                                <div class="newboxes" id="<?php echo $hasil['id_log'];?>" style="display: none;">
                                                <input type="text" placeholder="Nama"  class="form-control" name="q4_a" id="edit_nama"/><br />
                                                <input type="text"  id="id_nama" value="<?php echo $hasil['id_log'];?>"/>
                                                <a id="<?php echo $hasil['id_log'];?>" >
                                                simpan</a>
                                                </div>
                                                </td>
                                                <td><?php echo number_format($hasil['kode']);?></td>
                                                <td><?php echo $hasil['ket'];?></td>
                                       
                                            </tr>
                                         <script type="text/javascript">
                                                   function showonlyone(thechosenone) {
                                                    $('.newboxes').each(function(index) {
                                                          if ($(this).attr("id") == thechosenone) {
                                                             $(this).show(700);
                                                     
													  
										$("#edit_nama").keyup(function (){
											$(this).attr("id");
												 var user2=$("#edit_nama").val();
												  var id_nama=$("#id_nama").val();
												 $("#muncul").html(user2);
                                            var allin = [id_nama,user2];
  			                                  $("#<?php echo $hasil['id_log'];?>").click(function (){
					                          
				                               $.ajax({
									            //type: GET,  
		                                        url : "<?=$base_url?>login/update",
		                                        data : "allin=" +  allin,
		                                        success : function(data) {
										 
										             }
			                                   });
								            }); 
							             });
                                                
												
												
												
												
												      } else {
                                                              $(this).hide(600);
                                                           }
                                                        });
                                                      } </script>
                                                      <div id="muncul"></div>
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
  
       
	