<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Video extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Video_model');
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
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_video')){
            show_error('You must be an administrators to view this page.');
        }else{
            if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('adminofficers')){
                $video = $this->db->get('video')->result();
                $data['video'] = $video;
                $this->load->view('video/video_list', $data);
            }else{
                $this->load->view('video/video_list_admin');
            }
        }
    } 

    public function getlistvideo()
    {
        $page =  $_GET['page'];
        $q = (empty($_GET['q'])) ? '' : str_replace('%20', ' ', $_GET['q']);
        $dballvideo = $this->Video_model->getSearch($q, $page);
        foreach($dballvideo as $list){
            echo '        
              <figure class="effect-milo">
                <img src="https://i3.ytimg.com/vi/'.$list->code.'/maxresdefault.jpg" alt="img03"/>
                <figcaption>
                  <!-- <h5>Tentang Bisnis Online</h5> -->
                  <p>
                    <b>'.$list->judul.'</b><br/>
                    <i>'.$list->ket.'</i><br/>
                    <a href="#" class="btn btn-outline-danger btn-sm mt-2" data-toggle="modal" data-target="#modal1" onclick="getVideo('.$list->id.')">Play <i class="fa fa-youtube-play fa-lg c-mt-4 fa-2x"></i></a>
                  </p>              
                </figcaption>     
              </figure>
            ';
        }
        exit;
    }

    public function getvideo($id)
    {
        $db_video = $this->db->where('id', $id)->get('video')->row();
        echo '        
        <div class="modal-content">
          <div class="modal-body mb-0 p-0">
            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half" id="yt-player">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$db_video->code.'"
                allowfullscreen></iframe>
            </div>
          </div>
        </div>
        ';
    }

    public function getytvideo($code)
    {
        echo '
            <div class="card">
                <div class="card-body video-container">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/'.$code.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            ';
    }

    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_video')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Video_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_video')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Video_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id' => $row->id,
			'judul' => $row->judul,
			'ket' => $row->ket,
			'code' => $row->code,
		    );
                $this->load->view('video/video_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('video'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_video')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('video/create_action'),
			    'id' => set_value('id'),
			    'judul' => set_value('judul'),
			    'ket' => set_value('ket'),
			    'code' => set_value('code'),
			);
            $this->load->view('video/video_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_video')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'judul' => $this->input->post('judul',TRUE),
					'ket' => $this->input->post('ket',TRUE),
					'code' => $this->input->post('code',TRUE),
			    );
                $this->Video_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('video'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_video')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Video_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('video/update_action'),
					'id' => set_value('id', $row->id),
					'judul' => set_value('judul', $row->judul),
					'ket' => set_value('ket', $row->ket),
					'code' => set_value('code', $row->code),
			    );
                $this->load->view('video/video_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('video'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_video')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
					'judul' => $this->input->post('judul',TRUE),
					'ket' => $this->input->post('ket',TRUE),
					'code' => $this->input->post('code',TRUE),
			    );

                $this->Video_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('video'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_video')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Video_model->get_by_id($id);

            if ($row) {
                $this->Video_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('video'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('video'));
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('judul', 'judul', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');
	$this->form_validation->set_rules('code', 'code', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Video.php */
/* Location: ./application/controllers/Video.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-05 16:30:10 */
/* http://harviacode.com */