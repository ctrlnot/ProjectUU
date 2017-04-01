<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('Model_Members');
        $this->load->library('Ajax_pagination');
        $this->perPage = 10;
    }

    public function index() {
        if($this->session->userdata('token')){
            $data = array(
                );

            //total rows count
            $totalRec = count($this->Model_Members->getMembersRows());

            //pagination configuration
            $config['target']      = '#members-table';
            $config['base_url']    = base_url().'members/ajaxPaginationData';
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchFilter';
            $this->ajax_pagination->initialize($config);

            //get the members data
            $data['members'] = $this->Model_Members->getMembersRows(array('limit'=>$this->perPage));

            $this->load->view('view_header', getHeaderInfo("Members", "members"));
            $this->load->view('view_members_default', $data);
            $this->load->view('view_footer', getFooterInfo("members"));
        } else {
            redirect(base_url('login'));
        }
    }

    function ajaxPaginationData() {
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->Model_Members->getMembersRows($conditions));
        
        //pagination configuration
        $config['target']      = '#members-table';
        $config['base_url']    = base_url().'members/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get members data
        $data['members'] = $this->Model_Members->getMembersRows($conditions);
        
        //load the view
        $this->load->view('view_members_filtered', $data, false);
    }

    function validate() {
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
