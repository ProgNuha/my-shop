<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_selling extends CI_Model{
    public function insert($data){
        $this->db->insert('selling', $data);
    }

    public function show_data(){
		return $this->db->get('selling');
    }
    
    public function setStatus($code, $status){
        $this->db->query("update selling set status = '$status' WHERE code = $code ");
    }
}
