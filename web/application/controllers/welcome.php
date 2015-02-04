<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	function __construct() {
		parent::__construct();

	}


	/**
	 * Landing page
	 */
	public function index()
	{
		$this->load->view('welcome');
	}

	/**
	 * Log into the system
	 */
	public function login() {

	}

	/**
	 * Log out of the system
	 */
	public function logout() {

	}

	public function register() {

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */