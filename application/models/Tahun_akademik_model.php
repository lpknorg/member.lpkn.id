<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tahun_akademik_model extends CI_Model
{

    public $table = 'tahun_akademik';
    public $id = 'id_tahun_akademik';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_tahun_akademik,kode_tahun_akademik,nama_tahun_akademik,ket, (if(status=0, "", "checked")) AS stts');
        $this->datatables->from('tahun_akademik');
        //add this line for join
        //$this->datatables->join('table2', 'tahun_akademik.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('tahun_akademik/read/$1'),'Read')." | ".anchor(site_url('tahun_akademik/update/$1'),'Update')." | ".anchor(site_url('tahun_akademik/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_tahun_akademik');
        $this->datatables->add_column('status', 
            (($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('edit_tahun_akademik'))? 
                '<label class="switch switch-sm switch-label switch-pill switch-success">
                    <input id="$1" class="switch-input status" value="$1" type="checkbox" $2 />
                    <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                  </label>':
                '<label class="switch switch-sm switch-label switch-pill switch-success">
                    <input id="$1" class="switch-input status" value="$1" type="checkbox" $2 disabled />
                    <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                  </label>'),
            'kode_tahun_akademik, stts'
        );
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'tahun_akademik/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('edit_tahun_akademik'))?'<button onclick="load_controler(\'tahun_akademik/update/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>':"").'
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('delete_tahun_akademik'))?'<button onclick="if(confirm(\'Are you sure?\')) load_controler(\'tahun_akademik/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>':"").'
                                                    </div>', 
                                        'id_tahun_akademik'
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
        $this->db->like('id_tahun_akademik', $q);
	$this->db->or_like('kode_tahun_akademik', $q);
	$this->db->or_like('nama_tahun_akademik', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('ket', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_tahun_akademik', $q);
	$this->db->or_like('kode_tahun_akademik', $q);
	$this->db->or_like('nama_tahun_akademik', $q);
	$this->db->or_like('status', $q);
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