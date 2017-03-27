<?php

class Model_Auth extends CI_Model {
    public function insertFamilyInfo(){
        $data = array(
                    'mother' => $this->input->post('mother'),
                    'father' => $this->input->post('father'),
                    'guardian' => $this->input->post('guardian'),
                    'guardianContact' => $this->input->post('contactGuardian')
                );

        $this->db->insert('MemberFamilyInfo', $data);
        return $this->db->insert_id();
    }

    public function insertEducationInfo(){
        $data = array(
                    'highSchoolGraduated' => $this->input->post('highSchool'),
                    'highSchoolType' => $this->input->post('hsType'),
                    'awardsReceived' => $this->input->post('awardsHS'),
                    'scholarship' => $this->input->post('scholar'),
                    'scholarshipType' => $this->input->post('scholarType')
                );
        
        $this->db->insert('MemberEducationBackground', $data);
        return $this->db->insert_id();
    }

    public function insertAffiliationAndSkillsInfo(){
        $data = array(
                    'organization_one' => $this->input->post('organizationOne'),
                    'position_one' => $this->input->post('positionOne'),
                    'organization_two' => $this->input->post('organizationTwo'),
                    'position_two' => $this->input->post('positionTwo'),
                    'organization_three' => $this->input->post('organizationThree'),
                    'position_three' => $this->input->post('positionThree'),
                    'skills' => $this->input->post('skills')
                );

        $this->db->insert('MemberAffiliationSkills', $data);
        return $this->db->insert_id();
    }

    public function insertPersonalInfo(){
        $data = array(
                    'firstName' => $this->input->post('firstName'),
                    'middleName' => $this->input->post('middleName'),
                    'lastName' => $this->input->post('lastName'),
                    'suffix' => $this->input->post('suffix'),
                    'gender' =>  $this->input->post('gender'),
                    'birthDate' => $this->input->post('birthday'),
                    'yearLevel' => $this->input->post('year'),
                    'section' => $this->input->post('section'),
                    'contactNumber' => $this->input->post('contactNumber'),
                    'emailAddress' => $this->input->post('emailAddress'),
                    'residentialAddress' => $this->input->post('residentialAddress'),
                    'provincialAddress' => $this->input->post('provincialAddress')
                );

        $this->db->insert('MemberPersonalInfo', $data);
        return $this->db->insert_id();
    }

    public function insertMemberInfo($MPIid, $MFIid, $MEBid, $MASid){
        $options = ['cost' => 9];
        $studentNumber = $this->input->post('studentNumber');
        $pass = $this->input->post('password');
        $hashpass = password_hash($pass, PASSWORD_BCRYPT, $options);

        $data = array(
                    'memberID' => $this->generateUid($studentNumber),
                    'studentNumber' => $studentNumber,
                    'password' => $hashpass,
                    'MPIid' => $MPIid,
                    'MFIid' => $MFIid,
                    'MEBid' => $MEBid,
                    'MASid' => $MASid,
                    'dateRegistered' =>  date("Y-m-d H:i:s", time())
                );

        $query = $this->db->insert('MemberInformation', $data);

        return $query;
    }

    public function login($studentNumber, $password) {
        $this->db->where('studentNumber', $studentNumber);
        $query_stupass = $this->db->get('MemberInformation');

        if ($query_stupass->num_rows() == 1) {
            if(password_verify($password, $query_stupass->result_array()[0]['password'])){
                $this->db->where('studentNumber', $studentNumber);
                switch($query_stupay = $query_stupass->result_array()[0]['MSid']){

                    //good username and password and ___
                    case 0:
                        return 'active';   //PAID, can login
                    case 1:
                        return 'inactive';   //EXPIRED, can login
                    default:
                        return 'pending';   //NOT PAID, cannot login
                }
            }
            return 'invalid';   //invalid username or PASSWORD
        }
        return 'invalid';   //invalid USERNAME or password

        return 0;
    }

    public function getUser($studentNumber){
        $query = $this->db->query("SELECT * FROM MemberInformation INNER JOIN MemberPersonalInfo ON MemberPersonalInfo.MPIid = MemberInformation.MPIid WHERE studentNumber = '$studentNumber'");
        return $query->result_array();
    }

    public function getStudentNumber($studentNumber){
        $this->db->where('studentNumber', $studentNumber);
        $query = $this->db->get('user_details_member');
        return $query->result_array()[0]['studentNumber'];
    }

    private function generateUid($studentNumber){
        return substr($studentNumber, 0, 5). str_replace(".", "", strtoupper(uniqid()));
    }

    function getData($column, $input){
        $query = "SELECT `contactNumber`, `genderID`, `memberID`,`user_details`.`studentNumber`,`lastName`,`firstName`,`middleName`,`birthDate`, `emailAddress` FROM `user_details` JOIN `user_details_member` ON `user_details`.`studentNumber`=`user_details_member`.`studentNumber` WHERE `user_details_member`.`$column`='$input';";
        return $this->db->query($query)->result_array()[0];
        
    }
}