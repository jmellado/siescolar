<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consultas_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('consultas_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}


	//===== Funciones para consultar las notas de un estudiante desde el rol acudiente =====

	public function consultar_notasA()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'acudiente')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_acudiente_vista', 'consultas/consultar_notasA_vista');
	}


	public function llenarcombo_acudidos(){

		$id_acudiente =$this->input->post('id_acudiente');

    	$consulta = $this->consultas_model->llenar_acudidos($id_acudiente);
    	echo json_encode($consulta);
    }


    //Esta funcion permite obtener las asignaturas cursadas por un estudiante
    public function mostrarasignaturasNA(){

		$periodo = $this->input->post('periodo');
		$id_estudiante = $this->input->post('id_acudido'); 
		
		$data = array(

			'asignaturas' => $this->consultas_model->buscar_asignaturaNA($id_estudiante),

		    'totalregistros' => count($this->consultas_model->buscar_asignaturaNA($id_estudiante))


		);
	    echo json_encode($data);


	}


	// Esta funcion me permite obtener las notas por actividades de un estudiante en una asignatura
	public function mostraractividadesNA(){

		$id_estudiante = $this->input->post('id_estudiante');
		$periodo = $this->input->post('periodo'); 
		$id_curso = $this->input->post('id_curso'); 
		$id_asignatura = $this->input->post('id_asignatura'); 
		
		$data = array(

			'notas' => $this->consultas_model->buscar_actividadesNA($id_estudiante,$periodo,$id_curso,$id_asignatura),

		    'totalregistros' => count($this->consultas_model->buscar_actividadesNA($id_estudiante,$periodo,$id_curso,$id_asignatura))


		);
	    echo json_encode($data);


	}


	//===== Funciones para consultar las notas de un estudiante desde el rol estudiante =====


	public function consultar_notasE()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'estudiante')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_estudiante_vista', 'consultas/consultar_notasE_vista');
	}


	//Esta funcion permite obtener las asignaturas cursadas por un estudiante
    public function mostrarasignaturasNE(){

		$periodo = $this->input->post('periodo');
		$id_estudiante = $this->input->post('id_estudiante'); 
		
		$data = array(

			'asignaturas' => $this->consultas_model->buscar_asignaturaNE($id_estudiante),

		    'totalregistros' => count($this->consultas_model->buscar_asignaturaNE($id_estudiante))


		);
	    echo json_encode($data);


	}


	// Esta funcion me permite obtener las notas por actividades de un estudiante en una asignatura
	public function mostraractividadesNE(){

		$id_estudiante = $this->input->post('id_estudiante');
		$periodo = $this->input->post('periodo'); 
		$id_curso = $this->input->post('id_curso'); 
		$id_asignatura = $this->input->post('id_asignatura'); 
		
		$data = array(

			'notas' => $this->consultas_model->buscar_actividadesNE($id_estudiante,$periodo,$id_curso,$id_asignatura),

		    'totalregistros' => count($this->consultas_model->buscar_actividadesNE($id_estudiante,$periodo,$id_curso,$id_asignatura))


		);
	    echo json_encode($data);


	}

}