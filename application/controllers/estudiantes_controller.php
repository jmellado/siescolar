<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudiantes_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('estudiantes_model');
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
		$this->template->load('roles/rol_administrador_vista', 'estudiantes/registrar');
	}

	public function index2()
	{

		if($this->session->userdata('rol') == FALSE || $this->session->userdata('rol') != 'administrador')
		{
			redirect(base_url().'login_controller');
		}
		//$this->load->view('estudiantes/consultar2');
		$this->template->load('roles/rol_administrador_vista', 'estudiantes/consultar');
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
        	 $ultimo_id = $this->estudiantes_model->obtener_ultimo_id();

        	 //obtengo el ultimo id de padres + 1 
        	 $ultimo_id_padre = $this->estudiantes_model->obtener_ultimo_id_padres();
        	 $ultimo_id_madre = $ultimo_id_padre+1;

        	 //array para insertar en la tabla personas----------
        	$estudiante = array(
        	'id_persona' =>$ultimo_id,	
			'identificacion' =>$this->input->post('identificacion'),
			'tipo_id' =>$this->input->post('tipo_id'),
			'fecha_expedicion' =>$this->input->post('fecha_expedicion'),
			'departamento_expedicion' =>$this->input->post('departamento_expedicion'),
			'municipio_expedicion' =>$this->input->post('municipio_expedicion'),
			'nombres' =>ucwords($this->input->post('nombres')),
			'apellido1' =>ucwords($this->input->post('apellido1')),
			'apellido2' =>ucwords($this->input->post('apellido2')),
			'sexo' =>$this->input->post('sexo'),
			'fecha_nacimiento' =>$this->input->post('fecha_nacimiento'),
			'lugar_nacimiento' =>$this->input->post('lugar_nacimiento'),
			'tipo_sangre' =>$this->input->post('tipo_sangre'),
			'eps' =>ucwords($this->input->post('eps')),
			'poblacion' =>$this->input->post('poblacion'),
			'telefono' =>$this->input->post('telefono'),
			'email' =>$this->input->post('correo'),
			'direccion' =>$this->input->post('direccion'),
			'barrio' =>ucwords($this->input->post('barrio')) );

        	//array para insertar en la tabla estudiantes
			$estudiante2 = array(
			'id_persona' =>$ultimo_id,
			'institucion_procedencia' =>ucwords($this->input->post('institucion_procedencia')),
			'discapacidad' =>$this->input->post('discapacidad'));

			//aqui creamos el username de un estudiante
			$user = substr($this->input->post('nombres'), 0, 2);
			$name = $this->input->post('apellido1');
			$username = $user.$name.$ultimo_id;

			//array para insertar en la tabla usuarios
			$estudiante3 = array(
			'id_usuario' =>$ultimo_id,
			'id_persona' =>$ultimo_id,
			'id_rol' => 2,
			'username' =>$username,
			'password' =>sha1($this->input->post('identificacion')),
			'acceso' =>1);

			$estado = 'activo';
			//array del padre - para insertar en la tabla padres
			$padre = array(
			'id_padre' =>$ultimo_id_padre,
			'identificacion' =>$this->input->post('identificacion_padre'),
			'id_estudiante' =>$ultimo_id,
			'nombres' =>ucwords($this->input->post('nombres_padre')),
			'apellidos' =>ucwords($this->input->post('apellidos_padre')),
			'ocupacion' =>$this->input->post('ocupacion_padre'),
			'telefono' =>$this->input->post('telefono_padre'),
			'telefono_trabajo' =>$this->input->post('telefono_trabajo_padre'),
			'direccion_trabajo' =>$this->input->post('direccion_trabajo_padre'),
			'estado_padre' =>$estado);

			//array de la madre - para insertar en la tabla padres
			$madre = array(
			'id_padre' =>$ultimo_id_madre,
			'identificacion' =>$this->input->post('identificacion_madre'),
			'id_estudiante' =>$ultimo_id,
			'nombres' =>ucwords($this->input->post('nombres_madre')),
			'apellidos' =>ucwords($this->input->post('apellidos_madre')),
			'ocupacion' =>$this->input->post('ocupacion_madre'),
			'telefono' =>$this->input->post('telefono_madre'),
			'telefono_trabajo' =>$this->input->post('telefono_trabajo_madre'),
			'direccion_trabajo' =>$this->input->post('direccion_trabajo_madre'),
			'estado_padre' =>$estado);
			

			if ($this->estudiantes_model->validar_existencia($this->input->post('identificacion'))){

				$respuesta=$this->estudiantes_model->insertar_estudiante($estudiante,$estudiante2,$estudiante3,$padre,$madre);
				

				if($respuesta==true){

					echo "registroguardado";

				}
				else{
					echo "registronoguardado";
				}


			}
			else{

				echo "estudiante ya existe";
			}



        }
        

	}

	public function mostrarestudiantes(){

		$id =$this->input->post('id_buscar'); 
		$numero_pagina =$this->input->post('numero_pagina'); 
		$cantidad =$this->input->post('cantidad'); 
		$inicio = ($numero_pagina -1)*$cantidad;
		
		//---------FORMA PARA JSON ARRAY---------
		//$consulta = $data['buscado'] = $this->estudiantes_model->buscar_estudiante($id);
		
		//---------FORMA PARA JSON OBJECTH---------
		$data = array(

			'estudiantes' => $this->estudiantes_model->buscar_estudiante($id,$inicio,$cantidad),

		    'totalregistros' => count($this->estudiantes_model->buscar_estudiante($id)),

		    'cantidad' => $cantidad


		);
	    echo json_encode($data);


	}

	public function modificar(){

		//array para actualizar en la tabla personas----------
		$estudiante = array(
        	'id_persona' =>$this->input->post('id_persona'),	
			'identificacion' =>$this->input->post('identificacion'),
			'tipo_id' =>$this->input->post('tipo_id'),
			'fecha_expedicion' =>$this->input->post('fecha_expedicion'),
			'departamento_expedicion' =>$this->input->post('departamento_expedicion'),
			'municipio_expedicion' =>$this->input->post('municipio_expedicion'),
			'nombres' =>ucwords($this->input->post('nombres')),
			'apellido1' =>ucwords($this->input->post('apellido1')),
			'apellido2' =>ucwords($this->input->post('apellido2')),
			'sexo' =>$this->input->post('sexo'),
			'fecha_nacimiento' =>$this->input->post('fecha_nacimiento'),
			'lugar_nacimiento' =>$this->input->post('lugar_nacimiento'),
			'tipo_sangre' =>$this->input->post('tipo_sangre'),
			'eps' =>ucwords($this->input->post('eps')),
			'poblacion' =>$this->input->post('poblacion'),
			'telefono' =>$this->input->post('telefono'),
			'email' =>$this->input->post('correo'),
			'direccion' =>$this->input->post('direccion'),
			'barrio' =>ucwords($this->input->post('barrio')) );

		//array para actualizar en la tabla estudiantes----------
		$estudiante2 = array(
			'id_persona' =>$this->input->post('id_persona'),
			'institucion_procedencia' =>ucwords($this->input->post('institucion_procedencia')),
			'discapacidad' =>$this->input->post('discapacidad'));

		//aqui creamos el username de un estudiante
			$id_persona = $this->input->post('id_persona');
			$user = substr($this->input->post('nombres'), 0, 2);
			$name = $this->input->post('apellido1');
			$username = $user.$name.$id_persona;

		//array para actualizar en la tabla usuarios----------	
		$estudiante3 = array(
			'id_usuario' =>$this->input->post('id_persona'),
			'id_persona' =>$this->input->post('id_persona'),
			'id_rol' => 2,
			'username' =>$username,
			'password' =>sha1($this->input->post('identificacion')),
			'acceso' =>1);

		


    	$id = $this->input->post('identificacion');
        if(is_numeric($id)){
          
                $respuesta=$this->estudiantes_model->modificar_estudiante($this->input->post('id_persona'),$estudiante);
                $respuesta2=$this->estudiantes_model->modificar_estudiante2($this->input->post('id_persona'),$estudiante2); 
                $respuesta3=$this->estudiantes_model->modificar_estudiante3($this->input->post('id_persona'),$estudiante3);   
                if($respuesta==true && $respuesta2==true && $respuesta3==true){
                    
                    echo "registro actualizado";
                }else{
                   
                	echo "registro no se pudo actualizar";
                }
                //redirect(base_url());
         
        }else{
            //redirect(base_url()); 
            echo "digite valor numerico para la cedula";
        }
    }

    public function eliminar(){

	  	$id =$this->input->post('id'); 

        if(is_numeric($id)){

			
	        $respuesta=$this->estudiantes_model->eliminar_estudiante($id);
	        //$respuesta2=$this->estudiantes_model->eliminar_estudiante2($id);
			//$respuesta3=$this->estudiantes_model->eliminar_estudiante3($id);	
          	if($respuesta==true){
              
              	echo "eliminado correctamente";
          	}else{
              
              	echo "no se pudo eliminar";
          	}
          //redirect(base_url());
        }else{
          //redirect(base_url());
          	echo "digite valor numerico para la cedula";
        }
    }

    public function llenarcombo_departamentos(){

    	$consulta = $this->estudiantes_model->llenar_departamentos();
    	echo json_encode($consulta);
    }

    public function llenarcombo_municipios(){

    	$id =$this->input->post('id');
    	$consulta = $this->estudiantes_model->llenar_municipios($id);
    	echo json_encode($consulta);
    }





	
}