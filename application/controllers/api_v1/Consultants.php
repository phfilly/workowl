<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Consultants extends REST_Controller {
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With');

        parent::__construct();
        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['test_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->load->model('User');
    }

    function index_options()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With');
    }

    //API -  Fetch All Consultants
    function index_get()
    {
        $result = $this->User->all_consultants();
        if($result) {
            $this->response($result, 200); 
        } 
        else {
            $this->response("No Users found", 404);
        }
    }

    function consultant_get()
    {
        $id = (int) $this->get('id');
        $result = $this->User->profile_info($id);
        if($result) {
            $this->response($result, 200); 
        } 
        else {
            $this->response("No consultant found", 404);
        }
    }
}

?>