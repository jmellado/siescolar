<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imprimir_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('imprimir_model');
		$this->load->library('Pdf');
	}


	//vista imprimir boletines
	public function imprimir_boletin()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'imprimir/imprimir_boletin_vista');
	}


	//generar los boletines de los estudiantes de un determinado curso en formato PDF
	public function generar_boletin(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$periodo = $this->input->get('periodo');
		$jornada = $this->input->get('jornada');
		$id_curso = $this->input->get('id_curso');

		$curs = $this->imprimir_model->obtener_informacion_curso($id_curso);
		$nombre_curso = $curs[0]['nombre_grado'].'-'.$curs[0]['nombre_grupo'];
		$director_curso = $curs[0]['nombres'].' '.$curs[0]['apellido1'].' '.$curs[0]['apellido2'];

		$estudiantes = $this->imprimir_model->EstudiantesPorCursos($id_curso,$periodo);
		$total_estudiantes = count($this->imprimir_model->EstudiantesPorCursos($id_curso,$periodo));

		$col = $this->imprimir_model->obtener_informacion_colegio();
		$nombre_institucion = $col[0]['nombre_institucion'];
		$niveles_educacion = $col[0]['niveles_educacion'];
		$resolucion = $col[0]['resolucion'];
		$dane = $col[0]['dane'];
		$nit = $col[0]['nit'];
		$escudo = $col[0]['escudo'];

		if($this->imprimir_model->validar_existencia_estudiantes($id_curso)){

			if($this->imprimir_model->Verificar_NotasEstudiantesPorCurso($id_curso,$periodo)){

				if($this->imprimir_model->Verificar_LogrosEstudiantesPorCurso($id_curso,$periodo)){

					// create new PDF document
					$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
			        $pdf->SetCreator(PDF_CREATOR);
			        $pdf->SetAuthor('Siescolar');
			        $pdf->SetTitle('Boletines Curso: '.$nombre_curso);
			        $pdf->SetSubject('Boletines SIESCOLAR');
			        $pdf->SetKeywords('SIESCOLAR, PDF, example, test, guide');

			        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
			       	//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 128), array(0, 64, 128));
			        //$pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
			 
					// datos por defecto de cabecera
			        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			        //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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

				        //==============================================Page header========================================================

				        // Logo
				        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
				        $image_file = 'uploads/imagenes/colegio/'.$escudo;
				        $pdf->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
				        $pdf->SetFont('helvetica', 'B', 12);

				        // Title
				        //$pdf->Cell(0, 0, '<<TCPDF Example 003>>', 1, 1, 'C', 0, '', 0, false, 'T', 'M');
				        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
				        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
				        $pdf->SetFont('helvetica', '', 12);
				        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
				        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
				        $pdf->ln(3);
				        //===================================================================================================================

				        
				        $pdf->SetFont('helvetica', 'B', 12);
				        $pdf->Write(0, '                   INFORME PERIODICO DE EVALUACIONES', '', 0, 'C', true, 0, false, false, 0);

				        $pdf->SetFont('helvetica', '', 10, '', true);
				 
						//fijar efecto de sombra en el texto
				        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
				 
						// Establecemos el contenido para imprimir
				        //**********************************************************************************************************
						//preparamos y maquetamos el contenido a crear
						//**********************************************************************************************************

						$tbl = '';
				        $tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
				        $tbl .= '<tr>
				        			<td colspan="3">CODIGO: '.$estudiantes[$i]['identificacion'].'							      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOMBRE: '.$estudiantes[$i]['nombres'].' '.$estudiantes[$i]['apellido1'].' '.$estudiantes[$i]['apellido2'].'<br />CURSO: '.$nombre_curso.'   &nbsp;&nbsp;&nbsp;PERIODO: '.$periodo.'&nbsp;&nbsp;AÑO: '.$estudiantes[$i]['nombre_ano_lectivo'].'&nbsp;&nbsp;JORNADA: '.$jornada.'&nbsp;&nbsp;PROMEDIO: '.substr($estudiantes[$i]['promedio'], 0, 3).'&nbsp;&nbsp;PUESTO: '.$cont.' de '.$total_estudiantes.' 
				        			</td>
				        		</tr>';

				        $tbl .= '<tr>
				        			<td rowspan="2" width="147">AREAS/ASIGNATURAS</td>
				        			<td rowspan="2" align="center" width="18">IH</td>
				        			<td align="center" width="80">EV. ANT.</td>
				        			<td rowspan="2" align="center" width="34">C</td>
				        			<td rowspan="2" align="center" width="18">F</td>
				        			<td rowspan="2" align="center" width="333">INFORME DESCRIPTIVO - DESEMPEÑOS</td>
				        		</tr>
				        		<tr>
				        			<td align="center" width="20">1P</td>
				        			<td align="center" width="20">2P</td>
				        			<td align="center" width="20">3P</td>
				        			<td align="center" width="20">4P</td>
				        		</tr>';

				        $id_estudiante = $estudiantes[$i]['id_persona'];
				        $p = $periodo;

				        $notas_logros = $this->imprimir_model->Notas_Logros($id_curso,$periodo,$id_estudiante);
						$total_notas = count($this->imprimir_model->Notas_Logros($id_curso,$periodo,$id_estudiante));

						  
				        for ($j=0; $j < $total_notas; $j++) { 

				        	if($p=="Primero"){

				        		$tbl .= '<tr nobr="true">
				        					<td width="147">'.strtoupper($notas_logros[$j]['nombre_asignatura']).'</td>
				        					<td align="center" width="18">'.$notas_logros[$j]['intensidad_horaria'].'</td>
				        					<td align="center" width="20">'.$notas_logros[$j]['p1'].'</td>
				        					<td align="center" width="20"></td>
				        					<td align="center" width="20"></td>
				        					<td align="center" width="20"></td>
				        					<td align="center" width="34">'.$notas_logros[$j]['p1'].'</td>
				        					<td align="center" width="18"></td>
				        					<td align="justify" width="333" style="font-size:10px;"><p align="center">Desempeño Periodo: '.$notas_logros[$j]['nombre_desempeno'].'</p><br /><br />&nbsp;
				        												   '.$notas_logros[$j]['dl1'].'<br />&nbsp;
				        												   '.$notas_logros[$j]['dl2'].'<br />&nbsp;
				        												   '.$notas_logros[$j]['dl3'].'<br />&nbsp;
				        												   '.$notas_logros[$j]['dl4'].'<br />
				        					</td>
				        				</tr>';
									
							}
							if($p=="Segundo"){

								$tbl .= '<tr nobr="true">
											<td width="147">'.strtoupper($notas_logros[$j]['nombre_asignatura']).'</td>
											<td align="center" width="18">'.$notas_logros[$j]['intensidad_horaria'].'</td>
											<td align="center" width="20">'.$notas_logros[$j]['p1'].'</td>
											<td align="center" width="20"></td>
				        					<td align="center" width="20"></td>
				        					<td align="center" width="20"></td>
				        					<td align="center" width="34">'.$notas_logros[$j]['p2'].'</td>
				        					<td align="center" width="18"></td>
											<td align="justify" width="333" style="font-size:10px;"><p align="center">Desempeño Periodo: '.$notas_logros[$j]['nombre_desempeno'].'</p><br /><br />&nbsp;
				        												   '.$notas_logros[$j]['dl1'].'<br />&nbsp;
				        												   '.$notas_logros[$j]['dl2'].'<br />&nbsp;
				        												   '.$notas_logros[$j]['dl3'].'<br />&nbsp;
				        												   '.$notas_logros[$j]['dl4'].'<br />
											</td>
										</tr>';
									
							}
							if($p=="Tercero"){

								$tbl .= '<tr nobr="true">
											<td width="147">'.strtoupper($notas_logros[$j]['nombre_asignatura']).'</td>
											<td align="center" width="18">'.$notas_logros[$j]['intensidad_horaria'].'</td>
											<td align="center" width="20">'.$notas_logros[$j]['p1'].'</td>
											<td align="center" width="20">'.$notas_logros[$j]['p2'].'</td>
				        					<td align="center" width="20"></td>
				        					<td align="center" width="20"></td>
				        					<td align="center" width="34">'.$notas_logros[$j]['p3'].'</td>
				        					<td align="center" width="18"></td>
											<td align="justify" width="333" style="font-size:10px;"><p align="center">Desempeño Periodo: '.$notas_logros[$j]['nombre_desempeno'].'</p><br /><br />&nbsp;
				        												   '.$notas_logros[$j]['dl1'].'<br />&nbsp;
				        												   '.$notas_logros[$j]['dl2'].'<br />&nbsp;
				        												   '.$notas_logros[$j]['dl3'].'<br />&nbsp;
				        												   '.$notas_logros[$j]['dl4'].'<br />
											</td>
										</tr>';
									
							}
							if($p=="Cuarto"){

								$tbl .= '<tr nobr="true">
											<td width="147">'.strtoupper($notas_logros[$j]['nombre_asignatura']).'</td>
											<td align="center" width="18">'.$notas_logros[$j]['intensidad_horaria'].'</td>
											<td align="center" width="20">'.$notas_logros[$j]['p1'].'</td>
											<td align="center" width="20">'.$notas_logros[$j]['p2'].'</td>
				        					<td align="center" width="20">'.$notas_logros[$j]['p3'].'</td>
				        					<td align="center" width="20"></td>
				        					<td align="center" width="34">'.$notas_logros[$j]['p4'].'</td>
				        					<td align="center" width="18"></td>
											<td align="justify" width="333" style="font-size:10px;"><p align="center">Desempeño Periodo: '.$notas_logros[$j]['nombre_desempeno'].'</p><br /><br />&nbsp;
				        												   '.$notas_logros[$j]['dl1'].'<br />&nbsp;
				        												   '.$notas_logros[$j]['dl2'].'<br />&nbsp;
				        												   '.$notas_logros[$j]['dl3'].'<br />&nbsp;
				        												   '.$notas_logros[$j]['dl4'].'<br />
											</td>
										</tr>';
									
							}
				        	
				        }

				        $tbl .= '<tr nobr="true">
				        			 <td width="297">OBSERVACIONES</td>
				        			 <td width="333">  <br /><br />&nbsp;________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___________________<br />&nbsp;'.$director_curso.'</td>
				        		 </tr>';

					    $tbl .= '</table>';

					    

					    // Imprimimos el texto con writeHTMLCell()
					    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

					    //Page footer======================================================================================================
				        // Position at 15 mm from bottom
			        	//$pdf->SetY(-40);
				        // Set font
				        //$pdf->SetFont('helvetica', 'I', 8);
				        // Page number
				        //$pdf->Cell(0, 0, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
				        //===================================================================================================================

					    //SI HAY UN SALTO DE PAGINA, CREAMOS EL ENCABEZADO Y LAS 2 PRIMERAS FILAS
				        if ($pdf->getAutoPageBreak()) {
				        	
				        	$pdf->SetY(-280);

				        	//==================================Page header - Salto De Pagina=======================================
					        // Logo
					        $image_file = 'uploads/imagenes/colegio/'.$escudo;
					        $pdf->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
					        $pdf->SetFont('helvetica', 'B', 12);

					        // Title
					        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
					        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
					        $pdf->SetFont('helvetica', '', 12);
					        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
					        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
					        $pdf->ln(3);

					        $pdf->SetFont('helvetica', 'B', 12);
				        	$pdf->Write(0, '                   INFORME PERIODICO DE EVALUACIONES', '', 0, 'C', true, 0, false, false, 0);
				        	$pdf->SetFont('helvetica', '', 10, '', true);
					        //===================================================================================================================

					        $tbl = '';
					        $tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
					        $tbl .= '<tr>
					        			<td colspan="3">CODIGO: '.$estudiantes[$i]['identificacion'].'							      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOMBRE: '.$estudiantes[$i]['nombres'].' '.$estudiantes[$i]['apellido1'].' '.$estudiantes[$i]['apellido2'].'<br />CURSO: '.$nombre_curso.'   &nbsp;&nbsp;&nbsp;PERIODO: '.$periodo.'&nbsp;&nbsp;AÑO: '.$estudiantes[$i]['nombre_ano_lectivo'].'&nbsp;&nbsp;JORNADA: '.$jornada.'&nbsp;&nbsp;PROMEDIO: '.substr($estudiantes[$i]['promedio'], 0, 3).'&nbsp;&nbsp;PUESTO: '.$cont.' de '.$total_estudiantes.' 
					        			</td>
					        		</tr>';

					        $tbl .= '<tr>
					        			<td rowspan="2" width="147">AREAS/ASIGNATURAS</td>
					        			<td rowspan="2" align="center" width="18">IH</td>
					        			<td align="center" width="80">EV. ANT.</td>
					        			<td rowspan="2" align="center" width="34">C</td>
					        			<td rowspan="2" align="center" width="18">F</td>
					        			<td rowspan="2" align="center" width="333">INFORME DESCRIPTIVO - DESEMPEÑOS</td>
					        		</tr>
					        		<tr>
					        			<td align="center" width="20">1P</td>
					        			<td align="center" width="20">2P</td>
					        			<td align="center" width="20">3P</td>
					        			<td align="center" width="20">4P</td>
					        		</tr>';
					        $tbl .= '</table>';

					        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

				        }
				        
				        

					}
			 
					// ==============================================================================================0
					// Cerrar el documento PDF y preparamos la salida
					// Este método tiene varias opciones, consulte la documentación para más información.
			        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
			        $nombre_archivo = utf8_decode("Boletines curso ".$nombre_curso.".pdf");
			        $pdf->Output($nombre_archivo, 'I');

			    }
			    else{
			    	$html = '';
			    	$html .= '<!DOCTYPE html>
			    			<html lang="en">
			    			<head>
			    				<title>Observaciones</title>
			    			</head>
			    			<body>
			    				<h1>OBSERVACIONES</h1>
			    				<h2>El Curso Seleccionado Tiene Estudiantes Con Asignaturas Pendientes Por Asignación De Logros.</h2>
			    			</body>
			    			</html>';
			    	echo $html;
			    }

		    }
		    else{
		    	$html = '';
		    	$html .= '<!DOCTYPE html>
		    			<html lang="en">
		    			<head>
		    				<title>Observaciones</title>
		    			</head>
		    			<body>
		    				<h1>OBSERVACIONES</h1>
		    				<h2>El Curso Seleccionado Tiene Estudiantes Pendientes Por Calificaciones.</h2>
		    			</body>
		    			</html>';
		    	echo $html;
		    }

	    }
	    else{

	    	$tbl = '';

	        $tbl .= '<!DOCTYPE html>
			<html lang="en">
			<head>
			<title>OBSERVACIONES</title>
			<style type="text/css">

			::selection{ background-color: #E13300; color: white; }
			::moz-selection{ background-color: #E13300; color: white; }
			::webkit-selection{ background-color: #E13300; color: white; }

			body {
				background-color: #fff;
				margin: 40px;
				font: 13px/20px normal Helvetica, Arial, sans-serif;
				color: #4F5155;
			}

			a {
				color: #003399;
				background-color: transparent;
				font-weight: normal;
			}

			h1 {
				color: #444;
				background-color: transparent;
				border-bottom: 1px solid #D0D0D0;
				font-size: 19px;
				font-weight: normal;
				margin: 0 0 14px 0;
				padding: 14px 15px 10px 15px;
			}

			code {
				font-family: Consolas, Monaco, Courier New, Courier, monospace;
				font-size: 12px;
				background-color: #f9f9f9;
				border: 1px solid #D0D0D0;
				color: #002166;
				display: block;
				margin: 14px 0 14px 0;
				padding: 12px 10px 12px 10px;
			}

			#container {
				margin: 10px;
				border: 1px solid #D0D0D0;
				-webkit-box-shadow: 0 0 8px #D0D0D0;
			}

			p {
				margin: 12px 15px 12px 15px;
			}
			</style>
			</head>
			<body>
				<div id="container">
					<h1>OBSERVACIONES</h1>
					<p>No Existen Estudiantes Matriculados En El Curso: <b>'.$nombre_curso.'</b> De La Jornada: <b>'.$jornada.'</b></p> 
				</div>
			</body>
			</html>';

	    	echo $tbl;
	    }
 

	}



	public function llenarcombo_cursos(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->imprimir_model->llenar_cursos($jornada);
    	echo json_encode($consulta);
    }


    //************************************************** FUNCIONES PARA IMPRIMIR PLANILLAS *************************************************


    //vista imprimir planillas
	public function imprimir_planilla_asistencia()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'imprimir/imprimir_planilla_asistencia_vista');
	}


	public function generar_planilla_asistencia(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}


		$jornada = $this->input->get('jornada');
		$id_curso = $this->input->get('id_curso');

		$curs = $this->imprimir_model->obtener_informacion_curso($id_curso);
		$nombre_curso = $curs[0]['nombre_grado'].'-'.$curs[0]['nombre_grupo'];
		$director_curso = $curs[0]['nombres'].' '.$curs[0]['apellido1'].' '.$curs[0]['apellido2'];
		$ano_lectivo = $curs[0]['nombre_ano_lectivo'];

		$estudiantes = $this->imprimir_model->EstudiantesMatriculadosPorCurso($id_curso);
		$total_estudiantes = count($this->imprimir_model->EstudiantesMatriculadosPorCurso($id_curso));

		$col = $this->imprimir_model->obtener_informacion_colegio();
		$nombre_institucion = $col[0]['nombre_institucion'];
		$niveles_educacion = $col[0]['niveles_educacion'];
		$resolucion = $col[0]['resolucion'];
		$dane = $col[0]['dane'];
		$nit = $col[0]['nit'];
		$escudo = $col[0]['escudo'];


		if($this->imprimir_model->validar_existencia_estudiantes($id_curso)){

			// create new PDF document
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Planilla De Asistencia Curso: '.$nombre_curso.' '.$jornada);
	        $pdf->SetSubject('Planillas SIESCOLAR');
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

	        //==============================================Page header========================================================

	        // Logo
	        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
	        $image_file = 'uploads/imagenes/colegio/'.$escudo;
	        $pdf->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	        $pdf->SetFont('helvetica', 'B', 12);

	        // Title
	        //$pdf->Cell(0, 0, '<<TCPDF Example 003>>', 1, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->SetFont('helvetica', '', 12);
	        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->ln(3);
	        //===================================================================================================================

	        
	        $pdf->SetFont('helvetica', 'B', 12);
	        $pdf->Write(0, '         PLANILLA DE ASISTENCIA', '', 0, 'C', true, 0, false, false, 0);
	        $pdf->SetFont('helvetica', '', 10, '', true);
	 
			//fijar efecto de sombra en el texto
	        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


	        // Establecemos el contenido para imprimir
	        //**********************************************************************************************************
			//preparamos y maquetamos el contenido a crear
			//**********************************************************************************************************

			$tbl = '';
			$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
			$tbl .= '<tr>
	        			<td><b>CURSO:</b> '.$nombre_curso.' '.$jornada.'</td>
	        			<td><b>AREA/ASIGNATURA:</b></td>
	        		</tr>';

	        $tbl .= '<tr>
	        			<td><b>PERIODO:</b></td>
	        			<td><b>AÑO:</b> '.$ano_lectivo.'</td>
	        		</tr>';

	        $tbl .= '<tr>
	        			<td align="center" width="22" height="30"><b>#</b></td>
	        			<td align="center" width="235" height="30"><b>APELLIDOS Y NOMBRES</b></td>
	        			<td align="center" width="374" height="30"></td>
	        		</tr>';


	        for ($j=0; $j < $total_estudiantes; $j++) {

				$cont = $j + 1;

				$tbl .= '<tr nobr="true">

							<td align="center" width="22">'.$cont.'</td>
		        			<td align="center" width="235">'.$estudiantes[$j]['apellido1'].' '.$estudiantes[$j]['apellido2'].' '.$estudiantes[$j]['nombres'].'</td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>
		        			<td align="center" width="22"></td>

						</tr>';
			}

			$tbl .= '</table>';


			// Imprimimos el texto con writeHTMLCell()
		    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

		    //SI HAY UN SALTO DE PAGINA, CREAMOS EL ENCABEZADO Y LAS 2 PRIMERAS FILAS
	        if ($pdf->getAutoPageBreak()) {
	        	
	        	$pdf->SetY(-280);

	        	//==================================Page header - Salto De Pagina=======================================
		        // Logo
		        $image_file = 'uploads/imagenes/colegio/'.$escudo;
		        $pdf->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		        $pdf->SetFont('helvetica', 'B', 12);

		        // Title
		        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->SetFont('helvetica', '', 12);
		        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->ln(3);

		        $pdf->SetFont('helvetica', 'B', 12);
	        	$pdf->Write(0, '         PLANILLA DE ASISTENCIA', '', 0, 'C', true, 0, false, false, 0);
	        	$pdf->SetFont('helvetica', '', 10, '', true);
		        //===================================================================================================================

		        $tbl = '';
				$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
				$tbl .= '<tr>
		        			<td><b>CURSO:</b> '.$nombre_curso.' '.$jornada.'</td>
		        			<td><b>AREA/ASIGNATURA:</b></td>
		        		</tr>';

		        $tbl .= '<tr>
		        			<td><b>PERIODO:</b></td>
		        			<td><b>AÑO:</b> '.$ano_lectivo.'</td>
		        		</tr>';

		        $tbl .= '<tr>
		        			<td align="center" width="22" height="30"><b>#</b></td>
		        			<td align="center" width="235" height="30"><b>APELLIDOS Y NOMBRES</b></td>
		        			<td align="center" width="374" height="30"></td>
		        		</tr>';
		        $tbl .= '</table>';

		        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

	        }


		    // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Planilla De Asistencia Curso ".$nombre_curso." ".$jornada.".pdf");
	        $pdf->Output($nombre_archivo, 'I');

		}
		else{

			echo "<h1>No Existen Estudiantes Matriculados En Este Curso.</h1>";
		}

	}


	//****************************** FUNCIONES PARA IMPRIMIR CONSTANCIAS ***********************************


	public function imprimir_constancia()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'imprimir/imprimir_constancia_vista');
	}


	public function buscar_estudianteC(){

		$identificacion = $this->input->post('id');
		
		$consulta = $this->imprimir_model->buscar_estudiante($identificacion);

		if($consulta==false){
			echo "estudiantenoexiste";
		}
		else{

			if($this->imprimir_model->validar_existencia_matricula($identificacion,FALSE)){

				echo json_encode($consulta);	
			}
			else{

				echo "estudiantenomatriculado";

			}			
		}
	    
	}


	public function generar_constancia(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$id_persona = $this->input->get('id_persona');
		$fecha_actual = $this->imprimir_model->obtener_fecha();
		$fecha_letra = $this->imprimir_model->FechaxLetras();

		$col = $this->imprimir_model->obtener_informacion_colegio();
		$nombre_institucion = $col[0]['nombre_institucion'];
		$niveles_educacion = $col[0]['niveles_educacion'];
		$resolucion = $col[0]['resolucion'];
		$dane = $col[0]['dane'];
		$nit = $col[0]['nit'];
		$escudo = $col[0]['escudo'];
		$rector = $col[0]['rector'];

		$est = $this->imprimir_model->obtener_informacion_estudiante($id_persona);
		$nombres = $est[0]['nombres'];
		$apellido1 = $est[0]['apellido1'];
		$apellido2 = $est[0]['apellido2'];
		$identificacion = $est[0]['identificacion'];
		$grado = $est[0]['nombre_grado'];
		$jornada = $est[0]['jornada'];

		if ($est[0]['tipo_id'] == "cc") {
			$tipo_id = "cédula de ciudadania";
		}
		if ($est[0]['tipo_id'] == "rc") {
			$tipo_id = "registro de civil";
		}
		if ($est[0]['tipo_id'] == "ti") {
			$tipo_id = "tarjeta de identidad";
		}

		if($this->imprimir_model->validar_existencia_matricula(FALSE,$id_persona)){


			// create new PDF document
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Constancia De Estudio');
	        $pdf->SetSubject('Constancias SIESCOLAR');
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

	        //=======================================Page header========================================================

	        // Logo
	        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
	        $image_file = 'uploads/imagenes/colegio/'.$escudo;
	        $pdf->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	        $pdf->SetFont('helvetica', 'B', 12);

	        // Title
	        //$pdf->Cell(0, 0, '<<TCPDF Example 003>>', 1, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->SetFont('helvetica', '', 12);
	        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->ln(12);
	        //===========================================================================================================

	        $pdf->SetMargins(30, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	        $pdf->SetFont('helvetica', 'B', 12);
	        $titulo = '          El Suscrito Director Del '.ucwords(strtolower($nombre_institucion)).' De Sempegua Municipio De Chimichagua';
	        $pdf->Write(0, $titulo, '', 0, 'C', true, 0, false, false, 0);
	        $pdf->SetFont('helvetica', '', 12, '', true);
	 
			//fijar efecto de sombra en el texto
	        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


	        // Establecemos el contenido para imprimir
	        //**********************************************************************************************************
			//preparamos y maquetamos el contenido a crear
			//******

	        $tbl = '';
	        $tbl .= '<br /><br /><br />';
	        $tbl .= '<p align="center"><b>H A C E &nbsp;&nbsp;C O N S T A R:<br /></b></p>';
	        $tbl .= '<p>Que, <b>'.strtoupper($apellido1).' '.strtoupper($apellido2).' '.strtoupper($nombres).'</b>, identificado con '.$tipo_id.' número <b>'.$identificacion.'</b>, se encuentra matriculado (a) en este Centro Educativo en el Grado <b>'.$grado.'</b>, en la jornada de la <b>'.$jornada.'</b>, para el año lectivo ('.substr($fecha_actual, 6).').<br /></p>';

	        $tbl .= '<p>Para mayor constancia se firma la presente en el Corregimiento de Sempegua Municipio de Chimichagua Cesar a los '.$fecha_letra.'.<br /><br /><br /><br /></p>';
	        $tbl .= '<p>Cordialmente,<br /><br /><br /><br /></p>';
	        $tbl .= '<p>________________________________<br /><b>'.$rector.'<br />Director General</b></p>';

	        // Imprimimos el texto con writeHTMLCell()
		    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'J', $autopadding = true);

		    // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Constancia De Estudio ".$identificacion.".pdf");
	        $pdf->Output($nombre_archivo, 'I');


		}
		else{

			echo "<h1>El Estudiante No Se Encuentra Matriculado.</h1>";
		}



	}


	//****************** FUNCIONES PARA IMPRIMIR CERTIFICADOS ****************


	public function imprimir_certificado()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'imprimir/imprimir_certificado_vista');
	}


	public function buscar_estudianteCT(){

		$identificacion = $this->input->post('id');
		
		$consulta = $this->imprimir_model->buscar_estudiante($identificacion);

		if($consulta==false){
			echo "estudiantenoexiste";
		}
		else{

			if($this->imprimir_model->validar_existencia_matriculaCT($identificacion,FALSE,FALSE)){

				echo json_encode($consulta);	
			}
			else{

				echo "estudiantenomatriculado";

			}			
		}
	    
	}


	public function llenarcombo_anos_lectivosCT(){

    	$consulta = $this->imprimir_model->llenar_anos_lectivosCT();
    	echo json_encode($consulta);
    }


    public function generar_certificado(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$id_persona = $this->input->get('id_persona');
		$ano_lectivo = $this->input->get('ano_lectivo');
		$fecha_actual = $this->imprimir_model->obtener_fecha();
		$fecha_letra = $this->imprimir_model->FechaxLetras();

		$col = $this->imprimir_model->obtener_informacion_colegio();
		$nombre_institucion = $col[0]['nombre_institucion'];
		$niveles_educacion = $col[0]['niveles_educacion'];
		$resolucion = $col[0]['resolucion'];
		$dane = $col[0]['dane'];
		$nit = $col[0]['nit'];
		$escudo = $col[0]['escudo'];
		$rector = $col[0]['rector'];

		$est = $this->imprimir_model->obtener_informacion_estudianteCT($id_persona,$ano_lectivo);
		$nombres = $est[0]['nombres'];
		$apellido1 = $est[0]['apellido1'];
		$apellido2 = $est[0]['apellido2'];
		$identificacion = $est[0]['identificacion'];
		$id_grado = $est[0]['id_grado'];
		$grado = $est[0]['nombre_grado'];
		$jornada = $est[0]['jornada'];

		if ($est[0]['tipo_id'] == "cc") {
			$tipo_id = "cédula de ciudadania";
		}
		if ($est[0]['tipo_id'] == "rc") {
			$tipo_id = "registro de civil";
		}
		if ($est[0]['tipo_id'] == "ti") {
			$tipo_id = "tarjeta de identidad";
		}

		//variable que almacena el array de las calificaciones del estudiante
		$NotasEstudiante = $this->imprimir_model->Obtener_NotasEstudianteCT($id_persona,$id_grado,$ano_lectivo);

		if($this->imprimir_model->validar_existencia_matriculaCT(FALSE,$id_persona,$ano_lectivo)){


			// create new PDF document
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Certificado De Estudio');
	        $pdf->SetSubject('Certificados SIESCOLAR');
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

	        //=======================================Page header========================================================

	        // Logo
	        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
	        $image_file = 'uploads/imagenes/colegio/'.$escudo;
	        $pdf->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	        $pdf->SetFont('helvetica', 'B', 12);

	        // Title
	        //$pdf->Cell(0, 0, '<<TCPDF Example 003>>', 1, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->SetFont('helvetica', '', 12);
	        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->ln(12);
	        //===========================================================================================================

	        $pdf->SetMargins(30, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	        $pdf->SetFont('helvetica', 'B', 12);
	        $titulo = '          El Suscrito Director Del '.ucwords(strtolower($nombre_institucion)).' De Sempegua Municipio De Chimichagua';
	        $pdf->Write(0, $titulo, '', 0, 'C', true, 0, false, false, 0);
	        $pdf->SetFont('helvetica', '', 12, '', true);
	 
			//fijar efecto de sombra en el texto
	        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


	        // Establecemos el contenido para imprimir
	        //**********************************************************************************************************
			//preparamos y maquetamos el contenido a crear
			//******

	        $tbl = '';
	        $tbl .= '<br />';
	        $tbl .= '<p align="center"><b>CERTIFICA:</b><br /></p>';
	        $tbl .= '<p>Que, <b>'.strtoupper($apellido1).' '.strtoupper($apellido2).' '.strtoupper($nombres).'</b>, identificado con '.$tipo_id.' número <b>'.$identificacion.'</b> expedido (a) en ____________________, cursó y aprobó en este Centro Educativo el Grado <b>'.$grado.'</b>, durante el año lectivo ('.substr($fecha_actual, 6).') en la jornada de la <b>'.$jornada.'</b>, obteniendo las siguientes calificaciones.</p>';

	        $tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
	        $tbl .= '<tr>
	        			<td align="center" width="299" height="30"><b>AREAS Y ASIGNATURAS</b></td>
	        			<td align="center" width="28"><b>I.H.</b></td>
	        			<td align="center" width="249"><b>VALORACIÓN</b></td>
	        		</tr>';

	        for ($i=0; $i < count($NotasEstudiante); $i++) { 
	        	
	        	$tbl .= '<tr nobr="true">
	        				<td><b>'.strtoupper($NotasEstudiante[$i]['nombre_asignatura']).'</b></td>
	        				<td align="center">'.strtoupper($NotasEstudiante[$i]['intensidad_horaria']).'</td>
	        				<td align="center">'.mb_strtoupper($NotasEstudiante[$i]['nombre_desempeno'],'UTF-8').'</td>
	        			</tr>';
	        }

	        $tbl .= '</table>';

	        $tbl .= '<p><b>OBSERVACIONES:</b><br /></p>';
	        $tbl .= '<p>Este certificado pertenece a: <b>'.strtoupper($apellido1).' '.strtoupper($apellido2).' '.strtoupper($nombres).'</b>.</p>';
	        $tbl .= '<p>El presente no necesita ser autenticado en Notarias, Decreto 1543 de Julio 1978.<br /></p>';

	        if (count($NotasEstudiante) >= 17) {
	        	$tbl .= '<p>&nbsp;</p>';
	        }

	        //$tbl .= '<p>Se expide la presente en el Corregimiento de Sempegua, Municipio de Chimichagua Cesar a los _______ días del Mes de _______________ del Año __________.<br /><br /><br /></p>';

	        $tbl .= '<p>Se expide la presente en el Corregimiento de Sempegua, Municipio de Chimichagua Cesar a los '.$fecha_letra.'.<br /><br /><br /></p>';

	        if (count($NotasEstudiante) == 11) {
	        	$tbl .= '<p>&nbsp;<br /></p>';
	        }

	        $tbl .= '<p align="center">________________________________<br /><b>'.strtoupper($rector).'<br />DIRECTOR GENERAL</b></p>';

	        // Imprimimos el texto con writeHTMLCell()
		    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'J', $autopadding = true);


		    //SI HAY UN SALTO DE PAGINA, CREAMOS EL ENCABEZADO
	        if ($pdf->getAutoPageBreak()) {
	        	
	        	$pdf->SetY(-280);
	        	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	        	//==================================Page header - Salto De Pagina=======================================
		        // Logo
		        $image_file = 'uploads/imagenes/colegio/'.$escudo;
		        $pdf->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		        $pdf->SetFont('helvetica', 'B', 12);

		        // Title
		        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->SetFont('helvetica', '', 12);
		        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        //$pdf->ln(1);

		        $pdf->SetMargins(30, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	        }

		    // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Certificado De Estudio ".$identificacion.".pdf");
	        $pdf->Output($nombre_archivo, 'I');


		}
		else{

			echo "<h1>El Estudiante No Se Encuentra Matriculado.</h1>";
		}



	}


	//====================== FUNCIONES PARA LA IMPRESION DE CARNETS ESTUDIANTILES ==========================


	//vista imprimir carnets
	public function imprimir_carnet()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'imprimir/imprimir_carnet_vista');
	}


	public function generar_carnet(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}


		$jornada = $this->input->get('jornada');
		$id_curso = $this->input->get('id_curso');

		$curs = $this->imprimir_model->obtener_informacion_curso($id_curso);
		$nombre_curso = $curs[0]['nombre_grado'].' '.$curs[0]['nombre_grupo'];
		$director_curso = $curs[0]['nombres'].' '.$curs[0]['apellido1'].' '.$curs[0]['apellido2'];
		$ano_lectivo = $curs[0]['nombre_ano_lectivo'];

		$estudiantes = $this->imprimir_model->EstudiantesMatriculadosPorCurso($id_curso);
		$total_estudiantes = count($this->imprimir_model->EstudiantesMatriculadosPorCurso($id_curso));

		$col = $this->imprimir_model->obtener_informacion_colegio();
		$nombre_institucion = $col[0]['nombre_institucion'];
		$niveles_educacion = $col[0]['niveles_educacion'];
		$resolucion = $col[0]['resolucion'];
		$dane = $col[0]['dane'];
		$nit = $col[0]['nit'];
		$escudo = $col[0]['escudo'];


		if($this->imprimir_model->validar_existencia_estudiantes($id_curso)){

			// create new PDF document
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Canets Estudiantiles Curso: '.$nombre_curso.' '.$jornada);
	        $pdf->SetSubject('Carnets SIESCOLAR');
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

	        for ($i=0; $i < $total_estudiantes; $i++) {

		        // Añadir una página
		        $pdf->AddPage();

		        //========================================== Page header ===============================================

		        // Logo
		        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
		        $image_file = 'uploads/imagenes/colegio/'.$escudo;
		        $pdf->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		        $pdf->SetFont('helvetica', 'B', 12);

		        // Title
		        //$pdf->Cell(0, 0, '<<TCPDF Example 003>>', 1, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, $nombre_institucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$niveles_educacion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->SetFont('helvetica', '', 12);
		        $pdf->Cell(0, 0, '                 '.$resolucion, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->Cell(0, 0, '                 '.$dane.' '.$nit, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
		        $pdf->ln(3);
		        //=======================================================================================================

		        
		        $pdf->SetFont('helvetica', 'B', 12);
		        $pdf->Write(0, '         CARNET ESTUDIANTIL', '', 0, 'C', true, 0, false, false, 0);
		        $pdf->SetFont('helvetica', '', 10, '', true);
		 
				//fijar efecto de sombra en el texto
		        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


		        // Establecemos el contenido para imprimir
		        //**********************************************************************************************************
				//preparamos y maquetamos el contenido a crear
				//**********************************************************************************************************
				
				$tbl = '';
				$tbl .= '<br /><br /><br />';
				$tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
				$tbl .= '<tr>
		        			<td style="text-align:center" width="230" height="100" bgcolor="#4286f4"><br /><br /><b>'.$nombre_institucion.'</b><br /><img src="uploads/imagenes/colegio/'.$escudo.'" height="70" width="70" border="1"/></td>
		        		</tr>';
		        $tbl .= '<tr>
		        			<td style="text-align:center" height="200"><br /><br /><img src="uploads/imagenes/elecciones/candidatos/candidato.png" alt="Foto En Blanco" height="110" width="90" border="1"/><br /><b>'.strtoupper($estudiantes[$i]['nombres']).'<br />'.strtoupper($estudiantes[$i]['apellido1']).' '.strtoupper($estudiantes[$i]['apellido2']).'</b><br /><b>'.strtoupper($estudiantes[$i]['tipo_id']).':</b> '.$estudiantes[$i]['identificacion'].'<br /><b>RH:</b> '.strtoupper($estudiantes[$i]['tipo_sangre']).'</td>
		        		</tr>';
		        $tbl .= '<tr>
		        			<td style="text-align:center" height="40" bgcolor="#14cc5a"><b>CURSO: '.strtoupper($nombre_curso).'<br />'.$jornada.'</b></td>
		        		</tr>';
		        $tbl .= '</table>';


				// Imprimimos el texto con writeHTMLCell()
			    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '75', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

		    }

		    // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Carnets Estudiantiles Curso ".$nombre_curso." ".$jornada.".pdf");
	        $pdf->Output($nombre_archivo, 'I');

		}
		else{

			echo "<h1>No Existen Estudiantes Matriculados En Este Curso.</h1>";
		}

	}




}