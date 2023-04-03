<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daftar_nilai_model extends CI_Model
{

    public $table = 'daftar_nilai';
    public $id = 'id_nilai';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_nilai,nilai_min,nilai_max,nilai_huruf,mutu,ket_nilai');
        $this->datatables->from('daftar_nilai');
        //add this line for join
        //$this->datatables->join('table2', 'daftar_nilai.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('daftar_nilai/read/$1'),'Read')." | ".anchor(site_url('daftar_nilai/update/$1'),'Update')." | ".anchor(site_url('daftar_nilai/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_nilai');
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'daftar_nilai/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('edit_daftar_nilai'))?'<button onclick="load_controler(\'daftar_nilai/update/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>':"").'
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('delete_daftar_nilai'))?'<button onclick="if(confirm(\'Are you sure?\')) load_controler(\'daftar_nilai/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>':"").'
                                                    </div>', 
                                        'id_nilai'
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
        $this->db->like('id_nilai', $q);
	$this->db->or_like('nilai_min', $q);
	$this->db->or_like('nilai_max', $q);
	$this->db->or_like('nilai_huruf', $q);
	$this->db->or_like('ket_nilai', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_nilai', $q);
	$this->db->or_like('nilai_min', $q);
	$this->db->or_like('nilai_max', $q);
	$this->db->or_like('nilai_huruf', $q);
	$this->db->or_like('ket_nilai', $q);
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