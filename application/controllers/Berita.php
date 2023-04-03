<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Berita extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Berita_model');
        $this->load->library('form_validation');
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->library('ion_auth_acl');
        $this->load->helper(['url', 'language']);
        $this->load->helper('tgl_indo');
        $this->load->library('datatables');
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('berita/berita_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Berita_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Berita_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id' => $row->id,
			'kategori_berita' => $row->kategori_berita,
			'judul' => $row->judul,
			'slug' => $row->slug,
			'gambar' => $row->gambar,
			'isi' => $row->isi,
			'create_by' => $row->create_by,
			'create_at' => $row->create_at,
			'update_by' => $row->update_by,
			'update_at' => $row->update_at,
		    );
                $this->load->view('berita/berita_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('berita'));
            }
        }
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './uploads/news/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = uniqid();
        $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data("file_name");
        }
        
        return "default.jpg";
    }

    function tinymce_upload() {
        $config['upload_path'] = './uploads/news/tiny/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file')) {
            $this->output->set_header('HTTP/1.0 500 Server Error');
            exit;
        } else {
            $file = $this->upload->data();
            $this->output
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode(['location' => base_url().'uploads/news/tiny/'.$file['file_name']]))
                ->_display();
            exit;
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $kategori_berita = $this->db->get('kategori_berita')->result();
            $data = array(
                'button' => 'Create',
                'action' => site_url('berita/create_action'),
			    'id' => set_value('id'),
			    'kategori_berita' => set_value('kategori_berita'),
			    'judul' => set_value('judul'),
			    'slug' => set_value('slug'),
			    'gambar' => set_value('gambar'),
			    'isi' => set_value('isi'),
			    'create_by' => set_value('create_by'),
			    'create_at' => set_value('create_at'),
			    'update_by' => set_value('update_by'),
			    'update_at' => set_value('update_at'),
                'list_kategori' => $kategori_berita,
			);
            $this->load->view('berita/berita_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'kategori_berita' => $this->input->post('kategori_berita',TRUE),
					'judul' => $this->input->post('judul',TRUE),
					'slug' => url_title($this->input->post('judul'), 'dash', true),
					'gambar' => $this->_uploadImage(),
					'isi' => $this->input->post('isi',FALSE),
					'create_by' => $this->ion_auth->get_user_id(),
					'create_at' => date('Y-m-d H:i:s'),
			    );
                $this->Berita_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('berita'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Berita_model->get_by_id($id);
            $kategori_berita = $this->db->get('kategori_berita')->result();
            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('berita/update_action'),
					'id' => set_value('id', $row->id),
					'kategori_berita' => set_value('kategori_berita', $row->kategori_berita),
					'judul' => set_value('judul', $row->judul),
					'slug' => set_value('slug', $row->slug),
					'gambar' => set_value('gambar', $row->gambar),
					'isi' => set_value('isi', $row->isi),
					'create_by' => set_value('create_by', $row->create_by),
					'create_at' => set_value('create_at', $row->create_at),
					'update_by' => set_value('update_by', $row->update_by),
					'update_at' => set_value('update_at', $row->update_at),
                    'list_kategori' => $kategori_berita,
			    );
                $this->load->view('berita/berita_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('berita'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
					'kategori_berita' => $this->input->post('kategori_berita',TRUE),
					'judul' => $this->input->post('judul',TRUE),
					'slug' => url_title($this->input->post('judul'), 'dash', true),
					// 'gambar' => $this->_uploadImage(),
					'isi' => $this->input->post('isi',FALSE),
					'update_by' => $this->ion_auth->get_user_id(),
					'update_at' => date('Y-m-d H:i:s'),
			    );
                if(!empty($_FILES['gambar']['name'])){
                    $data['gambar'] = $this->_uploadImage();
                }

                $this->Berita_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('berita'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_berita')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Berita_model->get_by_id($id);

            if ($row) {
                $this->Berita_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('berita'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('berita'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kategori_berita', 'kategori berita', 'trim|required');
	$this->form_validation->set_rules('judul', 'judul', 'trim|required');
	// $this->form_validation->set_rules('slug', 'slug', 'trim|required');
	// $this->form_validation->set_rules('gambar', 'gambar', 'trim|required');
	$this->form_validation->set_rules('isi', 'isi', 'trim|required');
	// $this->form_validation->set_rules('create_by', 'create by', 'trim|required');
	// $this->form_validation->set_rules('create_at', 'create at', 'trim|required');
	// $this->form_validation->set_rules('update_by', 'update by', 'trim|required');
	// $this->form_validation->set_rules('update_at', 'update at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Berita.php */
/* Location: ./application/controllers/Berita.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-08-13 10:07:38 */
/* http://harviacode.com */