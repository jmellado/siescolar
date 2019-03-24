<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informes_promocion_controller extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('informes_promocion_model');
		$this->load->library('form_validation');
		$this->load->library('PdfEr');
	}


	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'informes_promocion/informes_promocion_vista');
	}


	public function llenarcombo_anos_lectivos(){

    	$consulta = $this->informes_promocion_model->llenar_anos_lectivos();
    	echo json_encode($consulta);
    }


	//============ Por Jornada =============


	public function PorJornada()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'informes_promocion/porjornada_vista');
	}


	public function mostrarporjornada(){

		$ano_lectivo = $this->input->post('ano_lectivo');
		$jornada = $this->input->post('jornada'); 
		
		$data = array(

			'porjornada' => $this->informes_promocion_model->buscar_porjornada($ano_lectivo,$jornada),

		    'totalregistros' => count($this->informes_promocion_model->buscar_porjornada($ano_lectivo,$jornada))

		);
	    echo json_encode($data);

	}


	public function generar_porjornada(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$ano_lectivo = $this->input->get('ano_lectivo');
		$jornada = $this->input->get('jornada');

		$anio = $this->informes_promocion_model->obtener_informacion_anolectivo($ano_lectivo);
		$nombre_ano_lectivo = $anio[0]['nombre_ano_lectivo'];

		$porjornada = $this->informes_promocion_model->buscar_porjornada($ano_lectivo,$jornada);

		if(count($porjornada) > 0){

			// create new PDF document
			$pdf = new PdfEr('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Informe De Promoción Por Jornada '.$nombre_ano_lectivo);
	        $pdf->SetSubject('Listados SIESCOLAR');
	        $pdf->SetKeywords('SIESCOLAR, PDF, example, test, guide');

	        // remove default header/footer
	        //$pdf->SetPrintHeader(false);
	 		//$pdf->SetPrintFooter(false);

			// establecer la fuente monoespaciada predeterminada
	        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	 
			// establecer margenes
	        $pdf->SetMargins(PDF_MARGIN_LEFT, 38, PDF_MARGIN_RIGHT);
	        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	 
			// establecer saltos automáticos de página
	        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	 
			// relación utilizada para ajustar la conversión de los píxeles, establecer el factor de escala de la imagen
	        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	        // ---------------------------------------------------------
			// establecer el modo de fuente por defecto
	        $pdf->setFontSubsetting(true);


	        // Añadir una página
	        $pdf->AddPage();

	        $pdf->SetFont('helvetica', 'B', 12);
	        $pdf->Write(0, 'INFORME DE PROMOCIÓN POR JORNADA', '', 0, 'C', true, 0, false, false, 0);
	        $pdf->SetFont('helvetica', '', 10, '', true);
	 
			//fijar efecto de sombra en el texto
	        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


	        // Establecemos el contenido para imprimir
	        //**********************************************************************************************************
			//preparamos y maquetamos el contenido a crear
			//**********************************************************************************************************

			$tbl = '';
			$tbl .= '<p align="center"><b>AÑO LECTIVO '.$nombre_ano_lectivo.'</b></p>';
			$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
	        $tbl .= '<tr>
	        			<td align="center" width="30" height="30"><b>#</b></td>
	        			<td align="center" width="200" height="30"><b>JORNADA</b></td>
	        			<td align="center" width="200" height="30"><b>SITUACIÓN ACADÉMICA</b></td>
	        			<td align="center" width="200" height="30"><b>TOTAL</b></td>
	        		</tr>';


	        for ($j=0; $j < count($porjornada); $j++) {

				$cont = $j + 1;

				$tbl .= '<tr nobr="true">

							<td align="center" width="30">'.$cont.'</td>
							<td align="center" width="200">'.$porjornada[$j]['jornada'].'</td>
		        			<td align="center" width="200">'.$porjornada[$j]['situacion_academica'].'</td>
		        			<td align="center" width="200">'.$porjornada[$j]['total'].'</td>

						</tr>';
			}

			$tbl .= '</table>';


			// Imprimimos el texto con writeHTMLCell()
		    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


		    // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Informe De Promocion Por Jornada ".$nombre_ano_lectivo.".pdf");
	        $pdf->Output($nombre_archivo, 'I');

		}
		else{

			echo "<h1>No Se Encontraron Resultados..</h1>";
		}

	}


	//============ Por Grado =============


	public function PorGrado()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'informes_promocion/porgrado_vista');
	}


	public function llenarcombo_grados(){

		$ano_lectivo =$this->input->post('ano_lectivo');

    	$consulta = $this->informes_promocion_model->llenar_grados($ano_lectivo);
    	echo json_encode($consulta);
    }


	public function mostrarporgrado(){

		$ano_lectivo = $this->input->post('ano_lectivo');
		$id_grado = $this->input->post('id_grado'); 
		
		$data = array(

			'porgrado' => $this->informes_promocion_model->buscar_porgrado($ano_lectivo,$id_grado),

		    'totalregistros' => count($this->informes_promocion_model->buscar_porgrado($ano_lectivo,$id_grado))

		);
	    echo json_encode($data);

	}


	public function generar_porgrado(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$ano_lectivo = $this->input->get('ano_lectivo');
		$id_grado = $this->input->get('id_grado');

		$anio = $this->informes_promocion_model->obtener_informacion_anolectivo($ano_lectivo);
		$nombre_ano_lectivo = $anio[0]['nombre_ano_lectivo'];

		$porgrado = $this->informes_promocion_model->buscar_porgrado($ano_lectivo,$id_grado);

		if(count($porgrado) > 0){

			// create new PDF document
			$pdf = new PdfEr('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Informe De Promoción Por Grado '.$nombre_ano_lectivo);
	        $pdf->SetSubject('Listados SIESCOLAR');
	        $pdf->SetKeywords('SIESCOLAR, PDF, example, test, guide');

	        // remove default header/footer
	        //$pdf->SetPrintHeader(false);
	 		//$pdf->SetPrintFooter(false);

			// establecer la fuente monoespaciada predeterminada
	        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	 
			// establecer margenes
	        $pdf->SetMargins(PDF_MARGIN_LEFT, 38, PDF_MARGIN_RIGHT);
	        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	 
			// establecer saltos automáticos de página
	        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	 
			// relación utilizada para ajustar la conversión de los píxeles, establecer el factor de escala de la imagen
	        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	        // ---------------------------------------------------------
			// establecer el modo de fuente por defecto
	        $pdf->setFontSubsetting(true);


	        // Añadir una página
	        $pdf->AddPage();

	        $pdf->SetFont('helvetica', 'B', 12);
	        $pdf->Write(0, 'INFORME DE PROMOCIÓN POR GRADO', '', 0, 'C', true, 0, false, false, 0);
	        $pdf->SetFont('helvetica', '', 10, '', true);
	 
			//fijar efecto de sombra en el texto
	        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


	        // Establecemos el contenido para imprimir
	        //**********************************************************************************************************
			//preparamos y maquetamos el contenido a crear
			//**********************************************************************************************************

			$tbl = '';
			$tbl .= '<p align="center"><b>AÑO LECTIVO '.$nombre_ano_lectivo.'</b></p>';
			$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
	        $tbl .= '<tr>
	        			<td align="center" width="30" height="30"><b>#</b></td>
	        			<td align="center" width="200" height="30"><b>GRADO</b></td>
	        			<td align="center" width="200" height="30"><b>SITUACIÓN ACADÉMICA</b></td>
	        			<td align="center" width="200" height="30"><b>TOTAL</b></td>
	        		</tr>';


	        for ($j=0; $j < count($porgrado); $j++) {

				$cont = $j + 1;

				$tbl .= '<tr nobr="true">

							<td align="center" width="30">'.$cont.'</td>
							<td align="center" width="200">'.$porgrado[$j]['nombre_grado'].'</td>
		        			<td align="center" width="200">'.$porgrado[$j]['situacion_academica'].'</td>
		        			<td align="center" width="200">'.$porgrado[$j]['total'].'</td>

						</tr>';
			}

			$tbl .= '</table>';


			// Imprimimos el texto con writeHTMLCell()
		    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


		    // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Informe De Promocion Por Grado ".$nombre_ano_lectivo.".pdf");
	        $pdf->Output($nombre_archivo, 'I');

		}
		else{

			echo "<h1>No Se Encontraron Resultados..</h1>";
		}

	}


	//============ Por Curso =============


	public function PorCurso()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'informes_promocion/porcurso_vista');
	}


	public function llenarcombo_cursos(){

		$ano_lectivo =$this->input->post('ano_lectivo');

    	$consulta = $this->informes_promocion_model->llenar_cursos($ano_lectivo);
    	echo json_encode($consulta);
    }


	public function mostrarporcurso(){

		$ano_lectivo = $this->input->post('ano_lectivo');
		$id_curso = $this->input->post('id_curso'); 
		
		$data = array(

			'porcurso' => $this->informes_promocion_model->buscar_porcurso($ano_lectivo,$id_curso),

		    'totalregistros' => count($this->informes_promocion_model->buscar_porcurso($ano_lectivo,$id_curso))

		);
	    echo json_encode($data);

	}


	public function generar_porcurso(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$ano_lectivo = $this->input->get('ano_lectivo');
		$id_curso = $this->input->get('id_curso');

		$anio = $this->informes_promocion_model->obtener_informacion_anolectivo($ano_lectivo);
		$nombre_ano_lectivo = $anio[0]['nombre_ano_lectivo'];

		$porcurso = $this->informes_promocion_model->buscar_porcurso($ano_lectivo,$id_curso);

		if(count($porcurso) > 0){

			// create new PDF document
			$pdf = new PdfEr('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Informe De Promoción Por Curso '.$nombre_ano_lectivo);
	        $pdf->SetSubject('Listados SIESCOLAR');
	        $pdf->SetKeywords('SIESCOLAR, PDF, example, test, guide');

	        // remove default header/footer
	        //$pdf->SetPrintHeader(false);
	 		//$pdf->SetPrintFooter(false);

			// establecer la fuente monoespaciada predeterminada
	        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	 
			// establecer margenes
	        $pdf->SetMargins(PDF_MARGIN_LEFT, 38, PDF_MARGIN_RIGHT);
	        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	 
			// establecer saltos automáticos de página
	        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	 
			// relación utilizada para ajustar la conversión de los píxeles, establecer el factor de escala de la imagen
	        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	        // ---------------------------------------------------------
			// establecer el modo de fuente por defecto
	        $pdf->setFontSubsetting(true);


	        // Añadir una página
	        $pdf->AddPage();

	        $pdf->SetFont('helvetica', 'B', 12);
	        $pdf->Write(0, 'INFORME DE PROMOCIÓN POR CURSO', '', 0, 'C', true, 0, false, false, 0);
	        $pdf->SetFont('helvetica', '', 10, '', true);
	 
			//fijar efecto de sombra en el texto
	        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


	        // Establecemos el contenido para imprimir
	        //**********************************************************************************************************
			//preparamos y maquetamos el contenido a crear
			//**********************************************************************************************************

			$tbl = '';
			$tbl .= '<p align="center"><b>AÑO LECTIVO '.$nombre_ano_lectivo.'</b></p>';
			$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
	        $tbl .= '<tr>
	        			<td align="center" width="30" height="30"><b>#</b></td>
	        			<td align="center" width="200" height="30"><b>CURSO</b></td>
	        			<td align="center" width="200" height="30"><b>SITUACIÓN ACADÉMICA</b></td>
	        			<td align="center" width="200" height="30"><b>TOTAL</b></td>
	        		</tr>';


	        for ($j=0; $j < count($porcurso); $j++) {

				$cont = $j + 1;

				$tbl .= '<tr nobr="true">

							<td align="center" width="30">'.$cont.'</td>
							<td align="center" width="200">'.$porcurso[$j]['nombre_grado'].' '.$porcurso[$j]['nombre_grupo'].' '.$porcurso[$j]['jornada'].'</td>
		        			<td align="center" width="200">'.$porcurso[$j]['situacion_academica'].'</td>
		        			<td align="center" width="200">'.$porcurso[$j]['total'].'</td>

						</tr>';
			}

			$tbl .= '</table>';


			// Imprimimos el texto con writeHTMLCell()
		    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


		    // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Informe De Promocion Por Curso ".$nombre_ano_lectivo.".pdf");
	        $pdf->Output($nombre_archivo, 'I');

		}
		else{

			echo "<h1>No Se Encontraron Resultados..</h1>";
		}

	}


}