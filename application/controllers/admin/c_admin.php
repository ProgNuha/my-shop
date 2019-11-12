<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Admin extends CI_Controller {

	function __Construct() {
		parent::__Construct ();
		$this->load->database(); // load database
		$this->load->helper('url');
        $this->load->model('m_admin');
        $this->load->helper(array('form', 'url'));
	}

	public function index() {
		if( $this->session->userdata('auth') ){               
        	redirect('admin/c_template/', 'refresh');
    	}
        $this->load->view('admin/v_login');
	}

	public function authenticate() {
		$username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
        $password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);

        $userAuth = $this->m_admin->authenticate($username,$password);

		if($userAuth->num_rows() > 0){
			$data=$userAuth->row_array();
			$this->session->set_userdata('auth',TRUE);
			$this->session->set_userdata('username',$data['username']);
			$url = base_url("admin/c_template/");
			redirect($url);
		}else{
			$this->load->view('admin/v_admin');
		}
	}

	public function logout(){
		// echo "logout";
		$this->session->unset_userdata('auth');
		$this->session->sess_destroy();
		redirect('admin/v_admin');
    }
    
    public function setStatus(){
        $code = $this->input->post('code');
        $status = $this->input->post('status');
        $this->m_selling->setStatus($code, $status);

        redirect('admin/c_admin/list_status');
    }

    public function list_status(){
        $data['status'] = $this->m_selling->show_data()->result();
        $page['content_page'] = $this->load->view('set_status', $data, TRUE);
        $this->load->view('admin/v_template', $page);
        
		// $this->load->view('templates/header');
		// $this->load->view('set_status', $data);
		// $this->load->view('templates/footer');
    }
}
