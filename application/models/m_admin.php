<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class m_admin extends CI_Model {
	    function __construct() {
			parent::__construct();
			$this->load->database();
	    }

        public function authenticate($username,$password)
        {
				$query = $this->db->query("SELECT * FROM admin WHERE username = '$username' AND password=MD5('$password')");
		        return $query;
        }
	}
?>
