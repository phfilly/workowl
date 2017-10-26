<?php defined('BASEPATH') OR exit('No direct script access allowed');

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


class Set_language extends MX_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->session->set_userdata('lang', $this->input->get('lang'));
		setcookie("fo_lang",$this->input->get('lang'), time() + 86400);
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
/* End of file sys_language.php */
/* Location: ./application/controllers/sys_language.php */