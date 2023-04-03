<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_member')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('member/member_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_member')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Member_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_member')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Member_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id' => $row->id,
			'nik' => $row->nik,
			'email' => $row->email,
			'nama_lengkap' => $row->nama_lengkap,
			'alamat_lengkap' => $row->alamat_lengkap,
			'create_date' => $row->create_date,
		    );
                $this->load->view('member/member_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('member'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_member')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('member/create_action'),
			    'id' => set_value('id'),
			    'nik' => set_value('nik'),
			    'email' => set_value('email'),
			    'nama_lengkap' => set_value('nama_lengkap'),
			    'alamat_lengkap' => set_value('alamat_lengkap'),
			    'create_date' => set_value('create_date'),
			);
            $this->load->view('member/member_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_member')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'nik' => $this->input->post('nik',TRUE),
					'email' => $this->input->post('email',TRUE),
					'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
					'alamat_lengkap' => $this->input->post('alamat_lengkap',TRUE),
					'create_date' => $this->input->post('create_date',TRUE),
			    );
                $this->Member_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('member'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_member')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Member_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('member/update_action'),
					'id' => set_value('id', $row->id),
					'nik' => set_value('nik', $row->nik),
					'email' => set_value('email', $row->email),
					'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
					'alamat_lengkap' => set_value('alamat_lengkap', $row->alamat_lengkap),
					'create_date' => set_value('create_date', $row->create_date),
			    );
                $this->load->view('member/member_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('member'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_member')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
					'nik' => $this->input->post('nik',TRUE),
					'email' => $this->input->post('email',TRUE),
					'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
					'alamat_lengkap' => $this->input->post('alamat_lengkap',TRUE),
					'create_date' => $this->input->post('create_date',TRUE),
			    );

                $this->Member_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('member'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_member')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Member_model->get_by_id($id);

            if ($row) {
                $this->Member_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('member'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('member'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
	$this->form_validation->set_rules('alamat_lengkap', 'alamat_lengkap', 'trim|required');
	$this->form_validation->set_rules('create_date', 'create date', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Member.php */
/* Location: ./application/controllers/Member.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-16 13:47:51 */
/* http://harviacode.com */