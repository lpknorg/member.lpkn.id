<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Validasi_member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->library('form_validation');
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->library('ion_auth_acl');
        $this->load->helper(['url', 'language', 'tgl_indo']);
        $this->load->library('datatables');
        // $this->lang->load('auth');
        // if (!$this->ion_auth->logged_in())
        // {
        //     redirect('auth/login', 'refresh');
        // }
    }

    public function index()
    {
        $this->load->view('validasi_member');
    }

    public function cekvalidasi()
    {
        $no_kta = $this->input->post('no_kta');
        $cari = $this->db->where('no_member', $no_kta)->get('member');
        if($cari->num_rows() > 0){
            $member = $cari->row();
            $user = $this->db->where('username',$member->nik)->get('users')->row();
            $this->res['success'] = true;
            $this->res['id_member'] = $user->id;
            $this->res['msg'] = "Berhasil ditemukan";
        }else{
            $this->res['success'] = false;
            $this->res['msg'] = "No.KTA tidak ditemukan";
        }
        echo json_encode($this->res);
    }

    public function get_id($id)
    {
        $group_name = $this->ion_auth->get_users_groups($id)->row()->name;
        $user = $this->db->where('id', $id)->get('users')->row();
        $member = $this->db->where('nik', $user->username)->get('member')->row();
        $data = array(
            'no_kta' => $member->no_member,
            'nama_lengkap' => $member->nama_lengkap,
            'tgl_gabung' => date_indo(substr($member->create_date,0,10)),
            'status' =>  $group_name = 'member' ? 'Aktif' : 'Tidak aktif',
        );
        $this->load->view('get_validasi', $data);
    }

}