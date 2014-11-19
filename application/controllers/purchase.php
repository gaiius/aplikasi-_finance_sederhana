<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase extends CI_Controller {
	public function index()
	{
		$this->load->model('m_barang');
        $data['barang'] = $this->m_barang->get_view();
		$this->load->model('m_barang');
        $data['brn'] = $this->m_barang->get_view_jual();
		 $data['main_view'] = 'master/v_barang';
		$this->load->view('grand_template',$data);
	}
	public function out($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'po/v_out';
		 $this->load->view('grand_template',$data);	
	}
	
	
		public function out_insert1($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$n = $this->input->post('par');
	    $yard = $this->input->post('yard');
			$harga = $this->input->post('harga');
			$total = $this->input->post('thirdBox');
			$toko = $this->input->post('standard');
		    $data_form = @$_POST['vol'];
			$tanggal=date('d/m/Y');
			$jam=date('H:i');
		    foreach($data_form as $key=>$hasil){
		    $sup=mysql_query("SELECT * FROM supplier where nama='$toko'");
            $sp=mysql_fetch_array($sup);
			//if(empty($sp['nama'])){
			//$supplier = $this->db->query("insert into supplier (nama)VALUES ('$hasil[sp]')");
			//}
			$sql = $this->db->query("insert into po_out 
			(kode,tgl,supplier,status,barang,jumlah,harga_satuan,total,sisa_out)VALUES
			 ('$hasil[nopo]','$hasil[tanggal]','$toko','Open','$hasil[jenis]','$yard','$harga','$total','$yard')");
			 $idnya=mysql_insert_id();
			 
			 $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			VALUES ('$total','$user','$hasil[tanggal]','Pembelian Bahan&nbsp;$hasil[jenis]&nbsp;','$hasil[nopo]')");
			
			$beli = $this->db->query("insert into pembelian (ket,dept,total,barang,kode_finance,dari,jumlah,status,tanggal,tgl)
			VALUES ('$hasil[nopo]','Belanja','$total','$hasil[jenis]','$idnya','PO OUT','$total','Tempo','$hasil[tanggal]',NOW())");
			}
			
			
			redirect('purchase/out/'.$user."/".$pass);
		 
	}
	
	public function out_insert($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$n = $this->input->post('par');
		 if(empty($n)){
			 $data['main_view'] = 'po/v_out_insert';
		     $this->load->view('grand_template',$data);
		
		 }else{
		    $data_form = @$_POST['vol'];
		    foreach($data_form as $key=>$hasil){
		    $sup=mysql_query("SELECT * FROM supplier where nama='$hasil[sp]'");
            $sp=mysql_fetch_array($sup);
			//if(empty($sp['nama'])){
			//$supplier = $this->db->query("insert into supplier (nama)VALUES ('$hasil[sp]')");
			//}
			//$sql = $this->db->query("insert into po_out (kode,tgl,supplier,status
			//)VALUES ('$hasil[nopo]','$hasil[tanggal]','$hasil[sp]','Open')");
			
			
			
			$idnya=mysql_insert_id();
			//$barangnya=$hasil['barang'];
			}
			
			$na = $this->input->post('jumlah');
			$b = $this->input->post('barang');
			$harga = $this->input->post('harga');
			$tanggal=date('d/m/Y');
			$jam=date('H:i');
			for($i=0; $i< count($b); $i++){
				$total2[$i] = $harga[$i]*$na[$i];
			$sql2 = $this->db->query("insert into po_barang (nama,kode_barang,jumlah_barang,total,harga,tanggal)VALUES
			                                                ('$b[$i]','$idnya','$na[$i]','$na[$i]','$harga[$i]','$tanggal')");
			$sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			VALUES ('$na[$i]','$user','$tanggal $jam','Insert&nbsp;$b[$i]&nbsp;','$hasil[nopo]')");
			
			$beli = $this->db->query("insert into pembelian (total,barang,kode_finance,dari,ket,jumlah,status,tanggal,tgl)
			VALUES ('$total2[$i]','$b[$i]','$idnya','Po OUT','$hasil[nopo]','$na[$i]','Tempo','$tanggal',NOW())");
			}
				
			
			redirect('purchase/out/'.$user."/".$pass);
		 }
		
	}
	
	public function out_edit($id,$user, $pass)
	{
		$n = $this->input->post('par');
		$data['id'] = $id;
		$data['pass'] = $pass;
		$data['user'] = $user;
		 if(empty($n)){
			 $data['main_view'] = 'po/v_out_edit';
		     $this->load->view('grand_template',$data);
		
		 }else{
		  /*  $data_form = @$_POST['vol'];
		    foreach($data_form as $key=>$hasil){
			
			$sql = $this->db->query("UPDATE po_out SET  
			tgl='$hasil[tanggal]',
			supplier='$hasil[sp]'
			where id_out='$id'
			");	
			
			$nama = $this->input->post('nama');
			$jumlah = $this->input->post('jumlah');
			$kirim = $this->input->post('kirim');
			$total = $this->input->post('total');
			$harga = $this->input->post('harga');
			$kode = $this->input->post('kode');
	        print_r ($kirim);
			for($a=0; $a< count($kode); $a++){
			$sql1 = $this->db->query("UPDATE po_barang SET  
			nama='$nama[$a]',
			jumlah_barang='$jumlah[$a]',
			harga='$harga[$a]',
			total='$total[$a]',
			kirim='$kirim[$a]'
			where id_barang='$kode[$a]'
			");
			$tanggal=date('d/m/Y H:i');
			$no_po=mysql_query("SELECT * FROM po_out where id_out='$id'");
            $hs=mysql_fetch_array($no_po);
			$sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			VALUES ('$jumlah[$a]','$user','$tanggal','Edit&nbsp;$nama[$a]','$hs[kode]')");
			}
			
			$nama2 = $this->input->post('barang2');
			$jumlah2 = $this->input->post('jumlah2');
			$harga2 = $this->input->post('harga2');
			$id2 = $this->input->post('id2');
			$tambah = $this->input->post('tambah');
			
			
			if(isset($_POST['tambah'])){
			  $tanggal=date('d/m/Y');
			  for($i=0; $i< count($nama2); $i++){
				  $sql2 = $this->db->query("insert into po_barang (total,nama,kode_barang,jumlah_barang,harga,tanggal)VALUES
			                                                ('$jumlah2[$i]','$nama2[$i]','$id','$jumlah2[$i]','$harga2[$i]','$tanggal')");
															
			$beli = $this->db->query("insert into pembelian (total,barang,kode_finance,dari,ket,jumlah,status,tanggal,tgl)
			VALUES ('$na[$i]','$nama2[$i]','$','PO OUT','$hs[nopo]','$jumlah2[$i]','Tempo','$tanggal',NOW())");
															
			$sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			VALUES ('$jumlah2[$i]','$user','$tanggal','Insert&nbsp;$nama2[$i]','$id')");
			  }
			}
		  }
			*/
			
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
		$n = $this->input->post('par');
	    $yard = $this->input->post('yard');
			$harga = $this->input->post('harga');
			$total = $this->input->post('thirdBox');
			$toko = $this->input->post('standard');
		    $data_form = @$_POST['vol'];
		    foreach($data_form as $key=>$hasil){
		   // $sup=mysql_query("SELECT * FROM supplier where nama='$hasil[sp]'");
            //$sp=mysql_fetch_array($sup);
			//if(empty($sp['nama'])){
			//$supplier = $this->db->query("insert into supplier (nama)VALUES ('$hasil[sp]')");
			//}
			$sql = $this->db->query("UPDATE po_out SET 
			kode='$hasil[nopo]',
			tgl='$hasil[tanggal]',
			barang='$hasil[jenis]',
			jumlah='$yard',
			sisa_out='$yard',
			harga_satuan='$harga',
			supplier='$toko',
			total='$total'
			where id_out='$id'
			");
			 
			 $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			VALUES ('$total','$user','$hasil[tanggal]','Edit Pembelian Bahan&nbsp;$hasil[jenis]&nbsp;','$hasil[nopo]')");
			$awal=$hasil['tanggal'];
								$bln_awal = substr("$awal",3,2);
								$tgl_awal = substr("$awal",0,2);
								$thn_awal = substr("$awal",6,4);
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
								$tanggal_s=$thn_awal."-".$bln_awal."-".$tgl_awal;
				$beli = $this->db->query("UPDATE pembelian SET 
				total='$total',barang='$hasil[jenis]',jumlah='$yard',tgl='$tanggal_s',tanggal='$tanggal_list' where kode_finance='$id' ");
			}
			redirect('purchase/out/'.$user."/".$pass);
		 }
	}
	
	 public function out_kirim($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		     $kirim = $this->input->post('kirim');
			 $total = $this->input->post('total');
		     $id = $this->input->post('id');
		     $ket = $this->input->post('ket');
			 $tanggal=date('d/m/Y H:i');
			 $validasi=$total-$kirim;
			  if($validasi < 0){
				  
				echo "<script>alert('Maaf Jumlah Kirim melebihi');</script>";
	            echo "<meta http-equiv=refresh content=0;url=../../../purchase/out/$user/$pass>";
			  }else{
			 $sql = $this->db->query("insert into history_out (jml_kirim,kode_out,tanggal,keterangan
			)VALUES ('$kirim','$id','$tanggal','$ket')");
			
			$bs=mysql_query("SELECT * FROM po_barang where id_barang='$id'");
            $s=mysql_fetch_array($bs);
									
			 $totalnya=$s['total']-$kirim;
			 $kiriman=$s['kirim']+$kirim;
			 
				if($totalnya == 0){
					$status='Close';
				}else{
					$status='Open';
				}
			
			 $sql2 = $this->db->query("UPDATE po_barang SET status='$status',
			 kirim='$kiriman',
			 total='$totalnya'
			 where id_barang='$id'");
			 
			 $no_po=mysql_query("SELECT * FROM po_out where id_out='$s[kode_barang]'");
             $hs=mysql_fetch_array($no_po);
			
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$kiriman','$user','$tanggal','kirim&nbsp;Po Out&nbsp;$s[nama]','$hs[kode]')");
			  }
		echo "<meta http-equiv=refresh content=0;url=../../../purchase/out/$user/$pass>";
		
	}
	
	public function out_datang($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $kirim = $this->input->post('kirim');
		 $id = $this->input->post('id');
		 $po = $this->input->post('po');
		 $total = $this->input->post('total');
		 $nama = $this->input->post('nama');
		 $po = $this->input->post('po');
		 $tanggal=date('d/m/Y');
		 $validasi=$total-$kirim;
		 
			  if($validasi < 0){
				  echo "<script>alert('Maaf Jumlah Barang datang melebihi Sisa Kirim');</script>";
	              echo "<meta http-equiv=refresh content=0;url=../../../purchase/out/$user/$pass>";
			  }else{
				   $bs=mysql_query("SELECT * FROM po_out where id_out='$id'");
                   $s=mysql_fetch_array($bs);
				   $kiriman=$s['kirim']+$kirim;
				   $sisa=$s['sisa_out']-$kirim;
				   if($sisa == 0){
					   $status='Close';
				     }else{
					   $status='Open';
				     }
				   $sql = $this->db->query("UPDATE po_out SET
				                               kirim='$kiriman',
											   status='$status',
											   sisa_out='$sisa'
											   where id_out='$id'
				                              ");
				   $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			       VALUES ('$kiriman','$user','$tanggal','Barang Datang&nbsp;Po Out&nbsp;$nama','$po')");
				   
				    $sql = $this->db->query("insert into history_out
					 (jml_kirim,kode_out,tanggal,keterangan)
					 VALUES 
					 ('$kiriman','$id','$tanggal','Sisa $sisa')");
		      }
		echo "<meta http-equiv=refresh content=0;url=../../../purchase/out/$user/$pass>";
	}
	
	public function out_barang($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $kirim = $this->input->post('kirim');
		 $id = $this->input->post('id');
		 $total = $this->input->post('total');
		 $nama = $this->input->post('nama');
		 $po = $this->input->post('po');
		 $tanggal=date('d/m/Y');
		 $validasi=$total-$kirim;
		
			  if($validasi < 0){
				  echo "<script>alert('Maaf Jumlah Barang datang melebihi Sisa Kirim');</script>";
	              echo "<meta http-equiv=refresh content=0;url=../../../purchase/out/$user/$pass>";
			  }else{
				   $bs=mysql_query("SELECT * FROM po_out where id_out='$id'");
                   $s=mysql_fetch_array($bs);
				   $kiriman=$s['kirim']-$kirim;
				   $sql1 = $this->db->query("UPDATE po_out SET
				                               kirim='$kiriman'
											   where id_out='$id'
				                              ");
				   $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			       VALUES ('$kiriman','$user','$tanggal','Pembagian barang Barang &nbsp;Po Out&nbsp;$nama','$po')");
				   
				   
				    $sql2 = $this->db->query("insert into po_barang
					 (po,kode_barang,nama,jumlah_barang,total,status,tanggal,tgl)
					 VALUES 
					 ('$po','$id','$nama','$kirim','$kirim','Barang Datang','$tanggal',NOW())");
					 echo $kiriman;
					 $sqlnya = $this->db->query("insert into history_out
					 (kode_out,jml_kirim,Keterangan,tanggal)
					 VALUES 
					 ('$id','$kiriman','$kirim','$tanggal')");
		      }
		echo "<meta http-equiv=refresh content=0;url=../../../purchase/out/$user/$pass>";
	}
	 public function out_retur($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		     $kirim = $this->input->post('kirim');
			  $harga = $this->input->post('harga');
			 $id_retur = $this->input->post('id_retur');
		     $id = $this->input->post('id');
		        $total = $this->input->post('total');
			 $tanggal=date('d/m/Y H:i');
			 $bs=mysql_query("SELECT * FROM po_barang where id_barang='$id_retur'");
             $s=mysql_fetch_array($bs);
				$jm=$s['jumlah_barang'];		
				//$harga=$s['harga']-$harga;			
	        
			 $kiriman=$jm-$kirim;
			if($kiriman > $total){
				
			    echo "<script>alert('Maaf Jumlah Retur melebihi');</script>";
	            echo "<meta http-equiv=refresh content=0;url=../../../purchase/out/$user/$pass>";
				
			}else{
			// $sql2 = $this->db->query("UPDATE po_barang SET status='$status',
			 //jumlah_barang='$kiriman',
			// total='$kiriman',
			 //harga='$harga'
			// where id_barang='$id_retur'");
			 
			 $no_po=mysql_query("SELECT * FROM po_out where id_out='$id'");
             $hs=mysql_fetch_array($no_po);
			 
			 $beli=mysql_query("SELECT * FROM pembelian where kode_finance='$id'");
             $b=mysql_fetch_array($beli);
			 
			 $h=$harga*$kirim;
			 $harganya=$b['jumlah']-$h;
			 $harganya2=$b['total']-$h;
			 
			 $pbl = $this->db->query("UPDATE pembelian SET jumlah='$harganya',
			 total='$harganya'
			 where kode_finance='$id'");
			 
			 $jml_out=$hs['jumlah']-$kirim;
			 $sisa_out=$hs['sisa_out']-$kirim;
			 
			 $tt_out=$hs['total']-$h;
			 echo $tt_out."<hr>";
			  echo $harga."<hr>";
			$ot = $this->db->query("UPDATE po_out SET jumlah='$jml_out',
			 kirim='$jml_out',
		     sisa_out='$sisa_out',
			 total='$tt_out'
		     where id_out='$id'");
			 
			 
			  $retur = $this->db->query("insert into retur (kode_retur,nama,tgl_retur,jumlah,total)
			  VALUES ('$id_retur','$s[nama]','$tanggal','$kirim','$kirim')");
			 
			 
			
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$kiriman','$user','$tanggal','Retur&nbsp;Po Out&nbsp;$s[nama]','$hs[kode]')");
			  }
echo "<meta http-equiv=refresh content=0;url=../../../purchase/out/$user/$pass>";
	}
	
	public function retur_kembali($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		     $kirim = $this->input->post('kirim');
		     $id = $this->input->post('id');
			 $jumlah = $this->input->post('jumlah');
			 
			  $rt=mysql_query("SELECT * FROM retur  where id_retur='$id'");
                $r=mysql_fetch_array($rt);
			    $retur_jumlah=$r['jumlah']-$kirim;	
		    
			 $tanggal=date('d/m/Y H:i');
			 $bs=mysql_query("SELECT * FROM po_barang where id_barang='$r[kode_retur]'");
             $s=mysql_fetch_array($bs);
		     $jm=$s['jumlah_barang'];					
             $total_barang=$jm+$kirim;
			
			 $total=$jumlah-$kirim;
			 if($total == 0){
				 
			    $sql = $this->db->query("DELETE FROM retur
			     where id_retur='$id'");
				 echo "delete";
			 }else{
				 
			     echo "update";
				 
			   $sql_retur = $this->db->query("UPDATE retur SET jumlah='$retur_jumlah',
			                                 sisa='$kirim',
										 tgl_kembali='$tanggal'
			                                where id_retur='$id'"); 
				 
			 }
			 
		 $sql2 = $this->db->query("UPDATE po_barang SET
			 jumlah_barang='$total_barang'
			 where id_barang='$r[kode_retur]'");
			 
			  
			 
			 $no_po=mysql_query("SELECT * FROM po_out where id_out='$s[kode_barang]'");
             $hs=mysql_fetch_array($no_po);
			
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$kirim','$user','$tanggal','Retur&nbsp;Po Out&nbsp;$s[nama]','$hs[kode]')");
			
		redirect('purchase/masuk/'.$user."/".$pass);
	}
	
   public function out_delete($id,$user, $pass)
	{
		$data['id']=$id;
		$data['pass'] = $pass;
		$data['user'] = $user;
		$tanggal=date('d/m/Y');
		
		
		
		$no_b=mysql_query("SELECT * FROM  po_barang where id_barang='$id'");
        $b=mysql_fetch_array($no_b);
		$jml=$b['jumlah_barang'];
		
		$no_po=mysql_query("SELECT * FROM po_out where id_out='$b[kode_barang]'");
        $hs=mysql_fetch_array($no_po);
		$jumlahnya=$hs['kirim']+$jml;
		$sql_out = $this->db->query("UPDATE po_out SET
		                            kirim='$jumlahnya',
									sisa_out='$jumlahnya',
									status='Close'
		                             where id_out='$b[kode_barang]'
									 ");
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket)
			  VALUES ('$kiriman','$user','$tanggal','Delete&nbsp;Po Out&nbsp;$s[nama]&nbsp;No PO&nbsp;$hs[kode]')");

		$sql21 = $this->db->query("DELETE FROM po_barang where id_barang='$id'");
		$sql22 = $this->db->query("DELETE FROM potong where kode_potong='$id'");
		;
		redirect('purchase/out/'.$user."/".$pass);
	}
	
	public function poout_delete($id,$user, $pass)
	{
		$data['id']=$id;
		$data['pass'] = $pass;
		$data['user'] = $user;
		$tanggal=date('d/m/Y');

		
		$no_po=mysql_query("SELECT * FROM po_out where id_out='$id'");
        $hs=mysql_fetch_array($no_po);
	
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket)
			  VALUES ('$hs[jumlah]','$user','$tanggal','Delete&nbsp;Po Out&nbsp;$hs[nama]&nbsp;No PO&nbsp;$hs[kode]')");

		$sql2 = $this->db->query("DELETE FROM po_out where id_out='$id'");
		$sql2 = $this->db->query("DELETE FROM history_out where kode_out='$id'");
		$sql23 = $this->db->query("DELETE FROM pembelian where kode_finance='$id' and dept='Belanja'");
		redirect('purchase/out/'.$user."/".$pass);
	}
	
	public function masuk($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'po/v_retur';
		 $this->load->view('grand_template',$data);	
	}
	
	public function stock_bahan($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'po/v_stock_bahan';
		 $this->load->view('grand_template',$data);	
	}
	
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */