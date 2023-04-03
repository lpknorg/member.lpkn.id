<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_menu_model');
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


    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_menu')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('tbl_menu/create_action'),
    	    'id' => set_value('id'),
            'key' => set_value('key'),
    	    'label' => set_value('label'),
    	    'icon' => set_value('icon'),
    	    'type' => set_value('type'),
    	    'link' => set_value('link'),
    	    'parent' => set_value('parent'),
        	);
            $this->load->view('tbl_menu/tbl_menu_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_menu')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
            'key' => $this->input->post('key',TRUE),
    		'label' => $this->input->post('label',TRUE),
    		'icon' => $this->input->post('icon',TRUE),
    		'type' => $this->input->post('type',TRUE),
    		'link' => $this->input->post('link',TRUE),
    		'parent' => $this->input->post('parent',TRUE),
    	    );

                $this->Tbl_menu_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('menu_dinamic'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_menu')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Tbl_menu_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('tbl_menu/update_action'),
    		'id' => set_value('id', $row->id),
            'key' => set_value('key', $row->key),
    		'label' => set_value('label', $row->label),
    		'icon' => set_value('icon', $row->icon),
    		'type' => set_value('type', $row->type),
    		'link' => set_value('link', $row->link),
    		'parent' => set_value('parent', $row->parent),
    	    );
                $this->load->view('tbl_menu/tbl_menu_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('menu_dinamic'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_menu')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
            'key' => $this->input->post('key',TRUE),
    		'label' => $this->input->post('label',TRUE),
    		'icon' => $this->input->post('icon',TRUE),
    		'type' => $this->input->post('type',TRUE),
    		'link' => $this->input->post('link',TRUE),
    		'parent' => $this->input->post('parent',TRUE),
    	    );

                $this->Tbl_menu_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('menu_dinamic'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_menu')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Tbl_menu_model->get_by_id($id);

            if ($row) {
                $this->Tbl_menu_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('tbl_menu'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('tbl_menu'));
            }
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('key', 'key', 'trim|required');
	$this->form_validation->set_rules('label', 'label', 'trim|required');
	$this->form_validation->set_rules('icon', 'icon', 'trim|required');
	$this->form_validation->set_rules('type', 'type', 'trim|required');
	$this->form_validation->set_rules('link', 'link', 'trim|required');
	$this->form_validation->set_rules('parent', 'parent', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tbl_menu.php */
/* Location: ./application/controllers/Tbl_menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-11 12:49:35 */
/* http://harviacode.com */