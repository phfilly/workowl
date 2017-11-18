<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class FilterOptions extends REST_Controller {
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With');

        parent::__construct();
        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['test_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->load->model(array('Industry','ProjectCategories'));
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
        $industry = $this->Industry->all_industries();
        $categories = $this->ProjectCategories->get_all();
        $array = [ 'industry' => $industry, 'categories' => $categories ];
        if($array) {
            $this->response($array, 200); 
        } 
        else {
            $this->response("No categories found", 404);
        }
    }

    function test_get()
    {
        $this->response("Hello", 404);
        
    }
}

?>