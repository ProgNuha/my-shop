<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_good extends CI_Controller {
	public function index(){
		$data['goods'] = $this->m_goods->show_data()->result();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/input_good', $data);
		$this->load->view('admin/templates/footer');
	}

	public function action(){
		$name = $this->input->post('name');
		$price = $this->input->post('price');
		$stock = $this->input->post('stock');
		$info = $this->input->post('info');
		$filepath = $_FILES['filepath'];
		if($filepath = ''){
			echo 'Auth Failed';
		} else {
			$config['upload_path'] = './assets/uploads';
			$config['allow_types'] = 'jpeg|jpg|png|gif';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('filepath')){
				$filepath = $this->upload->data('file_name');
			} else {
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('admin/input_good', $error);
				echo $config['upload_path'];
				echo $error;
				echo "Failed to upload"; die();
			}
		}

		$data = array (
			'name' => $name,
			'price' => $price,
			'stock' => $stock,
			'info' => $info,
			'filepath' => $filepath
		);

		$this->m_goods->add_good($data, 'goods');
		redirect('admin/input_good/index');
	}
}