<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matriculas_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('matriculas_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
		//$this->load->library('Pdf');
		//$this->load->database('default');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'matriculas/matriculas_vista');
	}

	public function insertar(){

        $this->form_validation->set_rules('id_persona', 'id persona', 'required|numeric');
        $this->form_validation->set_rules('id_curso', 'curso', 'required|numeric');
        $this->form_validation->set_rules('id_acudiente', 'Acudiente', 'required|numeric');
        $this->form_validation->set_rules('parentesco', 'Parentesco', 'required');
        $this->form_validation->set_rules('jornada', 'jornada', 'required|alpha_spaces');
        $this->form_validation->set_rules('observaciones', 'observaciones', 'required|alpha_spaces');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de matriculas + 1 
        	$ultimo_id = $this->matriculas_model->obtener_ultimo_id();

        	//obtengo la fecha actual 
        	$fecha_actual = $this->funciones_globales_model->obtener_fecha_actual_corta();
        	 
        	//obtengo la año actual 
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

        	$id_estudiante = $this->input->post('id_persona');
        	$id_curso = $this->input->post('id_curso');
        	$jornada = $this->input->post('jornada');
        	$id_acudiente = $this->input->post('id_acudiente');
        	$parentesco = $this->input->post('parentesco');
        	$observaciones = mb_convert_case(mb_strtolower(trim($this->input->post('observaciones'))), MB_CASE_TITLE);
        	$estado = 'Activo';
        	$situacion_academica = 'No Definida';

        	//array para insertar en la tabla matriculas----------
        	$matricula = array(
        	'id_matricula' =>$ultimo_id,	
			'fecha_matricula' =>$fecha_actual,
			'ano_lectivo' =>$ano_lectivo,
			'id_estudiante' =>$id_estudiante,
			'id_curso' =>$id_curso,
			'jornada' =>$jornada,
			'id_acudiente' =>$id_acudiente,
			'parentesco' =>$parentesco,
			'observaciones' =>$observaciones,
			'estado_matricula' =>$estado,
			'situacion_academica' =>$situacion_academica);

			//array para insertar en la tabla estudiantes_acudientes
			$est_acud = array(
        	'id_estudiante' =>$id_estudiante,	
			'id_acudiente' =>$id_acudiente,
			'parentesco' =>$parentesco,
			'ano_lectivo' =>$ano_lectivo);

			//array para actualizar el estado del estudiante en la tabla estudiantes
			$estado = array(
        	'id_persona' =>$id_estudiante,	
			'estado_estudiante' =>"Matriculado",
			'fecha_estado' =>$fecha_actual);

			//array para insertar en la tabla historial estados
			$historial = array(
        	'id_persona' =>$id_estudiante,	
			'estado' =>"Matriculado",
			'observaciones' =>"Estudiante Matriculado.",
			'fecha_estado' =>$fecha_actual,
			'ano_lectivo' =>$ano_lectivo);

			//array para insertar en la tabla promocion
			$promocion = array(
			'ano_lectivo' 			  =>$ano_lectivo,
        	'id_estudiante'           =>$id_estudiante,
        	'id_curso' 		          =>$id_curso,	
			'asignaturas_reprobadas'  =>"0",
			'areas_reprobadas' 		  =>"0",
			'areas_reprobadas' 		  =>"0",
			'inasistencias' 		  =>"0",
			'porcentaje_inasistencias'=>"0",
			'situacion_academica' 	  =>"No Definida");

			if ($this->matriculas_model->validar_existencia($id_estudiante,$ano_lectivo)){

				if ($this->matriculas_model->validar_existencia_pensum($id_curso,$ano_lectivo)){

					$respuesta=$this->matriculas_model->insertar_matricula($matricula,$est_acud,$estado,$historial,$promocion,$id_estudiante);

					if($respuesta==true){

						echo "registroguardado";

						//*******************************matricular materias********************************************
						$id_grado = $this->matriculas_model->obtener_gradoPorcurso($id_curso);

						$asignaturas_grados = $this->matriculas_model->obtener_asignaturasPorgrados($id_grado);

						if ($asignaturas_grados != false) {

							for ($i=0; $i < count($asignaturas_grados) ; $i++) { 


								$resp = $this->matriculas_model->insertar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante,$id_grado,$asignaturas_grados[$i]['id_asignatura']);

								if($resp == false){
									echo "no se pudo registrar en la tabla notas";
								}
								
							}
						}
						//*************************************************************************************************

					}
					else{

						echo "registronoguardado";
					}
				}
				else{

					echo "pensumnoexiste";
				}

			}
			else{

				echo "matricula ya existe";
			}

        }

	}

	public function mostrarmatriculas(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'matriculas' => $this->matriculas_model->buscar_matricula($id,$inicio,$cantidad),

		    'totalregistros' => count($this->matriculas_model->buscar_matricula($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

        	//Obtenemos id_estudiante y ano_lectivo con ese id de matricula********************************************
			$matri=$this->matriculas_model->obtener_informacion_matricula($id);
			$id_estudiante = $matri[0]['id_estudiante'];
			$ano_lectivo = $matri[0]['ano_lectivo'];

			$fecha_estado = $this->matriculas_model->obtener_fecha_estado($id_estudiante,$ano_lectivo);

			//array para actualizar el estado de (Matriculado a Inscrito) del estudiante en la tabla estudiantes
			$estado = array(
        	'id_persona' =>$id_estudiante,	
			'estado_estudiante' =>"Inscrito",
			'fecha_estado' =>$fecha_estado);

			//eliminanos las materias registradas de ese estudiante en la tabla notas********************************************
			if(!$this->matriculas_model->eliminar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante)){
				echo "No se pudo eliminar en la tabla notas";
			}


	        $respuesta=$this->matriculas_model->eliminar_matricula($id,$id_estudiante,$ano_lectivo,$estado);
	        
          	if($respuesta==true){
              
              	echo "Matrícula Eliminada Correctamente.";
          	}else{
              
              	echo "No Se Pudo Eliminar.";
          	}
          
        }else{
          
          	echo "digite valor numerico para identificar una matricula";
        }
    }

    public function modificar(){

    	$id_matricula = $this->input->post('id_matricula');
    	$fecha_matricula = $this->input->post('fecha_matricula');
    	$ano_lectivo = $this->input->post('ano_lectivo');
    	$id_estudiante = $this->input->post('id_persona');
    	$id_curso = $this->input->post('id_curso');
    	$jornada = $this->input->post('jornada');
    	$id_acudiente = $this->input->post('id_acudiente');
        $parentesco = $this->input->post('parentesco');
    	$observaciones = mb_convert_case(mb_strtolower(trim($this->input->post('observaciones'))), MB_CASE_TITLE);
        $estado = 'Activo';

    	//array para insertar en la tabla matriculas----------
        $matricula = array(
        'id_matricula' =>$id_matricula,	
		'fecha_matricula' =>$fecha_matricula,
		'ano_lectivo' =>$ano_lectivo,
		'id_estudiante' =>$id_estudiante,
		'id_curso' =>$id_curso,
		'jornada' =>$jornada,
		'id_acudiente' =>$id_acudiente,
		'parentesco' =>$parentesco,
		'observaciones' =>$observaciones,
		'estado_matricula' =>$estado);

        //array para insertar en la tabla estudiantes_acudientes
		$est_acud = array(
    	'id_estudiante' =>$id_estudiante,	
		'id_acudiente' =>$id_acudiente,
		'parentesco' =>$parentesco,
		'ano_lectivo' =>$ano_lectivo);

        if(is_numeric($id_matricula)){

	    	$respuesta=$this->matriculas_model->modificar_matricula($id_matricula,$matricula,$est_acud,$id_estudiante,$ano_lectivo);

	        if($respuesta==true){

	        	echo "registroactualizado";

	        	//******************************eliminar materias********************************************
				if(!$this->matriculas_model->eliminar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante)){
					echo "No se pudo eliminar en la tabla notas";
				}

				//*******************************matricular materias********************************************
				$id_grado = $this->matriculas_model->obtener_gradoPorcurso($id_curso);

				$asignaturas_grados = $this->matriculas_model->obtener_asignaturasPorgrados($id_grado);

				if ($asignaturas_grados != false) {
					
					for ($i=0; $i < count($asignaturas_grados) ; $i++) { 

						$resp = $this->matriculas_model->insertar_asignaturasPorestudiantes($ano_lectivo,$id_estudiante,$id_grado,$asignaturas_grados[$i]['id_asignatura']);

						if($resp == false){
							echo "no se pudo registrar en la tabla notas";
						}
							
					}
				}	
				//*************************************************************************************************

	        }else{

	        	echo "registronoactualizado";
	        }

         
        }else{
            
            echo "digite valor numerico para identificar una matricula";
        }




    }


    public function buscar_estudiante(){

		$id = $this->input->post('id'); 
		//obtengo la fecha actual 
       	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
		$consulta = $this->matriculas_model->buscar_estudiante($id);
		if($consulta==false){
			echo "estudiantenoexiste";
		}
		else{

			if($this->matriculas_model->validar_existencia_por_identificacion($id,$ano_lectivo)){

				if($this->matriculas_model->comprobar_NuevoAntiguo($id)){

					echo json_encode($consulta);
				}
				else{
					echo "estudianteantiguo";
				}	
						
			}else{

				echo "matricula ya existe";
			}
			
		}
	    
	}


    public function llenarcombo_cursos(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->matriculas_model->llenar_cursos($jornada);
    	echo json_encode($consulta);
    }


    public function llenarcombo_acudientes(){

    	$consulta = $this->matriculas_model->llenar_acudientes();
    	echo json_encode($consulta);
    }


    public function llenarcombo_cursos_actualizar(){

    	$jornada = $this->input->post('jornada');
    	$ano_lectivo = $this->input->post('ano_lectivo');

    	$consulta = $this->matriculas_model->llenar_cursos_actualizar($jornada,$ano_lectivo);
    	echo json_encode($consulta);
    }


    public function llenarcombo_anos_lectivos_actualizar(){

    	$consulta = $this->matriculas_model->llenar_anos_lectivos_actualizar();
    	echo json_encode($consulta);
    }


    //****************************************** FUNCIONES PARA MATRICULAR ESTUDIANTES ANTIGUOS ***************************************

    public function buscar_estudianteA(){

		$id = $this->input->post('id'); 
		//obtengo la fecha actual 
       	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
		$consulta = $this->matriculas_model->buscar_estudiante($id);
		if($consulta==false){
			echo "estudiantenoexiste";
		}
		else{

			if($this->matriculas_model->validar_existencia_por_identificacion($id,$ano_lectivo)){

				if(!$this->matriculas_model->comprobar_NuevoAntiguo($id)){

					//echo json_encode($consulta);

					$ultima_matricula = $this->matriculas_model->UltimaMatricula($id);
					$matricula = $this->matriculas_model->obtener_informacion_matricula($ultima_matricula);
					$id_curso = $matricula[0]['id_curso'];
					$estado_matricula = $matricula[0]['estado_matricula'];
					$situacion_academica = $matricula[0]['situacion_academica'];

					$id_grado = $this->matriculas_model->obtener_gradoPorcurso($id_curso);
					$grado = $this->matriculas_model->obtener_informacion_grado($id_grado);
					$nombre_grado = $grado[0]['nombre_grado'];

					if ($situacion_academica == "Aprobado") {

						$data = array(

							'datos' => $consulta,

							'proximo_grado' => $this->matriculas_model->obtener_proximo_grado($nombre_grado),

						    'estadomatricula' => $estado_matricula
						);

						echo json_encode($data);
						
					}
					else{

						$data = array(

							'datos' => $consulta,

							'proximo_grado' => $nombre_grado,

						    'estadomatricula' => $estado_matricula
						);

						echo json_encode($data);

					}
				}
				else{

					echo "estudiantenuevo";
				}	
						
			}else{

				echo "matricula ya existe";
			}
			
		}
	    
	}


	public function llenarcombo_cursosA(){

    	$jornada = $this->input->post('jornada');
    	$nombre_grado = $this->input->post('nombre_grado');

    	$consulta = $this->matriculas_model->llenar_cursosA($jornada,$nombre_grado);
    	echo json_encode($consulta);
    }


    //********************************* FUNCIONES PARA EL CONSOLIDADO DE MATRICULAS ****************************************


    public function consolidar_matriculas()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'matriculas/consolidar_matriculas_vista');
	}


	public function consolidar(){

		$jornada = $this->input->post('jornada'); 
		$id_curso = $this->input->post('id_curso');

		$PeriodosRegistrados = $this->matriculas_model->PeriodosRegistrados();
		$PeriodosActivos = $this->matriculas_model->PeriodosActivos();
		$PeriodosCerrados = $this->matriculas_model->PeriodosCerrados();

		if ($PeriodosRegistrados > 0) {

			if ($PeriodosRegistrados == 4) {
			
				if ($PeriodosActivos == 0) {

					if ($PeriodosCerrados == 4) {

						$respuesta = $this->matriculas_model->modificar_estado_matricula($jornada,$id_curso);

						if($respuesta==true){
			              
			              	echo "consolidadorealizado";
			          	}else{
			              
			              	echo "consolidadonorealizado";
			          	}
			        }
			        else{

			        	echo "nohay4periodoscerrados";
			        }

				}
				else{

					echo "consolidadodenegado";
				}
			}
			else{

				echo "nohay4periodos";
			}
		}
		else{

			echo "nohayperiodos";
		}
	}


	public function llenarcombo_cursosCM(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->matriculas_model->llenar_cursosCM($jornada);
    	echo json_encode($consulta);
    }



	//******************* FUNCIONES PARA IMPRIMIR FICHAS DE MATRICULAS *********************


	public function generar_ficha(){

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$id_matricula = $this->input->get('id_matricula');
		//$fecha_actual = $this->imprimir_model->obtener_fecha();
		//$fecha_letra = $this->imprimir_model->FechaxLetras();

		$col = $this->matriculas_model->obtener_informacion_colegio();
		$nombre_institucion = $col[0]['nombre_institucion'];
		$niveles_educacion = $col[0]['niveles_educacion'];
		$resolucion = $col[0]['resolucion'];
		$dane = $col[0]['dane'];
		$nit = $col[0]['nit'];
		$escudo = $col[0]['escudo'];
		$responsable = $col[0]['responsable'];
		$cargo_responsable = $col[0]['cargo_responsable'];

		$matri = $this->matriculas_model->obtener_informacion_matricula_ficha($id_matricula);
		$nombresest = $matri[0]['nombresest'];
		$apellido1est = $matri[0]['apellido1est'];
		$apellido2est = $matri[0]['apellido2est'];
		$tipo_idest = $matri[0]['tipo_idest'];
		$identificacionest = $matri[0]['identificacionest'];
		$sexoest = $matri[0]['sexoest'];
		$fecha_nacimientoest = $matri[0]['fecha_nacimientoest'];
		$nombre_municipioest = $matri[0]['nombre_municipioest'];
		$direccionest = $matri[0]['direccionest'];
		$barrioest = $matri[0]['barrioest'];
		$telefonoest = $matri[0]['telefonoest'];
		$epsest = $matri[0]['epsest'];
		$tipo_sangreest = $matri[0]['tipo_sangreest'];
		$grado = $matri[0]['nombre_grado'];
		$grupo = $matri[0]['nombre_grupo'];
		$jornada = $matri[0]['jornada'];
		$curso = $grado." ".$grupo;
		$ano_lectivo = $matri[0]['nombre_ano_lectivo'];

		$nombresacu = $matri[0]['nombresacu'];
		$apellido1acu = $matri[0]['apellido1acu'];
		$apellido2acu = $matri[0]['apellido2acu'];
		$identificacionacu = $matri[0]['identificacionacu'];
		$direccionacu = $matri[0]['direccionacu'];
		$telefonoacu = $matri[0]['telefonoacu'];
		$ocupacionacu = $matri[0]['ocupacionacu'];
		$telefono_trabajoacu = $matri[0]['telefono_trabajoacu'];

		$nombres_p = $matri[0]['nombres_p'];
		$apellido1_p = $matri[0]['apellido1_p'];
		$apellido2_p = $matri[0]['apellido2_p'];
		$identificacion_p = $matri[0]['identificacion_p'];
		$direccion_p = $matri[0]['direccion_p'];
		$telefono_p = $matri[0]['telefono_p'];
		$ocupacion_p = $matri[0]['ocupacion_p'];
		$telefono_trabajo_p = $matri[0]['telefono_trabajo_p'];

		$nombres_m = $matri[0]['nombres_m'];
		$apellido1_m = $matri[0]['apellido1_m'];
		$apellido2_m = $matri[0]['apellido2_m'];
		$identificacion_m = $matri[0]['identificacion_m'];
		$direccion_m = $matri[0]['direccion_m'];
		$telefono_m = $matri[0]['telefono_m'];
		$ocupacion_m = $matri[0]['ocupacion_m'];
		$telefono_trabajo_m = $matri[0]['telefono_trabajo_m'];


		if($this->matriculas_model->validar_existencia_matricula($id_matricula)){

			$this->load->library('Pdf');

			// create new PDF document
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Siescolar');
	        $pdf->SetTitle('Ficha De Matrícula');
	        $pdf->SetSubject('Fichas De Matrículas SIESCOLAR');
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
	        $pdf->Image($image_file, 10, 10, 25, 25, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
	        $pdf->SetFont('helvetica', 'B', 12);

	        // Title
	        //$pdf->Cell(0, 0, '<<TCPDF Example 003>>', 1, 1, 'C', 0, '', 0, false, 'T', 'M');
	        $pdf->Cell(0, 0, $nombre_institucion, 0, 2, 'C', 0, '', 1, false, 'T', 'M');
	        $pdf->Cell(0, 0, $niveles_educacion, 0, 2, 'C', 0, '', 1, false, 'T', 'M');
	        $pdf->SetFont('helvetica', '', 12);
	        $pdf->Cell(0, 0, $resolucion, 0, 2, 'C', 0, '', 1, false, 'T', 'M');
	        $pdf->Cell(0, 0, $dane.' '.$nit, 0, 2, 'C', 0, '', 1, false, 'T', 'M');
	        $pdf->ln(3);
	        //===========================================================================================================

	        //$pdf->SetMargins(30, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	        $pdf->SetFont('helvetica', 'B', 12);
	        $pdf->Write(0, 'FICHA DE MATRÍCULA', '', 0, 'C', true, 0, false, false, 0);
	        $pdf->SetFont('helvetica', '', 12, '', true);
	 
			//fijar efecto de sombra en el texto
	        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


	        // Establecemos el contenido para imprimir
	        //**********************************************************************************************************
			//preparamos y maquetamos el contenido a crear
			//******

	        $tbl = '';
	        $tbl .= '<p align="center"><b>AÑO LECTIVO '.$ano_lectivo.'</b></p>';
	        $tbl .= '<p><b>CURSO:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$curso.'<br /><b>JORNADA:</b> &nbsp;'.$jornada.'</p>';
	        $tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
	        $tbl .= '<tr>
	        			<td colspan="2" align="center">
	        				<b>DATOS DEL ESTUDIANTE</b>
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>APELLIDOS:</b> '.$apellido1est.' '.$apellido2est.'
	        			</td>
	        			<td>
	        				<b>NOMBRES:</b> '.$nombresest.'
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>IDENTIFICACION:</b> '.strtoupper($tipo_idest).' '.$identificacionest.'
	        			</td>
	        			<td>
	        				<b>SEXO:</b> '.strtoupper($sexoest).'
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>FECHA DE NACIMIENTO:</b> '.$fecha_nacimientoest.'
	        			</td>
	        			<td>
	        				<b>LUGAR DE NACIMIENTO:</b> '.ucfirst(mb_strtolower($nombre_municipioest, 'UTF-8')).'
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>DIRECCION:</b> '.$direccionest.'
	        			</td>
	        			<td>
	        				<b>BARRIO:</b> '.$barrioest.'
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>TELEFONO:</b> '.$telefonoest.'
	        			</td>
	        			<td>
	        				<b>CARNET DE SALUD:</b> '.$epsest.'
	        			</td>
	        		</tr>';	
	        $tbl .= '</table>';
	        	

	        $tbl .= '<p></p>';
	        $tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
	        $tbl .= '<tr>
	        			<td colspan="2" align="center">
	        				<b>DATOS DEL PADRE</b>
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>NOMBRE:</b> '.$nombres_p.' '.$apellido1_p.' '.$apellido2_p.'
	        			</td>
	        			<td>
	        				<b>C.C. No.</b> '.$identificacion_p.'
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>DIRECCION:</b> '.$direccion_p.'
	        			</td>
	        			<td>
	        				<b>TELEFONO:</b> '.$telefono_p.'
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>OCUPACION:</b> '.$ocupacion_p.'
	        			</td>
	        			<td>
	        				<b>TELEFONO 2:</b> '.$telefono_trabajo_p.'
	        			</td>
	        		</tr>';
	        $tbl .= '</table>';


	        $tbl .= '<p></p>';
	        $tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
	        $tbl .= '<tr>
	        			<td colspan="2" align="center">
	        				<b>DATOS DE LA MADRE</b>
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>NOMBRE:</b> '.$nombres_m.' '.$apellido1_m.' '.$apellido2_m.'
	        			</td>
	        			<td>
	        				<b>C.C. No.</b> '.$identificacion_m.'
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>DIRECCION:</b> '.$direccion_m.'
	        			</td>
	        			<td>
	        				<b>TELEFONO:</b> '.$telefono_m.'
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>OCUPACION:</b> '.$ocupacion_m.'
	        			</td>
	        			<td>
	        				<b>TELEFONO 2:</b> '.$telefono_trabajo_m.'
	        			</td>
	        		</tr>';
	        $tbl .= '</table>';


	        $tbl .= '<p></p>';
	        $tbl .= '<table cellspacing="0" cellpadding="1" border="1">';
	        $tbl .= '<tr>
	        			<td colspan="2" align="center">
	        				<b>DATOS DEL ACUDIENTE</b>
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>NOMBRE:</b> '.$nombresacu.' '.$apellido1acu.' '.$apellido2acu.'
	        			</td>
	        			<td>
	        				<b>C.C. No.</b> '.$identificacionacu.'
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>DIRECCION:</b> '.$direccionacu.'
	        			</td>
	        			<td>
	        				<b>TELEFONO:</b> '.$telefonoacu.'
	        			</td>
	        		</tr>';
	        $tbl .= '<tr>
	        			<td>
	        				<b>OCUPACION:</b> '.$ocupacionacu.'
	        			</td>
	        			<td>
	        				<b>TELEFONO 2:</b> '.$telefono_trabajoacu.'
	        			</td>
	        		</tr>';
	        $tbl .= '</table>';


	        $tbl .= '<p>&nbsp;<br /></p>';
	        $tbl .= '<p>________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Estudiante&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Acudiente<br /></p>';

	        if ($cargo_responsable == "Rector") {
	        	
	        	$tbl .= '<p>________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Rector&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Secretaria</p>';
	        }
	        elseif ($cargo_responsable == "Director") {
	        	
	        	$tbl .= '<p>________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Director&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Secretaria</p>';
	        }
	        elseif ($cargo_responsable == "Director General") {
	        	
	        	$tbl .= '<p>________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Director General&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Secretaria</p>';
	        }
	        elseif ($cargo_responsable == "Coordinador") {
	        	
	        	$tbl .= '<p>________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Coordinador&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Secretaria</p>';
	        }
	        elseif ($cargo_responsable == "Coordinador Académico") {
	        	
	        	$tbl .= '<p>________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Coordinador Académico&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Secretaria</p>';
	        }
	        elseif ($cargo_responsable == "Coordinador Disciplinario") {
	        	
	        	$tbl .= '<p>________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Coordinador Disciplinario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Secretaria</p>';
	        }
	        elseif ($cargo_responsable == "Psicorientador") {
	        	
	        	$tbl .= '<p>________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Psicorientador&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Secretaria</p>';
	        }
	        elseif ($cargo_responsable == "Docente") {
	        	
	        	$tbl .= '<p>________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Docente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma Secretaria</p>';
	        }
	         

	        // Imprimimos el texto con writeHTMLCell()
		    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $tbl, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

		    // ==============================================================================================0
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	        //$nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
	        $nombre_archivo = utf8_decode("Ficha De Matricula ".$nombresest." ".$apellido1est." ".$apellido2est.".pdf");
	        $pdf->Output($nombre_archivo, 'I');


		}
		else{

			echo "<h1>Ficha De Matrícula No Existe.</h1>";
		}



	}


	//******************* FUNCIONES PARA CONSULTAR LA SITUACION ACADEMICA *********************


	public function situacion_academica()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'matriculas/situacion_academica_vista');
	}


	public function llenarcombo_cursosSA(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->matriculas_model->llenar_cursosSA($jornada);
    	echo json_encode($consulta);
    }


    public function mostrarsituacionacademica(){

		$jornada = $this->input->post('jornada'); 
		$id_curso = $this->input->post('id_curso'); 
		
		$data = array(

			'situacion' => $this->matriculas_model->buscar_situacionacademica($jornada,$id_curso),

		    'totalregistros' => count($this->matriculas_model->buscar_situacionacademica($jornada,$id_curso))


		);
	    echo json_encode($data);

	}


	//******************* FUNCIONES PARA RETIRAR ESTUDIANTES *********************


	public function retirar_estudiante()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'matriculas/retirar_estudiante_vista');
	}


	public function llenarcombo_cursosRT(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->matriculas_model->llenar_cursosRT($jornada);
    	echo json_encode($consulta);
    }


    public function llenarcombo_estudiantesRT(){

    	$id_curso = $this->input->post('id_curso');

    	$consulta = $this->matriculas_model->llenar_estudiantesRT($id_curso);
    	echo json_encode($consulta);
    }


    public function insertar_retiro(){

        $this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_estudiante', 'Estudiante', 'required|numeric');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'required|alpha_spaces|min_length[1]|max_length[500]');
        $this->form_validation->set_rules('fecha_retiro', 'Fecha Retiro', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de nivelaciones + 1 
        	$id_retiro = $this->matriculas_model->obtener_ultimo_idretiro();
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
        	$id_estudiante = $this->input->post('id_estudiante');
        	$id_curso = $this->input->post('id_curso');
        	$observaciones = mb_convert_case(mb_strtolower(trim($this->input->post('observaciones'))), MB_CASE_TITLE);
        	$fecha_retiro = $this->input->post('fecha_retiro');
        	$fecha_registro = $this->funciones_globales_model->obtener_fecha_actual2();

        	//array para insertar en la tabla retiros
        	$retiro = array(
        	'id_retiro' =>$id_retiro,	
			'ano_lectivo' =>$ano_lectivo,
			'id_estudiante' =>$id_estudiante,
			'id_curso' =>$id_curso,
			'observaciones' =>$observaciones,
			'fecha_retiro' =>$fecha_retiro,
			'fecha_registro' =>$fecha_registro);

			//array para actualizar el estado del estudiante en la tabla estudiantes
			$estado = array(
			'estado_estudiante' =>"Retirado",
			'fecha_estado' =>$fecha_registro);

			//array para insertar en la tabla historial estados
			$historial = array(
        	'id_persona' =>$id_estudiante,	
			'estado' =>"Retirado",
			'observaciones' =>"Estudiante Retirado.",
			'fecha_estado' =>$fecha_registro,
			'ano_lectivo' =>$ano_lectivo);

			//array para actualizar el estado de la matricula del estudiante
			$estado_matricula = array(
			'estado_matricula' =>"Inactiva");

			
			$respuesta = $this->matriculas_model->insertar_retiro($retiro,$estado,$historial,$estado_matricula,$id_estudiante,$id_curso,$ano_lectivo);

			if($respuesta == true){

				echo "registroguardado";
			}
			else{

				echo "registronoguardado";
			}

        }

	}


	public function mostrarretiros(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'retiros' => $this->matriculas_model->buscar_retiro($id,$inicio,$cantidad),

		    'totalregistros' => count($this->matriculas_model->buscar_retiro($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}



	//******************* FUNCIONES PARA REINGRESAR ESTUDIANTES *********************


	//1). Reingreso Estudiantes - Retirados En Años Anteriores

	public function reingresar_estudiante()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'matriculas/reingresar_estudiante_vista');
	}


	public function mostrarreingresos(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'reingresos' => $this->matriculas_model->buscar_reingreso($id,$inicio,$cantidad),

		    'totalregistros' => count($this->matriculas_model->buscar_reingreso($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function buscar_estudianteRI(){

		$identificacion = $this->input->post('identificacion'); 
       	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
		$consulta = $this->matriculas_model->buscar_estudiante($identificacion);

		if($consulta == false){

			echo "estudiantenoexiste";
		}
		else{

			if ($ano_lectivo !=""){

				if($this->matriculas_model->validar_estado_retirado($identificacion)){

					if($this->matriculas_model->validar_existencia_matriculaRI($identificacion,$ano_lectivo)){

						echo json_encode($consulta);
					}
					else{

						echo "matriculaexiste";
					}	
							
				}
				else{

					echo "estudiantenoretirado";
				}

			}
			else{

				echo "anionoexiste";
			}
			
		}
	    
	}


	public function insertar_reingreso(){

        $this->form_validation->set_rules('id_estudiante', 'Estudiante', 'required|numeric');
        $this->form_validation->set_rules('jornada', 'jornada', 'required|alpha_spaces');
        $this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_acudiente', 'Acudiente', 'required|numeric');
        $this->form_validation->set_rules('parentesco', 'Parentesco', 'required');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'required|alpha_spaces|min_length[1]|max_length[500]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$fecha_actual = $this->funciones_globales_model->obtener_fecha_actual_corta();

        	//obtengo el ultimo id de reingresos + 1 
        	$id_reingreso = $this->matriculas_model->obtener_ultimo_idreingreso();
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
        	$id_estudiante = $this->input->post('id_estudiante');
        	$id_curso = $this->input->post('id_curso');
        	$observaciones = mb_convert_case(mb_strtolower(trim($this->input->post('observaciones'))), MB_CASE_TITLE);
        	$fecha_reingreso = $fecha_actual;
        	$fecha_registro = $this->funciones_globales_model->obtener_fecha_actual2();

        	$id_matricula = $this->matriculas_model->obtener_ultimo_id();
        	//$ano_lectivo
        	$fecha_matricula = $fecha_actual;
        	//$id_estudiante
        	//$id_curso
        	$jornada = $this->input->post('jornada');
        	$id_acudiente = $this->input->post('id_acudiente');
        	$parentesco = $this->input->post('parentesco');
        	$observaciones2 = 'Ninguna';
        	$estado = 'Activo';
        	$situacion_academica = 'No Definida';


        	//array para insertar en la tabla reingresos
        	$reingreso = array(
        	'id_reingreso'    =>$id_reingreso,	
			'ano_lectivo'     =>$ano_lectivo,
			'id_estudiante'   =>$id_estudiante,
			'id_curso' 		  =>$id_curso,
			'observaciones'   =>$observaciones,
			'fecha_reingreso' =>$fecha_reingreso,
			'fecha_registro'  =>$fecha_registro);

			//array para insertar en la tabla matriculas
        	$matricula = array(
        	'id_matricula'        =>$id_matricula,	
			'fecha_matricula'     =>$fecha_actual,
			'ano_lectivo'         =>$ano_lectivo,
			'id_estudiante'       =>$id_estudiante,
			'id_curso'            =>$id_curso,
			'jornada'             =>$jornada,
			'id_acudiente'        =>$id_acudiente,
			'parentesco'          =>$parentesco,
			'observaciones'       =>$observaciones2,
			'estado_matricula' 	  =>$estado,
			'situacion_academica' =>$situacion_academica);

			//array para insertar en la tabla estudiantes_acudientes
			$est_acud = array(
        	'id_estudiante' =>$id_estudiante,	
			'id_acudiente'  =>$id_acudiente,
			'parentesco'    =>$parentesco,
			'ano_lectivo'   =>$ano_lectivo);

			//array para actualizar el estado del estudiante en la tabla estudiantes
			$estado = array(
        	'id_persona'        =>$id_estudiante,	
			'estado_estudiante' =>"Matriculado",
			'fecha_estado'      =>$fecha_actual);

			//array para insertar en la tabla historial estados
			$historial = array(
        	'id_persona'    =>$id_estudiante,	
			'estado'        =>"Matriculado",
			'observaciones' =>"Estudiante Matriculado.",
			'fecha_estado'  =>$fecha_actual,
			'ano_lectivo'   =>$ano_lectivo);

			//array para insertar en la tabla promocion
			$promocion = array(
			'ano_lectivo' 			  =>$ano_lectivo,
        	'id_estudiante'           =>$id_estudiante,
        	'id_curso' 		          =>$id_curso,	
			'asignaturas_reprobadas'  =>"0",
			'areas_reprobadas' 		  =>"0",
			'areas_reprobadas' 		  =>"0",
			'inasistencias' 		  =>"0",
			'porcentaje_inasistencias'=>"0",
			'situacion_academica' 	  =>"No Definida");

			
			if ($this->matriculas_model->validar_existencia_pensum($id_curso,$ano_lectivo)){

				$respuesta = $this->matriculas_model->insertar_reingreso($reingreso,$matricula,$est_acud,$estado,$historial,$promocion,$id_estudiante);

				if($respuesta == true){

					echo "registroguardado";

					$asig_mat = $this->matriculas_model->Matricular_AsignaturasPorEstudiante($ano_lectivo,$id_estudiante,$id_curso);
					
				}
				else{

					echo "registronoguardado";
				}

			}
			else{

				echo "pensumnoexiste";
			}

        }

	}


	//2). Reingreso Estudiantes - Retirados En El Año Actual


	public function buscar_estudianteRI2(){

		$identificacion = $this->input->post('identificacion'); 
       	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		
		$consulta = $this->matriculas_model->buscar_estudiante($identificacion);

		if($consulta == false){

			echo "estudiantenoexiste";
		}
		else{

			if ($ano_lectivo !=""){

				if($this->matriculas_model->validar_estado_retirado($identificacion)){

					if($this->matriculas_model->validar_existencia_matriculaRI2($identificacion,$ano_lectivo)){

						$matricula = $this->matriculas_model->consultar_matricula_estudianteRI2($identificacion,$ano_lectivo);

						echo json_encode($matricula);
					}
					else{

						echo "matriculanoexiste";
					}	
							
				}
				else{

					echo "estudiantenoretirado";
				}

			}
			else{

				echo "anionoexiste";
			}
			
		}
	    
	}


	public function insertar_reingreso2(){

		$this->form_validation->set_rules('id_matricula', 'Matricula', 'required|numeric');
        $this->form_validation->set_rules('id_estudiante', 'Estudiante', 'required|numeric');
        $this->form_validation->set_rules('jornada', 'jornada', 'required|alpha_spaces');
        $this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_acudiente', 'Acudiente', 'required|numeric');
        $this->form_validation->set_rules('parentesco', 'Parentesco', 'required');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'required|alpha_spaces|min_length[1]|max_length[500]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$fecha_actual = $this->funciones_globales_model->obtener_fecha_actual_corta();

        	//obtengo el ultimo id de reingresos + 1 
        	$id_reingreso = $this->matriculas_model->obtener_ultimo_idreingreso();
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
        	$id_estudiante = $this->input->post('id_estudiante');
        	$id_curso = $this->input->post('id_curso');
        	$observaciones = mb_convert_case(mb_strtolower(trim($this->input->post('observaciones'))), MB_CASE_TITLE);
        	$fecha_reingreso = $fecha_actual;
        	$fecha_registro = $this->funciones_globales_model->obtener_fecha_actual2();

        	$id_matricula = $this->input->post('id_matricula');
        	//$ano_lectivo
        	$fecha_matricula = $fecha_actual;
        	//$id_estudiante
        	//$id_curso
        	$jornada = $this->input->post('jornada');
        	$id_acudiente = $this->input->post('id_acudiente');
        	$parentesco = $this->input->post('parentesco');
        	$observaciones2 = 'Ninguna';
        	$estado = 'Activo';
        	$situacion_academica = 'No Definida';


        	//array para insertar en la tabla reingresos
        	$reingreso = array(
        	'id_reingreso'    =>$id_reingreso,	
			'ano_lectivo'     =>$ano_lectivo,
			'id_estudiante'   =>$id_estudiante,
			'id_curso' 		  =>$id_curso,
			'observaciones'   =>$observaciones,
			'fecha_reingreso' =>$fecha_reingreso,
			'fecha_registro'  =>$fecha_registro);

			//array para actualizar en la tabla matriculas
        	$matricula = array(
        	'id_matricula'        =>$id_matricula,	
			'fecha_matricula'     =>$fecha_actual,
			'ano_lectivo'         =>$ano_lectivo,
			'id_estudiante'       =>$id_estudiante,
			'id_curso'            =>$id_curso,
			'jornada'             =>$jornada,
			'id_acudiente'        =>$id_acudiente,
			'parentesco'          =>$parentesco,
			'observaciones'       =>$observaciones2,
			'estado_matricula' 	  =>$estado,
			'situacion_academica' =>$situacion_academica);

			//array para actualizar en la tabla estudiantes_acudientes
			$est_acud = array(
        	'id_estudiante' =>$id_estudiante,	
			'id_acudiente'  =>$id_acudiente,
			'parentesco'    =>$parentesco,
			'ano_lectivo'   =>$ano_lectivo);

			//array para actualizar el estado del estudiante en la tabla estudiantes
			$estado = array(
        	'id_persona'        =>$id_estudiante,	
			'estado_estudiante' =>"Matriculado",
			'fecha_estado'      =>$fecha_actual);

			//array para insertar en la tabla historial estados
			$historial = array(
        	'id_persona'    =>$id_estudiante,	
			'estado'        =>"Matriculado",
			'observaciones' =>"Estudiante Matriculado.",
			'fecha_estado'  =>$fecha_actual,
			'ano_lectivo'   =>$ano_lectivo);

			
			$respuesta = $this->matriculas_model->insertar_reingreso2($reingreso,$matricula,$est_acud,$estado,$historial,$id_matricula,$id_estudiante,$ano_lectivo);

			if($respuesta == true){

				echo "registroguardado";
				
			}
			else{

				echo "registronoguardado";
			}

        }

	}

}