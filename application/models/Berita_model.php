<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Berita_model extends CI_Model
{

    public $table = 'berita';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('b.id,kb.kategori_berita as kategori_berita,judul,slug,gambar,isi,create_by,create_at,update_by,update_at');
        $this->datatables->from('berita b');
        //add this line for join
        $this->datatables->join('kategori_berita kb', 'b.kategori_berita = kb.id');
        //$this->datatables->add_column('action', anchor(site_url('berita/read/$1'),'Read')." | ".anchor(site_url('berita/update/$1'),'Update')." | ".anchor(site_url('berita/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'berita/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('edit_berita'))?'<button onclick="load_controler(\'berita/update/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>':"").'
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('delete_berita'))?'<button onclick="if(confirm(\'Are you sure?\')) load_controler(\'berita/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>':"").'
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