<?php
 
class PdfGenerator
{
  public function generate($html,$filename)
  {
    define('DOMPDF_ENABLE_AUTOLOAD', false);
    require_once(APPPATH . "libraries/dompdf/dompdf_config.inc.php");
 
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
	  $dompdf->set_paper("A4", "landscape");
    $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
  }
}