<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>

		<script language="javascript" type="text/javascript">
/*blocker*/
if(window.opener==null)
{
window.location="index.php";
}
/*--------*/
</script>

     <h2 align="center"> Add Barang </h2><hr />
		<table class="global tr th" width="100%"  style="font-size:12px; margin-left:20px; margin-bottom:60px;"> 
						<thead> 
			      <tr > 
						     
						    	    <th width="46" height="22">No</th>
                                   
                                    <th width="182">Nama</th>
   									<th width="95">Kode</th>
                                     <th width="158">Tgl Trans</th>
  									<th width="190">asal</th>
                                    <th width="247">Foto</th>                               
						      </tr>
						</thead>    <script>
function select_item(item)
{
targetitem.value = item;
top.close();
return false;
}
</script>
                                   <?php 
                                    $noUrut=0;
	                                $count_brn = count($brn);
	                                for($i=0; $i<$count_brn; $i++): 
								
                                   ?> 
						<tbody> 
						     <tr>
   								<td><?php  $noUrut++;echo $noUrut;?></td>                                 						
   									 <td><?php  echo $brn[$i]['nama_kat'];?></td>
                                     <td><a href="" onClick='return select_item("<?php echo $brn[$i]['kode']; ?>")'><?php echo $brn[$i]['kode']; ?></a>
	</td>
   									 <td><?php echo $brn[$i]['tgl']; ?></td>
                                     <td><?php echo $brn[$i]['asal']; ?></td>                                     
                                     <td><img  src="<?=$base_url?>file/<?php echo $brn[$i]['upload']; ?>" width="50" vspace="8" hspace="4"  /></td>                                      					
                          </tr>					 
						</tbody> 
                        <?php endfor; ?>
					</table> 

     <p>&nbsp;</p>
     