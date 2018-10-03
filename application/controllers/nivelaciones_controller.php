<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nivelaciones_controller extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->model('nivelaciones_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
	
	}


	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'nivelaciones/nivelaciones_vista');
	}


	public function llenarcombo_cursos(){

    	$consulta = $this->nivelaciones_model->llenar_cursos();
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas(){

    	$id_curso =$this->input->post('id_curso');
    	$id_grado = $this->nivelaciones_model->obtener_gradoPorcurso($id_curso);

    	$consulta = $this->nivelaciones_model->llenar_asignaturas($id_grado);
    	echo json_encode($consulta);
    }


    public function llenarcombo_profesores(){

    	$id_curso =$this->input->post('id_curso');
    	$id_asignatura =$this->input->post('id_asignatura');

    	$consulta = $this->nivelaciones_model->llenar_profesores($id_curso,$id_asignatura);
    	echo json_encode($consulta);
    }


    public function llenarcombo_estudiantes(){

    	$id_curso =$this->input->post('id_curso');
    	$id_asignatura =$this->input->post('id_asignatura');
    	$periodo =$this->input->post('periodo');

    	$consulta = $this->nivelaciones_model->llenar_estudiantes($id_curso,$id_asignatura,$periodo);
    	echo json_encode($consulta);
    }


    //Esta funcion me permite por cada estudiante obtener la calificacion de una asignatura en un determinado periodo
	public function buscar_notas_estudiante(){

		$id_estudiante = $this->input->post('id_estudiante');
		$periodo = $this->input->post('periodo');
		$id_curso = $this->input->post('id_curso');
		$id_asignatura = $this->input->post('id_asignatura');

		$id_grado = $this->nivelaciones_model->obtener_gradoPorcurso($id_curso);
		
		$consulta = $this->nivelaciones_model->buscar_notas($id_estudiante,$periodo,$id_grado,$id_asignatura);

		if($consulta==false){
			echo "no";
		}
		else{

			echo json_encode($consulta);	
						
		}
	    
	}


	public function insertar(){

        $this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'Asignatura', 'required|numeric');
        $this->form_validation->set_rules('id_profesor', 'Profesor', 'required|numeric');
        $this->form_validation->set_rules('periodo', 'Periodo', 'required|max_length[8]');
        $this->form_validation->set_rules('id_estudiante', 'Estudiante', 'required|numeric');
        $this->form_validation->set_rules('calificacion', 'Calificacion', 'required|numeric|min_length[3]|max_length[3]');
        $this->form_validation->set_rules('nivelacion', 'Nivelacion', 'required|numeric|min_length[1]|max_length[3]');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'required|alpha_spaces|min_length[1]|max_length[500]');
        $this->form_validation->set_rules('fecha_nivelacion', 'Fecha Nivelacion', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de nivelaciones + 1 
        	$id_nivelacion = $this->nivelaciones_model->obtener_ultimo_id();
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
        	$id_estudiante = $this->input->post('id_estudiante');
        	$id_curso = $this->input->post('id_curso');
        	$id_asignatura = $this->input->post('id_asignatura');
        	$id_profesor = $this->input->post('id_profesor');
        	$periodo = $this->input->post('periodo');
        	$calificacion = $this->input->post('calificacion');
        	$nivelacion = $this->input->post('nivelacion');
        	$observaciones = ucwords(strtolower(trim($this->input->post('observaciones'))));
        	$fecha_nivelacion = $this->input->post('fecha_nivelacion');
        	$fecha_registro = $this->funciones_globales_model->obtener_fecha_actual2();

        	//array para insertar en la tabla nivelaciones----------
        	/*$nivelacion = array(
        	'id_nivelacion' =>$id_nivelacion,	
			'ano_lectivo' =>$ano_lectivo,
			'id_estudiante' =>$id_estudiante,
			'id_curso' =>$id_curso,
			'id_asignatura' =>$id_asignatura,
			'id_profesor' =>$id_profesor,
			'periodo' =>$periodo,
			'nota' =>$calificacion,
			'nivelacion' =>$nivelacion,
			'observaciones' =>$observaciones,
			'fecha_nivelacion' =>$fecha_nivelacion,
			'fecha_registro' =>$fecha_registro);*/

			
			$respuesta = $this->nivelaciones_model->insertar_nivelacion($id_nivelacion,$ano_lectivo,$id_estudiante,$id_curso,$id_asignatura,$id_profesor,$periodo,$calificacion,$nivelacion,$observaciones,$fecha_nivelacion,$fecha_registro);

			if($respuesta == true){

				echo "registroguardado";
			}
			else{

				echo "registronoguardado";
			}

        }

	}


	public function mostrarnivelaciones(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'nivelaciones' => $this->nivelaciones_model->buscar_nivelacion($id,$inicio,$cantidad),

		    'totalregistros' => count($this->nivelaciones_model->buscar_nivelacion($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


}