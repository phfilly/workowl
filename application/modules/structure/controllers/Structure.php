<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Structure extends MX_Controller
{
    private $table = 'industry';
    
    function __construct()
    {
        parent::__construct();
        User::logged_in();

        $this->load->module('layouts');
        $this->load->library(array('template', 'form_validation'));
        $this->load->model(array('Project', 'App', 'Client', 'Industry', 'ProjectCategories'));
        
        $this->template->title('Structure');
        $this->applib->set_locale();
    }

    function index() {
        $this->template->title(lang('Project Categories'));
        $data = array(
            'page' => lang('projects'),
            'dir' => 'structure',
            'name'	=> 'Industry',
            'table' => 'industries',
            'industries' => Project::get_all_industries()
        );
        $this->template
            ->set_layout('users')
            ->build('view',isset($data) ? $data : NULL);
    }

    function add()
    {
        if ($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $table = $this->input->post('table');
            unset($_POST['table']);
            $model = $this->retrieveModal($table);
            
            if ($this->form_validation->run() == FALSE) {	
                $_POST = '';
                Applib::go_to('structure/'.$table, 'error', lang('error_in_form'));	
            } else {
                if($model::save($this->input->post())){
                    Applib::go_to('structure/'.$table, 'success', 'Added_successfully');
                }
            }
		} else {
            $data['table'] = $this->input->get('table');
			$this->load->view('modal/add', $data);
		}
	}

    function edit()
    {
        if ($this->input->post()) {   
            $this->form_validation->set_rules('name', 'Name', 'required');
            $table = $this->input->post('table');
            $model = $this->input->post('model');

            if ($this->form_validation->run() == FALSE) {	
                    $_POST = '';
                    Applib::go_to('structure/'.$table,'error',lang('error_in_form'));	
            } else {	
                $data = array('name' => $this->input->post('name'));

                $model::update($this->input->post('id'),$data);
                $this->session->set_flashdata('response_status', 'success');
                $this->session->set_flashdata('message','Updated');
                redirect('structure/'.$table);  
            }
        } else {
            $data['id'] = $this->uri->segment(4);
            $data['table'] = $this->input->get('table');
            $this->load->view('modal/edit',$data);
        }
    }
    
    function retrieveModal($table)
    {
        $tmptable = explode('_', $table);
        $model = "";
        if (count($tmptable) > 0) {
            foreach ($tmptable as $key => $value) {
                $model .= ucfirst($value);
            }
        }

        return $model;
    }

    function delete()
    {
		if ($this->input->post() ) {
		    $id = $this->input->post('id', TRUE);
            $table = $this->input->post('table');
            $model = $this->retrieveModal($table);

            if($model::delete($id)) {
                Applib::go_to('structure/'.$table,'success', 'saved');
            }
		} else {
            $data['id'] = $this->uri->segment(4);
            $data['table'] = $this->input->get('table');
			$this->load->view('modal/delete',$data);
		}
    }

    function project_categories()
    {
        $this->template->title(lang('Project Categories'));
        $data = array(
            'page' => lang('projects'),
            'dir' => 'structure',
            'name'	=> 'Project Categories',
            'table' => 'project_categories',
            'data' => ProjectCategories::get_all()
        );
        $this->template
            ->set_layout('users')
            ->build('view',isset($data) ? $data : NULL);
    }
}

?>