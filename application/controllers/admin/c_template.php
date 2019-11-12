<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_template extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('m_goods');
    }

    public function index(){
	if( $this->session->userdata('auth') ){   
        $page['content_page'] = $this->load->view('admin/index', '', TRUE);
		$this->load->view('admin/v_template', $page);
    }
    else {
        $this->load->view('admin/v_login');

    }

	}
}