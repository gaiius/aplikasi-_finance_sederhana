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
<form action="<?php echo base_url() . 'profile/insert_account/'.$user."/".$pass; ?>" method="post" enctype="multipart/form-data" class="validate">
	<div class="grid_8" style="width:100%; margin-left:100px;">
						<div class="box">
							<div class="header">
								
								<h3>Form Berita</h3>
								<span></span>
							</div>
							
								<div class="content no-padding">
									<div class="section _100">
									  <label>
											User Name</label>
										<div>
											<input class="required" name="usr" >
										</div>
									</div>
                                    
                             
							
									<div class="section _100">
										<label for="timeampm">
											Password</label>
										<div>
										  <input type="pass" name="pass" size="20">
										</div>
									</div>
                                    
                                    <div class="section _100">
										<label for="timeampm">
											Email</label>
										<div>
										  <input type="text" name="email" size="20">
										</div>
									</div>
                                    
                                       <div class="section _100">
										<label for="timeampm">
											No Telp</label>
										<div>
										  <input type="text" name="telp" size="20">
										</div>
									</div>
                                    
                                    <div class="section _100">
										<label for="timeampm">
											Hak akses</label>
										<div>
										 
                                           <hr />
                                         <?php 
				                           $no=0;
					                        $ch=mysql_query("SELECT * FROM sub_menu  ");
					                        while ($menu_chile=mysql_fetch_array($ch)){ $no++	
				                          ?>
                                         <input type="checkbox" class="flat-red" name="status[]" value="<?php echo $menu_chile['id_sub'];?>" />
                                        <?php echo $menu_chile['nama'];?>
                                        <hr />
                               
                               <?php } ?>
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
									</div>
								</div>
							</form>
					
					<div class="clear"></div>
                    						
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
  