<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Majalah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Majalah_model');
        $this->load->library('form_validation');
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->library('ion_auth_acl');
        $this->load->helper(['url', 'language', 'download']);
        $this->load->library('datatables');
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_majalah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('majalah/majalah_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('member')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Majalah_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_majalah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Majalah_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id' => $row->id,
			'judul' => $row->judul,
			'foto' => $row->foto,
			'file' => $row->file,
			'ket' => $row->ket,
			'create_date' => $row->create_date,
		    );
                $this->load->view('majalah/majalah_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('majalah'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_majalah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('majalah/create_action'),
			    'id' => set_value('id'),
			    'judul' => set_value('judul'),
			    'foto' => set_value('foto'),
			    'file' => set_value('file'),
			    'ket' => set_value('ket'),
			    'create_date' => set_value('create_date'),
			);
            $this->load->view('majalah/majalah_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_majalah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'judul' => $this->input->post('judul',TRUE),
					'foto' => $this->_uploadFotoMajalah(),
					'file' => $this->_uploadFileMajalah(),
					'ket' => $this->input->post('ket',TRUE),
					'create_date' => date('Y-m-d h:m:s'),
			    );
                $this->Majalah_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('majalah'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_majalah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Majalah_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('majalah/update_action'),
					'id' => set_value('id', $row->id),
					'judul' => set_value('judul', $row->judul),
					'foto' => set_value('foto', $row->foto),
					'file' => set_value('file', $row->file),
					'ket' => set_value('ket', $row->ket),
					'create_date' => set_value('create_date', $row->create_date),
			    );
                $this->load->view('majalah/majalah_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('majalah'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_majalah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
					'judul' => $this->input->post('judul',TRUE),
					// 'foto' => $this->input->post('foto',TRUE),
					// 'file' => $this->input->post('file',TRUE),
					'ket' => $this->input->post('ket',TRUE),
					// 'create_date' => $this->input->post('create_date',TRUE),
			    );
                if(!empty($_FILES['foto']['name'])){
                    $data['foto'] = $this->_uploadFotoMajalah();
                }

                if(!empty($_FILES['file']['name'])){
                    $data['file'] = $this->_uploadFileMajalah();
                }

                $this->Majalah_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('majalah'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_majalah')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Majalah_model->get_by_id($id);

            if ($row) {
                $this->Majalah_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('majalah'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('majalah'));
            }
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('judul', 'judul', 'trim|required');
    	// $this->form_validation->set_rules('foto', 'foto', 'trim|required');
    	// $this->form_validation->set_rules('file', 'file', 'trim|required');
    	$this->form_validation->set_rules('ket', 'ket', 'trim|required');
    	// $this->form_validation->set_rules('create_date', 'create date', 'trim|required');

    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    private function _uploadFotoMajalah()
    {
        $config['upload_path']          = './uploads/foto_majalah/';
        $config['allowed_types']        = 'jpeg|jpg|png|pdf|docx|doc|pptx|ppt';
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

    private function _uploadFileMajalah()
    {
        $config2['upload_path']          = './uploads/file_majalah/';
        $config2['allowed_types']        = 'jpeg|jpg|png|pdf|docx|doc|pptx|ppt';
        $config2['file_name']            = date('Ymd').'-'.uniqid();
        $config2['overwrite']            = true;
        // $config2['max_size']             = 1024; // 1MB

        $this->load->library('upload', $config2);
        $this->upload->initialize($config2);

        if ($this->upload->do_upload('file')) {
            return $this->upload->data("file_name");
        }
        
        return "gagal";
    }

    public function download($id)
    {
        $majalah = $this->db->where('id',$id)->get('majalah');
        $cek = $majalah->num_rows();
        if($cek > 0){
            $row = $majalah->row();
            $data['download'] = ($row->download+1);
            $update = $this->Majalah_model->update($id, $data);
            if($this->db->affected_rows() > 0){
                $file_ = explode(".",$row->file);
                $ext = $file_[1];
                force_download($row->judul.'.'.$ext, file_get_contents('uploads/file_majalah/'.$row->file));
            }
        }else{
            echo "Majalah tidak ditemukan";
        }
    }

}

/* End of file Majalah.php */
/* Location: ./application/controllers/Majalah.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-18 14:17:52 */
/* http://harviacode.com */