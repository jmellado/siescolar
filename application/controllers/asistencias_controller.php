<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asistencias_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('asistencias_model');
		$this->load->library('form_validation');
		$this->load->model('funciones_globales_model');
	}


	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_profesor_vista', 'asistencias/registrar_asistencias_vista');
	}


	public function consultar()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_profesor_vista', 'asistencias/consultar_asistencias_vista');
	}


	public function llenarcombo_cursos_profesor(){

		$id_profesor = $this->input->post('id_persona');

    	$consulta = $this->asistencias_model->llenar_cursos_profesor($id_profesor);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas_profesor(){

    	$id_profesor = $this->input->post('id_persona');
		$id_curso = $this->input->post('id_curso');

    	$consulta = $this->asistencias_model->llenar_asignaturas_profesor($id_profesor,$id_curso);
    	echo json_encode($consulta);
    }


    public function mostrarestudiantes(){
 
		$id_curso = $this->input->post('id_curso');
		
		$data = array(

			'estudiantes' => $this->asistencias_model->buscar_estudiantes_matriculados_curso($id_curso),

		    'totalregistros' => count($this->asistencias_model->buscar_estudiantes_matriculados_curso($id_curso))


		);
	    echo json_encode($data);

	}


	public function insertar_asistencias(){

		$ano_lectivo = $this->funciones_globales_model->obtener_anio_actual();
		$id_profesor = $this->input->post('id_profesor');
		$id_curso = $this->input->post('id_curso');
		$id_asignatura = $this->input->post('id_asignatura');
		$estudiantes = $this->input->post('id_estudiante');
		$periodo = $this->input->post('periodo');
		$fecha = $this->input->post('fecha');
		$asistencias = $this->input->post('asistencia');
		$fecha_registro = $this->funciones_globales_model->obtener_fecha_actual2();

		if($estudiantes !=""){

			if ($this->asistencias_model->validar_existencia($id_profesor,$id_curso,$id_asignatura,$periodo,$fecha)){

				$respuesta = $this->asistencias_model->insertar_asistencia($ano_lectivo,$id_profesor,$id_curso,$id_asignatura,$estudiantes,$periodo,$fecha,$asistencias,$fecha_registro);

				if($respuesta == true){

		        	echo "registroguardado";
		        }
		        else{

		        	echo "registronoguardado";
		        }
		    }
		    else{

		    	echo "asistenciayaexiste";
		    }

	    }else{

	    	echo "nohayestudiantes";
	    }

	}


    public function mostrarasistencias(){

		$id_profesor = $this->input->post('id_profesor'); 
		$id_curso = $this->input->post('id_curso');
		$id_asignatura = $this->input->post('id_asignatura');
		$periodo = $this->input->post('periodo');
		$fecha = $this->input->post('fecha');  
		
		$data = array(

			'asistencias' => $this->asistencias_model->buscar_asistencia($id_profesor,$id_curso,$id_asignatura,$periodo,$fecha),

		    'totalregistros' => count($this->asistencias_model->buscar_asistencia($id_profesor,$id_curso,$id_asignatura,$periodo,$fecha))


		);
	    echo json_encode($data);

	}



}