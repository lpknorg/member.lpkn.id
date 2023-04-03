<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('ion_auth_acl');
        $this->load->helper('tgl_indo');
        // $this->auth();
    }

    public function index_post()
    {
       $data = json_decode(file_get_contents('php://input'));
        $order_id = explode("-",$data->order_id);
        $paket = substr($order_id[1],0,1);
        $id_user = substr($order_id[1],1);
        $jenis = substr($order_id[2],0,1);
        $subdomain = $order_id[0];
        if($data->transaction_status == 'pending'){
            $data_update = array('view' => 1, );
            $this->db->where('invoice', $data->order_id);
            $update = $this->db->update('pembayaran', $data_update);
            $res['success'] = true;
        }elseif($data->transaction_status == 'expire'){
            $data_update = array('status' => 3, );
            $this->db->where('invoice', $data->order_id);
            $update = $this->db->update('pembayaran', $data_update);
            $res['success'] = true;
        }elseif($data->transaction_status == 'settlement' or $data->transaction_status == 'success'){
            $data_update = array(
                'status' => 1,
                'update_date' => date('Y-m-d h:m:s'),
            );
            $this->db->where('invoice', $data->order_id);
            $update = $this->db->update('pembayaran', $data_update);
            if($update){
                $this->ion_auth->add_to_group(5, $id_user);
                if($jenis == 'F'){
                    $this->ion_auth->remove_from_group(6, $id_user);
                }elseif($jenis == 'T'){
                    $this->ion_auth->remove_from_group(7, $id_user);
                }else{
                    $this->ion_auth->remove_from_group(5, $id_user);
                }
                $this->addNoMember($id_user);
                $this->add_paket($id_user,$paket,$data->order_id,$data->gross_amount);
                $res['success'] = true;
            }else{
                $res['success'] = false;
            }
        }
        $this->response($res, 200);
    }
    
    private function add_paket($id_user,$paket,$order_id,$gross_amount)
    {
        $user = $this->db->where('id', $id_user)->get('users')->row();
        if($paket == 1){$add = 3;}elseif($paket == 2){$add = 6;}elseif($paket == 3){$add = 12;}else{$add = 0;}
        $date = new DateTime('2022-04-01');
        // $date = new DateTime('now');
        $date->modify('+'.$add.' month'); // or you can use '-90 day' for deduct
        $date = $date->format('Y-m-d');
        $expired['expired_date'] = $date;
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