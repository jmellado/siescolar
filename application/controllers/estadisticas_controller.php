<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas_controller extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('estadisticas_model');
		$this->load->library('form_validation');
		$this->load->library('Pdf');
	}
	

	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'estadisticas/estadisticas_vista');
	}


	public function CincuentaMejores()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'estadisticas/cincuentamejores_vista');
	}


	public function PromedioCursos()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'estadisticas/promediocursos_vista');
	}


	public function PromedioGrados()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'estadisticas/promediogrados_vista');
	}


	public function EnRiesgo()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'estadisticas/enriesgo_vista');
	}


	public function llenarcombo_anos_lectivosE(){

    	$consulta = $this->estadisticas_model->llenar_anos_lectivosE();
    	echo json_encode($consulta);
    }


    public function mostrarcincuentamejores(){

		$periodo = $this->input->post('periodo'); 
		$jornada = $this->input->post('jornada'); 
		$ano_lectivo = $this->input->post('ano_lectivo'); 
		
		$data = array(

			'cincuentamejores' => $this->estadisticas_model->buscar_cincuentamejores($periodo,$jornada,$ano_lectivo),

		    'totalregistros' => count($this->estadisticas_model->buscar_cincuentamejores($periodo,$jornada,$ano_lectivo))


		);
	    echo json_encode($data);


	}


	public function mostrarpromediocursos(){

		$periodo = $this->input->post('periodo'); 
		$jornada = $this->input->post('jornada'); 
		$ano_lectivo = $this->input->post('ano_lectivo'); 
		
		$data = array(

			'promediocursos' => $this->estadisticas_model->buscar_promediocursos($periodo,$jornada,$ano_lectivo),

		    'totalregistros' => count($this->estadisticas_model->buscar_promediocursos($periodo,$jornada,$ano_lectivo))


		);
	    echo json_encode($data);


	}


	public function mostrarpromediogrados(){

		$periodo = $this->input->post('periodo'); 
		$jornada = $this->input->post('jornada'); 
		$ano_lectivo = $this->input->post('ano_lectivo'); 
		
		$data = array(

			'promediogrados' => $this->estadisticas_model->buscar_promediocursos($periodo,$jornada,$ano_lectivo),

		    'totalregistros' => count($this->estadisticas_model->buscar_promediocursos($periodo,$jornada,$ano_lectivo))


		);
	    echo json_encode($data);


	}


	public function mostrarenriesgo(){

		$periodo = $this->input->post('periodo'); 
		$jornada = $this->input->post('jornada'); 
		$ano_lectivo = $this->input->post('ano_lectivo'); 
		
		$data = array(

			'enriesgo' => $this->estadisticas_model->buscar_enriesgo($periodo,$jornada,$ano_lectivo),

		    'totalregistros' => count($this->estadisticas_model->buscar_enriesgo($periodo,$jornada,$ano_lectivo))


		);
	    echo json_encode($data);


	}


	//======== Funciones para generar los listados de las estadisticas ============


	public function generar_CincuentaMejores(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$periodo = $this->input->get('periodo');
		$jornada = $this->input->get('jornada');
		$ano_lectivo = $this->input->get('ano_lectivo');

		$anio = $this->estadisticas_model->obtener_informacion_anolectivo($ano_lectivo);
		$nombre_ano_lectivo = $anio[0]['nombre_ano_lectivo'];

		$col = $this->estadisticas_model->obtener_informacion_colegio();
		$nombre_institucion = $col[0]['nombre_institucion'];
		$niveles_educacion = $col[0]['niveles_educacion'];
		$resolucion = $col[0]['resolucion'];
		$dane = $col[0]['dane'];
		$nit = $col[0]['nit'];
		$escudo = $col[0]['escudo'];

		$estudiantes = $this->estadisticas_model->buscar_cincuentamejores($periodo,$jornada,$ano_lectivo);

		if(count($estudiantes) > 0){

			// create new PDF document
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Listado 50 Mejores: Periodo-'.$periodo.' Jornada-'.$jornada.' '.$nombre_ano_lectivo);
	        $pdf->SetSubject('Listados SIESCOLAR');
	        $pdf->SetKeywords('SIESCOLAR, PDF, example, test, guide');

	        // remove default header/footer
	        $pdf->SetPrintHeader(false);
	 		$pdf->SetPrintFooter(false);

			// establecer la fuente monoespaciada predeterminada
	        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	 
			// establecer margenes
	        $pdf->SetMargins(PDF_MARGIN_LEFT, 70, PDF_MARGIN_RIGHT);
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

	        //=========================Page header==============================================

	        // Logo
	        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
	        $image_file = 'uploads/imagenes/colegio/'.$escudo;
	        $pdf->Image($image_file, 10, 10, 25, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
	        $pdf->SetFont('helvetica', 'B', 12);

	        // Title
	        //$pdf->Cell(0, 0, '<<TCPDF Example 003>>', 1, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->SetFont('helvetica', '', 12);
	        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->ln(3);
	        //====================================================================================

	        
	        $pdf->SetFont('helvetica', 'B', 12);
	        $pdf->Write(0, 'LISTADO 50 MEJORES', '', 0, 'C', true, 0, false, false, 0);
	        $pdf->SetFont('helvetica', '', 10, '', true);
	 
			//fijar efecto de sombra en el texto
	        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


	        // Establecemos el contenido para imprimir
	        //**********************************************************************************************************
			//preparamos y maquetamos el contenido a crear
			//**********************************************************************************************************

			$tbl = '';
			$tbl .= '<p align="center"><b>AÑO LECTIVO '.$nombre_ano_lectivo.'</b></p>';
	        $tbl .= '<p><b>PERIODO:</b> &nbsp;&nbsp;'.$periodo.'<br /><b>JORNADA:</b> &nbsp;'.$jornada.'</p>';
			$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
	        $tbl .= '<tr>
	        			<td align="center" width="22" height="30"><b>#</b></td>
	        			<td align="center" width="160" height="30"><b>IDENTIFICACIÓN</b></td>
	        			<td align="center" width="200" height="30"><b>APELLIDOS Y NOMBRES</b></td>
	        			<td align="center" width="150" height="30"><b>CURSO</b></td>
	        			<td align="center" width="100" height="30"><b>PROMEDIO</b></td>
	        		</tr>';


	        for ($j=0; $j < count($estudiantes); $j++) {

				$cont = $j + 1;

				$tbl .= '<tr nobr="true">

							<td align="center" width="22">'.$cont.'</td>
							<td align="center" width="160">'.$estudiantes[$j]['identificacion'].'</td>
		        			<td align="center" width="200">'.$estudiantes[$j]['apellido1'].' '.$estudiantes[$j]['apellido2'].' '.$estudiantes[$j]['nombres'].'</td>
		        			<td align="center" width="150">'.$estudiantes[$j]['nombre_grado'].' '.$estudiantes[$j]['nombre_grupo'].' '.$estudiantes[$j]['jornada'].'</td>
		        			<td align="center" width="100">'.$estudiantes[$j]['promedio'].'</td>

						</tr>';
			}

			$tbl .= '</table>';


			// Imprimimos el texto con writeHTMLCell()
		    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

		    //SI HAY UN SALTO DE PAGINA, CREAMOS EL ENCABEZADO Y LAS 2 PRIMERAS FILAS
	        if ($pdf->getAutoPageBreak()) {
	        	
	        	$pdf->SetY(-280);

	        	//===========================Page header - Salto De Pagina===========================
		        // Logo
		        $image_file = 'uploads/imagenes/colegio/'.$escudo;
		        $pdf->Image($image_file, 10, 10, 25, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
		        $pdf->SetFont('helvetica', 'B', 12);

		        // Title
		        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->SetFont('helvetica', '', 12);
		        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->ln(3);

		        $pdf->SetFont('helvetica', 'B', 12);
	        	$pdf->Write(0, 'LISTADO 50 MEJORES', '', 0, 'C', true, 0, false, false, 0);
	        	$pdf->SetFont('helvetica', '', 10, '', true);
		        //=======================================================================================

		        $tbl = '';
		        $tbl .= '<p align="center"><b>AÑO LECTIVO '.$nombre_ano_lectivo.'</b></p>';
	        	$tbl .= '<p><b>PERIODO:</b> &nbsp;&nbsp;'.$periodo.'<br /><b>JORNADA:</b> &nbsp;'.$jornada.'</p>';
				$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
				$tbl .= '<tr>
		        			<td align="center" width="22" height="30"><b>#</b></td>
		        			<td align="center" width="160" height="30"><b>IDENTIFICACIÓN</b></td>
		        			<td align="center" width="200" height="30"><b>APELLIDOS Y NOMBRES</b></td>
		        			<td align="center" width="150" height="30"><b>CURSO</b></td>
		        			<td align="center" width="100" height="30"><b>PROMEDIO</b></td>
		        		</tr>';
		        $tbl .= '</table>';

		        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

	        }


		    // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Listado 50 Mejores Periodo-".$periodo." Jornada-".$jornada." ".$nombre_ano_lectivo.".pdf");
	        $pdf->Output($nombre_archivo, 'I');

		}
		else{

			echo "<h1>No Hay Estudiantes Matriculados..</h1>";
		}

	}


	public function generar_PromedioCursos(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$periodo = $this->input->get('periodo');
		$jornada = $this->input->get('jornada');
		$ano_lectivo = $this->input->get('ano_lectivo');

		$anio = $this->estadisticas_model->obtener_informacion_anolectivo($ano_lectivo);
		$nombre_ano_lectivo = $anio[0]['nombre_ano_lectivo'];

		$col = $this->estadisticas_model->obtener_informacion_colegio();
		$nombre_institucion = $col[0]['nombre_institucion'];
		$niveles_educacion = $col[0]['niveles_educacion'];
		$resolucion = $col[0]['resolucion'];
		$dane = $col[0]['dane'];
		$nit = $col[0]['nit'];
		$escudo = $col[0]['escudo'];

		$cursos = $this->estadisticas_model->buscar_promediocursos($periodo,$jornada,$ano_lectivo);

		if(count($cursos) > 0){

			// create new PDF document
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Listado Promedio Por Cursos: Periodo-'.$periodo.' Jornada-'.$jornada.' '.$nombre_ano_lectivo);
	        $pdf->SetSubject('Listados SIESCOLAR');
	        $pdf->SetKeywords('SIESCOLAR, PDF, example, test, guide');

	        // remove default header/footer
	        $pdf->SetPrintHeader(false);
	 		$pdf->SetPrintFooter(false);

			// establecer la fuente monoespaciada predeterminada
	        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	 
			// establecer margenes
	        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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

	        //=========================Page header==============================================

	        // Logo
	        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
	        $image_file = 'uploads/imagenes/colegio/'.$escudo;
	        $pdf->Image($image_file, 10, 10, 25, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
	        $pdf->SetFont('helvetica', 'B', 12);

	        // Title
	        //$pdf->Cell(0, 0, '<<TCPDF Example 003>>', 1, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->SetFont('helvetica', '', 12);
	        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->ln(3);
	        //====================================================================================

	        
	        $pdf->SetFont('helvetica', 'B', 12);
	        $pdf->Write(0, 'LISTADO PROMEDIO POR CURSOS', '', 0, 'C', true, 0, false, false, 0);
	        $pdf->SetFont('helvetica', '', 10, '', true);
	 
			//fijar efecto de sombra en el texto
	        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


	        // Establecemos el contenido para imprimir
	        //**********************************************************************************************************
			//preparamos y maquetamos el contenido a crear
			//**********************************************************************************************************

			$tbl = '';
			$tbl .= '<p align="center"><b>AÑO LECTIVO '.$nombre_ano_lectivo.'</b></p>';
	        $tbl .= '<p><b>PERIODO:</b> &nbsp;&nbsp;'.$periodo.'<br /><b>JORNADA:</b> &nbsp;'.$jornada.'</p>';
			$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
	        $tbl .= '<tr>
	        			<td align="center" width="22" height="30"><b>#</b></td>
	        			<td align="center" width="510" height="30"><b>CURSO</b></td>
	        			<td align="center" width="100" height="30"><b>PROMEDIO</b></td>
	        		</tr>';


	        for ($j=0; $j < count($cursos); $j++) {

				$cont = $j + 1;

				$tbl .= '<tr nobr="true">

							<td align="center" width="22">'.$cont.'</td>
		        			<td align="center" width="510">'.$cursos[$j]['nombre_grado'].' '.$cursos[$j]['nombre_grupo'].' '.$cursos[$j]['jornada'].'</td>
		        			<td align="center" width="100">'.$cursos[$j]['promedio'].'</td>

						</tr>';
			}

			$tbl .= '</table>';


			// Imprimimos el texto con writeHTMLCell()
		    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

		    //SI HAY UN SALTO DE PAGINA, CREAMOS EL ENCABEZADO Y LAS 2 PRIMERAS FILAS
	        if ($pdf->getAutoPageBreak()) {
	        	
	        	$pdf->SetY(-280);

	        	//===========================Page header - Salto De Pagina===========================
		        // Logo
		        $image_file = 'uploads/imagenes/colegio/'.$escudo;
		        $pdf->Image($image_file, 10, 10, 25, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
		        $pdf->SetFont('helvetica', 'B', 12);

		        // Title
		        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->SetFont('helvetica', '', 12);
		        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->ln(3);

		        $pdf->SetFont('helvetica', 'B', 12);
	        	$pdf->Write(0, 'LISTADO PROMEDIO POR CURSOS', '', 0, 'C', true, 0, false, false, 0);
	        	$pdf->SetFont('helvetica', '', 10, '', true);
		        //=======================================================================================

		        $tbl = '';
		        $tbl .= '<p align="center"><b>AÑO LECTIVO '.$nombre_ano_lectivo.'</b></p>';
	        	$tbl .= '<p><b>PERIODO:</b> &nbsp;&nbsp;'.$periodo.'<br /><b>JORNADA:</b> &nbsp;'.$jornada.'</p>';
				$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
				$tbl .= '<tr>
		        			<td align="center" width="22" height="30"><b>#</b></td>
		        			<td align="center" width="510" height="30"><b>CURSO</b></td>
		        			<td align="center" width="100" height="30"><b>PROMEDIO</b></td>
		        		</tr>';
		        $tbl .= '</table>';

		        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

	        }


		    // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Listado Promedio Por Cursos Periodo-".$periodo." Jornada-".$jornada." ".$nombre_ano_lectivo.".pdf");
	        $pdf->Output($nombre_archivo, 'I');

		}
		else{

			echo "<h1>No Hay Cursos Registrados..</h1>";
		}

	}


	public function generar_PromedioGrados(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$periodo = $this->input->get('periodo');
		$jornada = $this->input->get('jornada');
		$ano_lectivo = $this->input->get('ano_lectivo');

		$anio = $this->estadisticas_model->obtener_informacion_anolectivo($ano_lectivo);
		$nombre_ano_lectivo = $anio[0]['nombre_ano_lectivo'];

		$col = $this->estadisticas_model->obtener_informacion_colegio();
		$nombre_institucion = $col[0]['nombre_institucion'];
		$niveles_educacion = $col[0]['niveles_educacion'];
		$resolucion = $col[0]['resolucion'];
		$dane = $col[0]['dane'];
		$nit = $col[0]['nit'];
		$escudo = $col[0]['escudo'];

		$grados = $this->estadisticas_model->buscar_promediogrados($periodo,$jornada,$ano_lectivo);

		if(count($grados) > 0){

			// create new PDF document
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Listado Promedio Por Grados: Periodo-'.$periodo.' Jornada-'.$jornada.' '.$nombre_ano_lectivo);
	        $pdf->SetSubject('Listados SIESCOLAR');
	        $pdf->SetKeywords('SIESCOLAR, PDF, example, test, guide');

	        // remove default header/footer
	        $pdf->SetPrintHeader(false);
	 		$pdf->SetPrintFooter(false);

			// establecer la fuente monoespaciada predeterminada
	        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	 
			// establecer margenes
	        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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

	        //=========================Page header==============================================

	        // Logo
	        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
	        $image_file = 'uploads/imagenes/colegio/'.$escudo;
	        $pdf->Image($image_file, 10, 10, 25, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
	        $pdf->SetFont('helvetica', 'B', 12);

	        // Title
	        //$pdf->Cell(0, 0, '<<TCPDF Example 003>>', 1, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->SetFont('helvetica', '', 12);
	        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->ln(3);
	        //====================================================================================

	        
	        $pdf->SetFont('helvetica', 'B', 12);
	        $pdf->Write(0, 'LISTADO PROMEDIO POR GRADOS', '', 0, 'C', true, 0, false, false, 0);
	        $pdf->SetFont('helvetica', '', 10, '', true);
	 
			//fijar efecto de sombra en el texto
	        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


	        // Establecemos el contenido para imprimir
	        //**********************************************************************************************************
			//preparamos y maquetamos el contenido a crear
			//**********************************************************************************************************

			$tbl = '';
			$tbl .= '<p align="center"><b>AÑO LECTIVO '.$nombre_ano_lectivo.'</b></p>';
	        $tbl .= '<p><b>PERIODO:</b> &nbsp;&nbsp;'.$periodo.'<br /><b>JORNADA:</b> &nbsp;'.$jornada.'</p>';
			$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
	        $tbl .= '<tr>
	        			<td align="center" width="22" height="30"><b>#</b></td>
	        			<td align="center" width="510" height="30"><b>GRADO</b></td>
	        			<td align="center" width="100" height="30"><b>PROMEDIO</b></td>
	        		</tr>';


	        for ($j=0; $j < count($grados); $j++) {

				$cont = $j + 1;

				$tbl .= '<tr nobr="true">

							<td align="center" width="22">'.$cont.'</td>
		        			<td align="center" width="510">'.$grados[$j]['nombre_grado'].'</td>
		        			<td align="center" width="100">'.$grados[$j]['promedio'].'</td>

						</tr>';
			}

			$tbl .= '</table>';


			// Imprimimos el texto con writeHTMLCell()
		    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

		    //SI HAY UN SALTO DE PAGINA, CREAMOS EL ENCABEZADO Y LAS 2 PRIMERAS FILAS
	        if ($pdf->getAutoPageBreak()) {
	        	
	        	$pdf->SetY(-280);

	        	//===========================Page header - Salto De Pagina===========================
		        // Logo
		        $image_file = 'uploads/imagenes/colegio/'.$escudo;
		        $pdf->Image($image_file, 10, 10, 25, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
		        $pdf->SetFont('helvetica', 'B', 12);

		        // Title
		        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->SetFont('helvetica', '', 12);
		        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->ln(3);

		        $pdf->SetFont('helvetica', 'B', 12);
	        	$pdf->Write(0, 'LISTADO PROMEDIO POR GRADOS', '', 0, 'C', true, 0, false, false, 0);
	        	$pdf->SetFont('helvetica', '', 10, '', true);
		        //=======================================================================================

		        $tbl = '';
		        $tbl .= '<p align="center"><b>AÑO LECTIVO '.$nombre_ano_lectivo.'</b></p>';
	        	$tbl .= '<p><b>PERIODO:</b> &nbsp;&nbsp;'.$periodo.'<br /><b>JORNADA:</b> &nbsp;'.$jornada.'</p>';
				$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
				$tbl .= '<tr>
		        			<td align="center" width="22" height="30"><b>#</b></td>
		        			<td align="center" width="510" height="30"><b>GRADO</b></td>
		        			<td align="center" width="100" height="30"><b>PROMEDIO</b></td>
		        		</tr>';
		        $tbl .= '</table>';

		        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

	        }


		    // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Listado Promedio Por Grados Periodo-".$periodo." Jornada-".$jornada." ".$nombre_ano_lectivo.".pdf");
	        $pdf->Output($nombre_archivo, 'I');

		}
		else{

			echo "<h1>No Hay Grados Registrados..</h1>";
		}

	}


	public function generar_EnRiesgo(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$periodo = $this->input->get('periodo');
		$jornada = $this->input->get('jornada');
		$ano_lectivo = $this->input->get('ano_lectivo');

		$anio = $this->estadisticas_model->obtener_informacion_anolectivo($ano_lectivo);
		$nombre_ano_lectivo = $anio[0]['nombre_ano_lectivo'];

		$col = $this->estadisticas_model->obtener_informacion_colegio();
		$nombre_institucion = $col[0]['nombre_institucion'];
		$niveles_educacion = $col[0]['niveles_educacion'];
		$resolucion = $col[0]['resolucion'];
		$dane = $col[0]['dane'];
		$nit = $col[0]['nit'];
		$escudo = $col[0]['escudo'];

		$estudiantes = $this->estadisticas_model->buscar_enriesgo($periodo,$jornada,$ano_lectivo);

		if(count($estudiantes) > 0){

			// create new PDF document
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Listado Estudiantes En Riesgo: Periodo-'.$periodo.' Jornada-'.$jornada.' '.$nombre_ano_lectivo);
	        $pdf->SetSubject('Listados SIESCOLAR');
	        $pdf->SetKeywords('SIESCOLAR, PDF, example, test, guide');

	        // remove default header/footer
	        $pdf->SetPrintHeader(false);
	 		$pdf->SetPrintFooter(false);

			// establecer la fuente monoespaciada predeterminada
	        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	 
			// establecer margenes
	        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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

	        //=========================Page header==============================================

	        // Logo
	        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
	        $image_file = 'uploads/imagenes/colegio/'.$escudo;
	        $pdf->Image($image_file, 10, 10, 25, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
	        $pdf->SetFont('helvetica', 'B', 12);

	        // Title
	        //$pdf->Cell(0, 0, '<<TCPDF Example 003>>', 1, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->SetFont('helvetica', '', 12);
	        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->ln(3);
	        //====================================================================================

	        
	        $pdf->SetFont('helvetica', 'B', 12);
	        $pdf->Write(0, 'LISTADO DE ESTUDIANTES EN RIESGO DE PERDER EL AÑO', '', 0, 'C', true, 0, false, false, 0);
	        $pdf->SetFont('helvetica', '', 10, '', true);
	 
			//fijar efecto de sombra en el texto
	        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


	        // Establecemos el contenido para imprimir
	        //**********************************************************************************************************
			//preparamos y maquetamos el contenido a crear
			//**********************************************************************************************************

			$tbl = '';
			$tbl .= '<p align="center"><b>AÑO LECTIVO '.$nombre_ano_lectivo.'</b></p>';
	        $tbl .= '<p><b>PERIODO:</b> &nbsp;&nbsp;'.$periodo.'<br /><b>JORNADA:</b> &nbsp;'.$jornada.'</p>';
			$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
	        $tbl .= '<tr>
	        			<td align="center" width="22" height="30"><b>#</b></td>
	        			<td align="center" width="160" height="30"><b>IDENTIFICACIÓN</b></td>
	        			<td align="center" width="200" height="30"><b>APELLIDOS Y NOMBRES</b></td>
	        			<td align="center" width="150" height="30"><b>CURSO</b></td>
	        			<td align="center" width="100" height="30"><b>PROMEDIO</b></td>
	        		</tr>';


	        for ($j=0; $j < count($estudiantes); $j++) {

				$cont = $j + 1;

				$tbl .= '<tr nobr="true">

							<td align="center" width="22">'.$cont.'</td>
							<td align="center" width="160">'.$estudiantes[$j]['identificacion'].'</td>
		        			<td align="center" width="200">'.$estudiantes[$j]['apellido1'].' '.$estudiantes[$j]['apellido2'].' '.$estudiantes[$j]['nombres'].'</td>
		        			<td align="center" width="150">'.$estudiantes[$j]['nombre_grado'].' '.$estudiantes[$j]['nombre_grupo'].' '.$estudiantes[$j]['jornada'].'</td>
		        			<td align="center" width="100">'.$estudiantes[$j]['promedio'].'</td>

						</tr>';
			}

			$tbl .= '</table>';


			// Imprimimos el texto con writeHTMLCell()
		    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

		    //SI HAY UN SALTO DE PAGINA, CREAMOS EL ENCABEZADO Y LAS 2 PRIMERAS FILAS
	        if ($pdf->getAutoPageBreak()) {
	        	
	        	$pdf->SetY(-280);

	        	//===========================Page header - Salto De Pagina===========================
		        // Logo
		        $image_file = 'uploads/imagenes/colegio/'.$escudo;
		        $pdf->Image($image_file, 10, 10, 25, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
		        $pdf->SetFont('helvetica', 'B', 12);

		        // Title
		        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->SetFont('helvetica', '', 12);
		        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->ln(3);

		        $pdf->SetFont('helvetica', 'B', 12);
	        	$pdf->Write(0, 'LISTADO DE ESTUDIANTES EN RIESGO DE PERDER EL AÑO', '', 0, 'C', true, 0, false, false, 0);
	        	$pdf->SetFont('helvetica', '', 10, '', true);
		        //=======================================================================================

		        $tbl = '';
		        $tbl .= '<p align="center"><b>AÑO LECTIVO '.$nombre_ano_lectivo.'</b></p>';
	        	$tbl .= '<p><b>PERIODO:</b> &nbsp;&nbsp;'.$periodo.'<br /><b>JORNADA:</b> &nbsp;'.$jornada.'</p>';
				$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
				$tbl .= '<tr>
		        			<td align="center" width="22" height="30"><b>#</b></td>
		        			<td align="center" width="160" height="30"><b>IDENTIFICACIÓN</b></td>
		        			<td align="center" width="200" height="30"><b>APELLIDOS Y NOMBRES</b></td>
		        			<td align="center" width="150" height="30"><b>CURSO</b></td>
		        			<td align="center" width="100" height="30"><b>PROMEDIO</b></td>
		        		</tr>';
		        $tbl .= '</table>';

		        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

	        }


		    // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Listado Estudiantes En Riesgo Periodo-".$periodo." Jornada-".$jornada." ".$nombre_ano_lectivo.".pdf");
	        $pdf->Output($nombre_archivo, 'I');

		}
		else{

			echo "<h1>No Hay Estudiantes..</h1>";
		}

	}
}