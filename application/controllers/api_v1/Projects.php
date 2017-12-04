<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Projects extends REST_Controller {
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With');

        parent::__construct();
        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['test_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->load->model('Project');
    }

    function index_options()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With');
    }

    //API -  Fetch All Projects
    function index_get()
    {
        $result = $this->Project->all_full();
        if($result) {
            $data = $this->get('params');

            if ($this->get('search') != '') {
                $result = $this->Project->by_where('projects.description like "%'.$this->get('search').'%" OR projects.project_title like "%'.$this->get('search').'%"');
            } else if (count($data) > 0) {
                foreach($data as $item) {
                    $tmp = json_decode($item, true);
                    if($tmp['type'] == 'Industry') {
                        $result = $this->Project->by_where_filter('industries.name', $tmp['name']);    
                    }

                    if($tmp['type'] == 'Category') {
                        $result = $this->Project->by_where_filter('project_categories.name', $tmp['name']);    
                    }
                }
            }

            $this->response($result, 200); 
        } 
        else {
            $this->response("No projects found", 404);
        }
    }

    function project_options()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With');
    }

    function project_get()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With');

        $id = (int) $this->get('id');
        $result = $this->Project->by_id($id);
        if($result) {
            $this->response($result, 200); 
        } 
        else {
            $this->response("No projects found", 404);
        }
    }

    function test_get()
    {
        $this->response("Hello", 404);
        
    }
}

?>