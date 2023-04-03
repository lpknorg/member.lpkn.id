<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class No_member extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // $this->load->library('ion_auth');
        // $this->load->library('ion_auth_acl');
        // $this->auth();
        $this->output->set_header('HTTP/1.0 200 OK');
        $this->output->set_header('HTTP/1.1 200 OK');
        // $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', $last_update).' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_content_type('css', 'utf-8');

    }

    public function index_get(){
        $res['no_member'] = $this->addNoMember(35);
        $res['success'] = true;
        $this->response($res, 200);
    }

    private function addNoMember($id_user){
        $user = $this->db->where('id', $id_user)->get('users')->row();
        $count = $this->db->where('no_member !=', NULL)->get('member')->num_rows();
        $no_get = $count > 0 ? $count+1 : 1;
        $urut = str_pad(($no_get), 5, '0', STR_PAD_LEFT);
        $no_member = $urut.'/IV/'.date('Y'); //sementara
        // $no_member = $urut.'/A-AVENDO/'.$this->getRomawi().'/'.date('Y');
        $data['no_member'] = $no_member;
        $this->db->where('nik', $user->username);
        $update = $this->db->update('member', $data);
        return $no_member;
    }

    private function getRomawi(){
        switch (date('m')){
            case 1: 
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }   
}