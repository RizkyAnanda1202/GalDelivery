<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kendaraan_model extends CI_Model
{
    public $table = 'kendaraan';
    public $id = 'kendaraan.id_kendaraan';
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

        public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }


    public function getById($id)
    {
        $query = $this->db->get_where($this->table, ['id_kendaraan'=>$id]);
        return $query->row_array();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    
}