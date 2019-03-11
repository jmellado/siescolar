<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seguimientos_disciplinarios_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('seguimientos_disciplinarios_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_profesor_vista', 'seguimientos_disciplinarios/registrar_seguimiento_vista');
	}


	public function index2()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_profesor_vista', 'seguimientos_disciplinarios/consultar_seguimiento_vista');
	}


	public function llenarcombo_cursos_profesor(){

		$id_profesor = $this->input->post('id_persona');

    	$consulta = $this->seguimientos_disciplinarios_model->llenar_cursos_profesor($id_profesor);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas_profesor(){

    	$id_profesor = $this->input->post('id_persona');
		$id_curso = $this->input->post('id_curso');

    	$consulta = $this->seguimientos_disciplinarios_model->llenar_asignaturas_profesor($id_profesor,$id_curso);
    	echo json_encode($consulta);
    }


    public function llenarcombo_estudiantes(){

		$id_curso = $this->input->post('id_curso');

    	$consulta = $this->seguimientos_disciplinarios_model->EstudiantesMatriculadosPorCurso($id_curso);
    	echo json_encode($consulta);
    }


    public function llenarcombo_tipos_causales(){

    	$consulta = $this->seguimientos_disciplinarios_model->llenar_tipos_causales();
    	echo json_encode($consulta);
    }


    public function llenarcombo_causales(){

		$id_tipo_causal = $this->input->post('id_tipo_causal');

    	$consulta = $this->seguimientos_disciplinarios_model->llenar_causales($id_tipo_causal);
    	echo json_encode($consulta);
    }


    public function llenarcombo_acciones_pedagogicas(){

    	$consulta = $this->seguimientos_disciplinarios_model->llenar_acciones_pedagogicas();
    	echo json_encode($consulta);
    }


    public function insertar(){

        $this->form_validation->set_rules('id_profesor', 'Profesor', 'required|numeric');
        $this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'Asignatura', 'required|numeric');
        $this->form_validation->set_rules('id_estudiante', 'Estudiante', 'required|numeric');
        $this->form_validation->set_rules('id_tipo_causal', 'Tipo Causal', 'required|numeric');
        $this->form_validation->set_rules('id_causal', 'Causal', 'required|numeric');
        $this->form_validation->set_rules('fecha_causal', 'Fecha Causal', 'required');
        $this->form_validation->set_rules('descripcion_situacion', 'Descripcion Situacion', 'required|alpha_spaces|min_length[1]|max_length[500]');
        $this->form_validation->set_rules('id_accion_pedagogica', 'Accion Pedagogica', 'required|numeric');
        $this->form_validation->set_rules('descripcion_accion', 'Descripcion Accion Pedagogica', 'required|alpha_spaces|min_length[1]|max_length[500]');
        $this->form_validation->set_rules('compromiso_estudiante', 'Compromiso Estudiante', 'required|alpha_spaces|min_length[1]|max_length[500]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de seguimientos + 1 
        	$ultimo_id = $this->seguimientos_disciplinarios_model->obtener_ultimo_id();

        	//obtengo el año actual 
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

        	$fecha = $this->seguimientos_disciplinarios_model->obtener_fecha_actual();

        	$id_profesor = $this->input->post('id_profesor');
        	$id_curso = $this->input->post('id_curso');
        	$id_asignatura = $this->input->post('id_asignatura');
        	$id_estudiante = $this->input->post('id_estudiante');
        	$id_tipo_causal = $this->input->post('id_tipo_causal');
        	$id_causal = $this->input->post('id_causal');
        	$descripcion_situacion = mb_convert_case(mb_strtolower(trim($this->input->post('descripcion_situacion'))), MB_CASE_TITLE);
        	$fecha_causal = $this->input->post('fecha_causal');
        	$fecha_registro = $fecha;
        	$id_accion_pedagogica = $this->input->post('id_accion_pedagogica');
        	$descripcion_accion_pedagogica = mb_convert_case(mb_strtolower(trim($this->input->post('descripcion_accion'))), MB_CASE_TITLE);
        	$compromiso_estudiante = mb_convert_case(mb_strtolower(trim($this->input->post('compromiso_estudiante'))), MB_CASE_TITLE);
        	$observaciones = "";
        	$estado_seguimiento = "Abierto";

        	//array para insertar en la tabla seguimientos disciplinarios
        	$seguimiento = array(
        	'id_seguimiento' =>$ultimo_id,
        	'ano_lectivo' =>$ano_lectivo,
        	'id_profesor' =>$id_profesor,
        	'id_curso' =>$id_curso,
        	'id_asignatura' =>$id_asignatura,
        	'id_estudiante' =>$id_estudiante,
        	'id_tipo_causal' =>$id_tipo_causal,
        	'id_causal' =>$id_causal,
        	'descripcion_situacion' =>$descripcion_situacion,
        	'fecha_causal' =>$fecha_causal,
        	'id_accion_pedagogica' =>$id_accion_pedagogica,
        	'descripcion_accion_pedagogica' =>$descripcion_accion_pedagogica,
        	'compromiso_estudiante' =>$compromiso_estudiante,
        	'observaciones' =>$observaciones,
        	'estado_seguimiento' =>$estado_seguimiento,
			'fecha_registro' =>$fecha_registro);

			
			$respuesta = $this->seguimientos_disciplinarios_model->insertar_seguimiento($seguimiento);

			if($respuesta == true){

				echo "registroguardado";

				//*Enviar Notificacion Via Firebase A Los Acudientes Conectados En La App Movil *
                $respuesta_firebase = $this->seguimientos_disciplinarios_model->enviar_notificacionFirebase($id_estudiante);
                
			}
			else{

				echo "registronoguardado";
			}


        }

	}


	public function mostrarseguimientos(){

		$id =$this->input->post('id_buscar');
		$id_profesor = $this->input->post('id_persona'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'seguimientos' => $this->seguimientos_disciplinarios_model->buscar_seguimiento($id,$id_profesor,$inicio,$cantidad),

		    'totalregistros' => count($this->seguimientos_disciplinarios_model->buscar_seguimiento($id,$id_profesor)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function modificar(){

		$this->form_validation->set_rules('id_seguimiento', 'Id Seguimiento', 'required|numeric');
		$this->form_validation->set_rules('id_tipo_causal', 'Tipo Causal', 'required|numeric');
        $this->form_validation->set_rules('id_causal', 'Causal', 'required|numeric');
        $this->form_validation->set_rules('fecha_causal', 'Fecha Causal', 'required');
        $this->form_validation->set_rules('descripcion_situacion', 'Descripcion Situacion', 'required|alpha_spaces|min_length[1]|max_length[500]');
        $this->form_validation->set_rules('id_accion_pedagogica', 'Accion Pedagogica', 'required|numeric');
        $this->form_validation->set_rules('descripcion_accion', 'Descripcion Accion Pedagogica', 'required|alpha_spaces|min_length[1]|max_length[500]');
        $this->form_validation->set_rules('compromiso_estudiante', 'Compromiso Estudiante', 'required|alpha_spaces|min_length[1]|max_length[500]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

	    	$id_seguimiento = $this->input->post('id_seguimiento');
	    	$id_tipo_causal = $this->input->post('id_tipo_causal');
	        $id_causal = $this->input->post('id_causal');
	        $descripcion_situacion = mb_convert_case(mb_strtolower(trim($this->input->post('descripcion_situacion'))), MB_CASE_TITLE);
	        $fecha_causal = $this->input->post('fecha_causal');
	        $id_accion_pedagogica = $this->input->post('id_accion_pedagogica');
        	$descripcion_accion_pedagogica = mb_convert_case(mb_strtolower(trim($this->input->post('descripcion_accion'))), MB_CASE_TITLE);
        	$compromiso_estudiante = mb_convert_case(mb_strtolower(trim($this->input->post('compromiso_estudiante'))), MB_CASE_TITLE);
        	$observaciones = mb_convert_case(mb_strtolower(trim($this->input->post('observaciones'))), MB_CASE_TITLE);

	    	//array para actualizar en la tabla seguimientos disciplinarios
	    	$seguimiento = array(
	    	'id_seguimiento' =>$id_seguimiento,
	    	'id_tipo_causal' =>$id_tipo_causal,
	    	'id_causal' =>$id_causal,
	    	'descripcion_situacion' =>$descripcion_situacion,
	    	'fecha_causal' =>$fecha_causal,
	    	'id_accion_pedagogica' =>$id_accion_pedagogica,
        	'descripcion_accion_pedagogica' =>$descripcion_accion_pedagogica,
        	'compromiso_estudiante' =>$compromiso_estudiante,
        	'observaciones' =>$observaciones);

	        if(is_numeric($id_seguimiento)){

	        	if ($this->seguimientos_disciplinarios_model->validar_estadoseguimiento($id_seguimiento)) {

		        	$respuesta = $this->seguimientos_disciplinarios_model->modificar_seguimiento($id_seguimiento,$seguimiento);

					if($respuesta==true){

						echo "registroactualizado";

					}else{

						echo "registronoactualizado";

					}
				}
				else{
					echo "seguimientoyacerrado";
				}
			                
	        }else{
	            
	            echo "digite valor numerico para identificar un seguimiento";
	        }
	        
	    }

    }


    public function cerrar_seguimiento_disciplinario(){

		$id_seguimiento = $this->input->post('id_seguimiento');

		if ($this->seguimientos_disciplinarios_model->validar_estadoseguimiento($id_seguimiento)) {
			
	    	$respuesta = $this->seguimientos_disciplinarios_model->cerrar_seguimiento($id_seguimiento);

	    	if($respuesta==true){

				echo "seguimientocerrado";

			}else{

				echo "seguimientonocerrado";

			}

		}
		else{

			echo "seguimientoyacerrado";
		}
    	
    }


}