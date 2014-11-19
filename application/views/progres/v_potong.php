				<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>





						
		<script src="<?=$base_url?>public/js/jquery.min.js" type="text/javascript"></script>
        
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
                                    <h1 >POTONG KAIN</h1>
                       
                                </div>
                                <hr /><!-- /.box-header -->
                                <a class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#myModal" style="top:-20px;">

  Add No PO
</a>

                                 
                              
                               
                                 
                                <div class="box-body table-responsive">
                               
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                    
                                            <tr>
                                                <th>No</th>
                                                <th>TGL Keluar</th>
                                                <th>Sisa</th>
                                                <th>TGL Kembali</th>
                                                <th>No Po</th>
                                                <th>Surat Jalan</th>
                                                <th>Barang</th>
                                                 <th>Jumlah</th>
                                                <th>Keterangan</th>
                                               
                                                  
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           $no=0;
					                       // $qpo=mysql_query("SELECT * FROM potong order by id_potong DESC   ");
					                       // while ($hasil=mysql_fetch_array($qpo)){ $no++;
										   foreach ($pview as $hasil){	$no++;
				                          ?>
                                            <tr>
                                               <td><?php echo $no;
											   ?>
                                               
                                                <a href="<?=$base_url?>progres/potong_edit/<?php echo $hasil['id_potong'];?>/<?php echo $user;?>/<?php echo $pass;?>">
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
													 
													 if(empty($hasil['tanggal'])){
														 $edit="";
													 }else{
														  $edit="Edit";
													 }
													// echo $edit;
                                                     ?></a>
                                             &nbsp;
                                              <a href="<?=$base_url?>progres/potong_delete/<?php echo $hasil['id_potong'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                                 <?php echo $del;?>
                                               </a>
                                             
                                               </td>
                                               <td>
                                               <?php if(empty($hasil['tanggal'])){?>
                                                <a  data-toggle="modal" data-target="#myModal_1<?php echo $hasil['id_potong'];?>" style="top:-20px;">
                                               <em>Add Barang</em>
                                               </a>
                                                 <?php }elseif($hasil['jumlah_total'] == 0){
													  echo $hasil['tanggal'];
												   }else{?>
											    <a  data-toggle="modal" data-target="#myModal_1<?php echo $hasil['id_potong'];?>" style="top:-20px;">
											   <?php echo $hasil['tanggal'];?> 
                                               </a>
                                               <?php } ?>
<form action="<?=$base_url?>progres/potong_kirim/<?php echo $user;?>/<?php echo $pass;?>" method="post">                                             <!-- Modal -->
<div class="modal fade" id="myModal_1<?php echo $hasil['id_potong'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Bahan Keluar <?php echo $hasil['barang_potong'];?>&nbsp; PO  <?php echo $hasil['no_po'];?></h4>
      </div>
      <div class="modal-body">
       <br />
       <label> Kirim Ke toko (<em style="font-size:12px; color:#F00;"><?php echo number_format($hasil['jumlah_total'])."&nbsp;Roll";?></em>)&nbsp;Dalam PCS
          <input class="form-control input-sm" type="text" name="kirim" placeholder="Stock Yang tersedia <?php echo $hasil['jumlah_total'];?>"  id="masknumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input><br>
       </label> 
        <input type="hidden" name="jt" value="<?php echo $hasil['jumlah_total'];?>"  />
     
        <label> Invoice
          <input class="form-control input-sm" type="text" name="invoice" value="<?php echo $hasil['invoice'];?>" required="required"  /><br>
       </label>
       <hr />
    
         
         	   
<label> Nama Toko<br />
    <script src="<?=$base_url?>public/js/jquery-customselect.js"></script>
    <link href="<?=$base_url?>public/css/jquery-customselect.css" rel="stylesheet" />
    
        <select id="standard" name="standard" class="custom-select" required="required">
        <option value=""></option>
        <?php 
	$selector=mysql_query("SELECT * FROM supplier where dept_toko='Potong'");
     while ($sl=mysql_fetch_array($selector)){?>
        <option value="<?php echo $sl['id_supplier'];?>"><?php echo $sl['nama'];?></option>
        <?php } ?>
      </select>
    </label>
    
      <script>
      $(function() {
        $("#standard").customselect();
      });
      </script>			
				<hr />
         <label> Tanggal
          <input class="form-control input-sm" type="date" value="31/12/2012/"  name="tanggal"  required="required"  /><br>
       </label>
       <input type="hidden" name="id" value="<?php echo $hasil['id_potong'];?>"   >
       <input type="hidden" name="po" value="<?php echo $hasil['no_po'];?>"  >
       <input type="hidden" name="nama" value="<?php echo $hasil['barang_potong'];?>"  >
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
                                               <td><?php echo $hasil['jumlah_total'];?> - 
                                               
                                               <em>
                                                <a style="float:right;"  data-toggle="modal" data-target="#myModal_3<?php echo $hasil['id_potong'];?>" >
                                               History
                                               </a>
                                               </em>
                                               
                                               
<div class="modal fade" id="myModal_3<?php echo $hasil['id_potong'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">History Barang <?php echo $hasil['barang_potong'];?></h4>
      </div>
      <div class="modal-body">
        <br />
         <table  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Barang</th>
                                                <th>Jumlah </th>
                                                <th>Toko</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           
					                        $qp9=mysql_query("SELECT * FROM history_potong where kode_ptk='$hasil[id_potong]' and stt='Keluar'   ");
					                        while ($hasil3=mysql_fetch_array($qp9)){ 
				                          ?>
                                        <tr>
                                        <td><?php echo $no;?>&nbsp;
                                        
                                        
                                          <a href="<?=$base_url?>progres/del_ptk/<?php echo $hasil['id_potong'];?>/<?php echo $hasil3['id_ptk'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                        Del
                                        </a>
                                      
                                        </td>
                                        <td><?php echo $hasil3['tanggal'];?></td>
                                        <td><?php echo $hasil3['kode_pbarang'];?></td>
                                        <td><?php echo number_format($hasil3['kirim_ptk']);?></td>
                                         <td> <?php 
												 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$hasil3[toko_ptk]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												 echo $sl2['nama'];?></td>
                                       
                                        
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

                                               </td>
                                               <td>
                                                <?php
												$idnya2=$hasil['id_potong'];
												
												 if(empty($hasil['tgl_kembali'])){?>
                                                <a href="<?=$base_url?>progres/potongan_kembali/<?php echo $idnya2;?>/<?php echo $user;?>/<?php echo $pass;?>" style="top:-20px;">
                                               <em>Add Barang</em>
                                               </a>
                                               <?php }elseif($hasil['jumlah']-$hasil['jumlah_total'] == 0 ){?>
                                               <?php echo $hasil['tgl_kembali'];?> 
                                               <?php }else{?>
											    <a href="<?=$base_url?>progres/potongan_kembali/<?php echo $idnya2;?>/<?php echo $user;?>/<?php echo $pass;?>" style="top:-20px;">
											   <?php echo $hasil['tgl_kembali'];?> 
                                               </a>
                                               <?php } ?> 
                                               
                                                <a style="float:right;"  data-toggle="modal" data-target="#myModal_5<?php echo $hasil['id_potong'];?>" >
                                               History
                                               </a>
<div class="modal fade" id="myModal_5<?php echo $hasil['id_potong'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog" style="width:950px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">History Barang Kembali <?php echo $hasil['barang_potong'];?> </h4>
      </div>
      <div class="modal-body">
        <br />
         <table  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Barang</th>
                                                  <th>invoice</th>
                                                <th>Jumlah </th>
                                                 <th>Model</th>
                                                <th colspan="2">
                                                Lusin / PCS
                                                </th>
                                                  <th>Pemakaian</th>
                                                <th>Toko</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
				                           
					                        $qp9=mysql_query("SELECT * FROM history_potong where kode_ptk='$hasil[id_potong]' and stt='Kembali'   ");
					                        while ($hasil3=mysql_fetch_array($qp9)){ 
				                          ?>
                                        <tr>
                                        <td><?php echo $no;?>&nbsp;
                                        
                                        
                                          <a href="<?=$base_url?>progres/del_pty/<?php echo $hasil['id_potong'];?>/<?php echo $hasil3['id_ptk'];?>/<?php echo $user;?>/<?php echo $pass;?>">
                                        Del
                                        </a>
                                      
                                        </td>
                                        <td><?php echo $hasil3['tanggal'];?></td>
                                        <td><?php echo $hasil3['kode_pbarang'];?></td>
                                        <td><?php echo $hasil3['invoice_ptk'];?></td>
                                        <td><?php echo number_format($hasil3['kirim_ptk']);?></td>
                                        <td><?php echo $hasil3['model_ptk'];?></td>
                                                 <td><?php echo number_format($hasil3['lusin_ptk'],2,",",".");?></td>
                                                 <td><?php echo number_format($hasil3['pcs_ptk']);?></td>
                                                 <td><?php echo $hasil3['pakai_ptk'];?></td>
                                         <td> <?php 
												 $selector2=mysql_query("SELECT * FROM supplier where id_supplier='$hasil3[toko_ptk]' ");
                                                 $sl2=mysql_fetch_array($selector2);
												 echo $sl2['nama'];?></td>
                                       
                                        
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
                                               
                                               </td>
                                               <td> <?php echo $hasil['no_po'];?></td>
                                               <td><?php echo $hasil['invoice'];?></td>
                                                <td><?php echo $hasil['barang_potong'];?></td>
                                                <td><?php echo number_format($hasil['jumlah']);?></td>
                                                
                                                <td><?php
												if($hasil['status'] == 'Barang Keluar'){
													echo "<span style=color:#f00;>".$hasil['status']."</span>";
												}else{
													echo "<span style=color:#03F;>".$hasil['status']."</span>";
												}?></td>
                                              
                                                
                                            </tr>
                                            		           <!-- Modal -->

                                           <?php } ?>
                                        </tbody>
                                     
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->  

                     
                     
<form action="<?=$base_url?>progres/insert_potong/<?php echo $user;?>/<?php echo $pass;?>" method="post">		
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Masukkan No PO yang mau di potong</h4>
      </div>
      <div class="modal-body">
            
           <script language='JavaScript' type="text/javascript">

var ajaxRequest;
function getAjax() //fungsi untuk mengecek AJAX pada browser
{
	try
	{
		ajaxRequest = new XMLHttpRequest();
	}
	catch (e)
	{
		try
		{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) 
		{
			try
			{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser broke!");
				return false;
			}
		}
	}
}

function autoComplete1() //fungsi menangkap input search dan menampilkan hasil search
{
	getAjax();
	input = document.getElementById('inputan1').value;

	if (input == "")
	{
		document.getElementById("hasil1").innerHTML = "";
	}
	else
	{
		ajaxRequest.open("GET","<?=$base_url?>progres/loaddata_po?input="+input);
		ajaxRequest.onreadystatechange = function()
		{
			document.getElementById("hasil1").innerHTML = ajaxRequest.responseText;
		}
		ajaxRequest.send(null);
	}
}

function autoInsert1(nama1) //fungsi mengisi input text dengan hasil pencarian yang dipilih
{
	document.getElementById("inputan1").value = nama1;
	document.getElementById("hasil1").innerHTML = "";
}
                      </script>
                        <input type='text' onkeyup="autoComplete1();" id='inputan1' name="kain" />
                      <div id='hasil1'></div> 
                      
            
      </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>				
							
	 

</form>


	                          
             				
	
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
                $("#example2").dataTable();
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
  
       
	