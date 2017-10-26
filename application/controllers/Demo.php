<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Freelancer Office
 * 
 * Web based project and invoicing management system available on codecanyon
 *
 * @package     Freelancer Office
 * @author      William Mandai
 * @copyright   Copyright (c) 2014 - 2016 Gitbench,
 * @license     http://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
 * @link        http://codecanyon.net/item/freelancer-office/8870728
 * @link        https://gitbench.com
 */

class Demo_data extends MX_Controller {


    function __construct() {
        parent::__construct();
        $this->load->library('tank_auth');
        if ($this->tank_auth->user_role($this->tank_auth->get_role_id()) != 'admin') {
            $this->session->set_flashdata('response_status', 'error');
            $this->session->set_flashdata('message', lang('access_denied'));
            redirect('logout');
        }
        $this->load->helper('curl','file');
    }

    function index() {
        
    }



    function clean_my_data() {
        $this->load->dbforge();
        $this->load->database();

        $file_content = Applib::remote_get_contents(UPDATE_URL.'files/demo.sql');
        $this->db->query('USE ' . $this->db->database . ';');
        foreach (explode(";\n", $file_content) as $sql) {
            $sql = trim($sql);
            if ($sql) {
                $this->db->query($sql);
            }
        }
       die('Demo data installed');
    }

}

/* End of file updater.php */