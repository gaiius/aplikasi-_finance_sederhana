<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_supplier extends CI_Model {
    
    var $table = 'barang';

    public function insert($data)
    {
        $this->db->insert($this->table,$data);
    }
    
     public function insert_jual($data)
    {
        $this->db->insert('penjualan',$data);
    }
    
      public function update($data,$id)
    {
        $this->db->update($this->table, $data, array('id' => $id));
    }

    public function get_search($id) {
        $this->db->where('nama',$id);
         $data = $this->db->get('barang');
        return $query->result_array();
    }
    
    public function get_view() {
        $data = $this->db->get($this->table);
        return $data->result_array();
    }
    
     public function get_view_jual() {
        $this->db->join('penjualan', 'penjualan.kode = barang.id');
        $data = $this->db->get($this->table);
        return $data->result_array();
    }
     public function get_view_join($id) {

        $this->db->where('id',$id);
        $data = $this->db->get($this->table);
        return $data->result_array();
    }
   

   public function delete($id) {
        $this->db->delete('barang', array('id' => $id));
    }
    
    
    
    
    

   
}