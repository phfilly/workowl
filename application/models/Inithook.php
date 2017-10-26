<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

class Inithook extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_config()
    {
        return $this->db->get('config');
    }

    public function get_lang()
    {
        if ($this->session->userdata('lang')) {
            return $this->session->userdata('lang');
        }else{
            $query = $this->db->select('language')->where('user_id',$this->session->userdata('user_id'))->get('account_details');
            if ($query->num_rows() > 0)
            {
                $row = $query->row();
                return $row->language;
            }
        }
    }
}