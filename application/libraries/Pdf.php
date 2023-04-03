<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**


* CodeIgniter PDF Library
 *
 * Generate PDF's in your CodeIgniter applications.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Chris Harvey
 * @license         MIT License
 * @link            https://github.com/chrisnharvey/CodeIgniter-  PDF-Generator-Library



*/

// require_once APPPATH.'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
require_once 'dompdf/autoload.inc.php';
// use Dompdf\Options;
// use dompdf_new\src\Dompdf\Dompdf;
// use dompdf_master\src\Option;

class Pdf extends DOMPDF
{
/**
 * Get an instance of CodeIgniter
 *
 * @access  protected
 * @return  void
 */
    protected function ci()
    {
        return get_instance();
    }

    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access  public
     * @param   string  $view The view to load
     * @param   array   $data The view data
     * @return  void
     */
    public function load_view($view, $filename='',  $orientation = "portrait", $data = array())
    {
        $dompdf = new Dompdf();
        $html = $this->ci()->load->view($view, $data, TRUE);
        $dompdf->loadHtml($html);
        // $dompdf->loadHtml('<!DOCTYPE html> <html> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> </head> <body><img src="https://upload.wikimedia.org/wikipedia/de/thumb/b/bb/Png-logo.png/160px-Png-logo.png"></body> </html>');

        // (Optional) Setup the paper size and orientation
        // $option =
        $dompdf->setPaper('A4', $orientation);
        // Render the HTML as PDF
        $dompdf->render();
        $pdf = $dompdf->output();
        // $time = time();
        

        ob_end_clean();
        // Output the generated PDF to Browser
        $dompdf->stream($filename);
        // $dompdf->stream($filename);
        exit;
    }
}