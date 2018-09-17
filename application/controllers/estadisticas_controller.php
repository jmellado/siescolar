<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas_controller extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('estadisticas_model');
		$this->load->library('form_validation');
	}
	

	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'estadisticas/estadisticas_vista');
	}


	public function CincuentaMejores()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'estadisticas/cincuentamejores_vista');
	}


	public function PromedioCursos()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'estadisticas/promediocursos_vista');
	}


	public function PromedioGrados()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'estadisticas/promediogrados_vista');
	}


	public function EnRiesgo()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'estadisticas/enriesgo_vista');
	}


	public function llenarcombo_anos_lectivosE(){

    	$consulta = $this->estadisticas_model->llenar_anos_lectivosE();
    	echo json_encode($consulta);
    }


    public function mostrarcincuentamejores(){

		$periodo = $this->input->post('periodo'); 
		$jornada = $this->input->post('jornada'); 
		$ano_lectivo = $this->input->post('ano_lectivo'); 
		
		$data = array(

			'cincuentamejores' => $this->estadisticas_model->buscar_cincuentamejores($periodo,$jornada,$ano_lectivo),

		    'totalregistros' => count($this->estadisticas_model->buscar_cincuentamejores($periodo,$jornada,$ano_lectivo))


		);
	    echo json_encode($data);


	}


	public function mostrarpromediocursos(){

		$periodo = $this->input->post('periodo'); 
		$jornada = $this->input->post('jornada'); 
		$ano_lectivo = $this->input->post('ano_lectivo'); 
		
		$data = array(

			'promediocursos' => $this->estadisticas_model->buscar_promediocursos($periodo,$jornada,$ano_lectivo),

		    'totalregistros' => count($this->estadisticas_model->buscar_promediocursos($periodo,$jornada,$ano_lectivo))


		);
	    echo json_encode($data);


	}
}