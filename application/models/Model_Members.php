<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Members extends CI_Model {

    public function addMember() {
        $data = array(
                'm_id' => uniqid(),
                'm_name' => $this->input->post('name'),
                'm_initial_deposit' => $this->input->post('initial'),
                'm_contact' => $this->input->post('contact'),
                'm_date_registered' => $this->input->post('date_registered'),
                'm_goal_progress' => 0,
                'm_borrowed' => 0,
                'm_contributed' => 0
            );

        $query = $this->db->insert('info_members', $data);

        return $query;
    }

    public function getMembers() {
        $query = $this->db->get('info_members');
        return $query->result();
    }

}