<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart extends CI_Controller {
	public function index()
	{
		$this->load->model('m_progres');
                 $data['progres'] = $this->m_progres->get_search();
		 $data['main_view'] = 'progres/v_progres';
		$this->load->view('grand_template',$data);
	}
	public function penjualan($po,$barang,$awalan,$akhiran,$user,$pass)
	{
		$data['po'] = $po;
		$data['barang'] = $barang;
		$data['awalan'] = $awalan;
		$data['akhiran'] = $akhiran;
		$data['pass'] = $pass;
		$data['user'] = $user;
		 $data['main_view'] = 'laporan/v_chart_penjualan';
		 $this->load->view('grand_template',$data);
		
	}
	public function cetak($id,$customer,$user,$pass,$tanggal)
	{
		$data['id'] = $id;
		$data['customer'] = $customer;
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['tanggal'] = $tanggal;
		 $data['main_view'] = 'laporan/v_cetak_penjualan';
		 $this->load->view('cetak_template',$data);
		
	}
	
	
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */