<!doctype html>
    <link href="<?php echo base_url();?>assets/vendors/toastr/css/toastr.min.css" rel="stylesheet" />
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url();?>assets/vendors/toastr/js/toastr.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
            <!-- <main class="main"> -->
                <!-- Breadcrumb-->
                <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/vendors/nestable/style.css">
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
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        <div class="row">
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
                                        <?php if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('create_menu')) : ?>
                                        <div class="col-md-4 text-right">
                                            <button class="btn btn-primary btn-sm" onclick="load_controler('tbl_menu/create');">Create</button>
	                                    </div>
                                          <?php endif; ?>
                                    </div>
                                            <div class="table-responsive">

                                                <!-- <div class="cf nestable-lists"> -->
                                                    <div class="dd" id="nestable">
                                                        <menu id="nestable-menu">
                                                            <button class="btn btn-primary btn-sm" data-action="expand-all">Expand All</button>
                                                            <button class="btn btn-default btn-sm" data-action="collapse-all">Collapse All</button>
                                                        </menu>
                                                    <?php 
                                                        $this->db->order_by('sort');
                                                        $datalist_menu = $this->db->get('tbl_menu')->result();
                                                        $ref   = [];
                                                        $items = [];

                                                        foreach ($datalist_menu as $data) {

                                                            $thisRef = &$ref[$data->id];
                                                            if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('edit_menu')){
                                                              $edit = '<a class="edit-button" onclick="load_controler(\'tbl_menu/update/'.$data->id.'\');" id="'.$data->id.'" label="'.$data->label.'" link="'.$data->link.'" ><i class="fa fa-pencil"></i></a>';
                                                            }else{
                                                              $edit = "";
                                                            }
                                                            if($this->ion_auth_acl->has_permission('access_admin') OR $this->ion_auth_acl->has_permission('delete_menu')){
                                                              $delete = '<a class="edit-button" onclick="load_controler(\'tbl_menu/delete/'.$data->id.'\');" id="'.$data->id.'" label="'.$data->label.'" link="'.$data->link.'" ><i class="fa fa-trash"></i></a>';
                                                            }else{
                                                              $delete = '';
                                                            }


                                                            $thisRef['parent'] = $data->parent;
                                                            $thisRef['label'] = $data->label;
                                                            $thisRef['icon'] = $data->icon;
                                                            $thisRef['link'] = $data->link;
                                                            $thisRef['edit'] = $edit;
                                                            $thisRef['delete'] = $delete;
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
                                                                            <div class="dd-handle dd3-handle"></div>
                                                                            
                                                                            <div class="dd3-content"><i class="'.$value['icon'].'"></i>&nbsp;&nbsp;<span id="label_show'.$value['id'].'">'.$value['label'].'</span> 
                                                                                <span class="span-right"><span id="link_show'.$value['id'].'">'.$value['link'].'</span> &nbsp;&nbsp; 
                                                                                    '.$value['edit'].'
                                                                                    '.$value['delete'].'
                                                                            </div>';
                                                                if(array_key_exists('child',$value)) {
                                                                    $html .= get_menu($value['child'],'child');
                                                                }
                                                                    $html .= "</li>";
                                                            }
                                                            $html .= "</ol>";

                                                            return $html;

                                                        }
                                                         
                                                        print get_menu($items);

                                                    ?>
                                                    <input type="hidden" id="nestable-output">
                                                    </div>
                                                <!-- </div> -->
                                            </div>
                                        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables4/datatables.min.css') ?>"/>
                                        <script type="text/javascript" src="<?php echo base_url('assets/datatables4/datatables.min.js') ?>"></script>

                                        <script src="<?php echo base_url();?>assets/vendors/nestable/jquery.nestable.js"></script>
                                        <script>

                                            $(document).ready(function()
                                            {

                                                var updateOutput = function(e)
                                                {
                                                    var list   = e.length ? e : $(e.target),
                                                        output = list.data('output');
                                                    if (window.JSON) {
                                                        output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                                                    } else {
                                                        output.val('JSON browser support required for this demo.');
                                                    }
                                                };

                                                // activate Nestable for list 1
                                                $('#nestable').nestable({
                                                    group: 1
                                                })
                                                .on('change', updateOutput);



                                                // output initial serialised data
                                                updateOutput($('#nestable').data('output', $('#nestable-output')));

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

                                        <script>
                                          $(document).ready(function(){
                                            $("#load").hide();
                                            $("#submit").click(function(){
                                               $("#load").show();

                                               var dataString = { 
                                                      label : $("#label").val(),
                                                      link : $("#link").val(),
                                                      id : $("#id").val()
                                                    };

                                                $.ajax({
                                                    type: "POST",
                                                    url: "save_menu.php",
                                                    data: dataString,
                                                    dataType: "json",
                                                    cache : false,
                                                    success: function(data){
                                                      if(data.type == 'add'){
                                                         $("#menu-id").append(data.menu);
                                                      } else if(data.type == 'edit'){
                                                         $('#label_show'+data.id).html(data.label);
                                                         $('#link_show'+data.id).html(data.link);
                                                      }
                                                      $('#label').val('');
                                                      $('#link').val('');
                                                      $('#id').val('');
                                                      $("#load").hide();
                                                    } ,error: function(xhr, status, error) {
                                                      alert(error);
                                                    },
                                                });
                                            });

                                            $('.dd').on('change', function() {
                                                $("#load").show();
                                             
                                                  var dataString = { 
                                                      <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                                                      data : $("#nestable-output").val(),
                                                    };

                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?=base_url('menu_dinamic/save_menu')?>",
                                                    data: dataString,
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
                                                        $('main.main').load(res.redirect);
                                                  }
                                            
                                                })

                                            });

                                            $("#save").click(function(){
                                                 $("#load").show();
                                             
                                                  var dataString = { 
                                                      data : $("#nestable-output").val(),
                                                    };

                                                $.ajax({
                                                    type: "POST",
                                                    // url: "save.php",
                                                    url: "<?=base_url('menu_list/save_menu')?>",
                                                    data: dataString,
                                                    // "data": { dataString, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}
                                                    cache : false,
                                                    success: function(data){
                                                      $("#load").hide();
                                                      alert('Data has been saved');
                                                  
                                                    } ,error: function(xhr, status, error) {
                                                      alert(error);
                                                    },
                                                });
                                            });

                                         
                                            $(document).on("click",".del-button",function() {
                                                var x = confirm('Delete this menu?');
                                                var id = $(this).attr('id');
                                                if(x){
                                                    $("#load").show();
                                                     $.ajax({
                                                        type: "POST",
                                                        url: "delete.php",
                                                        data: { id : id },
                                                        cache : false,
                                                        success: function(data){
                                                          $("#load").hide();
                                                          $("li[data-id='" + id +"']").remove();
                                                        } ,error: function(xhr, status, error) {
                                                          alert(error);
                                                        },
                                                    });
                                                }
                                            });

                                            $(document).on("click",".edit-button",function() {
                                                var id = $(this).attr('id');
                                                var label = $(this).attr('label');
                                                var link = $(this).attr('link');
                                                $("#id").val(id);
                                                $("#label").val(label);
                                                $("#link").val(link);
                                            });

                                            $(document).on("click","#reset",function() {
                                                $('#label').val('');
                                                $('#link').val('');
                                                $('#id').val('');
                                            });

                                          });

                                        </script>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
        <script src="<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js"></script>