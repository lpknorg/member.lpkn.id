<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_dinamic extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->library('form_validation');   
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->library('ion_auth_acl');
        $this->load->helper(['url', 'language']);
        $this->load->library('datatables');
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_menu')){
            show_error('You must be an administrators to view this page.');
        }else{
           $this->load->view('menu_dinamic/menu_list');
       }
    } 

    function parseJsonArray($jsonArray, $parentID = 0) {

      $return = array();
      foreach ($jsonArray as $subArray) {
        $returnSubSubArray = array();
        if (isset($subArray->children)) {
            $returnSubSubArray = $this->parseJsonArray($subArray->children, $subArray->id);
        }

        $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
        $return = array_merge($return, $returnSubSubArray);
      }
      return $return;
    }

    public function save_menu(){
        if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('menu_menu')){
            show_error('You must be an administrators to view this page.');
        }else{
            if (!$this->ion_auth->is_admin() && !$this->ion_auth_acl->has_permission('position_menu')){
                $this->res['success'] = false;
                $this->res['redirect'] = base_url('menu_dinamic');
            }else{
                $data = json_decode($this->input->post('data'));
                $readbleArray = $this->parseJsonArray($data);
                $i=0;
                foreach($readbleArray as $row){
                  $i++;
                    $this->db->query("update tbl_menu set parent = '".$row['parentID']."', sort = '".$i."' where id = '".$row['id']."' ");
                }
                $this->res['success'] = true;
            }
            echo json_encode($this->res);
        }
        // print_r($data);
    }

}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-08 09:35:36 */
/* http://harviacode.com */