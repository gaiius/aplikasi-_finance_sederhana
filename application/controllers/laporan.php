<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function index()
	{
		$this->load->model('m_barang');
        $data['barang'] = $this->m_barang->get_view();
		$this->load->model('m_barang');
        $data['brn'] = $this->m_barang->get_view_jual();
		 $data['main_view'] = 'master/v_barang';
		$this->load->view('grand_template',$data);
	}
	public function log_user($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'laporan/v_log';
		 $this->load->view('grand_template',$data);	
	}

	
   public function log_delete($id,$user, $pass)
	{
		$data['id']=$id;
		$data['pass'] = $pass;
		$data['user'] = $user;
		$sql = $this->db->query("DELETE FROM log_user where id_log='$id'");
		
		redirect('laporan/log_user/'.$user."/".$pass);
	}
	
 public function pembelian($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'laporan/v_pembelian';
		 $this->load->view('grand_template',$data);	
	}
	 public function periode_pembelian($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'laporan/v_periode_pembelian';
		 $this->load->view('grand_template',$data);	
	}
	
	public function laba($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'laporan/v_laba';
		 $this->load->view('grand_template',$data);	
	}
	public function laba_rugi($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'laporan/v_laba_rugi';
		 $this->load->view('grand_template',$data);	
	}
 //-----------------------------------------Load Data For seach Enggine------------------------------------------
 	
  public function load_data2()
	{
		
		$stat = $this->input->get('stat');
		if($stat == 'ket'){
			echo "<select name='kunci'>";
			$qp=mysql_query("SELECT DISTINCT ket FROM pembelian");
            while ($kabar3=mysql_fetch_array($qp)){	
                $b=$kabar3[ket];
				 echo "<option value='$b'>".$b."</option>";	
			}
            echo "</select>";
		}	
	}
	
	 public function load_pembelian()
	{
		$input = $this->input->get('$input');
		$query = mysql_query("SELECT ket FROM pembelian WHERE ket LIKE '%$input%'"); 
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
	}
	
	 public function load_pembelian2()
	{
		$input = $this->input->get('$input');
		$query = mysql_query("SELECT DISTINCT barang FROM pembelian WHERE barang LIKE '%$input%'"); //query mencari hasil search
		$hasil2 = mysql_num_rows($query);
		if ($hasil2 > 0)
		{
			while ($data = mysql_fetch_row($query))
			{
				?>
				<a class="cari" href="javascript:autoInsert2('<?=$data[0]?>');"><?=$data[0]?><BR> <!-- hasil search -->
				<?php
			}
	   }
	}
//--------------------------------End Load Data------------------------------------------------------------
	
	 public function penjualan($user, $pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'laporan/v_penjualan';
		 $this->load->view('grand_template',$data);	
	}
//-----------------------------------------Load Data For seach Enggine------------------------------------------
	
	public function load_penjualan()
	{
		$input = $this->input->get('$input');
		$query = mysql_query("SELECT DISTINCT po_jual FROM history_jual WHERE po_jual LIKE '%$input%'"); //query mencari hasil search
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
	}
	public function load_kodebarang()
	{
		$input = $this->input->get('$input');
		$query = mysql_query("SELECT DISTINCT kode_barang FROM history_finis WHERE kode_barang LIKE '%$input%'"); //query mencari hasil search
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
	}
	
	public function load_baranga()
	{
		$input = $this->input->get('$input');
		$query = mysql_query("SELECT DISTINCT barang FROM history_finis WHERE barang LIKE '%$input%'"); //query mencari hasil search
		$hasil2 = mysql_num_rows($query);
		if ($hasil2 > 0)
		{
			while ($data = mysql_fetch_row($query))
			{
				?>
				<a class="cari" href="javascript:autoInsert2('<?=$data[0]?>');"><?=$data[0]?><BR> <!-- hasil search -->
				<?php
			}
	   }
	}
	
	 public function load_penjualan2()
	{
		$input = $this->input->get('$input');
		$query = mysql_query("SELECT DISTINCT nama_jual FROM history_jual WHERE nama_jual LIKE '%$input%'"); //query mencari hasil search
		$hasil2 = mysql_num_rows($query);
		if ($hasil2 > 0)
		{
			while ($data = mysql_fetch_row($query))
			{
				?>
				<a class="cari" href="javascript:autoInsert2('<?=$data[0]?>');"><?=$data[0]?><BR> <!-- hasil search -->
				<?php
			}
	   }
	}
//-----------------------------------------End Load Data For seach Enggine------------------------------------------
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */