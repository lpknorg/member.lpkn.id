<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kota extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kota_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_kota')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('kota/kota_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_kota')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Kota_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_kota')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Kota_model->get_by_id($id);
            if ($row) {
                $data = array(
        			'id' => $row->id,
        			'nama_propinsi' => $row->nama_propinsi,
                    'nama' => $row->nama,
    		    );
                $this->load->view('kota/kota_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('kota'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_kota')){
            show_error('You must be an administrators to view this page.');
        }else{
            $propinsis  = $this->Kota_model->get_propinsi();
            $data = array(
                'button' => 'Create',
                'action' => site_url('kota/create_action'),
			    'id' => set_value('id'),
			    'id_propinsi' => set_value('id_propinsi'),
                'nama' => set_value('nama'),
                'propinsi' => $propinsis
			);
            $this->load->view('kota/kota_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_kota')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'id_propinsi' => $this->input->post('id_propinsi',TRUE),
                    'nama' => $this->input->post('nama',TRUE),
			    );
                
                $this->Kota_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('kota'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_kota')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Kota_model->get_by_id($id);

            if ($row) {

                $data = array(
                    'button' => 'Update',
                    'action' => site_url('kota/update_action'),
					'id' => set_value('id', $row->id),
					'idpropinsi' => set_value('id_propinsi', $row->id_propinsi),
                    'nama' => set_value('nama', $row->nama),
                     'propinsi'  => $this->Kota_model->get_propinsi()
			    );
                $this->load->view('kota/kota_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('kota'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_kota')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
					'id_propinsi' => $this->input->post('id_propinsi',TRUE),
                    'nama' => $this->input->post('nama',TRUE),
			    );

                $this->Kota_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('kota'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_kota')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Kota_model->get_by_id($id);

            if ($row) {
                $this->Kota_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('kota'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('kota'));
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

/* End of file kota.php */
/* Location: ./application/controllers/kota.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-07-20 15:00:33 */
/* http://harviacode.com */