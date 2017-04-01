<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if($this->session->userdata('token')){
            $this->load->view('view_header', getHeaderInfo("Home", "home"));
            $this->load->view('view_home');
            $this->load->view('view_footer', getFooterInfo("home"));
        } else {
            redirect(base_url('login'));
        }
    }
}
