<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profesi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Profesi_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_profesi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('profesi/profesi_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_profesi')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Profesi_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_profesi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Profesi_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id' => $row->id,
			'profesi' => $row->profesi,
			'ket' => $row->ket,
		    );
                $this->load->view('profesi/profesi_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('profesi'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_profesi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('profesi/create_action'),
			    'id' => set_value('id'),
			    'profesi' => set_value('profesi'),
			    'ket' => set_value('ket'),
			);
            $this->load->view('profesi/profesi_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_profesi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'profesi' => $this->input->post('profesi',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );
                $this->Profesi_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('profesi'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_profesi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Profesi_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('profesi/update_action'),
					'id' => set_value('id', $row->id),
					'profesi' => set_value('profesi', $row->profesi),
					'ket' => set_value('ket', $row->ket),
			    );
                $this->load->view('profesi/profesi_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('profesi'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_profesi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
					'profesi' => $this->input->post('profesi',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );

                $this->Profesi_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('profesi'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_profesi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Profesi_model->get_by_id($id);

            if ($row) {
                $this->Profesi_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('profesi'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('profesi'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('profesi', 'profesi', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Profesi.php */
/* Location: ./application/controllers/Profesi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-07-20 15:00:33 */
/* http://harviacode.com */