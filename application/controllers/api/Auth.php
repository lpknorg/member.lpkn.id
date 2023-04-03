<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Auth extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->model('profile_model');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('M_main');
    }

    public function index_get()
    {
        $kunci = $this->config->item('thekey');
        $authHeader = substr($this->input->request_headers()['Authorization'], 7);  
        $decoded = JWT::decode($authHeader, $kunci, array('HS256','HS512','HS384','RS256','RS384','RS512'));
        $user = $this->db->where('id', $decoded->id)->get('users')->row();
        $member = $this->db->where('nik', $user->username)->get('member')->row();
        $data = array(
            'token_detail' => $decoded,
            'user' => $user,
            'member' => $member
        );
        $this->response($data, REST_Controller::HTTP_OK);
        
    }

    
    /*
    public function login_post()
    {
        $u = $this->post('username'); //Username Posted
        $p = sha1($this->post('password')); //Pasword Posted
        $q = array('username' => $u); //For where query condition
        $kunci = $this->config->item('thekey');
        $invalidLogin = ['status' => 'Invalid Login']; //Respon if login invalid
        $val = $this->M_main->get_user($q)->row(); //Model to get single data row from database base on username
        if($this->M_main->get_user($q)->num_rows() == 0){$this->response($invalidLogin, REST_Controller::HTTP_NOT_FOUND);}
		$match = $val->password;   //Get password for user from database
        if($p == $match){  //Condition if password matched
        	$token['id'] = $val->id;  //From here
            $token['username'] = $u;
            $date = new DateTime();
            $token['iat'] = $date->getTimestamp();
            $token['exp'] = $date->getTimestamp() + 60*60*5; //To here is to generate token
            $output['token'] = JWT::encode($token,$kunci ); //This is the output token
            $this->set_response($output, REST_Controller::HTTP_OK); //This is the respon if success
        }
        else {
            $this->set_response($invalidLogin, REST_Controller::HTTP_NOT_FOUND); //This is the respon if failed
        }
    }
    */
    
    public function login_post()
    {
        
        $kunci = $this->config->item('thekey');
        $invalidLogin = ['status' => 'Invalid Login']; //Respon if login invalid
        if ($this->ion_auth->login($this->post('username'), $this->post('password')))
        {
            $user_log = $this->ion_auth->user()->row();
            $token['id'] = $user_log->id;  //From here
            $token['username'] = $this->post('username');
            $token['user_group'] = 'member';
            $date = new DateTime();
            $token['iat'] = $date->getTimestamp();
            // $token['exp'] = $date->getTimestamp() + 60*60*5; //To here is to generate token
            $user = $this->db->where('id', $user_log->id)->get('users')->row();
            $member = $this->db->where('nik', $user->username)->get('member')->row();
            $output['token'] = JWT::encode($token,$kunci ); //This is the output token
            $output['user'] = $user;
            $output['member'] = $member;
            $this->set_response($output, REST_Controller::HTTP_OK); //This is the respon if success
        }
        else {
            $this->set_response($invalidLogin, REST_Controller::HTTP_NOT_FOUND); //This is the respon if failed
        }
        
        /*
        $invalidLogin = ['username' => $this->post('username'), 'password' => $this->post('password')]; //Respon if login invalid
        $this->set_response($invalidLogin, REST_Controller::HTTP_NOT_FOUND);
        */
    }
    
    private function generate_nik($length)
    {
        $str_result = '1234567890';
        return substr(str_shuffle($str_result), 0, $length);
    }
    
    private function send_email_activation($identity, $code)
    {
    	$row_user = $this->db->where('email', $identity)->get('users')->row();
    	$data = array('id' => $row_user->id,'first_name' => $row_user->first_name, 'code' => $code );
        $massage = $this->load->view('auth/email/email_activation.php', $data, TRUE);
        // Built by LucyBot. www.lucybot.com
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/json"
        ));
        curl_setopt($curl, CURLOPT_URL,
          "https://api.smtp2go.com/v3/email/send"
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
          "api_key" => "api-D8983966080211ED8BA0F23C91C88F4E",
          "sender" => "Member LPKN <info@lpkn.info>",
          "to" => array(
            0 => $identity
          ),
          "text_body" => "Keamanan",
          "html_body" => $massage,
          "subject" => "Verifikasi Akun"
        )));
        $result = curl_exec($curl);
        // echo $result;
    } 
    
    public function register_post()
    {
        $nik = 'LPKN-'.$this->generate_nik(6);
		$email = $this->post('email');
		$phone = $this->post('phone');
		$ceknik = $this->db->where('nik', $nik)->get('member')->num_rows();
	
		if($ceknik > 0){
	        $this->res['success'] = false;
			$this->res['msg'] = 'NIK sudah terdaftar';
			$this->response($this->res, 400);
		}else{
		    $cekEmail = $this->db->where('email', $email)->get('member')->num_rows();
		    if($cekEmail > 0){
		        $this->res['success'] = false;
				$this->res['msg'] = 'Email sudah terdaftar';
				$this->response($this->res, 400);
		    }else{
		        $nama_lengkap = $this->post('nama_lengkap');
				// $nik = $this->input->post('nik');
				$alamat_lengkap = $this->post('alamat_lengkap');
				// $kabkot = $this->input->post('kabkot');
				$tmp_pass = $this->post('password');
				$data = array(
					'nik' => $nik,
					'email' => $email,
					'nama_lengkap' => $nama_lengkap,
					// 'alamat_lengkap' => $alamat_lengkap,
					// 'kabkota' => $kabkot,
					'create_date' => date('Y-m-d H:m:s'),
				);
				$insert = $this->db->insert('member', $data);
				if($insert){
				    $identity = $nik;
		            $password = $tmp_pass;
		            $email = $email;
		            $additional_data = [
		                'username' => $nik,
		                'first_name' => $nama_lengkap,
		                'last_name' => ' ',
		                'company' => '-',
		                'phone' => $phone,
		            ];
		            $add_member = $this->ion_auth->register($identity, $password, $email, $additional_data);
		            if ($add_member)
		            {
		                $this->send_email_activation($add_member['email'], $add_member['activation']);
		                $this->res['success'] = true;
		                $this->res['id_user'] = $add_member['id'];
		                $this->res['msg'] = 'Cek email verifikasi ke "'.$add_member['email'].'" untuk dapat menggunakan akun';
		                $this->response($this->res, 200);
		            }else{
		                $this->res['success'] = false;
		                $this->res['msg'] = 'Gagal Add Users';
		                $this->response($this->res, 400);
		            }
				}else{
				    $this->res['success'] = false;
					$this->res['msg'] = 'Gagal';
					$this->response($this->res, 400);
				}
		    }
		}
    }
    
    public function profile_put(){
        $key = $this->config->item('thekey');
        $authHeader = $this->input->get_request_header('Authorization');
        $decoded = JWT::decode($authHeader, $key, array('HS256'));
        
      	$data_member = array(
    		'nama_lengkap' => $this->put('nama_lengkap'), 
    		'alamat_lengkap' => $this->put('alamat_lengkap'), 
    		'no_hp' => $this->put('no_hp'), 
    		'tempat_lahir' => $this->put('tempat_lahir'), 
    		'tgl_lahir' => $this->put('tgl_lahir'), 
    		'instansi' => $this->put('instansi'), 
    	);
    	$data_user = array(
    		'first_name' => $this->put('nama_lengkap'), 
    		'last_name' => '', 
    		'phone' => $this->put('no_hp'), 
    		'company' => $this->put('instansi'), 
    	);
    	$user = $this->db->where('email', $decoded->username)->get('users')->row();
    	
    	$update_member = $this->profile_model->update_member($user->username, $data_member);
    	$update_member = $this->profile_model->update_user($user->username, $data_user);
    	
        $member = $this->db->where('nik', $user->username)->get('member')->row();
        
        $token['id'] = $user->id;
        $token['username'] = $decoded->username;
        $token['user_group'] = 'member';
        $date = new DateTime();
        $token['iat'] = $date->getTimestamp();
    
        $output['token'] = JWT::encode($token,$key ); //This is the output token
        $output['user'] = $user;
        $output['member'] = $member;
        
        $this->set_response($output, REST_Controller::HTTP_OK);
    }
    
    public function change_password_post(){
        $key = $this->config->item('thekey');
        $authHeader = $this->input->get_request_header('Authorization');
        $decoded = JWT::decode($authHeader, $key, array('HS256'));
        
        $oldPassword = $this->input->post('oldPassword');
        $newPassword = $this->input->post('newPassword');
        $confirmPassword = $this->input->post('confirmPassword');
        
        $this->form_validation->set_rules('oldPassword', 'oldPassword', 'required');
        $this->form_validation->set_rules('newPassword', 'newPassword', 'required');
        $this->form_validation->set_rules('confirmPassword', 'confirmPassword', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            if(validation_errors())
            {
                $this->res['success'] = false;
    			$this->res['msg'] = 'Form tidak boleh kosong';
    			$this->response($this->res, 400);   
            }
        }
        else
        {
            if($confirmPassword != $newPassword)
            {
                $this->res['success'] = false;
    			$this->res['msg'] = 'Password Baru dan Konfirmasi Password tidak sama';
    			$this->response($this->res, 400);
            }
            else
            {
                $changeData = array('password'=>password_hash($newPassword, PASSWORD_DEFAULT));
        
                $user = $this->db->where('email', $decoded->username)->get('users')->row();
                
                $update_member = $this->profile_model->update_user($user->username, $changeData);
                
                $member = $this->db->where('nik', $user->username)->get('member')->row();
                
                $token['id'] = $user->id;
                $token['username'] = $decoded->username;
                $token['user_group'] = 'member';
                $date = new DateTime();
                $token['iat'] = $date->getTimestamp();
            
                $output['token'] = JWT::encode($token,$key ); //This is the output token
                $output['user'] = $user;
                $output['member'] = $member;
                
                $this->set_response($output, REST_Controller::HTTP_OK);   
            }
        }
    }
    
    public function photo_profile_post()
    {
         if (isset($_FILES['foto_profile']['tmp_name'])) 
         {
            $key = $this->config->item('thekey');
            $authHeader = $this->input->get_request_header('Authorization');
            $decoded = JWT::decode($authHeader, $key, array('HS256'));
            
            $config['upload_path']          = './uploads/foto_profile/';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['file_name']            = date('Ymd').'-'.uniqid();
            $config['overwrite']            = true;
            // $config['max_size']             = 1024; // 1MB
    
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
    
            if ($this->upload->do_upload('foto_profile')) {
                $pp = $this->upload->data("file_name");
                $data = array(
	                'pp' => $pp,
	            );
	            $user = $this->db->where('email', $decoded->username)->get('users')->row();
	            $update_member = $this->profile_model->update_member($user->username, $data);
	            
	            $member = $this->db->where('nik', $user->username)->get('member')->row();
        
                $token['id'] = $user->id;
                $token['username'] = $decoded->username;
                $token['user_group'] = 'member';
                $date = new DateTime();
                $token['iat'] = $date->getTimestamp();
            
                $output['token'] = JWT::encode($token,$key ); //This is the output token
                $output['user'] = $user;
                $output['member'] = $member;
                
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $this->res['success'] = false;
	            $this->res['msg'] = "Gagal, mungkin file terlalu besar.";
	            $this->response($this->res, 400);
            }
         }
    }
    
    public function generate_referral($length)
    {
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        return substr(str_shuffle($str_result), 0, $length);
    }
    
    public function act_ref_post()
    {
        $key = $this->config->item('thekey');
        $authHeader = $this->input->get_request_header('Authorization');
        $decoded = JWT::decode($authHeader, $key, array('HS256'));
        
        $data = array('ref' => $this->generate_referral(6), );
        
        $user = $this->db->where('email', $decoded->username)->get('users')->row();
	    $update_member = $this->profile_model->update_member($user->username, $data);
	    
	    $member = $this->db->where('nik', $user->username)->get('member')->row();
                
        $token['id'] = $user->id;
        $token['username'] = $decoded->username;
        $token['user_group'] = 'member';
        $date = new DateTime();
        $token['iat'] = $date->getTimestamp();
    
        $output['token'] = JWT::encode($token,$key ); //This is the output token
        $output['user'] = $user;
        $output['member'] = $member;
        
        $this->set_response($output, REST_Controller::HTTP_OK);
    }
    
    public function update_ref_post()
    {
        $key = $this->config->item('thekey');
        $authHeader = $this->input->get_request_header('Authorization');
        $decoded = JWT::decode($authHeader, $key, array('HS256'));
        
        $data = array(
        		'bank_rek_ref' => $this->input->post('bank_rek_ref'), 
        		'no_rek_ref' => $this->input->post('no_rek_ref'), 
        		'an_rek_ref' => $this->input->post('an_rek_ref'), 
        );
        
        $user = $this->db->where('email', $decoded->username)->get('users')->row();
	    $update_member = $this->profile_model->update_member($user->username, $data);
	    
	    $member = $this->db->where('nik', $user->username)->get('member')->row();
                
        $token['id'] = $user->id;
        $token['username'] = $decoded->username;
        $token['user_group'] = 'member';
        $date = new DateTime();
        $token['iat'] = $date->getTimestamp();
    
        $output['token'] = JWT::encode($token,$key ); //This is the output token
        $output['user'] = $user;
        $output['member'] = $member;
        
        $this->set_response($output, REST_Controller::HTTP_OK);
    }
    
    public function remove_account_post()
    {
        $key = $this->config->item('thekey');
        $authHeader = $this->input->get_request_header('Authorization');
        $decoded = JWT::decode($authHeader, $key, array('HS256'));
        
        $output['success'] = true;
        $output['msg'] = "Berhasil menghapus akun";
        
        $this->set_response($output, REST_Controller::HTTP_OK);
    }
    
    private function send_email_forget($identity, $forgotten_password_code)
    {
    	$row_user = $this->db->where('email', $identity)->get('users')->row();
    	$data = array('first_name' => $row_user->first_name, 'forgotten_password_code' => $forgotten_password_code );
        $massage = $this->load->view('auth/email/email_forgot_password.php', $data, TRUE);
        // Built by LucyBot. www.lucybot.com
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/json"
        ));
        curl_setopt($curl, CURLOPT_URL,
          "https://api.smtp2go.com/v3/email/send"
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
          "api_key" => "api-D8983966080211ED8BA0F23C91C88F4E",
          "sender" => "Member LPKN <info@lpkn.info>",
          "to" => array(
            0 => $identity
          ),
          "text_body" => "Keamanan",
          "html_body" => $massage,
          "subject" => "Permintaan reset password"
        )));
        $result = curl_exec($curl);
        // echo $result;
    } 
    
    public function forgot_password_post()
    {
        $identity_column = $this->config->item('identity', 'ion_auth');
        $identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();
        
        if(empty($identity))
        {
            $this->res['success'] = false;
			$this->res['msg'] = 'Email Tidak Ditemukan';
			$this->response($this->res, 404);
        }
        else
        {
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});
            $this->send_email_forget($forgotten['identity'], $forgotten['forgotten_password_code']);
            
            $output['success'] = true;
            $output['msg'] = "Berhasil";
            $this->set_response($output, REST_Controller::HTTP_OK);
        }
    
    }
    
    public function afiliasi_get()
    {
        $key = $this->config->item('thekey');
        $authHeader = $this->input->get_request_header('Authorization');
        $decoded = JWT::decode($authHeader, $key, array('HS256'));
        
        $user = $this->db->where('id', $decoded->id)->get('users')->row();
        $member = $this->db->where('nik', $user->username)->get('member')->row();
        $reg_list = $this->getReg($member->ref);
        $reg_pay_list = $this->getRegPay($member->ref);
        $bonus_list = $this->getBonus($member->ref);
        
        $data = array(
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
        $output['data'] = $data;
        $output['success'] = true;
        $output['msg'] = "Berhasil";
        
        $this->set_response($output, REST_Controller::HTTP_OK);
    }
    
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
    

}
