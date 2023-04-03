<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prodi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Prodi_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_prodi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('prodi/prodi_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_prodi')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Prodi_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_prodi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Prodi_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id_prodi' => $row->id_prodi,
			'kode_prodi' => $row->kode_prodi,
			'nama_prodi' => $row->nama_prodi,
			'ket' => $row->ket,
		    );
                $this->load->view('prodi/prodi_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('prodi'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_prodi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('prodi/create_action'),
			    'id_prodi' => set_value('id_prodi'),
			    'kode_prodi' => set_value('kode_prodi'),
			    'nama_prodi' => set_value('nama_prodi'),
			    'ket' => set_value('ket'),
			);
            $this->load->view('prodi/prodi_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_prodi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'kode_prodi' => $this->input->post('kode_prodi',TRUE),
					'nama_prodi' => $this->input->post('nama_prodi',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );
                $this->Prodi_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('prodi'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_prodi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Prodi_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('prodi/update_action'),
					'id_prodi' => set_value('id_prodi', $row->id_prodi),
					'kode_prodi' => set_value('kode_prodi', $row->kode_prodi),
					'nama_prodi' => set_value('nama_prodi', $row->nama_prodi),
					'ket' => set_value('ket', $row->ket),
			    );
                $this->load->view('prodi/prodi_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('prodi'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_prodi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_prodi', TRUE));
            } else {
                $data = array(
					'kode_prodi' => $this->input->post('kode_prodi',TRUE),
					'nama_prodi' => $this->input->post('nama_prodi',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );

                $this->Prodi_model->update($this->input->post('id_prodi', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('prodi'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_prodi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Prodi_model->get_by_id($id);

            if ($row) {
                $this->Prodi_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('prodi'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('prodi'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_prodi', 'kode prodi', 'trim|required');
	$this->form_validation->set_rules('nama_prodi', 'nama prodi', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');

	$this->form_validation->set_rules('id_prodi', 'id_prodi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Prodi.php */
/* Location: ./application/controllers/Prodi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-26 18:05:58 */
/* http://harviacode.com */