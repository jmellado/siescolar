<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administradores_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('administradores_model');
		$this->load->library('form_validation');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}

		$this->template->load('roles/rol_administrador_vista', 'administradores/administradores_vista');
	}


	public function insertar(){

		$this->form_validation->set_rules('identificacion', 'Identificación', 'required|numeric|max_length[11]');
		$this->form_validation->set_rules('tipo_id', 'Tipo Identificación', 'required|max_length[2]');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1', 'Primer Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2', 'Segundo Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('correo', 'Correo', 'required');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|alpha_spaces');
        $this->form_validation->set_rules('barrio', 'Barrio', 'required|alpha_spaces');


        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de personas + 1 
        	$ultimo_id = $this->administradores_model->obtener_ultimo_id();

        	$identificacion = trim($this->input->post('identificacion'));
        	$tipo_id = $this->input->post('tipo_id');
        	$nombres = mb_convert_case(mb_strtolower(trim($this->input->post('nombres'))), MB_CASE_TITLE);
        	$apellido1 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido1'))), MB_CASE_TITLE);
        	$apellido2 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido2'))), MB_CASE_TITLE);
        	$telefono = trim($this->input->post('telefono'));
        	$correo = trim($this->input->post('correo'));
        	$direccion = mb_convert_case(mb_strtolower(trim($this->input->post('direccion'))), MB_CASE_TITLE);
        	$barrio = mb_convert_case(mb_strtolower(trim($this->input->post('barrio'))), MB_CASE_TITLE);
   

        	//array para insertar en la tabla personas
        	$administrador = array(
			'id_persona' 	 =>$ultimo_id,
			'identificacion' =>$identificacion,
			'tipo_id' 		 =>$tipo_id,
			'nombres' 		 =>$nombres,
			'apellido1' 	 =>$apellido1,
			'apellido2' 	 =>$apellido2,
			'telefono' 		 =>$telefono,
			'email' 		 =>$correo,
			'direccion'      =>$direccion,
			'barrio'         =>$barrio);

			//array para insertar en la tabla administradores
        	$administrador2 = array(
			'id_persona' =>$ultimo_id);

			//aqui creamos el username de un administrador
			$user = mb_strtolower(substr($nombres, 0, 2));
			$name = mb_strtolower(str_replace(" ", "", $apellido1));
			$username = $user.$name."ad".$ultimo_id;

			//array para insertar en la tabla usuarios
			$usuario = array(
			'id_persona' =>$ultimo_id,
			'id_rol' 	 =>1,
			'username'   =>$username,
			'password'   =>sha1($identificacion),
			'acceso'     =>1);


			if ($this->administradores_model->validar_existencia_rol($identificacion,"administradores")){

				if ($this->administradores_model->validar_existencia_rol($identificacion,"estudiantes")){

					if ($this->administradores_model->validar_existencia_rol($identificacion,"profesores")){

						if ($this->administradores_model->validar_existencia_rol($identificacion,"acudientes")){

							$respuesta=$this->administradores_model->insertar_usuario($administrador,$administrador2,$usuario);
										
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

							$row = $this->administradores_model->obtener_informacion_persona($identificacion);
							$id_persona = $row[0]['id_persona'];

							//array para insertar en la tabla administradores
				        	$administrador2 = array(
							'id_persona' =>$id_persona);

							//aqui creamos el username de un administrador
							$user = mb_strtolower(substr($nombres, 0, 2));
							$name = mb_strtolower(str_replace(" ", "", $apellido1));
							$username = $user.$name."ad".$id_persona;

							//array para insertar en la tabla usuarios
							$usuario = array(
							'id_persona' =>$id_persona,
							'id_rol' 	 =>1,
							'username' 	 =>$username,
							'password' 	 =>sha1($identificacion),
							'acceso' 	 =>1);

							$respuesta=$this->administradores_model->insertar_administrador_rol($administrador2,$usuario);

							if($respuesta==true){

								echo "registroguardado";
							}
							else{

								echo "registronoguardado";
							}

						}
					}
					else{

						$row = $this->administradores_model->obtener_informacion_persona($identificacion);
						$id_persona = $row[0]['id_persona'];

						//array para insertar en la tabla administradores
			        	$administrador2 = array(
						'id_persona' =>$id_persona);

						//aqui creamos el username de un administrador
						$user = mb_strtolower(substr($nombres, 0, 2));
						$name = mb_strtolower(str_replace(" ", "", $apellido1));
						$username = $user.$name."ad".$id_persona;

						//array para insertar en la tabla usuarios
						$usuario = array(
						'id_persona' =>$id_persona,
						'id_rol'     =>1,
						'username'   =>$username,
						'password'   =>sha1($identificacion),
						'acceso'     =>1);

						$respuesta=$this->administradores_model->insertar_administrador_rol($administrador2,$usuario);

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
					if ($this->administradores_model->comprobar_estado_rol($identificacion,"estudiantes")) {

						$row = $this->administradores_model->obtener_informacion_persona($identificacion);
						$id_persona = $row[0]['id_persona'];

						//array para insertar en la tabla administradores
			        	$administrador2 = array(
						'id_persona' =>$id_persona);

						//aqui creamos el username de un administrador
						$user = mb_strtolower(substr($nombres, 0, 2));
						$name = mb_strtolower(str_replace(" ", "", $apellido1));
						$username = $user.$name."ad".$id_persona;

						//array para insertar en la tabla usuarios
						$usuario = array(
						'id_persona' =>$id_persona,
						'id_rol'     =>1,
						'username'   =>$username,
						'password'   =>sha1($identificacion),
						'acceso'     =>1);

						$respuesta=$this->administradores_model->insertar_administrador_rol($administrador2,$usuario);

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

				echo "administradoryaexiste";
			}

		}

	}


	public function mostraradministradores(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'administradores' => $this->administradores_model->buscar_administrador($id,$inicio,$cantidad),

		    'totalregistros' => count($this->administradores_model->buscar_administrador($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function eliminar(){

	  	$id_persona =$this->input->post('id'); 

        if(is_numeric($id_persona)){

        	if ($this->administradores_model->validar_sesion($id_persona)){

				$persona = $this->administradores_model->obtener_informacion_persona($id_persona,"2");
				$identificacion = $persona[0]['identificacion'];

				
				if (!$this->administradores_model->validar_existencia_rol($identificacion,"estudiantes")) {
					
					$respuesta=$this->administradores_model->eliminar_administrador($id_persona,"2");
		        
		          	if($respuesta==true){
		              
		              	echo "Administrador Eliminado Correctamente.";
		          	}else{
		              
		              	echo "No se Pudo Eliminar";
		          	}
				}
				elseif (!$this->administradores_model->validar_existencia_rol($identificacion,"profesores")) {
					
					$respuesta=$this->administradores_model->eliminar_administrador($id_persona,"2");
		        
		          	if($respuesta==true){
		              
		              	echo "Administrador Eliminado Correctamente.";
		          	}else{
		              
		              	echo "No se Pudo Eliminar";
		          	}
				}
				elseif (!$this->administradores_model->validar_existencia_rol($identificacion,"acudientes")) {
					
					$respuesta=$this->administradores_model->eliminar_administrador($id_persona,"2");
		        
		          	if($respuesta==true){
		              
		              	echo "Administrador Eliminado Correctamente.";
		          	}else{
		              
		              	echo "No se Pudo Eliminar";
		          	}
				}
				else{

					$respuesta=$this->administradores_model->eliminar_administrador($id_persona);
		        
		          	if($respuesta==true){
		              
		              	echo "Administrador Eliminado Correctamente.";

		              	if (!unlink("./uploads/imagenes/fotos/".$id_persona.".jpg")) {
		              		echo "Error Al Borrar La Imagen.";
		              	}

		          	}else{
		              
		              	echo "No se Pudo Eliminar";
		          	}

				}

			}
			else{
				echo "No Se Puede Eliminar Este Administrador; Actualmente Tíene Una Sesión Activa.";
			}
          
        }else{
          
          	echo "digite valor numerico para identificar un administrador";
        }
    }


	public function modificar(){

		$this->form_validation->set_rules('identificacion', 'Identificación', 'required|numeric|max_length[11]');
		$this->form_validation->set_rules('tipo_id', 'Tipo Identificación', 'required|max_length[2]');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1', 'Primer Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2', 'Segundo Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('correo', 'Correo', 'required');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|alpha_spaces');
        $this->form_validation->set_rules('barrio', 'Barrio', 'required|alpha_spaces');


        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	$id_persona = $this->input->post('id_persona');
        	$identificacion = trim($this->input->post('identificacion'));
        	$tipo_id = $this->input->post('tipo_id');
        	$nombres = mb_convert_case(mb_strtolower(trim($this->input->post('nombres'))), MB_CASE_TITLE);
        	$apellido1 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido1'))), MB_CASE_TITLE);
        	$apellido2 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido2'))), MB_CASE_TITLE);
        	$telefono = trim($this->input->post('telefono'));
        	$correo = trim($this->input->post('correo'));
        	$direccion = mb_convert_case(mb_strtolower(trim($this->input->post('direccion'))), MB_CASE_TITLE);
        	$barrio = mb_convert_case(mb_strtolower(trim($this->input->post('barrio'))), MB_CASE_TITLE);

        	//array para actualizar en la tabla personas
        	$administrador = array(
			'id_persona' 	 =>$id_persona,
			'identificacion' =>$identificacion,
			'tipo_id' 		 =>$tipo_id,
			'nombres' 		 =>$nombres,
			'apellido1' 	 =>$apellido1,
			'apellido2' 	 =>$apellido2,
			'telefono' 		 =>$telefono,
			'email' 		 =>$correo,
			'direccion'      =>$direccion,
			'barrio'         =>$barrio);

			//array para actualizar en la tabla administradores
        	$administrador2 = array(
			'id_persona' =>$id_persona);

			//aqui creamos el username de un administrador
			$user = mb_strtolower(substr($nombres, 0, 2));
			$name = mb_strtolower(str_replace(" ", "", $apellido1));
			$username = $user.$name."ad".$id_persona;

			//array para actualizar en la tabla usuarios
			$usuario = array(
			'id_persona' =>$id_persona,
			'id_rol' 	 =>1,
			'username'   =>$username,
			'password'   =>sha1($identificacion));

			$persona = $this->administradores_model->obtener_informacion_persona($id_persona,"2");
			$identificacion_buscada = $persona[0]['identificacion'];

			if(is_numeric($id_persona)){

	        	if ($identificacion_buscada == $identificacion){

		        	$respuesta=$this->administradores_model->modificar_administrador($id_persona,$administrador,$administrador2,$usuario);

					if($respuesta==true){

						echo "registroactualizado";

						$act_usu = $this->administradores_model->actualizar_usuarios_persona($id_persona,$identificacion,$nombres,$apellido1,$apellido2);

		            }else{

						echo "registronoactualizado";
		            }

		        }
		        else{

		        	if($this->administradores_model->validar_existencia($identificacion)){

		        		$respuesta=$this->administradores_model->modificar_administrador($id_persona,$administrador,$administrador2,$usuario);

		        		if($respuesta==true){

							echo "registroactualizado";

							$act_usu = $this->administradores_model->actualizar_usuarios_persona($id_persona,$identificacion,$nombres,$apellido1,$apellido2);

			            }else{

							echo "registronoactualizado";
			            }

		        	}
		        	else{

		        		echo "administradoryaexiste";
		        	}

		        }          
	         
	        }else{
	            
	            echo "digite valor numerico para identificar un acudiente";
	        }

		}

	}


	//==================  FUNCIONES PARA VALIDAR PERSONA EXISTENTE ==================


    public function validar_identificacion(){

		$identificacion = $this->input->post('identificacion'); 

		if ($this->administradores_model->validar_existencia_rol($identificacion,"administradores")){

			if ($this->administradores_model->validar_existencia_rol($identificacion,"estudiantes")){

				if ($this->administradores_model->validar_existencia_rol($identificacion,"profesores")){

					if ($this->administradores_model->validar_existencia_rol($identificacion,"acudientes")){

						echo "ok";
					}
					else{

						$consulta = $this->administradores_model->obtener_informacion_persona($identificacion);
						echo json_encode($consulta);
					}	
				}
				else{

					$consulta = $this->administradores_model->obtener_informacion_persona($identificacion);
					echo json_encode($consulta);
				}	
			}
			else{

				if ($this->administradores_model->comprobar_estado_rol($identificacion,"estudiantes")) {

					$consulta = $this->administradores_model->obtener_informacion_persona($identificacion);
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

}