<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mata_kuliah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mata_kuliah_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_mata_kuliah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('mata_kuliah/mata_kuliah_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_mata_kuliah')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Mata_kuliah_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_mata_kuliah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Mata_kuliah_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id_mata_kuliah' => $row->id_mata_kuliah,
			'kode_mata_kuliah' => $row->kode_mata_kuliah,
			'nama_mata_kuliah' => $row->nama_mata_kuliah,
			'sks' => $row->sks,
			'kode_prodi' => $row->kode_prodi,
			'kode_semester' => $row->kode_semester,
			'ket' => $row->ket,
		    );
                $this->load->view('mata_kuliah/mata_kuliah_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('mata_kuliah'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_mata_kuliah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $prodi = $this->db->get('prodi')->result();
            $data = array(
                'button' => 'Create',
                'action' => site_url('mata_kuliah/create_action'),
			    'id_mata_kuliah' => set_value('id_mata_kuliah'),
			    'kode_mata_kuliah' => set_value('kode_mata_kuliah'),
			    'nama_mata_kuliah' => set_value('nama_mata_kuliah'),
			    'sks' => set_value('sks'),
                'list_prodi' => $prodi,
			    'kode_prodi' => set_value('kode_prodi'),
			    'kode_semester' => set_value('kode_semester'),
			    'ket' => set_value('ket'),
			);
            $this->load->view('mata_kuliah/mata_kuliah_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_mata_kuliah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'kode_mata_kuliah' => $this->input->post('kode_mata_kuliah',TRUE),
					'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah',TRUE),
					'sks' => $this->input->post('sks',TRUE),
					'kode_prodi' => $this->input->post('kode_prodi',TRUE),
					'kode_semester' => $this->input->post('kode_semester',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );
                $this->Mata_kuliah_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('mata_kuliah'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_mata_kuliah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Mata_kuliah_model->get_by_id($id);

            if ($row) {
                $prodi = $this->db->get('prodi')->result();
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('mata_kuliah/update_action'),
					'id_mata_kuliah' => set_value('id_mata_kuliah', $row->id_mata_kuliah),
					'kode_mata_kuliah' => set_value('kode_mata_kuliah', $row->kode_mata_kuliah),
					'nama_mata_kuliah' => set_value('nama_mata_kuliah', $row->nama_mata_kuliah),
					'sks' => set_value('sks', $row->sks),
                    // 'list_prodi' => $prodi,
					'kode_prodi' => set_value('kode_prodi', $row->kode_prodi),
					'kode_semester' => set_value('kode_semester', $row->kode_semester),
					'ket' => set_value('ket', $row->ket),
			    );
                $this->load->view('mata_kuliah/mata_kuliah_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('mata_kuliah'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_mata_kuliah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_mata_kuliah', TRUE));
            } else {
                $data = array(
					'kode_mata_kuliah' => $this->input->post('kode_mata_kuliah',TRUE),
					'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah',TRUE),
					'sks' => $this->input->post('sks',TRUE),
					'kode_prodi' => $this->input->post('kode_prodi',TRUE),
					'kode_semester' => $this->input->post('kode_semester',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );

                $this->Mata_kuliah_model->update($this->input->post('id_mata_kuliah', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('mata_kuliah'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_mata_kuliah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Mata_kuliah_model->get_by_id($id);

            if ($row) {
                $this->Mata_kuliah_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('mata_kuliah'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('mata_kuliah'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_mata_kuliah', 'kode mata kuliah', 'trim|required');
	$this->form_validation->set_rules('nama_mata_kuliah', 'nama mata kuliah', 'trim|required');
	$this->form_validation->set_rules('sks', 'sks', 'trim|required');
	$this->form_validation->set_rules('kode_prodi', 'kode prodi', 'trim|required');
	$this->form_validation->set_rules('kode_semester', 'kode semester', 'trim|required');
	// $this->form_validation->set_rules('ket', 'ket', 'trim|required');

	$this->form_validation->set_rules('id_mata_kuliah', 'id_mata_kuliah', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Mata_kuliah.php */
/* Location: ./application/controllers/Mata_kuliah.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-26 18:07:47 */
/* http://harviacode.com */