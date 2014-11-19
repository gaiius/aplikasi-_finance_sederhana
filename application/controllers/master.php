<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller {
	public function index()
	{
		$this->load->model('m_progres');
                 $data['progres'] = $this->m_progres->get_search();
		 $data['main_view'] = 'progres/v_progres';
		$this->load->view('grand_template',$data);
	}
	public function supplier($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'master/v_supplier';
		 $this->load->view('grand_template',$data);
		
	}
	public function supplier_edit($id,$user,$pass)
	{
		$data['id'] = $id;
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['main_view'] = 'master/v_supplier_edit';
		$this->load->view('grand_template',$data);
		
	}
	
	public function insert_toko($user,$pass)
	{
	
		$data['pass'] = $pass;
		$data['user'] = $user;

		$hasil=@$_POST['vol'];
		print_r ($hasil);
		foreach($hasil as $key=>$val){
	    $sql = $this->db->query("INSERT INTO supplier (nama,alamat,telp,mail,url,dept_toko)VALUES
		('$val[nama]','$val[alamat]','$val[telp]','$val[mail]','$val[url]','$val[dept]')
		");		
			
		}
	  redirect('master/supplier/'.$user.'/'.$pass);
		
	}
	
		public function insert_customer($user,$pass)
	{
	
		$data['pass'] = $pass;
		$data['user'] = $user;

		$hasil=@$_POST['vol'];
		print_r ($hasil);
		foreach($hasil as $key=>$val){
	    $sql = $this->db->query("INSERT INTO customer (nama,alamat,telp,email,url)VALUES('$val[nama]','$val[alamat]','$val[telp]','$val[mail]','$val[url]')
		");		
			
		}
	  redirect('master/cutomer/'.$user.'/'.$pass);
		
	}
	
	public function update_supplier($id,$user,$pass)
	{
		$data['id'] = $id;
		$data['pass'] = $pass;
		$data['user'] = $user;

		$hasil=@$_POST['vol'];
		print_r ($hasil);
		foreach($hasil as $key=>$dapet){
	    $sql = $this->db->query("UPDATE supplier SET
		alamat='$dapet[alamat]',
		telp='$dapet[telp]',
		mail='$dapet[mail]',
		url='$dapet[url]',
		dept_toko='$dapet[dept]'
		where id_supplier='$id'
		");		
			
		}
	  redirect('master/supplier/'.$user.'/'.$pass);
		
	}
	 public function supplier_delete($id,$user, $pass)
	{
	
		$data['id']=$id;
		$data['user'] = $user;
		$data['pass'] = $pass;
		$tanggal=date('d/m/Y');
	
		$no_po=mysql_query("SELECT * FROM supplier where id_supplier='$id'");
        $hs=mysql_fetch_array($no_po);
	
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$hs[jumlah]','$user','$tanggal','Delete&nbsp;Supplier&nbsp;','$hs[nama]')");
			  
			  $sql = $this->db->query("DELETE FROM supplier where id_supplier='$id'");
		redirect('master/supplier/'.$user.'/'.$pass);
	}
	public function cutomer($user,$pass)
	{
		
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['main_view'] = 'master/v_customer';
		$this->load->view('grand_template',$data);
		
	}
	
	public function edit_customer($user,$pass)
	{
		
		$data['pass'] = $pass;
		$data['user'] = $user;

		$hasil=@$_POST['vol'];
		print_r ($hasil);
		foreach($hasil as $key=>$dapet){
	    $sql = $this->db->query("UPDATE customer SET
		alamat='$dapet[alamat]',
		telp='$dapet[telp]',
		email='$dapet[mail]',
		url='$dapet[url]'
		where id_customer='$dapet[id]'
		");		
			
		}
	  redirect('master/cutomer/'.$user.'/'.$pass);
		
	}
	
	 public function customer_delete($id,$user, $pass)
	{
	
		$data['id']=$id;
		$data['user'] = $user;
		$data['pass'] = $pass;
		$tanggal=date('d/m/Y');
	
		$no_po=mysql_query("SELECT * FROM customer where id_customer='$id'");
        $hs=mysql_fetch_array($no_po);
	
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$hs[jumlah]','$user','$tanggal','Delete&nbsp;Supplier&nbsp;','$hs[nama]')");
			  
			  $sql = $this->db->query("DELETE FROM customer where id_customer='$id'");
		redirect('master/cutomer/'.$user.'/'.$pass);
	}
	
	public function kas($user,$pass)
	{
		
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['main_view'] = 'master/v_kas';
		$this->load->view('grand_template',$data);
		
	}
	public function insert_kas($user,$pass)
	{
	
		$data['pass'] = $pass;
		$data['user'] = $user;

		$hasil=@$_POST['vol'];
		$tanggal=date('d/m/Y');
		
		foreach($hasil as $key=>$val){
			$total=$val['harga']*$val['jumlah'];
	    $sql = $this->db->query("INSERT INTO kas_kecil (nota,nama,jumlah,harga,total_harga,keterangan,tanggal,tgl)VALUES
		('$val[nota]','$val[nama]','$val[jumlah]','$val[harga]','$total','$val[ket]','$tanggal',NOW())
		");	$idnya=mysql_insert_id();	
		
		$beli = $this->db->query("insert into pembelian (dept,total,barang,kode_finance,dari,ket,jumlah,status,tanggal,tgl)
			VALUES ('Kas','$total','$val[nama]','$idnya','Biaya Lain-lain','0','$total','Tempo','$tanggal',NOW())");
			
			$sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$val[jumlah]','$user','$tanggal','Biaya Lain-lain&nbsp;Item&nbsp;$val[nama]','$val[nota]')");
			
		}
	  redirect('master/kas/'.$user.'/'.$pass);
		
	}
	
	public function edit_kas($user,$pass)
	{
	
		$data['pass'] = $pass;
		$data['user'] = $user;

		$hasil=@$_POST['vol'];
		
		
		foreach($hasil as $key=>$val){
			
			                    $awal=$val['tanggal'];
				                $awal_pecah = '/[\/]/';
		                        $hasil_awal =  preg_replace($awal_pecah,'-', $awal);
								//--------Hasil regex------------------------------
								$tgl_awal = substr("$hasil_awal",0,2);
								$bln_awal = substr("$hasil_awal",3,2);
								$thn_awal = substr("$hasil_awal",6,4);
								$awal_list=$thn_awal."-".$bln_awal."-".$tgl_awal;
								
						echo $awal_list."<hr>";	
						echo $val['tanggal']."<hr>";	
						
		$total=$val['harga']*$val['jumlah'];
	    $sql = $this->db->query("UPDATE kas_kecil SET nama='$val[nama]',
		jumlah='$val[jumlah]',
		harga='$val[harga]',
		total_harga='$total',
		nota='$val[tanggal]',
		tanggal='$val[nota]',
		tgl='$awal_list',
		keterangan='$val[ket]'
		where id_kas='$val[id]'
		");	
		
			$sql2 = $this->db->query("UPDATE pembelian SET tgl='$awal_list',
			total='$total',
			jumlah='$val[jumlah]'
			 where kode_finance='$val[id]'");	
			 
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$val[jumlah]','$user','$tanggal','Edit Biaya Lain-lain&nbsp;Item&nbsp;$val[nama]','$val[nota]')");
		}
  redirect('master/kas/'.$user.'/'.$pass);
		
	}
	
	 public function kas_delete($id,$user, $pass)
	{
	
		$data['id']=$id;
		$data['user'] = $user;
		$data['pass'] = $pass;
		$tanggal=date('d/m/Y');
	
		$no_po=mysql_query("SELECT * FROM kas_kecil where id_kas='$id'");
        $hs=mysql_fetch_array($no_po);
	
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$hs[jumlah]','$user','$tanggal','Delete&nbsp;Biaya Lain2&nbsp;','$hs[nama]')");
			  
			  $sql = $this->db->query("DELETE FROM kas_kecil where id_kas='$id'");
		redirect('master/kas/'.$user.'/'.$pass);
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */