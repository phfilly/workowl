<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Industries extends MX_Controller
{
    private $table = 'industry';
    
    function __construct()
    {
        parent::__construct();
        User::logged_in();

        $this->load->module('layouts');
        $this->load->library(array('template', 'form_validation'));
        $this->load->model(array('Project', 'App', 'Client', 'Industry'));
        
        $this->template->title('Industry');
        $this->applib->set_locale();
    }

    function index() {
        $this->template->title(lang('Project Categories'));
        $data = array(
            'page' => lang('projects'),
            'dir' => 'projects',
            'name'	=> 'Industry',
            'table' => 'industries',
            'industries' => Project::get_all_industries()
        );
        $this->template
            ->set_layout('users')
            ->build('industries',isset($data) ? $data : NULL);
    }

    function add()
    {
        if ($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Industry Name', 'required');

            if ($this->form_validation->run() == FALSE) {	
                $_POST = '';
                Applib::go_to('projects/industries/','error',lang('error_in_form'));	
            } else {	
                if(Industry::save($this->input->post())){
                    Applib::go_to('projects/industries/','success', 'Added successfully');
                }
            }
		} else {
			$this->load->view('modal/add_industries');
		}
	}

    function edit()
    {
        if ($this->input->post()) {   
            $this->form_validation->set_rules('name', 'Industry Name', 'required');

            if ($this->form_validation->run() == FALSE) {	
                    $_POST = '';
                    Applib::go_to('projects/industries','error',lang('error_in_form'));	
            } else {	
                $data = array('name' => $this->input->post('name'));

                Industry::update($this->input->post('id'),$data);
                $this->session->set_flashdata('response_status', 'success');
                $this->session->set_flashdata('message','Updated');
                redirect('projects/industries');  
            }
        } else {
            $data['id'] = $this->uri->segment(4);
            $this->load->view('modal/edit_industries',$data);
        }
	}

    function delete()
    {
		if ($this->input->post() ) {
		    $id = $this->input->post('id', TRUE);

            if(Industry::delete($id)) {
                Applib::go_to('projects/industries','success', 'saved');
            }
		} else {
			$data['id'] = $this->uri->segment(4);
			$this->load->view('modal/delete_industries',$data);
		}
    }
}

?>