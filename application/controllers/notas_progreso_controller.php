<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notas_progreso_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('notas_progreso_model');
		$this->load->library('form_validation');
	}


	public function notas_progreso()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'notas_progreso/notas_progreso_vista');
	}


	public function llenarcombo_cursosNP(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->notas_progreso_model->llenar_cursos($jornada);
    	echo json_encode($consulta);
    }


    public function mostrarnotasprogreso(){

		$jornada = $this->input->post('jornada'); 
		$id_curso = $this->input->post('id_curso');
		$periodo = $this->input->post('periodo');

		if ($this->notas_progreso_model->validar_existencia_estudiantes($id_curso)) {
		
			$data = array(

				'notas' => $this->notas_progreso_model->buscar_notasprogreso($jornada,$id_curso,$periodo),

			    'totalregistros' => count($this->notas_progreso_model->buscar_notasprogreso($jornada,$id_curso,$periodo))

			);
		    echo json_encode($data);

		}
		else{

			echo "nohayestudiantes";
		}


	}


}