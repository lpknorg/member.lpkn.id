<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public $table = 'users';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,ip_address,username,password,email,activation_selector,activation_code,forgotten_password_selector,forgotten_password_code,forgotten_password_time,remember_selector,remember_code,created_on,last_login,active,first_name,last_name,company,phone');
        $this->datatables->from('users');
        //add this line for join
        //$this->datatables->join('table2', 'users.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('users/read/$1'),'Read')." | ".anchor(site_url('users/update/$1'),'Update')." | ".anchor(site_url('users/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('edit_users'))?'<button onclick="load_controler(\'auth/edit_user/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>':"").'
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('delete_users'))?'<button onclick="if(confirm(\'Are you sure?\')) load_controler(\'users/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>':"").'
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
	$this->db->or_like('ip_address', $q);
	$this->db->or_like('username', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('activation_selector', $q);
	$this->db->or_like('activation_code', $q);
	$this->db->or_like('forgotten_password_selector', $q);
	$this->db->or_like('forgotten_password_code', $q);
	$this->db->or_like('forgotten_password_time', $q);
	$this->db->or_like('remember_selector', $q);
	$this->db->or_like('remember_code', $q);
	$this->db->or_like('created_on', $q);
	$this->db->or_like('last_login', $q);
	$this->db->or_like('active', $q);
	$this->db->or_like('first_name', $q);
	$this->db->or_like('last_name', $q);
	$this->db->or_like('company', $q);
	$this->db->or_like('phone', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('ip_address', $q);
	$this->db->or_like('username', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('activation_selector', $q);
	$this->db->or_like('activation_code', $q);
	$this->db->or_like('forgotten_password_selector', $q);
	$this->db->or_like('forgotten_password_code', $q);
	$this->db->or_like('forgotten_password_time', $q);
	$this->db->or_like('remember_selector', $q);
	$this->db->or_like('remember_code', $q);
	$this->db->or_like('created_on', $q);
	$this->db->or_like('last_login', $q);
	$this->db->or_like('active', $q);
	$this->db->or_like('first_name', $q);
	$this->db->or_like('last_name', $q);
	$this->db->or_like('company', $q);
	$this->db->or_like('phone', $q);
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