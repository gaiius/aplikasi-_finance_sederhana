<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Progres extends CI_Controller {
	public function index()
	{
		$this->load->model('m_progres');
                 $data['progres'] = $this->m_progres->get_search();
		 $data['main_view'] = 'progres/v_progres';
		$this->load->view('grand_template',$data);
	}
	public function potong($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$this->load->model('m_progres');
		 $data['pview'] = $this->m_progres->potong();
		 $data['main_view'] = 'progres/v_potong';
		 $this->load->view('grand_template',$data);
		
	}
	
	public function add_potong($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		
		 
		 $data['main_view'] = 'progres/v_add_potong';
		 $this->load->view('template_blank',$data);
		
	}
	public function potongan_kembali($id,$user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
		 $jml = $this->input->post('standart');
		 $data['main_view'] = 'progres/v_potongan_kembali';
		$this->load->view('grand_template',$data);
		
	}
	public function potong_edit($id,$user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
		 $data['main_view'] = 'progres/v_edit_potong';
		 $this->load->view('grand_template',$data);
		
	}
	
  public function loaddata_po()
	{
	
		 	  if (isset($_GET['input']))
	{
		$input = $this->input->get('input');
		echo "<h2 align=center>Quick Seach</h2>";
		$query = mysql_query("SELECT distinct po FROM po_barang WHERE po LIKE '%$input%' AND status='Barang Datang'"); //query mencari hasil search
		$hasil1 = mysql_num_rows($query);
		if ($hasil1 > 0)
		{
			while ($data = mysql_fetch_row($query))
			{
				?>
				<a class="cari" href="javascript:autoInsert1('<?=$data[0]?>');"><?=$data[0]?><hr /><BR> <!-- hasil search -->
				<?php
			}
		}
		else
		{
			echo "Data tidak ditemukan";
		}
	
	}
	}
	
	public function loaddata_poout()
	{
	
		 $data['main_view'] = 'progres/v_cari_po';
		 $this->load->view('template_blank',$data);
	}
  public function potong_delete($id,$user, $pass)
	{
	
		$data['id']=$id;
		$data['user'] = $user;
		$data['pass'] = $pass;
		
	
		$tanggal=date('d/m/Y');
		$po=mysql_query("SELECT * FROM potong where id_potong='$id'");
        $p=mysql_fetch_array($po);
		
		$no_po=mysql_query("SELECT * FROM po_barang where id_barang='$p[kode_potong]'");
        $hs=mysql_fetch_array($no_po);
		$sql_barang = $this->db->query("UPDATE po_barang SET 
		                              status='Barang Datang'
								  where id_barang='$p[kode_potong]'");
		
	
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('0','$user','$tanggal','Delete&nbsp;Potong&nbsp;','$hs[kode]')");
	    $sql = $this->db->query("DELETE FROM potong where id_potong='$id'");
		redirect('progres/potong/'.$user."/".$pass);
	}
	
	public function insert_potong($user, $pass)
	{	
	 $data['pass'] = $pass;
	 $data['user'] = $user;
     $kain = $this->input->post('kain');
	 $id = $this->input->post('id');
	 $tanggal=date('d/m/Y');
	 $acak	  = rand(000,999);
		
	 $ambil2=mysql_query("SELECT * FROM po_barang where po='$kain' AND status='Barang Datang' AND total >0");
     while ($dapet2=mysql_fetch_array($ambil2)){
     
	
	     $sql2 = $this->db->query("insert into potong (jumlah_total,status,no_po,barang_potong,kode_potong,jumlah,tgl)VALUES
		('$dapet2[jumlah_barang]','Stock Tersedia','$dapet2[po]','$dapet2[nama]','$dapet2[id_barang]','$dapet2[jumlah_barang]',NOW())");
														 
		 $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$dapet2[jumlah_barang]','$user','$tanggal','Kirim Ke stock &nbsp;potong&nbsp;$dapet2[nama]&nbsp;No PO&nbsp;$kain','$kain')");
			
			 
			  $sql = $this->db->query("UPDATE po_barang SET
				                               status='Sudah di Potong'
											   where po='$kain' AND status='Barang Datang'
											   
				                              ");
	 }
	 
	 redirect('progres/potong/'.$user."/".$pass);
	}
	
	public function potong_kirim($user,$pass)
	{	
	 $data['pass'] = $pass;
	 $data['user'] = $user;
	 $tanggal = $this->input->post('tanggal');
	                            $awal=$tanggal;
								$bln_awal = substr("$awal",5,2);
								$tgl_awal = substr("$awal",8,2);
								$thn_awal = substr("$awal",0,4);
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
								
     $kirim = $this->input->post('kirim');

	 $invoice = $this->input->post('invoice');
	 $ket = $this->input->post('standard');
	 $po = $this->input->post('po');
	 $id = $this->input->post('id');
	 $nama = $this->input->post('nama');
	 $biaya = $this->input->post('biaya');
	 $jt = $this->input->post('jt');
	 $alhasil=$jt-$kirim;
	  $sql2 = $this->db->query("UPDATE potong set 
	
	  invoice='$invoice',
	  ket='$ket',
	  jumlah_total='$alhasil',
	  status='Kirim Ke Toko',
	  tanggal='$tanggal_list',
	  ket='$ket'
	  where id_potong='$id' ");	
	  
	  $sql_hist = $this->db->query("insert into history_potong
	   (kode_ptk,toko_ptk,kirim_ptk,tanggal,kode_pbarang,stt)VALUES
	  ('$id','$ket','$kirim','$tanggal_list','$nama','Keluar')");
	  
	   $jumlah_kirim=$kirim."&nbsp;PCS".$lusin."&nbsp;Lusin";
		 $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
		VALUES ('$kirim','$user','$tanggal_list','Kirim Kain&nbsp;Ke toko potong&nbsp;$nama','$po')");
	 redirect('progres/potong/'.$user."/".$pass);
	}
	
	
	public function potong_kembali($user,$pass)
	{	
	 $data['pass'] = $pass;
	 $data['user'] = $user;
	 $tgl = $this->input->post('tanggal_kembali');
	  $awal=$tgl;
								$bln_awal = substr("$awal",5,2);
								$tgl_awal = substr("$awal",8,2);
								$thn_awal = substr("$awal",0,4);
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
								$tanggal_s=$thn_awal."-".$bln_awal."-".$tgl_awal;
								
     $kirim = $this->input->post('kirim');
	 $total_hasil = $this->input->post('lusin');
	 $pcs = $this->input->post('pcs');
	 $model = $this->input->post('model');
	 $pakai = $this->input->post('pakai');
	 $invoice = $this->input->post('invoice');
	 $ket = $this->input->post('keterangan');
	 $po = $this->input->post('po');
	 $id = $this->input->post('id');
	 $nama = $this->input->post('nama');
	 $biaya = $this->input->post('biaya');
	  $total = $this->input->post('total');
	    $id_history = $this->input->post('standard');
	
		$sentence = $id_history; //Kalimatnya
$value = "1";//Berapa kata yang ingin diambil
$ls = implode("-", array_slice(explode("-", $sentence), 0, $value));

$regek = '/^([0-9-])+([-])/';
$hasil2 =  preg_replace($regek,' ', $id_history);

$up3=mysql_query("SELECT * FROM history_potong where id_ptk='$ls'");
$p3=mysql_fetch_array($up3);
 $sql2 = $this->db->query("UPDATE history_potong  set status='1' where id_ptk='$ls'");

	 $sql2 = $this->db->query("UPDATE potong set kirim='$kirim',
	  lusin='$total_hasil',
	  pcs='$pcs',
	   total='$total',
	  model='$model',
	  pakai='$pakai',
	  invoice='$invoice',
	  biaya='$biaya',
	  status='Potong Selesai',
	  tgl_kembali='$tanggal_list'
	  where id_potong='$id' ");
	  
	  $sql_hist = $this->db->query("insert into history_potong
	   (invoice_ptk,harga_satuan,total_ptk,jumlah_ptk,pcs_ptk,lusin_ptk,pakai_ptk,model_ptk,kode_ptk,toko_ptk,kirim_ptk,tanggal,kode_pbarang,stt,kode_keluar)
	   VALUES
	  ('$invoice','$biaya','$total','$kirim','$pcs','$total_hasil','$pakai','$model','$id','$p3[toko_ptk]','$hasil2','$tanggal_list','$nama','Kembali','$ls')");
	  $idnya=mysql_insert_id();
	  	
	   $jumlah_kirim=$kirim."&nbsp;PCS".$lusin."&nbsp;Lusin";
		 $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$total','$user','$tanggal_list','Potong&nbsp;Kain&nbsp;$nama Kembali','$po')");
			
			$jahit = $this->db->query("insert into jahit (kode_jahit,barang_jahit,po_jahit,jumlah,total,status)
			VALUES ('$idnya','$model','$po','$pcs','$pcs','Gudang')");
			
			$beli = $this->db->query("insert into pembelian (dept,total,barang,kode_finance,dari,ket,jumlah,status,tanggal,tgl)
			VALUES ('Potong','$total','$model','$idnya','Biaya Potong Kain $kirim Yard','$po','$total','Tempo','$tanggal_list','$tanggal_s')");
	
	 redirect('progres/potong/'.$user."/".$pass);
	}
	
		public function del_ptk($id,$ptk,$user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
		$data['ptk'] = $ptk;
		$tanggal=date('j/m/y');
		$ln=mysql_query("SELECT * FROM potong where id_potong='$id'");
        $dr=mysql_fetch_array($ln);
		
		
		$ly1=mysql_query("SELECT * FROM history_potong where id_ptk='$ptk'");
        $jy=mysql_fetch_array($ly1);
		$jml_ly=$jy['kirim_ptk'];
		echo $dr['jumlah_total'];
		$jml_l=$dr['jumlah_total']+$jml_ly;
		//$kirimnya=$dr['kirim_keluar']-$jml_ly;
		
		$sql = $this->db->query("UPDATE potong SET jumlah_total='$jml_l' where id_potong='$id' ");
		$sql_del44 = $this->db->query("DELETE FROM history_potong where id_ptk='$ptk' ");
		
		$sql_del2 = $this->db->query("DELETE FROM history_potong where kode_keluar='$ptk' ");
		
		$sql_del = $this->db->query("DELETE FROM pembelian where kode_finance='$jy[kode_keluar]' ");
		$sql3 = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$kirim','$user','$tanggal','DEl &nbsp;Barang Keluar Laundry&nbsp;$dr[nama_laundry]','$dr[invoice]')");
			
		redirect('progres/potong/'.$user."/".$pass);
	}
	
		public function del_pty($id,$ptk,$user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
		$data['ptk'] = $ptk;
		$tanggal=date('j/m/y');
		$ln=mysql_query("SELECT * FROM potong where id_potong='$id'");
        $dr=mysql_fetch_array($ln);
		
		
		$ly1=mysql_query("SELECT * FROM history_potong where id_ptk='$ptk'");
        $jy=mysql_fetch_array($ly1);
		$jml_ly=$jy['kirim_ptk'];
		$jml_l=$dr['jumlah_total']+$jml_ly;
	
	     $sql_pty = $this->db->query("UPDATE history_potong set status='0' where id_ptk='$jy[kode_keluar]' ");
		$sql_del = $this->db->query("DELETE FROM history_potong where id_ptk='$ptk' ");
$sql_del44 = $this->db->query("DELETE FROM pembelian where kode_finance='$ptk' ");
		$sql3 = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$kirim','$user','$tanggal','DEl &nbsp;Barang Keluar Laundry&nbsp;$dr[nama_laundry]','$dr[invoice]')");
			
		redirect('progres/potong/'.$user."/".$pass);
	}
	
	public function upgrade_potong($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$standard = $this->input->post('standard');
		    $kirim = $this->input->post('kirim');
			$jumlah = $this->input->post('jumlah');
	 $total_hasil = $this->input->post('lusin');
	 $toko = $this->input->post('standard');
	 $pcs = $this->input->post('pcs');
	 $model = $this->input->post('model');
	 $pakai = $this->input->post('pakai');
	 $ket = $this->input->post('keterangan');
	 $po = $this->input->post('po');
	 $id = $this->input->post('id');
	 $nama = $this->input->post('nama');
	 $biaya = $this->input->post('biaya');
	  $total = $this->input->post('total');
		  $data_form = @$_POST['vol'];
		    foreach($data_form as $key=>$hasil){
				
				                $awal=$hasil['tgl_kembali'];
				                $awal_pecah = '/[\/]/';
		                        $hasil_awal =  preg_replace($awal_pecah,'-', $awal);
								//--------Hasil regex------------------------------
								$tgl_awal = substr("$hasil_awal",0,2);
								$bln_awal = substr("$hasil_awal",3,2);
								$thn_awal = substr("$hasil_awal",6,4);
								$awal_list=$thn_awal."-".$bln_awal."-".$tgl_awal;
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
								
							
				
				 $sql1 = $this->db->query("UPDATE potong SET
				                         lusin='$total_hasil',
										    ket='$toko',
										    kirim='$kirim',
	                                        pcs='$pcs',
	                                        total='$total',
	                                        model='$model',
	                                        pakai='$pakai',
	                                        invoice='$hasil[invoice]',
	                                        biaya='$biaya',
	                                        status='Potong Selesai',
											tanggal='$hasil[tanggal]',
	                                        tgl_kembali='$hasil[tgl_kembali]',
										 tgl='$awal_list'
										 where id_potong='$hasil[id]'
										 ");
										 
										// $total=$kirim*$hasil['jumlah'];
			$sql2 = $this->db->query("UPDATE pembelian SET 
			tgl='$awal_list',
			tanggal='$tanggal_list',
			total='$total',
			jumlah='$hasil[jumlah]'
			 where kode_finance='$hasil[id]'");							 
							 
			$sql3 = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$hasil[jumlah]','$user','$tanggal_list','edit&nbsp;potong&nbsp;$hasil[barang]','$hasil[po]')");
			
			}
		
	redirect('progres/potong/'.$user."/".$pass);
		
	}
	public function delete($id) {
        $this->load->model('m_progres');
        $this->m_progres->delete($id);	
      
        }
		
	//--------------------------Jahit---------------------------------------------------------------------
	
   public function jahis($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['main_view'] = 'progres/v_jahit';
		$this->load->view('grand_template',$data);
		
	}
	
	  public function jahit_delete($id,$user, $pass)
	{
	
		$data['id']=$id;
		$data['user'] = $user;
		$data['pass'] = $pass;
		$tanggal=date('d/m/Y ');
	
		$no_po=mysql_query("SELECT * FROM jahit where id_jahit='$id'");
        $hs=mysql_fetch_array($no_po);
	
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$hs[jumlah]','$user','$tanggal','Delete&nbsp;Jahit&nbsp;','$hs[po_jahit]')");
			  
			  $sql = $this->db->query("DELETE FROM jahit where id_jahit='$id'");
		redirect('progres/jahis/'.$user."/".$pass);
	}
	
		public function jahit_kirim($user,$pass)
	{	
	 $data['pass'] = $pass;
	 $data['user'] = $user;
	 $kirim = $this->input->post('kirim');
	 $cek = $this->input->post('cek');
	 if($kirim > $cek){
				 
				  echo "<script>alert('Maaf Jumlah  melebihi Stock');</script>";
	             echo "<meta http-equiv=refresh content=0;url=../../../progres/jahis/$user/$pass>";
				
	  }else{
	 $tanggal = $this->input->post('tanggal');
	
	                            $awal=$tanggal;
								$bln_awal = substr("$awal",5,2);
								$tgl_awal = substr("$awal",8,2);
								$thn_awal = substr("$awal",0,4);
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
     $kirim = $this->input->post('kirim');
	 $po = $this->input->post('po');
	 $id = $this->input->post('id');
	 $nama = $this->input->post('nama');
	 $biaya = $this->input->post('biaya');
	 $ivn = $this->input->post('ivn');
	 $toko = $this->input->post('standard');
	 $jahat=mysql_query("SELECT * FROM jahit where id_jahit='$id'");
     $jh=mysql_fetch_array($jahat);
	 $sisa=$jh['total']-$kirim;
	 $kiriman=$jh['kirim']+$kirim;
	  $sql2 = $this->db->query("UPDATE jahit set kirim='$kiriman',
	  total='$sisa',
	  invoice='$ivn',
	  status='Proses Jahit',
	  toko='$toko',
	  tanggal='$tanggal_list'
	  where id_jahit='$id'");	
	  
	  $sql44 = $this->db->query("insert into history_jahit 
	  (kode_jht,toko_jht,kirim_jht,tanggal,kode_jbarang,status,stt)
			VALUES 
	 ('$id','$toko','$kirim','$tanggal_list','$nama','0','Keluar')");
	
	
	   
		 $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$kirim','$user','$tanggal_list','Kirim Ke toko &nbsp;Jahit&nbsp;$nama','$po')");
			
			
	  }
	  echo "<meta http-equiv=refresh content=0;url=../../../progres/jahis/$user/$pass>";
	}
	 public function jahitan($id,$user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
		$data['main_view'] = 'progres/v_jahitan';
		$this->load->view('grand_template',$data);
		
	}
	public function jahit_kembali($user,$pass)
	{	
	 $data['pass'] = $pass;
	 $data['user'] = $user;
     $tgl = $this->input->post('tanggal_kembali');
	  $awal=$tgl;
								$bln_awal = substr("$awal",5,2);
								$tgl_awal = substr("$awal",8,2);
								$thn_awal = substr("$awal",0,4);
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
								$tanggal_s=$thn_awal."-".$bln_awal."-".$tgl_awal;
	 $po = $this->input->post('po');
	 $id = $this->input->post('id');
	 $nama = $this->input->post('nama');
	 $biaya = $this->input->post('biaya');
	 $kirim = $this->input->post('kirim');
	 $total = $this->input->post('total1');
	  $id_history = $this->input->post('standard');
	
	 $jahat=mysql_query("SELECT * FROM jahit where id_jahit='$id'");
     $jh=mysql_fetch_array($jahat);
	 $sisa=$jh['total']-$kirim;
	 $kiriman=$jh['kirim']+$kirim;
	  $sql2 = $this->db->query("UPDATE jahit set 
	 tgl_kembali='$tanggal_list',
	  status='Selesai',
	  harga='$biaya',
	  total='$total'
	 where id_jahit='$id' ");	
	  
	  		$sentence = $id_history; //Kalimatnya
$value = "1";//Berapa kata yang ingin diambil
$ls = implode("-", array_slice(explode("-", $sentence), 0, $value));

$regek = '/^([0-9-])+([-])/';
$hasil2 =  preg_replace($regek,' ', $id_history);

echo $ls."-".$hasil2;
$j=mysql_query("SELECT * FROM history_jahit  where id_jht='$ls'");
     $jh=mysql_fetch_array($j);
	 
$sql45 = $this->db->query("update history_jahit set status='1' where id_jht='$ls'");
	  
	 $sql44 = $this->db->query("insert into history_jahit 
	  (kirim_jht,kode_jht,toko_jht,biaya_jht,total_jht,tanggal,kode_jbarang,stt,kode_keluar)
			VALUES 
	 ('$kirim','$id','$jh[toko_jht]','$biaya','$total','$tanggal_list','$nama','Kembali','$ls')");
	 $idnya=mysql_insert_id();
	  
	  $beli = $this->db->query("insert into pembelian (dept,total,barang,kode_finance,dari,ket,jumlah,status,tanggal,tgl)
			VALUES ('Jahit','$total','$nama','$idnya','Biaya Jahit Kain','$po','$total','Tempo','$tanggal_list','$tanggal_s')");
			
			$laundry = $this->db->query("insert into laundry (kode_laundry,po_laundry,nama_laundry,jumlah_laundry,total_laundry,total_keluar,sisa_tkeluar,status)
			VALUES ('$idnya','$po','$nama','$kirim','$kirim','$kirim','$kirim','Hasil Jahit')");
	 
	   
		 $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$total','$user','$tanggal_list','Jahit&nbsp;Kain&nbsp;$nama','$po')");
			
			
	
	 redirect('progres/jahis/'.$user."/".$pass);
	}
	
		public function del_jht($id,$jht,$user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
		$data['jht'] = $jht;
		$tanggal=date('j/m/y');
		$ln=mysql_query("SELECT * FROM jahit where id_jahit='$id'");
        $dr=mysql_fetch_array($ln);
		
		
		$ly1=mysql_query("SELECT * FROM history_jahit where id_jht='$jht'");
        $jy=mysql_fetch_array($ly1);
		$jml_ly=$jy['kirim_jht'];
		
		$jml_l=$dr['total']+$jml_ly;
		$kekirim=$dr['kirim']-$jml_ly;
		echo $jht;
		$sql = $this->db->query("UPDATE jahit SET total='$jml_l',kirim='$kekirim' where id_jahit='$id' ");
		$sql_del443 = $this->db->query("DELETE FROM history_jahit where id_jht='$jht' ");
		
		$sql_del2 = $this->db->query("DELETE FROM history_jahit where kode_keluar='$jht' ");
		
		$sql_del = $this->db->query("DELETE FROM pembelian where kode_finance='$jht' ");
		$sql3 = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$jml_ly','$user','$tanggal','DEl &nbsp;Barang Keluar Jhit&nbsp;$dr[barang_jahit]','$dr[invoice]')");
			
		redirect('progres/jahis/'.$user."/".$pass);
	}
	
	 public function edit_jahit($id,$user,$pass)
	{
		$data['id'] = $id;
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['main_view'] = 'progres/v_edit_jahit';
		$this->load->view('grand_template',$data);
		
	}
	
	public function upgrade_jahit($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		
		  $data_form = @$_POST['vol'];
		  $kirim = $this->input->post('kirim');
		  $harga = $this->input->post('harga');
		  $total = $this->input->post('total');
		   $toko = $this->input->post('standard');
		    foreach($data_form as $key=>$hasil){
				
				$awal=$hasil['tgl_kembali'];
				                $awal_pecah = '/[\/]/';
		                        $hasil_awal =  preg_replace($awal_pecah,'-', $awal);
								//--------Hasil regex------------------------------
								$tgl_awal = substr("$hasil_awal",0,2);
								$bln_awal = substr("$hasil_awal",3,2);
								$thn_awal = substr("$hasil_awal",6,4);
								$awal_list=$thn_awal."-".$bln_awal."-".$tgl_awal;
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
								
				 $sql1 = $this->db->query("UPDATE jahit SET
				                         po_jahit='$hasil[po_jahit]',
										 barang_jahit='$hasil[barang_jahit]',
										 jumlah='$hasil[jumlah]',
										 kirim='$kirim',
						                 harga='$harga',
										 total='$total',
										 invoice='$hasil[invoice]',
										 tanggal='$hasil[tanggal]',
										 toko='$toko',
										 tgl_kembali='$hasil[tgl_kembali]'
										 where id_jahit='$hasil[id]'
										 ");
				// $total=$hasil['kirim']*$hasil['jumlah'];
			$sql2 = $this->db->query("UPDATE pembelian SET 
			tgl='$awal_list',
			tanggal='$tanggal_list',
			total='$total',
			jumlah='$hasil[jumlah]'
			 where kode_finance='$hasil[id]'");	
			 								 
			$sql3 = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$hasil[jumlah]','$user','$tanggal_list','edit&nbsp;jahit&nbsp;$hasil[barang_jahit]','$hasil[po_jahit]')");
			}
		
		redirect('progres/jahis/'.$user."/".$pass);
		
	}
//-------------------------------Laundry------------------------------------------------------------------

	
	public function laundry($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['main_view'] = 'progres/v_laundry';
		$this->load->view('grand_template',$data);
		
	}
	
	  public function laundry_delete($id,$user, $pass)
	{
	
		$data['id']=$id;
		$data['user'] = $user;
		$data['pass'] = $pass;
		$tanggal=date('d/m/Y H:i');
	
		$no_po=mysql_query("SELECT * FROM laundry where id_laundry='$id'");
        $hs=mysql_fetch_array($no_po);
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$hs[jumlah_laundry]','$user','$tanggal','Delete&nbsp;Laundry&nbsp;','$hs[po_laundry]')");
			  $sql = $this->db->query("DELETE FROM laundry where id_laundry='$id'");
			  $sql5 = $this->db->query("DELETE FROM history_laundry where id_hl='$id'");
		redirect('progres/laundry/'.$user."/".$pass);
	}
	
	public function laundry_kirim($user,$pass)
	{	
	 $data['pass'] = $pass;
	 $data['user'] = $user;
	 $tanggal = $this->input->post('tanggal');
	
	                            $awal=$tanggal;
								$bln_awal = substr("$awal",5,2);
								$tgl_awal = substr("$awal",8,2);
								$thn_awal = substr("$awal",0,4);
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
   
	 $po = $this->input->post('po');
	 $id = $this->input->post('id');
	 $nama = $this->input->post('nama');
	 $biaya = $this->input->post('biaya');
	 $kirim = $this->input->post('kirim');
	 $invoice = $this->input->post('invoice');
	 $toko = $this->input->post('standard');
	 $warna = $this->input->post('warna');

	 $jahat=mysql_query("SELECT * FROM laundry where id_laundry='$id'");
     $jh=mysql_fetch_array($jahat);
	 $sisa=$jh['sisa_tkeluar']-$kirim;
	 $kiriman=$jh['kirim_keluar']+$kirim;
	 
	 
	  $sql2 = $this->db->query("UPDATE laundry set 
	  tanggal='$tanggal_list',
	  status='Proses Laundry',
	  sisa_tkeluar='$sisa',
	  kirim_keluar='$kiriman',
	  toko='$toko',
	  warna='$warna',
	  invoice='$invoice'
	  where id_laundry='$id' ");	
	  
      $sql_ly = $this->db->query("insert into history_ly 
	  (tanggal,kode_ly,toko_ly,kirim_ly,kode_lbarang)
	  VALUES
	  ('$tanggal_list','$id','$toko','$kirim','$nama')
	  ");
	   
		 $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$kirim','$user','$tanggal_list','Laundry&nbsp;Kain&nbsp;$nama','$po')");
			
			
	
    redirect('progres/laundry/'.$user."/".$pass);
	}
	
	public function laundry_kembali($user,$pass)
	{	
	 $data['pass'] = $pass;
	 $data['user'] = $user;
      $tgl = $this->input->post('tgl');
	  $awal=$tgl;
								$bln_awal = substr("$awal",5,2);
								$tgl_awal = substr("$awal",8,2);
								$thn_awal = substr("$awal",0,4);
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
								$tanggal_s=$thn_awal."-".$bln_awal."-".$tgl_awal;
	 $po = $this->input->post('po');
	 $id = $this->input->post('id');
	 $nama = $this->input->post('nama');
	 $biaya = $this->input->post('biaya');
	 $kirim = $this->input->post('kirim');
	 $invoice = $this->input->post('invoice');
	 $toko = $this->input->post('standard');
	 

	 $warna = $this->input->post('warna');
	 $jt = $this->input->post('jt');
	 $kode_barang = $this->input->post('kode_barang');
	 $total = $biaya*$kirim;
	
	
	 $jahat=mysql_query("SELECT * FROM laundry where id_laundry='$id'");
     $jh=mysql_fetch_array($jahat);
	 $sisa=$jh['total_laundry']-$kirim;
	 $kiriman=$jh['kirim']+$kirim;
	 
	  if($kiriman > $jt){
				 
				  echo "<script>alert('Maaf Jumlah  melebihi');</script>";
	              echo "<meta http-equiv=refresh content=0;url=../../../progres/laundry/$user/$pass>";
				
	  }else{
	 
	 if($sisa == 0){
		 $status="Selesai";
	 }else{
		 $status="Belum Selesai";
	 }
		
	  $ly=mysql_query("SELECT * FROM history_ly where id_ly='$toko'");
      $jy=mysql_fetch_array($ly);
	  $total_ly=$jy['kirim_ly']-$kirim;
	  //echo $total_ly."-".$toko;
	       if($total_ly < 0){
				 
				  echo "<script>alert('Maaf Jumlah  melebihi Barang keluar');</script>";
	              echo "<meta http-equiv=refresh content=0;url=../../../progres/laundry/$user/$pass>";
		   }else{
			   
			    $sql2 = $this->db->query("UPDATE laundry set 
	 tgl_kembali='$tanggal_list',
	  status='$status',
	  biaya='$biaya',
	   total_laundry='$sisa',
	  kirim='$kiriman',
	  warna='$warna',

	 invoice='$invoice'
	 where id_laundry='$id' ");
		$laundry_ly = $this->db->query("UPDATE history_ly SET kirim_ly='$total_ly' where id_ly='$toko' ");	   
		   
	
	  $lh = $this->db->query("insert into history_laundry 
	  (kode_ly2,warna,kode_hl,jumlah,barang,tanggal,kode_barang,biaya,total)
			VALUES ('$toko','$warna','$id','$kirim','$nama','$tanggal_list','$kode_barang','$biaya','$total')");
			
	  $idnya=mysql_insert_id();
	  $beli = $this->db->query("insert into pembelian (dept,total,barang,kode_finance,dari,ket,jumlah,status,tanggal,tgl)
			VALUES ('Laundry','$total','$nama','$idnya','Biaya Laundry Kain','$po','$total','Tempo','$tanggal_list','$tanggal_s')");
			
			$laundry = $this->db->query("insert into finishing (warna,kode_finis,po_finis,nama_finis,jumlah_finis,total_finis,status,invoice)
			VALUES ('$warna','$id','$po','$nama','$kirim','$kirim','Hasil Laundry','$invoice')");
	 
	   
		 $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$kirim','$user','$tanggal_list','Laundry&nbsp;Kain&nbsp;$nama','$po')");
			
			}
	  }
 echo "<meta http-equiv=refresh content=0;url=../../../progres/laundry/$user/$pass>";
	}
	public function edit_laundry($id,$user,$pass)
	{
		$data['id'] = $id;
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['main_view'] = 'progres/v_edit_laundry';
		$this->load->view('grand_template',$data);
		
	}
	public function del_ly($id,$ly,$user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
		$data['ly'] = $ly;
		$tanggal=date('j/m/y');
		$ln=mysql_query("SELECT * FROM laundry where id_laundry='$id'");
        $dr=mysql_fetch_array($ln);
		
		
		$ly1=mysql_query("SELECT * FROM history_ly where id_ly='$ly'");
        $jy=mysql_fetch_array($ly1);
		$jml_ly=$jy['kirim_ly'];
		
		$jml_l=$dr['sisa_tkeluar']+$jml_ly;
		$kirimnya=$dr['kirim_keluar']-$jml_ly;
		
		$sql = $this->db->query("UPDATE laundry SET kirim_keluar='kirimnya',sisa_tkeluar='$jml_l' where id_laundry='$id' ");
		$sql_del = $this->db->query("DELETE FROM history_ly where id_ly='$ly' ");
		
		$sql3 = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$kirim','$user','$tanggal','DEl &nbsp;Barang Keluar Laundry&nbsp;$dr[nama_laundry]','$dr[invoice]')");
			
		redirect('progres/laundry/'.$user."/".$pass);
	}
	public function upgrade_loundry($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$toko = $this->input->post('standard');
		  $data_form = @$_POST['vol'];
		    foreach($data_form as $key=>$hasil){
				 $sql2 = $this->db->query("UPDATE laundry SET
										 jumlah_laundry='$hasil[jumlah]',
										 total_laundry='$hasil[kirim]',
		                                 warna='$hasil[warna]',
										 invoice='$hasil[invoice]',
										 tanggal='$hasil[tanggal]',
										 toko='$toko'
										 where id_laundry='$hasil[id]'
										 ");
										 
				 $barang = $this->input->post('barang');
				 
				 $kode_barang = $this->input->post('kode_barang');
				 $jumlah = $this->input->post('jumlah');
				 $biaya = $this->input->post('biaya');
				 $total = $this->input->post('total');
				 $tanggal = $this->input->post('tanggal');
	            // print_r ($tanggal);
	                           
				 $id_hl = $this->input->post('id_hl');		
				 print_r ($id_hl);
				 for($i=0; $i< count($id_hl); $i++){
					 $totalnya[$i]=$jumlah[$i]*$biaya[$i];
					 	echo $tanggal[$i]."<br>";
					            $awal[$i]=$tanggal[$i];
								$tgl_awal[$i] = substr("$awal[$i]",0,2);
								$bln_awal[$i] = substr("$awal[$i]",3,2);
								$thn_awal[$i] = substr("$awal[$i]",6,6);
								$tanggal_list[$i]=$tgl_awal[$i]."/".$bln_awal[$i]."/".$thn_awal[$i];
								$tanggal_s[$i]=$thn_awal[$i]."-".$bln_awal[$i]."-".$tgl_awal[$i];
						echo $barang[$i]."<br>";
					 $sql3 = $this->db->query("UPDATE history_laundry SET
												jumlah='$jumlah[$i]',
												biaya='$biaya[$i]',
												total='$totalnya[$i]',
												kode_barang='$kode_barang[$i]',
												tanggal='$tanggal[$i]'
												where id_hl='$id_hl[$i]'  					 
					                          ");
			$sql9 = $this->db->query("UPDATE pembelian SET 
			tgl='$tanggal_s[$i]',
			tanggal='$tanggal_list[$i]',
			total='$totalnya[$i]',
			jumlah='$jumlah[$i]'
			 where kode_finance='$id_hl[$i]'");
			$sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$jumlah[$i]','$user','$tanggal_list[$i]','edit&nbsp;Laundry&nbsp;$kode_barang[$i]','$hasil[invoice]')");
				 }
				
			}
redirect('progres/laundry/'.$user."/".$pass);
		
	}
	
	public function del_chile($id,$kode,$jumlah,$user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
		$data['kode'] = $kode;
		$data['jumlah'] = $jumlah;
		$qp=mysql_query("SELECT * FROM history_laundry where id_hl='$id'");
		  while ($h=mysql_fetch_array($qp)){
			 
		
		  
		  $j=mysql_query("SELECT * FROM laundry where id_laundry='$kode'   ");
          $h=mysql_fetch_array($j);
		  
		  $jml=$h['total_laundry']+$jumlah;
		  $jml2=$h['kirim']-$jumlah;
		  $up=$this->db->query("UPDATE laundry SET 
		  total_laundry='$jml',
		  status='Belum Selesai',
		  kirim='$jml2' 
		  
		  where id_laundry='$kode'  ");
		  
		  $dw=$this->db->query("DELETE FROM history_laundry where id_hl='$id'");
		  $bel=$this->db->query("DELETE FROM pembelian where kode_finance='$id'");
		  }
		 redirect('progres/edit_laundry/'.$kode.'/'.$user."/".$pass);
	}
	
	
	public function finis($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['main_view'] = 'progres/v_finis';
		$this->load->view('grand_template',$data);
		
	}
	
	public function edit_finis($id,$user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
		$data['main_view'] = 'progres/v_edit_finis';
		$this->load->view('grand_template',$data);
		
	}
	
		public function upgrade_finis($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$kirim = $this->input->post('kirim');
		$jumlah = $this->input->post('jumlah');
		$harga = $this->input->post('harga');
		$total = $this->input->post('total');
		$sisa = $this->input->post('sisa');
		  $data_form = @$_POST['vol'];
		    foreach($data_form as $key=>$hasil){
				
				$awal=$hasil['tgl_kembali'];
				                $awal_pecah = '/[\/]/';
		                        $hasil_awal =  preg_replace($awal_pecah,'-', $awal);
								//--------Hasil regex------------------------------
								$tgl_awal = substr("$hasil_awal",0,2);
								$bln_awal = substr("$hasil_awal",3,2);
								$thn_awal = substr("$hasil_awal",6,4);
								$awal_list=$thn_awal."-".$bln_awal."-".$tgl_awal;
								$tanggal_list=$tgl_awal."-".$bln_awal."-".$thn_awal;
								
				 $sql1 = $this->db->query("UPDATE finishing SET
				                         invoice='$hasil[invoice]',
										 jumlah_finis='$jumlah',
										 kirim='$kirim',
						                 biaya='$harga',
										 total_finis='$total',
										 tanggal='$hasil[tanggal]',
										 tgl_kembali='$hasil[tgl_kembali]'
										 where id_finis='$hasil[id]'
										 ");
				 //$total=$hasil['biaya']*$hasil['jumlah'];
			$sql2 = $this->db->query("UPDATE pembelian SET 
			tgl='$awal_list',
			tanggal='$tanggal_list',
			total='$total',
			jumlah='$jumlah'
			 where kode_finance='$hasil[id]'");		
										 
			$sql3 = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$total','$user','$tanggal_list','edit&nbsp;Finishing&nbsp;$hasil[nama]','$hasil[invoice]')");
			}
		
		redirect('progres/finis/'.$user."/".$pass);
		
	}
	
	  public function finis_delete($id,$user, $pass)
	{
	
		$data['id']=$id;
		$data['user'] = $user;
		$data['pass'] = $pass;
		$tanggal=date('d/m/Y H:i');
	
		$no_po=mysql_query("SELECT * FROM finishing where id_finis='$id'");
        $hs=mysql_fetch_array($no_po);
	
			 $sql_log = $this->db->query("insert into log_user (kode,nama,tanggal,ket,no_po)
			  VALUES ('$hs[jumlah_laundry]','$user','$tanggal','Delete&nbsp;Laundry&nbsp;','$hs[po_laundry]')");
			  
			  $sql = $this->db->query("DELETE FROM finishing where id_finis='$id'");
		redirect('progres/finis/'.$user."/".$pass);
	}
	
	public function finis_kirim($user,$pass)
	{	
	 $data['pass'] = $pass;
	 $data['user'] = $user;
      $tanggal = $this->input->post('tanggal');
	                            $awal=$tanggal;
								$bln_awal = substr("$awal",5,2);
								$tgl_awal = substr("$awal",8,2);
								$thn_awal = substr("$awal",0,4);
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
	 $po = $this->input->post('po');
	 $id = $this->input->post('id');
	 $nama = $this->input->post('nama');
	 $biaya = $this->input->post('biaya');
	 $kirim = $this->input->post('kirim');
	 $invoice = $this->input->post('invoice');
	  $toko = $this->input->post('standard');
	 $jahat=mysql_query("SELECT * FROM finishing where id_finis='$id'");
     $jh=mysql_fetch_array($jahat);
	 $sisa=$jh['total']-$kirim;
	 $kiriman=$jh['kirim']+$kirim;
	  $sql2 = $this->db->query("UPDATE finishing set 
	  tanggal='$tanggal_list',
	  status='Proses Finising',
	  toko='$toko',
	  invoice='$invoice'
	  where id_finis='$id' ");	
		 $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$kirim','$user','$tanggal_list','Finishing&nbsp;Kain&nbsp;$nama','$po')");
	
	 redirect('progres/finis/'.$user."/".$pass);
	}
	
	public function finis_kembali($user,$pass)
	{	
	 $data['pass'] = $pass;
	 $data['user'] = $user;
	  $kode = $this->input->post('kode');
	 $j5=mysql_query("SELECT * FROM history_finis where kode_barang='$kode'");
     $j6=mysql_fetch_array($j5);
	 $kodenya=$j6['kode_barang'];
	 if(empty($kodenya)){
     $total = $this->input->post('total');
	 $kirim = $this->input->post('kirim');
	 $kiriman2=$total-$kirim;
	  if($kiriman2 < 0){
				 
				  echo "<script>alert('Maaf Jumlah  melebihi');</script>";
	             echo "<meta http-equiv=refresh content=0;url=../../../progres/finis/$user/$pass>";
				
	  }else{
	 $po = $this->input->post('po');
	 $id = $this->input->post('id');
	 $nama = $this->input->post('nama');
	 $biaya = $this->input->post('biaya');
	 $kirim = $this->input->post('kirim');
	 $invoice = $this->input->post('invoice');
	 $toko = $this->input->post('standard');
	 $total_f=$kirim*$biaya;
	 $tanggal=date('d/m/Y');
	 $total2=$biaya*$kirim;
	 $jahat=mysql_query("SELECT * FROM finishing where id_finis='$id'");
     $jh=mysql_fetch_array($jahat);
	 $tgl = $this->input->post('tgl');
	 $awal=$tgl;
								$bln_awal = substr("$awal",5,2);
								$tgl_awal = substr("$awal",8,2);
								$thn_awal = substr("$awal",0,4);
								$tanggal_list=$tgl_awal."/".$bln_awal."/".$thn_awal;
								$tanggal_s=$thn_awal."-".$bln_awal."-".$tgl_awal;
	
	 $kiriman=$jh['kirim']+$kirim;
	 $sql2 = $this->db->query("UPDATE finishing set 
	  tgl_kembali='$tanggal_list',
	  status='Selesai',
	  kirim='$kiriman',
	  total_finis='$total2',
	  biaya='$biaya',
	  invoice='$invoice'
	  where id_finis='$id' ");	
	  $beli = $this->db->query("insert into pembelian (dept,total,barang,kode_finance,dari,ket,jumlah,status,tanggal,tgl)
			VALUES ('Finishing','$total_f','$nama','$id','Biaya Finishing Kain','$po','$total_f','Tempo','$tanggal_list','$tanggal_s')");
		    $bsa=mysql_query("SELECT id_fn FROM history_finis order by id_fn DESC");
            $sbba=mysql_fetch_array($bsa);
			$tgl=date('dmy');
			$id2=$sbba['id_fn']+1;
			$acak	  = rand(00,99);
	        $auto=$id2.$acak;
			$lh = $this->db->query("insert into history_finis (auto_id,kode_fn,jumlah,barang,tanggal,kode_barang,biaya,total)
			VALUES ('$auto','$id','$kirim','$nama','$tanggal_list','$kode','$biaya','$total2')");
		    $sql = $this->db->query("insert into log_user (kode,nama,tanggal,ket, no_po)
			VALUES ('$kirim','$user','$tanggal_list','Finishing&nbsp;Kain&nbsp;$nama','$kode')");
	  }
	 }else{
		  echo "<script>alert('Maaf Kode Barang sudah di pakai');</script>";
	      echo "<meta http-equiv=refresh content=0;url=../../../progres/finis/$user/$pass>";
	 }
	echo "<meta http-equiv=refresh content=0;url=../../../progres/finis/$user/$pass>";
  }

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */