<!doctype html>

                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/vendors/nestable/style.css">
    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
            <!-- <main class="main"> -->
                <!-- Breadcrumb-->
              <script>
                $(document).ready(function() {
                    $('form.jsform').on('submit', function(e){
                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "<?=base_url()?>admin/group_permissions/<?=$id?>",
                            data: $('form.jsform').serialize(),
                            dataType: "json",
                        })
                        .done(function(res) {
                            if(res.success) {
                                toastr.success('Data Changed', 'Success', 
                                    {
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "2000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                    })
                                                        
                            } else {
                                toastr.error('Data Not Changed', 'Failed', 
                                    {
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "2000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                    })
                            }
                                            
                        })
                    });
                });
              </script>
                <script type="text/javascript">
                    $(".check_all").click(function () {
                        var id = $(this).val();
                        $('.'+id).prop('checked', this.checked);
                    });
                    $('.pilih').click(function(){
                        var id = $(this).val();
                        if($('.'+id).length == $('.'+id+':checked').length) {
                            $(".all_"+id).prop("checked", "checked");
                        } else {
                            $(".all_"+id).prop('checked',false);
                        }
                    });
                </script>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">SISTEM INFORMASI USER & MENU</li>
                    <!-- Breadcrumb Menu-->
                    <li class="breadcrumb-menu d-md-down-none">
                        <div class="btn-group" role="group" aria-label="Button group">
                            <a class="btn" href="#">
                                <i class="icon-speech"></i>
                            </a>
                            <a class="btn" href="./">
                                <i class="icon-graph"></i>  Dashboard</a>
                            <a class="btn" href="#">
                                <i class="icon-settings"></i>  Settings</a>
                        </div>
                    </li>
                </ol>
                <div class="row">
                    <div class="container-fluid">
                        <div class="animated fadeIn">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 style="margin-top:0px">Groups Detail</h4><br>
                                            <table class="table">
    	                                        <tr><td>Name</td><td><?php echo $name; ?></td></tr>
    	                                        <tr><td>Description</td><td><?php echo $description; ?></td></tr>
    	                                        <tr><td></td><td><button type="button" class="btn btn-default" onclick="load_controler('groups');">Cancel</button></td></tr>
    	                                    </table>
                                        </div>
                                    </div>
                                </div>
                                <!--/.col-->
                            <?php if($this->ion_auth_acl->has_permission('access_admin') 
                                    OR $this->ion_auth_acl->has_permission('setting_access_group_user')) : ?>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">

                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-md-4">
                                                <h4 style="margin-top:0px">Backend Manu</h4>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <div style="margin-top: 4px"  id="message">
                                                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                                </div>
                                            </div>
                                        </div>
                                                <!-- <div class="table-responsive"> -->

                                                    <!-- <div class="cf nestable-lists"> -->
                                                        <div class="dd" id="nestable">
                                                            <menu id="nestable-menu">
                                                                <div class="row">
                                                                <div class="col-md-7">
                                                                    <button class="btn btn-primary btn-sm" data-action="expand-all">Expand All</button>
                                                                    <button class="btn btn-default btn-sm" data-action="collapse-all">Collapse All</button>
                                                                </div>
                                                                <div class="col-md-5 text-right">
                                                                    <button type="submit" form="myform" name="" value="save" class="btn btn-sm btn-primary">Save</button>
                                                                </div>
                                                                </div>
                                                            </menu>
                                                        <?php 
                                                            $this->db->select("m.*, CONCAT('perm_', p.id) AS perm_id, p.perm_key, gp.group_id, gp.value", false);
                                                            $this->db->from('tbl_menu m');
                                                            $this->db->join('permissions p', 'm.key = p.perm_key', 'left');
                                                            $this->db->join('groups_permissions gp', 'p.id = gp.perm_id AND gp.group_id = '.$id, 'left');
                                                            $this->db->order_by('sort');
                                                            $datalist_menu = $this->db->get()->result();
                                                            $ref   = [];
                                                            $items = [];

                                                            foreach ($datalist_menu as $data) {

                                                                $thisRef = &$ref[$data->id];
                                                                $this->db->where('parent', $data->id);
                                                                $count_parent = $this->db->get('tbl_menu')->num_rows();;
                                                                if($count_parent > 0){
                                                                    $_check_all = '&nbsp;';
                                                                    // $open = '';
                                                                    // $detail = '';
                                                                }else{
                                                                    $_check_all = '<span><input type="checkbox" name="'.$data->perm_id.'" class="check_all all_'.$data->id.'" value="1"></span>&nbsp;&nbsp;';
                                                                }
                                                                    $open = '<a class="card-header-action btn-minimize" href="#" data-toggle="collapse" data-target="#collapseExample'.$data->id.'_dd" aria-expanded="true">
                                                                                      <i class="fa fa-chevron-circle-down"></i>
                                                                                    </a>';
                                                                    $detail = '<div class="collapse" id="collapseExample'.$data->id.'_dd">
                                                                                    <table style="width:100%">';
                                                                                    $this->db->select("CONCAT('perm_', p.id) AS perm_id, p.perm_key, p.perm_name, gp.group_id, gp.value", false);
                                                                                    $this->db->from('permissions p');
                                                                                    $this->db->join('groups_permissions gp', 'p.id = gp.perm_id AND gp.group_id = '.$id, 'left');
                                                                                    $this->db->like('perm_key', substr($data->perm_key,4), 'before');
                                                                                    $perm_data = $this->db->get()->result();
                                                                                    foreach ($perm_data as $perm_key) {
                                                                    $detail.= '         <tr>
                                                                                            <th style="width:10%"></th>
                                                                                            <th style="width:30%">'.$perm_key->perm_name.'</th>
                                                                                            <th style="width:15%">
                                                                                                <input name="'.$perm_key->perm_id.'" type="radio" value="1" 
                                                                                                '.(($perm_key->value== "1")?'checked="checked"':"").'> Allow
                                                                                            </th>
                                                                                            <th style="width:15%">
                                                                                                <input name="'.$perm_key->perm_id.'" type="radio" value="0" 
                                                                                                '.(($perm_key->value== "0")?'checked="checked"':"").'> Deny
                                                                                            </th>
                                                                                            <th style="width:15%">
                                                                                                <input name="'.$perm_key->perm_id.'" type="radio" value="X"
                                                                                                '.(($perm_key->value== NULL)?'checked="checked"':"").'> Ignore
                                                                                            </th>
                                                                                        </tr>';
                                                                                    }

                                                                    $detail.= '     </table>
                                                                                </div>';
                                                                $thisRef['parent'] = $data->parent;
                                                                $thisRef['label'] = $data->label;
                                                                $thisRef['check_all'] = $_check_all;
                                                                $thisRef['open'] = $open;
                                                                $thisRef['detail'] = $detail;
                                                                $thisRef['icon'] = $data->icon;
                                                                $thisRef['link'] = $data->link;
                                                                $thisRef['id'] = $data->id;

                                                               if($data->parent == 0) {
                                                                    $items[$data->id] = &$thisRef;
                                                               } else {
                                                                    $ref[$data->parent]['child'][$data->id] = &$thisRef;
                                                               }

                                                            }

                                                            function get_menu($items,$class = 'dd-list') {

                                                                $html = "<ol class=\"".$class."\" id=\"menu-id\">";

                                                                foreach($items as $key=>$value) {
                                                                    $html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" >
                                                                                <div></div>
                                                                                
                                                                                <div class="dd3-content">
                                                                                    <i class="'.$value['icon'].'"></i>&nbsp;&nbsp;
                                                                                        <span id="label_show'.$value['id'].'">'.$value['label'].'</span> 
                                                                                        <span class="span-right"> &nbsp;&nbsp;
                                                                                        '.$value['open'].'
                                                                                </div>
                                                                                '.$value['detail'].'
                                                                                ';
                                                                    if(array_key_exists('child',$value)) {
                                                                        $html .= get_menu($value['child'],'child');
                                                                    }
                                                                        $html .= "</li>";
                                                                }
                                                                $html .= "</ol>";

                                                                return $html;

                                                            }
                                                            echo '<form action="" method="pos" class="jsform" id="myform">';
                                                            echo '<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">';
                                                            print get_menu($items);
                                                            echo '<input type="hidden" name="id" value="'.$id.'" />';
                                                            echo '<input type="hidden" name="save" value="save" />';
                                                            echo '</form>';

                                                        ?>
                                                        </div>
                                                    <!-- </div> -->
                                                <!-- </div> -->
                                            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables4/datatables.min.css') ?>"/>
                                            <script type="text/javascript" src="<?php echo base_url('assets/datatables4/datatables.min.js') ?>"></script>

                                            <script src="<?php echo base_url();?>assets/vendors/nestable/jquery.nestable.js"></script>
                                            <script>

                                                $(document).ready(function()
                                                {
                                                    $('#nestable').nestable({
                                                        group: 1
                                                    });
                                                    $('#nestable-menu').on('click', function(e)
                                                    {
                                                        var target = $(e.target),
                                                            action = target.data('action');
                                                        if (action === 'expand-all') {
                                                            $('.dd').nestable('expandAll');
                                                        }
                                                        if (action === 'collapse-all') {
                                                            $('.dd').nestable('collapseAll');
                                                        }
                                                    });
                                                });
                                            </script>

                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                                <!--/.col-->
                            </div>
                            <!--/.row-->
                        </div>
                    </div>
                </div>

        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>