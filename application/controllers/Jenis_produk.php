<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_produk_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_jenis_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('jenis_produk/jenis_produk_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_jenis_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Jenis_produk_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_jenis_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Jenis_produk_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id' => $row->id,
			'jenis' => $row->jenis,
			'ket' => $row->ket,
		    );
                $this->load->view('jenis_produk/jenis_produk_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('jenis_produk'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_jenis_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('jenis_produk/create_action'),
			    'id' => set_value('id'),
			    'jenis' => set_value('jenis'),
			    'ket' => set_value('ket'),
			);
            $this->load->view('jenis_produk/jenis_produk_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_jenis_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'jenis' => $this->input->post('jenis',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );
                $this->Jenis_produk_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('jenis_produk'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_jenis_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Jenis_produk_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('jenis_produk/update_action'),
					'id' => set_value('id', $row->id),
					'jenis' => set_value('jenis', $row->jenis),
					'ket' => set_value('ket', $row->ket),
			    );
                $this->load->view('jenis_produk/jenis_produk_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('jenis_produk'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_jenis_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
					'jenis' => $this->input->post('jenis',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );

                $this->Jenis_produk_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('jenis_produk'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_jenis_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Jenis_produk_model->get_by_id($id);

            if ($row) {
                $this->Jenis_produk_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('jenis_produk'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('jenis_produk'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jenis_produk.php */
/* Location: ./application/controllers/Jenis_produk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-27 19:17:30 */
/* http://harviacode.com */