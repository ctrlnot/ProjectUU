<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Members extends CI_Model {

    public function addMember() {
        $now = new DateTime();
        $year = $now->format("Y-m-d H:i:s");

        $data = array(
                'm_id' => $this->createNewMemberId(),
                'm_name' => $this->input->post('name'),
                'm_initial_deposit' => $this->input->post('initial'),
                'm_contact' => $this->input->post('contact'),
                'm_date_registered' => $year,
                'm_goal_progress' => 0,
                'm_borrowed' => 0,
                'm_contributed' => 0
            );

        $query = $this->db->insert('info_members', $data);

        return $query;
    }

    public function getMembers() {
        $query = $this->db->order_by("m_date_registered", "desc")->get('info_members');
        return $query->result();
    }

    private function createNewMemberId() {
        $this->db->select('m_id');
        $this->db->order_by('m_id', 'desc')->limit(1);
        $query = $this->db->get('info_members')->row('m_id');

        if(!empty($query)) {
            // Get last id and increment 
            $lastId = $query;
            $lastThreeCode = substr($lastId, 5, 3) + 1;
            $newId = substr($lastId, 0, 4) . "-" . str_pad($lastThreeCode, 3, 0, STR_PAD_LEFT);
            return $newId;
        } else {
            // Create first id
            $now = new DateTime();
            $year = $now->format("Y");

            $id = $year . str_pad('1', 3, 0, STR_PAD_LEFT);
            $dash = "-";
            $index = 4;

            return substr_replace($id, $dash, $index, 0);
        }
    }

    function getMembersRows($params = array()){
        $this->db->select('*');
        $this->db->from('info_members');

        // filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('m_name',$params['search']['keywords']);
        }

        // sort data
        if(!empty($params['search']['sortBy'])) {
            switch($params['search']['sortBy']) {
                case 'lat': 
                    $this->db->order_by('m_date_registered', 'desc');
                    break;
                case 'old':
                    $this->db->order_by('m_date_registered', 'asc');
                    break;
                case 'z-a':
                    $this->db->order_by('m_name', 'desc');
                    break;
                case 'a-z': default:
                    $this->db->order_by('m_name', 'asc');
                    break;
            }
        } else {
            $this->db->order_by('m_name', 'asc');
        }

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)) {
            $this->db->limit($params['limit'],$params['start']);
        } elseif (!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }

        //get records
        $query = $this->db->get();

        //return fetched data
        return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
    }
 
}