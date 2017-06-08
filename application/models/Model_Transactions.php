<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Transactions extends CI_Model {
    function getNames($q) {
        $this->db->select('m_name');
        $this->db->like('m_name', $q, 'after');
        $query = $this->db->get('info_members');
        if($query->num_rows() > 0) {
            foreach($query->result_array() as $row) {
                $row_set[] = htmlentities(stripslashes($row['m_name']));
            }
            echo json_encode($row_set);
        }
    }
}