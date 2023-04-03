<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_kelas')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('kelas/kelas_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_kelas')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Kelas_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_kelas')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Kelas_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id_kelas' => $row->id_kelas,
			'kode_kelas' => $row->kode_kelas,
			'nama_kelas' => $row->nama_kelas,
			'ket' => $row->ket,
		    );
                $this->load->view('kelas/kelas_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('kelas'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_kelas')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('kelas/create_action'),
			    'id_kelas' => set_value('id_kelas'),
			    'kode_kelas' => set_value('kode_kelas'),
			    'nama_kelas' => set_value('nama_kelas'),
			    'ket' => set_value('ket'),
			);
            $this->load->view('kelas/kelas_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_kelas')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'kode_kelas' => $this->input->post('kode_kelas',TRUE),
					'nama_kelas' => $this->input->post('nama_kelas',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );
                $this->Kelas_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('kelas'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_kelas')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Kelas_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('kelas/update_action'),
					'id_kelas' => set_value('id_kelas', $row->id_kelas),
					'kode_kelas' => set_value('kode_kelas', $row->kode_kelas),
					'nama_kelas' => set_value('nama_kelas', $row->nama_kelas),
					'ket' => set_value('ket', $row->ket),
			    );
                $this->load->view('kelas/kelas_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('kelas'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_kelas')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_kelas', TRUE));
            } else {
                $data = array(
					'kode_kelas' => $this->input->post('kode_kelas',TRUE),
					'nama_kelas' => $this->input->post('nama_kelas',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );

                $this->Kelas_model->update($this->input->post('id_kelas', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('kelas'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_kelas')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Kelas_model->get_by_id($id);

            if ($row) {
                $this->Kelas_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('kelas'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('kelas'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_kelas', 'kode kelas', 'trim|required');
	$this->form_validation->set_rules('nama_kelas', 'nama kelas', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');

	$this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-26 16:02:24 */
/* http://harviacode.com */