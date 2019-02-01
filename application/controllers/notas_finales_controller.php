<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notas_finales_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('notas_finales_model');
		$this->load->library('form_validation');
	}


	public function notas_finales()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'notas_finales/notas_finales_vista');
	}


	public function llenarcombo_cursosNF(){

    	$jornada = $this->input->post('jornada');

    	$consulta = $this->notas_finales_model->llenar_cursos($jornada);
    	echo json_encode($consulta);
    }


    public function llenarcombo_estudiantesNF(){

    	$id_curso = $this->input->post('id_curso');

    	$consulta = $this->notas_finales_model->llenar_estudiantes($id_curso);
    	echo json_encode($consulta);
    }


    public function mostrarnotasfinales(){

		$jornada = $this->input->post('jornada'); 
		$id_curso = $this->input->post('id_curso');
		$id_estudiante = $this->input->post('id_estudiante');
		
		$data = array(

			'notas' => $this->notas_finales_model->buscar_notas($jornada,$id_curso,$id_estudiante),

		    'totalregistros' => count($this->notas_finales_model->buscar_notas($jornada,$id_curso,$id_estudiante))


		);
	    echo json_encode($data);


	}


}