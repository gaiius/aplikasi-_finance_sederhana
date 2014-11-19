<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_barang extends CI_Model {
    
    var $table = 'barang';

    public function insert($data)
    {
       $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        return  $id;
    }
    
    public function insert_beli($data)
    {
        $this->db->insert('pembelian',$data);
    }
    
     public function insert_jual($data)
    {
        $this->db->insert('penjualan',$data);
    }
    
      public function update($data,$id)
    {
        $this->db->update($this->table, $data, array('id' => $id));
    }
	
	  public function upgrade($data2,$kode)
    {
        $this->db->update($this->table, $data2, array('id' => $kode));
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
    
    public function get_item($id) {
        
        $data = $this->db->get_where('penjualan', array('kode' => $id));
        return $data->result_array();
    }
    
    public function get_status($id) {
        
        $data = $this->db->get_where($this->table, array('pembayaran' => $id));
        return $data->result_array();
    }
    
     public function get_hutang_view($id) {
        
        $data = $this->db->get_where('hutang', array('kode' => $id));
        return $data->result_array();
    }
    
    public function get_tgl($id) {
        
        $data = $this->db->get_where('penjualan', array('tgl_tran' => $id));
        return $data->result_array();
    }
    
    public function get_hutang($id) {
        
        $data = $this->db->get_where($this->table, array('id' => $id));
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
    
    public function delete_jual($id) {
        $this->db->delete('penjualan', array('kode' => $id));
    }
     public function delete_supp($id) {
        $this->db->delete('supplier', array('kode' => $id));
    }
     public function delete_beli($id) {
        $this->db->delete('pembelian', array('kode' => $id));
    }
    public function delete_hutang($id) {
        $this->db->delete('hutang', array('kode' => $id));
    }
    
	
	 public function delete_his($id) {
        $this->db->delete('history_retur', array('kode' => $id));
    }
    
	
    public function get_report() {
        $this->db->distinct('nama');
        $this->db->join('penjualan', 'penjualan.kode = barang.id');
       // $this->db->group_by('nama');
        $data = $this->db->get($this->table);
        return $data->result_array();
    }
    
    
    
    
    

   
}