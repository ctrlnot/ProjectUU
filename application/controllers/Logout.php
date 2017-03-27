<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function index(){
        $this->session->unset_userdata('token');
        $this->session->unset_userdata('admin');  
        redirect(base_url('login'));
    }

}