<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct()
    {
        parent::__construct();
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_dashboard')){
            show_error('You must be an administrators to view this page.');
        }else{
            if ($this->ion_auth->in_group('member')){
                $this->load->view('profile/member_dashboard');
            }elseif ($this->ion_auth->in_group('register')) {
                $this->load->view('profile/member_dashboard');
            }elseif ($this->ion_auth->in_group('expired')) {
                $this->load->view('profile/member_dashboard');
            }else{
                $this->load->view('dashboard');
            }
			// $this->load->view('dashboard');
		}
	}
}
