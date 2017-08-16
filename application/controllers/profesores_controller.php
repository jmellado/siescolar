<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesores_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('profesores_model');
		$this->load->library('form_validation');
		//$this->load->database('default');
	}

	
	public function index()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		//$this->load->view('estudiantes/registrar2');
		$this->template->load('roles/rol_administrador_vista', 'profesores/profesores_vista');
	}

	
	public function insertar(){

		$this->form_validation->set_rules('identificacion', 'id de usuario', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('nombres', 'nombre de usuario', 'required|alpha_spaces');
        $this->form_validation->set_rules('apellido1', 'apellido de usuario', 'required|alpha_spaces');
        $this->form_validation->set_rules('sexo', 'sexo', 'required|min_length[1]|max_length[1]');

        if ($this->form_validation->run() == FALSE){

        	echo validation_errors();
        }
        else{
        	//obtengo el ultimo id de persona + 1 
        	 $ultimo_id = $this->profesores_model->obtener_ultimo_id();

        	$campo = '';
        	 //array para insertar en la tabla personas----------
        	$profesor = array(
        	'id_persona' =>$ultimo_id,	
			'identificacion' =>$this->input->post('identificacion'),
			'tipo_id' =>$this->input->post('tipo_id'),
			'fecha_expedicion' =>$campo,
			'departamento_expedicion' =>$campo,
			'municipio_expedicion' =>$campo,
			'nombres' =>ucwords($this->input->post('nombres')),
			'apellido1' =>ucwords($this->input->post('apellido1')),
			'apellido2' =>ucwords($this->input->post('apellido2')),
			'sexo' =>$this->input->post('sexo'),
			'fecha_nacimiento' =>$this->input->post('fecha_nacimiento'),
			'lugar_nacimiento' =>$campo,
			'tipo_sangre' =>$campo,
			'eps' =>$campo,
			'poblacion' =>$campo,
			'telefono' =>$this->input->post('telefono'),
			'email' =>$this->input->post('correo'),
			'direccion' =>$this->input->post('direccion'),
			'barrio' =>$campo );

        	//array para insertar en la tabla profesores
			$profesor2 = array(
			'id_persona' =>$ultimo_id,
			'perfil' =>ucwords($this->input->post('perfil')),
			'escalafon' =>ucwords($this->input->post('escalafon')),
			'fecha_inicio' =>$this->input->post('fecha_inicio'),
			'tipo_contrato' =>$this->input->post('tipo_contrato'));

			//aqui creamos el username de un profesor
			$user = strtolower(substr($this->input->post('nombres'), 0, 2));
			$name = strtolower($this->input->post('apellido1'));
			$username = $user.$name.$ultimo_id;

			//array para insertar en la tabla usuarios
			$profesor3 = array(
			'id_usuario' =>$ultimo_id,
			'id_persona' =>$ultimo_id,
			'id_rol' => 3,
			'username' =>$username,
			'password' =>sha1($this->input->post('identificacion')),
			'acceso' =>1);

			
			if ($this->profesores_model->validar_existencia($this->input->post('identificacion'))){

				$respuesta=$this->profesores_model->insertar_profesor($profesor,$profesor2,$profesor3);
				

				if($respuesta==true){

					echo "registroguardado";

				}
				else{
					echo "registronoguardado";
				}


			}
			else{

				echo "profesor ya existe";
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

		$campo = '';
		//array para actualizar en la tabla personas----------
		$profesor = array(
        	'id_persona' =>$this->input->post('id_persona'),	
			'identificacion' =>$this->input->post('identificacion'),
			'tipo_id' =>$this->input->post('tipo_id'),
			'fecha_expedicion' =>$campo,
			'departamento_expedicion' =>$campo,
			'municipio_expedicion' =>$campo,
			'nombres' =>ucwords($this->input->post('nombres')),
			'apellido1' =>ucwords($this->input->post('apellido1')),
			'apellido2' =>ucwords($this->input->post('apellido2')),
			'sexo' =>$this->input->post('sexo'),
			'fecha_nacimiento' =>$this->input->post('fecha_nacimiento'),
			'lugar_nacimiento' =>$campo,
			'tipo_sangre' =>$campo,
			'eps' =>$campo,
			'poblacion' =>$campo,
			'telefono' =>$this->input->post('telefono'),
			'email' =>$this->input->post('correo'),
			'direccion' =>$this->input->post('direccion'),
			'barrio' =>$campo);

		//array para actualizar en la tabla profesores----------
		$profesor2 = array(
			'id_persona' =>$this->input->post('id_persona'),
			'perfil' =>ucwords($this->input->post('perfil')),
			'escalafon' =>ucwords($this->input->post('escalafon')),
			'fecha_inicio' =>$this->input->post('fecha_inicio'),
			'tipo_contrato' =>$this->input->post('tipo_contrato'));

		//aqui creamos el username de un profesor
			$id_persona = $this->input->post('id_persona');
			$user = strtolower(substr($this->input->post('nombres'), 0, 2));
			$name = strtolower($this->input->post('apellido1'));
			$username = $user.$name.$id_persona;

		//array para actualizar en la tabla usuarios----------	
		$profesor3 = array(
			'id_usuario' =>$this->input->post('id_persona'),
			'id_persona' =>$this->input->post('id_persona'),
			'id_rol' => 2,
			'username' =>$username,
			'password' =>sha1($this->input->post('identificacion')),
			'acceso' =>1);

		
		
    	$id = $this->input->post('id_persona');
    	$identificacion_buscado = $this->profesores_model->obtener_identificacion($id);

        if(is_numeric($id)){

        	if($identificacion_buscado == $this->input->post('identificacion')){
          
                $respuesta=$this->profesores_model->modificar_profesor($this->input->post('id_persona'),$profesor);
                $respuesta2=$this->profesores_model->modificar_profesor2($this->input->post('id_persona'),$profesor2); 
                $respuesta3=$this->profesores_model->modificar_profesor3($this->input->post('id_persona'),$profesor3);   
                if($respuesta==true && $respuesta2==true && $respuesta3==true){
                    
                    echo "registro actualizado";
                }else{
                   
                	echo "registro no se pudo actualizar";
                }

            }
            else{

            	if($this->profesores_model->validar_existencia($this->input->post('identificacion'))){

            		$respuesta=$this->profesores_model->modificar_profesor($this->input->post('id_persona'),$profesor);
                	$respuesta2=$this->profesores_model->modificar_profesor2($this->input->post('id_persona'),$profesor2); 
                	$respuesta3=$this->profesores_model->modificar_profesor3($this->input->post('id_persona'),$profesor3);   
                	if($respuesta==true && $respuesta2==true && $respuesta3==true){
                    
                    	echo "registro actualizado";
                	}else{
                   
                		echo "registro no se pudo actualizar";
               		}



            	}else{

            		echo "identificacion ya registrada";

            	}

            }
                
         
        }else{
            
            echo "digite valor numerico para identificar una persona";
        }
    }

    public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->profesores_model->eliminar_profesor($id);
	        	
          	if($respuesta==true){
              
              	echo "eliminado correctamente";
          	}else{
              
              	echo "no se pudo eliminar";
          	}
         
        }else{
          
          	echo "digite valor numerico para la cedula";
        }
    }

 



	
}