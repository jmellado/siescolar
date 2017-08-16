<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funciones_globales_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('funciones_globales_model');
	}


	public function llenarcombo_anos_lectivos(){

    	$consulta = $this->funciones_globales_model->llenar_anos_lectivos();
    	echo json_encode($consulta);
    }

    public function llenarcombo_salones(){

    	$consulta = $this->funciones_globales_model->llenar_salones();
    	echo json_encode($consulta);
    }

    public function llenarcombo_grados(){

    	$consulta = $this->funciones_globales_model->llenar_grados();
    	echo json_encode($consulta);
    }

    public function llenarcombo_grupos(){

    	$consulta = $this->funciones_globales_model->llenar_grupos();
    	echo json_encode($consulta);
    }

    
}