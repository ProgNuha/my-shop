<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function template($load_data)
	{
		$data['content'] = $this->load->view('templates/header');
		$data['content'] = $this->load->view('templates/footer');

		$data['content'] = $this->load->view('templates/template',$data);
		return $this->load->view('templates/template',$load_data);
	}

	public function index(){
		$data['goods'] = $this->m_goods->show_data()->result();

		$data_view['content'] = $this->load->view('dashboard', $data, true);
		$data_view1['content_'] = $this->template($data_view);
		$this->load->view('dashboard',$data_view1);

		// $this->load->view('templates/header');
		// $this->load->view('dashboard', $data);
		// $this->load->view('templates/footer');
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
		
		$data_view['content'] = $this->load->view('add_to_chart', $_data, true);
		$data_view1['content_'] = $this->template($data_view);
		$this->load->view('add_to_chart',$data_view1);

		// $this->load->view('templates/header');
		// $this->load->view('add_to_chart', $_data);
		// $this->load->view('templates/footer');
	}


	
}
