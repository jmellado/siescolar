<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fotografias_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('fotografias_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	
	//=========================== Estudiantes ==========================
	public function estudiantes()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'fotografias/estudiantes_vista');
	}


	public function mostrarestudiantes(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'estudiantes' => $this->fotografias_model->buscar_estudiante($id,$inicio,$cantidad),

		    'totalregistros' => count($this->fotografias_model->buscar_estudiante($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function cargar_fotografia(){

        $this->form_validation->set_rules('id_persona', 'Id Persona', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$id_persona = $this->input->post('id_persona');
        	$foto_estudiante = "foto_estudiante";

        	$config = [
				'upload_path' => './uploads/imagenes/fotos',
				'allowed_types' => 'png|jpg',
				'file_name' => $id_persona.'.jpg',
				'overwrite' => 'true',
				'max_size' => '6000'
			];

			//Cargamos la librería de subida y le pasamos la configuración
			$this->load->library('upload', $config);

			//si el fchero es subido correctamente
			if ($this->upload->do_upload($foto_estudiante)) {

				echo "registroguardado";
			}
			else{

				echo $this->upload->display_errors();
			}

        }

	}


	//=========================== Profesores ==========================
	public function profesores()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'fotografias/profesores_vista');
	}


	public function mostrarprofesores(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'profesores' => $this->fotografias_model->buscar_profesor($id,$inicio,$cantidad),

		    'totalregistros' => count($this->fotografias_model->buscar_profesor($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function cargar_fotografiaP(){

        $this->form_validation->set_rules('id_persona', 'Id Persona', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$id_persona = $this->input->post('id_persona');
        	$foto_profesor = "foto_profesor";

        	$config = [
				'upload_path' => './uploads/imagenes/fotos',
				'allowed_types' => 'png|jpg',
				'file_name' => $id_persona.'.jpg',
				'overwrite' => 'true',
				'max_size' => '6000'
			];

			//Cargamos la librería de subida y le pasamos la configuración
			$this->load->library('upload', $config);

			//si el fchero es subido correctamente
			if ($this->upload->do_upload($foto_profesor)) {

				echo "registroguardado";
			}
			else{

				echo $this->upload->display_errors();
			}

        }

	}


}