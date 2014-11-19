<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>
 <link rel="stylesheet" href="<?=$base_url?>public/admin/css/sprite.tables.css">  
 

<h1 align="center">Acoount Login</h1>
<div class="grid_12">
						<div class="box">
							<div class="header">
                            <a href="<?=$base_url?>progres/add_account/<?php echo $user;?>">
								<img src="<?=$base_url?>public/admin/img/add.png" width="35">
                                </a>
								<h3>Data tables Artikel</h3><span></span>
							</div>
							<div class="content">
								<table id="table-example" class="table" >
									<thead>
										<tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Hak akses</th>
											<th>Email</th>
											<th>Telp</th>
											<th>
                                             <?php 
							                   $query2= $this->m_progres->get_log_detail($user);
							                    if($query2[0]['hakakses'] == '1'){
								                   echo "CV"; 
							                   }else{
								                   echo "Alamat"; }
							                  ?>
							                 </th>
                                             <th>Foto</th>
                                             <th>Edit</th>
                                             <th>Delete</th>
										</tr>
									</thead>
                                    
									<tbody >
                                    <?php $query= $this->m_progres->get_komunitas();	
                                          $noUrut=0;
	                                         foreach ($query as $mon1){ 
	                                           $stt=$mon1['status'];
	                                           $noUrut++;
                                     ?>
							<tr>
                             <td class="center"><?php echo $noUrut; ?></td>
                             <td class="center">
							 <?php 
							  $query2= $this->m_progres->get_log_detail($user);
							  $id_user=$mon1['user'];
							  if($query2[0]['hakakses'] == 1){?>
								  <a href="<?=base_url () ?>progres/detail_account/<?php echo $user; ?>/<?php echo $id_user; ?>" target="_blank"><?php echo $mon1['user'];?></a> 
							  <?php }else{
								   echo $mon1['user']; }
							   ?></td>
                              <td class="center">
							  <?php 
							    $query2= $this->m_progres->get_log_detail($user);
							    if($query2[0]['hakakses'] == 1){
								   echo $mon1['hakakses'];
							    }else{
								   echo "hak akses login"; }
							   ?>
							 </td>
                             
							 <td class="center"><?php echo $mon1['email']; ?></td>
                             <td><?php echo $mon1['telp']; ?></td>
                             <td>
							 <?php 
							  $query2= $this->m_progres->get_log_detail($user);
							     if($query2[0]['hakakses'] == '1'){
								   echo $mon1['cv']; 
							      }else{
								   echo $mon1['alamat']; }
							   ?>
							 
							</td>
							 <td><img src="<?php echo base_url();?>profile/<?php echo $mon1['foto']; ?>" width="70" height="70"></td>
							
							 <td><a href="<?php echo base_url();?>progres/edit_berita/<?php echo $user;?>/<?php echo $mon1['user']; ?>/<?php echo $stt; ?>" >Edit</a></td>
    <td>
	
	 <a href="<?php echo base_url();?>progres/delete_account/<?php echo $mon1['user']; ?>/<?php echo $user;?>">DEL</a></td>
   						</tr>
  
										 <?php } ?>
									</tbody>
                                     
								</table>
						  </div> <!-- End of .content -->
							<div class="clear"></div>
						</div> <!-- End of .box -->
					</div>
 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="<?=$base_url?>public/admin/js/libs/jquery-1.7.1.js"><\/script>')</script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
		<script>window.jQuery.ui || document.write('<script src="<?=$base_url?>public/admin/js/libs/jquery-ui-1.8.16.min.js"><\/script>')</script>
		
		<!-- scripts concatenated and minified via build script -->
		<script defer src="<?=$base_url?>public/admin/js/plugins.js"></script> <!-- REQUIRED: Different own jQuery plugnis -->
		<script defer src="<?=$base_url?>public/admin/js/mylibs/jquery.ba-resize.js"></script> <!-- RECOMMENDED when using sidebar: page resizing -->
		<script defer src="<?=$base_url?>public/admin/js/mylibs/jquery.easing.1.3.js"></script> <!-- RECOMMENDED: box animations -->
		<script defer src="<?=$base_url?>public/admin/js/mylibs/jquery.chosen.js"></script>
		<script defer src="<?=$base_url?>public/admin/js/mylibs/jquery.ui.touch-punch.js"></script> <!-- RECOMMENDED: touch compatibility -->
		<script defer src="<?=$base_url?>public/admin/js/mylibs/jquery.dataTables.js"></script>
		<script defer src="<?=$base_url?>public/admin/js/script.js"></script> <!-- REQUIRED: Generic scripts -->
		<!-- end scripts -->
		<script defer>
			$(window).load(function() {
				$('#table-example').dataTable();
				$(window).resize();
			});

		</script>
