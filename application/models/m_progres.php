<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class M_progres extends CI_Model {

    var $table = 'artikel';
    public function insert($masukan)
    {
        $this->db->insert($this->table,$masukan);
    }
	


	public function ambil_karyawan($num, $offset)
    {

      $this->db->order_by('id_artikel', 'DESC');
      $data = $this->db->get('artikel', $num, $offset);
      return $data->result();
    }

//------------------------------------------------Profile-----------------------------------------
public function get_profile($id) {
        $data = $this->db->get_where('login', array('user' => $id));  
         return $data->result_array();
    }	

public function insert_profile($data)
    {
        $this->db->insert('profile',$data);
    }

public function edit_profile($id) {
         $data = $this->db->get_where('profile', array('id' => $id));  
         return $data->result_array();
         }

public function update_pro($data,$id)
    {
        $this->db->update('profile', $data, array('id' => $id));
    }
	//-----------------------------Event---------------------------------------------------

	public function potong() {
        $data = $this->db->get('potong');
        return $data->result_array();
    }
	
	public function get_potong() {
        $data = $this->db->get_where('pembelian', array('dept' => 'Potong'));
        return $data->result_array();
    }
	
	public function belanja() {
		
		 $this->db->order_by('id_produk');
        $data = $this->db->get('hasil_produksi');
		
        
		
        return $data->result_array();

    }

//-------------------------------------------Kat-------------------------------------------



	  	public function get_user($user) {

        

        $data = $this->db->get_where($this->table, array('user' => $user));

        return $data->result_array();

    }

	     public function artikel(){ 
        $string_query       = "select * from artikel order by id_artikel"; 
        $query          = $this->db->query($string_query);             
        $config['base_url']     = base_url().'progres/get_berita/'.$user.'/'.$pass; 
        $config['total_rows']   = $query->num_rows(); 
        $config['per_page']     = '30'; 
        $num            = $config['per_page']; 
        $offset         = $this->uri->segment(3); 
        $offset         = ( ! is_numeric($offset) || $offset < 1) ? 0 : $offset; 

        if(emptyempty($offset)) 
        { 
            $offset=0; 
        } 
        $this->pagination->initialize($config);        
        $data['query']      = $this->db->query($string_query." limit $offset,$num");   
        $data['base']       = $this->config->item('base_url'); 
        return $data; 

    } 
	 public function SearchResult($perPage,$uri,$kunci)

    {
   $this->db->select('*');
   $this->db->from('artikel');
    $this->db->like('judul',$kunci);
   $this->db->order_by('id_artikel','asc');
   $getData = $this->db->get('', $perPage, $uri);
  echo $kunci."<hr>";
   if($getData->num_rows() > 0)
    return $getData->result_array();
   else
    return null;
  }
  
  	public function update_log($data,$id)
    {
        $this->db->update('login', $data, array('user' => $id));
    }

}

