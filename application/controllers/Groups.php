<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Groups extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Groups_model');
        $this->load->library('form_validation');   
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->library('ion_auth_acl');
        $this->load->helper(['url', 'language']);
    	$this->load->library('datatables');
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_group_user')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('groups/groups_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_group_user')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Groups_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_group_user')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Groups_model->get_by_id($id);
            if ($row) {
                $data = array(
    		'id' => $row->id,
    		'name' => $row->name,
    		'description' => $row->description,
    	    );
                $this->load->view('groups/groups_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('groups'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_group_user')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('groups/create_action'),
    	    'id' => set_value('id'),
    	    'name' => set_value('name'),
    	    'description' => set_value('description'),
    	    );
            $this->load->view('groups/groups_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_group_user')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
    		'name' => $this->input->post('name',TRUE),
    		'description' => $this->input->post('description',TRUE),
    	    );

                $this->Groups_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('groups'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_group_user')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Groups_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('groups/update_action'),
    		'id' => set_value('id', $row->id),
    		'name' => set_value('name', $row->name),
    		'description' => set_value('description', $row->description),
    	    );
                $this->load->view('groups/groups_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('groups'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_group_user')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
    		'name' => $this->input->post('name',TRUE),
    		'description' => $this->input->post('description',TRUE),
    	    );

                $this->Groups_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('groups'));
            }
        }
    }

    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_group_user')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Groups_model->get_by_id($id);

            if ($row) {
                $this->Groups_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('groups'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('groups'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('description', 'description', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Groups.php */
/* Location: ./application/controllers/Groups.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-08 09:21:13 */
/* http://harviacode.com */