<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permissions extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Permissions_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_permissions')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('permissions/permissions_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_permissions')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Permissions_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_permissions')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Permissions_model->get_by_id($id);
            if ($row) {
                $data = array(
    		'id' => $row->id,
    		'perm_key' => $row->perm_key,
    		'perm_name' => $row->perm_name,
    	    );
                $this->load->view('permissions/permissions_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permissions'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_permissions')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('permissions/create_action'),
        	    'id' => set_value('id'),
        	    'perm_key' => set_value('perm_key'),
        	    'perm_name' => set_value('perm_name'),
    	    );
            $this->load->view('permissions/permissions_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_permissions')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
    		'perm_key' => $this->input->post('perm_key',TRUE),
    		'perm_name' => $this->input->post('perm_name',TRUE),
    	    );

                $this->Permissions_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('permissions'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_permissions')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Permissions_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('permissions/update_action'),
    		'id' => set_value('id', $row->id),
    		'perm_key' => set_value('perm_key', $row->perm_key),
    		'perm_name' => set_value('perm_name', $row->perm_name),
    	    );
                $this->load->view('permissions/permissions_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permissions'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_permissions')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
    		'perm_key' => $this->input->post('perm_key',TRUE),
    		'perm_name' => $this->input->post('perm_name',TRUE),
    	    );

                $this->Permissions_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('permissions'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_permissions')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Permissions_model->get_by_id($id);

            if ($row) {
                $this->Permissions_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('permissions'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('permissions'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('perm_key', 'perm key', 'trim|required');
	$this->form_validation->set_rules('perm_name', 'perm name', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Permissions.php */
/* Location: ./application/controllers/Permissions.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-16 19:22:13 */
/* http://harviacode.com */