<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Khs_model extends CI_Model
{

    public $table = 'khs';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,NIM,kode_prodi,nama_tahun_akademik,kode_mata_kuliah,FORMAT(nilai_angka, 2) AS nilai_angka,nilai_huruf,mutu,date_time');
        $this->datatables->from('khs');
        //add this line for join
        $this->datatables->join('tahun_akademik', 'khs.kode_tahun_akademik = tahun_akademik.kode_tahun_akademik');
        //$this->datatables->add_column('action', anchor(site_url('khs/read/$1'),'Read')." | ".anchor(site_url('khs/update/$1'),'Update')." | ".anchor(site_url('khs/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'khs/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('edit_khs'))?'<button onclick="load_controler(\'khs/update/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>':"").'
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('delete_khs'))?'<button onclick="if(confirm(\'Are you sure?\')) load_controler(\'khs/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>':"").'
                                                    </div>', 
                                        'id'
                                    );
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->select('id,NIM,kode_prodi,kode_tahun_akademik,kode_mata_kuliah,FORMAT(nilai_angka, 2) AS nilai_angka,nilai_huruf,date_time', false);
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
        $this->db->like('id', $q);
	$this->db->or_like('NIM', $q);
    $this->db->or_like('kode_prodi', $q);
	$this->db->or_like('kode_tahun_akademik', $q);
	$this->db->or_like('kode_mata_kuliah', $q);
	$this->db->or_like('nilai_angka', $q);
	$this->db->or_like('nilai_huruf', $q);
	$this->db->or_like('date_time', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('NIM', $q);
	$this->db->or_like('kode_prodi', $q);
    $this->db->or_like('kode_tahun_akademik', $q);
	$this->db->or_like('kode_mata_kuliah', $q);
	$this->db->or_like('nilai_angka', $q);
	$this->db->or_like('nilai_huruf', $q);
	$this->db->or_like('date_time', $q);
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