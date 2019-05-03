<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AsistenciasA_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('asistenciasA_model');
		$this->load->library('form_validation');
		$this->load->model('funciones_globales_model');
	}


	public function consultar_asistencias_estudiante()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'asistenciasA/consultar_asistencias_estudianteA_vista');
	}


	public function llenarcombo_anos_lectivos(){

    	$consulta = $this->asistenciasA_model->llenar_anos_lectivos();
    	echo json_encode($consulta);
    }


    public function llenarcombo_cursos(){

		$ano_lectivo = $this->input->post('ano_lectivo');

    	$consulta = $this->asistenciasA_model->llenar_cursos($ano_lectivo);
    	echo json_encode($consulta);
    }


    public function llenarcombo_asignaturas(){

    	$id_curso =$this->input->post('id_curso');
    	$id_grado = $this->asistenciasA_model->obtener_gradoPorcurso($id_curso);
    	$ano_lectivo =$this->input->post('ano_lectivo');

    	$consulta = $this->asistenciasA_model->llenar_asignaturas($id_grado,$ano_lectivo);
    	echo json_encode($consulta);
    }


    public function llenarcombo_estudiantes(){

    	$id_curso =$this->input->post('id_curso');

    	$consulta = $this->asistenciasA_model->EstudiantesMatriculadosPorCurso($id_curso);
    	echo json_encode($consulta);
    }


    public function mostrarasistencias_estudiante(){

		$ano_lectivo = $this->input->post('ano_lectivo'); 
		$id_curso = $this->input->post('id_curso');
		$id_asignatura = $this->input->post('id_asignatura');
		$id_estudiante = $this->input->post('id_estudiante');
		$periodo = $this->input->post('periodo');  
		
		$data = array(

			'asistencias' => $this->asistenciasA_model->buscar_asistencia_estudiante($ano_lectivo,$id_curso,$id_asignatura,$id_estudiante,$periodo),

		    'totalregistros' => count($this->asistenciasA_model->buscar_asistencia_estudiante($ano_lectivo,$id_curso,$id_asignatura,$id_estudiante,$periodo))


		);
	    echo json_encode($data);

	}


}