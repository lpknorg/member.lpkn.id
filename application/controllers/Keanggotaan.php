<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keanggotaan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->library('ion_auth_acl');

        if( ! $this->ion_auth->logged_in() )
            redirect('auth/login');
    }

	public function index()
	{
        $this->load->view('profile/keanggotaan_page');
	}
}
