<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mata_kuliah_model extends CI_Model
{

    public $table = 'mata_kuliah';
    public $id = 'id_mata_kuliah';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_mata_kuliah,kode_mata_kuliah,nama_mata_kuliah,sks,kode_prodi,kode_semester,ket');
        $this->datatables->from('mata_kuliah');
        //add this line for join
        //$this->datatables->join('table2', 'mata_kuliah.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('mata_kuliah/read/$1'),'Read')." | ".anchor(site_url('mata_kuliah/update/$1'),'Update')." | ".anchor(site_url('mata_kuliah/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_mata_kuliah');
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'mata_kuliah/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('edit_mata_kuliah'))?'<button onclick="load_controler(\'mata_kuliah/update/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>':"").'
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('delete_mata_kuliah'))?'<button onclick="if(confirm(\'Are you sure?\')) load_controler(\'mata_kuliah/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>':"").'
                                                    </div>', 
                                        'id_mata_kuliah'
                                    );
        return $this->datatables->generate();
    }

    function json_input_nilai() {
        $this->datatables->select('id_mata_kuliah,kode_mata_kuliah,nama_mata_kuliah,sks,kode_prodi,kode_semester,ket');
        $this->datatables->from('mata_kuliah');
        //add this line for join
        //$this->datatables->join('table2', 'mata_kuliah.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('mata_kuliah/read/$1'),'Read')." | ".anchor(site_url('mata_kuliah/update/$1'),'Update')." | ".anchor(site_url('mata_kuliah/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_mata_kuliah');
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'khs/input_nilai/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>                                                    
                                                    </div>', 
                                        'id_mata_kuliah'
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
        $this->db->like('id_mata_kuliah', $q);
	$this->db->or_like('kode_mata_kuliah', $q);
	$this->db->or_like('nama_mata_kuliah', $q);
	$this->db->or_like('sks', $q);
	$this->db->or_like('kode_prodi', $q);
	$this->db->or_like('kode_semester', $q);
	$this->db->or_like('ket', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_mata_kuliah', $q);
	$this->db->or_like('kode_mata_kuliah', $q);
	$this->db->or_like('nama_mata_kuliah', $q);
	$this->db->or_like('sks', $q);
	$this->db->or_like('kode_prodi', $q);
	$this->db->or_like('kode_semester', $q);
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