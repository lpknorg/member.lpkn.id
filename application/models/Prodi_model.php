<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prodi_model extends CI_Model
{

    public $table = 'prodi';
    public $id = 'id_prodi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_prodi,kode_prodi,nama_prodi,ket');
        $this->datatables->from('prodi');
        //add this line for join
        //$this->datatables->join('table2', 'prodi.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('prodi/read/$1'),'Read')." | ".anchor(site_url('prodi/update/$1'),'Update')." | ".anchor(site_url('prodi/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_prodi');
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'prodi/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('edit_prodi'))?'<button onclick="load_controler(\'prodi/update/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>':"").'
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('delete_prodi'))?'<button onclick="if(confirm(\'Are you sure?\')) load_controler(\'prodi/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>':"").'
                                                    </div>', 
                                        'id_prodi'
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
        $this->db->like('id_prodi', $q);
	$this->db->or_like('kode_prodi', $q);
	$this->db->or_like('nama_prodi', $q);
	$this->db->or_like('ket', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_prodi', $q);
	$this->db->or_like('kode_prodi', $q);
	$this->db->or_like('nama_prodi', $q);
	$this->db->or_like('ket', $q);
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