<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member_model extends CI_Model
{

    public $table = 'member';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('m.id as id,nik,u.email,nama_lengkap,alamat_lengkap,g.description as desc_group,create_date,expired_date');
        $this->datatables->from('member m');
        //add this line for join
        $this->datatables->join('users u', 'u.username = m.nik');
        $this->datatables->join('users_groups ug', 'u.id = ug.user_id');
        $this->datatables->join('groups g', 'g.id = ug.group_id');
        //$this->datatables->add_column('action', anchor(site_url('member/read/$1'),'Read')." | ".anchor(site_url('member/update/$1'),'Update')." | ".anchor(site_url('member/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'member/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('edit_member'))?'<button onclick="load_controler(\'member/update/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>':"").'
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('delete_member'))?'<button onclick="if(confirm(\'Are you sure?\')) load_controler(\'member/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>':"").'
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
	$this->db->or_like('nik', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('nama_lengkap', $q);
	$this->db->or_like('prov', $q);
	$this->db->or_like('kabkota', $q);
	$this->db->or_like('create_date', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('nama_lengkap', $q);
	$this->db->or_like('prov', $q);
	$this->db->or_like('kabkota', $q);
	$this->db->or_like('create_date', $q);
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