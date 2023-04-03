<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kta extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('profile_model');
        $this->load->library(['kpdf']);
    }
    
    public function index_get($username)
    {
        $user = $this->db->where('username', $username)->get('users')->row();
        $member = $this->profile_model->get_member($username);
        $nim = $username;
        $pdf = new PDF_Code39();
        $pdf->AddPage();
        $pdf->Image(base_url().'assets/img/depan_cetak.jpg', 10, 10,180, 55);
        $pdf->Image(base_url()."uploads/foto_profile/".$member->pp, 18.5, 29, 15.1, 18.1);
        $pdf->Image(base_url().'barcode/qr_generator.php?code='.$username, 21, 49, 10, 10, "png");

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