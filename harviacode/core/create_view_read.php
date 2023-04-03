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
                            <div class=\"col-lg-6\">
                                <div class=\"card\">
                                    <div class=\"card-body\">
                                        <h4 style=\"margin-top:0px\">".label($table_name)." Detail</h4><br>
                                        <table class=\"table\">";
foreach ($non_pk as $row) {
    $string .= "\n\t                                        <tr><td>".label($row["column_name"])."</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t                                        <tr><td></td><td><button type=\"button\" class=\"btn btn-default\" onclick=\"load_controler('".$c_url."');\">Cancel</button></td></tr>";
$string .= "\n\t                                    </table>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
        <script src=\"<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js\"></script>";



$hasil_view_read = createFile($string, $target."views/" . $c_url . "/" . $v_read_file);

?>