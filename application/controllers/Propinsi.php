<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Propinsi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Propinsi_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_propinsi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('propinsi/propinsi_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_propinsi')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Propinsi_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_propinsi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Propinsi_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id' => $row->id,
			'nama' => $row->nama,
		    );
                $this->load->view('propinsi/propinsi_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('propinsi'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_propinsi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('propinsi/create_action'),
			    'id' => set_value('id'),
			    'nama' => set_value('nama'),
			);
            $this->load->view('propinsi/propinsi_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_propinsi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'nama' => $this->input->post('nama',TRUE),
			    );
                // var_dump($data);die;
                
                $this->Propinsi_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('propinsi'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_propinsi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Propinsi_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('propinsi/update_action'),
					'id' => set_value('id', $row->id),
					'nama' => set_value('nama', $row->nama),
			    );
                $this->load->view('propinsi/propinsi_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('propinsi'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_propinsi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
					'nama' => $this->input->post('nama',TRUE),
			    );

                $this->Propinsi_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('propinsi'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_propinsi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Propinsi_model->get_by_id($id);

            if ($row) {
                $this->Propinsi_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('propinsi'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('propinsi'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file propinsi.php */
/* Location: ./application/controllers/propinsi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-07-20 15:00:33 */
/* http://harviacode.com */