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
 * @link     	https://gitbench.com
 */


class Milestones extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		User::logged_in();

		$this->load->module('layouts');	
		$this->load->library(array('template','form_validation'));
		$this->template->title(lang('projects'));
		$this->load->model(array('Project','App'));

		$this->applib->set_locale();
	}

	function add()
	{
		if ($this->input->post()) {

		$project = $this->input->post('project');

		$this->form_validation->set_rules('milestone_name', 'Milestone Name', 'required');
		$this->form_validation->set_rules('project', 'Project', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			 Applib::make_flashdata(array('form_error'=> validation_errors()));
             Applib::go_to('projects/view/'.$project.'?group=milestones', 'error', lang('operation_failed'));
		}else{
           	$_POST['start_date'] = date_format(date_create_from_format(config_item('date_php_format'), $_POST['start_date']), 'Y-m-d');
            $_POST['due_date'] = date_format(date_create_from_format(config_item('date_php_format'), $_POST['due_date']), 'Y-m-d');

            $milestone_id = App::save_data('milestones',$this->input->post());

            // Post to slack channel
            if(config_item('slack_notification') == 'TRUE'){
            	$this->load->helper('slack');
            	$slack = new Slack_Post;
                $slack->slack_milestone_action($project,$milestone_id,User::get_id(),'added');
            }

            $data = array(
				'module' => 'milestones',
				'module_field_id' => $project,
				'user' => User::get_id(),
				'activity' => 'activity_added_new_milestone',
				'icon' => 'fa-laptop',
				'value1' => $this->input->post('milestone_name'),
				'value2' => ''
				);
			App::Log($data);

		Applib::go_to('projects/view/'.$project.'?group=milestones','success',lang('milestone_added_successfully'));

		}
		}else{
			$data['project'] = $this->uri->segment(4);
			$data['datepicker'] = TRUE;
			$data['action'] = 'add';
			$this->load->view('modal/milestone_action',isset($data) ? $data : NULL);
		}
	}

	function add_task()
	{
		
		$data = array(
				'project' => $this->uri->segment(5),
				'milestone' => $this->uri->segment(4),
				'action' => 'add_milestone_task',
				'datepicker' => TRUE
				);
		$this->load->view('modal/milestone_action',isset($data) ? $data : NULL);
	}

	function edit()
	{
		if ($this->input->post()) {

		$this->form_validation->set_rules('milestone_name', 'Milestone Name', 'required');
		$this->form_validation->set_rules('project', 'Project', 'required');

		$project = $this->input->post('project',TRUE);

		if ($this->form_validation->run() == FALSE)
		{
			Applib::make_flashdata(array('form_error'=> validation_errors()));
            Applib::go_to('projects/view/'.$project.'?group=milestones', 'error', lang('operation_failed'));
		}else{
			$milestone = $this->input->post('id',TRUE);
            $_POST['start_date'] = date_format(date_create_from_format(config_item('date_php_format'), $_POST['start_date']), 'Y-m-d');
            $_POST['due_date'] = date_format(date_create_from_format(config_item('date_php_format'), $_POST['due_date']), 'Y-m-d');
            
            App::update('milestones',array('id'=>$milestone),$this->input->post());


            // Post to slack channel
            if(config_item('slack_notification') == 'TRUE'){
            	$this->load->helper('slack');
            	$slack = new Slack_Post;
                $slack->slack_milestone_action($project,$milestone,User::get_id(),'edited');
            }

            $data = array(
				'module' => 'milestones',
				'module_field_id' => $project,
				'user' => User::get_id(),
				'activity' => 'activity_edited_milestone',
				'icon' => 'fa-pencil',
				'value1' => $this->input->post('milestone_name'),
				'value2' => ''
				);
			App::Log($data);

			Applib::go_to('projects/view/'.$project.'/?group=milestones&view=milestone&id='.$milestone,'success',lang('milestone_edited_successfully'));
		}
		}else{
	        $data['datepicker'] = TRUE;
	        $data['action'] = 'edit';
			$data['m'] = Project::view_milestone(intval($this->uri->segment(4)));
			$this->load->view('modal/milestone_action',isset($data) ? $data : NULL);
		}
	}

	function delete()
	{
		if ($this->input->post()) {

		$this->form_validation->set_rules('project', 'Project ID', 'required');

		if ($this->form_validation->run() == FALSE)
		{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('delete_failed'));
				redirect('projects');
		}else{	
			$project = $this->input->post('project');
			$milestone = $this->input->post('id');

			App::delete('milestones',array('id'=>$milestone));

			 $data = array(
				'module' => 'milestones',
				'module_field_id' => $project,
				'user' => User::get_id(),
				'activity' => 'activity_deleted_milestone',
				'icon' => 'fa-trash-o',
				'value1' => Project::view_milestone($milestone)->milestone_name,
				'value2' => ''
				);
			App::Log($data);

			Applib::go_to('projects/view/'.$project.'?group=milestones','success',lang('milestone_deleted_successfully'));
			}
		}else{
			$data['project'] = $this->uri->segment(4);
			$data['milestone'] = $this->uri->segment(5);
			$data['action'] = 'delete';
			$this->load->view('modal/milestone_action',$data);
		}
	}
}

/* End of file milestones.php */