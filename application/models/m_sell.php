<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sell extends CI_Model{
    public function insert($data){
		return $this->db->insert('sell', $data); 
    }
    
    public function show_data(){
		return $this->db->get('sell');
	}
}