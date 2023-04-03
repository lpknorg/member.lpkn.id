<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tahun_akademik extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tahun_akademik_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_tahun_akademik')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('tahun_akademik/tahun_akademik_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_tahun_akademik')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Tahun_akademik_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_tahun_akademik')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Tahun_akademik_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id_tahun_akademik' => $row->id_tahun_akademik,
			'kode_tahun_akademik' => $row->kode_tahun_akademik,
			'nama_tahun_akademik' => $row->nama_tahun_akademik,
			'status' => $row->status,
			'ket' => $row->ket,
		    );
                $this->load->view('tahun_akademik/tahun_akademik_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('tahun_akademik'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_tahun_akademik')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('tahun_akademik/create_action'),
			    'id_tahun_akademik' => set_value('id_tahun_akademik'),
			    'kode_tahun_akademik' => set_value('kode_tahun_akademik'),
			    'nama_tahun_akademik' => set_value('nama_tahun_akademik'),
			    'ket' => set_value('ket'),
			);
            $this->load->view('tahun_akademik/tahun_akademik_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_tahun_akademik')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'kode_tahun_akademik' => $this->input->post('kode_tahun_akademik',TRUE),
					'nama_tahun_akademik' => $this->input->post('nama_tahun_akademik',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );
                $this->Tahun_akademik_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('tahun_akademik'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_tahun_akademik')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Tahun_akademik_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('tahun_akademik/update_action'),
					'id_tahun_akademik' => set_value('id_tahun_akademik', $row->id_tahun_akademik),
					'kode_tahun_akademik' => set_value('kode_tahun_akademik', $row->kode_tahun_akademik),
					'nama_tahun_akademik' => set_value('nama_tahun_akademik', $row->nama_tahun_akademik),
					'ket' => set_value('ket', $row->ket),
			    );
                $this->load->view('tahun_akademik/tahun_akademik_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('tahun_akademik'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_tahun_akademik')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_tahun_akademik', TRUE));
            } else {
                $data = array(
					'kode_tahun_akademik' => $this->input->post('kode_tahun_akademik',TRUE),
					'nama_tahun_akademik' => $this->input->post('nama_tahun_akademik',TRUE),
					'ket' => $this->input->post('ket',TRUE),
			    );

                $this->Tahun_akademik_model->update($this->input->post('id_tahun_akademik', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('tahun_akademik'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_tahun_akademik')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Tahun_akademik_model->get_by_id($id);

            if ($row) {
                $this->Tahun_akademik_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('tahun_akademik'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('tahun_akademik'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_tahun_akademik', 'kode tahun akademik', 'trim|required');
	$this->form_validation->set_rules('nama_tahun_akademik', 'nama tahun akademik', 'trim|required');
	// $this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');

	$this->form_validation->set_rules('id_tahun_akademik', 'id_tahun_akademik', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function deactivate($id){
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_tahun_akademik')){
            $this->res['success'] = false;
            $this->res['msg'] = "You not have Permission";
        }else{
            $data = array(
                'status' => 0
            );
            $this->Tahun_akademik_model->update($id, $data);
            $this->res['success'] = true;
            $this->res['msg'] = "Tahun akademik Deactivated";
        }
        echo json_encode($this->res);
    }

    public function activate($id){
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_tahun_akademik')){
            $this->res['success'] = false;
            $this->res['msg'] = "You not have Permission";
        }else{
            $cek = $this->db->where('status', 1)->get('tahun_akademik')->num_rows();
            if($cek == 0){
                $data = array(
                    'status' => 1
                );
                $this->Tahun_akademik_model->update($id, $data);
                $this->res['success'] = true;
                $this->res['msg'] = "Tahun akademik Activated";
            }else{
                $this->res['success'] = false;
                $this->res['msg'] = "Tahun akademik hanya satu yang boleh aktive";
            }
        }
        echo json_encode($this->res);
    }

}

/* End of file Tahun_akademik.php */
/* Location: ./application/controllers/Tahun_akademik.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-23 10:15:34 */
/* http://harviacode.com */