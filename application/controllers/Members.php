<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('Model_Members');
    }

    public function index() {
        if($this->session->userdata('token')){
            $data = array(
                    'membersInfo' => $this->Model_Members->getMembers()
                );

            $this->load->view('header', getHeaderInfo("Members", "header"));
            $this->load->view('view_members', $data);
            $this->load->view('footer', getFooterInfo("members"));
        } else {
            redirect(base_url('login'));
        }
    }

    public function validate() {
        if(!empty($_POST)) {
            $data = array('success' => 0);

            $res = $this->Model_Members->addMember();

            if($res) {
                $data['success'] = true;
            }

            echo json_encode($data);
        } else {
            redirect(base_url('members'));
        }
    }

}
