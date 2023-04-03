<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->library('ion_auth_acl');

        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        if ($this->ion_auth->in_group('member') OR $this->ion_auth->in_group('expired')){
            $this->load->view('auth/iuran_bulanan');
            // echo "test";
        }elseif ($this->ion_auth->in_group('register')) {
            $this->load->view('auth/first_topup');
        }else{
            $this->load->view('profile/user_profile');
        }
    }

    public function transfer($id_pembayaran)
    {
        // if ($this->ion_auth->in_group('member') OR $this->ion_auth->in_group('expired')){
        //     $this->load->view('auth/iuran_bulanan');
        //     // echo "test";
        // }elseif ($this->ion_auth->in_group('register')) {
            $user = $this->ion_auth->user()->row();
            $pembayaran = $this->db->where('id', $id_pembayaran)->get('pembayaran')->row();
            $member = $this->db->where('nik', $user->username)->get('member')->row();
            $data = array('member' => $member, 'pembayaran' => $pembayaran);
            $this->load->view('auth/form_transfer', $data);
            // echo "test";
        // }else{
        //     // echo "test";
        //     $this->load->view('profile/user_profile');
        // }
    }

    public function first($paket = 1)
    {
        $user = $this->ion_auth->user()->row();
        $cekUser = $this->db->where('id',$user->id)->get('users')->num_rows();
        if($cekUser > 0){
            $getUser = $this->db->where('id',$user->id)->get('users')->row();
            if($paket == 1){
                $hargaPaket = 1055000;
            }elseif($paket == 2){
                $hargaPaket = 1554000;
            }else{
                $hargaPaket = 2498000;
            }
            $invoice = 'VI-'.$paket.''.$getUser->id.'-F'.rand();
            $snapToken = $this->getMidtrans($user->id, $hargaPaket, $invoice);
            $data = array(
                'user_id' => $user->id,
                'invoice' => $invoice,
                'jenis_pembayaran' => 'First Topup',
                'paket' => $paket,
                'nominal' => $hargaPaket,
                'status' => 0,
                'update_by' => $user->first_name,
                'snaptoken' => $snapToken, );
            $insert = $this->db->insert('pembayaran', $data);
            if($insert){
                redirect('https://app.midtrans.com/snap/v2/vtweb/'.$snapToken);
            }else{
                echo 'gagal insert';
            }
        }else{
            echo 'User no found';
        }
    }

    public function cek_pembayaran()
    {
        $cekManualPayment = $this->db->where('SUBSTR(create_date, 1, 7) = "'.date('Y-m').'"')->where('metode', 'manual')->get('pembayaran')->num_rows();
        echo $cekManualPayment;
    }

    public function first_manual($paket = 1)
    {
        $user = $this->ion_auth->user()->row();
        $cekUser = $this->db->where('id',$user->id)->get('users')->num_rows();
        if($cekUser > 0){
            $getUser = $this->db->where('id',$user->id)->get('users')->row();
            if($paket == 1){
                $hargaPaket = 1055000;
            }elseif($paket == 2){
                $hargaPaket = 1554000;
            }else{
                $hargaPaket = 2498000;
            }
            $invoice = 'VI-'.$paket.''.$getUser->id.'-FM'.rand();
            $cekManualPayment = $this->db->where('SUBSTR(create_date, 1, 7) = "'.date('Y-m').'"')->where('metode', 'manual')->get('pembayaran')->num_rows();
            
            if($cekManualPayment > 0){
                $input = $this->db->query("insert into pembayaran 
                                        (user_id, invoice, jenis_pembayaran, metode, paket, nominal, kode_unik, status, view, update_by)
                                        select ".$user->id.", '".$invoice."', 'First Topup (Manual)','manual', '".$paket."',(".$hargaPaket."+(p.kode_unik+1)), (p.kode_unik+1), 0, 1, '".$user->first_name."'
                                        from pembayaran p
                                        where SUBSTR(p.create_date, 1, 7) = '".date('Y-m')."'
                                        order by p.kode_unik desc
                                        limit 1");
            }else{
                $input = $this->db->query("insert into pembayaran 
                                        (user_id, invoice, jenis_pembayaran, metode, paket, nominal, kode_unik, status, view, update_by)
                                        values (".$user->id.", '".$invoice."', 'First Topup (Manual)','manual', '".$paket."',".$hargaPaket."+1, 1, 0, 1, '".$user->first_name."')");
            }
            /*
            $data = array(
                'user_id' => $user->id,
                'invoice' => $invoice,
                'jenis_pembayaran' => 'First Topup (Manual)',
                'metode' => 'manual',
                'paket' => $paket,
                'nominal' => $hargaPaket,
                'status' => 0,
                'update_by' => $user->first_name,
            );
            $insert = $this->db->insert('pembayaran', $data);
            */
            if($input){
                $insert_id = $this->db->insert_id();
                redirect(base_url().'payment/transfer/'.$insert_id);
                // echo 'berhasil';
            }else{
                echo 'gagal insert';
            }
        }else{
            echo 'User no found';
        }
    }

    public function topup($paket = 1)
    {
        $user = $this->ion_auth->user()->row();
        $cekUser = $this->db->where('id',$user->id)->get('users')->num_rows();
        if($cekUser > 0){
            $getUser = $this->db->where('id',$user->id)->get('users')->row();
            if($paket == 1){
                $hargaPaket = 555000;
            }elseif($paket == 2){
                $hargaPaket = 1054000;
            }else{
                $hargaPaket = 1998000;
            }
            $invoice = 'VI-'.$paket.''.$getUser->id.'-T'.rand();
            $snapToken = $this->getMidtrans($user->id, $hargaPaket, $invoice);
            $data = array(
                'user_id' => $user->id,
                'invoice' => $invoice,
                'jenis_pembayaran' => 'Topup',
                'paket' => $paket,
                'nominal' => $hargaPaket,
                'status' => 0,
                'update_by' => $user->first_name,
                'snaptoken' => $snapToken, );
            $insert = $this->db->insert('pembayaran', $data);
            if($insert){
                redirect('https://app.midtrans.com/snap/v2/vtweb/'.$snapToken);
            }else{
                echo 'gagal insert';
            }
        }else{
            echo 'User no found';
        }
    }

    public function cencelpay($id)
    {
        $cek_id = $this->db->where('id',$id)->get('pembayaran')->num_rows();
        if($cek_id > 0){
            $data['status'] = 3;
            $this->db->where('id', $id);
            $exsec = $this->db->update('pembayaran', $data);
            if($exsec){

            }
        }else{
            echo 'Transaksi Tidak ditemukan';
        }
    }

    function getMidtrans($idUser,$hargaPaket,$invoice)
    {
        $getUser = $this->db->where('id',$idUser)->get('users')->row();
        // Midtrans start
        require_once(dirname(__FILE__) . '/../libraries/midtrans/Veritrans.php');
        Veritrans_Config::$serverKey = "Mid-server-sR2TMmBauuN-cHhy_2m968Gl";
        Veritrans_Config::$isProduction = true;
        Veritrans_Config::$isSanitized = true;
        Veritrans_Config::$is3ds = true;

        // Required
        $params = array(
            'transaction_details' => array(
                'order_id' => $invoice,
                'gross_amount' => $hargaPaket,
            ),
            'customer_details' => array(
                'first_name' => $getUser->first_name,
                'email' => $getUser->email,
                'phone' => $getUser->phone,
            ),
        );
        
        $snapToken = Veritrans_Snap::getSnapToken($params);
        return $snapToken;
    }

    private function _uploadBukti()
    {
        $config['upload_path']          = './uploads/bukti/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = uniqid();
        $config['overwrite']            = true;
        $config['max_size']             = 11024; // 1MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('bukti')) {
            return $this->upload->data("file_name");
        }
        
        return "gagal";
    }

    public function upload_bukti($id)
    {
        $upload_name = $this->_uploadBukti();
        $data['tgl_upload'] = date('Y-m-d H:i:s');
        if($upload_name != 'gagal'){
            $data['bukti'] = $this->_uploadBukti();
            $this->db->where('id', $id);
            $upload = $this->db->update('pembayaran', $data);
            if($upload){
                $this->res['success'] = true;
                $this->res['msg'] = 'Berhasil upload bukti';
            }else{
                $this->res['success'] = false;
                $this->res['msg'] = 'Gagal upload bukti';
            }
        }else{
            $this->res['success'] = false;
            $this->res['msg'] = 'Gagal Upload File, Coba lagi! (Masalah Koneksi/file terlalu besar)';
        }
        echo json_encode($this->res);
    }
}
