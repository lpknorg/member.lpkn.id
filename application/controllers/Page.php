<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('profile_model');
        $this->load->model('Berita_model');
        $this->load->library('form_validation');
        $this->load->library(['ion_auth', 'form_validation', 'kpdf']);
        $this->load->library('ion_auth_acl');
        $this->load->helper(['url', 'language']);
        $this->load->helper('tgl_indo');
        $this->load->library('datatables');
        $this->lang->load('auth');
    }

	public function index()
	{
		$home_event = $this->getHomeEvent();
		$data = array(
			'home_event' => json_decode($home_event, TRUE), 
		);
		$this->load->view('landing/layout/header');
		$this->load->view('landing/page/beranda', $data);
		$this->load->view('landing/layout/footer');
	}

	public function profile()
	{
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }else{
        	if(empty($this->input->get('active'))){
	        	$active = 'recomended';
        	}else{
        		$active = $this->input->get('active');
        	}
        	$user = $this->ion_auth->user()->row();
        	$member = $this->profile_model->get_member($user->username);
        	$new_event = $this->getNewEvent();
        	$waiting_event = $this->getEventWaiting($user->email);
        	$my_event = $this->getMyEvent($user->email);
        	$jum_event = $this->countEvent($user->email);
        	$jum_sertif = $this->getCountSertif($user->email);
        	$list_sertif = $this->getListSertif($user->email);
        	$data = array(
        		'active' => $active,
        		'member' => $member,
        		'new_event' => json_decode($new_event, TRUE), 
        		'waiting_event' => json_decode($waiting_event, TRUE), 
        		'list_sertif' => json_decode($list_sertif, TRUE), 
        		'my_event' => json_decode($my_event, TRUE), 
        		'jum_event' => json_decode($jum_event, TRUE), 
        		'jum_sertif' => json_decode($jum_sertif, TRUE), 
        	);
			$this->load->view('landing/layout/header');
			$this->load->view('landing/page/profile',$data);
			$this->load->view('landing/layout/footer');
        }
	}

	public function afiliasi()
	{
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }else{
        	if(empty($this->input->get('page'))){
	        	$page = 'recomended';
        	}else{
        		$page = $this->input->get('page');
        	}
        	$user = $this->ion_auth->user()->row();
        	$member = $this->profile_model->get_member($user->username);
        	$reg_list = $this->getReg($member->ref);
        	$reg_pay_list = $this->getRegPay($member->ref);
        	$bonus_list = $this->getBonus($member->ref);
        	$data = array(
        		'page' => $page,
        		'member' => $member,
        		'reg_list' => json_decode($reg_list, TRUE),
        		'reg_pay_list' => json_decode($reg_pay_list, TRUE),
        		'bonus_list' => json_decode($bonus_list, TRUE), 
        	);
        	$pergerakan = $this->db->where('id_user', $user->id)->get('pergerakan_saldo')->num_rows();
        	if($pergerakan > 0){
        		$pendapatan = $this->profile_model->pendapatan($user->id);
        		$pencairan = $this->profile_model->pencairan($user->id);
        		$saldo = $pendapatan->nominal - $pencairan->nominal;
        	}else{
        		$saldo = 0;
        	}
        	$data['saldo'] = $saldo;
			$this->load->view('landing/layout/header');
			$this->load->view('landing/page/afiliasi',$data);
			$this->load->view('landing/layout/footer');
        }
	}

	public function add_saldo($id_event)
	{
        if (!$this->ion_auth->logged_in())
        {
            $this->res['success'] = false;
            $this->res['msg'] = "Anda sedang tidak login";
        }else{
        	$user = $this->ion_auth->user()->row();
        	$member = $this->profile_model->get_member($user->username);
        	$data = array('ref' => $member->ref, 'id_event' => $id_event );
        	$get_bonus = json_decode($this->addsaldo($data));
        	$get_bonus->ref_event->id_user = $user->id;
        	$insert = $get_bonus->ref_event;
    		$input_pendapatan = $this->db->insert('pergerakan_saldo', $insert);
    		if($input_pendapatan){
    			$update_ref = json_decode($this->updateRef($data));
    			if($update_ref->success == true){
		            $this->res['success'] = true;
		            $this->res['msg'] = "Berhasil menambah saldo ";
    			}else{
		            $this->res['success'] = false;
		            $this->res['msg'] = "Gagal Update Status";
    			}
    		}else{
	            $this->res['success'] = false;
	            $this->res['msg'] = "Gagal Input";
    		}
        }
	    echo json_encode($this->res);
	}

	public function act_ref()
	{
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }else{
        	$user = $this->ion_auth->user()->row();
        	$data = array('ref' => $this->generate_referral(6), );
	    	$this->db->where('nik', $user->username);
	    	$upload = $this->db->update('member', $data);
	    	redirect(site_url('page/profile?active=afiliasi'));
        }
	}

	public function update_ref()
	{
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }else{
        	$user = $this->ion_auth->user()->row();
        	$data = array(
        		'bank_rek_ref' => $this->input->post('bank_rek_ref'), 
        		'no_rek_ref' => $this->input->post('no_rek_ref'), 
        		'an_rek_ref' => $this->input->post('an_rek_ref'), 
        	);
	    	$this->db->where('nik', $user->username);
	    	$upload = $this->db->update('member', $data);
	    	redirect(site_url('page/profile?active=afiliasi'));
        }
	}

	public function update_profile()
	{
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }else{
        	$user = $this->ion_auth->user()->row();
        	$data_member = array(
        		'nama_lengkap' => $this->input->post('nama_lengkap'), 
        		'alamat_lengkap' => $this->input->post('alamat_lengkap'), 
        		'no_hp' => $this->input->post('no_hp'), 
        		'tempat_lahir' => $this->input->post('tempat_lahir'), 
        		'tgl_lahir' => $this->input->post('tgl_lahir'), 
        		'instansi' => $this->input->post('instansi'), 
        	);
        	$data_user = array(
        		'first_name' => $this->input->post('nama_lengkap'), 
        		'last_name' => '', 
        		'phone' => $this->input->post('no_hp'), 
        		'company' => $this->input->post('instansi'), 
        	);
        	$update_member = $this->profile_model->update_member($user->username, $data_member);
        	$update_member = $this->profile_model->update_user($user->username, $data_user);
        	redirect(site_url('page/profile?active=profile'));
        }
	}

    public function updatepp()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }else{
	        $pp = $this->_uploadFotoProfile();
	        if($pp == 'gagal'){
	            $this->res['success'] = false;
	            $this->res['msg'] = "Gagal, mungkin file terlalu besar.";
	        }else{
	        	$user = $this->ion_auth->user()->row();
	            $data = array(
	                'pp' => $pp,
	            );
	            $this->db->where('nik', $user->username);
	            $update = $this->db->update('member', $data);
	            if($update){
	                $this->res['success'] = true;
	                $this->res['msg'] = "Berhasil merubah foto profile.";
	            }else{
	                $this->res['success'] = false;
	                $this->res['msg'] = "Gagal, mungkin file terlalu besar.";
	            }
	        }
	        echo json_encode($this->res);
	    }
    }

    private function _uploadFotoProfile()
    {
        $config['upload_path']          = './uploads/foto_profile/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = date('Ymd').'-'.uniqid();
        $config['overwrite']            = true;
        // $config['max_size']             = 1024; // 1MB

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto_profile')) {
            return $this->upload->data("file_name");
        }
        
        return "gagal";
    }

    public function getvideo($id)
    {
        $db_video = $this->db->where('id', $id)->get('video')->row();
        echo '        
        <div class="modal-content">
          <div class="modal-body mb-0 p-0">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half" id="yt-player">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$db_video->code.'"
                allowfullscreen></iframe>
            </div>
          </div>
        </div>
        ';
    }

    public function detailnews($slug)
    {
    	$this->db->where('slug', $slug);
    	$data = array('news' => $this->db->get('berita')->row(), );
		$this->load->view('landing/layout/header');
		$this->load->view('landing/page/news_detail', $data);
		$this->load->view('landing/layout/footer');
    }

    public function allnews($page = 0)
    {
		$this->load->library('pagination');
    	$berita = $this->db->limit(4, $page)->get('berita')->result();
    	$total_berita = $this->db->get('berita')->num_rows();
		$config['base_url'] = base_url().'page/allnews';
		$config['total_rows'] = $total_berita;
		$config['per_page'] = 4;

      	$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);    	// $this->db->where('slug', $slug);

    	$total_berita = $this->db->get('berita')->num_rows();
    	$data = array(
    		'total_berita' => $total_berita,
    		'berita' => $berita,
    		'pagination' => $this->pagination->create_links()
    	);
		$this->load->view('landing/layout/header');
		$this->load->view('landing/page/news_all', $data);
		$this->load->view('landing/layout/footer');
    }

    public function allvideo($page = 0)
    {
		$this->load->library('pagination');
    	$videos = $this->db->limit(6, $page)->get('video')->result();
    	$total_videos = $this->db->get('video')->num_rows();
		$config['base_url'] = base_url().'page/allvideo';
		$config['total_rows'] = $total_videos;
		$config['per_page'] = 6;

      	$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);    	// $this->db->where('slug', $slug);
    	
    	$data = array(
    		'total_videos' => $total_videos,
    		'videos' => $videos,
    		'pagination' => $this->pagination->create_links()
    	);
		$this->load->view('landing/layout/header');
		$this->load->view('landing/page/video_all', $data);
		$this->load->view('landing/layout/footer');
    }

    public function allevent($page = 0)
    {
		$this->load->library('pagination');
    	$event = json_decode($this->getEventAll($page));
		$config['base_url'] = base_url().'page/allevent';
		$config['total_rows'] = $event->count;
		$config['per_page'] = 9;
		// $config['use_page_numbers'] = true;

      	$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);
    	$data = array(
    		'event' => $event,
    		'pagination' => $this->pagination->create_links()
    	);
		$this->load->view('landing/layout/header');
		$this->load->view('landing/page/event_all', $data);
		$this->load->view('landing/layout/footer');
    }

    public function get_event($slug)
    {
    	if ($this->ion_auth->logged_in()){
	    	$user = $this->db->where('id', $this->ion_auth->get_user_id())->get('users')->row();
	    	$member = $this->db->where('nik',$user->username)->get('member')->row();
	    	$datapost = array('slug' => $slug, 'email' => $user->email );
	    	$event = json_decode($this->detailEvent($datapost));
	    	$data['detail_event'] = $event;
	    	$data['member'] = $member;
	    	if($event->status == 0){
	    		$this->load->view('landing/page/get_event', $data);
	    	}elseif($event->status == 1){
	    		$this->load->view('landing/page/get_event_status', $data);
	    		// echo "Terdaftar";
	    	}else{
	    		$this->load->view('landing/page/get_event_lunas', $data);
	    		// echo "Lunas";
	    	}
	    }else{
	    	$datapost = array('slug' => $slug);
	    	$event = json_decode($this->detailEventNew($datapost));
	    	$data['detail_event'] = $event;
	    	$this->load->view('landing/page/get_event_new', $data);
	    }
    }

	public function regis_event()
	{
		// $user = $this->ion_auth->user()->row();
		$user = $this->db->where('id', $this->ion_auth->get_user_id())->get('users')->row();
		$member = $this->db->where('nik', $user->username)->get('member')->row();
		$slug = $this->input->post('slug');
		$data = array(
			'id_event' => $this->input->post('id_event'), 
			'email' => $user->email, 
			'nama_lengkap' => $member->nama_lengkap,
			'alamat_lengkap' => $member->alamat_lengkap,
			'ref' => 'qwerty',
			'biaya' => $this->input->post('biaya'),
			'no_hp' => $user->phone
		);
		$response = $this->regisEvent($data);
		$getRes = json_decode($response, TRUE);
		if($getRes['status'] == 'sukses'){
	        $this->res['success'] = true;
	        $this->res['msg'] = 'Berhasil Mendaftar';
	        $this->res['slug'] = $slug;
	    }elseif($getRes['status'] == 'duplikat'){
	        $this->res['success'] = false;
	        $this->res['msg'] = 'Anda sudah terdaftar';
	    }else{
	        $this->res['success'] = false;
	        $this->res['msg'] = 'Gagal';
	    }
        echo json_encode($this->res);
	}

	public function upload_bukti()
	{
		$id_regis = $this->input->post('id_regis');
		$bukti =  new CURLFILE($_FILES['bukti']['tmp_name'], $_FILES['bukti']['type'], $_FILES['bukti']['name']);
		$slug = $this->input->post('slug');
		// $bukti = $this->input->post('bukti');
		$data = array('id_regis' => $id_regis, 'bukti' => $bukti );
		$upload = $this->uploadBukti($data);
		$getRes = json_decode($upload, TRUE);
		if($getRes['success'] == true){
	        $this->res['success'] = true;
	        $this->res['msg'] = $getRes['msg'];
	        $this->res['slug'] = $slug;
	    }else{
	        $this->res['success'] = false;
	        $this->res['msg'] = $getRes['msg'];
	    }
        echo json_encode($this->res);
	}

	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() === FALSE)
		{
			// display the form
			// set the flash data error message if there is one
			if(validation_errors()){
				$this->res['success'] = false;
				$this->res['msg'] = validation_errors();
			echo json_encode($this->res);
			}else{
				// $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['old_password'] = [
					'name' => 'old',
					'id' => 'old',
					'type' => 'password',
				];
				$this->data['new_password'] = [
					'name' => 'new',
					'id' => 'new',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				];
				$this->data['new_password_confirm'] = [
					'name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				];
				$this->data['user_id'] = [
					'name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
				];
				
				// render
				// $this->load->view('landing/layout/header');
				$this->load->view('landing/page/change_password', $this->data);
				// $this->load->view('landing/layout/footer');
			}
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				// $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->res['success'] = true;
                $this->res['msg'] = $this->ion_auth->messages();
                // $this->res['count'] = $total_update;
                $this->res['redirect'] = base_url('auth/logout');
				// $this->logout();
			}
			else
			{
                $this->res['success'] = false;
			}
		echo json_encode($this->res);
		}
	}

    public function generate_referral($length)
    {
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        return substr(str_shuffle($str_result), 0, $length);
    }


// { API
	private function detailEventNew($datapost)
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/event/event_detail_new',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $datapost,
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=5cd6067b59c73ae6f8c41f013de4839e3fa01a36'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }    
	private function detailEvent($datapost)
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/event/event_detail',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $datapost,
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=3a2cc7314a72b8e7b2a03e5b4f92606b95471631'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }    

    private function getNewEvent()
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/event',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=ll7c9n7fav9lv01otctbitrmjpjmmp4j'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }

    private function getHomeEvent()
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/event/home_event',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=ll7c9n7fav9lv01otctbitrmjpjmmp4j'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }

    private function getEventAll($page = 0)
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/event/event_page?page='.$page,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=ll7c9n7fav9lv01otctbitrmjpjmmp4j'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }

	private function countEvent($email)
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/event/count_event',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('email' => $email),
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=4ltaf1v8qloh96i2mp743n6rn9hbibil'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }    

    private function getEventWaiting($email)
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/event/waiting',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('email' => $email),
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=a83i2a5mmtv1rfb7voanijqalbuontnq'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }

    private function getMyEvent($email)
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/event/my_event',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('email' => $email),
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=i83u8739doieetvuv94lnnkf2mjg2pvs'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }
	private function getCountSertif($email)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://sertifikat.diklatonline.id/api/member/count_sertif',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('email' => $email),
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=34f1a293c68d66be51713edaef9996c46f476862'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

	private function getListSertif($email)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://sertifikat.diklatonline.id/api/member/list_sertif',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('email' => $email),
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=bf473e252ab962e8117a839b7de0889046813ae2'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

	private function regisEvent($data)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/action/regis_event',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $data,
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
		    'Cookie: ci_session=e40e0d7d948983435b6949a4df8efbfaf2238c4b'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

	private function uploadBukti($data)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/action/upload_bukti',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $data,
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
		    'Cookie: ci_session=e40e0d7d948983435b6949a4df8efbfaf2238c4b'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;
	}	
// }

    private function getReg($ref)
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/event/ref/'.$ref,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=ll7c9n7fav9lv01otctbitrmjpjmmp4j'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }

    private function getRegPay($ref)
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/event/ref_pay/'.$ref,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=ll7c9n7fav9lv01otctbitrmjpjmmp4j'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }

    private function getBonus($ref)
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/event/bonus/'.$ref,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Cookie: ci_session=ll7c9n7fav9lv01otctbitrmjpjmmp4j'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }

    private function addsaldo($data_post)
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/action/addsaldo',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $data_post,
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
		    'Cookie: ci_session=153fb99b834202b4f870350a8de40bb6cb0ac89f'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }
    
    private function updateRef($data_post)
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://event.lpkn.id/api/member/action/update_ref',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $data_post,
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
		    'Cookie: ci_session=153fb99b834202b4f870350a8de40bb6cb0ac89f'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }
    
    public function kta()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }else{
            $user = $this->ion_auth->user()->row();
            $member = $this->profile_model->get_member($user->username);
            $nim = $user->username;
            $pdf = new PDF_Code39();
            $pdf->AddPage();
            $pdf->Image(base_url().'assets/img/depan_cetak.jpg', 10, 10,180, 55);
            $pdf->Image(base_url()."uploads/foto_profile/".$member->pp, 18.5, 29, 15.1, 18.1);
            $pdf->Image(base_url().'barcode/qr_generator.php?code='.$user->username, 21, 49, 10, 10, "png");
    
            $pdf->AddFont('courier','','courier.php');  
            $pdf->SetFont('courier','b',11);
            $pdf->SetXY(55, 29);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(55, 23);
            $pdf->Cell(37,7,$user->first_name.' '.$user->last_name,0,4,'C');
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(55, 31);
            $pdf->Cell(37,7,$user->username,0,4,'C');
            // $pdf->Output();
            $pdf->Output('KTA '.$user->first_name.' '.$user->last_name.'.pdf', 'D');
        }
    }

    
}
