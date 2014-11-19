<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_hutang extends CI_Model {
    
    var $table = 'hutang';

    public function insert($data)
    {
        $this->db->insert($this->table,$data);
    }
    
    public function get_view() {
        $data = $this->db->get($this->table);
        return $data->result_array();
    }
    
     public function get_join($id) {
        $data = $this->db->get_where('hutang', array('kode' => $id));
         return $data->result_array();
     }
}