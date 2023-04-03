<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('produk/produk_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Produk_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Produk_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id' => $row->id,
			'id_member' => $row->id_member,
			'id_jenis' => $row->id_jenis,
			'nama_produk' => $row->nama_produk,
			'foto' => $row->foto,
			'ket' => $row->ket,
			'link' => $row->link,
			'create_date' => $row->create_date,
		    );
                $this->load->view('produk/produk_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('produk'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('produk/create_action'),
			    'id' => set_value('id'),
			    'id_member' => set_value('id_member'),
			    'id_jenis' => set_value('id_jenis'),
			    'nama_produk' => set_value('nama_produk'),
			    'foto' => set_value('foto'),
			    'ket' => set_value('ket'),
			    'link' => set_value('link'),
			    'create_date' => set_value('create_date'),
			);
            $this->load->view('produk/produk_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'id_member' => $this->ion_auth->get_user_id(),
					'id_jenis' => $this->input->post('id_jenis',TRUE),
					'nama_produk' => $this->input->post('nama_produk',TRUE),
					'foto' => $this->_uploadFotoProduk(),
					'ket' => $this->input->post('ket',TRUE),
					'link' => $this->input->post('link',TRUE),
					'create_date' => date('Y-m-d h:m:s'),
			    );
                $this->Produk_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('produk'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Produk_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('produk/update_action'),
					'id' => set_value('id', $row->id),
					'id_member' => set_value('id_member', $row->id_member),
					'id_jenis' => set_value('id_jenis', $row->id_jenis),
					'nama_produk' => set_value('nama_produk', $row->nama_produk),
					'foto' => set_value('foto', $row->foto),
					'ket' => set_value('ket', $row->ket),
					'link' => set_value('link', $row->link),
					'create_date' => set_value('create_date', $row->create_date),
			    );
                $this->load->view('produk/produk_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('produk'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
					// 'id_member' => $this->input->post('id_member',TRUE),
					'id_jenis' => $this->input->post('id_jenis',TRUE),
					'nama_produk' => $this->input->post('nama_produk',TRUE),
					// 'foto' => $this->input->post('foto',TRUE),
					'ket' => $this->input->post('ket',TRUE),
					'link' => $this->input->post('link',TRUE),
					// 'create_date' => $this->input->post('create_date',TRUE),
			    );
                if(!empty($_FILES['foto']['name'])){
                    $data['foto'] = $this->_uploadFotoProduk();
                }

                $this->Produk_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('produk'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_produk')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Produk_model->get_by_id($id);

            if ($row) {
                $this->Produk_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('produk'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('produk'));
            }
        }
    }

    public function _rules() 
    {
	// $this->form_validation->set_rules('id_member', 'id member', 'trim|required');
	$this->form_validation->set_rules('id_jenis', 'id jenis', 'trim|required');
	$this->form_validation->set_rules('nama_produk', 'nama produk', 'trim|required');
	// $this->form_validation->set_rules('foto', 'foto', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');
	// $this->form_validation->set_rules('link', 'link', 'trim|required');
	// $this->form_validation->set_rules('create_date', 'create date', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    private function _uploadFotoProduk()
    {
        $config['upload_path']          = './uploads/foto_produk/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = date('Ymd').'-'.uniqid();
        $config['overwrite']            = true;
        // $config['max_size']             = 1024; // 1MB

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data("file_name");
        }
        
        return "gagal";
    }

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-16 16:22:01 */
/* http://harviacode.com */