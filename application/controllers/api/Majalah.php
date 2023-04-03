<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Majalah extends BD_Controller {
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

    public function index_get()
    {
        $this->db->select('id, judul, concat("'.base_url().'uploads/foto_majalah/", foto) AS foto, concat("'.base_url().'majalah/download/", id) AS download_file, ket, download', false);
        $data = $this->db->get('majalah')->result();
        // $this->set_response($data, REST_Controller::HTTP_OK);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}