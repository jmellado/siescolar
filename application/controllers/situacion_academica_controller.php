<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Situacion_academica_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('situacion_academica_model');
		$this->load->model('funciones_globales_model');
		$this->load->library('form_validation');
	}


	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'situacion_academica/situacion_academica_vista');
	}


	public function llenarcombo_cursosSA(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->situacion_academica_model->llenar_cursos($jornada);
    	echo json_encode($consulta);
    }


    public function mostrarsituacionacademica(){

		$jornada = $this->input->post('jornada'); 
		$id_curso = $this->input->post('id_curso');

		if ($this->situacion_academica_model->validar_existencia_estudiantes($id_curso)) {
			
			if ($this->situacion_academica_model->validar_existencia_criterios($id_curso)) {

				$data = array(

					'situacion' => $this->situacion_academica_model->buscar_situacionacademica($jornada,$id_curso),

				    'totalregistros' => count($this->situacion_academica_model->buscar_situacionacademica($jornada,$id_curso))

				);
			    echo json_encode($data);
				
			}
			else{

				echo "nohaycriterios";
			}
		}
		else{

			echo "nohayestudiantes";
		}
		
	}


}