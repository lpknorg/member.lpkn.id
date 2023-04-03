<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jurusan_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_jurusan')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('jurusan/jurusan_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_jurusan')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Jurusan_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_jurusan')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Jurusan_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id_jurusan' => $row->id_jurusan,
			'kode_jurusan' => $row->kode_jurusan,
			'nama_jurusan' => $row->nama_jurusan,
			'ket' => $row->ket,
		    );
                $this->load->view('jurusan/jurusan_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('jurusan'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_jurusan')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('jurusan/create_action'),
			    'id_jurusan' => set_value('id_jurusan'),
			    'kode_jurusan' => set_value('kode_jurusan'),
			    'nama_jurusan' => set_value('nama_jurusan'),
			    'ket' => set_value('ket'),
			);
            $this->load->view('jurusan/jurusan_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_jurusan')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'kode_jurusan' => $this->input->post('kode_jurusan',TRUE),
					'nama_jurusan' => $this->input->post('nama_jurusan',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );
                $this->Jurusan_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('jurusan'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_jurusan')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Jurusan_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('jurusan/update_action'),
					'id_jurusan' => set_value('id_jurusan', $row->id_jurusan),
					'kode_jurusan' => set_value('kode_jurusan', $row->kode_jurusan),
					'nama_jurusan' => set_value('nama_jurusan', $row->nama_jurusan),
					'ket' => set_value('ket', $row->ket),
			    );
                $this->load->view('jurusan/jurusan_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('jurusan'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_jurusan')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_jurusan', TRUE));
            } else {
                $data = array(
					'kode_jurusan' => $this->input->post('kode_jurusan',TRUE),
					'nama_jurusan' => $this->input->post('nama_jurusan',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );

                $this->Jurusan_model->update($this->input->post('id_jurusan', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('jurusan'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_jurusan')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Jurusan_model->get_by_id($id);

            if ($row) {
                $this->Jurusan_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('jurusan'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('jurusan'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_jurusan', 'kode jurusan', 'trim|required');
	$this->form_validation->set_rules('nama_jurusan', 'nama jurusan', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');

	$this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jurusan.php */
/* Location: ./application/controllers/Jurusan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-26 15:44:29 */
/* http://harviacode.com */