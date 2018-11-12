<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acudientes_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('acudientes_model');
		$this->load->library('form_validation');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		$this->template->load('roles/rol_administrador_vista', 'acudientes/acudientes_vista');
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

        $this->form_validation->set_rules('ocupacion', 'Ocupacion', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono_trabajo', 'Telefono Trabajo', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('direccion_trabajo', 'Dirección Trabajo', 'required|alpha_spaces');


        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();

        }
        else{

        	//obtengo el ultimo id de personas + 1 
        	$ultimo_id = $this->acudientes_model->obtener_ultimo_id();

        	$identificacion = trim($this->input->post('identificacion'));
        	$tipo_id = $this->input->post('tipo_id');
        	$nombres = ucwords(strtolower(trim($this->input->post('nombres'))));
        	$apellido1 = ucwords(strtolower(trim($this->input->post('apellido1'))));
        	$apellido2 = ucwords(strtolower(trim($this->input->post('apellido2'))));
        	$telefono = trim($this->input->post('telefono'));
        	$correo = trim($this->input->post('correo'));
        	$direccion = ucwords(strtolower(trim($this->input->post('direccion'))));
        	$barrio = ucwords(strtolower(trim($this->input->post('barrio'))));
        	$ocupacion = ucwords(strtolower(trim($this->input->post('ocupacion'))));
        	$telefono_trabajo = trim($this->input->post('telefono_trabajo'));
        	$direccion_trabajo = ucwords(strtolower(trim($this->input->post('direccion_trabajo'))));

        	//array para insertar en la tabla personas----------
        	$acudiente = array(
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

			//array para insertar en la tabla acudientes----------
        	$acudiente2 = array(
			'id_persona' =>$ultimo_id,
			'ocupacion' =>$ocupacion,
			'telefono_trabajo' =>$telefono_trabajo,
			'direccion_trabajo' =>$direccion_trabajo);

			//aqui creamos el username de un estudiante
			$user = strtolower(substr($nombres, 0, 2));
			$name = strtolower($apellido1);
			$username = $user.$name."ac".$ultimo_id;

			//array para insertar en la tabla usuarios
			$usuario = array(
			'id_persona' =>$ultimo_id,
			'id_rol' => 4,
			'username' =>$username,
			'password' =>sha1($identificacion),
			'acceso' =>0);

			
			if ($this->acudientes_model->validar_existencia_rol($identificacion,"acudientes")){

				if ($this->acudientes_model->validar_existencia_rol($identificacion,"estudiantes")){

					if ($this->acudientes_model->validar_existencia_rol($identificacion,"profesores")){

						if ($this->acudientes_model->validar_existencia_rol($identificacion,"administradores")){
							
							$respuesta=$this->acudientes_model->insertar_acudiente($acudiente,$acudiente2,$usuario);
							
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

							$row = $this->acudientes_model->obtener_informacion_persona($identificacion);
							$id_persona = $row[0]['id_persona'];

							//array para insertar en la tabla acudientes----------
				        	$acudiente2 = array(
							'id_persona' =>$id_persona,
							'ocupacion' =>$ocupacion,
							'telefono_trabajo' =>$telefono_trabajo,
							'direccion_trabajo' =>$direccion_trabajo);

							//aqui creamos el username de un estudiante
							$user = strtolower(substr($nombres, 0, 2));
							$name = strtolower($apellido1);
							$username = $user.$name."ac".$id_persona;

							//array para insertar en la tabla usuarios
							$usuario = array(
							'id_persona' =>$id_persona,
							'id_rol' => 4,
							'username' =>$username,
							'password' =>sha1($identificacion),
							'acceso' =>0);

							$respuesta=$this->acudientes_model->insertar_acudiente_rol($acudiente2,$usuario);

							if($respuesta==true){

								echo "registroguardado";
							}
							else{

								echo "registronoguardado";
							}

						}	
					}
					else{

						$row = $this->acudientes_model->obtener_informacion_persona($identificacion);
						$id_persona = $row[0]['id_persona'];

						//array para insertar en la tabla acudientes----------
			        	$acudiente2 = array(
						'id_persona' =>$id_persona,
						'ocupacion' =>$ocupacion,
						'telefono_trabajo' =>$telefono_trabajo,
						'direccion_trabajo' =>$direccion_trabajo);

						//aqui creamos el username de un estudiante
						$user = strtolower(substr($nombres, 0, 2));
						$name = strtolower($apellido1);
						$username = $user.$name."ac".$id_persona;

						//array para insertar en la tabla usuarios
						$usuario = array(
						'id_persona' =>$id_persona,
						'id_rol' => 4,
						'username' =>$username,
						'password' =>sha1($identificacion),
						'acceso' =>0);

						$respuesta=$this->acudientes_model->insertar_acudiente_rol($acudiente2,$usuario);

						if($respuesta==true){

							echo "registroguardado";
						}
						else{

							echo "registronoguardado";
						}

					}			
						
				}
				else{
					
					//CUANDO EL N° DE IDENTIFICACION DEL ACUDIENTE CORRESPONDE A UN ESTUDIANTE QUE SE ENCUENTRA REGISTRADO EN LA BD;
					//COMPROBAMOS QUE EL ESTADO DE ESE ESTUDIANTE NO SEA ACTIVO.
					if ($this->acudientes_model->comprobar_estado_rol($identificacion,"estudiantes")) {

						$row = $this->acudientes_model->obtener_informacion_persona($identificacion);
						$id_persona = $row[0]['id_persona'];

						//array para insertar en la tabla acudientes----------
			        	$acudiente2 = array(
						'id_persona' =>$id_persona,
						'ocupacion' =>$ocupacion,
						'telefono_trabajo' =>$telefono_trabajo,
						'direccion_trabajo' =>$direccion_trabajo);

						//aqui creamos el username de un estudiante
						$user = strtolower(substr($nombres, 0, 2));
						$name = strtolower($apellido1);
						$username = $user.$name."ac".$id_persona;

						//array para insertar en la tabla usuarios
						$usuario = array(
						'id_persona' =>$id_persona,
						'id_rol' => 4,
						'username' =>$username,
						'password' =>sha1($identificacion),
						'acceso' =>0);

						$respuesta=$this->acudientes_model->insertar_acudiente_rol($acudiente2,$usuario);

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

				echo "acudienteyaexiste";	
					
			}

        }

	}


	public function mostraracudientes(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		$data = array(

			'acudientes' => $this->acudientes_model->buscar_acudiente($id,$inicio,$cantidad),

		    'totalregistros' => count($this->acudientes_model->buscar_acudiente($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}


	public function eliminar(){

	  	$id_persona =$this->input->post('id'); 

        if(is_numeric($id_persona)){

        	if ($this->acudientes_model->ValidarExistencia_AcudienteEnMatriculas($id_persona)){

				$row = $this->acudientes_model->obtener_informacion_persona($id_persona,"2");
				$identificacion = $row[0]['identificacion'];

				
				if (!$this->acudientes_model->validar_existencia_rol($identificacion,"estudiantes")) {
					
					$respuesta=$this->acudientes_model->eliminar_acudiente($id_persona,"2");
		        
		          	if($respuesta==true){
		              
		              	echo "Acudiente Eliminado Correctamente.";
		          	}else{
		              
		              	echo "No se Pudo Eliminar";
		          	}
				}
				elseif (!$this->acudientes_model->validar_existencia_rol($identificacion,"profesores")) {
					
					$respuesta=$this->acudientes_model->eliminar_acudiente($id_persona,"2");
		        
		          	if($respuesta==true){
		              
		              	echo "Acudiente Eliminado Correctamente.";
		          	}else{
		              
		              	echo "No se Pudo Eliminar";
		          	}
				}
				elseif (!$this->acudientes_model->validar_existencia_rol($identificacion,"administradores")) {
					
					$respuesta=$this->acudientes_model->eliminar_acudiente($id_persona,"2");
		        
		          	if($respuesta==true){
		              
		              	echo "Acudiente Eliminado Correctamente.";
		          	}else{
		              
		              	echo "No se Pudo Eliminar";
		          	}
				}
				else{

					$respuesta=$this->acudientes_model->eliminar_acudiente($id_persona,"1");
		        
		          	if($respuesta==true){
		              
		              	echo "Acudiente Eliminado Correctamente.";

		              	if (!unlink("./uploads/imagenes/fotos/".$id_persona.".jpg")) {
		              		echo "Error Al Borrar La Imagen.";
		              	}

		          	}else{
		              
		              	echo "No se Pudo Eliminar";
		          	}

				}
			}
			else{
				echo "No Se Puede Eliminar Este Acudiente; Actualmente Se Encuentra Asociado A Una Matrícula.";
			}
          
        }else{
          
          	echo "digite valor numerico para identificar un acudiente";
        }
    }


    public function modificar(){

    	$id_persona = $this->input->post('id_persona');
    	$identificacion = trim($this->input->post('identificacion'));
    	$tipo_id = $this->input->post('tipo_id');
    	$nombres = ucwords(strtolower(trim($this->input->post('nombres'))));
    	$apellido1 = ucwords(strtolower(trim($this->input->post('apellido1'))));
    	$apellido2 = ucwords(strtolower(trim($this->input->post('apellido2'))));
    	$telefono = trim($this->input->post('telefono'));
    	$correo = trim($this->input->post('correo'));
    	$direccion = ucwords(strtolower(trim($this->input->post('direccion'))));
    	$barrio = ucwords(strtolower(trim($this->input->post('barrio'))));
    	$ocupacion = ucwords(strtolower(trim($this->input->post('ocupacion'))));
    	$telefono_trabajo = trim($this->input->post('telefono_trabajo'));
    	$direccion_trabajo = ucwords(strtolower(trim($this->input->post('direccion_trabajo'))));
    	$estado_acudiente = $this->input->post('estado_acudiente');


    	//array para insertar en la tabla personas----------
    	$acudiente = array(
		'id_persona' =>$id_persona,
		'identificacion' =>$identificacion,
		'tipo_id' =>$tipo_id,
		'nombres' =>$nombres,
		'apellido1' =>$apellido1,
		'apellido2' =>$apellido2,
		'telefono' =>$telefono,
		'email' =>$correo,
		'direccion' =>$direccion,
		'barrio' =>$barrio);

		//array para insertar en la tabla acudientes----------
    	$acudiente2 = array(
		'id_persona' =>$id_persona,
		'ocupacion' =>$ocupacion,
		'telefono_trabajo' =>$telefono_trabajo,
		'direccion_trabajo' =>$direccion_trabajo,
		'estado_acudiente' =>$estado_acudiente);

		//aqui creamos el username de un estudiante
		$user = strtolower(substr($nombres, 0, 2));
		$name = strtolower($apellido1);
		$username = $user.$name."ac".$id_persona;

		//array para insertar en la tabla usuarios
		$usuario = array(
		'id_persona' =>$id_persona,
		'id_rol' => 4,
		'username' =>$username,
		'password' =>sha1($identificacion),
		'acceso' =>0);

		$row = $this->acudientes_model->obtener_informacion_persona($id_persona,"2");
		$identificacion_buscada = $row[0]['identificacion'];

        if(is_numeric($identificacion)){

        	if ($identificacion_buscada == $identificacion){

	        	$respuesta=$this->acudientes_model->modificar_acudiente($id_persona,$acudiente,$acudiente2,$usuario);

				 if($respuesta==true){

					echo "registroactualizado";

	             }else{

					echo "registronoactualizado";

	             }
	        }          
         
        }else{
            
            echo "digite valor numerico para identificar un acudiente";
        }




    }


    public function validar_identificacion(){

		$identificacion = $this->input->post('identificacion'); 

		if ($this->acudientes_model->validar_existencia_rol($identificacion,"acudientes")){

			if ($this->acudientes_model->validar_existencia_rol($identificacion,"estudiantes")){

				if ($this->acudientes_model->validar_existencia_rol($identificacion,"profesores")){

					if ($this->acudientes_model->validar_existencia_rol($identificacion,"administradores")){

						echo "ok";
					}
					else{

						$consulta = $this->acudientes_model->obtener_informacion_persona($identificacion);
						echo json_encode($consulta);
					}	
				}
				else{

					$consulta = $this->acudientes_model->obtener_informacion_persona($identificacion);
					echo json_encode($consulta);
				}	
			}
			else{

				if ($this->acudientes_model->comprobar_estado_rol($identificacion,"estudiantes")) {

					$consulta = $this->acudientes_model->obtener_informacion_persona($identificacion);
					echo json_encode($consulta);
					
				}
				else{
					echo "estudianteactivo";
				}

			}
		}
		else{
			echo "acudienteyaexiste";
		}	
		
	    
	}


	public function validar_rol(){

		$identificacion = $this->input->post('identificacion');

		if (!$this->acudientes_model->validar_existencia_rol($identificacion,"estudiantes")) {
				
			echo "no";
		}
		elseif (!$this->acudientes_model->validar_existencia_rol($identificacion,"profesores")) {
			
			echo "no";
		}
		elseif (!$this->acudientes_model->validar_existencia_rol($identificacion,"administradores")) {
			
			echo "no";
		}
		else{

			echo "si";

		}


	}

}	