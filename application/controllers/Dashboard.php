<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index(){
		$data['goods'] = $this->m_goods->show_data()->result();

		$this->load->view('templates/header');
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function add_to_cart(){
		$id    	= $this->input->post('id');
		$qty	= $this->input->post('qty');
		$price	= $this->input->post('price');
		$name	= $this->input->post('name');
		
		$data = array(
			'id'      => $id,
			'qty'     => $qty,
			'price'   => $price,
			'name'    => $name
		);

		$this->cart->insert($data);
		$_data['data'] =  $data;
		
		$this->load->view('templates/header');
		$this->load->view('add_to_chart', $_data);
		$this->load->view('templates/footer');
	}
	
}
