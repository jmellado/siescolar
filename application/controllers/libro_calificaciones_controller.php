<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Libro_calificaciones_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('libro_calificaciones_model');
		$this->load->library('form_validation');
		$this->load->library('Pdf');
	}


	public function libro_calificaciones()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'libro_calificaciones/libro_calificaciones_vista');
	}


	public function llenarcombo_anos_lectivos(){

    	$consulta = $this->libro_calificaciones_model->llenar_anos_lectivos();
    	echo json_encode($consulta);
    }


	public function llenarcombo_cursos(){

		$ano_lectivo = $this->input->post('ano_lectivo');
    	$jornada = $this->input->post('jornada');

    	$consulta = $this->libro_calificaciones_model->llenar_cursos($ano_lectivo,$jornada);
    	echo json_encode($consulta);
    }


    public function generar_libro(){

    	if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

    	$ano_lectivo = $this->input->get('ano_lectivo');
    	$jornada = $this->input->get('jornada');
    	$id_curso = $this->input->get('id_curso');

    	$curs = $this->libro_calificaciones_model->obtener_informacion_curso($id_curso);
		$nombre_curso = $curs[0]['nombre_grado'].' '.$curs[0]['nombre_grupo'];
		$director_curso = $curs[0]['nombres'].' '.$curs[0]['apellido1'].' '.$curs[0]['apellido2'];
		$id_grado = $curs[0]['id_grado'];
		$nombre_ano_lectivo = $curs[0]['nombre_ano_lectivo'];

		$col = $this->libro_calificaciones_model->obtener_informacion_colegio();
		$nombre_institucion = $col[0]['nombre_institucion'];
		$niveles_educacion = $col[0]['niveles_educacion'];
		$resolucion = $col[0]['resolucion'];
		$dane = $col[0]['dane'];
		$nit = $col[0]['nit'];
		$escudo = $col[0]['escudo'];
		$responsable = $col[0]['responsable'];
		$cargo_responsable = $col[0]['cargo_responsable'];

		$estudiantes = $this->libro_calificaciones_model->buscar_estudiantes_matriculados_curso($ano_lectivo,$id_curso);
		$total_estudiantes = count($estudiantes);

		if($this->libro_calificaciones_model->validar_existencia_estudiantes($id_curso)){

			// create new PDF document
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Libro De Calificaciones Curso: '.$nombre_curso);
	        $pdf->SetSubject('Libro De Calificaciones SIESCOLAR');
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
	 
			// Establecer el tipo de letra
			//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
			// Helvetica para reducir el tamaño del archivo.
	        //$pdf->SetFont('freemono', 'B', 14, '', true);


	        for ($i=0; $i < $total_estudiantes; $i++) {

	        	$cont = $i + 1;

	        	// Añadir una página
				$pdf->AddPage();


				//============ Page header ============

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
		        $pdf->ln(7);
		        //======================================


		        $pdf->SetFont('helvetica', 'B', 12);
		        $pdf->Write(0, 'REGISTRO GENERAL DE CALIFICACIONES', '', 0, 'C', true, 0, false, false, 0);

		        $pdf->SetFont('helvetica', '', 10, '', true);
		 
				//fijar efecto de sombra en el texto
		        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
		 
				// Establecemos el contenido para imprimir
		        //**************************************************************************************************
				//preparamos y maquetamos el contenido a crear
				//**************************************************************************************************


				$tbl = '';
				$tbl .= '<table cellspacing="0" cellpadding="3" border="1">';
				$tbl .= '<tr>
		        			<td width="160"><b>ESTUDIANTE:</b></td>
		        			<td width="230">'.$estudiantes[$i]['apellido1'].' '.$estudiantes[$i]['apellido2'].' '.$estudiantes[$i]['nombres'].'</td>
		        			<td width="120"><b>IDENTIFICACIÓN:</b></td>
		        			<td width="120">'.strtoupper($estudiantes[$i]['tipo_id']).' - '.$estudiantes[$i]['identificacion'].'</td>
		        		</tr>';

		        $tbl .= '<tr>
		        			<td width="110"><b>CURSO:</b></td>
		        			<td width="100">'.$nombre_curso.'</td>
		        			<td width="110"><b>JORNADA:</b></td>
		        			<td width="100">'.$jornada.'</td>
		        			<td width="110"><b>AÑO:</b></td>
		        			<td width="100">'.$nombre_ano_lectivo.'</td>
		        		</tr>';

		       	$tbl .= '<tr>
		        			<td width="160" height="30"><b>ASIGNATURA</b></td>
		        			<td align="center" width="40" height="30"><b>1°P</b></td>
		        			<td align="center" width="40" height="30"><b>2°P</b></td>
		        			<td align="center" width="40" height="30"><b>3°P</b></td>
		        			<td align="center" width="40" height="30"><b>4°P</b></td>
		        			<td align="center" width="100" height="30"><b>DEFINITIVA</b></td>
		        			<td align="center" width="100" height="30"><b>DESEMPEÑO</b></td>
		        			<td align="center" width="110" height="30"><b>INASISTENCIAS</b></td>
		        		</tr>';

		        $id_estudiante = $estudiantes[$i]['id_estudiante'];
		        $notas = $this->libro_calificaciones_model->obtener_NotasPorEstudiante($ano_lectivo,$id_estudiante,$id_grado);
		        $desempeno = $this->libro_calificaciones_model->obtener_Desempenos($ano_lectivo);

		        for ($j=0; $j < count($notas); $j++) { 
		        	
		        	$id_asignatura = $notas[$j]['id_asignatura'];
		        	$inasistencias = $this->libro_calificaciones_model->obtener_inasistencias($ano_lectivo,$id_asignatura,$id_estudiante);

		        	$tbl .= '<tr nobr="true">
		        				<td width="160">'.$notas[$j]['nombre_asignatura'].'</td>
			        			<td align="center" width="40">'.$notas[$j]['p1'].'</td>
			        			<td align="center" width="40">'.$notas[$j]['p2'].'</td>
			        			<td align="center" width="40">'.$notas[$j]['p3'].'</td>
			        			<td align="center" width="40">'.$notas[$j]['p4'].'</td>
			        			<td align="center" width="100">'.$notas[$j]['definitiva'].'</td>
			        			<td align="center" width="100">'.$notas[$j]['nombre_desempeno'].'</td>
			        			<td align="center" width="110">'.$inasistencias.'</td>
		        			</tr>';
		        }

		        $tbl .= '<tr>
		        			<td width="200" height="30"><b>SITUACIÓN ACADÉMICA FINAL</b></td>
		        			<td width="115" height="30">'.$estudiantes[$i]['situacion_academica'].'</td>
		        			<td width="200" height="30"><b>ESTADO FINAL DE MATRICULA</b></td>
		        			<td width="115" height="30">'.$estudiantes[$i]['estado_matricula'].'</td>
		        		</tr>';

		        $tbl .= '</table>';

		        //tabla de desempeños
		        $tbl .= '<table cellspacing="0" cellpadding="3" border="1">';

		        for ($d=0; $d < count($desempeno); $d++) { 
		        	
		        	$tbl .= '<tr>
			        			<td width="80"><b>'.$desempeno[$d]['nombre_desempeno'].'</b></td>
			        			<td width="40">'.$desempeno[$d]['rango_inicial'].'</td>
			        			<td width="40">'.$desempeno[$d]['rango_final'].'</td>
			        		</tr>';
		        }

		        $tbl .= '</table>';

		        $tbl .= '<p>&nbsp;<br /></p>';
	        	$tbl .= '<p><b>'.$responsable.'<br />'.$cargo_responsable.'</b></p>';
		        


				// Imprimimos el texto con writeHTMLCell()
				$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


				//SI HAY UN SALTO DE PAGINA, CREAMOS EL ENCABEZADO Y LAS 2 PRIMERAS FILAS
		        if ($pdf->getAutoPageBreak()) {
		        	
		        	$pdf->SetY(-280);

		        	//=========== Page header - Salto De Pagina ============
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
			        $pdf->ln(7);

			        $pdf->SetFont('helvetica', 'B', 12);
		        	$pdf->Write(0, 'REGISTRO GENERAL DE CALIFICACIONES', '', 0, 'C', true, 0, false, false, 0);
		        	$pdf->SetFont('helvetica', '', 10, '', true);
			        //=======================================================

			        $tbl = '';
					$tbl .= '<table cellspacing="0" cellpadding="3" border="1">';
					$tbl .= '<tr>
			        			<td width="160"><b>ESTUDIANTE:</b></td>
			        			<td width="230">'.$estudiantes[$i]['apellido1'].' '.$estudiantes[$i]['apellido2'].' '.$estudiantes[$i]['nombres'].'</td>
			        			<td width="120"><b>IDENTIFICACIÓN:</b></td>
			        			<td width="120">'.strtoupper($estudiantes[$i]['tipo_id']).' - '.$estudiantes[$i]['identificacion'].'</td>
			        		</tr>';

			        $tbl .= '<tr>
			        			<td width="110"><b>CURSO:</b></td>
			        			<td width="100">'.$nombre_curso.'</td>
			        			<td width="110"><b>JORNADA:</b></td>
			        			<td width="100">'.$jornada.'</td>
			        			<td width="110"><b>AÑO:</b></td>
			        			<td width="100">'.$nombre_ano_lectivo.'</td>
			        		</tr>';

			       	$tbl .= '<tr>
			        			<td width="160" height="30"><b>ASIGNATURA</b></td>
			        			<td align="center" width="40" height="30"><b>1°P</b></td>
			        			<td align="center" width="40" height="30"><b>2°P</b></td>
			        			<td align="center" width="40" height="30"><b>3°P</b></td>
			        			<td align="center" width="40" height="30"><b>4°P</b></td>
			        			<td align="center" width="100" height="30"><b>DEFINITIVA</b></td>
			        			<td align="center" width="100" height="30"><b>DESEMPEÑO</b></td>
			        			<td align="center" width="110" height="30"><b>INASISTENCIAS</b></td>
			        		</tr>';
			        $tbl .= '</table>';

			        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

		        }



	        }



	        // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("LibroDeCalificaciones ".$nombre_curso."_".substr($jornada, 0,1)."_".$nombre_ano_lectivo.".pdf");
	        $pdf->Output($nombre_archivo, 'I');


		}
		else{

			echo "<h1>No Existen Estudiantes Matriculados En Este Curso.</h1>";
		}

    }


}