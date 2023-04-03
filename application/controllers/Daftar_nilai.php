<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daftar_nilai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Daftar_nilai_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_daftar_nilai')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('daftar_nilai/daftar_nilai_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_daftar_nilai')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Daftar_nilai_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_daftar_nilai')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Daftar_nilai_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id_nilai' => $row->id_nilai,
			'nilai_min' => $row->nilai_min,
			'nilai_max' => $row->nilai_max,
            'nilai_huruf' => $row->nilai_huruf,
			'mutu' => $row->mutu,
			'ket_nilai' => $row->ket_nilai,
		    );
                $this->load->view('daftar_nilai/daftar_nilai_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('daftar_nilai'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_daftar_nilai')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('daftar_nilai/create_action'),
			    'id_nilai' => set_value('id_nilai'),
			    'nilai_min' => set_value('nilai_min'),
			    'nilai_max' => set_value('nilai_max'),
                'nilai_huruf' => set_value('nilai_huruf'),
			    'mutu' => set_value('mutu'),
			    'ket_nilai' => set_value('ket_nilai'),
			);
            $this->load->view('daftar_nilai/daftar_nilai_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_daftar_nilai')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'nilai_min' => $this->input->post('nilai_min',TRUE),
					'nilai_max' => $this->input->post('nilai_max',TRUE),
                    'nilai_huruf' => $this->input->post('nilai_huruf',TRUE),
					'mutu' => $this->input->post('mutu',TRUE),
					'ket_nilai' => $this->input->post('ket_nilai',TRUE),
			    );
                $this->Daftar_nilai_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('daftar_nilai'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_daftar_nilai')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Daftar_nilai_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('daftar_nilai/update_action'),
					'id_nilai' => set_value('id_nilai', $row->id_nilai),
					'nilai_min' => set_value('nilai_min', $row->nilai_min),
					'nilai_max' => set_value('nilai_max', $row->nilai_max),
                    'nilai_huruf' => set_value('nilai_huruf', $row->nilai_huruf),
					'mutu' => set_value('mutu', $row->mutu),
					'ket_nilai' => set_value('ket_nilai', $row->ket_nilai),
			    );
                $this->load->view('daftar_nilai/daftar_nilai_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('daftar_nilai'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_daftar_nilai')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_nilai', TRUE));
            } else {
                $data = array(
					'nilai_min' => $this->input->post('nilai_min',TRUE),
					'nilai_max' => $this->input->post('nilai_max',TRUE),
                    'nilai_huruf' => $this->input->post('nilai_huruf',TRUE),
					'mutu' => $this->input->post('mutu',TRUE),
					'ket_nilai' => $this->input->post('ket_nilai',TRUE),
			    );

                $this->Daftar_nilai_model->update($this->input->post('id_nilai', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('daftar_nilai'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_daftar_nilai')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Daftar_nilai_model->get_by_id($id);

            if ($row) {
                $this->Daftar_nilai_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('daftar_nilai'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('daftar_nilai'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nilai_min', 'nilai min', 'trim|required');
	$this->form_validation->set_rules('nilai_max', 'nilai max', 'trim|required');
	$this->form_validation->set_rules('nilai_huruf', 'nilai huruf', 'trim|required');
	// $this->form_validation->set_rules('ket_nilai', 'ket nilai', 'trim|required');

	$this->form_validation->set_rules('id_nilai', 'id_nilai', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Daftar_nilai.php */
/* Location: ./application/controllers/Daftar_nilai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-27 20:23:36 */
/* http://harviacode.com */