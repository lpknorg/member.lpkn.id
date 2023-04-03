<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori_berita extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_berita_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_kategori_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('kategori_berita/kategori_berita_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_kategori_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Kategori_berita_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_kategori_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Kategori_berita_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id' => $row->id,
			'kategori_berita' => $row->kategori_berita,
			'ket' => $row->ket,
		    );
                $this->load->view('kategori_berita/kategori_berita_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('kategori_berita'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_kategori_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('kategori_berita/create_action'),
			    'id' => set_value('id'),
			    'kategori_berita' => set_value('kategori_berita'),
			    'ket' => set_value('ket'),
			);
            $this->load->view('kategori_berita/kategori_berita_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_kategori_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'kategori_berita' => $this->input->post('kategori_berita',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );
                $this->Kategori_berita_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('kategori_berita'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_kategori_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Kategori_berita_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('kategori_berita/update_action'),
					'id' => set_value('id', $row->id),
					'kategori_berita' => set_value('kategori_berita', $row->kategori_berita),
					'ket' => set_value('ket', $row->ket),
			    );
                $this->load->view('kategori_berita/kategori_berita_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('kategori_berita'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_kategori_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
					'kategori_berita' => $this->input->post('kategori_berita',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );

                $this->Kategori_berita_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('kategori_berita'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_kategori_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Kategori_berita_model->get_by_id($id);

            if ($row) {
                $this->Kategori_berita_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('kategori_berita'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('kategori_berita'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kategori_berita', 'kategori berita', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kategori_berita.php */
/* Location: ./application/controllers/Kategori_berita.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-08-13 09:58:47 */
/* http://harviacode.com */