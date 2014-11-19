<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Finance extends CI_Controller {
	public function index()
	{
		$this->load->model('m_progres');
                 $data['progres'] = $this->m_progres->get_search();
		 $data['main_view'] = 'progres/v_progres';
		$this->load->view('grand_template',$data);
	}
	public function pembelian($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'finance/v_pembelian';
		$this->load->view('grand_template',$data);
		
	}
	public function add_jual($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'finance/v_add_pembelanjaan';
		$this->load->view('grand_template',$data);
		
	}
	
	public function jualan_insert($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$cus = $this->input->post('standard');
	
		    $data_form = @$_POST['vol'];
		    foreach($data_form as $key=>$hasil){
				
	
			$sql = $this->db->query("insert into hasil_produksi (invoice,tgl_masuk,customer)
			VALUES ('$hasil[nopo]','$hasil[tanggal]','$cus')");
			
			$tanggalan=$hasil['tanggal'];
			
			$idnya=mysql_insert_id();
			//$barangnya=$hasil['barang'];
			}
			
			$na = $this->input->post('jumlah');
			$b = $this->input->post('barang');
			$harga = $this->input->post('harga');
		    $awal=$tanggalan;
								$tgl_awal = substr("$awal",0,2);
								$bln_awal = substr("$awal",3,2);
								$thn_awal= substr("$awal",6,6);
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
								$tanggal_s=$thn_awal."-".$bln_awal."-".$tgl_awal;
								
			for($i=0; $i< count($b); $i++){
			$sentence[$i] = $b[$i]; //Kalimatnya
            $value[$i] = "1";//Berapa kata yang ingin diambil
            $limit_sentence[$i] = implode("/", array_slice(explode("/", $sentence[$i]), 0, $value[$i]));
			echo $limit_sentence[$i];
			
			$sup3=mysql_query("SELECT * FROM finishing where id_finis='$limit_sentence[$i]'");
            $sp3=mysql_fetch_array($sup3);
			
			$sup1[$i]=mysql_query("SELECT * FROM history_finis where kode_barang='$limit_sentence[$i]'");
            $sp1=mysql_fetch_array($sup1[$i]);
			$jumlahnya=$sp1['jumlah']-$na[$i];
			$terjual=$sp1['kirim_jual']+$na[$i];
			$po=$sp1['kode_barang'];
			$bpr=$sp1['barang'];
			
			
            echo $i."<hr>";
			
			if($jumlahnya < 0 ){
				$update_finis = $this->db->query("DELETE FROM hasil_produksi where id_produk='$idnya'");
				echo "<script>alert('Maaf Jumlah melebihi Stock yang ada');</script>";
	            echo "<meta http-equiv=refresh content=0;url=../../../finance/pembelanjaan/$user/$pass>";
				
			}else{
			
			$update_finis = $this->db->query("UPDATE history_finis SET jumlah='$jumlahnya',kirim_jual='$terjual' where kode_barang='$limit_sentence[$i]'");
			
			
			$barang[$i]=$sp3['nama_finis'];	
			$total[$i] = $harga[$i]*$na[$i];
			
			$sql2 = $this->db->query("insert into history_jual 
			(jumlah_total,nama_jual,kode_jual,jumlah,harga_satuan,harga,tgl_jual,tgl)
			VALUES
			    ('$sp1[jumlah]','$sp1[id_fn]','$idnya','$na[$i]','$harga[$i]','$total[$i]','$tanggalan','$tanggal_s')");
															
															
			$sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			VALUES ('$total[$i]','$user','$tanggalan','Penjualan&nbsp;$bpr&nbsp;','$po')");
			
		
			}
			 $sql_del = $this->db->query("DELETE FROM history_jual WHERE nama_jual ='0' ");
			}
			
		 echo "<meta http-equiv=refresh content=0;url=../../../finance/pembelanjaan/$user/$pass>";
		 
	}
	
	
	
	 public function pembelian_delete($id,$user, $pass)
	{
	
		$data['id']=$id;
		$data['pass'] = $pass;
		$data['user'] = $user;
		$tanggal=date('d/m/Y H:i');
		$no_beli=mysql_query("SELECT * FROM pembelian where id_beli='$id'");
        $beli=mysql_fetch_array($no_beli);
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$beli[jumlah]','$user','$tanggal','Delete&nbsp;Pembelian&nbsp;$beli[barang]','$beli[ket]')");
			  
			  $sql = $this->db->query("DELETE FROM pembelian where id_beli='$id'");
		redirect('finance/pembelian/'.$user."/".$pass);
	}
	
	 public function bayar_pembelian($status,$user, $pass)
	{
	
		
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['status'] = $status;
		 $kirim = $this->input->post('kirim');

	     $po = $this->input->post('po');
	     $id = $this->input->post('id');
	     $nama = $this->input->post('nama');
		  $total = $this->input->post('total');
	 
		$tanggal=date('d/m/Y H:i');
		$no_beli=mysql_query("SELECT * FROM pembelian where id_beli='$id'");
        $beli=mysql_fetch_array($no_beli);
		
		$hasil=$beli['total']-$kirim;
		$bayarnya=$beli['bayar']+$kirim;
		
		if($hasil == 0){
			$statusnya='Lunas';
		}else{
			$statusnya='Tempo';
		}
			if($hasil <0 ){
				  echo "<script>alert('Maaf Jumlah Pembayaran melebihi Total/Sisa Biaya');</script>";
	              echo "<meta http-equiv=refresh content=0;url=../../../../finance/biaya/$status/$user/$pass>";
			}else{
	             $sql_log = $this->db->query("UPDATE pembelian SET 
	             total='$hasil',
	             bayar='$bayarnya',
	             status='$statusnya'  
	             where id_beli='$id' ");
	   
	            $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			    VALUES ('$kirim','$user','$tanggal','Bayar Hutang&nbsp;untuk&nbsp;$beli[dari]','$hasil[nopo]')");
			
		
			}
			 echo "<meta http-equiv=refresh content=0;url=../../../../finance/biaya/$status/$user/$pass>";
	}
	
	public function pembelanjaan($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$this->load->model('m_progres');
		 $data['pview'] = $this->m_progres->belanja();
		 $data['main_view'] = 'laporan/v_pembelanjaan';
		 $this->load->view('grand_template',$data);	
	}
	
	public function jual($user,$pass)
	{	
	 $data['pass'] = $pass;
	 $data['user'] = $user;
   
	 $po = $this->input->post('po');
	 $id = $this->input->post('id');
	 $nama = $this->input->post('nama');
	 $biaya = $this->input->post('biaya');
	 $kirim = $this->input->post('kirim');
	 $invoice = $this->input->post('invoice');
	 $customer = $this->input->post('customer');
	 $tanggal=date('d/m/Y H:i');
	
	 $jahat=mysql_query("SELECT * FROM hasil_produksi where id_produk='$id'");
     $jh=mysql_fetch_array($jahat);
	 $sisa=$jh['sisa']-$kirim;
	 $harga=$biaya*$kirim;
	  $sql2 = $this->db->query("UPDATE hasil_produksi set 
	  tgl_keluar='$tanggal',
	  sisa='$sisa',
	  harga='$harga',
	  harga_satuan='$kirim',
	  invoice='$invoice'
	  where id_produk='$id' ");	
	  
	  $cs=mysql_query("SELECT * FROM customer where nama='$customer'");
      $cus=mysql_fetch_array($cs);
	  
	  if(empty($cus['nama'])){
		$sc = $this->db->query("insert into customer (nama)VALUES('$customer') "); 
		  
	  }
	  
	  $jual = $this->db->query("insert into history_jual 
	  (kode_jual,nama_jual,po_jual,tgl_jual,harga_satuan,harga,jumlah,inv,customer)
			VALUES 
	('$id','$nama','$po','$tanggal','$biaya','$harga','$kirim','$invoice','$customer')");
			
	   
		 $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$kirim','$user','$tanggal','Penjualan&nbsp;Kain&nbsp;$nama','$po')");
			
			
	
       redirect('finance/pembelanjaan/'.$user."/".$pass);
	}
	public function belanjan_edit($id, $user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
		$data['main_view'] = 'finance/v_belanja_edit';
		$this->load->view('grand_template',$data);
	}
	
	public function jualan_update($id, $user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
	
		    $data_form = @$_POST['vol'];
		    foreach($data_form as $key=>$hasil){
				
		    $sup=mysql_query("SELECT * FROM customer where nama='$hasil[sp]'");
            $sp=mysql_fetch_array($sup);
			
			if(empty($sp['nama'])){
			$supplier = $this->db->query("insert into customer (nama)VALUES ('$hasil[sp]')");
			}
			$sql = $this->db->query("UPDATE hasil_produksi SET 
			invoice='$hasil[nopo]',
			tgl_masuk='$hasil[tanggal]',
			customer='$hasil[sp]'  
			WHERE id_produk='$id'");
			
			
			
		     $tanggalan=$hasil['tanggal'];
			//$barangnya=$hasil['barang'];
			}
			
			$na = $this->input->post('jumlah');
			$b = $this->input->post('barang');
			$harga = $this->input->post('harga');
			$id_fn= $this->input->post('id_fn');
	        $tg= $this->input->post('tg');
		    $id_jual= $this->input->post('id_jual');
			$awal=$tanggalan;
								$tgl_awal = substr("$awal",0,2);
								$bln_awal = substr("$awal",3,2);
								$thn_awal= substr("$awal",6,6);
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
								$tanggal_s=$thn_awal."-".$bln_awal."-".$tgl_awal;
			for($i=0; $i< count($b); $i++){
		
			         $total_jual=$harga[$i]*$na[$i];
			         $sup1[$i]=mysql_query("SELECT * FROM history_finis where id_fn='$id_fn[$i]'");
                     $sp1=mysql_fetch_array($sup1[$i]);
			
			         $jumlahnya=$sp1['jumlah']-$na[$i];
		             $julannya=$sp1['kirim_jual']-$na[$i];
	
			         $update_finis = $this->db->query("UPDATE history_finis SET 
			           jumlah='$jumlahnya',
			           kirim_jual='$na[$i]' 
			           where id_fn='$id_fn[$i]'");
			
			                    
			         
			         $total[$i] = $harga[$i]*$na[$i];
			       $update_jual = $this->db->query("UPDATE history_jual SET 
				    tgl_jual='$tanggalan',
					tgl='$tanggal_s',
			          harga_satuan='$harga[$i]',
			          harga='$total[$i]',
			          jumlah='$na[$i]' 
			         where id_jual='$id_jual[$i]'");	
			
														
          
		
			}
		    $jml = $this->input->post('jumlah2');
			$brn = $this->input->post('barang2');
			$hrg = $this->input->post('harga2');
			if(isset($_POST['tambah'])){
			  $tanggal=date('d/m/Y');
			 
			  for($a=0; $a< count($brn); $a++){
				   $total_insert[$a]=$jml[$a]*$hrg[$a];
				   
				   
				   
				   
				  	$sql2 = $this->db->query("insert into history_jual 
				     (nama_jual,kode_jual,jumlah,harga_satuan,harga,tgl_jual)VALUES
			         ('$brn[$a]','$id','$jml[$a]','$hrg[$a]','$total_insert[$a]','$tanggal')");
					 
					 $sup3[$a]=mysql_query("SELECT * FROM history_finis where id_fn='$brn[$a]'");
                     $sp3=mysql_fetch_array($sup3[$a]);
															
					$jumlahnya1=$sp3['jumlah']-$jml[$a];
					$jumlahnya2=$sp3['kirim_jual']+$jml[$a];
					
			        $update_finis = $this->db->query("UPDATE history_finis SET 
					jumlah='$jumlahnya1',
					kirim_jual='$jumlahnya2'
					where id_fn='$brn[$a]'");								
															
			  }
			}
			
	redirect('finance/pembelanjaan/'.$user."/".$pass);
		 
	}
	
	 public function belanja_delete($id,$user, $pass)
	{
	
		$data['id']=$id;
		$data['pass'] = $pass;
		$data['user'] = $user;
		$tanggal=date('d/m/Y H:i');
		$no_beli=mysql_query("SELECT * FROM pembelian where id_beli='$id'");
        $beli=mysql_fetch_array($no_beli);
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$beli[jumlah]','$user','$tanggal','Delete&nbsp;Pembelian&nbsp;$beli[barang]','$beli[ket]')");
			  
			  $sql = $this->db->query("DELETE FROM pembelian where id_beli='$id'");
		redirect('finance/pembelian/'.$user."/".$pass);
	}
	
	
	 public function pembelanjaan_delete($id,$user, $pass)
	{
	
		$data['id']=$id;
		$data['pass'] = $pass;
		$data['user'] = $user;
		$tanggal=date('d/m/Y H:i');
		$no_beli=mysql_query("SELECT * FROM hasil_Produksi where id_produk='$id'");
        $beli=mysql_fetch_array($no_beli);
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$beli[jumlah]','$user','$tanggal','Delete&nbsp;Pembelian&nbsp;$beli[barang]','$beli[ket]')");
			  
			  $sql = $this->db->query("DELETE FROM hasil_Produksi where id_produk='$id'");
			  $sql = $this->db->query("DELETE FROM history_jual where kode_jual='$id'");
		redirect('finance/pembelanjaan/'.$user."/".$pass);
	}
	
	 public function load_customer()
	{
	if (isset($_GET['input']))
	{
		$input = $this->input->get('$input');
		echo "Quick Search<hr>";
		$query = mysql_query("SELECT DISTINCT nama FROM customer WHERE nama LIKE '%$input%'"); //query mencari hasil search
		$hasil1 = mysql_num_rows($query);
		if ($hasil1 > 0)
		{
			while ($data = mysql_fetch_row($query))
			{
				?>
				<a class="cari" href="javascript:autoInsert1('<?=$data[0]?>');"><?=$data[0]?><BR> <!-- hasil search -->
				<?php
			}
		}
		else
		{
			echo "Data tidak ditemukan";
		}
	
	}

	
	}
	

	
	public function bayar_customer($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $kirim = $this->input->post('kirim');
		 $id = $this->input->post('id');
		 $jenis = $this->input->post('jenis');
		 $ket = $this->input->post('ket');
		 $tanggal=date('d/m/Y H:i');
		 $tgl=date('Y-m-j');
		 
		 $bel=mysql_query("SELECT * FROM history_jual where id_jual='$id'");
         $belia=mysql_fetch_array($bel);	
		 
		 $total=$belia['harga']-$kirim;
		
		 if($total < 0){
			 echo "<script>alert('Maaf Jumlah pembayaran melebihi sisa $total');</script>";
	              echo "<meta http-equiv=refresh content=0;url=../../../finance/pembelanjaan/$user/$pass>";
		 }else{
		 $sql_lg = $this->db->query("UPDATE history_jual SET harga='$total',bayarnya='$kirim',tgl=NOW() where id_jual='$id'");
		 $sql_log1 = $this->db->query("insert into history_bayar (ket,jenis,tanggal,kode_bayar,bayar,sisa,tgl)VALUES('$ket','$jenis','$tanggal','$id','$kirim','$total',NOW())");
		
		}
		
		
		echo "<meta http-equiv=refresh content=0;url=../../../finance/pembelanjaan/$user/$pass>";
	}
	
	public function retur_customer($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $kirim = $this->input->post('kirim');
		 $id = $this->input->post('id');
		 $jumlah = $this->input->post('jumlah');
		  $jm = $this->input->post('jm');
		  
		   $validasi=$jm-$jumlah;
		  
			  if($validasi < 0){
			
			    echo "<script>alert('Maaf Jumlah Retur melebihi Jumlah Penjualan');</script>";
	            echo "<meta http-equiv=refresh content=0;url=../../../finance/pembelanjaan/$user/$pass>";
			  }else{
				  
		 $ket = $this->input->post('ket');
		 $kode = $this->input->post('kode');
		 $namanya = $this->input->post('namanya');
		  $barangnya = $this->input->post('barangnya');
		 $total=$kirim*$jumlah;
		 $tanggal=date('d/m/Y H:i');
		 $bel=mysql_query("SELECT * FROM history_jual where id_jual='$id'");
         $belia=mysql_fetch_array($bel);	
		 $totalnya=$belia['harga']-$total;
		 $jml=$belia['jumlah']-$jumlah;
	  	 $sql_lg = $this->db->query("UPDATE history_jual SET harga='$totalnya',jumlah='$jml',retur_jumlah='$jumlah' where id_jual='$id'");
		 
		 $bl=mysql_query("SELECT * FROM history_finis where kode_barang='$kode' AND status='Fix'");
         $b2=mysql_fetch_array($bl);
		 $terjual=$b2['kirim_jual']-$jumlah;
		
		 $sqlnya = $this->db->query("UPDATE history_finis SET kirim_jual='$terjual' where kode_barang='$kode' AND status='Fix'");
		 
	$lh = $this->db->query("insert into history_finis (biaya,kirim_jual,barang,jumlah,status,kode_barang,tanggal)
	VALUES ('$b2[biaya]','$jumlah','$barangnya','$jumlah','Retur Dari $namanya ','$kode','$tanggal')");
			  }
echo "<meta http-equiv=refresh content=0;url=../../../finance/pembelanjaan/$user/$pass>";
	}
	
		public function stock($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'finance/v_stock';
		 $this->load->view('grand_template',$data);
		
	}
	

		public function returan($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $kirim = $this->input->post('kirim');
		 $id = $this->input->post('id');
		 $jumlah = $this->input->post('jumlah');
		 $status = $this->input->post('status');
		 $kode = $this->input->post('kode');
		 $nama = $this->input->post('nama');

		 $total=$kirim*$jumlah;
		 $tanggal=date('d/m/Y H:i');
		 $be=mysql_query("SELECT * FROM history_finis where status='$status' AND kode_barang='$kode'");
         $b=mysql_fetch_array($be);	
		 $totalnya=$b['jumlah']+$jumlah;
	
	  	$sql= $this->db->query("UPDATE history_finis SET jumlah='$totalnya' where status='$status' AND kode_barang='$kode'");
		 
	     $Del= $this->db->query("DELETE FROM history_finis WHERE id_fn='$id' ");
		
		 redirect('finance/stock/'.$user."/".$pass);
	}
	
   public function belanja_delete2($id,$user, $pass)
	{
	
		$data['id']=$id;
		$data['pass'] = $pass;
		$data['user'] = $user;
		$tanggal=date('d/m/Y H:i');
		$no_beli=mysql_query("SELECT * FROM hasil_produksi where id_produk='$id'");
        $beli=mysql_fetch_array($no_beli);
		
		$ambil4=mysql_query("SELECT history_finis.kode_barang,
		                            history_finis.barang,
									history_finis.kirim_jual,
									history_finis.id_fn,
									history_finis.jumlah
									
									       FROM history_finis inner join
										   history_jual on
								           history_finis.id_fn=history_jual.nama_jual
										   where history_jual.kode_jual='$id'");
                                                       while ($dapet4=mysql_fetch_array($ambil4)){
														$up=$dapet4['jumlah']+$dapet4['kirim_jual'];  
													
														//echo $dapet4['jumlah']."<hr>";
														//echo $dapet4['kirim_jual']."<hr>";
														//echo $dapet4['jumlah']."<hr>";
														   $array=array($dapet4['id_fn']);
														//print_r ($array);
	   													
		$sql_log1 = $this->db->query("UPDATE history_finis SET jumlah='$up',kirim_jual='0' where id_fn='$dapet4[id_fn]' ");
		$sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			 VALUES ('$dapet4[jumlah]','$user','$tanggal','Delete&nbsp;Penjualan&nbsp;$dapet4[kode_barang]','$dapet4[barang]')");
			  $Del= $this->db->query("DELETE FROM history_jual WHERE kode_jual='$id' "); 								   
														   
		}
		
			 
			  
			 $sql = $this->db->query("DELETE FROM hasil_produksi where id_produk='$id'");
	redirect('finance/pembelanjaan/'.$user."/".$pass);
	}
public function insert_stock($user,$pass)
	{
	
		$data['pass'] = $pass;
		$data['user'] = $user;

		$hasil=@$_POST['vol'];
		$tanggal=date('j/m/Y');
		foreach($hasil as $key=>$val){
			$total=$val['jumlah']*$val['harga'];
			
	    $sql = $this->db->query("INSERT INTO history_finis 
		(kode_fn,barang,jumlah,biaya,total,tanggal,kode_barang,tgl_finis,status)
		VALUES
		('01','$val[nama]','$val[jumlah]','$val[harga]','$total','$tanggal','$val[kode]',NOW(),'Fix')");		
			
		}
 redirect('finance/stock/'.$user.'/'.$pass);
		
	}
	
	public function update_stock($id,$user,$pass)
	{
	
		$data['pass'] = $pass;
		$data['user'] = $user;
        $data['id'] = $id;
		$hasil=@$_POST['vol'];
		$tanggal=date('j/m/Y');
		foreach($hasil as $key=>$val){
			$total=$val['jumlah']*$val['harga'];
			
	    $sql = $this->db->query("UPDATE history_finis SET
		kirim_jual='$val[jumlah]',
		barang='$val[nama]',
		jumlah='0',
		biaya='$val[harga]',
		total='$total',
		tanggal='$tanggal',
		kode_barang='$val[kode]',
		tgl_finis=NOW()
		where id_fn='$id'
		");		
			
		}
	  redirect('finance/stock/'.$user.'/'.$pass);
		
	}
	
	public function stock_delete($id,$user,$pass)
	{
	
		$data['pass'] = $pass;
		$data['user'] = $user;
        $data['id'] = $id;
	    $sql = $this->db->query("DELETE FROM history_finis WHERE id_fn='$id'");		
			
	
	  redirect('finance/stock/'.$user.'/'.$pass);
		
	}
	
	/*public function biaya_potong($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
	     $tmpl = array( 
            'table_open'     => '<table id="example1" class="table table-bordered table-striped">',
			'row_alt_start'  => '<thead>', 
            'row_alt_start'  => '<tr>', 
			 'row_alt_end'    => '</tr>',
            'row_alt_end'    => '</thead>'
        );
        $this->table->set_template($tmpl);
        $this->table->set_empty("-");
        $this->table->set_heading(
            'No', 
            'Po',
            'Barang',
            'Jumlah',
            'Total',
            'Status', 
	    'Delete',
	    'Export'	    
        );
        $this->load->model('m_progres');
        $data['invite_letter'] = $this->m_progres->get_potong();
        $invite_data = $data['invite_letter'];
        for($i=0; $i<count($invite_data); $i++) {
            $no = $i + 1;
            $this->table->add_row(
                $no, 
                $invite_data[$i]['ket'],
                $invite_data[$i]['barang'],
                $invite_data[$i]['jumlah'],
                number_format($invite_data[$i]['total']),
                $invite_data[$i]['status'],
                '',
                anchor('invitation/detail/'.$invite_data[$i]['id_beli'], 'VIEW'),		  
                anchor('invitation/delete_letter/'.$invite_data[$i]['id_beli'], 'DELETE', array('class'=> 'delete','onclick'=>"return confirm('Anda yakin akan menghapus data ini?')")),
                anchor('excel', 'EXCEL')
            );
        }
        $data['tbl'] = $this->table->generate();      
        $this->load->model('m_progres');
		$data['main_view'] = 'finance/v_biaya_potong';
		$this->load->view('grand_template',$data);	
	}
	*/
	public function biaya($status,$user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['status'] = $status;
		$data['main_view'] = 'finance/v_biaya_potong';
		$this->load->view('grand_template',$data);	
	}
	
	public function edit_biaya($status,$user, $pass)
	{
		$hasil=@$_POST['vol'];
		$tanggal=date('j/m/Y');
		$data['status'] = $status;
		foreach($hasil as $key=>$val){
			 $sql = $this->db->query("UPDATE pembelian SET
			                         jumlah='$val[total]',
									 bayar='$val[bayar]', 
									 total='$val[sisa]'  
			                         where id_beli='$val[id]'
			                       ");
			
		}
		redirect('finance/biaya/'.$status."/".$user.'/'.$pass);
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */