<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividades_controller extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('actividades_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}


	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		//$this->load->view('estudiantes/registrar2');
		$this->template->load('roles/rol_profesor_vista', 'actividades/actividades_vista');
	}


	public function insertar(){

        $this->form_validation->set_rules('id_profesor', 'Profesor', 'required|numeric');
        $this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'Asignatura', 'required|numeric');
        $this->form_validation->set_rules('periodo', 'Periodo', 'required');
        $this->form_validation->set_rules('descripcion_actividad', 'Descripcion Actividad', 'required|alpha_spaces|min_length[1]|max_length[300]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de actividades + 1 
        	$ultimo_id = $this->actividades_model->obtener_ultimo_id();

        	//obtengo el año actual 
        	$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

        	$fecha = $this->actividades_model->obtener_fecha_actual();

        	$id_actividad = $ultimo_id;
        	$descripcion_actividad = ucwords(mb_strtolower(trim($this->input->post('descripcion_actividad'))));
        	$id_profesor = $this->input->post('id_profesor');
        	$id_curso = $this->input->post('id_curso');
        	$id_asignatura = $this->input->post('id_asignatura');
        	$periodo = $this->input->post('periodo');
        	$fecha_registro = $fecha;

        	//array para insertar en la tabla seguimientos disciplinarios
        	$actividad = array(
        	'id_actividad' =>$id_actividad,
        	'descripcion_actividad' =>$descripcion_actividad,
        	'id_profesor' =>$id_profesor,
        	'id_curso' =>$id_curso,
        	'id_asignatura' =>$id_asignatura,
        	'periodo' =>$periodo,	
			'fecha_registro' =>$fecha_registro,
			'ano_lectivo' =>$ano_lectivo);

			
			$respuesta = $this->actividades_model->insertar_actividad($actividad);

			if($respuesta == true){

				echo "registroguardado";

				//======================== Asociamos Estudiantes A La Actividad Creada ====================
				$resp = $this->actividades_model->insertar_estudiantesPoractividad($id_actividad,$id_curso);

				if($resp == false){
					echo "No Se Pudo Registrar En La Tabla Notas Actividad";
				}
				//=========================================================================================

			}
			else{

				echo "registronoguardado";
			}


        }

	}


	public function mostraractividades(){

		$id =$this->input->post('id_buscar');
		$id_profesor = $this->input->post('id_persona'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'actividades' => $this->actividades_model->buscar_actividad($id,$id_profesor,$inicio,$cantidad),

		    'totalregistros' => count($this->actividades_model->buscar_actividad($id,$id_profesor)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function eliminar(){

	  	$id_actividad =$this->input->post('id'); 

        if(is_numeric($id_actividad)){

	        $respuesta = $this->actividades_model->eliminar_actividad($id_actividad);
	        
          	if($respuesta==true){
              
              	echo "Actividad Eliminada Correctamente.";
          	}else{
              
              	echo "No Se Pudo Eliminar.";
          	}
	      
        }else{
          
          	echo "digite valor numerico para identificar una actividad.";
        }
    }


    public function modificar(){

        $this->form_validation->set_rules('id_actividad', 'Id Actividad', 'required|numeric');
        $this->form_validation->set_rules('descripcion_actividad', 'Descripcion Actividad', 'required|alpha_spaces|min_length[1]|max_length[300]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$descripcion_actividad = ucwords(mb_strtolower(trim($this->input->post('descripcion_actividad'))));
        	$id_actividad = $this->input->post('id_actividad');

        	//array para insertar en la tabla seguimientos disciplinarios
        	$actividad = array(
        	'id_actividad' =>$id_actividad,
        	'descripcion_actividad' =>$descripcion_actividad);

			
			$respuesta = $this->actividades_model->modificar_actividad($id_actividad,$actividad);

			if($respuesta == true){

				echo "registroactualizado";
			}
			else{

				echo "registronoactualizado";
			}


        }

	}


	public function llenarcombo_cursos_profesor(){

		$id_profesor = $this->input->post('id_persona');

    	$consulta = $this->actividades_model->llenar_cursos_profesor($id_profesor);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas_profesor(){

    	$id_profesor = $this->input->post('id_persona');
		$id_curso = $this->input->post('id_curso');

    	$consulta = $this->actividades_model->llenar_asignaturas_profesor($id_profesor,$id_curso);
    	echo json_encode($consulta);
    }


    //===================== Funciones Para La Calificacion De Actividades =======================


    public function calificar_actividades()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		//$this->load->view('estudiantes/registrar2');
		$this->template->load('roles/rol_profesor_vista', 'actividades/calificar_actividades_vista');
	}


	public function mostraractividadesCA(){

		$id =$this->input->post('id_buscar');
		$id_profesor = $this->input->post('id_persona');
		$periodo = $this->input->post('periodo'); 
		$id_curso = $this->input->post('id_curso'); 
		$id_asignatura = $this->input->post('id_asignatura'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'actividades' => $this->actividades_model->buscar_actividadCA($id,$id_profesor,$periodo,$id_curso,$id_asignatura,$inicio,$cantidad),

		    'totalregistros' => count($this->actividades_model->buscar_actividadCA($id,$id_profesor,$periodo,$id_curso,$id_asignatura)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function mostrarnotasactividad(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;

		$id_curso = $this->input->post('id_curso');
		$id_actividad = $this->input->post('id_actividad');
		
		$data = array(

			'notas' => $this->actividades_model->buscar_nota($id,$id_curso,$id_actividad,$inicio,$cantidad),

		    'totalregistros' => count($this->actividades_model->buscar_nota($id,$id_curso,$id_actividad)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function insertar_notas(){


		if($this->input->post('id_persona')!=""){

			$fecha_registro = $this->actividades_model->obtener_fecha_actual();
			$estudiantes = $this->input->post('id_persona');
			$id_actividad = $this->input->post('id_actividad');
			$notas = $this->input->post('nota');

			$respuesta = $this->actividades_model->modificar_nota($estudiantes,$id_actividad,$notas,$fecha_registro);

			if($respuesta == true){

	        	echo "registroguardado";

	        	//*Enviar Notificacion Via Firebase A Los Acudientes Conectados En La App Movil *
                $respuesta_firebase = $this->actividades_model->enviar_notificacionFirebase($estudiantes,$id_actividad,$notas);
	        }
	        else{
	        	echo "registronoguardado";
	        }

	    }else{

	    	echo "nohayestudiantes";
	    }

	}


	//===================== Funciones Para La Consulta De Notas =======================


    public function consultar_notas()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_profesor_vista', 'actividades/consultar_notas_vista');
	}


	public function mostrarnotasasignatura(){

		$id =$this->input->post('id_buscar');
		$id_profesor = $this->input->post('id_persona');
		$periodo = $this->input->post('periodo'); 
		$id_curso = $this->input->post('id_curso'); 
		$id_asignatura = $this->input->post('id_asignatura'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'notas' => $this->actividades_model->buscar_notafinal($id,$id_profesor,$periodo,$id_curso,$id_asignatura,$inicio,$cantidad),

		    'totalregistros' => count($this->actividades_model->buscar_notafinal($id,$id_profesor,$periodo,$id_curso,$id_asignatura)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	// Esta funcion me permite obtener las notas por actividades de un estudiante en una asignatura
	public function mostrarnotasactividades(){

		$id =$this->input->post('id_buscar');
		$id_estudiante = $this->input->post('id_estudiante');
		$periodo = $this->input->post('periodo'); 
		$id_curso = $this->input->post('id_curso'); 
		$id_asignatura = $this->input->post('id_asignatura'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'notas' => $this->actividades_model->buscar_notasactividades($id,$id_estudiante,$periodo,$id_curso,$id_asignatura,$inicio,$cantidad),

		    'totalregistros' => count($this->actividades_model->buscar_notasactividades($id,$id_estudiante,$periodo,$id_curso,$id_asignatura)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}




}