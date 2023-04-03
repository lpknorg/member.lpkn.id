<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{

    public $table = 'pembayaran';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,invoice,jenis_pembayaran,if(paket = 1,"3 Bulan",if(paket = 2,"6 Bulan","1 Tahun")) AS paket,nominal,snaptoken,bukti,if(status = 0,if(bukti is NULL, "Pending", "Upload Bukti"),if(status = 1,"Paid",if(status = 2,"Cancel","Expire"))) AS status_name,status,create_date,update_date,update_by', false);
        $this->datatables->from('pembayaran');
        $this->db->where('view', 1);
        if (!$this->ion_auth->is_admin()){
            $this->db->where('user_id', $this->ion_auth->get_user_id());
        }
        //add this line for join
        //$this->datatables->join('table2', 'pembayaran.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('pembayaran/read/$1'),'Read')." | ".anchor(site_url('pembayaran/update/$1'),'Update')." | ".anchor(site_url('pembayaran/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        $this->datatables->add_column('all', '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <button onclick="load_controler(\'pembayaran/read/$1\');" class="btn btn-secondary" type="button"><i class="fa fa-eye"></i></button>
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('edit_pembayaran'))?'<button onclick="load_controler(\'pembayaran/update/$1\');" class="btn btn-primary" type="button"><i class="fa fa-pencil-square-o"></i></button>':"").'
                                                    '.(($this->ion_auth->is_admin() OR $this->ion_auth_acl->has_permission('delete_pembayaran'))?'<button onclick="if(confirm(\'Are you sure?\')) load_controler(\'pembayaran/delete/$1\');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>':"").'
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
	$this->db->or_like('jenis_pembayaran', $q);
	$this->db->or_like('paket', $q);
	$this->db->or_like('nominal', $q);
	$this->db->or_like('snaptoken', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('create_date', $q);
	$this->db->or_like('update_date', $q);
	$this->db->or_like('update_by', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('jenis_pembayaran', $q);
	$this->db->or_like('paket', $q);
	$this->db->or_like('nominal', $q);
	$this->db->or_like('snaptoken', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('create_date', $q);
	$this->db->or_like('update_date', $q);
	$this->db->or_like('update_by', $q);
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