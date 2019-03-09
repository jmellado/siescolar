<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignar_logros_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('asignar_logros_model');
		$this->load->model('funciones_globales_model');
		$this->load->model('grados_model');
		$this->load->model('asignaturas_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'asignar_logros/asignar_logros_vista');
	}


	public function index_profesor()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_profesor_vista', 'asignar_logros/asignar_logrosprofesor_vista');
	}


	public function buscar_profesor(){

		$id = $this->input->post('id'); 
		
		$consulta = $this->asignar_logros_model->buscar_profesor($id);

		if($consulta==false){
			echo "profesornoexiste";
		}
		else{

			echo json_encode($consulta);	
						
		}
	    
	}


	public function llenarcombo_cursos_profesor(){

		$id_profesor = $this->input->post('id_persona');

    	$consulta = $this->asignar_logros_model->llenar_cursos_profesor($id_profesor);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas_profesor(){

    	$id_profesor = $this->input->post('id_persona');
		$id_curso = $this->input->post('id_curso');

    	$consulta = $this->asignar_logros_model->llenar_asignaturas_profesor($id_profesor,$id_curso);
    	echo json_encode($consulta);
    }


    public function validar_fechaIngresoLogros(){

    	$periodo = $this->input->post('periodo');
		$fecha_actual = $this->input->post('fecha_actual');

		$consulta = $this->asignar_logros_model->validar_fechaIngresoLogros($periodo,$fecha_actual);

		if($consulta){

			echo "si";
			
		}
		else{
			echo "no";
		}

    }


    //Esta Funcion me permite obtener los estudiantes matriculados en un respectivo curso(id_grado y id_grupo)
    public function llenarcombo_estudiantes(){

		$id_curso = $this->input->post('id_curso');

    	$consulta = $this->asignar_logros_model->llenar_estudiantes($id_curso);
    	echo json_encode($consulta);
    }


	//Est Funcion me permite obtener los logros ingresados por un profesor para una asignatura de un respectivo grado y periodo
	public function mostrarlogros_profesor(){

    	$periodo = $this->input->post('periodo');
    	$id_profesor = $this->input->post('id_persona');
		$id_curso = $this->input->post('id_curso');
		$id_asignatura = $this->input->post('id_asignatura');

		$id_grado = $this->asignar_logros_model->obtener_id_grado($id_curso);

    	$data = array(

			'logros' => $this->asignar_logros_model->buscar_logros($periodo,$id_profesor,$id_grado,$id_asignatura)


		);
	    echo json_encode($data);
    }


	public function insertar(){

		$this->form_validation->set_rules('periodo', 'Periodo', 'required|max_length[8]');
		$this->form_validation->set_rules('id_curso', 'Curso', 'required|numeric');
        $this->form_validation->set_rules('id_asignatura', 'Asignatura', 'required|numeric');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

			$i=0;

			$id_estudiante = $this->input->post('id_persona');
			$periodo = $this->input->post('periodo');
			$id_curso = $this->input->post('id_curso');
			$id_grado = $this->asignar_logros_model->obtener_id_grado($id_curso);
			$id_asignatura = $this->input->post('id_asignatura');
			$id_logro = $this->input->post('id_logro');

			$id_logro1 = $id_logro[$i];
			$id_logro2 = $id_logro[$i+1];
			$id_logro3 = $id_logro[$i+2];
			$id_logro4 = $id_logro[$i+3];
			$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();

			if($id_logro != ""){


				$data = array(
	        	'ano_lectivo'   => $ano_lectivo,
	            'id_estudiante' => $id_estudiante,
	            'periodo'       => $periodo,
	            'id_grado'      => $id_grado,
	            'id_asignatura' => $id_asignatura,
	            'id_logro1'     => $id_logro1,
	            'id_logro2'     => $id_logro2,
	            'id_logro3'     => $id_logro3,
	            'id_logro4'     => $id_logro4);

				$estado = $this->asignar_logros_model->validar_existencia($ano_lectivo,$id_estudiante,$periodo,$id_grado,$id_asignatura);

				if($estado){

					$respuesta = $this->asignar_logros_model->insertar_logros($data);

		            if($respuesta == true){

			        	echo "registroguardado";
			        }
			        else{
			        	
			        	echo "registronoguardado";
			        }

				}
				else{
					
					$respuesta = $this->asignar_logros_model->modificar_logros($data,$ano_lectivo,$id_estudiante,$periodo,$id_grado,$id_asignatura);

		            if($respuesta == true){

			        	echo "registroguardado";
			        }
			        else{
			        	
			        	echo "registronoguardado";
			        }

				}


		    }else{

		    	echo "nohayinformacion";
		    }

		}

	}

	//Esta funcion me permite por cada estudiante obtener la calificacion de una asignatura en un determinado periodo
	public function buscar_notas_estudiante(){

		$id_estudiante = $this->input->post('id_estudiante');
		$periodo = $this->input->post('periodo');
		$id_curso = $this->input->post('id_curso');
		$id_asignatura = $this->input->post('id_asignatura');

		$id_grado = $this->asignar_logros_model->obtener_id_grado($id_curso);
		
		$consulta = $this->asignar_logros_model->buscar_notas($id_estudiante,$periodo,$id_grado,$id_asignatura);

		if($consulta==false){
			echo "no";
		}
		else{

			echo json_encode($consulta);	
						
		}
	    
	}

	//Esta funcion me permite por cada estudiante seleccionado, los logros asignados para una determinada asignatura
	public function buscar_logros_asignados(){

		$id_estudiante = $this->input->post('id_estudiante');
		$periodo = $this->input->post('periodo');
		$id_curso = $this->input->post('id_curso');
		$id_asignatura = $this->input->post('id_asignatura');

		$id_grado = $this->asignar_logros_model->obtener_id_grado($id_curso);
		
		$consulta = $this->asignar_logros_model->buscar_logros_asignados($id_estudiante,$periodo,$id_grado,$id_asignatura);

		if($consulta==false){
			echo "no";
		}
		else{

			echo json_encode($consulta);	
						
		}
	    
	}


	

}