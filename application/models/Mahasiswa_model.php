<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_mahasiswa($id = null)
    {
        if ($id === null) {
            $query = $this->db->get('mahasiswa');            
        } else {
            $query = $this->db->get_where('mahasiswa', array('id' => $id));            
        }
            
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return null;
        }

    }

    public function delete_mahasiswa($id = null)
    {
        $this->db->delete('mahasiswa', array('id' => $id));
        return $this->db->affected_rows();
    }

    public function create_mahasiswa($data = null)
    {
        $this->db->insert('mahasiswa', $data);
        return $this->db->affected_rows();
    }

    public function update_mahasiswa($data = null, $id = null)
    {
        $this->db->update('mahasiswa', $data, ['id'=> $id]);
        return $this->db->affected_rows();
    }

}
