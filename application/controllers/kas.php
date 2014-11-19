<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kas extends CI_Controller {
	public function index($ttm)
	{   $data['ttm'] = $ttm;
		$data['main_view'] = 'master/v_kas';
		$this->load->view('grand_template',$data);
	}
	public function home($ttm, $posisi)
	{		
	    $data['ttm'] = $ttm;
		$data['posisi'] = $posisi;
		$data['main_view'] = 'master/v_kas';
		$this->load->view('grand_template',$data);		
	}
	public function insert()
	{

        $jumlah = $this->input->post('jumlah');	
		$dari = $this->input->post('dari');
		$ket = $this->input->post('ket');
		$tran = $this->input->post('tran');
		$detail = $this->input->post('detail');
	    $tanggal=date('j-m-Y');
		if($detail == 'masuk'){
		 mysql_query("insert into kas (jml,dari,ket,tran,tgl,tanggal)
	       values ('$jumlah','$dari','$ket','$tran','$tanggal',NOW())");
		}else{
			mysql_query("insert into kas (jm_keluar,dari,ket,tran,tgl,tanggal)
	       values ('$jumlah','$dari','$ket','$tran','$tanggal',NOW())");
		}
		   exit("<script>window.alert('Proses Input DATA baru Berhasil..!!');
		window.location='../kas';</script>");
	}
	
		public function saldo()
	{
		 $data['main_view'] = 'master/v_saldo';
		$this->load->view('grand_template',$data);
	}
	
	public function laba($ttm, $posisi)
	{		
	    $data['ttm'] = $ttm;
		$data['posisi'] = $posisi;
		
		$data['main_view'] = 'master/v_laba';
		$this->load->view('grand_template',$data);		
	}
	public function chat($ttm, $posisi)
	{		
	    $data['ttm'] = $ttm;
		$data['posisi'] = $posisi;
		$data['main_view'] = 'barang/v_chat';
		$this->load->view('grand_template',$data);		
	}
	
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */