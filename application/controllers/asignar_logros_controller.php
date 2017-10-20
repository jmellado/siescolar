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


	public function llenarcombo_grados_profesor(){

		$id_profesor = $this->input->post('id_persona');

    	$consulta = $this->asignar_logros_model->llenar_grados_profesor($id_profesor);
    	echo json_encode($consulta);
    }


    public function llenarcombo_grupos_profesor(){

		$id_profesor = $this->input->post('id_persona');
		$id_grado = $this->input->post('id_grado');

    	$consulta = $this->asignar_logros_model->llenar_grupos_profesor($id_profesor,$id_grado);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas_profesor(){

    	$id_profesor = $this->input->post('id_persona');
		$id_grado = $this->input->post('id_grado');
		$id_grupo = $this->input->post('id_grupo');

    	$consulta = $this->asignar_logros_model->llenar_asignaturas_profesor($id_profesor,$id_grado,$id_grupo);
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

		$id_grado = $this->input->post('id_grado');
		$id_grupo =	$this->input->post('id_grupo');

    	$consulta = $this->asignar_logros_model->llenar_estudiantes($id_grado,$id_grupo);
    	echo json_encode($consulta);
    }


	//Est Funcion me permite obtener los logros ingresados por un profesor para una asignatura de un respectivo grado y periodo
	public function mostrarlogros_profesor(){

    	$periodo = $this->input->post('periodo');
    	$id_profesor = $this->input->post('id_persona');
		$id_grado = $this->input->post('id_grado');
		$id_asignatura = $this->input->post('id_asignatura');

    	$data = array(

			'logros' => $this->asignar_logros_model->buscar_logros($periodo,$id_profesor,$id_grado,$id_asignatura)


		);
	    echo json_encode($data);
    }


	public function insertar(){

		
		if($this->input->post('id_persona')!=""){

			$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
			$i=0;

			$id_estudiante = $this->input->post('id_persona');
			$periodo = $this->input->post('periodo');
			$id_grado = $this->input->post('id_grado');
			$id_asignatura = $this->input->post('id_asignatura');
			$id_logro1 = $this->input->post('id_logro')[$i];
			$id_logro2 = $this->input->post('id_logro')[$i+1];
			$id_logro3 = $this->input->post('id_logro')[$i+2];
			$id_logro4 = $this->input->post('id_logro')[$i+3];


			$data = array(

            	'ano_lectivo' => $ano_lectivo,
                'id_estudiante' => $id_estudiante,
                'periodo' => $periodo,
                'id_grado' => $id_grado,
                'id_asignatura' => $id_asignatura,
                'id_logro1' => $id_logro1,
                'id_logro2' => $id_logro2,
                'id_logro3' => $id_logro3,
                'id_logro4' => $id_logro4
                
            );

			$estado = $this->asignar_logros_model->validar_existencia($ano_lectivo,$id_estudiante,$periodo,$id_grado,$id_asignatura);

			if($estado){

				$respuesta = $this->asignar_logros_model->insertar_logros($data);

	            if($respuesta == false){
					echo "error al ingresar logros";
				}
			}
			else{
				
				$respuesta = $this->asignar_logros_model->modificar_logros($data,$ano_lectivo,$id_estudiante,$periodo,$id_grado,$id_asignatura);

	            if($respuesta == false){
					echo "error al modificar logros";
				}

			}


			if($respuesta == true){

	        	echo "registroguardado";
	        }
	        else{
	        	echo "registronoguardado";
	        }

	    }else{

	    	echo "No Hay Informacion Por Registrar";
	    }

	}

	//Esta funcion me permite por cada estudiante obtener la calificacion de una asignatura en un determinado periodo
	public function buscar_notas_estudiante(){

		$id_estudiante = $this->input->post('id_estudiante');
		$periodo = $this->input->post('periodo');
		$id_grado = $this->input->post('id_grado');
		$id_asignatura = $this->input->post('id_asignatura');
		
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
		$id_grado = $this->input->post('id_grado');
		$id_asignatura = $this->input->post('id_asignatura');
		
		$consulta = $this->asignar_logros_model->buscar_logros_asignados($id_estudiante,$periodo,$id_grado,$id_asignatura);

		if($consulta==false){
			echo "no";
		}
		else{

			echo json_encode($consulta);	
						
		}
	    
	}


	

}