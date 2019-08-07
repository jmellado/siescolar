<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asistencias_a_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('asistencias_a_model');
		$this->load->library('form_validation');
		$this->load->model('funciones_globales_model');
	}


	public function consultar_asistencias_estudiante()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'asistencias_a/consultar_asistencias_estudiante_a_vista');
	}


	public function llenarcombo_anos_lectivos(){

    	$consulta = $this->asistencias_a_model->llenar_anos_lectivos();
    	echo json_encode($consulta);
    }


    public function llenarcombo_cursos(){

		$ano_lectivo = $this->input->post('ano_lectivo');

    	$consulta = $this->asistencias_a_model->llenar_cursos($ano_lectivo);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas(){

    	$id_curso =$this->input->post('id_curso');
    	$id_grado = $this->asistencias_a_model->obtener_gradoPorcurso($id_curso);
    	$ano_lectivo =$this->input->post('ano_lectivo');

    	$consulta = $this->asistencias_a_model->llenar_asignaturas($id_grado,$ano_lectivo);
    	echo json_encode($consulta);
    }


    public function llenarcombo_estudiantes(){

    	$id_curso =$this->input->post('id_curso');

    	$consulta = $this->asistencias_a_model->EstudiantesMatriculadosPorCurso($id_curso);
    	echo json_encode($consulta);
    }


    public function mostrarasistencias_estudiante(){

		$ano_lectivo = $this->input->post('ano_lectivo'); 
		$id_curso = $this->input->post('id_curso');
		$id_asignatura = $this->input->post('id_asignatura');
		$id_estudiante = $this->input->post('id_estudiante');
		$periodo = $this->input->post('periodo');  
		
		$data = array(

			'asistencias' => $this->asistencias_a_model->buscar_asistencia_estudiante($ano_lectivo,$id_curso,$id_asignatura,$id_estudiante,$periodo),

		    'totalregistros' => count($this->asistencias_a_model->buscar_asistencia_estudiante($ano_lectivo,$id_curso,$id_asignatura,$id_estudiante,$periodo))


		);
	    echo json_encode($data);

	}


}