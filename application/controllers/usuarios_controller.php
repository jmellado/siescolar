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


	public function insertar(){

		$this->form_validation->set_rules('identificacion', 'Identificación', 'required|numeric|max_length[10]');
		$this->form_validation->set_rules('tipo_id', 'Tipo Identificación', 'required|max_length[2]');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1', 'Primer Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2', 'Segundo Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('correo', 'Correo', 'required|alpha_spaces');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|alpha_spaces');
        $this->form_validation->set_rules('barrio', 'Barrio', 'required|alpha_spaces');

        $this->form_validation->set_rules('rol', 'Rol', 'required|numeric');


        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de personas + 1 
        	$ultimo_id = $this->usuarios_model->obtener_ultimo_id();

        	$identificacion = trim($this->input->post('identificacion'));
        	$tipo_id = $this->input->post('tipo_id');
        	$nombres = ucwords(strtolower(trim($this->input->post('nombres'))));
        	$apellido1 = ucwords(strtolower(trim($this->input->post('apellido1'))));
        	$apellido2 = ucwords(strtolower(trim($this->input->post('apellido2'))));
        	$telefono = trim($this->input->post('telefono'));
        	$correo = trim($this->input->post('correo'));
        	$direccion = ucwords(strtolower(trim($this->input->post('direccion'))));
        	$barrio = ucwords(strtolower(trim($this->input->post('barrio'))));
        	$rol = $this->input->post('rol');
   

        	//array para insertar en la tabla personas
        	$usuario = array(
			'id_persona' =>$ultimo_id,
			'identificacion' =>$identificacion,
			'tipo_id' =>$tipo_id,
			'nombres' =>$nombres,
			'apellido1' =>$apellido1,
			'apellido2' =>$apellido2,
			'telefono' =>$telefono,
			'email' =>$correo,
			'direccion' =>$direccion,
			'barrio' =>$barrio);

			//array para insertar en la tabla administradores
        	$usuario2 = array(
			'id_persona' =>$ultimo_id);

			//aqui creamos el username de un administrador
			$user = strtolower(substr($nombres, 0, 2));
			$name = strtolower($apellido1);
			$username = $user.$name."ad".$ultimo_id;

			//array para insertar en la tabla usuarios
			$usuario3 = array(
			'id_persona' =>$ultimo_id,
			'id_rol' => $rol,
			'username' =>$username,
			'password' =>sha1($identificacion),
			'acceso' =>1);


			if ($this->usuarios_model->validar_existencia($identificacion)){

				$respuesta=$this->usuarios_model->insertar_usuario($usuario,$usuario2,$usuario3);
							
				if($respuesta==true){

					echo "registroguardado";
				}
				else{

					echo "registronoguardado";
				}
			}
			else{

				echo "usuarioyaexiste";
			}

		}

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