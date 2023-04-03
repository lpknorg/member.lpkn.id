<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inbox_model extends CI_Model
{

    public $table = 'inbox';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function json() {
        $this->datatables->select('id,judul,deskripsi,create_at');
        $this->datatables->from('inbox');
        //add this line for join
        //$this->datatables->join('table2', 'jenis_produk.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('jenis_produk/read/$1'),'Read')." | ".anchor(site_url('jenis_produk/update/$1'),'Update')." | ".anchor(site_url('jenis_produk/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'inbox/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('edit_inbox'))?'<button onclick="load_controler(\'inbox/update/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>':"").'
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('delete_inbox'))?'<button onclick="if(confirm(\'Are you sure?\')) load_controler(\'inbox/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>':"").'
                                                    </div>', 
                                        'id'
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
        $this->db->like('id', $q);
	$this->db->or_like('kategori_berita', $q);
	$this->db->or_like('judul', $q);
	$this->db->or_like('slug', $q);
	$this->db->or_like('gambar', $q);
	$this->db->or_like('isi', $q);
	$this->db->or_like('create_by', $q);
	$this->db->or_like('create_at', $q);
	$this->db->or_like('update_by', $q);
	$this->db->or_like('update_at', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('kategori_berita', $q);
	$this->db->or_like('judul', $q);
	$this->db->or_like('slug', $q);
	$this->db->or_like('gambar', $q);
	$this->db->or_like('isi', $q);
	$this->db->or_like('create_by', $q);
	$this->db->or_like('create_at', $q);
	$this->db->or_like('update_by', $q);
	$this->db->or_like('update_at', $q);
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