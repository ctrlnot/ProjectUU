<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
        if($this->session->userdata('token')){
            redirect(base_url());
        } else {
            $this->load->view('view_authentication');
        }
	}

    function validate() {
        if(!empty($_POST)) {
            $data = array('success' => 0);
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->load->model('Model_Auth');

            $res = $this->Model_Auth->login($username, $password);
            $admin = $this->Model_Auth->getUser($username);

            if($res) {
                $data['success'] = 1;
                $auth = array(
                        'admin' => $admin,
                        'token' => 1
                    );
                $this->session->set_userdata($auth);
            }

            echo json_encode($data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function hash() {
        $p = "asda123";
        $options = ['cost' => 9];
        echo password_hash($p, PASSWORD_BCRYPT, $options);
    }
}
