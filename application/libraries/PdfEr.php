<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class PdfEr extends TCPDF {

	public function __construct(){

		parent::__construct();
		
	}


	//Page header
    public function Header() {

    	$CI = & get_instance();
    	$CI->load->model('estadisticas_model');

    	$col = $CI->estadisticas_model->obtener_informacion_colegio();
		$nombre_institucion = $col[0]['nombre_institucion'];
        $niveles_educacion = $col[0]['niveles_educacion'];
        $resolucion = $col[0]['resolucion'];
        $dane = $col[0]['dane'];
        $nit = $col[0]['nit'];
        $escudo = $col[0]['escudo'];

        // Logo
        $image_file = 'uploads/imagenes/colegio/'.$escudo;
        $this->Image($image_file, 10, 10, 25, 25, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(0, 0, $nombre_institucion, 0, 2, 'C', 0, '', 1, false, 'T', 'M');
        $this->Cell(0, 0, $niveles_educacion, 0, 2, 'C', 0, '', 1, false, 'T', 'M');
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 0, $resolucion, 0, 2, 'C', 0, '', 1, false, 'T', 'M');
        $this->Cell(0, 0, $dane.' '.$nit, 0, 2, 'C', 0, '', 1, false, 'T', 'M');
    }


    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
	
}