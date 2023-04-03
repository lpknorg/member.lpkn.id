<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public $table = 'menu';
    public $id = 'id_menu';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_menu,menu_name,icon_menu,id_group_menu,menu_link,description_menu,status');
        $this->datatables->from('menu');
        //add this line for join
        //$this->datatables->join('table2', 'menu.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('menu/read/$1'),'Read')." | ".anchor(site_url('menu/update/$1'),'Update')." | ".anchor(site_url('menu/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_menu');
        $this->datatables->add_column('view_only', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'menu/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    </div>', 
                                        'id_menu'
                                    );
        $this->datatables->add_column('update_only', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'menu/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    <button onclick="load_controler(\'menu/update/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>
                                                    </div>', 
                                        'id_menu'
                                    );
        $this->datatables->add_column('delete_only', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'menu/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    <button onclick="if(confirm(\'Are you sure?\')) load_controler(\'menu/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                                    </div>', 
                                        'id_menu'
                                    );
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'menu/read/$1\');" class="btn btn-default" type="button"><i class="fa fa-eye"></i></button>
                                                    <button onclick="load_controler(\'menu/update/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>
                                                    <button onclick="if(confirm(\'Are you sure?\')) load_controler(\'menu/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                                    </div>', 
                                        'id_menu'
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
        $this->db->like('id_menu', $q);
	$this->db->or_like('menu_name', $q);
	$this->db->or_like('icon_menu', $q);
	$this->db->or_like('id_group_menu', $q);
	$this->db->or_like('menu_link', $q);
	$this->db->or_like('description_menu', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_menu', $q);
	$this->db->or_like('menu_name', $q);
	$this->db->or_like('icon_menu', $q);
	$this->db->or_like('id_group_menu', $q);
	$this->db->or_like('menu_link', $q);
	$this->db->or_like('description_menu', $q);
	$this->db->or_like('status', $q);
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