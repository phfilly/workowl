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

class Fopdf extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		User::logged_in();
		
		$this->load->model(array('Client','Estimate','Invoice','App'));
		$this->load->helper('invoicer');
		
		$this->applib->set_locale();
		
	}

	function invoice($invoice_id = NULL){			
			$data['id'] = $invoice_id;
			$this->load->view('invoice_pdf',isset($data) ? $data : NULL);				
	}
	function estimate($estimate = NULL){
			$data['id'] = $estimate;
			$this->load->view('estimate_pdf',isset($data) ? $data : NULL);	
	}

	function attach_invoice($invoice){			
			$data['id'] = $invoice['inv_id'];
			$data['attach'] = TRUE;
			$invoice = $this->load->view('invoice_pdf',isset($data) ? $data : NULL,TRUE);	
			return $invoice;			
	}
	function attach_estimate($estimate){
			$data['attach'] = TRUE;			
			$data['id'] = $estimate['est_id'];
			$est = $this->load->view('estimate_pdf',isset($data) ? $data : NULL,TRUE);	
			return $est;			
	}



}

/* End of file fopdf.php */