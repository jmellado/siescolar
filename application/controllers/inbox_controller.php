<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('inbox_model');
		$this->load->library('form_validation');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'profesor')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_profesor_vista', 'inbox/inbox_vista');
	}


	public function mostrarestudiantes(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;

		$id_curso = $this->input->post('id_curso');
		
		$data = array(

			'estudiantes' => $this->inbox_model->buscar_estudiante($id,$id_curso,$inicio,$cantidad),

		    'totalregistros' => count($this->inbox_model->buscar_estudiante($id,$id_curso,$inicio,$cantidad)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


}