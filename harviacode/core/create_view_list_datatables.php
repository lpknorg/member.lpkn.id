<?php 

$string = "<!doctype html>
            <!-- <main class=\"main\"> -->
                <!-- Breadcrumb-->
                <ol class=\"breadcrumb\">
                    <li class=\"breadcrumb-item\">SISTEM INFORMASI USER & MENU</li>
                    <!-- Breadcrumb Menu-->
                    <li class=\"breadcrumb-menu d-md-down-none\">
                        <div class=\"btn-group\" role=\"group\" aria-label=\"Button group\">
                            <a class=\"btn\" href=\"#\">
                                <i class=\"icon-speech\"></i>
                            </a>
                            <a class=\"btn\" href=\"./\">
                                <i class=\"icon-graph\"></i>  Dashboard</a>
                            <a class=\"btn\" href=\"#\">
                                <i class=\"icon-settings\"></i>  Settings</a>
                        </div>
                    </li>
                </ol>
                <div class=\"container-fluid\">
                    <div class=\"animated fadeIn\">
                        <div class=\"row\">
                            <div class=\"col-lg-12\">
                                <div class=\"card\">
                                    <div class=\"card-body\">

                                    <div class=\"row\" style=\"margin-bottom: 10px\">
                                        <div class=\"col-md-4\">
                                            <h4 style=\"margin-top:0px\">".label($table_name)." List</h4>
                                        </div>
                                        <div class=\"col-md-4 text-center\">
                                            <div style=\"margin-top: 4px\"  id=\"message\">
                                                <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                                            </div>
                                        </div>
                                        <div class=\"col-md-4 text-right\">
                                        <?php if(\$this->ion_auth_acl->has_permission('access_admin') OR \$this->ion_auth_acl->has_permission('create_".$table_name."')) : ?>
                                            <button class=\"btn btn-primary btn-sm\" onclick=\"load_controler('".$c_url."/create');\">Create</button>
                                        <?php endif; ?>";
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
}
$string .= "\n\t                                      </div>
                                            </div>
                                            <div class=\"table-responsive\">
                                            <table class=\"table table-striped table-sm\" id=\"mytable\">
                                                <thead>
                                                    <tr>
                                                        <th width=\"80px\">No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t                                                <th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t                                                <th width=\"90px\">Action</th>
                                                    </tr>
                                                </thead>";

$column_non_pk = array();
foreach ($non_pk as $row) {
    $column_non_pk[] .= "{\"data\": \"".$row['column_name']."\"}";
}
$col_non_pk = implode(',', $column_non_pk);

$string .= "\n\t    
                                        </table>
                                        </div>
                                        <link rel=\"stylesheet\" type=\"text/css\" href=\"<?php echo base_url('assets/datatables4/datatables.min.css') ?>\"/>
                                        <script type=\"text/javascript\" src=\"<?php echo base_url('assets/datatables4/datatables.min.js') ?>\"></script>
                                        <script type=\"text/javascript\">
                                            $(document).ready(function() {
                                                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                                                {
                                                    return {
                                                        \"iStart\": oSettings._iDisplayStart,
                                                        \"iEnd\": oSettings.fnDisplayEnd(),
                                                        \"iLength\": oSettings._iDisplayLength,
                                                        \"iTotal\": oSettings.fnRecordsTotal(),
                                                        \"iFilteredTotal\": oSettings.fnRecordsDisplay(),
                                                        \"iPage\": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                                                        \"iTotalPages\": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                                                    };
                                                };

                                                var t = $(\"#mytable\").dataTable({
                                                    initComplete: function() {
                                                        var api = this.api();
                                                        $('#mytable_filter input')
                                                                .off('.DT')
                                                                .on('keyup.DT', function(e) {
                                                                    if (e.keyCode == 13) {
                                                                        api.search(this.value).draw();
                                                            }
                                                        });
                                                    },
                                                    oLanguage: {
                                                        sProcessing: \"loading...\"
                                                    },
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: {\"url\": \"".$c_url."/json\", \"type\": \"POST\", \"data\": {'<?php echo \$this->security->get_csrf_token_name(); ?>' : '<?php echo \$this->security->get_csrf_hash(); ?>'} },
                                                    columns: [
                                                        {
                                                            \"data\": \"$pk\",
                                                            \"orderable\": false
                                                        },".$col_non_pk.",
                                                        {
                                                            \"data\" : \"all\",
                                                            \"orderable\": false,
                                                            \"className\" : \"text-center\"
                                                        }
                                                    ],
                                                    order: [[0, 'desc']],
                                                    rowCallback: function(row, data, iDisplayIndex) {
                                                        var info = this.fnPagingInfo();
                                                        var page = info.iPage;
                                                        var length = info.iLength;
                                                        var index = page * length + (iDisplayIndex + 1);
                                                        $('td:eq(0)', row).html(index);
                                                    }
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
        <script src=\"<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js\"></script>";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>