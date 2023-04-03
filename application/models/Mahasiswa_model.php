<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{

    public $table = 'mahasiswa';
    public $id = 'id_mahasiswa';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_mahasiswa,NIM,nama_depan,nama_belakang,email,kode_prodi,kode_semester,tmpt_lahir,
            DATE_FORMAT(tgl_lahir, "%d/%m/%Y") AS tgl_lahir,jenis_kelamin,alamat');
        $this->datatables->from('mahasiswa');
        //add this line for join
        //$this->datatables->join('table2', 'mahasiswa.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('mahasiswa/read/$1'),'Read')." | ".anchor(site_url('mahasiswa/update/$1'),'Update')." | ".anchor(site_url('mahasiswa/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_mahasiswa');
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'mahasiswa/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('edit_mahasiswa'))?'<button onclick="load_controler(\'mahasiswa/update/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>':"").'
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('delete_mahasiswa'))?'<button onclick="if(confirm(\'Are you sure?\')) load_controler(\'mahasiswa/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>':"").'
                                                    </div>', 
                                        'id_mahasiswa'
                                    );
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_mahasiswa', $q);
	$this->db->or_like('NIM', $q);
	$this->db->or_like('nama_depan', $q);
	$this->db->or_like('nama_belakang', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('kode_prodi', $q);
	$this->db->or_like('tmpt_lahir', $q);
	$this->db->or_like('tgl_lahir', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('alamat', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_mahasiswa', $q);
	$this->db->or_like('NIM', $q);
	$this->db->or_like('nama_depan', $q);
	$this->db->or_like('nama_belakang', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('kode_prodi', $q);
	$this->db->or_like('tmpt_lahir', $q);
	$this->db->or_like('tgl_lahir', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('alamat', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}