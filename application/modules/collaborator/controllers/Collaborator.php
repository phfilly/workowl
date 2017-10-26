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
 * @link     	https://gitbench.com
 */

class Collaborator extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		User::logged_in(); 

		$this->load->model(array('Project','App','Welcome'));

		if (User::is_admin()) {
			redirect('welcome');
		}
		if (User::is_client()) {
			redirect('clients');
		}

		$this->applib->set_locale();
	}

	function index()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('welcome').' - '.config_item('company_name'));
	$data['page'] = lang('home');
	$data['task_checkbox'] = TRUE;

	$this->template
	->set_layout('users')
	->build('welcome',isset($data) ? $data : NULL);
	}
	
}

/* End of file collaborator.php */