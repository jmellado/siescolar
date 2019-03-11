<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nivelaciones_finales_controller extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->model('nivelaciones_finales_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
	
	}


	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'nivelaciones_finales/nivelaciones_finales_vista');
	}


	public function llenarcombo_anos_lectivos(){

    	$consulta = $this->nivelaciones_finales_model->llenar_anos_lectivos();
    	echo json_encode($consulta);
    }


	public function llenarcombo_cursos(){

		$ano_lectivo =$this->input->post('ano_lectivo');

    	$consulta = $this->nivelaciones_finales_model->llenar_cursos($ano_lectivo);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas(){

    	$id_curso =$this->input->post('id_curso');
    	$id_grado = $this->nivelaciones_finales_model->obtener_gradoPorcurso($id_curso);
    	$ano_lectivo =$this->input->post('ano_lectivo');

    	$consulta = $this->nivelaciones_finales_model->llenar_asignaturas($id_grado,$ano_lectivo);
    	echo json_encode($consulta);
    }


    public function llenarcombo_profesores(){

    	$id_curso =$this->input->post('id_curso');
    	$id_asignatura =$this->input->post('id_asignatura');
    	$ano_lectivo =$this->input->post('ano_lectivo');

    	$consulta = $this->nivelaciones_finales_model->llenar_profesores($id_curso,$id_asignatura,$ano_lectivo);
    	echo json_encode($consulta);
    }


    public function llenarcombo_estudiantes(){

    	$id_curso =$this->input->post('id_curso');
    	$id_asignatura =$this->input->post('id_asignatura');
    	$ano_lectivo =$this->input->post('ano_lectivo');

    	$consulta = $this->nivelaciones_finales_model->llenar_estudiantes($id_curso,$id_asignatura,$ano_lectivo);
    	echo json_encode($consulta);
    }


    //Esta funcion me permite por cada estudiante obtener la calificacion definitiva de una asignatura 
	public function buscar_notas_estudiante(){

		$id_estudiante = $this->input->post('id_estudiante');
		$id_curso = $this->input->post('id_curso');
		$id_asignatura = $this->input->post('id_asignatura');
		$ano_lectivo =$this->input->post('ano_lectivo');

		$id_grado = $this->nivelaciones_finales_model->obtener_gradoPorcurso($id_curso);
		
		$consulta = $this->nivelaciones_finales_model->buscar_notas($id_estudiante,$id_grado,$id_asignatura,$ano_lectivo);

		if($consulta==false){
			echo "no";
		}
		else{

			echo json_encode($consulta);	
						
		}
	    
	}


	public function insertar(){

		$this->form_validation->set_rules('ano_lectivo', 'Año Lectivo', 'required|numeric');
        $this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'Asignatura', 'required|numeric');
        $this->form_validation->set_rules('id_profesor', 'Profesor', 'required|numeric');
        $this->form_validation->set_rules('id_estudiante', 'Estudiante', 'required|numeric');
        $this->form_validation->set_rules('calificacion', 'Calificacion', 'required|numeric');
        $this->form_validation->set_rules('nivelacion', 'Nivelacion', 'required|numeric');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'required|alpha_spaces|min_length[1]|max_length[500]');
        $this->form_validation->set_rules('fecha_nivelacion', 'Fecha Nivelacion', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de nivelaciones_finales + 1 
        	$id_nivelacion_final = $this->nivelaciones_finales_model->obtener_ultimo_id();
        	$ano_lectivo = $this->input->post('ano_lectivo');
        	$id_estudiante = $this->input->post('id_estudiante');
        	$id_curso = $this->input->post('id_curso');
        	$id_asignatura = $this->input->post('id_asignatura');
        	$id_profesor = $this->input->post('id_profesor');
        	$periodo = $this->input->post('periodo');
        	$calificacion = $this->input->post('calificacion');
        	$nivelacion = $this->input->post('nivelacion');
        	$observaciones = mb_convert_case(mb_strtolower(trim($this->input->post('observaciones'))), MB_CASE_TITLE);
        	$fecha_nivelacion = $this->input->post('fecha_nivelacion');
        	$fecha_registro = $this->funciones_globales_model->obtener_fecha_actual2();

        	if ($this->nivelaciones_finales_model->validar_situacion_academica($ano_lectivo,$id_estudiante,$id_curso)){

	        	if ($this->nivelaciones_finales_model->validar_nivelacion($ano_lectivo,$nivelacion)){

					$respuesta = $this->nivelaciones_finales_model->insertar_nivelacion($id_nivelacion_final,$ano_lectivo,$id_estudiante,$id_curso,$id_asignatura,$id_profesor,$calificacion,$nivelacion,$observaciones,$fecha_nivelacion,$fecha_registro);

					if($respuesta == true){

						echo "registroguardado";
					}
					else{

						echo "registronoguardado";
					}
				}
				else{

					echo "nivelacionincorrecta";
				}

			}
			else{

				echo "situacionnodefinida";
			}

        }

	}


	public function mostrarnivelaciones(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'nivelaciones' => $this->nivelaciones_finales_model->buscar_nivelacion($id,$inicio,$cantidad),

		    'totalregistros' => count($this->nivelaciones_finales_model->buscar_nivelacion($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


}