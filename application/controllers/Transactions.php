<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('Model_Transactions');
    }

    public function index() {
        if($this->session->userdata('token')){
            $this->load->view('view_header', getHeaderInfo("Transactions", "transactions"));
            $this->load->view('view_transactions');
            $this->load->view('view_footer', getFooterInfo("transactions"));
        } else {
            redirect(base_url('login'));
        }
    }

    public function getName() {
        if(isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->Model_Transactions->getNames($q);
        }
    }
}