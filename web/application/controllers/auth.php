<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : auth.php
 *  Date : 2/21/15 10:41 AM
 *  Description :
 *  
 */

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('UserModel');
    }

    /**
     * Check if user is logged in
     * @return bool
     */
    private function _isLoggedIn() {
        return $this->session->userdata('user') != null;
    }

    /**
     * Redirect to session's 'login_callback' if user is logged in
     */
    private function  _redirectIfLoggedIn() {
        if($this->_isLoggedIn()) {
            $callback = $this->session->userdata("login_callback");
            if($callback == null) $callback = base_url();
            redirect($callback);
            exit;
        }
    }

    /**
     *
     */
    public function login(){

        $this->_redirectIfLoggedIn();

        $email = $this->input->post('email');
        $password = $this->input->post('pwd');

        $viewContext = array(
            "error" => null,
            "message" => null
        );

        if($email == null || $password == null){
            $this->load->view("auth/login", $viewContext);
        }else{

            //TODO: Sanitize data

            if($this->UserModel->validCredentials($email, $password)){
                $this->session->set_userdata("user",$this->UserModel->getUser($email));
                $this->_redirectIfLoggedIn();
            }else{
                $viewContext['error'] = "Invalid username and/or password.";
                $this->load->view("auth/login", $viewContext);
            }
        }
    }

    /**
     *
     */
    public function logout(){
        $usr = $this->session->userdata('user');

        $viewContext = array(
            "error" => null,
            "message" => null
        );

        if($usr != null){
            $this->session->unset_userdata('user');
            $viewContext['message'] = "Logged out!";
            $this->load->view("auth/login",$viewContext);
        }else{
            $this->load->view("auth/login", $viewContext);
        }
    }

    /**
     *
     */
    public function register(){

        $name = $this->input->post('name');
        $pwd = $this->input->post('pwd');
        $email = $this->input->post('email');

        $viewContext = array(
            "error" => null,
            "message" => null
        );

        if($name == null || $pwd == null || $email == null){
            $this->load->view("auth/register", $viewContext);
        }else{
            //TODO: Sanitize data

            if($this->UserModel->addUser($name, $email, $pwd)){
                $callback = $this->session->userdata("login_callback");
                if($callback == null) $callback = base_url();
                redirect($callback);
            }else{
                $viewContext['error'] = "Registration failed";
                $this->load->view("auth/register",array("error",$viewContext));
            }
        }
    }

}