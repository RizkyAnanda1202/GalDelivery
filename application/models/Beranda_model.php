<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Beranda_model extends CI_Model
{
    public $table = 'tbl_kos';
    public $id = 'tbl_kos.kos_id';
    public function __construct()
    {
        parent::__construct();
    }

    public function getMykos()
    {
        $this->db->from('tbl_kos');
        $this->db->where('user_id', $this->session->userdata('id'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getMykosById($id)
    {
        $query = $this->db->get_where($this->table, ['kos_id'=>$id]);
        return $query->row_array();
    }

    public function insertKos($data)
    {
        $this->db->insert('tbl_kos', $data);
        return $this->db->insert_id();
    }

    public function updateKos($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function deleteKos($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    
}