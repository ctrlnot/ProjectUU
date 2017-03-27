<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Auth extends CI_Model {

    function login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('acc_admin');

        if($query->num_rows()) {
            return $this->verify_pass($password);
        } else {
            return false;
        }
    }

    function getUser($username) {
        $query = $this->db->get('acc_admin');

        return $query->result_array()[0]['username'];
    }

    private function verify_pass($password) {
        $query = $this->db->get('acc_admin');

        return password_verify($password, $query->result_array()[0]['password']);
    }

}