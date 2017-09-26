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


    public function llenarcombo_logros(){

    	$periodo = $this->input->post('periodo');
    	$id_profesor = $this->input->post('id_persona');
		$id_grado = $this->input->post('id_grado');
		$id_asignatura = $this->input->post('id_asignatura');

    	$consulta = $this->asignar_logros_model->llenar_logros($periodo,$id_profesor,$id_grado,$id_asignatura);
    	echo json_encode($consulta);
    }

}