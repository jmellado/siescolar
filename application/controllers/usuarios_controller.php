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
        $this->form_validation->set_rules('correo', 'Correo', 'required');
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
        	$nombres = mb_convert_case(mb_strtolower(trim($this->input->post('nombres'))), MB_CASE_TITLE);
        	$apellido1 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido1'))), MB_CASE_TITLE);
        	$apellido2 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido2'))), MB_CASE_TITLE);
        	$telefono = trim($this->input->post('telefono'));
        	$correo = trim($this->input->post('correo'));
        	$direccion = mb_convert_case(mb_strtolower(trim($this->input->post('direccion'))), MB_CASE_TITLE);
        	$barrio = mb_convert_case(mb_strtolower(trim($this->input->post('barrio'))), MB_CASE_TITLE);
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
			$user = mb_strtolower(substr($nombres, 0, 2));
			$name = mb_strtolower($apellido1);
			$username = $user.$name."ad".$ultimo_id;

			//array para insertar en la tabla usuarios
			$usuario3 = array(
			'id_persona' =>$ultimo_id,
			'id_rol' => $rol,
			'username' =>$username,
			'password' =>sha1($identificacion),
			'acceso' =>1);


			if ($this->usuarios_model->validar_existencia_rol($identificacion,"administradores")){

				if ($this->usuarios_model->validar_existencia_rol($identificacion,"estudiantes")){

					if ($this->usuarios_model->validar_existencia_rol($identificacion,"profesores")){

						if ($this->usuarios_model->validar_existencia_rol($identificacion,"acudientes")){

							$respuesta=$this->usuarios_model->insertar_usuario($usuario,$usuario2,$usuario3);
										
							if($respuesta==true){

								echo "registroguardado";

								if(!copy("./uploads/imagenes/fotos/foto.jpg","./uploads/imagenes/fotos/".$ultimo_id.".jpg")){
									echo "Error Al Copiar La Imagen.";
								}
							}
							else{

								echo "registronoguardado";
							}

						}
						else{

							$row = $this->usuarios_model->obtener_informacion_persona($identificacion);
							$id_persona = $row[0]['id_persona'];

							//array para insertar en la tabla administradores
				        	$usuario2 = array(
							'id_persona' =>$id_persona);

							//aqui creamos el username de un administrador
							$user = mb_strtolower(substr($nombres, 0, 2));
							$name = mb_strtolower($apellido1);
							$username = $user.$name."ad".$id_persona;

							//array para insertar en la tabla usuarios
							$usuario3 = array(
							'id_persona' =>$id_persona,
							'id_rol' => $rol,
							'username' =>$username,
							'password' =>sha1($identificacion),
							'acceso' =>1);

							$respuesta=$this->usuarios_model->insertar_usuario_rol($usuario2,$usuario3);

							if($respuesta==true){

								echo "registroguardado";

								if(!copy("./uploads/imagenes/fotos/foto.jpg","./uploads/imagenes/fotos/".$ultimo_id.".jpg")){
									echo "Error Al Copiar La Imagen.";
								}
							}
							else{

								echo "registronoguardado";
							}

						}
					}
					else{

						$row = $this->usuarios_model->obtener_informacion_persona($identificacion);
						$id_persona = $row[0]['id_persona'];

						//array para insertar en la tabla administradores
			        	$usuario2 = array(
						'id_persona' =>$id_persona);

						//aqui creamos el username de un administrador
						$user = mb_strtolower(substr($nombres, 0, 2));
						$name = mb_strtolower($apellido1);
						$username = $user.$name."ad".$id_persona;

						//array para insertar en la tabla usuarios
						$usuario3 = array(
						'id_persona' =>$id_persona,
						'id_rol' => $rol,
						'username' =>$username,
						'password' =>sha1($identificacion),
						'acceso' =>1);

						$respuesta=$this->usuarios_model->insertar_usuario_rol($usuario2,$usuario3);

						if($respuesta==true){

							echo "registroguardado";
						}
						else{

							echo "registronoguardado";
						}

					}
				}
				else{

					//COMPROBAMOS QUE EL ESTADO DE ESE ESTUDIANTE NO SEA ACTIVO.
					if ($this->usuarios_model->comprobar_estado_rol($identificacion,"estudiantes")) {

						$row = $this->usuarios_model->obtener_informacion_persona($identificacion);
						$id_persona = $row[0]['id_persona'];

						//array para insertar en la tabla administradores
			        	$usuario2 = array(
						'id_persona' =>$id_persona);

						//aqui creamos el username de un administrador
						$user = mb_strtolower(substr($nombres, 0, 2));
						$name = mb_strtolower($apellido1);
						$username = $user.$name."ad".$id_persona;

						//array para insertar en la tabla usuarios
						$usuario3 = array(
						'id_persona' =>$id_persona,
						'id_rol' => $rol,
						'username' =>$username,
						'password' =>sha1($identificacion),
						'acceso' =>1);

						$respuesta=$this->usuarios_model->insertar_usuario_rol($usuario2,$usuario3);

						if($respuesta==true){

							echo "registroguardado";
						}
						else{

							echo "registronoguardado";
						}

					}
					else{

						echo "estudianteactivo";
					}

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

				if($this->usuarios_model->validar_sesion($id_usuario)){

					$respuesta=$this->usuarios_model->modificar_usuario($id_usuario,$usuario);

					if($respuesta==true){

						echo "registroactualizado";

					}else{

						echo "registronoactualizado";

					}

				}
				else{

					echo "sesionactiva";
				}

			}
			else{

				echo "digite valor numerico para identificar un usuario";
			}

        }

	}


	public function reestablecer_contrasena(){

	  	$id_usuario =$this->input->post('id_usuario');

	  	$user = $this->usuarios_model->obtener_informacion_usuario($id_usuario);
	  	$identificacion = $user[0]['identificacion'];

	  	$password = array('password' => sha1($identificacion));

        if(is_numeric($id_usuario)){

			
	        $respuesta=$this->usuarios_model->reestablecer_contrasena($id_usuario,$password);
	        
          	if($respuesta==true){
              
              	echo "reestablecida";
          	}else{
              
              	echo "noreestablecida";
          	}
          
        }else{
          
          	echo "Digite valor numerico para identificar un usuario";
        }
    }



    //==================  FUNCIONES PARA VALIDAR EL USUARIO ==================


    public function validar_identificacion(){

		$identificacion = $this->input->post('identificacion'); 

		if ($this->usuarios_model->validar_existencia_rol($identificacion,"administradores")){

			if ($this->usuarios_model->validar_existencia_rol($identificacion,"estudiantes")){

				if ($this->usuarios_model->validar_existencia_rol($identificacion,"profesores")){

					if ($this->usuarios_model->validar_existencia_rol($identificacion,"acudientes")){

						echo "ok";
					}
					else{

						$consulta = $this->usuarios_model->obtener_informacion_persona($identificacion);
						echo json_encode($consulta);
					}	
				}
				else{

					$consulta = $this->usuarios_model->obtener_informacion_persona($identificacion);
					echo json_encode($consulta);
				}	
			}
			else{

				if ($this->usuarios_model->comprobar_estado_rol($identificacion,"estudiantes")) {

					$consulta = $this->usuarios_model->obtener_informacion_persona($identificacion);
					echo json_encode($consulta);
					
				}
				else{
					echo "estudianteactivo";
				}

			}
		}
		else{
			echo "administradoryaexiste";
		}	
		
	    
	}


	public function validar_rol(){

		$identificacion = $this->input->post('identificacion');

		if (!$this->usuarios_model->validar_existencia_rol($identificacion,"estudiantes")) {
				
			echo "no";
		}
		elseif (!$this->usuarios_model->validar_existencia_rol($identificacion,"profesores")) {
			
			echo "no";
		}
		elseif (!$this->usuarios_model->validar_existencia_rol($identificacion,"acudientes")) {
			
			echo "no";
		}
		else{

			echo "si";

		}


	}



}