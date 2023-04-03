<?php 

$string = "<!doctype html>
      <script>
        $(document).ready(function() {
            $('form.jsform').on('submit', function(form){
                form.preventDefault();
                $.post('<?php echo \$action;?>', $('form.jsform').serialize(), function(data){
                    $('main.main').html(data);
                });
            });
        });
      </script>
            <!-- <main class=\"main\"> -->
                <!-- Breadcrumb-->
                <ol class=\"breadcrumb\">
                    <li class=\"breadcrumb-item\">SISTEM INFORMASI USER & MENU</li>
                </ol>
                <div class=\"container-fluid\">
                    <div class=\"animated fadeIn\">
                        <div class=\"row\">
                            <div class=\"col-sm-6\">
                                <div class=\"card\">
                                    <div class=\"card-body\">
                                        <h4 style=\"margin-top:0px\">".label($table_name)." <?php echo \$button ?></h4><br>
                                        <form action=\"<?php echo \$action; ?>\" method=\"post\" class=\"jsform\">
                                        <input type=\"hidden\" name=\"<?=\$this->security->get_csrf_token_name(); ?>\" value=\"<?=\$this->security->get_csrf_hash(); ?>\">";
foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text')
    {
    $string .= "\n\t                                    <div class=\"form-group\">
                                            <label for=\"".$row["column_name"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
                                            <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
                                        </div>";
    } else
    {
    $string .= "\n\t                                    <div class=\"form-group\">
                                            <label for=\"".$row["data_type"]."\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
                                            <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
                                        </div>";
    }
}
$string .= "\n\t                                    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
$string .= "\n\t                                    <button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> ";
$string .= "\n\t                                    <button type=\"button\" class=\"btn btn-default\" onclick=\"load_controler('".$c_url."');\">Cancel</button>";
$string .= "\n\t                                </form>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
            <!-- </main> -->
        <script src=\"<?php echo base_url();?>assets/vendors/pace-progress/js/pace.min.js\"></script>";

$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>