<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : dashboard.php
 *  Date : 2/2/15 3:40 PM
 *  Description :
 *  
 */

class Dashboard extends CI_Controller {

    var $User = null;

    function __construct(){
        parent::__construct();

        $this->load->library('session');

        $this->User = $this->session->userdata('user');
        if($this->User == null) {
            $this->session->set_userdata('login_callback', '/dashboard');
            redirect('/auth/login');
        }
    }

    public function index() {
        $context = array(
            "user" => $this->User
        );
        $this->load->view("dashboard/index", $context);
    }

    public function partial($name) {
        $view = "dashboard/partials/".$name;
        $this->load->view($view);
    }

}