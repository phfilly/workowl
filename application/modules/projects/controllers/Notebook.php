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


class Notebook extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		User::logged_in();
		
		$this->load->model('Project');

		$this->applib->set_locale();
		
	}

	
	function savenote()
	{
		if ($this->input->post()) {
		
		$project = $this->input->post('project', TRUE);	

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');
		$this->form_validation->set_rules('project', 'Project', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			Applib::go_to('projects/view/'.$project.'/?group=notes','error',lang('error_in_form'));
		}else{		
			
			Project::update($project,array('notes' => $this->input->post('notes')));

			Applib::go_to('projects/view/'.$project.'/?group=notes','success',lang('note_saved_successfully')); 
			}
		}else{
			redirect('projects');
		}
	}
}

/* End of file project_home.php */