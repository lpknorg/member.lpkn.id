<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email extends CI_Controller {
 
   /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    *        http://example.com/index.php/welcome
    * - or -
    *        http://example.com/index.php/welcome/index
    * - or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see https://codeigniter.com/user_guide/general/urls.html
    */


   public function send()
    {
        $data['test'] = 'test1';
        $massage = $this->load->view('auth/email/template', $data, TRUE);
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
          "sender" => "info@vendor-indonesia.id",
          "to" => array(
            0 => "ferdians.bm@gmail.com"
          ),
          "text_body" => "test saja",
          "html_body" => $massage,
          "subject" => "test email"
        )));
        $result = curl_exec($curl);
        echo $result;
    } 
   public function index()
   {
    // $this->load->library('email');
    /*

        $config = array();
        $config['protocol'] = 'smtp';
        // $config['mailpath'] = "/usr/sbin/sendmail";
        $config['smtp_host'] = 'mail.smtp2go.com';
        $config['smtp_user'] = 'noreply@diklatonline.id';
        $config['smtp_pass'] = 'dHhvaDdvdjlsejAw';
        $config['smtp_port'] = '587';
        $config['charset'] = 'utf-8';
        $config['smtp_crypto']  = 'TLS';
        $config['mailtype'] = 'html';

        // Load library email dan konfigurasinya.
        $this->email->initialize($config);
         $data = array(
            'new_password'              => 'test',
            'nama'                      => 'test2'
        );
        $to_mail = 'yans.camerount@gmail.com' ;
        $from_email = "noreply@diklatonline.id";
        $this->email->from($from_email, 'noreply');
        $this->email->to($to_mail);
        $this->email->subject('Reset Password');
        $massage = 'Test Email';
        // $massage = $this->load->view('email/lupa_password', $data, TRUE);
        $this->email->message($massage);
        $this->email->set_mailtype('html');
      */

      $api_key = "api-4B9AD7BE96D111EC9BF7F23C91C88F4E";
      $pengirim = "info@vendor-indonesia.id";
      $tujuan = "ferdians.bm@gmail.com";
      $subyek = "Berhasil Mengirimkan Email";
      $pesan = "
               Ini email dikirimkan dengan codeigniter<br><br>
               Regards<br>
               Admin
      ";
      $this->_apiSMTP2go($pengirim,$tujuan,$subyek,$pesan,$api_key);
      echo "Berhasil";
      // $hasil = $this->_apiSMTP2go($pengirim,$tujuan,$subyek,$pesan,$api_key);
      // echo $hasil;
   }
 
   /** Mengirimkan Email dengan SMTP2GO
    * @param $pengirim
    * @param $tujuan
    * @param $subyek
    * @param $pesan
    * @param $api
    */
   private function _apiSMTP2go($pengirim,$tujuan,$subyek,$pesan,$api)
   {
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
         "api_key" => $api,
         "sender" => $pengirim,
         "to" => array(
            0 => $tujuan
         ),
         "subject" => $subyek,
         "text_body" => $pesan,
         "html_body" => $pesan
      )));
      curl_exec($curl);
   }
}