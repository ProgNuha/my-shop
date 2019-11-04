<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_goods extends CI_Model {
	public function show_data(){
		return $this->db->get('goods');
	}

	public function find($id){
		$result = $this->db->where('code', $id)->limit(1)->get('goods');

		if($result->num_rows() > 0){
			return $result->row();  
		} else {
			return null;
		}
	}

	public function add_good($data,$table){
		$this->db->insert($table,$data); 
	}

	public function reducestock($id, $qty){
		return $this->db->query("update goods set stock = stock - $qty WHERE code = $id");
	}
}