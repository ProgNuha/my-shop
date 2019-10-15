<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_admin extends CI_Controller {
	public function index()
	{
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/templates/footer');
	}
}