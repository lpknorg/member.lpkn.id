<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile_model extends CI_Model
{
    function get_member($nik)
    {
        $this->db->select('nik, u.email, phone AS no_hp, nama_lengkap, id_propinsi, id_kota, alamat_lengkap, tempat_lahir, tgl_lahir, instansi, fb, instagram, profesi, ref, bank_rek_ref, no_rek_ref, an_rek_ref, pp, create_date');
        $this->db->from('member m');
        $this->db->join('users u', 'm.nik = u.username', 'left');
        $this->db->where('nik', $nik);
        $result = $this->db->get()->row();
        return $result;
    }

    // update data
    function update_member($nik, $data)
    {
        $this->db->where('nik', $nik);
        $this->db->update('member', $data);
    }

    function update_user($username, $data)
    {
        $this->db->where('username', $username);
        $this->db->update('users', $data);
    }

    public function pendapatan($id_user)
    {
        $this->db->select('IFNULL(sum(nominal), 0) AS nominal', false);
        $this->db->where('id_user', $id_user);
        $this->db->where('jenis', 0);
        $return = $this->db->get('pergerakan_saldo')->row();
        return $return;
    }
    public function pencairan($id_user)
    {
        $this->db->select('IFNULL(sum(nominal), 0) AS nominal', false);
        $this->db->where('id_user', $id_user);
        $this->db->where('jenis', 1);
        $return = $this->db->get('pergerakan_saldo')->row();
        return $return;
    }
}