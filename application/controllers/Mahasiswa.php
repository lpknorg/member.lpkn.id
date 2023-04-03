<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_mahasiswa')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('mahasiswa/mahasiswa_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_mahasiswa')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Mahasiswa_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_mahasiswa')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Mahasiswa_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id_mahasiswa' => $row->id_mahasiswa,
			'NIM' => $row->NIM,
			'nama_depan' => $row->nama_depan,
			'nama_belakang' => $row->nama_belakang,
			'email' => $row->email,
            'kode_prodi' => $row->kode_prodi,
			'kode_semester' => $row->kode_semester,
			'tmpt_lahir' => $row->tmpt_lahir,
			'tgl_lahir' => date_format(date_create($row->tgl_lahir),"d/m/Y"),
			'jenis_kelamin' => $row->jenis_kelamin,
			'alamat' => $row->alamat,
		    );
                $this->load->view('mahasiswa/mahasiswa_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('mahasiswa'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_mahasiswa')){
            show_error('You must be an administrators to view this page.');
        }else{
            $prodi = $this->db->get('prodi')->result();
            $data = array(
                'button' => 'Create',
                'action' => site_url('mahasiswa/create_action'),
			    'id_mahasiswa' => set_value('id_mahasiswa'),
			    'NIM' => set_value('NIM'),
			    'nama_depan' => set_value('nama_depan'),
			    'nama_belakang' => set_value('nama_belakang'),
			    'email' => set_value('email'),
                'list_prodi' => $prodi,
                'kode_prodi' => set_value('kode_prodi'),
			    'kode_semester' => set_value('kode_semester'),
			    'tmpt_lahir' => set_value('tmpt_lahir'),
			    'tgl_lahir' => set_value('tgl_lahir'),
			    'jenis_kelamin' => set_value('jenis_kelamin'),
			    'alamat' => set_value('alamat'),
			);
            $this->load->view('mahasiswa/mahasiswa_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_mahasiswa')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'NIM' => $this->input->post('NIM',TRUE),
					'nama_depan' => $this->input->post('nama_depan',TRUE),
					'nama_belakang' => $this->input->post('nama_belakang',TRUE),
					'email' => $this->input->post('email',TRUE),
                    'kode_prodi' => $this->input->post('kode_prodi',TRUE),
					'kode_semester' => $this->input->post('kode_semester',TRUE),
					'tmpt_lahir' => $this->input->post('tmpt_lahir',TRUE),
					'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
					'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
					'alamat' => $this->input->post('alamat',TRUE),
			    );
                $identity = $this->input->post('NIM');
                $password = $this->input->post('password');
                $email = $this->input->post('email');
                $additional_data = [
                    'username' => $this->input->post('NIM'),
                    'first_name' => $this->input->post('nama_depan'),
                    'last_name' => $this->input->post('nama_belakang'),
                    'company' => $this->input->post('Mahasiswa'),
                    'phone' => '6221',
                ];
                $this->Mahasiswa_model->insert($data);
                if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data))
                {
                    $id_user = $this->db->query("SELECT id FROM users WHERE email = '".$email."'")->row();
                    $this->ion_auth->add_to_group(3, $id_user->id);
                    $this->ion_auth->remove_from_group(2, $id_user->id);
                }
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('mahasiswa'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_mahasiswa')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Mahasiswa_model->get_by_id($id);

            if ($row) {
                $prodi = $this->db->get('prodi')->result();
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('mahasiswa/update_action'),
					'id_mahasiswa' => set_value('id_mahasiswa', $row->id_mahasiswa),
					'NIM' => set_value('NIM', $row->NIM),
					'nama_depan' => set_value('nama_depan', $row->nama_depan),
					'nama_belakang' => set_value('nama_belakang', $row->nama_belakang),
					'email' => set_value('email', $row->email),
                    'list_prodi' => $prodi,
                    'kode_prodi' => set_value('kode_prodi', $row->kode_prodi),
					'kode_semester' => set_value('kode_semester', $row->kode_semester),
					'tmpt_lahir' => set_value('tmpt_lahir', $row->tmpt_lahir),
					'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
					'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
					'alamat' => set_value('alamat', $row->alamat),
			    );
                $this->load->view('mahasiswa/mahasiswa_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('mahasiswa'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_mahasiswa')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_mahasiswa', TRUE));
            } else {
                $data = array(
					'NIM' => $this->input->post('NIM',TRUE),
					'nama_depan' => $this->input->post('nama_depan',TRUE),
					'nama_belakang' => $this->input->post('nama_belakang',TRUE),
					'email' => $this->input->post('email',TRUE),
                    'kode_prodi' => $this->input->post('kode_prodi',TRUE),
					'kode_semester' => $this->input->post('kode_semester',TRUE),
					'tmpt_lahir' => $this->input->post('tmpt_lahir',TRUE),
					'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
					'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
					'alamat' => $this->input->post('alamat',TRUE),
			    );
                $nim = $this->input->post('NIM');
                $get_user = $this->db->where('username',$nim)->get('users')->row();
                $data_auth = [
                    'username' => $this->input->post('NIM'),
                    'email' => $this->input->post('email'),
                    'first_name' => $this->input->post('nama_depan'),
                    'last_name' => $this->input->post('nama_belakang'),
                ];
                // update the password if it was posted
                if ($this->input->post('password'))
                {
                    $data_auth['password'] = $this->input->post('password');
                }
                $this->Mahasiswa_model->update($this->input->post('id_mahasiswa', TRUE), $data);
                if ($this->ion_auth->update($get_user->id, $data_auth))
                {
                    $this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('mahasiswa'));
                }else{
                    $this->session->set_flashdata('message', 'Update Record Error');
                    redirect(site_url('mahasiswa'));
                }
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_mahasiswa')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Mahasiswa_model->get_by_id($id);

            if ($row) {
                $this->Mahasiswa_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('mahasiswa'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('mahasiswa'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('NIM', 'nim', 'trim|required');
	$this->form_validation->set_rules('nama_depan', 'nama depan', 'trim|required');
	$this->form_validation->set_rules('nama_belakang', 'nama belakang', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
    $this->form_validation->set_rules('kode_prodi', 'kode prodi', 'trim|required');
	$this->form_validation->set_rules('kode_semester', 'kode kode_semester', 'trim|required');
	$this->form_validation->set_rules('tmpt_lahir', 'tmpt lahir', 'trim|required');
	$this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

	$this->form_validation->set_rules('id_mahasiswa', 'id_mahasiswa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-26 18:44:45 */
/* http://harviacode.com */