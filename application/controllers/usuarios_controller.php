<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('usuarios_model');
		$this->load->library('form_validation');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		//$this->load->view('estudiantes/registrar2');
		$this->template->load('roles/rol_administrador_vista', 'usuarios/usuarios_vista');
	}


	public function mostrarusuarios(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'usuarios' => $this->usuarios_model->buscar_usuario($id,$inicio,$cantidad),

		    'totalregistros' => count($this->usuarios_model->buscar_usuario($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function modificar(){

		$this->form_validation->set_rules('id_usuario', 'Id Usuario', 'required|numeric');
        $this->form_validation->set_rules('estado_usuario', 'Estado Usuario', 'required|numeric');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();
        }
        else{

        	$id_usuario = $this->input->post('id_usuario');
        	$acceso = $this->input->post('estado_usuario');

        	//array para actualizar en la tabla usuarios
			$usuario = array(
			'acceso' =>$acceso);

			if(is_numeric($id_usuario)){

				$respuesta=$this->usuarios_model->modificar_usuario($id_usuario,$usuario);

				if($respuesta==true){

					echo "registroactualizado";

				}else{

					echo "registronoactualizado";

				}

			}
			else{

				echo "digite valor numerico para identificar un usuario";
			}

        }

	}



}