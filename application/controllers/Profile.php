<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->library('ion_auth_acl');
        $this->load->helper(['url', 'language', 'tgl_indo']);
        $this->lang->load('auth');
        $this->load->model('profile_model');

        if( ! $this->ion_auth->logged_in() )
            redirect('auth/login');
    }

	public function index()
	{
        if ($this->ion_auth->in_group('member')){
            $this->load->view('profile/member_profile');
        }elseif ($this->ion_auth->in_group('register')) {
            $this->load->view('profile/member_profile');
        }elseif ($this->ion_auth->in_group('expired')) {
            $this->load->view('profile/member_profile');
        }else{
            $this->load->view('profile/user_profile');
        }
	}

    public function kta($username)
    {
        $member = $this->db->where('nik',$username)->get('member')->row();
        $data = array('member' => $member, );
        $this->load->view('profile/download_kta', $data);
    }

    public function update()
    {
        $getProv = $this->getProv();
        $data = array('getprov' => json_decode($getProv), );
        $this->load->view('profile/update_member_profile', $data);
    }

    public function update_action()
    {
        $user = $this->ion_auth->user()->row();
        $data_member = array(
            'nik' => $this->input->post('username'),
            'nama_lengkap' => $this->input->post('first_name'),
            'email' => $this->input->post('email'),
            'prov' => $this->input->post('prov'),
            'kabkota' => $this->input->post('kabkot'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
        );
        $this->profile_model->update_member($user->username, $data_member);
        $data_user = array(
            'username' => $this->input->post('username'),
            'first_name' => $this->input->post('first_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'company' => $this->input->post('company'),
        );
        $this->profile_model->update_user($user->id, $data_user);
        $this->res['success'] = true;
        echo json_encode($this->res);
    }

    public function _render_page($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
    {

        $viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $viewdata, $returnhtml);

        // This will return html on 3rd argument being true
        if ($returnhtml)
        {
            return $view_html;
        }
    }

    public function updatepp($id)
    {
        $pp = $this->_uploadFotoProfile();
        if($pp == 'gagal'){
            $this->res['success'] = false;
            $this->res['msg'] = "Gagal, mungkin file terlalu besar.";
        }else{
            $data = array(
                'pp' => $pp,
            );
            $this->db->where('id', $id);
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
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

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
            $this->_render_page('profile' . DIRECTORY_SEPARATOR . 'change_password', $this->data);
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

    public function getProv()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }


    public function getKota($id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/'.$id.'.json',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $kota = json_decode($response);
        echo '<option>Pilih</option>';
        foreach ($kota as $row) {
            echo '<option value="'.$row->id.'-'.$row->name.'">'.$row->name.'</option>';
        }
        // return $response;
    } 

    public function getKec($id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/'.$id.'.json',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $kota = json_decode($response);
        echo '<option>Pilih</option>';
        foreach ($kota as $row) {
            echo '<option value="'.$row->id.'-'.$row->name.'">'.$row->name.'</option>';
        }
        // return $response;
    } 

    public function getKel($id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.emsifa.com/api-wilayah-indonesia/api/villages/'.$id.'.json',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $kota = json_decode($response);
        echo '<option>Pilih</option>';
        foreach ($kota as $row) {
            echo '<option value="'.$row->name.'">'.$row->name.'</option>';
        }
        // return $response;
    } 

}
