<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>
 <link href="<?=$base_url?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?=$base_url?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?=$base_url?>public/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?=$base_url?>public/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?=$base_url?>public/css/AdminLTE.css" rel="stylesheet" type="text/css" />
          
                           
                                <div class="box-header" style=" margin-left:45%; font-size:36px;">
                                    <h1 >Edit Profile</h1>
                                </div>
                                <hr /><!-- /.box-header -->
                               
                     
                                <div class="box-body table-responsive" style="margin-left:100px; background-color:#FFF;">
         <?php   $bs=mysql_query("SELECT * FROM login where user='$id'");
                                $s=mysql_fetch_array($bs);?>
<form action="<?php echo base_url() . 'profile/update_account/'.$user."/".$pass; ?>" method="post" enctype="multipart/form-data" class="validate">

						
							
								<div class="content no-padding">
									<div class="section _100">
									  <label>
											User Name</label>
										<div>
											<input class="required" name="usr" value="<?php echo $id;?>" readonly="readonly" >
										</div>
									</div>
                                    
                             
							
									<div class="section _100">
										<label for="timeampm">
											Password</label>
										<div>
										  <input type="pass" name="pass" size="20" value="<?php echo $s['bp'];?>">
										</div>
									</div>
                                    
                                    <div class="section _100">
										<label for="timeampm">
											Email</label>
										<div>
										  <input type="text" name="email" size="20" value="<?php echo $s['email'];?>">
										</div>
									</div>
                                    
                                       <div class="section _100">
										<label for="timeampm">
											No Telp</label>
										<div>
										  <input type="text" name="telp" size="20" value="<?php echo $s['telp'];?>">
										</div>
									</div>
                                    
                                    <div class="section _100">
										<label for="timeampm">
											Hak akses
                                            <select name="hak">
                                            <?php if($s['hakakses'] == 0){?>
                                           <option value="0">User</option>
                                            <option value="1">Penuh</option>
                                             <?php }else{ ?>
                                                <option value="1">Penuh</option>
                                             
                                             <option value="0">User</option>
                                             
                                           
                                            <?php } ?>
                                            </select>
                                            </label>
										<div>
										 
                                           <hr />
                                 
                               
                                <ul class="treeview-menu">
                                <?php 
				                           $no=0;
					                        $ch=mysql_query("SELECT * FROM sub_menu 
											                          join akses_user on
																	  sub_menu.id_sub=akses_user.url_kode
											where  akses_user.nama_user='$id'");
					                        while ($menu_chile=mysql_fetch_array($ch)){ $no++;	
											$hidden[]=$menu_chile['id_kode'];
				                          ?>
                                           <li>
                                           <input type="checkbox" class="flat-red" name="status[]" value="<?php echo $menu_chile['id_sub'];?>" checked="checked" />
                                           &nbsp;&nbsp;&nbsp;<?php echo $menu_chile['nama'];?>

<a href="<?=$base_url?>profile/del_akses/<?php echo $id;?>/<?php echo $menu_chile['id_kode'];?>/<?php echo $user;?>/<?php echo $pass;?>">Del</a>
                                           </li>
                               
                               <?php } ?>
                               <hr />
                               
                                          <?php 
								         for($i=0; $i<count($hidden); $i++){
									         $hilang=$hidden[$i];
								             }
								
				                           $no=0;
					                        $ch2=mysql_query("SELECT * FROM sub_menu ");
					                        while ($menu_chile2=mysql_fetch_array($ch2)){ $no++;	
				                          ?>
                                           <li>
                                         
										   <input type="checkbox" class="flat-red" name="status2[]" value="<?php echo $menu_chile2['id_sub'];?>"  />
											       &nbsp;&nbsp;&nbsp; <?php echo $menu_chile2['nama'];?>
                                          
											   
										  
                                      
                                           </li>
                               
                               <?php } ?>
                            </ul>
   						       </div>
									</div>
                                
									<div class="_50">
										<p><label for="timeampm">
											Foto</label>
										  <input name="gambar" type="file" class="required" id="gambar" />
                                           
									  </p>
									</div>	
                                  							
								</div>
								
								<div class="actions">
								
									<div class="actions-right">
										<input type="submit" />
								
							</form>
						</div>
								</div>
					<div class="clear"></div>
                    						
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
  