<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->library('form_validation');
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->library('ion_auth_acl');
        $this->load->helper(['url', 'language', 'tgl_indo']);
        $this->load->library('datatables');
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_pembayaran')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('pembayaran/pembayaran_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_pembayaran')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Pembayaran_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_pembayaran')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Pembayaran_model->get_by_id($id);
            if ($row) {
                $data = array(
            'id' => $row->id,
			'invoice' => $row->invoice,
			'jenis_pembayaran' => $row->jenis_pembayaran,
			'paket' => $row->paket,
            'nominal' => $row->nominal,
			'metode' => $row->metode,
			'snaptoken' => $row->snaptoken,
			'status' => $row->status,
			'create_date' => $row->create_date,
			'update_date' => $row->update_date,
			'update_by' => $row->update_by,
		    );
                if($this->ion_auth->in_group('adminofficers') OR $this->ion_auth->is_admin()){
                    $this->load->view('pembayaran/admin_read', $data);
                }else{
                    $this->load->view('pembayaran/pembayaran_read', $data);
                }
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pembayaran'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_pembayaran')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('pembayaran/create_action'),
			    'id' => set_value('id'),
			    'jenis_pembayaran' => set_value('jenis_pembayaran'),
			    'paket' => set_value('paket'),
			    'nominal' => set_value('nominal'),
			    'snaptoken' => set_value('snaptoken'),
			    'status' => set_value('status'),
			    'create_date' => set_value('create_date'),
			    'update_date' => set_value('update_date'),
			    'update_by' => set_value('update_by'),
			);
            $this->load->view('pembayaran/pembayaran_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_pembayaran')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
					'jenis_pembayaran' => $this->input->post('jenis_pembayaran',TRUE),
					'paket' => $this->input->post('paket',TRUE),
					'nominal' => $this->input->post('nominal',TRUE),
					'snaptoken' => $this->input->post('snaptoken',TRUE),
					'status' => $this->input->post('status',TRUE),
					'create_date' => $this->input->post('create_date',TRUE),
					'update_date' => $this->input->post('update_date',TRUE),
					'update_by' => $this->input->post('update_by',TRUE),
			    );
                $this->Pembayaran_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('pembayaran'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_pembayaran')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Pembayaran_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('pembayaran/update_action'),
					'id' => set_value('id', $row->id),
					'jenis_pembayaran' => set_value('jenis_pembayaran', $row->jenis_pembayaran),
					'paket' => set_value('paket', $row->paket),
					'nominal' => set_value('nominal', $row->nominal),
					'snaptoken' => set_value('snaptoken', $row->snaptoken),
					'status' => set_value('status', $row->status),
					'create_date' => set_value('create_date', $row->create_date),
					'update_date' => set_value('update_date', $row->update_date),
					'update_by' => set_value('update_by', $row->update_by),
			    );
                $this->load->view('pembayaran/pembayaran_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pembayaran'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_pembayaran')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
					'jenis_pembayaran' => $this->input->post('jenis_pembayaran',TRUE),
					'paket' => $this->input->post('paket',TRUE),
					'nominal' => $this->input->post('nominal',TRUE),
					'snaptoken' => $this->input->post('snaptoken',TRUE),
					'status' => $this->input->post('status',TRUE),
					'create_date' => $this->input->post('create_date',TRUE),
					'update_date' => $this->input->post('update_date',TRUE),
					'update_by' => $this->input->post('update_by',TRUE),
			    );

                $this->Pembayaran_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('pembayaran'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_pembayaran')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Pembayaran_model->get_by_id($id);

            if ($row) {
                $this->Pembayaran_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pembayaran'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pembayaran'));
            }
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('jenis_pembayaran', 'jenis pembayaran', 'trim|required');
    	$this->form_validation->set_rules('paket', 'paket', 'trim|required');
    	$this->form_validation->set_rules('nominal', 'nominal', 'trim|required');
    	$this->form_validation->set_rules('snaptoken', 'snaptoken', 'trim|required');
    	$this->form_validation->set_rules('status', 'status', 'trim|required');
    	$this->form_validation->set_rules('create_date', 'create date', 'trim|required');
    	$this->form_validation->set_rules('update_date', 'update date', 'trim|required');
    	$this->form_validation->set_rules('update_by', 'update by', 'trim|required');
    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function cencel_transaction_manual($id){
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_pembayaran')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data_update = array('status' => 2, );
            $this->Pembayaran_model->update($id, $data_update);
            $this->session->set_flashdata('message', 'Pembayaran berhasil di Cancel');
            redirect(site_url('pembayaran'));
        }
    }


    public function cencel_transaction($id){
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_pembayaran')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->db->where('id', $id)->get('pembayaran')->row();
            // echo 'https://api.midtrans.com/v2/'.$row->invoice.'/cancel';
            
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.midtrans.com/v2/'.$row->invoice.'/cancel',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Basic TWlkLXNlcnZlci1zUjJUTW1CYXV1Ti1jSGh5XzJtOTY4R2w='
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            $data = json_decode($response);
            if($data->status_code == 200){
                $data_update = array('status' => 2, );
                $this->Pembayaran_model->update($id, $data_update);
                $this->session->set_flashdata('message', 'Pembayaran berhasil di Cancel');
                redirect(site_url('pembayaran'));
            }else{
                $this->session->set_flashdata('message', "Gagal");
                redirect(site_url('pembayaran'));
            }
            
        }
    }    


    function invoice($id_pembayaran){
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_pembayaran')){
            show_error('You must be an administrators to view this page.');
        }else{

            $pembayaran = $this->db->where('id',$id_pembayaran)->get('pembayaran')->row();
            $user = $this->db->where('id',$pembayaran->user_id)->get('users')->row();
            $member = $this->db->where('nik', $user->username)->get('member')->row();
            $invoice = explode("-",$pembayaran->invoice);
            if(substr($invoice[2],0,1) == 'F'){
                if($pembayaran->paket == 1)
                    {$paket = 3;}
                elseif($pembayaran->paket == 2)
                    {$paket = 6;}
                else{$paket = 12;}
                $data = array(
                    'title_pdf' => 'Invoice',
                    'tgl' => $pembayaran->update_date,
                    'invoice' => $pembayaran->invoice,
                    'nama_lengkap' => $member->nama_lengkap,
                    'nominal' => $pembayaran->nominal,
                    'paket' => $paket
                );
                $filename = $pembayaran->invoice;
                $orientation = "landscape";
                $this->load->library('pdf');
                $this->pdf->load_view('pembayaran/kwitansi',$filename,$orientation,$data);
                // $this->load->view('pembayaran/kwitansi',$data);
            }elseif(substr($invoice[2],0,1) == 'T'){
                $data = array(
                    'title_pdf' => 'Invoice', 
                    'tgl' => $pembayaran->update_date,
                    'invoice' => $pembayaran->invoice,
                    'nominal' => $pembayaran->nominal,
                    'paket' => $pembayaran->paket
                );
                $filename = "Kwitansi";
                $orientation = "landscape";
                $this->load->library('pdf');
                $this->pdf->load_view('pembayaran/kwitansi',$filename,$orientation,$data);
                // $this->load->view('pembayaran/kwitansi',$filename,$orientation,$data);
            }
        }
    }


    public function konfirmasi_manual($id_pembayaran)
    {
        if($this->ion_auth->in_group('member') OR $this->ion_auth->is_admin()){
            $pembayaran = $this->db->where('id', $id_pembayaran)->get('pembayaran')->row();
            $user = $this->db->where('id', $pembayaran->user_id)->get('users')->row();
            $data_update = array(
                'status' => 1,
                'update_date' => date('Y-m-d h:m:s'),
            );
            $order_id = explode("-",$pembayaran->invoice);
            $paket = substr($order_id[1],0,1);
            $jenis = substr($order_id[2],0,1);
            $this->db->where('invoice', $pembayaran->invoice);
            $update = $this->db->update('pembayaran', $data_update);
            if($update){
                $this->ion_auth->add_to_group(5, $user->id);
                if($jenis == 'F'){
                    $this->ion_auth->remove_from_group(6, $user->id);
                }elseif($jenis == 'T'){
                    $this->ion_auth->remove_from_group(7, $user->id);
                }else{
                    $this->ion_auth->remove_from_group(5, $user->id);
                }
                $this->addNoMember($user->id);
                $this->add_paket($user->id,$paket,$pembayaran->invoice,$pembayaran->nominal);
                $this->session->set_flashdata('message', 'Berhasil Dikonfirmasi #'.$pembayaran->invoice);
                redirect(site_url('pembayaran'));
            }else{
                $this->session->set_flashdata('message', 'Gagal Dikonfirmasi #'.$pembayaran->invoice);
                redirect(site_url('pembayaran'));
            }
        }else{
            show_error('You must be an administrators to view this page.');
        }
    }

    private function add_paket($id_user,$paket,$order_id,$gross_amount)
    {
        $user = $this->db->where('id', $id_user)->get('users')->row();
        if($paket == 1){$add = 3;}
        elseif($paket == 2){$add = 6;}
        elseif($paket == 3){$add = 12;}
        else{$add = 0;}
        $date = new DateTime('2022-04-02');
        // $date = new DateTime('now');
        $date->modify('+'.$add.' month'); // or you can use '-90 day' for deduct
        $ex_date = $date->format('Y-m-d');
        $expired['expired_date'] = $ex_date;
        $this->db->where('nik', $user->username);
        $update = $this->db->update('member', $expired);
        $this->emailVerifikasiTopup($user->email,$order_id,$gross_amount,$add,$date);
    }

    private function addNoMember($id_user){
        $user = $this->db->where('id', $id_user)->get('users')->row();
        $count = $this->db->where('no_member !=', NULL)->get('member')->num_rows();
        $no_get = $count > 0 ? $count+1 : 1;
        $urut = str_pad(($no_get), 6, '0', STR_PAD_LEFT);
        $no_member = $urut.'/B-AVENDO/IV/'.date('Y'); //sementara
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

    private function emailVerifikasiTopup($identity,$order_id,$gross_amount,$paket,$expired)
    {
        $row_user = $this->db->where('email', $identity)->get('users')->row();
        $data = array(
            'first_name' => $row_user->first_name, 
            'invoice' => $order_id,
            'price' => 'Rp. '.number_format($gross_amount).',-',
            'paket' => $paket.' Bulan',
            'expired' => date_indo($expired),
        );
        $massage = $this->load->view('auth/email/email_first_topup.php', $data, TRUE);
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
          "api_key" => "api-4B9AD7BE96D111EC9BF7F23C91C88F4E",
          "sender" => "Vendor Asosiation <info@vendor-indonesia.id>",
          "to" => array(
            0 => $identity
          ),
          "text_body" => "Pembayaran Pertama (Register + 3 Bulan Iuran)",
          "html_body" => $massage,
          "subject" => "Konfirmasi Pembayaran"
        )));
        $result = curl_exec($curl);
        // echo $result;
    } 




}

/* End of file Pembayaran.php */
/* Location: ./application/controllers/Pembayaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-17 13:22:24 */
/* http://harviacode.com */