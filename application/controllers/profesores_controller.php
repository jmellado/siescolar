<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesores_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('profesores_model');
		$this->load->library('form_validation');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		
		$this->template->load('roles/rol_administrador_vista', 'profesores/profesores_vista');
	}

	
	public function insertar(){

		$this->form_validation->set_rules('identificacion', 'Identificación', 'required|numeric|max_length[10]');
		$this->form_validation->set_rules('tipo_id', 'Tipo De Identificación', 'required');
		$this->form_validation->set_rules('fecha_expedicion', 'Fecha De Expedicion', 'required');
		$this->form_validation->set_rules('pais_expedicion', 'Pais De Expedicion', 'required');
        $this->form_validation->set_rules('departamento_expedicion', 'Dpto. De Expedicion', 'required');
        $this->form_validation->set_rules('municipio_expedicion', 'Mcpio. De Expedicion', 'required');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1', 'Primer Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2', 'Segundo Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('fecha_nacimiento', 'Fecha De Nacimiento', 'required');
        $this->form_validation->set_rules('pais_nacimiento', 'Pais De Nacimiento', 'required');
        $this->form_validation->set_rules('departamento_nacimiento', 'Dpto. De Nacimiento', 'required');
        $this->form_validation->set_rules('municipio_nacimiento', 'Mcpio. De Nacimiento', 'required');
        $this->form_validation->set_rules('correo', 'Correo', 'required');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('barrio', 'Barrio', 'required|alpha_spaces');
        $this->form_validation->set_rules('pais_residencia', 'Pais De Residencia', 'required');
        $this->form_validation->set_rules('departamento_residencia', 'Dpto. De Residencia', 'required');
        $this->form_validation->set_rules('municipio_residencia', 'Mcpio. De Residencia', 'required');
        $this->form_validation->set_rules('estrato', 'Estrato', 'required');

        $this->form_validation->set_rules('titulo', 'Titulo', 'required');
        $this->form_validation->set_rules('escalafon', 'Escalafon', 'required');
        $this->form_validation->set_rules('fecha_vinculacion', 'Fecha vinculacion', 'required');
        $this->form_validation->set_rules('tipo_vinculacion', 'Tipo vinculacion', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();
        }
        else{

        	//obtengo el ultimo id de persona + 1 
        	$ultimo_id = $this->profesores_model->obtener_ultimo_id();

        	$identificacion = $this->input->post('identificacion');
			$tipo_id = $this->input->post('tipo_id');
			$fecha_expedicion = $this->input->post('fecha_expedicion');
			$pais_expedicion = $this->input->post('pais_expedicion');
			$departamento_expedicion = $this->input->post('departamento_expedicion');
			$municipio_expedicion = $this->input->post('municipio_expedicion');
			$nombres = mb_convert_case(mb_strtolower(trim($this->input->post('nombres'))), MB_CASE_TITLE);
			$apellido1 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido1'))), MB_CASE_TITLE);
			$apellido2 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido2'))), MB_CASE_TITLE);
			$sexo = $this->input->post('sexo');
			$fecha_nacimiento = $this->input->post('fecha_nacimiento');
			$pais_nacimiento = $this->input->post('pais_nacimiento');
			$departamento_nacimiento = $this->input->post('departamento_nacimiento');
			$municipio_nacimiento = $this->input->post('municipio_nacimiento');
			$telefono = trim($this->input->post('telefono'));
			$email = trim($this->input->post('correo'));
			$direccion = mb_convert_case(mb_strtolower(trim($this->input->post('direccion'))), MB_CASE_TITLE);
			$barrio = mb_convert_case(mb_strtolower(trim($this->input->post('barrio'))), MB_CASE_TITLE);
			$pais_residencia = $this->input->post('pais_residencia');
			$departamento_residencia = $this->input->post('departamento_residencia');
			$municipio_residencia = $this->input->post('municipio_residencia');
			$estrato = $this->input->post('estrato');

			$titulo = mb_convert_case(mb_strtolower(trim($this->input->post('titulo'))), MB_CASE_TITLE);
			$escalafon = mb_convert_case(mb_strtolower($this->input->post('escalafon')), MB_CASE_TITLE);
			$fecha_vinculacion = $this->input->post('fecha_vinculacion');
			$tipo_vinculacion = $this->input->post('tipo_vinculacion');
			$decreto_nombramiento = mb_convert_case(mb_strtolower(trim($this->input->post('decreto'))), MB_CASE_TITLE);

        	//array para insertar en la tabla personas
			$profesor = array(
        	'id_persona'       =>$ultimo_id,	
			'identificacion'   =>$identificacion,
			'tipo_id'          =>$tipo_id,
			'fecha_expedicion' =>$fecha_expedicion,
			'pais_expedicion'  =>$pais_expedicion,
			'departamento_expedicion' =>$departamento_expedicion,
			'municipio_expedicion'    =>$municipio_expedicion,
			'nombres'          =>$nombres,
			'apellido1'        =>$apellido1,
			'apellido2'        =>$apellido2,
			'sexo'             =>$sexo,
			'fecha_nacimiento' =>$fecha_nacimiento,
			'pais_nacimiento'  =>$pais_nacimiento,
			'departamento_nacimiento' =>$departamento_nacimiento,
			'municipio_nacimiento'    =>$municipio_nacimiento,
			'telefono'         =>$telefono,
			'email'            =>$email,
			'direccion'        =>$direccion,
			'barrio'           =>$barrio,
			'pais_residencia'  =>$pais_residencia,
			'departamento_residencia' =>$departamento_residencia,
			'municipio_residencia'    =>$municipio_residencia,
			'estrato'          =>$estrato);

        	//array para insertar en la tabla profesores
			$profesor2 = array(
			'id_persona'           =>$ultimo_id,
			'titulo'               =>$titulo,
			'escalafon'            =>$escalafon,
			'fecha_vinculacion'    =>$fecha_vinculacion,
			'tipo_vinculacion'     =>$tipo_vinculacion,
			'decreto_nombramiento' =>$decreto_nombramiento);

			//aqui creamos el username de un profesor
			$user = mb_strtolower(substr($nombres, 0, 2));
			$name = mb_strtolower(str_replace(" ", "", $apellido1));
			$username = $user.$name.$ultimo_id;

			//array para insertar en la tabla usuarios
			$usuario = array(
			'id_usuario' =>$ultimo_id,
			'id_persona' =>$ultimo_id,
			'id_rol'     =>3,
			'username'   =>$username,
			'password'   =>sha1($identificacion),
			'acceso'     =>1);

			
			if ($this->profesores_model->validar_existencia_rol($identificacion,"profesores")){

				if ($this->profesores_model->validar_existencia_rol($identificacion,"estudiantes")){

					if ($this->profesores_model->validar_existencia_rol($identificacion,"acudientes")){

						if ($this->profesores_model->validar_existencia_rol($identificacion,"administradores")){

							$respuesta=$this->profesores_model->insertar_profesor($profesor,$profesor2,$usuario);
							
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

							$resultado = $this->procesar_registro($identificacion,$nombres,$apellido1,$apellido2,$fecha_expedicion,$pais_expedicion,$departamento_expedicion,$municipio_expedicion,$sexo,$fecha_nacimiento,$pais_nacimiento,$departamento_nacimiento,$municipio_nacimiento,$pais_residencia,$departamento_residencia,$municipio_residencia,$estrato,$titulo,$escalafon,$fecha_vinculacion,$tipo_vinculacion,$decreto_nombramiento);

							echo $resultado;

						}

					}
					else{

						$resultado = $this->procesar_registro($identificacion,$nombres,$apellido1,$apellido2,$fecha_expedicion,$pais_expedicion,$departamento_expedicion,$municipio_expedicion,$sexo,$fecha_nacimiento,$pais_nacimiento,$departamento_nacimiento,$municipio_nacimiento,$pais_residencia,$departamento_residencia,$municipio_residencia,$estrato,$titulo,$escalafon,$fecha_vinculacion,$tipo_vinculacion,$decreto_nombramiento);

						echo $resultado;

					}

				}
				else{

					//COMPROBAMOS QUE EL ESTADO DE ESE ESTUDIANTE NO SEA ACTIVO.
					if ($this->profesores_model->comprobar_estado_rol($identificacion,"estudiantes")) {

						$resultado = $this->procesar_registro($identificacion,$nombres,$apellido1,$apellido2,$fecha_expedicion,$pais_expedicion,$departamento_expedicion,$municipio_expedicion,$sexo,$fecha_nacimiento,$pais_nacimiento,$departamento_nacimiento,$municipio_nacimiento,$pais_residencia,$departamento_residencia,$municipio_residencia,$estrato,$titulo,$escalafon,$fecha_vinculacion,$tipo_vinculacion,$decreto_nombramiento);

						echo $resultado;

					}
					else{

						echo "estudianteactivo";
					}

				}

			}
			else{

				echo "profesoryaexiste";
			}

        }
        

	}

	public function mostrarprofesores(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		//---------FORMA PARA JSON ARRAY---------
		//$consulta = $data['buscado'] = $this->estudiantes_model->buscar_estudiante($id);
		
		//---------FORMA PARA JSON OBJECTH---------
		$data = array(

			'profesores' => $this->profesores_model->buscar_profesor($id,$inicio,$cantidad),

		    'totalregistros' => count($this->profesores_model->buscar_profesor($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function modificar(){

		$this->form_validation->set_rules('identificacion', 'Identificación', 'required|numeric|max_length[10]');
		$this->form_validation->set_rules('tipo_id', 'Tipo De Identificación', 'required');
		$this->form_validation->set_rules('fecha_expedicion', 'Fecha De Expedicion', 'required');
		$this->form_validation->set_rules('pais_expedicion', 'Pais De Expedicion', 'required');
        $this->form_validation->set_rules('departamento_expedicion', 'Dpto. De Expedicion', 'required');
        $this->form_validation->set_rules('municipio_expedicion', 'Mcpio. De Expedicion', 'required');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1', 'Primer Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido2', 'Segundo Apellido', 'required|alpha_spaces');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('fecha_nacimiento', 'Fecha De Nacimiento', 'required');
        $this->form_validation->set_rules('pais_nacimiento', 'Pais De Nacimiento', 'required');
        $this->form_validation->set_rules('departamento_nacimiento', 'Dpto. De Nacimiento', 'required');
        $this->form_validation->set_rules('municipio_nacimiento', 'Mcpio. De Nacimiento', 'required');
        $this->form_validation->set_rules('correo', 'Correo', 'required');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|alpha_spaces');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('barrio', 'Barrio', 'required|alpha_spaces');
        $this->form_validation->set_rules('pais_residencia', 'Pais De Residencia', 'required');
        $this->form_validation->set_rules('departamento_residencia', 'Dpto. De Residencia', 'required');
        $this->form_validation->set_rules('municipio_residencia', 'Mcpio. De Residencia', 'required');
        $this->form_validation->set_rules('estrato', 'Estrato', 'required');

        $this->form_validation->set_rules('titulo', 'Titulo', 'required');
        $this->form_validation->set_rules('escalafon', 'Escalafon', 'required');
        $this->form_validation->set_rules('fecha_vinculacion', 'Fecha vinculacion', 'required');
        $this->form_validation->set_rules('tipo_vinculacion', 'Tipo vinculacion', 'required');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();
        }
        else{

        	$id_persona = $this->input->post('id_persona');
        	$identificacion = $this->input->post('identificacion');
			$tipo_id = $this->input->post('tipo_id');
			$fecha_expedicion = $this->input->post('fecha_expedicion');
			$pais_expedicion = $this->input->post('pais_expedicion');
			$departamento_expedicion = $this->input->post('departamento_expedicion');
			$municipio_expedicion = $this->input->post('municipio_expedicion');
			$nombres = mb_convert_case(mb_strtolower(trim($this->input->post('nombres'))), MB_CASE_TITLE);
			$apellido1 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido1'))), MB_CASE_TITLE);
			$apellido2 = mb_convert_case(mb_strtolower(trim($this->input->post('apellido2'))), MB_CASE_TITLE);
			$sexo = $this->input->post('sexo');
			$fecha_nacimiento = $this->input->post('fecha_nacimiento');
			$pais_nacimiento = $this->input->post('pais_nacimiento');
			$departamento_nacimiento = $this->input->post('departamento_nacimiento');
			$municipio_nacimiento = $this->input->post('municipio_nacimiento');
			$telefono = trim($this->input->post('telefono'));
			$email = trim($this->input->post('correo'));
			$direccion = mb_convert_case(mb_strtolower(trim($this->input->post('direccion'))), MB_CASE_TITLE);
			$barrio = mb_convert_case(mb_strtolower(trim($this->input->post('barrio'))), MB_CASE_TITLE);
			$pais_residencia = $this->input->post('pais_residencia');
			$departamento_residencia = $this->input->post('departamento_residencia');
			$municipio_residencia = $this->input->post('municipio_residencia');
			$estrato = $this->input->post('estrato');

			$titulo = mb_convert_case(mb_strtolower(trim($this->input->post('titulo'))), MB_CASE_TITLE);
			$escalafon = mb_convert_case(mb_strtolower($this->input->post('escalafon')), MB_CASE_TITLE);
			$fecha_vinculacion = $this->input->post('fecha_vinculacion');
			$tipo_vinculacion = $this->input->post('tipo_vinculacion');
			$decreto_nombramiento = mb_convert_case(mb_strtolower(trim($this->input->post('decreto'))), MB_CASE_TITLE);

			//array para actualizar en la tabla personas
			$profesor = array(
        	'id_persona'       =>$id_persona,	
			'identificacion'   =>$identificacion,
			'tipo_id'          =>$tipo_id,
			'fecha_expedicion' =>$fecha_expedicion,
			'pais_expedicion'  =>$pais_expedicion,
			'departamento_expedicion' =>$departamento_expedicion,
			'municipio_expedicion'    =>$municipio_expedicion,
			'nombres'          =>$nombres,
			'apellido1'        =>$apellido1,
			'apellido2'        =>$apellido2,
			'sexo'             =>$sexo,
			'fecha_nacimiento' =>$fecha_nacimiento,
			'pais_nacimiento'  =>$pais_nacimiento,
			'departamento_nacimiento' =>$departamento_nacimiento,
			'municipio_nacimiento'    =>$municipio_nacimiento,
			'telefono'         =>$telefono,
			'email'            =>$email,
			'direccion'        =>$direccion,
			'barrio'           =>$barrio,
			'pais_residencia'  =>$pais_residencia,
			'departamento_residencia' =>$departamento_residencia,
			'municipio_residencia'    =>$municipio_residencia,
			'estrato'          =>$estrato);

			//array para actualizar en la tabla profesores
			$profesor2 = array(
			'id_persona'           =>$id_persona,
			'titulo'               =>$titulo,
			'escalafon'            =>$escalafon,
			'fecha_vinculacion'    =>$fecha_vinculacion,
			'tipo_vinculacion'     =>$tipo_vinculacion,
			'decreto_nombramiento' =>$decreto_nombramiento);

			//aqui creamos el username de un profesor
			$user = mb_strtolower(substr($nombres, 0, 2));
			$name = mb_strtolower(str_replace(" ", "", $apellido1));
			$username = $user.$name.$id_persona;

			//array para actualizar en la tabla usuarios	
			$usuario = array(
			'id_persona' =>$id_persona,
			'id_rol'     =>3,
			'username'   =>$username,
			'password'   =>sha1($identificacion));


	    	$identificacion_buscada = $this->profesores_model->obtener_identificacion($id_persona);

	        if(is_numeric($id_persona)){

	        	if($identificacion_buscada == $identificacion){
	          
	                $respuesta=$this->profesores_model->modificar_profesor($id_persona,$profesor,$profesor2,$usuario);
	                
	                if($respuesta==true){
	                    
	                    echo "registroactualizado";

	                    $act_usu = $this->profesores_model->actualizar_usuarios_persona($id_persona,$identificacion,$nombres,$apellido1,$apellido2);

	                }else{
	                   
	                	echo "registronoactualizado";
	                }

	            }
	            else{

	            	if($this->profesores_model->validar_existencia($identificacion)){

	            		$respuesta=$this->profesores_model->modificar_profesor($id_persona,$profesor,$profesor2,$usuario);
	                	  
	                	if($respuesta==true){
	                    
	                    	echo "registroactualizado";

	                    	$act_usu = $this->profesores_model->actualizar_usuarios_persona($id_persona,$identificacion,$nombres,$apellido1,$apellido2);
	                    	
	                	}else{
	                   
	                		echo "registronoactualizado";
	               		}


	            	}else{

	            		echo "profesoryaexiste";

	            	}

	            }
	                
	         
	        }else{
	            
	            echo "digite valor numerico para identificar un profesor";
	        }

	    }
    }

    public function eliminar(){

	  	$id_persona =$this->input->post('id'); 

        if(is_numeric($id_persona)){

        	if ($this->profesores_model->ValidarExistencia_ProfesorEnCargasAcademicas($id_persona)){

        		$persona = $this->profesores_model->obtener_informacion_persona($id_persona,"2");
				$identificacion = $persona[0]['identificacion'];

				if (!$this->profesores_model->validar_existencia_rol($identificacion,"estudiantes")) {
					
					$respuesta=$this->profesores_model->eliminar_profesor($id_persona,"2");
		        
		          	if($respuesta==true){
		              
		              	echo "Profesor Eliminado Correctamente.";
		          	}else{
		              
		              	echo "No se Pudo Eliminar";
		          	}
				}
				elseif (!$this->profesores_model->validar_existencia_rol($identificacion,"acudientes")) {
					
					$respuesta=$this->profesores_model->eliminar_profesor($id_persona,"2");
		        
		          	if($respuesta==true){
		              
		              	echo "Profesor Eliminado Correctamente.";
		          	}else{
		              
		              	echo "No se Pudo Eliminar";
		          	}
				}
				elseif (!$this->profesores_model->validar_existencia_rol($identificacion,"administradores")) {
					
					$respuesta=$this->profesores_model->eliminar_profesor($id_persona,"2");
		        
		          	if($respuesta==true){
		              
		              	echo "Profesor Eliminado Correctamente.";
		          	}else{
		              
		              	echo "No se Pudo Eliminar";
		          	}
				}
				else{

					$respuesta=$this->profesores_model->eliminar_profesor($id_persona);
		        
		          	if($respuesta==true){
		              
		              	echo "Profesor Eliminado Correctamente.";

		              	if (!unlink("./uploads/imagenes/fotos/".$id_persona.".jpg")) {
		              		echo "Error Al Borrar La Imagen.";
		              	}

		          	}else{
		              
		              	echo "No se Pudo Eliminar";
		          	}

				}

		    }
		    else{
		    	echo "No Se Puede Eliminar Este Profesor; Actualmente Tiene Asociadas Cargas Académicas.";
		    }
         
        }else{
          
          	echo "digite valor numerico para identificar un profesor";
        }
    }

 
    public function llenarcombo_paises(){

    	$consulta = $this->profesores_model->llenar_paises();
    	echo json_encode($consulta);
    }

    public function llenarcombo_departamentos(){

    	$id =$this->input->post('id');
    	$consulta = $this->profesores_model->llenar_departamentos($id);
    	echo json_encode($consulta);
    }

    public function llenarcombo_municipios(){

    	$id =$this->input->post('id');
    	$consulta = $this->profesores_model->llenar_municipios($id);
    	echo json_encode($consulta);
    }



    //================== FUNCIONES PARA VALIDAR PERSONA EXISTENTE ===================


    public function validar_identificacion(){

		$identificacion = $this->input->post('identificacion'); 

		if ($this->profesores_model->validar_existencia_rol($identificacion,"profesores")){

			if ($this->profesores_model->validar_existencia_rol($identificacion,"estudiantes")){

				if ($this->profesores_model->validar_existencia_rol($identificacion,"acudientes")){

					if ($this->profesores_model->validar_existencia_rol($identificacion,"administradores")){

						echo "ok";
					}
					else{

						$consulta = $this->profesores_model->obtener_informacion_persona($identificacion);
						echo json_encode($consulta);
					}	
				}
				else{

					$consulta = $this->profesores_model->obtener_informacion_persona($identificacion);
					echo json_encode($consulta);
				}	
			}
			else{

				if ($this->profesores_model->comprobar_estado_rol($identificacion,"estudiantes")) {

					$consulta = $this->profesores_model->obtener_informacion_persona($identificacion);
					echo json_encode($consulta);
					
				}
				else{
					echo "estudianteactivo";
				}

			}
		}
		else{
			echo "profesoryaexiste";
		}	
	    
	}


	public function procesar_registro($identificacion,$nombres,$apellido1,$apellido2,$fecha_expedicion,$pais_expedicion,$departamento_expedicion,$municipio_expedicion,$sexo,$fecha_nacimiento,$pais_nacimiento,$departamento_nacimiento,$municipio_nacimiento,$pais_residencia,$departamento_residencia,$municipio_residencia,$estrato,$titulo,$escalafon,$fecha_vinculacion,$tipo_vinculacion,$decreto_nombramiento){

		$persona = $this->profesores_model->obtener_informacion_persona($identificacion);
		$id_persona = $persona[0]['id_persona'];

		//array para actualizar en la tabla personas
		$profesor = array(
		'fecha_expedicion' =>$fecha_expedicion,
		'pais_expedicion'  =>$pais_expedicion,
		'departamento_expedicion' =>$departamento_expedicion,
		'municipio_expedicion'    =>$municipio_expedicion,
		'sexo'             =>$sexo,
		'fecha_nacimiento' =>$fecha_nacimiento,
		'pais_nacimiento'  =>$pais_nacimiento,
		'departamento_nacimiento' =>$departamento_nacimiento,
		'municipio_nacimiento'    =>$municipio_nacimiento,
		'pais_residencia'  =>$pais_residencia,
		'departamento_residencia' =>$departamento_residencia,
		'municipio_residencia'    =>$municipio_residencia,
		'estrato'          =>$estrato);

		//array para insertar en la tabla profesores
		$profesor2 = array(
		'id_persona'           =>$id_persona,
		'titulo'               =>$titulo,
		'escalafon'            =>$escalafon,
		'fecha_vinculacion'    =>$fecha_vinculacion,
		'tipo_vinculacion'     =>$tipo_vinculacion,
		'decreto_nombramiento' =>$decreto_nombramiento);

		//aqui creamos el username de un profesor
		$user = mb_strtolower(substr($nombres, 0, 2));
		$name = mb_strtolower(str_replace(" ", "", $apellido1));
		$username = $user.$name.$id_persona;

		//array para insertar en la tabla usuarios
		$usuario = array(
		'id_persona' =>$id_persona,
		'id_rol'     =>3,
		'username'   =>$username,
		'password'   =>sha1($identificacion),
		'acceso'     =>1);

		$respuesta=$this->profesores_model->insertar_profesor_rol($id_persona,$profesor,$profesor2,$usuario);

		if($respuesta==true){

			return "registroguardado";
		}
		else{

			return "registronoguardado";
		}


	}


	
}