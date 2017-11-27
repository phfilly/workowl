<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Auth extends REST_Controller {
    public function __construct()
    {
        $this->headers();
        parent::__construct();
        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['test_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->load->model(array('Users', 'User'));
    }

    function headers()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With');
    }

    function index_options()
    {
        $this->headers();
    }

    function login_options()
    {
       $this->headers();
    }

    function login_post()
    {
      $this->headers();
      $this->config->load('tank_auth',TRUE);
      $flag = false;

      if ($this->post('params')['data']['email'] != "") {
          $login_by_email = $this->post('params')['data']['email'];
          $password = $this->post('params')['data']['password'];
          $flag = $this->tank_auth->login($this->post('params')['data']['email'], $password, true, '', $login_by_email);
          $id = $this->User->get_id();
          $user = $this->User->view_user($id);
          $account = $this->User->profile_info($id);

          $this->response(['key' => 12345, 'hash' => md5(strtolower(trim($this->post('params')['data']['email']))), 'user' => $user, 'account' => $account], 200);
      }
      $errors = $this->tank_auth->get_error_message();
      // $token = Configuration::gateway()->clientToken()->generateWithoutCustomerIdSignature();
    $this->response($errors, 404);
    }

    function signup_options()
    {
        $this->headers();
    }

    function signup_post()
    {
        $this->headers();

        //double check this

        if ($this->post('params')['data']['name'] != "") {
            $acc = [
                'fullname' => $this->post('params')['data']['name'],
                'surname' => $this->post('params')['data']['surname']
            ];

            $this->config->load('tank_auth',TRUE);
            $hasher = new PasswordHash(
                $this->config->item('phpass_hash_strength', 'tank_auth'),
                $this->config->item('phpass_hash_portable', 'tank_auth'));

            $hashed_password = $hasher->HashPassword($this->post('params')['data']['password']);

            $userprofile = [
                'username' => $this->post('params')['data']['name'],
                'email' => $this->post('params')['data']['email'],
                'password' => $hashed_password,
                'type' => $this->post('params')['data']['profileType'],
                'role_id' => 1,
                'verified' => 'Pending'
            ];

            $user_id = $this->Users->create_user($userprofile, $acc, FALSE);
            $this->response('Success', 200);
        } else {
            $this->response("Failed", 404);
        }
    }

    //API -  Fetch All Consultants
    function index_get()
    {
        $result = $this->User->all_users();
        if($result) {
            $this->response($result, 200); 
        } 
        else {
            $this->response("No Users found", 404);
        }
    }
}

?>