<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Khs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Khs_model');
        $this->load->model('Mata_kuliah_model');
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

    public function index_nilai()
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('khs/mata_kuliah_list');
        }
    } 
    
    public function json_nilai() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Mata_kuliah_model->json_input_nilai();
        }
    }

    public function index()
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('khs/khs_list');
        }
    } 
    
    public function json() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Khs_model->json();
        }
    }

    public function input_nilai($id)
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Mata_kuliah_model->get_by_id($id);
            if ($row) {
                $th = $this->db->where('status', 1)->get('tahun_akademik')->row();
                // $mhs = $this->db->where('kode_prodi', $row->kode_prodi)->where('kode_semester', $row->kode_semester)->get('mahasiswa')->result();
                $this->db->from('mahasiswa m');
                $this->db->where("m.kode_semester = '".$row->kode_semester."' AND m.NIM NOT IN (select NIM from khs where NIM = m.NIM
                 AND kode_mata_kuliah = '".$row->kode_mata_kuliah."' 
                 AND kode_tahun_akademik = ".$th->kode_tahun_akademik.")");
                $mhs = $this->db->get()->result();
                $data = array(
                    'id_mata_kuliah' => $row->id_mata_kuliah,
                    'kode_mata_kuliah' => $row->kode_mata_kuliah,
                    'nama_mata_kuliah' => $row->nama_mata_kuliah,
                    'sks' => $row->sks,
                    'kode_prodi' => $row->kode_prodi,
                    'kode_semester' => $row->kode_semester,
                    'ket' => $row->ket,
                    'list_mahasiswa' => $mhs,
                );
                $this->load->view('khs/form_input_nilai', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('khs'));
            }
        }
    }

    public function input_nilai_action($mk = NULL)
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            if($mk != NULL && $this->input->post()){
                // echo $mk;
                
                $total_update = 0;
                foreach($this->input->post() as $k => $v){
                    if( $v !== "" ){
                        if( substr($k, 0, 4) == 'nim_' ){
                            $th = $this->db->where('status', 1)->get('tahun_akademik')->row();
                            $nilai = $this->db->query("SELECT * FROM daftar_nilai WHERE ".$v." BETWEEN nilai_min AND nilai_max", FALSE)->row();
                            $huruf = $nilai->nilai_huruf;
                            $mutu =  $nilai->mutu;
                            $nim  =   str_replace("nim_","",$k);
                            // if( $v !== "" ){
                                $data = ['NIM' => $nim, 
                                         'kode_mata_kuliah' => $mk, 
                                         'kode_tahun_akademik' => $th->kode_tahun_akademik,
                                         'nilai_angka' => $v, 
                                         'nilai_huruf' => $huruf,
                                         'mutu' => $mutu
                                        ];
                                $this->Khs_model->insert($data);
                            $count_update = 1;
                            $total_update += $count_update;
                        }
                    }
                }
                if($total_update == 0){
                    $this->res['success'] = false;
                    $this->res['count'] = $total_update;
                }else{
                    $mk = $this->db->where('kode_mata_kuliah', $mk)->get('mata_kuliah')->row();
                    $this->res['success'] = true;
                    $this->res['count'] = $total_update;
                    $this->res['redirect'] = base_url('khs/input_nilai/'.$mk->id_mata_kuliah);
                }
            }else{
                $this->res['success'] = false;
            }
            echo json_encode($this->res);
        }
    }

    public function index_khs()
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->view('khs/khs_list');
        }
    } 
    
    public function json_khs() {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            header('Content-Type: application/json');
            echo $this->Khs_model->json();
        }
    }

    public function read($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Khs_model->get_by_id($id);
            if ($row) {
                $data = array(
			'id' => $row->id,
			'NIM' => $row->NIM,
            'kode_prodi' => $row->kode_prodi,
			'kode_tahun_akademik' => $row->kode_tahun_akademik,
			'kode_mata_kuliah' => $row->kode_mata_kuliah,
			'nilai_angka' => $row->nilai_angka,
			'nilai_huruf' => $row->nilai_huruf,
			'date_time' => $row->date_time,
		    );
                $this->load->view('khs/khs_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('khs'));
            }
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            $data = array(
                'button' => 'Create',
                'action' => site_url('khs/create_action'),
			    'id' => set_value('id'),
			    'NIM' => set_value('NIM'),
                'kode_prodi' => set_value('kode_prodi'),
			    'kode_tahun_akademik' => set_value('kode_tahun_akademik'),
			    'kode_mata_kuliah' => set_value('kode_mata_kuliah'),
			    'nilai_angka' => set_value('nilai_angka'),
			);
            $this->load->view('khs/khs_form', $data);
        }
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('create_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $nilai_angka = $this->input->post('nilai_angka');
                $huruf = $this->db->query("SELECT * FROM daftar_nilai WHERE ".$nilai_angka." BETWEEN nilai_min AND nilai_max", FALSE)->row();
                $data = array(
					'NIM' => $this->input->post('NIM',TRUE),
                    'kode_prodi' => $this->input->post('kode_prodi',TRUE),
					'kode_tahun_akademik' => $this->input->post('kode_tahun_akademik',TRUE),
					'kode_mata_kuliah' => $this->input->post('kode_mata_kuliah',TRUE),
					'nilai_angka' => $this->input->post('nilai_angka',TRUE),
                    'nilai_huruf' => $huruf->nilai_huruf,
					'mutu' => $huruf->mutu,
			    );
                $this->Khs_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('khs'));
            }
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Khs_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('khs/update_action'),
					'id' => set_value('id', $row->id),
					'NIM' => set_value('NIM', $row->NIM),
                    'kode_prodi' => set_value('kode_prodi', $row->kode_prodi),
					'kode_tahun_akademik' => set_value('kode_tahun_akademik', $row->kode_tahun_akademik),
					'kode_mata_kuliah' => set_value('kode_mata_kuliah', $row->kode_mata_kuliah),
					'nilai_angka' => set_value('nilai_angka', $row->nilai_angka),
					'nilai_huruf' => set_value('nilai_huruf', $row->nilai_huruf),
					'date_time' => set_value('date_time', $row->date_time),
			    );
                $this->load->view('khs/khs_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('khs'));
            }
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('edit_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $nilai_angka = $this->input->post('nilai_angka');
                $huruf = $this->db->query("SELECT * FROM daftar_nilai WHERE ".$nilai_angka." BETWEEN nilai_min AND nilai_max", FALSE)->row();
                $data = array(
					'NIM' => $this->input->post('NIM',TRUE),
                    'kode_prodi' => $this->input->post('kode_prodi',TRUE),
					'kode_tahun_akademik' => $this->input->post('kode_tahun_akademik',TRUE),
					'kode_mata_kuliah' => $this->input->post('kode_mata_kuliah',TRUE),
					'nilai_angka' => $this->input->post('nilai_angka',TRUE),
                    'nilai_huruf' => $huruf->nilai_huruf,
                    'mutu' => $huruf->mutu,
					// 'nilai_huruf' => $this->input->post('nilai_huruf',TRUE),
					// 'date_time' => $this->input->post('date_time',TRUE),
			    );

                $this->Khs_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('khs'));
            }
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('delete_khs')){
            show_error('You must be an administrators to view this page.');
        }else{
            $row = $this->Khs_model->get_by_id($id);

            if ($row) {
                $this->Khs_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('khs'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('khs'));
            }
        }
    }

    public function khs_list() 
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('list_kartu_hasil_stadi')){
            show_error('You must be an administrators to view this page.');
        }else{
            if ($this->ion_auth->in_group('mahasiswa')){
                $user_login = $this->ion_auth->user()->row();
                $mahasiswa = $this->db->where('NIM', $user_login->username)->get('mahasiswa')->row();
                $this->data['semester'] = $mahasiswa->kode_semester;
                $this->load->view('khs/khs_list_mahasiswa', $this->data);
            }else{
                $user_login = $this->ion_auth->user()->row();
                $mahasiswa = $this->db->get('mahasiswa')->result();
                $this->data['mahasiswa'] = $mahasiswa;
                $this->load->view('khs/khs_list_admin', $this->data);
            }
        }
    }

    public function get_khs($semester = NULL)
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('list_kartu_hasil_stadi')){
            show_error('You must be an administrators to view this page.');
        }else{
            if(!is_null($semester)){
                $user_login = $this->ion_auth->user()->row();
                $mahasiswa = $this->db->where('NIM', $user_login->username)->get('mahasiswa')->row();
                    $this->db->select('mk.kode_mata_kuliah, mk.nama_mata_kuliah, FORMAT(k.nilai_angka, 2) AS nilai_angka, k.nilai_huruf, mk.sks, k.mutu', false);
                    $this->db->from('mata_kuliah mk');
                    $this->db->join('khs k', 'mk.kode_mata_kuliah = k.kode_mata_kuliah AND k.NIM = '.$user_login->username, 'left');
                    $this->db->where('mk.kode_prodi', $mahasiswa->kode_prodi);
                    $this->db->where('mk.kode_semester', $semester);
                $data_khs = $this->db->get()->result();
                $this->data['data_khs'] = $data_khs;
                $this->load->view('khs/get_khs', $this->data);
            }
        }
    }

    public function get_semester($NIM = NULL)
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('list_kartu_hasil_stadi')){
            show_error('You must be an administrators to view this page.');
        }else{
            if(!is_null($NIM)){
                $mahasiswa = $this->db->where('NIM', $NIM)->get('mahasiswa')->row();
                $this->data['NIM'] = $NIM;
                $this->data['semester'] = $mahasiswa->kode_semester;
                $this->load->view('khs/list_semester', $this->data);
            }
        }
    }

    public function get_khs_admin($NIM, $semester = NULL)
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('list_kartu_hasil_stadi')){
            show_error('You must be an administrators to view this page.');
        }else{
            if(!is_null($semester)){
                // $user_login = $this->ion_auth->user()->row();
                $mahasiswa = $this->db->where('NIM', $NIM)->get('mahasiswa')->row();
                    $this->db->select('mk.kode_mata_kuliah, mk.nama_mata_kuliah, FORMAT(k.nilai_angka, 2) AS nilai_angka, k.nilai_huruf, mk.sks, k.mutu', false);
                    $this->db->from('mata_kuliah mk');
                    $this->db->join('khs k', 'mk.kode_mata_kuliah = k.kode_mata_kuliah AND k.NIM = '.$NIM, 'left');
                    $this->db->where('mk.kode_prodi', $mahasiswa->kode_prodi);
                    $this->db->where('mk.kode_semester', $semester);
                $data_khs = $this->db->get()->result();
                $this->data['data_khs'] = $data_khs;
                $this->load->view('khs/get_khs', $this->data);
            }
        }
    }

    public function pdf($semester = NULL)
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('list_kartu_hasil_stadi')){
            show_error('You must be an administrators to view this page.');
        }else{
            $this->load->library('pdfgenerator');
            if(!is_null($semester)){
                $user_login = $this->ion_auth->user()->row();
                $mahasiswa = $this->db->where('NIM', $user_login->username)->get('mahasiswa')->row();
                    $this->db->select('mk.kode_mata_kuliah, mk.nama_mata_kuliah, FORMAT(k.nilai_angka, 2) AS nilai_angka, k.nilai_huruf, mk.sks, k.mutu', false);
                    $this->db->from('mata_kuliah mk');
                    $this->db->join('khs k', 'mk.kode_mata_kuliah = k.kode_mata_kuliah AND k.NIM = '.$user_login->username, 'left');
                    $this->db->where('mk.kode_prodi', $mahasiswa->kode_prodi);
                    $this->db->where('mk.kode_semester', $semester);
                $data_khs = $this->db->get()->result();
                $this->data['data_khs'] = $data_khs;
                $html = $this->load->view('khs/get_khs', $this->data, true);
                $this->pdfgenerator->generate($html,'contoh');
            }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('NIM', 'nim', 'trim|required');
	// $this->form_validation->set_rules('kode_prodi', 'kode prodi', 'trim|required');
	$this->form_validation->set_rules('kode_mata_kuliah', 'kode mata kuliah', 'trim|required');
	$this->form_validation->set_rules('nilai_angka', 'nilai angka', 'trim|required|numeric');
	// $this->form_validation->set_rules('nilai_huruf', 'nilai huruf', 'trim|required');
	// $this->form_validation->set_rules('date_time', 'date time', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "khs.xls";
        $judul = "khs";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "NIM");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Prodi");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Mata Kuliah");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Angka");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Huruf");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Time");

	foreach ($this->Khs_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->NIM);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_prodi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_mata_kuliah);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nilai_angka);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai_huruf);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_time);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Khs.php */
/* Location: ./application/controllers/Khs.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-27 19:57:23 */
/* http://harviacode.com */