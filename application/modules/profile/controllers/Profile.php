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


class Profile extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		User::logged_in();
		
		$this->load->model(array('App','Client'));

		$this->applib->set_locale();
	}

	
	function index(){
		redirect('profile/settings');
	}

	function settings()
	{
		if($_POST){
			Applib::is_demo();
			
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fullname', 'Full Name', 'required');
		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span><br>');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		                {
		                	$this->session->set_flashdata('response_status', 'error');
							$this->session->set_flashdata('message',lang('error_in_form'));
							$_POST = '';
							$this->settings();
		                    //redirect('profile/settings');
		                }else{ 

		                $id = $this->input->post('co_id',TRUE);

                        if (isset($_POST['company_data'])) {
                            $company_data = $_POST['company_data'];
                            Client::update($id,$company_data);
                            unset($_POST['company_data']);
                        }
                            unset($_POST['co_id']);
                        App::update('account_details',array('user_id'=>User::get_id()),$this->input->post());

                        $this->session->set_flashdata('response_status', 'success');
                        $this->session->set_flashdata('message',lang('profile_updated_successfully'));
                        redirect('profile/settings');
		        }

		}else{
			$this->load->module('layouts');
			$this->load->library('template');
			$this->template->title(lang('profile').' - '.config_item('company_name'));
			$data['page'] = lang('home');
			$data['form'] = TRUE;
			$this->template
			->set_layout('users')
			->build('edit_profile',isset($data) ? $data : NULL);
		}
	}

	function changeavatar()
	{		


		if ($this->input->post()) {
						
		Applib::is_demo();

		if(file_exists($_FILES['userfile']['tmp_name']) || is_uploaded_file($_FILES['userfile']['tmp_name'])) {
			$current_avatar = User::profile_info(User::get_id())->avatar;

							$config['upload_path'] = './resource/avatar/';
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							// $config['file_name'] = strtoupper('USER-'.$this->tank_auth->get_username()).'-AVATAR';
							$config['overwrite'] = FALSE;

							$this->load->library('upload', $config);

							if ( ! $this->upload->do_upload())
									{
										$this->session->set_flashdata('response_status', 'error');
										$this->session->set_flashdata('message',lang('avatar_upload_error'));
										redirect($this->input->post('r_url', TRUE));
							}else{
										$data = $this->upload->data();
										$ar = array('avatar' => $data['file_name']);
										App::update('account_details',array('user_id'=>User::get_id()),$ar);
										
								if(file_exists('./resource/avatar/'.$current_avatar) 
									&& $current_avatar != 'default_avatar.jpg'){
									unlink('./resource/avatar/'.$current_avatar);
								}
							}
				}

				if(isset($_POST['use_gravatar']) && $_POST['use_gravatar'] == 'on'){
					$ar = array('use_gravatar' => 'Y');
					App::update('account_details',array('user_id'=>User::get_id()),$ar);

				}else{ 
					$ar = array('use_gravatar' => 'N');
					App::update('account_details',array('user_id'=>User::get_id()),$ar);
					}

				$this->session->set_flashdata('response_status', 'success');
				$this->session->set_flashdata('message',lang('avatar_uploaded_successfully'));
				redirect($this->input->post('r_url', TRUE));

					
			}else{
				$this->session->set_flashdata('response_status', 'error');
				$this->session->set_flashdata('message', lang('no_avatar_selected'));
				redirect('profile/settings');
		}
	}

	function activities()
	{
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('profile').' - '.config_item('company_name'));
	$data['page'] = lang('home');
	$data['datatables'] = TRUE;
    $data['lastseen'] = config_item('last_seen_activities');
    $this->db->where('config_key','last_seen_activities')->update('config',array('value'=>time()));
	$this->template
	->set_layout('users')
	->build('activities',isset($data) ? $data : NULL);
	}

	function help()
	{
	$this->load->model('profile_model');
	$this->load->module('layouts');
	$this->load->library('template');
	$this->template->title(lang('profile').' - '.config_item('company_name'));
	$data['page'] = lang('home');
	$this->template
	->set_layout('users')
	->build('intro',isset($data) ? $data : NULL);
	}
}

/* End of file profile.php */