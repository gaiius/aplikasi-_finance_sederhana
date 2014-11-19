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
            <?php 
			
			$bs=mysql_query("SELECT * FROM supplier where id_supplier='$id'");
            $sb=mysql_fetch_array($bs);
			?>
           <form action="<?=$base_url?>master/update_supplier/<?php echo $id;?>/<?php echo $user;?>/<?php echo $pass;?>" method="post">
                                 
            <label>Nama
            <input class="form-control input-sm" type="text" name="vol[index][nama]" value="<?php echo $sb['nama'];?>" readonly="readonly" >
            </label>
            
              <label> Alamat
            <input class="form-control input-sm" type="text" name="vol[index][alamat]" value="<?php echo $sb['alamat'];?>" >
            </label>
            
             <label> Telp
            <input class="form-control input-sm" type="text" name="vol[index][telp]" value="<?php echo $sb['telp'];?>" >
            </label>
            
             <label> Mail
            <input class="form-control input-sm" type="text" name="vol[index][mail]" value="<?php echo $sb['mail'];?>" >
            </label>
            
             <label>Web
            <input class="form-control input-sm" type="text" name="vol[index][url]" value="<?php echo $sb['url'];?>" >
            </label>
            
            <hr />
               <label>Toko Untuk proses
      
          <select name="vol[index][dept]" class="form-control input-sm">
          <option value="<?php echo $sb['dept_toko'];?>"><?php echo $sb['dept_toko'];?></option>
          <option value="Potong">Potong</option>
          <option value="Jahit">Jahit</option>
          <option value="Laundry">Laundry</option>
          <option value="Finishing">Finishing</option>
          </select>
         </label> 
            
                 <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary" />
            
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
  
       
	